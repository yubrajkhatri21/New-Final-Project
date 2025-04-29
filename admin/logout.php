<!-- filepath: c:\xampp\htdocs\myfinalproject\admin\logout.php -->
<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?>