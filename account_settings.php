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
        <title>Chỉnh sửa thông tin</title>
        <link rel="stylesheet" href="css/find_friend.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php
            // Lấy thông tin người dùng từ session
            $user_email = $_SESSION['user_email'];
            $get_user = "SELECT * FROM users WHERE user_email='$user_email'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);

            // Lưu thông tin người dùng vào các biến
            $user_name = $row['user_name'];
            $user_pass = $row['user_password'];
            $user_email = $row['user_email'];
            $user_profile = $row['user_profile'];
        ?>
        <div class="col-sm-12">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td colspan="2" class="active">
                            <h2>Chỉnh sửa thông tin</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Tên tài khoản</td>
                        <td>
                            <input type="text" name="u_name" class="form-control" required value="<?php echo $user_name; ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;">Ảnh đại diện</td>
                        <td>
                            <a class="btn btn-default" style="text-decoration: none;font-size: 15px; border:1px solid" href="upload.php">
                                <i class="fa fa-user" aria-hidden="true"></i> Đổi ảnh đại diện
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;">Địa chỉ email</td>
                        <td>
                            <input type="email" name="u_email" class="form-control" required value="<?php echo $user_email; ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight: bold;">Quên mật khẩu</td>
                            <td>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" style=" border:1px solid">Lấy lại mật khẩu</button>
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Thông báo
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                Chức năng đang được cập nhật !!!
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- </td> -->
                        </tr>

                        <tr>
                        <td style="font-weight: bold;">Đổi mật khẩu</td>
                        <td>
                        <a class="btn btn-default" style="text-decoration: none; font-size: 15px; border:1px solid;" href="change_password.php"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Đổi mật khẩu</a>
                        </td>
                    </tr>
                </table>
                <!-- <tr><td></td><td><a class="btn btn-default" style="text-decoration: none; font-size: 15px" href="change_password.php"></a><i class="fa fa-key fa-fw" aria-hidden="true"></i>Đổi mật khẩu</td></tr> -->
                
                <tr align="center">
                <td colspan="6">
                <input type="submit" value="Cập nhật" name="update" class="btn btn-info" style="display: flex; margin: 0 auto">
                </td>
                </tr> </table>
            </form>
            <?php 
            if(isset($_POST['update'])){
                $user_name = $_POST['u_name'];
                $email = $_POST['u_email'];
                
                $update = "UPDATE users SET user_name = '$user_name', user_email = '$email' WHERE user_email='$user'";
                
                $run = mysqli_query($con, $update);
                
                if($run){
                    echo "<script>window.open('account_settings.php', '_self')</script>";
                } 
            }
            
            ?>
        </div>
        <div class="col-sm-2"></div>
    </body>

    </html>
<?php } ?>