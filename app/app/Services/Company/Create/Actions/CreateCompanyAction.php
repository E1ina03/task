<?php

namespace App\Services\Company\Create\Actions;

use App\Interfaces\CompanyRepositoryInterface;
use App\Services\Company\Create\Dto\CreateCompanyDto;

class CreateCompanyAction
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ) {
    }

    public function run(CreateCompanyDto $dto)
    {
        return $this->companyRepository->create($dto->toArray());
    }
}
