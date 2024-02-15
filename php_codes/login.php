<?php 
@include "database.php";

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In Form</title>

    <link rel="stylesheet" href="style/register_login.css">
</head>

<body>
    <div class="form-container">
        <form action="login.php" method="post">
            <h3>Log-In Now</h3>
            <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_id'] = $user['id'];
                 if ($user) {
                    if ($password = $user["password"]) {
                        header("Location: ../index.php");
                        die();
                    } else {
                        echo "<div'>Password does not match</div>";
                    }
                } else {
                    echo "<div'>Email does not match</div>";
                }
            }
            ?>
            <input type="text" name="email" placeholder="Your E-mail ">
            <input type="password" name="password" placeholder="Your password">
            <input type="submit" name="login" value="login" class="submit-btn">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>

</html>