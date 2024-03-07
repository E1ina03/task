<?php

namespace App\Repositories;

use App\Exceptions\Exception;
use App\Models\Company;
use App\Services\Company\Delete\Dto\DeleteCompanyDto;
use App\Services\Company\Get\Dto\GetCompanyDto;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    private function query(): Builder
    {
        return Company::query();
    }

    public function create(array $data): Company
    {
        return $this->query()->create($data);
    }

    public function update(array $data): void
    {
        $companyId = $data['id'];
        $company = $this->query()->find($companyId);

        if ($company === null) {
            throw new \Exception('Company not found');
        }
        if (isset($data['name'])&&(!isset($data['phone'])) ){
            $this->query()->where('id', $companyId)->update([
                'name' => $data['name'],
                'phone' => "",
                ]);
        }
        else{
            $updateData = [
                'name' => $data['name'],
                'phone' => $data['phone'],
            ];
            $this->query()->where('id', $companyId)->update($updateData);
        }


    }

    public function getCompany(GetCompanyDto $dto): ?Company
    {
        $company = $this->query()->find($dto->id);

        if ($company === null) {
            throw new Exception('Product not found');
        }

        return $company;
    }

    public function delete(DeleteCompanyDto $dto): void
    {
        $company = $this->query()->find($dto->id);

        if ($company === null) {
            throw new \Exception('Product not found');
        } else {
            $this->query()->where('id', $dto->id)->delete();
        }
    }

}
