<?php
include('../admin/includes/header.php');
include('../admin/db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn kiểm tra username và password
    $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lưu thông tin người dùng vào session
        $_SESSION['username'] = $username;
        // Chuyển hướng đến trang chủ hoặc trang mà bạn muốn
        header("Location: index.php");
    } else {
        echo "Username or Password is incorrect.";
    }
}

$conn->close();
?>





<?php include('../admin/includes/header.php'); ?>