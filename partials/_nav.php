<?php
$loggedin = (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="/CampusProject/">
      <i class="bi bi-calendar-event"></i> CAMPUS EVENT MANAGEMENT
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if ($loggedin): ?>
          <li class="nav-item">
            <a class="nav-link" href="/CampusProject/welcome.php">
              <i class="bi bi-house-door"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/CampusProject/partials/_AddEvents.php">
              <i class="bi bi-plus-circle"></i> Add Event
            </a>
          </li>
          <li class="nav-item">
            <span class="nav-link text-white-50">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-light btn-sm ms-2" href="/CampusProject/logout.php">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="/CampusProject/login.php">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-light btn-sm ms-2" href="./CampusProject/register.php">
              <!-- //C:\xampp\htdocs\CampusProject\register.php -->
              <i class="bi bi-person-plus"></i> Register
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">