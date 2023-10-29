<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\NotificationService;
use Exception;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendHighPressureNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $name;
    private User $user;
    public int $tries = 10;
    public int $maxExceptions = 1;
    public int $runAfterTime = 0;
    public int $runEveryTime = 60;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            (new NotificationService())->sendSms($this->user);

            Log::channel('job')->notice('Job create sms send - done: ' . $this->user->phone);
        } catch(ConnectException $e) {
            if ($this->attempts() < $this->tries) {
                $this->release($this->runEveryTime);
            } else {
                Log::channel('sms')->error('Job create send sms twilio - failed: ' . $this->user->phone, [
                    'error' => $e->getMessage()
                ]);

                throw $e;
            }
        } catch(Exception $e) {
            Log::channel('sms')->error('Job create send sms twilio - failed: ' . $this->user->phone, [
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }
}
