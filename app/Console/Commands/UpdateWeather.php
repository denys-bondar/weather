<?php

namespace App\Console\Commands;

use App\Enums\WeatherThresholdEnum;
use App\Jobs\Sms\SendHighPressureNotificationJob;
use App\Models\User;
use App\Notifications\HighPressureAlert;
use App\Notifications\HighUviAlert;
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
        $users = User::all();
        $wt = new Weather();

        foreach ($users as $user) {
            $weather = $wt->getCurrentByCity($user->city);

            if($weather->main->pressure > WeatherThresholdEnum::THRESHOLD_PRESSURE->value) {
                Bus::chain([
                    new SendHighPressureNotificationJob($user)
                ])->dispatch();
                $user->notify(new HighPressureAlert());
            }

            if($weather->main->temp_max > WeatherThresholdEnum::THRESHOLD_UV_INDEX->value) {
                Bus::chain([
                    new SendHighPressureNotificationJob($user)
                ])->dispatch();
                $user->notify(new HighUviAlert());
            }
        }
    }
}
