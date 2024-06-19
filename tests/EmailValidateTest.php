<?php

use Ichinya\MailValidator\Config;
use Ichinya\MailValidator\Validator;
use PHPUnit\Framework\TestCase;

class EmailValidateTest extends TestCase
{
    public function testValidateWithValidEmail()
    {
        $email = 'test@example.com';
        $this->assertTrue(Validator::validate($email));
    }

    public function testWithUnicodeEmail()
    {
        $emails = [
            'я@я.рф',
            "ñandu@dominio.com", // Valid if Unicode is considered
        ];
        foreach ($emails as $email) {
            $this->assertTrue(Validator::validate($email));
        }
    }

    public function testValidateWithInvalidEmail()
    {
        $emails = [
            "test.example@com", // Invalid: no top-level domain
            "test_example.com", // Invalid: missing '@'
            "test@example.com.", // Invalid: dot at the end of the domain
        ];
        foreach ($emails as $email) {
            $this->assertFalse(Validator::validate($email));
        }
    }

    public function testValidateWithException()
    {
        $email = 'invalid_email';

        $config = new Config();
        $config->setUseException();
        Validator::setConfig($config);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Email is not valid');

        Validator::validate($email);
    }
}
