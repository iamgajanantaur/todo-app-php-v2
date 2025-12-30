<?php
require_once 'config.php';

if (isLoggedIn()) {
    redirect('index.php');
}

$token = $_GET['token'] ?? '';

$conn = getDBConnection();
$valid_token = false;
$user_id = null;

// Validate token
if (!empty($token)) {
    $stmt = mysqli_prepare($conn, 
        "SELECT user_id FROM password_resets WHERE reset_token = ? AND expires_at > NOW() AND used = 0");
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    
    if ($user_id) {
        $valid_token = true;
    }
}

if (!$valid_token) {
    flashMessage("Invalid or expired reset token.", 'error');
    redirect('login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($new_password !== $confirm_password) {
        flashMessage("Passwords do not match.", 'error');
    } elseif (strlen($new_password) < 6) {
        flashMessage("Password must be at least 6 characters.", 'error');
    } else {
        // Update password
        $hashed_pw = password_hash($new_password, PASSWORD_DEFAULT);
        
        $stmt = mysqli_prepare($conn, 
            "UPDATE users SET password_hash = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $hashed_pw, $user_id);
        
        if (mysqli_stmt_execute($stmt)) {
            // Mark token as used
            $stmt2 = mysqli_prepare($conn, 
                "UPDATE password_resets SET used = 1 WHERE reset_token = ?");
            mysqli_stmt_bind_param($stmt2, "s", $token);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
            
            flashMessage("Password reset successfully! You can now login with your new password.", 'success');
            redirect('login.php');
        } else {
            flashMessage("Failed to reset password.", 'error');
        }
        mysqli_stmt_close($stmt);
    }
}

$title = "Set New Password";
ob_start();
?>
<style>
    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 150px);
    }
    
    .login-card {
        width: 100%;
        max-width: 400px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        border: none;
    }
    
    .login-header {
        border-radius: 10px 10px 0 0 !important;
        padding: 1.2rem 1.5rem;
    }
    
    .login-body {
        padding: 1.5rem;
    }
    
    .password-hint {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .password-toggle {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-left: none;
        cursor: pointer;
        padding: 0.375rem 0.75rem;
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 45px;
    }
    
    .password-toggle:hover {
        background-color: #e9ecef;
    }
    
    .password-toggle i {
        font-size: 1rem;
        color: #6c757d;
    }
</style>

<div class="login-container">
    <div class="login-card card">
        <div class="card-header login-header bg-primary text-white">
            <h4 class="mb-0 text-center"><i class="bi bi-key me-2"></i>Set New Password</h4>
        </div>
        <div class="card-body login-body">
            <form method="POST" id="resetForm">
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="new_password" name="new_password" required 
                               placeholder="Enter new password (min. 6 characters)">
                        <span class="input-group-text password-toggle" id="toggleNewPassword">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    <div class="password-hint mt-1">
                        <small>
                            <i class="bi bi-info-circle me-1"></i>
                            Must be at least 6 characters
                        </small>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required 
                               placeholder="Confirm new password">
                        <span class="input-group-text password-toggle" id="toggleConfirmPassword">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                    <i class="bi bi-check-circle me-2"></i> Reset Password
                </button>
            </form>
            <div class="text-center mt-3">
                <p class="mb-0">
                    <a href="login.php" class="text-decoration-none fw-semibold">
                        <i class="bi bi-arrow-left me-1"></i>Back to Login
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to toggle password visibility
    function setupPasswordToggle(toggleId, inputId) {
        const toggleElement = document.getElementById(toggleId);
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = toggleElement.querySelector('i');
        
        toggleElement.addEventListener('click', function() {
            // Toggle the password field type
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle the eye icon
            if (type === 'text') {
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
                toggleElement.title = "Hide password";
            } else {
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
                toggleElement.title = "Show password";
            }
        });
    }
    
    // Setup both password toggles
    setupPasswordToggle('toggleNewPassword', 'new_password');
    setupPasswordToggle('toggleConfirmPassword', 'confirm_password');
});
</script>
<?php
$content = ob_get_clean();
require 'base.html.php';
?>
