<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['index'])) {
    $index = $_POST['index'];
    // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
    if (isset($_SESSION['cart'][$index])) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($_SESSION['cart'][$index]);
        // Phản hồi thành công nếu sản phẩm được xóa thành công
        echo json_encode(array('success' => true));
    } else {
        // Phản hồi lỗi nếu sản phẩm không tồn tại trong giỏ hàng
        echo json_encode(array('success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'));
    }
} else {
    // Phản hồi lỗi nếu không có yêu cầu POST hoặc không có index được cung cấp
    echo json_encode(array('success' => false, 'message' => 'Yêu cầu không hợp lệ'));
}
?>
