<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register | Hivision</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main">
    <div class="content">
        <div class="form">
            <h2>Register Here</h2>

            <?php
            if (!empty($_SESSION['error'])) {
                echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }

            if (!empty($_SESSION['success'])) {
                echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
                unset($_SESSION['success']);
            }
            ?>

            <form action="register_action.php" method="POST">
                <input type="text" name="name" placeholder="Enter Full Name" required>
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="password" name="password" placeholder="Enter Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>

                <button class="btnn" type="submit" name="register">Register</button>
            </form>

            <p class="link">
                Already have an account?<br>
                <a href="login.php">Login</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>
