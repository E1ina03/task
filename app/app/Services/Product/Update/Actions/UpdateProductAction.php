<?php

declare(strict_types=1);

namespace App\Services\Product\Update\Actions;

use App\Exceptions\Exception;
use App\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Update\Dto\UpdateProductDto;

class UpdateProductAction
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

    public function run(UpdateProductDto $dto)
    {
        try {
            return $this->productRepository->update($dto);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
