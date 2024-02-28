<?php
namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Services\Product\Delete\Dto\DeleteDto;
use App\Services\Product\Read\Dto\ReadDto;
use App\Services\Product\Update\Dto\UpdateDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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

    public function update(UpdateDto $updateDto)
    {
        $a = $this->query()->find($updateDto->id);

        if ($a !== null) {
            $user = Auth::user();
            $this->query()->where('user_id', $user->id)->update(
                [
                    'product_name' => $updateDto->product_name
                ]
            );
            return [
                'Product successfully updated'
            ];
        } else {
            return [
                'product not found'
            ];
        }
    }

    public function delete(DeleteDto $dto)
    {
        $product = $this->query()->find($dto->id);

        if ($product !== null) {
            $user = Auth::user();
            $this->query()->where('user_id', $user->id)->delete();
            return [
                'Product successfully deleted'
            ];
        } else {
            return [
                'product not found'
            ];
        }
    }

    public function getProduct(ReadDto $dto)
    {
        $product = $this->query()->find($dto->id);

        if ($product !== null) {
            return [
             'id' => $product['id'],
             'product_name' => $product['product_name'],
             'user_id' => $product['user_id']
            ];
        } else {
            return [
                'product not found'
            ];
        }
    }
}
