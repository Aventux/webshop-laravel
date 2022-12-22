<?php

namespace App\Helpers;

class Api
{
    public static function Service(): \App\Services\Api
    {
        return new \App\Services\Api();
    }
}