<?php
$con = mysqli_connect('localhost','root','','chat_app');
function search_user() {
    global $con;

    if (isset($_GET['search_btn'])) {
        $search_query = $_GET['search_query'];
        $get_user = "SELECT * FROM users WHERE user_name LIKE '%$search_query%'";
    } else {
        $get_user = "SELECT * FROM users ORDER BY user_name DESC LIMIT 5";
    }

    $run_user = mysqli_query($con, $get_user);

    while ($row_user = mysqli_fetch_array($run_user)) {
        $user_name = $row_user['user_name'];
        $user_profile = $row_user['user_profile'];
        $gender = $row_user['user_gender'];

        // hiển thị danh sách người dùng tìm kiếm
        echo "
        <div class='card'>
            <img src='../$user_profile'>
            <h1>$user_name</h1>
            <p>$gender</p>
            <form method='post'>
                <input type='hidden' name='user_to_chat' value='$user_name'>
                <p><button type='submit' name='add'>Nhắn tin với $user_name</button></p>
            </form>
        </div>
        <br>
        ";
    }
}

if(isset($_POST['add'])){
    $user_to_chat = $_POST['user_to_chat'];
    echo "<script>window.open('../home.php?user_name=$user_to_chat', '_self')</script>";
}
?>