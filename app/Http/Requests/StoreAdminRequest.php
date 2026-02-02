<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'business_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'nid' => ['nullable', 'string', 'max:255'],
            'id_type' => ['required', 'string', 'in:passport,drivers_license,national_id,residence_permit'],
            'id_number' => ['required', 'string', 'max:255'],
            'full_name_on_id' => ['required', 'string', 'max:255'],
            'id_expiry_date' => ['required', 'date', 'after:today'],
            'id_document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'confirm_id_details' => ['required', 'accepted'],
            'accept_terms' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
    }
}
