<?php
session_start();
require_once 'db.php';

// Xử lý thanh toán khi người dùng nhấn nút Checkout
if (isset($_POST['checkout'])) {
    // Lấy thông tin thanh toán từ form và escape để ngăn chặn SQL Injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);
    $expiry_date = mysqli_real_escape_string($conn, $_POST['expiry_date']);
    $cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $user_id = $_SESSION['user_id']; // Lấy user_id từ session

    // Tính tổng số tiền của đơn hàng từ giỏ hàng trong session
    $total_amount = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }
    }

    // Thêm thông tin đơn hàng vào cơ sở dữ liệu
    $insert_customer_query = "INSERT INTO Customer_Information (user_id, username, email, phone_number, address, card_number, expire_date, cvv)
                     VALUES ('$user_id', '$username', '$email', '$phone_number', '$address', '$card_number', '$expiry_date', '$cvv')";

    if (mysqli_query($conn, $insert_customer_query)) {
        // Lấy ID của khách hàng vừa thêm vào
        $customer_id = mysqli_insert_id($conn);
        
        // Thêm thông tin đơn hàng vào bảng Cart
        foreach ($_SESSION['cart'] as $item) {
            $product_name = mysqli_real_escape_string($conn, $item['name']);
            $price = $item['price'];
            $quantity = $item['quantity'];
            $color = mysqli_real_escape_string($conn, $item['color']); // Lấy thông tin màu sắc
            
            // Tính toán total_money cho từng sản phẩm
            $total_money = $price * $quantity;
            
            // Thêm thông tin đơn hàng vào bảng Cart với total_money của từng sản phẩm
            $insert_order_query = "INSERT INTO Cart (user_id, product_name, price, quantity, order_date, status, total_money, color)
                       VALUES ('$user_id', '$product_name', '$price', '$quantity', NOW(), 0, '$total_money', '$color')";
        
            mysqli_query($conn, $insert_order_query);
        }

        // Xóa giỏ hàng sau khi lưu thông tin đơn hàng thành công
        unset($_SESSION['cart']);
        echo "<script>alert('Thanh toán thành công.');</script>";
        // Sau khi thông báo thành công, chuyển hướng người dùng về trang chủ
        echo "<script>window.location.replace('index.php');</script>";
        exit();
    } else {
        echo "Đã xảy ra lỗi khi lưu thông tin đơn hàng: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include "menu.php";?>
<div class="container container-checkout" style="border-top: 3px solid black;">
    <h2 class="text-center my-4">Checkout</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h4>Order Summary</h4>
            <?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total_amount = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $total_amount += $item['price'] * $item['quantity'];
                    echo "<tr>
                            <td>{$item['name']}</td>
                            <td>$ {$item['price']}</td>
                            <td>{$item['color']}</td> <!-- Hiển thị màu sắc -->
                            <td>{$item['quantity']}</td>
                            <td>$ " . number_format($item['price'] * $item['quantity'], 2) . "</td>
                          </tr>";
                }
                ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total Amount</strong></td>
                    <td><strong>$ <?= number_format($total_amount, 2) ?></strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h4 class="mb-4">Payment Details</h4>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="card_number" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="card_number" name="card_number" required>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                    </div>
                    <div class="col">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" maxlength="3" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                    </div>
                </div>
                <button type="submit" name="checkout">
                  Check Out
                  <div class="star-1">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      xml:space="preserve"
                      version="1.1"
                      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                      viewBox="0 0 784.11 815.53"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs></defs>
                      <g id="Layer_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <path
                          class="fil0"
                          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                        ></path>
                      </g>
                    </svg>
                  </div>
                  <div class="star-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      xml:space="preserve"
                      version="1.1"
                      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                      viewBox="0 0 784.11 815.53"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs></defs>
                      <g id="Layer_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <path
                          class="fil0"
                          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                        ></path>
                      </g>
                    </svg>
                  </div>
                  <div class="star-3">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      xml:space="preserve"
                      version="1.1"
                      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                      viewBox="0 0 784.11 815.53"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs></defs>
                      <g id="Layer_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <path
                          class="fil0"
                          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                        ></path>
                      </g>
                    </svg>
                  </div>
                  <div class="star-4">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      xml:space="preserve"
                      version="1.1"
                      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                      viewBox="0 0 784.11 815.53"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs></defs>
                      <g id="Layer_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <path
                          class="fil0"
                          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                        ></path>
                      </g>
                    </svg>
                  </div>
                  <div class="star-5">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      xml:space="preserve"
                      version="1.1"
                      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                      viewBox="0 0 784.11 815.53"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs></defs>
                      <g id="Layer_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <path
                          class="fil0"
                          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                        ></path>
                      </g>
                    </svg>
                  </div>
                  <div class="star-6">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      xml:space="preserve"
                      version="1.1"
                      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                      viewBox="0 0 784.11 815.53"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs></defs>
                      <g id="Layer_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <path
                          class="fil0"
                          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
                        ></path>
                      </g>
                    </svg>
                  </div>
                </button>
            </form>
            <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No items in the cart.
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include"footer.php";?>
</body>
</html>
