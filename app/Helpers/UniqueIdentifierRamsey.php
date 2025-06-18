<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;

class UniqueIdentifierRamsey implements UniqueIdentifierInterface
{
    public function generate()
    {
        return Str::uuid7();
    }
}
