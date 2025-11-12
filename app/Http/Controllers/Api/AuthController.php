<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;

class AuthController extends Controller
{

    public function __construct(
        private readonly AuthService $authService,
    )
    {
    }

    public function register(RegisterFormRequest $request)
    {

        $result = $this->authService->register(
            $request->input('name'),
            $request->input('lastName'),
            $request->input('age'),
            $request->input('phone'),
            $request->input('dateOfBirth'),
            $request->input('email'),
            $request->input('password'),
        );

        if ($result->isError){
            return response()->json([
                'message' => $result->message,
                'errors' => $result->errors,
                'code' => $result->code
            ]);
        }

        return new AuthResource($result->data);
    }

    public function login(LoginFormRequest $request)
    {
        $result = $this->authService->login(
          $request->input('email'),
          $request->input('password')
        );

        if($result->isError){
            return response()->json([
                'message' => $result->message,
                'errors' => $result->errors,
                'code' => $result->code
            ]);
        }

        return new AuthResource($result->data);
    }
}
