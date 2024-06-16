-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 10:20 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`id`, `user_id`, `amount`, `bal`, `type`, `date`, `deadline`, `status`) VALUES
(1, 3, 1000, 0, 'Membership Fee', '2023-06-18', '2024-06-18', 1),
(2, 2, 1000, 0, 'Membership Fee', '2023-06-17', '2023-06-17', 1),
(3, 4, 1000, 0, 'Membership Fee', '2023-06-18', '2024-06-18', 1),
(4, 18, 1000, 0, 'Membership Fee', '2023-06-18', '2024-06-18', 1),
(5, 19, 1000, 0, 'Membership Fee', '2023-06-18', '2024-06-18', 1);

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
  `date_added` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `block_number`, `lot_number`, `first_name`, `mid_name`, `last_name`, `gender`, `contact`, `username`, `password`, `user_image`, `status`, `date_added`) VALUES
(2, 8, 17, 'Krisha', '', 'Maldonado', 'Female', '09121234567', 'kris', 'kris', 'dp2.png', 1, '2023-06-18'),
(3, 8, 16, 'Annalyza', 'Sarah', 'Maldonado', 'Rather Not Say', '09123456789', 'sample_user', 'sample_user', 'dp1.png', 1, '2023-06-18'),
(4, 9, 2, 'Princess', 'Sarah', 'Does', 'Female', '', 'sarah', 'sarah', '68754d3618d624a051c3f38dc5a732cd.jpg', 1, '2023-06-18'),
(12, 9, 5, 'Astro', 'Astro', 'Astro', 'Male', '09123456789', 'astro', 'astro', '883bf9b29dbd1c3b7f747efe8e12fedf.jpg', 1, '2023-06-18'),
(18, 2, 5, 'Sample', 'User', 'User', 'Male', '09123456789', 'lando', 'alegraheights', 'messages-3.jpg', 1, '2023-06-18'),
(19, 9, 11, 'Sarah', 'Doe', 'Doe', 'Female', '09123456789', 'sarah', 'alegraheights', 'messages-2.jpg', 1, '2023-06-18');

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
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_log`
--

INSERT INTO `payment_log` (`id`, `type`, `project_name`, `amount`, `date_paid`, `user_id`) VALUES
(1, '0', '', 250, '0000-00-00', 3),
(2, 'Membership Fee', '', 250, '0000-00-00', 2),
(3, 'Project Contribution', 'Parol Project', 250, '0000-00-00', 3),
(4, 'Project Contribution', 'Parol Project', 25, '2023-06-18', 3),
(5, 'Membership Fee', '', 1000, '2023-06-18', 3),
(6, 'Project Contribution', '', 1000, '2023-06-18', 3),
(7, 'Project Contribution', '', 1000, '2023-06-18', 3),
(8, 'Project Contribution', '', 1000, '2023-06-18', 3),
(9, 'Membership Fee', '', 1000, '2023-06-18', 3),
(10, 'Membership Fee', '', 1000, '2023-06-18', 4),
(11, 'Membership Fee', '', 1000, '2023-06-18', 18),
(12, 'Membership Fee', '', 1000, '2023-06-18', 19),
(13, 'Project Contribution', 'Sample Project', 900, '2023-06-18', 19);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project`, `description`, `location`, `overall_cost`, `start_date`, `deadline`, `site_pic`, `site_pic1`, `site_pic2`, `tid`, `proposed_project`, `date_added`, `status`) VALUES
(1, 'Covered Court', '\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eget turpis sapien. Vestibulum fringilla, lacus semper dignissim sagittis, augue metus suscipit mi, eu varius dolor ligula dapibus lectus. Sed sollicitudin, velit sit amet rutrum ullamcorper, nibh metus rutrum erat, eu accumsan odio magna vel dolor. Vestibulum efficitur finibus euismod. Sed eu quam ornare, facilisis augue a, fringilla sem. Maecenas in fermentum est. Mauris ex ante, ultrices sit amet sem quis, iaculis consectetur erat. Morbi hendrerit justo consectetur leo pretium, sed accumsan felis lobortis. Suspendisse eget sem eu ipsum egestas dictum. Nam quis pharetra sapien. Etiam massa orci, euismod in magna id, hendrerit pretium nisi.', 'Sample', '30000000', '2019-02-08', '2023-06-30', '12.jpg', 'blueprint-15323.jpeg', 'download.jpg', 1, 1, '2020-10-05', 1),
(2, 'Sample', '\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eget turpis sapien. Vestibulum fringilla, lacus semper dignissim sagittis, augue metus suscipit mi, eu varius dolor ligula dapibus lectus. Sed sollicitudin, velit sit amet rutrum ullamcorper, nibh metus rutrum erat, eu accumsan odio magna vel dolor. Vestibulum efficitur finibus euismod. Sed eu quam ornare, facilisis augue a, fringilla sem. Maecenas in fermentum est. Mauris ex ante, ultrices sit amet sem quis, iaculis consectetur erat. Morbi hendrerit justo consectetur leo pretium, sed accumsan felis lobortis. Suspendisse eget sem eu ipsum egestas dictum. Nam quis pharetra sapien. Etiam massa orci, euismod in magna id, hendrerit pretium nisi.', 'Alegra Heights', '100000', '2023-05-09', '2023-06-22', '12.jpg', 'blueprint-15323.jpeg', 'download.jpg', 0, 5, '2023-05-01', 5),
(8, 'Astro', 'Astreo  ', 'Astro', '10000', '2023-06-08', '2023-06-27', '68754d3618d624a051c3f38dc5a732cd.jpg', 'minimalist-astronaut-hd-wallpaper-1920x1080.jpg', '883bf9b29dbd1c3b7f747efe8e12fedf.jpg', 0, 0, '2023-06-05', 3),
(9, 'Parol Project', '\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eget turpis sapien. Vestibulum fringilla, lacus semper dignissim sagittis, augue metus suscipit mi, eu varius dolor ligula dapibus lectus. Sed sollicitudin, velit sit amet rutrum ullamcorper, nibh metus rutrum erat, eu accumsan odio magna vel dolor. Vestibulum efficitur finibus euismod. Sed eu quam ornare, facilisis augue a, fringilla sem. Maecenas in fermentum est. Mauris ex ante, ultrices sit amet sem quis, iaculis consectetur erat. Morbi hendrerit justo consectetur leo pretium, sed accumsan felis lobortis. Suspendisse eget sem eu ipsum egestas dictum. Nam quis pharetra sapien. Etiam massa orci, euismod in magna id, hendrerit pretium nisi.', 'Court', '10000', '2023-06-08', '2023-06-28', '12.jpg', 'blueprint-15323.jpeg', 'download.jpg', 0, 0, '2023-06-05', 2),
(11, 'Sample Project', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum  ', 'Court', '2000', '2023-06-22', '2023-07-22', 'bas.jpg', 'card.jpg', 'news-5.jpg', 0, 0, '2023-06-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `project_division`
--

CREATE TABLE `project_division` (
  `pd_id` int(11) NOT NULL,
  `division` varchar(100) NOT NULL,
  `project_type` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `start_date` date NULL,
  `estimated_cost` DECIMAL(19, 4) NOT NULL,
  `actual_cost` DECIMAL(19, 4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `project_id`, `task`, `description`, `staff`, `status`, `date_created`, `deadline`, `start_date`, `estimated_cost`, `actual_cost`) VALUES
(1, 2, 'Re-paint Court - update', 'Quisque viverra facilisis lorem sit amet euismod. Fusce vitae semper leo. Morbi nisl sem, porta non erat posuere, aliquam pellentesque mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames - update', 'Sample Staff', 3, '2023-06-03 10:13:30', '2023-09-06', '2023-07-05', 100000.0000, 150000.0000),
(3, 2, 'sample', 'asdasdasdasd', '', 3, '2023-06-05 00:00:00', '2023-09-17', '2023-07-11', 120000.0000, 150000.0000),
(6, 2, 'Sample Task', 'test', '', 3, '2023-06-05 00:00:00', '2023-09-24', '2023-07-10', 200000.0000, 250000.0000),
(7, 8, 'Sample Task', 'Sample Task', '', 1, '2023-06-05 00:00:00', '2023-09-07', '2023-07-17', 170000.0000, 220000.0000),
(8, 4, 'Sample Task', 'asdsa', '', 3, '2023-06-05 00:00:00', '2023-09-16', '2023-06-28', 200000.0000, 250000.0000),
(9, 4, 'Sample Task', '123', '', 2, '2023-06-05 00:00:00', '2023-09-17', '2023-06-27', 300000.0000, 350000.0000),
(10, 1, 'Sample Task', 'mnnm', '', 2, '2023-06-05 00:00:00', '2023-09-20', '2023-07-22', 400000.0000, 500000.0000),
(11, 9, 'Sample Task', 'Quisque viverra facilisis lorem sit amet euismod. Fusce vitae semper leo. Morbi nisl sem, porta non erat posuere, aliquam pellentesque mi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames - update', 'Princess Does', 3, '2023-06-07 00:00:00', '2023-09-14', '2023-06-19', 90000.0000, 140000.0000),
(12, 9, 'Sample Task', 'sdadasdas', 'Astro Astro', 1, '2023-06-07 00:00:00', '2023-09-09', '2023-06-11', 120000.0000, 170000.0000),
(13, 9, 'afasd', 'asdasdas', 'Krisha Maldonado', 2, '2023-06-07 00:00:00', '2023-09-22', '2023-06-12', 180000.0000, 230000.0000),
(14, 11, 'Sample Task', 'Repaint sample project mural', 'Sarah Doe', 2, '2023-06-18 20:04:18', '2023-09-26', '2023-07-27', 2500000.0000, 350000.0000),
(15, 11, 'add task test', 'add task test add task test add task test', 'Sample User', 3, '2023-06-18 20:04:51', '2023-09-30', '2023-07-16', 150000.0000, 200000.0000);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment_log`
--
ALTER TABLE `payment_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
