<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class StorePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $isLandlord = Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 1;

        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],
            'purok' => ['nullable', 'string', 'max:255'],
            'barangay' => ['nullable', 'string', 'max:255'],
            'thumbnail' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:25600'],
            'price' => ['required', 'numeric', 'min:0'],
            'bedroom' => ['required', 'numeric', 'min:0'],
            'bathroom' => ['required', 'numeric', 'min:0'],
            'garage' => ['required', 'numeric', 'min:0'],
            'floor' => ['required', 'numeric', 'min:0'],
            'type' => ['required', 'string', 'max:255'],
            'facility' => ['nullable'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:25600'],
            'accommodation' => ['required', 'numeric', 'min:0'],
            'pet_friendly' => ['nullable', 'numeric',],
            'title_document' => $isLandlord
                ? ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240']
                : ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'title_document.required' => 'A scanned copy of the property title/house document is required.',
            'title_document.mimes'    => 'The title document must be a PDF, JPG, or PNG file.',
            'title_document.max'      => 'The title document must not exceed 10MB.',
        ];
    }
}
