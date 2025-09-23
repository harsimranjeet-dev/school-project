<?php
include("connection.php");
 $uid = $_POST['user'];
 $em = $_POST['email'];
 $pa = $_POST['password'];
 $pr = $_POST['privilege'];
  $sql = "INSERT INTO users (username, email, password, privilege)
  VALUES ('$uid', '$em', '$pa', '$pr')";
  if (mysqli_query($conn, $sql)) {
    header("location:user_func.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
?>