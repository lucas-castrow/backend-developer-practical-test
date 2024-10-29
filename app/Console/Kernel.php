<?php

namespace App\Console;

use App\Jobs\MonitorRpcProviderStateJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
	protected function schedule(Schedule $schedule)
	{
		Log::info('MonitorRpcProviderState job scheduled');
		$schedule->job(new MonitorRpcProviderStateJob())->everyMinute();
	}

	protected function commands(): void
	{
		$this->load(__DIR__ . '/Commands');

		require base_path('routes/console.php');
	}
}
