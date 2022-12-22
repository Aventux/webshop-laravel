<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\OpenApi\Parameters\GetProductParameters;
use App\OpenApi\Responses\ProductResponse;
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
    public function index(int $id): \Illuminate\Http\JsonResponse
    {

        $api = Api::Service();
        $api->execute(function () use ($id) {
            /** @var Product $product */
            $product = Product::findOrFail($id);

            return [
                'responseData' => [
                    'id'            => $product->id, 'description' => $product->description,
                    'product_stock' => $product->product_stock,
                ],
            ];
        })
            ->error(function ($e) use ($id) {
                return [
                    'statusCode' => 404, 'message' => 'Product ID '.$id.' not found',
                ];
                //            /** @var Product $product */
                //            $product = Product::findOrFail($id);
            });

        return $api->render();
    }
}
