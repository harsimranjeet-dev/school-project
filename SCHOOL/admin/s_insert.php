<?php
session_start();
include("connection.php");
$target_dir = "../std_pic/";
$target_file = $target_dir . basename($_FILES["Fileupload"]["name"]);
$uploadOK = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$allowed_types= ['jpg','png','gif'];
if(!in_array($imageFileType,$allowed_types)){
  $_SESSION['form_err']="SORRY ! only .jpg, .png, .gif files are allowed<br>";
  $uploadOK = 0;
  echo "error";
  header("Location:students_reg.php");
}
else{
  $_SESSION['form_err']="";
}
 $s_details=$_POST["SiblingDetails"]; 
 $f_f = $_POST['form_fee'];
 $ad_f = $_POST['ad_fee'];
 $ms = $_POST['ms_chg'];
 $c = $_POST['cm'];
 $e_f = $_POST['e_fee'];
 $reg_num= $_POST['REG_NO'];
 $snf = $_POST['SNf'];
 $snl = $_POST['SNl'];
 $Class_nm1 = $_POST['class_nm1'];
 $section = $_POST['Section'];
 $DoB = $_POST['DOB'];
 $gender = $_POST['Gender'];
 $fatherf = $_POST['Fatherf'];
 $fatherl = $_POST['Fatherl'];
 $motherf = $_POST['Motherf'];
 $motherl = $_POST['Motherl'];
 $streetAD = $_POST['StreetAD'];
 $streetADs = $_POST['StreetADs'];
 $city = $_POST['City'];
 $state = $_POST['State'];
 $postal = $_POST['Postal'];
 $phone = $_POST['Phone'];
 $email = $_POST['Email'];
 $Class_nm2 = $_POST['class_nm2'];
 $pic_nm= $target_dir.trim($_POST['REG_NO']).".".$imageFileType;
//  $conn1 = mysqli_connect("localhost","root","","school");
 $sql2 = "SELECT class_name FROM classes WHERE class_id =  $Class_nm1;";
 $result1 = mysqli_query($conn,$sql2);
 $rows1 = mysqli_fetch_array ($result1);
 $class_n = $rows1['class_name'];
  $sql = "INSERT INTO students (First_Name, Last_Name, Class, Section, DoB, Gender, F_First_Name, F_Last_Name , M_First_Name, M_Last_Name, S_Address, S_Address_s, City, State, Zip_Code, Phone, Email, S_REG_NUM, std_pic, st_Session,sibling_dcp)
  VALUES ('$snf', '$snl', '$class_n', '$section', '$DoB', '$gender', '$fatherf', '$fatherl','$motherf','$motherl', '$streetAD', '$streetADs', '$city', '$state', '$postal', '$phone', '$email', $reg_num , '$pic_nm', '$Class_nm2','$s_details')";
  
  
  if (mysqli_query($conn, $sql)) {
    $sql1 ="update setting_tb_std set s_reg_no = $reg_num";
    $sql3 = "UPDATE fee_struct SET Form_fee = $f_f, AD_fee = $ad_f, MS_CHG = $ms, CM = $c, Exam_Fee = $e_f WHERE class_id = $Class_nm1 AND st_Session = '$Class_nm2';";
    mysqli_query($conn,$sql1);
      mysqli_query($conn,$sql3);
    if($uploadOK == 1){
      move_uploaded_file($_FILES["Fileupload"]["tmp_name"],$pic_nm);
    }
    echo "<pre>";
print_r($_FILES);
echo "</pre>";
    // header("location:student_transec.php?re=$reg_num");
    echo "done";
    echo $f_f . $ad_f . $ms . $c . $e_f . $Class_nm2 . $Class_nm1; 
    echo $sql3;
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
?>