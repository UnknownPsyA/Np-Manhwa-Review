<?php
include("database.php");
if (isset($_POST['submit']) && isset($_FILES['image'])) {
    include('database.php');
    echo "hello world <br>";
    print_r($_FILES['image']);

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $temp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];
    $manhwa_name = $_POST['name'];
    $manhwa_name = mysqli_real_escape_string($conn, $manhwa_name);

    if ($error === 0) {
        if ($img_size > 125000000) {
            $em = "Sorry, your image is too large";
            header("Location: insert.php?error=$em");
        } else if (empty($manhwa_name)) {
            $em = "You need to put title!";
            header("Location: insert.php?error=$em");
        }else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            echo "$img_ex";

            $allowed_exs = array("jpg", "jpeg", "png", "gif", "webp");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'images/covers/' . $new_img_name;
                move_uploaded_file($temp_name, $img_upload_path);

                // Insert into Database
 
                $sql = "INSERT INTO manhwas(manhwa_cover, manhwa_name) 
                VALUES('$new_img_name', '$manhwa_name')";
                mysqli_query($conn, $sql);
                $em = "You have Sucessfully uploaded the manhwa image";
                header("Location: insert.php?error=$em");
            } else {
                $em = "You cannot upload files of this type";
                header("Location: insert.php?error=$em");
            }
        }
    } else {
        $em = "Unknown error occured";
        header("Location: insert.php?error=$em");
    }
}
/* idk whats not working but i dont need it rn
if(isset($_POST['update'])) {
    $manhwa_id = $_POST['id'];
    $name = $_POST['name'];
    $new_image =  $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    print_r ($_FILES['image']['name']);
    print_r ($_POST['old_image']);
    
    if($new_image != '') {
        $update_filename = $new_image;
    } else {
        $update_filename = $old_image;
    }

    $update = "UPDATE manhwas SET manhwa_name='$name', manhwa_cover='$update_filename' WHERE id='$manhwa_id'";
    $update_run = mysqli_query($conn, $update);

    if($update_run )  {
        if($_FILES['image']['name' !='']) {
            move_uploaded_file($temp_name, $img_upload_path);
            unlink("images/cover/.$old_image");
        }
        $em = "updated";
        header("Location: edit.php?error=$em");

    } else {
        $em = "failed";
        header("Location: edit.php?error=$em");
    }
}


if(isset($_POST['delete'])) {
    $id = $_POST['id'];
    $image = $_POST['manhwa_cover'];
    echo "hello mf";
    $delete = "DELETE FROM manhwas WHERE id='$id' ";
    $result = mysqli_query($conn, $delete);

    if ($result) {
        unlink("images/covers/.$image");
        echo "manhwa deleted";
        header("location: manhwas.php");
    } else {
        echo "manhwa couldnt be deleted";
        header("location: manhwas.php");
    }
}
*/
?>
