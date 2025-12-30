<?php
require_once 'config.php';

if (isLoggedIn()) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    
    $conn = getDBConnection();
    
    // Check if user exists
    $stmt = mysqli_prepare($conn, "SELECT id, username FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    if ($user) {
        // Generate a unique reset token
        $reset_token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid for 1 hour
        
        // Store reset token in database
        $stmt = mysqli_prepare($conn, 
            "INSERT INTO password_resets (user_id, reset_token, expires_at) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iss", $user['id'], $reset_token, $expires_at);
        
        if (mysqli_stmt_execute($stmt)) {
            // In a real application, you would send an email here
            // For demo purposes, we'll show the reset link on screen
            $reset_link = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 
                         "/reset_password.php?token=" . $reset_token;
            
            flashMessage("Password reset link generated! (Demo: <a href='$reset_link' class='text-white'>Click here to reset</a>)", 'success');
        } else {
            flashMessage("Failed to generate reset token.", 'error');
        }
        mysqli_stmt_close($stmt);
    } else {
        flashMessage("Username not found.", 'error');
    }
    
    redirect('login.php');
} else {
    redirect('reset_password_request.php');
}
?>
