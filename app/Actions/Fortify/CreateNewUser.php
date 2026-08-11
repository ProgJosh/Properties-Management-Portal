<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\IdValidationService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
            'id_type' => ['required', 'string', 'in:passport,drivers_license,national_id,sss_id,pagibig_id,philhealth_id,voters_id,postal_id,senior_citizen_id,residence_permit,tin_id,umid,student_id'],
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

        $this->sendAccountCreatedEmails($user);

        return $user;
    }

    private function sendAccountCreatedEmails(User $user): void
    {
        $this->sendTenantWelcomeEmail($user);
        $this->sendAdminNewAccountEmail($user);
    }

    private function sendTenantWelcomeEmail(User $user): void
    {
        try {
            Mail::send('emails.account-created', [
                'user' => $user,
                'appName' => config('app.name'),
                'loginUrl' => route('login'),
            ], function ($message) use ($user) {
                $message->to($user->email, $user->name)
                    ->subject('Your tenant account has been created');
            });

            Log::info('Account created email sent.', [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);
        } catch (\Throwable $e) {
            Log::error('Account created email failed: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);
        }
    }

    private function sendAdminNewAccountEmail(User $user): void
    {
        $supportEmail = config('mail.from.address');

        try {
            Mail::send('emails.account-created-admin', [
                'user' => $user,
                'appName' => config('app.name'),
                'registeredAt' => now(),
            ], function ($message) use ($user, $supportEmail) {
                $message->to($supportEmail)
                    ->replyTo($user->email, $user->name)
                    ->subject('New tenant account registered');
            });

            Log::info('New account notification email sent.', [
                'user_id' => $user->id,
                'recipient' => $supportEmail,
            ]);
        } catch (\Throwable $e) {
            Log::error('New account notification email failed: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'recipient' => $supportEmail,
            ]);
        }
    }
}
