<?php

session_start();
include("./server/config.php");
$email = $_SESSION['email'];

$sql = "DELETE FROM login  WHERE user_email = '$email' ";
mysqli_query($dbcon, $sql);


session_unset();
session_destroy();
header("Location: index.php");



exit();

?>