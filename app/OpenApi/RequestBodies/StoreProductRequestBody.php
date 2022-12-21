<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\ProductSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class StoreProductRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('UserCreate')
            ->description('User data')
            ->content(
                MediaType::json()->schema(ProductSchema::ref())
            );
    }
}
