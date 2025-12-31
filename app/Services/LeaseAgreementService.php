<?php

namespace App\Services;

use App\Models\LeaseAgreement;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use PDF;

class LeaseAgreementService
{
    /**
     * Generate lease agreement document as PDF
     */
    public function generateAgreementDocument(LeaseAgreement $agreement)
    {
        try {
            $html = $this->generateAgreementHTML($agreement);
            
            // Generate PDF (using laravel-dompdf or similar)
            // For now, we'll just store the HTML as document
            $fileName = "lease-agreement-{$agreement->id}-" . now()->timestamp . ".pdf";
            $filePath = "lease-agreements/{$fileName}";
            
            // If using dompdf:
            // $pdf = PDF::loadHTML($html);
            // Storage::put($filePath, $pdf->output());
            
            // For now, store as HTML (implement PDF generation based on your setup)
            Storage::put($filePath, $html);
            
            $agreement->update([
                'agreement_document_path' => $filePath,
            ]);

            Log::info("Lease agreement document generated for agreement {$agreement->id}");
            return $filePath;
        } catch (\Exception $e) {
            Log::error("Error generating lease agreement document: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Generate HTML content for lease agreement
     */
    private function generateAgreementHTML(LeaseAgreement $agreement)
    {
        $tenant = $agreement->tenant;
        $landlord = $agreement->landlord;
        $property = $agreement->property;

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <style>
                body { font-family: Arial, sans-serif; margin: 40px; }
                .header { text-align: center; margin-bottom: 40px; }
                .header h1 { margin: 0; color: #333; }
                .section { margin-bottom: 30px; }
                .section h2 { color: #667eea; font-size: 16px; margin-bottom: 10px; }
                .section p { margin: 5px 0; line-height: 1.6; }
                .two-column { display: flex; gap: 30px; }
                .column { flex: 1; }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                table th, table td { text-align: left; padding: 10px; border-bottom: 1px solid #ddd; }
                table th { background-color: #f5f5f5; }
                .signature-area { margin-top: 50px; }
                .signature-line { border-bottom: 1px solid #333; width: 300px; margin-bottom: 5px; }
                .footer { text-align: center; margin-top: 50px; color: #666; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h1>LEASE AGREEMENT</h1>
                <p>Agreement ID: #{$agreement->id}</p>
            </div>

            <div class='section'>
                <h2>AGREEMENT DETAILS</h2>
                <table>
                    <tr>
                        <th>Lease Agreement ID</th>
                        <td>#{$agreement->id}</td>
                    </tr>
                    <tr>
                        <th>Created Date</th>
                        <td>" . $agreement->created_at->format('F d, Y') . "</td>
                    </tr>
                    <tr>
                        <th>Lease Start Date</th>
                        <td>" . $agreement->formatted_start_date . "</td>
                    </tr>
                    <tr>
                        <th>Lease End Date</th>
                        <td>" . $agreement->formatted_end_date . "</td>
                    </tr>
                </table>
            </div>

            <div class='section'>
                <h2>PARTIES INVOLVED</h2>
                <div class='two-column'>
                    <div class='column'>
                        <h3>TENANT (LESSEE)</h3>
                        <p><strong>Name:</strong> {$tenant->name}</p>
                        <p><strong>Email:</strong> {$tenant->email}</p>
                        <p><strong>Phone:</strong> " . ($tenant->userDetail->phone ?? 'N/A') . "</p>
                    </div>
                    <div class='column'>
                        <h3>LANDLORD (LESSOR)</h3>
                        <p><strong>Name:</strong> {$landlord->name}</p>
                        <p><strong>Email:</strong> {$landlord->email}</p>
                        <p><strong>Phone:</strong> " . ($landlord->phone ?? 'N/A') . "</p>
                    </div>
                </div>
            </div>

            <div class='section'>
                <h2>PROPERTY DETAILS</h2>
                <p><strong>Property Name:</strong> {$property->title}</p>
                <p><strong>Address:</strong> {$property->address}</p>
                <p><strong>City:</strong> {$property->city}" . ($property->state ? ", {$property->state}" : '') . "</p>
                <p><strong>Property Type:</strong> " . ucfirst($property->property_type ?? 'N/A') . "</p>
            </div>

            <div class='section'>
                <h2>FINANCIAL TERMS</h2>
                <table>
                    <tr>
                        <th>Monthly Rent</th>
                        <td>₱" . number_format($agreement->monthly_rent, 2) . "</td>
                    </tr>
                    <tr>
                        <th>Security Deposit</th>
                        <td>₱" . number_format($agreement->security_deposit ?? 0, 2) . "</td>
                    </tr>
                    <tr>
                        <th>Total Lease Period</th>
                        <td>" . $agreement->start_date->diffInMonths($agreement->end_date) . " months</td>
                    </tr>
                    <tr>
                        <th>Total Lease Amount</th>
                        <td>₱" . number_format($agreement->monthly_rent * $agreement->start_date->diffInMonths($agreement->end_date), 2) . "</td>
                    </tr>
                </table>
            </div>

            <div class='section'>
                <h2>TERMS AND CONDITIONS</h2>
                <p>" . nl2br($agreement->terms_and_conditions ?? 'Standard lease terms apply.') . "</p>
            </div>

            " . ($agreement->additional_terms ? "
            <div class='section'>
                <h2>ADDITIONAL TERMS</h2>
                " . $this->formatAdditionalTerms($agreement->additional_terms) . "
            </div>
            " : '') . "

            <div class='signature-area'>
                <h2>SIGNATURES</h2>
                <div class='two-column'>
                    <div class='column'>
                        <h3>TENANT SIGNATURE</h3>
                        <div class='signature-line'></div>
                        <p>{$tenant->name}</p>
                        <p><small>Date: __________________</small></p>
                    </div>
                    <div class='column'>
                        <h3>LANDLORD SIGNATURE</h3>
                        <div class='signature-line'></div>
                        <p>{$landlord->name}</p>
                        <p><small>Date: __________________</small></p>
                    </div>
                </div>
            </div>

            <div class='footer'>
                <p>This document was generated on " . now()->format('F d, Y \a\t g:i A') . "</p>
                <p>Property Management Portal &copy; " . date('Y') . "</p>
            </div>
        </body>
        </html>
        ";

        return $html;
    }

    /**
     * Format additional terms for display
     */
    private function formatAdditionalTerms($terms)
    {
        if (!is_array($terms)) {
            return $terms;
        }

        $html = '<ul>';
        foreach ($terms as $term) {
            $html .= '<li>' . $term . '</li>';
        }
        $html .= '</ul>';

        return $html;
    }

    /**
     * Send agreement to tenant for signature
     */
    public function sendToTenant(LeaseAgreement $agreement)
    {
        try {
            $tenant = $agreement->tenant;
            
            // Generate document first
            $this->generateAgreementDocument($agreement);

            // Send email
            Mail::send('emails.lease-agreement-tenant', [
                'agreement' => $agreement,
                'tenant' => $tenant,
                'property' => $agreement->property,
            ], function ($m) use ($tenant, $agreement) {
                $m->to($tenant->email)
                  ->subject("New Lease Agreement - {$agreement->property->title}");
            });

            $agreement->update([
                'sent_to_tenant_at' => now(),
            ]);

            Log::info("Lease agreement sent to tenant {$tenant->id}");
        } catch (\Exception $e) {
            Log::error("Error sending lease agreement to tenant: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Notify tenant of landlord signature
     */
    public function notifyTenantOfSignature(LeaseAgreement $agreement)
    {
        try {
            $tenant = $agreement->tenant;
            
            Mail::send('emails.lease-agreement-signed-landlord', [
                'agreement' => $agreement,
                'tenant' => $tenant,
            ], function ($m) use ($tenant) {
                $m->to($tenant->email)
                  ->subject('Lease Agreement Signed by Landlord');
            });

            Log::info("Tenant {$tenant->id} notified of landlord signature");
        } catch (\Exception $e) {
            Log::error("Error notifying tenant: " . $e->getMessage());
        }
    }

    /**
     * Notify landlord of tenant signature
     */
    public function notifyLandlordOfSignature(LeaseAgreement $agreement)
    {
        try {
            $landlord = $agreement->landlord;
            
            Mail::send('emails.lease-agreement-signed-tenant', [
                'agreement' => $agreement,
                'landlord' => $landlord,
            ], function ($m) use ($landlord) {
                $m->to($landlord->email)
                  ->subject('Lease Agreement Signed by Tenant');
            });

            Log::info("Landlord {$landlord->id} notified of tenant signature");
        } catch (\Exception $e) {
            Log::error("Error notifying landlord: " . $e->getMessage());
        }
    }

    /**
     * Notify both parties of cancellation
     */
    public function notifyOfCancellation(LeaseAgreement $agreement, $reason = null)
    {
        try {
            $tenant = $agreement->tenant;
            $landlord = $agreement->landlord;

            Mail::send('emails.lease-agreement-cancelled', [
                'agreement' => $agreement,
                'reason' => $reason,
            ], function ($m) use ($tenant) {
                $m->to($tenant->email)
                  ->subject('Lease Agreement Cancelled');
            });

            Mail::send('emails.lease-agreement-cancelled', [
                'agreement' => $agreement,
                'reason' => $reason,
            ], function ($m) use ($landlord) {
                $m->to($landlord->email)
                  ->subject('Lease Agreement Cancelled');
            });

            Log::info("Both parties notified of agreement {$agreement->id} cancellation");
        } catch (\Exception $e) {
            Log::error("Error notifying cancellation: " . $e->getMessage());
        }
    }

    /**
     * Get lease agreement statistics
     */
    public function getStatistics()
    {
        return [
            'total' => LeaseAgreement::count(),
            'pending' => LeaseAgreement::pending()->count(),
            'signed_by_tenant' => LeaseAgreement::signedByTenant()->count(),
            'signed_by_landlord' => LeaseAgreement::signedByLandlord()->count(),
            'executed' => LeaseAgreement::executed()->count(),
            'active' => LeaseAgreement::active()->count(),
            'expired' => LeaseAgreement::expired()->count(),
            'cancelled' => LeaseAgreement::cancelled()->count(),
        ];
    }
}
