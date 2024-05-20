<!DOCTYPE html>
<?php
session_start();
include("include/config.php");
include("include/header.php");
if (!isset($_SESSION['user_email'])) {
    header('location: login.php');
} else {
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cập nhật ảnh đại diện</title>
        <link rel="stylesheet" href="css/find_friend.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </head>

    <body>
    </body>
    <?php
            // Lấy thông tin người dùng từ session
            $user_email = $_SESSION['user_email'];
            $get_user = "SELECT * FROM users WHERE user_email='$user_email'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);

            // Lưu thông tin người dùng vào các biến
            $user_name = $row['user_name'];
            $user_profile = $row['user_profile'];

            echo "<div class='card'>
        <img src='$user_profile'>
        <h1>$user_name</h1>
        <form method='post' enctype='multipart/form-data'>
            <label id='update_profile'><i class='fa fa-circle-o' aria-hidden='true'></i>Chọn ảnh đại diện</label>
            <input type='file' name='u_image' size='60'>
            <button id='button_profile' name='update'>Cập nhật</button>
        </form>
      </div><br><br>";

      if(isset($_POST['update'])){
        $u_image = $_FILES['u_image']['name'];
        $image_tmp = $_FILES['u_image']['tmp_name'];
        $random_number = rand(1,100);
        if($u_image == ''){
            echo "<script>alert('Vui lòng chọn ảnh đại diện')</script>";
            echo "<script>window.open('upload.php', '_self')</script>";
            exit();
        } else {
            move_uploaded_file($image_tmp, "images/$u_image.$random_number");
            $update = "UPDATE users SET user_profile='images/$u_image.$random_number' WHERE user_email='$user'";
            $run = mysqli_query($con, $update);
            if ($run) {
                echo "<script>alert('Đã thay đổi ảnh đại diện!')</script>";
                echo "<script>window.open('upload.php', '_self')</script>";
            }
        }
    }
    
        ?>
    </html>
<?php } ?>