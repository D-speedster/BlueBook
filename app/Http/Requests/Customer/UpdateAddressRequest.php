<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'recipient_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'regex:/^09\d{9}$/'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
            'postal_code' => ['required', 'string', 'regex:/^\d{10}$/'],
            'is_default' => ['boolean'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'recipient_name' => 'نام گیرنده',
            'mobile' => 'شماره موبایل',
            'province' => 'استان',
            'city' => 'شهر',
            'address' => 'نشانی کامل',
            'postal_code' => 'کد پستی',
            'is_default' => 'نشانی پیش‌فرض',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'recipient_name.required' => 'وارد کردن نام گیرنده الزامی است.',
            'mobile.required' => 'وارد کردن شماره موبایل الزامی است.',
            'mobile.regex' => 'شماره موبایل باید با 09 شروع شود و 11 رقم باشد.',
            'province.required' => 'انتخاب استان الزامی است.',
            'city.required' => 'انتخاب شهر الزامی است.',
            'address.required' => 'وارد کردن نشانی کامل الزامی است.',
            'address.max' => 'نشانی نباید بیشتر از 1000 کاراکتر باشد.',
            'postal_code.required' => 'وارد کردن کد پستی الزامی است.',
            'postal_code.regex' => 'کد پستی باید 10 رقم باشد.',
        ];
    }
}
