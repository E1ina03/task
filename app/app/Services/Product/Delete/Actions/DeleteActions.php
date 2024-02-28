<?php

namespace App\Services\Product\Delete\Actions;

use App\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Delete\Dto\DeleteDto;

class DeleteActions
{
    public function __construct(
    protected ProductRepositoryInterface $productRepository
) {
}

    public function run(DeleteDto $dto)
    {
        return $this->productRepository->delete($dto);
    }
}
