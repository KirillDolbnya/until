<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;

class AuthController extends Controller
{

    public function __construct(
        private readonly AuthService  $registerService,
//        private readonly LoginService  $loginService;
    )
    {
    }

    public function register(RegisterFormRequest $request)
    {

        $result = $this->registerService->register(
            $request->input('name'),
            $request->input('lastName'),
            $request->input('age'),
            $request->input('phone'),
            $request->input('dateOfBirth'),
            $request->input('email'),
            $request->input('password'),
        );

        if ($result->errors){
            return response()->json([
                'message' => $result->message,
                'errors' => $result->errors,
                'code' => $result->code
            ]);
        }

        return new AuthResource($result->data);
    }

    public function login(Request $request){

    }
}
