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

    // Xử lý tìm kiếm sản phẩm
    $searchTerm = '';
    if (isset($_GET['search'])) {
        $searchTerm = $conn->real_escape_string($_GET['search']);
    }

    // Lấy danh sách sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT p.*, pi.image_path, pi.color 
            FROM Products p
            LEFT JOIN Product_Image pi ON p.id_Product = pi.product_id";
    if (!empty($searchTerm)) {
        $sql .= " WHERE p.product_name LIKE '%$searchTerm%' OR p.description LIKE '%$searchTerm%'";
    }
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
    } else {
        echo "Không có dữ liệu trong bảng Products";
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
<?php
    if (!isset($_SESSION['user_id'])) {
        // Nếu chưa đăng nhập, hiển thị thông báo và chuyển hướng về trang đăng nhập
        echo "<script>
                alert('You are not logged in! Please log in.');
                window.location.href = 'login.php';
              </script>";
        exit();
    }

    // Lấy ID người dùng từ session
    $user_id = $_SESSION['user_id'];
    // Lấy ID sản phẩm từ tham số truy vấn
    $product_id = $_GET['id'];

    // Theo dõi lượt xem sản phẩm
    $sql = "INSERT INTO user_behavior (user_id, product_id, action) VALUES ($user_id, $product_id, 'view')";
    $conn->query($sql);

    // Kiểm tra xem có tham số id sản phẩm được truyền qua không
    if (isset($_GET['id'])) {
        // Lấy id sản phẩm từ tham số truyền qua
        $product_id = $_GET['id'];

        // Truy vấn để lấy thông tin chi tiết của sản phẩm dựa trên id
        $sql = "SELECT p.*, pi.image_path, pi.color 
        FROM Products p
        LEFT JOIN Product_Image pi ON p.id_Product = pi.product_id
        WHERE p.id_Product = $product_id";

     
        $result = $conn->query($sql);

        // Kiểm tra xem có kết quả từ truy vấn không
        if ($result->num_rows > 0) {
            // Lấy thông tin của sản phẩm
            $product = $result->fetch_assoc();

            // Đặt lại con trỏ dòng kết quả về dòng đầu tiên
            mysqli_data_seek($result, 0);

            // Lấy tất cả các hình ảnh của sản phẩm
            $product['images'] = array();
            while ($row = $result->fetch_assoc()) {
                $product['images'][] = array(
                    'id' => $row['id_Product'], // Add product id
                    'image_path' => $row['image_path'],
                    'color' => $row['color']
                );
            }
        } else {
            // Nếu không có sản phẩm nào được tìm thấy, chuyển hướng về trang danh sách sản phẩm hoặc hiển thị thông báo lỗi
            header("Location: all_products.php");
            exit();
        }
    } else {
        // Nếu không có tham số id sản phẩm được truyền qua, chuyển hướng về trang danh sách sản phẩm hoặc hiển thị thông báo lỗi
        header("Location: all_products.php");
        exit();
    }
    // Hàm lấy sản phẩm gợi ý
    function getRecommendedProducts($conn, $user_id, $current_product_id) {
    // Lấy ID các sản phẩm đã xem bởi người dùng
    $sql = "SELECT DISTINCT product_id 
            FROM user_behavior 
            WHERE user_id = $user_id AND product_id != $current_product_id 
            ORDER BY created_at DESC 
            LIMIT 10";
    $result = $conn->query($sql);

    $recommended_product_ids = array();
    while ($row = $result->fetch_assoc()) {
        $recommended_product_ids[] = $row['product_id'];
    }

    if (empty($recommended_product_ids)) {
        return array();
    }

    // Lấy thông tin chi tiết của các sản phẩm được gợi ý
    $ids = implode(',', $recommended_product_ids);
    $sql = "SELECT p.*, pi.image_path, pi.color 
            FROM Products p 
            LEFT JOIN Product_Image pi ON p.id_Product = pi.product_id 
            WHERE p.id_Product IN ($ids)";
    $result = $conn->query($sql);

    $recommended_products = array();
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['id_Product'];
        if (!isset($recommended_products[$product_id])) {
            $recommended_products[$product_id] = array(
                'id' => $row['id_Product'],
                'name' => $row['product_name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'created_at' => $row['created_at'],
                'update_at' => $row['update_at'],
                'images' => array(),
                'colors' => array()
            );
        }

        if (!empty($row['color']) && !empty($row['image_path'])) {
            $recommended_products[$product_id]['images'][$row['color']] = $row['image_path'];
            if (!in_array($row['color'], $recommended_products[$product_id]['colors'])) {
                $recommended_products[$product_id]['colors'][] = $row['color'];
            }
        }
    }

    return $recommended_products;
}

// Lấy ID người dùng từ session hoặc phương thức khác
$user_id = $_SESSION['user_id'];

// Lấy ID sản phẩm hiện tại (nếu có)
$current_product_id = $_GET['id'];

// Lấy danh sách sản phẩm gợi ý
$recommended_products = getRecommendedProducts($conn, $user_id, $current_product_id);

?>
<?php if (isset($product['colors']) && is_array($product['colors'])): ?>
    <?php foreach ($product['colors'] as $color): ?>
        <li>Color: <span><?php echo $color; ?></span></li>
    <?php endforeach; ?>
<?php endif; ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Card/Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');
        body{
            line-height: 1.5;
        }
        <?php echo $css; ?>
            .color-option  .circles .circle.active{
                box-shadow: 0 0 0 2px #fff,
                            0 0 0 4px #EEEEEE;
        }
        .card-wrapper{
            margin: 0 auto;
        }
        img{
            width: 100%;
            display: block;
        }
        .img-display{
            overflow: hidden;
        }
        .img-showcase{
            display: flex;
            width: 100%;
            transition: all 0.5s ease;
        }
        .img-showcase img{
            min-width: 100%;
        }
        .img-select{
            display: flex;
        }
        .img-item{
            margin: 0.3rem;
        }
        .img-item:nth-child(1),
        .img-item:nth-child(2),
        .img-item:nth-child(3){
            margin-right: 0;
        }
        .img-item:hover{
            opacity: 0.8;
        }
        .product-content{
            padding: 2rem 1rem;
        }
        .product-title{
            font-size: 3rem;
            text-transform: capitalize;
            font-weight: 700;
            position: relative;
            color: #12263a;
            margin: 1rem 0;
        }
        .product-title::after{
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            width: 80px;
            background: #12263a;
        }
        .product-link{
            text-decoration: none;
            text-transform: uppercase;
            font-weight: 400;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 0.5rem;
            background: #256eff;
            color: #fff;
            padding: 0 0.3rem;
            transition: all 0.5s ease;
        }
        .product-link:hover{
            opacity: 0.9;
        }
        .product-rating{
            color: #ffc107;
        }
        .product-rating span{
            font-weight: 600;
            color: #252525;
        }
        .product-price{
            margin: 1rem 0;
            font-size: 1rem;
            font-weight: 700;
        }
        .product-price span{
            font-weight: 400;
        }
        .last-price span{
            color: #f64749;
            text-decoration: line-through;
        }
        .new-price span{
            color: #256eff;
        }
        .product-detail h2{
            text-transform: capitalize;
            color: #12263a;
            padding-bottom: 0.6rem;
        }
        .product-detail p{
            font-size: 0.9rem;
            padding: 0.3rem;
            opacity: 0.8;
        }
        .product-detail ul{
            margin: 1rem 0;
            font-size: 0.9rem;
        }
        .product-detail ul li{
            margin: 0;
            list-style: none;
            background: url(shoes_images/checked.png) left center no-repeat;
            background-size: 18px;
            padding-left: 1.7rem;
            margin: 0.4rem 0;
            font-weight: 600;
            opacity: 0.9;
        }
        .product-detail ul li span{
            font-weight: 400;
        }
        .purchase-info{
            margin: 1.5rem 0;
        }
        .purchase-info input,
        .purchase-info .btn{
            border: 1.5px solid #ddd;
            border-radius: 25px;
            text-align: center;
            padding: 0.45rem 0.8rem;
            outline: 0;
            margin-right: 0.2rem;
            margin-bottom: 1rem;
        }
        .purchase-info input{
            width: 60px;
        }
        .purchase-info .btn{
            cursor: pointer;
            color: #fff;
        }
        .purchase-info .btn:first-of-type{
            background: #256eff;
        }
        .purchase-info .btn:last-of-type{
            background: #f64749;
        }
        .purchase-info .btn:hover{
            opacity: 0.9;
        }
        .social-links{
            display: flex;
            align-items: center;
        }
        .social-links a{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            color: #000;
            border: 1px solid #000;
            margin: 0 0.2rem;
            border-radius: 50%;
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.5s ease;
        }
        .social-links a:hover{
            background: #000;
            border-color: transparent;
            color: #fff;
        }
        .product-imgs
        {
            max-width:500px
        }
        .product-imgs img {
            max-width: 100%; /* Hình ảnh không vượt quá kích thước của phần tử chứa */
            max-height: 100%; /* Hình ảnh không vượt quá kích thước của phần tử chứa */
        }
        .CartBtn {
            width: 140px;
            height: 40px;
            border-radius: 12px;
            border: none;
            background-color: #6FDCE3;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition-duration: .5s;
            overflow: hidden;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.103);
            position: relative;
            }

            .IconContainer {
            position: absolute;
            left: -50px;
            width: 30px;
            height: 30px;
            background-color: transparent;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            z-index: 2;
            transition-duration: .5s;
            }

            .icon {
            border-radius: 1px;
            }

            .text {
            height: 100%;
            width: fit-content;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgb(17, 17, 17);
            z-index: 1;
            transition-duration: .5s;
            font-size: 1.04em;
            font-weight: 600;
            }

            .CartBtn:hover .IconContainer {
            transform: translateX(58px);
            border-radius: 40px;
            transition-duration: .5s;
            }

            .CartBtn:hover .text {
            transform: translate(10px,0px);
            transition-duration: .5s;
            }

            .CartBtn:active {
            transform: scale(0.95);
            transition-duration: .5s;
            }
            .form{
                display: flex;
            }
        @media screen and (min-width: 992px){
            .card{
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                grid-gap: 1.5rem;
            }
            .card-wrapper{
                height: 160vh;
                display: flex;
                justify-content:space-around;
                align-items: center;
            }
            .product-imgs{
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .product-content{
                padding-top: 0;
            }
            .product-card .main-images{
                position:unset;
            }
            .product-card {
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                
            }
        }
        @media screen and (max-width: 990px){

            .image{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .product-container{
                display: flex;
                justify-content:space-between;
                align-items:center;
            }
            .product-card{
                height: 330px;
            }
        }
        @media screen and (max-width: 800px){
             .form{
                display: block;
                
            }
            .image{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .product-container{
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
            
        }
    </style>
  </head>
  <body>
  <?php include"menu.php";?>
    <div class="card-wrapper" style="margin: 40px;">
        <div class="card">
            <form action="add_to_cart.php" method="post" class="form">
                <!-- card left -->
                <div class="product-imgs">
                    <div class="img-display">
                        <div class="img-showcase" style="max-width: 500px;">
                            <?php foreach ($product['images'] as $image): ?>
                                <img src="img/<?= $image['image_path']; ?>" alt="<?= $image['color']; ?>">
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="img-select">
                        <?php if (isset($product['images']) && is_array($product['images'])): ?>
                            <?php foreach ($product['images'] as $image): ?>
                                <div class="img-item" style="max-width: 200px;">
                                    <a href="#" data-id="<?= $image['id']; ?>" data-color="<?= $image['color']; ?>" data-image-path="<?= $image['image_path']; ?>">
                                        <img src="img/<?= $image['image_path']; ?>" alt="<?= $image['color']; ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- card right -->
                <div class="product-content">
                    <h2 class="product-title"><?php echo $product['product_name']; ?></h2>
                    <div class="product-price">
                        <p class="last-price">Old Price: <span>$<?php echo $product['price'] + 2; ?></span></p>
                        <p class="new-price">New Price: <span>$<?php echo $product['price']; ?></span></p>
                    </div>
                    <div class="product-detail">
                        <h2>About this item:</h2>
                        <p><?php echo $product['description']; ?></p>
                        <p><?php echo $product['description_detail']; ?></p>
                        <ul>
                            <?php if (isset($product['images']) && is_array($product['images'])): ?>
                                <?php foreach ($product['images'] as $image): ?>
                                    <li>Color: <span><?php echo $image['color']; ?></span></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (isset($product['category'])): ?>
                                <li>Category: <span><?php echo $product['category']; ?></span></li>
                            <?php else: ?>
                                <li>No category available</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="purchase-info" style="display: flex;">
                        <input type="hidden" name="product_id" value="<?= $product_id; ?>">
                        <input type="hidden" name="image_path" value="<?= $product['images'][0]['image_path']; ?>">
                        <input type="hidden" name="color" value="<?= $product['images'][0]['color']; ?>">
                        <input type="number" name="quantity" min="0" value="1">
                        <div class="button">
                            <div class="button-layer"></div>
                            <button class="CartBtn" type="submit" value="Add to cart" style="margin-left: 10px;">
                                <span class="IconContainer"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="rgb(17, 17, 17)" class="cart"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path></svg>
                                </span>
                                <p class="text">Add to Cart</p>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php if (!empty($recommended_products)): ?>
            <section class="recommended-products">
                <center><h2 style="font-weight: 300;">May be you like</h2></center>
                <div class="product-container">
                    <?php 
                    $count = 0; // Initialize a counter
                    foreach ($recommended_products as $index => $product): 
                        if ($count >= 3) break; // Limit to 3 products
                        $count++; // Increment counter
                    ?>
                        <div class="product-card">
                            <a href="product_detail.php?id=<?= $product['id']; ?>">
                                <div class="main-images">
                                    <?php 
                                        $firstColor = key($product['images']);
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
                                        <span class="circle <?= $color === $firstColor ? $color . ' active' : $color; ?>" id="<?= $color; ?>" style="background-color: <?= $color === 'blue' ? '#0071C7' : ($color === 'pink' ? '#FF76CE' : ($color === 'white' ? '#EEEEEE' : ($color === 'yellow' ? '#F5DA00' : $color))); ?>;"></span>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="price">
                                    <span class="price_num"><?= $product['price']; ?></span>
                                    <span class="price_letter">JUST <?= $product['price']; ?>$</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </div>
    <script src="script.js"></script>
    <script>
        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem, index) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = index + 1; // Update imgId based on the index of the clicked image
                slideImage();

                // Get the color value and image path of the clicked image
                const color = imgItem.getAttribute('data-color');
                const imagePath = imgItem.getAttribute('data-image-path');
                
                // Update the hidden input values with the new color and image path
                document.querySelector('input[name="color"]').value = color;
                document.querySelector('input[name="image_path"]').value = imagePath;
            });
        });

        // Trong hàm slideImage():
        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;
            const selectedImage = imgBtns[imgId - 1]; // Chọn hình ảnh mới

            // Cập nhật giá trị của các trường ẩn với thông tin của hình ảnh mới
            document.querySelector('input[name="color"]').value = selectedImage.getAttribute('data-color');
            document.querySelector('input[name="image_path"]').value = selectedImage.getAttribute('data-image-path');

            // Di chuyển hiển thị hình ảnh
            document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
        }
        window.addEventListener('resize', slideImage);
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

<?php include "footer.php"; ?>
</body>
</html>
