-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 04, 2023 lúc 03:36 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `e-shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '0748435564', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_desc` text DEFAULT NULL,
  `brand_status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_desc`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'apple', 1, NULL, NULL),
(2, 'Không có', 'không có thương hiệu', 1, NULL, NULL),
(3, 'Samsung', 'samsung', 1, NULL, NULL),
(20, 'Oppo', 'ư', 1, NULL, NULL),
(27, 'Logitech', 'Logitech', 1, NULL, NULL),
(28, 'Dareu', 'Dareu', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` text DEFAULT NULL,
  `category_status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'Phụ kiện Apple', 'phụ kiện của Apple như kính cường lực, tai nghe,....', 1, NULL, NULL),
(29, 'Phụ kiện laptop', 'phụ kiện laptop', 1, NULL, NULL),
(30, 'Chuột, bàn phím', 'chuột, bàn phím', 1, NULL, NULL),
(31, 'Pin dự phòng', 'Pin dự phòng', 1, NULL, NULL),
(32, 'Ốp lưng', 'ốp lưng', 1, NULL, NULL),
(36, 'a', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(200) NOT NULL,
  `coupon_desc` text DEFAULT NULL,
  `coupon_value` float NOT NULL,
  `coupon_start` date NOT NULL,
  `coupon_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_name`, `coupon_desc`, `coupon_value`, `coupon_start`, `coupon_end`) VALUES
(2, 'Khuyến mãi giảm 10% giá tiền', NULL, 0.1, '2023-04-03', '2023-04-10'),
(3, 'KM 2', NULL, 0.45, '2023-04-05', '2023-04-06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_password`, `created_at`, `updated_at`) VALUES
(3, 'Truc', 'trucptt9@gmail.com', '0799786319', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL),
(5, 'Minh Hoàng', 'hoang@gmail.com', '025472434', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL),
(6, 'Hùng', 'hung@gmail.com', '017334234', '202cb962ac59075b964b07152d234b70', NULL, NULL),
(7, 'Hoàng', 'hoang@gmail.com', '0845671232', '202cb962ac59075b964b07152d234b70', NULL, NULL),
(8, 'Hoa', 'hoa@gmail.com', '0568231334', '202cb962ac59075b964b07152d234b70', NULL, NULL),
(9, 'khoa', 'khoa@gmail.com', '0789456125', '202cb962ac59075b964b07152d234b70', NULL, NULL),
(10, 'Minh Hùng', 'mhung@gmail.com', '0987622343', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_03_19_221808_create_admin_table', 1),
(8, '2023_03_20_112200_create_category_table', 2),
(9, '2023_03_21_144831_create_brand_table', 3),
(11, '2023_03_22_064223_create_product_table', 4),
(12, '2023_03_24_102056_crete_customer_table', 5),
(14, '2023_03_24_122449_create_shipping_table', 6),
(15, '2023_03_25_095443_create_payment_table', 6),
(16, '2023_03_25_100534_create_order_table', 6),
(17, '2023_03_25_100642_create_order_detail_table', 6),
(18, '2023_04_01_163556_create_table_coupon', 7),
(19, '2023_04_03_073849_create_promotional_products_table', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `shipping_id` int(11) UNSIGNED NOT NULL,
  `payment_id` int(11) UNSIGNED NOT NULL,
  `order_total` varchar(50) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `order_ngaydathang` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`order_id`, `customer_id`, `shipping_id`, `payment_id`, `order_total`, `order_status`, `order_ngaydathang`, `created_at`, `updated_at`) VALUES
(25, 3, 4, 28, '3190000', 'Đang chờ xử lý', '2023-04-02', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `orderDetail_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`orderDetail_id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_qty`, `created_at`, `updated_at`) VALUES
(16, 23, 19, 'Ốp lưng Samsung Galaxy S23 Ultra Araree Flexield', '250000', 1, NULL, NULL),
(17, 24, 19, 'Ốp lưng Samsung Galaxy S23 Ultra Araree Flexield', '250000', 1, NULL, NULL),
(18, 25, 16, 'Bút cảm ứng Apple Pencil 2 MU8F2', '3190000', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(28, '0', 'Đang chờ xử lý', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `brand_id` int(11) UNSIGNED NOT NULL,
  `product_content` text DEFAULT NULL,
  `product_desc` text DEFAULT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `product_SLtrongkho` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category_id`, `brand_id`, `product_content`, `product_desc`, `product_price`, `product_image`, `product_status`, `product_SLtrongkho`, `created_at`, `updated_at`) VALUES
(5, 'Chuột Gaming không dây Logitech G304 Prodigy', 30, 27, 'Chuột Gaming không dây Logitech G304 Prodigy - Hiệu quả gaming tối ưu dành cho bạn', 'Cảm biến HERO với hiệu suất ổn định và chính xác vượt trội, giúp tăng tốc từ 200 tới 12.000 DPI\r\nCông nghệ LIGHTSPEED giải pháp không dây cấp độ chuyên gia đạt được hiệu suất như có dây\r\nThiết kế cơ học trọng lượng nhẹ chỉ 99g, mang lại cảm giác thoải mái khi sử dụng thời gian dài\r\nNút giữa, DPI và hai nút bên có thể lập trình tùy theo sở thích của bạn bằng G HUB của Logitech', '949000', 'Chuột Gaming không dây Logitech G304 Prodigy6.jpg', 1, 29, NULL, NULL),
(6, 'Chuột không dây Logitech Pebble M350', 30, 27, 'Chuột không dây Logitech Pebble M350 tối giản, hiện đại, thuận tiện khi sử dụng', 'Thiết kế hiện đại, mỏng và vừa vặn trong lòng bàn tay\r\nHỗ trợ Bluetooth và USB Receiver ở phạm vi đến 10m\r\nChống ồn SilentTouch giảm hơn 90% tiếng nhấp chuột\r\nCảm biến 1000DPI cho chuột di chuyển nhanh, mượt mà', '599000', 'Chuột không dây Logitech Pebble M35067.jpg', 1, 30, NULL, NULL),
(7, 'Bàn phím cơ không dây Dareu EK807G TKL', 30, 28, 'Bàn phím cơ không dây Dareu EK807G TKL - Giá rẻ, trải nghiệm gõ êm ái\r\nBàn phím cơ không dây Dareu EK807G là sản phẩm của hãng Gaming Gear DareU nổi tiếng. Với thiết kế hiện đại, kết nối không dây 2.4 Ghz cùng mức giá cực rẻ, đây sẽ là lựa chọn hoàn hảo phục vụ nhu cầu chơi game và công việc của bạn.', 'Thiết kế trẻ trung, tiết kiệm pin\r\nThương hiệu bàn phím cơ không dây Dareu EK807G sở hữu thiết kế gọn nhẹ, các ký tự keycap được sơn màu cam nổi bật, khoảng cách giữa các phím hoàn hảo cho bạn trải nghiệm gõ tốt nhất. Tuy nhiên, Dareu EK807G lại không được trang bị đèn LED nhưng bù lại có bộ keycap ABS shot chất lượng.\r\nCảm giác gõ mượt mà, kết nối không dây tiện lợi\r\nDareu EK807G được lắp hệ thống switch D với đầy đủ Blue – Brown – Red, riêng dòng Blue Switch cho trải nghiệm gõ khá tốt, âm thanh gõ hoàn hảo và rất ổn định. Ngoài ra, với cảm giác gõ phím mượt mà đi kèm không dây tiện lợi', '666000', 'Bàn phím cơ không dây Dareu EK807G TKL4.jpg', 1, 30, NULL, NULL),
(8, 'Chuột không dây Dareu LM115B Silent', 30, 28, 'Kết nối cực tiện lợi với 2.4GHz Nano Receiver + Bluetooth 5.0 \r\nTrang bị silent switch, giúp giảm tiếng ồn khi sử dụng\r\nĐộ phân giải đến 1600 DPI, đáp ứng mọi nhu cầu thiết yếu\r\nHệ thống bảo vệ năng lượng thông minh, sử dụng pin đến 6 tháng', 'Chuột không dây Dareu LM115B Silent– Tốc độ nhanh, ấn tượng\r\nDareU LM115B Silent là sản phẩm chuột không dây giá rẻ mới thuộc phân khúc sản phẩm chuột văn phòng của thương hiệu DareU. Sản phẩm chuột không dây mới của nhà DareU gây ấn tượng nhờ vào khả năng hạn chế phát ra âm thanh, tốc độ USB cũng cực kỳ nhanh và ấn tượng\r\nKết hợp chế độ im lặng cực hảo cùng 3 cấp độ điều chỉnh DPI\r\nChuột không dây DareU LM115B Silent có thể hạn chế phát ra âm thanh tối đa nhờ vào sự trang bị công tắc im lặng ‘Silent switch’. Cùng với đó là sự kết nối với dây Nano 2.4 GHz, Bluetooth 5.0 tiện lợi. Khả năng kết nối và tốc độ báo cáo USB cũng sẽ cực kỳ nhanh, có thể nói chúng cho tốc độ phản hồi tuyệt vời, tương đương cáp 1000Hz/s.', '269000', '7_15_4618.webp', 1, 30, NULL, NULL),
(9, 'Bàn phím có dây Logitech K120', 30, 27, 'Bàn phím thiết kế đầy đủ phím bấm kèm bàn phím số tích hợp hỗ trợ nhập dữ liệu, tính toán và điều hướng diễn ra nhanh chóng\r\nTrang bị dây USB kết nối dài 1.5m chỉ cần cắm vào cổng USB máy tính để sử dụng\r\nThiết kế chống đổ tràn, các phím bền bỉ và chân nghiêng vững chắc có chiều cao có thể điều chỉnh\r\nBàn phím chắc chắn này đem lại cảm giác gõ quen thuộc, với các phím sâu và phản hồi nhanh, nhạy', 'Bàn phím có dây LOGITECH K120\r\nLogitech là nhà sản xuất hàng đầu các sản phẩm ngoại vi như chuột, máy tính,... Các sản phẩm của hãng đều được ưa chuộng bởi thiết kế thông minh, nhiều tính năng cũng như độ bền cao. Và sản phẩm bàn phím có dây LOGITECH K120 cũng không phải là ngoại lệ.  Đây là chiếc bàn phím có thiết kế phổ thông, hiệu năng tốt, đáp ứng nhu cầu đa dạng của người dùng và được Logitech trang bị nhiều tính năng cao cấp khác.\r\nThiết kế thông minh của bàn phím có dây LOGITECH K120\r\nBàn phím LOGITECH sở hữu thiết kế khá truyền thống với gam màu đen. So với các mẫu bàn phím hiện nay thì bàn phím LOGITECH có thiết kế khá mỏng, vừa giúp tiết kiệm diện tích, vừa tạo nên tính thẩm mỹ cho không gian làm việc của bạn.', '190000', 'Bàn phím có dây Logitech K12070.jpg', 1, 30, NULL, NULL),
(10, 'Chuột Apple Magic Mouse 2022 MMMQ3', 1, 1, 'Kiểu dáng hiện đại, mỏng nhẹ tạo cảm giác sang trọng\r\nThời lượng sử dụng pin đến 1 tháng chỉ trong 1 lần sạc\r\nKết nối Bluetooth ổn định trong khoảng cách lên tới 10m\r\nĐộ phân giải 1500 DPI giúp mọi thao tác mượt mà hơn', 'Chuột Apple Magic Mouse 2: Tối giản, liền mạch, thanh lịch và bền bỉ\r\nTrong các thao tác công việc hằng ngày, đặc biệt là khi làm việc trên laptop hay trên chiếc máy iMac, thì chiếc chuột máy tính không dây Apple Magic Mouse 2 là một điều cần thiết để các thao tác được nhanh nhẹn hơn và linh hoạt hơn.\r\nThiết kế bằng kim lại kết hợp nhựa cao cấp cùng khả năng kết nối không dây\r\nApple Magic Mouse 2 mang trong mình một thiết kế bằng kim loại phần khung và thân chuột, giúp chúng có một độ sang trọng và cao cấp nhất định. Cùng với đó, phần thao tác bằng nhựa cao cấp, bền bỉ ở bên trên giúp cho bạn có thể có được những thao tác gọn nhẹ, linh hoạt và thoải mái nhất có thể. Thiết kế này của chuột Magic Mouse 2 giúp đồng bộ và hài hoà khi bạn sử dụng với thiết bị Apple', '2990000', 'Chuột Apple Magic Mouse 2022 MMMQ325.jpg', 1, 0, NULL, NULL),
(11, 'Bàn phím Bluetooth Logitech K580', 30, 27, 'Thiết kế hiện đại, mỏng nhẹ, tích hợp giá đỡ điện thoại, máy tính bảng tiện lợi\r\nSử dụng tiện lợi với kết nối không dây qua Bluetooth hoặc đầu thu USB kèm theo\r\nTương thích với nhiều hệ điều hành như Windows, macOS và điện thoại, tablet\r\nTích hợp Easy Switch kết nối và dễ dàng chuyển đổi thao tác nhập liệu với 2 thiết bị\r\nTuổi thọ pin đến 24 tháng cùng khả năng tiết kiệm pin nhờ tính năng tự động ngủ', 'Bàn phím Bluetooth Logitech K580 hiện đại, tối ưu hoá không gian\r\nBàn phím không dây là sản phẩm của công nghệ hiện đại ngày nay giúp mang đến tính thẩm mĩ, sự thuận tiện tối đa cho người dùng. Một trong những thiết kế mà bạn không nên bỏ qua đó chính là bàn phím bluetooth Logitech K580.\r\nThiết kế siêu mỏng, full size với 101 nút bấm\r\nBàn phím bluetooth Logitech K580 được thiết kế vô cùng hiện đại và tinh tế. Kích thước chỉ 37.35 x 14.39 x 2.13cm cùng với sự bo tròn mềm mại ở các góc giúp cho bàn phím trở nên mỏng nhẹ và sang trọng hơn rất nhiều. Bên cạnh đó, thiết kế góc nghiêng mang đến cảm giác thoải mái ngay cả khi sử dụng trong nhiều giờ liền.', '880000', 'Bàn phím Bluetooth Logitech K5808.PNG', 1, 0, NULL, NULL),
(12, 'Combo bàn phím + Chuột không dây Logitech MK215', 30, 27, 'Combo bàn phím kèm chuột thiết kế nhỏ gọn không chiếm nhiều diện tích, dễ dàng mang theo tiện lợi\r\nBàn phím bổ sung thêm phím số phù hợp cho các thao tác nhập liệu cùng với chân nghiêng tích hợp \r\nChuột không dây nhỏ gọn có thiết kế thuận cả hai tay giúp bạn dễ cầm nắm và thoải mái khi sử dụng\r\nCombo được trang bị đầu thu USB cho khả năng kết nối không dây với khoảng cách lên tới 10 mét\r\nSử dụng pin AAA với thời gian sử dụng lên tới 2 năm cho bàn phím và 5 tháng với pin AA cho chuột', 'Bộ bàn phím và chuột không dây Logitech MK215 - Combo tiết kiệm\r\nBộ bàn phím và chuột không dây Logitech MK215 là trợ thủ đắc lực mang đến cho bạn những phút giây giải trí và làm việc ấn tượng. Độ nhạy cao, khả năng gõ phím cực êm, khiến cho mỗi trải nghiệm đều trở nên thật giá trị.\r\nBàn phím Logitech MK215 - Bàn phím full, chống tràn\r\nBàn phím Logitech MK215 được hoàn thiện từ chất liệu nhựa cao cấp, mang đến độ bền bỉ cao. Phủ bởi lớp sơn đen, chống chọi với môi trường bụi bẩn. Đặc biệt, kích thước của Logitech MK215 là bàn phím full gồm cả chữ lẫn số, hỗ trợ cho những ai thường làm việc với con số.', '499000', 'Combo bàn phím + Chuột không dây Logitech MK21563.PNG', 1, 0, NULL, NULL),
(13, 'Combo bàn phím + Chuột có dây Logitech MK200', 30, 27, 'Thiết kế nhỏ gọn, dễ mang theo và phù hợp mọi không gian làm việc\r\nBàn phím với kích thước đầy đủ mang đến trải nghiệm gõ thoải mái\r\nChuột uốn cong để nâng đỡ lòng bàn tay, giúp điều hướng dễ dàng\r\nDễ dàng kết nối với máy tính của bạn thông qua cổng USB', 'Combo bàn phím và chuột có dây Logitech MK200 thuận tiện và đồng bộ tốt hơn\r\nNếu bạn đang tìm kiếm bàn phím và chuột để trang bị cho máy tính để bàn của mình giúp thuận tiện và đồng bộ hơn thì combo bàn phím và chuột có dây Logitech MK200 sẽ là gợi ý hoàn hảo dành cho bạn. Với thiết kế chuột nhỏ gọn, bàn phím rộng, không phai theo thời gian sẽ giúp bạn có những trải nghiệm sử dụng tuyệt vời.\r\n\r\nBàn phím fullsize, thiết kế chống tràn\r\nCombo bàn phím và chuột có dây Logitech MK200 bao gồm bàn phím MK200 là dòng bàn phím full-size với đầy đủ 101 phím bấm. Người dùng có thể tăng tốc độ đánh máy so với các dòng sản phẩm thông thường khác trên thị trường.', '300000', 'Combo bàn phím + Chuột có dây Logitech MK20082.PNG', 1, 0, NULL, NULL),
(14, 'Tai nghe Bluetooth Apple AirPods 2 VN/A', 1, 1, 'Phản hồi nhanh hơn và tiết kiệm năng lượng nhờ vào con chip Apple H1\r\nThiết kế sang trọng, gọn nhẹ tạo cảm giác thoải mái khi đeo hàng giờ liền\r\nTích hợp 2 micro khử tiếng ồn cho chất lượng âm thanh tốt khi đàm thoại\r\nHỗ trợ công nghệ sạc nhanh, chỉ mất 15 phút là đã có ngay 3 giờ sử dụng', 'Tai nghe Apple AirPods 2 – Thiết kế tối giản, chất lượng âm thanh tuyệt vời\r\nVừa qua, Apple đã chính thức cho ra mắt chiếc tai nghe Airpods 2. Thế hệ thứ 2 lần này không có nhiều sự khác biệt so với thế hệ đầu về ngoại hình, trừ một số chi tiết về đèn báo hiệu cũng như ra mắt thêm phiên bản sạc không dây và sạc thường (sạc có dây). Ngoài ra, bạn có thể tham khảo thêm Apple Airpods Pro sắp được ra mắt trong thời gian tới.\r\nDung lượng pin lớn, sử dụng bền bỉ\r\nAirPods 2 chính hãng VN/A có dung lượng pin khá ấn tượng. Tai nghe cho 5 giờ chơi nhạc và 3 giờ đàm thoại. Ngoài ra, hộp sạc cũng sở hữu tính năng tính pin, cho thêm 24 giờ sử dụng.\r\nThiết kế nhỏ gọn, bắt mắt\r\nVề cơ bản tai nghe bluetooth Apple AirPods 2 vẫn sở hữu thiết kế thời trang và nhỏ gọn, trọng lượng 4g cũng rất nhẹ không khác mấy so với tai nghe AirPods thế hệ đầu tiên. Nó cũng vẫn giữ nguyên thiết kế với màu trắng đặc trưng cho các dòng tai nghe. Đây là tai nghe wireless 100% và có khả năng tích hợp với mọi thiết bị Apple khác nhau nên bạn có thể linh hoạt sử dụng.', '3900000', 'Tai nghe Bluetooth Apple AirPods 279.PNG', 1, 0, NULL, NULL),
(15, 'Sạc nhanh 20W Apple MHJE3ZA', 1, 1, 'Công nghệ PD sạc cho các sản phẩm Apple nhanh chóng\r\nCổng Type-C công suất 20W giúp tiết kiệm nhiều thời gian\r\nThiết kế chuẩn thương hiệu Apple nhỏ gọn và sang trọng\r\nBảo vệ quá dòng, tránh hiện tượng chập mạch, quá nhiệt', 'Sạc nhanh Apple iPhone 20W Type-C PD MHJE3ZA chính hãng tiết kiệm tối đa thời gian sạc điện thoại\r\nNhanh chóng, tiết kiệm tối đa thời gian là những gì mà người dùng iPhone mong đợi ở chiếc sạc pin của mình. Để có thể làm được điều đó thì việc sử dụng củ sạc nhanh Apple iPhone 20W Type-C PD MHJE3ZA chính hãng là điều cần thiết mà bạn không nên bỏ qua.\r\n\r\nThiết kế nhỏ gọn, an toàn dòng điện\r\nCủ sạc nhanh Apple iPhone 20W Type-C PD MHJE3ZA chính hãng được thiết kế siêu nhỏ gọn, tinh tế giúp bạn có thể mang đến bất cứ nơi đâu. Chất liệu cao cấp cùng màu trắng nổi bật mang đến sự sang trọng và độ bền bỉ cùng với thời gian.\r\n\r\nCủ sạc còn có khả năng bảo vệ sản phẩm tránh quá dòng, quá điện áp hay hiện tượng mạch điện bị chập và quá nhiệt trong quá trình sạc. Sản phẩm được kiểm định khắt khe và được cấp chứng chỉ an toàn cháy nổ: ROSH, CE, FCC giúp đảm đảm an toàn cho người sử dụng.', '890000', 'Sạc nhanh 20W Apple MHJE3ZA1.PNG', 1, 0, NULL, NULL),
(16, 'Bút cảm ứng Apple Pencil 2 MU8F2', 1, 1, 'Thiết kế đơn giản tinh tế với gam màu trắng kích thước chiều dài 16.6 cm và trọng lượng 20.7 g\r\nKết nối không dây Bluetooth với iPad cho cảm giác sử dụng tương tự bút thông dụng\r\nSạc pin nam châm từ tính ngay trên thiết bị Ipad, sạc đầy trong 45 phút, sử dụng đến 4 giờ\r\nCông nghệ cảm ứng lực nhấn cho độ trễ thấp, độ nhạy và chính xác cao\r\nDễ dàng thao tác chuyển đổi công cụ bút bằng cảm ứng trên thân bút', 'Bút cảm ứng Apple Pencil 2 – Cải tiến sâu, nâng cao trải nghiệm người dùng\r\nSau sự ủng hộ của người dùng về bút cảm ứng Apple Pencil, phụ kiện Apple đã tiếp tục cho ra mắt Apple Pencil thế hệ thứ hai với tên gọi bút cảm ứng Apple Pencil 2. Nhận được sự kế thừa của người tiền nhiệm cùng những nâng cấp quý giá, bút cảm ứng Apple Pencil 2 xứng đáng là phụ kiện đồ chơi công nghệ không thể thiếu khi người dùng đang sở hữu một chiếc iPad.\r\n\r\nThiết kế đơn giản thuần của một chiếc bút chì cùng trọng lượng nhẹ 20.7 gram\r\nVề kiểu dáng, bút cảm ứng Apple Pencil 2 có thiết kế giống như một chiếc bút chì bình thường. Với  chiều dài 6,53 inch (166 mm), đường kính 0,35 inch (8,9 mm) và trọng lượng 20,7 gram, Apple Pencil 2 đem lại khả năng cầm chắc tay, nhẹ nhàng, linh hoạt khi viết. Với sắc trắng nổi bật của phụ kiện cùng với hình dạng như một cây bút chì truyền thống, thon dài cùng trọng lượng nhẹ, mang lại cho người dùng cảm giác cầm vừa tay và thoải mái khi sử dụng.Kiểm soát hoàn toàn bút cảm ứng Apple Pencil 2 bằng đơn giản hóa việc sạc, việc cất giữ\r\nTheo như người dùng biết, ở thế hệ đầu, Apple Pencil 1 được sạc bằng cổng lightning vào thiết bị iPad. Điều này khiến cho độ thẩm mỹ, cũng như khiến cho máy rất cồng kềnh. Nhận biết được điều đó, Apple Pencil 2 được cải tiến thành chiếc bút sạc không dây thông qua nam châm, điểm nâng cấp sáng giá.', '3190000', 'Bút cảm ứng Apple Pencil 2 MU8F280.PNG', 1, 11, NULL, NULL),
(17, 'Cáp sạc Apple Watch Magnetic MX2E2ZA 1M', 1, 1, 'Cáp được thiết kế dành riêng cho các dòng Apple Watch\r\nTích hợp công nghệ sạc MagSafe như trên các đời máy Mac, đảm bảo sạc an toàn cho Apple Watch\r\nChỉ cần để gần thiết bị, đầu sạc có nam châm sẽ tự hít vào thiết bị và bắt đầu sạc\r\nChiều dài 1m tiện lợi dùng sạc cho Apple Watch ở nhiều vị trí\r\nSản phẩm cáp sạc chính hãng Apple Việt Nam', 'Cáp sạc Apple Watch Magnetic MX2E2ZA 1m - Đơn giản và tinh tế\r\nĐể nạp năng lượng nhanh chóng và tiện lợi nhất cho chiếc Apple Watch hiện đại, chắc chắn bạn sẽ cần đến cáp sạc Apple Watch Magnetic MX2E2ZA 1m. Được sản xuất chính hãng bởi Apple, giúp cho mọi người cảm thấy an tâm hơn rất nhiều.\r\n\r\nTinh tế, gọn gàng và dễ dàng mang đi\r\nThiết kế thanh lịch với màu trắng được phủ bao quanh là hướng thiết kế đặc trưng của Apple. Vì vậy, không ít người dùng ưa chuộng cáp sạc Apple Watch Magnetic MX2E2ZA 1m này.', '790000', 'Cáp sạc Apple Watch Magnetic MX2E2ZA 1M70.PNG', 0, 0, NULL, NULL),
(18, 'Ốp lưng Samsung Galaxy S23 Ultra Silicone', 32, 3, 'Ốp lưng Samsung Galaxy S23 Ultra Silicone Navy là một trong số những phụ kiện được ra mắt chính thức dành cho điện thoại Samsung Galaxy S23 Ultra. Sự tinh tế của chiếc ốp lưng Samsung Galaxy S23 Series này sẽ giúp cho điện thoại khoe trọn vẹn được toàn bộ thiết kế.', 'Chất liệu silicone siêu bền bỉ\r\nĐược thiết kế với kích thước vừa vặn, ốp lưng Samsung Galaxy S23 Ultra Silicone Navy có thể ôm trọn vẹn và sát với viền máy. Với sự bo cong và bao bọc 4 góc một cách hoàn thiện, ốp lưng silicone đã có thể bảo vệ được Smartphone Galaxy S23 Ultra một các an toàn và tốt nhất.Thiết kế sang trọng, dễ cầm nắm\r\nỐp lưng Samsung Galaxy S23 Ultra Silicone Navy vẫn sẽ được giữ nguyên thiết kế sang trọng và vốn có như ở phiên bản tiền nhiệm. Để hoàn thiện thêm thì vỏ máy sẽ có thiết kế với những đường đường gô bảo vệ, tránh ảnh hưởng đến ốp lưng và cả camera của máy.', '230000', 'Ốp lưng Samsung Galaxy S23 Ultra Silicone57.PNG', 1, 29, NULL, NULL),
(19, 'Ốp lưng Samsung Galaxy S23 Ultra Araree Flexield', 32, 3, 'Ốp lưng Samsung Galaxy S23 Ultra Araree Flexield được chế tác từ chất liệu bền bỉ với thiết kế tiên tiến chắc chắn sẽ bảo vệ toàn diện cho chiếc smartphone của bạn. Bên cạnh hiệu quả bảo vệ tối ưu, chiếc ốp lưng Samsung Galaxy S23 Series còn sở hữu kiểu dáng thanh lịch giúp ngoại hình điện thoại thêm phần bắt mắt.', 'Sở hữu kiểu dáng bắt mắt và tiện lợi.Bảo vệ tối ưu với chất liệu bền bỉ và thiết kế thông minh', '250000', 'Ốp lưng Samsung Galaxy S23 Ultra Araree Flexield78.PNG', 1, 48, NULL, NULL),
(25, 'd', 36, 33, NULL, NULL, '12', 'gallery367.jpg', 0, 1, NULL, NULL),
(26, 'd', 36, 34, NULL, NULL, '123', 'gallery377.jpg', 0, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotional_products`
--

CREATE TABLE `promotional_products` (
  `pp_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_note` text DEFAULT NULL,
  `shipping_name` varchar(255) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `customer_id`, `shipping_note`, `shipping_name`, `shipping_phone`, `shipping_address`, `created_at`, `updated_at`) VALUES
(1, 0, 'ffff', 'Thanh Thanh', '0799786319', '12/3 an', NULL, NULL),
(4, 3, 'không có', 'Thanh Trúc', '012878372', 'Cần Thơ', NULL, NULL),
(6, 5, NULL, 'Thanh Thanh', '0799786319', '12/3, an', NULL, NULL),
(7, 5, NULL, 'Thanh Thanh', '0799786319', '12/3, an', NULL, NULL),
(8, 6, NULL, 'Hùng', '0163726334', 'Cần Thơ', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `shipping_id` (`shipping_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`orderDetail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `promotional_products`
--
ALTER TABLE `promotional_products`
  ADD PRIMARY KEY (`pp_id`);

--
-- Chỉ mục cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `orderDetail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `promotional_products`
--
ALTER TABLE `promotional_products`
  MODIFY `pp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`shipping_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
