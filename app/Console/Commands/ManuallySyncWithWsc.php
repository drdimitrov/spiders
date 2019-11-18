<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WscService;

class ManuallySyncWithWsc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog {wsc_lsid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually sync taxa with WSC';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(WscService $wsc)
    {
        $fetch = $wsc->fetchSpecies($this->argument('wsc_lsid'));

        $species = Species::where('wsc_lsid', str_replace('urn:lsid:nmbe.ch:spidersp:', '', $fetch->taxon->lsid))->first();

        if($species){

            // TODO: handle the synonimy first !!!

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
            $species->gdist_wsc = $fetch->taxon->distribution;

            if($species->save()){                              
                //$this->info('The species ' . $this->argument('species') . ' was successfully updated');
            }else{
                $this->error('An error occupied while trying to update the species ' . $this->argument('species') );
            }            
        }

        $this->info($this->argument('wsc_lsid') . ' synced manually');
    }
}
