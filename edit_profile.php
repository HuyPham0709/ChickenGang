<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$query_customer = "SELECT id_User, username, email, phone_number, address FROM customer WHERE username='$username'";
$result_customer = mysqli_query($conn, $query_customer);

if ($result_customer) {
    $user = mysqli_fetch_assoc($result_customer);
} else {
    echo "Lỗi: " . mysqli_error($conn);
    exit();
}

// Xử lý dữ liệu khi người dùng cập nhật thông tin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form và cập nhật vào database
    $new_email = $_POST['email'];
    $new_phone = $_POST['phone'];
    $new_address = $_POST['address'];

    // Cập nhật thông tin mới vào database
    $query_update = "UPDATE customer SET email='$new_email', phone_number='$new_phone', address='$new_address' WHERE id_User=" . $user['id_User'];
    $result_update = mysqli_query($conn, $query_update);

    if ($result_update) {
        echo '<script>alert("Cập nhật thông tin thành công!");</script>';
        // Cập nhật lại thông tin hiển thị trên trang (nếu cần thiết)
        // Ví dụ: $user['email'] = $new_email;
        // Cập nhật biến session nếu cần thiết
        // Ví dụ: $_SESSION['email'] = $new_email;
    } else {
        echo "Lỗi khi cập nhật thông tin: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <style>
        /* Import Font Dancing Script */
@import url(https://fonts.googleapis.com/css?family=Dancing+Script);

* {
    margin: 0;
}

body {
    background-color: #e8f5ff;
    font-family: Arial;
    overflow: hidden;
}

/* NavbarTop */
.navbar-top {
    background-color: #fff;
    color: #333;
    box-shadow: 0px 4px 8px 0px grey;
    height: 70px;
}

.title {
    font-family: 'Dancing Script', cursive;
    padding-top: 15px;
    position: absolute;
    left: 45%;
}

.navbar-top ul {
    float: right;
    list-style-type: none;
    margin: 0;
    overflow: hidden;
    padding: 18px 50px 0 40px;
}

.navbar-top ul li {
    float: left;
}

.navbar-top ul li a {
    color: #333;
    padding: 14px 16px;
    text-align: center;
    text-decoration: none;
}

.icon-count {
    background-color: #ff0000;
    color: #fff;
    float: right;
    font-size: 11px;
    left: -25px;
    padding: 2px;
    position: relative;
}

/* End */

/* Sidenav */
.sidenav {
    background-color: #fff;
    color: #333;
    border-bottom-right-radius: 25px;
    height: 86%;
    left: 0;
    overflow-x: hidden;
    padding-top: 20px;
    position: absolute;
    top: 70px;
    width: 250px;
    z-index: 999999;
}

.profile {
    margin-bottom: 20px;
    margin-top: -12px;
    text-align: center;
}

.profile img {
    border-radius: 50%;
    box-shadow: 0px 0px 5px 1px grey;
}

.name {
    font-size: 20px;
    font-weight: bold;
    padding-top: 20px;
}

.job {
    font-size: 16px;
    font-weight: bold;
    padding-top: 10px;
}

.url, hr {
    text-align: center;
}

.url hr {
    margin-left: 20%;
    width: 60%;
}

.url a {
    color: #818181;
    display: block;
    font-size: 20px;
    margin: 10px 0;
    padding: 6px 8px;
    text-decoration: none;
}

.url a:hover, .url .active {
    background-color: #e8f5ff;
    border-radius: 28px;
    color: #000;
    margin-left: 14%;
    width: 65%;
}

/* End */

/* Main */
.main {
    margin: 20px auto;
    font-size: 28px;
    padding: 0 10px;
    width: 58%;
}

.main h2 {
    color: #333;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 24px;
    margin-bottom: 10px;
}

.main .card {
    background-color: #fff;
    border-radius: 18px;
    box-shadow: 1px 1px 8px 0 grey;
    height: auto;
    margin-bottom: 20px;
    padding: 20px 0 20px 50px;
}

.main .card table {
    border: none;
    font-size: 16px;
    height: 270px;
    width: 80%;
}

.edit {
    position: absolute;
    color: #e7e7e8;
    right: 14%;
}

.social-media {
    text-align: center;
    width: 90%;
}

.social-media span {
    margin: 0 10px;
}
.cart-info-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.cart-info-table th, .cart-info-table td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
}

.cart-info-table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.cart-info-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.cart-info-table tbody tr:hover {
    background-color: #f1f1f1;
}
.cart-table th{
    margin: 20px;
}
.text-center {
    text-align: center;
}
.cart-table th,
    .cart-table td {
        text-align: center;
        padding: 10px; /* Để cân đối khoảng cách nếu cần thiết */
    }
    .form {
 --width-of-input: 200px;
 --border-height: 1px;
 --border-before-color: rgba(221, 221, 221, 0.39);
 --border-after-color: #5891ff;
 --input-hovered-color: #4985e01f;
 position: relative;
 width: var(--width-of-input);
}
/* styling of Input */
.card-body .input {
 color: black;
 font-size: 0.9rem;
 background-color: transparent;
 width: 140%;
 box-sizing: border-box;
 padding-inline: 0.5em;
 padding-block: 0.7em;
 border: none;
 border-bottom: var(--border-height) solid var(--border-before-color);
}
/* styling of animated border */
.card-body .input-border {
 position: absolute;
 background: var(--border-after-color);
 width: 0%;
 height: 2px;
 bottom: 0;
 left: 0;
 transition: 0.3s;
}
/* Hover on Input */
.card-body input:hover {
 background: var(--input-hovered-color);
}

.card-body input:focus {
 outline: none;
}
/* here is code of animated border */
.card-body input:focus ~ .input-border {
 width: 100%;
}
/* === if you want to do animated border on typing === */
/* remove input:focus code and uncomment below code */
/* input:valid ~ .input-border{
  width: 100%;
} */
.card-body button {
  position: relative;
  padding: 10px 20px;
  border-radius: 7px;
  border: 1px solid rgb(61, 106, 255);
  font-size: 14px;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 2px;
  background: transparent;
  color: rgb(61, 106, 255);
  overflow: hidden;
  box-shadow: 0 0 0 0 transparent;
  -webkit-transition: all 0.2s ease-in;
  -moz-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
}

.card-body button:hover {
  background: rgb(61, 106, 255);
  -webkit-transition: all 0.2s ease-out;
  -moz-transition: all 0.2s ease-out;
  transition: all 0.2s ease-out;
  color: #fff;
}

.card-body button:hover::before {
  -webkit-animation: sh02 0.5s 0s linear;
  -moz-animation: sh02 0.5s 0s linear;
  animation: sh02 0.5s 0s linear;
}

.card-body button::before {
  content: '';
  display: block;
  width: 0px;
  height: 86%;
  position: absolute;
  top: 7%;
  left: 0%;
  opacity: 0;
  background: #fff;
  box-shadow: 0 0 50px 30px #fff;
  -webkit-transform: skewX(-20deg);
  -moz-transform: skewX(-20deg);
  -ms-transform: skewX(-20deg);
  -o-transform: skewX(-20deg);
  transform: skewX(-20deg);
}

@keyframes sh02 {
  from {
    opacity: 0;
    left: 0%;
  }

  50% {
    opacity: 1;
  }

  to {
    opacity: 0;
    left: 100%;
  }
}

.card-body button:active {
  box-shadow: 0 0 0 0 transparent;
  -webkit-transition: box-shadow 0.2s ease-in;
  -moz-transition: box-shadow 0.2s ease-in;
  transition: box-shadow 0.2s ease-in;
}

    </style>
</head>
<body>
    <?php include "menu.php"; ?>
    <div class="main">
        <h2>Edit Profile</h2>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <table>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td><?= $user['username'] ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <div class="form">
                                        <input class="input" placeholder="Type your text" required="" type="text" name="email" value="<?= $user['email'] ?>">
                                        <span class="input-border"></span>
                                    </div>
                                </div>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>
                                    <div class="form">
                                        <input class="input" placeholder="Type your text" required="" type="text"  name="address" value="<?= $user['address'] ?>">
                                        <span class="input-border"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>:</td>
                                <td>
                                    <div class="form">
                                        <input class="input" placeholder="Type your text" required="" type="text"  name="phone" value="<?= $user['phone_number'] ?>">
                                        <span class="input-border"></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
