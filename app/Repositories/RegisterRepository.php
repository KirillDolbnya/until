<?php

namespace App\Repositories;

use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Query\Builder;

class RegisterRepository implements RegisterRepositoryInterface
{

    public function create(array $data): User
    {
        return User::create($data);
    }
}
