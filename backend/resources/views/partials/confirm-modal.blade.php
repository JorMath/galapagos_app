<!-- Confirm Modal Reusable Component -->
<!-- Usage: Include this partial, then use data attributes on trigger buttons: -->
<!-- data-confirm-modal="open" data-form-id="delete-boat-1" data-item-name="Barco Name" -->

<div id="confirmModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="confirmModalTitle">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" id="confirmModalBackdrop"></div>
    
    <!-- Modal Content -->
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all" id="confirmModalPanel">
            <!-- Icono de peligro -->
            <div class="flex justify-center pt-8 pb-4">
                <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Título -->
            <h2 id="confirmModalTitle" class="font-display text-xl font-medium text-gray-900 text-center px-6">
                ¿Estás seguro?
            </h2>
            
            <!-- Mensaje -->
            <p id="confirmModalMessage" class="mt-2 text-sm text-gray-500 text-center px-6">
                Esta acción no se puede deshacer
            </p>
            
            <!-- Nombre del elemento a eliminar -->
            <p id="confirmModalItemName" class="mt-1 text-sm font-medium text-gray-900 text-center px-6">
            </p>
            
            <!-- Botones -->
            <div class="flex gap-3 px-6 pb-8 pt-6">
                <button type="button" id="confirmModalCancel" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors">
                    Cancelar
                </button>
                <button type="button" id="confirmModalConfirm" class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    let currentFormId = null;
    let isVisible = false;
    
    const modal = document.getElementById('confirmModal');
    const backdrop = document.getElementById('confirmModalBackdrop');
    const cancelBtn = document.getElementById('confirmModalCancel');
    const confirmBtn = document.getElementById('confirmModalConfirm');
    const itemNameEl = document.getElementById('confirmModalItemName');
    const panel = document.getElementById('confirmModalPanel');
    
    // Open modal
    function openModal(formId, itemName) {
        if (!modal) return;
        
        currentFormId = formId;
        itemNameEl.textContent = itemName ? itemName : '';
        
        // Show modal
        modal.classList.remove('hidden');
        
        // Animate in
        setTimeout(function() {
            panel.classList.add('scale-100');
            panel.classList.remove('scale-95', 'opacity-0');
        }, 10);
        
        isVisible = true;
    }
    
    // Close modal
    function closeModal() {
        if (!modal) return;
        
        // Animate out
        panel.classList.add('scale-95', 'opacity-0');
        panel.classList.remove('scale-100');
        
        setTimeout(function() {
            modal.classList.add('hidden');
            currentFormId = null;
        }, 150);
        
        isVisible = false;
    }
    
    // Confirm action - submit the form
    function confirmAction() {
        if (!currentFormId) return;
        
        const form = document.getElementById(currentFormId);
        if (form) {
            form.submit();
        }
        closeModal();
    }
    
    // Event listeners
    if (cancelBtn) {
        cancelBtn.addEventListener('click', closeModal);
    }
    
    if (confirmBtn) {
        confirmBtn.addEventListener('click', confirmAction);
    }
    
    if (backdrop) {
        backdrop.addEventListener('click', closeModal);
    }
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isVisible) {
            closeModal();
        }
    });
    
    // Global function to open modal from data attributes
    window.openConfirmModal = function(formId, itemName) {
        openModal(formId, itemName);
    };
    
    // Auto-bind buttons with data-confirm-modal attribute
    document.addEventListener('DOMContentLoaded', function() {
        const triggers = document.querySelectorAll('[data-confirm-modal="open"]');
        triggers.forEach(function(trigger) {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                const formId = trigger.getAttribute('data-form-id');
                const itemName = trigger.getAttribute('data-item-name');
                openModal(formId, itemName);
            });
        });
    });
})();
</script>

<style>
#confirmModalPanel {
    transition: transform 0.15s ease-out, opacity 0.15s ease-out;
}
#confirmModalPanel.scale-95 {
    transform: scale(0.95);
    opacity: 0;
}
#confirmModalPanel.scale-100 {
    transform: scale(1);
    opacity: 1;
}
</style>