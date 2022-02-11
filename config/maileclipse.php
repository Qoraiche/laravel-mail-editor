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
    | Display Mailable Subject
    |--------------------------------------------------------------------------
    |
    | Set to true this will display the subject of the Mailable instead of Class Name.
    | When the config setting is false the namespace/class name is shown
    | options: true / false
    |
    */
    'display_as_subject' => true,

    /*
    |--------------------------------------------------------------------------
    | Relationship loading.
    |--------------------------------------------------------------------------
    |
    | This configures how deep the package will search an load relations.
    | If you set this to 0, relations will not be loaded.
    |
    | relation_depth: off = 0, min = 1, max = 5
    | model: this is the model to use to exclude methods when searching.
    |
    | N.B. This does not configure how many many relationship types are loaded.
    */
    'relations' => [
        'relation_depth' => env('MAILECLIPSE_RELATION_DEPTH', 2),

        'model' => \Illuminate\Foundation\Auth\User::class,
    ],

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

    'allowed_environments' => ['local', 'development', 'staging', 'testing'],

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
    | Blade Methods
    |--------------------------------------------------------------------------
    |
    | The list of blade methods that need to be replaced when moving between the
    | editor and the blade file.
    |
    */
    'components' => [
        'extends',
        'yield',
        'parent',
        'component',
        'endcomponent',
        'section',
        'endsection',
        'slot',
        'endslot',
    ],

    /*
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
