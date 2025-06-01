// API endpoint configuration
const API_BASE_URL = 'http://localhost:8000';

function showMessage(message, isError = false) {
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = message;
    messageDiv.className = `message ${isError ? 'error' : 'success'}`;
    messageDiv.style.display = 'block';
}

// Form submission handler
async function handleSubmit(event, endpoint) {
    event.preventDefault();
    
    const form = event.target;
    const email = form.email.value;
    const password = form.password.value;
    
    try {
        const response = await fetch(`${API_BASE_URL}/${endpoint}.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email, password })
        });
        
        const data = await response.json();
        
        if (response.ok) {
            showMessage(data.message);
            if (endpoint === 'login') {
                // Store user ID in localStorage (for demo purposes)
                localStorage.setItem('userId', data.user_id);
                // Redirect to a success page or dashboard
                setTimeout(() => {
                    window.location.href = 'dashboard.html';
                }, 1500);
            } else {
                // For registration, redirect to login page
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 1500);
            }
        } else {
            showMessage(data.message, true);
        }
    } catch (error) {
        showMessage('An error occurred. Please try again.', true);
        console.error('Error:', error);
    }
}

// Form validation
function validateForm(form) {
    const email = form.email.value;
    const password = form.password.value;
    
    if (!email || !password) {
        showMessage('Please fill in all fields', true);
        return false;
    }
    
    if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        showMessage('Please enter a valid email address', true);
        return false;
    }
    
    if (password.length < 6) {
        showMessage('Password must be at least 6 characters long', true);
        return false;
    }
    
    return true;
} 