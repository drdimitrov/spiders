<?php

namespace App\Services;

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
	
}
