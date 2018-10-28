<?php

return array(

    'ios'     => array(
        'environment' => 'production',
        'certificate' => base_path() . '/MetroNewPush.pem',
        'passPhrase'  => '2916',
        'service'     => 'apns',
    ),
    'android' => array(
        'environment' => 'production',
        'apiKey'      => 'AIzaSyC1-UIAOegTLZLZJJbppN8wqJ1kRjmUYJg',
        'service'     => 'gcm',
    ),

);
