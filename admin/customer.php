<?php
include('../admin/includes/header.php');
include('../admin/functions/manage-customer.php');

// Xử lý khi nhấn submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra khi thêm mới khách hàng
    if (isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $login_id = (int)$_POST['login_id']; // Đảm bảo rằng login_id là một số nguyên

        // Gọi hàm thêm khách hàng từ file manage-customer.php
        $result = addCustomer($username, $email, $phone_number, $address, $login_id);
        if ($result === true) {
            echo "<meta http-equiv='refresh' content='0'>"; // Tải lại trang
            exit;
        } else {
            echo $result;
        }
    } elseif (isset($_POST['update_user'])) {
        // Kiểm tra khi cập nhật thông tin khách hàng
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $login_id = (int)$_POST['login_id']; // Đảm bảo rằng login_id là một số nguyên

        // Gọi hàm cập nhật khách hàng từ file manage-customer.php
        $result = updateCustomer($id, $username, $email, $phone_number, $address, $login_id);
        if ($result === true) {
            echo "<meta http-equiv='refresh' content='0'>"; // Tải lại trang
            exit;
        } else {
            echo $result;
        }
    }
}

// Xử lý khi nhấn nút xóa
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $result = deleteCustomer($delete_id);
    if ($result === true) {
        echo "<meta http-equiv='refresh' content='0'>"; // Tải lại trang
        exit;
    } else {
        echo $result;
    }
}

// Lấy danh sách khách hàng từ hàm trong manage-customer.php
$customers = getCustomer();

// Biến chứa thông tin khách hàng cần chỉnh sửa, ban đầu là rỗng
$customer = array();

// Nếu có yêu cầu sửa thông tin, lấy thông tin của khách hàng cần sửa
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $customer = getCustomerById($edit_id);
    if (!$customer) {
        echo "Không tìm thấy khách hàng.";
    }
}
?>


<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($_GET['edit_id']) ? "Chỉnh Sửa Thông Tin Khách Hàng" : "Thêm Mới Khách Hàng"; ?></h6>
            </div>
            <div class="card-body">
                <form method="post">
                    <?php if (isset($_GET['edit_id'])) : ?>
                        <input type="hidden" name="id" value="<?php echo $customer['id_User']; ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" class="form-control" name="username" value="<?php echo isset($customer['username']) ? $customer['username'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo isset($customer['email']) ? $customer['email'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Số Điện Thoại:</label>
                        <input type="text" class="form-control" name="phone_number" value="<?php echo isset($customer['phone_number']) ? $customer['phone_number'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Địa Chỉ:</label>
                        <textarea class="form-control" name="address" required><?php echo isset($customer['address']) ? $customer['address'] : ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="<?php echo isset($_GET['edit_id']) ? 'update_user' : 'add_user'; ?>"><?php echo isset($_GET['edit_id']) ? "Cập Nhật" : "Thêm Mới"; ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Danh sách khách hàng -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh Sách Khách Hàng</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Địa Chỉ</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($customers)) {
                                foreach ($customers as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id_User"] . "</td>";
                                    echo "<td>" . $row["username"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>" . $row["phone_number"] . "</td>";
                                    echo "<td>" . $row["address"] . "</td>";
                                    echo "<td><a href='?edit_id=" . $row["id_User"] . "'>Sửa</a> | <a href='?delete_id=" . $row["id_User"] . "' onclick=\"return confirm('Bạn chắc chắn muốn xóa khách hàng này?');\">Xóa</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>Không có khách hàng nào.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include('../admin/includes/footer.php'); ?>
