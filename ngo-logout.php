<?php

    session_start();
    include("./server/config.php");
    $email = $_SESSION['ngo-email'];

    // $sql = "DELETE FROM ngo_login  WHERE ngo_email = '$email' ";
    // mysqli_query($dbcon, $sql);


    session_unset();
    session_destroy();
    header("Location: index.php");



    exit();

?>