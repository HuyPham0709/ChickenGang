<?php
include('../admin/includes/header.php');
include('../admin/functions/manage-account.php');
include('../admin/auth.php');
?>
<!-- Content Row -->
<div class="row">
    <!-- Form thêm/sửa tài khoản -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thêm/Sửa Tài Khoản Người Dùng</h6>
            </div>
            <div class="card-body">
                <?php
                // Nếu có id để sửa tài khoản, lấy thông tin tài khoản từ database
                if (isset($_GET['edit_id'])) {
                    $edit_id = (int)$_GET['edit_id'];
                    $sql = "SELECT * FROM login WHERE id_Login = $edit_id";
                    $result = $con->query($sql);
                    $user = $result->fetch_assoc();
                }
                ?>

                <form method="POST" action="">
                    <input type="hidden" name="user_id" value="<?php echo isset($user['id_Login']) ? $user['id_Login'] : ''; ?>">
                    <div class="form-group">
                        <label for="username">Tên Đăng Nhập</label>
                        <input type="text" class="form-control" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật Khẩu</label>
                        <input type="password" class="form-control" name="password" value="<?php echo isset($user['password']) ? $user['password'] : ''; ?>" required>
                    </div>
                    <?php if (isset($user['id_Login'])) { ?>
                        <button type="submit" name="edit_user" class="btn btn-primary">Sửa Tài Khoản</button>
                    <?php } else { ?>
                        <button type="submit" name="add_user" class="btn btn-primary">Thêm Tài Khoản</button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Danh sách tài khoản người dùng -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh Sách Tài Khoản Người Dùng</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Đăng Nhập</th>
                                <th>Mật Khẩu</th>
                                <th>Vai Trò</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Hiển thị danh sách tài khoản người dùng
                            $sql = "SELECT * FROM login WHERE role = 'user'";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id_Login"] . "</td>";
                                    echo "<td>" . $row["username"] . "</td>";
                                    echo "<td>" . $row["password"] . "</td>";
                                    echo "<td>" . $row["role"] . "</td>";
                                    echo "<td>
                                            <a href='?edit_id=" . $row["id_Login"] . "'>Sửa</a> | 
                                            <a href='?delete_id=" . $row["id_Login"] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?');\">Xóa</a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Không có tài khoản người dùng nào.</td></tr>";
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
