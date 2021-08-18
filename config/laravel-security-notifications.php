<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model Attributes
    |--------------------------------------------------------------------------
    |
    | This option controls what attributes are used to determine changes on a given model.
    | You may change these defaults as required, but they're a perfect start for most Laravel applications.
    |
    */
    'models' => [
        \App\Models\User::class => [
            'email' => 'email',
            'password' => 'password',
            'two_factor_secret' => 'two_factor_secret',
        ]
    ]

];