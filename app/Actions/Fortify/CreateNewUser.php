<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\IdValidationService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    protected IdValidationService $idValidationService;

    public function __construct(IdValidationService $idValidationService)
    {
        $this->idValidationService = $idValidationService;
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            // ID Validation Rules
            'id_document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120', 'min:100'],
            'id_type' => ['required', 'string', 'in:passport,drivers_license,national_id,residence_permit'],
            'id_number' => ['required', 'string', 'min:5', 'max:50'],
            'full_name_on_id' => ['required', 'string', 'min:3', 'max:100'],
            'id_expiry_date' => ['required', 'date', 'after:today', 'date_format:Y-m-d'],
            'confirm_id_details' => ['accepted'],
        ])->validate();

        // Create user
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // Process ID upload
        if (isset($input['id_document'])) {
            $this->idValidationService->processIdUpload(
                $user,
                $input['id_document'],
                $input['id_type'],
                $input['id_number'],
                $input['full_name_on_id'],
                $input['id_expiry_date']
            );
        }

        return $user;
    }
}
