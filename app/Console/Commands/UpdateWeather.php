<?php

namespace App\Console\Commands;

use App\Jobs\SendHighPressureNotificationJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use RakibDevs\Weather\Weather;

class UpdateWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update weather data for users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $thresholdPressure = 1000;
        $thresholdUvIndex = 6;

        $users = User::all();
        $wt = new Weather();

        foreach ($users as $user) {
            $weather = $wt->getCurrentByCity($user->city);

            if($weather->main->pressure > $thresholdPressure) {
                Bus::chain([
                    new SendHighPressureNotificationJob($user)
                ])->dispatch();
            }

            if($weather->main->uvi > $thresholdUvIndex) {
                Bus::chain([
                    new SendHighPressureNotificationJob($user)
                ])->dispatch();
            }
        }
    }
}
