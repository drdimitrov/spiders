<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WscService;
use App\Species;
use App\Genus;

class SyncWithWsc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wsc {species}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync taxa with WSC';

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
        $fetch = $wsc->fetchSpecies($this->argument('species'));

        $species = Species::where('wsc_lsid', str_replace('urn:lsid:nmbe.ch:spidersp:', '', $fetch->taxon->lsid))->first();

        if($species){
            $species->name = $fetch->taxon->species;

            $genus = Genus::where('wsc_lsid', str_replace('urn:lsid:nmbe.ch:spidergen:', '', $fetch->taxon->genusObject->genLsid))->first();

            if(!$genus){
                $genus = Genus::create([
                    'name' => $fetch->taxon->genusObject->genus, 
                    'author' => $fetch->taxon->genusObject->author, 
                    'family_id' => $fetch->taxon->familyObject->family, 
                    'slug' => strtolower($fetch->taxon->genusObject->genus), 
                    'wsc_lsid' => str_replace('urn:lsid:nmbe.ch:spidergen:', '', $fetch->taxon->genusObject->genLsid)
                ]);
            }

            $species->genus_id = $genus->id;
            $species->author = $fetch->taxon->author;

            if($species->save()){
                $this->info('The species ' . $this->argument('species') . ' was successfully updated');
            }else{
                $this->error('An error occupied while trying to update the species ' . $this->argument('species') );
            }
        }        

    }
}
