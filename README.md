# OCP-MS - Operations & Maintenance Management System

<p align="center">
  <img src="public/images/OCP-MS.png" alt="OCP-MS Logo" width="200">
</p>

<p align="center">
  <strong>A comprehensive Laravel-based Equipment Maintenance Management System</strong>
</p>

 <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

## 📋 Overview

OCP-MS is a modern, web-based Operations and Maintenance Management System designed to streamline equipment maintenance workflows in industrial environments. Built with Laravel 12 and featuring a responsive design, it provides comprehensive tools for managing equipment, work orders, technicians, and spare parts inventory.

## ✨ Key Features

### 🔧 Equipment Management
- **Equipment Tracking**: Monitor all equipment with detailed information (name, type, location, status)
- **Maintenance History**: Track last maintenance dates and schedules
- **Status Monitoring**: Real-time equipment status updates
- **Location Management**: Organize equipment by physical location

### 📋 Work Order System
- **Work Order Creation**: Generate maintenance requests with detailed descriptions
- **Priority Management**: Set and track work order priorities (High, Medium, Low)
- **Status Tracking**: Monitor work order progress from creation to completion
- **Cost Tracking**: Record and analyze maintenance costs
- **Due Date Management**: Set and monitor maintenance deadlines

### 👨‍🔧 Technician Management
- **Technician Profiles**: Manage technician information and specialties
- **Contact Management**: Store email and phone contact information
- **Work Assignment**: Assign technicians to specific work orders
- **Workload Tracking**: Monitor technician availability and assignments

### 📦 Inventory Management
- **Spare Parts Tracking**: Comprehensive spare parts inventory system
- **Category Organization**: Organize parts by categories
- **Quantity Monitoring**: Track stock levels and quantities
- **Price Management**: Monitor and update part pricing

### 📊 Reporting & Analytics
- **Maintenance Reports**: Generate comprehensive maintenance reports
- **Data Export**: Export data for external analysis
- **Dashboard Analytics**: Visual insights into maintenance operations
- **Performance Metrics**: Track key maintenance KPIs

## 🛠️ Technology Stack

- **Backend**: Laravel 12.x (PHP 8.2+)
- **Frontend**: Blade Templates + Tailwind CSS
- **Authentication**: Laravel Breeze
- **Database**: MySQL/SQLite with Eloquent ORM
- **Icons**: Heroicons
- **Build Tools**: Vite
- **Testing**: PHPUnit

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL 8.0+ or SQLite
- Web server (Apache/Nginx)

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/OCP-MS.git
cd OCP-MS
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ocp_ms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Migration
```bash
# Run migrations
php artisan migrate

# (Optional) Seed sample data
php artisan db:seed
```

### 6. Build Assets
```bash
# Build frontend assets
npm run build

# Or for development
npm run dev
```

### 7. Start the Application
```bash
# Start the development server
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 🎯 Usage

### Getting Started
1. **Register/Login**: Create an account or login with existing credentials
2. **Dashboard**: Access the main dashboard for system overview
3. **Equipment**: Add and manage your equipment inventory
4. **Work Orders**: Create maintenance work orders and assign to technicians
5. **Technicians**: Manage your maintenance team
6. **Inventory**: Track spare parts and supplies
7. **Reports**: Generate and export maintenance reports

### User Roles
- **Maintenance Manager**: Full system access, reporting, and management
- **Technician**: View assigned work orders, update status
- **Inventory Manager**: Manage spare parts and inventory

## 🔧 Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
# Format code with Laravel Pint
./vendor/bin/pint
```

### Development Server
```bash
# Run all development services
composer run dev
```

This command starts:
- Laravel development server
- Queue worker
- Log viewer (Pail)
- Vite development server

## 📁 Project Structure

```
OCP-MS/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── ...
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   └── web.php             # Web routes
└── public/
    └── images/             # Static images
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [Issues](https://github.com/yourusername/OCP-MS/issues) page
2. Create a new issue with detailed information
3. Contact the development team

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com)
- UI components from [Tailwind CSS](https://tailwindcss.com)
- Icons by [Heroicons](https://heroicons.com)

---

<p align="center">
  Made with ❤️ for efficient maintenance management
</p>
