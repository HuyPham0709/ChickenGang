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

    // Lấy danh sách sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT p.*, pi.image_path, pi.color 
            FROM Products p
            LEFT JOIN Product_Image pi ON p.id_Product = pi.product_id
            WHERE p.collection = 'LAZY'";
    $result = $conn->query($sql);

    // Khởi tạo một mảng để lưu trữ các màu cho mỗi sản phẩm
    $products = array();

    // Khởi tạo mảng $colors để lưu trữ tất cả các màu
    $colors = array();

    // Kiểm tra và gán dữ liệu cho biến $products và $colors
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['id_Product'];
            if (!isset($products[$product_id])) {
                // Nếu sản phẩm chưa được thêm vào mảng $products, thì thêm sản phẩm đó vào mảng
                $products[$product_id] = array(
                    'id' => $row['id_Product'],
                    'name' => $row['product_name'],
                    'description' => $row['description'],
                    'price' => $row['price'],
                    'quantity' => $row['quantity'],
                    'created_at' => $row['created_at'],
                    'update_at' => $row['update_at'],
                    'images' => array(), // Mảng để lưu trữ các hình ảnh của sản phẩm
                    'colors' => array() // Mảng để lưu trữ các màu của sản phẩm
                );
            }

            // Thêm hình ảnh vào mảng images của sản phẩm
            if (!empty($row['color']) && !empty($row['image_path'])) {
                $products[$product_id]['images'][$row['color']] = $row['image_path'];
                
                // Nếu màu chưa được thêm vào mảng colors của sản phẩm, thì thêm màu đó vào mảng
                if (!in_array($row['color'], $products[$product_id]['colors'])) {
                    $products[$product_id]['colors'][] = $row['color'];
                    
                    // Đồng thời cập nhật màu vào mảng $colors nếu chưa tồn tại
                    if (!in_array($row['color'], $colors)) {
                        $colors[] = $row['color'];
                    }
                }
            }
        }
    }
    // Khai báo biến $css trước khi sử dụng
    $css = '';
    foreach ($colors as $color) {
        
        $css .= "
        .product-card .color-price .color-option{
            display: flex;
            align-items: center;
        }
        .color-price{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .color-price .color-option .color{
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-right: 8px;
        }
        .color-option .circles{
            display: flex;
        }
        .color-option .circles .circle{
            height: 18px;
            width: 18px;
            background: $color;
            border-radius: 50%;
            margin: 0 4px;
            cursor: pointer;
            transition: all 0.4s ease;
        }
        .color-option .circles .circle.$color.active{
            box-shadow: 0 0 0 2px #fff, 0 0 0 4px $color;
        }
        .color-price .price{
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 10px;
        }
        .color-price .price .price_num{
            font-size: 25px;
            font-weight: 600;
            color: #707070;
        }
        .color-price .price .price_letter{
            font-size: 10px;
            font-weight: 600;
            margin-top: -4px;
            color: #707070;
        }
        .color-option  .circles .circle.$color.active{
            box-shadow: 0 0 0 2px #fff,
                        0 0 0 4px $color;
        }
        .color-option  .circles .circle.$color{
            background: $color;
        }";
        
    }

    // Xử lý dữ liệu gửi từ biểu mẫu
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST['products'] as $index => $product) {
            if (isset($_POST['add_to_cart_' . $index])) {
                $product_id = $product['id'];
                $product_name = $product['name'];
                $price = $product['price'];
                $color = $_POST['products'][$index]['color'];
                $quantity = $_POST['products'][$index]['num'];
                $image_path = $product['image_path'];

                // Tạo một mảng chứa thông tin sản phẩm
                $item = array(
                    'id' => $product_id,
                    'name' => $product_name,
                    'price' => $price,
                    'color' => $color,
                    'quantity' => $quantity,
                    'image_path' => $image_path
                );

                // Thêm sản phẩm vào giỏ hàng
                $_SESSION['cart'][] = $item;

                // Hiển thị thông báo thành công
                echo "<script>alert('Add to cart successfully!');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAZY THINK COLLECTION</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            background-color: #e8f5ff;
        }
        .group {
  display: flex;
  line-height: 28px;
  align-items: center;
  position: relative;
  max-width: 190px;
}

.input {
  /* width: 100%; */
  height: 40px;
  line-height: 28px;
  padding: 0 1rem;
  padding-left: 2.5rem;
  border: 2px solid transparent;
  border-radius: 8px;
  outline: none;
  background-color: #f3f3f4;
  color: #0d0c22;
  transition: 0.3s ease;
}

.input::placeholder {
  color: #9e9ea7;
}

.input:focus,
input:hover {
  outline: none;
  border-color: rgba(247, 127, 0, 0.4);
  background-color: #fff;
  box-shadow: 0 0 0 4px rgb(247 127 0 / 10%);
}

.icon {
  position: absolute;
  left: 1rem;
  fill: #9e9ea7;
  width: 1rem;
  height: 1rem;
}
.headweb{
    font-weight: 200;
     border-bottom: 1px solid black; 
     padding: 20px;
      margin: 0 50px 50px 50px;
      display:flex;
      justify-content:space-between;
      align-items:flex-end;
    }
@media screen and (max-width: 1040px){
    .headweb{
        display: block;
    }
}
        <?php echo $css; ?>
            .color-option  .circles .circle.while.active{
                box-shadow: 0 0 0 2px #fff,
                            0 0 0 4px #EEEEEE;
            }
    </style>
</head>
<body>
    <?php include "menu.php"; ?>
    <div class="headweb">
        <!-- Search Form -->
        <h2  style="font-weight: 200;">LAZY THINK COLLECTION</h2>
    </div>
    </h2>
    <section class="product-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="display: flex; flex-wrap: wrap; justify-content: center;">
            <?php foreach ($products as $index => $product): ?>
                <div class="product-card" style="margin: 10px">
                    <input type="hidden" name="products[<?= $index; ?>][id]" value="<?= $product['id']; ?>">
                    <input type="hidden" name="products[<?= $index; ?>][name]" value="<?= $product['name']; ?>">
                    <input type="hidden" name="products[<?= $index; ?>][price]" value="<?= $product['price']; ?>">
                    <input type="hidden" name="products[<?= $index; ?>][color]" id="selected_color_<?= $index; ?>" value="<?= $product['colors'][0] ?? ''; ?>">
                    <input type="hidden" name="products[<?= $index; ?>][image_path]" id="product_image_<?= $index; ?>" value="<?= $product['images'][$product['colors'][0]] ?? ''; ?>">
                    <input type="hidden" name="products[<?= $index; ?>][num]" value="1">

                    <div class="logo-cart">
                        <div class="heart-container" title="like">
                            <input type="checkbox" class="checkbox" id="Give-It-An-Id">
                            <div class="svg-container">
                                <!-- Mã SVG -->
                                <svg viewBox="0 0 24 24" class="svg-outline" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path>
                                </svg>
                                <svg viewBox="0 0 24 24" class="svg-filled" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"></path>
                                </svg>
                                <svg class="svg-celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="10,10 20,20"></polygon>
                                    <polygon points="10,50 20,50"></polygon>
                                    <polygon points="20,80 30,70"></polygon>
                                    <polygon points="90,10 80,20"></polygon>
                                    <polygon points="90,50 80,50"></polygon>
                                    <polygon points="80,80 70,70"></polygon>
                                </svg>
                            </div>
                        </div>
                        <button style="border: none;background-color: transparent;" type="submit" name="add_to_cart_<?= $index; ?>"><i class='bx bx-shopping-bag'></i></button>
                    </div>
                    <a href="product_detail.php?id=<?= $product['id']; ?>">
                        <div class="main-images">
                            <?php 
                                $firstColor = key($product['images']); // Lấy màu đầu tiên từ mảng images
                            ?>
                            <?php foreach ($product['images'] as $color => $image): ?>
                                <img style="left: 10px;" id="<?= $color; ?>" class="<?= $color === $firstColor ? 'active' : ''; ?>" src="img/<?= $image; ?>" alt="<?= $color; ?>" name="<?= $color; ?>">
                            <?php endforeach; ?>
                        </div>
                    </a>
                    <div class="shoe-details">
                        <span class="shoe_name"><?= $product['name']; ?></span>
                        <p><?= $product['description']; ?></p>
                    </div>
                    <div class="color-price">
                        <div class="color-option">
                            <span class="color">Colour:</span>
                            <div class="circles">   
                            <?php foreach ($product['colors'] as $color): ?>
                                <span class="circle <?= $color === $firstColor ? $color . ' active' : $color; ?>" id="<?= $color; ?>" data-index="<?= $index; ?>" data-color="<?= $color; ?>" style="background-color: <?= $color === 'blue' ? '#0071C7' : ($color === 'pink' ? '#FF76CE' : ($color === 'white' ? '#EEEEEE' : ($color === 'yellow' ? '#F5DA00' : $color))); ?>;"></span>
                            <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="price">
                            <span class="price_num"><?= $product['price']; ?></span>
                            <span class="price_letter">Just <?= $product['price']; ?>$ only</span>
                        </div>
                    </div>
                    <div class="button">
                        <div class="button-layer"></div>
                        <button type="submit" name="add_to_cart_<?= $index; ?>">Add to cart</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </form>
    </section>
    <?php include "footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelectorAll('.color-option .circle').forEach(circle => {
            circle.addEventListener("click", (e) => {
                let target = e.target;
                if (target.classList.contains("circle")) {
                    let colorName = target.id;
                    let productCard = target.closest('.product-card');
                    productCard.querySelectorAll('.color-option .circle').forEach(c => c.classList.remove("active"));
                    target.classList.add("active");
                    productCard.querySelectorAll(".main-images img").forEach(image => {
                        image.classList.toggle("active", image.getAttribute("name") === colorName);
                    });
                    let index = target.getAttribute('data-index');
                    document.getElementById(`selected_color_${index}`).value = colorName;
                    let imagePath = productCard.querySelector(`img[name="${colorName}"]`).getAttribute('src');
                    document.getElementById(`product_image_${index}`).value = imagePath;
                }
            });
        });
    </script>
</body>
</html>
