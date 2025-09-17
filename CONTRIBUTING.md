# Contributing to Template-Adm

Thank you for considering contributing to Template-Adm! This guide will help you get started.

## 🚀 Quick Start

1. **Fork the repository**
2. **Clone your fork**
3. **Install dependencies**: `composer install && npm install`
4. **Set up environment**: Copy `.env.example` to `.env`
5. **Run migrations**: `php artisan migrate --seed`
6. **Start development**: `npm run dev`

## 📋 Development Guidelines

### Code Style
- Follow PSR-12 coding standards
- Use Laravel Pint: `./vendor/bin/pint`
- Write descriptive commit messages
- Add tests for new features

### Livewire Components
- Use modular structure (Index, Create, Edit)
- Follow naming conventions
- Add proper validation
- Include loading states

### Frontend
- Use Tailwind CSS utilities
- Maintain responsive design
- Test on mobile devices
- Follow accessibility guidelines

## 🧪 Testing

Run tests before submitting:
```bash
composer test
php artisan test --coverage
```

## 📝 Documentation

- Update README.md for new features
- Add inline code comments
- Document complex functions
- Include usage examples

## 🐛 Bug Reports

Include:
- Laravel version
- PHP version
- Steps to reproduce
- Expected vs actual behavior
- Error messages/logs

## 💡 Feature Requests

- Describe the use case
- Explain the benefit
- Provide implementation ideas
- Consider backward compatibility

## 📋 Pull Request Process

1. **Create feature branch**: `git checkout -b feature/feature-name`
2. **Make changes** with proper tests
3. **Run test suite**: `composer test`
4. **Update documentation** if needed
5. **Submit PR** with clear description

## 🏷️ Commit Convention

Use conventional commits:
- `feat:` New features
- `fix:` Bug fixes
- `docs:` Documentation
- `style:` Code style changes
- `refactor:` Code refactoring
- `test:` Adding tests
- `chore:` Build/config changes

## ❓ Questions?

- Open a discussion on GitHub
- Check existing issues first
- Provide context and examples

Thank you for contributing! 🙏