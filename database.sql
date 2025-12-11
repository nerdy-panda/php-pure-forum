-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2025 at 02:29 PM
-- Server version: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_id` bigint(20) UNSIGNED NOT NULL,
  `body` longtext NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `issue_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 'برای آپلود تصویر پروفایل به صفحهٔ پروفایل بروید و از بخش \"ویرایش پروفایل\" گزینهٔ انتخاب تصویر را بزنید. فرمت‌های jpg و png پشتیبانی می‌شوند.', '2025-01-10 09:30:00', NULL),
(2, 1, 'اگر با خطا مواجه شدید، حجم تصویر را به زیر 2 مگابایت کاهش دهید و نام فایل را بدون کاراکترهای خاص قرار دهید.', '2025-01-10 09:45:00', NULL),
(3, 2, 'به‌صورت پیش‌فرض HTML خام فیلتر می‌شود تا از XSS جلوگیری شود؛ اگر نیاز به درج HTML دارید از ویرایشگر امن استفاده کنید.', '2025-01-11 11:20:00', NULL),
(4, 2, 'می‌توانید از تگ‌های محدود شده مانند <b> و <i> استفاده کنید؛ تگ‌های اسکریپت و iframe مسدود هستند.', '2025-01-11 11:35:00', NULL),
(5, 3, 'بله؛ تا ۱۵ دقیقه پس از ارسال می‌توانید پست خود را ویرایش کنید. پس از آن برای تغییرات جزئی با پشتیبانی تماس بگیرید.', '2025-01-12 14:40:00', NULL),
(6, 4, 'برای ریپورت کردن یک پاسخ، روی دکمهٔ سه‌نقطه کنار پاسخ کلیک کنید و گزینهٔ \"گزارش\" را انتخاب کنید؛ تیم بررسی خواهد کرد.', '2025-01-13 08:50:00', NULL),
(7, 5, 'بله؛ در تنظیمات حساب می‌توانید اعلان ایمیل برای پاسخ‌ها را فعال یا غیرفعال کنید.', '2025-01-14 10:15:00', NULL),
(8, 5, 'همچنین می‌توانید برای هر موضوع خاص اعلان‌های جداگانه تنظیم کنید تا فقط ایمیل‌های مرتبط دریافت کنید.', '2025-01-14 10:25:00', NULL),
(9, 6, 'ایجاد دسته‌بندی جدید معمولاً توسط مدیران انجام می‌شود؛ اگر دسترسی ندارید درخواست خود را در بخش پشتیبانی ثبت کنید.', '2025-01-15 17:00:00', NULL),
(10, 6, 'در نسخه‌های آینده امکان ایجاد دسته‌بندی توسط کاربران با امتیاز مشخص اضافه خواهد شد.', '2025-01-15 17:10:00', NULL),
(11, 7, 'در حال حاضر پیوست فایل در پاسخ‌ها محدود است؛ فقط تصاویر با فرمت jpg/png و حداکثر 2 مگابایت مجاز است.', '2025-01-16 12:30:00', NULL),
(12, 7, 'برای ارسال فایل‌های بزرگ‌تر از سرویس‌های اشتراک‌گذاری لینک استفاده کنید و لینک را در پاسخ قرار دهید.', '2025-01-16 12:45:00', NULL),
(13, 8, 'برای جستجوی سوالات قدیمی از نوار جستجو بالای صفحه استفاده کنید و فیلتر تاریخ یا دسته‌بندی را اعمال کنید.', '2025-01-17 10:05:00', NULL),
(14, 9, 'حداکثر طول متن سوال در حال حاضر 10000 کاراکتر است؛ اگر نیاز به متن طولانی‌تر دارید، آن را در چند بخش ارسال کنید.', '2025-01-18 13:40:00', NULL),
(15, 10, 'برای حذف حساب کاربری به صفحهٔ تنظیمات بروید و گزینهٔ \"حذف حساب\" را انتخاب کنید؛ توجه داشته باشید که این عمل غیرقابل بازگشت است.', '2025-01-19 15:20:00', NULL),
(16, 10, 'اگر نیاز به غیرفعال‌سازی موقت دارید، می‌توانید حساب را غیرفعال کنید تا اطلاعات حفظ شود اما قابل دسترسی نباشد.', '2025-01-19 15:35:00', NULL),
(17, 11, 'بله؛ با دنبال کردن یک موضوع، اعلان‌های جدید مربوط به آن موضوع برای شما ارسال می‌شود.', '2025-01-20 17:55:00', NULL),
(18, 11, 'برای دنبال کردن، روی دکمهٔ \"دنبال کن\" در صفحهٔ موضوع کلیک کنید یا از منوی موضوعات استفاده کنید.', '2025-01-20 18:05:00', NULL),
(19, 12, 'سطح دسترسی معمولاً شامل نقش‌های \"کاربر\"، \"نویسنده\" و \"مدیر\" است؛ مدیر می‌تواند دسترسی‌ها را تنظیم کند.', '2025-01-21 19:30:00', NULL),
(20, 12, 'برای تعریف دسترسی سفارشی، از بخش مدیریت کاربران گزینهٔ \"نقش‌ها و مجوزها\" را بررسی کنید.', '2025-01-21 19:45:00', NULL),
(21, 3, 'اگر پست شما نیاز به اصلاحات بیشتر دارد، می‌توانید درخواست بازبینی ارسال کنید تا تیم محتوا آن را بررسی کند.', '2025-01-12 15:00:00', NULL),
(22, 8, 'همچنین می‌توانید از اپراتورهای جستجو مانند AND و OR برای محدود کردن نتایج استفاده کنید.', '2025-01-17 10:20:00', NULL),
(23, 9, 'در صورت نیاز به محدودیت‌های خاص برای هر دسته، می‌توان تنظیمات طول را در سطح دسته‌بندی اعمال کرد.', '2025-01-18 13:55:00', NULL),
(24, 11, 'اگر می‌خواهید فقط اعلان‌های مهم را دریافت کنید، تنظیمات اعلان را به \"فقط مهم\" تغییر دهید.', '2025-01-20 18:20:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `body` longtext NOT NULL,
  `status` enum('pending','publish','answered') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `full_name`, `email`, `phone`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'علی رضایی', 'ali.rezaei@example.com', '09120000001', 'چگونه می‌توانم تصویر پروفایل را در انجمن آپلود کنم؟', 'publish', '2025-01-10 09:12:00', NULL),
(2, 'مریم حسینی', 'mary.hosseini@example.com', '09120000002', 'در ارسال مطلب، HTML اجازه داده می‌شود یا باید فیلتر شود؟', 'publish', '2025-01-11 11:05:00', NULL),
(3, 'رضا محمدی', 'reza.m@example.com', '09120000003', 'آیا امکان ویرایش پست بعد از ارسال وجود دارد؟', 'pending', '2025-01-12 14:20:00', NULL),
(4, 'سارا کاظمی', 'sara.k@example.com', '09120000004', 'نحوهٔ ریپورت کردن یک پاسخ نامناسب چگونه است؟', 'publish', '2025-01-13 08:30:00', NULL),
(5, 'حسن موسوی', 'hassan.m@example.com', '09120000005', 'آیا می‌توانم اعلان ایمیل برای پاسخ‌ها فعال کنم؟', 'answered', '2025-01-14 10:00:00', NULL),
(6, 'نرگس عباسی', 'narges.a@example.com', '09120000006', 'چطور می‌توانم دسته‌بندی جدید برای سوالات ایجاد کنم؟', 'publish', '2025-01-15 16:45:00', NULL),
(7, 'امیر کاظمی', 'amir.k@example.com', '09120000007', 'آیا امکان پیوست فایل در پاسخ‌ها وجود دارد؟', 'pending', '2025-01-16 12:10:00', NULL),
(8, 'لیلا صادقی', 'lila.s@example.com', '09120000008', 'چگونه می‌توانم سوالات قدیمی را جستجو کنم؟', 'publish', '2025-01-17 09:50:00', NULL),
(9, 'مهدی نادری', 'mahdi.n@example.com', '09120000009', 'آیا محدودیتی برای طول متن سوال وجود دارد؟', 'publish', '2025-01-18 13:25:00', NULL),
(10, 'فاطمه رستمی', 'fateme.r@example.com', '09120000010', 'چگونه می‌توانم حساب کاربری خود را حذف کنم؟', 'pending', '2025-01-19 15:00:00', NULL),
(11, 'سعید کریمی', 'saeid.k@example.com', '09120000011', 'آیا امکان دنبال کردن یک موضوع خاص وجود دارد؟', 'publish', '2025-01-20 17:40:00', NULL),
(12, 'مهسا یوسفی', 'mahsa.y@example.com', '09120000012', 'نحوهٔ تنظیم سطح دسترسی برای اعضای انجمن چگونه است؟', 'publish', '2025-01-21 19:10:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issue_id` (`issue_id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
