<?php
ob_start();
error_reporting(E_ERROR | E_PARSE);
// remove all session variables
session_start();
session_unset();

// destroy the session
session_destroy();
header("Location:index.php");
die();
?>