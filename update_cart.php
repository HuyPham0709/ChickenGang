<?php
// Bắt đầu hoặc khôi phục phiên
session_start();

// Xử lý cập nhật số lượng sản phẩm trong giỏ hàng qua AJAX
if (isset($_POST['index']) && isset($_POST['quantity'])) {
    $index = $_POST['index'];
    $quantity = $_POST['quantity'];
    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
    }
}
?>
