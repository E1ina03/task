<?php

namespace App\Services\Product\Create\Actions;

use App\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Create\Dto\CreateDto;

class CreateAction
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function run(CreateDto $dto)
    {
    return $this->productRepository->create($dto->toArray());
    }
}
