<?php

declare(strict_types=1);

namespace App\Services\Product\Get\Actions;

use App\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Get\Dto\GetProductDto;
use App\Exceptions\Exception;

class GetProductActions
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function run(GetProductDto $dto)
    {
        try {
            return $this->productRepository->getProduct($dto);

        } catch (Exception $e)  {
           return $e->getMessage();
        }
    }
}
