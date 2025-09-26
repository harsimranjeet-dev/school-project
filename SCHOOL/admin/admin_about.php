<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - School Management System</title>
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
        
        .about-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .about-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            padding: 2.5rem;
            margin-bottom: 2rem;
            transition: var(--transition);
        }
        
        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            text-align: center;
            transition: var(--transition);
            height: 100%;
            border: 2px solid transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            border-color: #667eea;
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin: 0 auto 1.5rem auto;
        }
        
        .feature-icon.students {
            background: var(--primary-gradient);
        }
        
        .feature-icon.staff {
            background: var(--secondary-gradient);
        }
        
        .feature-icon.attendance {
            background: var(--success-gradient);
        }
        
        .feature-icon.notifications {
            background: linear-gradient(135deg, #fcb045 0%, #fd1d1d 100%);
        }
        
        .feature-icon.reports {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #2d3748 !important;
        }
        
        .feature-icon.access {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
        }
        
        .feature-description {
            color: #718096;
            line-height: 1.6;
        }
        
        .back-btn {
            background: var(--success-gradient);
            border: none;
            border-radius: 15px;
            color: white;
            padding: 1rem 2rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
        }
        
        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(17, 153, 142, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .system-icon {
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 2rem auto;
            backdrop-filter: blur(10px);
        }
        
        @media (max-width: 768px) {
            .about-title {
                font-size: 2rem;
            }
            
            .hero-section {
                padding: 2rem 0 1rem 0;
            }
            
            .content-card {
                padding: 2rem;
            }
            
            .feature-card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .system-icon {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
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
                <div class="system-icon">
                    <i class="bi bi-gear-fill"></i>
                </div>
                <h1 class="about-title animate-fade-up">About This Admin Panel</h1>
                <p class="about-subtitle animate-fade-up">
                    Comprehensive School Management Solution
                </p>
            </div>
        </div>
    </div>
    
    <div class="container">
        <!-- Introduction Card -->
        <div class="content-card animate-fade-up">
            <h2 class="mb-4" style="color: #2d3748; font-weight: 600;">
                <i class="bi bi-info-circle-fill me-3" style="color: #667eea;"></i>
                Welcome to Our School Management System
            </h2>
            <p class="lead mb-4" style="color: #4a5568; line-height: 1.8;">
                Welcome to the <strong>Admin Panel</strong> of our comprehensive <strong>School Management System</strong>.
                This panel provides authorized administrators with secure and centralized access to manage all critical aspects of the school's operations.
            </p>
        </div>
        
        <!-- Key Features -->
        <div class="content-card animate-fade-up" style="animation-delay: 0.1s;">
            <h2 class="mb-4" style="color: #2d3748; font-weight: 600;">
                <i class="bi bi-star-fill me-3" style="color: #667eea;"></i>
                Key Features
            </h2>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon students">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4 class="feature-title">Student Management</h4>
                        <p class="feature-description">
                            Comprehensive student record management including admissions, personal details, academic history, and progress reports.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon staff">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <h4 class="feature-title">Staff & Teacher Data</h4>
                        <p class="feature-description">
                            Manage staff information, teacher assignments, qualifications, and performance tracking in one centralized system.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon attendance">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <h4 class="feature-title">Attendance & Performance</h4>
                        <p class="feature-description">
                            Track student attendance, monitor academic performance, and generate detailed progress reports.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon notifications">
                            <i class="bi bi-megaphone-fill"></i>
                        </div>
                        <h4 class="feature-title">Notifications</h4>
                        <p class="feature-description">
                            Send internal notifications, announcements, and important updates to students, staff, and parents.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon reports">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4 class="feature-title">Reports & Analytics</h4>
                        <p class="feature-description">
                            Generate comprehensive reports, analytics, and insights to support data-driven decision making.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon access">
                            <i class="bi bi-shield-check-fill"></i>
                        </div>
                        <h4 class="feature-title">Access Control</h4>
                        <p class="feature-description">
                            Secure user access management with role-based privileges and comprehensive security features.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Purpose Section -->
        <div class="content-card animate-fade-up" style="animation-delay: 0.2s;">
            <h2 class="mb-4" style="color: #2d3748; font-weight: 600;">
                <i class="bi bi-target me-3" style="color: #667eea;"></i>
                Our Purpose
            </h2>
            <p class="mb-4" style="color: #4a5568; font-size: 1.1rem; line-height: 1.8;">
                The goal of this system is to <strong>streamline daily administrative tasks</strong>, reduce paperwork,
                improve communication between staff and management, and ensure efficient data handling
                across all departments within the school.
            </p>
            
            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3" style="color: #38ef7d; font-size: 1.5rem;"></i>
                        <span style="color: #4a5568; font-weight: 500;">Paperless Administration</span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3" style="color: #38ef7d; font-size: 1.5rem;"></i>
                        <span style="color: #4a5568; font-weight: 500;">Enhanced Communication</span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3" style="color: #38ef7d; font-size: 1.5rem;"></i>
                        <span style="color: #4a5568; font-weight: 500;">Centralized Data Management</span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3" style="color: #38ef7d; font-size: 1.5rem;"></i>
                        <span style="color: #4a5568; font-weight: 500;">Improved Efficiency</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Back Button -->
        <div class="text-center animate-fade-up" style="animation-delay: 0.3s;">
            <a href="admin_index.php?id=1" class="back-btn">
                <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
    
    <div style="height: 3rem;"></div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>