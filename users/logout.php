<?php
session_start();
include("includes/config.php");

// Ensure session login is cleared correctly
$_SESSION['login'] = ""; // Or use unset($_SESSION['login']);

date_default_timezone_set('Asia/Kolkata');
$ldate = date('d-m-Y h:i:s A', time());

// Use a prepared statement to prevent SQL injection
$stmt = $bd->prepare("UPDATE userlog SET logout = ? WHERE username = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param('ss', $ldate, $_SESSION['login']);
$stmt->execute();
$stmt->close();

session_unset(); // Clear all session variables
session_destroy(); // Destroy the session

?>
<script language="javascript">
document.location = "../index.html";
</script>
