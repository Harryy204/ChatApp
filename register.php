<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>
<body>
    <div class="register-form">
        <form action="#" method="post">
            <div class="form-header">
                <h2>Đăng Ký</h2>
                <p>Đăng ký để nhắn tin cùng bạn bè</p>
            </div>
            <div class="form-group">
                <label>Tên người dùng</label>
                <input type="text" class="form-control" name="user_name" placeholder="Ví dụ: Harry" >
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="user_email" placeholder="chatting@gmail.com" >
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="user_password" placeholder="Nhập mật khẩu" >
            </div>
            <div class="form-group">
                <label>Giới tính</label>
                <select class="form-control" name="user_gender" >
                    <option disabled="">Chọn giới tính</option>
                    <option>Nam</option>
                    <option>Nữ</option>
                    <option>Không muốn trả lời</option>
                </select>
            </div>
            <div class="message">
                <?php include("register_user.php"); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="register-btn">Đăng ký</button>
            </div>
        </form>
        <p class="regis-account">Bạn đã có tài khoản ? <a href="login.php">Đăng nhập ngay</a></p>
    </div>
</body>
</html>