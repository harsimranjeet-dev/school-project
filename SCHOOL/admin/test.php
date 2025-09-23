<?php
$k= trim($_POST['id']);
$conn1 = mysqli_connect("localhost","root","","school");
$sql1 = "SELECT * FROM `students` WHERE s_reg_num like '{$k}%' or First_Name like '{$k}%' or Last_Name like '{$k}%' or DoB like '{$k}%' or class like '{$k}%' or Section like '{$k}%' or F_First_Name like '{$k}%' or F_Last_Name like '{$k}%' or M_First_Name like '{$k}%' or M_Last_Name like '{$k}%' or phone like '{$k}%'  or email like '{$k}%';";
$result1 = mysqli_query($conn1,$sql1);
while($rows1 = mysqli_fetch_array ($result1)){
?>
    <tr>
        <td><?php echo $rows1['S_REG_NUM'] ?></td>
        <td><?php echo $rows1['Class']." ".$rows1['Section'] ?></td>
        <td><?php echo $rows1['First_Name']." ".$rows1['Last_Name'] ?></td>
        <td><?php echo $rows1['F_First_Name']." ".$rows1['F_Last_Name'] ?></td>
        <td style="color:red !important;"><?php echo $rows1['DoB'] ?></td>
        <td><a href="edit.php?id=<?php echo $rows1['id']; ?>">Edit</a></td>
        <td><a href="delete.php?id=<?php echo $rows1['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
    </tr>
<?php }
?>