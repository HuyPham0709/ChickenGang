<?php


// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: ../admin/login.php"); // Điều hướng đến trang login.php
    exit();
}
?>
