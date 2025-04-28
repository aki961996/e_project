This is a Laravel-based web application designed to Event management system.
Built with Laravel's powerful MVC framework, this project emphasizes scalability, security, and performance.

Features

    [✔️] Laravel  Framework

    [✔️] Authentication System (Login/Register)

    [✔️] CRUD Operations

    [✔️] Responsive Frontend Design (Blade templates or frontend tech if used)

    [✔️] Email Notifications (if applicable)

    Requirements

    PHP >= 8.1

    Composer

    MySQL 

    Laravel CLI

    Installation

Follow these steps to set up the project locally:
# Clone the repository
git clone https://github.com/aki961996/e_project.git

# Navigate into the project directory
cd e_project

# Install PHP dependencies
composer install

# Copy .env.example to .env
cp .env.example .env

# Generate application key
php artisan key:generate

# Set your database credentials in the .env file
# DB_DATABASE, DB_USERNAME, DB_PASSWORD

# Run database migrations
php artisan migrate

# Install Node.js dependencies
npm install

# Build frontend assets
npm run dev

# Serve the application
php artisan serve

The application will be available at http://localhost:8000.

Usage

    Register a new user account.

    Log in with your credentials.

    Perform CRUD operations on [entities related to your project].

    Folder Structure

    app/ – Laravel application core (Controllers, Models, etc.)

    resources/views/ – Blade templates for frontend views

    routes/web.php – Web routes

    routes/api.php – API routes

    database/migrations/ – Database structure files
