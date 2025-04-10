-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 09, 2025 lúc 10:15 AM
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
-- Cơ sở dữ liệu: `cafess`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile`) VALUES
('zsf7a0xXnfaxXZ76vB6Z', 'nguyenkhacphuoc', 'nguyenkhacphuoc08122004@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'icon2.png'),
('gTOJvCxzNdgLkvr01S2g', 'QuangDoanh', 'quangminh04072004@gmail.com', '1', ' 04.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `product_detail` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `image`, `product_detail`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Cà phê xanh thơm ngon', '4.webp', 'Cà phê xanh là một sản phẩm tự nhiên được chế biến từ những hạt cà phê chưa qua rang xay, giữ lại toàn bộ dưỡng chất quý giá từ thiên nhiên. Với hương vị nhẹ nhàng, độc đáo, sản phẩm này đã trở thành sự lựa chọn lý tưởng cho những người yêu thích lối sống lành mạnh.\r\n\r\nCà phê xanh giàu chất chống oxy hóa, đặc biệt là axit chlorogenic, giúp hỗ trợ quá trình trao đổi chất và giảm hấp thụ đường trong cơ thể. Đây là lý do tại sao cà phê xanh thường được sử dụng trong các chế độ ăn kiêng và kiểm soát cân nặng. Ngoài ra, sản phẩm còn giúp tăng cường năng lượng, cải thiện sự tập trung mà không gây cảm giác bồn chồn như cà phê thông thường.\r\n\r\nĐặc biệt, cà phê xanh rất dễ pha chế. Bạn chỉ cần ngâm hạt cà phê xanh trong nước nóng khoảng 10 phút, sau đó lọc và thưởng thức. Có thể thêm một chút mật ong hoặc chanh để tăng hương vị.\r\n\r\nVới những lợi ích vượt trội, cà phê xanh không chỉ là một thức uống, mà còn là bí quyết chăm sóc sức khỏe toàn diện. Hãy thử ngay hôm nay để cảm nhận sự khác biệt!', 'active', '2024-12-23 08:49:44', '2024-12-23 12:37:41'),
(3, 'Túi cafe', 'card1.jpg', 'Hạt cà phê rang là kết quả của quá trình chế biến và nhiệt hóa hạt cà phê xanh, nhằm mang lại hương vị đặc trưng. Trong quá trình rang, các hợp chất tự nhiên bên trong hạt được biến đổi, tạo nên mùi thơm quyến rũ và vị đậm đà. Tùy theo thời gian và nhiệt độ rang, hạt cà phê có thể mang vị chua thanh, đắng nhẹ hoặc đậm đà. Đây là bước quan trọng quyết định chất lượng và phong cách của mỗi loại cà phê, làm nên sức hấp dẫn của thức uống phổ biến này.', 'active', '2024-12-23 08:51:20', '2024-12-23 12:39:30'),
(7, 'Cafe xanh sạch đẹp', 'about-us.jpg', 'Cà phê rang là sự kết tinh của hương vị và nghệ thuật. Từng hạt được chế biến kỹ lưỡng để mang lại mùi thơm nồng nàn và vị đậm đà. Quá trình rang quyết định sự khác biệt, từ vị chua thanh đến đắng nhẹ. Một tách cà phê ngon là kết quả của sự hòa quyện hoàn hảo giữa kỹ thuật và tâm huyết. Thưởng thức cà phê là khám phá câu chuyện đầy cảm hứng đằng sau từng hạt.', 'active', '2024-12-23 13:00:56', '2024-12-23 13:14:14'),
(15, 'cafe muối ', '6.webp', 'Cà phê muối là một loại thức uống độc đáo, kết hợp giữa vị đắng nhẹ của cà phê và chút mặn từ muối, tạo nên hương vị cân bằng và lạ miệng. Muối không chỉ làm dịu vị đắng mà còn làm nổi bật hương thơm tự nhiên của cà phê. Đây là một đặc sản nổi tiếng của Huế, thường được phục vụ với sữa đặc để tăng độ béo ngậy và hài hòa. Thưởng thức cà phê muối là một trải nghiệm thú vị, mang lại cảm giác mới lạ và đầy ấn tượng cho người yêu cà phê.', 'deactive', '2025-01-02 13:29:17', '2025-01-02 13:31:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `qty` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `price`, `qty`) VALUES
('iWyLSYbdqTs7ugpPP2a6', '', 'BQDirWqv8ZXMXb28NZh4', 120000, 2),
('QfFFm20D3ufmYewjZvms', 'FwFw38dWyoGn45JW6Chz', 'g8FR2y8jtiJCiWjO2JQW', 20000, 1),
('l7ToScakKYyONPDzZoii', 'Mf6W6qlBJHTKfuHvYAU3', '42NTYGSINKAhPfghM8IS', 35000, 1),
('rdGr33qUlEwJkz7HBEyD', 'Mf6W6qlBJHTKfuHvYAU3', 'a9F3jT9aWkjNw7d1BC8C', 30000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `number` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `message`, `number`, `status`) VALUES
('38mQJc72asmTmURL75Sv', 'wBfcaz2zJ9U3omEe5A0f', 'quangminh', 'quangminh04072004@gmail.com', 'rất ngon', '2134256789', 'complete'),
('fh2bOAFdacQlNx9OLjtp', 'wBfcaz2zJ9U3omEe5A0f', 'khac phuoc', 'quangminh04072004@gmail.com', 'không tệ', '2134256789', 'complete'),
('5luvnWua3IOuEuNiCqcs', 'wBfcaz2zJ9U3omEe5A0f', 'quang minh', 'quangminh04072004@gmail.com', 'Sản phẩm cà phê này có chất lượng tuyệt vời với hương vị đậm đà, thơm ngon đặc trưng. Bao bì được thiết kế đẹp mắt và tiện lợi, rất phù hợp để mang theo khi di chuyển. Giá cả hợp lý so với chất lượng, là lựa chọn tốt cho những người yêu thích cà phê nguyên chất. Sự kết hợp giữa vị đắng và hậu vị ngọt tạo cảm giác dễ chịu khi thưởng thức. Đây chắc chắn là sản phẩm đáng để trải nghiệm và sử dụng lâu dài.', '2134256789', 'complete'),
('sN3vaR2lIF9h4PoolJKb', 'wBfcaz2zJ9U3omEe5A0f', 'coffee green', 'daxoyol656@bulatox.com', '123456', '0386926955', 'initial');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_type` varchar(10) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `qty` varchar(2) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`, `date`, `status`, `payment_status`) VALUES
('jG6NHUJzXQCrsPChturv', 'wBfcaz2zJ9U3omEe5A0f', 'Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2024-12-14 00:00:00', 'canceled-nv', 'uncomplete'),
('A8ocy4uZiJSA6oracqZb', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2024-12-14 00:00:00', 'delivered', 'complete'),
('a1utsHKuI3BRdU6lry8s', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2024-12-14 00:00:00', 'delivered', 'complete'),
('A0UB1OZE3NOagxsUqp2z', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 50000, '1', '2024-12-14 00:00:00', 'canceled-nv', 'uncomplete'),
('2olO3j6gvLPlO5TfEcgT', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2024-12-14 00:00:00', 'canceled-nv', 'uncomplete'),
('Gp20nAOs8TXMkXCMMQyA', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2024-12-14 00:00:00', 'canceled-nv', 'uncomplete'),
('s2w384Ka9b4IEJPKNWy5', '', 'Quang Doanh', 386926955, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2024-12-21 00:00:00', 'delivered', 'complete'),
('u6SvWW9ZA8dCFzz1ygmd', '', 'coffe', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2024-12-21 00:00:00', 'delivered', 'complete'),
('wE7TXrikQuFDP1O9HkPW', '', 'coffe', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2024-12-21 00:00:00', 'delivered', 'complete'),
('mj4acmLym2xI42hsdkTT', '', 'Quang Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2024-12-23 00:00:00', 'delivered', 'complete'),
('tQTkeZ8ZKJkrjBclN96P', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-02 00:00:00', 'delivered', 'complete'),
('dGl9UQKfQfozmj5Q83DZ', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-02 00:00:00', 'delivered', 'complete'),
('fKcZodb4wSmxbD5XeCp7', 'Mf6W6qlBJHTKfuHvYAU3', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'BQDirWqv8ZXMXb28NZh4', 120000, '3', '2025-01-02 00:00:00', 'delivered', 'complete'),
('RajJdSAET0BasoqzTNUK', 'Mf6W6qlBJHTKfuHvYAU3', 'QuangDoanh0407', 386926955, 'nguyenkhacphuoc08122004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 20000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('9cwXpC7tASXarnIu7ejk', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'nguyenkhacphuoc08122004@gmail.com', '266 tran nguyen han', 'home', 'cash on delivery', '42NTYGSINKAhPfghM8IS', 35000, '1', '2025-01-07 00:00:00', 'canceled-kh', ''),
('lkDGf8baPWPDe6zsJ8Ha', 'Mf6W6qlBJHTKfuHvYAU3', 'Minh', 386926902, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2ET', 30000, '1', '2025-01-07 00:00:00', 'canceled-kh', ''),
('FCKIp1NXdLEjmfGt51QZ', 'Mf6W6qlBJHTKfuHvYAU3', 'coffe sun', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQD', 25000, '1', '2025-01-07 00:00:00', 'canceled-nv', 'uncomplete'),
('pPByXX3NsYod9AJfvZ8g', '2HlAt1Q5SXCXAbrw7DPq', 'đức', 2134256789, 'quangminh04072004@gmail.com', 'nhà tao', 'home', 'net banking', '42NTYGSINKAhPfghM8IS', 35000, '99', '2025-01-08 00:00:00', 'delivered', 'complete'),
('Ae1rftnWBaE3kGrS2RTk', '2HlAt1Q5SXCXAbrw7DPq', 'Quang Doanh', 2134256789, 'quangdoanh04072004@gmail.com', 'nhà tao', 'home', 'cash on delivery', '42NTYGSINKAhPfghM8IS', 35000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('KsgaPzwz1UH76Bo544u8', '2HlAt1Q5SXCXAbrw7DPq', 'Quan', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2ET', 30000, '1', '2025-01-08 00:00:00', 'canceled-nv', 'uncomplete'),
('rQvMU36ZPBM4gvnqL7Dd', '2HlAt1Q5SXCXAbrw7DPq', 'Tue', 2134256789, 'quangdoanh04072004@gmail.com', '266 tran nguyen han', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-08 08:38:31', 'delivered', 'complete'),
('2qZUlUY2XzlbvK8gjRY8', '2HlAt1Q5SXCXAbrw7DPq', 'QuangDoanh', 2134256789, 'bbalicka06@gmail.com', '266 tran nguyen han', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7D', 30000, '1', '2025-01-08 08:41:05', 'canceled-nv', 'uncomplete'),
('zWteftkPXNGt5W41G19n', '2HlAt1Q5SXCXAbrw7DPq', 'Minh', 2134256789, 'daxoyol656@bulatox.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC8C', 30000, '3', '2025-01-08 09:10:56', 'delivered', 'complete'),
('p5KK2ZvGmCUjOUYCFg3a', 'Mf6W6qlBJHTKfuHvYAU3', 'Phương', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-08 18:36:11', 'delivered', 'complete'),
('tBFEHCrOqkAOH7YbGrh1', 'Mf6W6qlBJHTKfuHvYAU3', 'Phương', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2ET', 30000, '1', '2025-01-08 18:36:11', 'delivered', 'complete'),
('z8lxKN7uP9gmhxYsdESa', 'Mf6W6qlBJHTKfuHvYAU3', 'Phương', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQD', 25000, '10', '2025-01-08 18:36:11', 'delivered', 'complete'),
('TJPiUZzmPDTnhb7e4Ox0', 'Mf6W6qlBJHTKfuHvYAU3', 'Việt', 2134256789, 'quangminh04072004@gmail.com', '266 tran nguyen han', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2ET', 30000, '1', '2025-01-09 08:17:28', 'canceled-nv', 'uncomplete'),
('qQla6M3Zh3UdfLLD8AgS', 'Mf6W6qlBJHTKfuHvYAU3', 'Tuệ', 386926902, 'quangdoanh04072004@gmail.com', '456', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQD', 25000, '1', '2025-01-09 08:19:10', 'delivered', 'complete'),
('A8ocy4uZiJSA6oracqZb', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-02 00:00:00', 'delivered', 'complete'),
('a1utsHKuI3BRdU6lry8s', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('A0UB1OZE3NOagxsUqp2z', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 50000, '1', '2025-01-04 00:00:00', 'canceled-nv', 'uncomplete'),
('2olO3j6gvLPlO5TfEcgT', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-05 00:00:00', 'canceled-nv', 'uncomplete'),
('Gp20nAOs8TXMkXCMMQyA', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-06 00:00:00', 'canceled-nv', 'uncomplete'),
('s2w384Ka9b4IEJPKNWy5', '', 'Quang Doanh', 386926955, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('u6SvWW9ZA8dCFzz1ygmd', '', 'coffe', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('wE7TXrikQuFDP1O9HkPW', '', 'coffe', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-09 00:00:00', 'delivered', 'complete'),
('jG6NHUJzXQCrsPC1', 'wBfcaz2zJ9U3omEe5A0f', 'Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-01 00:00:00', 'delivered', 'complete'),
('A8ocy4uZiJSA6oracqZb', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-01 00:00:00', 'delivered', 'complete'),
('a1utsHKuI3BRdU6lry8s', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-01 00:00:00', 'delivered', 'complete'),
('A0UB1OZE3NOagxsUqp2z', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 50000, '1', '2025-01-01 00:00:00', 'delivered', 'complete'),
('2olO3j6gvLPlO5TfEcgT', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-01 00:00:00', 'delivered', 'complete'),
('u6SvWW9ZA8dCFzz1ygmd', '', 'coffe', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-01 00:00:00', 'canceled-nv', 'uncomplete'),
('jG6NHUJzXQCrsPC2', 'wBfcaz2zJ9U3omEe5A0f', 'Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-02 00:00:00', 'delivered', 'complete'),
('A8ocy4uZiJSA6oracqZb', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-02 00:00:00', 'delivered', 'complete'),
('a1utsHKuI3BRdU6lry8s', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-02 00:00:00', 'delivered', 'complete'),
('A0UB1OZE3NOagxsUqp2z', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 50000, '1', '2025-01-02 00:00:00', 'delivered', 'complete'),
('2olO3j6gvLPlO5TfEcgT', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-02 00:00:00', 'canceled-nv', 'uncomplete'),
('Gp20nAOs8TXMkXCMMQyA', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-02 00:00:00', 'canceled-nv', 'uncomplete'),
('jG6NHUJzXQCrsPC3', 'wBfcaz2zJ9U3omEe5A0f', 'Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('A8ocy4uZiJSA6oracqZc', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('a1utsHKuI3BRdU6lry8t', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('A0UB1OZE3NOagxsUqp3z', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 50000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('2olO3j6gvLPlO5TfEcgU', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('Gp20nAOs8TXMkXCMMQyB', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('s2w384Ka9b4IEJPKNWy6', '', 'Quang Doanh', 386926955, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('u6SvWW9ZA8dCFzz1ygmc', '', 'coffe', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('wE7TXrikQuFDP1O9HkPW', '', 'coffe', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('mj4acmLym2xI42hsdkTU', '', 'Quang Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-03 00:00:00', 'delivered', 'complete'),
('tQTkeZ8ZKJkrjBclN96P', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-03 00:00:00', 'canceled-nv', 'uncomplete'),
('dGl9UQKfQfozmj5Q83DZ', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-03 00:00:00', 'canceled-nv', 'uncomplete'),
('fKcZodb4wSmxbD5XeCp8', 'Mf6W6qlBJHTKfuHvYAU3', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'BQDirWqv8ZXMXb28NZh4', 120000, '3', '2025-01-03 00:00:00', 'canceled-nv', 'uncomplete'),
('jG6NHUJzXQCrsPC3', 'wBfcaz2zJ9U3omEe5A0f', 'Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('A8ocy4uZiJSA6oracqZc', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('a1utsHKuI3BRdU6lry8t', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('A0UB1OZE3NOagxsUqp3z', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 50000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('2olO3j6gvLPlO5TfEcgU', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('Gp20nAOs8TXMkXCMMQyB', 'Mf6W6qlBJHTKfuHvYAU3', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('s2w384Ka9b4IEJPKNWy6', '', 'Quang Doanh', 386926955, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('u6SvWW9ZA8dCFzz1ygmc', '', 'coffe', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('wE7TXrikQuFDP1O9HkPW', '', 'coffe', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('mj4acmLym2xI42hsdkTU', '', 'Quang Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-04 00:00:00', 'delivered', 'complete'),
('tQTkeZ8ZKJkrjBclN96P', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-04 00:00:00', 'canceled-nv', 'uncomplete'),
('dGl9UQKfQfozmj5Q83DZ', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-04 00:00:00', 'canceled-nv', 'uncomplete'),
('fKcZodb4wSmxbD5XeCp8', 'Mf6W6qlBJHTKfuHvYAU3', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'BQDirWqv8ZXMXb28NZh4', 120000, '3', '2025-01-04 00:00:00', 'canceled-nv', 'uncomplete'),
('LytU7Aco7t8XoGp9Vco4', '', 'QuangDoanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('Q0Rl8wFLc0OygT75Vf6Q', '', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('OHmbNTGzql9x0HsmDFGp', '', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('hH1Er6f8eNop51Zy6Oea', 'FwFw38dWyoGn45JW6Chz', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('E4cnXITlhIpf8Ez5k0b2', '', 'Doanh', 386926955, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 50000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('wI8q5lEZm5y4XhZD1FkD', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('ZI1lV5d1s1XTqmrhr1s8', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('Qk0ae16hAp5V8yLje43f', '', 'coffe', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('Zfi5UIu3gEl67Jtxw0qs', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-05 00:00:00', 'canceled-nv', 'uncomplete'),
('tQTkeZ8ZKJkrjBclN96P', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-05 00:00:00', 'canceled-nv', 'uncomplete'),
('dGl9UQKfQfozmj5Q83DZ', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-05 00:00:00', 'canceled-nv', 'uncomplete'),
('LytU7Aco7t8XoGp9Vco4', '', 'QuangDoanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('Q0Rl8wFLc0OygT75Vf6Q', '', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('OHmbNTGzql9x0HsmDFGp', '', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('hH1Er6f8eNop51Zy6Oea', 'FwFw38dWyoGn45JW6Chz', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('E4cnXITlhIpf8Ez5k0b2', '', 'Doanh', 386926955, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 50000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('wI8q5lEZm5y4XhZD1FkD', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('ZI1lV5d1s1XTqmrhr1s8', 'wBfcaz2zJ9U3omEe5A0f', 'Hương', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('Qk0ae16hAp5V8yLje43f', '', 'coffe', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-05 00:00:00', 'delivered', 'complete'),
('Zfi5UIu3gEl67Jtxw0qs', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-05 00:00:00', 'canceled-nv', 'uncomplete'),
('tQTkeZ8ZKJkrjBclN96P', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-05 00:00:00', 'canceled-nv', 'uncomplete'),
('dGl9UQKfQfozmj5Q83DZ', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-05 00:00:00', 'canceled-nv', 'uncomplete'),
('DhN1u8NO83tBbYZ7JpVA', '', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('fmrHfLOJpC1VsTcK2uyA', '', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('R9qGz2lN7d5w3jyt3AsV', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('Up4b5AmK9lZk2FhWzD7f', '', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('wOvn0D04jGFNNXHphdAI', '', 'Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('Bdfhb3fZ5nCK6HEuHeFf', '', 'Doanh', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('9mu3I5v2xK2sHUd0onxO', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('J8TKvZyGqFzizTxS6c7f', 'FwFw38dWyoGn45JW6Chz', 'Hương', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('2xwZGKo9O1z8Osjp5ovm', '', 'coffe', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-06 00:00:00', 'delivered', 'complete'),
('aqLxkIKfs7ZL6dMByxFu', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-06 00:00:00', 'canceled-nv', 'uncomplete'),
('dGl9UQKfQfozmj5Q83DZ', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-06 00:00:00', 'canceled-nv', 'uncomplete'),
('Vg9kzq6jPmQUtW2jF6Dr', '', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('r9m1lUM9pTbSgbLo1Zz8', '', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('zR7Xu2hH2VZGJY2gQ5In', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('aP0dLnTp8oGNs7gKbI4s', '', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('Xz3vwY7k5z3XuFT6UlG5', '', 'Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('pTGbQo84sH5KwA5G2sHV', '', 'Doanh', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('fvbn2Jz6rBtk5F9l1vAm', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('2ukOFpzkMwUs8w4zTHpk', 'FwFw38dWyoGn45JW6Chz', 'Hương', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('ynz5Hcs9kRzkWxNQwksZ', '', 'coffe', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-07 00:00:00', 'delivered', 'complete'),
('lKOnICwJQp5thW5Tw7QU', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-07 00:00:00', 'canceled-nv', 'uncomplete'),
('mfrVk7G0Z3wRLpSkJ9Pe', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-07 00:00:00', 'canceled-nv', 'uncomplete'),
('c9yXi3mV6HdFmvPzPo9b', '', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'ei8xgUPBnIflamN8JT2e', 60000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('vKlYe3FbD9dVhcUi2Eg4', '', 'Hương', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('wQ1Skm4tB8ThKUmG4Jne', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('kN0gU2rC4t2Zu3yO0B3B', '', 'Phuoc', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('oI7tKlLt1v9DmlVJ0zV6', '', 'Doanh', 386926955, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('q2ftz9rb9g8XqvZ7gpyy', '', 'Doanh', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('dPmxKh6L4kJvxT7Fg8Pf', 'FwFw38dWyoGn45JW6Chz', 'Doanh', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'credit or debit card', 'BQDirWqv8ZXMXb28NZh4', 120000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('b5HqL5vH1RzV1yK8ZOfY', 'FwFw38dWyoGn45JW6Chz', 'Hương', 2134256789, 'quangminh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'a9F3jT9aWkjNw7d1BC7Z', 25000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('c9vNhA0kMh5tZp0e0WJz', '', 'coffe', 2134256789, 'bbalicka06@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-08 00:00:00', 'delivered', 'complete'),
('m0QkL9iFb4Fq0FdJzFea', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'COBhevQXjTi59yOeHzxp', 90000, '1', '2025-01-08 00:00:00', 'canceled-nv', 'uncomplete'),
('h1fFr3G5uA5xN9B8QfLm', 'FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 2134256789, 'quangdoanh04072004@gmail.com', '54 Triều Khúc', 'home', 'cash on delivery', 'g8FR2y8jtiJCiWjO2JQW', 15000, '1', '2025-01-08 00:00:00', 'canceled-nv', 'uncomplete');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_detail` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `product_detail`, `status`) VALUES
('COBhevQXjTi59yOeHzxp', 'Bột cà phê xay ', 90000, 'card.jpg', 'Bột cà phê xay nguyên chất được chế biến từ những hạt cà phê Arabica và Robusta chất lượng cao. Quá trình xay tỉ mỉ giúp bột có độ mịn hoàn hảo, lý tưởng cho việc pha phin truyền thống. Hương thơm nồng nàn, vị đắng nhẹ hòa quyện cùng chút chua thanh tạo nên một ly cà phê tròn vị. Sản phẩm đóng gói kín, đảm bảo giữ được hương vị lâu dài. Phù hợp cho những buổi sáng thư giãn bên ly cà phê đậm đà.', 'deactive'),
('BQDirWqv8ZXMXb28NZh4', 'Hạt Cà Phê Rang', 120000, 'thumb.jpg', 'Hạt cà phê rang nguyên chất được tuyển chọn từ những nông trại trồng cà phê nổi tiếng. Các hạt được rang ở nhiệt độ chuẩn, giữ trọn hương vị thơm nồng và đắng nhẹ đặc trưng. Khi xay và pha chế, bạn sẽ cảm nhận được hương thơm quyến rũ lan tỏa khắp không gian. Sản phẩm phù hợp để pha phin hoặc máy pha espresso. Đối với những ai yêu cà phê nguyên bản, đây là lựa chọn không thể bỏ qua.', 'deactive'),
('ei8xgUPBnIflamN8JT2e', 'Capuchino', 60000, 'hinh-uong-cafe.jpg', 'Cabuchi No Cafe Đá là thức uống pha sẵn dành cho những người yêu thích hương vị cà phê mạnh mẽ. Được chiết xuất từ hạt cà phê Robusta nguyên chất, loại cafe này mang đến vị đắng đậm đà và hậu vị ngọt nhẹ. Sản phẩm được đóng chai tiện lợi, phù hợp cho người bận rộn. Khi thưởng thức lạnh, bạn sẽ cảm nhận được sự tỉnh táo và sảng khoái tức thì. Đây là lựa chọn hoàn hảo để khởi đầu ngày mới tràn đầy năng lượng.', 'active'),
('g8FR2y8jtiJCiWjO2JQW', 'Bánh bao chiên', 20000, 'thumb1.jpg', 'Bánh bao chiên giòn nhân thịt, với lớp vỏ ngoài giòn rụm và nhân thịt thơm ngon bên trong, là món ăn lý tưởng cho bữa sáng hoặc bữa phụ. Được chế biến từ nguyên liệu tươi ngon, bánh bao chiên mang lại hương vị đặc trưng không thể cưỡng lại.', 'deactive'),
('42NTYGSINKAhPfghM8IS', 'cafe nóng', 35000, 'thumb2.jpg', 'Cà phê nóng là thức uống quen thuộc, mang lại cảm giác ấm áp và thư thái, đặc biệt trong những buổi sáng se lạnh hay lúc cần sự tập trung. Tách cà phê nóng thơm lừng với hương vị đậm đà, kết hợp giữa vị đắng đặc trưng và hậu vị ngọt nhẹ, là lựa chọn hoàn hảo để khởi đầu ngày mới. Dù là cà phê đen nguyên chất hay pha cùng sữa đặc, mỗi cách thưởng thức đều mang lại nét riêng biệt, giúp tinh thần tỉnh táo và tràn đầy năng lượng. Cầm trên tay tách cà phê nóng, nhấp từng ngụm nhỏ, cảm nhận sự quyến rũ của từng giọt là một thú vui tao nhã khó cưỡng.', 'active'),
('g8FR2y8jtiJCiWjO2JQD', 'Cafe sữa', 25000, 'thumb0.jpg', 'Cafe sữa được pha chế từ những hạt cà phê chất lượng, đem lại hương vị đậm đà, thơm ngon và đầy sức sống. Đây là sự lựa chọn lý tưởng cho những ai yêu thích cafe mạnh mẽ. Với hương thơm nồng nàn, mỗi ngụm cafe nóng sẽ giúp bạn cảm thấy tỉnh táo và tràn đầy năng lượng để bắt đầu một ngày mới.', 'active'),
('a9F3jT9aWkjNw7d1BC7D', 'Bạc sỉu', 30000, 'thumb2.jpg', 'Bạc sỉu được pha chế từ những hạt cà phê chất lượng, đem lại hương vị đậm đà, thơm ngon và đầy sức sống. Đây là sự lựa chọn lý tưởng cho những ai yêu thích cafe mạnh mẽ. Với hương thơm nồng nàn, mỗi ngụm cafe nóng sẽ giúp bạn cảm thấy tỉnh táo và tràn đầy năng lượng để bắt đầu một ngày mới.', 'active'),
('g8FR2y8jtiJCiWjO2ET', 'Cafe nguyên chất', 30000, 'card1.jpg', 'Cafe nguyên chất được pha chế từ những hạt cà phê chất lượng, đem lại hương vị đậm đà, thơm ngon và đầy sức sống. Đây là sự lựa chọn lý tưởng cho những ai yêu thích cafe mạnh mẽ. Với hương thơm nồng nàn, mỗi ngụm cafe nóng sẽ giúp bạn cảm thấy tỉnh táo và tràn đầy năng lượng để bắt đầu một ngày mới.', 'active'),
('a9F3jT9aWkjNw7d1BC8C', 'Cafe đánh trứng', 30000, 'thumb0.jpg', 'Bạc sỉu được pha chế từ những hạt cà phê chất lượng, đem lại hương vị đậm đà, thơm ngon và đầy sức sống. Đây là sự lựa chọn lý tưởng cho những ai yêu thích cafe mạnh mẽ. Với hương thơm nồng nàn, mỗi ngụm cafe nóng sẽ giúp bạn cảm thấy tỉnh táo và tràn đầy năng lượng để bắt đầu một ngày mới.', 'active');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'user',
  `bom` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `bom`) VALUES
('YYtGXXaBGSozHnlH7D60', 'Đào Quang Doanh', 'daoquangdoanh@gmail.com', '123', 'user', 0),
('FwFw38dWyoGn45JW6Chz', 'QuangDoanh', 'quangminh04072004@gmail.com', '123', 'user', 0),
('wBfcaz2zJ9U3omEe5A0f', 'QuangDoanh', 'quangdoanh04072004@gmail.com', '1', 'user', 2),
('Mf6W6qlBJHTKfuHvYAU3', 'coffe', 'bbalicka06@gmail.com', '1', 'user', 1),
('IZg4gfZbxsIAGj7ml3Za', 'Doanh', 'daxoyol656@bulatox.com', '1', 'user', 0),
('2HlAt1Q5SXCXAbrw7DPq', 'đức', 'a@gmail.com', '123', 'user', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

