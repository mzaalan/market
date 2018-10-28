<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Davibennun\LaravelPushNotification\Facades\PushNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       /* $devices = PushNotification::DeviceCollection(array(
            //PushNotification::Device('cek_2-c96K0:APA91bGay6GFSA_SXARagdCzxoDkzlTldrR3UVL_PnRhU3uaOr_iwaUm7GNqIHCNCFTRgnuzDsBXK99LGQcOLrk_N9KfpnrF6bTancHB8rIK1Y993D2miJNx2o41DiVX03nxjzouG4Pt'),
            PushNotification::Device('crLh7QOYM2I:APA91bGtjfRRTK7CJlWouSn7FCuS-LtVEPEWa2fP7bZEry5zZfC6qpyKc5xt9c20uctixZjyaS3kBkxfC0TJW9au8s0p34_tWED7DoV7wBFsoR5hgt5C3LzuhuiI-cPlbAb3mT6aeZVU'),
            //PushNotification::Device('dMJmoPxZ6Zs:APA91bGXG2ZgTWuzhu-vmnlvu2Y71A6_vZkev30bXmSy3TlmJiibV2ckwwVUlgACVwWh5ZlWXdmkt9vNDC6EbXsbXTAjOWg54NAh_AOPaViZ9GZZqQVa7VmZAAiJr030x9fCKZNyPKWb'),
        ));

        $message = PushNotification::Message('مترو ماركت يرحب بكم', array(
            'id' => 1,
        ));

        $collection = PushNotification::app('android')
            ->to($devices)
            ->send($message);*/
        //return;
        $devices[] = PushNotification::Device('3e96e9ee745db7f33691b25b992d85687f721f58ce270856b09ca54ff35a23c5');  
        $message = PushNotification::Message('مترو ماركت يرحب بكم 6', array(
            'id' => 1,
        ));    
        $collection =    PushNotification::app('ios')
                    ->to(PushNotification::DeviceCollection($devices))
                    ->send($message);    
        $responses = array();

        // get response for each device push
        foreach ($collection->pushManager as $push) {
            $response = $push->getAdapter()->getResponse();
            array_push($responses, $response);
        }

        dd($responses);

        // access to adapter for advanced settings
        /*$push = PushNotification::app('android');
        $push->adapter->setAdapterParameters(['sslverifypeer' => false]);*/

        //return view('home');
    }
}
