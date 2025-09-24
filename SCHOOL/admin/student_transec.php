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
  <meta name="viewport" content="width='device-width', initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts for a modern look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .calculator-card {
            max-width: 900px;
            margin: 2rem auto;
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
        }
        .form-label {
            font-weight: 500;
        }
        .summary-section {
            background-color: #e9ecef;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-top: 1rem;
        }
        .summary-section p {
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
        }
        .summary-section .final-amount {
            font-weight: 700;
            font-size: 1.25rem;
            color: #0d6efd;
            border-top: 1px solid #ced4da;
            padding-top: 0.75rem;
            margin-top: 0.75rem;
        }
    </style>
  <title>Document</title>
  <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
  <script>
    function net_fee(){
      var x = '<?php echo $class_id ?>';
      var h = '<?php echo $st_s ?>';
      var d = document.getElementById("tuitionFee").value;
      var n = document.getElementById("discountSelect").value;
      $.ajax({
      url: "total_net_fee1.php",
      method: "POST",
      data: {
        id:x,
        id1:h,
        id2:d,
        id3:n
      },
      success:function(data){
        $("#net_f").html(data);
      }
    });
    }
  </script>
</head>
<body>
<div class="container">
        <div class="card calculator-card">
            <div class="card-header text-center py-3">
                <h2>Fee Structure</h2>
            </div>
            <div class="card-body px-md-5 ps-md-5">
                <form id="feeForm" action="trans_insert.php" method="POST">
                    <!-- Student Details Section -->
                    <h5 class="mb-3">Student Information</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="studentName" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="studentName" value="<?php echo $FN ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="studentClass" class="form-label">Class</label>
                            <input type="text" class="form-control" id="studentClass" value="<?php echo $sec ?>">
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Fee Input Section -->
                    <h5 class="mb-3">Fee Details</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                          <?php
                          while($rows3 = mysqli_fetch_array ($result3)){
                            ?> 
                            <label for="formFee" class="form-label">Form Fee</label>
                            <input type="number" class="form-control" id="formFee" value="<?php echo $rows3['Form_fee']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="admissionFee" class="form-label">Admission Fee</label>
                            <input type="number" class="form-control" id="admissionFee" value="<?php echo $rows3['AD_fee']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="miscCharges" class="form-label">Miscellaneous Charges</label>
                            <input type="number" class="form-control" id="miscCharges" value="<?php echo $rows3['MS_CHG']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="cautionMoney" class="form-label">Caution Money</label>
                            <input type="number" class="form-control" id="cautionMoney" value="<?php echo $rows3['CM']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="examFee" class="form-label">Exam Fee</label>
                            <input type="number" class="form-control" id="examFee" value="<?php echo $rows3['Exam_fee']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="tuitionFee" class="form-label">Tuition Fee</label>
                            <select class="form-select" id="tuitionFee" onchange="net_fee()">
                                <option value="<?php echo $rows3['Tuition']?>"> Monthly</option>
                                <option value="<?php echo $rows3['Tuition']*3?>">Quarterly</option>
                                <option value="<?php echo $rows3['Tuition']*12?>">Yearly</option>
                            </select>
                        </div>
                        <?php }
                          ?>
                    </div>

                    <hr class="my-4">
                        
                    </div>
                    <!-- Discount Section -->
                    <h5 class="px-md-5 pb-md-3">Discount Details</h5>
                    <div class="row p-4 px-md-5 py-md-3">
                      <div class="col-md-6">
                            <label for="discountSelect" class="form-label">Discount</label>
                            <select class="form-select" id="discountSelect" onchange="net_fee()">
                                <option value="0" selected>None (0%)</option>
                                <option value="10">Sibling Discount (10%)</option>
                                <option value="15">Staff Child (15%)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sibling Relation</label>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discountOptions" id="noDiscount" value="0" checked>
                                    <label class="form-check-label" for="noDiscount">None</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discountOptions" id="brother" value="10">
                                    <label class="form-check-label" for="brother">Brother</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discountOptions" id="sister" value="10">
                                    <label class="form-check-label" for="sister">Sister</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fee Summary Section -->
                    <div id="net_f">
                      
                       </div>
                       
                       
                </form>
            </div>
        </div>
    </div>
</body>
</html>