<?php
$reg_num = $_GET['re'];
$conn1 = mysqli_connect("localhost","root","","school");
$sql1="SELECT * from students where S_REG_NUM = $reg_num";
$result1 = mysqli_query($conn1,$sql1);
$rows1 = mysqli_fetch_array($result1);
$FN = $rows1["First_Name"];
$LN = $rows1["Last_Name"];
$sec = $rows1["Section"];
$class = $rows1["Class"];
$st_s = $rows1["st_Session"];
$sql2="SELECT class_id from classes where class_name = '$class'";
$result2 = mysqli_query($conn1,$sql2);
$rows2 = mysqli_fetch_array($result2);
$class_id = $rows2['class_id'];
$sql3="SELECT * from fee_struct where class_id = {$class_id} and st_Session = '{$st_s}'";
$result3 = mysqli_query($conn1,$sql3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Transaction - School Management</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .fee-calculator-card {
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: none;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .section-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 1rem 1.5rem;
            margin: 0;
            font-weight: 600;
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
        
        .form-control[readonly] {
            background-color: #f8f9fa;
            border-color: #dee2e6;
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
        
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
        }
        
        .summary-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border: 2px solid #e9ecef;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .fee-summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .fee-summary-item:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 1.125rem;
            color: #4facfe;
            border-top: 2px solid #4facfe;
            padding-top: 1rem;
            margin-top: 0.5rem;
        }
        
        .student-info-card {
            background: linear-gradient(135deg, #e3f2fd 0%, #f1f8e9 100%);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .fee-badge {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .discount-badge {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .form-check-input:checked {
            background-color: #4facfe;
            border-color: #4facfe;
        }
        
        .loading-overlay {
            position: relative;
        }
        
        .loading-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
        }
        
        .loading-overlay.loading::after {
            display: flex;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .fee-calculator-card {
                margin-bottom: 1rem;
            }
            
            .section-header {
                padding: 0.75rem 1rem;
                font-size: 1rem;
            }
            
            .student-info-card {
                padding: 1rem;
            }
            
            .btn-primary {
                width: 100%;
                margin-bottom: 1rem;
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    
    <script>
        function net_fee(){
            var x = '<?php echo $class_id ?>';
            var h = '<?php echo $st_s ?>';
            var d = document.getElementById("tuitionFee").value;
            var n = document.getElementById("discountSelect").value;
            
            // Show loading state
            $("#net_f").html(`
                <div class="summary-card text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Calculating...</span>
                    </div>
                    <p class="mt-2 mb-0 text-muted">Calculating fee structure...</p>
                </div>
            `);
            
            $.ajax({
                url: "total_net_fee1.php",
                method: "POST",
                data: {
                    id: x,
                    id1: h,
                    id2: d,
                    id3: n
                },
                success: function(data){
                    setTimeout(() => {
                        $("#net_f").html(data).addClass('animate-fade-in');
                    }, 500);
                },
                error: function(){
                    $("#net_f").html(`
                        <div class="summary-card">
                            <div class="text-center text-danger">
                                <i class="bi bi-exclamation-triangle display-4 mb-2"></i>
                                <h5>Error Calculating Fees</h5>
                                <p class="mb-0">Please try again or contact administrator.</p>
                            </div>
                        </div>
                    `);
                }
            });
        }
        
        // Auto-calculate on page load
        $(document).ready(function(){
            setTimeout(() => {
                net_fee();
            }, 1000);
        });
        
        // Update discount select when radio buttons change
        function updateDiscountSelect(value) {
            document.getElementById('discountSelect').value = value;
            net_fee();
        }
        
        // Form validation
        function validateForm() {
            const forMonth = document.getElementById('for_month').value;
            if (!forMonth.trim()) {
                alert('Please enter the month(s) for this fee payment.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="bg-light">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">
                        <i class="bi bi-calculator me-2"></i>
                        Fee Transaction
                    </h1>
                    <p class="mb-0 mt-1">Calculate and process student fee payment</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="students_li.php" class="btn btn-light me-2">
                        <i class="bi bi-arrow-left me-1"></i>
                        Back to Students
                    </a>
                    <a href="homepage.php" class="btn btn-secondary">
                        <i class="bi bi-house-fill me-1"></i>
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <form id="feeForm" action="transec_insert.php" method="POST" onsubmit="return validateForm()">
            <!-- Student Information Card -->
            <div class="student-info-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-2">
                            <i class="bi bi-person-circle me-2 text-primary"></i>
                            <?php echo htmlspecialchars($FN . ' ' . $LN); ?>
                        </h4>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <strong>Registration:</strong> 
                                <span class="fee-badge">#<?php echo htmlspecialchars($reg_num); ?></span>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <strong>Class:</strong> 
                                <span class="fee-badge"><?php echo htmlspecialchars($class . ' - ' . $sec); ?></span>
                            </div>
                            <div class="col-sm-6">
                                <strong>Session:</strong> 
                                <span class="fee-badge"><?php echo htmlspecialchars($st_s); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <i class="bi bi-mortarboard-fill display-4 text-primary opacity-75"></i>
                    </div>
                </div>
            </div>

            <input type="hidden" name="re" value="<?php echo $reg_num ?>">

            <!-- Fee Structure Card -->
            <div class="card fee-calculator-card">
                <h5 class="section-header mb-0">
                    <i class="bi bi-currency-dollar me-2"></i>
                    Fee Structure Details
                </h5>
                <div class="card-body p-4">
                    <?php while($rows3 = mysqli_fetch_array($result3)){ ?>
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-4">
                            <label for="formFee" class="form-label">
                                <i class="bi bi-file-earmark-text me-1"></i>
                                Form Fee
                            </label>
                            <input type="number" class="form-control" id="formFee" value="<?php echo $rows3['Form_fee']?>" readonly>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label for="admissionFee" class="form-label">
                                <i class="bi bi-door-open me-1"></i>
                                Admission Fee
                            </label>
                            <input type="number" class="form-control" id="admissionFee" value="<?php echo $rows3['AD_fee']?>" readonly>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label for="miscCharges" class="form-label">
                                <i class="bi bi-gear me-1"></i>
                                Miscellaneous Charges
                            </label>
                            <input type="number" class="form-control" id="miscCharges" value="<?php echo $rows3['MS_CHG']?>" readonly>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label for="cautionMoney" class="form-label">
                                <i class="bi bi-shield-check me-1"></i>
                                Caution Money
                            </label>
                            <input type="number" class="form-control" id="cautionMoney" value="<?php echo $rows3['CM']?>" readonly>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label for="examFee" class="form-label">
                                <i class="bi bi-clipboard-check me-1"></i>
                                Exam Fee
                            </label>
                            <input type="number" class="form-control" id="examFee" value="<?php echo $rows3['Exam_fee']?>" readonly>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="hidden" name="TU_fee" value="<?php echo $rows3['Tuition']?>">
                            <label for="tuitionFee" class="form-label">
                                <i class="bi bi-book me-1"></i>
                                Tuition Fee Payment Mode
                            </label>
                            <select class="form-select" name="mode" id="tuitionFee" onchange="net_fee()" required>
                                <option value="">Select Payment Mode</option>
                                <option value="<?php echo $rows3['Tuition']?>">Monthly - ₹<?php echo number_format($rows3['Tuition']); ?></option>
                                <option value="<?php echo $rows3['Tuition']*3?>">Quarterly - ₹<?php echo number_format($rows3['Tuition']*3); ?></option>
                                <option value="<?php echo $rows3['Tuition']*12?>">Yearly - ₹<?php echo number_format($rows3['Tuition']*12); ?></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="for_month" class="form-label">
                                <i class="bi bi-calendar-range me-1"></i>
                                Fee For Month(s) <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="for_month" class="form-control" id="for_month" 
                                   placeholder="e.g., January, January-March, 2024-2025" required>
                            <div class="form-text">Specify the month(s) or period this payment covers</div>
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">
                                <i class="bi bi-chat-text me-1"></i>
                                Description (Optional)
                            </label>
                            <textarea name="description" class="form-control" id="description" rows="3"
                                      placeholder="Additional notes or remarks about this payment..."></textarea>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Discount Section -->
            <div class="card fee-calculator-card">
                <h5 class="section-header mb-0">
                    <i class="bi bi-percent me-2"></i>
                    Discount & Concessions
                </h5>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="discountSelect" class="form-label">
                                <i class="bi bi-tag me-1"></i>
                                Available Discounts
                            </label>
                            <select class="form-select" id="discountSelect" onchange="net_fee()">
                                <option value="0" selected>No Discount (0%)</option>
                                <option value="10">Sibling Discount (10%)</option>
                                <option value="15">Staff Child Discount (15%)</option>
                                <option value="20">Merit Scholarship (20%)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-people me-1"></i>
                                Sibling Relation
                            </label>
                            <div class="d-flex gap-3 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discountOptions" id="noDiscount" 
                                           value="0" checked onchange="updateDiscountSelect(0)">
                                    <label class="form-check-label" for="noDiscount">None</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discountOptions" id="brother" 
                                           value="10" onchange="updateDiscountSelect(10)">
                                    <label class="form-check-label" for="brother">Brother</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discountOptions" id="sister" 
                                           value="10" onchange="updateDiscountSelect(10)">
                                    <label class="form-check-label" for="sister">Sister</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fee Summary Section -->
            <div class="card fee-calculator-card">
                <h5 class="section-header mb-0">
                    <i class="bi bi-receipt me-2"></i>
                    Fee Summary & Payment
                </h5>
                <div class="card-body p-4">
                    <div id="net_f" class="loading-overlay">
                        <div class="summary-card text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 mb-0 text-muted">Calculating fee structure...</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-credit-card me-2"></i>
                                Process Payment
                            </button>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <a href="students_li.php" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i>
                                Cancel Transaction
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="bi bi-lightning me-2"></i>
                                Quick Actions
                            </h6>
                            <div class="row g-2">
                                <div class="col-6 col-md-3">
                                    <a href="filter.php?id=<?php echo $reg_num; ?>" class="btn btn-outline-info btn-sm w-100">
                                        <i class="bi bi-clock-history d-block mb-1"></i>
                                        <small>Transaction History</small>
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <button type="button" class="btn btn-outline-warning btn-sm w-100" onclick="window.print()">
                                        <i class="bi bi-printer d-block mb-1"></i>
                                        <small>Print Receipt</small>
                                    </button>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="students_li.php" class="btn btn-outline-secondary btn-sm w-100">
                                        <i class="bi bi-people d-block mb-1"></i>
                                        <small>All Students</small>
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="homepage.php" class="btn btn-outline-primary btn-sm w-100">
                                        <i class="bi bi-house d-block mb-1"></i>
                                        <small>Dashboard</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Enhanced form interactions
        $(document).ready(function() {
            // Auto-focus on tuition fee select
            setTimeout(() => {
                $('#tuitionFee').focus();
            }, 1500);
            
            // Auto-populate common month patterns
            $('#tuitionFee').change(function() {
                const mode = $(this).find('option:selected').text();
                const monthField = $('#for_month');
                
                if (mode.includes('Monthly') && !monthField.val()) {
                    const currentMonth = new Date().toLocaleString('default', { month: 'long' });
                    monthField.val(currentMonth);
                } else if (mode.includes('Quarterly') && !monthField.val()) {
                    monthField.val('Q1 (Apr-Jun)');
                } else if (mode.includes('Yearly') && !monthField.val()) {
                    const currentYear = new Date().getFullYear();
                    monthField.val(`${currentYear}-${currentYear + 1}`);
                }
            });
            
            // Form submission loading state
            $('#feeForm').on('submit', function() {
                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.html('<span class="spinner-border spinner-border-sm me-2"></span>Processing...').prop('disabled', true);
            });
        });
        
        // Print functionality
        function printReceipt() {
            window.print();
        }
        
        // Success notification
        function showSuccess(message) {
            const toast = $(`
                <div class="toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3" style="z-index: 9999;">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-check-circle me-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `);
            
            $('body').append(toast);
            const bsToast = new bootstrap.Toast(toast[0]);
            bsToast.show();
            
            toast[0].addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }
    </script>

</body>
</html>