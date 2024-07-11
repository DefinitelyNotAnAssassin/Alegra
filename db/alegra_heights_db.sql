-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 01:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alegra_heights_db`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `current_budget`
-- (See below for the actual view)
--
CREATE TABLE `current_budget` (
`budget_remaining` double
);

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

CREATE TABLE `finances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `bal` int(11) NOT NULL,
  `type` varchar(250) NOT NULL DEFAULT 'Membership Fee',
  `date` date NOT NULL DEFAULT current_timestamp(),
  `deadline` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`id`, `user_id`, `amount`, `bal`, `type`, `date`, `deadline`, `status`) VALUES
(1, 3, 1000, 0, 'Membership Fee', '2023-06-18', '2024-06-18', 1),
(2, 2, 1000, 0, 'Membership Fee', '2023-06-17', '2023-06-17', 1),
(3, 4, 1000, 0, 'Membership Fee', '2023-06-18', '2024-06-18', 1),
(4, 18, 1000, 0, 'Membership Fee', '2023-06-18', '2024-06-18', 1),
(5, 19, 1000, 0, 'Membership Fee', '2023-06-18', '2024-06-18', 1),
(6, 19, 1000, 0, 'Membership Fee', '2024-06-24', '2024-06-24', 0),
(7, 19, 1000, 0, 'Membership Fee', '2024-06-24', '2024-06-24', 0),
(8, 4, 1000, 0, 'Membership Fee', '2024-06-24', '2024-06-24', 0),
(9, 20, 1000, 0, 'Membership Fee', '2024-06-24', '2025-06-23', 1),
(10, 20, 1000, 0, 'Membership Fee', '2024-06-24', '2025-06-24', 1),
(11, 20, 1000, 0, 'Membership Fee', '2024-06-24', '2024-06-24', 0),
(12, 2, 1000, 0, 'Membership Fee', '2024-06-24', '2025-06-23', 1),
(13, 2, 1000, 0, 'Membership Fee', '2024-06-24', '2025-06-24', 1),
(14, 2, 10000, 0, 'Membership Fee', '2024-06-24', '2025-06-24', 1),
(15, 2, 30000, 0, 'Membership Fee', '2024-06-24', '2025-06-24', 1),
(16, 2, 1000, 0, 'Membership Fee', '2024-06-24', '2025-06-24', 1),
(17, 2, 1000, 0, 'Membership Fee', '2024-06-24', '2024-06-24', 0),
(18, 2, 1000, 0, 'Membership Fee', '2024-06-24', '2024-06-24', 0),
(19, 2, 2000, 0, 'Membership Fee', '2024-06-24', '2025-06-24', 1),
(20, 2, 12000, 0, 'Membership Fee', '2024-06-24', '2024-06-24', 0),
(21, 2, 36000, 0, 'Membership Fee', '2024-06-24', '2025-06-24', 1),
(22, 20, 1000, 0, 'Membership Fee', '2024-06-24', '2024-06-24', 0),
(23, 20, 6000, 0, 'Membership Fee', '2024-06-24', '2024-06-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `Blk` varchar(255) NOT NULL,
  `Lot` varchar(255) NOT NULL,
  `household_owner` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`Blk`, `Lot`, `household_owner`, `id`) VALUES
('1', '1', 4, 14),
('1', '2', 19, 15),
('2', '3', 4, 16),
('4', '5', 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `household_members`
--

CREATE TABLE `household_members` (
  `id` int(11) NOT NULL,
  `relationship_to_head` varchar(255) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `social_security_number` varchar(255) DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `other_id_description` varchar(255) DEFAULT NULL,
  `other_id_number` varchar(255) DEFAULT NULL,
  `social_welfare_programs` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `household_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `is_pwd` tinyint(1) DEFAULT 0,
  `is_political_family` tinyint(1) DEFAULT 0,
  `is_ethnic` tinyint(1) DEFAULT 0,
  `is_ayuda` tinyint(4) DEFAULT NULL,
  `is_military` tinyint(4) DEFAULT NULL,
  `is_4ps` tinyint(4) DEFAULT NULL,
  `is_gsis` tinyint(4) DEFAULT NULL,
  `is_sss` tinyint(4) DEFAULT NULL,
  `is_sap` tinyint(4) DEFAULT NULL,
  `is_sap_qc` tinyint(4) DEFAULT NULL,
  `is_senior` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `household_members`
--

INSERT INTO `household_members` (`id`, `relationship_to_head`, `occupation`, `national_id`, `social_security_number`, `passport_number`, `other_id_description`, `other_id_number`, `social_welfare_programs`, `created_at`, `updated_at`, `household_id`, `member_id`, `is_pwd`, `is_political_family`, `is_ethnic`, `is_ayuda`, `is_military`, `is_4ps`, `is_gsis`, `is_sss`, `is_sap`, `is_sap_qc`, `is_senior`) VALUES
(7, 'Head', '1', '1', '1', '1', '1', '1', '1', '2024-06-20 19:58:03', '2024-06-20 19:58:03', 14, 3, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Head', '1', '1', '1', '1', '1', '1', '1', '2024-06-20 19:58:52', '2024-06-20 19:58:52', 15, 4, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Head', '1', '1', '1', '1', '1', '1', '1', '2024-06-20 20:02:01', '2024-06-20 20:02:01', 15, 19, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Head', '1', '1', '1', '1', '1', '1', '1', '2024-06-20 20:03:31', '2024-06-20 20:03:31', 14, 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '123', '123', '123', '123', '123', '123', '123', '123', '2024-06-23 18:31:26', '2024-06-23 18:31:26', 14, 4, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '123', '1', '1', '', '', '', '', '', '2024-06-25 17:29:53', '2024-06-25 17:29:53', 14, 20, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '', '', '', '', '', '', '', '', '2024-06-25 17:30:18', '2024-06-25 17:30:18', 14, 19, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '', '', '', '', '', '12312312', '', '', '2024-06-25 17:33:03', '2024-06-25 18:22:37', 15, 20, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '', '', '', '', '', '', '', '', '2024-06-25 17:34:09', '2024-06-25 17:34:09', 16, 20, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '123123', '123', '', '', '', '', '', '', '2024-07-11 09:15:44', '2024-07-11 11:16:29', 17, 20, 1, 0, 0, 1, 1, 1, 0, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) NOT NULL,
  `block_number` int(10) NOT NULL,
  `lot_number` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `mid_name` varchar(250) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_image` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_added` date DEFAULT current_timestamp(),
  `household_id` int(11) DEFAULT NULL,
  `membership_plan` varchar(255) DEFAULT 'Monthly',
  `residence_type` varchar(255) DEFAULT 'Homeowner',
  `lot_type` varchar(255) DEFAULT NULL,
  `award_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `block_number`, `lot_number`, `first_name`, `mid_name`, `last_name`, `gender`, `contact`, `username`, `password`, `user_image`, `status`, `date_added`, `household_id`, `membership_plan`, `residence_type`, `lot_type`, `award_type`) VALUES
(2, 8, 17, 'Krisha', '', 'Maldonado', 'Female', '09121234567', 'kris', 'kris', 'dp2.png', 1, '2023-06-18', 9, 'Annually', 'Homeowner', NULL, NULL),
(3, 8, 16, 'Annalyza', 'Sarah', 'Maldonado', 'Rather Not Say', '09123456789', 'sample_user', 'sample_user', 'dp1.png', 1, '2023-06-18', 13, 'Monthly', 'Homeowner', NULL, NULL),
(4, 9, 2, 'Princess', 'Sarah', 'Does', 'Female', '', 'sarah', 'sarah', '68754d3618d624a051c3f38dc5a732cd.jpg', 1, '2023-06-18', 17, 'Monthly', 'Homeowner', NULL, NULL),
(19, 9, 11, 'Sarah', 'Doe', 'Doe', 'Female', '09123456789', 'sarah', 'alegraheights', 'messages-2.jpg', 1, '2023-06-18', 15, 'Monthly', 'Homeowner', NULL, NULL),
(20, 1, 1, 'Winmari', '', 'Manzano', 'Male', '1', '1', '12121', '448262227_10232385425642472_8136769368041204756_n.jpg', 1, '2024-06-24', NULL, 'Semi-Annually', 'Homeowner', NULL, NULL),
(21, 3, 4, 'Winmari', '', 'Manzano', 'Male', '1', 'winmari.manzano', 'alegraheights', '416806701_1147437819998445_7415913858888315293_n.jpg', 1, '2024-07-11', NULL, 'monthly', 'Homeowner', 'Acquired', 'NotYetAwarded');

-- --------------------------------------------------------

--
-- Table structure for table `payment_log`
--

CREATE TABLE `payment_log` (
  `id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `project_name` varchar(250) NOT NULL,
  `amount` int(11) NOT NULL,
  `date_paid` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_log`
--

INSERT INTO `payment_log` (`id`, `type`, `project_name`, `amount`, `date_paid`, `user_id`, `status`) VALUES
(1, '0', '', 250, '0000-00-00', 3, 'Paid'),
(2, 'Membership Fee', '', 250, '0000-00-00', 2, 'Paid'),
(3, 'Project Contribution', 'Parol Project', 250, '0000-00-00', 3, 'Paid'),
(4, 'Project Contribution', 'Parol Project', 25, '2023-06-18', 3, 'Paid'),
(5, 'Membership Fee', '', 1000, '2023-06-18', 3, 'Paid'),
(6, 'Project Contribution', '', 1000, '2023-06-18', 3, 'Paid'),
(7, 'Project Contribution', '', 1000, '2023-06-18', 3, 'Paid'),
(8, 'Project Contribution', '', 1000, '2023-06-18', 3, 'Paid'),
(9, 'Membership Fee', '', 1000, '2023-06-18', 3, 'Paid'),
(13, 'Project Contribution', 'Sample Project', 900, '2023-06-18', 19, 'Paid'),
(20, 'Membership Fee', '', 10000, '2024-06-24', 2, 'Paid'),
(21, 'Membership Fee', '', 30000, '2024-06-24', 2, 'Paid'),
(22, 'Membership Fee', '', 1500, '2024-06-24', 2, 'Paid'),
(23, 'Membership Fee', '', 1000, '2024-06-24', 2, 'Paid'),
(24, 'Membership Fee', '', 1000, '2024-06-24', 2, 'Paid'),
(25, 'Membership Fee', '', 1, '2024-06-24', 2, 'Paid'),
(26, 'Membership Fee', '', 10000, '2024-06-24', 20, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) NOT NULL,
  `project` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `overall_cost` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `deadline` date NOT NULL,
  `site_pic` varchar(100) NOT NULL,
  `site_pic1` varchar(250) NOT NULL,
  `site_pic2` varchar(250) NOT NULL,
  `tid` int(10) NOT NULL,
  `proposed_project` int(5) NOT NULL,
  `date_added` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-pending\r\n1-started\r\n2-onprogress\r\n3-cancelled\r\n5-done'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project`, `description`, `location`, `overall_cost`, `start_date`, `deadline`, `site_pic`, `site_pic1`, `site_pic2`, `tid`, `proposed_project`, `date_added`, `status`) VALUES
(16, 'Lorem Ipsum', 'Lorem ', 'Test', '5000', '2024-05-28', '2024-07-02', '1798772931-cb53d0383b3052977eb1e0512a3585af16da63d0adf88568483f03b29ee373b4-d.webp', '1798772931-cb53d0383b3052977eb1e0512a3585af16da63d0adf88568483f03b29ee373b4-d.webp', '1798772931-cb53d0383b3052977eb1e0512a3585af16da63d0adf88568483f03b29ee373b4-d.webp', 0, 0, '2024-06-23', 5),
(17, '', '', '', '0', '0000-00-00', '0000-00-00', '', '', '', 0, 0, '0000-00-00', 10),
(18, '1', '1 ', '1', '11111', '2024-06-19', '2024-07-05', '448262227_10232385425642472_8136769368041204756_n.jpg', '448262227_10232385425642472_8136769368041204756_n.jpg', '448262227_10232385425642472_8136769368041204756_n.jpg', 0, 0, '2024-06-24', 5),
(19, '123', '123123123', '1312312', '12313', '2024-06-27', '2024-06-28', '448262227_10232385425642472_8136769368041204756_n.jpg', '448262227_10232385425642472_8136769368041204756_n.jpg', '448262227_10232385425642472_8136769368041204756_n.jpg', 0, 0, '2024-06-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_division`
--

CREATE TABLE `project_division` (
  `pd_id` int(11) NOT NULL,
  `division` varchar(100) NOT NULL,
  `project_type` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `project_division`
--

INSERT INTO `project_division` (`pd_id`, `division`, `project_type`) VALUES
(1, 'Layout', 1),
(2, 'Floor', 1),
(3, 'Roof', 1),
(4, 'windows', 1),
(5, 'Sample', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_partition`
--

CREATE TABLE `project_partition` (
  `pp_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `pd_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `project_partition`
--

INSERT INTO `project_partition` (`pp_id`, `project_id`, `pd_id`) VALUES
(1, 2, 5),
(2, 3, 2),
(3, 3, 1),
(4, 4, 2),
(5, 3, 3),
(6, 4, 1),
(7, 4, 3),
(8, 3, 5),
(9, 4, 5),
(10, 3, 4),
(11, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `project_progress`
--

CREATE TABLE `project_progress` (
  `prog_id` int(10) NOT NULL,
  `pp_id` int(10) NOT NULL,
  `progress` int(2) NOT NULL,
  `date_added` date NOT NULL,
  `partition_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `project_progress`
--

INSERT INTO `project_progress` (`prog_id`, `pp_id`, `progress`, `date_added`, `partition_img`) VALUES
(1, 0, 0, '2020-10-05', ''),
(2, 0, 0, '2020-10-05', 'no_image.jpg'),
(3, 0, 0, '2020-10-05', 'no_image.jpg'),
(4, 0, 0, '2020-10-05', ''),
(5, 0, 0, '2020-10-05', ''),
(6, 0, 0, '2020-10-05', ''),
(7, 0, 0, '2020-10-05', ''),
(8, 0, 0, '2020-10-05', ''),
(9, 0, 0, '2020-10-05', ''),
(10, 0, 0, '2020-10-05', 'no_image.jpg'),
(11, 0, 0, '2020-10-05', ''),
(12, 0, 0, '2020-10-05', 'no_image.jpg'),
(13, 1, 80, '2020-10-05', '4703_blank.jpg'),
(14, 0, 0, '2020-10-05', 'no_image.jpg'),
(15, 0, 0, '2020-10-05', 'no_image.jpg'),
(16, 4, 80, '2020-10-05', '6536_blank.jpg'),
(17, 6, 100, '2020-10-05', '1907_blank.jpg'),
(18, 7, 90, '2020-10-05', '8358_blank.jpg'),
(19, 7, 10, '2020-10-05', '9062_blank.jpg'),
(20, 9, 90, '2020-10-05', '3728_blank.jpg'),
(21, 11, 80, '2020-10-05', '9689_blank.jpg'),
(22, 0, 0, '2023-05-01', ''),
(23, 0, 0, '2023-05-01', ''),
(24, 0, 0, '2023-05-01', 'no_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project_team`
--

CREATE TABLE `project_team` (
  `tid` int(10) NOT NULL,
  `date_added` date NOT NULL,
  `eid` int(10) NOT NULL,
  `pio` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `project_team`
--

INSERT INTO `project_team` (`tid`, `date_added`, `eid`, `pio`) VALUES
(1, '2020-10-05', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `proj_con`
--

CREATE TABLE `proj_con` (
  `id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `date_paid` date NOT NULL,
  `deadline` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proj_con`
--

INSERT INTO `proj_con` (`id`, `proj_id`, `amount`, `balance`, `user_id`, `date`, `date_paid`, `deadline`, `status`) VALUES
(3, 9, 1000, 725, 3, '2023-06-17', '2023-06-17', '2023-06-24', 2),
(4, 9, 1000, 1000, 2, '2023-06-17', '2023-06-17', '2023-06-24', 0),
(5, 11, 1000, 100, 19, '2023-06-18', '0000-00-00', '2023-06-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `report_id` varchar(250) NOT NULL,
  `reply` text NOT NULL,
  `img` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(250) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `report_id`, `reply`, `img`, `user_id`, `user`, `date`) VALUES
(1, 'aVP7e0JlMH', 'Phasellus elementum pharetra nisi, at venenatis risus imperdiet laoreet. Suspendisse quis nulla efficitur, interdum lorem non, feugiat purus.Phasellus elementum pharetra nisi, at venenatis risus imperdiet laoreet. Suspendisse quis nulla efficitur, interdum lorem non, feugiat purus.', 'sample.jpg', 1, 'Administration', '2023-06-06 17:21:44'),
(2, 'aVP7e0JlMH', 'Reply user', '', 3, 'Annalyza Maldonado', '2023-06-06 17:21:44'),
(32, 'aVP7e0JlMH', 'sad', '', 2, 'Princess Does', '2023-06-06 18:23:35'),
(33, 'aVP7e0JlMH', 'test', '', 1, 'Administrator', '2023-06-06 18:24:37'),
(34, 'aVP7e0JlMH', 'Test reply ', '', 0, 'Administrator', '2023-06-16 20:01:27'),
(35, 'aVP7e0JlMH', 'sample', '', 3, 'Annalyza Maldonado', '2023-06-16 20:14:14'),
(36, 'aVP7e0JlMH', 'sample', '', 3, 'Annalyza Maldonado', '2023-06-16 20:14:19'),
(37, 'aVP7e0JlMH', 'sample', '', 3, 'Annalyza Maldonado', '2023-06-16 20:14:24'),
(38, 'aVP7e0JlMH', 'sample', 'sample.jpg', 3, 'Annalyza Maldonado', '2023-06-16 20:14:29'),
(39, 'aVP7e0JlMH', 'test img', '352246599_217068281147094_9214581756663586400_n.jpg', 3, 'Annalyza Maldonado', '2023-06-16 20:36:38'),
(40, '3yP8JZSrNr', 'please respond', '', 19, 'Sarah Doe', '2023-06-18 21:04:12'),
(41, '3yP8JZSrNr', 'hello sarah', '', 0, 'Administrator', '2023-06-18 21:04:49'),
(42, '3yP8JZSrNr', 'please upload photo', '', 0, 'Administrator', '2023-06-18 21:05:02'),
(43, '3yP8JZSrNr', 'proof', 'slides-2.jpg', 19, 'Sarah Doe', '2023-06-18 21:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `rep_id` varchar(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `report_img` varchar(250) NOT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `status` varchar(250) NOT NULL DEFAULT '0' COMMENT '0-needs attention\r\n1 - investigating\r\n2-resolved\r\n3-unresolved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `rep_id`, `title`, `user_id`, `user`, `type`, `description`, `report_img`, `date_added`, `status`) VALUES
(1, 'aVP7e0JlMH', 'sample report', 3, 'Annalyza Maldonado', 'Report', 'Phasellus elementum pharetra nisi, at venenatis risus imperdiet laoreet. Suspendisse quis nulla efficitur, interdum lorem non, feugiat purus. In rhoncus neque convallis nibh cursus, a molestie dui eleifend. Sed gravida aliquet lorem, quis tincidunt dolor cursus a. Morbi iaculis turpis at ligula finibus venenatis. Donec aliquam arcu sed neque maximus, eget fringilla nunc aliquet. Donec sagittis pharetra enim sed venenatis. Aenean leo velit, semper et sodales sed, fringilla vel lectus.', 'sample.jpg', '2023-06-06 15:50:09', '0'),
(2, 'HmtcVWrnFv', 'sample report', 0, 'Annalyza Maldonado', 'Report', 'Sample Sample Sample Sample Sample Sample Sample ', 'sample.jpg', '2023-06-06 15:50:09', '0'),
(3, 'GHTSdd1234', 'sample report', 0, 'Annalyza Maldonado', 'Report', 'Sample Sample Sample Sample Sample Sample Sample ', 'sample.jpg', '2023-06-06 15:50:09', '0'),
(4, 'tSOELEIGyX', 'sample report', 0, 'Annalyza Maldonado', 'Report', 'Sample Sample Sample Sample Sample Sample Sample ', 'sample.jpg', '2023-06-06 15:50:09', '2'),
(5, '8m1na07l93', 'sample report', 0, 'user user', 'Report', 'Phasellus elementum pharetra nisi, at venenatis risus imperdiet laoreet. Suspendisse quis nulla efficitur, interdum lorem non, feugiat purus. In rhoncus neque convallis nibh cursus, a molestie dui eleifend. Sed gravida aliquet lorem, quis tincidunt dolor cursus a. Morbi iaculis turpis at ligula finibus venenatis. Donec aliquam arcu sed neque maximus, eget fringilla nunc aliquet. Donec sagittis pharetra enim sed venenatis. Aenean leo velit, semper et sodales sed, fringilla vel lectus.', 'sample.jpg', '2023-06-06 15:50:09', '0'),
(6, 'n44p2y6p6v', 'sample report', 0, 'qwe asd', 'Report', 'Sample Sample Sample Sample Sample Sample Sample ', 'sample.jpg', '2023-06-06 15:50:09', '1'),
(7, 'u11bkvjkhx', 'sample report', 0, 'asdfxc asdawqwd', 'Report', 'Sample Sample Sample Sample Sample Sample Sample ', 'sample.jpg', '2023-06-06 15:50:09', '2'),
(8, 'kouxg8pjy3', 'sample report', 0, 'ghdfgdf asda', 'Report', 'Sample Sample Sample Sample Sample Sample Sample ', 'sample.jpg', '2023-06-06 15:50:09', '3'),
(9, '5CpnPIy0As', 'sample report', 3, 'Annalyza Maldonado', 'Financial Matters', 'sample report', 'pexels-codioful-(formerly-gradienta)-6985118.jpg', '2023-06-16 16:27:52', '0'),
(10, 'rCcpcqJQ6I', 'sample report', 3, 'Annalyza Maldonado', 'Dispute Among Members', 'sample reportsample reportsample report', 'pexels-codioful-(formerly-gradienta)-6985118.jpg', '2023-06-16 16:28:35', '1'),
(11, 'rCcpcqJQ6I', 'sample report', 3, 'Annalyza Maldonado', 'Dispute Among Members', 'sample reportsample reportsample report', 'pexels-codioful-(formerly-gradienta)-6985118.jpg', '2023-06-16 16:29:03', '0'),
(12, 'UfRkKrgz8g', 'Annalyza Maldonado', 3, 'Annalyza Maldonado', 'Property Maintenance', 'Annalyza MaldonadoAnnalyza MaldonadoAnnalyza MaldonadoAnnalyza Maldonado', 'pexels-codioful-(formerly-gradienta)-6985118.jpg', '2023-06-16 16:31:59', '3'),
(13, '7bsB9zM9Cd', 'Annalyza Maldonado', 3, 'Annalyza Maldonado', 'Board Governance', 'Annalyza MaldonadoAnnalyza MaldonadoAnnalyza Maldonado', '352246599_217068281147094_9214581756663586400_n.jpg', '2023-06-16 16:32:13', '0'),
(14, '3yP8JZSrNr', 'sample report', 19, 'Sarah Doe', 'Financial Matters', 'sample report 6/18', 'slides-1.jpg', '2023-06-18 21:03:51', '3');

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `u_name` varchar(250) NOT NULL,
  `u_num` varchar(11) NOT NULL,
  `start` date NOT NULL,
  `t_start` time NOT NULL,
  `t_end` time NOT NULL,
  `title` varchar(250) NOT NULL,
  `u_type` varchar(250) NOT NULL,
  `facility` varchar(250) NOT NULL COMMENT '1-Covered Court\r\n2 - Club house\r\n3 - others',
  `purpose` varchar(250) NOT NULL,
  `date_res` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1-pending\r\n2-approved\r\n3-cancelled\r\n4-rejected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`id`, `user_id`, `u_name`, `u_num`, `start`, `t_start`, `t_end`, `title`, `u_type`, `facility`, `purpose`, `date_res`, `status`) VALUES
(26, 0, 'Sarah Doe', '09123456789', '2023-06-30', '22:52:00', '10:53:00', 'Other 10:52pm - 10:53am', 'Residents', 'Other', 'test reserve 18/06/2023', '2023-06-18 20:44:30', 2),
(27, 0, 'Sample Video', '09123456789', '2023-07-08', '20:55:00', '23:55:00', 'Covered Court 08:55pm - 11:55pm', 'Residents', 'Covered Court', 'test  court', '2023-06-18 20:46:04', 3),
(28, 0, 'Sample', '09123456789', '2023-06-22', '20:58:00', '22:57:00', 'Covered Court 08:58pm - 10:57pm', 'Residents', 'Covered Court', 'adasd', '2023-06-18 20:57:25', 1),
(29, 0, 'Sarah Doe', '09123456789', '2023-06-21', '20:58:00', '23:58:00', 'Covered Court 08:58pm - 11:58pm', 'Residents', 'Covered Court', 'sample test', '2023-06-18 20:59:09', 1),
(30, 0, 'Sarah Doe', '09123456789', '2023-06-19', '22:01:00', '00:01:00', 'Covered Court 10:01pm - 12:01am', 'Residents', 'Covered Court', 'test other facility avail', '2023-06-18 21:00:56', 2);

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` int(5) NOT NULL,
  `project_id` int(5) NOT NULL,
  `task` varchar(225) NOT NULL,
  `description` varchar(225) NOT NULL,
  `staff` varchar(225) NOT NULL,
  `status` int(4) NOT NULL,
  `date_created` datetime NOT NULL,
  `deadline` date NOT NULL,
  `start_date` date DEFAULT NULL,
  `estimated_cost` decimal(19,4) NOT NULL,
  `actual_cost` decimal(19,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `project_id`, `task`, `description`, `staff`, `status`, `date_created`, `deadline`, `start_date`, `estimated_cost`, `actual_cost`) VALUES
(16, 16, 'Learn HTML', '123', 'Sarah Doe', 3, '2024-06-24 01:44:47', '2024-06-19', '2024-06-12', 100.0000, 100.0000),
(17, 16, 'Learn Flask', '123', 'Winmari Manzano', 3, '2024-06-24 15:53:26', '2024-06-12', '2024-06-20', 2000.0000, 1500.0000),
(18, 18, 'Learn HTML', '123', 'Winmari Manzano', 3, '2024-06-24 16:48:00', '2024-06-10', '2024-06-26', 100.0000, 100.0000),
(23, 19, 'Learn HTML', '123', 'Princess Does', 1, '2024-06-26 01:10:05', '2024-06-26', '2024-06-26', 123.0000, 5000.0000),
(24, 19, 'Learn HTML', '123', 'Princess Does', 1, '2024-06-26 01:10:31', '2024-06-26', '2024-06-26', 123.0000, 123.0000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_payment_sum`
-- (See below for the actual view)
--
CREATE TABLE `total_payment_sum` (
`total_amount` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `profile` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `username`, `password`, `first_name`, `last_name`, `profile`) VALUES
(1, 'admin', 'alegra_admin', 'wQz65N8K7', 'Alegra Heights', 'Admin', 'admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_productivity`
--

CREATE TABLE `user_productivity` (
  `id` int(20) NOT NULL,
  `project_id` int(20) NOT NULL,
  `task_id` int(20) NOT NULL,
  `comment` text NOT NULL,
  `subject` varchar(225) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(30) NOT NULL,
  `time_rendered` float NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `current_budget`
--
DROP TABLE IF EXISTS `current_budget`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `current_budget`  AS SELECT (select sum(`payment_log`.`amount`) from `payment_log` where `payment_log`.`status` = 'Paid') - (select sum(`projects`.`overall_cost`) from `projects` where `projects`.`status` not in (0,4) and `projects`.`status` <= 9) AS `budget_remaining` ;

-- --------------------------------------------------------

--
-- Structure for view `total_payment_sum`
--
DROP TABLE IF EXISTS `total_payment_sum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_payment_sum`  AS SELECT sum(`payment_log`.`amount`) AS `total_amount` FROM `payment_log` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `household`
--
ALTER TABLE `household`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_blk_lot` (`Blk`,`Lot`),
  ADD KEY `fk_household_owner` (`household_owner`);

--
-- Indexes for table `household_members`
--
ALTER TABLE `household_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_household` (`household_id`),
  ADD KEY `fk_member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_household` (`household_id`);

--
-- Indexes for table `payment_log`
--
ALTER TABLE `payment_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_division`
--
ALTER TABLE `project_division`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `project_partition`
--
ALTER TABLE `project_partition`
  ADD PRIMARY KEY (`pp_id`);

--
-- Indexes for table `project_progress`
--
ALTER TABLE `project_progress`
  ADD PRIMARY KEY (`prog_id`);

--
-- Indexes for table `project_team`
--
ALTER TABLE `project_team`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `proj_con`
--
ALTER TABLE `proj_con`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_productivity`
--
ALTER TABLE `user_productivity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `household_members`
--
ALTER TABLE `household_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payment_log`
--
ALTER TABLE `payment_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `project_division`
--
ALTER TABLE `project_division`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_partition`
--
ALTER TABLE `project_partition`
  MODIFY `pp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project_progress`
--
ALTER TABLE `project_progress`
  MODIFY `prog_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `project_team`
--
ALTER TABLE `project_team`
  MODIFY `tid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proj_con`
--
ALTER TABLE `proj_con`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_productivity`
--
ALTER TABLE `user_productivity`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `household`
--
ALTER TABLE `household`
  ADD CONSTRAINT `fk_household_owner` FOREIGN KEY (`household_owner`) REFERENCES `members` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `household_members`
--
ALTER TABLE `household_members`
  ADD CONSTRAINT `fk_household` FOREIGN KEY (`household_id`) REFERENCES `household` (`id`),
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `fk_user_household` FOREIGN KEY (`household_id`) REFERENCES `household` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
