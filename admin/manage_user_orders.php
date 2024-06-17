<?php
include('../admin/db.php'); // Kết nối CSDL
include('../admin/includes/header.php'); // Include header file

// Xử lý cập nhật trạng thái đơn hàng nếu có yêu cầu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_status']) && isset($_POST['order_id'])) {
    $order_id = (int)$_POST['order_id'];
    $new_status = $_POST['new_status'];
    $sql_update = "UPDATE cart SET status = ? WHERE id_Cart = ?";
    $stmt = $con->prepare($sql_update);
    $stmt->bind_param("si", $new_status, $order_id);

    if ($stmt->execute()) {
        echo '<script>alert("Cập nhật trạng thái đơn hàng thành công!"); window.location.href="manage_user_orders.php?user_id=' . $_GET['user_id'] . '";</script>';
        exit();
    } else {
        echo '<script>alert("Cập nhật trạng thái đơn hàng thất bại!");</script>';
    }
}

// Lấy danh sách người dùng và số lượng đơn hàng của mỗi người dùng
$sql_users = "SELECT ci.*, COUNT(c.id_Cart) AS order_count 
              FROM customer_information ci 
              LEFT JOIN cart c ON ci.user_id = c.user_id 
              GROUP BY ci.user_id";
$result_users = $con->query($sql_users);

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Đơn Hàng</h6>
                </div>
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="form-group">
                            <label for="user_id">Chọn Người Dùng:</label>
                            <select class="form-control" name="user_id" required>
                                <option value="">Chọn người dùng</option>
                                <?php
                                if ($result_users->num_rows > 0) {
                                    while ($row = $result_users->fetch_assoc()) {
                                        echo "<option value='{$row['user_id']}'>{$row['username']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Xem Đơn Hàng</button>
                    </form>
                    <?php
                    if (isset($_GET['user_id'])) {
                        $user_id = (int)$_GET['user_id'];
                        $sql_orders = "SELECT * FROM cart WHERE user_id = $user_id";
                        $result_orders = $con->query($sql_orders);

                        if ($result_orders->num_rows > 0) {
                    ?>
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Đơn Hàng</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Màu</th>
                                            <th>Số Lượng</th>
                                            <th>Giá</th>
                                            <th>Ngày Đặt Hàng</th>
                                            <th>Tổng Tiền</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($order = $result_orders->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>{$order['id_Cart']}</td>";
                                            echo "<td>{$order['product_name']}</td>";
                                            echo "<td>{$order['color']}</td>";
                                            echo "<td>{$order['Quantity']}</td>";
                                            echo "<td>{$order['price']}</td>";
                                            echo "<td>{$order['order_date']}</td>";
                                            echo "<td>{$order['total_money']}</td>";
                                            // Form để cập nhật trạng thái
                                            echo "<td>
                                                <form method='POST' action=''>
                                                    <input type='hidden' name='order_id' value='{$order['id_Cart']}' />
                                                    <select name='new_status' class='form-control' onchange='this.form.submit()'>
                                                        <option value='Pending' " . ($order['status'] == 'Pending' ? 'selected' : '') . ">Chờ xác nhận</option>
                                                        <option value='Processing' " . ($order['status'] == 'Processing' ? 'selected' : '') . ">Đang xử lý</option>
                                                        <option value='Shipped' " . ($order['status'] == 'Shipped' ? 'selected' : '') . ">Đã giao hàng</option>
                                                        <option value='Delivered' " . ($order['status'] == 'Delivered' ? 'selected' : '') . ">Đã nhận hàng</option>
                                                    </select>
                                                </form>
                                            </td>";
                                            echo "<td><a href='manage_user_orders.php?user_id={$user_id}&delete_id={$order['id_Cart']}' onclick=\"return confirm('Bạn chắc chắn muốn xóa đơn hàng này?');\">Xóa</a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                    <?php
                        } else {
                            echo "<div class='alert alert-warning mt-4'>Người dùng này chưa có đơn hàng nào.</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../admin/includes/footer.php'); ?>
