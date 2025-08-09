# Diaa Blog - Laravel Application

## Project Overview
A feature-rich blog platform built with Laravel, featuring:
- User roles and authentication
- Post management with categories
- Comment system with admin replies
- Newsletter functionality
- YouTube video integration
- Static page management
- Search functionality

## Development Setup
1. Clone repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure
4. Run migrations: `php artisan migrate`
5. Install frontend dependencies: `npm install && npm run dev`

## Testing
We use PestPHP for testing with TDD approach:
- Run all tests: `php artisan test`
- Run specific test: `php artisan test --filter=TestName`

## Adding New Features
When adding features:
1. Create feature branch
2. Write tests first (TDD)
3. Implement feature
4. Write documentation
5. Submit PR for review

## Roadmap
Planned features:
- Strava integration
- User UID system
- Improved text editor support
