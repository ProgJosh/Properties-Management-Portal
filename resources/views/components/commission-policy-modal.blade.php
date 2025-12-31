<link rel="stylesheet" href="{{ asset('assets/css/commission-policy-modal.css') }}">

<div id="commissionPolicyModal" class="commission-modal-overlay" style="display: none;">
    <div class="commission-modal-wrapper">
        <div class="commission-modal-bg"></div>
        
        <div class="commission-modal">
            <div class="commission-modal-container">
                <!-- Left Side - Illustration -->
                <div class="commission-illustration">
                    <!-- Your custom commission illustration -->
                    <img src="{{ asset('frontend/assets/images/commission-illustration.gif') }}" alt="Commission Policy Illustration" class="commission-image">
                </div>

                <!-- Right Side - Content -->
                <div class="commission-content">
                    <h1 class="commission-title">Commission Policy</h1>

                    <p class="commission-intro">
                        Before completing your registration as a Landlord, please review our commission policy.
                    </p>

                    <!-- Commission Fee Section -->
                    <div class="commission-section">
                        <h2 class="section-title">Commission Fee:</h2>
                        <p class="section-text">
                            A <strong>3% commission</strong> will be automatically deducted from each successful tenant transaction.
                        </p>
                    </div>

                    <!-- How It Works Section -->
                    <div class="commission-section">
                        <h2 class="section-title">How it works:</h2>
                        <ul class="commission-list">
                            <li>The commission covers platform maintenance and secure transaction handling.</li>
                            <li>Deductions apply only when rent payments are successfully processed.</li>
                            <li>You'll receive monthly reports summarizing commissions and payouts.</li>
                        </ul>
                    </div>

                    <!-- Checkbox -->
                    <div class="commission-checkbox-container">
                        <input type="checkbox" id="commissionCheckbox">
                        <label for="commissionCheckbox">I understand and agree to the Commission Policy</label>
                    </div>

                    <!-- Buttons -->
                    <div class="commission-buttons">
                        <button class="commission-cancel-btn" id="commissionCancelBtn" type="button">Cancel</button>
                        <button class="commission-proceed-btn" id="commissionProceedBtn" type="button" disabled>PROCEED</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/commission-policy-modal.js') }}"></script>