<?php 
$k= trim($_POST['id']);
$j= trim($_POST['id1']);
$conn1 = mysqli_connect("localhost","root","","school");
$sql1="select * from fee_struct where class_id = {$k} and st_Session = '{$j}'";
$result1 = mysqli_query($conn1,$sql1);
while($rows1 = mysqli_fetch_array ($result1)){
?> 
         <p class="fee_p">Fee Structure</p><br>
          <label for="form_fee">Form Fee:</label>
          <input style="margin-left: 0px; width: 150px;" name="form_fee" type="text" value="<?php echo $rows1['Form_fee']?>"><br>
          <label for="ad_fee">Admission Fee:</label>
          <input style="margin-left: 0px; width: 130px;" name="ad_fee" type="text" value="<?php echo $rows1['AD_fee']?>"><br>
          <label for="ms_chg">Miscellaneous<br> Charges:</label>
          <input style="margin-left: 0px; width: 150px;" name="ms_chg" type="text" value="<?php echo $rows1['MS_CHG']?>"><br>
          <label for="cm">Caution Money:</label>
          <input style="margin-left: 0px; width: 150px;" name="cm" type="text" value="<?php echo $rows1['CM']?>"><br>
          <label for="e_fee">Exam Fee:</label>
          <input style="margin-left: 0px; width: 150px;" name="e_fee" type="text" value="<?php echo $rows1['Exam_fee']?>"><br>
          <span> Total fee: <?php 
          $to = $rows1['Form_fee']+$rows1['AD_fee']+$rows1['MS_CHG']+$rows1['CM']+$rows1['Exam_fee'];
          echo $to;
          ?></span><span style="color: #313131ff; font-size: 10px;"> *Tuition Fee exlcuded </span>
          <label for="t_fee">Tuition Fee:</label>
        <select name="class_nm3" id="class_nm3" onchange="net_fee()">
        <option value="<?php echo $rows1['Tuition']?>"> Monthly</option>
        <option value="<?php echo $rows1['Tuition']*3?>">Quarterly</option>
        <option value="<?php echo $rows1['Tuition']*12?>">Yearly</option>
        </select><br>
         <div id="net_f"></div>
          
<?php }
?>

