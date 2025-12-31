<link rel="stylesheet" href="{{ asset('assets/css/landlord-terms-modal.css') }}">

<div id="landlordTermsModal" class="modal-overlay" style="display: none;">
    <div class="modal">
        <div class="modal-header">
            <h1>Terms of Use</h1>
            <button class="close-btn" id="closeModalBtn" type="button">&times;</button>
        </div>

        <div class="modal-content">
            <div class="content-intro">
                By signing up as a Landlord, you agree to our <strong>Terms and Conditions.</strong>
            </div>

            <div class="terms-text">
                <strong>1. Landlord Agreement</strong><br><br>
                By registering as a Landlord on our platform, you agree to comply with all applicable laws and regulations governing rental properties in your jurisdiction.

                <br><br><strong>2. Property Management</strong><br><br>
                As a Landlord, you are responsible for maintaining your property in accordance with local housing codes and standards. You agree to provide safe, habitable premises for your tenants.

                <br><br><strong>3. Tenant Relations</strong><br><br>
                You agree to treat all tenants fairly and without discrimination. You must respect tenant privacy and provide proper notice before entering the premises as required by law.

                <br><br><strong>4. Rent Collection and Payments</strong><br><br>
                You agree to clearly communicate rent amounts, payment methods, and due dates to your tenants. Late fees, if applicable, must comply with local regulations.

                <br><br><strong>5. Liability and Insurance</strong><br><br>
                You are responsible for obtaining appropriate landlord insurance and maintaining adequate coverage. You agree to indemnify and hold harmless our platform from any claims arising from your property or tenant interactions.

                <br><br><strong>6. Dispute Resolution</strong><br><br>
                Any disputes related to your use of our platform shall be resolved through binding arbitration or as required by applicable law.

                <br><br><strong>7. Platform Conduct</strong><br><br>
                You agree to use our platform in good faith and not engage in fraudulent, abusive, or illegal activities. Violation of these terms may result in account suspension or termination.
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="termsCheckbox">
                <label for="termsCheckbox">I agree to the Terms of Use</label>
            </div>
        </div>

        <div class="modal-footer">
            <button class="cancel-btn" id="cancelBtn" type="button">Cancel</button>
            <button class="proceed-btn" id="proceedBtn" type="button" disabled>PROCEED</button>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/landlord-terms-modal.js') }}"></script>