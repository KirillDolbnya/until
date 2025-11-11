<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string",
            "lastName" => "required|string",
            "age" => "required|integer|between:1,100",
            "phone" => "required|integer",
            "dateOfBirth" => "required|date",
            "email" => "required|email",
            "password" => "required|string|min:6",
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'lastName.required' => 'Фамилия обязательна для заполнения',
            'age.required' => 'Возраст обязателен для заполнения',
            'age.between' => 'Возраст не может быть меньше 0 и больше 100',
            'phone.required' => 'Телефон обязателен для заполнения',
            'phone.unique' => 'Такой номер телефона уже существует',
            'dateOfBirth.required' => 'Дата рождения обязателена для заполнения',
            'email.unique' => 'Такой email уже зарегистрирован',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен быть не меньше 6 символов',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
