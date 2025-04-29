<?php
    session_start();
    include("ngo_loggedin_nav.php");
    include("./server/config.php");

    if(!isset($_SESSION["ngo-email"])){
        header("Location: ngo-login.php");
        exit();
    }
    
    $email = $_SESSION['ngo-email'];
    $sql = "SELECT * FROM ngo WHERE ngo_email = '$email' ";
    $result = mysqli_query($dbcon, $sql);

    $row = null;
    if($result && mysqli_num_rows($result) > 0 )
    {
        $row = mysqli_fetch_assoc($result);
    }

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container" style="transform: translateY(50vh)">
        <h1>NGO DASHBOARD</h1>
        <h2>Welcome: <?php echo "{$row['ngo_name']}"?></h2>
        <button><a href="ngo-logout.php">LOGOUT</a></button>

    </div>
</body>
</html>