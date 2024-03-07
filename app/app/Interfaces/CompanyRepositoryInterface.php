<?php

namespace App\Interfaces;

use App\Models\Company;
use App\Services\Company\Delete\Dto\DeleteCompanyDto;
use App\Services\Company\Get\Dto\GetCompanyDto;

interface CompanyRepositoryInterface
{
    public function create(array $data): Company;

    public function update(array $data): void;

    public function delete(DeleteCompanyDto $dto);
    public function getCompany(GetCompanyDto $dto): ?Company;
}
