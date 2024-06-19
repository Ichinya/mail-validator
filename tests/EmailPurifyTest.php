<?php

use Ichinya\MailValidator\Validator;
use PHPUnit\Framework\TestCase;

class EmailPurifyTest extends TestCase
{


    public function testPurifyLower()
    {
        // Arrange
        $email = 'Test@eXample.com';

        // Act
        $result = Validator::purify($email);

        // Assert
        $this->assertEquals(mb_strtolower($email), $result);
    }

}
