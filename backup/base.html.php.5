<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App - <?php echo $title ?? 'My Tasks'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
        }
        
        body {
            display: flex;
            flex-direction: column;
        }
        
        .container {
            flex: 1 0 auto;
            padding-bottom: 20px;
        }
        
        footer {
            flex-shrink: 0;
            width: 100%;
        }
        
        :root {
            --primary-color: #6c63ff;
            --secondary-color: #4d44db;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }
        
        .task-item {
            transition: background-color 0.2s ease;
        }
        
        .task-item:hover {
            background-color: #f8f9fa;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .completed-task {
            text-decoration: line-through;
            color: #6c757d;
        }
        
        .task-actions .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .filter-btns .btn {
            margin-right: 5px;
        }
        
        /* Enhanced Logo styles - REDUCED SIZE */
        .navbar-logo {
            height: 28px;
            width: auto;
            margin-right: 10px;
            border-radius: 4px;
            object-fit: contain;
        }
        
        .brand-container {
            display: flex;
            align-items: center;
            height: 100%;
        }
        
        .brand-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff !important;
            padding-left: 8px;
            border-left: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Make navbar shorter - REDUCED HEIGHT */
        .navbar {
            min-height: 35px;
            padding: 5px 0;
        }
        
        .navbar-nav .nav-link {
            font-size: 0.9rem;
        }
        
        /* Notification System */
        .notification-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            max-width: 350px;
            width: 100%;
            pointer-events: none;
        }
        
        .notification {
            pointer-events: auto;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-left: 4px solid transparent;
            animation: slideInRight 0.3s ease forwards, fadeOut 0.5s ease 1.7s forwards;
            transform: translateX(120%);
            opacity: 0;
        }
        
        .notification.success {
            border-left-color: #28a745;
        }
        
        .notification.danger {
            border-left-color: #dc3545;
        }
        
        .notification.warning {
            border-left-color: #ffc107;
        }
        
        .notification.info {
            border-left-color: #17a2b8;
        }
        
        @keyframes slideInRight {
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(100%);
                margin-bottom: -50px;
                height: 0;
                padding: 0;
                border: 0;
            }
        }
        
        .notification-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            border-radius: 4px;
        }
        
        .notification-message {
            flex-grow: 1;
            margin-right: 10px;
            font-size: 0.95rem;
        }
        
        .notification-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            line-height: 1;
            padding: 0;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s;
        }
        
        .notification-close:hover {
            opacity: 1;
        }
        
        /* Progress bar for notifications */
        .notification-progress {
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 0 0 4px 4px;
            overflow: hidden;
            margin-top: -3px;
        }
        
        .notification-progress-bar {
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            animation: progressBar 2s linear forwards;
            transform-origin: left;
        }
        
        @keyframes progressBar {
            from {
                transform: scaleX(1);
            }
            to {
                transform: scaleX(0);
            }
        }
        
        /* For smaller screens */
        @media (max-width: 768px) {
            .notification-container {
                top: 70px;
                right: 10px;
                left: 10px;
                max-width: none;
            }
            
            .navbar-logo {
                height: 22px;
                margin-right: 5px;
            }
            
            .brand-text {
                font-size: 1rem;
                padding-left: 5px;
            }
            
            .navbar {
                min-height: 30px;
            }
        }
        
        /* Extra small screens */
        @media (max-width: 576px) {
            .notification-container {
                top: 65px;
            }
            
            .navbar-logo {
                height: 20px;
                margin-right: 4px;
            }
            
            .brand-text {
                font-size: 0.9rem;
                padding-left: 4px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3 py-1">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div class="brand-container">
                    <!-- Logo Image from images folder -->
                    <img src="images/sunbeam.jpg" 
                         alt="Sunbeam Institute Logo" 
                         class="navbar-logo">
                    <!-- App Name -->
                    <span class="brand-text">TodoApp</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isLoggedIn()): ?>
                    <li class="nav-item">
                        <span class="nav-link text-light" style="padding: 0.2rem 0.5rem;">Hello, <?php echo htmlspecialchars(getCurrentUsername()); ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="padding: 0.2rem 0.5rem;">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" style="padding: 0.2rem 0.5rem;">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php" style="padding: 0.2rem 0.5rem;">Register</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Notification Container -->
    <div class="notification-container" id="notificationContainer"></div>

    <div class="container">
        <?php echo $content ?? ''; ?>
    </div>

    <footer class="mt-auto py-2 bg-dark text-white">
        <div class="container text-center">
            <p class="mb-0" style="font-size: 0.85rem;">© <?php echo date('Y'); ?> SunBeam Infotech Pvt. Ltd. - TodoApp. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Notification system
    document.addEventListener('DOMContentLoaded', function() {
        const notificationContainer = document.getElementById('notificationContainer');
        let notificationQueue = [];
        let isShowingNotification = false;
        
        // Function to show a notification
        function showNotification(message, type = 'success') {
            // Add to queue
            notificationQueue.push({ message, type });
            
            // If not currently showing a notification, show the next one
            if (!isShowingNotification) {
                showNextNotification();
            }
        }
        
        // Function to show the next notification in the queue
        function showNextNotification() {
            if (notificationQueue.length === 0) {
                isShowingNotification = false;
                return;
            }
            
            isShowingNotification = true;
            const { message, type } = notificationQueue.shift();
            
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            // Determine background color based on type
            let bgColor;
            switch(type) {
                case 'danger': bgColor = '#dc3545'; break;
                case 'warning': bgColor = '#ffc107'; break;
                case 'info': bgColor = '#17a2b8'; break;
                default: bgColor = '#28a745'; break;
            }
            
            notification.innerHTML = `
                <div class="notification-content" style="background-color: ${bgColor}; color: white;">
                    <div class="notification-message">${message}</div>
                    <button class="notification-close text-white" onclick="this.closest('.notification').remove(); checkQueue();">×</button>
                </div>
                <div class="notification-progress">
                    <div class="notification-progress-bar"></div>
                </div>
            `;
            
            // Add to container
            notificationContainer.appendChild(notification);
            
            // Auto remove after 2 seconds (1 second for fade out animation)
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
                showNextNotification();
            }, 2000);
        }
        
        // Make checkQueue available globally for the close button
        window.checkQueue = function() {
            setTimeout(showNextNotification, 100);
        };
        
        // Check for flash messages from PHP
        <?php
        $flashMessages = getFlashMessages();
        if (!empty($flashMessages)) {
            echo "// Flash messages from PHP\n";
            foreach ($flashMessages as $flash) {
                $alertClass = $flash['type'] == 'error' ? 'danger' : ($flash['type'] == 'warning' ? 'warning' : 'success');
                $message = addslashes($flash['message']);
                echo "showNotification('{$message}', '{$alertClass}');\n";
            }
        }
        ?>
        
        // Intercept form submissions to show notifications
        document.addEventListener('submit', function(e) {
            // Check if it's a task form
            if (e.target.querySelector('input[name="task_name"]')) {
                // We'll handle the notification on the server side via flash messages
                return;
            }
        });
    });
    </script>
</body>
</html>
