-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 01, 2024 lúc 04:12 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dacs2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id_cmt` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `noidung` tinytext NOT NULL,
  `ngay_gio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id_cmt`, `id_sp`, `id_user`, `noidung`, `ngay_gio`) VALUES
(3, 22, 0, 'q', '2023-12-29 19:44:57'),
(4, 23, 41, 'cảm ơn bạn đã tin tưởng và đặt hàng shop mình. chúc bạn có 1 ngày vui vẻ <3 ', '2023-12-30 02:57:31'),
(5, 23, 34, 'Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit', '2023-12-30 03:00:34'),
(6, 23, 34, 'álknasasd', '2023-12-30 03:17:32'),
(7, 21, 34, 'Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit', '2023-12-30 03:39:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id_dm` int(11) NOT NULL,
  `name_dm` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id_dm`, `name_dm`) VALUES
(19, 'rose'),
(20, 'Lavender '),
(27, 'lavana'),
(28, 'Tulipp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `id_hd` int(11) NOT NULL,
  `name_client` varchar(22) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `status` int(2) NOT NULL,
  `product` varchar(100) NOT NULL,
  `ngay_tao_hd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ten_nguoi_nhan` varchar(30) NOT NULL,
  `number_phone` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id_sp` int(11) NOT NULL,
  `id_dm` int(10) NOT NULL,
  `ten_sp` varchar(50) NOT NULL,
  `gia_sp` float NOT NULL,
  `anh_mota` varchar(50) NOT NULL,
  `chitiet_sp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id_sp`, `id_dm`, `ten_sp`, `gia_sp`, `anh_mota`, `chitiet_sp`) VALUES
(2, 28, 'Tulip trắng', 30, '6502165d625f18b447d717ba4559bcad.jpg', 'aaaaaaa'),
(4, 29, 'hoa hồng trắng', 45, '9e811f2b954794c2e2d6f4feb8d6c8d7.jpg', 'cú tui cú tuiii'),
(8, 20, 'lavender tím', 1100, '96f5147084b69fea51ae4d48eb74094f.jpg', 'xin chào hyhy'),
(10, 10, 'Loa kèn', 111, 'new3.jpg', ''),
(14, 20, 'lavender', 35, '12cdbfa21f76d7cadf8865f52f3645b1.jpg', 'hoa xinh đẹp nhứt quả đất đấy mua đi'),
(15, 20, 'dâm bụt', 23, 'new7.jpg', 'xin đẹp tiệt trần'),
(16, 28, 'tuplip hồng', 50, 'af8abe753e3f34253a62790033318611.jpg', 'adsklc'),
(17, 28, 'tulip tím', 55, 'ha3.jpg', 'sàn'),
(18, 28, 'tulip tím', 33, 'ha4.jpg', 'ấn'),
(19, 19, 'rose white', 29, '9e811f2b954794c2e2d6f4feb8d6c8d7.jpg', 'âsss'),
(20, 28, 'Tulip hồng', 32, 'hinh5.jpg', 'àlnassa'),
(21, 27, 'a', 2, 'new2.jpg', ''),
(22, 20, 'Scarlet Sage', 34, 'roseOgrange.jpg', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.'),
(23, 28, 'Tulip Ogrange', 59, 'tulipcam.jpg', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `name_user` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `email`, `name_user`, `password`, `role`) VALUES
(1, 'thuyvan@gmail.com', 'thuyvan', '8fd6f5461b', 0),
(2, 'nguyenthuyvann105@gm', 'thuyvan', 'bb2495c2b8', 0),
(3, 'bbbbbbbbbbb@m', 'bbbb', 'v123', 0),
(4, 'van@m', 'thuyvann', 'v123', 0),
(5, 'vann@m', 'mmnn', 'v123', 0),
(6, 'va@m', 'vann', 'v123', 0),
(7, 'baaaaa@m', 'aaaaaa', 'v123', 0),
(8, 'ccc@a', 'ccccccccc', 'v123', 0),
(9, 'kkkk@m', 'mmmm', 'mmmmmmmmmm', 0),
(10, 'van@n', 'vanb', 'v123', 0),
(11, 'aaa@x', 'aaaaaaaaaa', 'v123', 0),
(12, 'vvvvvvvv@d', 'vvvvvv', 'aaaaa', 0),
(13, 'ccc@ks', 'aaaaa', 'vvvvvv', 0),
(14, 'ssss', 'sss@q', 'v111', 0),
(15, 'ssssssssss@q', 'ggggggggg', 'v11111111', 0),
(16, 'van@n', 'qaaaaaaaa', 'af15d5fdac', 0),
(17, 'a', 'aaa', '74b8733745', 0),
(18, 'ccc@aa', 'aaaaaaaaa', '96e7921896', 0),
(19, 'aa', 'aaaaaaa', '594f803b38', 0),
(20, 'aaaa', 'aaaaa', '74b8733745', 0),
(21, 'aaaaa@ds', 'aaaaa', '4bbde07660', 0),
(22, 'nguyen@gmail.com', 'thuyvan', 'bb2495c2b8', 0),
(23, 'tvan@gmail.com', 'thuy van', '8fd6f5461b', 0),
(24, 'van@xinhdep', 'vannnnnn', 'a0e70be9e8', 0),
(25, 'tvan@gmail', 'vannn', 'a0e70be9e8', 0),
(26, 'vanne@gmail.com', 'vanne', 'bb2495c2b8', 0),
(27, 'v@m', 'vannn', 'bb2495c2b8', 0),
(28, 'mini@mail', 'mmini', 'bb2495c2b8', 0),
(29, 'mnii@mail', 'aaaaaasss', 'bb2495c2b8', 0),
(30, 'quynunu@gmail', 'van', '$2y$10$yyC', 0),
(31, 'n@na', 'thuyvan', '$2y$10$2Fi', 0),
(32, 'naan@m', 'tvan', '$2y$10$uXz', 0),
(33, 'c', 'mcams', '$2y$10$Lk2', 0),
(34, 'ccc@aaa', 'ccaa', '$2y$10$Zf59ESEA0Em5S.Z8Gp2GdOY6UnNxv3fOHvDG.tKrwq9ncEJ7pa7QG', 0),
(35, 'van@aaa', 'vannne', '$2y$10$/0ThFhi8IGM4fJpUT29BJukD3qqXV4lapaK94TyXv0Ppo4kL1WXWy', 0),
(36, 'hanhi@gmail.com', 'hanhi', '$2y$10$l6NNjQzF6BoGwExGwHN43.HLfheH1xhw9t9mF.r.hcStEDqtG5Fc2', 0),
(37, 'hanhinguyen@gmail.co', 'hanhinguyen', '$2y$10$9yFHM0MZGzeGvXj6IsAQTegL/cJETbzklHAlYzxnysnDwdS0gDkD6', 0),
(38, 'hanhi@gmail.com.vn', 'hanhi', '$2y$10$5TQh/CFgFBPzQUd1p2CZfeMi2eo8KfbhfttGY9qhgRQnDeBK7zCo6', 0),
(39, 'admin1@gmail.com', 'admin', 'v123', 1),
(40, 'admin2@gmail.com', 'admin', '$2y$10$pDea2bhlV3bNx/SaZ5Al2.TxiL6qr6umI5mtpskN18mCgasv7cF3C', 1),
(41, 'admin3@gmail.com', 'admin3', '$2y$10$GvBhpfguzOLJjcn.ghSAZe53/.gq9/dOhcrXjQEsKnn8tuiXKoOZC', 1),
(42, 'thuy@gmail.com', 'thuyvan', '$2y$10$8orTDhatP07yX/Jc8wWhgulNb9jCKZepDl9lDeQljwqtDkCi6kQZS', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_cmt`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_dm`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sp` (`id_sp`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id_hd`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `oder_id` (`order_id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_sp`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id_cmt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id_dm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id_hd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`id_sp`) REFERENCES `sanpham` (`id_sp`),
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
