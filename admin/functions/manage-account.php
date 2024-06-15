<?php
include ('../admin/db.php');
// Xử lý xóa tài khoản
if (isset($_GET['delete_id'])) {
    $user_id = (int)$_GET['delete_id'];
    $sql = "DELETE FROM login WHERE id_Login = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
        // Nếu xóa thành công, chuyển hướng trang về lại chính nó
        header("Location: ".$_SERVER['PHP_SELF']);
        exit(); // Thêm exit() sau header() để ngăn chặn việc thực thi tiếp tục
    } else {
        // Nếu xóa thất bại, hiển thị thông báo lỗi
        echo '<script>alert("Xóa tài khoản thất bại!");</script>';
    }
}


// Xử lý sửa tài khoản
if (isset($_POST['edit_user'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "UPDATE login SET username = ?, password = ? WHERE id_Login = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssi", $username, $password, $user_id);
    $stmt->execute();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Xử lý xóa tài khoản
if (isset($_GET['delete_id'])) {
    $user_id = (int)$_GET['delete_id'];
    $sql = "DELETE FROM login WHERE id_Login = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>