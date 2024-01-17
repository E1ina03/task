<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Services\ProductServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function __construct(protected ProductServices $productService) {}


    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray();

        $user = Auth::user();

        $product = $this->productService->createProduct($data, $user->id);

        return response()->json($product, 201);
    }

    public function getProductByUserId(): ProductResource
    {
        $user = Auth::user();

        $product = $this->productService->getProductByUserId($user->id);

        return new ProductResource($product);

    }

    public function updateProduct(Request $request,int $productId ): ProductResource
    {
        $updatedProduct = $this->productService->updateProduct($request,$productId);

        return new ProductResource($updatedProduct);
    }

    public function deleteProduct(): JsonResponse
    {
        $user = Auth::user();

        $product = $this->productService->getProductByUserId($user->id);

        if ($product !== null)
        {
            $this->productService->deleteProduct($product);
            return response()->json(['message' => 'Product deleted successfully']);
        }
        else {
            return response()->json(['message' => 'Product not found or unauthorized'], 404);
        }
    }
}
