<?php

namespace App\Inspections;

class Spam
{
    private $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class,
    ];

    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }

        return false;
    }
}
