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
        $this->info($wsc->synchronize($this->argument('wsc_lsid')));
    }
}
