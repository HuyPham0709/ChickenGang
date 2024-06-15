-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 13, 2024 lúc 09:53 AM
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
(13, 'admin', '123', 'admin');

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

CREATE TABLE `revenue` (
  `id` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `revenue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cart` (`id_cart`);


ALTER TABLE `revenue`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id_Product`, `product_name`, `description`, `description_detail`, `category`, `collection`, `quantity`, `price`, `created_at`, `update_at`) VALUES
(1, 'Short Sleeve Polo Shirt', '100% coton', 'POLO can give you a very dynamic look with an oversize shirt form combined with stylish pants, striking or simple colors that all express the uniqueness of the polo shirt. Moreover, it is extremely co', 'Polo', 'LAZY THINK COLLECTION', 0, 0.99, NULL, NULL),
(2, 'T-Shirt', '99% coton', '', '', '', 0, 1.99, NULL, NULL),
(3, 'Shirt', '99% coton', '', '', '', 0, 0.88, NULL, NULL),
(4, 'HOODED WB JACKET', 'ONTOP', '', '', '', 0, 3.99, NULL, NULL),
(55, 'Levents® College Global Tee White', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 390.00, NULL, NULL),
(56, 'Levents® Best Thing Tee', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 370.00, NULL, NULL),
(57, 'Levents® Flowers Window Sweater Cream', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 590.00, NULL, NULL),
(58, 'Levents® XL Logo Striped Shirt', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 390.00, NULL, NULL),
(59, 'Levents® Stripe Polo', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 400.00, NULL, NULL),
(60, 'Levents® Stars Spray Boxy 2.0 Tee', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 190.00, NULL, NULL),
(61, 'Levents® Wellness Tee White', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 120.00, NULL, NULL),
(62, 'Levents® Blank Boxy 2.0 Tee', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 230.00, NULL, NULL),
(63, 'Levents® College Raglan Boxy Tee White', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 390.00, NULL, NULL),
(64, 'Levents® Flowers Window Tee Cream', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 190.00, NULL, NULL),
(65, 'Levents® Horizontal Stripes Shirt', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 230.00, NULL, NULL),
(66, 'Levents® Sticker Long Sleeve Tee', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 190.00, NULL, NULL),
(67, 'Levents® Classic Wrinkle Nylon Cargo ShortPantsa', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 290.00, NULL, NULL),
(68, 'Levents® Best Thing Hoodie Grey', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 610.00, NULL, NULL),
(69, 'Levents® Cargo ShortPants Dark Green', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 390.00, NULL, NULL),
(70, 'Levents® Classic 2Tone Wrinkle Nylon Hood Jacket Red', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 390.00, NULL, NULL),
(71, 'Levents® Ribbon Rabit Sweater Black', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 390.00, NULL, NULL),
(72, 'Levents® Classic Straight Loose Trouser', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 390.00, NULL, NULL),
(73, 'Levents® Classic Wash Straight Jeans', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 120.00, NULL, NULL),
(74, 'Levents® Classic Knit Oversized Gile', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 290.00, NULL, NULL),
(75, 'Levents® Classic Baggy Girl Jeans Blue', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 190.00, NULL, NULL),
(76, 'Levents® 23 Jersey', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Levent', 1, 390.00, NULL, NULL),
(77, 'Levents® Casual Shoulder Bag Black', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'item', 'Levent', 1, 420.00, NULL, NULL),
(78, 'Levents® Champion Snapback Cap Cream', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'ITEM', 'Levent', 1, 250.00, NULL, NULL),
(79, 'Levents® College Cap Red', 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'ITEM', 'Levent', 1, 250.00, NULL, NULL),
(80, 'MEN JOGGER IN BLACK', 'softest materials, our new set features pockets, a relaxed', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 331.00, NULL, NULL),
(81, 'MEN JOGGER IN CLASSIC GREY', 'features side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 180.00, NULL, NULL),
(82, 'MEN JOGGER IN NAVY WASH', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 180.00, NULL, NULL),
(83, 'MEN SWEATSUIT SET IN BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 331.00, NULL, NULL),
(84, 'MEN SWEATSUIT SET IN CLASSIC GREY', 'softest materials, our new set features pockets, a relaxed', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 331.00, NULL, NULL),
(85, 'MEN SWEATSUIT SET IN NAVY WASH', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 208.00, NULL, NULL),
(86, 'MEN SWEATSUIT SET IN WHITE CAMO', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 165.00, NULL, NULL),
(87, 'MEN SWEATSUIT SET IN WINTER WHITE CAMO', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 165.00, NULL, NULL),
(88, 'MEN SWEATSUIT SET IN BONE', 'This crazy-soft hoodie is perfect for lounging, living and snacking in.', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 331.00, NULL, NULL),
(89, 'MEN PREMIUM FLEECE RELAXED SWEATPANTS IN CAMEL', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 140.00, NULL, NULL),
(90, 'MEN PACKABLE PUFFER JACKET IN WHITE CAMO', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 350.00, NULL, NULL),
(91, 'LIGHTWEIGHT COTTON GAUZE STRAIGHT LEG PANTS IN BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 180.00, NULL, NULL),
(92, 'LIGHTWEIGHT COTTON GAUZE SHORTS IN BONE', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 165.00, NULL, NULL),
(93, 'LIGHTWEIGHT COTTON GAUZE BUTTON DOWN SHIRT INBLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 180.00, NULL, NULL),
(94, 'AMBER TEDDY SHERPA SHACKET IN BISCUIT', 'This fuzzy number includes a hidden polar fleece interior, keeping you warm for colder temperatures', '100% Polyester', 'SHIRT', 'Lazy', 1, 236.00, NULL, NULL),
(95, 'SARA TEDDY SHERPA ZIP UP JACKET IN BONE', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 199.00, NULL, NULL),
(96, 'WOMEN CHLO DOUBLE-FACE VELOUR HOODIE IN BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 190.00, NULL, NULL),
(97, 'ARIE AND JUSTINE SET IN SILVER GREEN', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 190.00, NULL, NULL),
(98, 'SHACKET IN BONE', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 160.00, NULL, NULL),
(99, 'NOVA PREMIUM FLEECE RELAXED SWEATPANTS IN BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 250.00, NULL, NULL),
(100, 'NOVA PREMIUM FLEECE RELAXED SWEATPANTS IN CLASSIC GREY', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 180.00, NULL, NULL),
(101, 'COOPER EXCLUSIVE ULTRA-SOFT BOYFRIEND HOODIE IN VINTAGE MINT', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 109.00, NULL, NULL),
(102, 'NIKI + COOPER EXCLUSIVE ULTRA-SOFT SWEATSUIT SET IN VINTAGE BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 199.00, NULL, NULL),
(103, 'WOMEN TRACKSUIT IN BANANA YELLOW', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 190.00, NULL, NULL),
(104, 'CHLO RELAXED FIT HOODIE IN VINTAGE BLACK', 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'SHIRT', 'Lazy', 1, 180.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_image`
--

CREATE TABLE `product_image` (
  `id_PdImg` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_image`
--

INSERT INTO `product_image` (`id_PdImg`, `product_id`, `image_path`, `color`) VALUES
(1, 1, '1_blue.png', 'blue'),
(2, 1, '1_pink.png', 'pink'),
(3, 1, '1_yellow.png', 'yellow'),
(4, 2, '2_blue.png', 'blue'),
(5, 2, '2_pink.png', 'pink'),
(6, 2, '2_yellow.png', 'yellow'),
(7, 3, '3_white.png', 'white'),
(8, 3, '3_black.png', 'black'),
(9, 4, '4_yellow.png', 'yellow'),
(10, 4, '4_black.png', 'black'),
(11, 4, '4_green.png', 'green'),
(12, 4, '4_pink.png', 'pink'),
(71, 55, 'White_LTSGICOA359UW0101SS24_1.png', 'white'),
(72, 56, 'White_LTSOVCOA449UW0100SS24_1.png', 'white'),
(73, 57, 'Cream_LSWOVCOK450UC0102SS24_1.png', 'bisque'),
(74, 58, 'Pink_LSHOVCOB253UP0101SS24_1.png', 'pink'),
(75, 59, 'Cream_LPOOVCOC229UC0101SS24_1.png', 'bisque'),
(76, 60, 'Black_LTSBXCOA265UD0101SS24_1.png', 'black'),
(77, 61, 'White_LTSBXCOA451UW0101SS24_1.png', 'white'),
(78, 62, 'LightBrown_LTSBXCLA154UN0201SS24_1.png', 'light brown'),
(79, 63, 'White_LTSBOCOA314UW0100SS24_1.png', 'white'),
(80, 64, 'Cream_LTSOVCOA427UC0100SS24_1.png', 'bisque'),
(81, 65, 'Green_LSHOVCOB330UG0101SS24_1.png', 'green'),
(82, 66, 'Pink_LTSOVCOA434UP0101SS24_1..png', 'pink'),
(83, 67, 'Cream_LSPSPCLO152UC0101FW23_1.png', 'bisque'),
(84, 68, 'Grey_LHOOVCOD305UX0102SS24_1.png', 'grey'),
(85, 69, 'DarkGreen_LSPSPCOO231UG0201SS24_1.png', 'dark green'),
(86, 70, 'Red_LHJOVCLD760UR0102FW23_1.png', 'red'),
(87, 71, 'Black_LSWOVCOK426UD0102SS24_1.png', 'black'),
(88, 72, 'Cream_LPATLCLN157UC0101FW23_1.png', 'bisque'),
(89, 73, 'Black_LJESTCLP115UD0102FW23_1.png', 'black'),
(90, 74, 'Black_LGIOVCLH154UD0102FW23_1.png', 'black'),
(91, 75, 'Blue_LJEBGCLP156WB0102FW23_1.png', 'blue'),
(92, 76, 'Black_LPOOVCOC317UD0101SS2_1.png', 'black'),
(93, 77, 'BLACK_LHLSDCOJ243UD01NOSS24_1.png', 'black'),
(94, 78, 'Cream_LCPSNACU446UC01NOSS24_1.png', 'bisque'),
(95, 79, 'Red_LCPSPACU345UR01NOSS24_1.png', 'red'),
(96, 80, 'SJAB1963.png', 'black'),
(97, 81, 'SJAB1857 .png', 'grey'),
(98, 82, 'unnamed3.png', 'grey'),
(99, 83, 'SJAB2028.png', 'black'),
(100, 84, 'SJAB1867.png', 'grey'),
(101, 85, 'SJAB2122_0b597590-1755-4a44-b014-90277dccca4e.png', 'black'),
(102, 86, 'SJAB2265 (3).png', 'white'),
(103, 87, '422A9980 (1).png', 'white'),
(104, 88, 'SJAB0956.png', 'bisque'),
(105, 89, 'LazyP0108-2.png', 'coral'),
(106, 90, 'SJAB1196_2f77dce3-86f2-445c-b135-4ceb38908c29.png', 'grey'),
(107, 91, 'Photoshoot_Dec152023_001-1049.png', 'black'),
(108, 92, 'Photoshoot_Dec152023_001-937.png', 'bisque'),
(109, 93, 'Photoshoot_Dec152023_001-430.png', 'black'),
(110, 94, 'SJAB7486.png', 'coral'),
(111, 95, 'SJAB6771.png', 'bisque'),
(112, 96, 'SJAB7424.png', 'black'),
(113, 97, 'Justine_Arie_SilverGreen_2.png', 'siver green'),
(114, 98, 'BONE-Edited-SA0005-P-S1-1122.png', 'bisque'),
(115, 99, 'Black_Pants_CostcoF24_SqubaMarch2024_001-2048.png', 'black'),
(116, 100, 'img_23355.png', 'grey'),
(117, 101, 'L22263LZVM_VintageMint_1_0206.png', 'light green'),
(118, 102, 'L6_2263916LZV_VintageBlack_1_0083.png', 'black'),
(119, 103, 'BannaYellow_6_cc4a0438-cc53-44ea-9ca2-c88c9e480e8c.png', 'yellow'),
(120, 104, 'SJAB8871.png', 'black'),
(121, 80, 'SJAB1983.png', 'black'),
(122, 81, 'SJAB1857.png', 'grey'),
(123, 82, 'unnamed.png.png', 'blue'),
(124, 82, 'Navywash_Woman_6_gyst.png', 'blue'),
(125, 83, 'SJAB2008.png', 'black'),
(126, 83, 'SJAB2034.png', 'black'),
(127, 84, 'SJAB1868.png', 'grey'),
(128, 84, 'SJAB1870.png', 'grey'),
(129, 85, 'SJAB2168_8a0b5ba5-5002-4d29-938e-16c89ae87b7e.png', 'blue'),
(130, 86, 'SJAB2232.png', 'white'),
(131, 86, 'SJAB2265 (2).png', 'white'),
(132, 86, 'SJAB2265 (1).png', 'white'),
(133, 87, '422A9980 (2).png', 'white'),
(134, 87, '422A9980 (3).png', 'white'),
(135, 87, '422A9980 (4).png', 'white'),
(136, 88, 'SJAB0962.png', 'gainsboro'),
(137, 88, 'SJAB0966.png', 'gainsboro'),
(138, 88, 'SJAB0974.png', 'gainsboro'),
(139, 89, 'LazyP0126-2.png', 'BurlyWood'),
(140, 89, 'LazyP0132-2.png', 'BurlyWood'),
(141, 89, 'LazyP0122-2.png', 'BurlyWood'),
(142, 90, 'SJAB1198_faf23167-d526-47bc-ac87-9ff8258fc8c9.png', 'grey'),
(143, 90, 'SJAB1201_d8aabe72-2ca5-4696-a1b6-5fb674277f87.png', 'grey'),
(144, 90, 'SJAB1204_fd13c381-3430-48d5-a419-6b5783e2e0cb.png', 'grey'),
(145, 91, 'Photoshoot_Dec152023_001-1051.png', 'black'),
(146, 91, 'Photoshoot_Dec152023_001-1062.png', 'black'),
(147, 92, 'Photoshoot_Dec152023_001-940.png', 'wheat'),
(148, 92, 'Photoshoot_Dec152023_001-948.png', 'wheat'),
(149, 93, 'Photoshoot_Dec152023_001-490.png', 'black'),
(150, 93, 'Photoshoot_Dec152023_001-500.png', 'black'),
(151, 93, 'Photoshoot_Dec152023_001-506.png', 'black'),
(152, 94, 'SJAB7495.png', 'darkorange'),
(153, 94, 'SJAB7500.png', 'darkorange'),
(154, 94, 'SJAB7497.png', 'darkorange'),
(155, 95, 'SJAB6778.png', 'antiquewhite'),
(156, 95, 'SJAB6784.png', 'antiquewhite'),
(157, 95, 'SJAB6780.png', 'antiquewhite'),
(158, 96, 'SJAB7432.png', 'black'),
(159, 96, 'SJAB7434.png', 'black'),
(160, 96, 'SJAB7427.png', 'black'),
(161, 97, 'Justine_Arie_SilverGreen_11.png', 'aquamarine'),
(162, 97, 'Justine_Arie_SilverGreen_10.png', 'aquamarine'),
(163, 97, 'Justine_Arie_SilverGreen_12.png', 'aquamarine'),
(164, 98, 'BONE-SA0005-P-S1-1051-Edit-Download.png', 'gainsboro'),
(165, 98, 'BONE-SA0005-P-S1-1043-Edit-Download.png', 'gainsboro'),
(166, 98, 'BONE-SA0005-P-S1-1031-Edit-Download.png', 'gainsboro'),
(167, 99, 'Black_Pants_CostcoF24_SqubaMarch2024_001-2063.png', 'black'),
(168, 99, 'SJAB8799.png', 'black'),
(169, 99, 'Black_Pants_CostcoF24_SqubaMarch2024_001-2062.png', 'black'),
(170, 100, 'Grey_Woman_2_oi.png', 'grey'),
(171, 100, 'img_23357.png', 'grey'),
(172, 100, 'img_23360.png', 'grey'),
(173, 101, 'L22263LZVM_VintageMint_3_0211.png', 'lightgreen'),
(174, 101, 'L6-2263916LZV_VintageMint_4_0189.png', 'lightgreen'),
(175, 101, 'L22263LZVM_VintageMint_2_0223.png', 'lightgreen'),
(176, 102, 'L6_2263916LZV_VintageBlack_2_0100.png', 'black'),
(177, 102, 'L6_2263916LZV_VintageBlack_4_0105.png', 'black'),
(178, 102, 'L6_2263916LZV_VintageBlack_2_0092.png', 'black'),
(179, 103, 'BannaYellow_8_5e8007d7-4af5-4203-b522-92c579d17edf.png', 'yellow'),
(180, 103, 'BannaYellow_7_807cd367-1dba-42e6-9321-7bd3a614d8a7.png', 'yellow'),
(181, 104, 'SJAB8569_90e4bfc5-a7b9-48e2-beb6-fa098c235e93.png', 'black'),
(182, 104, 'SJAB8578_27300ac4-55ec-4ccc-9dab-b641ef989263.png', 'black'),
(183, 104, 'SJAB8532_4e749f24-ef11-420e-974c-f30d1e3c1f56.png', 'black');

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
(139, 1, 2, 'view', '2024-06-13 03:10:21'),
(140, 1, 3, 'view', '2024-06-13 03:49:28'),
(141, 1, 6, 'view', '2024-06-13 03:49:33'),
(142, 1, 7, 'view', '2024-06-13 03:49:34'),
(143, 1, 7, 'view', '2024-06-13 03:50:11'),
(144, 1, 7, 'view', '2024-06-13 03:50:11'),
(145, 1, 7, 'view', '2024-06-13 03:51:13'),
(146, 1, 7, 'view', '2024-06-13 03:51:25'),
(147, 1, 7, 'view', '2024-06-13 03:51:35'),
(148, 1, 12, 'view', '2024-06-13 04:03:24'),
(149, 1, 12, 'view', '2024-06-13 04:04:22'),
(150, 1, 12, 'view', '2024-06-13 04:04:23'),
(151, 1, 7, 'view', '2024-06-13 04:04:25'),
(152, 1, 7, 'view', '2024-06-13 04:04:46'),
(153, 1, 7, 'view', '2024-06-13 04:04:47'),
(154, 1, 9, 'view', '2024-06-13 04:04:51'),
(155, 1, 9, 'view', '2024-06-13 04:05:03'),
(156, 1, 9, 'view', '2024-06-13 04:05:14'),
(157, 1, 9, 'view', '2024-06-13 04:05:24'),
(158, 1, 12, 'view', '2024-06-13 04:06:20'),
(159, 1, 20, 'view', '2024-06-13 04:15:06'),
(160, 1, 20, 'view', '2024-06-13 04:15:28'),
(161, 1, 20, 'view', '2024-06-13 04:16:31'),
(162, 1, 20, 'view', '2024-06-13 04:16:51'),
(163, 1, 10, 'view', '2024-06-13 04:17:20'),
(164, 1, 1, 'view', '2024-06-13 04:27:17'),
(165, 1, 1, 'view', '2024-06-13 04:27:20'),
(166, 1, 1, 'view', '2024-06-13 04:27:21'),
(167, 1, 1, 'view', '2024-06-13 04:27:53'),
(168, 1, 1, 'view', '2024-06-13 04:27:54'),
(169, 1, 1, 'view', '2024-06-13 04:28:03'),
(170, 1, 1, 'view', '2024-06-13 04:28:04'),
(171, 1, 1, 'view', '2024-06-13 04:28:04'),
(172, 1, 1, 'view', '2024-06-13 04:29:15'),
(173, 1, 1, 'view', '2024-06-13 04:29:31'),
(174, 1, 1, 'view', '2024-06-13 04:29:31'),
(175, 1, 1, 'view', '2024-06-13 04:29:31'),
(176, 1, 1, 'view', '2024-06-13 04:29:48'),
(177, 1, 3, 'view', '2024-06-13 04:30:07'),
(178, 1, 3, 'view', '2024-06-13 04:30:13'),
(179, 1, 3, 'view', '2024-06-13 04:30:53'),
(180, 1, 3, 'view', '2024-06-13 04:31:16'),
(181, 1, 3, 'view', '2024-06-13 04:31:17'),
(182, 1, 3, 'view', '2024-06-13 04:31:41'),
(183, 1, 3, 'view', '2024-06-13 04:32:01'),
(184, 1, 3, 'view', '2024-06-13 04:32:02'),
(185, 1, 3, 'view', '2024-06-13 04:32:07'),
(186, 1, 3, 'view', '2024-06-13 04:32:36'),
(187, 1, 3, 'view', '2024-06-13 04:33:13'),
(188, 1, 3, 'view', '2024-06-13 04:33:17'),
(189, 1, 3, 'view', '2024-06-13 04:33:22'),
(190, 1, 3, 'view', '2024-06-13 04:33:23'),
(191, 1, 3, 'view', '2024-06-13 04:33:23'),
(192, 1, 3, 'view', '2024-06-13 04:33:32'),
(193, 1, 3, 'view', '2024-06-13 04:34:00'),
(194, 1, 3, 'view', '2024-06-13 04:34:00'),
(195, 1, 3, 'view', '2024-06-13 04:34:00'),
(196, 1, 3, 'view', '2024-06-13 04:34:01'),
(197, 1, 3, 'view', '2024-06-13 04:34:01'),
(198, 1, 3, 'view', '2024-06-13 04:34:06'),
(199, 1, 3, 'view', '2024-06-13 04:34:37'),
(200, 1, 5, 'view', '2024-06-13 04:34:43'),
(201, 1, 7, 'view', '2024-06-13 04:34:46'),
(202, 1, 9, 'view', '2024-06-13 04:34:52'),
(203, 1, 9, 'view', '2024-06-13 04:35:10'),
(204, 1, 9, 'view', '2024-06-13 04:35:11'),
(205, 1, 9, 'view', '2024-06-13 04:35:11'),
(206, 1, 9, 'view', '2024-06-13 04:35:21'),
(207, 1, 9, 'view', '2024-06-13 04:35:49'),
(208, 1, 9, 'view', '2024-06-13 04:36:03'),
(209, 1, 2, 'view', '2024-06-13 04:36:22'),
(210, 1, 2, 'view', '2024-06-13 04:36:30'),
(211, 1, 3, 'view', '2024-06-13 04:36:57'),
(212, 1, 3, 'view', '2024-06-13 04:36:59'),
(213, 1, 3, 'view', '2024-06-13 04:37:18'),
(214, 1, 3, 'view', '2024-06-13 04:37:24'),
(215, 1, 3, 'view', '2024-06-13 04:38:25'),
(216, 1, 3, 'view', '2024-06-13 04:39:41'),
(217, 1, 3, 'view', '2024-06-13 04:40:45'),
(218, 1, 3, 'view', '2024-06-13 04:41:21'),
(219, 1, 3, 'view', '2024-06-13 04:42:07'),
(220, 1, 3, 'view', '2024-06-13 04:42:38'),
(221, 1, 3, 'view', '2024-06-13 04:42:42'),
(222, 1, 3, 'view', '2024-06-13 04:42:49'),
(223, 1, 3, 'view', '2024-06-13 04:42:58'),
(224, 1, 6, 'view', '2024-06-13 04:43:05'),
(225, 1, 39, 'view', '2024-06-13 05:15:20'),
(226, 1, 39, 'view', '2024-06-13 05:15:43'),
(227, 1, 89, 'view', '2024-06-13 05:47:52'),
(228, 1, 89, 'view', '2024-06-13 05:48:26'),
(229, 1, 2, 'view', '2024-06-13 05:48:29'),
(230, 1, 4, 'view', '2024-06-13 05:48:33'),
(231, 1, 3, 'view', '2024-06-13 05:48:36'),
(232, 1, 57, 'view', '2024-06-13 05:48:39'),
(233, 1, 57, 'view', '2024-06-13 05:48:44'),
(234, 1, 57, 'view', '2024-06-13 05:52:47'),
(235, 1, 2, 'view', '2024-06-13 05:52:59'),
(236, 1, 81, 'view', '2024-06-13 05:53:02'),
(237, 1, 2, 'view', '2024-06-13 05:53:07'),
(238, 1, 3, 'view', '2024-06-13 05:53:16'),
(239, 1, 58, 'view', '2024-06-13 05:53:20'),
(240, 1, 58, 'view', '2024-06-13 05:53:40'),
(241, 1, 1, 'view', '2024-06-13 05:53:42'),
(242, 1, 1, 'view', '2024-06-13 05:54:12'),
(243, 1, 1, 'view', '2024-06-13 05:55:07'),
(244, 1, 1, 'view', '2024-06-13 05:55:51'),
(245, 1, 1, 'view', '2024-06-13 05:56:00'),
(246, 1, 1, 'view', '2024-06-13 05:56:29'),
(247, 1, 1, 'view', '2024-06-13 05:56:38'),
(248, 1, 1, 'view', '2024-06-13 05:56:54'),
(249, 1, 1, 'view', '2024-06-13 05:57:05'),
(250, 1, 1, 'view', '2024-06-13 05:57:10'),
(251, 1, 2, 'view', '2024-06-13 05:57:24'),
(252, 1, 4, 'view', '2024-06-13 05:57:26'),
(253, 1, 65, 'view', '2024-06-13 05:57:30'),
(254, 1, 2, 'view', '2024-06-13 05:57:35'),
(255, 1, 62, 'view', '2024-06-13 05:57:39'),
(256, 1, 62, 'view', '2024-06-13 05:57:53'),
(257, 1, 1, 'view', '2024-06-13 05:57:56'),
(258, 1, 101, 'view', '2024-06-13 06:09:45'),
(259, 1, 101, 'view', '2024-06-13 06:10:09'),
(260, 1, 101, 'view', '2024-06-13 06:10:35'),
(261, 1, 2, 'view', '2024-06-13 06:10:40'),
(262, 1, 2, 'view', '2024-06-13 06:10:51'),
(263, 1, 4, 'view', '2024-06-13 06:11:05'),
(264, 1, 82, 'view', '2024-06-13 06:11:08'),
(265, 1, 56, 'view', '2024-06-13 06:11:25'),
(266, 1, 96, 'view', '2024-06-13 06:23:18'),
(267, 1, 2, 'view', '2024-06-13 06:23:37'),
(268, 1, 2, 'view', '2024-06-13 06:32:37'),
(269, 1, 55, 'view', '2024-06-13 06:32:55'),
(270, 1, 1, 'view', '2024-06-13 06:33:02'),
(271, 1, 1, 'view', '2024-06-13 06:33:40'),
(272, 1, 1, 'view', '2024-06-13 06:33:50'),
(273, 1, 1, 'view', '2024-06-13 06:33:50'),
(274, 1, 1, 'view', '2024-06-13 06:34:41'),
(275, 1, 1, 'view', '2024-06-13 06:34:53'),
(276, 1, 1, 'view', '2024-06-13 06:34:54'),
(277, 1, 2, 'view', '2024-06-13 06:35:06'),
(278, 1, 2, 'view', '2024-06-13 06:35:13'),
(279, 1, 2, 'view', '2024-06-13 06:35:18'),
(280, 1, 56, 'view', '2024-06-13 06:35:23'),
(281, 1, 4, 'view', '2024-06-13 06:35:28'),
(282, 1, 55, 'view', '2024-06-13 06:35:40'),
(283, 1, 94, 'view', '2024-06-13 07:28:03'),
(284, 1, 98, 'view', '2024-06-13 07:28:09'),
(285, 1, 98, 'view', '2024-06-13 07:28:35'),
(286, 1, 57, 'view', '2024-06-13 07:28:39'),
(287, 1, 61, 'view', '2024-06-13 07:28:42'),
(288, 1, 64, 'view', '2024-06-13 07:28:45'),
(289, 1, 85, 'view', '2024-06-13 07:28:49');

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
  ADD PRIMARY KEY (`id_PdImg`),
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
  MODIFY `id_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT cho bảng `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id_PdImg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT cho bảng `user_behavior`
--
ALTER TABLE `user_behavior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

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
  ALTER TABLE `revenue`
  ADD CONSTRAINT `revenue_ibfk_1` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id_Cart`);
COMMIT;

