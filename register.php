<?php
require_once 'config.php';

if (isLoggedIn()) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (!isPasswordComplex($password)) {
        flashMessage("Password must be at least 8 characters with at least one uppercase letter and one number", 'error');
    } else {
        $conn = getDBConnection();
        $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password_hash) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_pw);
            
            if (mysqli_stmt_execute($stmt)) {
                flashMessage("Registration successful! Welcome, {$username}!", 'success');
                redirect('login.php');
            } else {
                if (mysqli_errno($conn) == 1062) { // Duplicate entry
                    flashMessage("Username '{$username}' already exists. Please choose another.", 'error');
                } else {
                    flashMessage("Registration failed. Please try again.", 'error');
                }
            }
            mysqli_stmt_close($stmt);
        } catch (Exception $e) {
            flashMessage("Registration failed. Please try again.", 'error');
        }
    }
}

$title = "Register";
ob_start();
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Register</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="form-text">Password must be at least 8 characters with uppercase and number</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-person-plus"></i> Register
                    </button>
                </form>
                <div class="mt-3 text-center">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require 'base.html.php';
?>
