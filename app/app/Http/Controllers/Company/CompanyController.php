<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Company\Get\Dto\GetCompanyDto;
use Illuminate\Auth\Access\AuthorizationException;
use App\Services\Company\Delete\Dto\DeleteCompanyDto;
use App\Services\Company\Create\Dto\CreateCompanyDto;
use App\Services\Company\Update\Dto\UpdateCompanyDto;
use App\Services\Company\Get\Actions\GetCompanyAction;
use App\Services\Company\Delete\Actions\DeleteCompanyAction;
use App\Services\Company\Update\Actions\UpdateCompanyAction;
use App\Services\Company\Create\Actions\CreateCompanyAction;
use App\Http\Middleware\Requests\CompanyRequests\GetCompanyRequest;
use App\Http\Middleware\Requests\CompanyRequests\DeleteCompanyRequest;
use App\Http\Middleware\Requests\CompanyRequests\UpdateCompanyRequest;
use App\Http\Middleware\Requests\CompanyRequests\CreateCompanyRequest;

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
