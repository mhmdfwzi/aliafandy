-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 04:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loloafandy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `super_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `user_name`, `email`, `password`, `phone_number`, `super_admin`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '$2y$10$uvaDUeIBUXQqd9fTSXb3mO1evQHkK5zJCLssAqKNsMCQQZB962DSi', '01001942600', 1, 'active', '2023-07-12 11:06:46', '2023-07-12 11:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 'المقاس', 1, NULL, NULL),
(2, 'الالوان', 1, NULL, NULL),
(3, 'صورة اخري', 1, NULL, NULL),
(4, 'حصى - مطحون', 1, NULL, NULL),
(5, 'مقاس الحذاء', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `name`, `value`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 1, '', 'x-small', 1, '2023-08-02 16:10:39', '2023-08-02 16:10:39'),
(2, 1, '', 'Small', 1, '2023-08-02 16:11:31', '2023-08-02 16:11:31'),
(3, 1, '', 'Medium', 1, '2023-08-02 16:11:52', '2023-08-02 16:11:52'),
(4, 1, '', 'Large', 1, '2023-08-02 16:12:09', '2023-08-02 16:12:09'),
(5, 1, '', 'XL/1X', 1, '2023-08-02 16:12:23', '2023-08-02 16:12:23'),
(6, 1, '', '2X', 1, '2023-08-02 16:12:42', '2023-08-02 16:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cookie_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `measure` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '1.00',
  `size` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `percent` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `image`, `featured`, `status`, `percent`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'مواد غذائية', 'moad-ghthayy', 'خضروات , فاكهه, لحوم, دواجن,اسماك, حبوب, معلبات, سوبر ماركت, مشروبات,', 'categories/2992QyuidIbibjCGvKqPwnHIGAhptH1svwrD3enM.jpg', 1, 'active', NULL, NULL, '2023-06-28 20:21:21', '2023-06-28 20:21:21'),
(2, NULL, 'ملابس واحذية واكسسوار نسائية', 'mlabs-oahthy-oakssoar', 'ملابس رجالى , ملابس نسائية , ملابس اطفالى, احذية رجالى, احذية نسائية, احذية اطفالى , نظارات, ساعات, شنط يد رجالى, شنط نسائية', 'categories/rhAVrFQsnHuu8KP8GcPG22fPNiv8n6mpqnCkYnBS.jpg', 1, 'active', NULL, NULL, '2023-06-29 02:34:22', '2023-07-28 06:51:26'),
(3, NULL, 'منظفات وادوات نظافة', 'mnthfat-oadoat-nthaf', 'مسحوق غسيل , منظف ارضيات, منظف اوانى, معطر الغرف ورقيات', 'categories/ZUhWx3C5NulsLbO2egDkCYNgXziCL5e9QDiGcWCU.jpg', 1, 'active', NULL, NULL, '2023-06-29 02:36:32', '2023-06-29 02:36:32'),
(4, NULL, 'الجمال والعناية الشخصية', 'algmal-oalaanay-alshkhsy', 'بريفيوم رجالى, بيرفيوم نسائى , العناية بالبشرة,العناية بالشعر', 'categories/5FrVHQYZswCHZBBa9bomawNdoRNE2G6IwAvtX1ws.jpg', 1, 'active', NULL, NULL, '2023-06-29 02:37:28', '2023-06-29 02:37:28'),
(5, NULL, 'موبايل وكمبيوتر', 'mobayl-okmbyotr', 'كمبيوتر وموبايل اكسسوار موبايل ,', 'categories/vlXll79wgxiJnyR800PQVhzxv71cY9dTE4vWR45W.webp', 1, 'active', NULL, NULL, '2023-06-29 02:38:46', '2023-06-29 02:38:46'),
(6, 1, 'خضروات', 'khdroat', 'خضراوات اورجانيك طازة مغسولة منتقاه بعناية', 'categories/oqndqxPfoBLnIweQHHPGJ17hvTl4IjrQhWFzGDFC.jpg', 1, 'active', NULL, NULL, '2023-06-29 02:39:45', '2023-06-29 02:39:45'),
(7, 1, 'لحوم', 'lhom', 'لحوم بلدى طازجة قطعيات مناسبة لكل انواع المأكولات', 'categories/723gQHWN08FKfEHapCyrDDFpzP2jMOiLaEGW6VnE.jpg', 1, 'active', NULL, NULL, '2023-06-29 02:48:59', '2023-06-29 02:48:59'),
(8, 1, 'دواجن', 'doahn', 'منتجات الدواجن  الطازجة مجهزة فى نفس اليوم', 'categories/O2ULhKQVXKQ1w2n321pR4MaO4iW2Ji5PdluM9COP.jpg', 1, 'active', NULL, NULL, '2023-06-29 02:49:49', '2023-06-29 02:49:49'),
(9, 1, 'اطعمة مجمدة', 'albkal-oalhbob-oaltoabl', NULL, 'categories/gylZmcwhqGE8DUJcvFcpKPzO86c6HS8PN2Fl8KY1.jpg', 1, 'active', NULL, NULL, '2023-06-29 02:51:47', '2023-07-28 08:38:58'),
(10, 1, 'جبن والبان', 'gbn-oalban', 'جبن والبان', 'categories/ZFDgjUbT4czYv1tSq9Qppe7RGcaX5MrPgy4lgmLu.jpg', 1, 'active', NULL, NULL, '2023-06-29 02:53:30', '2023-06-29 02:53:30'),
(11, 1, 'مخبوزات', 'mkhbozat', 'مخبوزات طازجة', 'categories/hQkezxZQcNMynCCOgO4hCtm4QHeK6Y8Bsq9kZSbF.jpg', 1, 'active', NULL, NULL, '2023-06-29 02:54:34', '2023-06-29 02:54:34'),
(12, 1, 'فواكه', 'foakh', 'فواكه اورجانيك طازة مغسولة منتقاه بعناية', 'categories/U7anW2Wvj6ByNoP9uzC79KV49DSGYlEaeTARluYL.jpg', 1, 'active', NULL, NULL, '2023-06-29 03:00:32', '2023-06-29 03:00:32'),
(13, 5, 'موبايل', 'mobayl', 'كل انواع اجهزة الموبايل', 'categories/xrhaon1Te70yZDPjzs5K8ZHuwMlXyNWtH8wxVEOU.jpg', 1, 'active', NULL, NULL, '2023-07-16 20:59:04', '2023-07-28 07:05:36'),
(14, 5, 'اكسسوار الموبايل', 'mmm', 'سمعات هيدفون , جرابات ,سكرين', 'categories/Zb8YbfU1kO0LZbNMOhryP2N8kZQNQ9T19HmVls7S.webp', 1, 'active', NULL, NULL, '2023-07-16 21:05:56', '2023-07-16 21:05:56'),
(15, 5, 'كابلات وشواحن', 'kablat-oshoahn-mobayl', 'كابلات وشواحن', 'categories/9UGZRay7yfgVg2opCgiFoXawVW2g8KYPvVDkruhT.png', 1, 'active', NULL, NULL, '2023-07-16 21:09:56', '2023-07-28 07:06:27'),
(16, 2, 'ملابس خروج', 'mlabs-nsayy', 'ملابس نسائية', 'categories/yU4Nfzy1AnhBOtkQvNF9Dqfudnzw4F3k4w5FfZ63.jpg', 0, 'active', NULL, NULL, '2023-07-26 08:01:56', '2023-07-28 06:56:44'),
(17, 2, 'احذية', 'ahthy-nsayy', NULL, 'categories/Gf9UivqKCGhBZ3yVwhgzxvrgqTPL4uTptSz1CTO2.png', 0, 'active', NULL, NULL, '2023-07-26 08:06:26', '2023-07-28 06:58:04'),
(18, 1, 'اسماك طازجة', 'asmak-tazg', 'اسماك طازجة', 'categories/4GN1kBAqG9bNIp0RTx5CYvPPSLptQcJUnbUORhBE.jpg', 1, 'active', NULL, NULL, '2023-07-27 10:42:42', '2023-07-28 06:31:22'),
(19, 1, 'البقاله والحبوب', 'mgmdat', 'سكر  ارز مكرونة', 'categories/yf0uJHupdNB5BGFyuFW0x6eeyZwQgwnuuzaze3AR.jpg', 0, 'active', NULL, NULL, '2023-07-27 11:23:06', '2023-07-28 08:37:23'),
(20, 1, 'مشروبات وعصائر', 'mshrobat-oaasayr', 'مشروبات ساخنة شاى , قهوة, عصائر معلبه, مشروبات غازيه', 'categories/a03pe4No8469a6bBZWTRw93JS1AUgjNYECNfR7U9.jpg', 0, 'active', NULL, NULL, '2023-07-27 15:10:03', '2023-07-27 15:10:03'),
(21, 4, 'البشرة', 'alaanay-balbshr', 'سكين كير', 'categories/XlJpUlMIa8Khw64VzIzSGz0cScXmiv4qsvncvc9R.jpg', 0, 'active', NULL, NULL, '2023-07-28 05:56:29', '2023-07-29 11:58:32'),
(22, 4, 'الشعر', 'alaanay-balshaar', 'العناية بالشعر', 'categories/XFfRipSW5O495Z1DgoxXMyvQz9ZE73JCAxIomwhb.jpg', 0, 'active', NULL, NULL, '2023-07-28 05:59:46', '2023-07-29 11:59:43'),
(23, 4, 'العناية الشخصية', 'aanay-shkhsy', NULL, 'categories/Wy4vhmLLJ0b0f5Pq5t3fw8HYpzfg8U7e9bnZvs2P.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:03:50', '2023-07-29 11:57:30'),
(24, 4, 'المكياج', 'almkyag', NULL, 'categories/JWkfka78jXdSkyMQjb6F5oYL33zg0eRVi5V15BRB.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:06:49', '2023-07-28 06:06:49'),
(25, 4, 'البرفيوم', 'albrfyom', NULL, 'categories/A94bu6XFUERM722Es9MkOf2xlszAZa8PsqUN8Wm7.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:08:43', '2023-07-28 06:08:43'),
(26, 4, 'ازالة الشعر', 'azal-alshaar', NULL, 'categories/8GWhCSgapsZo6JR5PM2KR1slp04LZBjX7MF6txXw.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:14:19', '2023-07-28 06:14:19'),
(27, 4, 'لوازم الاستحمام', 'loazm-alasthmam', NULL, 'categories/z6cSo7DKPh5rrCO0Z0a2eEEgGdIOZB9XZqZDNZE4.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:19:02', '2023-07-28 06:19:02'),
(28, 3, 'غسيل الملابس', 'ghsyl-almlabs', 'مساحيق غسيل  الملابس', 'categories/h93Fd0OamzKjQn9IlvQsAKPq7Jq2PhxjFrFwNG1L.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:24:56', '2023-07-28 06:24:56'),
(29, 3, 'منظفات ارضيات', 'mnthf-ardyat', NULL, 'categories/Sg4Mtlaghqdh8vK9um0zqDLyEAkR4sTxpqaxGgzB.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:27:39', '2023-07-28 07:07:34'),
(30, 3, 'معطرات للمنزل', 'maatrat-llmnzl', NULL, 'categories/23mTCI5j39Cuu0p0yioDXwxjtVzqOcrx5v5rchye.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:31:03', '2023-07-28 06:31:03'),
(31, 2, 'نظارات', 'ntharat', NULL, 'categories/9usNXnPJgzINEirpLL2AeWDvYlpBamsnl2v8fZgq.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:35:22', '2023-07-28 06:35:22'),
(32, 2, 'شنط يد', 'ahthy-oshnt', NULL, 'categories/WjZXANd9d8v6YTsy4dP9FVbhTMVORWNlJm0N9Jdl.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:46:31', '2023-07-28 07:01:32'),
(33, 2, 'ملابس منزل', 'mlabs-mnzl', NULL, 'categories/RC5MO79WdoUhaSKz0DQ4itfESKT1slcp2E4mHwcs.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:48:46', '2023-07-28 06:48:46'),
(34, 2, 'لانجيري', 'mlabs-dakhlyh', NULL, 'categories/zuPMz4mIzY7sv6OG1N8XV5xAw4Fn5WiQZzUmR1UT.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:50:58', '2023-08-01 03:38:08'),
(35, 2, 'ساعات انيقة', 'saaaat-anyk', NULL, 'categories/LaSuVbqzE5MrVHU94vYCS5lxN1GAyEBLKp7tTo6z.jpg', 0, 'active', NULL, NULL, '2023-07-28 06:53:13', '2023-07-28 06:56:04'),
(36, 1, 'توابل وبهارات', 'toabl-obharat', NULL, 'categories/ClJjbAW9woQzAKWc5SffD0PBNM2AHPx7Xxc2TBDR.jpg', 0, 'active', NULL, NULL, '2023-07-28 08:13:19', '2023-07-28 08:16:05'),
(37, 2, 'ايشارب وطرحة', 'aysharb-otrh', NULL, 'categories/BdGYcRoDcK8YpSGAADdUGCFg9zzX7L2d0PQJD4FK.jpg', 0, 'active', NULL, NULL, '2023-07-31 13:31:15', '2023-07-31 13:31:15'),
(38, 1, 'خضار جاهز', 'khdar-gahz', NULL, 'categories/sqEOp3y0w57ZNXeakSEtsaCPs56HMtKJAJE2Nvua.jpg', 0, 'active', NULL, NULL, '2023-07-31 13:34:28', '2023-07-31 13:34:28'),
(39, 5, 'ملحقات كمبيوتر', 'mlhkat-kmbyotr', NULL, 'categories/UMLZLiJcMc8cL0eWEwBUpWdpXK4zeLSZBOsSk59M.jpg', 0, 'active', NULL, NULL, '2023-07-31 14:02:03', '2023-07-31 14:02:03'),
(40, 5, 'اجهزة كمبيوتر', 'aghz-kmbyotr', NULL, 'categories/iNC2Zspz9wQXK5VsLvOsY4d2AgSJ7H01Y2eFik0B.jpg', 0, 'active', NULL, NULL, '2023-07-31 14:02:27', '2023-07-31 14:02:27'),
(41, 5, 'لابتوب', 'labtob', NULL, 'categories/4r2K6S9PLUoAHNE4TwR2Onpbq6iTS2yd5aFZznzv.jpg', 0, 'active', NULL, NULL, '2023-07-31 14:02:46', '2023-07-31 14:02:46'),
(42, 5, 'شاشات كمبيوتر', 'shashat-kmbyotr', NULL, 'categories/Bq7aOcWPIC2avTwq1rq1XSS3nP3bPNAfAF0r95Ul.jpg', 0, 'active', NULL, NULL, '2023-07-31 14:05:07', '2023-08-01 04:44:04'),
(43, 3, 'ادوات نظافة', 'adoat-nthaf', NULL, 'categories/fhKNyPMuPpWky9v0gFbBQNiFHG1Mg7P78gqoOFVq.jpg', 0, 'active', NULL, NULL, '2023-07-31 14:12:56', '2023-07-31 14:12:56'),
(44, 3, 'ورقيات', 'orkyat', NULL, 'categories/doMGzasIMpfOlWc6Zcmud2n1nQfySKSzmkxaqSRP.jpg', 0, 'active', NULL, NULL, '2023-07-31 14:25:17', '2023-07-31 14:25:17'),
(45, 2, 'اكسسورات', 'akssorat', NULL, 'categories/pJfBMFFKjHIu3bjWXGtvhtEQ4pPkHmh2PJYKLhHG.jpg', 0, 'active', NULL, NULL, '2023-07-31 14:32:51', '2023-07-31 14:32:51'),
(46, 3, 'منظف اطباق', 'mnthf-atbak', NULL, 'categories/pOVwhQt6kiqBqYxInljxlMYc3WGrFp7Ol1qwnX5z.png', 0, 'active', NULL, NULL, '2023-07-31 15:22:16', '2023-07-31 15:23:26'),
(47, NULL, 'ملابس واكسسوار رجالى', 'mlabs-oakssoar-rgal', 'ملابس رجاليى واكسسوار  احذية وساعات وشنط', 'categories/jeO4tYP13qG7RndPLTOScsS2zfqgh7iTYOZ7Qvec.jpg', 0, 'active', NULL, NULL, '2023-07-31 15:29:26', '2023-07-31 15:29:26'),
(48, 47, 'خروج', 'khrog', NULL, 'categories/aKLtCQzzUuG0Oz8vOo1ooKiDL668N8M3aE0ebhv0.jpg', 0, 'active', NULL, NULL, '2023-07-31 15:30:25', '2023-07-31 16:07:20'),
(49, 47, 'ملابس للمنزل', 'mlabs-llmnzl', NULL, 'categories/Fl1y2zZiumS8ntxgLjxfHrQ6UDInJFw8CoXq3cfh.jpg', 0, 'active', NULL, NULL, '2023-07-31 16:10:30', '2023-07-31 16:10:30'),
(50, 47, 'ملابس داخلية', 'mlabs-dakhly', NULL, 'categories/xQDu88V54FqGiQPII1xsCHjyODfEIBbyfVNTEM50.jpg', 0, 'active', NULL, NULL, '2023-07-31 16:11:25', '2023-07-31 16:20:22'),
(51, 47, 'ساعات رجالى', 'saaaat-rgal', NULL, 'categories/cEVtfGIo643mL2jDv1dvaSBrGgyUsSlRd7klCkp8.jpg', 0, 'active', NULL, NULL, '2023-07-31 16:11:41', '2023-07-31 16:16:55'),
(52, 47, 'شنطة يد', 'shnt-yd', NULL, 'categories/LsYjlucTW4jMpar8PriwqwNBSAKvk82jAOAG7WME.jpg', 0, 'active', NULL, NULL, '2023-07-31 16:11:58', '2023-07-31 16:11:58'),
(53, 47, 'احذية رجاليه', 'ahthy-rgalyh', NULL, 'categories/DAjzF73rZfaZe5Te8fHiKyaV8raoxa8JKWtaasd5.jpg', 0, 'active', NULL, NULL, '2023-07-31 16:12:23', '2023-08-01 06:58:22'),
(54, 47, 'ملابس رياضية', 'mlabs-ryady', NULL, 'categories/1nw6Xgs2yr0N5rBy2soH8tT1BmqXgvpmTaOdgSV8.jpg', 0, 'active', NULL, NULL, '2023-07-31 16:12:44', '2023-07-31 16:12:44'),
(55, 2, 'ملابس رياضيه', 'mlabs-ryadyh', NULL, 'categories/IRfQWEPytSJjC1HzbIuS5OdjqhfO7h4HV18kNIyo.jpg', 0, 'active', NULL, NULL, '2023-07-31 16:15:29', '2023-07-31 16:17:27'),
(59, NULL, 'ملابس اطفال ومستلزمات البيبي', 'mlabs-atfal-omstlzmat-albyby', NULL, 'categories/VXq1MS1J64zVdBVqmwRXV7yKQh4WHQ44exVyncGM.jpg', 0, 'active', NULL, NULL, '2023-08-01 03:52:24', '2023-08-01 03:52:24'),
(64, 2, 'لبس داخلى', 'lbs-dakhl', NULL, 'categories/TGOUxllhnPIb6F2OeOZ7qM2YNWjAMrme7vaeL1Zm.jpg', 0, 'active', NULL, NULL, '2023-08-01 04:26:44', '2023-08-01 04:28:06'),
(65, 59, 'اولادى خروج', 'aolad-khrog', NULL, 'categories/rIRSr2aTpKtNTNx5Q7DjmWGhtrgdFEyqYVIvwDHh.jpg', 0, 'active', NULL, NULL, '2023-08-01 04:33:42', '2023-08-01 04:33:42'),
(66, 59, 'بناتى خروج', 'bnat-khrog', NULL, 'categories/ea6IpKdUDcWZgNlyh627JrK8Q21i6aREAjIjc0tH.jpg', 0, 'active', NULL, NULL, '2023-08-01 04:35:46', '2023-08-01 04:38:47'),
(67, 59, 'احذية اولادى', 'ahthy-aolad', NULL, 'categories/A2eYTDKcGG4PmvKqeyxrltSLFc2NBuo6NXN8WWi9.jpg', 0, 'active', NULL, NULL, '2023-08-01 04:36:30', '2023-08-01 04:36:30'),
(68, 59, 'احذية بناتى', 'ahthy-bnat', NULL, 'categories/26amh86dnC0NHyJBm93u8SyRR4r4UWswc8s3F4Bp.jpg', 0, 'active', NULL, NULL, '2023-08-01 04:36:49', '2023-08-01 04:36:49'),
(69, 59, 'حديثى الولادة', 'hdyth-alatfal', NULL, 'categories/JYptm5XNchX77QTpOnepZWEvZtoIUCGgq9g2DJYp.jpg', 0, 'active', NULL, NULL, '2023-08-01 04:41:36', '2023-08-01 07:01:40'),
(70, 59, 'حفاضات', 'hfadat', NULL, 'categories/oV7dMiCwJmjaMQ1tGgx5oqZiGnZgxOFUwPqc3krl.jpg', 0, 'active', NULL, NULL, '2023-08-01 04:41:58', '2023-08-01 04:41:58'),
(71, 47, 'نظارات رجالى', 'ntharat-rgal', NULL, 'categories/H3p7p4N7uVpHD1EZZ9Aew3yVWgVTECwFMrveBT70.jpg', 0, 'active', NULL, NULL, '2023-08-01 07:28:29', '2023-08-01 07:28:29'),
(72, NULL, 'Back To School', 'back-to-school', 'ادوات مدرسيه', 'categories/WpCa0UoKQwPiDNk982nMLXh9EbrFU0L3SyMMMSKi.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:23:01', '2023-08-07 15:23:01'),
(73, NULL, 'كتب خارجية', 'ktb-khargy', NULL, 'categories/hDdfup776cfpL8BeWYVHOUnWUQcYk2iyb9lGrclJ.jpg', 0, 'inactive', NULL, NULL, '2023-08-07 15:23:35', '2023-08-07 15:23:35'),
(74, 73, 'KG1', 'kg1', NULL, 'categories/xC2hzALH9UcLxh3JZoAgdm6p4mPWSZIA3LXqG5PV.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:38:08', '2023-08-07 15:38:08'),
(75, 73, 'KG2', 'kg2', NULL, 'categories/UD4eey19mqKY5uFl9t54FtOFJNFIuyTjQVNJ53Pl.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:39:12', '2023-08-07 15:39:12'),
(76, 73, 'أولي ابتدائي', 'aoly-abtdayy', NULL, 'categories/8MAS5HIgNmWETfyS36mGjj6AROP8lpfaWSHP05L5.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:40:21', '2023-08-07 15:40:21'),
(77, 73, 'تانيه التدائي', 'tanyh-altdayy', NULL, 'categories/e7576XIah8YCzpnSv06iBXNevlOSPHzGzgr40DzP.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:41:49', '2023-08-07 15:41:49'),
(78, 73, 'تالته ابتدائي', 'talth-abtdayy', NULL, 'categories/MoIYbOFDndLXGy6etCccs6EYF1OeD5UdGG3GpwY3.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:44:27', '2023-08-07 15:44:27'),
(79, 73, 'رابعة ابتدائي', 'rabaa-abtdayy', NULL, 'categories/lbhUbRm3XXi00X3dw9Jk4z3RR9Tnz9hnHWfP5jEW.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:44:53', '2023-08-07 15:44:53'),
(80, 73, 'خامسة ابتدائي', 'khams-abtdayy', NULL, 'categories/kiY1YqgC52x3mLhcBVkf2NU4znnL84NaKZelQXyS.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:45:42', '2023-08-07 15:45:42'),
(81, 73, 'السادس الابتدائي', 'alsads-alabtdayy', NULL, 'categories/toRgoDTcKbjrfRv56RT4IHvpC2BZEjXDPCCOOSOY.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:46:37', '2023-08-07 15:46:37'),
(82, 73, 'الاول الاعدادى', 'alaol-alaaadad', NULL, 'categories/aI9AyYoiznV7QI738C9pGjoLohDvbPLVKWnkhS1Y.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:53:16', '2023-08-07 15:53:16'),
(83, 73, 'الثانى الاعدادى', 'althan-alaaadad', NULL, 'categories/FUoVoZsNckziQWX55f7CpK9oTmFYKjlLT8Xvn72r.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:54:09', '2023-08-07 15:54:09'),
(84, 73, 'الثالث الاعدادى', 'althalth-alaaadad', NULL, 'categories/AOC4YkWsjaW0tsKTzZd1C9VOp1h9sIiRtVtevHX1.jpg', 0, 'active', NULL, NULL, '2023-08-07 15:54:43', '2023-08-07 15:56:14'),
(85, 72, 'شنطة مدرسه', 'shnt-mdrsh', NULL, 'categories/Wphr656zfjZBoS9Gw8TT80Fy81hI0rJb6a5X4eDw.jpg', 0, 'active', NULL, NULL, '2023-08-07 16:10:28', '2023-08-07 16:10:28'),
(86, 72, 'لانش بوكس', 'lansh-boks', NULL, 'categories/eC0LtrLwCVoHUvLQoyrCOs1Km2SfHS1PjK7b3mYL.jpg', 0, 'active', NULL, NULL, '2023-08-07 16:10:57', '2023-08-07 16:10:57'),
(87, 72, 'زمزميه', 'zmzmyh', NULL, 'categories/uIzQBuTh6YrAMVGQxSRX6wrKxfkJZ3TrbWtu7W6B.jpg', 0, 'active', NULL, NULL, '2023-08-07 16:11:16', '2023-08-07 16:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_percentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usage_limit` smallint(6) NOT NULL,
  `usage_count` smallint(6) NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order`
--

CREATE TABLE `delivery_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cart_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_location` point DEFAULT NULL,
  `order_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_delivery_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `parent_id`, `name`, `rank`, `price`, `created_at`, `updated_at`) VALUES
(1, NULL, 'مصر', '0', NULL, '2023-07-01 15:27:15', '2023-07-01 15:27:15'),
(2, 1, 'القليوبية', '1', NULL, '2023-07-01 15:29:15', '2023-07-01 15:29:15'),
(3, 2, 'بنها', '2', NULL, '2023-07-01 15:29:45', '2023-07-01 15:29:45'),
(4, 3, 'الفلل', '3', 15.00, '2023-07-01 15:46:56', '2023-07-01 15:46:56'),
(5, 3, 'كفر السرايا', '3', 15.00, '2023-07-01 15:55:58', '2023-07-01 15:55:58'),
(6, 3, 'اهرام', '3', 15.00, '2023-07-01 15:56:22', '2023-07-01 15:56:22'),
(7, 3, 'أتريب', '3', 15.00, '2023-07-01 15:56:35', '2023-07-01 15:56:35'),
(8, 3, 'عزبة المربع', '3', 15.00, '2023-07-01 15:56:48', '2023-07-01 15:56:48'),
(9, 3, 'وسط البلد', '3', 15.00, '2023-07-01 15:57:02', '2023-07-01 15:57:02'),
(10, 3, 'الشدية', '3', 15.00, '2023-07-01 15:57:18', '2023-07-01 15:57:18'),
(11, 3, 'المنشية', '3', 15.00, '2023-07-01 15:57:30', '2023-07-01 15:57:30'),
(12, 3, 'حي الزهور', '3', 15.00, '2023-07-01 15:57:45', '2023-07-01 15:57:45'),
(13, 3, 'منشية النور', '3', 15.00, '2023-07-01 15:58:07', '2023-07-01 15:58:07'),
(14, 3, 'الحرس الوطني', '3', 15.00, '2023-07-01 15:58:23', '2023-07-01 15:58:23'),
(15, 3, 'الموالح', '3', 15.00, '2023-07-01 15:58:34', '2023-07-01 15:58:34'),
(16, 3, 'عزبة الزراعة', '3', 15.00, '2023-07-01 15:58:55', '2023-07-01 15:58:55'),
(17, 3, 'كفر مناقر', '3', 15.00, '2023-07-01 15:59:08', '2023-07-01 15:59:08'),
(18, 3, 'كفر الجزار', '3', 15.00, '2023-07-01 15:59:23', '2023-07-01 15:59:23'),
(19, 3, 'الرملة', '3', 20.00, '2023-07-01 15:59:43', '2023-07-01 15:59:43'),
(20, 3, 'ميت العطار', '3', 20.00, '2023-07-01 16:00:02', '2023-07-01 16:00:02'),
(21, 3, 'الشموت', '3', 20.00, '2023-07-01 16:00:31', '2023-07-01 16:00:31'),
(22, 3, 'بتمدة', '3', 25.00, '2023-07-01 16:00:50', '2023-07-01 16:00:50'),
(23, 3, 'جزيرة بلى', '3', 25.00, '2023-07-01 16:01:05', '2023-07-01 16:01:05'),
(24, 3, 'جمجرة', '3', 25.00, '2023-07-01 16:01:20', '2023-07-01 16:01:20'),
(25, 3, 'دجوي', '3', 25.00, '2023-07-01 16:01:32', '2023-07-01 16:01:32'),
(26, 3, 'طحلة', '3', 25.00, '2023-07-01 16:01:51', '2023-07-01 16:01:51'),
(27, 3, 'فرسيس', '3', 25.00, '2023-07-01 16:02:08', '2023-07-01 16:02:08'),
(28, 3, 'كفر أبو زهرة', '3', 25.00, '2023-07-01 16:02:24', '2023-07-01 16:02:24'),
(29, 3, 'كفر الأربعين', '3', 15.00, '2023-07-01 16:02:40', '2023-07-01 16:02:40'),
(30, 3, 'كفر الحصة', '3', 25.00, '2023-07-01 16:04:39', '2023-07-01 16:04:39'),
(31, 3, 'كفر الحمام', '3', 25.00, '2023-07-01 16:04:55', '2023-07-01 16:04:55'),
(32, 3, 'كفر الشموت', '3', 25.00, '2023-07-01 16:05:08', '2023-07-01 16:05:08'),
(33, 3, 'كفر الشيخ إبراهيم', '3', 25.00, '2023-07-01 16:05:28', '2023-07-01 16:05:28'),
(34, 3, 'كفر سعد', '3', 20.00, '2023-07-01 16:05:45', '2023-07-01 16:05:45'),
(35, 3, 'كفر سندنهور', '3', 25.00, '2023-07-01 16:05:58', '2023-07-01 16:05:58'),
(36, 3, 'كفر طحلة', '3', 25.00, '2023-07-01 16:06:12', '2023-07-01 16:06:12'),
(37, 3, 'كفر عطا الله', '3', 25.00, '2023-07-01 16:06:29', '2023-07-01 16:06:29'),
(38, 3, 'كفر مويس', '3', 25.00, '2023-07-01 16:06:44', '2023-07-01 16:06:44'),
(39, 3, 'مجول', '3', 25.00, '2023-07-01 16:07:04', '2023-07-01 16:07:04'),
(40, 3, 'منشأة أبو دياب', '3', 25.00, '2023-07-01 16:07:21', '2023-07-01 16:07:21'),
(41, 3, 'منية السباع', '3', 25.00, '2023-07-01 16:07:35', '2023-07-01 16:07:35'),
(42, 3, 'ميت راضي', '3', 25.00, '2023-07-01 16:07:50', '2023-07-01 16:07:50'),
(43, 3, 'ميت عاصم', '3', 25.00, '2023-07-01 16:08:11', '2023-07-01 16:08:11'),
(44, 3, 'نقباس', '3', 25.00, '2023-07-01 16:08:30', '2023-07-01 16:08:30'),
(45, 3, 'بطا', '3', 20.00, '2023-07-01 16:09:42', '2023-07-01 16:09:42'),
(46, 3, 'بقيرة', '3', 20.00, '2023-07-01 16:09:58', '2023-07-01 16:09:58'),
(47, 3, 'كفر أبو ذكري', '3', 20.00, '2023-07-01 16:10:16', '2023-07-01 16:10:16'),
(48, 3, 'كفر بطا', '3', 20.00, '2023-07-01 16:10:28', '2023-07-01 16:10:28'),
(49, 3, 'سندنهور', '3', 25.00, '2023-07-01 16:11:21', '2023-07-01 16:11:21'),
(50, 3, 'كفر فرسيس', '3', 25.00, '2023-07-01 16:11:42', '2023-07-01 16:11:42'),
(51, 3, 'دملو', '3', 20.00, '2023-07-01 16:12:19', '2023-07-01 16:12:19'),
(52, 3, 'ميت الحوفين', '3', 20.00, '2023-07-01 16:12:35', '2023-07-01 16:12:35'),
(55, 3, 'ورورة', '3', 25.00, '2023-07-01 16:13:47', '2023-07-01 16:13:47'),
(56, 3, 'كفر العرب', '3', 25.00, '2023-07-01 16:14:57', '2023-07-01 16:14:57'),
(57, 3, 'مرصفا', '3', 25.00, '2023-07-01 16:15:08', '2023-07-01 16:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_03_21_174046_create_categories_table', 1),
(5, '2023_03_21_194241_create_destinations_table', 1),
(6, '2023_03_21_194242_create_stores_table', 1),
(7, '2023_03_21_194243_create_store_categories_table', 1),
(8, '2023_03_22_141160_create_brands_table', 1),
(9, '2023_03_22_141161_create_products_table', 1),
(10, '2023_03_22_141162_create_coupons_table', 1),
(11, '2023_03_22_141162_create_vendors_table', 1),
(12, '2023_03_23_000000_create_users_table', 1),
(13, '2023_03_24_071216_create_profiles_table', 1),
(14, '2023_03_24_150215_create_tags_table', 1),
(15, '2023_03_24_150346_create_product_tag_table', 1),
(16, '2023_03_26_120117_create_carts_table', 1),
(17, '2023_03_27_120031_create_orders_table', 1),
(18, '2023_03_27_121715_create_order_items_table', 1),
(19, '2023_03_27_122550_create_order_addresses_table', 1),
(20, '2023_03_28_190017_create_notifications_table', 1),
(21, '2023_03_29_183948_create_admins_table', 1),
(22, '2023_03_29_200000_add_two_factor_columns_to_users_table', 1),
(23, '2023_04_16_234637_create_roles_table', 1),
(24, '2023_04_16_235207_create_role_abilities_table', 1),
(25, '2023_04_16_235633_create_role_user_table', 1),
(26, '2023_04_30_135245_create_banners_table', 1),
(27, '2023_04_30_201919_create_website_parts_table', 1),
(28, '2023_05_08_034011_create_attributes_table', 1),
(29, '2023_05_08_034012_create_attribute_values_table', 1),
(30, '2023_05_08_034013_create_product_variant_table', 1),
(31, '2023_05_21_105955_create_reviews_table', 1),
(32, '2023_06_13_042324_create_order_coupons_table', 1),
(33, '2023_06_16_035000_create_temp_session', 1),
(34, '2023_06_26_010532_create_delivery_table', 1),
(35, '2023_06_26_012258_create_delivery_order_table', 1),
(36, '2023_07_05_132505_create_user_codes', 1),
(37, '2023_07_18_180203_add_short_description_to_products', 1),
(38, '2023_08_15_063310_create_vendor_stores_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('1e4bea13-bee4-4267-a3f0-0f99f1ae34dd', 'App\\Notifications\\OrderCreatedNotification', 'App\\Models\\Admin', 1, '{\"body\":\"A new Order #20230001\",\"icon\":\"fas fa-file\",\"url\":\"http:\\/\\/localhost:8000\\/admin\\/dashboard\",\"order_id\":1}', NULL, '2023-12-10 16:08:35', '2023-12-10 16:08:35'),
('27068d78-2a58-40b6-9f6d-43974dfa82d5', 'App\\Notifications\\OrderCreatedNotification', 'App\\Models\\Vendor', 1, '{\"body\":\"A new Order #20230001\",\"icon\":\"fas fa-file\",\"url\":\"http:\\/\\/localhost:8000\\/vendor\\/dashboard\",\"order_id\":1}', NULL, '2023-12-10 16:08:36', '2023-12-10 16:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cart_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','processing','delivering','completed','cancelled','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `shipping` double(8,2) NOT NULL DEFAULT 0.00,
  `percent` double(8,2) NOT NULL DEFAULT 0.00,
  `tax` double(8,2) NOT NULL DEFAULT 0.00,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `store_id`, `user_id`, `cart_id`, `number`, `payment_method`, `status`, `payment_status`, `shipping`, `percent`, `tax`, `coupon_id`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 33, '6fc7cc5f-168b-4209-8d3f-4f96a74e2b19', '20230001', 'cash_on_delivery', 'pending', 'pending', 25.00, 22.50, 0.00, NULL, 450.00, '2023-12-10 16:08:35', '2023-12-10 16:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

CREATE TABLE `order_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('billing','shipping') COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `governorate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `neighborhood_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_addresses`
--

INSERT INTO `order_addresses` (`id`, `order_id`, `type`, `first_name`, `last_name`, `email`, `phone_number`, `street_address`, `governorate_id`, `city_id`, `neighborhood_id`) VALUES
(1, 1, 'billing', 'محمد', 'فوزى', NULL, '01001942600', '1', 2, 3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `order_coupons`
--

CREATE TABLE `order_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `measure` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '1.00',
  `size` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `options`, `measure`, `size`, `color`) VALUES
(1, 1, 7, 'ستربس دجاج طازج', 232.50, 1, NULL, '1.5', NULL, NULL),
(2, 1, 8, 'شيش طاووق طازج', 217.50, 1, NULL, '1.5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `compare_price` double(8,2) DEFAULT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `offer` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `product_type` enum('normal','best_seller','new_arrival','top_rated','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `measure` enum('unite','kg','gram') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unite',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `store_id`, `category_id`, `name`, `brand_id`, `slug`, `description`, `short_description`, `image`, `price`, `compare_price`, `quantity`, `featured`, `offer`, `status`, `product_type`, `measure`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 24, 'مسكره ايسنس لاش', NULL, 'mskrh-aysns-lash', NULL, 'مسكره ايسنس لاش\r\nمسكره ايسنس لاش', 'products/1702189789.jpeg', 175.00, 175.00, 1, 0, 0, 'active', 'normal', 'unite', NULL, '2023-12-10 06:29:49', '2023-12-10 06:30:25'),
(2, 3, 22, 'شامبو لوريال الفيف الموف 600 مللي', NULL, 'shambo-loryal-alfyf-almof-600-mlly', NULL, 'شامبو لوريال الفيف الموف 600 مللي', 'products/1702251232.jpg', 95.00, 95.00, 1, 0, 0, 'active', 'normal', 'unite', NULL, '2023-12-10 06:46:01', '2023-12-10 23:33:53'),
(3, 3, 22, 'كريم بليس للشعر الكيرلي', NULL, 'krym-blys-llshaar-alkyrly', NULL, 'كريم بليس للشعر الكيرلي', 'products/1702190825.jpg', 65.00, 65.00, 1, 0, 0, 'active', 'normal', 'unite', NULL, '2023-12-10 06:47:05', '2023-12-10 06:47:05'),
(4, 2, 12, 'ليمون بلدى', NULL, 'lymon-bld', NULL, 'ليمون فاكهة حمضية مهمة ومفيدة لجسم الإنسان. ويعود ذلك حيث أن الليمون يدخل في المواد التي تعمل على الحفاظ على صحة القلب. كما أنه مقوي للمناعة وطارد للسموم. ويقوي المعدة ويحافظ عليها من البكتيريا المهاجمة لها. يساهم في موت الخلايا السرطانية ويقوم بدور مهم في تنظيم الكلى.', 'products/1702192043.jpg', 15.00, 15.00, 1, 0, 0, 'active', 'normal', 'kg', NULL, '2023-12-10 07:07:23', '2023-12-10 07:19:37'),
(5, 2, 12, 'موز مغربي', NULL, 'moz-mghrby', NULL, 'الموز من الفواكه الصحية المتوفرة بالصيف والشتاء، كما أنه يعد من المصادر المهمة في تجديد الطاقة بالجسم، ويساهم في حل مشاكل الإسهال الخاصة بالأطفال، كما أن الموز يحتوي على الكثير من العناصر الغذائية المهمة والتركيبات الكيميائية المتواجدة بالموز من فيتامينات ومعادن وأحماض أمنية يحتاجها الجسم.', 'products/1702192883.jpg', 15.00, 15.00, 1, 0, 0, 'active', 'normal', 'kg', NULL, '2023-12-10 07:21:23', '2023-12-10 07:21:23'),
(6, 2, 12, 'تفاح اصفر سكري', NULL, 'tfah-asfr-skry', NULL, 'فاكهة الشتاء والصيف والتي لا غنى عنها ومحبوبة إلى الكثير والكثير من الناس، وهي من الفواكه المصدرة للأسواق العالمية وتحتوي على الفيتامينات المعادن التي تعمل على الحفاظ على صحة العظام بالجسم ومد الجسم بالطاقة اللازمة وتقوية المناعة وحماية القلب والجهاز الهضمي.', 'products/1702192945.jpg', 60.00, 60.00, 1, 0, 0, 'active', 'normal', 'kg', NULL, '2023-12-10 07:22:25', '2023-12-10 07:22:25'),
(7, 1, 8, 'ستربس دجاج طازج', NULL, 'strbs-dgag-tazg', NULL, 'ستربس الدجاج هي عباره عن شرايح من صدور الدجاج ومتبلة ومتحمرة ،من اطعم الاكلات ومحببة جدا عن الاطفال ويمكن تناولها في عيش او مع مكرونة او ارز ورغم سهولتها الا كثير من الناس يتناولها في المطاعم ، اعرف طريقة عمل ستربس الدجاج المقرمش بتتبيله مميزة وطعم لايقاوم من المطبخ', 'products/1702193086.jpg', 165.00, 155.00, 0, 0, 0, 'active', 'normal', 'kg', NULL, '2023-12-10 07:24:46', '2023-12-11 01:05:00'),
(8, 1, 8, 'شيش طاووق طازج', NULL, 'shysh-taook-tazg', NULL, 'الشيش طاووق هو عبارة عن صدور الفراخ المخلية والمقطعة، يحبه الأولاد ويقبلون على شرائه من المحال الخارجية «شيش طاووق» هي من أصل اللغة التركية، وتعني سيخ من لحم الدجاج، أي أن شيش معناها سيخ الحديد أو العود الذي يتم وضع مكعبات الدجاج به ليشوى على الفحم،أما كلمة طاووق فمعناها الدجاج»', 'products/1702193163.jpg', 145.00, 145.00, 0, 0, 0, 'active', 'normal', 'unite', NULL, '2023-12-10 07:26:03', '2023-12-11 00:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_abilities`
--

CREATE TABLE `role_abilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `ability` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('allow','deny','inherit') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `authorizable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorizable_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `percent` int(11) DEFAULT NULL,
  `phone_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `governorate` bigint(20) UNSIGNED DEFAULT NULL,
  `city` bigint(20) UNSIGNED DEFAULT NULL,
  `neighborhood` bigint(20) UNSIGNED DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `slug`, `description`, `logo_image`, `cover_image`, `status`, `percent`, `phone_number`, `governorate`, `city`, `neighborhood`, `street_address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'اسواق الاهرام للدواجن', 'asoak-alahram-lldoagn', NULL, 'stores/1702187159.jpg', 'stores/1702187160.jpg', 'active', 5, '01095954467', 2, 3, 6, 'خلف مسجد ابراهيم مرسى', NULL, '2023-12-10 05:46:00', '2023-12-10 05:46:00'),
(2, 'ام فاروق', 'am-farok', NULL, 'stores/1702187358.jpg', 'stores/1702187358.jpg', 'active', 5, '01222879885', 2, 3, 10, 'شارع عبد الحافظ', NULL, '2023-12-10 05:49:18', '2023-12-10 05:49:18'),
(3, 'لمسة جمال', 'lms-gmal', NULL, 'stores/1702187455.jpg', 'stores/1702187456.jpg', 'active', 5, '01210333282', 2, 3, 9, 'خلف صيدناوى', NULL, '2023-12-10 05:50:56', '2023-12-10 05:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

CREATE TABLE `store_categories` (
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_categories`
--

INSERT INTO `store_categories` (`store_id`, `category_id`) VALUES
(1, 8),
(2, 6),
(2, 12),
(3, 21),
(3, 22),
(3, 23),
(3, 24),
(3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_session`
--

CREATE TABLE `temp_session` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT 0,
  `governorate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `neighborhood_id` bigint(20) UNSIGNED DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_active_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_address`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `gender`, `phone_number`, `isVerified`, `governorate_id`, `city_id`, `neighborhood_id`, `postal_code`, `street_address`, `last_active_at`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(25, 'ali', 'afandy', 'alimhmdfwzi@gmail.com', '2023-09-28 11:33:00', '$2y$10$MO2zT3ZiRo3MO3xP36N6UebIWpsSM5jBqycE7/OtK9i9.vLVrUVs.', NULL, NULL, NULL, 'male', '01555361715', 0, 2, 3, 14, NULL, 'ش حنكريشة', '2023-10-22 09:16:24', 'H6x6mZpEIKZVUfTtAPrFUy0a6Zo4NgAcYc7uRwknJB3dKDNhYlsAZ1HyxDmD', NULL, '2023-09-26 09:35:14', '2023-10-22 09:16:24'),
(28, 'عمر', 'محمد', NULL, '2023-10-14 03:35:48', '$2y$10$w4JQBmpGO3u1BOLIKH/D1uUuvyhjvE0vJdKeoS9ZTaNEHUlBAuZwa', NULL, NULL, NULL, 'male', '01032072464', 0, 2, 3, 25, NULL, 'خط البطاوية بعد الجامع', '2023-10-14 04:53:08', 'OzJwx5Ny0Kvz8K3IAObzElD2onzAFS5iWxGDxzzT1PQT8tktfOtjPo84Llvq', NULL, '2023-10-14 03:34:47', '2023-10-14 04:53:08'),
(33, 'محمد', 'فوزى', NULL, '2023-10-14 08:08:26', '$2y$10$4z0nG7Nzk.XvLtAVkyRfq.PMbB5M3c2gSr76fn9OBuT70df0NodVW', NULL, NULL, NULL, 'male', '01001942600', 0, 2, 3, 25, NULL, '1', '2023-12-10 16:08:38', 'P2i8NincgG', NULL, '2023-10-14 08:08:07', '2023-12-10 16:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_codes`
--

CREATE TABLE `user_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `password`, `phone`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 'اسواق الاهرام', NULL, '$2y$10$63E7y/f57GrU7jsnKiJvKu.oqkImKyw92Pf6AU/CE2zEceVPGulDi', '01001942600', 1, '2023-12-10 06:06:33', '2023-12-10 06:06:33'),
(2, 'om farouk', NULL, '$2y$10$lqAUR9oKUoJX5n.p3/FCoOVQNv77n0O3eJezFlEXQ2hIHIDdRsQ0K', '01032072464', 2, '2023-12-10 06:11:50', '2023-12-10 06:11:50'),
(3, 'lamsetgmal', NULL, '$2y$10$ijK9mMTIPQM9fW8EOUMzfeX4pcdPYnI1eXsGOceZWp4XqCEdbdB8y', '01017031520', 3, '2023-12-10 06:13:02', '2023-12-10 06:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_stores`
--

CREATE TABLE `vendor_stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `website_parts`
--

CREATE TABLE `website_parts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_parts`
--

INSERT INTO `website_parts` (`id`, `key`, `value`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Slider', '1', '', NULL, NULL),
(2, 'Featured Categories Section', '1', '', NULL, NULL),
(3, 'Trending Product Section', '1', '', NULL, NULL),
(4, 'Banner Section', '0', '', NULL, NULL),
(5, 'Special Offers Section', '0', '', NULL, NULL),
(6, 'Home Product List Section', '0', '', NULL, NULL),
(7, 'Brands Section', '1', '', NULL, NULL),
(8, 'Blog Section', '0', '', NULL, NULL),
(9, 'Shipping Info Section', '1', '', NULL, NULL),
(10, 'Best Sellers', '1', '', NULL, NULL),
(11, 'New Arrivals', '1', '', NULL, NULL),
(12, 'Top Rated', '1', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_number_unique` (`phone_number`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attributes_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`),
  ADD KEY `attribute_values_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_cookie_id_product_id_unique` (`cookie_id`,`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`),
  ADD KEY `coupons_store_id_foreign` (`store_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delivery` (`email`),
  ADD KEY `delivery_category_id_foreign` (`category_id`);

--
-- Indexes for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_order_delivery_id_foreign` (`delivery_id`),
  ADD KEY `delivery_order_order_id_foreign` (`order_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `destinations_name_unique` (`name`),
  ADD KEY `destinations_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_number_unique` (`number`),
  ADD KEY `orders_store_id_foreign` (`store_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_addresses_order_id_foreign` (`order_id`),
  ADD KEY `order_addresses_governorate_id_foreign` (`governorate_id`),
  ADD KEY `order_addresses_city_id_foreign` (`city_id`),
  ADD KEY `order_addresses_neighborhood_id_foreign` (`neighborhood_id`);

--
-- Indexes for table `order_coupons`
--
ALTER TABLE `order_coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_coupons_order_id_foreign` (`order_id`),
  ADD KEY `order_coupons_coupon_id_foreign` (`coupon_id`),
  ADD KEY `order_coupons_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_items_order_id_product_id_unique` (`order_id`,`product_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_store_id_foreign` (`store_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`product_id`,`tag_id`),
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_attribute_id_foreign` (`attribute_id`),
  ADD KEY `product_variant_attribute_value_id_foreign` (`attribute_value_id`),
  ADD KEY `product_variant_product_id_foreign` (`product_id`),
  ADD KEY `product_variant_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_abilities`
--
ALTER TABLE `role_abilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_abilities_role_id_ability_unique` (`role_id`,`ability`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`authorizable_id`,`authorizable_type`,`role_id`),
  ADD KEY `role_user_authorizable_type_authorizable_id_index` (`authorizable_type`,`authorizable_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stores_slug_unique` (`slug`),
  ADD KEY `stores_governorate_foreign` (`governorate`),
  ADD KEY `stores_city_foreign` (`city`),
  ADD KEY `stores_neighborhood_foreign` (`neighborhood`);

--
-- Indexes for table `store_categories`
--
ALTER TABLE `store_categories`
  ADD PRIMARY KEY (`store_id`,`category_id`),
  ADD KEY `store_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `temp_session`
--
ALTER TABLE `temp_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_session_coupon_id_foreign` (`coupon_id`),
  ADD KEY `temp_session_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_address_unique` (`email_address`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD KEY `users_governorate_id_foreign` (`governorate_id`),
  ADD KEY `users_city_id_foreign` (`city_id`),
  ADD KEY `users_neighborhood_id_foreign` (`neighborhood_id`);

--
-- Indexes for table `user_codes`
--
ALTER TABLE `user_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendorss` (`email`),
  ADD KEY `vendors_store_id_foreign` (`store_id`);

--
-- Indexes for table `vendor_stores`
--
ALTER TABLE `vendor_stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_stores_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendor_stores_store_id_foreign` (`store_id`);

--
-- Indexes for table `website_parts`
--
ALTER TABLE `website_parts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_order`
--
ALTER TABLE `delivery_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_coupons`
--
ALTER TABLE `order_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_abilities`
--
ALTER TABLE `role_abilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_session`
--
ALTER TABLE `temp_session`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_codes`
--
ALTER TABLE `user_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor_stores`
--
ALTER TABLE `vendor_stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_parts`
--
ALTER TABLE `website_parts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `attributes_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_values_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD CONSTRAINT `delivery_order_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `delivery_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD CONSTRAINT `order_addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_addresses_governorate_id_foreign` FOREIGN KEY (`governorate_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_addresses_neighborhood_id_foreign` FOREIGN KEY (`neighborhood_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_coupons`
--
ALTER TABLE `order_coupons`
  ADD CONSTRAINT `order_coupons_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_coupons_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_coupons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_abilities`
--
ALTER TABLE `role_abilities`
  ADD CONSTRAINT `role_abilities_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_city_foreign` FOREIGN KEY (`city`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `stores_governorate_foreign` FOREIGN KEY (`governorate`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `stores_neighborhood_foreign` FOREIGN KEY (`neighborhood`) REFERENCES `destinations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `store_categories`
--
ALTER TABLE `store_categories`
  ADD CONSTRAINT `store_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_categories_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `temp_session`
--
ALTER TABLE `temp_session`
  ADD CONSTRAINT `temp_session_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `temp_session_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_governorate_id_foreign` FOREIGN KEY (`governorate_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_neighborhood_id_foreign` FOREIGN KEY (`neighborhood_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vendor_stores`
--
ALTER TABLE `vendor_stores`
  ADD CONSTRAINT `vendor_stores_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendor_stores_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
