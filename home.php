<!DOCTYPE html>
<?php
session_start();
include("include/config.php");
if(!isset($_SESSION['user_email'])){
    header('location: login.php');
}else {
include("include/header.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container main-section">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
                <div class="input-group search-box">
                    <div class="input-group-btn">
                        <center><a href="include/find_friends.php"><button class="btn btn-primary search-icon" name="search_user" type="submit">Tìm bạn bè</button></a></center>
                    </div>
                </div>
                <div class="left-chat">
                    <ul>
                        <?php include("include/get_user_data.php"); ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
                <div class="row">
                    <!-- lấy thông tin những người dùng đã đăng nhập -->
                    <?php
                    // session_start();
                    include 'include/config.php';
                    $user = $_SESSION['user_email'];
                    $get_user = "SELECT * FROM users WHERE user_email = '$user'";
                    $run_user = mysqli_query($con, $get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    ?>

                    <!-- lấy thông tin người đã click -->
                    <?php
                    if (isset($_GET['user_name'])) {
                        $get_username = $_GET['user_name'];
                        $get_user = "SELECT * FROM users WHERE user_name = '$get_username'";
                        $run_user = mysqli_query($con, $get_user);
                        $row_user = mysqli_fetch_array($run_user);

                        $username = $row_user['user_name'];
                        $user_profile_image = $row_user['user_profile'];
                    }
                    $total_messages = "SELECT * FROM users_chat WHERE (sender_username = '$user_name' AND receiver_username = '$username') OR (receiver_username = '$user_name' AND sender_username = '$username')";
                    $run_messages = mysqli_query($con, $total_messages);
                    $total = mysqli_num_rows($run_messages);
                    ?>
                    <div class="col-md-12 right-header">
                        <div class="right-header-img">
                            <img src="<?php echo "$user_profile_image"; ?>">
                        </div>
                        <div class="right-header-detail">
                            <form method="post">
                                <p><?php echo "$username"; ?></p>
                                <span><?php echo $total; ?> Tin nhắn</span>&nbsp; &nbsp;
                                <button name="logout" class="btn btn-danger">Đăng xuất</button>
                            </form>
                            <?php
                            if (isset($_POST['logout'])) {
                                $update_msg = mysqli_query($con, "UPDATE users SET log_in = 'Không hoạt động' WHERE user_name = '$user_name'");
                                header("location: logout.php");
                                return;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
                        <?php
                        $update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status = 'Đã xem' WHERE sender_username = '$username' AND receiver_username = '$user_name'");
                        $sel_msg = "SELECT * FROM users_chat WHERE (sender_username = '$user_name' AND receiver_username = '$username') OR (receiver_username = '$user_name' AND sender_username = '$username') ORDER BY 1 ASC";
                        $run_msg = mysqli_query($con, $sel_msg);

                        while ($row = mysqli_fetch_array($run_msg)) {
                            $sender_username = $row['sender_username'];
                            $receiver_username = $row['receiver_username'];
                            $msg_content = $row['msg_content'];
                            $msg_date = $row['msg_date'];
                        ?>
                            <ul>
                                <?php
                                if ($user_name == $sender_username and $username == $receiver_username) {
                                    echo "
                                        <li>
                                            <div class='rightside-right-chat'>
                                                <span>$username<small> $msg_date</small></span>
                                                <br>
                                                <p>$msg_content</p>
                                            </div>
                                        </li>
                                    ";
                                                        } else if ($user_name == $receiver_username and $username == $sender_username) {
                                                            echo "
                                        <li>
                                            <div class='rightside-left-chat'>
                                                <span>$username<small> $msg_date</small></span>
                                                <br>
                                                <p>$msg_content</p>
                                            </div>
                                        </li>
                                    ";
                                }
                                ?>
                            </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 right-chat-textbox">
                        <form method="post">
                            <input type="text" name="msg_content" placeholder="Nhập nội dung tin nhắn...">
                            <button class="btn" name="submit"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $msg = $_POST['msg_content'];
        if ($msg == '') {
            echo "
            <div class='alert alert-danger'>
                <strong><center>Tin nhắn chưa được gửi</center></strong>
            </div>
            ";
        } else if (strlen($msg) > 100) {
            echo "
            <div class='alert alert-danger'>
                <strong><center>Tin nhắn chỉ chứa tối đa 100 ký tự</center></strong>
            </div>
            ";
        } else {
            $insert = "INSERT INTO users_chat (sender_username, receiver_username, msg_content, msg_status, msg_date) VALUES ('$user_name', '$username', '$msg', 'Đã nhận', NOW())";
            $run_insert = mysqli_query($con, $insert);
        }
    }
    ?>

    
    <script>
        $('#scrolling_to_bottom').animate({
            scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight
        }, 1000);
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var height = $(window).height();
            $('.left-chat').css('height', (height - 92) + 'px');
            $('.right-header-contentChat').css('height', (height - 163) + 'px');
        });
    </script>

</body>

</html>