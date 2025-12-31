<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use App\Models\LeaseAgreement;

class LeaseAgreementPolicy
{
    /**
     * Determine if the user can view the agreement
     */
    public function view(User|Admin $user, LeaseAgreement $agreement): bool
    {
        if ($user instanceof User) {
            return $user->id === $agreement->tenant_id;
        }
        return $user->id === $agreement->landlord_id;
    }

    /**
     * Determine if the user can sign the agreement
     */
    public function sign(User|Admin $user, LeaseAgreement $agreement): bool
    {
        if ($user instanceof User) {
            return $user->id === $agreement->tenant_id && 
                   in_array($agreement->status, ['pending', 'signed_by_landlord']);
        }
        return $user->id === $agreement->landlord_id && 
               in_array($agreement->status, ['pending', 'signed_by_tenant']);
    }

    /**
     * Determine if the user can cancel the agreement
     */
    public function cancel(User|Admin $user, LeaseAgreement $agreement): bool
    {
        if ($user instanceof User) {
            return false;
        }
        return $user->id === $agreement->landlord_id;
    }

    /**
     * Determine if the user can delete the agreement
     * Active lease agreements cannot be deleted until end date
     */
    public function delete(User|Admin $user, LeaseAgreement $agreement): bool
    {
        // Only admin/landlord can delete
        if ($user instanceof User) {
            return false;
        }

        // Admin must be the landlord
        if ($user->id !== $agreement->landlord_id) {
            return false;
        }

        // Check if agreement can be deleted
        return $agreement->canBeDeleted();
    }

    /**
     * Determine if the user can permanently delete the agreement
     */
    public function forceDelete(User|Admin $user, LeaseAgreement $agreement): bool
    {
        return $this->delete($user, $agreement);
    }

    /**
     * Determine if the user can restore a soft-deleted agreement
     */
    public function restore(User|Admin $user, LeaseAgreement $agreement): bool
    {
        if ($user instanceof User) {
            return false;
        }
        return $user->id === $agreement->landlord_id;
    }

    /**
     * Determine if the user can download the agreement
     */
    public function download(User|Admin $user, LeaseAgreement $agreement): bool
    {
        return $this->view($user, $agreement);
    }
}
