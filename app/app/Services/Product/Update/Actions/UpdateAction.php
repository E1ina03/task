<?php

namespace App\Services\Product\Update\Actions;

use App\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Update\Dto\UpdateDto;

class UpdateAction
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function run(UpdateDto $dto)
    {
        return $this->productRepository->update($dto);
    }
}
