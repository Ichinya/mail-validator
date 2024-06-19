<?php

namespace Ichinya\MailValidator\Purifications;

class Lower
{
    public function __invoke($value): string
    {
        return mb_strtolower($value);
    }
}
