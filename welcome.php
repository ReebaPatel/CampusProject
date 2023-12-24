<?php
include 'partials/_dbconnect.php';
session_start();

if ((!isset($_SESSION['loggedin'])) || $_SESSION['loggedin'] != true) {

    header("location: login.php");

    exit;
}

?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "events";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}else{
    $query="select * from events";
$result = mysqli_query($conn,$query);
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
        <h1>Welcome <?php echo $_SESSION['username'] ?></h1>
        Here are all the events:
    </div>

    <div class="card-body">
        <table class="table table-bordered text-center">
            <tr class="bg-dark text-white">
                <td>Event Name</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Venue</td>
                <td>Coordinator Name</td>
                <td>Coordinator Contact</td>
            </tr>
            <tr>
                <?php
                while($row=mysqli_fetch_assoc($result)){
                    ?>

                    <td><?php echo $row['EName']; ?></td>
                    <td><?php echo $row['startdate']; ?></td>
                    <td><?php echo $row['enddate']; ?></td>
                    <td><?php echo $row['venue']; ?></td>
                    <td><?php echo $row['coordinatorname']; ?></td>
                    <td><?php echo $row['coordinatorcontact']; ?></td>
                    </tr>

                
                <?php
                }
                ?>
           


        </table>


    </div>
    <!-- 
    <?php
    // $sql ="select * from users";
    // $result = mysqli_query($conn, $sql);
    // while($row = mysqli_fetch_assoc($result)){
    //     echo $row['ename'];

    // }
    ?> -->
</body>

</html>