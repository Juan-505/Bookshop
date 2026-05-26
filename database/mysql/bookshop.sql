-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th5 26, 2026 lúc 07:24 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `ward_commune` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `hinh` text DEFAULT NULL,
  `tacgia` varchar(100) DEFAULT NULL,
  `ngaytao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `link` varchar(255) DEFAULT NULL,
  `nguoidoc` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog`
--

INSERT INTO `blog` (`id`, `ten`, `mota`, `hinh`, `tacgia`, `ngaytao`, `link`, `nguoidoc`) VALUES
(1, 'Lý do Attack on Titan vẫn là một tuyệt tác khiến khán giả trăn trở', 'Nếu bạn là một người yêu thích anime/manga, hẳn bạn đã từng nghe đến cái tên Attack on Titan (Shingeki no Kyojin) hay Đại Chiến Titan.', 'https://blogger.googleusercontent.com/img/a/AVvXsEgzk9vQZBPeIA84SlIdL9I7Ybyc0IXKcaunG8EpBYLnd6h6deWwukXHMEPeb4k5SNW6RMG_hXHyQTRWtTCJjx2MAaUk6_n1K03XL2rMQAFF5Nw_GCXi1HvG-sxYHtzevWPl5KwLSgN8WpERdzof76bUKpr7WvyWWlHigFggXVhD3b8CYEQIgOs3ZnIOfmhi', 'tiltyclaret', '2025-12-02 10:02:30', 'blog/aot.html', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(17, 25, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `shipping_address_id` int(11) DEFAULT NULL,
  `recipient_name_snapshot` varchar(255) DEFAULT NULL,
  `phone_number_snapshot` varchar(255) DEFAULT NULL,
  `full_address_snapshot` varchar(255) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_amount` decimal(38,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `shipping_fee` decimal(38,2) DEFAULT NULL,
  `discount_amount` decimal(38,2) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `shipping_address_id`, `recipient_name_snapshot`, `phone_number_snapshot`, `full_address_snapshot`, `order_date`, `total_amount`, `status`, `shipping_fee`, `discount_amount`, `notes`, `created_at`) VALUES
(14, 25, NULL, 'Admin', 'rrr', 'rrr', '2026-05-26 09:18:11', 10000.00, 'cancelled', 0.00, 0.00, 'rrr', '2026-05-26 09:03:56'),
(15, 25, NULL, 'Admin', '00000000000', 'rrr', '2026-05-26 09:17:38', 517920.00, 'cancelled', 0.00, 0.00, NULL, '2026-05-26 09:16:42'),
(16, 25, NULL, 'Admin', '00000000000', '0000', '2026-05-26 09:18:22', 51000.00, 'shipping', 0.00, 0.00, NULL, '2026-05-26 09:17:05'),
(17, 24, NULL, 'name', '08684939700', '33333333333333', '2026-05-26 16:41:19', 51000.00, 'cancelled', 0.00, 0.00, '3333333333333333', '2026-05-26 16:40:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `idbook` int(11) DEFAULT NULL,
  `product_name_snapshot` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(38,2) DEFAULT NULL,
  `subtotal` decimal(38,2) DEFAULT NULL,
  `variation_details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `idbook`, `product_name_snapshot`, `quantity`, `unit_price`, `subtotal`, `variation_details`, `created_at`) VALUES
(15, 14, 70, 'Tập Học Sinh Good Mood - Kẻ Ngang - 80 Trang', 2, 5000.00, 10000.00, NULL, '2026-05-26 09:03:56'),
(16, 15, 48, 'Hộp 12 Bút Marker Acrylic - Deli EC189-12', 6, 86320.00, 517920.00, NULL, '2026-05-26 09:16:42'),
(17, 16, 55, 'Búp Sen Xanh (Tái Bản 2020)', 1, 51000.00, 51000.00, NULL, '2026-05-26 09:17:05'),
(18, 17, 55, 'Búp Sen Xanh (Tái Bản 2020)', 1, 51000.00, 51000.00, NULL, '2026-05-26 16:40:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `idbook` int(11) NOT NULL,
  `tensach` varchar(255) DEFAULT NULL,
  `hinh` varchar(255) DEFAULT NULL,
  `id_loai` int(11) DEFAULT NULL,
  `dongia` bigint(20) NOT NULL,
  `hangton` bigint(20) NOT NULL,
  `daban` bigint(20) NOT NULL,
  `ngaynhap` date DEFAULT NULL,
  `giamgia` bigint(20) DEFAULT NULL,
  `nhacungcap` varchar(255) DEFAULT NULL,
  `tacgia` varchar(255) DEFAULT NULL,
  `nxb` varchar(255) DEFAULT NULL,
  `namxb` int(11) DEFAULT NULL,
  `trongluong` int(11) DEFAULT NULL,
  `sotrang` int(11) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `hinhthuc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`idbook`, `tensach`, `hinh`, `id_loai`, `dongia`, `hangton`, `daban`, `ngaynhap`, `giamgia`, `nhacungcap`, `tacgia`, `nxb`, `namxb`, `trongluong`, `sotrang`, `mota`, `hinhthuc`) VALUES
(1, 'Móc Khóa Bông Trang Trí Kèm Card Holder Spy X Family - Big Head - ToTy NX05 - Anya', 'Móc Khóa Bông Trang Trí Kèm Card Holder Spy X Family - Big Head - ToTy NX05 - Anya.png', 17, 136000, 41, 70, '2026-04-22', 16, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(9, 'bi mat tu duy trieu phu', 'kt-bimattuduytrieuphu.png', 2, 120000, 98, 76, '2024-01-01', 0, 'Alpha Books', 'Nhiều tác giả', 'NXB Thế Giới', 2023, 350, 320, 'Sách kiến thức chuyên ngành quản trị kinh doanh, phát triển bản thân và tư duy tài chính cốt lõi dành cho doanh nhân và sinh viên.', 'Bìa mềm'),
(10, 'kinh te via he', 'kt-kinhteviahe.png', 2, 140000, 50, 54, '2024-01-01', 0, 'Alpha Books', 'Nhiều tác giả', 'NXB Thế Giới', 2023, 350, 320, 'Sách kiến thức chuyên ngành quản trị kinh doanh, phát triển bản thân và tư duy tài chính cốt lõi dành cho doanh nhân và sinh viên.', 'Bìa mềm'),
(11, 'mba bang hinh', 'kt-mbabanghinh.png', 2, 230000, 34, 14, '2024-01-01', 0, 'Alpha Books', 'Nhiều tác giả', 'NXB Thế Giới', 2023, 350, 320, 'Sách kiến thức chuyên ngành quản trị kinh doanh, phát triển bản thân và tư duy tài chính cốt lõi dành cho doanh nhân và sinh viên.', 'Bìa mềm'),
(12, 'mot doi quan tri', 'kt-motdoiquantri.png', 2, 350000, 25, 14, '2024-01-01', 13, 'Alpha Books', 'Nhiều tác giả', 'NXB Thế Giới', 2023, 350, 320, 'Sách kiến thức chuyên ngành quản trị kinh doanh, phát triển bản thân và tư duy tài chính cốt lõi dành cho doanh nhân và sinh viên.', 'Bìa mềm'),
(13, 'bien moi thu thanh tien2', 'ky-bienmoithuthanhtien2.png', 2, 50000, 50, 14, '2024-01-01', 0, 'Alpha Books', 'Nhiều tác giả', 'NXB Thế Giới', 2023, 350, 320, 'Sách kiến thức chuyên ngành quản trị kinh doanh, phát triển bản thân và tư duy tài chính cốt lõi dành cho doanh nhân và sinh viên.', 'Bìa mềm'),
(14, 'attack on titan 13', 'mg-aot13.png', 3, 100000, 50, 32, '2024-01-01', 0, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(15, 'attack on titan 34', 'mg-aot34.png', 3, 136000, 75, 4, '2024-01-01', 0, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(16, 'attack on titan 4', 'mg-aot4.png', 3, 121000, 50, 44, '2024-01-01', 0, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(17, 'attack on titan 9', 'mg-aot9.png', 3, 32500, 32, 11, '2024-01-01', 2, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(18, 'doraemon 1', 'mg-drm1.png', 3, 321000, 50, 23, '2024-01-01', 0, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(19, 'doraemon 2', 'mg-drm2.png', 3, 120000, 5, 3, '2024-01-01', 0, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(20, 'doraemon 3', 'mg-drm3.png', 3, 147000, 50, 53, '2024-01-01', 0, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(21, 'doraemon 5', 'mg-drm5.png', 3, 170000, 34, 43, '2024-01-01', 7, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(22, 'doraemon 6', 'mg-drm6.png', 3, 260800, 23, 9, '2024-01-01', 0, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(23, 'overlord', 'mg-ovl.png', 3, 119999, 23, 40, '2024-01-01', 0, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(24, 'van hao luu lac', 'mg-vhll.png', 3, 120000, 53, 9, '2024-01-01', 0, 'Nhà Xuất Bản Kim Đồng', 'Nhiều tác giả', 'NXB Kim Đồng', 2024, 180, 192, 'Ấn phẩm truyện tranh bản quyền phát hành tại thị trường Việt Nam, chất lượng giấy in cao cấp kèm quà tặng limited.', 'Bìa mềm'),
(25, 'ngu phap tieng anh', 'nn-npta.png', 23, 120000, 76, 23, '2024-01-01', 0, 'Nhà Xuất Bản Giáo Dục Việt Nam', 'Bộ Giáo Dục Và Đào Tạo', 'NXB Giáo Dục Việt Nam', 2024, 280, 160, 'Sách giáo khoa biên soạn theo chương trình giáo dục phổ thông mới của Bộ Giáo dục và Đào tạo.', 'Bìa mềm'),
(26, 'ngu phap tieng duc', 'nn-npttd.png', 24, 675640, 24, 33, '2024-01-01', 0, 'Nhà Xuất Bản Giáo Dục Việt Nam', 'Bộ Giáo Dục Và Đào Tạo', 'NXB Giáo Dục Việt Nam', 2024, 280, 160, 'Sách giáo khoa biên soạn theo chương trình giáo dục phổ thông mới của Bộ Giáo dục và Đào tạo.', 'Bìa mềm'),
(27, 'tu hoc duoc', 'nn-thd.png', 25, 431000, 45, 87, '2024-01-01', 0, 'Nhà Xuất Bản Giáo Dục Việt Nam', 'Bộ Giáo Dục Và Đào Tạo', 'NXB Giáo Dục Việt Nam', 2024, 280, 160, 'Sách giáo khoa biên soạn theo chương trình giáo dục phổ thông mới của Bộ Giáo dục và Đào tạo.', 'Bìa mềm'),
(28, 'ngu van 11 -1- canhdieu', 'sgk-nguvan11-1-canhdieu.png', 22, 34500, 43, 63, '2024-01-01', 5, 'Nhà Xuất Bản Giáo Dục Việt Nam', 'Bộ Giáo Dục Và Đào Tạo', 'NXB Giáo Dục Việt Nam', 2024, 280, 160, 'Sách giáo khoa biên soạn theo chương trình giáo dục phổ thông mới của Bộ Giáo dục và Đào tạo.', 'Bìa mềm'),
(30, 'toan 11 -1- chan troi sang tao', 'sgk-toan11-1-ctst.png', 22, 334898, 50, 34, '2024-01-01', 0, 'Nhà Xuất Bản Giáo Dục Việt Nam', 'Bộ Giáo Dục Và Đào Tạo', 'NXB Giáo Dục Việt Nam', 2024, 280, 160, 'Sách giáo khoa biên soạn theo chương trình giáo dục phổ thông mới của Bộ Giáo dục và Đào tạo.', 'Bìa mềm'),
(31, 'toan 11 -1- ket noi tri thuc', 'sgk-toan11-1-kn.png', 22, 543000, 48, 2, '2024-01-01', 0, 'Nhà Xuất Bản Giáo Dục Việt Nam', 'Bộ Giáo Dục Và Đào Tạo', 'NXB Giáo Dục Việt Nam', 2024, 280, 160, 'Sách giáo khoa biên soạn theo chương trình giáo dục phổ thông mới của Bộ Giáo dục và Đào tạo.', 'Bìa mềm'),
(33, 'toan 11 -2- ket noi tri thuc', 'sgk-toan11-2-kn.png', 22, 212000, 45, 36, '2024-01-01', 6, 'Nhà Xuất Bản Giáo Dục Việt Nam', 'Bộ Giáo Dục Và Đào Tạo', 'NXB Giáo Dục Việt Nam', 2024, 280, 160, 'Sách giáo khoa biên soạn theo chương trình giáo dục phổ thông mới của Bộ Giáo dục và Đào tạo.', 'Bìa mềm'),
(34, 'cau chuyen rung xanh', 'tn-cauchuyenrungxanh.png', 6, 120000, 99, 24, '2024-01-01', 0, 'Nhà Xuất Bản Trẻ', 'Nhiều tác giả', 'NXB Trẻ', 2022, 400, 280, 'Tác phẩm văn học Việt Nam kinh điển, giàu tính nhân văn và giáo dục, phù hợp với mọi thế hệ bạn đọc.', 'Bìa mềm'),
(35, 'co tich cua ba', 'tn-cotichcuaba.png', 6, 645000, 84, 22, '2024-01-01', 8, 'Nhà Xuất Bản Trẻ', 'Nhiều tác giả', 'NXB Trẻ', 2022, 400, 280, 'Tác phẩm văn học Việt Nam kinh điển, giàu tính nhân văn và giáo dục, phù hợp với mọi thế hệ bạn đọc.', 'Bìa mềm'),
(36, 'le ta on', 'tn-letaon.png', 6, 123000, 43, 43, '2024-01-01', 0, 'Nhà Xuất Bản Trẻ', 'Nhiều tác giả', 'NXB Trẻ', 2022, 400, 280, 'Tác phẩm văn học Việt Nam kinh điển, giàu tính nhân văn và giáo dục, phù hợp với mọi thế hệ bạn đọc.', 'Bìa mềm'),
(37, 'phong thu', 'tn-phongthu.png', 6, 445500, 75, 21, '2024-01-01', 0, 'Nhà Xuất Bản Trẻ', 'Nhiều tác giả', 'NXB Trẻ', 2022, 400, 280, 'Tác phẩm văn học Việt Nam kinh điển, giàu tính nhân văn và giáo dục, phù hợp với mọi thế hệ bạn đọc.', 'Bìa mềm'),
(38, 'truyen co tich cua vuon', 'tn-truyencotichcuavuon.png', 6, 272000, 52, 44, '2024-01-01', 0, 'Nhà Xuất Bản Trẻ', 'Nhiều tác giả', 'NXB Trẻ', 2022, 400, 280, 'Tác phẩm văn học Việt Nam kinh điển, giàu tính nhân văn và giáo dục, phù hợp với mọi thế hệ bạn đọc.', 'Bìa mềm'),
(39, 'vo luyen tap tieng viet 1', 'tn-volttiengviet1.png', 21, 572000, 32, 19, '2024-01-01', 0, 'Nhà Xuất Bản Giáo Dục Việt Nam', 'Bộ Giáo Dục Và Đào Tạo', 'NXB Giáo Dục Việt Nam', 2024, 280, 160, 'Sách giáo khoa biên soạn theo chương trình giáo dục phổ thông mới của Bộ Giáo dục và Đào tạo.', 'Bìa mềm'),
(40, 'vo luyen tap tieng viet 2', 'tn-volttiengviet2.png', 21, 157200, 13, 21, '2024-01-01', 0, 'Nhà Xuất Bản Giáo Dục Việt Nam', 'Bộ Giáo Dục Và Đào Tạo', 'NXB Giáo Dục Việt Nam', 2024, 280, 160, 'Sách giáo khoa biên soạn theo chương trình giáo dục phổ thông mới của Bộ Giáo dục và Đào tạo.', 'Bìa mềm'),
(42, 'Đồ Chơi Lắp Ráp Go Battle! Pokémon Vol 2 - Eevee - Keepplay 32666', 'Đồ Chơi Lắp Ráp Go Battle! Pokémon Vol 2 - Eevee - Keepplay 32666.png', 16, 104000, 51, 32, '2026-04-22', 0, 'Keepplay Việt Nam', 'Keepplay', 'Không có (Đồ chơi)', 2025, 500, 0, 'Bộ đồ chơi lắp ráp mô hình chính hãng, chất liệu nhựa ABS an toàn, giúp kích thích trí thông minh và tư duy logic.', 'Hộp giấy'),
(43, 'Đồ Chơi Lắp Ráp Go Adventure Pokémon - Charmander & Charizard - Keepplay K20252', 'Đồ Chơi Lắp Ráp Go Adventure Pokémon - Charmander & Charizard - Keepplay K20252.png', 16, 72000, 84, 72, '2026-04-22', 0, 'Keepplay Việt Nam', 'Keepplay', 'Không có (Đồ chơi)', 2025, 500, 0, 'Bộ đồ chơi lắp ráp mô hình chính hãng, chất liệu nhựa ABS an toàn, giúp kích thích trí thông minh và tư duy logic.', 'Hộp giấy'),
(44, 'Thú Bông Doraemon Cầm Dorayaki', 'Thú Bông Doraemon Cầm Dorayaki.png', 17, 164000, 85, 50, '2026-04-22', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Kính Vạn Hoa - Tập 18 - Tóc Ngắn Tóc Dài - Má Lúm Đồng Tiền - Cà Phê Áo Tím (Tái Bản 2022)', 'Kính Vạn Hoa - Tập 18 - Tóc Ngắn Tóc Dài - Má Lúm Đồng Tiền - Cà Phê Áo Tím (Tái Bản 2022).png', 6, 142000, 77, 56, '2026-04-22', 0, 'Nhà Xuất Bản Trẻ', 'Nhiều tác giả', 'NXB Trẻ', 2022, 400, 280, 'Tác phẩm văn học Việt Nam kinh điển, giàu tính nhân văn và giáo dục, phù hợp với mọi thế hệ bạn đọc.', 'Bìa mềm'),
(46, 'Kính Vạn Hoa - Tập 15 - Khách Sạn Hoa Hồng - Quà Tặng Ba Lần - Kính Vạn Hoa (Tái Bản 2022)', 'Kính Vạn Hoa - Tập 15 - Khách Sạn Hoa Hồng - Quà Tặng Ba Lần - Kính Vạn Hoa (Tái Bản 2022).png', 6, 79000, 90, 25, '2026-04-22', 0, 'Nhà Xuất Bản Trẻ', 'Nhiều tác giả', 'NXB Trẻ', 2022, 400, 280, 'Tác phẩm văn học Việt Nam kinh điển, giàu tính nhân văn và giáo dục, phù hợp với mọi thế hệ bạn đọc.', 'Bìa mềm'),
(47, 'Hộp 24 Bút Lông Màu Acrylic Markers 2 Đầu - Colokit ACM-C002', 'Hộp 24 Bút Lông Màu Acrylic Markers 2 Đầu - Colokit ACM-C002.png', 18, 91000, 23, 43, '2026-04-22', 0, 'Thiên Long - Deli', 'Deli / Thiên Long', 'Không có (Dụng cụ học tập)', 2026, 250, 0, 'Bút màu Acrylic cao cấp chống thấm nước, độ che phủ cao, vẽ được trên nhiều chất liệu như giấy, vải, nhựa, ly sứ.', 'Hộp nhựa'),
(48, 'Hộp 12 Bút Marker Acrylic - Deli EC189-12', 'Hộp 12 Bút Marker Acrylic - Deli EC189-12.png', 18, 104000, 56, 14, '2026-04-22', 17, 'Thiên Long - Deli', 'Deli / Thiên Long', 'Không có (Dụng cụ học tập)', 2026, 250, 0, 'Bút màu Acrylic cao cấp chống thấm nước, độ che phủ cao, vẽ được trên nhiều chất liệu như giấy, vải, nhựa, ly sứ.', 'Hộp nhựa'),
(49, 'Hộp 12 Bút Màu Acrylic Marker - Deli HM166-12', 'Hộp 12 Bút Màu Acrylic Marker - Deli HM166-12.png', 18, 82000, 32, 28, '2026-04-22', 9, 'Thiên Long - Deli', 'Deli / Thiên Long', 'Không có (Dụng cụ học tập)', 2026, 250, 0, 'Bút màu Acrylic cao cấp chống thấm nước, độ che phủ cao, vẽ được trên nhiều chất liệu như giấy, vải, nhựa, ly sứ.', 'Hộp nhựa'),
(50, 'Hộp 12 Bút Lông Màu Acrylic Markers 2 Đầu - Colokit ACM-C001', 'Hộp 12 Bút Lông Màu Acrylic Markers 2 Đầu - Colokit ACM-C001.png', 18, 67000, 57, 32, '2026-04-22', 20, 'Thiên Long - Deli', 'Deli / Thiên Long', 'Không có (Dụng cụ học tập)', 2026, 250, 0, 'Bút màu Acrylic cao cấp chống thấm nước, độ che phủ cao, vẽ được trên nhiều chất liệu như giấy, vải, nhựa, ly sứ.', 'Hộp nhựa'),
(51, 'Hộp 14 Bút Màu Acrylic Đầu Brush - Colokit ACM-C020', 'Hộp 14 Bút Màu Acrylic Đầu Brush - Colokit ACM-C020.png', 18, 183000, 25, 22, '2026-04-22', 0, 'Thiên Long - Deli', 'Deli / Thiên Long', 'Không có (Dụng cụ học tập)', 2026, 250, 0, 'Bút màu Acrylic cao cấp chống thấm nước, độ che phủ cao, vẽ được trên nhiều chất liệu như giấy, vải, nhựa, ly sứ.', 'Hộp nhựa'),
(52, 'Hộp 24 Bút Màu Acrylic Marker - Deli HM166-24', 'Hộp 24 Bút Màu Acrylic Marker - Deli HM166-24.png', 18, 58000, 52, 49, '2026-04-22', 0, 'Thiên Long - Deli', 'Deli / Thiên Long', 'Không có (Dụng cụ học tập)', 2026, 250, 0, 'Bút màu Acrylic cao cấp chống thấm nước, độ che phủ cao, vẽ được trên nhiều chất liệu như giấy, vải, nhựa, ly sứ.', 'Hộp nhựa'),
(53, 'Tư Duy Logic (Tái Bản 2021)', 'Tư Duy Logic (Tái Bản 2021).png', 2, 170000, 65, 68, '2026-04-22', 9, 'Alpha Books', 'Nhiều tác giả', 'NXB Thế Giới', 2023, 350, 320, 'Sách kiến thức chuyên ngành quản trị kinh doanh, phát triển bản thân và tư duy tài chính cốt lõi dành cho doanh nhân và sinh viên.', 'Bìa mềm'),
(54, 'Việt Nam Danh Tác - Tiêu Sơn Tráng Sĩ', 'Việt Nam Danh Tác - Tiêu Sơn Tráng Sĩ.png', 8, 161000, 35, 54, '2026-04-22', 6, 'Nhà Xuất Bản Trẻ', 'Nhiều tác giả', 'NXB Trẻ', 2022, 400, 280, 'Tác phẩm văn học Việt Nam kinh điển, giàu tính nhân văn và giáo dục, phù hợp với mọi thế hệ bạn đọc.', 'Bìa mềm'),
(55, 'Búp Sen Xanh (Tái Bản 2020)', 'Búp Sen Xanh (Tái Bản 2020).png', 6, 51000, 52, 64, '2026-04-22', 0, 'Nhà Xuất Bản Trẻ', 'Nhiều tác giả', 'NXB Trẻ', 2022, 400, 280, 'Tác phẩm văn học Việt Nam kinh điển, giàu tính nhân văn và giáo dục, phù hợp với mọi thế hệ bạn đọc.', 'Bìa mềm'),
(70, 'Tập Học Sinh Good Mood - Kẻ Ngang - 80 Trang', 'Tập Học Sinh Good Mood - Kẻ Ngang - 80 Trang 70gsm - Hải Tiến 9479 (Mẫu Bìa Giao Ngẫu Nhiên).png', 19, 5000, 87, 95, '2026-04-23', 0, 'Hải Tiến - Deli', 'Nhiều tác giả', 'Không có (Văn phòng phẩm)', 2026, 80, 80, 'Dụng cụ học tập thiết yếu dành cho học sinh, sinh viên, chất lượng gia công tốt, độ bền cao.', 'Tập lẻ'),
(71, 'Gôm Tẩy - Deli EH328 - Dudu', 'Gôm Tẩy - Deli EH328 - Dudu.png', 20, 5000, 65, 98, '2026-04-23', 0, 'Hải Tiến - Deli', 'Nhiều tác giả', 'Không có (Văn phòng phẩm)', 2026, 80, 80, 'Dụng cụ học tập thiết yếu dành cho học sinh, sinh viên, chất lượng gia công tốt, độ bền cao.', 'Tập lẻ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `id_loai` int(11) NOT NULL,
  `ten_loai` varchar(255) NOT NULL,
  `id_cha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`id_loai`, `ten_loai`, `id_cha`) VALUES
(1, 'Đồ Chơi ', NULL),
(2, 'Kinh Tế', NULL),
(3, 'Truyện Tranh ', NULL),
(4, 'Ngoại Ngữ', NULL),
(5, 'Sách Giáo Khoa', NULL),
(6, 'Thiếu Nhi', NULL),
(7, 'Văn Phòng Phẩm', NULL),
(8, 'Tiểu Thuyết', NULL),
(16, 'Mô Hình', 1),
(17, 'Gấu Bông', 1),
(18, 'Bút Màu', 7),
(19, 'Vở', 7),
(20, 'Tẩy', 7),
(21, 'Lớp 1', 5),
(22, 'Lớp 11', 5),
(23, 'Tiếng Anh', 4),
(24, 'Tiếng Đức', 4),
(25, 'Sách Đa Ngữ (Polyglot)', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sdt` varchar(255) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `avt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `email`, `sdt`, `ngay_sinh`, `password_hash`, `user_role`, `full_name`, `phone_number`, `is_active`, `avt`) VALUES
(24, 'user@bookshop.test', NULL, NULL, '$2y$12$Zy9uwbPSmQIfQVpYBHW/XePxxUZZ3OGitb47D22wxlk6CL7cFxIyO', 'user', 'name', NULL, 1, NULL),
(25, 'admin@bookshop.test', NULL, NULL, '$2y$12$JzmjQMKiuhEhLvjtUhHMlOA2vd0kpnWVdFizhRfFXvjNaMU5KCMRO', 'admin', 'Admin', NULL, 1, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orders_ibfk_2` (`shipping_address_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `idbook` (`idbook`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`idbook`),
  ADD KEY `FKrkx2dq16qno5kkhg0whpluq4w` (`id_loai`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`id_loai`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `sach`
--
ALTER TABLE `sach`
  MODIFY `idbook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `id_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `sach` (`idbook`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shipping_address_id`) REFERENCES `addresses` (`address_id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`idbook`) REFERENCES `sach` (`idbook`);

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `FKrkx2dq16qno5kkhg0whpluq4w` FOREIGN KEY (`id_loai`) REFERENCES `theloai` (`id_loai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
