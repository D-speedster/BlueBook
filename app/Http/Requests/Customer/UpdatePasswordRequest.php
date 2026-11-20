<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'current_password' => 'رمز عبور فعلی',
            'password' => 'رمز عبور جدید',
            'password_confirmation' => 'تکرار رمز عبور جدید',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'current_password.required' => 'وارد کردن رمز عبور فعلی الزامی است.',
            'password.required' => 'وارد کردن رمز عبور جدید الزامی است.',
            'password.min' => 'رمز عبور جدید باید حداقل 8 کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور جدید مطابقت ندارد.',
        ];
    }
}
