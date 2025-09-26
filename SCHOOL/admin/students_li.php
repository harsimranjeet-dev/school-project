<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List - School Management</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
    
    <style>
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .search-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .search-card .card-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border: none;
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
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
        }
        
        .btn-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
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
        
        .table-card {
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: none;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
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
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .action-buttons .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            min-width: 80px;
        }
        
        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin: 0 auto;
        }
        
        .stats-row {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
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
                min-width: 100%;
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .stats-row {
                padding: 0.75rem 0.5rem;
            }
            
            .stat-number {
                font-size: 1.25rem;
            }
        }
        
        /* Tablet Responsive */
        @media (min-width: 769px) and (max-width: 1024px) {
            .action-buttons .btn {
                min-width: 70px;
                font-size: 0.8rem;
            }
        }
        
        .loading-spinner {
            text-align: center;
            padding: 2rem;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Pagination Styles */
        .pagination-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 0.75rem;
        }
        
        .pagination .page-link {
            color: #4facfe;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            margin: 0 0.125rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .pagination .page-link:hover {
            color: white;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-color: #4facfe;
            transform: translateY(-1px);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-color: #4facfe;
            color: white;
            box-shadow: 0 2px 4px rgba(79, 172, 254, 0.3);
        }
        
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
        
        .pagination-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #6c757d;
            font-size: 0.875rem;
        }
        
        .entries-per-page {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .entries-per-page select {
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #dee2e6;
            font-size: 0.875rem;
        }
        
        @media (max-width: 768px) {
            .pagination-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .pagination .page-link {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }
        }
    </style>
    
    <script>
        // Pagination variables
        let currentPage = 1;
        let itemsPerPage = 10;
        let totalItems = 0;
        let allStudentsData = [];
        
        function class_set(){
            const searchValue = document.getElementById("class_nm1").value;
            
            // Show loading state
            $("#ans").html(`
                <tr>
                    <td colspan="8" class="loading-spinner">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 mb-0 text-muted">Searching students...</p>
                    </td>
                </tr>
            `);
            
            // Hide pagination during loading
            $("#pagination-container").hide();
            
            $.ajax({
                url: "test.php",
                method: "POST",
                data: {
                    id: searchValue,
                    page: 'all' // Get all data for client-side pagination
                },
                success: function(data){
                    setTimeout(() => {
                        // Store all data and reset to first page
                        allStudentsData = parseTableData(data);
                        totalItems = allStudentsData.length;
                        currentPage = 1;
                        
                        displayPage(currentPage);
                        updatePagination();
                        $("#pagination-container").show();
                    }, 500);
                },
                error: function(){
                    $("#ans").html(`
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-danger">
                                    <i class="bi bi-exclamation-triangle display-4 mb-2"></i>
                                    <h5>Error Loading Data</h5>
                                    <p class="mb-0">Please try again later.</p>
                                </div>
                            </td>
                        </tr>
                    `);
                    $("#pagination-container").hide();
                }
            });
        }
        
        // Parse table data from server response
        function parseTableData(htmlData) {
            const tempDiv = $('<div>').html(htmlData);
            const rows = tempDiv.find('tr');
            const studentsArray = [];
            
            rows.each(function() {
                const row = $(this);
                if (row.find('td').length > 0) {
                    studentsArray.push(row[0].outerHTML);
                }
            });
            
            return studentsArray;
        }
        
        // Display specific page
        function displayPage(page) {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageData = allStudentsData.slice(startIndex, endIndex);
            
            if (pageData.length === 0) {
                $("#ans").html(`
                    <tr>
                        <td colspan="8" class="empty-state">
                            <i class="bi bi-inbox display-4 mb-3"></i>
                            <h5>No Students Found</h5>
                            <p class="mb-0">Try adjusting your search criteria or add new students.</p>
                            <a href="students_reg.php" class="btn btn-primary mt-3">
                                <i class="bi bi-person-plus-fill me-1"></i>
                                Add New Student
                            </a>
                        </td>
                    </tr>
                `);
            } else {
                $("#ans").html(pageData.join('')).addClass('fade-in');
            }
            
            updatePaginationInfo();
        }
        
        // Update pagination controls
        function updatePagination() {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            let paginationHtml = '';
            
            if (totalPages <= 1) {
                $("#pagination-controls").html('');
                return;
            }
            
            // Previous button
            paginationHtml += `
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage - 1})" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            `;
            
            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);
            
            if (startPage > 1) {
                paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(1)">1</a></li>`;
                if (startPage > 2) {
                    paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
            }
            
            for (let i = startPage; i <= endPage; i++) {
                paginationHtml += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                    </li>
                `;
            }
            
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
                paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(${totalPages})">${totalPages}</a></li>`;
            }
            
            // Next button
            paginationHtml += `
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage + 1})" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            `;
            
            $("#pagination-controls").html(paginationHtml);
        }
        
        // Change page function
        function changePage(page) {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            if (page < 1 || page > totalPages || page === currentPage) return;
            
            currentPage = page;
            displayPage(currentPage);
            updatePagination();
            
            // Smooth scroll to table
            $('html, body').animate({
                scrollTop: $("#students-table").offset().top - 100
            }, 300);
        }
        
        // Change items per page
        function changeItemsPerPage(newItemsPerPage) {
            itemsPerPage = parseInt(newItemsPerPage);
            currentPage = 1; // Reset to first page
            displayPage(currentPage);
            updatePagination();
        }
        
        // Update pagination info
        function updatePaginationInfo() {
            const startItem = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
            const endItem = Math.min(currentPage * itemsPerPage, totalItems);
            
            $("#pagination-info").html(`
                Showing <strong>${startItem}</strong> to <strong>${endItem}</strong> of <strong>${totalItems}</strong> students
            `);
        }
        
        // Auto-search on page load
        $(document).ready(function(){
            class_set();
        });
        
        // Search functionality
        function performSearch() {
            class_set();
        }
        
        // Enter key support for search
        $(document).on('keypress', '#class_nm1', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                performSearch();
            }
        });
    </script>
</head>
<body class="bg-light">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-0">
                        <i class="bi bi-people-fill me-2"></i>
                        Students Management
                    </h1>
                    <p class="mb-0 mt-1">View and manage all registered students</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="students_reg.php" class="btn btn-success me-2">
                        <i class="bi bi-person-plus-fill me-1"></i>
                        Add New Student
                    </a>
                    <a href="homepage.php" class="btn btn-light">
                        <i class="bi bi-house-fill me-1"></i>
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Statistics Row -->
        <div class="stats-row">
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number" id="totalStudents">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label">Total Students</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number" id="activeStudents">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label">Active Students</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number" id="totalClasses">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label">Classes</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number" id="todayAdmissions">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label">Today's Admissions</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card search-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-search me-2"></i>
                            Search Students
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="insert.php" method="post" class="d-flex flex-column flex-md-row gap-3">
                            <div class="flex-grow-1">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" 
                                           name="class_nm1" 
                                           id="class_nm1" 
                                           class="form-control" 
                                           placeholder="Search by name, registration number, class, or father's name..."
                                           onchange="class_set()"
                                           oninput="class_set()">
                                </div>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Start typing to search instantly, or leave empty to show all students
                                </small>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary" onclick="performSearch()">
                                    <i class="bi bi-search me-1"></i>
                                    Search
                                </button>
                                <button type="button" class="btn btn-outline-secondary" onclick="clearSearch()">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <div class="row">
            <div class="col-12">
                <div class="card table-card" id="students-table">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-table me-2"></i>
                            Students List
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm" onclick="exportData()">
                                <i class="bi bi-download me-1"></i>
                                Export
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="refreshData()">
                                <i class="bi bi-arrow-clockwise me-1"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <i class="bi bi-hash me-1"></i>
                                            Reg No.
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-mortarboard me-1"></i>
                                            Class
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-person me-1"></i>
                                            Student Name
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-person-check me-1"></i>
                                            Father Name
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            DoB
                                        </th>
                                        <th scope="col" class="text-center">
                                            <i class="bi bi-pencil me-1"></i>
                                            Edit
                                        </th>
                                        <th scope="col" class="text-center">
                                            <i class="bi bi-trash me-1"></i>
                                            Delete
                                        </th>
                                        <th scope="col" class="text-center">
                                            <i class="bi bi-clock-history me-1"></i>
                                            Transaction History
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="ans">
                                    <!-- Loading state -->
                                    <tr>
                                        <td colspan="8" class="loading-spinner">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-2 mb-0 text-muted">Loading students data...</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination Section -->
        <div class="row mt-4" id="pagination-container" style="display: none;">
            <div class="col-12">
                <div class="card pagination-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="pagination-info">
                                    <div id="pagination-info">
                                        Showing 0 to 0 of 0 students
                                    </div>
                                    <div class="entries-per-page">
                                        <label for="itemsPerPage" class="form-label mb-0">Show:</label>
                                        <select id="itemsPerPage" class="form-select form-select-sm" onchange="changeItemsPerPage(this.value)" style="width: auto;">
                                            <option value="5">5</option>
                                            <option value="10" selected>10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <span>per page</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <nav aria-label="Students pagination">
                                    <ul class="pagination justify-content-center justify-content-md-end mb-0" id="pagination-controls">
                                        <!-- Pagination buttons will be inserted here -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
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
                                <a href="students_reg.php" class="btn btn-outline-success w-100">
                                    <i class="bi bi-person-plus-fill d-block mb-1"></i>
                                    <small>Add Student</small>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#" class="btn btn-outline-info w-100" onclick="viewReports()">
                                    <i class="bi bi-bar-chart-fill d-block mb-1"></i>
                                    <small>View Reports</small>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#" class="btn btn-outline-warning w-100" onclick="bulkActions()">
                                    <i class="bi bi-collection-fill d-block mb-1"></i>
                                    <small>Bulk Actions</small>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="homepage.php" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-house-fill d-block mb-1"></i>
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
        // Clear search function
        function clearSearch() {
            document.getElementById("class_nm1").value = "";
            class_set();
        }
        
        // Refresh data
        function refreshData() {
            class_set();
        }
        
        // Mock functions for additional features
        function exportData() {
            alert('Export functionality will be implemented soon!');
        }
        
        function viewReports() {
            alert('Reports feature coming soon!');
        }
        
        function bulkActions() {
            alert('Bulk actions feature coming soon!');
        }
        
        // Update statistics (mock data - replace with actual PHP)
        function updateStats() {
            // These would typically come from PHP/database
            document.getElementById('totalStudents').textContent = '150';
            document.getElementById('activeStudents').textContent = '145';
            document.getElementById('totalClasses').textContent = '12';
            document.getElementById('todayAdmissions').textContent = '3';
        }
        
        // Initialize page
        $(document).ready(function(){
            updateStats();
            setTimeout(() => {
                class_set();
            }, 1000);
        });
        
        // Smooth scroll to top after actions
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        
        // Enhanced search with debouncing
        let searchTimeout;
        $(document).on('input', '#class_nm1', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                class_set();
            }, 500); // Wait 500ms after user stops typing
        });
        
        // Toast notifications for actions
        function showToast(message, type = 'success') {
            // Create toast element
            const toast = $(`
                <div class="toast align-items-center text-white bg-${type} border-0 position-fixed top-0 end-0 m-3" role="alert" style="z-index: 9999;">
                    <div class="d-flex">
                        <div class="toast-body">
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `);
            
            $('body').append(toast);
            const bsToast = new bootstrap.Toast(toast[0]);
            bsToast.show();
            
            // Remove from DOM after it's hidden
            toast[0].addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }
    </script>

</body>
</html>