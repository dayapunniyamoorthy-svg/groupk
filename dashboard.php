<?php
session_start();
include "db.php";



$role = $_SESSION['role']; 


/* LOGIN CHECK */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* USER INFO FROM SESSION */
$username = $_SESSION['username'];
$email    = $_SESSION['email'];
$role     = $_SESSION['role'];

/* TOTAL USERS COUNT */
$userCount = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM users")
)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hivision Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>

<!-- TOP BAR -->
<div class="topbar">
    <h2 class="logo">Hivision</h2>
    <a href="logout.php" class="logout">Logout</a>
</div>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="dashboard.php"><ion-icon name="home-outline"></ion-icon> Dashboard</a>

    <?php if ($role == "admin") { ?>
    <?php if ($role == "admin") { ?>
    <a href="user.php"><ion-icon name="person-outline"></ion-icon> Users</a>
    <a href="adduser.php"><ion-icon name="person-add-outline"></ion-icon> Add User</a>
<?php } ?>

        <a href="user.php"><ion-icon name="person-outline"></ion-icon> Users</a>
    <?php } ?>

    <a href="#"><ion-icon name="videocam-outline"></ion-icon> CCTV Services</a>
    <a href="#"><ion-icon name="flash-outline"></ion-icon> Electrician Works</a>
    <a href="#"><ion-icon name="settings-outline"></ion-icon> Settings</a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <h1>Welcome, <span style="color:#ff7200;"><?= htmlspecialchars($username); ?></span></h1>
    <p>Here is the summary of your account:</p>

    <!-- CARDS -->
    <div class="cards">
        <div class="card">
            <h3>Total Users</h3>
            <p><?= $userCount; ?></p>
        </div>

        <div class="card">
            <h3>CCTV Projects</h3>
            <p>0</p>
        </div>

        <div class="card">
            <h3>Electrician Jobs</h3>
            <p>0</p>
        </div>

        <div class="card">
            <h3>Pending Requests</h3>
            <p>0</p>
        </div>
    </div>

    <!-- PROFILE + ACTIONS -->
    <div style="margin-top: 40px; display: flex; gap: 20px; flex-wrap: wrap;">
        <div class="card" style="flex: 1 1 300px;">
            <h3>Profile Info</h3>
            <p><strong>Name:</strong> <?= htmlspecialchars($username); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email); ?></p>
            <p><strong>Role:</strong> <?= ucfirst($role); ?></p>
        </div>

        <?php if ($role == "admin") { ?>
        <div class="card" style="flex: 1 1 300px;">
            <h3>Quick Actions</h3>
            <p><a href="adduser.php">Add New User</a></p>
            <p><a href="#">Create Project</a></p>
            <p><a href="#">View Reports</a></p>
        </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
