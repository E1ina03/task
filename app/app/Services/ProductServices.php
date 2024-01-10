<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ProductServices
{
    public function getProductById(int $productId): Product
    {
        $product = Product::find($productId);

        if (!$product)
        {
            throw new  InvalidArgumentException('Product not found');
        }

        return $product;
    }

    public function createProduct(array $data, int $userId): Product
    {

        $validator = Validator::make($data,
            [
            'product_name' => 'required|string|max:255',
                ]
        );

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return Product::create(
            [
            'product_name' => $data['product_name'],
            'user_id' => $userId,
        ]
        );
    }

    public function getProductByUserId(int $userId): ?Product
    {
        return Product::where('user_id', $userId)->first();
    }

    public function updateProduct(Product $product, array $data): Product
    {
        $validator = Validator::make($data,
            [
            'product_name' => 'required|string|max:255',
            ]
        );

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $product->update(
            [
            'product_name' => $data['product_name'],
                ]
        );

        return $product;
    }

    public function deleteProduct(Product $product): void
    {
        $product->delete();
    }
}
