<?php

namespace Ichinya\MailValidator;

class Validator
{
    private static ?Validator $instance = null;
    private static Config $config;

    private function __construct(Config $config)
    {
        self::$config = $config;
    }

    public static function getInstance(?Config $config = null): Validator
    {
        if (!self::$instance) {
            self::$instance = new Validator($config ?? new Config());
        } elseif ($config) {
            self::$instance->setConfig($config);
        }

        return self::$instance;
    }

    public static function setConfig(Config $config): void
    {
        self::$config = $config;
    }

    public function getConfig(): Config
    {
        return self::$config;
    }

    public static function purify(string $email): string
    {
        $validator = self::getInstance();
        foreach ($validator->getConfig()->getPurifications() as $purification) {
            if (is_callable($purification)) {
                $email = $purification($email);
            } else {
                $email = (new $purification)($email);
            }
        }
        return $email;
    }

    public static function validate(string $email): bool
    {
        $validator = self::getInstance();

        $email = $validator::purify($email);

        foreach ($validator->getConfig()->getCheckers() as $checker) {
            if (!(new $checker)($email)) {
                if (self::$config->isUseException()) {
                    throw self::$config->makeException('Email is not valid');
                }
                return false;
            }
        }
        return true;
    }
}
