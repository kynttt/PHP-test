# Backend Authentication API

This is the backend API for the authentication system, built with PHP and PostgreSQL.

## Prerequisites

1. PHP 8.2 or higher
2. PostgreSQL database server
3. PHP PostgreSQL extensions (pgsql and pdo_pgsql)

## Setup

1. **Enable PHP PostgreSQL Extensions**
   - Open your `php.ini` file
   - Uncomment these lines (remove the semicolon):
     ```ini
     extension=pgsql
     extension=pdo_pgsql
     ```
   - Restart your PHP server after making changes

2. **Database Setup**
   - Open pgAdmin
   - Create a new database named `auth_test`
   - Run the following SQL:
     ```sql
     CREATE TABLE users (
         id SERIAL PRIMARY KEY,
         email VARCHAR(255) UNIQUE NOT NULL,
         password TEXT NOT NULL,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```

3. **Configuration**
   - Open `config.php`
   - Update database credentials if needed:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'auth_test');
     define('DB_USER', 'postgres');
     define('DB_PASS', 'Yanuric09'); // Change to your password
     ```

## Running the Server

1. Open PowerShell or Command Prompt
2. Navigate to the project root directory:
   ```powershell
   cd "A:\Postgre Project"
   ```
3. Start the PHP development server:
   ```powershell
   php -S localhost:8000 -t backend
   ```
4. The server will start at `http://localhost:8000`

## API Endpoints

### Register User
- **URL**: `/register.php`
- **Method**: `POST`
- **Body**:
  ```json
  {
      "email": "user@example.com",
      "password": "password123"
  }
  ```

### Login User
- **URL**: `/login.php`
- **Method**: `POST`
- **Body**:
  ```json
  {
      "email": "user@example.com",
      "password": "password123"
  }
  ```

## Testing the API

You can test the API using:
1. Postman
2. cURL
3. Frontend application

Example cURL command:
```bash
curl -X POST http://localhost:8000/register.php \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password123"}'
```

## Troubleshooting

1. **Connection Issues**
   - Verify PostgreSQL is running
   - Check database credentials in `config.php`
   - Ensure database and table exist

2. **PHP Errors**
   - Check PHP error logs
   - Verify PHP PostgreSQL extensions are enabled
   - Make sure PHP version is 8.2 or higher

3. **Port Issues**
   - If port 8000 is in use, use a different port:
     ```powershell
     php -S localhost:8080 -t backend
     ```
   - Remember to update frontend API URL if port changes 