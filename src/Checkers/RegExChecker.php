<?php

namespace Ichinya\MailValidator\Checkers;

class RegExChecker
{
    public function __invoke(string $email): bool
    {
        $pattern = '/^[\p{L}0-9._%+-]+@[\p{L}0-9.-]+\.\p{L}{2,}$/u';
        if (preg_match($pattern, $email)) {
            return true;
        }
        return false;
    }
}
