<?php
$k= trim($_POST['id']);
$j= trim($_POST['id1']);
$d= trim($_POST['id2']);
$conn1 = mysqli_connect("localhost","root","","school");
$sql1="select * from fee_struct where class_id = {$k} and st_Session = '{$j}'";
$result1 = mysqli_query($conn1,$sql1);
while($rows1 = mysqli_fetch_array ($result1)){
?> 

<?php }?>