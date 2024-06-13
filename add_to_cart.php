<?php
// Kết nối đến cơ sở dữ liệu
require_once 'connect.php';

// Bắt đầu hoặc khôi phục phiên
session_start();

// Khởi tạo giỏ hàng nếu chưa tồn tại trong session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Kiểm tra xem request method là POST hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (isset($_SESSION['user_id'])) {
        // Lấy thông tin sản phẩm từ form
        $product_id = $_POST['product_id'];
        $image_path = $_POST['image_path'];
        $color = $_POST['color'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION['user_id'];

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sql = "SELECT * FROM Products WHERE id_Product = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if ($product) {
            // Thêm sản phẩm vào giỏ hàng của người dùng trong session
            $item = array(
                'id' => $product['id_Product'],
                'name' => $product['product_name'],
                'price' => $product['price'],
                'image_path' => $image_path,
                'color' => $color,
                'quantity' => $quantity
            );

            // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
            $found = false;
            foreach ($_SESSION['cart'] as &$cart_item) {
                if ($cart_item['id'] == $product_id && $cart_item['color'] == $color) {
                    // Cập nhật số lượng sản phẩm nếu đã tồn tại
                    $cart_item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng
            if (!$found) {
                $_SESSION['cart'][] = $item;
            }
        }

        // Sau khi thêm sản phẩm vào giỏ hàng, chuyển hướng người dùng đến trang giỏ hàng
        header("Location: cart.php");
        exit();
    } else {
        // Nếu người dùng chưa đăng nhập, chuyển hướng họ đến trang đăng nhập
        header("Location: login.php");
        exit();
    }
} else {
    // Nếu không phải là request method POST, chuyển hướng về trang sản phẩm hoặc trang chính
    header("Location: index.php");
    exit();
}
?>
