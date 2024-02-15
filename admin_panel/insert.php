<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert manhwa to db</title>
    <link rel="stylesheet" href="style/register_login.css">
</head>

<body>
    <div class="container">
        <?php include("_admin.php"); ?>
        <div class="insert-manhwa">
            <?php if (isset($_GET['error'])): ?>
                <p>
                    <?php echo $_GET['error']; ?>
                </p>
            <?php endif ?>
            <div class="insert_manhwa">
                <h1>insert manhwa into db</h1>
                <form action="code_insert_update.php" method="post" enctype="multipart/form-data">
                    <label for="title">Title:</label>
                    <input type="text" placeholder="Manhwa title" name="name" value=""> <br>
                    <label for="image">Cover Image: </label>
                    <input type="file" name="image" id="cover_img" value=""> <br>
                    <button type="submit" name="submit" value="submit">Submit</button>
                </form>
                <h1>Extra data for manhwa</h1>
                <form action="code_insert_update.php" method="post" enctype="multipart/form-data">
                    <label for="manhwa_id">manhwa id:</label>
                    <input type="text" placeholder="manhwa id" name=""manhwa_id value=""> <br>
                    <label for="manhwa_summary">manhwa summary:</label>
                    <input type="text" placeholder="Manhwa summary" name="manhwa_summary" value=""> <br>
                    <label for="bg_image">BackGround Image: </label>
                    <input type="file" name="manhwa_bg" id="bg_img" value=""> <br>
                    <button type="submit" name="submit" value="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>