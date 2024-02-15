<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list of users</title>
    <link rel="stylesheet" href="style/register_login.css">
</head>

<body>
    <div class="container">
        <?php include("_admin.php"); ?>
        <div class="user-list">
            <h2>List of Users</h2> <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User name</th>
                        <th>User email</th>
                        <th>User role</th>
                        <th>edit/delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('database.php');
                    // read all rows from database of manhwas 
                    $sql = "SELECT * FROM users ORDER BY id ASC";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Something went wrong");
                    }
                    //read data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "";
                        echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[user_roles]</td>
                        <td>
                            <a href='edit.php?id=$row[id]'>edit</a>
                            <form action='code_insert_update.php' method='post'>
                                <input type='hidden' name='id' value='$row[id]'></input>
                                <input type='hidden' name='id' value='$row[email]'></input>
                                <button type='submit' name='delete'>Delete</button>
                            </form>
                        </td>
                    </tr>
                    ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>