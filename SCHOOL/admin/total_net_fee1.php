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
          <div class="summary-section">
              <div class="card border-0" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                  <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 20px 20px 0 0; border: none;">
                      <h5 class="mb-0 text-center">
                          <i class="bi bi-receipt me-2"></i>Fee Summary
                      </h5>
                  </div>
                  <div class="card-body p-4">
                      <div class="row g-3">
                          <div class="col-md-6">
                              <div class="d-flex justify-content-between align-items-center p-3" style="background: white; border-radius: 15px; border-left: 4px solid #4facfe;">
                                  <span style="color: #718096; font-weight: 500;">Total Fee:</span>
                                  <span id="totalFeeSum" class="fw-bold" style="color: #2d3748; font-size: 1.1rem;">₹<?php echo number_format($to)?></span>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="d-flex justify-content-between align-items-center p-3" style="background: white; border-radius: 15px; border-left: 4px solid #fcb045;">
                                  <span style="color: #718096; font-weight: 500;">Discount:</span>
                                  <span id="discountAmount" class="fw-bold" style="color: #fd1d1d; font-size: 1.1rem;">₹<?php echo number_format($tot). " (". $n."%)"?></span>
                              </div>
                          </div>
                      </div>
                      <div class="final-amount-section mt-4">
                          <div class="alert alert-success d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none; color: white; border-radius: 15px;">
                              <span style="font-size: 1.2rem; font-weight: 600;">Final Amount:</span>
                              <span id="finalAmount" style="font-size: 1.5rem; font-weight: 700;">₹<?php echo number_format($total) ?></span>
                          </div>
                      </div>
                      <input type="hidden" name="total_amount" value="<?php echo $total ?>">
                      <input type="hidden" name="discount_amount" value="<?php echo $tot ?>">
                      <small id="feeNote" class="form-text text-muted d-block text-center mt-3" style="font-style: italic;">
                          <i class="bi bi-info-circle me-1"></i>Tuition Fee (₹<?php echo number_format($l) ?>) included in calculation
                      </small>
                  </div>
              </div>
          </div>
          <?php }
}
          else{
            while($rows1 = mysqli_fetch_array ($result1)){
?> 
      <?php
          $to = $rows1['Form_fee']+$rows1['AD_fee']+$rows1['MS_CHG']+$rows1['CM']+$rows1['Exam_fee']+$l;
          ?>
        <div class="summary-section">
            <div class="card border-0" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 20px 20px 0 0; border: none;">
                    <h5 class="mb-0 text-center">
                        <i class="bi bi-receipt me-2"></i>Fee Summary
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="final-amount-section">
                        <div class="alert alert-success d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none; color: white; border-radius: 15px;">
                            <span style="font-size: 1.2rem; font-weight: 600;">Total Fee:</span>
                            <span id="totalFeeSum" style="font-size: 1.5rem; font-weight: 700;">₹<?php echo number_format($to)?></span>
                        </div>
                    </div>
                    <small id="feeNote" class="form-text text-muted d-block text-center mt-3" style="font-style: italic;">
                        <i class="bi bi-info-circle me-1"></i>Tuition Fee (₹<?php echo number_format($l) ?>) included in calculation
                    </small>
                </div>
            </div>
        </div>
<?php 
}
}
?>
