// Tenant Rental Policy Modal JavaScript

document.addEventListener('DOMContentLoaded', function() {
    console.log('Tenant Rental Policy Modal script loaded');

    const modal = document.getElementById('tenantRentalPolicyModal');
    const policyCheckbox = document.getElementById('rentalPolicyCheckbox');
    const consequenceCheckbox = document.getElementById('legalConsequenceCheckbox');
    const proceedBtn = document.getElementById('rentalProceedBtn');
    const cancelBtn = document.getElementById('rentalCancelBtn');
    const registerForm = document.querySelector('form[action*="register"]');

    // Show modal on page load (for tenant registration) with small delay
    if (modal && registerForm) {
        setTimeout(function() {
            showModal();
        }, 300);
    }

    // Function to show the modal
    function showModal() {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        console.log('Modal displayed');
    }

    // Function to hide the modal
    function hideModal() {
        modal.style.display = 'none';
        document.body.style.overflow = ''; // Restore scrolling
    }

    // Enable/Disable Proceed button based on checkbox states
    function updateProceedButton() {
        if (policyCheckbox && consequenceCheckbox && proceedBtn) {
            if (policyCheckbox.checked && consequenceCheckbox.checked) {
                proceedBtn.disabled = false;
                proceedBtn.style.cursor = 'pointer';
            } else {
                proceedBtn.disabled = true;
                proceedBtn.style.cursor = 'not-allowed';
            }
        }
    }

    // Add event listeners to checkboxes
    if (policyCheckbox) {
        policyCheckbox.addEventListener('change', updateProceedButton);
    }

    if (consequenceCheckbox) {
        consequenceCheckbox.addEventListener('change', updateProceedButton);
    }

    // Make checkbox containers clickable
    document.querySelectorAll('.rental-checkbox-container').forEach(function(container) {
        container.addEventListener('click', function(e) {
            // Only trigger if clicking on the container itself, not the checkbox or label
            if (e.target === container) {
                const checkbox = container.querySelector('input[type="checkbox"]');
                if (checkbox) {
                    checkbox.checked = !checkbox.checked;
                    updateProceedButton();
                }
            }
        });
    });

    // Handle Proceed button click
    if (proceedBtn) {
        proceedBtn.addEventListener('click', function(e) {
            e.preventDefault();

            // Verify both checkboxes are checked
            if (!policyCheckbox.checked || !consequenceCheckbox.checked) {
                alert('Please acknowledge both statements before proceeding.');
                return;
            }

            // Store acceptance in localStorage or session
            sessionStorage.setItem('rentalPolicyAccepted', 'true');
            sessionStorage.setItem('rentalPolicyAcceptedTime', new Date().toISOString());

            // Add a hidden input to the form to track policy acceptance
            if (registerForm) {
                let policyInput = document.getElementById('rental_policy_accepted');
                if (!policyInput) {
                    policyInput = document.createElement('input');
                    policyInput.type = 'hidden';
                    policyInput.id = 'rental_policy_accepted';
                    policyInput.name = 'rental_policy_accepted';
                    policyInput.value = '1';
                    registerForm.appendChild(policyInput);
                }

                // Add timestamp
                let timestampInput = document.getElementById('rental_policy_accepted_at');
                if (!timestampInput) {
                    timestampInput = document.createElement('input');
                    timestampInput.type = 'hidden';
                    timestampInput.id = 'rental_policy_accepted_at';
                    timestampInput.name = 'rental_policy_accepted_at';
                    timestampInput.value = new Date().toISOString();
                    registerForm.appendChild(timestampInput);
                }
            }

            // Hide modal and allow user to continue registration
            hideModal();

            // Show success message
            showSuccessMessage();
        });
    }

    // Handle Cancel button click
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();

            // Confirm cancellation
            if (confirm('Are you sure you want to cancel your registration? You must accept the rental policy to register as a tenant.')) {
                // Clear form and redirect or close
                sessionStorage.removeItem('rentalPolicyAccepted');
                sessionStorage.removeItem('rentalPolicyAcceptedTime');
                
                // Redirect to home page or clear form
                if (confirm('Would you like to return to the home page?')) {
                    window.location.href = '/';
                } else {
                    hideModal();
                }
            }
        });
    }

    // Function to show success message
    function showSuccessMessage() {
        // Create a temporary success notification
        const notification = document.createElement('div');
        notification.innerHTML = `
            <div style="position: fixed; top: 20px; right: 20px; z-index: 99999; 
                        background: linear-gradient(135deg, #10b981 0%, #059669 100%); 
                        color: white; padding: 15px 25px; border-radius: 10px; 
                        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
                        animation: slideInRight 0.3s ease-out;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-check-circle" style="font-size: 20px;"></i>
                    <span style="font-weight: 600;">Rental Policy Accepted! You may now complete your registration.</span>
                </div>
            </div>
        `;
        document.body.appendChild(notification);

        // Add animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(100px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
        `;
        document.head.appendChild(style);

        // Remove notification after 5 seconds
        setTimeout(() => {
            notification.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100px)';
            setTimeout(() => {
                notification.remove();
                style.remove();
            }, 300);
        }, 5000);
    }

    // Prevent form submission if policy not accepted
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const policyAccepted = sessionStorage.getItem('rentalPolicyAccepted');
            
            if (policyAccepted !== 'true') {
                e.preventDefault();
                alert('Please accept the Tenant Rental Policy before registering.');
                showModal();
                return false;
            }

            // Ensure hidden inputs are present
            if (!document.getElementById('rental_policy_accepted')) {
                e.preventDefault();
                alert('Please accept the Tenant Rental Policy before registering.');
                showModal();
                return false;
            }
        });
    }

    // Check if policy was already accepted (in case of page reload)
    const policyAccepted = sessionStorage.getItem('rentalPolicyAccepted');
    if (policyAccepted === 'true' && modal) {
        hideModal();
    }

    // Handle browser back button
    window.addEventListener('popstate', function() {
        if (modal && modal.style.display === 'flex') {
            hideModal();
        }
    });

    // Escape key to close modal (with confirmation)
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal && modal.style.display === 'flex') {
            if (confirm('Are you sure you want to close the rental policy? You must accept it to continue registration.')) {
                cancelBtn.click();
            }
        }
    });

    // Prevent closing modal by clicking outside (tenant must make a choice)
    if (modal) {
        const modalBg = modal.querySelector('.rental-modal-bg');
        if (modalBg) {
            modalBg.addEventListener('click', function(e) {
                e.stopPropagation();
                // Show a message that they must accept or cancel
                const proceedBtnElement = document.getElementById('rentalProceedBtn');
                if (proceedBtnElement) {
                    proceedBtnElement.style.animation = 'shake 0.5s';
                    setTimeout(() => {
                        proceedBtnElement.style.animation = '';
                    }, 500);
                }

                // Add shake animation if not exists
                if (!document.getElementById('shakeAnimation')) {
                    const shakeStyle = document.createElement('style');
                    shakeStyle.id = 'shakeAnimation';
                    shakeStyle.textContent = `
                        @keyframes shake {
                            0%, 100% { transform: translateX(0); }
                            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                            20%, 40%, 60%, 80% { transform: translateX(5px); }
                        }
                    `;
                    document.head.appendChild(shakeStyle);
                }

                alert('Please accept the rental policy or cancel your registration to continue.');
            });
        }
    }

    // Log policy view for analytics
    if (modal) {
        console.log('Tenant Rental Policy displayed at:', new Date().toISOString());
    }
});
