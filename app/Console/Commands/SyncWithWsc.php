<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WscService;
use App\Species;
use App\Genus;
use App\Family;
use App\DailyUpdate;
use Carbon\Carbon;

class SyncWithWsc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wsc';

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
        $updatedTaxaInWsc = $wsc->fetchUpdatedTaxa(Carbon::yesterday()->format('Y-m-d'));
 
        if(isset($updatedTaxaInWsc['species'])){
            foreach($updatedTaxaInWsc['species'] as $taxon){
                $this->info($wsc->synchronize($taxon));
            }
        }      
    }

}
