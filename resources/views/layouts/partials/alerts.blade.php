<div id="alerts-container" class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <!-- Alerts will be dynamically added here -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('showAlert', event => {
            const { type, message } = event.detail;
            showAlert(type, message);
        });
        
        // Listen for Livewire event
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('showAlert', data => {
                showAlert(data[0].type, data[0].message);
            });
        });
    });
    
    function showAlert(type, message) {
        const alertsContainer = document.getElementById('alerts-container');
        const alertId = 'alert-' + Date.now();
        
        const alertElement = document.createElement('div');
        alertElement.id = alertId;
        alertElement.className = `alert alert-${type} alert-dismissible fade show`;
        alertElement.role = 'alert';
        
        alertElement.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        alertsContainer.appendChild(alertElement);
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            const alert = document.getElementById(alertId);
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    }
</script>