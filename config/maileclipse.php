<?php

return [

	/*
    |--------------------------------------------------------------------------
    | MailEclipse Path
    |--------------------------------------------------------------------------
    |
    | Neque porro quisquam est qui dolorem ipsum quia 
    | dolor sit amet, consectetur, adipisci velit...
    |
    */

	'path' => 'maileclipse',

	/*
    |--------------------------------------------------------------------------
    | Laravel Mail Directory
    |--------------------------------------------------------------------------
    |
    | Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, 
    | consectetur, adipisci velit...
    |
    */

    'mail_dir' => app_path('Mail/'),

    /*
    |--------------------------------------------------------------------------
    | Laravel Mail Directory
    |--------------------------------------------------------------------------
    |
    | Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, 
    | consectetur, adipisci velit...
    |
    */

    'allowed_environments' => ['local', 'staging', 'testing'],

    /*
    |--------------------------------------------------------------------------
    | MailEclipse Route Middleware
    |--------------------------------------------------------------------------
    |
    | Neque porro quisquam est qui dolorem ipsum quia dolor sit amet,
    | consectetur, adipisci velit...
    |
    */
   
    'middleware' => [],

    /*
    |--------------------------------------------------------------------------
    | MailEclipse Route Middleware
    |--------------------------------------------------------------------------
    |
    | Neque porro quisquam est qui dolorem ipsum quia dolor sit amet,
    | consectetur, adipisci velit...
    |
    */
   
   'skeletons' => [

        'html' => [

            'airmail' => [
                'confirm', 
                'invite', 
                'invoice', 
                'ping', 
                'progress', 
                'reignite', 
                'survey', 
                'upsell', 
                'welcome',
            ],

            'cerberus' => [
                'fluid', 
                'hybrid', 
                'responsive',
            ],

            'cleave' => [
                'confirm', 
                'invite', 
                'invoice', 
                'ping', 
                'progress', 
                'reignite', 
                'survey', 
                'upsell', 
                'welcome',
            ],

            'go' => [
                'confirm', 
                'invite', 
                'invoice', 
                'ping', 
                'progress', 
                'reignite', 
                'survey', 
                'upsell', 
                'welcome',
            ],

            'goldstar' => [
                'birthday', 
                'confirm', 
                'invite', 
                'invoice', 
                'progress', 
                'reignite', 
                'survey', 
                'update', 
                'welcome',
            ],

            'mantra' => [
                'activation', 
                'birthday', 
                'coupon', 
                'progress', 
                'rating', 
                'receipt', 
                'shipped', 
                'update', 
                'welcome',
            ],

            'meow' => [
                'confirmation', 
                'coupon', 
                'digest-left', 
                'digest-right', 
                'progress', 
                'receipt', 
                'survey', 
                'two-column', 
                'welcome'
            ],

            'narrative' => [
                'confirm', 
                'invite', 
                'invoice', 
                'ping', 
                'progress', 
                'reignite', 
                'survey', 
                'upsell', 
                'welcome',
            ],

            'neopolitan' => [
                'confirm',
                'invite',
                'invoice',
                'ping',
                'progress',
                'reignite',
                'survey',
                'upsell',
                'welcome',
            ],

            'oxygen' => [
                'confirm',
                'invite',
                'invoice',
                'ping',
                'progress',
                'reignite',
                'survey',
                'upsell',
                'welcome',
            ],

            'plain' => [
                'plain'
            ],

            'skyline' => [
                'confirm',
                'invite',
                'invoice',
                'ping',
                'progress',
                'reignite',
                'survey',
                'upsell',
                'welcome',
            ],

            'sunday' => [
                'confirm',
                'invite',
                'invoice',
                'ping',
                'progress',
                'reignite',
                'survey',
                'upsell',
                'welcome',
            ],

            'zenflat' => [
                'confirm',
                'invite',
                'invoice',
                'ping',
                'progress',
                'reignite',
                'survey',
                'upsell',
                'welcome',
            ],

        ],

        'markdown' => [
            'postmark' => [
                'blank',
                'comment-notification',
                'invoice',
                'receipt',
                'reset-password',
                'reset-password-help',
                'trial-expired',
                'trial-expiring',
                'user-invitation',
                'welcome',
            ],
            'plain' => [
                'full-width',
                'fixed-width',
            ]
        ]
   ]

];