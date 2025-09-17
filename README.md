# Template-Adm - Laravel Admin Dashboard

A modern, responsive admin dashboard built with Laravel 12, Livewire, and Flux UI components. This template provides a complete foundation for building administrative interfaces with user management, role-based access control, and multi-language support.

## ✨ Features

### 🔐 Authentication & Security
- **Complete Auth System**: Login, registration, password reset, email verification
- **Role-Based Access Control (RBAC)**: Manage user permissions with 4 default roles
- **Session Management**: Secure session handling with CSRF protection
- **Password Security**: Secure password hashing and validation

### 👥 User Management
- **User CRUD Operations**: Create, read, update, delete users
- **Role Assignment**: Assign roles to users with granular permissions
- **User Profiles**: Comprehensive user profile management
- **Search & Pagination**: Efficient user browsing with search functionality

### 🛡️ Roles & Permissions
- **4 Default Roles**: Super Admin, Admin, User, Visitor
- **CRUD Permissions**: Read, Write, Update, Delete operations
- **Dynamic Role Creation**: Add custom roles with specific permissions
- **Permission Management**: Fine-grained permission control

### 🌍 Multi-Language Support
- **4 Languages**: English, French, Spanish, Arabic
- **RTL Support**: Full right-to-left layout support for Arabic
- **Dynamic Switching**: Real-time language switching
- **Localized Interface**: Complete UI translation

### 🎨 Modern UI/UX
- **Responsive Design**: Perfect on desktop, tablet, and mobile
- **Dark/Light Mode**: Toggle between themes with system preference detection
- **Mobile-First**: Optimized mobile experience with sidebar toggle
- **Clean Interface**: Modern, intuitive design using Flux UI components

### ⚡ Real-Time Interactivity
- **Livewire Components**: Dynamic updates without page refresh
- **AJAX Operations**: Seamless form submissions and data updates
- **Instant Feedback**: Real-time validation and notifications

## 🚀 Demo

### Desktop Interface
![Desktop View](docs/images/desktop-dashboard.png)

### Mobile Interface
![Mobile View](docs/images/mobile-dashboard.png)

### Dark Mode
![Dark Mode](docs/images/dark-mode.png)

## 📋 Requirements

- **PHP**: ^8.2
- **Laravel**: ^12.0
- **Node.js**: Required for Vite
- **Database**: MySQL, PostgreSQL, SQLite
- **Composer**: For PHP dependencies
- **NPM/Yarn**: For frontend dependencies

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/template-adm.git
   cd template-adm
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database configuration**
   ```bash
   # Configure your database in .env file
   php artisan migrate --seed
   ```

6. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

7. **Start the application**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access your application.

## 🏗️ Architecture

### Technology Stack
- **Backend**: Laravel 12 with Livewire
- **Frontend**: Blade templates with Flux UI components
- **Styling**: Tailwind CSS v4.0.7
- **Build Tool**: Vite v7.0.4
- **Database**: Eloquent ORM with migrations
- **Testing**: PestPHP

### Project Structure
```
app/
├── Http/Controllers/     # Controllers
├── Livewire/            # Livewire components
│   ├── Auth/           # Authentication components
│   ├── Users/          # User management
│   ├── Roles/          # Role management
│   ├── Permissions/    # Permission management
│   └── Actions/        # Action components
├── Models/             # Eloquent models
└── Http/Middleware/    # Custom middleware

resources/
├── views/
│   ├── components/     # Blade components
│   ├── livewire/      # Livewire views
│   └── layouts/       # Layout templates
├── css/               # Stylesheets
└── js/                # JavaScript files

database/
├── migrations/        # Database migrations
└── seeders/          # Database seeders

routes/
├── web.php           # Web routes
└── auth.php          # Authentication routes
```

## 👤 Default Users

After running migrations with seed, you'll have these default users:

| Role | Email | Password |
|------|-------|----------|
| Super Admin | admin@example.com | password |
| Admin | manager@example.com | password |
| User | user@example.com | password |

## 🎯 Usage

### User Management
1. Navigate to **Users** section
2. **Create** new users with role assignment
3. **Edit** existing users and update their roles
4. **Search** and filter users efficiently

### Role & Permission Management
1. Go to **Roles** to manage user roles
2. **Create custom roles** with specific permissions
3. **Assign permissions** (Read, Write, Update, Delete)
4. **Edit roles** and modify permission sets

### Multi-Language & Theme
1. **Language Switcher**: Click language dropdown in topbar
2. **Theme Toggle**: Use sun/moon icon to switch themes
3. **RTL Support**: Automatic layout adjustment for Arabic

### Mobile Navigation
1. **Sidebar Toggle**: Use hamburger menu (☰) on mobile
2. **Responsive Design**: Optimized for all screen sizes
3. **Touch-Friendly**: Mobile-optimized interactions

## 🧪 Testing

Run the test suite:
```bash
composer test
```

Run specific tests:
```bash
php artisan test --filter=UserTest
```

## 📝 Development

### Adding New Features
1. **Create Livewire components**: `php artisan make:livewire ComponentName`
2. **Add routes**: Update `routes/web.php`
3. **Create migrations**: `php artisan make:migration create_table_name`
4. **Add to navigation**: Update sidebar navigation

### Code Style
This project uses Laravel Pint for code formatting:
```bash
./vendor/bin/pint
```

### Development Server
For development with hot-reload:
```bash
npm run dev
```

## 🌟 Features in Detail

### RBAC System
- **Hierarchical Roles**: Super Admin > Admin > User > Visitor
- **Permission Matrix**: Granular control over CRUD operations
- **Middleware Protection**: Route-level permission checking
- **Dynamic UI**: Interface adapts based on user permissions

### Responsive Design
- **Mobile-First**: Designed for mobile, enhanced for desktop
- **Breakpoints**: Tailwind's responsive utilities
- **Touch Interactions**: Optimized for touch devices
- **Performance**: Optimized assets and lazy loading

### Internationalization
- **Laravel Localization**: Built-in Laravel i18n system
- **RTL Support**: Complete right-to-left layout support
- **Dynamic Loading**: No page refresh required
- **Extensible**: Easy to add new languages

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📜 License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## 🆘 Support

If you encounter any issues or have questions:

1. **Check the documentation** in the `docs/` folder
2. **Search existing issues** on GitHub
3. **Create a new issue** with detailed information
4. **Join our community** discussions

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com) - The PHP framework
- [Livewire](https://livewire.laravel.com) - Dynamic interfaces
- [Flux UI](https://fluxui.dev) - Beautiful UI components
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS
- [Heroicons](https://heroicons.com) - Icon library

## 📈 Roadmap

- [ ] API Integration
- [ ] Advanced Analytics Dashboard
- [ ] File Upload Management
- [ ] Email Templates
- [ ] Two-Factor Authentication
- [ ] Advanced Search & Filtering
- [ ] Export/Import Functionality
- [ ] Audit Logging

---

**Built with ❤️ using Laravel & Livewire**

*Star ⭐ this repository if you find it helpful!*