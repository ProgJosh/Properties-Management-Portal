<link rel="stylesheet" href="{{ asset('frontend/assets/css/admin-warning-modal.css') }}">

<div id="adminWarningModal" class="warning-modal-overlay" style="display: none;">
    <div class="warning-modal">
        <button class="warning-close-btn" id="warningCloseBtn" type="button">&times;</button>

        <div class="warning-modal-container">
            <!-- Left Side - Illustration -->
            <div class="warning-illustration">
                <div class="warning-icon-container">
                    <div class="warning-avatar-group">
                        <div class="warning-triangle"></div>
                        <span class="warning-label">Landlord</span>
                    </div>
                    <div class="warning-exchange">↔️</div>
                    <div class="warning-avatar-group">
                        <div class="warning-exclamation"></div>
                        <span class="warning-label">Tenant</span>
                    </div>
                </div>
                <div class="warning-leaf"></div>
                <div class="warning-person"></div>
            </div>

            <!-- Right Side - Content -->
            <div class="warning-content">
                <h1 class="warning-title">Warning Notice</h1>

                <div class="warning-message">
                    <p>
                        By signing up as an Admin, you are agreeing to the <strong>Terms of Use for Landlords</strong>. 
                        Please read them carefully.
                    </p>
                    <p style="margin-top: 15px; color: #d32f2f;">
                        <strong>Please note that this application is meant for Landlords, and adherence to our policies is required. 
                        Violations may result in the suspension or termination of your account.</strong>
                    </p>
                </div>

                <div class="warning-buttons">
                    <button class="warning-cancel-btn" id="warningCancelBtn" type="button">Cancel</button>
                    <button class="warning-agree-btn" id="warningAgreeBtn" type="button">I Understand</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/admin-warning-modal.js') }}"></script>