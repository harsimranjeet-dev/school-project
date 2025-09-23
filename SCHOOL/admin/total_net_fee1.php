<?php 
$k= trim($_POST['id']);
$s= trim($_POST['id1']);
$l= trim($_POST['id2']);
$n= trim($_POST['id3']);
$conn1 = mysqli_connect("localhost","root","","school");
$sql1="select * from fee_struct where class_id = {$k} and st_Session = '{$s}'";
$result1 = mysqli_query($conn1,$sql1);
if($n == 10 || $n == 15 || $n == 20){
while($rows1 = mysqli_fetch_array ($result1)){
?>  <?php
          $to = $rows1['Form_fee']+$rows1['AD_fee']+$rows1['MS_CHG']+$rows1['CM']+$rows1['Exam_fee']+$l;
          $tot = ($to*$n) /100;
          $total = $to-$tot;
          ?>
          <div  class="summary-section ms-5 me-5">
              <h5 class="mb-3 text-center">Fee Summary</h5>
              <p>Total Fee: <span id="totalFeeSum" class="fw-bold"><?php echo "₹".$to?></span></p>
              <p>Discount: <span id="discountAmount" class="fw-bold"><?php echo "₹".$tot. " (". $n."%)"?></span></p>
              <p class="final-amount">Final Amount: <span id="finalAmount"><?php echo "₹". $total ?></span></p>
              <small id="feeNote" class="form-text text-muted d-block text-end"><?php echo "Quarterly ₹". $l ." fee included"?></small>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
              <button style="margin-right: 50px;" type="button" class="btn btn-primary px-4 mb-3">Submit Payment</button>
            </div>
          <?php }
}
          else{
            while($rows1 = mysqli_fetch_array ($result1)){
?> 
      <?php
          $to = $rows1['Form_fee']+$rows1['AD_fee']+$rows1['MS_CHG']+$rows1['CM']+$rows1['Exam_fee']+$l;
          ?>
        <div  class="summary-section ms-5 me-5 mb-5">
              <h5 class="mb-3 text-center">Fee Summary</h5>
              <p>Total Fee: <span id="totalFeeSum" class="fw-bold"><?php echo "₹".$to?></span></p>
              <small id="feeNote" class="form-text text-muted d-block text-end"><?php echo "₹". $l ."Tuition fee included"?></small>
        </div>
<?php 
}
}
?>
