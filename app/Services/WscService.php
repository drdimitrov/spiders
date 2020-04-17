<?php

namespace App\Services;

use App\Species;
use App\Genus;
use App\Family;
use App\Record;
use Storage;
use Carbon\Carbon;
use App\DailyUpdate;
use GuzzleHttp\Client;

class WscService{

	protected $apiKey;
	protected $client;

	public function __construct($apiKey)
	{
		$this->apiKey = $apiKey;
		$this->client = new Client();
	}

	public function fetchSpecies($lsid){

		$res = $this->client->request(
			'GET',
			'http://wsc.nmbe.ch/api/lsid/urn:lsid:nmbe.ch:spidersp:' . $lsid  . '?apiKey=' . $this->apiKey
		);

		
		return json_decode($res->getBody());
	}

	public function fetchGenus($lsid){

		$res = $this->client->request(
			'GET',
			'http://wsc.nmbe.ch/api/lsid/urn:lsid:nmbe.ch:spidergen:' . $lsid  . '?apiKey=' . $this->apiKey
		);

		
		return json_decode($res->getBody());
	}

	public function fetchFamily($lsid){

		$res = $this->client->request(
			'GET',
			'http://wsc.nmbe.ch/api/lsid/urn:lsid:nmbe.ch:spiderfam:' . $lsid  . '?apiKey=' . $this->apiKey
		);

		
		return json_decode($res->getBody());
	}
	
	public function fetchUpdatedTaxa($date){

		$taxa = [];
		$updated = [];

		$res = $this->client->request(
			'GET',
			'http://wsc.nmbe.ch/api/updates?date=' . $date . '&apiKey=' . $this->apiKey
		);

		
		$temp = json_decode($res->getBody());
		
		if(isset($temp->updates)){			
			foreach($temp->updates as $update){
				$taxa[] = $update;
			}
		}
		
		if(isset($temp->_links->next)){
			$next = $this->nextLink($temp->_links->next);
			$taxa = array_merge($taxa, $next);
		}

		foreach($taxa as $tx){

			if (strpos($tx, 'urn:lsid:nmbe.ch:spiderfam') !== false){
				$updated['families'][] = str_replace('urn:lsid:nmbe.ch:spiderfam:', '', $tx);
			}

			if (strpos($tx, 'urn:lsid:nmbe.ch:spidergen') !== false){
				$updated['genera'][] = str_replace('urn:lsid:nmbe.ch:spidergen:', '', $tx);
			}

			if (strpos($tx, 'urn:lsid:nmbe.ch:spidersp') !== false){
				$updated['species'][] = str_replace('urn:lsid:nmbe.ch:spidersp:', '', $tx);
			}
		}

		ksort($updated);
		
		return $updated;
	}

	public function fetchValidTaxon($link){
		$res = $this->client->request('GET', $link . '?apiKey=' . $this->apiKey);
		return json_decode($res->getBody());
	}

	public function nextLink($link){
		$res = $this->client->request('GET', $link);

		$temp = json_decode($res->getBody());

		$taxa = [];

		if(isset($temp->updates)){			
			foreach($temp->updates as $update){
				$taxa[] = $update;
			}
		}

		if(isset($temp->_links->next)){
			$next = $this->nextLink($temp->_links->next);
			$taxa = array_merge($taxa, $next);
		}

		return $taxa;
	}

	public function synchronize($speciesToSync){

		$fetch = $this->fetchSpecies(trim($speciesToSync));

        $species = Species::where(
        	'wsc_lsid', 
        	str_replace('urn:lsid:nmbe.ch:spidersp:', '', $fetch->taxon->lsid)
        )->first();

        if($species){
            
        	if($fetch->taxon->status == 'SYNONYM'){
        		// Fetch the valid species from the WSC API
            	$validSpecies = $this->fetchValidTaxon($fetch->validTaxon->_href);

            	// Match it to species in our DB
            	$validSpeciesExistingInDB = Species::where(
            		'wsc_lsid', 
            		str_replace('urn:lsid:nmbe.ch:spidersp:', '', $validSpecies->taxon->lsid)
            	)->first();

            	if(!$validSpeciesExistingInDB){            		
            		$validSpeciesExistingInDB = new Species;
            		$validSpeciesExistingInDB->name = $validSpecies->taxon->species;
            		$validSpeciesExistingInDB->slug = strtolower($validSpecies->taxon->species);

            		$genus = Genus::where(
            			'wsc_lsid', 
            			str_replace('urn:lsid:nmbe.ch:spidergen:', '', $validSpecies->taxon->genusObject->genLsid)
            		)->first();

            		if(!$genus){
            			$family = Family::where(
            				'wsc_lsid', 
            				str_replace( 'urn:lsid:nmbe.ch:spiderfam:', '', $validSpecies->taxon->familyObject->famLsid)
            			)->first();

            			if(!$family){
		                    $family = Family::create([
		                        'name' => $validSpecies->taxon->familyObject->family,
		                        'slug' => strtolower($validSpecies->taxon->familyObject->family),
		                        'order_id' => 2,
		                        'author' => $validSpeciesvalidSpecies->taxon->familyObject->author,
		                        'wsc_lsid' => str_replace('urn:lsid:nmbe.ch:spiderfam:', '', $validSpeciesvalidSpecies->taxon->familyObject->famLsid),
		                    ]);
		                }

		                $genus = Genus::create([
		                    'name' => $validSpecies->taxon->genusObject->genus,
		                    'author' => $validSpecies->taxon->genusObject->author,
		                    'family_id' => $family->id,
		                    'slug' => strtolower($validSpecies->taxon->genusObject->genus ),
		                    'wsc_lsid' => str_replace('urn:lsid:nmbe.ch:spidergen:', '', $validSpecies->taxon->genusObject->genLsid)
		                ]);
            		}

	            	$validSpeciesExistingInDB->author = $validSpecies->taxon->author;
            		$validSpeciesExistingInDB->wsc_lsid = str_replace('urn:lsid:nmbe.ch:spidersp:', '', $validSpecies->taxon->lsid);           		
            	}

            	$validSpeciesExistingInDB->genus_id = $genus->id;
	            $validSpeciesExistingInDB->gdist_wsc = $validSpecies->taxon->distribution;
	            
	            
	            if($validSpeciesExistingInDB->save()){
        			DailyUpdate::create(['species_id' => $validSpeciesExistingInDB->id]);
	            }

            	$records = Record::where('species_id', $species->id)->get();
            	
            	if(!$records->isEmpty()){
            		foreach ($records as $record) {
            			$record->species_id = $validSpeciesExistingInDB->id;
            			$record->save();
            		}
            	}

            	$species->delete();

            	return 'The synonimy was handled successfully';
        	}

            $species->name = $fetch->taxon->species;

            $genus = Genus::where('wsc_lsid', str_replace('urn:lsid:nmbe.ch:spidergen:', '', $fetch->taxon->genusObject->genLsid))->first();

            if(!$genus){

                $family = Family::where('wsc_lsid', str_replace( 'urn:lsid:nmbe.ch:spiderfam:', '', $fetch->taxon->familyObject->famLsid))->first();

                if(!$family){
                    $family = Family::create([
                        'name' => $fetch->taxon->familyObject->family,
                        'slug' => strtolower($fetch->taxon->familyObject->family),
                        'order_id' => 2,
                        'author' => $fetch->taxon->familyObject->author,
                        'wsc_lsid' => str_replace('urn:lsid:nmbe.ch:spiderfam:', '', $fetch->taxon->familyObject->famLsid),
                    ]);
                }

                $genus = Genus::create([
                    'name' => $fetch->taxon->genusObject->genus,
                    'author' => $fetch->taxon->genusObject->author,
                    'family_id' => $family->id,
                    'slug' => strtolower($fetch->taxon->genusObject->genus ),
                    'wsc_lsid' => str_replace('urn:lsid:nmbe.ch:spidergen:', '', $fetch->taxon->genusObject->genLsid)
                ]);
            }

            $species->genus_id = $genus->id;
            $species->author = $fetch->taxon->author;
            $species->wsc_lsid = str_replace('urn:lsid:nmbe.ch:spidersp:', '', $fetch->taxon->lsid);
            $species->gdist_wsc = $fetch->taxon->distribution;

            if($species->save()){
            	DailyUpdate::create(['species_id' => $species->id]);                            
                $message = $species->genus->name . ' ' . $species->name . ' synced successfully';
            }else{
            	$message = 'An error occupied while trying to update the species ' .  $species->genus->name . ' ' . $species->name;                
            }            
        }else{
        	$message = 'Irrelevant species ' . $speciesToSync;
        	Storage::append(
        		'synchronized_irrelevant.txt', 
        		Carbon::now()->format('d.m.Y') . '-' . $speciesToSync
        	);
        }

        return $message;
	}
	
}
