<?php

namespace Ichinya\MailValidator\Checkers;

class FilterValidate
{
    /**
     * @deprecated
     * @param $value
     * @return bool
     */
    public function __invoke($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
