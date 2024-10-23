<?php

namespace App\Jobs;

use App\Models\RpcProvider;
use App\Services\RpcProviderMonitorService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;

class MonitorRpcProviderState implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected RpcProvider $rpcProvider;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // $this->rpcProvider = $rpcProvider;
    }

    /**
     * Execute the job.
     */
    public function handle(RpcProviderMonitorService $monitorService)
    {
        Log::info('Monitor RPC Provider State Job START! ...');

        $monitorService->monitor();
    }
}
