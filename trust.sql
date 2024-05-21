-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 12:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trust`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `last_update` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `img` int(11) NOT NULL,
  `heading` varchar(150) NOT NULL,
  `description` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `status`, `last_update`, `update_by`, `img`, `heading`, `description`) VALUES
(0, 'A', '2024-02-08 10:07:16', 1, 18, 'About Us', 'Sai-Prerna is a compassionate trust dedicated to supporting parents whose children are abroad and unable to return home due to unforeseen emergencies. Our mission is to provide a helping hand during challenging times, offering emotional and practical assistance to families facing the distress of being separated from their loved ones. At Sai-Prerna, we believe in fostering a sense of community and understanding, ensuring that no parent feels alone in their journey. Together, we strive to create a network of support, bridging the gap between parents and their children in foreign lands during times of need.');

-- --------------------------------------------------------

--
-- Table structure for table `allowed_ip`
--

CREATE TABLE `allowed_ip` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `status` char(11) NOT NULL,
  `insert_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allowed_ip`
--

INSERT INTO `allowed_ip` (`id`, `ip_address`, `status`, `insert_time`) VALUES
(1, '::1', 'A', '2024-02-05 10:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `frm_contact`
--

CREATE TABLE `frm_contact` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `system_info` varchar(300) NOT NULL,
  `insert_time` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `purpose` varchar(150) NOT NULL,
  `message` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `frm_contact`
--

INSERT INTO `frm_contact` (`id`, `ip_address`, `system_info`, `insert_time`, `name`, `contact`, `email_id`, `purpose`, `message`) VALUES
(1, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-07 09:56:04', 'Sumit', '8759624100', 'sumit@gmail.com', 'Nice site', 'test'),
(2, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-07 10:10:55', 'Kajal', '9548762140', 'kajal5476@gmail.com', 'Very good website', 'test'),
(3, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-07 10:35:59', 'Rbi', '9548761425', 'rabi@gmail.com', 'looking good', 'Your site is looking like a wow.'),
(4, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-08 03:57:19', 'Sahil', '9548762140', 'sahil@gmail.com', 'Excellent site', 'Wow');

-- --------------------------------------------------------

--
-- Table structure for table `frm_subscribe`
--

CREATE TABLE `frm_subscribe` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `system_info` varchar(300) NOT NULL,
  `insert_time` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `email` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `frm_subscribe`
--

INSERT INTO `frm_subscribe` (`id`, `ip_address`, `system_info`, `insert_time`, `status`, `email`) VALUES
(1, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-07 06:57:12', 'A', 'anjali@gmail.com'),
(2, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-07 06:58:19', 'A', 'kajal@gmail.com'),
(3, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-07 07:07:47', 'A', 'atul@gmail.com'),
(4, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-07 07:10:10', 'A', 'sumitkr.@gmail.com'),
(5, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-07 08:40:18', 'A', 'sumit@123'),
(6, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-08 03:55:29', 'A', 'sahil@gmail.com'),
(7, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-08 05:47:11', 'A', 'preety@gmail.com'),
(8, '::1', '{\"browser\":\"Chrome\",\"browser_ver\":\"121.0.0.0\",\"platform\":\"Windows 10\"}', '2024-02-08 05:52:39', 'A', 'sumitkr.@123');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `last_update` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `img` int(11) NOT NULL,
  `alt` varchar(200) NOT NULL,
  `detail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `status`, `last_update`, `update_by`, `img`, `alt`, `detail`) VALUES
(1, 'A', '2024-02-06 10:05:48', 1, 11, 'celebrate birthday', 'Celebrations'),
(2, 'D', '2024-02-08 10:52:22', 1, 10, 'cremation', 'Cremation Ceremony'),
(3, 'A', '2024-02-08 10:37:32', 1, 22, 'caring', 'Caring'),
(4, 'A', '2024-02-08 10:18:13', 1, 21, 'play', 'Playing'),
(5, 'A', '2024-02-08 10:52:55', 1, 23, 'exercise', 'Exercise');

-- --------------------------------------------------------

--
-- Table structure for table `home_slider`
--

CREATE TABLE `home_slider` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `last_update` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(11) NOT NULL,
  `img` int(11) NOT NULL,
  `top_line` varchar(200) NOT NULL,
  `bottom_line` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `home_slider`
--

INSERT INTO `home_slider` (`id`, `status`, `last_update`, `update_by`, `img`, `top_line`, `bottom_line`) VALUES
(33, 'A', '2024-02-08 09:12:37', 1, 14, 'Sai-Prerna', 'Sai-Prerna Trust Extends Helping Hand: Supports Parents Whose Children Abroad Face Emergencies, Ensuring Aid When Home Seems Far.');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `upload_time` datetime NOT NULL DEFAULT current_timestamp(),
  `upload_by` int(11) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `status`, `upload_time`, `upload_by`, `purpose`, `location`) VALUES
(1, 'A', '2024-02-05 09:57:54', 1, 'home_slider', 'homeslider/1707127074_a38d5b23b779707d2ce6.jpg'),
(2, 'A', '2024-02-05 10:07:24', 1, 'about', 'about/1707127644_3e39730dbce64322ec22.jpg'),
(6, 'A', '2024-02-06 05:06:21', 1, 'slides', 'slides/1707195981_baf31992316e41d81506.jpg'),
(7, 'A', '2024-02-06 05:41:37', 1, 'slides', 'slides/1707198097_e46a85b9495014a5aaf6.jpg'),
(8, 'A', '2024-02-06 05:46:35', 1, 'slides', 'slides/1707198395_fb864676e0ff39a48d46.jpg'),
(11, 'A', '2024-02-06 10:04:32', 1, 'gallery', 'gallery/1707213872_9bcf3c561eab28744a61.jpg'),
(13, 'A', '2024-02-08 07:17:40', 1, 'service', 'services/1707376660_1df81215a2f7ef98ec86.jpg'),
(14, 'A', '2024-02-08 09:12:28', 1, 'home_slider', 'homeslider/1707383548_ac7788437c8ae66de52c.jpg'),
(15, 'A', '2024-02-08 09:35:47', 1, 'about', 'about/1707384947_a93ceaf3258a4e31307a.jpg'),
(16, 'A', '2024-02-08 09:47:14', 1, 'service', 'services/1707385634_bd7153d14ac2016defc5.jpg'),
(17, 'A', '2024-02-08 10:00:13', 1, 'service', 'services/1707386413_185628bf96f0d5af7bc9.jpg'),
(18, 'A', '2024-02-08 10:07:10', 1, 'about', 'about/1707386830_a08ae8daaa634b0bcf05.jpg'),
(21, 'A', '2024-02-08 10:18:00', 1, 'gallery', 'gallery/1707387480_2622f1c6d3967ff0daa7.png'),
(22, 'A', '2024-02-08 10:37:13', 1, 'gallery', 'gallery/1707388633_ba997f1d4ddd69e4738d.jpg'),
(23, 'A', '2024-02-08 10:49:09', 1, 'gallery', 'gallery/1707389349_5d65ca1dd313810006dd.jpg'),
(24, 'A', '2024-02-08 11:13:11', 1, 'slides', 'slides/1707390791_8c5818f5a341101b44a4.jpg'),
(25, 'A', '2024-02-08 11:16:50', 1, 'slides', 'slides/1707391010_2a0fd234118e036b6b6f.jpg'),
(26, 'A', '2024-02-08 11:19:58', 1, 'slides', 'slides/1707391198_80d1bf3ca31865a81867.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `type` char(2) NOT NULL,
  `f_name` varchar(150) NOT NULL,
  `l_name` varchar(150) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `status`, `create_time`, `update_time`, `update_by`, `type`, `f_name`, `l_name`, `email_id`, `password`, `session_id`) VALUES
(1, 'A', '2024-02-05 10:40:00', '2024-02-05 10:40:00', 1, 'SA', 'Sumit', 'Kumar', 'sumit@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 8);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `last_activity_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `login_time`, `ip_address`, `last_activity_time`) VALUES
(1, 1, '2024-02-05 09:43:37', '::1', '2024-02-05 11:12:06'),
(2, 1, '2024-02-05 11:12:53', '::1', '2024-02-05 11:55:20'),
(3, 1, '2024-02-06 03:41:23', '::1', '2024-02-06 11:20:53'),
(4, 1, '2024-02-06 13:44:16', '::1', '2024-02-06 14:30:38'),
(5, 1, '2024-02-07 03:46:49', '::1', '2024-02-07 11:31:32'),
(6, 1, '2024-02-08 03:46:30', '::1', '2024-02-08 05:14:25'),
(7, 1, '2024-02-08 05:44:17', '::1', '2024-02-08 05:45:03'),
(8, 1, '2024-02-08 05:45:25', '::1', '2024-02-08 11:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) NOT NULL,
  `status` varchar(2) NOT NULL,
  `last_update` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(15) NOT NULL,
  `menu` varchar(20) NOT NULL,
  `sequence` int(10) NOT NULL,
  `href_url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `status`, `last_update`, `update_by`, `menu`, `sequence`, `href_url`) VALUES
(1, 'A', '2024-02-06 14:14:23', 1, 'Home', 1, '#wrapper'),
(2, 'A', '2024-02-06 14:16:50', 1, 'About', 2, '#section-about'),
(3, 'A', '2024-02-06 14:17:13', 1, 'Gallery', 3, '#section-gallery'),
(4, 'A', '2024-02-06 14:17:59', 1, 'Service', 4, '#section-services'),
(5, 'A', '2024-02-06 14:27:59', 1, 'Contact', 5, '#section-contact');

-- --------------------------------------------------------

--
-- Table structure for table `mini_slide`
--

CREATE TABLE `mini_slide` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `last_update` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `img` int(11) NOT NULL,
  `alt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mini_slide`
--

INSERT INTO `mini_slide` (`id`, `status`, `last_update`, `update_by`, `img`, `alt`) VALUES
(1, 'A', '2024-02-06 05:31:20', 1, 6, 'img-1'),
(2, 'A', '2024-02-06 05:45:14', 1, 7, 'img-2'),
(3, 'A', '2024-02-08 11:13:17', 1, 24, 'img-3'),
(4, 'A', '2024-02-08 11:16:58', 1, 25, 'img-4'),
(5, 'A', '2024-02-08 11:20:06', 1, 26, 'img-5');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `last_update` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `img` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `status`, `last_update`, `update_by`, `img`, `description`, `name`) VALUES
(1, 'A', '2024-02-08 08:53:19', 1, 13, 'We try and initiate a better understanding of the problems of ageing from a social perspective.', 'Interaction Center'),
(2, 'A', '2024-02-08 09:52:47', 1, 16, 'We conduct routine medical check-up and provide medication to all our elderly patients.', 'Medial Check-Up'),
(3, 'A', '2024-02-08 10:01:46', 1, 17, 'We provide self-contained rooms and 24 hour nursing &amp personal care for aged person.', 'Nursing &amp Personal Carfe');

-- --------------------------------------------------------

--
-- Table structure for table `tab`
--

CREATE TABLE `tab` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `tab_group` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `page_url` varchar(300) NOT NULL,
  `other_action` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tab`
--

INSERT INTO `tab` (`id`, `status`, `create_at`, `tab_group`, `name`, `page_url`, `other_action`) VALUES
(1, 'A', '2020-04-13 20:04:26', 1, 'Users', 'user', 'Add|1,Edit|2,view|3'),
(2, 'A', '2020-06-24 15:43:14', 2, 'Slider', 'slider', 'Add|1,Edit|2,Change Status|3'),
(3, 'A', '2020-06-25 16:30:17', 2, 'Gallery', 'gallery', 'Add|1,Edit|2,Change Status|3'),
(4, 'A', '2020-06-26 10:55:00', 2, 'About', 'about', 'Add|1,Edit|2,Change Status|3'),
(5, 'A', '2024-02-05 16:37:15', 1, 'Web-Settings', 'web_settings', 'Add|1,Edit|2,Change Status|3'),
(6, 'A', '2024-02-06 10:03:55', 2, 'Mini-Slide', 'slide', 'Add|1,Edit|2,Change Status|3'),
(7, 'A', '2024-02-06 11:21:16', 2, 'Service', 'service', 'Add|1,Edit|2,Change Status|3\r\n'),
(8, 'A', '2024-02-06 16:48:53', 2, 'Menu', 'menu', 'Add|1,Edit|2,Change Status|3');

-- --------------------------------------------------------

--
-- Table structure for table `tab_group`
--

CREATE TABLE `tab_group` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  `last_update` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(11) NOT NULL,
  `themify` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tab_group`
--

INSERT INTO `tab_group` (`id`, `status`, `create_time`, `last_update`, `update_by`, `themify`, `name`) VALUES
(1, 'A', '2020-04-12 00:26:47', '2020-04-12 00:26:47', 1, 'ti-settings', 'Settings'),
(2, 'A', '2020-06-24 15:41:35', '2020-06-24 15:41:35', 1, 'ti-medall', 'Gadget');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `user_id` int(11) NOT NULL,
  `tab_id` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `other_action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`user_id`, `tab_id`, `status`, `other_action`) VALUES
(1, 1, 'A', '1 2 3'),
(1, 2, 'A', '1 2 3'),
(1, 3, 'A', '1 2 3'),
(1, 4, 'A', '1 2 3'),
(1, 5, 'A', '1 2 3'),
(1, 6, 'A', '1 2 3'),
(1, 7, 'A', '1 2 3\r\n'),
(1, 8, 'A', '1 2 3');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_key` char(2) NOT NULL,
  `status` char(1) NOT NULL,
  `last_update` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_key`, `status`, `last_update`, `update_by`, `name`) VALUES
('SA', 'A', '2020-04-28 20:34:00', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `visiting_time` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(20) NOT NULL,
  `system_info` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_settings`
--

CREATE TABLE `web_settings` (
  `id` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `last_update` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `web_settings`
--

INSERT INTO `web_settings` (`id`, `status`, `last_update`, `update_by`, `name`, `value`) VALUES
(1, 'A', '2024-02-07 09:22:13', 1, 'email-id', 'contact@sai-prerna.com'),
(2, 'A', '2024-02-07 05:18:09', 1, 'contact', '1800-865-6007'),
(3, 'A', '2024-02-07 05:22:02', 1, 'copyright', 'Copyright &copy2020Sai-Prerna. All Rights Reserved'),
(4, 'A', '2024-02-07 05:24:05', 1, 'address', '795 Folsom Ave, Suite 600 San Francisco, CA 94107'),
(5, 'A', '2024-02-07 05:25:34', 1, 'subscribe', 'To get latest news and update keep connected with us by mailing'),
(6, 'A', '2024-02-07 05:40:37', 1, 'Facebook', '#'),
(7, 'A', '2024-02-07 05:40:48', 1, 'Instagram', '#'),
(8, 'A', '2024-02-07 05:41:05', 1, 'Twitter', '#'),
(9, 'A', '2024-02-07 05:41:12', 1, 'Youtube', '#'),
(10, 'A', '2024-02-07 05:41:23', 1, 'Linkedin', '#'),
(11, 'A', '2024-02-07 09:20:40', 1, 'google-map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3499.8741646462868!2d77.14508757536073!3d28.693410575631518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d03ccdb31b369%3A0xb6b53b80403d1bc8!2sGarg%20Tower%2C%20Netaji%20Subhash%20Place%2C%20Pitampura%2C%20Delhi%2C%20110034!5e0!3m2!1sen!2sin!4v1707295896040!5m2!1sen!2sin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowed_ip`
--
ALTER TABLE `allowed_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frm_contact`
--
ALTER TABLE `frm_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frm_subscribe`
--
ALTER TABLE `frm_subscribe`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_slider`
--
ALTER TABLE `home_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mini_slide`
--
ALTER TABLE `mini_slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab`
--
ALTER TABLE `tab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab_group`
--
ALTER TABLE `tab_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD UNIQUE KEY `user_id` (`user_id`,`tab_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD UNIQUE KEY `user_key` (`user_key`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_settings`
--
ALTER TABLE `web_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowed_ip`
--
ALTER TABLE `allowed_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `frm_contact`
--
ALTER TABLE `frm_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `frm_subscribe`
--
ALTER TABLE `frm_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `home_slider`
--
ALTER TABLE `home_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mini_slide`
--
ALTER TABLE `mini_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tab`
--
ALTER TABLE `tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tab_group`
--
ALTER TABLE `tab_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_settings`
--
ALTER TABLE `web_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
