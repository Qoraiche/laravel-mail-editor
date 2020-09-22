<?php

namespace Qoraiche\MailEclipse\Facades;

use Illuminate\Support\Facades\Facade;

class MailEclipse extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'maileclipse';
    }
}
