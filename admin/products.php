<?php
include('../admin/includes/header.php');
include('../admin/functions/manage-products.php');
?>

<!-- Content Row -->
<div class="row">
    <!-- Form thêm/sửa sản phẩm -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thêm/Sửa Sản Phẩm</h6>
            </div>
            <div class="card-body">
                <?php
                // Nếu có id để sửa sản phẩm, lấy thông tin sản phẩm từ database
                if (isset($_GET['edit_id'])) {
                    $edit_id = (int)$_GET['edit_id'];
                    $sql = "SELECT * FROM Products WHERE id_Product = $edit_id";
                    $result = $con->query($sql);
                    $product = $result->fetch_assoc();

                    $sql_image = "SELECT * FROM Product_Image WHERE product_id = $edit_id";
                    $result_image = $con->query($sql_image);
                    $product_image = $result_image->fetch_assoc();
                }
                ?>

                <form method="POST" action="">
                    <input type="hidden" name="product_id" value="<?php echo isset($product['id_Product']) ? $product['id_Product'] : ''; ?>">
                    <div class="form-group">
                        <label for="product_name">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" name="product_name" value="<?php echo isset($product['product_name']) ? $product['product_name'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Số Lượng</label>
                        <input type="number" class="form-control" name="quantity" value="<?php echo isset($product['quantity']) ? $product['quantity'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô Tả</label>
                        <textarea class="form-control" name="description" required><?php echo isset($product['description']) ? $product['description'] : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="number" step="0.01" class="form-control" name="price" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="image_path">Ảnh</label>
                        <input type="file" class="form-control-file" id="image_path" name="image_path">
                        <?php if (isset($product_image['image_path'])) : ?>
                            <img src="<?php echo $product_image['image_path']; ?>" width="100" height="100" alt="">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="color">Màu</label>
                        <input type="text" class="form-control" name="color" value="<?php echo isset($product_image['color']) ? $product_image['color'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="collection">Bộ Sưu Tập</label>
                        <input type="text" class="form-control" name="collection" value="<?php echo isset($product['collection']) ? $product['collection'] : ''; ?>">
                    </div>
                    <?php if (isset($product['id_Product'])) { ?>
                        <button type="submit" name="edit_product" class="btn btn-primary">Sửa Sản Phẩm</button>
                    <?php } else { ?>
                        <button type="submit" name="add_product" class="btn btn-primary">Thêm Sản Phẩm</button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh Sách Sản Phẩm</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Mô Tả</th>
                            <th>Giá</th>
                            <th>Ảnh</th>
                            <th>Màu</th>
                            <th>Bộ Sưu Tập</th>
                            <th>Hành Động</th>
                        </tr>
                        <?php
                        // Hiển thị danh sách sản phẩm
                        $sql = "SELECT * FROM Products";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Lấy thông tin ảnh sản phẩm từ bảng Product_Image (nếu có)
                                $sql_image = "SELECT * FROM Product_Image WHERE product_id = " . $row["id_Product"];
                                $result_image = $con->query($sql_image);
                                $row_image = $result_image->fetch_assoc();

                                echo "<tr>";
                                echo "<td>" . $row["id_Product"] . "</td>";
                                echo "<td>" . $row["product_name"] . "</td>";
                                echo "<td>" . $row["quantity"] . "</td>";
                                echo "<td>" . $row["description"] . "</td>";
                                echo "<td>" . $row["price"] . "</td>";
                                // Kiểm tra nếu có dữ liệu từ bảng Product_Image
                                if ($row_image !== null) {
                                    echo "<td><img src='" . $row_image["image_path"] . "' width='50' height='50'></td>";
                                    echo "<td>" . $row_image["color"] . "</td>";
                                } else {
                                    echo "<td></td>"; // Nếu không có ảnh
                                    echo "<td></td>"; // Nếu không có màu sắc
                                }
                                echo "<td>" . $row["collection"] . "</td>";
                                echo "<td><a href='?edit_id=" . $row["id_Product"] . "'>Sửa</a> | <a href='?delete_id=" . $row["id_Product"] . "' onclick=\"return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');\">Xóa</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>Không có sản phẩm nào.</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include('../admin/includes/footer.php'); ?>