<!-- Delete Lease Agreement Modal -->
<div class="modal fade" id="deleteLeaseModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-top: 4px solid #ef4444;">
            <div class="modal-header" style="background: linear-gradient(135deg, #fee2e2 0%, rgba(239, 68, 68, 0.05) 100%);">
                <h5 class="modal-title" style="color: #ef4444;">⚠️ Delete Lease Agreement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <strong>Warning:</strong> This action cannot be undone.
                </div>

                <!-- Deletion Block Message -->
                <div id="deletionBlockMessage" style="display: none; margin-bottom: 1rem;">
                    <div class="alert alert-warning">
                        <strong>⛔ Cannot Delete</strong>
                        <p id="blockReason" class="mb-0"></p>
                    </div>
                </div>

                <!-- Deletion Allowed Message -->
                <div id="deletionAllowedMessage" style="display: none;">
                    <p>Are you sure you want to permanently delete this lease agreement?</p>
                    
                    <div class="alert alert-info">
                        <strong>Note:</strong> You are about to delete:
                        <ul class="mb-0 mt-2">
                            <li>Agreement ID: <strong id="agreementId">#</strong></li>
                            <li>Tenant: <strong id="tenantName">-</strong></li>
                            <li>Property: <strong id="propertyName">-</strong></li>
                            <li>Status: <strong id="agreementStatus">-</strong></li>
                        </ul>
                    </div>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="confirmDelete" name="confirm" value="on" required>
                            <label class="custom-control-label" for="confirmDelete">
                                I understand this agreement will be permanently deleted
                            </label>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="confirmAck" required>
                            <label class="custom-control-label" for="confirmAck">
                                I have read and understand the consequences of this action
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn" style="display: none;">
                    <span id="deleteButtonText">🗑️ Delete Agreement</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteLeaseModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const confirmDelete = document.getElementById('confirmDelete');
    const confirmAck = document.getElementById('confirmAck');
    const deletionBlockMessage = document.getElementById('deletionBlockMessage');
    const deletionAllowedMessage = document.getElementById('deletionAllowedMessage');

    // Listen to modal show event
    $(deleteModal).on('show.bs.modal', function(e) {
        const button = $(e.relatedTarget);
        const canDelete = button.data('can-delete') === true;
        const blockReason = button.data('block-reason');
        const agreementId = button.data('agreement-id');
        const tenantName = button.data('tenant-name');
        const propertyName = button.data('property-name');
        const agreementStatus = button.data('agreement-status');
        const deleteUrl = button.data('delete-url');

        // Update modal content based on deletion status
        if (!canDelete) {
            deletionBlockMessage.style.display = 'block';
            deletionAllowedMessage.style.display = 'none';
            confirmDeleteBtn.style.display = 'none';
            document.getElementById('blockReason').textContent = blockReason || 'This agreement cannot be deleted.';
        } else {
            deletionBlockMessage.style.display = 'none';
            deletionAllowedMessage.style.display = 'block';
            confirmDeleteBtn.style.display = 'inline-block';

            // Update form data
            document.getElementById('agreementId').textContent = '#' + agreementId;
            document.getElementById('tenantName').textContent = tenantName;
            document.getElementById('propertyName').textContent = propertyName;
            document.getElementById('agreementStatus').textContent = agreementStatus;
            
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = deleteUrl;

            // Reset checkboxes
            confirmDelete.checked = false;
            confirmAck.checked = false;
            updateDeleteButton();
        }
    });

    // Update delete button state
    function updateDeleteButton() {
        const bothChecked = confirmDelete.checked && confirmAck.checked;
        confirmDeleteBtn.disabled = !bothChecked;
        confirmDeleteBtn.style.opacity = bothChecked ? '1' : '0.6';
        confirmDeleteBtn.style.cursor = bothChecked ? 'pointer' : 'not-allowed';
    }

    confirmDelete.addEventListener('change', updateDeleteButton);
    confirmAck.addEventListener('change', updateDeleteButton);

    // Handle delete confirmation
    confirmDeleteBtn.addEventListener('click', function() {
        if (confirmDelete.checked && confirmAck.checked) {
            const originalText = confirmDeleteBtn.innerHTML;
            confirmDeleteBtn.disabled = true;
            confirmDeleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm mr-2"></span>Deleting...';

            const deleteForm = document.getElementById('deleteForm');
            const formData = new FormData(deleteForm);

            fetch(deleteForm.action, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Error deleting agreement');
                    });
                }
                return response.json();
            })
            .then(data => {
                $(deleteModal).modal('hide');
                alert(data.message || 'Agreement deleted successfully!');
                setTimeout(() => window.location.reload(), 1000);
            })
            .catch(error => {
                confirmDeleteBtn.disabled = false;
                confirmDeleteBtn.innerHTML = originalText;
                alert('Error: ' + error.message);
            });
        }
    });

    // Reset modal on close
    $(deleteModal).on('hidden.bs.modal', function() {
        confirmDelete.checked = false;
        confirmAck.checked = false;
        updateDeleteButton();
    });
});
</script>
