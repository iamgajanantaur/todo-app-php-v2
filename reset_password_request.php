<?php
require_once 'config.php';

if (isLoggedIn()) {
    redirect('index.php');
}

$title = "Reset Password";
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
</style>

<div class="login-container">
    <div class="login-card card">
        <div class="card-header login-header bg-primary text-white">
            <h4 class="mb-0 text-center"><i class="bi bi-key me-2"></i>Reset Password</h4>
        </div>
        <div class="card-body login-body">
            <p class="text-muted mb-4">Enter your username to receive a password reset link.</p>
            
            <form method="POST" action="send_reset_link.php">
                <div class="mb-4">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="username" name="username" required 
                               placeholder="Enter your username">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                    <i class="bi bi-send me-2"></i> Send Reset Link
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
<?php
$content = ob_get_clean();
require 'base.html.php';
?>
