<?php

include_once 'connection.php'; 
$description = $_POST['description'];
$for_month = $_POST['for_month'];
$total_am = $_POST['total_amount'];
$discount_am = $_POST['discount_amount'];
$reg_num = $_POST['re'];
$tuition_fee = $_POST['TU_fee'];
$mode = $_POST['mode'];

$student_sql = "SELECT Class, Section, st_Session FROM students WHERE S_REG_NUM = $reg_num";
$student_result = mysqli_query($conn, $student_sql);
if (!$student_result || mysqli_num_rows($student_result) == 0) {
    die("Error: Could not find student with Registration Number: $reg_num");
}
$student_data = mysqli_fetch_assoc($student_result);
$class_name = $student_data['Class'];
$section = $student_data['Section'];
$session = $student_data['st_Session'];

$insert_transaction_sql = "INSERT INTO transaction (s_reg_no,description,for_month,s_session,class_name,class_section,m_fee,t_date) VALUES (
    '$reg_num',
    '$description',
    '$for_month',
    '$session',
    '$class_name',
    '$section',
    '$tuition_fee',
     NOW()
)";

if (mysqli_query($conn, $insert_transaction_sql)) {
    $insert_second_table_sql = "UPDATE students SET tuition_fee_mode = '$mode', total_fee = '$total_am', sibling_discount = '$discount_am', 
        monthly_fee = '$tuition_fee'
        WHERE S_REG_NUM = $reg_num";
    if (mysqli_query($conn, $insert_second_table_sql)) {
        header("Location: student_transec.php?re=$reg_num&status=success");
        exit();
    } else {
        die("Error updating student data: " . mysqli_error($conn));
    }
} else {
    die("Error inserting transaction data: " . mysqli_error($conn));
}

$conn->close();
?>
