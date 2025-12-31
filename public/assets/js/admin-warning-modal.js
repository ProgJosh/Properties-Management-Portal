document.addEventListener('DOMContentLoaded', function() {
    const warningModal = document.getElementById('adminWarningModal');
    const warningCloseBtn = document.getElementById('warningCloseBtn');
    const warningCancelBtn = document.getElementById('warningCancelBtn');
    const warningAgreeBtn = document.getElementById('warningAgreeBtn');

    // Close modal when X button is clicked
    if (warningCloseBtn) {
        warningCloseBtn.addEventListener('click', function() {
            closeWarningModal();
        });
    }

    // Close modal when Cancel button is clicked
    if (warningCancelBtn) {
        warningCancelBtn.addEventListener('click', function() {
            closeWarningModal();
        });
    }

    // Handle "I Understand" button click
    if (warningAgreeBtn) {
        warningAgreeBtn.addEventListener('click', function() {
            handleWarningAcknowledge();
        });
    }

    // Close modal when clicking outside (on overlay)
    if (warningModal) {
        warningModal.addEventListener('click', function(e) {
            if (e.target === warningModal) {
                closeWarningModal();
            }
        });
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeWarningModal();
        }
    });
});

/**
 * Open the Warning Notice Modal
 */
function openWarningModal() {
    const warningModal = document.getElementById('adminWarningModal');
    if (warningModal) {
        warningModal.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
}

/**
 * Close the Warning Notice Modal
 */
function closeWarningModal() {
    const warningModal = document.getElementById('adminWarningModal');
    if (warningModal) {
        warningModal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore background scrolling
    }
}

/**
 * Handle when user acknowledges the warning
 */
function handleWarningAcknowledge() {
    const warningAgreeBtn = document.getElementById('warningAgreeBtn');
    const originalText = warningAgreeBtn.textContent;

    // Show loading state
    warningAgreeBtn.disabled = true;
    warningAgreeBtn.textContent = 'Processing...';

    // Simulate processing or API call
    setTimeout(function() {
        // Dispatch custom event that parent component can listen to
        const event = new CustomEvent('warningAcknowledged', {
            detail: {
                acknowledged: true,
                timestamp: new Date(),
                type: 'admin_warning'
            }
        });
        document.dispatchEvent(event);

        // Log for debugging
        console.log('Admin warning acknowledged at:', new Date());

        // Close warning modal
        closeWarningModal();

        // Reset button
        warningAgreeBtn.textContent = originalText;
        warningAgreeBtn.disabled = false;

        // Mark warning as acknowledged
        markWarningAsAcknowledged();

        // Now open the terms modal
        if (typeof openTermsModal === 'function') {
            openTermsModal();
        }
    }, 800);
}

/**
 * Check if warning has been acknowledged (useful for validation)
 */
function hasAcknowledgedWarning() {
    // This would typically check sessionStorage or a database
    const acknowledged = sessionStorage.getItem('warningAcknowledged');
    return acknowledged === 'true';
}

/**
 * Mark warning as acknowledged in session
 */
function markWarningAsAcknowledged() {
    sessionStorage.setItem('warningAcknowledged', 'true');
    sessionStorage.setItem('warningAcknowledgedAt', new Date().toISOString());
}

/**
 * Clear warning acknowledgement (useful for logout or form reset)
 */
function clearWarningAcknowledgement() {
    sessionStorage.removeItem('warningAcknowledged');
    sessionStorage.removeItem('warningAcknowledgedAt');
}

/**
 * Get warning acknowledgement details
 */
function getWarningDetails() {
    return {
        acknowledged: sessionStorage.getItem('warningAcknowledged') === 'true',
        acknowledgedAt: sessionStorage.getItem('warningAcknowledgedAt')
    };
}

/**
 * Export for use in other modules (if using ES6)
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        openWarningModal,
        closeWarningModal,
        handleWarningAcknowledge,
        hasAcknowledgedWarning,
        markWarningAsAcknowledged,
        clearWarningAcknowledgement,
        getWarningDetails
    };
}