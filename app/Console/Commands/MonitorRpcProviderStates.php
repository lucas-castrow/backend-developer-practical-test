<?php

namespace App\Console\Commands;

use App\Jobs\MonitorRpcProviderState;
use App\Models\RpcProvider;
use Illuminate\Console\Command;

class MonitorRpcProviderStates extends Command
{

    protected $signature = 'app:monitor-rpc-provider-states';

    protected $description = 'Check RPC providers state';

    /**
     * call the MonitorRpcProviderState job for each provider
     */

     public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {   
        while (true) {
            // $providers = RpcProvider::all();
            // foreach ($providers as $provider) {
                MonitorRpcProviderState::dispatch();
            // }
            sleep(60);
        }
    }
}
