<?php

namespace Qoraiche\MailEclipse\Actions;

use Illuminate\Support\Facades\File;

class DeleteMailable
{
    public function handle(array $request)
    {
        $mailableFile = config('maileclipse.mailables_dir').'/'.$request['mailablename'].'.php';

        if (! File::exists($mailableFile)) {
            return [
                'status' => 'error',
                'message' => 'Mailable '.$request['mailablename'].' does not exist',
            ];
        }

        if (File::delete($mailableFile)) {
            return [
                'status' => 'ok',
                'message' => 'Mailable Deleted',
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Unknown error, please check the log file',
        ];
    }
}
