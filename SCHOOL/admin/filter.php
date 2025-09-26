<?php
$conn = mysqli_connect("localhost", "root", "", "school");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate and sanitize registration number from GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing registration number.");
}
$reg = (int) $_GET['id']; // Cast to integer for safety

// Handle selected date from POST or GET
$selected_date = '';
if (isset($_POST['filter_date'])) {
    $selected_date = $_POST['filter_date'];
} elseif (isset($_GET['click_date'])) {
    $selected_date = $_GET['click_date'];
}

// Fetch unique transaction dates for the specific student
$date_sql = "SELECT DISTINCT `t_date` FROM transaction 
             WHERE s_reg_no = $reg AND `t_date` != '0000-00-00' 
             ORDER BY `t_date` DESC";
$date_result = mysqli_query($conn, $date_sql);

// Fetch transactions for the specific student and selected date (if any)
$txn_sql = "SELECT t.*, 
                   s.First_Name, 
                   s.F_First_Name, 
                   s.Class AS student_class, 
                   s.Section AS student_section
            FROM transaction t
            JOIN students s ON t.s_reg_no = s.S_REG_NUM
            WHERE t.s_reg_no = $reg";

if (!empty($selected_date)) {
    $safe_date = mysqli_real_escape_string($conn, $selected_date);
    $txn_sql .= " AND t.t_date = '$safe_date'";
}

$txn_sql .= " ORDER BY t.t_date DESC";
$txn_result = mysqli_query($conn, $txn_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History - School Management</title>
    
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
        
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
        
        .table-responsive {
            border-radius: 0.375rem;
        }
        
        .quick-date-btn {
            margin: 0.25rem;
        }
        
        .filter-card {
            background-color: #f8f9fa;
        }
        
        .transaction-amount {
            font-weight: 600;
            color: #28a745;
        }
        
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .filter-form-container {
                margin-bottom: 1rem;
            }
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
                        <i class="bi bi-receipt me-2"></i>
                        Transaction History
                    </h1>
                    <p class="mb-0 mt-1">Student Registration #<?php echo htmlspecialchars($reg); ?></p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="students_li.php" class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Students
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card filter-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-funnel me-2"></i>
                            Filter Transactions
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Date Filter Form -->
                        <div class="row filter-form-container">
                            <div class="col-md-6 col-lg-4">
                                <form method="POST" action="filter.php?id=<?php echo $reg; ?>" class="d-flex gap-2">
                                    <div class="flex-grow-1">
                                        <label for="filter_date" class="form-label">Filter by Date</label>
                                        <input type="date" 
                                               id="filter_date" 
                                               name="filter_date" 
                                               class="form-control"
                                               value="<?php echo htmlspecialchars($selected_date); ?>">
                                    </div>
                                    <div class="align-self-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search me-1"></i>
                                            Filter
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Quick Date Links -->
                        <?php if (mysqli_num_rows($date_result) > 0): ?>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-muted mb-2">
                                        <i class="bi bi-clock-history me-1"></i>
                                        Quick Date Selection:
                                    </h6>
                                    <div class="quick-dates-container">
                                        <?php 
                                        mysqli_data_seek($date_result, 0); // Reset pointer
                                        while ($date_row = mysqli_fetch_assoc($date_result)) { 
                                        ?>
                                            <a href="filter.php?id=<?php echo $reg; ?>&click_date=<?php echo $date_row['t_date']; ?>" 
                                               class="btn btn-outline-secondary btn-sm quick-date-btn <?php echo ($selected_date == $date_row['t_date']) ? 'active' : ''; ?>">
                                                <?php echo date('d M Y', strtotime($date_row['t_date'])); ?>
                                            </a>
                                        <?php } ?>
                                        
                                        <?php if (!empty($selected_date)): ?>
                                            <a href="filter.php?id=<?php echo $reg; ?>" 
                                               class="btn btn-outline-danger btn-sm quick-date-btn">
                                                <i class="bi bi-x-circle me-1"></i>
                                                Clear Filter
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Results -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-table me-2"></i>
                            Transaction Records
                            <?php if (!empty($selected_date)): ?>
                                <small class="text-muted">for <?php echo date('d M Y', strtotime($selected_date)); ?></small>
                            <?php endif; ?>
                        </h5>
                        <span class="badge bg-info">
                            <?php echo mysqli_num_rows($txn_result); ?> record(s)
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">
                                            <i class="bi bi-hash me-1"></i>
                                            ID
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-person me-1"></i>
                                            Student
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-person-check me-1"></i>
                                            Father
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-mortarboard me-1"></i>
                                            Class
                                        </th>
                                        <th scope="col">Section</th>
                                        <th scope="col">Session</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">
                                            <i class="bi bi-currency-dollar me-1"></i>
                                            Amount
                                        </th>
                                        <th scope="col">
                                            <i class="bi bi-calendar-event me-1"></i>
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($txn_result) > 0): ?>
                                        <?php while ($row = mysqli_fetch_assoc($txn_result)) { ?>
                                            <tr>
                                                <td>
                                                    <span class="badge bg-secondary">#<?php echo $row['id']; ?></span>
                                                </td>
                                                <td>
                                                    <strong><?php echo htmlspecialchars($row['First_Name']); ?></strong>
                                                </td>
                                                <td><?php echo htmlspecialchars($row['F_First_Name']); ?></td>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        <?php echo htmlspecialchars($row['student_class']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        <?php echo htmlspecialchars($row['student_section']); ?>
                                                    </span>
                                                </td>
                                                <td><?php echo htmlspecialchars($row['s_session']); ?></td>
                                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                                <td><?php echo htmlspecialchars($row['for_month']); ?></td>
                                                <td>
                                                    <span class="transaction-amount">
                                                        ₹<?php echo number_format($row['m_fee'], 2); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        <?php echo date('d M Y', strtotime($row['t_date'])); ?>
                                                    </small>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                                    <h5>No transactions found</h5>
                                                    <p class="mb-0">
                                                        <?php echo $selected_date ? "No records found for " . date('d M Y', strtotime($selected_date)) : "This student has no transaction history yet."; ?>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
