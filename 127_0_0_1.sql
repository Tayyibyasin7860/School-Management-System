-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2020 at 07:39 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--
CREATE DATABASE IF NOT EXISTS `school` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `school`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PUBLISHED',
  `date` date NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `admin_id`, `category_id`, `title`, `slug`, `content`, `image`, `status`, `date`, `featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, 2, 20, 'Midterm Exams', 'midterm', '<p>Midterm exams are approaching so be prepared. Prepare well for the exams so that you get good marks in all the subjects and get succeed.&nbsp;</p>', NULL, 'PUBLISHED', '2019-11-27', 0, '2019-11-27 12:14:45', '2019-11-27 12:14:45', NULL),
(24, 2, 21, 'Final Term Exams', 'final-term-exams', '<p>final term exams are approaching very near. be prepared and do exercices of math subjects especiallly regularly</p>', 'uploads/ed998a697a031c656b1376f0266b782e.jpg', 'PUBLISHED', '2019-11-28', 0, '2019-11-28 04:13:40', '2019-11-28 04:13:40', NULL),
(25, 2, 21, 'Spring Sports', 'spring-sports', '<p>difrerentasd sdfkjsd fjsdfl dsfkl sdlkfjdlsf ldsjf ldskjf dlksjfkdsjfdklsf lksdjf lkdj flksdj flsdjf klsdjf.sdf. sdlkfjs.d. fsdlkfj sdlfjsdlkfjsdj fdslf dsf.ds flsdjf .</p>', NULL, 'PUBLISHED', '2019-11-28', 0, '2019-11-28 04:14:27', '2019-11-28 04:14:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `lft` int(10) UNSIGNED DEFAULT NULL,
  `rgt` int(10) UNSIGNED DEFAULT NULL,
  `depth` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `admin_id`, `parent_id`, `lft`, `rgt`, `depth`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 2, 0, NULL, NULL, NULL, 'General', 'general', '2019-11-27 12:13:05', '2019-11-27 12:13:05', NULL),
(21, 2, 0, NULL, NULL, NULL, 'Sports', 'sports', '2019-11-27 12:15:56', '2019-11-27 12:15:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT 40,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `title`, `capacity`, `admin_id`, `created_at`, `updated_at`) VALUES
(262, 'Play Group', 40, 2, '2019-11-24 08:21:35', '2019-11-24 08:21:35'),
(263, 'Prep', 40, 2, '2019-11-24 08:21:35', '2019-11-24 08:21:35'),
(264, 'Nursary', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(265, 'One', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(266, 'Two', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(267, 'Three', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(268, 'Four', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(269, 'Five', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(270, 'Six', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(271, 'Seven', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(272, 'Eight', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(273, 'Nine', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36'),
(274, 'Ten', 40, 2, '2019-11-24 08:21:36', '2019-11-24 08:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `class_fees`
--

CREATE TABLE `class_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `fee_type_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(10) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_fees`
--

INSERT INTO `class_fees` (`id`, `class_id`, `fee_type_id`, `amount`, `updated_at`, `created_at`) VALUES
(18, 265, 28, 1000, '2019-11-27 17:21:17', '2019-11-27 17:21:17'),
(19, 266, 28, 2000, '2019-11-27 17:21:29', '2019-11-27 17:21:29'),
(20, 267, 28, 3000, '2019-11-27 17:22:09', '2019-11-27 17:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_session_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_session_id`, `class_id`, `subject_id`, `date`, `updated_at`, `created_at`) VALUES
(20, 26, 265, 48, '2019-11-19', '2019-11-28 09:52:43', '2019-11-27 17:19:43'),
(21, 27, 265, 53, '2019-12-03', '2019-11-27 18:39:53', '2019-11-27 18:39:53'),
(22, 27, 274, 49, '2019-11-26', '2019-11-28 09:15:26', '2019-11-28 09:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `exam_sessions`
--

CREATE TABLE `exam_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_sessions`
--

INSERT INTO `exam_sessions` (`id`, `admin_id`, `title`, `year`, `updated_at`, `created_at`) VALUES
(26, 2, 'Spring', 2019, '2019-11-24 13:21:37', '2019-11-24 13:21:37'),
(27, 2, 'Fall', 2019, '2019-11-24 13:21:37', '2019-11-24 13:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `admin_id`, `student_id`, `subject`, `message`, `submission_date`, `updated_at`, `created_at`) VALUES
(5, 2, 3, 'Exams', 'When will midterm exams be conducted?', '2019-11-28 14:19:04', '2019-11-28 09:19:04', '2019-11-28 09:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `fee_receipts`
--

CREATE TABLE `fee_receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `fee_type_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(10) NOT NULL,
  `submitted_amount` int(10) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `submission_date` datetime DEFAULT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_receipts`
--

INSERT INTO `fee_receipts` (`id`, `student_id`, `fee_type_id`, `amount`, `submitted_amount`, `due_date`, `submission_date`, `status`, `created_at`, `updated_at`) VALUES
(138, 12, 28, 3000, NULL, '2019-11-25 00:00:00', NULL, 'pending', '2019-11-27 17:23:48', '2019-11-27 17:23:48'),
(139, 3, 28, 1000, 0, '2019-10-31 00:00:00', NULL, 'pending', '2019-11-27 18:34:40', '2019-11-27 18:34:40'),
(140, 4, 28, 3000, 0, '2019-11-13 00:00:00', NULL, 'pending', '2019-11-27 18:35:43', '2019-11-27 18:35:43'),
(141, 3, 30, 500, 500, '2019-11-18 00:00:00', '2019-11-26 00:00:00', 'paid', '2019-11-28 09:16:31', '2019-11-28 09:16:31'),
(142, 4, 28, 3000, 0, '2019-11-13 00:00:00', NULL, 'pending', '2019-11-28 10:00:23', '2019-11-28 10:00:23');

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `admin_id`, `type`, `created_at`, `updated_at`) VALUES
(28, 2, 'Admission Fee', '2019-11-24 13:21:36', '2019-11-24 13:21:36'),
(29, 2, 'Monthly Fee', '2019-11-24 13:21:36', '2019-11-24 13:21:36'),
(30, 2, 'Annual Fee', '2019-11-24 13:21:36', '2019-11-24 13:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(125, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\MailboxMailJob\\\":10:{s:4:\\\"mail\\\";O:20:\\\"App\\\\Mail\\\\MailboxMail\\\":24:{s:7:\\\"subject\\\";s:46:\\\"Important Notice from School Management System\\\";s:7:\\\"message\\\";s:7:\\\"message\\\";s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:0:{}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2019-11-27 18:36:19.328095\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"email\\\";s:24:\\\"tayyibyasin786@gmail.com\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1574879776, 1574879776),
(126, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\MailboxMailJob\\\":10:{s:4:\\\"mail\\\";O:20:\\\"App\\\\Mail\\\\MailboxMail\\\":24:{s:7:\\\"subject\\\";s:46:\\\"Important Notice from School Management System\\\";s:7:\\\"message\\\";s:7:\\\"message\\\";s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:0:{}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2019-11-27 18:36:32.594149\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"email\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:1:{i:0;s:24:\\\"tayyibyasin786@gmail.com\\\";}}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1574879789, 1574879789),
(127, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\MailboxMailJob\\\":10:{s:4:\\\"mail\\\";O:20:\\\"App\\\\Mail\\\\MailboxMail\\\":24:{s:7:\\\"subject\\\";s:46:\\\"Important Notice from School Management System\\\";s:7:\\\"message\\\";s:7:\\\"message\\\";s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:0:{}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2019-11-27 18:36:32.648061\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"email\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:1:{i:0;s:21:\\\"tayyibyasin@gmail.com\\\";}}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1574879789, 1574879789),
(128, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\MailboxMailJob\\\":10:{s:4:\\\"mail\\\";O:20:\\\"App\\\\Mail\\\\MailboxMail\\\":24:{s:7:\\\"subject\\\";s:46:\\\"Important Notice from School Management System\\\";s:7:\\\"message\\\";s:7:\\\"message\\\";s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:0:{}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2019-11-27 18:36:32.714058\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"email\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:1:{i:0;s:16:\\\"hashim@gmail.com\\\";}}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1574879789, 1574879789),
(129, 'default', '{\"displayName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\MailboxMailJob\",\"command\":\"O:23:\\\"App\\\\Jobs\\\\MailboxMailJob\\\":10:{s:4:\\\"mail\\\";O:20:\\\"App\\\\Mail\\\\MailboxMail\\\":24:{s:7:\\\"subject\\\";s:46:\\\"Important Notice from School Management System\\\";s:7:\\\"message\\\";s:4:\\\"sdfd\\\";s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:0:{}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2019-11-27 18:37:16.553969\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"email\\\";O:29:\\\"Illuminate\\\\Support\\\\Collection\\\":1:{s:8:\\\"\\u0000*\\u0000items\\\";a:1:{i:0;s:16:\\\"hashim@gmail.com\\\";}}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1574879833, 1574879833),
(130, 'default', '{\"displayName\":\"App\\\\Jobs\\\\WelcomeStudentMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\WelcomeStudentMailJob\",\"command\":\"O:30:\\\"App\\\\Jobs\\\\WelcomeStudentMailJob\\\":10:{s:4:\\\"mail\\\";O:27:\\\"App\\\\Mail\\\\WelcomeStudentMail\\\":24:{s:7:\\\"subject\\\";s:46:\\\"Important Notice from School Management System\\\";s:11:\\\"studentData\\\";a:2:{s:12:\\\"studentEmail\\\";s:20:\\\"newstudent@gmail.com\\\";s:15:\\\"studentPassword\\\";s:8:\\\"88888888\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:0:{}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2019-11-28 10:48:09.739482\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"email\\\";s:20:\\\"newstudent@gmail.com\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1574938086, 1574938086),
(131, 'default', '{\"displayName\":\"App\\\\Jobs\\\\WelcomeStudentMailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"delay\":null,\"timeout\":null,\"timeoutAt\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\WelcomeStudentMailJob\",\"command\":\"O:30:\\\"App\\\\Jobs\\\\WelcomeStudentMailJob\\\":10:{s:4:\\\"mail\\\";O:27:\\\"App\\\\Mail\\\\WelcomeStudentMail\\\":24:{s:7:\\\"subject\\\";s:46:\\\"Important Notice from School Management System\\\";s:11:\\\"studentData\\\";a:2:{s:12:\\\"studentEmail\\\";s:20:\\\"nwestudent@gmail.com\\\";s:15:\\\"studentPassword\\\";s:8:\\\"88888888\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:0:{}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:11:\\\"\\u0000*\\u0000markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2019-11-28 10:49:12.037686\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"email\\\";s:20:\\\"nwestudent@gmail.com\\\";s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:5:\\\"delay\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1574938149, 1574938149);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_resets_table', 1),
(33, '2019_08_19_000000_create_failed_jobs_table', 1),
(34, '2019_09_12_103233_create_students_table', 1),
(35, '2019_09_13_092610_create_classes_table', 1),
(36, '2015_08_04_130507_create_article_tag_table', 2),
(37, '2015_08_04_130520_create_articles_table', 2),
(38, '2015_08_04_130551_create_categories_table', 2),
(39, '2015_08_04_131626_create_tags_table', 2),
(40, '2016_07_24_060017_add_slug_to_categories_table', 2),
(41, '2016_07_24_060101_add_slug_to_tags_table', 2),
(42, '2019_09_20_195427_create_permission_tables', 3),
(43, '2019_10_12_183842_create_jobs_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 13),
(3, 'App\\User', 3),
(3, 'App\\User', 4),
(3, 'App\\User', 5),
(3, 'App\\User', 6),
(3, 'App\\User', 7),
(3, 'App\\User', 8),
(3, 'App\\User', 9),
(3, 'App\\User', 10),
(3, 'App\\User', 11),
(3, 'App\\User', 12),
(3, 'App\\User', 14),
(3, 'App\\User', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('tayyibyasin786123@gmail.com', '$2y$10$W/FgO61Xz4wTJUgsvYAX6OGc1pCYXZR9R0kq1pHvdOO4LnHMefvGC', '2019-10-01 05:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'view admin panel', 'web', '2019-09-22 12:37:59', '2019-09-22 12:37:59'),
(4, 'list article', 'web', '2019-09-22 12:44:57', '2019-09-22 12:44:57'),
(5, 'create article', 'web', '2019-09-22 12:44:57', '2019-09-22 12:44:57'),
(6, 'update article', 'web', '2019-09-22 12:44:57', '2019-09-22 12:44:57'),
(7, 'delete article', 'web', '2019-09-22 12:44:57', '2019-09-22 12:44:57'),
(8, 'list backpackuser', 'web', '2019-09-22 12:44:57', '2019-09-22 12:44:57'),
(9, 'create backpackuser', 'web', '2019-09-22 12:44:57', '2019-09-22 12:44:57'),
(10, 'update backpackuser', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(11, 'delete backpackuser', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(12, 'list category', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(13, 'create category', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(14, 'update category', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(15, 'delete category', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(16, 'list classroom', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(17, 'create classroom', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(18, 'update classroom', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(19, 'delete classroom', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(20, 'list exam', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(21, 'create exam', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(22, 'update exam', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(23, 'delete exam', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(24, 'list fee', 'web', '2019-09-22 12:44:58', '2019-09-22 12:44:58'),
(25, 'create fee', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(26, 'update fee', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(27, 'delete fee', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(28, 'list permission', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(29, 'create permission', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(30, 'update permission', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(31, 'delete permission', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(32, 'list result', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(33, 'create result', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(34, 'update result', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(35, 'delete result', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(36, 'list role', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(37, 'create role', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(38, 'update role', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(39, 'delete role', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(40, 'list student details', 'web', '2019-09-22 12:44:59', '2019-09-24 02:08:58'),
(41, 'create student details', 'web', '2019-09-22 12:44:59', '2019-09-24 02:09:25'),
(42, 'update student details', 'web', '2019-09-22 12:44:59', '2019-09-24 02:09:44'),
(43, 'delete student details', 'web', '2019-09-22 12:44:59', '2019-09-24 02:10:01'),
(44, 'list subject', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(45, 'create subject', 'web', '2019-09-22 12:44:59', '2019-09-22 12:44:59'),
(46, 'update subject', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(47, 'delete subject', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(48, 'list tag', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(49, 'create tag', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(50, 'update tag', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(51, 'delete tag', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(52, 'list user', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(53, 'create user', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(54, 'update user', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(55, 'delete user', 'web', '2019-09-22 12:45:00', '2019-09-22 12:45:00'),
(56, 'view roles and permissions', 'web', '2019-09-24 02:15:04', '2019-09-24 02:15:04'),
(57, 'view student panel', 'web', '2019-09-24 02:59:04', '2019-09-24 02:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `total_marks` bigint(20) NOT NULL DEFAULT 100,
  `obtained_marks` bigint(20) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_id`, `exam_id`, `total_marks`, `obtained_marks`, `remarks`, `updated_at`, `created_at`) VALUES
(20, 12, 22, 100, 80, 'Good', '2019-11-28 09:54:54', '2019-11-27 17:20:46'),
(21, 3, 21, 100, 60, 'fair', '2019-11-27 18:40:12', '2019-11-27 18:40:12'),
(23, 3, 20, 100, 70, 'good', '2019-11-28 09:56:21', '2019-11-28 09:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2019-09-28 15:47:16', '2019-09-28 15:47:16'),
(2, 'school_admin', 'web', '2019-09-28 15:48:14', '2019-09-28 15:48:14'),
(3, 'student', 'web', '2019-09-28 15:48:27', '2019-09-28 15:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(57, 3);

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `student_id`, `class_id`, `photo`, `father_name`, `gender`, `phone_number`, `date_of_birth`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(73, 3, 265, 'uploads/HUR1xyUdkAIBqtO8osSuLIAnN5ODZ1fgztwogj0n.jpeg', 'Muhammad Yasin', 'Male', 3498869509, '2019-11-27', 'Kallar Syedan', '2019-11-24 08:44:33', '2019-11-28 04:59:16', NULL),
(74, 4, 267, 'uploads/b6dece4f854d9d86c0333799a0a867fd.jpg', 'amjab huassan', 'Male', 3498888, '2019-11-05', 'kallary syedan', '2019-11-27 06:38:53', '2019-11-27 06:38:53', NULL),
(75, 5, 266, 'uploads/s0R8idCZJ09en9WqS4txMqaOD1dWh3B5PfiQR52l.jpeg', 'father name', 'Male', 3498869509, '2019-11-20', 'kallar syedan', '2019-11-27 11:30:56', '2019-11-27 13:44:21', NULL),
(76, 6, 268, NULL, 'father name', 'Male', 8525852085, '2019-11-19', 'rawalpindi', '2019-11-27 11:31:35', '2019-11-27 11:31:35', NULL),
(77, 7, 269, NULL, 'father name', 'Male', 963214789, '2019-11-26', '7410258963', '2019-11-27 11:32:19', '2019-11-27 11:32:19', NULL),
(78, 8, 270, NULL, 'father name', 'Male', 963214789, '2019-11-19', 'fasildkfj', '2019-11-27 11:32:53', '2019-11-27 11:32:53', NULL),
(79, 9, 271, NULL, 'father name', 'Male', 3498869509, '2019-11-12', 'alskdfjsd', '2019-11-27 12:16:33', '2019-11-27 12:16:33', NULL),
(80, 10, 272, NULL, 'father name', 'Male', 3498869509, '2019-11-25', 'awdfsdf', '2019-11-27 12:16:55', '2019-11-27 12:16:55', NULL),
(81, 11, 273, NULL, 'father name', 'Male', 3498869509, '2019-11-26', 'sfsdfsdfsd', '2019-11-27 12:17:16', '2019-11-27 12:17:16', NULL),
(82, 12, 274, NULL, 'father name', 'Male', 3498869509, '2019-11-19', 'kallar syedan', '2019-11-27 12:17:33', '2019-11-27 12:17:33', NULL),
(83, 15, 268, NULL, 'father name', 'Male', 8525852085, '2019-11-19', 'rawalpindi', '2019-11-28 05:49:40', '2019-11-28 05:49:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `title`, `admin_id`, `updated_at`, `created_at`) VALUES
(48, 'Math', 2, '2019-11-24 08:21:36', '2019-11-24 13:21:36'),
(49, 'Physics', 2, '2019-11-24 08:21:36', '2019-11-24 13:21:36'),
(50, 'Chemistry', 2, '2019-11-24 08:21:37', '2019-11-24 13:21:37'),
(51, 'Science', 2, '2019-11-24 08:21:37', '2019-11-24 13:21:37'),
(52, 'Urdu', 2, '2019-11-24 08:21:37', '2019-11-24 13:21:37'),
(53, 'English', 2, '2019-11-24 08:21:37', '2019-11-24 13:21:37'),
(54, 'Pak Studies', 2, '2019-11-24 08:21:37', '2019-11-24 13:21:37'),
(55, 'Drawing', 2, '2019-11-24 08:21:37', '2019-11-24 13:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Super Admin', 'superadmin@superadmin.com', NULL, '$2y$10$gsSt6PwTy1xThP2d/lDjPupDQKlynsgeqIWKO8ulUqU1pmg4Um1NG', NULL, '2019-09-28 15:37:49', '2019-09-28 15:37:49'),
(2, NULL, 'School Admin 1', 'schooladmin@gmail.com', NULL, '$2y$10$SafkSlmlrYOOQjqN7zVhH.X43tvPQBntbOrFYneSqvoTmrIqS4d1O', NULL, '2019-11-24 08:21:35', '2019-11-24 08:21:35'),
(3, 2, 'Tayyab Yasin', 'tayyibyasin786@gmail.com', NULL, '$2y$10$lb5NnhCe1ZtvIyNBDt8mAeiGK5BboOCxBDPPRx3JPBDmmYEGljCmy', NULL, '2019-11-24 08:41:31', '2019-11-28 04:05:39'),
(4, 2, 'tayyab', 'tayyibyasin@gmail.com', NULL, '$2y$10$G1gjYOwOtX7SJQjBP04jkeRz4wvzDlAsgvV9OW.rBoMTi5SiM3Cxa', NULL, '2019-11-27 06:32:40', '2019-11-27 06:32:40'),
(5, 2, 'majid', 'majid@gmail.com', NULL, '$2y$10$Gboh.bCgcRUG3aLd9ymPped9G2PpvTnR9cGYmteNckCGbYZx7cqVe', NULL, '2019-11-27 06:38:05', '2019-11-27 06:38:05'),
(6, 2, 'hassan', 'hasssan@gmail.com', NULL, '$2y$10$7eel0gmnIFy3jXbDQP2/KuoRwjEju9l684PQYBX9jzbg5oNEZiuRa', NULL, '2019-11-27 11:25:43', '2019-11-27 11:25:43'),
(7, 2, 'amir', 'amir@gmail.com', NULL, '$2y$10$kXvetzV9mw870.O5cWhtGu74I8nMD2pcedho24Za/uw3XHFNHUTpq', NULL, '2019-11-27 11:26:03', '2019-11-27 11:26:03'),
(8, 2, 'hussain', 'hussain@gmail.com', NULL, '$2y$10$4FomrJF1gVsgLauxK.XLeuiDdM61o6V3zpqE1AmElMzBRnSa29VPW', NULL, '2019-11-27 11:26:25', '2019-11-27 11:26:25'),
(9, 2, 'nabeel', 'nabeel@gmail.com', NULL, '$2y$10$HEBSEZanPrDlf0uX3B.lt.xhr1xNvDP0qxZRlh0lXI3ciP6occe4u', NULL, '2019-11-27 11:26:47', '2019-11-27 11:26:47'),
(10, 2, 'aima', 'aima@gmail.com', NULL, '$2y$10$y9l3v5OBEpr4peP87rTg4uPImwxMxQRCNssjK4hqmHK6SluHnmFsG', NULL, '2019-11-27 11:27:21', '2019-11-27 11:27:21'),
(11, 2, 'khaleel', 'khaleel@gmail.com', NULL, '$2y$10$kAMEKeU9I/X7M.JV0kVZPufOc.sYrfCwBWjgVTkmOxSFeaMEW0gwy', NULL, '2019-11-27 11:27:48', '2019-11-27 11:27:48'),
(12, 2, 'hashim', 'hashim@gmail.com', NULL, '$2y$10$DPp9fotHjaPMrpuU1JRzLuE8pbUNNTxXeIbCI9pwtV4qA8TTcI/ge', NULL, '2019-11-27 11:28:13', '2019-11-27 11:28:13'),
(13, NULL, 'new admin', 'newadmin@gmail.com', NULL, '$2y$10$KqONT7doU14E3kstyGm7PODlW3/jCmZmMjV0kFE2jpaaiJV94pRua', NULL, '2019-11-28 05:47:00', '2019-11-28 05:47:00'),
(14, 13, 'a student', 'newstudent@gmail.com', NULL, '$2y$10$50WOodXYiMvpGPSWtTEdqu.w7/aOP8ZWXvwCMy.rCsWdscUKGNXhe', NULL, '2019-11-28 05:48:06', '2019-11-28 05:48:06'),
(15, 2, 'new student', 'nwestudent@gmail.com', NULL, '$2y$10$LYXDgouKROcoaPlNY23Fn.7yIQBn.pYORpLpY6Yui0viBwuNn3KCa', NULL, '2019-11-28 05:49:09', '2019-11-28 05:49:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `class_fees`
--
ALTER TABLE `class_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_id` (`fee_type_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_subject_ibfk_2` (`subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `exam_session_id` (`exam_session_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `exam_sessions`
--
ALTER TABLE `exam_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `fee_receipts`
--
ALTER TABLE `fee_receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_id` (`fee_type_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `user_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT for table `class_fees`
--
ALTER TABLE `class_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `exam_sessions`
--
ALTER TABLE `exam_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fee_receipts`
--
ALTER TABLE `fee_receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `class_fees`
--
ALTER TABLE `class_fees`
  ADD CONSTRAINT `class_fees_ibfk_2` FOREIGN KEY (`fee_type_id`) REFERENCES `fee_types` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `class_fees_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD CONSTRAINT `class_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `class_subjects_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_2` FOREIGN KEY (`exam_session_id`) REFERENCES `exam_sessions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `exams_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `exams_ibfk_5` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `exam_sessions`
--
ALTER TABLE `exam_sessions`
  ADD CONSTRAINT `exam_sessions_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `fee_receipts`
--
ALTER TABLE `fee_receipts`
  ADD CONSTRAINT `fee_receipts_ibfk_1` FOREIGN KEY (`fee_type_id`) REFERENCES `fee_types` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fee_receipts_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD CONSTRAINT `fee_types_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_ibfk_1` FOREIGN KEY (`model_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `student_details_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
