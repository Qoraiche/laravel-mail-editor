<?php

namespace qoraiche\mailEclipse\Facades;

use Illuminate\Support\Facades\Facade;

class mailEclipse extends Facade
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
