<nav class="navbar">
        <a class="navbar-brand" href="#"><i class="fa-brands fa-facebook-messenger"></i> Chat</a>
        <?php
        // session_start();
        $user = $_SESSION['user_email'];
        $get_user = "SELECT * FROM users WHERE user_email='$user'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);
        $user_name = $row['user_name'];
        echo "<a class='navbar-brand' href='home.php?user_name=$user_name'>Chat</a>";
        ?>
        <ul class="navbar-nav">
            <li><a href="account_settings.php"><i class="fa-regular fa-circle-user"></i> Tài khoản</a></li>
        </ul>
    </nav><br>