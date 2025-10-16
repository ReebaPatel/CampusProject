<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: ../login.php");
    exit;
}

$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconn.php';
    
    $ename = mysqli_real_escape_string($conn_events, $_POST['ename']);
    $startdate = mysqli_real_escape_string($conn_events, $_POST["startdate"]);
    $enddate = mysqli_real_escape_string($conn_events, $_POST["enddate"]);
    $venue = mysqli_real_escape_string($conn_events, $_POST["venue"]);
    $coordinatorname = mysqli_real_escape_string($conn_events, $_POST["coordinatorname"]);
    $coordinatorcontact = mysqli_real_escape_string($conn_events, $_POST["coordinatorcontact"]);
    
    // Validate dates
    if (strtotime($enddate) < strtotime($startdate)) {
        $showError = "End date cannot be before start date";
    } else {
        $sql = "INSERT INTO events (EName, startdate, enddate, venue, coordinatorname, coordinatorcontact) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn_events, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $ename, $startdate, $enddate, $venue, $coordinatorname, $coordinatorcontact);
        
        if (mysqli_stmt_execute($stmt)) {
            $showAlert = true;
        } else {
            $showError = "Failed to add event";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Event - Campus Event Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .form-container {
            max-width: 700px;
            margin: 50px auto;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 25px;
        }
    </style>
</head>
<body>
    <?php require '_nav.php' ?>
    
    <div class="container form-container">
        <?php
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> <strong>Success!</strong> Event added successfully. <a href="../welcome.php" class="alert-link">View all events</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if ($showError) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> <strong>Error!</strong> ' . htmlspecialchars($showError) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>

        <div class="card">
            <div class="card-header text-center">
                <h3 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Event</h3>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="/CampusProject/partials/_addEvents.php">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="ename" class="form-label"><i class="bi bi-bookmark"></i> Event Name *</label>
                            <input type="text" class="form-control form-control-lg" id="ename" name="ename" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="startdate" class="form-label"><i class="bi bi-calendar-check"></i> Start Date *</label>
                            <input type="date" class="form-control form-control-lg" id="startdate" name="startdate" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="enddate" class="form-label"><i class="bi bi-calendar-x"></i> End Date *</label>
                            <input type="date" class="form-control form-control-lg" id="enddate" name="enddate" required>
                        </div>
                        
                        <div class="col-12">
                            <label for="venue" class="form-label"><i class="bi bi-geo-alt"></i> Venue *</label>
                            <input type="text" class="form-control form-control-lg" id="venue" name="venue" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="coordinatorname" class="form-label"><i class="bi bi-person-badge"></i> Coordinator Name *</label>
                            <input type="text" class="form-control form-control-lg" id="coordinatorname" name="coordinatorname" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="coordinatorcontact" class="form-label"><i class="bi bi-telephone"></i> Coordinator Contact *</label>
                            <input type="tel" class="form-control form-control-lg" id="coordinatorcontact" name="coordinatorcontact" pattern="[0-9]{10}" placeholder="10-digit number" required>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-plus-circle"></i> Add Event
                            </button>
                        </div>
                        
                        <div class="col-12">
                            <a href="../welcome.php" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-arrow-left"></i> Back to Events
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>