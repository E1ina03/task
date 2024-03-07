<?php

namespace App\Services\Company\Delete\Actions;

use App\Exceptions\Exception;
use App\Interfaces\CompanyRepositoryInterface;
use App\Services\Company\Delete\Dto\DeleteCompanyDto;

class DeleteCompanyAction
{

    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ) {
    }

    public function run(DeleteCompanyDto $dto)
    {
        try {
            return $this->companyRepository->delete($dto);
        }
        catch (Exception $e)  {
            return $e->getMessage();
        }
    }
}
