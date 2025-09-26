<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --card-shadow: 0 8px 25px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .main-navbar {
            background: var(--primary-gradient);
            padding: 1rem 0;
            box-shadow: var(--card-shadow);
            border: none;
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            text-decoration: none;
        }
        
        .navbar-brand:hover {
            color: rgba(255,255,255,0.9) !important;
        }
        
        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 0.75rem 1.5rem !important;
            border-radius: 25px;
            margin: 0 0.25rem;
            transition: var(--transition);
            text-decoration: none;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white !important;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            transform: translateY(-2px);
        }
        
        .user-info {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 0.5rem 1rem;
            color: white;
            font-weight: 500;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .navbar-toggler {
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 10px;
        }
        
        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(255,255,255,0.25);
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        .mobile-user-info {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 1rem;
            margin: 1rem 0;
            color: white;
            text-align: center;
        }
        
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(255,255,255,0.1);
                backdrop-filter: blur(20px);
                border-radius: 15px;
                padding: 1rem;
                margin-top: 1rem;
            }
            
            .navbar-nav .nav-link {
                text-align: center;
                margin: 0.25rem 0;
                padding: 1rem !important;
            }
        }
        
        .brand-icon {
            margin-right: 0.5rem;
            font-size: 1.75rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg main-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="admin_index.php?id=1">
                <i class="bi bi-mortarboard-fill brand-icon"></i>
                School Management
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Mobile User Info -->
                <?php if(isset($_SESSION['user_nm']) && $_SESSION['user_nm'] != 'Guest'): ?>
                    <div class="mobile-user-info d-lg-none">
                        <i class="bi bi-person-circle me-2"></i>
                        <span><?php echo $_SESSION['user_nm']; ?></span>
                        <?php if(isset($_SESSION['login_type_selected']) && $_SESSION['login_type_selected'] == 'admin'): ?>
                            <small class="user-type text-warning ms-1">(Admin)</small>
                        <?php elseif(isset($_SESSION['login_type_selected']) && $_SESSION['login_type_selected'] == 'teacher'): ?>
                            <small class="user-type text-info ms-1">(Teacher)</small>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_index.php?id=1">
                            <i class="bi bi-house-door me-2"></i>HOME
                        </a>
                    </li>
                    
                    <?php if($_SESSION["user_nm"]=="Guest"): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_index.php?id=3">
                                <i class="bi bi-info-circle me-2"></i>ABOUT
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_index.php?id=4">
                                <i class="bi bi-box-arrow-in-right me-2"></i>LOGIN
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_index.php?id=2">
                                <i class="bi bi-people me-2"></i>USERS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_index.php?id=3">
                                <i class="bi bi-info-circle me-2"></i>ABOUT
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_index.php?id=5">
                                <i class="bi bi-box-arrow-right me-2"></i>LOGOUT
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <!-- Desktop User Info -->
                <?php if(isset($_SESSION['user_nm']) && $_SESSION['user_nm'] != 'Guest'): ?>
                    <div class="user-info d-none d-lg-block">
                        <i class="bi bi-person-circle me-2"></i>
                        <span><?php echo $_SESSION['user_nm']; ?></span>
                        <?php if(isset($_SESSION['login_type_selected']) && $_SESSION['login_type_selected'] == 'admin'): ?>
                            <small class="user-type text-warning ms-1">(Admin)</small>
                        <?php elseif(isset($_SESSION['login_type_selected']) && $_SESSION['login_type_selected'] == 'teacher'): ?>
                            <small class="user-type text-info ms-1">(Teacher)</small>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>