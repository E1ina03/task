<?php

declare(strict_types=1);

namespace App\Services\Product\Delete\Actions;

use App\Exceptions\Exception;
use App\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Delete\Dto\DeleteProductDto;

class DeleteProductActions
{
    public function __construct(
    protected ProductRepositoryInterface $productRepository
) {
}

    public function run(DeleteProductDto $dto)
    {
        try {
            return $this->productRepository->delete($dto);
        }
        catch (Exception $e)  {
            return $e->getMessage();
        }
    }
}
