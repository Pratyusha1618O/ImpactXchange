<?php

    session_start();
    include("./server/config.php");
    $email = $_SESSION['admin-email'];

    $sql = "DELETE FROM admin_login  WHERE admin_email = '$email' ";
    mysqli_query($dbcon, $sql);


    session_unset();
    session_destroy();
    header("Location: index.php");



    exit();

?>