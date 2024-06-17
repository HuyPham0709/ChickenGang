<?php
include('../admin/db.php'); // Kết nối CSDL
include('../admin/includes/header.php'); // Include header file
include('../admin/auth.php');

// Xử lý xóa đơn hàng nếu có yêu cầu
if (isset($_GET['delete_id']) && isset($_GET['user_id'])) {
    $order_id = (int)$_GET['delete_id'];
    $user_id = (int)$_GET['user_id'];
    $sql = "DELETE FROM cart WHERE id_Cart = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo '<script>alert("Xóa đơn hàng thành công!"); window.location.href="manage_user_orders.php?user_id=' . $user_id . '";</script>';
        exit();
    } else {
        echo '<script>alert("Xóa đơn hàng thất bại!");</script>';
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
    <h2>Quản Lý Đơn Hàng Người Dùng</h2>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Người Dùng</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Người Dùng</th>
                                    <th>Email</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Địa Chỉ</th>
                                    <th>Số Lượng Đơn Hàng</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result_users->num_rows > 0) {
                                    while ($user = $result_users->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>{$user['user_id']}</td>";
                                        echo "<td>{$user['username']}</td>";
                                        echo "<td>{$user['email']}</td>";
                                        echo "<td>{$user['phone_number']}</td>";
                                        echo "<td>{$user['address']}</td>";
                                        echo "<td>{$user['order_count']}</td>";
                                        echo "<td><a href='manage_user_orders.php?user_id={$user['user_id']}'>Xem Đơn Hàng</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>Không có người dùng nào.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../admin/includes/footer.php'); ?>
