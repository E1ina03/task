<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class CompanyPolicy
{
    public function create(User $user): bool
    {
        return $user->role_id == 2;
    }

}
