<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Services\Product\Get\Dto\GetProductDto;
use App\Services\Product\Delete\Dto\DeleteProductDto;
use App\Services\Product\Update\Dto\UpdateProductDto;

interface ProductRepositoryInterface
{
    public function create(array $data);

    public function update(UpdateProductDto $updateDto);

    public function delete(DeleteProductDto $dto);

    public function getProduct(GetProductDto $dto);
}
