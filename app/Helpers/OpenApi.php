<?php

namespace App\Helpers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class OpenApi
{
    public static function Response(): Schema
    {
        return Schema::object()
            ->properties(Schema::integer('statusCode')
                ->example(200), Schema::boolean('success')
                ->example(true), Schema::array('data')
                ->example(['foo' => ['Bar']]), Schema::array('error')
                ->example(['foo' => ['Bar']]), Schema::boolean('message')
                ->example('Successful response'));
    }
}