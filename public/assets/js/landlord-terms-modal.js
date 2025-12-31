// Initialize event listeners when DOM is ready
function initializeModalListeners() {
    const modalOverlay = document.getElementById('landlordTermsModal');
    const termsCheckbox = document.getElementById('termsCheckbox');
    const proceedBtn = document.getElementById('proceedBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');

    console.log('Initializing modal listeners...', {
        modalOverlay: !!modalOverlay,
        termsCheckbox: !!termsCheckbox,
        proceedBtn: !!proceedBtn,
        cancelBtn: !!cancelBtn,
        closeModalBtn: !!closeModalBtn
    });

    // Enable/disable proceed button based on checkbox state
    if (termsCheckbox) {
        termsCheckbox.addEventListener('change', function() {
            proceedBtn.disabled = !this.checked;
        });
    }

    // Close modal when cancel button is clicked
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            closeModal();
        });
    }

    // Close modal when close button (X) is clicked
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            closeModal();
        });
    }

    // Handle proceed button click
    if (proceedBtn) {
        proceedBtn.addEventListener('click', function() {
            proceedWithSignup();
        });
    }

    // Close modal when clicking outside the modal (on overlay)
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });
    }
}

// Wait for DOM to be fully loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeModalListeners);
} else {
    // DOM is already loaded
    initializeModalListeners();
}

/**
 * Open the Terms of Use Modal
 */
function openTermsModal() {
    const modalOverlay = document.getElementById('landlordTermsModal');
    if (modalOverlay) {
        // Clear any inline styles first
        modalOverlay.style.cssText = '';
        
        // Set display to flex with all centering properties
        modalOverlay.style.display = 'flex';
        modalOverlay.style.justifyContent = 'center';
        modalOverlay.style.alignItems = 'center';
        modalOverlay.style.position = 'fixed';
        modalOverlay.style.top = '0';
        modalOverlay.style.left = '0';
        modalOverlay.style.width = '100%';
        modalOverlay.style.height = '100%';
        modalOverlay.style.zIndex = '1000';
        
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
        console.log('Modal opened - centered');
    }
}

/**
 * Handle registration button click - prevent submission and show warning modal first
 */
function handleRegistration(event) {
    event.preventDefault();
    // Open the warning modal first (the terms modal will open after user acknowledges the warning)
    if (typeof openWarningModal === 'function') {
        openWarningModal();
    }
}

/**
 * Close the Terms of Use Modal
 */
function closeModal() {
    const modalOverlay = document.getElementById('landlordTermsModal');
    if (modalOverlay) {
        modalOverlay.style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore background scrolling
        
        // Reset checkbox and button states
        const termsCheckbox = document.getElementById('termsCheckbox');
        const proceedBtn = document.getElementById('proceedBtn');
        if (termsCheckbox) termsCheckbox.checked = false;
        if (proceedBtn) proceedBtn.disabled = true;
        
        console.log('Modal closed');
    }
}

/**
 * Handle proceeding with signup after terms acceptance
 */
function proceedWithSignup() {
    const termsCheckbox = document.getElementById('termsCheckbox');
    
    if (!termsCheckbox.checked) {
        alert('Please accept the terms and conditions to proceed.');
        return;
    }

    // Show loading state
    const proceedBtn = document.getElementById('proceedBtn');
    const originalText = proceedBtn.textContent;
    proceedBtn.disabled = true;
    proceedBtn.textContent = 'Processing...';

    // Close terms modal
    setTimeout(function() {
        closeModal();
        
        // Open commission policy modal next
        if (typeof openCommissionModal === 'function') {
            openCommissionModal();
        } else {
            console.error('openCommissionModal is not available');
            proceedBtn.disabled = false;
            proceedBtn.textContent = originalText;
        }
    }, 500);
}

/**
 * Check if user has accepted terms (useful for form validation)
 */
function hasAcceptedTerms() {
    const termsCheckbox = document.getElementById('termsCheckbox');
    return termsCheckbox ? termsCheckbox.checked : false;
}

/**
 * Export for use in other modules (if using ES6)
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        openTermsModal,
        closeModal,
        proceedWithSignup,
        hasAcceptedTerms
    };
}