<?php
session_start();

// Unset user id 
unset($_SESSION['user_id']);

session_destroy();

header("Location: index.php");
exit();
?>
