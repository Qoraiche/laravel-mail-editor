<?php

namespace Qoraiche\MailEclipse\Command;

use Illuminate\Console\Command;

class VendorPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-mail-editor:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all MailEclipse assets from vendor packages';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--provider' => "Qoraiche\MailEclipse\MailEclipseServiceProvider",
        ]);
    }
}
