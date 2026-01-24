<link rel="stylesheet" href="{{ asset('assets/css/tenant-rental-policy-modal.css') }}?v={{ now()->timestamp }}">

<div id="tenantRentalPolicyModal" class="rental-modal-overlay" style="display: none;">
    <div class="rental-modal-wrapper">
        <div class="rental-modal-bg"></div>
        
        <div class="rental-modal">
            <div class="rental-modal-container">
                <!-- Left Side - Illustration -->
                <div class="rental-illustration">
                    @if(file_exists(public_path('frontend/assets/images/rental-policy-illustration.gif')))
                        <img src="{{ asset('frontend/assets/images/rental-policy-illustration.gif') }}" alt="Rental Policy Illustration" class="rental-image">
                    @else
                        <div class="rental-icon-placeholder">
                            <i class="fas fa-home" style="font-size: 120px; color: white; opacity: 0.9;"></i>
                            <div style="margin-top: 20px; text-align: center;">
                                <i class="fas fa-file-contract" style="font-size: 60px; color: white; opacity: 0.8;"></i>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Side - Content -->
                <div class="rental-content">
                    <h1 class="rental-title">🏠 Tenant Rental Policy</h1>

                    <p class="rental-intro">
                        Before finalizing your registration, please carefully review our rental policy. These terms and conditions will apply to all lease agreements.
                    </p>

                    <!-- DO'S Section -->
                    <div class="rental-section dos-section">
                        <h2 class="section-title">✅ DO'S - What You MUST Do:</h2>
                        <ul class="rental-list">
                            <li><strong>Pay Rent On Time:</strong> Submit your monthly rent by the agreed-upon due date to avoid late fees.</li>
                            <li><strong>Maintain Cleanliness:</strong> Keep the property clean and in good condition throughout your tenancy.</li>
                            <li><strong>Report Issues Promptly:</strong> Notify landlord immediately of any damages, repairs needed, or maintenance issues.</li>
                            <li><strong>Follow Community Rules:</strong> Respect neighbors, building regulations, and community guidelines.</li>
                            <li><strong>Use Property as Intended:</strong> Utilize the property for residential purposes only as specified in the lease.</li>
                            <li><strong>Allow Property Inspections:</strong> Permit landlord to conduct reasonable inspections with prior notice.</li>
                            <li><strong>Keep Insurance Updated:</strong> Maintain renter's insurance if required by your lease agreement.</li>
                            <li><strong>Communicate Effectively:</strong> Respond to landlord communications within a reasonable timeframe.</li>
                        </ul>
                    </div>

                    <!-- DON'TS Section -->
                    <div class="rental-section donts-section">
                        <h2 class="section-title">❌ DON'TS - What You MUST NOT Do:</h2>
                        <ul class="rental-list">
                            <li><strong>No Unauthorized Alterations:</strong> Do not make structural changes, paint, or renovate without written landlord approval.</li>
                            <li><strong>No Illegal Activities:</strong> Strictly prohibited - engaging in any illegal activities on the premises will result in immediate eviction.</li>
                            <li><strong>No Subletting:</strong> Do not sublet or assign the property to others without explicit landlord permission.</li>
                            <li><strong>No Excessive Noise:</strong> Avoid creating disturbances that interfere with neighbors' peaceful enjoyment.</li>
                            <li><strong>No Unauthorized Pets:</strong> Do not bring pets onto the property without prior written consent from the landlord.</li>
                            <li><strong>No Property Damage:</strong> Do not intentionally damage or neglect the property and its fixtures.</li>
                            <li><strong>No Overcrowding:</strong> Do not exceed the maximum occupancy limit stated in your lease agreement.</li>
                            <li><strong>No Late Payment Without Notice:</strong> Do not delay rent payments without communicating with your landlord.</li>
                            <li><strong>No Smoking:</strong> If specified in the lease, smoking (including vaping) is prohibited inside the property.</li>
                        </ul>
                    </div>

                    <!-- Additional Important Terms -->
                    <div class="rental-section terms-section">
                        <h2 class="section-title">📋 Important Terms & Conditions:</h2>
                        <ul class="rental-list">
                            <li><strong>Security Deposit:</strong> Your security deposit will be held and returned (minus any deductions for damages) within the legally required timeframe after lease termination.</li>
                            <li><strong>Notice Period:</strong> Provide the required notice period (typically 30-60 days) before vacating the property.</li>
                            <li><strong>Entry Rights:</strong> Landlord has the right to enter with proper notice (24-48 hours) for inspections, repairs, or showings.</li>
                            <li><strong>Liability:</strong> You are responsible for damages caused by negligence or misuse beyond normal wear and tear.</li>
                            <li><strong>Lease Violations:</strong> Violation of any terms may result in penalties, eviction proceedings, or legal action.</li>
                            <li><strong>Utilities & Services:</strong> Clarify which utilities and services you are responsible for paying as per your lease agreement.</li>
                        </ul>
                    </div>

                    <!-- Consequences Section -->
                    <div class="rental-section consequences-section">
                        <h2 class="section-title">⚠️ Consequences of Policy Violations:</h2>
                        <ul class="rental-list">
                            <li>Written warning for first-time minor violations</li>
                            <li>Monetary penalties or deduction from security deposit</li>
                            <li>Lease termination and eviction proceedings for serious or repeated violations</li>
                            <li>Legal action for damages, unpaid rent, or breach of contract</li>
                            <li>Negative rental history affecting future rental applications</li>
                        </ul>
                    </div>

                    <!-- Acknowledgment Section -->
                    <div class="rental-acknowledgment">
                        <div class="rental-checkbox-container">
                            <input type="checkbox" id="rentalPolicyCheckbox" required>
                            <label for="rentalPolicyCheckbox">
                                <strong>I acknowledge that I have read, understood, and agree to comply with all the Do's and Don'ts, terms and conditions outlined in this Tenant Rental Policy.</strong>
                            </label>
                        </div>
                        
                        <div class="rental-checkbox-container mt-2">
                            <input type="checkbox" id="legalConsequenceCheckbox" required>
                            <label for="legalConsequenceCheckbox">
                                I understand that violations of this policy may result in penalties, lease termination, or legal action.
                            </label>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="rental-buttons">
                        <button class="rental-cancel-btn" id="rentalCancelBtn" type="button">Cancel Registration</button>
                        <button class="rental-proceed-btn" id="rentalProceedBtn" type="button" disabled>I AGREE & PROCEED</button>
                    </div>

                    <!-- Footer Note -->
                    <div class="rental-footer-note">
                        <p class="text-muted small">
                            <i class="fas fa-info-circle"></i> By proceeding, you acknowledge that this policy will be incorporated into any lease agreement you sign through our platform.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
