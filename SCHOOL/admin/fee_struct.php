<?php 
$k= trim($_POST['id']);
$j= trim($_POST['id1']);
$conn1 = mysqli_connect("localhost","root","","school");
$sql1="select * from fee_struct where class_id = {$k} and st_Session = '{$j}'";
$result1 = mysqli_query($conn1,$sql1);
while($rows1 = mysqli_fetch_array ($result1)){
?> 
    <div class="fee-structure-section">
        <h4 class="fee-title mb-4">
            <i class="bi bi-currency-dollar me-2" style="color: #667eea;"></i>
            Fee Structure
        </h4>
        
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="form_fee" id="form_fee" value="<?php echo $rows1['Form_fee']?>" readonly>
                    <label for="form_fee">
                        <i class="bi bi-file-text me-2"></i>Form Fee
                    </label>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="ad_fee" id="ad_fee" value="<?php echo $rows1['AD_fee']?>" readonly>
                    <label for="ad_fee">
                        <i class="bi bi-person-check me-2"></i>Admission Fee
                    </label>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="ms_chg" id="ms_chg" value="<?php echo $rows1['MS_CHG']?>" readonly>
                    <label for="ms_chg">
                        <i class="bi bi-gear me-2"></i>Miscellaneous Charges
                    </label>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="cm" id="cm" value="<?php echo $rows1['CM']?>" readonly>
                    <label for="cm">
                        <i class="bi bi-shield-check me-2"></i>Caution Money
                    </label>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" name="e_fee" id="e_fee" value="<?php echo $rows1['Exam_fee']?>" readonly>
                    <label for="e_fee">
                        <i class="bi bi-journal-text me-2"></i>Exam Fee
                    </label>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" name="class_nm3" id="class_nm3" onchange="net_fee()">
                        <option value="<?php echo $rows1['Tuition']?>">Monthly - ₹<?php echo $rows1['Tuition']?></option>
                        <option value="<?php echo $rows1['Tuition']*3?>">Quarterly - ₹<?php echo $rows1['Tuition']*3?></option>
                        <option value="<?php echo $rows1['Tuition']*12?>">Yearly - ₹<?php echo $rows1['Tuition']*12?></option>
                    </select>
                    <label for="class_nm3">
                        <i class="bi bi-calendar-range me-2"></i>Tuition Fee
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Total Fee Display -->
        <div class="fee-summary mt-4">
            <div class="alert alert-info d-flex align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                <i class="bi bi-calculator me-2"></i>
                <div>
                    <strong>Total Fee (excluding Tuition): ₹<?php 
                    $to = $rows1['Form_fee']+$rows1['AD_fee']+$rows1['MS_CHG']+$rows1['CM']+$rows1['Exam_fee'];
                    echo number_format($to);
                    ?></strong>
                    <small class="d-block" style="opacity: 0.8;">*Tuition Fee to be added separately based on payment plan</small>
                </div>
            </div>
        </div>
        
        <div id="net_f" class="net-fee-display mt-3"></div>
    </div>
    
    <style>
        .fee-structure-section .form-floating > .form-control[readonly] {
            background-color: #f8f9fa;
            border-color: #e9ecef;
        }
        
        .fee-title {
            color: #2d3748;
            font-weight: 600;
            border-bottom: 2px solid #667eea;
            padding-bottom: 0.5rem;
        }
        
        .fee-summary .alert {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }
        
        .net-fee-display {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-left: 4px solid #38ef7d;
        }
    </style>
          
<?php }
?>

