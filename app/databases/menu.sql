-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2019 at 04:43 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sosanhgia`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_category_id` int(11) NOT NULL,
  `menu_name` varchar(225) NOT NULL,
  `menu_icon` varchar(225) NOT NULL,
  `menu_description` varchar(500) NOT NULL,
  `menu_link` varchar(500) DEFAULT NULL,
  `menu_created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `menu_updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_category_id`, `menu_name`, `menu_icon`, `menu_description`, `menu_link`, `menu_created_time`, `menu_updated_time`) VALUES
(1, 3401, 'So sánh giá khách sạn', '2019_09_10_fzv1568102334.png', 'Khách sạn giá rẻ, uy tín', 'khachsan.websosanh.vn', '2019-09-10 04:08:46', '2019-09-11 03:55:46'),
(2, 607, 'So sánh dịch vụ tài chính', '2019_09_10_kre1568102368.png', 'Vay, thẻ tín dụng, thẻ ghi nợ...', 'websosanh.vn/tai-chinh.htm', '2019-09-10 04:08:46', '2019-09-11 03:56:01'),
(3, 3402, 'Khuyến mãi - Giảm giá', '2019_09_10_qho1568102377.png', 'Sản phẩm khuyến mãi, mã giảm giá', '/khuyen-mai-giam-gia/', '2019-09-10 04:08:46', '2019-09-11 03:56:22'),
(4, 2, 'Thiết bị gia dụng', '2019_09_10_iva1568102388.png', 'Đồ dùng gia đình, thiết bị điện', '/thiet-bi-gia-dung/cat-2.htm', '2019-09-10 04:08:46', '2019-09-11 03:56:36'),
(5, 1867, 'Điện lạnh', '2019_09_10_rrz1568102398.png', 'Điều hoà, tủ lạnh, máy giặt', '/dien-lanh/cat-1867.htm', '2019-09-10 04:08:46', '2019-09-11 03:56:51'),
(6, 85, 'Điện thoại - Máy tính bảng', '2019_09_10_qvo1568102406.png', 'Điện thoại, phụ kiện...', '/dien-thoai-may-tinh-bang/cat-85.htm', '2019-09-10 04:08:46', '2019-09-11 03:57:17'),
(7, 3, 'Thời trang - Mỹ phẩm', '2019_09_10_ihu1568102420.png', 'Thời trang nam - nữ, giày dép', '/thoi-trang-my-pham/cat-3.htm', '2019-09-10 04:08:46', '2019-09-11 03:57:37'),
(8, 20, 'Laptop - Linh phụ kiện', '2019_09_10_wyo1568102435.png', 'Laptop, máy tính để bàn', '/tin-hoc/cat-20.htm', '2019-09-10 04:08:46', '2019-09-11 03:58:35'),
(9, 1, 'Tivi - Âm thanh', '2019_09_10_qeh1568102443.png', 'Ti vi, dàn âm thanh, loa', '/tivi-am-thanh/cat-1.htm', '2019-09-10 04:08:46', '2019-09-11 03:58:47'),
(10, 13, 'Máy ảnh - Máy quay phim', '2019_09_10_tho1568102451.png', 'Máy ảnh DSLR, camera, lens', '/may-anh-may-quay-phim/cat-13.htm', '2019-09-10 04:08:46', '2019-09-11 03:59:02'),
(11, 119, 'Sản phẩm Mẹ & Bé', '2019_09_10_jzc1568102463.png', 'Sữa bột công thức, bỉm - tã', '/me-va-be/cat-119.htm', '2019-09-10 04:08:46', '2019-09-11 03:59:52'),
(12, 216, 'Sách', '2019_09_10_xxe1568102482.png', 'Sách Kinh tế, Ngoại ngữ...', '/sach/cat-216.htm', '2019-09-10 04:08:46', '2019-09-11 04:00:27'),
(13, 1980, 'Đồ thể thao', '2019_09_10_ieu1568102491.png', 'Giày thể thao và các loại bóng, gậy...', 'google.com', '2019-09-10 07:41:44', '2019-09-11 04:00:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
