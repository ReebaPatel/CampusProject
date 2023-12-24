<?php
session_start();

if((!isset($_SESSION['loggedin'])) || $_SESSION['loggedin']!=true){
   
    header("location: login.php");

    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Welcome</title>
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    <div class="container my-4">
    <h1>Welcome <?php echo $_SESSION['username']?></h1>
    <br>
    <br>
    <a class="btn btn-primary" href="/MyProject/CampusProject/logout.php" role="button">Logout</a>
    </div>
</body>
</html>