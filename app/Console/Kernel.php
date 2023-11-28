<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$crawl_list = DB::table('crawl')->get();

		foreach ($crawl_list as $c) {
			if ($c->start == 1) {
				$cron = $schedule->call(function () use ($c) {
					$response = Http::get(route("cronjob", $c->unique_name));
					$data = $response->json();
					$text = $data['message'];
					DB::table('crawl_log')->insert([
						'unique_name' => $c->unique_name,
						'time' => now(),
						'text' => $text,
					]);
				});
				if ($c->schedule == 'daily') {
					$cron->daily();
				} else if ($c->schedule == 'every1minute') {
					$cron->everyMinute();
				} else if ($c->schedule == 'every2minutes') {
					$cron->everyTwoMinutes();
				} else if ($c->schedule == 'every5minutes') {
					$cron->everyFiveMinutes();
				} else if ($c->schedule == 'hourly') {
					$cron->hourly()->timezone('Asia/Ho_Chi_Minh');
				} else if ($c->schedule == '2perday') {
					$cron->twiceDaily()->timezone('Asia/Ho_Chi_Minh');
				}
			}
		}
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		$this->load(__DIR__ . '/Commands');

		require base_path('routes/console.php');
	}
}
