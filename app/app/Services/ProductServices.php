<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ProductServices
{

    public function createProduct(array $data, int $userId): Product
    {

        $validator = Validator::make($data, ['product_name' => 'required|string|max:255',]);

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return Product::create(
            [
            'product_name' => $data['product_name'],
            'user_id' => $userId,
        ]);
    }

    public function getProductByUserId(int $userId): ?Product
    {
        $product = Product::where('user_id', $userId)->first();
        if (!$product) {
            throw new InvalidArgumentException('Product not found');
        }
        return $product;
    }

    public function updateProduct(Request $request, int $productId ): Product
    {
        $user = Auth::user();
        $data = $request->toArray();
        $product =Product::find($productId);
        $validator = Validator::make($data, ['product_name' => 'required|string|max:255',]);

        if ($validator->fails())
        {
            throw new InvalidArgumentException("product not defined ");
        }

        if ($user->id == $product->user_id){
            $product->update(['product_name' => $data['product_name']]);
        }
        else{
            throw new InvalidArgumentException("the product does not belong to this user");
        }
        return $product;
    }

    public function deleteProduct(int $userId): string
    {
        $product = Product::query()->where('user_id', $userId)->first();

        if (!$product) {
            throw new InvalidArgumentException('Product not found');
        }
        $product->delete();
        return 'Product deleted successfully';
}}
