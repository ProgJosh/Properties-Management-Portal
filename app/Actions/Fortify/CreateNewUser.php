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
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'date_of_birth' => [
                'required', 
                'date', 
                'before:' . now()->subYears(18)->format('Y-m-d'),
                'date_format:Y-m-d'
            ],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            // ID Validation Rules
            'id_document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120', 'min:100'],
            'id_type' => ['required', 'string', 'in:passport,drivers_license,national_id,residence_permit'],
            'id_number' => ['required', 'string', 'min:5', 'max:50'],
            'full_name_on_id' => ['required', 'string', 'min:3', 'max:100'],
            'id_expiry_date' => ['required', 'date', 'after:today', 'date_format:Y-m-d'],
            'confirm_id_details' => ['accepted'],
            // Rental Policy Rules
            'rental_policy_accepted' => ['required', 'accepted'],
            'rental_policy_accepted_at' => ['required', 'date'],
        ], [
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.before' => "Sorry, you can't create an account because you are below 18 years old. You must be at least 18 years of age to register as a tenant on our platform.",
            'rental_policy_accepted.required' => 'You must accept the Tenant Rental Policy to register.',
            'rental_policy_accepted.accepted' => 'You must accept the Tenant Rental Policy to register.',
            'rental_policy_accepted_at.required' => 'Policy acceptance timestamp is required.',
        ])->validate();

        // Create user
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'date_of_birth' => $input['date_of_birth'],
            'password' => Hash::make($input['password']),
            'rental_policy_accepted' => true,
            'rental_policy_accepted_at' => $input['rental_policy_accepted_at'],
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
