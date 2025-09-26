<?php
session_start();
if($_SESSION["user_nm"]=="Guest"){
    header("Location:login.php");
}
else if(isset($_SESSION['user_nm']) && $id == 6)
        {
             echo"welcome";
        }
else if(isset($_SESSION['user_nm']))
        {
            echo "<h2> User:".$_SESSION['user_nm'];
            header("Location:admin_index.php?id=2");
        }
        else {
            echo "error!!";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - School Management</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .user-form-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 0.75rem;
            margin-bottom: 2rem;
        }
        
        .user-form-card .card-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border: none;
            border-radius: 0.75rem 0.75rem 0 0;
        }
        
        .form-control, .form-select {
            border-radius: 0.5rem;
            border: 2px solid #e9ecef;
            transition: border-color 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #4facfe;
            box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
        }
        
        .users-table-card {
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: none;
            overflow: hidden;
        }
        
        .table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem 0.75rem;
        }
        
        .table td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border-color: #e9ecef;
        }
        
        .table-striped > tbody > tr:nth-of-type(odd) > td {
            background-color: rgba(79, 172, 254, 0.05);
        }
        
        .privilege-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .privilege-admin {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
        }
        
        .privilege-teacher {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
        
        .action-buttons .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            min-width: 70px;
        }
        
        .password-field {
            font-family: 'Courier New', monospace;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .stats-row {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-item {
            text-align: center;
            padding: 0.5rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4facfe;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }
            
            .action-buttons .btn {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
            
            .stats-row {
                padding: 0.75rem 0.5rem;
            }
            
            .stat-number {
                font-size: 1.25rem;
            }
        }
        
        .welcome-alert {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-light">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">
                        <i class="bi bi-people-fill me-2"></i>
                        User Management
                    </h1>
                    <p class="mb-0 mt-1">Manage system users and access privileges</p>
                    <?php if(isset($_SESSION['user_nm']) && $_SESSION["user_nm"] != "Guest"): ?>
                        <small class="opacity-75">
                            <i class="bi bi-person-check me-1"></i>
                            Logged in as: <strong><?php echo htmlspecialchars($_SESSION['user_nm']); ?></strong>
                        </small>
                    <?php endif; ?>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="homepage.php" class="btn btn-light me-2">
                        <i class="bi bi-house-fill me-1"></i>
                        Dashboard
                    </a>
                    <a href="admin_index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Welcome Message -->
        <?php if(isset($_SESSION['user_nm']) && $_SESSION["user_nm"] != "Guest"): ?>
            <div class="alert welcome-alert fade-in" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-3 display-6"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Welcome to User Management!</h5>
                        <p class="mb-0">You have administrator privileges to manage system users and their access levels.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Statistics Row -->
        <div class="stats-row">
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number" id="totalUsers">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label">Total Users</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number" id="adminUsers">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label">Admin Users</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number" id="teacherUsers">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label">Teacher Users</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number" id="activeToday">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label">Active Today</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New User Form -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card user-form-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-person-plus-fill me-2"></i>
                            Add New User
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="insert.php" method="post" id="userForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="user" class="form-label">
                                        <i class="bi bi-person me-1"></i>
                                        Username <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="user" id="user" class="form-control" 
                                           placeholder="Enter username" required>
                                    <div class="form-text">Username must be unique and at least 3 characters long</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope me-1"></i>
                                        Email Address <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control" 
                                           placeholder="Enter email address" required>
                                    <div class="form-text">A valid email address is required</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">
                                        <i class="bi bi-lock me-1"></i>
                                        Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" 
                                               placeholder="Enter password" required minlength="6">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                            <i class="bi bi-eye" id="passwordToggleIcon"></i>
                                        </button>
                                    </div>
                                    <div class="form-text">Password must be at least 6 characters long</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="privilege" class="form-label">
                                        <i class="bi bi-shield-check me-1"></i>
                                        User Privilege <span class="text-danger">*</span>
                                    </label>
                                    <select name="privilege" id="privilege" class="form-select" required>
                                        <option value="">Select Privilege Level</option>
                                        <option value="Admin">Administrator - Full Access</option>
                                        <option value="Teacher">Teacher - Limited Access</option>
                                    </select>
                                    <div class="form-text">Admin users have full system access</div>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Add User
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary ms-2">
                                        <i class="bi bi-arrow-clockwise me-1"></i>
                                        Reset Form
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users List -->
        <div class="row">
            <div class="col-12">
                <div class="card users-table-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-table me-2"></i>
                            Existing Users
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" onclick="refreshUsers()">
                                <i class="bi bi-arrow-clockwise me-1"></i>
                                Refresh
                            </button>
                            <button class="btn btn-outline-success btn-sm" onclick="exportUsers()">
                                <i class="bi bi-download me-1"></i>
                                Export
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php
                        include_once("connection.php");
                        $sql = "SELECT * FROM users ORDER BY id DESC";
                        $res = mysqli_query($conn, $sql);
                        
                        if(mysqli_num_rows($res) > 0){
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <i class="bi bi-hash me-1"></i>
                                            ID
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-person me-1"></i>
                                            Username
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-envelope me-1"></i>
                                            Email
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-lock me-1"></i>
                                            Password
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-shield-check me-1"></i>
                                            Privilege
                                        </th>
                                        <th scope="col" class="text-center">
                                            <i class="bi bi-gear me-1"></i>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $adminCount = 0;
                                    $teacherCount = 0;
                                    $totalCount = 0;
                                    
                                    while($ro = mysqli_fetch_assoc($res)){ 
                                        $totalCount++;
                                        if($ro['privilege'] == 'Admin') $adminCount++;
                                        if($ro['privilege'] == 'Teacher') $teacherCount++;
                                    ?>
                                        <tr>
                                            <td>
                                                <span class="badge bg-secondary">#<?php echo $ro['id']; ?></span>
                                            </td>
                                            <td>
                                                <strong><?php echo htmlspecialchars($ro['username']); ?></strong>
                                            </td>
                                            <td>
                                                <i class="bi bi-envelope me-1 text-muted"></i>
                                                <?php echo htmlspecialchars($ro['email']); ?>
                                            </td>
                                            <td>
                                                <span class="password-field">
                                                    <?php echo str_repeat('•', min(8, strlen($ro['password']))); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="privilege-badge privilege-<?php echo strtolower($ro['privilege']); ?>">
                                                    <i class="bi bi-<?php echo $ro['privilege'] == 'Admin' ? 'shield-fill' : 'person-badge'; ?> me-1"></i>
                                                    <?php echo htmlspecialchars($ro['privilege']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="edit.php?id=<?php echo $ro['id']; ?>" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil me-1"></i>
                                                        Edit
                                                    </a>
                                                    <a href="delete.php?id=<?php echo $ro['id']; ?>" 
                                                       class="btn btn-danger btn-sm"
                                                       onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                                        <i class="bi bi-trash me-1"></i>
                                                        Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } else { ?>
                        <div class="empty-state">
                            <i class="bi bi-people display-4"></i>
                            <h5>No Users Found</h5>
                            <p class="mb-3">There are no users in the system yet. Add the first user using the form above.</p>
                            <button class="btn btn-primary" onclick="document.getElementById('user').focus()">
                                <i class="bi bi-person-plus-fill me-1"></i>
                                Add First User
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-lightning me-2"></i>
                            Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <button class="btn btn-outline-primary w-100" onclick="document.getElementById('user').focus()">
                                    <i class="bi bi-person-plus-fill d-block mb-1"></i>
                                    <small>Add User</small>
                                </button>
                            </div>
                            <div class="col-6 col-md-3">
                                <button class="btn btn-outline-info w-100" onclick="refreshUsers()">
                                    <i class="bi bi-arrow-clockwise d-block mb-1"></i>
                                    <small>Refresh List</small>
                                </button>
                            </div>
                            <div class="col-6 col-md-3">
                                <button class="btn btn-outline-success w-100" onclick="exportUsers()">
                                    <i class="bi bi-download d-block mb-1"></i>
                                    <small>Export Data</small>
                                </button>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="homepage.php" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-house d-block mb-1"></i>
                                    <small>Dashboard</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Update statistics
        function updateStats() {
            document.getElementById('totalUsers').textContent = '<?php echo isset($totalCount) ? $totalCount : 0; ?>';
            document.getElementById('adminUsers').textContent = '<?php echo isset($adminCount) ? $adminCount : 0; ?>';
            document.getElementById('teacherUsers').textContent = '<?php echo isset($teacherCount) ? $teacherCount : 0; ?>';
            document.getElementById('activeToday').textContent = '<?php echo isset($totalCount) ? $totalCount : 0; ?>';
        }
        
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('passwordToggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        }
        
        // Form validation
        document.getElementById('userForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const username = document.getElementById('user').value;
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long.');
                return;
            }
            
            if (username.length < 3) {
                e.preventDefault();
                alert('Username must be at least 3 characters long.');
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Adding User...';
            submitBtn.disabled = true;
        });
        
        // Refresh users function
        function refreshUsers() {
            location.reload();
        }
        
        // Export users function (placeholder)
        function exportUsers() {
            alert('Export functionality will be implemented soon!');
        }
        
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            updateStats();
            
            // Auto-focus on first input
            setTimeout(() => {
                document.getElementById('user').focus();
            }, 1000);
        });
        
        // Enhanced delete confirmation
        function confirmDelete(userId, username) {
            if (confirm(`Are you sure you want to delete user "${username}"?\n\nThis action cannot be undone and will permanently remove the user from the system.`)) {
                window.location.href = `delete.php?id=${userId}`;
            }
        }
        
        // Toast notification system
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type} border-0 position-fixed top-0 end-0 m-3`;
            toast.style.zIndex = '9999';
            toast.setAttribute('role', 'alert');
            
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            document.body.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }
        
        // Check for success/error messages from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success')) {
            showToast('User added successfully!', 'success');
        }
        if (urlParams.get('error')) {
            showToast('Error occurred. Please try again.', 'danger');
        }
    </script>

</body>
</html>