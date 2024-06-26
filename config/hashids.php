<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [
        \App\Models\Order::class => [
            'salt' =>   \App\Models\Order::class.'7623e9b0009feff8e024a689d6ef59ce',
            'length' => 8,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],
        \App\Models\Receipt::class => [
            'salt' =>   \App\Models\Receipt::class.'7623e9b0009feff8e024a689d6ef59ce',
            'length' => 8,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],

//        'main' => [
//            'salt' => 'your-salt-string',
//            'length' => 'your-length-integer',
//            // 'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
//        ],
//
//        'alternative' => [
//            'salt' => 'your-salt-string',
//            'length' => 'your-length-integer',
//            // 'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
//        ],

    ],

];
