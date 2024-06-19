<?php

namespace Ichinya\MailValidator;

use Ichinya\MailValidator\Purifications\Lower;

class Config
{
    protected bool $useException = false;
    protected array $standardPurifications = [
//        Purifications\FilterSanitize::class,
        Purifications\Lower::class,
    ];
    protected array $customPurifications = [];

    protected array $checkers = [
//        Checkers\FilterValidate::class,
        Checkers\RegExChecker::class,
    ];


    public static function makeException($message): \Throwable
    {
        return new \Exception($message);
    }

    public function setUseException()
    {
        $this->useException = true;
    }

    public function isUseException(): bool
    {
        return $this->useException;
    }

    public function addCustomPurification(string|callable $purification): static
    {
        $this->customPurifications[] = $purification;
        return $this;
    }

    public function addChecker(string $checker): static
    {
        $this->checkers[] = $checker;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPurifications(): array
    {
        return $this->standardPurifications + $this->customPurifications;
    }

    public function getCheckers(): array
    {
        return $this->checkers;
    }

}
