<?php

namespace App\Services;

final class ResultService
{
    public function __construct(
        public readonly string $message,
        public readonly array $data = [],
        public readonly array $errors = [],
        public readonly int $code,
    )
    {
    }

    public static function success(string $message, array $data = [], int $code = 200) :self
    {
        return new self(
            message: $message,
            data: $data,
            errors: $errors = [],
            code: $code,
        );
    }

    public static function error(string $message, array $errors = [], int $code = 400) :self
    {
        return new self(
            message: $message,
            data: $data = [],
            errors: $errors,
            code: $code,
        );
    }
}
