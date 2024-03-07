<?php

namespace App\Services\Company\Update\Actions;


use App\Exceptions\Exception;
use App\Interfaces\CompanyRepositoryInterface;
use App\Services\Company\Update\Dto\UpdateCompanyDto;

class UpdateCompanyAction
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ) {
    }

    public function run(UpdateCompanyDto $dto)
    {
        try {
            $this->companyRepository->update($dto->toArray());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
