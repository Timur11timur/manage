<?php

namespace App\Inspections;

use Exception;

class InvalidKeywords
{
    private $keyword = [
        'yahoo customer support'
    ];

    public function detect($body)
    {
        foreach ($this->keyword as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception('Your reply contains spam.');
            }
        }
    }
}
