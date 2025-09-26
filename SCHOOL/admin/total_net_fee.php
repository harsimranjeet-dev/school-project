<?php 
$k= trim($_POST['id']);
$s= trim($_POST['id5']);
$l= trim($_POST['id8']);
$conn1 = mysqli_connect("localhost","root","","school");
$sql1="select * from fee_struct where class_id = {$k} and st_Session = '{$s}'";
$result1 = mysqli_query($conn1,$sql1);
if(isset($_POST['id8']))
while($rows1 = mysqli_fetch_array ($result1)){
?> 
    <div class="alert alert-success d-flex align-items-center" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none; color: white; border-radius: 15px; margin-top: 1rem;">
        <i class="bi bi-check-circle-fill me-2" style="font-size: 1.5rem;"></i>
        <div>
            <strong style="font-size: 1.2rem;">Total Net Fee: ₹<?php
              $to = $rows1['Form_fee']+$rows1['AD_fee']+$rows1['MS_CHG']+$rows1['CM']+$rows1['Exam_fee']+$l;
              echo number_format($to);
              ?></strong>
            <small class="d-block" style="opacity: 0.8;">*Tuition Fee included in calculation</small>
        </div>
    </div>
<?php }
?>