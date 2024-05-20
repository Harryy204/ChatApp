<!DOCTYPE html>
<?php
session_start();
include("find_friends_function.php");
if(!isset($_SESSION['user_email'])){
    header('location: login.php');
}
else{
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm bạn bè</title>
    <link rel="stylesheet" href="../css/find_friend.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#"><i class="fa-brands fa-facebook-messenger"></i> Chat</a>
        <?php
        // session_start();
        $user = $_SESSION['user_email'];
        $get_user = "SELECT * FROM users WHERE user_email='$user'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);
        $user_name = $row['user_name'];
        // echo "<a class='navbar-brand' href='../home.php?user_name=$user_name'>Chat</a>";
        ?>
        <ul class="navbar-nav">
            <li><a href="../account_settings.php"><i class="fa-regular fa-circle-user"></i> Tài khoản</a></li>
        </ul>
    </nav><br>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form class="search_form" action="">
                <input type="text" name="search_query" placeholder="Tìm bạn bè" required>
                <button class="btn" type="submit" name="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <br><br>
    <?php search_user();?>
</body>
</html>
<?php } ?>