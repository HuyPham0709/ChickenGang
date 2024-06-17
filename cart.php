<?php
// Kết nối đến cơ sở dữ liệu
require_once 'connect.php';

// Bắt đầu hoặc khôi phục phiên
session_start();

// Khởi tạo giỏ hàng nếu chưa tồn tại trong session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Xử lý yêu cầu xóa sản phẩm khỏi giỏ hàng
if (isset($_POST['remove_item'])) {
    $index = $_POST['index'];
    unset($_SESSION['cart'][$index]);
    header("Location: cart.php");
    exit();
}

// Xử lý cập nhật số lượng sản phẩm trong giỏ hàng
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $index => $quantity) {
        if (isset($_SESSION['cart'][$index])) {
            $_SESSION['cart'][$index]['quantity'] = $quantity;
        }
    }
    header("Location: cart.php");
    exit();
}

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$sql = "SELECT p.*, pi.color, pi.image_path 
        FROM Products p
        LEFT JOIN Product_Image pi ON p.id_Product = pi.product_id";
$result = $conn->query($sql);

// Kiểm tra và gán dữ liệu cho biến $products
if ($result->num_rows > 0) {
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['id_Product'];
        if (!isset($products[$product_id])) {
            $products[$product_id] = array(
                'id' => $row['id_Product'],
                'name' => $row['product_name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'created_at' => $row['created_at'],
                'update_at' => $row['update_at'],
                'images' => array()
            );
        }

        if (!empty($row['color']) && !empty($row['image_path'])) {
            $products[$product_id]['images'][$row['color']] = $row['image_path'];
        }
    }
} else {
    echo "Không có dữ liệu trong bảng Products";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your cart</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="cart.js"></script>
    <style>
        body{
            background-color: #e8f5ff;
        }
         @media screen and (max-width: 550px){
             .item{
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <?php include "menu.php";?>
    <div class="shopping-cart">
        <!-- Title -->
        <div class="title">
            Shopping Bag
        </div>

        <?php if (!empty($_SESSION['cart'])): ?>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <!-- Product #<?= $index + 1 ?> -->
                    <div class="item" style="display: flex;">
                        <div class="buttons">
                            <input type="hidden" name="index" value="<?= $index; ?>">
                            <button type="button" class="delete-btn"><i class='bx bx-trash'></i></button>
                            <span class="like-btn"></span>
                        </div>
                        <div class="image" style="width: 150px;height:150px">
                            <!-- Kiểm tra xem 'image_path' có tồn tại không -->
                            <?php if (isset($item['image_path'])): ?>
                                <img style="width: 90px;height:90px" src="<?= (strpos($item['image_path'], 'img/') === false) ? 'img/' . $item['image_path'] : $item['image_path']; ?>" alt="<?= isset($item['name']) ? $item['name'] : ''; ?>" />
                            <?php endif; ?>
                        </div>

                        <div class="description">
                            <!-- Kiểm tra xem 'name' có tồn tại không -->
                            <span><?= isset($item['name']) ? $item['name'] : ''; ?></span>
                            <!-- Kiểm tra xem 'color' có tồn tại không -->
                            <span><?= isset($item['color']) ? $item['color'] : ''; ?></span>
                        </div>

                        <div class="quantity" style="display: flex;justify-content: center;align-items: center;">
                            <input type="hidden" name="cart[<?= $index; ?>][id]" value="<?= isset($item['id']) ? $item['id'] : ''; ?>">
                            <input type="hidden" name="cart[<?= $index; ?>][color]" value="<?= isset($item['color']) ? $item['color'] : ''; ?>">
                            <button type="button" class="minus-btn" data-index="<?= $index; ?>">
                                <i class='bx bx-minus'></i>
                            </button>
                            <input type="text" name="quantity[<?= $index; ?>]" value="<?= isset($item['quantity']) ? $item['quantity'] : ''; ?>" data-index="<?= $index; ?>" data-price="<?= isset($item['price']) ? $item['price'] : ''; ?>" class="quantity-input">
                            <button type="button" class="plus-btn" data-index="<?= $index; ?>">
                                <i class='bx bx-plus'></i>
                            </button>
                        </div>

                        <div class="total-price" style="display: flex;justify-content: center;align-items: center;" data-index="<?= $index; ?>">
                            <!-- Kiểm tra xem 'price' và 'quantity' có tồn tại không -->
                            $ <?= isset($item['price']) && isset($item['quantity']) ? ($item['price'] * $item['quantity']) : ''; ?> 
                        </div>
                    </div>
                <?php endforeach; ?>
            </form>
            <a class="fancy" href="./checkout.php">
                <span class="top-key"></span>
                <span class="text">Check Out</span>
                <span class="bottom-key-1"></span>
                <span class="bottom-key-2"></span>
            </a>
        <?php else: ?>
            <div class="empty-cart-message">
                No items in cart.
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        $(document).ready(function() {
    $('.plus-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $input = $this.closest('div').find('input.quantity-input');
        var value = parseInt($input.val());

        if (value < 100) {
            value = value + 1;
        } else {
            value = 100;
        }

        $input.val(value);
        updateCart($this.data('index'), value);
    });

    $('.minus-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $input = $this.closest('div').find('input.quantity-input');
        var value = parseInt($input.val());

        if (value > 1) {
            value = value - 1;
        } else {
            value = 1;
        }

        $input.val(value);
        updateCart($this.data('index'), value);
    });

    function updateCart(index, quantity) {
        $.ajax({
            type: "POST",
            url: "update_cart.php",
            data: { index: index, quantity: quantity, update_cart: true },
            success: function(data) {
                location.reload(); // Tải lại trang để cập nhật giỏ hàng mới
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function removeFromCart(index) {
        $.ajax({
            type: "POST",
            url: "remove_from_cart.php",
            data: { index: index },
            success: function(data) {
                var response = JSON.parse(data);
                if (response.status === 'success') {
                    location.reload(); // Tải lại trang để cập nhật giỏ hàng mới
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    $('.delete-btn').on('click', function() {
        var index = $(this).siblings('input[name="index"]').val();
        removeFromCart(index);
    });
});

    </script>

</body>
</html>
