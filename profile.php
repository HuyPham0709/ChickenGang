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

if (!$result_customer) {
    echo "Error fetching customer data: " . mysqli_error($conn);
    exit();
}

$user = mysqli_fetch_assoc($result_customer);
$user_id = $user['id_User'];

$query_cart = "SELECT id_Cart, color, product_name, Quantity, price, order_date, status, total_money FROM cart WHERE user_id='$user_id'";
$result_cart = mysqli_query($conn, $query_cart);

if (!$result_cart) {
    echo "Error fetching cart data: " . mysqli_error($conn);
    exit();
}

$cart_items = [];
while ($row = mysqli_fetch_assoc($result_cart)) {
    $cart_items[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
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
        }

        .main .card table {
            border: none;
            font-size: 16px;
            height: 270px;
            width: 80%;
        }

        .edit {
            position: absolute;
            color: #333;
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
        .card-body{
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <?php include "menu.php"; ?>

    <div class="main">
        <h2>IDENTITY <a href="edit_profile.php"><i class="fa fa-edit edit"></i></a></h2>
        <div class="card">
            <div class="card-body">
                <table>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?= htmlspecialchars($user['address']) ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>:</td>
                            <td><?= htmlspecialchars($user['phone_number']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <h2>CART ITEMS</h2>
        <div class="card">
            <div class="card-body">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Color</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Order Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Total Money</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td class="text-center"><?= htmlspecialchars($item['product_name']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($item['color']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($item['Quantity']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($item['price']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($item['order_date']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($item['status']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($item['total_money']) ?></td>
                        </tr>
                        <?php endforeach; ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
