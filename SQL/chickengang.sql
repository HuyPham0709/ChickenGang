-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 13, 2024 lúc 05:38 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `chickengang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id_Cart` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `color` varchar(250) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `Quantity` int(100) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `total_money` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id_Cart`, `user_id`, `color`, `product_name`, `Quantity`, `price`, `order_date`, `status`, `total_money`) VALUES
(61, 1, 'blue', 'Short Sleeve Polo Shirt', 1, 0.99, '2024-06-12 16:36:28', 0, 0.99),
(62, 1, 'blue', 'T-Shirt', 1, 1.99, '2024-06-12 16:37:18', 0, 1.99);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id_User` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone_number` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id_User`, `username`, `email`, `phone_number`, `address`, `password`, `login_id`) VALUES
(1, 'huy', 'n23dvcn025@student.ptithcm.edu.vn', '0971435594', '123 hjhj', '123', 1),
(3, 'test', NULL, NULL, NULL, '123', 5),
(10, 'hiu', NULL, NULL, NULL, '123', 12),
(11, 'adminhuy', NULL, NULL, NULL, '123', 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_information`
--

CREATE TABLE `customer_information` (
  `id_CtInformation` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `card_number` varchar(100) NOT NULL,
  `expire_date` varchar(20) NOT NULL,
  `cvv` varchar(20) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer_information`
--

INSERT INTO `customer_information` (`id_CtInformation`, `user_id`, `username`, `email`, `card_number`, `expire_date`, `cvv`, `phone_number`, `address`) VALUES
(23, NULL, 'huy', 'tatsumin123456@gmail.com', '123', '12/12', '123', '', '45/5/3 đường 10'),
(24, NULL, 'huy1', 'tatsumin123456@gmail.com', '123', '12/12', '321', '', '45/5/3 đường 10'),
(25, NULL, 'vantran', 'van@gmail.com', '11111', '11111111', '1', '', '1111');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback1`
--

CREATE TABLE `feedback1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `feedback1`
--

INSERT INTO `feedback1` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'huy', 'n23dvcn025@student.ptithcm.edu.vn', 'shop quá là ok', '2024-06-06 06:45:42'),
(2, 'hiu', 'tatsumin123456@gmail.com', 'cũng được', '2024-06-06 06:48:13'),
(3, 'hiu', 'tatsumin123456@gmail.com', 'cũng được', '2024-06-06 06:48:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login`
--

CREATE TABLE `login` (
  `id_Login` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login`
--

INSERT INTO `login` (`id_Login`, `username`, `password`, `role`) VALUES
(1, 'huy', '123', 'user'),
(13, 'adminhuy', '123', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `management_product`
--

CREATE TABLE `management_product` (
  `id_MProduct` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `management_user`
--

CREATE TABLE `management_user` (
  `id_MUser` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id_Product` int(11) NOT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `description_detail` varchar(200) NOT NULL,
  `category` varchar(20) NOT NULL,
  `collection` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id_Product`, `product_name`, `description`, `description_detail`, `category`, `collection`, `quantity`, `price`, `created_at`, `update_at`) VALUES
(1, 'Short Sleeve Polo Shirt', '100% coton', 'POLO can give you a very dynamic look with an oversize shirt form combined with stylish pants, striking or simple colors that all express the uniqueness of the polo shirt. Moreover, it is extremely co', 'Polo', 'LAZY THINK COLLECTION', 0, 0.99, NULL, NULL),
(2, 'T-Shirt', '99% coton', '', '', '', 0, 1.99, NULL, NULL),
(3, 'Shirt', '99% coton', '', '', '', 0, 0.88, NULL, NULL),
(4, 'HOODED WB JACKET', 'ONTOP', '', '', '', 0, 3.99, NULL, NULL),
(5, 'Levents® College Global Tee White', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 39.00, NULL, NULL),
(6, 'Levents® Best Thing Tee', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 3.70, NULL, NULL),
(7, 'Levents® Flowers Window Sweater Cream', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 59.00, NULL, NULL),
(8, 'Levents® XL Logo Striped Shirt', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 3.00, NULL, NULL),
(9, 'Levents® Stripe Polo', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 400.00, NULL, NULL),
(10, 'Levents® Stars Spray Boxy 2.0 Tee', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 190.00, NULL, NULL),
(11, 'Levents® Wellness Tee White', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 120.00, NULL, NULL),
(12, 'Levents® Blank Boxy 2.0 Tee', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 230.00, NULL, NULL),
(13, 'Levents® College Raglan Boxy Tee White', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 390.00, NULL, NULL),
(14, 'Levents® Flowers Window Tee Cream', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 190.00, NULL, NULL),
(15, 'Levents® Horizontal Stripes Shirt', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 230.00, NULL, NULL),
(16, 'Levents® Sticker Long Sleeve Tee', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 190.00, NULL, NULL),
(17, 'Levents® Classic Wrinkle Nylon Cargo ShortPantsa', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 290.00, NULL, NULL),
(18, 'Levents® Best Thing Hoodie Grey', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 610.00, NULL, NULL),
(19, 'Levents® Cargo ShortPants Dark Green', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 390.00, NULL, NULL),
(20, 'Levents® Classic 2Tone Wrinkle Nylon Hood Jacket Red', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 390.00, NULL, NULL),
(21, 'Levents® Ribbon Rabit Sweater Black', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 390.00, NULL, NULL),
(22, 'Levents® Classic Straight Loose Trouser', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 390.00, NULL, NULL),
(23, 'Levents® Classic Wash Straight Jeans', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 120.00, NULL, NULL),
(24, 'Levents® Classic Knit Oversized Gile', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 290.00, NULL, NULL),
(25, 'Levents® Classic Baggy Girl Jeans Blue', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 190.00, NULL, NULL),
(26, 'Levents® 23 Jersey', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 390.00, NULL, NULL),
(27, 'Levents® Casual Shoulder Bag Black', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 420.00, NULL, NULL),
(28, 'Levents® Champion Snapback Cap Cream', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 250.00, NULL, NULL),
(29, 'Levents® College Cap Red', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Levent', '1', 1, 250.00, NULL, NULL),
(30, 'MEN JOGGER IN BLACK', 'softest materials, our new set features pockets, a relaxed', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 331.00, NULL, NULL),
(31, 'MEN JOGGER IN CLASSIC GREY', 'features side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 180.00, NULL, NULL),
(32, 'MEN JOGGER IN NAVY WASH', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 180.00, NULL, NULL),
(33, 'MEN SWEATSUIT SET IN BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 331.00, NULL, NULL),
(34, 'MEN SWEATSUIT SET IN CLASSIC GREY', 'softest materials, our new set features pockets, a relaxed', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 331.00, NULL, NULL),
(35, 'MEN SWEATSUIT SET IN NAVY WASH', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 208.00, NULL, NULL),
(36, 'MEN SWEATSUIT SET IN WHITE CAMO', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 165.00, NULL, NULL),
(37, 'MEN SWEATSUIT SET IN WINTER WHITE CAMO', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 165.00, NULL, NULL),
(38, 'MEN SWEATSUIT SET IN BONE', 'This crazy-soft hoodie is perfect for lounging, living and snacking in.', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 331.00, NULL, NULL),
(39, 'MEN PREMIUM FLEECE RELAXED SWEATPANTS IN CAMEL', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 140.00, NULL, NULL),
(40, 'MEN PACKABLE PUFFER JACKET IN WHITE CAMO', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 350.00, NULL, NULL),
(41, 'LIGHTWEIGHT COTTON GAUZE STRAIGHT LEG PANTS IN BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 180.00, NULL, NULL),
(42, 'LIGHTWEIGHT COTTON GAUZE SHORTS IN BONE', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 165.00, NULL, NULL),
(43, 'LIGHTWEIGHT COTTON GAUZE BUTTON DOWN SHIRT IN BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 180.00, NULL, NULL),
(44, 'AMBER TEDDY SHERPA SHACKET IN BISCUIT', 'This fuzzy number includes a hidden polar fleece interior, keeping you warm for colder temperatures', '100% Polyester', 'Lazy', '1', 1, 236.00, NULL, NULL),
(45, 'SARA TEDDY SHERPA ZIP UP JACKET IN BONE', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 199.00, NULL, NULL),
(46, 'WOMEN CHLO DOUBLE-FACE VELOUR HOODIE IN BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 190.00, NULL, NULL),
(47, 'ARIE AND JUSTINE SET IN SILVER GREEN', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 190.00, NULL, NULL),
(48, 'SHACKET IN BONE', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 160.00, NULL, NULL),
(49, 'NOVA PREMIUM FLEECE RELAXED SWEATPANTS IN BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 250.00, NULL, NULL),
(50, 'NOVA PREMIUM FLEECE RELAXED SWEATPANTS IN CLASSIC GREY', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 180.00, NULL, NULL),
(51, 'COOPER EXCLUSIVE ULTRA-SOFT BOYFRIEND HOODIE IN VINTAGE MINT', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 109.00, NULL, NULL),
(52, 'NIKI + COOPER EXCLUSIVE ULTRA-SOFT SWEATSUIT SET IN VINTAGE BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 199.00, NULL, NULL),
(53, 'WOMEN TRACKSUIT IN BANANA YELLOW', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 190.00, NULL, NULL),
(54, 'CHLO RELAXED FIT HOODIE IN VINTAGE BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Lazy', '1', 1, 180.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_image`
--

CREATE TABLE `product_image` (
  `id_PdImg` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_image`
--

INSERT INTO `product_image` (`id_PdImg`, `product_id`, `image_path`, `color`) VALUES
(NULL, 1, '1_blue.png', 'blue'),
(NULL, 1, '1_pink.png', 'pink'),
(NULL, 1, '1_yellow.png', 'yellow'),
(NULL, 2, '2_blue.png', 'blue'),
(NULL, 2, '2_pink.png', 'pink'),
(NULL, 2, '2_yellow.png', 'yellow'),
(NULL, 3, '3_white.png', 'white'),
(NULL, 3, '3_black.png', 'black'),
(NULL, 4, '4_yellow.png', 'yellow'),
(NULL, 4, '4_black.png', 'black'),
(NULL, 4, '4_green.png', 'green'),
(NULL, 4, '4_pink.png', 'pink'),
(NULL, 5, 'White_LTSGICOA359UW0101SS24_1.png', 'white'),
(NULL, 6, 'White_LTSOVCOA449UW0100SS24_1.png', 'white'),
(NULL, 7, 'Cream_LSWOVCOK450UC0102SS24_1.png', 'cream'),
(NULL, 8, 'Pink_LSHOVCOB253UP0101SS24_1.png', 'pink'),
(NULL, 9, 'Cream_LPOOVCOC229UC0101SS24_1.png', 'cream'),
(NULL, 10, 'Black_LTSBXCOA265UD0101SS24_1.png', 'black'),
(NULL, 11, 'White_LTSBXCOA451UW0101SS24_1.png', 'white'),
(NULL, 12, 'LightBrown_LTSBXCLA154UN0201SS24_1.png', 'light brown'),
(NULL, 13, 'White_LTSBOCOA314UW0100SS24_1.png', 'white'),
(NULL, 14, 'Cream_LTSOVCOA427UC0100SS24_1.png', 'cream'),
(NULL, 15, 'Green_LSHOVCOB330UG0101SS24_1.png', 'green'),
(NULL, 16, 'Pink_LTSOVCOA434UP0101SS24_1.png', 'pink'),
(NULL, 17, 'Cream_LSPSPCLO152UC0101FW23_1.png', 'cream'),
(NULL, 18, 'Grey_LHOOVCOD305UX0102SS24_1.png', 'grey'),
(NULL, 19, 'DarkGreen_LSPSPCOO231UG0201SS24_1.png', 'dark green'),
(NULL, 20, 'Red_LHJOVCLD760UR0102FW23_1.png', 'red'),
(NULL, 21, 'Black_LSWOVCOK426UD0102SS24_1.png', 'black'),
(NULL, 22, 'Cream_LPATLCLN157UC0101FW23_1.png', 'cream'),
(NULL, 23, 'Black_LJESTCLP115UD0102FW23_1.png', 'black'),
(NULL, 24, 'Black_LGIOVCLH154UD0102FW23_1.png', 'black'),
(NULL, 25, 'Blue_LJEBGCLP156WB0102FW23_1.png', 'blue'),
(NULL, 26, 'Black_LPOOVCOC317UD0101SS2_1.png', 'black'),
(NULL, 27, 'BLACK_LHLSDCOJ243UD01NOSS24_1.png', 'black'),
(NULL, 28, 'Cream_LCPSNACU446UC01NOSS24_1.png', 'cream'),
(NULL, 29, 'Red_LCPSPACU345UR01NOSS24_1.png', 'red'),
(NULL, 30, 'SJAB1963.png', 'black'),
(NULL, 31, 'SJAB1857.png', 'grey'),
(NULL, 32, 'unnamed3.png', 'grey'),
(NULL, 33, 'SJAB2028.png', 'black'),
(NULL, 34, 'SJAB1867.png', 'grey'),
(NULL, 35, 'SJAB2122_0b597590-1755-4a44-b014-90277dccca4e.png', 'black'),
(NULL, 36, 'SJAB2265 (3).png', 'white'),
(NULL, 37, '422A9980 (1).png', 'white'),
(NULL, 38, 'SJAB0956.png', 'bone'),
(NULL, 39, 'LazyP0108-2.png', 'camel'),
(NULL, 40, 'SJAB1196_2f77dce3-86f2-445c-b135-4ceb38908c29.png', 'grey'),
(NULL, 41, 'Photoshoot_Dec152023_001-1049.png', 'black'),
(NULL, 42, 'Photoshoot_Dec152023_001-937.png', 'bone'),
(NULL, 43, 'Photoshoot_Dec152023_001-430.png', 'black'),
(NULL, 44, 'SJAB7486.png', 'biscuit'),
(NULL, 45, 'SJAB6771.png', 'bone'),
(NULL, 46, 'SJAB7424.png', 'black'),
(NULL, 47, 'Justine_Arie_SilverGreen_2.png', 'silver green'),
(NULL, 48, 'BONE-Edited-SA0005-P-S1-1122.png', 'bone'),
(NULL, 49, 'Black_Pants_CostcoF24_SqubaMarch2024_001-2048.png', 'black'),
(NULL, 50, 'img_23355.png', 'grey'),
(NULL, 51, 'L22263LZVM_VintageMint_1_0206.png', 'light green'),
(NULL, 52, 'L6_2263916LZV_VintageBlack_1_0083.png', 'black'),
(NULL, 53, 'BannaYellow_6_cc4a0438-cc53-44ea-9ca2-c88c9e480e8c.png', 'yellow'),
(NULL, 54, 'SJAB8871.png', 'black'),
(NULL, 9, 'DarkBlue_LPOOVCOC229UB0501SS24_1.png', 'dark blue'),
(NULL, 12, 'White_LTSBXCOA265UW0101SS24_1.png', 'white'),
(NULL, 6, 'Blue_LTSOVCOA449UB0100SS24_1.png', 'blue'),
(NULL, 6, 'Black_LTSOVCOA449UD0100SS24_1.png', 'black'),
(NULL, 12, 'Black_LTSBXCLA154UD0101SS24_1.png', 'black'),
(NULL, 15, 'Yellow_LSHOVCOB330UY0101SS24_1.png', 'yellow'),
(NULL, 15, 'Grey__65.png', 'grey'),
(NULL, 16, 'Yellow_LTSOVCOA434UY0101SS24_1.png', 'yellow');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_behavior`
--

CREATE TABLE `user_behavior` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_behavior`
--

INSERT INTO `user_behavior` (`id`, `user_id`, `product_id`, `action`, `created_at`) VALUES
(7, 1, 3, 'view', '2024-06-12 15:58:59'),
(10, 1, 3, 'view', '2024-06-12 16:01:15'),
(11, 1, 3, 'view', '2024-06-12 16:01:16'),
(12, 1, 3, 'view', '2024-06-12 16:01:21'),
(13, 1, 3, 'view', '2024-06-12 16:01:28'),
(14, 1, 3, 'view', '2024-06-12 16:01:31'),
(15, 1, 4, 'view', '2024-06-12 16:01:32'),
(16, 1, 4, 'view', '2024-06-12 16:02:06'),
(17, 1, 4, 'view', '2024-06-12 16:02:23'),
(18, 1, 4, 'view', '2024-06-12 16:02:57'),
(19, 1, 4, 'view', '2024-06-12 16:03:25'),
(20, 1, 2, 'view', '2024-06-12 16:03:52'),
(21, 1, 2, 'view', '2024-06-12 16:04:10'),
(22, 1, 2, 'view', '2024-06-12 16:04:16'),
(23, 1, 2, 'view', '2024-06-12 16:04:31'),
(24, 1, 2, 'view', '2024-06-12 16:05:00'),
(25, 1, 2, 'view', '2024-06-12 16:08:24'),
(26, 1, 2, 'view', '2024-06-12 16:09:47'),
(27, 1, 2, 'view', '2024-06-12 16:09:56'),
(28, 1, 2, 'view', '2024-06-12 16:09:58'),
(29, 1, 2, 'view', '2024-06-12 16:10:36'),
(30, 1, 2, 'view', '2024-06-12 16:10:40'),
(31, 1, 2, 'view', '2024-06-12 16:11:43'),
(32, 1, 2, 'view', '2024-06-12 16:11:53'),
(33, 1, 2, 'view', '2024-06-12 16:11:59'),
(34, 1, 2, 'view', '2024-06-12 16:12:02'),
(35, 1, 2, 'view', '2024-06-12 16:12:17'),
(36, 1, 2, 'view', '2024-06-12 16:12:20'),
(37, 1, 2, 'view', '2024-06-12 16:12:39'),
(38, 1, 2, 'view', '2024-06-12 16:13:10'),
(39, 1, 2, 'view', '2024-06-12 16:13:27'),
(40, 1, 2, 'view', '2024-06-12 16:13:38'),
(41, 1, 2, 'view', '2024-06-12 16:13:47'),
(42, 1, 2, 'view', '2024-06-12 16:14:00'),
(43, 1, 2, 'view', '2024-06-12 16:14:35'),
(44, 1, 2, 'view', '2024-06-12 16:16:15'),
(45, 1, 2, 'view', '2024-06-12 16:16:38'),
(46, 1, 2, 'view', '2024-06-12 16:16:54'),
(47, 1, 2, 'view', '2024-06-12 16:17:21'),
(48, 1, 2, 'view', '2024-06-12 16:17:49'),
(49, 1, 2, 'view', '2024-06-12 16:18:28'),
(50, 1, 2, 'view', '2024-06-12 16:18:42'),
(51, 1, 3, 'view', '2024-06-12 16:18:47'),
(52, 1, 1, 'view', '2024-06-12 16:18:48'),
(53, 1, 1, 'view', '2024-06-12 16:19:38'),
(54, 1, 1, 'view', '2024-06-12 16:19:46'),
(55, 1, 2, 'view', '2024-06-12 16:19:53'),
(56, 1, 3, 'view', '2024-06-12 16:19:56'),
(57, 1, 3, 'view', '2024-06-12 16:21:00'),
(58, 1, 3, 'view', '2024-06-12 16:21:08'),
(59, 1, 3, 'view', '2024-06-12 16:21:21'),
(60, 1, 3, 'view', '2024-06-12 16:21:34'),
(61, 1, 3, 'view', '2024-06-12 16:21:45'),
(62, 1, 3, 'view', '2024-06-12 16:22:00'),
(63, 1, 3, 'view', '2024-06-12 16:22:11'),
(64, 1, 3, 'view', '2024-06-12 16:22:35'),
(65, 1, 3, 'view', '2024-06-12 16:22:47'),
(66, 1, 3, 'view', '2024-06-12 16:23:06'),
(67, 1, 3, 'view', '2024-06-12 16:23:31'),
(68, 1, 3, 'view', '2024-06-12 16:23:35'),
(69, 1, 3, 'view', '2024-06-12 16:23:44'),
(70, 1, 3, 'view', '2024-06-12 16:24:47'),
(71, 1, 3, 'view', '2024-06-12 16:25:30'),
(72, 1, 3, 'view', '2024-06-12 16:25:47'),
(73, 1, 3, 'view', '2024-06-12 16:26:04'),
(74, 1, 3, 'view', '2024-06-12 16:26:15'),
(75, 1, 3, 'view', '2024-06-12 16:26:27'),
(76, 1, 1, 'view', '2024-06-12 16:27:16'),
(77, 1, 3, 'view', '2024-06-12 16:27:25'),
(78, 1, 4, 'view', '2024-06-12 16:27:28'),
(79, 1, 4, 'view', '2024-06-12 16:27:52'),
(80, 1, 4, 'view', '2024-06-12 16:28:21'),
(81, 1, 4, 'view', '2024-06-12 16:28:27'),
(82, 1, 4, 'view', '2024-06-12 16:31:22'),
(83, 1, 4, 'view', '2024-06-12 16:32:06'),
(84, 1, 3, 'view', '2024-06-12 16:35:52'),
(85, 1, 2, 'view', '2024-06-12 16:36:09'),
(86, 1, 2, 'view', '2024-06-12 16:36:55'),
(87, 1, 2, 'view', '2024-06-12 16:39:23'),
(88, 1, 2, 'view', '2024-06-12 16:39:29'),
(89, 1, 2, 'view', '2024-06-12 16:39:46'),
(90, 1, 2, 'view', '2024-06-12 16:40:29'),
(91, 1, 2, 'view', '2024-06-12 16:40:30'),
(92, 1, 2, 'view', '2024-06-12 16:40:50'),
(93, 1, 2, 'view', '2024-06-12 16:41:22'),
(94, 1, 2, 'view', '2024-06-12 16:41:26'),
(95, 1, 2, 'view', '2024-06-12 16:41:32'),
(96, 1, 2, 'view', '2024-06-12 16:41:55'),
(97, 1, 2, 'view', '2024-06-12 16:42:03'),
(98, 1, 2, 'view', '2024-06-12 16:44:24'),
(99, 1, 2, 'view', '2024-06-12 16:44:28'),
(100, 1, 2, 'view', '2024-06-12 16:44:32'),
(101, 1, 2, 'view', '2024-06-12 16:44:36'),
(102, 1, 2, 'view', '2024-06-12 16:48:05'),
(103, 1, 2, 'view', '2024-06-13 01:46:01'),
(104, 1, 1, 'view', '2024-06-13 01:46:06'),
(105, 1, 2, 'view', '2024-06-13 01:47:25'),
(106, 1, 2, 'view', '2024-06-13 01:48:32'),
(107, 1, 1, 'view', '2024-06-13 01:48:40'),
(108, 1, 1, 'view', '2024-06-13 01:49:48'),
(109, 1, 1, 'view', '2024-06-13 01:49:56'),
(110, 1, 1, 'view', '2024-06-13 01:51:02'),
(111, 1, 5, 'view', '2024-06-13 01:59:17'),
(112, 1, 5, 'view', '2024-06-13 02:00:09'),
(113, 1, 1, 'view', '2024-06-13 02:04:26'),
(114, 1, 28, 'view', '2024-06-13 02:05:56'),
(115, 1, 2, 'view', '2024-06-13 02:06:21'),
(116, 1, 1, 'view', '2024-06-13 02:06:24'),
(117, 1, 3, 'view', '2024-06-13 02:06:26'),
(118, 1, 2, 'view', '2024-06-13 02:06:27'),
(119, 1, 4, 'view', '2024-06-13 02:06:28'),
(120, 1, 5, 'view', '2024-06-13 02:06:32'),
(121, 1, 8, 'view', '2024-06-13 02:06:35'),
(122, 1, 6, 'view', '2024-06-13 02:06:42'),
(123, 1, 5, 'view', '2024-06-13 02:07:03'),
(124, 1, 8, 'view', '2024-06-13 02:07:25'),
(125, 1, 8, 'view', '2024-06-13 02:07:27'),
(126, 1, 8, 'view', '2024-06-13 02:30:00'),
(127, 1, 15, 'view', '2024-06-13 02:52:32'),
(128, 1, 15, 'view', '2024-06-13 02:56:54'),
(129, 1, 47, 'view', '2024-06-13 02:58:07'),
(130, 1, 46, 'view', '2024-06-13 02:58:21'),
(131, 1, 15, 'view', '2024-06-13 02:58:28'),
(132, 1, 12, 'view', '2024-06-13 02:58:42'),
(133, 1, 10, 'view', '2024-06-13 02:58:46'),
(134, 1, 2, 'view', '2024-06-13 02:59:07'),
(135, 1, 3, 'view', '2024-06-13 02:59:13'),
(136, 1, 7, 'view', '2024-06-13 02:59:16'),
(137, 1, 1, 'view', '2024-06-13 03:07:38'),
(138, 1, 1, 'view', '2024-06-13 03:09:14'),
(139, 1, 2, 'view', '2024-06-13 03:10:21');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_Cart`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_User`),
  ADD KEY `login_id` (`login_id`);

--
-- Chỉ mục cho bảng `customer_information`
--
ALTER TABLE `customer_information`
  ADD PRIMARY KEY (`id_CtInformation`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `feedback1`
--
ALTER TABLE `feedback1`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_Login`);

--
-- Chỉ mục cho bảng `management_product`
--
ALTER TABLE `management_product`
  ADD PRIMARY KEY (`id_MProduct`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `management_user`
--
ALTER TABLE `management_user`
  ADD PRIMARY KEY (`id_MUser`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_Product`);

--
-- Chỉ mục cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `user_behavior`
--
ALTER TABLE `user_behavior`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id_Cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `customer_information`
--
ALTER TABLE `customer_information`
  MODIFY `id_CtInformation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `feedback1`
--
ALTER TABLE `feedback1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `login`
--
ALTER TABLE `login`
  MODIFY `id_Login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `management_product`
--
ALTER TABLE `management_product`
  MODIFY `id_MProduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `management_user`
--
ALTER TABLE `management_user`
  MODIFY `id_MUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `user_behavior`
--
ALTER TABLE `user_behavior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id_User`);

--
-- Các ràng buộc cho bảng `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id_Login`);

--
-- Các ràng buộc cho bảng `customer_information`
--
ALTER TABLE `customer_information`
  ADD CONSTRAINT `customer_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id_User`);

--
-- Các ràng buộc cho bảng `management_product`
--
ALTER TABLE `management_product`
  ADD CONSTRAINT `management_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_Product`),
  ADD CONSTRAINT `management_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_Product`),
  ADD CONSTRAINT `management_product_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_Product`);

--
-- Các ràng buộc cho bảng `management_user`
--
ALTER TABLE `management_user`
  ADD CONSTRAINT `management_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id_User`);

--
-- Các ràng buộc cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_Product`);

--
-- Các ràng buộc cho bảng `user_behavior`
--
ALTER TABLE `user_behavior`
  ADD CONSTRAINT `user_behavior_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id_User`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_behavior_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_Product`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
