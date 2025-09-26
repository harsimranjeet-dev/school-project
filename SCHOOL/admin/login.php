<?php
// Enable error reporting for development (disable in production)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();

// Include database connection
if (!file_exists("connection.php")) {
    die("Database connection file not found.");
}
include "connection.php";

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$loginTypeMap = [
    'admin' => [
        'title' => 'Admin',
        'tagline' => 'Complete administrative control and system management',
        'icon' => 'bi-mortarboard-fill',
        'redirect' => 'admin_index.php?id=1'
    ],
    'teacher' => [
        'title' => 'Teacher',
        'tagline' => 'Access your teaching dashboard and student management tools',
        'icon' => 'bi-person-badge-fill',
        'redirect' => 'admin_index.php?id=1&type=teacher'
    ]
];

$selectedType = strtolower($_SESSION['login_type_selected'] ?? '');
if ($selectedType === '' || !isset($loginTypeMap[$selectedType])) {
    unset($_SESSION['login_type_selected']);
    header("Location: logind.php");
    exit();
}

// Already logged in? send to appropriate dashboard
if (!empty($_SESSION['user_nm']) && !empty($_SESSION['user_type'])) {
    $existingType = strtolower($_SESSION['user_type']);
    if (isset($loginTypeMap[$existingType])) {
        header("Location: " . $loginTypeMap[$existingType]['redirect']);
    } else {
        header("Location: admin_index.php");
    }
    exit();
}

$message = $_SESSION['auth_error'] ?? '';
unset($_SESSION['auth_error']);

$portal_title = $loginTypeMap[$selectedType]['title'];
$portal_tagline = $loginTypeMap[$selectedType]['tagline'];
$logo_icon = $loginTypeMap[$selectedType]['icon'];
$is_teacher_view = ($selectedType === 'teacher');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['user'] ?? '');
    $password_input = trim($_POST['password'] ?? '');

    if ($username === '' || $password_input === '') {
        $_SESSION['auth_error'] = "Please enter both username and password.";
        header("Location: login.php");
        exit();
    }

    $query = "SELECT username, password, privilege, email FROM users WHERE username = ? AND LOWER(privilege) = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $selectedType);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {
            $user_record = mysqli_fetch_assoc($result);

            if ($password_input === $user_record['password']) {
                session_regenerate_id(true);

                $_SESSION['user_nm'] = $user_record['username'];
                $_SESSION['user_email'] = $user_record['email'] ?? '';
                $_SESSION['user_type'] = strtolower($user_record['privilege']);
                $_SESSION['login_time'] = time();

                unset($_SESSION['login_type_selected']);
                unset($_SESSION['auth_error']);

                $redirectTarget = $loginTypeMap[$_SESSION['user_type']]['redirect'] ?? 'admin_index.php';
                header("Location: " . $redirectTarget);
                exit();
            }
        }

        mysqli_stmt_close($stmt);
        $_SESSION['auth_error'] = "Invalid credentials. Please check your username and password.";
    } else {
        error_log("New Auth: Database prepare statement failed: " . mysqli_error($conn));
        $_SESSION['auth_error'] = "A server error occurred. Please try again later.";
    }

    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - School Management System</title>
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
            padding: 2rem;
            position: relative;
            overflow-x: hidden;
        }
        
        .container-fluid {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(102, 126, 234, 0.3) 0%, transparent 50%),
                       radial-gradient(circle at 80% 20%, rgba(118, 75, 162, 0.2) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            box-shadow: var(--card-shadow), 0 0 60px rgba(102, 126, 234, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 700px;
            min-height: auto;
            position: relative;
            z-index: 2;
            animation: slideInUp 0.8s ease-out;
        }
        
        @media (min-width: 1200px) {
            .login-container {
                max-width: 800px;
            }
        }
        
        @media (min-width: 1400px) {
            .login-container {
                max-width: 900px;
            }
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .login-card {
            padding: 4rem 4rem 3rem 4rem;
            text-align: center;
            position: relative;
            max-width: 100%;
        }
        
        @media (min-width: 992px) {
            .login-card {
                padding: 4rem 6rem;
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                gap: 4rem;
                text-align: center;
                min-height: 500px;
            }
            
            .login-left-content {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            
            .login-form-content {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                max-width: 400px;
            }
            
            .form-section {
                width: 100%;
            }
        }
        
        .login-header {
            margin-bottom: 2.5rem;
        }
        
        .logo-container {
            width: 120px;
            height: 120px;
            background: var(--primary-gradient);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            color: white;
            margin: 0 auto 2rem auto;
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.4);
            transform: rotate(-5deg);
            transition: var(--transition);
        }
        
        @media (max-width: 991px) {
            .logo-container {
                width: 100px;
                height: 100px;
                font-size: 3rem;
                border-radius: 25px;
                margin-bottom: 1.5rem;
            }
        }
        
        .logo-container:hover {
            transform: rotate(0deg) scale(1.05);
        }
        
        .logo-container.teacher {
            background: var(--secondary-gradient);
            box-shadow: 0 15px 40px rgba(79, 172, 254, 0.4);
        }
        
        .brand-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.8rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .brand-subtitle {
            color: #718096;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
        
        .login-title {
            font-size: 2.6rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.8rem;
        }
        
        .login-subtitle {
            color: #718096;
            margin-bottom: 2.5rem;
            font-size: 1.2rem;
            line-height: 1.6;
        }
        
        @media (max-width: 991px) {
            .brand-title {
                font-size: 1.8rem;
            }
            
            .brand-subtitle {
                font-size: 0.95rem;
            }
            
            .login-title {
                font-size: 2.2rem;
            }
            
            .login-subtitle {
                font-size: 1rem;
            }
        }
        
        .form-floating {
            margin-bottom: 2rem;
            position: relative;
        }
        
        .form-floating > .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            padding: 2rem 1.5rem 1rem;
            height: auto;
            font-size: 1.1rem;
            transition: var(--transition);
            background: rgba(247, 250, 252, 0.8);
            backdrop-filter: blur(5px);
        }
        
        @media (max-width: 991px) {
            .form-floating > .form-control {
                padding: 1.8rem 1.2rem 0.8rem;
                font-size: 1rem;
                border-radius: 18px;
            }
        }
        
        .form-floating > .form-control:hover {
            border-color: #cbd5e0;
            background: rgba(247, 250, 252, 1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .form-floating > .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15), 0 5px 20px rgba(102, 126, 234, 0.1);
            outline: none;
            background: white;
        }
        
        .form-floating > label {
            pointer-events: none;
            transform-origin: 0 0;
            transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
            color: #a0aec0;
            font-weight: 500;
            padding-left: 0.2rem;
        }
        
        .login-btn {
            background: var(--primary-gradient);
            border: none;
            border-radius: 20px;
            padding: 1.4rem;
            font-weight: 600;
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            color: white;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        @media (max-width: 991px) {
            .login-btn {
                padding: 1.2rem;
                font-size: 1.1rem;
                border-radius: 18px;
            }
        }
        
        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .login-btn:hover::before {
            left: 100%;
        }
        
        .login-btn:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
            color: white;
            outline: none;
        }
        
        .login-btn:active {
            transform: translateY(0);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }
        
        .login-btn.loading {
            opacity: 0.8;
            cursor: not-allowed;
            pointer-events: none;
        }
        
        .login-btn.loading i {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .error-alert {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            border: none;
            border-radius: 15px;
            color: white;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }
        
        .back-link {
            margin-top: 2.5rem;
            text-align: center;
        }
        
        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        
        .back-link a:hover {
            color: #764ba2;
            text-decoration: none;
        }
        
        .error-alert {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            border: none;
            border-radius: 15px;
            color: white;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .back-link {
            text-align: center;
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
        
        @media (max-width: 991px) {
            .login-card {
                padding: 3rem 2rem;
            }
            
            .login-left-content .login-header {
                margin-bottom: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .login-container {
                margin: 0;
                border-radius: 25px;
                min-height: auto;
                max-width: 100%;
            }
            
            .login-card {
                padding: 2.5rem 2rem;
            }
            
            .logo-container {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
                border-radius: 20px;
            }
            
            .brand-title {
                font-size: 1.5rem;
            }
            
            .login-title {
                font-size: 1.8rem;
            }
            
            .form-floating > .form-control {
                padding: 1.5rem 1rem 0.6rem;
                font-size: 16px; /* Prevent zoom on iOS */
                border-radius: 15px;
            }
            
            .login-btn {
                padding: 1.2rem;
                font-size: 1rem;
                border-radius: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .login-container {
                margin: 0;
                border-radius: 20px;
            }
            
            .login-card {
                padding: 2rem 1.5rem;
            }
            
            .back-link .d-flex {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
            }
            50% { 
                transform: translateY(-10px) rotate(2deg); 
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Additional enhancement styles */
        .form-floating > .form-control:valid {
            border-color: #48bb78;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: var(--primary-gradient);
            border-radius: 32px;
            z-index: -1;
            opacity: 0.2;
            animation: borderGlow 4s ease-in-out infinite alternate;
        }
        
        @keyframes borderGlow {
            0% { opacity: 0.2; }
            100% { opacity: 0.4; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="login-container">
                    <div class="login-card animate-fade-in">
                        <!-- Left Content Section -->
                        <div class="login-left-content">
                            <div class="login-header">
                                <div class="logo-container<?php echo $is_teacher_view ? ' teacher' : ''; ?>">
                                    <i class="bi <?php echo $logo_icon; ?>"></i>
                                </div>
                                <h3 class="brand-title">School Management System</h3>
                                <p class="brand-subtitle">Professional Education Platform</p>
                            </div>
                        </div>
                        
                        <!-- Right Content Section -->
                        <div class="login-form-content">
                            <div class="form-section">
                                <h2 class="login-title"><?php echo $portal_title; ?> Portal</h2>
                                <p class="login-subtitle"><?php echo $portal_tagline; ?></p>
                                
                                <?php if (!empty($message)): ?>
                                    <div class="alert error-alert" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        <?php echo htmlspecialchars($message); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <form method="POST" action="" novalidate>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="user" name="user" placeholder="Username" required autocomplete="username">
                                        <label for="user">
                                            <i class="bi bi-person me-2"></i>Username
                                        </label>
                                    </div>
                                    
                                    <div class="form-floating mb-4">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                                        <label for="password">
                                            <i class="bi bi-lock me-2"></i>Password
                                        </label>
                                    </div>
                                    
                                    <button type="submit" name="submit" class="btn login-btn">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                                    </button>
                                </form>
                                
                                <div class="back-link">
                                    <div class="d-flex justify-content-between">
                                        <a href="logind.php">
                                            <i class="bi bi-arrow-left me-1"></i>
                                            Change Login Type
                                        </a>
                                        <a href="admin_index.php?id=1">
                                            <i class="bi bi-house me-1"></i>
                                            Main Site
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('.login-btn');
            const btnIcon = submitBtn.querySelector('i');
            const btnText = submitBtn.textContent.trim();
            
            form.addEventListener('submit', function(e) {
                // Add loading state
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
                btnIcon.className = 'bi bi-arrow-clockwise me-2';
                submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise me-2"></i>Signing In...';
                
                // Allow form to submit naturally
            });
            
            // Remove loading state if there's an error (form reloads)
            setTimeout(() => {
                if (submitBtn.classList.contains('loading')) {
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-box-arrow-in-right me-2"></i>Sign In';
                }
            }, 5000);
        });
    </script>
</body>
</html>