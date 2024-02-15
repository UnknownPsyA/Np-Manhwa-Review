<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert manhwa to db</title>
    <link rel="stylesheet" href="style/register_login.css">
</head>

<body>
    <?php if (isset($_GET['error'])): ?>
        <p>
            <?php echo $_GET['error']; ?>
        </p>
    <?php endif ?>
    <div class="create_post">
        <h1>insert manhwa into db</h1>
        <a href="manhwas.php">list of manhwas</a>
        <?php
        include("database.php");
        $id = $_GET['id'];
        $fetch = "SELECT * FROM manhwas WHERE id=$id";
        $result = mysqli_query($conn, $fetch);

        if (mysqli_num_rows($result) > 0) {
            foreach ($result as $row) {
                // echo $row['id'];
                ?>
                <form action="code_insert_update.php" method="post" enctype="multipart/form-data">
                    <label for="title">Title:</label>
                    <input type="text" placeholder="Manhwa title" name="name" value="<?php echo $row['manhwa_name'];?>"> <br>
                    <label for="image">Cover Image: </label>
                    <input type="file" name="image" id="cover_img" value=""> <br>
                    <input type="hidden" name="old_image"value="<?php echo $row['manhwa_cover']?>"><br>
                    <img src="<?php echo"images/covers/".$row['manhwa_cover'];?> " class='manhwa-cover' alt=""> <br>
                    <button type="submit" name="update" value="submit">Update</button>
                </form>
                <?php
            }
        } else {
            $em = "No data found";
            header("Location: edit.php?error=$em");
        }


        ?>
    </div>

</body>

</html>