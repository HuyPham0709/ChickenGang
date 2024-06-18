<?php
include ('../admin/db.php');

// Hàm để làm sạch và kiểm tra đầu vào
function sanitize_input($input) {
    global $con;
    return $con->real_escape_string(trim($input));
}

// Xử lý thêm sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $product_name = sanitize_input($_POST['product_name']);
    $quantity = (int)$_POST['quantity'];
    $description = sanitize_input($_POST['description']);
    $price = (float)$_POST['price'];
    $image_path = sanitize_input($_POST['image_path']);
    $color = sanitize_input($_POST['color']);
    $collection = sanitize_input($_POST['collection']);

    // Chuẩn bị và liên kết
    $stmt = $con->prepare("INSERT INTO Products (product_name, quantity, description, price, collection) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisd", $product_name, $quantity, $description, $price, $collection);

    if ($stmt->execute() === TRUE) {
        // Lấy ID của sản phẩm vừa được thêm vào
        $product_id = $stmt->insert_id;

        // Thêm ảnh sản phẩm vào bảng Product_Image
        $stmt_image = $con->prepare("INSERT INTO Product_Image (product_id, image_path, color) VALUES (?, ?, ?)");
        $stmt_image->bind_param("iss", $product_id, $image_path, $color);
        $stmt_image->execute();

        echo "Sản phẩm đã được thêm thành công.";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý sửa sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_product'])) {
    $product_id = (int)$_POST['product_id'];
    $product_name = sanitize_input($_POST['product_name']);
    $quantity = (int)$_POST['quantity'];
    $description = sanitize_input($_POST['description']);
    $price = (float)$_POST['price'];
    $image_path = sanitize_input($_POST['image_path']);
    $color = sanitize_input($_POST['color']);
    $collection = sanitize_input($_POST['collection']);

    // Cập nhật thông tin sản phẩm trong bảng Products
    $stmt = $con->prepare("UPDATE Products SET product_name=?, quantity=?, description=?, price=?, collection=? WHERE id_Product=?");
    $stmt->bind_param("sisdis", $product_name, $quantity, $description, $price, $collection, $product_id);

    if ($stmt->execute() === TRUE) {
        // Cập nhật ảnh sản phẩm trong bảng Product_Image
        $stmt_image = $con->prepare("UPDATE Product_Image SET image_path=?, color=? WHERE product_id=?");
        $stmt_image->bind_param("ssi", $image_path, $color, $product_id);
        $stmt_image->execute();

        echo "Sản phẩm đã được cập nhật thành công.";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý xóa sản phẩm
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];

    // Xóa ảnh sản phẩm từ bảng Product_Image trước
    $stmt_delete_image = $con->prepare("DELETE FROM Product_Image WHERE product_id=?");
    $stmt_delete_image->bind_param("i", $delete_id);
    $stmt_delete_image->execute();

    // Xóa sản phẩm từ bảng Products
    $stmt_delete_product = $con->prepare("DELETE FROM Products WHERE id_Product=?");
    $stmt_delete_product->bind_param("i", $delete_id);

    if ($stmt_delete_product->execute() === TRUE) {
        echo "Sản phẩm đã được xóa thành công.";
    } else {
        echo "Lỗi: " . $stmt_delete_product->error;
    }

    $stmt_delete_product->close();
}
?>
