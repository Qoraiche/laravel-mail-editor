<?php

namespace Qoraiche\MailEclipse\Actions;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Qoraiche\MailEclipse\Facades\MailEclipse;

class CreateMailable
{
    /**
     * Handle Creating a new mailable.
     *
     * @param  array  $parameters
     * @return string[]
     */
    public function handle(array $parameters)
    {
        $parameters = $this->commandParameters($parameters);

        if (strtolower($parameters['name']) === 'mailable') {
            return [
                'status' => 'error',
                'message' => 'You cannot use this name',
            ];
        }

        if (! MailEclipse::getMailable('name', $parameters['name'])->isEmpty() && ! isset($parameters['force'])) {
            return [
                'status' => 'error',
                'message' => 'This mailable name already exists. names should be unique! to override it, enable "force" option.',
            ];
        }

        $exitCode = Artisan::call('make:mail', $parameters);

        if ($exitCode > -1) {
            return [
                'status' => 'ok',
                'message' => 'Mailable Created<br> <small>Reloading...<small>',
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Unable to create the Mailable, please double check the log file',
        ];
    }

    /**
     * Get the parameters for the artisan command.
     *
     * @param  array  $parameters
     * @return array
     */
    protected function commandParameters(array $parameters)
    {
        $parameters['name'] = ucwords(Str::camel(preg_replace('/\s+/', '_', $parameters['name'])));

        if (isset($parameters['force'])) {
            $parameters['force'] = true;
        }

        return $parameters;
    }
}
