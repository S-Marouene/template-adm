# Template-Adm - Laravel Admin Dashboard

A modern, responsive admin dashboard built with Laravel 12, Livewire, and Bootstrap 5. This template provides a complete foundation for building administrative interfaces with user management, role-based access control, profile management, and multi-language support.

## ✨ Features

### 🔐 Authentication & Security
- **Complete Auth System**: Login, registration, password reset, email verification
- **Role-Based Access Control (RBAC)**: Manage user permissions with 4 default roles
- **Session Management**: Secure session handling with CSRF protection
- **Password Security**: Secure password hashing and validation

### 👥 Enhanced User Management
- **Comprehensive User Profiles**: Profile pictures, phone numbers, and addresses
- **Advanced User Table**: Visual profile display with contact information
- **User CRUD Operations**: Create, read, update, delete users with full profile data
- **Role Assignment**: Assign roles to users with granular permissions
- **Enhanced Search**: Search by name, email, phone number, or address
- **Responsive Pagination**: Bootstrap 5 pagination with Livewire navigation

### 👤 Profile Management
- **Profile Pictures**: Upload, preview, and manage user avatars
- **Contact Information**: Phone numbers and addresses with validation
- **Secure File Upload**: Image validation and storage management
- **Profile Settings**: Comprehensive profile editing interface
- **Responsive Design**: Mobile-optimized profile management

### 🛡️ Roles & Permissions
- **4 Default Roles**: Super Admin, Admin, User, Visitor
- **CRUD Permissions**: Read, Write, Update, Delete operations
- **Dynamic Role Creation**: Add custom roles with specific permissions
- **Permission Management**: Fine-grained permission control

### 🌍 Multi-Language Support
- **4 Languages**: English, French, Spanish, Arabic
- **RTL Support**: Full right-to-left layout support for Arabic
- **Dynamic Switching**: Real-time language switching without page reload
- **Localized Interface**: Complete UI translation

### 🎨 Modern UI/UX with Bootstrap 5
- **Bootstrap 5 Framework**: Modern, responsive design system
- **Responsive Design**: Perfect on desktop, tablet, and mobile
- **Dark/Light Mode**: Toggle between themes with system preference detection
- **Mobile-First**: Optimized mobile experience with sidebar toggle
- **Clean Interface**: Modern, intuitive design using Bootstrap components
- **Enhanced Tables**: Professional data presentation with advanced features

### ⚡ Real-Time Interactivity
- **Livewire Components**: Dynamic updates without page refresh
- **SPA-like Navigation**: Seamless page transitions with wire:navigate
- **AJAX Operations**: Seamless form submissions and data updates
- **Instant Feedback**: Real-time validation and notifications
- **File Upload Preview**: Live preview during file uploads

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
   git clone https://github.com/S-Marouene/template-adm.git
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

6. **Storage setup**
   ```bash
   # Create storage link for profile pictures
   php artisan storage:link
   ```

7. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

8. **Start the application**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access your application.

## 🆕 What's New

### 🔄 Recent Updates
This version includes major enhancements to the user management system:

#### 👤 Enhanced User Profiles
- **Profile Pictures**: Upload and manage user avatars with live preview
- **Contact Information**: Phone numbers and addresses for all users
- **Comprehensive Forms**: Enhanced create/edit user forms with all profile fields
- **Responsive Design**: Mobile-optimized profile management interface

#### 📋 Advanced User Table
- **Visual Profiles**: Profile pictures displayed in the users table
- **Contact Display**: Phone numbers and addresses shown in table columns
- **Smart Search**: Search across name, email, phone, and address fields
- **Responsive Table**: Horizontal scrolling for mobile devices
- **Optimized Layout**: Professional data presentation with proper spacing

#### 🎨 Bootstrap 5 Migration
- **Modern Framework**: Complete migration from Tailwind CSS to Bootstrap 5
- **Improved Components**: Professional tables, forms, and navigation
- **Better Responsive**: Enhanced mobile experience with Bootstrap grid
- **Theme Integration**: Native Bootstrap dark/light mode support
- **Consistent Design**: Unified visual language across all components

## 🏗️ Architecture

### Technology Stack
- **Backend**: Laravel 12 with Livewire
- **Frontend**: Blade templates with Bootstrap 5 components
- **Styling**: Bootstrap 5 with custom CSS variables
- **Build Tool**: Vite v7.0.4
- **Database**: Eloquent ORM with migrations
- **File Storage**: Laravel Storage with public disk
- **Testing**: PestPHP

### Project Structure
```
app/
├── Http/Controllers/     # Controllers
├── Livewire/            # Livewire components
│   ├── Auth/           # Authentication components
│   ├── Users/          # User management (Index, Create, Edit)
│   ├── Roles/          # Role management
│   ├── Permissions/    # Permission management
│   ├── Settings/       # Profile and settings
│   └── Actions/        # Action components (theme, language)
├── Models/             # Eloquent models (User with profile fields)
└── Http/Middleware/    # Custom middleware

resources/
├── views/
│   ├── components/     # Blade components (topbar, layouts)
│   ├── livewire/      # Livewire views with Bootstrap 5
│   └── layouts/       # Layout templates
├── css/               # Bootstrap 5 stylesheets
└── js/                # JavaScript files (sidebar management)

database/
├── migrations/        # Database migrations (including profile fields)
└── seeders/          # Database seeders

public/
└── storage/          # Profile pictures storage (via symlink)

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
2. **Create** new users with complete profile information:
   - Basic details (name, email, password)
   - Contact information (phone number, address)
   - Profile picture upload
   - Role assignment
3. **Edit** existing users and update their profiles
4. **View Enhanced Table** with profile pictures and contact details
5. **Search** by name, email, phone, or address
6. **Manage Profile Pictures** with upload, preview, and removal

### Profile Settings
1. Access **Profile Settings** from the topbar user menu
2. **Update Profile Information**: Name, email, phone, address
3. **Upload Profile Picture**: Drag & drop or click to upload
4. **Preview Changes**: Live preview before saving
5. **Remove Pictures**: Easy profile picture removal

### Role & Permission Management
1. Go to **Roles** to manage user roles
2. **Create custom roles** with specific permissions
3. **Assign permissions** (Read, Write, Update, Delete)
4. **Edit roles** and modify permission sets

### Multi-Language & Theme
1. **Language Switcher**: Click language dropdown in topbar
2. **Theme Toggle**: Use sun/moon icon to switch between light/dark modes
3. **System Theme**: Automatic detection of system preferences
4. **RTL Support**: Automatic layout adjustment for Arabic
5. **Theme Persistence**: Settings saved across sessions

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

### Enhanced User Management System
- **Comprehensive Profiles**: Full user profiles with pictures, contact information
- **Advanced Data Table**: Visual presentation with profile pictures and contact details
- **Smart Search**: Multi-field search across name, email, phone, and address
- **Responsive Design**: Mobile-optimized table with horizontal scrolling
- **File Management**: Secure profile picture upload with validation
- **Data Validation**: Comprehensive form validation for all profile fields

### RBAC System
- **Hierarchical Roles**: Super Admin > Admin > User > Visitor
- **Permission Matrix**: Granular control over CRUD operations
- **Middleware Protection**: Route-level permission checking
- **Dynamic UI**: Interface adapts based on user permissions

### Bootstrap 5 Integration
- **Modern Framework**: Latest Bootstrap 5 components and utilities
- **Responsive Grid**: Advanced responsive layouts
- **Component Library**: Cards, modals, forms, tables, and navigation
- **Theme System**: Built-in dark/light mode support
- **Mobile-First**: Designed for mobile, enhanced for desktop

### Profile Management Features
- **Image Upload**: Drag & drop profile picture upload
- **Live Preview**: Real-time preview during file selection
- **Image Validation**: File type and size validation (2MB limit)
- **Storage Management**: Automatic cleanup of old profile pictures
- **Responsive Forms**: Mobile-optimized profile editing interface

### Internationalization
- **Laravel Localization**: Built-in Laravel i18n system
- **RTL Support**: Complete right-to-left layout support
- **Dynamic Loading**: No page refresh required for language switching
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
- [Bootstrap 5](https://getbootstrap.com) - Modern CSS framework
- [Vite](https://vitejs.dev) - Fast build tool
- [Bootstrap Icons](https://icons.getbootstrap.com) - Icon library

## 📋 Roadmap

### ✅ Recently Completed
- [x] **Bootstrap 5 Migration**: Complete migration from Tailwind CSS to Bootstrap 5
- [x] **Enhanced User Profiles**: Profile pictures, phone numbers, and addresses
- [x] **Advanced User Table**: Visual data presentation with contact information
- [x] **Improved Theme System**: Fixed theme persistence across Livewire navigation
- [x] **File Upload Management**: Secure profile picture upload and management
- [x] **Enhanced Search**: Multi-field search functionality

### 🕰️ Upcoming Features
- [ ] API Integration
- [ ] Advanced Analytics Dashboard
- [ ] Email Templates
- [ ] Two-Factor Authentication
- [ ] Advanced Search & Filtering
- [ ] Export/Import Functionality
- [ ] Audit Logging
- [ ] Notification System

---

**Built with ❤️ using Laravel, Livewire & Bootstrap 5**

*Star ⭐ this repository if you find it helpful!*

> **Note**: This project has been migrated from Tailwind CSS to Bootstrap 5 for improved component consistency and better mobile responsiveness. All features maintain their functionality while benefiting from Bootstrap's mature design system.