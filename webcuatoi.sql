-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 04:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webcuatoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `ID` int(11) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ID`, `Name`, `Email`, `Password`, `Level`) VALUES
(4, 'Nguyễn Kim Hùng', 'lehauok04@gmail.com', '123', 1),
(5, 'Nguyễn Kim Hùng', 'lehau@gmail.com', '123', 0),
(6, 'phuc', 'phuc@gmail.com', '11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `status`) VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`) VALUES
(1, 'Giày Nice', 1),
(2, 'Addidas', 1),
(3, 'Giày Converse All Star', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chitietdh`
--

CREATE TABLE `chitietdh` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitietdh`
--

INSERT INTO `chitietdh` (`id`, `order_id`, `product_id`, `quantity`, `price`, `image`, `product_name`, `total`) VALUES
(1, 1, NULL, 5, 55555555, NULL, '', 0),
(2, 1, NULL, 2, 3829000, NULL, '', 0),
(3, 2, NULL, 1, 55555555, NULL, '', 0),
(4, 40, NULL, 1, 2815199, NULL, 'Nike Dunk Low Next Nature SE', 2815199),
(5, 40, NULL, 2, 1909000, NULL, 'Nike Court Vision Low Tiếp theo Thiên nhiên', 3818000),
(6, 40, NULL, 4, 3519000, NULL, 'Nike Dunk Low Retro SE Da/Da lộn', 14076000),
(7, 41, NULL, 1, 2815199, NULL, 'Nike Dunk Low Next Nature SE', 2815199),
(8, 41, NULL, 2, 1909000, NULL, 'Nike Court Vision Low Tiếp theo Thiên nhiên', 3818000),
(9, 41, NULL, 4, 3519000, NULL, 'Nike Dunk Low Retro SE Da/Da lộn', 14076000),
(10, 42, NULL, 1, 2815199, NULL, 'Nike Dunk Low Next Nature SE', 2815199),
(11, 42, NULL, 2, 1909000, NULL, 'Nike Court Vision Low Tiếp theo Thiên nhiên', 3818000),
(12, 42, NULL, 4, 3519000, NULL, 'Nike Dunk Low Retro SE Da/Da lộn', 14076000),
(13, 43, NULL, 1, 2815199, NULL, 'Nike Dunk Low Next Nature SE', 2815199),
(14, 43, NULL, 2, 1909000, NULL, 'Nike Court Vision Low Tiếp theo Thiên nhiên', 3818000),
(15, 43, NULL, 4, 3519000, NULL, 'Nike Dunk Low Retro SE Da/Da lộn', 14076000),
(16, 43, NULL, 1, 3959000, NULL, 'Giày Nike Dunk Cao Cổ Điển SE', 3959000),
(17, 44, NULL, 1, 2815199, NULL, 'Nike Dunk Low Next Nature SE', 2815199),
(18, 44, NULL, 2, 1909000, NULL, 'Nike Court Vision Low Tiếp theo Thiên nhiên', 3818000),
(19, 44, NULL, 4, 3519000, NULL, 'Nike Dunk Low Retro SE Da/Da lộn', 14076000),
(20, 44, NULL, 1, 3959000, NULL, 'Giày Nike Dunk Cao Cổ Điển SE', 3959000);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dssanpham`
--

CREATE TABLE `dssanpham` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `brandid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dssanpham`
--

INSERT INTO `dssanpham` (`id`, `image`, `name`, `price`, `description`, `brandid`, `status`) VALUES
(43, '1731511924_1.png', 'Nike Dunk thấp', 2680299.00, 'Được tạo ra cho sân gỗ cứng nhưng được đưa ra đường phố, biểu tượng bóng rổ thập niên 80 này trở lại với các chi tiết cổ điển và phong cách bóng rổ hoài cổ. Lớp phủ bằng da tổng hợp giúp Nike Dunk mang phong cách cổ điển trong khi cổ áo có đệm, cổ thấp cho phép bạn chơi ở bất cứ đâu—một cách thoải mái.\r\n- Màu sắc hiển thị: Bụi Photon/Trắng/Bóng ma/Đá Obsidian\r\n- Kiểu dáng: HF4299-001\r\n- Quốc gia/Khu vực xuất xứ: Indonesia', 1, 1),
(44, '1731512256_2.png', 'Giày Nike Dunk Low Retro', 2343199.00, 'Nhận ra nguồn gốc của Dunk là đôi giày thể thao của đội tuyển đại học hàng đầu, Be True To Your School Pack lấy cảm hứng từ chiến dịch quảng cáo gốc. Màu sắc đại diện cho các trường đại học hàng đầu, trong khi da thật có độ bóng hoàn hảo để giúp chúng trở thành chiến thắng dễ dàng. Vậy hãy xỏ dây giày và thể hiện tinh thần đại học của bạn. Bạn có muốn chơi không?\r\n\r\n- Màu sắc hiển thị: Trắng/Trắng/Viotech\r\n- Kiểu dáng: DV0833-107\r\n- Quốc gia/Khu vực xuất xứ: Indonesia', 1, 1),
(45, '1731512501_3.png', 'Nike Dunk Low Next Nature SE', 2815199.00, 'Dunk trở lại với thiết kế cổ điển, phong cách vòng tròn hoài cổ và màu sắc theo mùa. Mang phong cách thập niên 80 trở lại đường phố, cổ giày có đệm, cổ thấp cho phép bạn chơi ở bất cứ đâu—một cách thoải mái. Thêm vào đó, phiên bản đặc biệt này bao gồm các chi tiết kim loại để bạn có thể cá nhân hóa đôi giày của mình.\r\n\r\nMàu sắc hiển thị: Thủy tinh biển/Xanh lá cây hơi nước/Cánh buồm/Bạc nhạt\r\nKiểu dáng: FN6344-001\r\nQuốc gia/Khu vực xuất xứ: Việt Nam', 1, 1),
(46, '1731512544_7.png', 'Giày Nike Dunk Cao Cổ Điển SE', 3959000.00, 'Bạn luôn có thể tin tưởng vào một đôi giày cổ điển. Vẻ ngoài cổ điển kết hợp với lớp đệm sang trọng mang đến sự thoải mái vượt trội và lâu dài. Khả năng là vô tận—bạn sẽ mang giày Dunks của mình như thế nào?\r\n\r\n- Màu sắc hiển thị: Phantom/Nâu ngà/Vàng -kẹo cao su/Xanh đua\r\n- Kiểu dáng: FV6612-001\r\n- Quốc gia/Khu vực xuất xứ: Việt Nam', 1, 1),
(47, '1731512740_6.png', 'Giày Air Jordan 1 Thấp', 3239006.00, 'Lấy cảm hứng từ phi&ecirc;n bản gốc ra mắt năm 1985, Air Jordan 1 Low mang đến vẻ ngo&agrave;i sạch sẽ, cổ điển, quen thuộc nhưng lu&ocirc;n mới mẻ. Với thiết kế mang t&iacute;nh biểu tượng kết hợp ho&agrave;n hảo với mọi &#39;fit&#39;, đ&ocirc;i gi&agrave;y n&agrave;y đảm bảo bạn sẽ lu&ocirc;n đ&uacute;ng phong c&aacute;ch.<br />\r\n&nbsp;\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị:&nbsp;Trắng/Trắng/Đen</li>\r\n	<li>Kiểu d&aacute;ng:&nbsp;553558-132</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>\r\n', 1, 1),
(48, '1731512817_4.png', 'Nike Court Vision thấp', 2069000.00, 'Bạn y&ecirc;u th&iacute;ch phong c&aacute;ch b&oacute;ng rổ cổ điển của thập ni&ecirc;n 80 nhưng lại th&iacute;ch nền văn h&oacute;a nhanh của tr&ograve; chơi ng&agrave;y nay? H&atilde;y xem Court Vision Low. Một phi&ecirc;n bản cổ điển được phối lại, phần tr&ecirc;n sắc n&eacute;t v&agrave; lớp phủ kh&acirc;u giữ nguy&ecirc;n linh hồn của phong c&aacute;ch ban đầu. Cổ &aacute;o sang trọng, cắt thấp gi&uacute;p giữ cho n&oacute; b&oacute;ng bẩy v&agrave; thoải m&aacute;i cho thế giới của bạn.<br />\r\n&nbsp;\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị:&nbsp;Sail/Light Orewood Brown/White/Black</li>\r\n	<li>Kiểu d&aacute;ng:&nbsp;FQ8075-133</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Ấn Độ</li>\r\n</ul>\r\n', 1, 1),
(49, '1731513186_12.png', 'Jordan Nu Retro 1 Thấp', 3089000.00, '<p>Hai mươi năm sau v&agrave; đ&ocirc;i gi&agrave;y cổ thấp n&agrave;y đ&atilde; trở lại. Lấy cảm hứng từ logo Wings ban đầu v&agrave; thiết kế của Jordan 1, đ&ocirc;i gi&agrave;y d&ugrave;ng cả ng&agrave;y, h&agrave;ng ng&agrave;y n&agrave;y đ&atilde; sẵn s&agrave;ng cho mọi thứ. Mặc ch&uacute;ng với quần jeans rộng th&ugrave;ng th&igrave;nh, đi gi&agrave;y trượt v&aacute;n hoặc chỉ cần tr&ocirc;ng thật ngầu&mdash;t&ugrave;y bạn. Phần tr&ecirc;n bằng da mịn v&agrave; logo nổi lớn sẽ gi&uacute;p bạn nổi bật d&ugrave; bạn ăn mặc giản dị hay sang trọng.<br />\r\nChi tiết sản phẩm</p>\r\n\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị: Trắng/Palomino/Trắng/Đen</li>\r\n	<li>Kiểu d&aacute;ng: DV5141-102</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>\r\n', 1, 1),
(50, '1731512995_n7.png', 'Nike Ebernon thấp cao cấp', 1239000.00, 'Sự rạng rỡ vẫn tồn tại với bản gốc b&oacute;ng rổ. Kết hợp sự thoải m&aacute;i của s&agrave;n gỗ cứng với phong c&aacute;ch ngo&agrave;i s&acirc;n đấu, mang đến sự tươi mới cho những g&igrave; bạn biết r&otilde; nhất: kết cấu lấy cảm hứng từ thập ni&ecirc;n 80, c&aacute;c chi tiết t&aacute;o bạo v&agrave; phong c&aacute;ch kh&ocirc;ng g&igrave; kh&aacute;c ngo&agrave;i lưới.<br />\r\n&nbsp;\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị:&nbsp;Đen/Đen/Trắng</li>\r\n	<li>Kiểu d&aacute;ng:&nbsp;DV0788-001</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>\r\n', 1, 1),
(51, '1731513057_9.png', 'Nike Dunk Low Retro SE Da/Da lộn', 3519000.00, 'Bạn lu&ocirc;n c&oacute; thể tin tưởng v&agrave;o một đ&ocirc;i gi&agrave;y cổ điển. Thiết kế phối m&agrave;u n&agrave;y kết hợp da v&agrave; da lộn với lớp đệm sang trọng để tạo sự thoải m&aacute;i vượt trội v&agrave; bền l&acirc;u. Khả năng l&agrave; v&ocirc; tận&mdash;bạn sẽ mang gi&agrave;y Dunk của m&igrave;nh như thế n&agrave;o?<br />\r\n<br />\r\nChi tiết sản phẩm\r\n<ul>\r\n	<li>2 bộ d&acirc;y gi&agrave;y</li>\r\n	<li>Cổ &aacute;o c&oacute; đệm</li>\r\n	<li>M&agrave;u sắc hiển thị: Trắng/Trắng/V&agrave;ng đội</li>\r\n	<li>Kiểu d&aacute;ng: FQ8249-102</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>\r\n', 1, 1),
(52, '1731513115_10.png', 'Nike Dunk Low Retro Cao Cấp', 22519000.00, 'Được tạo ra cho s&acirc;n gỗ cứng nhưng được đưa ra đường phố, biểu tượng b&oacute;ng rổ thập ni&ecirc;n 80 trở lại với c&aacute;c chi tiết cổ điển v&agrave; phong c&aacute;ch b&oacute;ng rổ ho&agrave;i cổ. Mang phong c&aacute;ch cổ điển trở lại đường phố, cổ &aacute;o c&oacute; đệm, cổ thấp cho ph&eacute;p bạn chơi tr&ograve; chơi của m&igrave;nh ở bất cứ đ&acirc;u&mdash;một c&aacute;ch thoải m&aacute;i.<br />\r\n&nbsp;\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị:&nbsp;Đ&aacute; bọt nhạt/Đ&aacute; Obsidian đậm/Sữa dừa/Sương gi&aacute; xanh</li>\r\n	<li>Kiểu d&aacute;ng:&nbsp;FB8895-001</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>\r\n', 1, 1),
(53, '1731513648_NIKE+ZOOM+VOMERO+5.jpg', 'Nike Court Vision Low Tiếp theo Thiên nhiên', 1909000.00, '<p>H&atilde;y l&agrave;m quen với Nike Court Vision Low Next Nature. Được l&agrave;m từ &iacute;t nhất 20% vật liệu t&aacute;i chế theo trọng lượng, phần tr&ecirc;n sắc n&eacute;t v&agrave; lớp phủ kh&acirc;u được lấy cảm hứng từ những ng&agrave;y của c&uacute; đ&aacute;nh m&oacute;c v&agrave; vớ ống. Cổ gi&agrave;y c&oacute; đệm v&agrave; đế ngo&agrave;i bằng cao su mang lại sự thoải m&aacute;i v&agrave; lực k&eacute;o cho thế giới của bạn.<br />\r\n&nbsp;</p>\r\n\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị:&nbsp;Trắng/Hồng Oxford</li>\r\n	<li>Kiểu d&aacute;ng:&nbsp;DH3158-102</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Indonesia, Ấn Độ, Việt Nam</li>\r\n</ul>\r\n', 1, 1),
(54, '1731513402_NIKE+C1TY.jpg', 'Nike C1TY Surplus', 2929000.00, 'Nike C1TY được thiết kế để vượt qua mọi thứ m&agrave; th&agrave;nh phố mang đến cho bạn. Th&acirc;n gi&agrave;y bằng lưới gi&uacute;p vừa vặn, tho&aacute;ng kh&iacute;, trong khi phần h&ocirc;ng v&agrave; mũi gi&agrave;y được gia cố gi&uacute;p bảo vệ đ&ocirc;i ch&acirc;n của bạn khỏi c&aacute;c yếu tố thời tiết. Phi&ecirc;n bản n&agrave;y lấy cảm hứng từ m&agrave;u sắc của quần &aacute;o tactical surplus&mdash;mang đến cho phong c&aacute;ch đường phố một &yacute; nghĩa ho&agrave;n to&agrave;n mới.<br />\r\n&nbsp;\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị:&nbsp;Light Army/Cargo Khaki/University Gold/Black</li>\r\n	<li>Kiểu d&aacute;ng:&nbsp;FZ3863-300</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Ấn Độ</li>\r\n</ul>\r\n', 1, 1),
(55, '1731513489_W+NIKE+ZOOM+VOMERO+5.png', 'Giày Nike Zoom Vomero 5', 4699000.00, 'H&atilde;y tạo cho m&igrave;nh một l&agrave;n đường mới trong Zoom Vomero 5&mdash;sự lựa chọn của bạn cho sự phức tạp, chiều s&acirc;u v&agrave; b&acirc;y giờ l&agrave; kiểu d&aacute;ng dễ d&agrave;ng. Thiết kế nhiều lớp phong ph&uacute; bao gồm c&aacute;c điểm nhấn bằng vải, da v&agrave; nhựa kết hợp với nhau để tạo n&ecirc;n một trong những đ&ocirc;i gi&agrave;y thể thao tuyệt vời nhất của m&ugrave;a n&agrave;y. Đ&acirc;y l&agrave; c&acirc;u chuyện t&igrave;nh y&ecirc;u thực sự giữa c&ocirc;ng nghệ v&agrave; sự giản dị.<br />\r\n&nbsp;\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị:&nbsp;Ng&agrave; nhạt/Ng&agrave; nhạt/Tr&ocirc;i c&aacute;t/Ng&agrave; nhạt</li>\r\n	<li>Kiểu d&aacute;ng:&nbsp;FQ6868-111</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Trung Quốc</li>\r\n</ul>\r\n', 1, 1),
(56, '1731513554_ACG+WATERCAT+.png', 'Giày Nike ACG Watercat+', 3669000.00, 'Những ch&uacute; m&egrave;o n&agrave;y kh&ocirc;ng sợ bị ướt. Th&iacute;ch d&agrave;nh nhiều thời gian để t&eacute; nước hơn l&agrave; kh&ocirc;ng, Watercat+ kh&ocirc; nhanh đưa bạn đến m&eacute;p nước v&agrave; sang bờ b&ecirc;n kia. Ra đời từ lịch sử l&acirc;u đời của ch&uacute;ng t&ocirc;i về gi&agrave;y dệt, phần tr&ecirc;n tối giản được chế t&aacute;c từ d&acirc;y kh&ocirc;ng thấm nước để tho&aacute;ng kh&iacute; nhẹ. Ch&uacute;ng t&ocirc;i giữ nguy&ecirc;n hệ thống buộc d&acirc;y nhanh từ bản gốc trong khi cải thiện độ vừa vặn v&agrave; cấu tr&uacute;c tổng thể của gi&agrave;y để gi&uacute;p bạn lu&ocirc;n thoải m&aacute;i trong những ng&agrave;y d&agrave;i tr&ecirc;n s&ocirc;ng. V&agrave; v&igrave; đ&aacute; trơn v&agrave; đường m&ograve;n lầy lội về cơ bản l&agrave; c&ocirc;ng vi&ecirc;n nước của thi&ecirc;n nhi&ecirc;n, đế ngo&agrave;i bằng cao su hỗn hợp với c&aacute;c vấu lượn s&oacute;ng mang lại độ b&aacute;m tốt hơn c&aacute; m&uacute;t đ&aacute;. Khi ch&uacute;ng t&ocirc;i n&oacute;i mọi điều kiện, ch&uacute;ng t&ocirc;i c&oacute; nghĩa l&agrave; mọi điều kiện. V&igrave; vậy, h&atilde;y bước v&agrave;o d&ograve;ng nước - những đ&ocirc;i gi&agrave;y n&agrave;y được thiết kế để xử l&yacute; d&ograve;ng chảy.<br />\r\n&nbsp;\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị:&nbsp;Xanh ngọc lam denim/Xanh ngọc lam denim/Xanh navy Armory/Xanh băng gi&aacute;</li>\r\n	<li>Kiểu d&aacute;ng:&nbsp;CZ0931-400</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Việt Nam</li>\r\n</ul>\r\n', 1, 1),
(57, '1731513613_NIKE+AIR+MAX+2017.png', 'Giày Nike Air Max 2017', 5869000.00, 'Nike Air Max 2017 mang đến cảm gi&aacute;c &ecirc;m &aacute;i m&agrave; bạn y&ecirc;u th&iacute;ch với bộ Max Air to&agrave;n chiều d&agrave;i. Phần tr&ecirc;n được thiết kế liền mạch với khả năng hỗ trợ theo v&ugrave;ng v&agrave; th&ocirc;ng gi&oacute; trong khi lớp bọt đ&uacute;c bao quanh giữa b&agrave;n ch&acirc;n v&agrave; g&oacute;t ch&acirc;n của bạn để mang lại sự thoải m&aacute;i an to&agrave;n.<br />\r\n&nbsp;\r\n<ul>\r\n	<li>M&agrave;u sắc hiển thị:&nbsp;Trắng/Bạch kim nguy&ecirc;n chất/Đen</li>\r\n	<li>Kiểu d&aacute;ng:&nbsp;849559-100</li>\r\n	<li>Quốc gia/Khu vực xuất xứ: Trung Quốc</li>\r\n</ul>\r\n', 1, 1),
(58, '1731513914_M9622C-1.webp', 'Giày Unisex Converse Chuck Taylor All Star', 1021000.00, '<p>Bắt đầu từ những năm 1917, đ&ocirc;i gi&agrave;y cổ cao Converse Chuck Taylor All Star đ&atilde; trở th&agrave;nh biểu tượng thời trang của to&agrave;n cầu với c&aacute;c chi tiết đặc trưng &ndash; th&acirc;n gi&agrave;y bằng vải canvas, mũi gi&agrave;y hoa văn kim cương v&agrave; logo Chuck Taylor ở mắt c&aacute; ch&acirc;n đ&atilde; mang lại sự phối hợp ho&agrave;n hảo về kiểu d&aacute;ng cũng như độ bền bỉ của d&ocirc;i gi&agrave;y n&agrave;y. Gi&agrave;y được t&iacute;ch hợp lớp đế l&oacute;t OrthoLite mang lại sự &ecirc;m &aacute;i cho b&agrave;n ch&acirc;n. Đơn giản nhưng lu&ocirc;n phong c&aacute;ch.</p>\r\n\r\n<p><strong>TH&Ocirc;NG SỐ</strong></p>\r\n\r\n<ul>\r\n	<li>Gi&agrave;y sneaker cổ cao với chất liệu vải canvas cổ điển</li>\r\n	<li>Kiểu d&aacute;ng mang t&iacute;nh biểu tượng</li>\r\n	<li>Logo Chuck Taylor ở mắt c&aacute;</li>\r\n	<li>Đế l&oacute;t OrthoLite mang lại sự thoải m&aacute;i</li>\r\n	<li>Mũi gi&agrave;y với họa tiết kim cương</li>\r\n	<li>M&atilde; sản phẩm: M9622C</li>\r\n</ul>\r\n', 3, 1),
(59, '1731514018_168817C-1.webp', 'Giày Unisex Converse Run Star Hike', 1466000.00, '<p>Một sự ph&aacute;t triển thiết kế của Chuck Taylor All Star đến từ thương hiệu Converse, đ&ocirc;i gi&agrave;y lấy cảm hứng từ gi&agrave;y đi bộ đường d&agrave;i, nổi bật với phần đế được thiết kế v&ocirc; c&ugrave;ng độc đ&aacute;o.&nbsp;</p>\r\n<strong>TH&Ocirc;NG SỐ</strong>\r\n\r\n<ul>\r\n	<li>Phần tr&ecirc;n bằng vải&nbsp;</li>\r\n	<li>Lưỡi Accordion cho độ ổn định cao hơn</li>\r\n	<li>Đế l&oacute;t Ortholite tạo sự thoải m&aacute;i</li>\r\n	<li>Đế giữa EVA kết hợp với đế ngo&agrave;i c&oacute; kiểu d&aacute;ng m&aacute;y k&eacute;o&nbsp;</li>\r\n	<li>M&atilde; sản phẩm:&nbsp;168817C</li>\r\n</ul>\r\n', 3, 1),
(60, '1731514085_A06806C-1.webp', 'Giày  Unisex Converse As-1 Pro - Nâu', 1533000.00, '<p>Trải nghiệm mẫu gi&agrave;y trượt v&aacute;n ti&ecirc;n phong nhất từ CONS, được tạo ra bởi một trong những vận động vi&ecirc;n trượt v&aacute;n h&agrave;ng đầu thế giới, Alexis Sablone - AS-1 Pro. Với sự ảnh hưởng của phong c&aacute;ch cổ điển, nhưng với c&aacute;c t&iacute;nh năng ho&agrave;n to&agrave;n mới mẻ, mục ti&ecirc;u ch&iacute;nh của sản phẩm n&agrave;y l&agrave; tạo ra một đ&ocirc;i gi&agrave;y trượt v&aacute;n kiểu cupsole ho&agrave;n to&agrave;n kh&aacute;c biệt so với những sản phẩm trước đ&acirc;y. Hệ thống lỗ gắn tr&ecirc;n gi&agrave;y gi&uacute;p tăng t&iacute;nh bền của sản phẩm. Để cung cấp sự cảm gi&aacute;c tốt nhất khi tiếp x&uacute;c với v&aacute;n, hệ thống chống sốc được ph&acirc;n phối đều khắp đế gi&agrave;y, vượt ra khỏi lớp đệm b&ecirc;n trong. Kết th&uacute;c với đế ngo&agrave;i herringbone tạo độ b&aacute;m tối đa, đem đến sự kiểm so&aacute;t tốt ngay cả khi bạn mới mua gi&agrave;y.</p>\r\n<strong>TH&Ocirc;NG SỐ</strong>\r\n\r\n<ul>\r\n	<li>Đ&ocirc;i gi&agrave;y thấp với upper bằng vải da lộn bền, th&iacute;ch hợp cho trượt v&aacute;n</li>\r\n	<li>Lớp đệm CX Foam gi&uacute;p bảo vệ khỏi t&aacute;c động của trượt v&aacute;n, mang lại sự thoải m&aacute;i v&agrave; an to&agrave;n.</li>\r\n	<li>Đế ngo&agrave;i với hoa văn herringbone tạo độ b&aacute;m tối đa, gi&uacute;p bạn kiểm so&aacute;t v&aacute;n trượt tốt hơn</li>\r\n	<li>D&acirc;y gi&agrave;y bằng vải cotton bền bỉ, th&iacute;ch hợp cho mọi hoạt động trượt v&aacute;n.</li>\r\n	<li>M&atilde; sản phẩm: A06806C</li>\r\n</ul>\r\n', 3, 1),
(61, '1731514151_A05519C-1.webp', 'Giày Converse Pro Blaze Strap - Xanh Dương', 900000.00, '<p>Converse Pro Blaze Strap Trẻ Em l&agrave; một điểm nhấn s&aacute;ng tạo cho thời trang của b&eacute; y&ecirc;u. Đ&ocirc;i gi&agrave;y n&agrave;y đ&atilde; được điều chỉnh đặc biệt cho c&aacute;c b&eacute;, với c&aacute;c đường may mềm mại v&agrave; tối ưu h&oacute;a sự thoải m&aacute;i. Upper bằng da với ng&ocirc;i sao Chevron m&agrave;u s&aacute;ng tạo điểm nhấn cũng như cải thiện độ bền của sản phẩm. Lưỡi gi&agrave;y co gi&atilde;n v&agrave; d&acirc;y đeo mắt c&aacute; ch&acirc;n c&oacute; thể điều chỉnh gi&uacute;p b&eacute; dễ d&agrave;ng mang v&agrave; cởi gi&agrave;y.</p>\r\n<strong>TH&Ocirc;NG SỐ</strong>\r\n\r\n<ul>\r\n	<li>Đ&ocirc;i gi&agrave;y cao cổ với upper bằng da chất lượng, thể hiện sự thời thượng v&agrave; độ bền.</li>\r\n	<li>D&acirc;y đeo c&oacute; thể điều chỉnh gi&uacute;p bạn tạo sự vừa vặn cho b&eacute;.</li>\r\n	<li>Lưỡi gi&agrave;y co gi&atilde;n gi&uacute;p b&eacute; dễ d&agrave;ng mang v&agrave; cởi gi&agrave;y.</li>\r\n	<li>Logo Converse v&agrave; ng&ocirc;i sao Chevron m&agrave;u s&aacute;ng lấp l&aacute;nh tạo điểm nhấn cho diện mạo của b&eacute;.</li>\r\n	<li>Lớp đệm foam mềm mại gi&uacute;p b&eacute; cảm thấy thoải m&aacute;i suốt cả ng&agrave;y.</li>\r\n	<li>M&atilde; sản phẩm: A05519C</li>\r\n</ul>\r\n', 3, 1),
(62, '1731514246_A04524C-1.webp', 'Giày Unisex  Chuck Taylor All Star Cruise ', 1667000.00, '<p>Giới thiệu sản phẩm mới nhất trong di sản Chuck Taylor: Chuck Taylor All Star. Được thiết kế để b&agrave;y tỏ l&ograve;ng k&iacute;nh trọng đối với thời trang phản văn h&oacute;a, n&oacute; kết hợp phần tr&ecirc;n bằng vải bạt cổ điển với c&aacute;c yếu tố lấy cảm hứng từ gi&agrave;y trượt băng, chẳng hạn như lớp phủ bằng da lộn. Đế giữa được thiết kế ph&aacute; c&aacute;ch với nhiều lớp tạo th&ecirc;m sự nổi bật m&agrave; kh&ocirc;ng l&agrave;m mất đi phong c&aacute;ch đặc trưng của Converse.</p>\r\n\r\n<p><strong>TH&Ocirc;NG SỐ</strong></p>\r\n\r\n<ul>\r\n	<li>Gi&agrave;y cổ cao với phần tr&ecirc;n bằng vải cotton 12oz</li>\r\n	<li>Lưỡi g&agrave; bằng vải canvas/da lộn t&aacute;ch rời v&agrave; lớp phủ da lộn để tăng độ bền v&agrave; phong c&aacute;ch</li>\r\n	<li>Đệm OrthoLite cho thoải m&aacute;i cả ng&agrave;y</li>\r\n	<li>Đế ngo&agrave;i được bơm EVA nhẹ với đế giữa bằng bọt &ecirc;m &aacute;i</li>\r\n	<li>M&atilde; sản phẩm: A04688C</li>\r\n</ul>\r\n', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leve`
--

CREATE TABLE `leve` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leve`
--

INSERT INTO `leve` (`id`, `username`, `password`, `level`, `email`) VALUES
(18, 'devilsabo1808', '123123', 1, 'lehaueok04@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `productid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ordermethodid` int(11) NOT NULL,
  `membeid` int(11) NOT NULL,
  `orderdate` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: chua xu ly; 2:dang xu ly; 3:da xu ly; 4: huy',
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ttkh`
--

CREATE TABLE `ttkh` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ttkh`
--

INSERT INTO `ttkh` (`id`, `fullname`, `phone`, `address`, `total`, `created_at`, `status`) VALUES
(1, 'nguyenhhung', '0397141150', 'daklak', 285435775, '2024-11-12 15:31:51', 1),
(2, 'nguyenhhung1111', '0397141150', 'hhh', 55555555, '2024-11-12 15:35:09', 2),
(3, 'phúc', '0397141150', 'namlac', 174444442, '2024-11-12 16:00:48', 1),
(4, 'phúc', '0397141150', 'namlac', 174444442, '2024-11-12 16:01:41', 1),
(5, 'phúc111', '0397141150', 'dddđ', 174444442, '2024-11-12 16:03:02', 1),
(6, 'hùng', '0397141150', 'đ', 174444442, '2024-11-12 16:07:05', 1),
(7, 'hùng', '0397141150', 'đ', 174444442, '2024-11-12 16:07:36', 1),
(8, 'hùng', '0397141150', 'hhh', 174444442, '2024-11-12 16:09:24', 1),
(9, 'hùng', '0397141150', 'hhh', 174444442, '2024-11-12 16:10:19', 1),
(10, 'hùng', '0397141150', 'đ', 174444442, '2024-11-12 16:10:24', 1),
(11, 'hùng', '0397141150', 'namlac', 174444442, '2024-11-12 16:12:32', 1),
(12, 'hùng', '0397141150', 'dđ', 174444442, '2024-11-12 16:18:49', 1),
(13, 'dsad', '0397141150', 'dddaa', 174444442, '2024-11-12 16:18:59', 1),
(14, 'phuc lỏ', '09392483742', 'daklak', 2343200, '2024-11-13 00:20:14', 1),
(15, 'huân', '06789533', 'daklak', 55555555, '2024-11-13 07:10:24', 1),
(16, 'hhhh', '76r65', 'hhhh', 155555555, '2024-11-13 09:46:44', 1),
(17, 'hung sào', '0397141150', 'ljkdjad', 2815199, '2024-11-14 08:00:09', 1),
(18, 'hung sào', '0894982342', 'dsadadad', 2815199, '2024-11-14 08:00:32', 1),
(19, 'hung sào', '0894982342', '2eqweqeee', 4724199, '2024-11-14 08:06:12', 1),
(20, 'hung sào', '0894982342', '12345', 6633199, '2024-11-14 08:11:57', 1),
(21, 'hung sào', '0894982342', '12345', 6633199, '2024-11-14 08:13:04', 1),
(22, 'dương tơ', '0397141150', 'đ323424', 6633199, '2024-11-14 08:13:19', 1),
(23, 'dương tơ', '0397141150', 'đây', 6633199, '2024-11-14 08:18:28', 1),
(24, 'dương tơ', '0397141150', 'đây', 6633199, '2024-11-14 08:23:07', 1),
(25, 'dương tơ', '0397141150', 'đây', 6633199, '2024-11-14 08:23:43', 1),
(26, 'dương tơ', '0397141150', 'đây', 6633199, '2024-11-14 08:27:14', 1),
(27, 'dương tơ', '0397141150', 'đây', 6633199, '2024-11-14 08:29:28', 1),
(28, 'dương tơ', '0397141150', 'nonoo', 6633199, '2024-11-14 08:29:44', 1),
(29, 'phúc đây này', '0397141150', 'daklak', 6633199, '2024-11-14 08:31:29', 1),
(30, 'phúc đây này', '0397141150', 'daklak', 6633199, '2024-11-14 08:32:01', 1),
(31, 'phúc đây này', '0397141150', '64564564', 10152199, '2024-11-14 08:32:19', 1),
(32, 'phúc đây này', '0397141150', '64564564', 10152199, '2024-11-14 08:33:20', 1),
(33, 'phúc đây này', '0397141150', '64564564', 10152199, '2024-11-14 08:33:39', 1),
(34, 'phúc đây này', '0397141150', '3333', 10152199, '2024-11-14 08:37:08', 1),
(35, 'phúc đây này1', '0397141150', '64564564', 10152199, '2024-11-14 08:38:18', 1),
(36, 'hùng', '0397141150', 'đ', 10152199, '2024-11-14 08:38:37', 1),
(37, 'chuyền', '0397141150', 'nonoo', 10152199, '2024-11-14 08:41:28', 1),
(38, 'chuyền', '0397141150', '777777777', 10152199, '2024-11-14 08:44:15', 1),
(39, 'chuyền', '0397141150', '44444', 20709199, '2024-11-14 09:03:46', 1),
(40, 'chuyền', '0397141150', 'nonoo', 20709199, '2024-11-14 09:04:36', 1),
(41, 'fesfds', 'fdsff', 'dsfsdf', 20709199, '2024-11-14 09:05:44', 1),
(42, 'hùng', '0397141150', 'đ', 20709199, '2024-11-14 09:08:28', 1),
(43, 'mèo', '0397141150', 'daklak', 24668199, '2024-11-14 09:11:39', 1),
(44, 'mèo', '0397141150', 'mô nam', 24668199, '2024-11-14 09:13:15', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitietdh`
--
ALTER TABLE `chitietdh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `dssanpham`
--
ALTER TABLE `dssanpham`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leve`
--
ALTER TABLE `leve`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ttkh`
--
ALTER TABLE `ttkh`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chitietdh`
--
ALTER TABLE `chitietdh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dssanpham`
--
ALTER TABLE `dssanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `leve`
--
ALTER TABLE `leve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ttkh`
--
ALTER TABLE `ttkh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdh`
--
ALTER TABLE `chitietdh`
  ADD CONSTRAINT `chitietdh_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ttkh` (`id`),
  ADD CONSTRAINT `chitietdh_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `dssanpham` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `dssanpham` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
