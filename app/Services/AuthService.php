<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(
    )
    {
    }

    public function register(string $name, string $lastName, int $age, int $phone, string $dateOfBirth, string $email, string $password) :ResultService
    {
        $valid = Validator::make([
            'email' => $email,
            'phone' => $phone,
        ], [
            'phone' => 'unique:users,phone',
            'email' => 'unique:users,email',
        ]);

        if ($valid->fails()){
            return ResultService::error('Ошибка валидации', $valid->errors()->toArray(), true, 422);
        }

        $user = User::create([
            'name' => $name,
            'lastName' => $lastName,
            'age' => $age,
            'phone' => $phone,
            'dateOfBirth' => $dateOfBirth,
            'email' => $email,
            'password' => $password,
        ]);

        $userToken = $user->createToken($user->name)->plainTextToken;

        return ResultService::success('Register success', ['user' => $user , 'token' => $userToken], false, 201);
    }

    public function login(string $email, string $password) :ResultService
    {
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return ResultService::error('Данные для входа не верны',[], true,422);
        }

        $user = Auth::getUser();

        $userToken = $user->createToken($user->name)->plainTextToken;

        return ResultService::success('Вход успешно выполнен', ['user' => $user , 'token' => $userToken], false,201);
    }
}
