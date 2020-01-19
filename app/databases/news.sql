-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 16, 2019 lúc 05:19 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sosanhgia`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `nes_id` int(11) NOT NULL,
  `nes_title` varchar(255) DEFAULT NULL,
  `nes_meta_title` varchar(255) NOT NULL,
  `nes_meta_keyword` varchar(255) NOT NULL,
  `nes_meta_description` varchar(255) NOT NULL,
  `nes_slug` varchar(255) DEFAULT NULL,
  `nes_description` varchar(255) DEFAULT NULL,
  `nes_content` text,
  `nes_image` varchar(255) DEFAULT NULL,
  `nes_type_id` int(11) NOT NULL,
  `nes_author_id` varchar(255) DEFAULT NULL,
  `nes_active` int(11) DEFAULT '0',
  `nes_views` int(11) DEFAULT '0',
  `nes_create_time` int(11) DEFAULT NULL,
  `nes_update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`nes_id`, `nes_title`, `nes_meta_title`, `nes_meta_keyword`, `nes_meta_description`, `nes_slug`, `nes_description`, `nes_content`, `nes_image`, `nes_type_id`, `nes_author_id`, `nes_active`, `nes_views`, `nes_create_time`, `nes_update_time`) VALUES
(30, 'Đánh giá bàn phím cơ DareU EK169 : Ngon – Bổ – Rẻ!', 'Máy tính bảng Ipad', 'Máy tính bảng Ipad', 'Đánh giá bàn phím cơ DareU EK169 : Ngon – Bổ – Rẻ!', 'danh-gia-ban-phim-co-dareu-ek169-ngon-bo-re', 'DareU EK169 là mẫu bàn phím cơ giá rẻ có 3 tùy chọn switch blue, brown và red, thiết kế switch đính nổi trên bề mặt phím hiện đại. Một món hời so với giá bán.', 'DareU EK169 là mẫu bàn phím cơ giá rẻ có 3 tùy chọn switch blue, brown và red, thiết kế switch đính nổi trên bề mặt phím hiện đại. Một món hời so với giá bán.', '2019_09_12_kea1568261916.jpg', 75, 'Vinh Quang Phùng', 1, 0, 1568198499, 1568261916),
(32, 'Dụng cụ học tập', 'Dụng cụ học tập', 'Dụng cụ học tập', 'Dụng cụ học tập', 'dung-cu-hoc-tap', 'Balo không còn đơn thuần chỉ để đựng sách vở, đồ dùng học tập hay tư trang cá nhân mà đã trở thành một phụ kiện làm đẹp của rất nhiều người. Tuy nhiên, không phải ai cũng có đủ điều kiện tài chính để sở hữu những chiếc balo đắt tiền. Hãy cùng tìm hiểu nhữ', '1 vấn đề không có gì mới. Ở nhà xem tivi khi thấy svđ nghi ngút khói và ánh lửa cũng phê thật, nhưng nếu ra sân và ngồi gần mấy ông cầm quả pháo sáng thì thú thật là hãi phải biết', '2019_09_12_uvz1568254462.png', 3328, 'Vinh Quang', 1, 0, 1568254805, 1568261234),
(33, 'Balo học sinh', 'Dụng cụ học tập', 'Dụng cụ học tập', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'balo-hoc-sinh', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', '2019_09_12_voi1568261509.jpg', 3329, 'Vinh Quang Phùng', 1, 0, 1568255033, 1568261509),
(34, 'Máy tính bảng Ipad djergnjhmktrh', 'Dụng cụ học tập', 'Dụng cụ học tập', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'may-tinh-bang-ipad-djergnjhmktrh', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', '2019_09_12_pnw1568259984.jpg', 3329, 'Vinh Quang Phùng', 1, 0, 1568255064, 1568259987),
(35, 'Máy tính bảng Ipad', 'Dụng cụ học tập', 'Dụng cụ học tập', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'may-tinh-bang-ipad', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', '2019_09_12_hac1568255143.jpg', 84, 'Vinh Quang Phùng', 0, 0, 1568255143, NULL),
(36, 'Làm thế nào để có thể bảo quản bàn phím tốt nhất?', 'Dụng cụ học tập', 'Dụng cụ học tập', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'lam-the-nao-de-co-the-bao-quan-ban-phim-tot-nhat', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', '2019_09_12_jsg1568255148.jpg', 21, 'Vinh Quang Phùng', 1, 0, 1568255148, 1568275267),
(37, 'sidelines vietnam community', 'Dụng cụ học tập', 'Dụng cụ học tập', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'sidelines-vietnam-community', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', '2019_09_12_ztd1568257753.jpg', 84, 'Vinh Quang Phùng', 1, 0, 1568255356, 1568257753),
(38, 'Máy tính bảng Ipad', 'Dụng cụ học tập', 'Dụng cụ học tập', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', 'may-tinh-bang-ipad', 'Balo không còn đơn thuần chỉ để đựng sách vở, đồ dùng học tập hay tư trang cá nhân mà đã trở thành một phụ kiện làm đẹp của rất nhiều người. Tuy nhiên, không phải ai cũng có đủ điều kiện tài chính để sở hữu những chiếc balo đắt tiền. Hãy cùng tìm hiểu nhữ', 'Thực hiện bước này nếu bạn muốn đưa mã nguồn của bạn', '2019_09_12_adu1568256696.jpg', 84, 'Vinh Quang Phùng', 1, 0, 1568255360, 1568256696);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`nes_id`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `nes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
