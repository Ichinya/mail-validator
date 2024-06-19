<?php

namespace Ichinya\MailValidator\Purifications;

class FilterSanitize
{

    /**
     * @deprecated
     * @param $value
     * @return string
     */
    public function __invoke($value): string
    {
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }
}
