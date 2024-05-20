<?php
if(isset($_POST['register-btn'])){
    include 'include/config.php';
    $name = $_POST['user_name'];
    $pass = $_POST['user_password'];
    $email = $_POST['user_email'];
    $gender = $_POST['user_gender'];
    $rand = rand(1,2);
    
    if(empty($name) || empty($pass) || empty($email) || empty($gender)){
        echo "Vui lòng điền đầy đủ thông tin";
        return;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Địa chỉ email không hợp lệ";
        return;
    }

    if(strlen($pass) < 6){
        echo "Mật khẩu phải lớn hơn 6 ký tự";
        return;
    }
    $check_email = "SELECT * FROM users WHERE user_email = '$email'";
    $run_email = mysqli_query($con, $check_email);
    $check = mysqli_num_rows($run_email);
    if($check == 1){
        echo "Email đã tồn tại";
        return;
    }
    $profile_pic = ($rand == 1) ? "images/profile0.jpg" : "images/profile.jpg";

    $insert = "INSERT INTO users (user_name, user_email, user_password, user_profile, user_gender) VALUES ('$name', '$email', '$pass', '$profile_pic', '$gender')";
    $query = mysqli_query($con, $insert);

    if($query){
        echo "Chúc mừng $name đã đăng ký thành công";
        echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
    } else {
        echo "Đăng ký không thành công, vui lòng thử lại";
    }
}
?>
