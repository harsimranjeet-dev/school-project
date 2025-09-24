<?php
// This file handles the fee transaction and student data insertion.
// It is called from student_transec.php.

include_once 'connection.php'; // Assuming this file creates the $conn variable.

// Since the data from the form is not being passed directly via POST,
// we need to retrieve it from the GET request parameters and the database.
// The data from the AJAX call in total_net_fee1.php is the source.

// 1. Get the student's registration number and fee data from the GET request.
// The form in student_transec.php does not post the reg number, so we get it from the URL.
if (!isset($_GET['re']) || !ctype_digit((string)$_GET['re'])) {
    die("Error: Student Registration Number not provided or invalid.");
}
$reg_num = (int)$_GET['re'];

// These values are passed from student_transec.php via the form action URL.
// We must validate and sanitize them.
$form_fee = isset($_GET['form_fee']) ? floatval($_GET['form_fee']) : 0;
$admission_fee = isset($_GET['ad_fee']) ? floatval($_GET['ad_fee']) : 0;
$misc_charges = isset($_GET['ms_chg']) ? floatval($_GET['ms_chg']) : 0;
$caution_money = isset($_GET['cm']) ? floatval($_GET['cm']) : 0;
$exam_fee = isset($_GET['e_fee']) ? floatval($_GET['e_fee']) : 0;
$tuition_fee = isset($_GET['t_fee']) ? floatval($_GET['t_fee']) : 0;
$billing_cycle = isset($_GET['billing_cycle']) ? $_GET['billing_cycle'] : 'Quarterly';
$discount_percent = isset($_GET['discount_percent']) ? floatval($_GET['discount_percent']) : 0;

// The user has requested to get the calculated values from the URL, so we
// retrieve total, discount amount, and net amount from the GET request.
$total_amount = isset($_GET['total_amount']) ? floatval($_GET['total_amount']) : 0;
$discount_amount = isset($_GET['discount_amount']) ? floatval($_GET['discount_amount']) : 0;
$net_amount = isset($_GET['net_amount']) ? floatval($_GET['net_amount']) : 0;


// 2. Fetch student details to get class, section, and session.
$student_sql = "SELECT Class, Section, st_Session FROM students WHERE S_REG_NUM = $reg_num";
$student_result = mysqli_query($conn, $student_sql);
if (!$student_result || mysqli_num_rows($student_result) == 0) {
    die("Error: Could not find student with Registration Number: $reg_num");
}
$student_data = mysqli_fetch_assoc($student_result);
$class_name = $student_data['Class'];
$section = $student_data['Section'];
$session = $student_data['st_Session'];

// 3. Insert data into the 'transaction' table using a simple query.
// Note: This method is susceptible to SQL injection.
$insert_transaction_sql = "INSERT INTO `transaction` (
    `student_id`,
    `class`,
    `section`,
    `session`,
    `form_fee`,
    `admission_fee`,
    `misc_charges`,
    `caution_money`,
    `exam_fee`,
    `tuition_fee`,
    `billing_cycle`,
    `discount_percentage`,
    `discount_amount`,
    `total_amount`,
    `net_amount`,
    `transaction_date`
) VALUES (
    '$reg_num',
    '$class_name',
    '$section',
    '$session',
    '$form_fee',
    '$admission_fee',
    '$misc_charges',
    '$caution_money',
    '$exam_fee',
    '$tuition_fee',
    '$billing_cycle',
    '$discount_percent',
    '$discount_amount',
    '$total_amount',
    '$net_amount',
    NOW()
)";

if (mysqli_query($conn, $insert_transaction_sql)) {
    // Success: Redirect back to the student transaction page with a success message.
    header("Location: student_transec.php?re=$reg_num&status=success");
    exit();
} else {
    // Failure
    die("Error inserting transaction data: " . mysqli_error($conn));
}

$conn->close();
?>