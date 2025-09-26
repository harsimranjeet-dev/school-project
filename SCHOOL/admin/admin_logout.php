<?php
session_start();

// Clear all session variables
$_SESSION['user_nm'] = "Guest";
$_SESSION['user_type'] = null;
$_SESSION['userlogin'] = "mt";
$_SESSION['login_type_selected'] = null;

// Destroy the session completely
session_unset();
session_destroy();

// Start a new session for guest access
session_start();
$_SESSION['user_nm'] = "Guest";
$_SESSION['userlogin'] = "mt";

// Redirect to homepage with logout success message
header("Location: admin_index.php?id=1&logout=success");
exit();
?>