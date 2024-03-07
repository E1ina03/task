<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ProductServices
{

//    public function __construct(protected ProductRepository $productRepository)
//    {
//    }
//
//    public function createProduct(array $data, int $userId): Product
//    {
//        $validator = Validator::make($data, ['product_name' => 'required|string|max:255']);
//
//        if ($validator->fails()) {
//            throw new InvalidArgumentException($validator->errors()->first());
//        }
//
//        return $this->productRepository->create($data, $userId);
//    }

    public function getProductByUserId(int $userId): ?Product
    {
        $product = $this->productRepository->getByUserId($userId);

        if (!$product)
        {
            throw new InvalidArgumentException('Product not found');
        }
        return $product;
    }

    public function updateProduct(Request $request, int $productId): Product
    {
        $user = Auth::user();
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'product_name' => 'required|string|max:255',
        ]);

        if ($validator->fails())
        {
            throw new InvalidArgumentException("Product not defined");
        }
        $product = $this->productRepository->findProduct($productId);

        if (!$product)
        {
            throw new InvalidArgumentException('Product not found');
        }
        if ($user->id != $product->user_id)
        {
            throw new InvalidArgumentException("The product does not belong to this user");
        }

        $updateData = ['product_name' => $data['product_name']];

        return $this->productRepository->update($updateData);
    }

    public function deleteProduct(int $userId): string
    {
        $product =$this->productRepository->findProductByUserId($userId);

        if (!$product) {
            throw new InvalidArgumentException('Product not found');
        }
        $this->productRepository->delete($product);
        return 'Product deleted successfully';
}}
