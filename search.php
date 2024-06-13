<?php
include 'db.php';
// Thêm các sản phẩm vào một biến để hiển thị theo hàng ngang
$product_info = "";

// Xử lý truy vấn tìm kiếm
if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    // Truy vấn để tìm kiếm sản phẩm và thông tin hình ảnh
    $sql = "SELECT Products.*, Product_Image.image_path, Product_Image.color 
            FROM Products 
            LEFT JOIN Product_Image ON Products.id_Product = Product_Image.product_id 
            WHERE Products.product_name LIKE '%$keyword%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Hiển thị kết quả
        while($row = $result->fetch_assoc()) {
            $product_info .= "<div>";
            $product_info .= "<p>" . $row["product_name"] . "</p>";
            $product_info .= "<p>Price: $" . $row["price"] . "</p>";
            $product_info .= "<p>Quantity: " . $row["quantity"] . "</p>";
            $product_info .= "<p>Description: " . $row["description"] . "</p>";
            $product_info .= "<img src='img/" . $row["image_path"] . "' alt='Product Image' style='max-width: 200px;'>";
            $product_info .= "<p>Color: " . $row["color"] . "</p>";
            $product_info .= "</div>";
        }
    } else {
        $product_info = "No results found";
    }
}

echo $product_info;
?>




