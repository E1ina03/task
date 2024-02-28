<?php

namespace App\Interfaces;

use App\Services\Product\Delete\Dto\DeleteDto;
use App\Services\Product\Read\Dto\ReadDto;
use App\Services\Product\Update\Dto\UpdateDto;

interface ProductRepositoryInterface
{
    public function create(array $data);

    public function update(UpdateDto $updateDto);

    public function delete(DeleteDto $dto);

    public function getProduct(ReadDto $dto);
}
