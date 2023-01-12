-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2023 at 06:21 PM
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
-- Database: `new_pro_ex`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_time`, `img`, `status`) VALUES
(1, 'Mr. admin', 'admin@mail.com', '$2y$10$Clunkrww2jw6q7rb9rLVU.AePt6Cs5RiQK9Z7WzrNzEBXlA3auNye', '2023-01-11 22:08:13', NULL, 1),
(2, 'Abir', 'abir@mail.com', '$2y$10$h1mhfF451p3jWcEqfSyuzuKBOWHMEjZ9Q11i/YKO8SDdP2QlVAMzy', '2023-01-11 22:08:13', NULL, 0),
(28, 'Abu Wahid', 'abuwahid017@gmail.com', '1234', '2023-01-11 22:08:13', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `name`, `slug`) VALUES
(1, 'জেলা', 'জেলা'),
(2, 'বাংলাদেশ', 'বাংলাদেশ'),
(3, 'বিশ্ব', 'বিশ্ব'),
(4, 'জীবনযাপন', 'জীবনযাপন'),
(5, 'চাকরি', 'চাকরি'),
(6, 'বিনোদন', 'বিনোদন'),
(7, 'খেলা', 'খেলা'),
(8, 'মতামত', 'মতামত'),
(9, 'বাণিজ্য', 'বাণিজ্য'),
(10, 'করোনাভাইরাস', 'করোনাভাইরাস'),
(12, 'সংবাদ', 'সংবাদ'),
(13, 'বিশেষ', 'বিশেষ'),
(14, 'সর্বশেষ', 'সর্বশেষ');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint NOT NULL,
  `admin_id` bigint NOT NULL,
  `catagory_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_published` enum('Published','Draft') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `admin_id`, `catagory_id`, `title`, `slug`, `description`, `image`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'হ্যাক হওয়া ২০ কোটি টুইটার ব্যবহারকারীর ইমেইল ঠিকানা ফাঁস: গবেষক', 'হ্যাক-হওয়া-২০-কোটি-টুইটার-ব্যবহারকারীর-ইমেইল-ঠিকানা-ফাঁস:-গবেষক', '<p>২০ কোটির বেশি টুইটার ব্যবহারকারীর ইমেইলের ঠিকানা হ্যাকাররা চুরি করেছে। ইতিমধ্যে একটি অনলাইন হ্যাকিং ফোরামে ঠিকানাগুলো পোস্ট করা হয়েছে। বুধবার ইসরায়েলের এক সাইবার নিরাপত্তা গবেষক এ কথা বলেছেন। খবর রয়টার্সের।<br></p>', 'uploads/post/63b775b29cd1341384.webp', 'Published', '2023-01-06 01:13:22', NULL),
(2, 1, 10, 'চীনে ১ মাসে ৪০ শতাংশ মানুষ করোনা আক্রান্ত', 'চীনে-১-মাসে-৪০-শতাংশ-মানুষ-করোনা-আক্রান্ত', '<p><span style=\"color: rgb(18, 18, 18); font-family: Shurjo, SolaimanLipi, &quot;Siyam Rupali&quot;, Roboto, Arial, Helvetica, monospace; font-size: 18px; white-space: break-spaces;\">চীনে সম্প্রতি করোনাভাইরাসের সংক্রমণ বেড়েছে। তবে ঠিক কী পরিমাণ মানুষ করোনায় আক্রান্ত হচ্ছেন, তা নিয়ে সঠিক তথ্য পাওয়া যাচ্ছিল না। এরই মধ্যে নতুন তথ্য হাজির করেছে চীনের আধা স্বায়ত্তশাসিত অঞ্চল হংকংভিত্তিক ইংরেজি ভাষার অনলাইন এশিয়া টাইমস। দেশটির বিশেষজ্ঞ চিকিৎসকদের বরাত দিয়ে তারা বলেছে, গত ১ মাসে চীনের প্রায় ৪০ শতাংশ মানুষ করোনায় আক্রান্ত হয়েছেন।</span><br></p>', 'uploads/post/63b776cb91ede45310.webp', 'Published', '2023-01-06 01:18:03', NULL),
(3, 1, 3, 'তেল উত্তোলনে চীনা কোম্পানির সঙ্গে তালেবানের চুক্তি', 'তেল-উত্তোলনে-চীনা-কোম্পানির-সঙ্গে-তালেবানের-চুক্তি', '<p>আফগানিস্তানের উত্তরাঞ্চল থেকে তেল উত্তোলনের জন্য দেশটির তালেবান সরকার একটি চীনা প্রতিষ্ঠানের সঙ্গে চুক্তি স্বাক্ষর করতে যাচ্ছে। ২০২১ সালে আফগানিস্তানে ক্ষমতা দখলের পর থেকে এটি হবে বিদেশি প্রতিষ্ঠানের সঙ্গে তালেবানের প্রথম কোনো বড় জ্বালানি উত্তোলন চুক্তি। চুক্তির মেয়াদ হবে ২৫ বছর। খবর বিবিসির।<br></p>', 'uploads/post/63b77732b747526473.webp', 'Published', '2023-01-06 01:19:46', NULL),
(4, 1, 5, 'আন্তর্জাতিক সংস্থায় চাকরি, বেতন লাখের বেশি', 'আন্তর্জাতিক-সংস্থায়-চাকরি,-বেতন-লাখের-বেশি', '                                                                              <p><span style=\"color: rgb(18, 18, 18); font-family: Shurjo, SolaimanLipi, \"Siyam Rupali\", Roboto, Arial, Helvetica, monospace; font-size: 18px; white-space: break-spaces;\">ফ্রান্সের আন্তর্জাতিক মানবাধিকার সংস্থা এজেন্সি ফর টেকনিক্যাল কো–অপারেশন অ্যান্ড ডেভেলপমেন্ট (অ্যাকটেড) বাংলাদেশে জনবল নিয়োগে বিজ্ঞপ্তি দিয়েছে। সংস্থাটি কক্সবাজারে  রোহিঙ্গা প্রকল্পের কুতুপালং–বালুখালী এক্সপানশন সাইটে প্রজেক্ট ম্যানেজার নিয়োগ দেবে। আগ্রহী প্রার্থীদের নির্ধারিত আবেদন ফরম পূরণ করে প্রয়োজনীয় কাগজপত্রসহ ই–মেইলে পাঠাতে হবে।</span><br></p>                                                                                ', 'uploads/post/63b7778a175af56666.webp', 'Published', '2023-01-06 01:21:14', '2023-01-07 00:22:34'),
(5, 1, 2, 'মঞ্চ ভাঙার পর যা বললেন ওবায়দুল কাদের', 'মঞ্চ-ভাঙার-পর-যা-বললেন-ওবায়দুল-কাদের', '                                                                                                                     <p>ছাত্রলীগের ৭৫তম প্রতিষ্ঠাবার্ষিকীর শোভাযাত্রার উদ্বোধনী অনুষ্ঠানে বক্তব্য দিচ্ছিলেন আওয়ামী লীগের সাধারণ সম্পাদক এবং সড়ক পরিবহন ও সেতুমন্ত্রী ওবায়দুল কাদের। ওই অনুষ্ঠানের মঞ্চে ছাত্রলীগের সাবেক নেতা ছাড়া অন্যদের নেমে যাওয়ার কথা বেশ কয়েকবার মাইকে বলা হলেও অনেকেই নামেননি। কাদেরের বক্তব্যের একপর্যায়ে মঞ্চ ভেঙে পড়ে। পরে নিজেকে সামলে নিয়ে কাদের বলেন, ‘এত নেতা কেন? এত নেতা আমাদের দরকার নেই। দরকার কর্মী। স্মার্ট বাংলাদেশের জন্য স্মার্ট কর্মী দরকার।’<br></p>                                                                                                                        ', 'uploads/post/63b7786ebe3da76378.webp', 'Published', '2023-01-06 01:25:02', '2023-01-07 00:20:33'),
(6, 1, 8, 'সরকারি বরাদ্দ বাড়ানোর বিকল্প নেই', 'সরকারি-বরাদ্দ-বাড়ানোর-বিকল্প-নেই', '<p>মানুষের বেঁচে থাকার যে মৌলিক পাঁচটি চাহিদা সংবিধানে স্বীকৃত, সেখানে তৃতীয় নম্বরে আছে স্বাস্থ্যসেবা। খাদ্য ও বাসস্থানের পরেই সেটির অবস্থান। বাংলাদেশের সংবিধানের অন্যতম মৌলিক নীতি সমাজতন্ত্র, যেখানে সব নাগরিকের অত্যাবশ্যকীয় চাহিদা পূরণের কথা বলা আছে। এর মধ্যে স্বাস্থ্যসেবাকে কোনোভাবেই অগ্রাহ্য করা যায় না।</p><p><br></p><p>সুস্থ জাতি গঠনের জন্য মানুষের সুস্বাস্থ্য নিশ্চিত করা অপরিহার্য। মানুষের মৌলিক চাহিদা পূরণের দায়িত্ব রাষ্ট্রের, সেখানে স্বাস্থ্যসেবায় জনপ্রতি রাষ্ট্রের হিস্যা কমে যাওয়া কেবল হতাশাজনক নয়, উদ্বেগজনকও বটে। প্রথম আলোর খবর অনুযায়ী, স্বাস্থ্য মন্ত্রণালয়ের অধীন স্বাস্থ্য অর্থনীতি ইউনিট বলেছে, ২০১৮, ২০১৯ ও ২০২০ সালে স্বাস্থ্যসেবা খাতে ব্যয় সরকারের অংশ যথাক্রমে ২৮, ২৬ ও ২৩ শতাংশ। অর্থাৎ ধারাবাহিকভাবে সরকারের ব্যয় কমছে</p>', 'uploads/post/63b890feb2c2039292.webp', 'Published', '2023-01-07 03:22:06', NULL),
(7, 1, 4, 'চিলমারীর শাখাহাতি দ্বীপে যেভাবে হলো বছরের প্রথম সূর্য দেখার উৎসব', 'চিলমারীর-শাখাহাতি-দ্বীপে-যেভাবে-হলো-বছরের-প্রথম-সূর্য-দেখার-উৎসব', '<p>বছরের প্রথম দিনে অপ্রচলিত জায়গায় অ্যাডভেঞ্চার ক্যাম্পের আয়োজন করে থাকে বাংলাদেশ অ্যাস্ট্রোনমিক্যাল অ্যাসোসিয়েশন। আয়োজনটির নাম দিয়েছেন তারা সূর্য উৎসব। এবারের উৎসব হয়েছে চিলমারীর শাখাহাতি দ্বীপে। সেখানেই বছরের প্রথম সূর্য দেখলেন জাহানুর রহমান<br></p>', 'uploads/post/63b89374237e363091.webp', 'Published', '2023-01-07 03:32:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` bigint NOT NULL,
  `tag_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(1, 4),
(2, 2),
(2, 4),
(2, 5),
(3, 2),
(5, 2),
(5, 3),
(4, 2),
(6, 4),
(7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `slug`) VALUES
(1, 'কক্সবাজার', 'কক্সবাজার'),
(2, 'রাজনীতি', 'রাজনীতি'),
(3, 'আওয়ামী লীগ', 'আওয়ামী-লীগ'),
(4, 'হামলা', 'হামলা'),
(5, 'প্রতিবাদ', 'প্রতিবাদ'),
(6, 'ভোলা', 'ভোলা'),
(7, 'বরিশাল বিভাগ', 'বরিশাল-বিভাগ'),
(8, 'দৌলতখান', 'দৌলতখান'),
(9, 'ছাত্রলীগ', 'ছাত্রলীগ');

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
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
