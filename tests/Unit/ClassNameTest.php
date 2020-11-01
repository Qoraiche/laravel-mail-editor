<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Qoraiche\MailEclipse\MailEclipse;

class ClassNameTest extends TestCase
{
    public function testValidClassName()
    {
        $expectedMap = [
            'mail' => false,
            '1 Number' => false,
            'Number 1' => 'Number1Mail',
            'Welcome #1 User' => 'Welcome1UserMail',
            'Welcome User' => 'WelcomeUserMail',
            'null' => 'NullMail',
            '_null' => 'NullMail',
            '#null' => 'NullMail',
            'CustomerMail' => 'Customermail',
            'Customermail' => 'Customermail',
            'Customer Mail' => 'CustomerMail',
            'customer mail' => 'CustomerMail',
        ];

        foreach ($expectedMap as $input => $expected) {
            $className = MailEclipse::generateClassName($input);
            $this->assertEquals($expected, $className);
        }
    }
}
