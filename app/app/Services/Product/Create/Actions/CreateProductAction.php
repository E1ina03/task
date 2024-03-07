<?php

declare(strict_types=1);

namespace App\Services\Product\Create\Actions;

use App\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Create\Dto\CreateProductDto;

class CreateProductAction
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function run(CreateProductDto $dto)
    {
    return $this->productRepository->create($dto->toArray());
    }
}
