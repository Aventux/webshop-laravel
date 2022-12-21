<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use App\OpenApi\Parameters\GetProductParameters;
use App\OpenApi\Responses\ProductResponse;
use Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api');
    }

    /**
     * Product
     *
     * CRUD the Product
     */
    #[OpenApi\Operation]
    #[OpenApi\Parameters(factory: GetProductParameters::class)]
    #[OpenApi\Response(factory: ProductResponse::class)]
    public function index(Request $request)
    {
        return response()->json([
            'Foo' => 'Bar',
        ]);
    }
}
