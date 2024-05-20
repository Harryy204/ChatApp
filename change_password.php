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
        <title>Cập nhật mật khẩu</title>
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="mt-5 text-dark text-center">
                        <h2>Đổi mật khẩu</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="current_pass">Mật khẩu hiện tại</label>
                                <input type="password" name="current_pass" id="current_pass" class="form-control" required placeholder="Mật khẩu hiện tại" />
                            </div>
                            <div class="form-group">
                                <label for="new_pass">Mật khẩu mới</label>
                                <input type="password" name="u_pass1" id="new_pass" class="form-control" required placeholder="Mật khẩu mới" />
                            </div>
                            <div class="form-group">
                                <label for="confirm_pass">Xác nhận mật khẩu mới</label>
                                <input type="password" name="u_pass2" id="confirm_pass" class="form-control" required placeholder="Xác nhận mật khẩu mới" />
                            </div>
                            <div class="form-group">
                                <input type="submit" name="change" value="Đổi mật khẩu" class="btn btn-primary btn-block" />
                            </div>
                        </form>
            <?php
            if (isset($_POST['change'])) {
                $c_pass = $_POST['current_pass'];
                $pass1 = $_POST['u_pass1'];
                $pass2 = $_POST['u_pass2'];
                $user = $_SESSION['user_email'];

                $get_user = "SELECT * FROM users WHERE user_email='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($run_user);
                $user_password = $row['user_password'];

                if ($c_pass !== $user_password) {
                    echo "
                    <div class='alert alert-danger'>
                        <strong>Mật khẩu cũ không đúng</strong>
                    </div>";
                } elseif ($pass1 !== $pass2) {
                    echo "
                    <div class='alert alert-danger'>
                        <strong>Xác nhận mật khẩu không chính xác</strong>
                    </div>";
                } elseif (strlen($pass1) < 6 || strlen($pass2) < 6) {
                    echo "
                    <div class='alert alert-danger'>
                        <strong>Mật khẩu phải có ít nhất 6 ký tự</strong>
                    </div>";
                } else {
                    $update_pass = "UPDATE users SET user_password='$pass1' WHERE user_email='$user'";
                    $run_update = mysqli_query($con, $update_pass);
                    if ($run_update) {
                        echo "
                        <div class='alert alert-success'>
                            <strong>Đã đổi mật khẩu thành công</strong>
                        </div>";
                    }
                }
            }
            ?>

        </div>
        <div class="col-sm-2"></div>
    </div>

    </html>
<?php } ?>