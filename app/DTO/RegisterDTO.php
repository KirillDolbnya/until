<?php

namespace App\DTO;

use App\DTO\RegisterDTOInterface;

class RegisterDTO implements RegisterDTOInterface
{

    public function __construct(
        private ?string $name,
        private ?string $lastName,
        private ?int $age,
        private ?int $phone,
        private ?string $dateOfBirth,
        private ?string $email,
        private ?string $password,
    )
    {
    }

    public static function data(array $data) :self
    {
        return new self(
            name: $data['name'],
            lastName: $data['lastName'],
            age: $data['age'],
            phone: $data['phone'],
            dateOfBirth: $data['dateOfBirth'],
            email: $data['email'],
            password: $data['password'],
        );
    }

    public function __get(string $property)
    {
        return $this->$property ?? null;
    }
}
