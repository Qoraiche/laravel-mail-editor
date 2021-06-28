<?php

namespace Qoraiche\MailEclipse\Tests\Feature;

use Illuminate\Support\Facades\Config;
use Qoraiche\MailEclipse\Tests\TestCase;

class MailablesControllerTest extends TestCase
{
    public function test_page_loads_in_allowed_environments()
    {
        Config::set('maileclipse.allowed_environments', ['staging', 'testing', 'local']);

        $this->get('maileclipse/mailables')
            ->assertOk();
    }

    public function test_returns_error_when_viewing_in_prohibited_env_by_default()
    {
        Config::set('maileclipse.allowed_environments', ['staging', 'local']);

        $this->get('maileclipse/mailables')
            ->assertStatus(403);
    }
}
