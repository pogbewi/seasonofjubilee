<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'show_dev_tips' => true,

    'storage' => [
        'disk' => 'public',
    ],

    'attachment' =>[
        'max_size' => 1000000,
        'allowed'=>'.jpg,.png,.mp4,.gif','.mp3','.pdf','.acc',

    ],


    'ffmpeg_variables'=>[
        'ffmpeg' => env('FFMPEG_PATH'),
        'ffprobe' => env('FFPROBE_PATH'),
    ],
];