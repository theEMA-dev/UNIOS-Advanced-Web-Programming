# Project Management Application

A multilingual project management system built with Laravel 10, featuring dark mode support and responsive design.

## Technologies Used

- Laravel 10
- PHP 8.2+
- MySQL/MariaDB
- TailwindCSS 3
- Alpine.js
- Node.js & NPM
- Composer

## Features

- User Authentication
- Project Management (CRUD operations)
- Team Member Management 
- Progress Tracking
- Multi-language Support (English, Polish, Turkish)
- Dark/Light/System Theme Support
- Responsive Design
- Role-based Access Control

## Prerequisites

Make sure you have the following installed on your system:

- PHP >= 8.2
- Composer
- Node.js >= 16
- MySQL/MariaDB
- Git

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd exercise3
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

7. Run database migrations:
```bash
php artisan migrate
```

## Running the Application

1. Start the Laravel development server:
```bash
php artisan serve
```

2. Compile assets in development mode:
```bash
npm run dev
```

Or for production:
```bash
npm run build
```

The application will be available at `http://localhost:8000`

## Project Structure

- `/app` - Contains the core code of the application
    - `/Http/Controllers` - Application controllers
    - `/Models` - Eloquent models
    - `/Policies` - Authorization policies
    - `/Providers` - Service providers
- `/database/migrations` - Database migrations
- `/lang` - Language files (en, pl, tr)
- `/resources`
    - `/views` - Blade templates
    - `/css` - Stylesheets
    - `/js` - JavaScript files
- `/routes` - Application routes

## Key Features Implementation

### Multilingual Support
The application supports multiple languages with easy switching. Language files are located in `/lang` directory.

### Theme System
Dark/Light mode implementation using TailwindCSS and Alpine.js with system preference detection.

### Project Management
Full CRUD operations for projects with role-based access control and team member management.

### Database Schema
- Users Table: Stores user information
- Projects Table: Stores project details with manager relationship
- Project Members Table: Manages many-to-many relationship between projects and users

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the MIT license.
