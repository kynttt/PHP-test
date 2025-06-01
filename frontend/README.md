# Frontend Authentication System

This is the frontend part of the authentication system, built with vanilla HTML, CSS, and JavaScript.

## Prerequisites

1. A modern web browser (Chrome, Firefox, Safari, or Edge)
2. Backend server running (see backend/README.md)
3. Local web server (optional, but recommended)

## Project Structure

```
frontend/
├── styles.css      # Common styles
├── script.js       # Common JavaScript functions
├── signup.html     # Registration page
├── login.html      # Login page
└── dashboard.html  # Dashboard page (after login)
```

## Running the Frontend

### Method 1: Direct File Opening
Simply open any of the HTML files in your browser:
- `signup.html` - For user registration
- `login.html` - For user login
- `dashboard.html` - For viewing after successful login

### Method 2: Using a Local Server (Recommended)
You can use any of these methods to serve the frontend files:

1. **Using Python (if installed)**
   ```powershell
   # Python 3
   python -m http.server 3000
   ```
   Then visit: `http://localhost:3000`

2. **Using Node.js (if installed)**
   ```powershell
   # Install http-server globally
   npm install -g http-server
   
   # Run server
   http-server -p 3000
   ```
   Then visit: `http://localhost:3000`

3. **Using PHP (if installed)**
   ```powershell
   php -S localhost:3000 -t frontend
   ```
   Then visit: `http://localhost:3000`

## Configuration

If you're running the backend on a different port or URL, update the API base URL in `script.js`:
```javascript
const API_BASE_URL = 'http://localhost:8000'; // Change this if needed
```

## Features

1. **User Registration**
   - Email validation
   - Password length validation
   - Success/error messages
   - Automatic redirect to login after registration

2. **User Login**
   - Email validation
   - Password verification
   - Success/error messages
   - Automatic redirect to dashboard after login

3. **Dashboard**
   - Displays user ID
   - Logout functionality
   - Session management using localStorage

## Testing

1. **Registration Flow**
   - Open `signup.html`
   - Enter email and password
   - Submit form
   - Should redirect to login page on success

2. **Login Flow**
   - Open `login.html`
   - Enter registered email and password
   - Submit form
   - Should redirect to dashboard on success

3. **Error Cases**
   - Try invalid email format
   - Try short password
   - Try non-existent user login
   - Try wrong password

## Troubleshooting

1. **CORS Issues**
   - Ensure backend CORS headers are properly set
   - Check if backend server is running
   - Verify API base URL in `script.js`

2. **Connection Issues**
   - Check if backend server is running
   - Verify API base URL in `script.js`
   - Check browser console for errors

3. **Form Submission Issues**
   - Check browser console for JavaScript errors
   - Verify all required fields are filled
   - Check network tab for API responses

## Browser Support

The application works in all modern browsers:
- Chrome (recommended)
- Firefox
- Safari
- Edge

## Security Notes

- This is a demo application
- Passwords are hashed on the backend
- No sensitive data is stored in localStorage
- For production, implement proper session management 