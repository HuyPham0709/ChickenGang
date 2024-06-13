<?php
require_once 'db.php';

// Truy vấn SQL để lấy dữ liệu từ bảng Products và Product_Image
$sql = "SELECT p.*, pi.color, pi.image_path 
        FROM Products p
        LEFT JOIN Product_Image pi ON p.id_Product = pi.product_id";

$result = $conn->query($sql);

// Kiểm tra và gán dữ liệu cho biến $products
if ($result->num_rows > 0) {
    $products = array();
    while ($row = $result->fetch_assoc()) {
        // Tạo một mảng ứng với mỗi sản phẩm, bao gồm thông tin từ bảng Products và Product_Image
        $product_id = $row['id_Product'];
        if (!isset($products[$product_id])) {
            $products[$product_id] = array(
                'id' => $row['id_Product'],
                'name' => $row['product_name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'created_at' => $row['created_at'],
                'update_at' => $row['update_at'],
                'images' => array()
            );
        }

        // Thêm thông tin về hình ảnh vào mảng images của sản phẩm tương ứng
        if (!empty($row['color']) && !empty($row['image_path'])) {
            $products[$product_id]['images'][$row['color']] = $row['image_path'];
        }
    }
} else {
    echo "Không có dữ liệu trong bảng Products";
}

// Hiển thị thông tin sản phẩm (ví dụ)
// foreach ($products as $product) {
//     echo "ID: " . $product['id'] . "<br>";
//     echo "Tên sản phẩm: " . $product['name'] . "<br>";
//     echo "Mô tả: " . $product['description'] . "<br>";
//     echo "Giá: " . $product['price'] . "<br>";
//     echo "Số lượng: " . $product['quantity'] . "<br>";
//     echo "Ngày tạo: " . $product['created_at'] . "<br>";
//     echo "Ngày cập nhật: " . $product['update_at'] . "<br>";
//     if (!empty($product['images'])) {
//         foreach ($product['images'] as $color => $image_path) {
//             echo "Màu: " . $color . " - Đường dẫn hình ảnh: " . $image_path . "<br>";
//         }
//     }
//     echo "<hr>";
// }

// Đóng kết nối cơ sở dữ liệu   
?>
