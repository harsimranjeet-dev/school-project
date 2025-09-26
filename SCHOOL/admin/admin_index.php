<?php
error_reporting(0);
session_start();
include("connection.php");

$_SESSION["userlogin"] = "mt";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System - Admin Panel</title>
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
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .content-wrapper {
            min-height: calc(100vh - 80px);
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        
        .page-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        @media (max-width: 768px) {
            .content-wrapper {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }
            
            .page-container {
                border-radius: 15px;
                margin: 0 1rem 2rem 1rem;
            }
        }
    </style>
</head>
<body>
    <?php include("header.php") ?>
    
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="page-container">
                <?php
                    $page_id = isset($_GET['id']) ? $_GET['id'] : 1;
                    
                    switch($page_id) {
                        case 1:
                            include("homepage.php");
                            break;
                        case 2:
                            $id = 6;
                            include("user_func.php");
                            break;
                        case 3:
                            include("admin_about.php");
                            break;
                        case 4:
                            header("Location: login.php");
                            exit();
                            break;
                        case 5:
                            header("Location: admin_logout.php");
                            exit();
                            break;
                        default:
                            include("homepage.php");
                            break;
                    }
                ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>