<?php

namespace App\Services;

use App\DTO\RegisterDTOInterface;
use App\Repositories\RegisterRepositoryInterface;

class RegisterService
{
    public function __construct(
        private readonly RegisterRepositoryInterface $registerRepository,
    )
    {
    }

    public function register(RegisterDTOInterface $registerDTOInterface){

        $user = $this->registerRepository->create([
            'name' => $registerDTOInterface->name,
            'lastName' => $registerDTOInterface->lastName,
            'age' => $registerDTOInterface->age,
            'phone' => $registerDTOInterface->phone,
            'dateOfBirth' => $registerDTOInterface->dateOfBirth,
            'email' => $registerDTOInterface->email,
            'password' => $registerDTOInterface->password,
        ]);

        $userToken = $user->createToken($user->name)->plainTextToken;

        return [
            'user' => $user,
            'token' => $userToken,
        ];
    }
}
