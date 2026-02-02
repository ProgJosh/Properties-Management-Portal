document.addEventListener('DOMContentLoaded', function() {
    const commissionModal = document.getElementById('commissionPolicyModal');
    const commissionCheckbox = document.getElementById('commissionCheckbox');
    const commissionProceedBtn = document.getElementById('commissionProceedBtn');
    const commissionCancelBtn = document.getElementById('commissionCancelBtn');

    // Enable/disable proceed button based on checkbox state
    if (commissionCheckbox) {
        commissionCheckbox.addEventListener('change', function() {
            commissionProceedBtn.disabled = !this.checked;
        });
    }

    // Close modal when cancel button is clicked
    if (commissionCancelBtn) {
        commissionCancelBtn.addEventListener('click', function() {
            closeCommissionModal();
        });
    }

    // Handle proceed button click
    if (commissionProceedBtn) {
        commissionProceedBtn.addEventListener('click', function() {
            proceedWithCommissionAgreement();
        });
    }

    // Close modal when clicking outside (on overlay)
    if (commissionModal) {
        commissionModal.addEventListener('click', function(e) {
            if (e.target === commissionModal) {
                closeCommissionModal();
            }
        });
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCommissionModal();
        }
    });
});

/**
 * Open the Commission Policy Modal
 */
function openCommissionModal() {
    const commissionModal = document.getElementById('commissionPolicyModal');
    if (commissionModal) {
        commissionModal.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
}

/**
 * Close the Commission Policy Modal
 */
function closeCommissionModal() {
    const commissionModal = document.getElementById('commissionPolicyModal');
    if (commissionModal) {
        commissionModal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore background scrolling
        
        // Reset checkbox and button states
        const commissionCheckbox = document.getElementById('commissionCheckbox');
        const commissionProceedBtn = document.getElementById('commissionProceedBtn');
        if (commissionCheckbox) commissionCheckbox.checked = false;
        if (commissionProceedBtn) commissionProceedBtn.disabled = true;
    }
}

/**
 * Handle proceeding after commission policy agreement
 */
function proceedWithCommissionAgreement() {
    const commissionCheckbox = document.getElementById('commissionCheckbox');
    
    if (!commissionCheckbox.checked) {
        alert('Please agree to the Commission Policy to proceed.');
        return;
    }

    // Show loading state
    const proceedBtn = document.getElementById('commissionProceedBtn');
    const originalText = proceedBtn.textContent;
    proceedBtn.disabled = true;
    proceedBtn.textContent = 'Processing...';

    // Submit the registration form
    setTimeout(function() {
        // Mark commission as acknowledged
        markCommissionAsAcknowledged();

        // Close modal
        closeCommissionModal();

        // Dispatch event that commission was accepted
        document.dispatchEvent(new CustomEvent('commissionAccepted'));
        
        // Reset button state
        proceedBtn.disabled = false;
        proceedBtn.textContent = originalText;
    }, 300);
}

/**
 * Check if commission policy has been acknowledged
 */
function hasAgreedToCommission() {
    const agreed = sessionStorage.getItem('commissionAgreed');
    return agreed === 'true';
}

/**
 * Mark commission as acknowledged in session
 */
function markCommissionAsAcknowledged() {
    sessionStorage.setItem('commissionAgreed', 'true');
    sessionStorage.setItem('commissionAgreedAt', new Date().toISOString());
    sessionStorage.setItem('commissionPercentage', '3');
}

/**
 * Clear commission acknowledgement (for logout or form reset)
 */
function clearCommissionAcknowledgement() {
    sessionStorage.removeItem('commissionAgreed');
    sessionStorage.removeItem('commissionAgreedAt');
    sessionStorage.removeItem('commissionPercentage');
}

/**
 * Get commission agreement details
 */
function getCommissionDetails() {
    return {
        agreed: sessionStorage.getItem('commissionAgreed') === 'true',
        agreedAt: sessionStorage.getItem('commissionAgreedAt'),
        percentage: sessionStorage.getItem('commissionPercentage')
    };
}

/**
 * Validate all required signups (Terms + Warning + Commission)
 */
function validateAllAgreements() {
    const termsAccepted = sessionStorage.getItem('termsAccepted') === 'true';
    const warningAcknowledged = sessionStorage.getItem('warningAcknowledged') === 'true';
    const commissionAgreed = sessionStorage.getItem('commissionAgreed') === 'true';

    return {
        termsAccepted: termsAccepted,
        warningAcknowledged: warningAcknowledged,
        commissionAgreed: commissionAgreed,
        allAccepted: termsAccepted && warningAcknowledged && commissionAgreed
    };
}

/**
 * Export for use in other modules (if using ES6)
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        openCommissionModal,
        closeCommissionModal,
        proceedWithCommissionAgreement,
        hasAgreedToCommission,
        markCommissionAsAcknowledged,
        clearCommissionAcknowledgement,
        getCommissionDetails,
        validateAllAgreements
    };
}