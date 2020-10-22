<?php

return [

    /*
    |--------------------------------------------------------------------------
    | MailEclipse Path
    |--------------------------------------------------------------------------
    |
    | This is the URL where you can access mailEclipse
    |
    */

    'path' => 'maileclipse',

    /*
    |--------------------------------------------------------------------------
    | Application Mailables Directory
    |--------------------------------------------------------------------------
    |
    */

    'mailables_dir' => app_path('Mail/'),

    /*
    |--------------------------------------------------------------------------
    | If you want the package to look for the equivalent factory if the
    | dependency is an eloquent model.
    |--------------------------------------------------------------------------
    |
    */

    'factory' => true,

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | If you don't want to use this package in production env
    | at all, you can restrict that using this option
    | rather than by using a middleware.
    |
    */

    'allowed_environments' => ['local', 'staging', 'testing'],

    /*
    |--------------------------------------------------------------------------
    | MailEclipse Route Middleware
    |--------------------------------------------------------------------------
    |
    | The value should be an array of fully qualified
    | class names of the middleware classes.
    |
    */

    'middlewares' => [
        'web',
        //'auth',
    ],

    /*
    |--------------------------------------------------------------------------
    | Test Mail
    |--------------------------------------------------------------------------
    |
    | The email you want to send mailable test previews to it
    |
    */

    'test_mail' => 'your-test@email.com',

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    | List of pre-defined templates used by maileclipse (HTML/Markdown)
    |
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
                'welcome',
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
                'plain',
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
        ],
    ],

];
