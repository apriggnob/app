<?php
require_once '../config.php';

// Destroy session
session_destroy();

// Redirect to login page
header("Location: " . BASE_URL . "auth/login.php");
exit();
?>