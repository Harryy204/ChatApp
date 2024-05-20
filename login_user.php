<?php
session_start();
if(isset($_POST['login-btn'])){
    include 'include/config.php';
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if( empty($pass) || empty($email)){
        echo "Vui lòng điền đầy đủ thông tin";
        return;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Địa chỉ email không hợp lệ";
        return;
    }

    $select_user = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$pass'";
    $query = mysqli_query($con, $select_user);
    $check_user = mysqli_num_rows($query);
    if($check_user == 1){
        $_SESSION['user_email'] = $email;
        $update_msg = mysqli_query($con, "UPDATE users SET log_in = 'Đang hoạt động' WHERE user_email = '$email'");
        $user = $_SESSION['user_email'];
        $get_user = "SELECT * FROM users WHERE user_email = '$user'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);
        $user_name = $row['user_name'];
        echo "<script>window.location.href = 'home.php?user_name=$user_name';</script>";

    }
    else{
        echo "Tài khoản hoặc mật khẩu không chính xác";
    }
}
?>