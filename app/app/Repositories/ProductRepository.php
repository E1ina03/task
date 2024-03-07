<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\Exception;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Services\Product\Get\Dto\GetProductDto;
use App\Services\Product\Update\Dto\UpdateProductDto;
use App\Services\Product\Delete\Dto\DeleteProductDto;
use App\Interfaces\ProductRepositoryInterface;


class ProductRepository implements ProductRepositoryInterface
{
    private function query(): Builder
    {
        return Product::query();
    }

    public function create(array $data,): Product
    {
        return $this->query()->create($data);
    }

    /**
     * @throws \Exception
     */
    public function update(UpdateProductDto $updateDto): void
    {
        $product = $this->query()->find($updateDto->id);

        if ($product === null)
        {
            throw new \Exception('Product not found');
        }
        else
        {
            $user = Auth::user();
            $this->query()->where('user_id', $user->id)->update(
                [
                    'product_name' => $updateDto->product_name
                ]
            );
        }
    }

    public function delete(DeleteProductDto $dto): void
    {
        $product = $this->query()->find($dto->id);

        if ($product === null) {
            throw new \Exception('Product not found');
        } else {
            $user = Auth::user();
            $this->query()->where('user_id', $user->id)->delete();
        }
    }

    public function getProduct(GetProductDto $dto): ?Product
    {
        $product = $this->query()->find($dto->id);

        if ($product === null) {
            throw new Exception('Product not found');
        }

        return $product;
    }
}
