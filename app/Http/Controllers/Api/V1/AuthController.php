<?php

namespace App\Http\Controllers\Api\V1;

use App\DTO\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;

class AuthController extends Controller
{

    public function __construct(
        private readonly RegisterService  $registerService,
//        private readonly LoginService  $loginService;
    )
    {
    }

    public function register(RegisterFormRequest $request)
    {
        $result = $this->registerService->register(RegisterDTO::data($request->all()));

        return new AuthResource(['user' => $result['user'], 'token' => $result['token']]);
    }

    public function login(Request $request){

    }
}
