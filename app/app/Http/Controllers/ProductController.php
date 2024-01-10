<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Services\ProductServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function __construct(protected ProductServices $productService)
    {
    }

    public function getProductById(int $productId): ProductResource
    {
        try
        {
            $product = $this->productService->getProductById($productId);

            return new ProductResource($product);
        }
        catch (\Exception $e)
        {
            return new ProductResource(response()->json(['message' => $e->getMessage()], 404));
        }
    }

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

        if ($product !== null)
        {
            return new ProductResource($product);
        }
        else
        {
            $error = response()->json(['message' => 'Product not found'], 404);
            return new ProductResource($error);
        }
    }

    public function updateProduct(Request $request): ProductResource
    {
        $user = Auth::user();

        $product = $this->productService->getProductByUserId($user->id);

        if ($product !== null)
        {
            $data = $request->validate(
                [
                'product_name' => 'required|string|max:255',
                ]
            );

            $updatedProduct = $this->productService->updateProduct($product, $data);

            return new ProductResource($updatedProduct);
        }
        else
        {
           $error = response()->json(
               [
                   'message' => 'Product not found or unauthorized'
               ], 404);

           return new ProductResource($error);
        }
    }

    public function deleteProduct(): JsonResponse
    {
        $user = Auth::user();

        $product = $this->productService->getProductByUserId($user->id);

        if ($product !== null)
        {
            $this->productService->deleteProduct($product);
            return response()->json(
                [
                    'message' => 'Product deleted successfully'
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'message' => 'Product not found or unauthorized'
                ], 404);
        }
    }
}
