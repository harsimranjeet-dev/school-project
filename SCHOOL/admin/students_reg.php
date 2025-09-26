<?php 
session_start();
if(!isset($_SESSION['form_err']))
{
  $_SESSION['form_err']="";
}
$conn = mysqli_connect("localhost","root","","school");
$sql2 = "SELECT s_reg_no FROM setting_tb_std";
$result1 = mysqli_query($conn, $sql2);
while($row1=mysqli_fetch_array ($result1)){
  $reg_no = $row1['s_reg_no'];
}
$sql = "SELECT * FROM classes";
$result = mysqli_query($conn, $sql);
$sql3 = "SELECT distinct st_Session FROM fee_struct";
$result3 = mysqli_query($conn, $sql3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - School Management</title>
    
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
        
        .form-section {
            margin-bottom: 1.5rem;
        }
        
        .section-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .section-header:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .section-header.collapsed {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        
        .image-upload-area {
            border: 3px dashed #dee2e6;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .image-upload-area:hover {
            border-color: #4facfe;
            background: #e3f2fd;
        }
        
        .preview-image {
            max-width: 150px;
            max-height: 150px;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        .subject-table {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .fee-structure {
            background: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
            min-height: 200px;
        }
        
        .radio-group {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .form-check {
            margin: 0;
        }
        
        /* Mobile Accordion Animation */
        @media (max-width: 768px) {
            .mobile-section {
                margin-bottom: 1rem;
            }
            
            .mobile-section .collapse {
                transition: height 0.4s ease, opacity 0.3s ease;
            }
            
            .mobile-section .collapse:not(.show) {
                opacity: 0;
            }
            
            .mobile-section .collapse.show {
                opacity: 1;
            }
            
            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .section-header::after {
                content: '\f282';
                font-family: 'bootstrap-icons';
                transition: transform 0.3s ease;
            }
            
            .section-header.collapsed::after {
                transform: rotate(180deg);
            }
        }
        
        /* Tablet Responsive */
        @media (min-width: 769px) and (max-width: 1024px) {
            .tablet-grid {
                display: grid;
                grid-template-columns: 1fr 300px;
                gap: 2rem;
            }
            
            .tablet-sidebar {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }
        }
        
        /* Desktop Layout */
        @media (min-width: 1025px) {
            .desktop-layout {
                display: grid;
                grid-template-columns: 2fr 1fr;
                gap: 2rem;
            }
            
            .desktop-sidebar {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }
        }
        
        .contact-sibling-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        @media (max-width: 768px) {
            .contact-sibling-wrapper {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>
    
    <script>
        function class_set(){
            var x = document.getElementById("class_nm1").value;
            var h = document.getElementById("class_nm2").value;
            $.ajax({
                url: "show_class.php",
                method: "POST",
                data: {
                    id:x
                },
                success:function(data){
                    $("#ans").html(data);
                }
            });
            $.ajax({
                url: "fee_struct.php",
                method: "POST",
                data: {
                    id:x,
                    id1:h
                },
                success:function(data){
                    $("#fees").html(data);
                }
            });
        }
        
        function net_fee(){
            var x = document.getElementById("class_nm1").value;
            var h = document.getElementById("class_nm2").value;
            var d = document.getElementById("class_nm3").value;
            $.ajax({
                url: "total_net_fee.php",
                method: "POST",
                data: {
                    id:x,
                    id5:h,
                    id8:d
                },
                success:function(data){
                    $("#net_f").html(data);
                }
            });
        }
        
        function pic(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImage');
            const container = document.getElementById('imagePreviewContainer');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    container.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
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
                        <i class="bi bi-person-plus-fill me-2"></i>
                        Student Registration
                    </h1>
                    <p class="mb-0 mt-1">Add new student to the system</p>
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
        <?php 
        if($_SESSION['form_err']!=""){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '<i class="bi bi-exclamation-triangle-fill me-2"></i>';
            echo $_SESSION['form_err'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
        }
        ?>

        <form action="s_insert.php" method="POST" enctype="multipart/form-data">
            <!-- Mobile: Accordion Layout -->
            <div class="d-md-none">
                <!-- Student Details Section - Default Open -->
                <div class="mobile-section">
                    <div class="section-header" data-bs-toggle="collapse" data-bs-target="#mobileStudentDetails" aria-expanded="true">
                        <div>
                            <i class="bi bi-person-fill me-2"></i>
                            <strong>Student Details</strong>
                        </div>
                    </div>
                    <div class="collapse show" id="mobileStudentDetails">
                        <div class="card">
                            <div class="card-body">
                                <!-- Student Details Content -->
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-8">
                                                <label class="form-label">Registration Number</label>
                                                <input type="text" name="REG_NO" class="form-control" value="<?php echo $reg_no + 1 ;?>" readonly>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">Date</label>
                                                <input name="current-date-input" type="date" id="current-date-input" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="SNf" class="form-control" placeholder="First Name" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="SNl" class="form-control" placeholder="Last Name" required>
                                    </div>
                                    
                                    <div class="col-4">
                                        <label class="form-label">Class</label>
                                        <select name="class_nm1" id="class_nm1" class="form-select" onchange="class_set()" required>
                                            <?php while($rows = mysqli_fetch_array($result)){?>
                                                <option value="<?php echo $rows["class_id"];?>"><?php echo $rows["class_name"];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Session</label>
                                        <select name="class_nm2" id="class_nm2" class="form-select" onchange="class_set()" required>
                                            <?php while($rows3 = mysqli_fetch_array($result3)){?>
                                                <option value="<?php echo $rows3["st_Session"];?>"><?php echo $rows3["st_Session"];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Section</label>
                                        <select name="Section" class="form-select" required>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" name="DOB" class="form-control" required>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label">Sibling Relation</label>
                                        <div class="radio-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="brother" value="brother" id="brother1" required>
                                                <label class="form-check-label" for="brother1">Brother</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sister" value="sister" id="sister1" required>
                                                <label class="form-check-label" for="sister1">Sister</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label">Gender</label>
                                        <div class="radio-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Gender" value="He" id="male1" required>
                                                <label class="form-check-label" for="male1">Male</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Gender" value="She" id="female1" required>
                                                <label class="form-check-label" for="female1">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <label class="form-label">Father First Name</label>
                                        <input type="text" name="Fatherf" class="form-control" placeholder="First Name" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Father Last Name</label>
                                        <input type="text" name="Fatherl" class="form-control" placeholder="Last Name" required>
                                    </div>
                                    
                                    <div class="col-6">
                                        <label class="form-label">Mother First Name</label>
                                        <input type="text" name="Motherf" class="form-control" placeholder="First Name" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Mother Last Name</label>
                                        <input type="text" name="Motherl" class="form-control" placeholder="Last Name" required>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label">Street Address</label>
                                        <input type="text" name="StreetAD" class="form-control" placeholder="Street Address" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Street Address 2 (Optional)</label>
                                        <input type="text" name="StreetADs" class="form-control" placeholder="Apartment, suite, etc.">
                                    </div>
                                    
                                    <div class="col-4">
                                        <label class="form-label">City</label>
                                        <input type="text" name="City" class="form-control" placeholder="City" required>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">State</label>
                                        <input type="text" name="State" class="form-control" placeholder="State" required>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" name="Postal" class="form-control" placeholder="Postal Code" required>
                                    </div>
                                    
                                    <div class="col-6">
                                        <label class="form-label">Phone</label>
                                        <input type="number" name="Phone" class="form-control" placeholder="Phone Number" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="Email" class="form-control" placeholder="Email Address" required>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label">Sibling Details</label>
                                        <textarea name="SiblingDetails" class="form-control" rows="3" placeholder="List each sibling: Name - Class / Roll"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Picture Section -->
                <div class="mobile-section">
                    <div class="section-header collapsed" data-bs-toggle="collapse" data-bs-target="#mobileProfilePic">
                        <div>
                            <i class="bi bi-camera-fill me-2"></i>
                            <strong>Profile Picture</strong>
                        </div>
                    </div>
                    <div class="collapse" id="mobileProfilePic">
                        <div class="card">
                            <div class="card-body">
                                <div class="image-upload-area">
                                    <div class="text-center">
                                        <i class="bi bi-cloud-upload display-4 text-muted mb-3"></i>
                                        <label for="Fileupload" class="btn btn-primary">
                                            <i class="bi bi-upload me-2"></i>
                                            Upload Image
                                        </label>
                                        <input id="Fileupload" name="Fileupload" type="file" class="d-none" accept="image/*" onchange="pic(event)">
                                        <p class="text-muted mt-2 mb-0">Select student profile picture</p>
                                    </div>
                                    <div id="imagePreviewContainer" class="mt-3" style="display:none;">
                                        <img id="previewImage" src="#" alt="Preview" class="preview-image mx-auto d-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subjects Section -->
                <div class="mobile-section">
                    <div class="section-header collapsed" data-bs-toggle="collapse" data-bs-target="#mobileSubjects">
                        <div>
                            <i class="bi bi-book-fill me-2"></i>
                            <strong>Subjects</strong>
                        </div>
                    </div>
                    <div class="collapse" id="mobileSubjects">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped subject-table">
                                        <thead class="table-primary">
                                            <tr>
                                                <th class="text-center">
                                                    <i class="bi bi-journal-bookmark me-1"></i>
                                                    Subjects
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="ans">
                                            <tr><td class="text-center text-muted">Select Class First!</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fee Structure Section -->
                <div class="mobile-section">
                    <div class="section-header collapsed" data-bs-toggle="collapse" data-bs-target="#mobileFees">
                        <div>
                            <i class="bi bi-currency-dollar me-2"></i>
                            <strong>Fee Structure</strong>
                        </div>
                    </div>
                    <div class="collapse" id="mobileFees">
                        <div class="card">
                            <div class="card-body">
                                <div id="fees" class="fee-structure">
                                    <div class="text-center text-muted">
                                        <i class="bi bi-calculator display-4 mb-3"></i>
                                        <h5>Fee Structure</h5>
                                        <p>Select Class and Session to view fees</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-4 mb-5">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check-circle me-2"></i>
                        Submit Registration
                    </button>
                </div>
            </div>
            <!-- Tablet Layout -->
            <div class="d-none d-md-block d-lg-none">
                <div class="tablet-grid">
                    <!-- Main Form Content -->
                    <div>
                        <!-- Student Details -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-person-fill me-2"></i>
                                <strong>Student Details</strong>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-8">
                                            <label class="form-label">Registration Number</label>
                                            <input type="text" name="REG_NO" class="form-control" value="<?php echo $reg_no + 1 ;?>" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Date</label>
                                            <input name="current-date-input" type="date" id="current-date-input-tablet" class="form-control">
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="SNf" class="form-control" placeholder="First Name" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" name="SNl" class="form-control" placeholder="Last Name" required>
                                        </div>
                                        
                                        <div class="col-4">
                                            <label class="form-label">Class</label>
                                            <select name="class_nm1" id="class_nm1_tablet" class="form-select" onchange="class_set()" required>
                                                <?php mysqli_data_seek($result, 0); while($rows = mysqli_fetch_array($result)){?>
                                                    <option value="<?php echo $rows["class_id"];?>"><?php echo $rows["class_name"];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Session</label>
                                            <select name="class_nm2" id="class_nm2_tablet" class="form-select" onchange="class_set()" required>
                                                <?php mysqli_data_seek($result3, 0); while($rows3 = mysqli_fetch_array($result3)){?>
                                                    <option value="<?php echo $rows3["st_Session"];?>"><?php echo $rows3["st_Session"];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Section</label>
                                            <select name="Section" class="form-select" required>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" name="DOB" class="form-control" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Gender</label>
                                            <div class="radio-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="Gender" value="He" id="male2" required>
                                                    <label class="form-check-label" for="male2">Male</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="Gender" value="She" id="female2" required>
                                                    <label class="form-check-label" for="female2">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Sibling Relation</label>
                                            <div class="radio-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="brother" value="brother" id="brother2" required>
                                                    <label class="form-check-label" for="brother2">Brother</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sister" value="sister" id="sister2" required>
                                                    <label class="form-check-label" for="sister2">Sister</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">Father First Name</label>
                                            <input type="text" name="Fatherf" class="form-control" placeholder="First Name" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Father Last Name</label>
                                            <input type="text" name="Fatherl" class="form-control" placeholder="Last Name" required>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">Mother First Name</label>
                                            <input type="text" name="Motherf" class="form-control" placeholder="First Name" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Mother Last Name</label>
                                            <input type="text" name="Motherl" class="form-control" placeholder="Last Name" required>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Street Address</label>
                                            <input type="text" name="StreetAD" class="form-control" placeholder="Street Address" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Street Address 2 (Optional)</label>
                                            <input type="text" name="StreetADs" class="form-control" placeholder="Apartment, suite, etc.">
                                        </div>
                                        
                                        <div class="col-4">
                                            <label class="form-label">City</label>
                                            <input type="text" name="City" class="form-control" placeholder="City" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">State</label>
                                            <input type="text" name="State" class="form-control" placeholder="State" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" name="Postal" class="form-control" placeholder="Postal Code" required>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">Phone</label>
                                            <input type="number" name="Phone" class="form-control" placeholder="Phone Number" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="Email" class="form-control" placeholder="Email Address" required>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Sibling Details</label>
                                            <textarea name="SiblingDetails" class="form-control" rows="3" placeholder="List each sibling: Name - Class / Roll"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="tablet-sidebar">
                        <!-- Profile Picture -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-camera-fill me-2"></i>
                                <strong>Profile Picture</strong>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="image-upload-area">
                                        <div class="text-center">
                                            <i class="bi bi-cloud-upload display-6 text-muted mb-2"></i>
                                            <label for="FileuploadTablet" class="btn btn-primary btn-sm">
                                                <i class="bi bi-upload me-1"></i>
                                                Upload
                                            </label>
                                            <input id="FileuploadTablet" name="Fileupload" type="file" class="d-none" accept="image/*" onchange="pic(event)">
                                            <p class="text-muted mt-2 mb-0 small">Student photo</p>
                                        </div>
                                        <div id="imagePreviewContainerTablet" class="mt-2" style="display:none;">
                                            <img id="previewImageTablet" src="#" alt="Preview" class="preview-image mx-auto d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Subjects -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-book-fill me-2"></i>
                                <strong>Subjects</strong>
                            </div>
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped subject-table mb-0">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center">
                                                        <i class="bi bi-journal-bookmark me-1"></i>
                                                        Subjects
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="ansTablet">
                                                <tr><td class="text-center text-muted">Select Class!</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fee Structure -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-currency-dollar me-2"></i>
                                <strong>Fee Structure</strong>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div id="feesTablet" class="fee-structure">
                                        <div class="text-center text-muted">
                                            <i class="bi bi-calculator display-6 mb-2"></i>
                                            <h6>Fee Structure</h6>
                                            <p class="small mb-0">Select Class & Session</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button for Tablet -->
                <div class="text-center mt-4 mb-5">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check-circle me-2"></i>
                        Submit Registration
                    </button>
                </div>
            </div>

            <!-- Desktop Layout -->
            <div class="d-none d-lg-block">
                <div class="desktop-layout">
                    <!-- Main Form Content -->
                    <div>
                        <!-- Student Details -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-person-fill me-2"></i>
                                <strong>Student Details</strong>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label class="form-label">Registration Number</label>
                                            <input type="text" name="REG_NO" class="form-control" value="<?php echo $reg_no + 1 ;?>" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Registration Date</label>
                                            <input name="current-date-input" type="date" id="current-date-input-desktop" class="form-control">
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">Student First Name</label>
                                            <input type="text" name="SNf" class="form-control" placeholder="First Name" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Student Last Name</label>
                                            <input type="text" name="SNl" class="form-control" placeholder="Last Name" required>
                                        </div>
                                        
                                        <div class="col-4">
                                            <label class="form-label">Class</label>
                                            <select name="class_nm1" id="class_nm1_desktop" class="form-select" onchange="class_set()" required>
                                                <?php mysqli_data_seek($result, 0); while($rows = mysqli_fetch_array($result)){?>
                                                    <option value="<?php echo $rows["class_id"];?>"><?php echo $rows["class_name"];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Academic Session</label>
                                            <select name="class_nm2" id="class_nm2_desktop" class="form-select" onchange="class_set()" required>
                                                <?php mysqli_data_seek($result3, 0); while($rows3 = mysqli_fetch_array($result3)){?>
                                                    <option value="<?php echo $rows3["st_Session"];?>"><?php echo $rows3["st_Session"];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Section</label>
                                            <select name="Section" class="form-select" required>
                                                <option value="A">Section A</option>
                                                <option value="B">Section B</option>
                                                <option value="C">Section C</option>
                                                <option value="D">Section D</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-4">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" name="DOB" class="form-control" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Gender</label>
                                            <div class="radio-group mt-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="Gender" value="He" id="male3" required>
                                                    <label class="form-check-label" for="male3">Male</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="Gender" value="She" id="female3" required>
                                                    <label class="form-check-label" for="female3">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Sibling Relation</label>
                                            <div class="radio-group mt-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="brother" value="brother" id="brother3" required>
                                                    <label class="form-check-label" for="brother3">Brother</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sister" value="sister" id="sister3" required>
                                                    <label class="form-check-label" for="sister3">Sister</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">Father First Name</label>
                                            <input type="text" name="Fatherf" class="form-control" placeholder="First Name" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Father Last Name</label>
                                            <input type="text" name="Fatherl" class="form-control" placeholder="Last Name" required>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">Mother First Name</label>
                                            <input type="text" name="Motherf" class="form-control" placeholder="First Name" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Mother Last Name</label>
                                            <input type="text" name="Motherl" class="form-control" placeholder="Last Name" required>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Street Address</label>
                                            <input type="text" name="StreetAD" class="form-control" placeholder="Street Address" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Street Address 2 (Optional)</label>
                                            <input type="text" name="StreetADs" class="form-control" placeholder="Apartment, suite, unit, building, floor, etc.">
                                        </div>
                                        
                                        <div class="col-4">
                                            <label class="form-label">City</label>
                                            <input type="text" name="City" class="form-control" placeholder="City" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">State</label>
                                            <input type="text" name="State" class="form-control" placeholder="State/Province" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" name="Postal" class="form-control" placeholder="Postal/Zip Code" required>
                                        </div>
                                        
                                        <div class="col-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="number" name="Phone" class="form-control" placeholder="Contact Number" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" name="Email" class="form-control" placeholder="Email Address" required>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Sibling Details</label>
                                            <textarea name="SiblingDetails" class="form-control" rows="4" placeholder="Please list each sibling with their name, class, and roll number (if applicable). Example: John Smith - Class 5A / Roll 15"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Desktop Sidebar -->
                    <div class="desktop-sidebar">
                        <!-- Profile Picture -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-camera-fill me-2"></i>
                                <strong>Student Profile Picture</strong>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="image-upload-area">
                                        <div class="text-center">
                                            <i class="bi bi-cloud-upload display-4 text-muted mb-3"></i>
                                            <label for="FileuploadDesktop" class="btn btn-primary">
                                                <i class="bi bi-upload me-2"></i>
                                                Upload Image
                                            </label>
                                            <input id="FileuploadDesktop" name="Fileupload" type="file" class="d-none" accept="image/*" onchange="pic(event)">
                                            <p class="text-muted mt-2 mb-0">Select student profile picture<br><small>Recommended: 300x300px</small></p>
                                        </div>
                                        <div id="imagePreviewContainerDesktop" class="mt-3" style="display:none;">
                                            <img id="previewImageDesktop" src="#" alt="Preview" class="preview-image mx-auto d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Subjects -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-book-fill me-2"></i>
                                <strong>Subject List</strong>
                            </div>
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped subject-table mb-0">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center">
                                                        <i class="bi bi-journal-bookmark me-1"></i>
                                                        Enrolled Subjects
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="ansDesktop">
                                                <tr><td class="text-center text-muted py-4">Please select class and session to view subjects</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fee Structure -->
                        <div class="form-section">
                            <div class="section-header">
                                <i class="bi bi-currency-dollar me-2"></i>
                                <strong>Fee Structure</strong>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div id="feesDesktop" class="fee-structure">
                                        <div class="text-center text-muted">
                                            <i class="bi bi-calculator display-4 mb-3"></i>
                                            <h5>Fee Calculation</h5>
                                            <p class="mb-0">Select class and session to calculate fees</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button for Desktop -->
                <div class="text-center mt-4 mb-5">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-check-circle me-2"></i>
                        Submit Student Registration
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Set current date
        document.addEventListener('DOMContentLoaded', (event) => {
            const today = new Date().toISOString().split('T')[0];
            const dateInputs = document.querySelectorAll('[id^="current-date-input"]');
            dateInputs.forEach(input => {
                input.value = today;
            });
        });

        // Enhanced pic function for all layouts
        function pic(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update all preview images
                    const previews = document.querySelectorAll('[id^="previewImage"]');
                    const containers = document.querySelectorAll('[id^="imagePreviewContainer"]');
                    
                    previews.forEach(preview => {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    });
                    
                    containers.forEach(container => {
                        container.style.display = 'block';
                    });
                }
                reader.readAsDataURL(file);
            }
        }
        
        // Enhanced class_set function for all layouts
        function class_set() {
            // Get values from active layout
            let classValue, sessionValue;
            
            if (window.innerWidth < 768) {
                // Mobile
                classValue = document.getElementById("class_nm1").value;
                sessionValue = document.getElementById("class_nm2").value;
            } else if (window.innerWidth < 1024) {
                // Tablet
                classValue = document.getElementById("class_nm1_tablet").value;
                sessionValue = document.getElementById("class_nm2_tablet").value;
            } else {
                // Desktop
                classValue = document.getElementById("class_nm1_desktop").value;
                sessionValue = document.getElementById("class_nm2_desktop").value;
            }
            
            // Update subjects
            $.ajax({
                url: "show_class.php",
                method: "POST",
                data: { id: classValue },
                success: function(data) {
                    $("#ans, #ansTablet, #ansDesktop").html(data);
                }
            });
            
            // Update fees
            $.ajax({
                url: "fee_struct.php",
                method: "POST",
                data: { id: classValue, id1: sessionValue },
                success: function(data) {
                    $("#fees, #feesTablet, #feesDesktop").html(data);
                }
            });
        }
    </script>

</body>
</html>
