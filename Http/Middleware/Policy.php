<?php

namespace App\Http\Middleware;

use ObiPlus\ObiPlus\Http\Middleware\Policy as BasePolicy;

class Policy extends BasePolicy
{
    public function policies(): array
    {
        return [
            'admin' => [

            ],
            'customer' => [

            ],
            'client' => [

            ],
        ];
    }
}
