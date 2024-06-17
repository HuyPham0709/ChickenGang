<?php
session_start();                  
include('../admin/db.php');
include('../admin/auth.php');

$error = ""; // Khởi tạo biến lỗi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn kiểm tra username và password
    $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Kiểm tra vai trò của người dùng
        if ($row['role'] == 'admin') {
            // Lưu thông tin người dùng vào session
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin'; // Lưu vai trò vào session
            // Chuyển hướng đến trang quản trị hoặc trang mà bạn muốn
            header("Location:../admin/index.php");
            exit(); // Kết thúc kịch bản để ngăn mã tiếp tục thực thi
        } else {
            $error = "You don't have permission to access this area.";
        }
    } else {
        $error = "Username or Password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ChickenGang</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>
            <form class="user" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user"
                        id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Username..." name="username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user"
                        id="exampleInputPassword" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                </button>
            </form>
            <?php
            if (isset($error)) {
                echo "<div class='text-center text-danger'>$error</div>";
            }
            ?>

        </div>
    </div>
</div>
