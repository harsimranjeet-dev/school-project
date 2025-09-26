<?php
    session_start();
    include("connection.php");
    
    // Get statistics
    $students_query = "SELECT COUNT(*) as total_students FROM students";
    $students_result = mysqli_query($conn, $students_query);
    $total_students = mysqli_fetch_assoc($students_result)['total_students'] ?? 0;
    
    $classes_query = "SELECT COUNT(*) as total_classes FROM classes";
    $classes_result = mysqli_query($conn, $classes_query);
    $total_classes = mysqli_fetch_assoc($classes_result)['total_classes'] ?? 0;
    
    $users_query = "SELECT COUNT(*) as total_users FROM users";
    $users_result = mysqli_query($conn, $users_query);
    $total_users = mysqli_fetch_assoc($users_result)['total_users'] ?? 0;
    
    $transactions_query = "SELECT COUNT(*) as total_transactions FROM transection";
    $transactions_result = mysqli_query($conn, $transactions_query);
    $total_transactions = mysqli_fetch_assoc($transactions_result)['total_transactions'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #fcb045 0%, #fd1d1d 100%);
            --card-shadow: 0 8px 25px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .hero-section {
            background: var(--primary-gradient);
            color: white;
            padding: 4rem 0 2rem 0;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="1000,0 1000,100 0,100"/></svg>');
            background-size: cover;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .stats-card {
            background: white;
            border-radius: 20px;
            border: none;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
            height: 100%;
        }
        
        .stats-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .stats-card .card-body {
            padding: 2rem;
            position: relative;
        }
        
        .stats-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 1.5rem;
        }
        
        .stats-icon.students {
            background: var(--primary-gradient);
        }
        
        .stats-icon.classes {
            background: var(--secondary-gradient);
        }
        
        .stats-icon.users {
            background: var(--success-gradient);
        }
        
        .stats-icon.transactions {
            background: var(--warning-gradient);
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        
        .stats-label {
            color: #718096;
            font-weight: 500;
            font-size: 1.1rem;
        }
        
        .quick-actions {
            background: white;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .action-btn {
            background: var(--primary-gradient);
            border: none;
            border-radius: 15px;
            color: white;
            padding: 1rem 2rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
            margin: 0.5rem;
        }
        
        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .welcome-text {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        @media (max-width: 768px) {
            .welcome-text {
                font-size: 2rem;
            }
            
            .hero-section {
                padding: 2rem 0 1rem 0;
            }
            
            .stats-card .card-body {
                padding: 1.5rem;
            }
            
            .stats-number {
                font-size: 2rem;
            }
            
            .action-btn {
                padding: 0.8rem 1.5rem;
                font-size: 0.9rem;
                display: block;
                text-align: center;
                margin: 0.5rem 0;
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
    <div class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="welcome-text animate-fade-up">Welcome to Admin Panel</h1>
                <p class="subtitle animate-fade-up">Manage your school operations efficiently and effectively</p>
                <?php if(isset($_SESSION['user_nm'])): ?>
                    <div class="alert alert-light d-inline-block" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3); color: white;">
                        <i class="bi bi-person-circle me-2"></i>
                        Logged in as: <strong><?php echo $_SESSION['user_nm']; ?></strong>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="container">
        <!-- Logout Success Message -->
        <?php if(isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none; color: white; border-radius: 15px; margin-bottom: 2rem;">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Logged out successfully!</strong> Thank you for using the School Management System.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card stats-card animate-fade-up">
                    <div class="card-body text-center">
                        <div class="stats-icon students mx-auto">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="stats-number"><?php echo $total_students; ?></div>
                        <div class="stats-label">Total Students</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card stats-card animate-fade-up" style="animation-delay: 0.1s;">
                    <div class="card-body text-center">
                        <div class="stats-icon classes mx-auto">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="stats-number"><?php echo $total_classes; ?></div>
                        <div class="stats-label">Total Classes</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card stats-card animate-fade-up" style="animation-delay: 0.2s;">
                    <div class="card-body text-center">
                        <div class="stats-icon users mx-auto">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div class="stats-number"><?php echo $total_users; ?></div>
                        <div class="stats-label">System Users</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card stats-card animate-fade-up" style="animation-delay: 0.3s;">
                    <div class="card-body text-center">
                        <div class="stats-icon transactions mx-auto">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <div class="stats-number"><?php echo $total_transactions; ?></div>
                        <div class="stats-label">Transactions</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="quick-actions animate-fade-up" style="animation-delay: 0.4s;">
            <h3 class="mb-4 text-center" style="color: #2d3748; font-weight: 600;">
                <i class="bi bi-lightning-fill me-2" style="color: #667eea;"></i>
                Quick Actions
            </h3>
            
            <div class="text-center">
                <a href="students_reg.php" class="action-btn">
                    <i class="bi bi-person-plus me-2"></i>Add New Student
                </a>
                
                <a href="students_li.php" class="action-btn">
                    <i class="bi bi-list-ul me-2"></i>View Students
                </a>
                
                <a href="student_transec.php" class="action-btn">
                    <i class="bi bi-calculator me-2"></i>Fee Calculator
                </a>
                
                <a href="filter.php" class="action-btn">
                    <i class="bi bi-search me-2"></i>Transaction History
                </a>
                
                <a href="user_func.php" class="action-btn">
                    <i class="bi bi-gear me-2"></i>User Management
                </a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>