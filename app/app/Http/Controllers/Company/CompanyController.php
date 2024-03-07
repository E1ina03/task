<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequests\CreateCompanyRequest;
use App\Http\Requests\CompanyRequests\DeleteCompanyRequest;
use App\Http\Requests\CompanyRequests\GetCompanyRequest;
use App\Http\Requests\CompanyRequests\UpdateCompanyRequest;
use App\Services\Company\Create\Actions\CreateCompanyAction;
use App\Services\Company\Create\Dto\CreateCompanyDto;
use App\Services\Company\Delete\Actions\DeleteCompanyAction;
use App\Services\Company\Delete\Dto\DeleteCompanyDto;
use App\Services\Company\Get\Actions\GetCompanyAction;
use App\Services\Company\Get\Dto\GetCompanyDto;
use App\Services\Company\Update\Actions\UpdateCompanyAction;
use App\Services\Company\Update\Dto\UpdateCompanyDto;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function create(
        CreateCompanyRequest $request,
        CreateCompanyAction $createCompanyAction
    ): JsonResponse {
        $dto = CreateCompanyDto::fromRequest($request);

        $company = $createCompanyAction->run($dto);

        return new JsonResponse($company);
    }

    public function update(
        UpdateCompanyRequest $request,
        UpdateCompanyAction $updateCompanyAction
    ): JsonResponse {
        $dto = UpdateCompanyDto::fromRequest($request);

        $company = $updateCompanyAction->run($dto);

        return new JsonResponse($company);
    }

    public function getCompanyById(
        GetCompanyRequest $request,
        GetCompanyAction $getCompanyAction
    ): JsonResponse {
        $dto = GetCompanyDto::fromRequest($request);

        $company = $getCompanyAction->run($dto);

        return new JsonResponse($company);
    }

    public function delete(
        DeleteCompanyRequest $request,
        DeleteCompanyAction $deleteCompanyAction
    ): JsonResponse {
        $dto = DeleteCompanyDto::fromRequest($request);

        $company = $deleteCompanyAction->run($dto);

        return new JsonResponse($company);
    }
}
