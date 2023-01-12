-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2022 at 10:19 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bolg_21a`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `img`, `status`) VALUES
(1, 'Mr. admin', 'admin@mail.com', '$2y$10$Clunkrww2jw6q7rb9rLVU.AePt6Cs5RiQK9Z7WzrNzEBXlA3auNye', NULL, 1),
(2, 'Abir', 'abir@mail.com', '$2y$10$h1mhfF451p3jWcEqfSyuzuKBOWHMEjZ9Q11i/YKO8SDdP2QlVAMzy', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `name`, `slug`) VALUES
(1, 'জেলা', 'জেলা'),
(2, 'বাংলাদেশ', 'বাংলাদেশ');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint NOT NULL,
  `admin_id` bigint NOT NULL,
  `catagory_id` bigint NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_published` enum('Published','Draft') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `admin_id`, `catagory_id`, `title`, `slug`, `description`, `image`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'জনগণ ভোট দিতে পারলে এই সরকারের পাত্তা থাকবে না: খন্দকার মোশাররফ', 'জনগণ-ভোট-দিতে-পারলে-এই-সরকারের-পাত্তা-থাকবে-না:-খন্দকার-মোশাররফ', '<p>এর আগে গণমিছিল কর্মসূচির সমন্বয়ক ও বিএনপির ভাইস চেয়ারম্যান এ জেড এম জাহিদ হোসেন এবং দলের ঢাকা মহানগর উত্তর কমিটির আহ্বায়ক আমানউল্লাহ আমান বক্তব্য দেন। সমাবেশের পর বেলা সাড়ে তিনটায় নয়াপল্টন থেকে গণমিছিল শুরু হয়।</p><p><br></p><p>গণমিছিলটি কাকরাইল, শান্তিনগর, মালিবাগ হয়ে বিকেল ৪টা ১০ মিনিটে মগবাজার মোড়ে গিয়ে পৌঁছায়। সেখানে দলের স্থায়ী কমিটির সদস্য গয়েশ্বর চন্দ্র রায় সমাপনী বক্তব্য দেন। জুমার নামাজের আগেই হাজার হাজার নেতা-কর্মী নয়াপল্টনের ভিআইপি সড়কে অবস্থান নেন। একপর্যায়ে তা কাকরাইল থেকে ফকিরাপুল বাজার পর্যন্ত ছড়িয়ে যায়। কর্মসূচি মগবাজার মোড়ে এসে শেষ হলেও নেতা-কর্মীরা ফিরতি মিছিল নিয়ে আবার একই পথে নয়াপল্টনে যান।</p>', 'uploads/post/63af0743ce84b8505.webp', 'Draft', '2022-12-30 15:44:03', NULL),
(2, 1, 1, 'শ্যামলীর সভায় আ.লীগ নেতারা: বিএনপির আন্দোলন ‘ফ্লপ’ করেছে', 'শ্যামলীর-সভায়-আ.লীগ-নেতারা:-বিএনপির-আন্দোলন-‘ফ্লপ’-করেছে', '<p>বিএনপি আবারও আগুন-সন্ত্রাসের রাজনীতি শুরু করেছে দাবি করে আওয়ামী লীগের নেতারা বলেছেন, বিএনপি সন্ত্রাস করলে, আওয়ামী লীগের নেতা-কর্মীরা ঘরে বসে থাকবেন না। বিএনপির আন্দোলন ইতিমধ্যে ‘ফ্লপ’ করেছে। বিএনপির নৈরাজ্য জনগণ আর মেনে নেবে না।</p><p><br></p><p>আজ শুক্রবার রাজধানীর শ্যামলী স্কয়ার শপিং মলের সামনে আয়োজিত সমাবেশে দলের নেতারা এসব কথা বলেন। ঢাকায় বিএনপির গণমিছিলকে সামনে রেখে এ সমাবেশের আয়োজন করে ঢাকা মহানগর উত্তর আওয়ামী লীগ।</p>', 'uploads/post/63af07bf0c39298397.webp', 'Published', '2022-12-30 15:46:07', NULL),
(3, 1, 1, 'জনগণ ভোট দিতে পারলে এই সরকারের পাত্তা থাকবে না: খন্দকার মোশাররফ', 'জনগণ-ভোট-দিতে-পারলে-এই-সরকারের-পাত্তা-থাকবে-না:-খন্দকার-মোশাররফ', '                                            <p>এর আগে গণমিছিল কর্মসূচির সমন্বয়ক ও বিএনপির ভাইস চেয়ারম্যান এ জেড এম জাহিদ হোসেন এবং দলের ঢাকা মহানগর উত্তর কমিটির আহ্বায়ক আমানউল্লাহ আমান বক্তব্য দেন। সমাবেশের পর বেলা সাড়ে তিনটায় নয়াপল্টন থেকে গণমিছিল শুরু হয়।</p><p><br></p><p>গণমিছিলটি কাকরাইল, শান্তিনগর, মালিবাগ হয়ে বিকেল ৪টা ১০ মিনিটে মগবাজার মোড়ে গিয়ে পৌঁছায়। সেখানে দলের স্থায়ী কমিটির সদস্য গয়েশ্বর চন্দ্র রায় সমাপনী বক্তব্য দেন। জুমার নামাজের আগেই হাজার হাজার নেতা-কর্মী নয়াপল্টনের ভিআইপি সড়কে অবস্থান নেন। একপর্যায়ে তা কাকরাইল থেকে ফকিরাপুল বাজার পর্যন্ত ছড়িয়ে যায়। কর্মসূচি মগবাজার মোড়ে এসে শেষ হলেও নেতা-কর্মীরা ফিরতি মিছিল নিয়ে আবার একই পথে নয়াপল্টনে যান।</p>                                        ', '', 'Published', '2022-12-30 22:05:21', NULL),
(4, 1, 1, 'জনগণ ভোট দিতে পারলে এই সরকারের পাত্তা থাকবে না: খন্দকার মোশাররফ', 'জনগণ-ভোট-দিতে-পারলে-এই-সরকারের-পাত্তা-থাকবে-না:-খন্দকার-মোশাররফ', '                                            <p>এর আগে গণমিছিল কর্মসূচির সমন্বয়ক ও বিএনপির ভাইস চেয়ারম্যান এ জেড এম জাহিদ হোসেন এবং দলের ঢাকা মহানগর উত্তর কমিটির আহ্বায়ক আমানউল্লাহ আমান বক্তব্য দেন। সমাবেশের পর বেলা সাড়ে তিনটায় নয়াপল্টন থেকে গণমিছিল শুরু হয়।</p><p><br></p><p>গণমিছিলটি কাকরাইল, শান্তিনগর, মালিবাগ হয়ে বিকেল ৪টা ১০ মিনিটে মগবাজার মোড়ে গিয়ে পৌঁছায়। সেখানে দলের স্থায়ী কমিটির সদস্য গয়েশ্বর চন্দ্র রায় সমাপনী বক্তব্য দেন। জুমার নামাজের আগেই হাজার হাজার নেতা-কর্মী নয়াপল্টনের ভিআইপি সড়কে অবস্থান নেন। একপর্যায়ে তা কাকরাইল থেকে ফকিরাপুল বাজার পর্যন্ত ছড়িয়ে যায়। কর্মসূচি মগবাজার মোড়ে এসে শেষ হলেও নেতা-কর্মীরা ফিরতি মিছিল নিয়ে আবার একই পথে নয়াপল্টনে যান।</p>                                        ', 'uploads/post/63af0743ce84b8505.webp', 'Published', '2022-12-30 22:07:16', NULL),
(5, 1, 1, 'জনগণ ভোট দিতে পারলে এই সরকারের পাত্তা থাকবে না: খন্দকার মোশাররফ', 'জনগণ-ভোট-দিতে-পারলে-এই-সরকারের-পাত্তা-থাকবে-না:-খন্দকার-মোশাররফ', '                                            <p>এর আগে গণমিছিল কর্মসূচির সমন্বয়ক ও বিএনপির ভাইস চেয়ারম্যান এ জেড এম জাহিদ হোসেন এবং দলের ঢাকা মহানগর উত্তর কমিটির আহ্বায়ক আমানউল্লাহ আমান বক্তব্য দেন। সমাবেশের পর বেলা সাড়ে তিনটায় নয়াপল্টন থেকে গণমিছিল শুরু হয়।</p><p><br></p><p>গণমিছিলটি কাকরাইল, শান্তিনগর, মালিবাগ হয়ে বিকেল ৪টা ১০ মিনিটে মগবাজার মোড়ে গিয়ে পৌঁছায়। সেখানে দলের স্থায়ী কমিটির সদস্য গয়েশ্বর চন্দ্র রায় সমাপনী বক্তব্য দেন। জুমার নামাজের আগেই হাজার হাজার নেতা-কর্মী নয়াপল্টনের ভিআইপি সড়কে অবস্থান নেন। একপর্যায়ে তা কাকরাইল থেকে ফকিরাপুল বাজার পর্যন্ত ছড়িয়ে যায়। কর্মসূচি মগবাজার মোড়ে এসে শেষ হলেও নেতা-কর্মীরা ফিরতি মিছিল নিয়ে আবার একই পথে নয়াপল্টনে যান।</p>                                        ', 'uploads/post/63af0743ce84b8505.webp', 'Published', '2022-12-30 22:11:30', NULL),
(6, 1, 1, 'জনগণ ভোট দিতে পারলে এই সরকারের পাত্তা থাকবে না: খন্দকার মোশাররফ', 'জনগণ-ভোট-দিতে-পারলে-এই-সরকারের-পাত্তা-থাকবে-না:-খন্দকার-মোশাররফ', '                                                                                        <p>এর আগে গণমিছিল কর্মসূচির সমন্বয়ক ও বিএনপির ভাইস চেয়ারম্যান এ জেড এম জাহিদ হোসেন এবং দলের ঢাকা মহানগর উত্তর কমিটির আহ্বায়ক আমানউল্লাহ আমান বক্তব্য দেন। সমাবেশের পর বেলা সাড়ে তিনটায় নয়াপল্টন থেকে গণমিছিল শুরু হয়।</p><p><br></p><p>গণমিছিলটি কাকরাইল, শান্তিনগর, মালিবাগ হয়ে বিকেল ৪টা ১০ মিনিটে মগবাজার মোড়ে গিয়ে পৌঁছায়। সেখানে দলের স্থায়ী কমিটির সদস্য গয়েশ্বর চন্দ্র রায় সমাপনী বক্তব্য দেন। জুমার নামাজের আগেই হাজার হাজার নেতা-কর্মী নয়াপল্টনের ভিআইপি সড়কে অবস্থান নেন। একপর্যায়ে তা কাকরাইল থেকে ফকিরাপুল বাজার পর্যন্ত ছড়িয়ে যায়। কর্মসূচি মগবাজার মোড়ে এসে শেষ হলেও নেতা-কর্মীরা ফিরতি মিছিল নিয়ে আবার একই পথে নয়াপল্টনে যান।</p>                                                                                ', 'uploads/post/63af0743ce84b8505.webp', 'Published', '2022-12-30 22:13:08', NULL),
(7, 1, 1, 'জনগণ ভোট দিতে পারলে এই সরকারের পাত্তা থাকবে না: খন্দকার মোশাররফ', 'জনগণ-ভোট-দিতে-পারলে-এই-সরকারের-পাত্তা-থাকবে-না:-খন্দকার-মোশাররফ', '                                                                                                                                    <p>এর আগে গণমিছিল কর্মসূচির সমন্বয়ক ও বিএনপির ভাইস চেয়ারম্যান এ জেড এম জাহিদ হোসেন এবং দলের ঢাকা মহানগর উত্তর কমিটির আহ্বায়ক আমানউল্লাহ আমান বক্তব্য দেন। সমাবেশের পর বেলা সাড়ে তিনটায় নয়াপল্টন থেকে গণমিছিল শুরু হয়।</p><p><br></p><p>গণমিছিলটি কাকরাইল, শান্তিনগর, মালিবাগ হয়ে বিকেল ৪টা ১০ মিনিটে মগবাজার মোড়ে গিয়ে পৌঁছায়। সেখানে দলের স্থায়ী কমিটির সদস্য গয়েশ্বর চন্দ্র রায় সমাপনী বক্তব্য দেন। জুমার নামাজের আগেই হাজার হাজার নেতা-কর্মী নয়াপল্টনের ভিআইপি সড়কে অবস্থান নেন। একপর্যায়ে তা কাকরাইল থেকে ফকিরাপুল বাজার পর্যন্ত ছড়িয়ে যায়। কর্মসূচি মগবাজার মোড়ে এসে শেষ হলেও নেতা-কর্মীরা ফিরতি মিছিল নিয়ে আবার একই পথে নয়াপল্টনে যান।</p>                                                                                                                        ', 'uploads/post/63af0743ce84b8505.webp', 'Draft', '2022-12-30 22:16:49', NULL),
(8, 1, 1, 'জনগণ ভোট দিতে পারলে এই সরকারের পাত্তা থাকবে না: খন্দকার মোশাররফ', 'জনগণ-ভোট-দিতে-পারলে-এই-সরকারের-পাত্তা-থাকবে-না:-খন্দকার-মোশাররফ', '                                                                                                                                                                                <p>এর আগে গণমিছিল কর্মসূচির সমন্বয়ক ও বিএনপির ভাইস চেয়ারম্যান এ জেড এম জাহিদ হোসেন এবং দলের ঢাকা মহানগর উত্তর কমিটির আহ্বায়ক আমানউল্লাহ আমান বক্তব্য দেন। সমাবেশের পর বেলা সাড়ে তিনটায় নয়াপল্টন থেকে গণমিছিল শুরু হয়।</p><p><br></p><p>গণমিছিলটি কাকরাইল, শান্তিনগর, মালিবাগ হয়ে বিকেল ৪টা ১০ মিনিটে মগবাজার মোড়ে গিয়ে পৌঁছায়। সেখানে দলের স্থায়ী কমিটির সদস্য গয়েশ্বর চন্দ্র রায় সমাপনী বক্তব্য দেন। জুমার নামাজের আগেই হাজার হাজার নেতা-কর্মী নয়াপল্টনের ভিআইপি সড়কে অবস্থান নেন। একপর্যায়ে তা কাকরাইল থেকে ফকিরাপুল বাজার পর্যন্ত ছড়িয়ে যায়। কর্মসূচি মগবাজার মোড়ে এসে শেষ হলেও নেতা-কর্মীরা ফিরতি মিছিল নিয়ে আবার একই পথে নয়াপল্টনে যান।</p>                                                                                                                                                                ', 'uploads/post/63af0743ce84b8505.webp', 'Published', '2022-12-30 22:17:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint NOT NULL,
  `post_id` bigint NOT NULL,
  `tag_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 1),
(4, 2, 2),
(5, 2, 3),
(6, 3, 2),
(7, 3, 3),
(8, 4, 2),
(9, 4, 3),
(10, 5, 2),
(11, 5, 3),
(12, 6, 3),
(13, 7, 3),
(14, 8, 2),
(15, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `slug`) VALUES
(1, 'কক্সবাজার', 'কক্সবাজার'),
(2, 'রাজনীতি', 'রাজনীতি'),
(3, 'আওয়ামী লীগ', 'আওয়ামী-লীগ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `catagory_id` (`catagory_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`catagory_id`) REFERENCES `catagory` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
