<?php
session_start();
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST["password"];
    $cpassword = $_POST["confpassword"];

    // Check if username exists
    $existSql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $existSql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $numExistRows = mysqli_num_rows($result);
    
    if ($numExistRows > 0) {
        $showError = "Username already exists";
    } else {
        if (strlen($password) < 8) {
            $showError = "Password must be at least 8 characters";
        } elseif ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (Username, Password, Date) VALUES (?, ?, current_timestamp())";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $hash);
            $result = mysqli_stmt_execute($stmt);
            
            if ($result) {
                $showAlert = true;
            }
            mysqli_stmt_close($stmt);
        } else {
            $showError = "Passwords do not match";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Campus Event Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .register-container {
            max-width: 500px;
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
    <?php require 'partials/_nav.php' ?>
    
    <div class="container register-container">
        <?php
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> <strong>Success!</strong> Your account has been created. <a href="login.php" class="alert-link">Login now</a>
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
                <h3 class="mb-0"><i class="bi bi-person-plus"></i> Register</h3>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle"></i> Already have an account? <a href="login.php" class="alert-link">Login here</a>
                </div>

                <form action="/CampusProject/register.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label"><i class="bi bi-person"></i> Username</label>
                        <input type="text" maxlength="30" class="form-control form-control-lg" id="username" name="username" required>
                        <div class="form-text">Maximum 30 characters</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="bi bi-lock"></i> Password</label>
                        <input type="password" minlength="8" class="form-control form-control-lg" id="password" name="password" required>
                        <div class="form-text">Minimum 8 characters</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confpassword" class="form-label"><i class="bi bi-lock-fill"></i> Confirm Password</label>
                        <input type="password" class="form-control form-control-lg" id="confpassword" name="confpassword" required>
                        <div class="form-text">Re-enter your password</div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-person-plus"></i> Register
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>