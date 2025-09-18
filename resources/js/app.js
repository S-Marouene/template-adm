import './bootstrap.js';

// Import Bootstrap JavaScript
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Theme management
class ThemeManager {
    constructor() {
        this.init();
    }

    init() {
        this.setTheme(this.getStoredTheme() || this.getSystemTheme());
        this.setupEventListeners();
    }

    getStoredTheme() {
        return localStorage.getItem('theme');
    }

    getSystemTheme() {
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    setTheme(theme) {
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
    }

    toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        this.setTheme(newTheme);
        return newTheme;
    }

    setupEventListeners() {
        // Listen for theme toggle events
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-theme-toggle]')) {
                e.preventDefault();
                this.toggleTheme();
            }
        });

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!this.getStoredTheme()) {
                this.setTheme(e.matches ? 'dark' : 'light');
            }
        });
    }
}

// Sidebar management
class SidebarManager {
    constructor() {
        this.sidebar = document.querySelector('.sidebar');
        this.toggleBtn = document.querySelector('[data-sidebar-toggle]');
        this.init();
    }

    init() {
        if (this.toggleBtn) {
            this.toggleBtn.addEventListener('click', () => this.toggle());
        }

        // Handle responsive behavior
        this.handleResize();
        window.addEventListener('resize', () => this.handleResize());
    }

    toggle() {
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

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ThemeManager();
    new SidebarManager();
});

// Global functions for Livewire integration
window.toggleTheme = function() {
    const themeManager = new ThemeManager();
    return themeManager.toggleTheme();
};

window.toggleSidebar = function() {
    const sidebarManager = new SidebarManager();
    sidebarManager.toggle();
};