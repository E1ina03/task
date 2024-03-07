<?php

namespace App\Services\Company\Get\Actions;

use App\Exceptions\Exception;
use App\Interfaces\CompanyRepositoryInterface;
use App\Services\Company\Get\Dto\GetCompanyDto;

class GetCompanyAction
{ public function __construct(
    protected CompanyRepositoryInterface $companyRepository
) {
}

    public function run(GetCompanyDto $dto)
    {
        try {
            return $this->companyRepository->getCompany($dto);

        } catch (Exception $e)  {
            return $e->getMessage();
        }
    }
}
