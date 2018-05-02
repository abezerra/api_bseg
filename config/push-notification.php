<?php

return array(

    'appNameIOS'     => array(
        'environment' =>'development',
        'certificate' => public_path('certificates/certificado.pem'),
        'passPhrase'  =>'Spartan13#',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production',
        'apiKey'      => env('FCM_SERVER_KEY'),
        'service'     =>'gcm'
    )

);