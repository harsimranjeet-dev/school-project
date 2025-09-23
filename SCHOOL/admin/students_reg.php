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
  
    <title>Student Form</title>
  <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
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
  </script>
  <link rel="stylesheet" href="students_reg.css">
</head>
<body>
  <?php 
  if($_SESSION['form_err']!=""){
    echo $_SESSION['form_err'];
  }
  ?>
  <h1 class="heading">Student Admission Form</h1>
  <form  action="s_insert.php" method="POST" enctype="multipart/form-data">
  <div class="parent">
    <div class="div1">
      <div class="form_div">
      <p style="text-align: center;">Student Details</p>
      <div>
        <label for="no">Registration Number:</label>
        <input type="text" name="REG_NO" value="<?php echo $reg_no + 1 ;?>" readonly="readonly" required><label for="current-date-input" style="margin-left:10px;">Date:</label><input type="date" id="current-date-input" style="padding-left: 10px;"><br>
        <label for="sn">Student Name:</label>
        <input style="margin-left:60px;" type="text" name="SNf" placeholder="First" required><input type="text" name="SNl" placeholder="Last" required><br>
      </div>
        <div>
        <label for="class_nm1">Class:</label>
        <select name="class_nm1" id="class_nm1" onchange="class_set()" required>
        <?php while($rows = mysqli_fetch_array($result)){?>
          <option value="<?php echo $rows ["class_id"];?>"><?php echo $rows ["class_name"];?> </option>
          <?php }?>
        </select>
        <label for="class_nm2">Session:</label>
        <select name="class_nm2" id="class_nm2" onchange="class_set()" required>
        <?php while($rows3 = mysqli_fetch_array($result3)){
          ?>
          <option value="<?php echo $rows3 ["st_Session"];?>"><?php echo $rows3 ["st_Session"];?> </option><?php }?>
        </select>
        <label for="Section">Section:</label>
        <select name="Section" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select><br></div>
        <div>
        <label for="DOB">Student's DoB:</label>
        <input type="date" name="DOB" required><br></div>
        <div>
        <label for="Gender">Student's Gender:</label>
        <input style="height: auto;" type="radio" name="Gender" value="He" required>He<input style="height: auto;" type="radio" name="Gender" value="She" required>She<br></div>
        <div>
        <label for="Father">Father Name:</label>
        <input style="margin-left:20px;" type="text" name="Fatherf" placeholder="First" required><input type="text" name="Fatherl" placeholder="Last" required><br>
        </div>
        <div>
        <label for="Motherf">Mother Name:</label>
        <input style="margin-left:15px;" type="text" name="Motherf" placeholder="First" required><input type="text" name="Motherl" placeholder="Last" required><br>
        </div>
        <div>
        <label for="Address">Curent Adress:</label>
        <input type="text" name="StreetAD" placeholder="Street Address" required>
        <input style="margin-left:7px;" type="text" name="StreetADs" placeholder="Street Address 2 Optional" ><br>
        <input type="text" name="City" placeholder="City"><input type="text" name="State" placeholder="State" required>
        <input style="width:150px" type="text" name="Postal" placeholder="Postal/Zip Code" required><br>
      </div>
      <!-- Contact + Sibling details block -->
      <div class="contact-sibling-wrapper">
        <div class="contact-fields">
          <div>
            <label for="Phone">Phone:</label>
            <input type="number" name="Phone" placeholder="#####-#####" required>
          </div>
          <div>
            <label for="Email">Email:</label>
            <input name="Email" type="email" required>
          </div>
        </div>
        <div class="sibling-details">
          <label for="SiblingDetails">Sibling details:</label>
          <textarea name="SiblingDetails" id="SiblingDetails" rows="4" placeholder="List each sibling: Name - Class / Roll"></textarea>
        </div>
      </div>
      </div>
        </div>
        <div style="width: 335px; height: 200px;">
        <div class="div2">
          <p style="text-align: center;">Student Profile Picture</p>
          <div class="pic">
            <div>
        <label for="Fileupload" class="custom-file-button">Upload Image</label>
        <input id="Fileupload" class="file_up" name="Fileupload" type="file" style="display: none; text-align:left;" accept="image/*" onchange="pic(event)">
        </div>
        <div id="imagePreviewContainer">
            <img id="previewImage" src="#" alt="Image Preview" style=" display:none; max-width:80px; max-height:100px;">
        </div>
        </div>
        </div>
      
        <div class="subjects">
        <table>
          <thread>
            <th style="width: 250px; color: #0b59ffff; font-size: 20px; font-weight: 800; margin-top: 0px; margin-bottom: 0px; text-align: center;">Subjects</th>
          </thread>
          <tbody id ="ans"><td><h2 align="center">Select Class!</h2></td> </tbody>
        </table>
        </div>
        </div>
        <div class="div3">
        
        
        <div id="fees"><p class="fee_p">Fee Structure</p>
        <h2 align="center">Select Class!</h2><br>
      </div>
      <button>Submit</button>
    </form>
    <div>
        
         <script src="js\preview.js"></script>
           <script>
            document.addEventListener('DOMContentLoaded', (event) => {
            const dateInput = document.getElementById('current-date-input');
            const today = new Date().toISOString().split('T')[0];

            dateInput.value = today;
        });
    </script>
</body> 
</html> ,
