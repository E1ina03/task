<?php

namespace App\Services\Product\Read\Actions;

use App\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Read\Dto\ReadDto;

class ReadActions
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function run(ReadDto $dto)
    {
        return $this->productRepository->getProduct($dto);
    }
}
