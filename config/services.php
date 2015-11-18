<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
	
	'facebook' => [
		'client_id' 	=> '1601781760083601',
		'client_secret' => '75e12b6e6374ec7b13b62107ccff2d22',
		'redirect'	    => (! $app->runningInConsole()) ? url('auth/fb/callback') : '',
	],
	
	'google' => [
		'client_id' 	=> '373605917685-qjr4nip8s5attlinnk4o2qml90oitgop.apps.googleusercontent.com',
		'client_secret' => '5aSPDtRWfy3S0_GXRyirJri3',
		'redirect'		=> (! $app->runningInConsole()) ? url('auth/google/callback') : '',
	],

];
