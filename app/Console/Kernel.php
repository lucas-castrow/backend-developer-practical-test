<?php

namespace App\Console;

use App\Jobs\MonitorRpcProviderState;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
	protected function schedule(Schedule $schedule)
	{
		// $schedule->command('app:monitor-rpc-provider-states')->everyMinute();
		Log::info('MonitorRpcProviderState job foi agendado');
		$schedule->job(new MonitorRpcProviderState)->everyMinute();
	}

	protected function commands(): void
	{
		$this->load(__DIR__ . '/Commands');

		require base_path('routes/console.php');
	}
}
