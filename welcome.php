<?php
session_start();

// Check if user is logged in
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;

// Only fetch events if logged in
if ($isLoggedIn) {
    include 'partials/_dbconn.php';
    $query = "SELECT * FROM events ORDER BY startdate DESC";
    $result = mysqli_query($conn_events, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 30px;
        }
        .feature-card {
            border: none;
            border-radius: 15px;
            padding: 30px;
            height: 100%;
            transition: transform 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
            transition: all 0.2s;
        }
        .event-badge {
            font-size: 0.9rem;
            padding: 5px 15px;
        }
        .cta-section {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    
    <div class="hero-section">
        <div class="container text-center">
            <?php if ($isLoggedIn): ?>
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-calendar-event"></i> Welcome Back, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                </h1>
                <p class="lead">Manage and view all campus events in one place</p>
            <?php else: ?>
                <h1 class="display-3 fw-bold">
                    <i class="bi bi-calendar-event"></i> Campus Event Management
                </h1>
                <p class="lead fs-4">Your One-Stop Solution for Campus Events</p>
                <div class="mt-4">
                    <a href="login.php" class="btn btn-light btn-lg me-3">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="register.php" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-person-plus"></i> Register
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="container mb-5">
        <?php if ($isLoggedIn): ?>
            <!-- Logged In User View - Show Events -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="bi bi-list-ul"></i> All Events</h2>
                <a href="partials/_AddEvents.php" class="btn btn-primary btn-lg">
                    <i class="bi bi-plus-circle"></i> Add New Event
                </a>
            </div>

            <div class="table-container">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-bookmark"></i> Event Name</th>
                                    <th><i class="bi bi-calendar-check"></i> Start Date</th>
                                    <th><i class="bi bi-calendar-x"></i> End Date</th>
                                    <th><i class="bi bi-geo-alt"></i> Venue</th>
                                    <th><i class="bi bi-person-badge"></i> Coordinator</th>
                                    <th><i class="bi bi-telephone"></i> Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($row['EName']); ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge event-badge bg-success">
                                                <?php echo date('M d, Y', strtotime($row['startdate'])); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge event-badge bg-danger">
                                                <?php echo date('M d, Y', strtotime($row['enddate'])); ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['venue']); ?></td>
                                        <td><?php echo htmlspecialchars($row['coordinatorname']); ?></td>
                                        <td>
                                            <a href="tel:<?php echo htmlspecialchars($row['coordinatorcontact']); ?>" class="text-decoration-none">
                                                <i class="bi bi-telephone-fill"></i> <?php echo htmlspecialchars($row['coordinatorcontact']); ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info text-center" role="alert">
                        <i class="bi bi-info-circle fs-1"></i>
                        <h4 class="mt-3">No Events Found</h4>
                        <p>Be the first to add an event!</p>
                        <a href="partials/_AddEvents.php" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add Event
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <!-- Guest View - Show Features -->
            <div class="row mb-5">
                <div class="col-md-4 mb-4">
                    <div class="feature-card bg-white text-center">
                        <i class="bi bi-calendar-check text-primary" style="font-size: 3rem;"></i>
                        <h3 class="mt-3">Easy Event Management</h3>
                        <p class="text-muted">Create, view, and manage all campus events in one centralized platform</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card bg-white text-center">
                        <i class="bi bi-people text-success" style="font-size: 3rem;"></i>
                        <h3 class="mt-3">Coordinator Details</h3>
                        <p class="text-muted">Keep track of event coordinators and their contact information</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card bg-white text-center">
                        <i class="bi bi-shield-check text-danger" style="font-size: 3rem;"></i>
                        <h3 class="mt-3">Secure & Reliable</h3>
                        <p class="text-muted">Your data is protected with modern security practices</p>
                    </div>
                </div>
            </div>

            <div class="cta-section">
                <h2 class="mb-3"><i class="bi bi-rocket-takeoff"></i> Get Started Today!</h2>
                <p class="lead text-muted mb-4">Join our campus event management system and never miss an event again</p>
                <a href="register.php" class="btn btn-primary btn-lg me-3">
                    <i class="bi bi-person-plus"></i> Create Account
                </a>
                <a href="login.php" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>