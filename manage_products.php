<?php
include 'db.php';

// Function to sanitize and validate inputs
function sanitize_input($input) {
    global $conn;
    return $conn->real_escape_string(trim($input));
}

// Xử lý thêm sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $product_name = sanitize_input($_POST['product_name']);
    $quantity = (int)$_POST['quantity'];
    $description = sanitize_input($_POST['description']);
    $price = (float)$_POST['price'];
    $image_path = sanitize_input($_POST['image_path']);
    $color = sanitize_input($_POST['color']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Products (product_name, quantity, description, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisd", $product_name, $quantity, $description, $price);

    if ($stmt->execute() === TRUE) {
        // Lấy ID của sản phẩm vừa được thêm vào
        $product_id = $stmt->insert_id;

        // Thêm ảnh sản phẩm vào bảng Product_Image
        $stmt_image = $conn->prepare("INSERT INTO Product_Image (product_id, image_path, color) VALUES (?, ?, ?)");
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

    // Cập nhật thông tin sản phẩm trong bảng Products
    $stmt = $conn->prepare("UPDATE Products SET product_name=?, quantity=?, description=?, price=? WHERE id_Product=?");
    $stmt->bind_param("sisdi", $product_name, $quantity, $description, $price, $product_id);

    if ($stmt->execute() === TRUE) {
        // Cập nhật ảnh sản phẩm trong bảng Product_Image
        $stmt_image = $conn->prepare("UPDATE Product_Image SET image_path=?, color=? WHERE product_id=?");
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
    $stmt_delete_image = $conn->prepare("DELETE FROM Product_Image WHERE product_id=?");
    $stmt_delete_image->bind_param("i", $delete_id);
    $stmt_delete_image->execute();

    // Xóa sản phẩm từ bảng Products
    $stmt_delete_product = $conn->prepare("DELETE FROM Products WHERE id_Product=?");
    $stmt_delete_product->bind_param("i", $delete_id);

    if ($stmt_delete_product->execute() === TRUE) {
        echo "Sản phẩm đã được xóa thành công.";
    } else {
        echo "Lỗi: " . $stmt_delete_product->error;
    }

    $stmt_delete_product->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
</head>
<body>
    <h2>Quản Lý Sản Phẩm</h2>

    <!-- Form thêm sản phẩm -->
    <h3>Thêm Sản Phẩm</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="add_product">
        <label for="product_name">Tên Sản Phẩm:</label><br>
        <input type="text" id="product_name" name="product_name" required><br>
        
        <label for="quantity">Số Lượng:</label><br>
        <input type="number" id="quantity" name="quantity" required><br>
        
        <label for="description">Mô Tả:</label><br>
        <textarea id="description" name="description" required></textarea><br>
        
        <label for="price">Giá:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="image_path">Đường dẫn ảnh:</label><br>
        <input type="text" id="image_path" name="image_path" required><br>

        <label for="color">Màu sắc:</label><br>
        <input type="text" id="color" name="color" required><br>
        
        <input type="submit" value="Thêm">
    </form>

    <!-- Hiển thị danh sách sản phẩm -->
    <h3>Danh Sách Sản Phẩm</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên Sản Phẩm</th>
            <th>Số Lượng</th>
            <th>Mô Tả</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Màu</th>
            <th>Hành Động</th>
        </tr>
        <?php
        // Hiển thị danh sách sản phẩm
        $sql = "SELECT * FROM Products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Lấy thông tin ảnh sản phẩm từ bảng Product_Image (nếu có)
                $sql_image = "SELECT * FROM Product_Image WHERE product_id = ".$row["id_Product"];
                $result_image = $conn->query($sql_image);
                $row_image = $result_image->fetch_assoc();

                echo "<tr>";
                echo "<td>".$row["id_Product"]."</td>";
                echo "<td>".$row["product_name"]."</td>";
                echo "<td>".$row["quantity"]."</td>";
                echo "<td>".$row["description"]."</td>";
                echo "<td>".$row["price"]."</td>";
                // Kiểm tra nếu có dữ liệu từ bảng Product_Image
                if ($row_image !== null) {
                    echo "<td><img src='".$row_image["image_path"]."' width='50' height='50'></td>";
                    echo "<td>".$row_image["color"]."</td>";
                } else {
                    echo "<td></td>"; // Nếu không có ảnh
                    echo "<td></td>"; // Nếu không có màu sắc
                }
                echo "<td><a href='?edit_id=".$row["id_Product"]."'>Sửa</a> | <a href='?delete_id=".$row["id_Product"]."' onclick=\"return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');\">Xóa</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Không có sản phẩm nào.</td></tr>";
        }
        ?>
    </table>

    <!-- Form sửa sản phẩm -->
    <?php
    if (isset($_GET['edit_id'])) {
        $edit_id = (int)$_GET['edit_id'];
        $sql_edit = "SELECT * FROM Products WHERE id_Product = $edit_id";
        $result_edit = $conn->query($sql_edit);
        $row_edit = $result_edit->fetch_assoc();

        // Lấy thông tin ảnh sản phẩm từ bảng Product_Image (nếu có)
        $sql_image_edit = "SELECT * FROM Product_Image WHERE product_id = ".$row_edit["id_Product"];
        $result_image_edit = $conn->query($sql_image_edit);
        $row_image_edit = $result_image_edit->fetch_assoc();
    ?>
    <h3>Sửa Sản Phẩm</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="edit_product">
        <input type="hidden" name="product_id" value="<?php echo $row_edit['id_Product']; ?>">
        
        <label for="product_name">Tên Sản Phẩm:</label><br>
        <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($row_edit['product_name']); ?>" required><br>
        
        <label for="quantity">Số Lượng:</label><br>
        <input type="number" id="quantity" name="quantity" value="<?php echo $row_edit['quantity']; ?>" required><br>
        
        <label for="description">Mô Tả:</label><br>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($row_edit['description']); ?></textarea><br>
        
        <label for="price">Giá:</label><br>
        <input type="number" id="price" name="price" value="<?php echo $row_edit['price']; ?>" step="0.01" required><br>

        <label for="image_path">Đường dẫn ảnh:</label><br>
        <input type="text" id="image_path" name="image_path" value="<?php echo isset($row_image_edit['image_path']) ? htmlspecialchars($row_image_edit['image_path']) : ''; ?>" required><br>

        <label for="color">Màu sắc:</label><br>
        <input type="text" id="color" name="color" value="<?php echo isset($row_image_edit['color']) ? htmlspecialchars($row_image_edit['color']) : ''; ?>" required><br>
        
        <input type="submit" value="Lưu">
    </form>
    <?php } ?>

</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
