<?php
error_reporting(0);
session_start();

// When a user selects a login type, we clear the old session and set a new, simple flag.
if (isset($_POST['admin'])) {
    session_unset(); // Clear any old session data
    $_SESSION['login_type_selected'] = 'admin';
    header("Location: login.php");
    exit();
}

if (isset($_POST['teacher'])) {
    session_unset(); // Clear any old session data
    $_SESSION['login_type_selected'] = 'teacher';
    header("Location: login.php");
    exit();
}


// Get any error messages
$message = "";
if (isset($_GET['reply'])) {
    $message = htmlspecialchars($_GET['reply']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal - School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --card-shadow: 0 15px 35px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: var(--primary-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="1000,0 1000,100 0,100"/></svg>');
            background-size: cover;
        }
        
        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(102, 126, 234, 0.3) 0%, transparent 50%),
                       radial-gradient(circle at 70% 80%, rgba(118, 75, 162, 0.2) 0%, transparent 50%);
        }
        
        .portal-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            box-shadow: var(--card-shadow), 0 0 40px rgba(102, 126, 234, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 750px;
            position: relative;
            z-index: 2;
            text-align: center;
            animation: slideUp 0.8s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .portal-header {
            margin-bottom: 3rem;
        }
        
        .portal-icon {
            width: 100px;
            height: 100px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            margin: 0 auto 2rem auto;
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
        }
        
        .portal-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
        }
        
        .portal-subtitle {
            color: #718096;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        
        .login-options {
            display: flex;
            flex-direction: row;
            gap: 1.5rem;
            justify-content: space-between;
        }
        
        .login-option {
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            padding: 1.5rem;
            transition: var(--transition);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            flex: 1;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border-color: #667eea;
            text-decoration: none;
            color: inherit;
        }
        
        .login-option:active {
            transform: translateY(-2px);
            transition: all 0.1s ease;
        }
        
        .login-option.loading {
            opacity: 0.7;
            cursor: not-allowed;
            pointer-events: none;
        }
        
        .admin-option {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }
        
        .admin-option:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.2) 100%);
        }
        
        .teacher-option {
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.1) 0%, rgba(0, 242, 254, 0.1) 100%);
        }
        
        .teacher-option:hover {
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.2) 0%, rgba(0, 242, 254, 0.2) 100%);
        }
        
        .option-icon {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: white;
            margin: 0 auto 1rem auto;
        }
        
        .admin-icon {
            background: var(--primary-gradient);
        }
        
        .teacher-icon {
            background: var(--secondary-gradient);
        }
        
        .option-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        
        .option-description {
            color: #718096;
            font-size: 0.85rem;
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }
        
        .error-message {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            padding: 1rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            font-weight: 500;
        }
        
        .back-link {
            margin-top: 2rem;
        }
        
        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .back-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        
        .login-option .btn-loading {
            opacity: 0.8;
            cursor: not-allowed;
        }
        
        .login-option .btn-loading .option-icon {
            animation: pulse 1.5s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .login-option:focus {
            outline: 3px solid rgba(102, 126, 234, 0.3);
            outline-offset: 2px;
        }
        
        .option-icon {
            transition: var(--transition);
        }
        
        .login-option:hover .option-icon {
            transform: scale(1.1);
        }
        
        @media (max-width: 768px) {
            .portal-container {
                margin: 1rem;
                padding: 1.5rem;
                border-radius: 20px;
                max-width: 95%;
            }
            
            .portal-title {
                font-size: 1.8rem;
            }
            
            .portal-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }
            
            .login-options {
                flex-direction: column;
                gap: 1rem;
            }
            
            .login-option {
                padding: 1.2rem;
                min-height: auto;
            }
            
            .option-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }
            
            .option-title {
                font-size: 1.1rem;
            }
            
            .option-description {
                font-size: 0.8rem;
            }
        }
                font-size: 1.5rem;
            }
        }
        
        .animate-fade-up {
            animation: fadeUp 0.6s ease-out;
        }
        
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="portal-container animate-fade-up">
        <div class="portal-header">
            <div class="portal-icon">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <h1 class="portal-title">Welcome</h1>
            <p class="portal-subtitle">
                Choose your login type to access the School Management System
            </p>
        </div>
        
        <?php if (!empty($message)): ?>
            <div class="error-message">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="login-options">
                <button type="submit" name="admin" class="login-option admin-option">
                    <div class="option-icon admin-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    <h3 class="option-title">Administrator</h3>
                    <p class="option-description">
                        Complete system control: manage students, staff, fees, classes, reports, and all administrative functions.
                    </p>
                    <small class="text-muted"><i class="bi bi-shield-check me-1"></i>Requires admin privileges</small>
                </button>
                
                <button type="submit" name="teacher" class="login-option teacher-option">
                    <div class="option-icon teacher-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <h3 class="option-title">Teacher</h3>
                    <p class="option-description">
                        Teacher portal access: view students, track attendance, manage your classes, and handle teaching duties.
                    </p>
                    <small class="text-muted"><i class="bi bi-mortarboard me-1"></i>Teacher account required</small>
                </button>
            </div>
        </form>
        
        <div class="back-link">
            <a href="admin_index.php?id=1">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Homepage
            </a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add loading states to buttons
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const buttons = document.querySelectorAll('.login-option');
            
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    // Add loading state
                    this.classList.add('loading');
                    
                    // Show loading text
                    const title = this.querySelector('.option-title');
                    const originalText = title.textContent;
                    title.innerHTML = '<i class="bi bi-arrow-clockwise spin me-2"></i>Loading...';
                    
                    // Add spin animation
                    const style = document.createElement('style');
                    style.textContent = `
                        .spin {
                            animation: spin 1s linear infinite;
                        }
                        @keyframes spin {
                            from { transform: rotate(0deg); }
                            to { transform: rotate(360deg); }
                        }
                    `;
                    document.head.appendChild(style);
                    
                    // Submit form after brief delay for visual feedback
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                });
            });
        });
    </script>
</body>
</html>