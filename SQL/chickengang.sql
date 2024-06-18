-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 18, 2024 lúc 08:25 AM
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
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Pending',
  `total_money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id_Cart`, `user_id`, `product_id`, `color`, `product_name`, `Quantity`, `price`, `order_date`, `status`, `total_money`) VALUES
(4, 9, NULL, 'light green', 'COOPER EXCLUSIVE ULTRA-SOFT BOYFRIEND HOODIE IN VINTAGE MINT', '1', 109, '2024-06-15 23:58:38', 'Shipped', 109),
(5, 9, NULL, 'yellow', 'WOMEN TRACKSUIT IN BANANA YELLOW', '1', 190, '2024-03-15 23:58:38', 'Delivered', 190),
(14, 8, NULL, 'grey', 'MEN JOGGER IN NAVY WASH', '1', 180, '2024-06-18 02:01:01', '0', 180),
(15, 8, NULL, 'black', 'MEN SWEATSUIT SET IN BLACK', '1', 331, '2024-06-18 02:02:07', 'Pending', 331);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id_User` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id_User`, `username`, `email`, `phone_number`, `address`, `password`, `login_id`) VALUES
(1, 'NGUYEN HUU DUC', 'duc@gmail.com', '0123456789', '1 đường a quận a tp hcm', '123', NULL),
(2, 'NGUYEN TRUNG HIEU', 'hieu@gmail.com', '0123456789', 'a phố 2 quận 2 tp hcm', '123', NULL),
(3, 'Đào Thị Kim Anh', 'daothikimanh@gmail.com', NULL, NULL, '123', NULL),
(6, 'Huu Duc', 'duc@gmail.com', '0123456789', '1a đường 11 Phú Nhuận Tp Hcm', '123', 1),
(7, 'Gum', 'duc@gmail.com', '123456789', 'a1 đường 1 phú nhuận tp hcm', '123', 4),
(8, 'huy', 'tatsumin123456@gmail.com', '321', 'tatsumin123456@gmail.com', '123', 5),
(9, 'huy3', 'n23dvcn025@student.ptithcm.edu.vn', '3213123', '34/33', '123', 8),
(10, 'ad', NULL, NULL, NULL, '123', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_information`
--

CREATE TABLE `customer_information` (
  `id_CtInformation` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `expire_date` varchar(100) DEFAULT NULL,
  `cvv` varchar(30) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer_information`
--

INSERT INTO `customer_information` (`id_CtInformation`, `user_id`, `username`, `email`, `address`, `card_number`, `expire_date`, `cvv`, `phone_number`) VALUES
(1, 6, 'Huu Duc', 'duc@gmail.com', '1a đường 11 Phú Nhuận Tp Hcm', '111111111', '11/23', '111', '0123456789'),
(2, 9, 'tat', 'n23dvcn025@student.ptithcm.edu.vn', '33', '33', '22', '22', '11'),
(3, 8, 'gg', 'n23dvcn025@student.ptithcm.edu.vn', '55', '22', '33', '11', '44'),
(4, 8, 'huy', 'tatsumin123456@gmail.com', '45/5/3 đường 10', '321', '22', '33', '0971435594'),
(5, 8, 'huy2', 'tatsumin123456@gmail.com', '45/5/3 đường 10', '33', '11', '22', '0971435594'),
(8, 8, 'huy', 'tatsumin123456@gmail.com', '45/5/3 đường 10', '22', '33', '11', '0971435594'),
(9, 8, 'ad2', 'tatsumin123456@gmail.com', '45/5/3 đường 10', '22', '33', '22', '0971435594'),
(10, 8, 'huy2', 'tatsumin123456@gmail.com', '45/5/3 đường 10', '22', '33', '11', '0971435594'),
(11, 8, 'huy22', 'tatsumin123456@gmail.com', '45/5/3 đường 10', '22', '33', '11', '0971435594');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback1`
--

CREATE TABLE `feedback1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `feedback1`
--

INSERT INTO `feedback1` (`id`, `name`, `email`, `message`, `user_id`, `created_at`) VALUES
(1, 'Huu Duc', 'duc@gmail.com', 'đức đz', 6, '2024-06-12 21:03:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login`
--

CREATE TABLE `login` (
  `id_Login` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login`
--

INSERT INTO `login` (`id_Login`, `username`, `password`, `role`) VALUES
(1, 'Huu Duc', '123', 'user'),
(2, 'Gum', '123', 'admin'),
(3, 'Kim Anh', '123', 'user'),
(4, 'GumXu', '123', 'user'),
(5, 'huy', '123', 'user'),
(8, 'huy3', '123', 'user'),
(9, 'ad', '123', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id_Product` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `description_detail` varchar(255) NOT NULL,
  `category` varchar(20) NOT NULL,
  `collection` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id_Product`, `product_name`, `quantity`, `description`, `description_detail`, `category`, `collection`, `price`, `created_at`, `update_at`) VALUES
(55, 'Levents® College Global Tee White', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Polo', 'Levent', 390, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(56, 'Levents® Best Thing Tee', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Tee', 'Levent', 370, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(57, 'Levents® Flowers Window Sweater Cream', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Sweater', 'Levent', 590, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(58, 'Levents® XL Logo Striped Shirt', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Shirt', 'Levent', 390, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(59, 'Levents® Stripe Polo', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Hoodie', 'Levent', 400, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(60, 'Levents® Stars Spray Boxy 2.0 Tee', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Tee', 'Levent', 190, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(61, 'Levents® Wellness Tee White', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Tee', 'Levent', 120, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(62, 'Levents® Blank Boxy 2.0 Tee', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Tee', 'Levent', 230, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(63, 'Levents® College Raglan Boxy Tee White', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Tee', 'Levent', 390, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(64, 'Levents® Flowers Window Tee Cream', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Tee', 'Levent', 190, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(65, 'Levents® Horizontal Stripes Shirt', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Shirt', 'Levent', 230, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(66, 'Levents® Sticker Long Sleeve Tee', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Tee', 'Levent', 190, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(67, 'Levents® Classic Wrinkle Nylon Cargo ShortPantsa', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Cargo', 'Levent', 290, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(68, 'Levents® Best Thing Hoodie Grey', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Hoodie', 'Levent', 610, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(69, 'Levents® Cargo ShortPants Dark Green', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Cargo', 'Levent', 390, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(70, 'Levents® Classic 2Tone Wrinkle Nylon Hood Jacket', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Jacket', 'Levent', 390, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(71, 'Levents® Ribbon Rabit Sweater Black', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Sweater', 'Levent', 390, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(72, 'Levents® Classic Straight Loose Trouser', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Trousers', 'Levent', 390, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(73, 'Levents® Classic Wash Straight Jeans', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Jeans', 'Levent', 120, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(74, 'Levents® Classic Knit Oversized Gile', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Gile', 'Levent', 290, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(75, 'Levents® Classic Baggy Girl Jeans Blue', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Jeans', 'Levent', 190, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(76, 'Levents® 23 Jersey', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Sweater', 'Levent', 390, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(77, 'Levents® Casual Shoulder Bag Black', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Bag', 'Levent', 420, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(78, 'Levents® Champion Snapback Cap Cream', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Cap', 'Levent', 250, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(79, 'Levents® College Cap Red', 1, 'Thiết kế độc quyền', '60% cotton, 40% polyester (PES)', 'Cap', 'Levent', 250, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(80, 'MEN JOGGER IN BLACK', 1, 'softest materials, our new set features pockets, a relaxed', '60% cotton, 40% polyester (PES)', 'Jogger', 'Lazy', 331, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(81, 'MEN JOGGER IN CLASSIC GREY', 1, 'features side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Jogger', 'Lazy', 180, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(82, 'MEN JOGGER IN NAVY WASH', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Jogger', 'Lazy', 180, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(83, 'MEN SWEATSUIT SET IN BLACK', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Sweatsuit', 'Lazy', 331, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(84, 'MEN SWEATSUIT SET IN CLASSIC GREY', 1, 'softest materials, our new set features pockets, a relaxed', '60% cotton, 40% polyester (PES)', 'Sweatsuit', 'Lazy', 331, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(85, 'MEN SWEATSUIT SET IN NAVY WASH', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Sweatsuit', 'Lazy', 208, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(86, 'MEN SWEATSUIT SET IN WHITE CAMO', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Sweatsuit', 'Lazy', 165, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(87, 'MEN SWEATSUIT SET IN WINTER WHITE CAMO', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Sweatsuit', 'Lazy', 165, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(88, 'MEN SWEATSUIT SET IN BONE', 1, 'This crazy-soft hoodie is perfect for lounging, living and snacking in.', '60% cotton, 40% polyester (PES)', 'Sweatsuit', 'Lazy', 331, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(89, 'MEN PREMIUM FLEECE RELAXED SWEATPANTS IN CAMEL', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Sweatpants', 'Lazy', 140, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(90, 'MEN PACKABLE PUFFER JACKET IN WHITE CAMO', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Jacket', 'Lazy', 350, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(91, 'LIGHTWEIGHT COTTON GAUZE STRAIGHT LEG PANTS IN BLACK', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Pants', 'Lazy', 180, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(92, 'LIGHTWEIGHT COTTON GAUZE SHORTS IN BONE', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Gauze', 'Lazy', 165, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(93, 'LIGHTWEIGHT COTTON GAUZE BUTTON DOWN SHIRT IN BLACK', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Gauze', 'Lazy', 180, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(94, 'AMBER TEDDY SHERPA SHACKET IN BISCUIT', 1, 'This fuzzy number includes a hidden polar fleece interior, keeping you warm for colder temperatures', '100% Polyester', 'Shacket', 'Lazy', 236, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(95, 'SARA TEDDY SHERPA ZIP UP JACKET IN BONE', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Jacket', 'Lazy', 199, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(96, 'WOMEN CHLO DOUBLE-FACE VELOUR HOODIE IN BLACK', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Hoodie', 'Lazy', 190, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(97, 'ARIE AND JUSTINE SET IN SILVER GREEN', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Hoodie', 'Lazy', 190, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(98, 'SHACKET IN BONE', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Shacket', 'Lazy', 160, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(99, 'NOVA PREMIUM FLEECE RELAXED SWEATPANTS IN BLACK', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Sweatpants', 'Lazy', 250, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(100, 'NOVA PREMIUM FLEECE RELAXED SWEATPANTS IN CLASSIC GREY', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Sweatpants', 'Lazy', 180, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(101, 'COOPER EXCLUSIVE ULTRA-SOFT BOYFRIEND HOODIE IN VINTAGE MINT', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Hoodie', 'Lazy', 109, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(102, 'NIKI + COOPER EXCLUSIVE ULTRA-SOFT SWEATSUIT SET IN VINTAGE BLACK', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Sweatsuit', 'Lazy', 199, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(103, 'WOMEN TRACKSUIT IN BANANA YELLOW', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Hoodie', 'Lazy', 190, '2024-06-13 00:47:17', '2024-06-13 00:47:17'),
(104, 'CHLO RELAXED FIT HOODIE IN VINTAGE BLACK', 1, 'side pockets, a tailored figure & hidden drawstrings', '60% cotton, 40% polyester (PES)', 'Hoodie', 'Lazy', 180, '2024-06-13 00:47:17', '2024-06-13 00:47:17');

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
(6, 55, 'White_LTSGICOA359UW0101SS24_1.png', 'white'),
(7, 56, 'White_LTSOVCOA449UW0100SS24_1.png', 'white'),
(8, 57, 'Cream_LSWOVCOK450UC0102SS24_1.png', 'burlywood'),
(9, 58, 'Pink_LSHOVCOB253UP0101SS24_1.png', 'pink'),
(10, 59, 'Cream_LPOOVCOC229UC0101SS24_1.png', 'burlywood'),
(11, 60, 'Black_LTSBXCOA265UD0101SS24_1.png', 'black'),
(12, 61, 'White_LTSBXCOA451UW0101SS24_1.png', 'white'),
(13, 62, 'LightBrown_LTSBXCLA154UN0201SS24_1.png', 'Wheat'),
(14, 63, 'White_LTSBOCOA314UW0100SS24_1.png', 'white'),
(15, 64, 'Cream_LTSOVCOA427UC0100SS24_1.png', 'burlywood'),
(16, 65, 'Green_LSHOVCOB330UG0101SS24_1.png', 'green'),
(17, 66, 'Pink_LTSOVCOA434UP0101SS24_1..png', 'pink'),
(18, 67, 'Cream_LSPSPCLO152UC0101FW23_1.png', 'burlywood'),
(19, 68, 'Grey_LHOOVCOD305UX0102SS24_1.png', 'grey'),
(20, 69, 'DarkGreen_LSPSPCOO231UG0201SS24_1.png', 'darkgreen'),
(21, 70, 'Red_LHJOVCLD760UR0102FW23_1.png', 'red'),
(22, 71, 'Black_LSWOVCOK426UD0102SS24_1.png', 'black'),
(23, 72, 'Cream_LPATLCLN157UC0101FW23_1.png', 'burlywood'),
(24, 73, 'Black_LJESTCLP115UD0102FW23_1.png', 'black'),
(25, 74, 'Black_LGIOVCLH154UD0102FW23_1.png', 'black'),
(26, 75, 'Blue_LJEBGCLP156WB0102FW23_1.png', 'blue'),
(27, 76, 'Black_LPOOVCOC317UD0101SS2_1.png', 'black'),
(28, 77, 'BLACK_LHLSDCOJ243UD01NOSS24_1.png', 'black'),
(29, 78, 'Cream_LCPSNACU446UC01NOSS24_1.png', 'burlywood'),
(30, 79, 'Red_LCPSPACU345UR01NOSS24_1.png', 'red'),
(31, 80, 'SJAB1963.png', 'black'),
(32, 81, 'SJAB1857 .png', 'grey'),
(33, 82, 'unnamed3.png', 'grey'),
(34, 83, 'SJAB2028.png', 'black'),
(35, 84, 'SJAB1867.png', 'grey'),
(36, 85, 'SJAB2122_0b597590-1755-4a44-b014-90277dccca4e.png', 'black'),
(37, 86, 'SJAB2265 (3).png', 'white'),
(38, 87, '422A9980 (1).png', 'white'),
(39, 88, 'SJAB0956.png', 'gainsboro'),
(40, 89, 'LazyP0108-2.png', 'camel'),
(41, 90, 'SJAB1196_2f77dce3-86f2-445c-b135-4ceb38908c29.png', 'grey'),
(42, 91, 'Photoshoot_Dec152023_001-1049.png', 'black'),
(43, 92, 'Photoshoot_Dec152023_001-937.png', 'gainsboro'),
(44, 93, 'Photoshoot_Dec152023_001-430.png', 'black'),
(45, 94, 'SJAB7486.png', 'biscuit'),
(46, 95, 'SJAB6771.png', 'antiquewhite'),
(47, 96, 'SJAB7424.png', 'black'),
(48, 97, 'Justine_Arie_SilverGreen_2.png', 'siver green'),
(49, 98, 'BONE-Edited-SA0005-P-S1-1122.png', 'gainsboro'),
(50, 99, 'Black_Pants_CostcoF24_SqubaMarch2024_001-2048.png', 'black'),
(51, 100, 'img_23355.png', 'grey'),
(52, 101, 'L22263LZVM_VintageMint_1_0206.png', 'light green'),
(53, 102, 'L6_2263916LZV_VintageBlack_1_0083.png', 'black'),
(54, 103, 'BannaYellow_6_cc4a0438-cc53-44ea-9ca2-c88c9e480e8c.png', 'yellow'),
(55, 104, 'SJAB8871.png', 'black'),
(56, 59, 'DarkBlue_LPOOVCOC229UB0501SS24_1.png', 'dark blue'),
(57, 60, 'White_LTSBXCOA265UW0101SS24_1.png', 'white'),
(58, 56, 'Blue_LTSOVCOA449UB0100SS24_1.png', 'blue'),
(59, 56, 'Black_LTSOVCOA449UD0100SS24_1.png', 'black'),
(60, 62, 'Black_LTSBXCLA154UD0101SS24_1.png', 'black'),
(61, 65, 'Yellow_LSHOVCOB330UY0101SS24_1.png', 'yellow'),
(62, 65, 'Grey__65.png', 'grey'),
(63, 66, 'Yellow_LTSOVCOA434UY0101SS24_1.png', 'yellow'),
(64, 70, 'Black_LHJOVCLD758UD0102FW23_1.png', 'black'),
(65, 67, 'Black_LSPSPCLO152UD0101FW23_1.png', 'black'),
(66, 67, 'Green_LSPSPCLO152UG0101FW23_1.png', 'green'),
(67, 67, 'Black_LSPSPCLO152UD0101FW23_1.png', 'blue'),
(68, 80, 'SJAB1983.png', 'black'),
(69, 81, 'SJAB1857.png', 'grey'),
(70, 82, 'unnamed.png', 'blue'),
(71, 82, 'Navywash_Woman_6_gyst.png', 'blue'),
(72, 83, 'SJAB2008.png', 'black'),
(73, 83, 'SJAB2034.png', 'black'),
(74, 84, 'SJAB1868.png', 'grey'),
(75, 84, 'SJAB1870.png', 'grey'),
(76, 85, 'SJAB2168_8a0b5ba5-5002-4d29-938e-16c89ae87b7e.png', 'blue'),
(77, 86, 'SJAB2232.png', 'white'),
(78, 86, 'SJAB2265 (2).png', 'white'),
(79, 86, 'SJAB2265 (1).png', 'white'),
(80, 87, '422A9980 (2).png', 'white'),
(81, 87, '422A9980 (3).png', 'white'),
(82, 87, '422A9980 (4).png', 'white'),
(83, 88, 'SJAB0962.png', 'gainsboro'),
(84, 88, 'SJAB0966.png', 'gainsboro'),
(85, 88, 'SJAB0974.png', 'gainsboro'),
(86, 89, 'LazyP0126-2.png', 'BurlyWood'),
(87, 89, 'LazyP0132-2.png', 'BurlyWood'),
(88, 89, 'LazyP0122-2.png', 'BurlyWood'),
(89, 90, 'SJAB1198_faf23167-d526-47bc-ac87-9ff8258fc8c9.png', 'grey'),
(90, 90, 'SJAB1201_d8aabe72-2ca5-4696-a1b6-5fb674277f87.png', 'grey'),
(91, 90, 'SJAB1204_fd13c381-3430-48d5-a419-6b5783e2e0cb.png', 'grey'),
(92, 91, 'Photoshoot_Dec152023_001-1051.png', 'black'),
(93, 91, 'Photoshoot_Dec152023_001-1062.png', 'black'),
(94, 92, 'Photoshoot_Dec152023_001-940.png', 'wheat'),
(95, 92, 'Photoshoot_Dec152023_001-948.png', 'wheat'),
(96, 93, 'Photoshoot_Dec152023_001-490.png', 'black'),
(97, 93, 'Photoshoot_Dec152023_001-500.png', 'black'),
(98, 93, 'Photoshoot_Dec152023_001-506.png', 'black'),
(99, 94, 'SJAB7495.png', 'darkorange'),
(100, 94, 'SJAB7500.png', 'darkorange'),
(101, 94, 'SJAB7497.png', 'darkorange'),
(102, 95, 'SJAB6778.png', 'antiquewhite'),
(103, 95, 'SJAB6784.png', 'antiquewhite'),
(104, 95, 'SJAB6780.png', 'antiquewhite'),
(105, 96, 'SJAB7432.png', 'black'),
(106, 96, 'SJAB7434.png', 'black'),
(107, 96, 'SJAB7427.png', 'black'),
(108, 97, 'Justine_Arie_SilverGreen_11.png', 'aquamarine'),
(109, 97, 'Justine_Arie_SilverGreen_10.png', 'aquamarine'),
(110, 97, 'Justine_Arie_SilverGreen_12.png', 'aquamarine'),
(111, 98, 'BONE-SA0005-P-S1-1051-Edit-Download.png', 'gainsboro'),
(112, 98, 'BONE-SA0005-P-S1-1043-Edit-Download.png', 'gainsboro'),
(113, 98, 'BONE-SA0005-P-S1-1031-Edit-Download.png', 'gainsboro'),
(114, 99, 'Black_Pants_CostcoF24_SqubaMarch2024_001-2063.png', 'black'),
(115, 99, 'SJAB8799.png', 'black'),
(116, 99, 'Black_Pants_CostcoF24_SqubaMarch2024_001-2062.png', 'black'),
(117, 100, 'Grey_Woman_2_oi.png', 'grey'),
(118, 100, 'img_23357.png', 'grey'),
(119, 100, 'img_23360.png', 'grey'),
(120, 101, 'L22263LZVM_VintageMint_3_0211.png', 'lightgreen'),
(121, 101, 'L6-2263916LZV_VintageMint_4_0189.png', 'lightgreen'),
(122, 101, 'L22263LZVM_VintageMint_2_0223.png', 'lightgreen'),
(123, 102, 'L6_2263916LZV_VintageBlack_2_0100.png', 'black'),
(124, 102, 'L6_2263916LZV_VintageBlack_4_0105.png', 'black'),
(125, 102, 'L6_2263916LZV_VintageBlack_2_0092.png', 'black'),
(126, 103, 'BannaYellow_8_5e8007d7-4af5-4203-b522-92c579d17edf.png', 'yellow'),
(127, 103, 'BannaYellow_7_807cd367-1dba-42e6-9321-7bd3a614d8a7.png', 'yellow'),
(128, 104, 'SJAB8569_90e4bfc5-a7b9-48e2-beb6-fa098c235e93.png', 'black'),
(129, 104, 'SJAB8578_27300ac4-55ec-4ccc-9dab-b641ef989263.png', 'black'),
(130, 104, 'SJAB8532_4e749f24-ef11-420e-974c-f30d1e3c1f56.png', 'black');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `revenue`
--

CREATE TABLE `revenue` (
  `id` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 7, 93, 'view', '2024-06-13 08:35:37'),
(2, 7, 93, 'view', '2024-06-13 08:35:37'),
(3, 7, 93, 'view', '2024-06-13 08:36:01'),
(4, 7, 102, 'view', '2024-06-13 08:36:09'),
(5, 7, 102, 'view', '2024-06-13 08:37:19'),
(6, 7, 80, 'view', '2024-06-13 08:41:54'),
(7, 7, 81, 'view', '2024-06-13 08:42:08'),
(8, 7, 89, 'view', '2024-06-13 08:42:18'),
(9, 7, 93, 'view', '2024-06-13 08:42:26'),
(10, 7, 80, 'view', '2024-06-13 08:42:42'),
(11, 7, 81, 'view', '2024-06-13 08:42:43'),
(12, 7, 80, 'view', '2024-06-13 08:42:44'),
(13, 7, 81, 'view', '2024-06-13 08:42:45'),
(14, 7, 80, 'view', '2024-06-13 08:42:45'),
(15, 7, 89, 'view', '2024-06-13 08:42:46'),
(16, 7, 80, 'view', '2024-06-13 08:42:48'),
(17, 7, 81, 'view', '2024-06-13 08:42:50'),
(18, 7, 80, 'view', '2024-06-13 08:42:52'),
(19, 7, 81, 'view', '2024-06-13 08:42:53'),
(20, 7, 88, 'view', '2024-06-13 08:43:10'),
(21, 7, 88, 'view', '2024-06-13 08:44:40'),
(22, 7, 87, 'view', '2024-06-13 08:44:48'),
(23, 7, 78, 'view', '2024-06-13 08:45:34'),
(24, 7, 71, 'view', '2024-06-13 08:45:52'),
(25, 7, 67, 'view', '2024-06-13 08:45:56'),
(26, 7, 72, 'view', '2024-06-13 08:46:09'),
(27, 7, 62, 'view', '2024-06-13 08:46:12'),
(28, 7, 62, 'view', '2024-06-13 08:46:35'),
(29, 7, 57, 'view', '2024-06-13 08:47:17'),
(30, 7, 57, 'view', '2024-06-13 08:50:51'),
(31, 7, 63, 'view', '2024-06-13 08:50:58'),
(32, 7, 86, 'view', '2024-06-13 08:51:07'),
(33, 7, 92, 'view', '2024-06-13 08:51:20'),
(34, 7, 95, 'view', '2024-06-13 08:51:55'),
(35, 7, 95, 'view', '2024-06-13 08:52:53'),
(36, 7, 101, 'view', '2024-06-13 08:53:05'),
(37, 7, 83, 'view', '2024-06-13 08:55:52'),
(38, 7, 57, 'view', '2024-06-13 08:55:56'),
(39, 7, 83, 'view', '2024-06-13 08:56:00'),
(40, 7, 88, 'view', '2024-06-13 08:56:04'),
(41, 7, 82, 'view', '2024-06-14 06:14:50'),
(42, 7, 62, 'view', '2024-06-14 06:15:27'),
(43, 7, 63, 'view', '2024-06-14 06:15:45'),
(44, 7, 57, 'view', '2024-06-14 06:15:47'),
(45, 7, 60, 'view', '2024-06-14 06:15:57'),
(46, 7, 62, 'view', '2024-06-14 06:16:46'),
(47, 7, 62, 'view', '2024-06-14 06:17:30'),
(48, 7, 60, 'view', '2024-06-14 06:17:34'),
(49, 7, 62, 'view', '2024-06-14 06:17:47'),
(50, 7, 60, 'view', '2024-06-14 06:17:48'),
(51, 7, 78, 'view', '2024-06-14 06:22:47'),
(52, 7, 79, 'view', '2024-06-14 06:22:53'),
(53, 7, 55, 'view', '2024-06-14 07:20:15'),
(54, 7, 77, 'view', '2024-06-14 13:26:09'),
(55, 7, 88, 'view', '2024-06-14 13:26:29'),
(56, 7, 55, 'view', '2024-06-14 13:27:24'),
(57, 7, 60, 'view', '2024-06-14 13:27:41'),
(58, 6, 89, 'view', '2024-06-15 15:53:50'),
(59, 8, 82, 'view', '2024-06-15 17:35:51'),
(60, 8, 81, 'view', '2024-06-15 17:35:57'),
(61, 8, 58, 'view', '2024-06-15 17:36:00'),
(62, 8, 82, 'view', '2024-06-15 17:36:02'),
(63, 8, 92, 'view', '2024-06-15 17:36:08'),
(64, 8, 57, 'view', '2024-06-15 17:44:50'),
(65, 8, 66, 'view', '2024-06-17 16:58:56'),
(66, 8, 67, 'view', '2024-06-17 17:15:50'),
(67, 8, 58, 'view', '2024-06-17 17:20:28'),
(68, 8, 56, 'view', '2024-06-17 17:21:01'),
(69, 8, 56, 'view', '2024-06-17 17:21:03'),
(70, 8, 55, 'view', '2024-06-17 17:29:51'),
(71, 8, 63, 'view', '2024-06-17 19:04:38'),
(72, 8, 59, 'view', '2024-06-17 19:04:55');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_Cart`),
  ADD KEY `product_id` (`product_id`),
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_Login`);

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
-- Chỉ mục cho bảng `revenue`
--
ALTER TABLE `revenue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cart` (`id_cart`);

--
-- Chỉ mục cho bảng `user_behavior`
--
ALTER TABLE `user_behavior`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id_Cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `customer_information`
--
ALTER TABLE `customer_information`
  MODIFY `id_CtInformation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `feedback1`
--
ALTER TABLE `feedback1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `login`
--
ALTER TABLE `login`
  MODIFY `id_Login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT cho bảng `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id_PdImg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT cho bảng `revenue`
--
ALTER TABLE `revenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user_behavior`
--
ALTER TABLE `user_behavior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_Product`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id_User`);

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
-- Các ràng buộc cho bảng `feedback1`
--
ALTER TABLE `feedback1`
  ADD CONSTRAINT `feedback1_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id_User`);

--
-- Các ràng buộc cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_Product`);

--
-- Các ràng buộc cho bảng `revenue`
--
ALTER TABLE `revenue`
  ADD CONSTRAINT `revenue_ibfk_1` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id_Cart`);

--
-- Các ràng buộc cho bảng `user_behavior`
--
ALTER TABLE `user_behavior`
  ADD CONSTRAINT `user_behavior_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_Product`),
  ADD CONSTRAINT `user_behavior_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id_User`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
