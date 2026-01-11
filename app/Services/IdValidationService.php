<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IdValidationService
{
    /**
     * Process and validate ID upload
     */
    public function processIdUpload(
        User $user,
        UploadedFile $document,
        string $idType,
        string $idNumber,
        string $fullNameOnId,
        string $expiryDate
    ): array {
        try {
            // Validate document file
            if (!$this->isValidDocumentFile($document)) {
                return [
                    'success' => false,
                    'message' => 'Invalid document file. Please ensure the file is clear and readable.',
                ];
            }

            // Store the document
            $filePath = $this->storeDocument($user, $document);

            if (!$filePath) {
                return [
                    'success' => false,
                    'message' => 'Failed to store document. Please try again.',
                ];
            }

            // Update or create user details with ID information
            $user->userDetails()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'id_type' => $idType,
                    'id_number' => $idNumber,
                    'full_name_on_id' => $fullNameOnId,
                    'id_expiry_date' => $expiryDate,
                    'id_document_path' => $filePath,
                    'id_verified_at' => null, // Pending admin verification
                    'id_verification_status' => 'pending',
                ]
            );

            // Update user's ID verification flag
            $user->update([
                'id_submitted_at' => now(),
                'id_verified' => false,
            ]);

            return [
                'success' => true,
                'message' => 'ID document uploaded successfully. Our team will verify your identity within 24-48 hours.',
                'file_path' => $filePath,
            ];
        } catch (\Exception $e) {
            \Log::error('ID Validation Error', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'An error occurred while processing your ID. Please try again.',
            ];
        }
    }

    /**
     * Verify ID document (admin only)
     */
    public function verifyId(User $user, bool $approved, ?string $notes = null): array
    {
        $userDetails = $user->userDetails();

        if (!$userDetails) {
            return [
                'success' => false,
                'message' => 'No ID document found for this user.',
            ];
        }

        try {
            $userDetails->update([
                'id_verification_status' => $approved ? 'approved' : 'rejected',
                'id_verified_at' => now(),
                'verification_notes' => $notes,
            ]);

            $user->update([
                'id_verified' => $approved,
            ]);

            return [
                'success' => true,
                'message' => $approved ? 'ID verified successfully.' : 'ID verification rejected.',
            ];
        } catch (\Exception $e) {
            \Log::error('ID Verification Error', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Failed to verify ID. Please try again.',
            ];
        }
    }

    /**
     * Reject ID and request resubmission
     */
    public function rejectIdAndRequest(User $user, string $reason): array
    {
        try {
            $userDetails = $user->userDetails();

            if (!$userDetails) {
                return [
                    'success' => false,
                    'message' => 'No ID document found for this user.',
                ];
            }

            // Delete the document file
            if ($userDetails->id_document_path) {
                Storage::delete($userDetails->id_document_path);
            }

            // Reset ID information
            $userDetails->update([
                'id_type' => null,
                'id_number' => null,
                'full_name_on_id' => null,
                'id_expiry_date' => null,
                'id_document_path' => null,
                'id_verified_at' => null,
                'id_verification_status' => 'rejected',
                'verification_notes' => $reason,
            ]);

            $user->update([
                'id_verified' => false,
                'id_submitted_at' => null,
            ]);

            return [
                'success' => true,
                'message' => 'ID rejected and user notified to resubmit.',
            ];
        } catch (\Exception $e) {
            \Log::error('ID Rejection Error', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Failed to reject ID. Please try again.',
            ];
        }
    }

    /**
     * Check if document file is valid
     */
    private function isValidDocumentFile(UploadedFile $file): bool
    {
        // Check file size (5MB max)
        if ($file->getSize() > 5120 * 1024) {
            return false;
        }

        // Check MIME type
        $mimeTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        if (!in_array($file->getMimeType(), $mimeTypes)) {
            return false;
        }

        // File should be readable and not corrupted
        return $file->isValid();
    }

    /**
     * Store document in secure location
     */
    private function storeDocument(User $user, UploadedFile $document): ?string
    {
        try {
            $fileName = 'id_' . $user->id . '_' . Str::random(10) . '.' . $document->getClientOriginalExtension();
            $path = 'id_documents/' . $user->id . '/';

            // Store with private disk (not publicly accessible)
            $storedPath = Storage::disk('private')->putFileAs(
                $path,
                $document,
                $fileName
            );

            return $storedPath;
        } catch (\Exception $e) {
            \Log::error('Document Storage Error', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Get stored document URL for authenticated users
     */
    public function getDocumentUrl(User $user): ?string
    {
        if (!$user->userDetails() || !$user->userDetails()->id_document_path) {
            return null;
        }

        try {
            // Generate temporary URL (valid for 1 hour)
            return Storage::disk('private')->temporaryUrl(
                $user->userDetails()->id_document_path,
                now()->addHour()
            );
        } catch (\Exception $e) {
            \Log::error('Document URL Generation Error', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Delete ID document
     */
    public function deleteDocument(User $user): bool
    {
        try {
            $userDetails = $user->userDetails();

            if (!$userDetails || !$userDetails->id_document_path) {
                return false;
            }

            // Delete from storage
            Storage::disk('private')->delete($userDetails->id_document_path);

            // Clear ID information
            $userDetails->update([
                'id_type' => null,
                'id_number' => null,
                'full_name_on_id' => null,
                'id_expiry_date' => null,
                'id_document_path' => null,
                'id_verified_at' => null,
                'id_verification_status' => null,
            ]);

            $user->update([
                'id_verified' => false,
                'id_submitted_at' => null,
            ]);

            return true;
        } catch (\Exception $e) {
            \Log::error('Document Deletion Error', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Get ID verification status summary
     */
    public function getVerificationStatus(User $user): array
    {
        $userDetails = $user->userDetails();

        if (!$userDetails) {
            return [
                'status' => 'not_submitted',
                'message' => 'ID not yet submitted',
                'submitted_at' => null,
                'verified_at' => null,
            ];
        }

        $status = $userDetails->id_verification_status ?? 'not_submitted';

        return [
            'status' => $status,
            'message' => $this->getStatusMessage($status),
            'submitted_at' => $userDetails->created_at,
            'verified_at' => $userDetails->id_verified_at,
            'verification_notes' => $userDetails->verification_notes,
        ];
    }

    /**
     * Get human-readable status message
     */
    private function getStatusMessage(string $status): string
    {
        return match ($status) {
            'pending' => '⏳ Pending verification',
            'approved' => '✓ Verified',
            'rejected' => '✗ Rejected - Please resubmit',
            default => 'Not submitted',
        };
    }

    /**
     * Check if user ID is pending verification
     */
    public function isPending(User $user): bool
    {
        $userDetails = $user->userDetails();
        return $userDetails && $userDetails->id_verification_status === 'pending';
    }

    /**
     * Check if user ID is approved
     */
    public function isApproved(User $user): bool
    {
        return $user->id_verified === true;
    }

    /**
     * Check if user ID is rejected
     */
    public function isRejected(User $user): bool
    {
        $userDetails = $user->userDetails();
        return $userDetails && $userDetails->id_verification_status === 'rejected';
    }
}
