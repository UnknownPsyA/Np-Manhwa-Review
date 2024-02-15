<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>

    <link rel="stylesheet" href="style/register_login.css">
</head>

<body>
    <div class="form-container">
        <form action="register.php" method="post">
            <h3>Register Now</h3>
            <?php
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();
                if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
                    array_push($errors, "All feilds are required");
                }
                if ($password !== $cpassword) {
                    array_push($errors, "Passwords does not match");
                }
                if (strlen($password) < 8) {
                    array_push($errors, "Your password must be atleast 8 Charcacters");
                }
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email' ";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    array_push($errors, "Email already exist");
                }
                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo '<span class="error-msg">&#9888;' . $error . '</span>';
                    }
                } else {
                    require_once 'database.php';
                    $sql = "INSERT INTO users (name, email, password) VALUES ( ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);
                        mysqli_stmt_execute($stmt);

                        echo "<div class = 'reg-log-message' >You are registered sucessfully</div>";

                    } else {
                        die("something went wrong!");
                    }
                }
            }
            ?>
            <input type="text" name="name" placeholder="Username">
            <input type="text" name="email" placeholder="Your e-mail">
            <input type="password" name="password" placeholder="Your password">
            <input type="password" name="cpassword" placeholder="confirm password">
            <input type="submit" name="submit" value="register" class="submit-btn">
            <p>already have an account? <a href="login.php">login In</a></p>
        </form>
    </div>
</body>

</html>