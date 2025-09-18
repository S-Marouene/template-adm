import './bootstrap.js';

// Import Bootstrap JavaScript
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Sidebar management
class SidebarManager {
    constructor() {
        this.init();
    }

    init() {
        this.sidebar = document.querySelector('.sidebar');
        this.toggleBtn = document.querySelector('[data-sidebar-toggle]');
        
        if (this.toggleBtn) {
            // Remove existing listeners to prevent duplicates
            this.toggleBtn.removeEventListener('click', this.handleToggle);
            this.toggleBtn.addEventListener('click', this.handleToggle.bind(this));
        }

        // Handle responsive behavior
        this.handleResize();
        window.removeEventListener('resize', this.handleResize);
        window.addEventListener('resize', this.handleResize.bind(this));
    }

    handleToggle() {
        if (this.sidebar) {
            this.sidebar.classList.toggle('show');
        }
    }

    handleResize() {
        if (window.innerWidth >= 992 && this.sidebar) {
            this.sidebar.classList.remove('show');
        }
    }
}

// Initialize sidebar management
function initializeApp() {
    new SidebarManager();
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', initializeApp);

// Reinitialize after Livewire navigation
document.addEventListener('livewire:navigated', initializeApp);

// Global functions for Livewire integration
window.toggleSidebar = function() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.classList.toggle('show');
    }
};