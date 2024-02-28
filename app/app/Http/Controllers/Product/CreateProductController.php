<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Requests\ProductRequests\CreateRequests;
use App\Http\Resources\Product\CreateResource;
use App\Services\Product\Create\Actions\CreateAction;
use App\Services\Product\Create\Dto\CreateDto;
use Illuminate\Support\Facades\Auth;

class CreateProductController extends Controller
{
 public function create(
     CreateRequests $requests,
     CreateAction $createAction,
 ): CreateResource
 {

     $dto = CreateDto::fromRequest($requests);

     $product = $createAction->run($dto);

     return new CreateResource($product);
 }
}
