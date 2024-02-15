<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert manhwa</title>
    <link rel="stylesheet" href="style/register_login.css">
</head>

<body>
    <div class="container">
        <?php include("_admin.php");?>
    <div class="manhwa-list">
        <h2>list of manhwa</h2> <br>
        <table class="table"> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Manhwa name</th>
                    <th>Manhwa Cover</th>
                    <th>edit/delete</th>
                </tr>
            </thead>
            <tbody>
                <?php     
                include ('database.php');
                // read all rows from database of manhwas 
                $sql = "SELECT * FROM manhwas ORDER BY id ASC";
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
                        <td>$row[manhwa_name]</td>
                        <td><img src='images/covers/$row[manhwa_cover]' class='manhwa-cover'></td>
                        <td>
                            <a href='edit.php?id=$row[id]'>edit</a>
                            <form action='code_insert_update.php' method='post'>
                                <input type='hidden' name='id' value='$row[id]'></input>
                                <input type='hidden' name='id' value='$row[manhwa_cover]'></input>
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