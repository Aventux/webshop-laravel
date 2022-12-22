<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Product;
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
    public function index(int $id)
    {
        $statusCode = 200;
        $success = true;
        $responseResult = [
            'id' => 0, 'title' => '', 'description' => '', 'product_stock' => 0, 'message' => '',
        ];

        try {


            $responseResult ['id'] = $product->id;
            $responseResult ['title'] = $product->title;
            $responseResult ['description'] = $product->description;
            $responseResult ['product_stock'] = $product->product_stock;

        } catch (\Throwable $e) {
            $success = false;
            $statusCode = 404;
            $responseResult = [
                'error' => $e->getMessage(),
            ];
        }

        $api = Api::Service();
        $api->execute(function () {
            //            /** @var Product $product */
            //            $product = Product::findOrFail($id);
        });


        return response()->json([
            'success' => $success, 'data' => $responseResult,
        ], $statusCode);
    }
}
