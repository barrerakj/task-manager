# Task Manager

A modern task management application built with Laravel, designed to help you organize and track your tasks efficiently.

## Features

- Task creation and management
- Task categorization
- Task status tracking
- User authentication
- Responsive design

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL or PostgreSQL

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/task-manager.git
cd task-manager
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install and compile frontend dependencies:
```bash
npm install
npm run dev
```

4. Configure your environment:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in the `.env` file and run migrations:
```bash
php artisan migrate
```

6. Start the development server:
```bash
php artisan serve
```

## Usage

Visit `http://localhost:8000` in your browser to access the application.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
