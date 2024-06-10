-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 03:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `user_type` varchar(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `user_type`, `is_deleted`, `created_on`) VALUES
(1, 'admin', '$2y$10$6WYHp21FBz6uUpkrZrvdPOrD2QaiN8A.VimKfS8eYRTvbCaif/Jkq', 'Keanuber', 'Ostaya', 'Picture1.jpg', 'admin', 0, '2024-04-30'),
(3, 'staff', '$2y$10$.9ZihqgQPGfjDGdKpC404u2AvFc9fRHe3OzpPkJVTRQTRDH6QxgwW', 'maynard', 'Ostaya', '0407 (6) - frame at 0m4s.jpg', 'staff', 0, '2024-05-05'),
(4, 'test', '$2y$10$zkz.s5.dfF4Upxr.9zk1.uytF.VBe5QCoXDMbELvSOuKrj3cI69N6', 'test', 'test', '0420 (2) - frame at 0m4s.jpg', 'staff', 1, '2024-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `platform` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `firstname`, `lastname`, `photo`, `platform`, `is_deleted`) VALUES
(18, 8, 'Alan', 'Ostaya', '0420 (3) - frame at 0m4s.jpg', 'test', 0),
(19, 8, 'KEANUBER', 'OSTAYA', '0407 (6) - frame at 0m4s.jpg', 'test', 0),
(20, 9, 'GARCIANO', 'E.', 'Screenshot 2023-12-19 231219.png', '', 0),
(21, 9, 'Lemuel', 'Abasolo', 'Picture1.jpg', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `max_vote` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `description`, `max_vote`, `priority`, `is_deleted`) VALUES
(8, 'President', 1, 1, 0),
(9, 'Vice President', 1, 2, 0),
(10, 'test', 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `student_id` int(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `course` enum('BSIT','BSHM','BSTM','BEED','BSED','DEVCOM') NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `account_status` varchar(15) NOT NULL DEFAULT 'active',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `student_id`, `username`, `password`, `firstname`, `lastname`, `photo`, `course`, `gender`, `status`, `account_status`, `is_deleted`) VALUES
(37, 0, 'test', '$2y$10$FBC7hdFzoSZjc6FszDKD1e9VdwDIloMIS6PVFwcHXjni2bYjpf2QC', 'Maynard ', 'Ostaya', '0407 (6) - frame at 0m4s.jpg', 'DEVCOM', 'Male', 'approve', 'active', 0),
(39, 2, 'deactivated', '$2y$10$7m13QLQ6tgSpota8yqMg6OdUbuZh70gUQ2XeKWOx0YC0CUy.jbKOG', 'test2', 'test2', '0422 (1) - frame at 0m4s.jpg', 'BSIT', 'Male', 'deny', 'deactivated', 0),
(54, 3, 'keanuber', '$2y$10$qJdpqkdrsvNlBfV8tHcqg.gojE2s5zcZo7xy4ADejEz9sUcpLXbVC', 'keanuber', 'ostaya', '0424 - frame at 0m4s.jpg', 'BSIT', 'Male', 'approve', 'active', 0),
(55, 4, 'deny', '$2y$10$uyqtRmrDFUIvew3ZmJSfY.BkZBR7UOscgMCpaGHURVle73R8HREK6', 'deny', 'deny', 'Picture1.jpg', 'BSIT', 'Male', 'pending', 'active', 0),
(69, 12, '', '$2y$10$8ECc4/kgOR3/.inpXaXccOFui4KuwpbSwRW.49OMg7NhgniNjN4b.', 'tie', 'tie', '0428 (1) - frame at 0m4s.jpg', 'BSIT', 'Male', 'approve', 'active', 0),
(70, 13, '', '$2y$10$1xVzrGTj3K1Fmbb3w21T9OcInntNZrFkBVH1Lz6srjnTN5J2cFxx.', 'tie', 'tie', '0407 (6) - frame at 0m4s.jpg', 'BSIT', 'Male', 'approve', 'active', 0),
(72, 19101375, '', '$2y$10$7m13QLQ6tgSpota8yqMg6OdUbuZh70gUQ2XeKWOx0YC0CUy.jbKOG', 'keanuber', 'ostaya', '0420 (2) - frame at 0m4s.jpg', 'BSIT', 'Male', 'approve', 'deactivated', 0),
(73, 1925, '', '$2y$10$YA/LW/09.whHin.TnVFDf.b8cKUT2fOGbbcRLiAJk.Vxy0V7YCJyi', 'maynard', 'ostaya', 'Screenshot 2024-05-05 143738.png', 'BSIT', 'Male', 'approve', 'active', 0),
(74, 43243, '', '$2y$10$E5ldn8gVzs2u3feCj6GJY.OLeXNsugxx9rUiJlQ.eLK5MuOHSe52e', 'test', 'test', 'Screenshot 2023-12-19 231219.png', 'BSHM', 'Male', 'approve', 'active', 0),
(75, 8976, '', '$2y$10$NZEm4GsmG7n1ctATfJTYnud23zoK8Ciz6vYFHybloD53FcUmNSWaS', 'HRM', 'HRM', '0420 (3) - frame at 0m4s.jpg', 'BSHM', 'Male', 'approve', 'active', 0),
(76, 666, '', '$2y$10$WM0V/3LvfA4pqot5g1vhk.oQv2OmBIk.akodY5UfKvuVMkBsloHxi', 'test', 'test', '0407 (6) - frame at 0m4s.jpg', 'DEVCOM', 'Male', 'approve', 'active', 0),
(77, 0, '', '$2y$10$4U.xf3d2so9iKYt1o5Pg2.4.FfxeIMix.bujlT6U99F.0FPPLnVYu', 'test', 'test', '', 'BSTM', 'Male', 'approve', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `is_lock` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voters_id`, `candidate_id`, `position_id`, `is_lock`, `is_deleted`) VALUES
(107, 69, 18, 8, 0, 0),
(108, 69, 20, 9, 0, 0),
(109, 70, 19, 8, 0, 0),
(110, 70, 20, 9, 0, 0),
(111, 75, 18, 8, 0, 0),
(112, 75, 21, 9, 0, 0),
(113, 76, 18, 8, 0, 0),
(114, 76, 21, 9, 0, 0),
(115, 77, 19, 8, 0, 0),
(116, 77, 20, 9, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
