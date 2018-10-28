<?php

namespace MetroMarket\MobilePanel\Jobs;

use Davibennun\LaravelPushNotification\Facades\PushNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use MetroMarket\MobilePanel\Jobs\Job;
use MetroMarket\MobilePanel\Models\MobileDevice;

class SendPushNotifications extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $notification;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = PushNotification::Message($this->notification['message'], array(
            'id' => $this->notification['id'],
        ));

        $devices = MobileDevice::active()->get();

        $notifaiable_devices            = array();
        $notifaiable_devices['ios']     = array();
        $notifaiable_devices['android'] = array();

        foreach ($devices as $device):
            $device_os = $device->device_os == 'android' ? 'android' : 'ios';
            array_push($notifaiable_devices[$device_os], PushNotification::Device($device->device_token));

        endforeach;

        $collections = array();
        if (array_key_exists('android', $notifaiable_devices)) {
            $collections[] = PushNotification::app('android')
                ->to(PushNotification::DeviceCollection($notifaiable_devices['android']))
                ->send($message);
        }

        if (array_key_exists('ios', $notifaiable_devices)) {
            foreach ($notifaiable_devices['ios'] as $key => $device):
                $collections[] = PushNotification::app('ios')
                    ->to($device)
                    ->send($message);
            endforeach;
        }

        $responses = array();

        foreach ($collections as $collection):
            foreach ($collection->pushManager as $push):
                $response = $push->getAdapter()->getResponse();
                array_push($responses, $response);
            endforeach;
        endforeach;

        ob_start();
        var_dump($responses);
        $textlog = ob_get_clean();

        Log::debug($textlog);

    }
}
