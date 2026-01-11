<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadIdRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_document' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120', // 5MB max
                'min:100', // Minimum file size to prevent tiny/corrupted files
            ],
            'id_type' => [
                'required',
                'string',
                'in:passport,drivers_license,national_id,residence_permit',
            ],
            'id_number' => [
                'required',
                'string',
                'min:5',
                'max:50',
            ],
            'full_name_on_id' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'id_expiry_date' => [
                'required',
                'date',
                'after:today', // ID must not be expired
                'date_format:Y-m-d',
            ],
            'confirm_id_details' => [
                'accepted', // Must be checked as true
            ],
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'id_document.required' => 'Government-issued ID document is required.',
            'id_document.file' => 'The ID must be a file.',
            'id_document.mimes' => 'The ID must be a PDF, JPG, JPEG, or PNG file.',
            'id_document.max' => 'The ID file cannot exceed 5MB.',
            'id_document.min' => 'The ID file appears to be corrupted or too small.',
            'id_type.required' => 'Please select the type of ID you are uploading.',
            'id_type.in' => 'The selected ID type is invalid.',
            'id_number.required' => 'ID number is required.',
            'id_number.min' => 'ID number must be at least 5 characters.',
            'id_number.max' => 'ID number cannot exceed 50 characters.',
            'full_name_on_id.required' => 'Full name on ID is required.',
            'full_name_on_id.min' => 'Full name must be at least 3 characters.',
            'full_name_on_id.max' => 'Full name cannot exceed 100 characters.',
            'id_expiry_date.required' => 'ID expiry date is required.',
            'id_expiry_date.date' => 'Please provide a valid date.',
            'id_expiry_date.after' => 'ID must not be expired. Please provide an ID with a future expiry date.',
            'id_expiry_date.date_format' => 'Expiry date must be in YYYY-MM-DD format.',
            'confirm_id_details.accepted' => 'You must confirm that the information provided is accurate.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Sanitize ID number - remove spaces and special characters except hyphens
        if ($this->has('id_number')) {
            $this->merge([
                'id_number' => str_replace([' ', '_'], '', $this->id_number),
            ]);
        }

        // Uppercase ID type
        if ($this->has('id_type')) {
            $this->merge([
                'id_type' => strtolower($this->id_type),
            ]);
        }

        // Trim whitespace from names
        if ($this->has('full_name_on_id')) {
            $this->merge([
                'full_name_on_id' => trim($this->full_name_on_id),
            ]);
        }
    }
}
