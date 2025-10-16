# Campus Event Management System

A modern, secure PHP-based web application for managing campus events with user authentication and a beautiful Bootstrap interface.

## Features

✨ **User Authentication**
- Secure registration with password hashing
- Login/Logout functionality
- Session management

📅 **Event Management**
- Add new events with detailed information
- View all events in a beautiful dashboard
- Event details include: name, dates, venue, coordinator info

🎨 **Modern UI/UX**
- Responsive Bootstrap 5 design
- Beautiful gradient themes
- Bootstrap Icons integration
- Mobile-friendly interface
- Smooth animations and hover effects

🔒 **Security**
- Prepared statements to prevent SQL injection
- Password hashing with bcrypt
- Input sanitization
- Protected routes (login required)

## Project Structure

```
CampusProject/
├── partials/
│   ├── _AddEvents.php      # Add new events form
│   ├── _dbconn.php         # Events database connection
│   ├── _dbconnect.php      # Users database connection
│   └── _nav.php            # Navigation bar component
├── login.php               # User login page
├── logout.php              # Logout handler
├── register.php            # User registration page
├── welcome.php             # Dashboard with events list
└── README.md              # Project documentation
```

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP (recommended for local development)

### Database Setup

1. Create two databases:
```sql
CREATE DATABASE users;
CREATE DATABASE events;
```

2. Create users table:
```sql
USE users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(30) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

3. Create events table:
```sql
USE events;

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    EName VARCHAR(255) NOT NULL,
    startdate DATE NOT NULL,
    enddate DATE NOT NULL,
    venue VARCHAR(255) NOT NULL,
    coordinatorname VARCHAR(100) NOT NULL,
    coordinatorcontact VARCHAR(15) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Application Setup

1. Clone or download the project to your web server directory:
```bash
# For XAMPP
C:/xampp/htdocs/CampusProject/

# For WAMP
C:/wamp64/www/CampusProject/
```

2. Update database credentials in:
   - `partials/_dbconnect.php` (for users database)
   - `partials/_dbconn.php` (for events database)

```php
$servername = "localhost";
$username = "root";        // Change if needed
$password = "";            // Change if needed
```

3. Start your web server and MySQL

4. Access the application:
```
http://localhost/CampusProject/
```

## Usage

### For Users

1. **Register**: Create a new account with username and password
2. **Login**: Access your dashboard with credentials
3. **View Events**: See all campus events in a beautiful table
4. **Add Events**: Click "Add Event" to create new events
5. **Logout**: Safely logout when done

### For Administrators

- Monitor user registrations through the database
- Manage events through the web interface
- Export event data from MySQL for reports

## Security Features

- **Password Security**: All passwords are hashed using PHP's `password_hash()` with bcrypt
- **SQL Injection Prevention**: Uses prepared statements for all database queries
- **XSS Protection**: All user inputs are sanitized with `htmlspecialchars()`
- **Session Security**: Secure session management for authenticated users
- **Input Validation**: Client-side and server-side validation

## Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, Bootstrap 5.3.2
- **Icons**: Bootstrap Icons 1.11.1
- **JavaScript**: Bootstrap Bundle (includes Popper.js)
