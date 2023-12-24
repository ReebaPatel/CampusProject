<?php
// $showAlert=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$ename = $_POST['ename'];
$startdate = $_POST["startdate"];
$enddate = $_POST["enddate"];
$venue = $_POST["venue"];
$coordinatorname = $_POST["coordinatorname"];
$coordinatorcontact = $_POST["coordinatorcontact"];
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
$servername = "localhost";
$username = "root";
$password = "";
$database = "events";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
   

    $sql = "INSERT INTO `events` (`EName`, `startdate`, `enddate`, `venue`, `coordinatorname`, `coordinatorcontact`) VALUES ('$ename', '$startdate', '$enddate', '$venue', '$coordinatorname', '$coordinatorcontact')";
    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);
// if(isset($_POST['submit'])){

}
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php require '_nav.php' ?>
    <?php
    //  if ($showAlert) {
    //     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //     <strong>Sucess!</strong> Your account is created and you can Login now.
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>';
    // }
    ?>
    <div class="container my-4">
        <form method = "POST" action ="/MyProject/CampusProject/partials/_addEvents.php" class="row g-3">
            <div class="col-12">
                <label for="ename" class="form-label">Name Of The Event</label>
                <input type="text" class="form-control" id="ename" name = "ename">
            </div>
            <div class="col-md-6">
                <label for="startdate" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="startdate" name= "startdate">
            </div>
            <div class="col-md-6">
                <label for="enddate" class="form-label">End Date</label>
                <input type="date" class="form-control" id="enddate" name="enddate">
            </div>
            <div class="col-12">
                <label for="venue" class="form-label">Venue</label>
                <input type="varchar" class="form-control" id="venue" name="venue">
            </div>
            <div class="col-md-6">
                <label for="coordinatorname" class="form-label">Coordinator Name</label>
                <input type="text" class="form-control" id="coordinatorname" name ="coordinatorname">
            </div>
            <div class="col-md-6">
                <label for="coordinatorcontact" class="form-label">Coordinator Contact No.</label>
                <input type="text" class="form-control" id="coordinatorcontact" name="coordinatorcontact">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add Event</button>
            </div>
        </form>
    </div>
</body>

</html>