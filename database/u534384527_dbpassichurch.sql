-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2025 at 03:12 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u534384527_dbpassichurch`
--

-- --------------------------------------------------------

--
-- Table structure for table `baptism`
--

CREATE TABLE `baptism` (
  `id` int(11) NOT NULL,
  `child_lastname` varchar(50) DEFAULT NULL,
  `child_firstname` varchar(50) DEFAULT NULL,
  `child_middlename` varchar(50) DEFAULT NULL,
  `place_of_birth` varchar(200) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `baptism_date` date NOT NULL,
  `baptism_time` time NOT NULL,
  `father_lastname` varchar(50) DEFAULT NULL,
  `father_firstname` varchar(50) DEFAULT NULL,
  `father_middlename` varchar(50) DEFAULT NULL,
  `mother_lastname` varchar(50) DEFAULT NULL,
  `mother_firstname` varchar(50) DEFAULT NULL,
  `mother_middlename` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `baptism`
--

INSERT INTO `baptism` (`id`, `child_lastname`, `child_firstname`, `child_middlename`, `place_of_birth`, `date_of_birth`, `baptism_date`, `baptism_time`, `father_lastname`, `father_firstname`, `father_middlename`, `mother_lastname`, `mother_firstname`, `mother_middlename`, `date_created`, `customer_id`) VALUES
(46, 'asd', 'asd', 'asd', 'asdasdasd', '2024-10-22', '2024-11-22', '09:46:00', 'asdasd', 'asda', 'sdasd', 'asd', 'asd', 'asd', '2024-11-22 01:46:43', 25),
(47, 'Lim', 'Bea', 'Loot', 'Calinog hospital', '2024-11-01', '2024-12-28', '22:30:00', 'Lim', 'Leo', 'Ong', 'Lim', 'Maria', 'Loot', '2024-11-28 04:31:55', 32),
(48, 'Ong', 'Lea', 'Mendoza', 'Passi City', '2024-10-28', '2024-11-29', '10:30:00', 'Ong', 'Lara', 'Mendoza', 'Ong', 'Apolonio', 'Mendoza', '2024-11-28 05:23:12', 34),
(49, 'Padernilla', 'Louie Rio IV', 'Palma', 'Passi City', '2024-11-28', '2024-11-28', '14:27:00', 'Padernilla', 'Louie Rio III', 'Palma', 'Padernilla', 'Mona Liza', 'Amazan', '2024-11-28 06:28:24', 35),
(50, 'Padernilla', 'Jace', 'Pacardo', 'Brgy. Bantayan San Enrique', '2024-11-28', '2024-12-10', '20:30:00', 'Padernilla', 'Leo', 'Padasay', 'Padernilla', 'Quinnie', 'Pacardo', '2024-11-28 06:29:53', 36),
(51, 'Palma', 'Leomar .Jr', 'Lavilla', 'Mission Hospital', '2024-11-29', '2024-12-25', '10:30:00', 'Palma', 'Leomal', 'L', 'Palma', 'Jera', 'Lavilla', '2024-11-29 04:40:49', 38),
(52, 'f', 'df', '', 'e', '2000-12-02', '2024-12-02', '10:08:00', 'a', 'q', 'd', 'f', 'ad', 'df', '2024-12-02 02:09:48', 41),
(53, 'Palmaira', 'Jamilla', 'Sumindol', '', '2024-11-11', '2024-12-10', '20:30:00', 'Palmaira', 'Ruben', 'Higado', 'SUMINDOL', 'Jenelyn', 'Ayroso', '2024-12-03 05:34:06', 45),
(54, 'Palma', 'Bea', 'Lee', 'Western Iloilo', '2024-11-15', '2024-12-25', '08:30:00', 'Palma', 'Leo', 'Par', 'Palma', 'Linda', 'Lee', '2024-12-03 10:08:51', 46),
(55, 'Pantin', 'Nefisa', 'Paspe', 'Passi', '2024-12-03', '2024-12-15', '19:12:00', 'Paspe', 'Ramon', 'Tiangco', 'Paspe', 'Julia', 'Palmares', '2024-12-03 11:20:39', 46),
(56, 'Loot', 'Ann', 'Adres', 'Mission Hospital', '2024-11-15', '2025-01-15', '10:30:00', 'Par', 'Darel', 'Parcon', 'Loot', 'Andrea', 'Andres', '2024-12-06 05:23:35', 48),
(57, 'Palmaira', 'Raven', 'Sumindol', 'Brgy Gegacjac Passi City', '2024-12-26', '2024-12-29', '21:30:00', 'Palmaira', 'Jose', 'Sumindol', 'Palmaira', 'Maria', 'Garcia', '2024-12-26 04:53:39', 45);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `posted` tinyint(3) NOT NULL DEFAULT 0 COMMENT '0-Pending, 1-(Reserved, Booked), 7 - (Cancelled,Deleted)',
  `booking_code` varchar(30) NOT NULL,
  `church_event` varchar(250) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `booking_status` varchar(20) NOT NULL COMMENT 'Pending,Reserved,Booked, Cancelled',
  `remarks` varchar(200) NOT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `total_payment` decimal(10,2) NOT NULL,
  `payment_status` varchar(20) NOT NULL COMMENT 'Down Payment, Full Payment',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_modified_by` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `burial_id` int(11) DEFAULT NULL,
  `baptism_id` int(11) DEFAULT NULL,
  `wedding_id` int(11) DEFAULT NULL,
  `intentions_id` int(11) DEFAULT NULL,
  `sacrament_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `posted`, `booking_code`, `church_event`, `booking_date`, `start_time`, `booking_status`, `remarks`, `amount_to_pay`, `total_payment`, `payment_status`, `created_at`, `updated_at`, `last_modified_by`, `customer_id`, `burial_id`, `baptism_id`, `wedding_id`, `intentions_id`, `sacrament_type`) VALUES
(81, 1, '2024112281', '', '2024-11-22', '09:46:00', 'Booked', '', 600.00, 600.00, 'Full Payment', '2024-11-22 01:46:43', '2024-11-28 00:59:17', 0, 25, NULL, 46, NULL, NULL, 'Baptism'),
(82, 1, '2024112282', '', '2024-12-06', '15:38:00', 'Pending', '', 200.00, 200.00, 'Full Payment', '2024-11-22 07:39:09', '2024-12-06 01:23:27', 1, 0, NULL, NULL, NULL, 3, 'Intentions'),
(83, 1, '2024112883', '', '2024-12-28', '22:30:00', 'Booked', '', 900.00, 900.00, 'Full Payment', '2024-11-28 04:31:55', '2024-11-28 04:36:31', 1, 32, NULL, 47, NULL, NULL, 'Baptism'),
(84, 1, '2024112884', '', '2024-12-01', '10:00:00', 'Booked', '', 200.00, 200.00, 'Full Payment', '2024-11-28 04:41:26', '2024-11-28 04:42:56', 1, 32, NULL, NULL, NULL, 4, 'Intentions'),
(85, 1, '2024112885', '', '2024-11-29', '10:30:00', 'Booked', '', 800.00, 800.00, 'Full Payment', '2024-11-28 05:23:12', '2024-11-29 04:35:50', 1, 34, NULL, 48, NULL, NULL, 'Baptism'),
(86, 1, '2024112886', '', '2024-11-28', '14:27:00', 'Booked', '', 700.00, 700.00, 'Full Payment', '2024-11-28 06:28:24', '2024-11-28 06:30:15', 1, 35, NULL, 49, NULL, NULL, 'Baptism'),
(87, 1, '2024112887', '', '2024-12-10', '20:30:00', 'Booked', '', 800.00, 800.00, 'Full Payment', '2024-11-28 06:29:53', '2024-11-28 06:37:21', 1, 36, NULL, 50, NULL, NULL, 'Baptism'),
(88, 1, '2024112888', '', '2024-11-28', '06:32:00', 'Booked', '', 200.00, 200.00, 'Full Payment', '2024-11-28 06:32:39', '2024-11-28 06:35:16', 1, 37, NULL, NULL, NULL, 5, 'Intentions'),
(89, 1, '2024112989', '', '2024-11-29', '12:25:00', 'Booked', '', 2500.00, 2500.00, 'Full Payment', '2024-11-29 04:33:31', '2024-11-29 04:35:23', 1, 38, NULL, NULL, 31, NULL, 'Wedding'),
(90, 1, '2024112990', '', '2024-12-25', '10:30:00', 'Booked', '', 1200.00, 1200.00, 'Full Payment', '2024-11-29 04:40:49', '2024-12-01 06:54:01', 1, 38, NULL, 51, NULL, NULL, 'Baptism'),
(91, 1, '2024120191', '', '2024-12-05', '07:27:00', 'Booked', '', 100.00, 100.00, 'Full Payment', '2024-12-01 07:28:47', '2024-12-01 07:30:06', 1, 40, NULL, NULL, NULL, 6, 'Intentions'),
(92, 1, '2024120192', 'xxxx', '2024-12-01', '07:30:00', 'Booked', '', 0.00, 0.00, '', '2024-12-01 07:59:09', '2024-12-01 07:59:09', 1, 0, NULL, NULL, NULL, NULL, ''),
(93, 1, '2024120293', 'seminar', '2024-12-02', '01:30:00', 'Booked', '', 0.00, 0.00, '', '2024-12-02 01:38:09', '2024-12-02 01:38:09', 1, 0, NULL, NULL, NULL, NULL, ''),
(130, 0, '2024120213', '', '2024-12-02', '10:07:00', 'Pending', '', 2200.00, 0.00, '', '2024-12-02 02:08:29', '2024-12-02 02:08:29', 0, 41, 22, NULL, NULL, NULL, 'Burial'),
(133, 1, '2024120213', '', '2024-12-02', '02:08:00', 'Booked', '', 200.00, 200.00, 'Full Payment', '2024-12-02 02:08:48', '2024-12-02 02:15:16', 1, 41, NULL, NULL, NULL, 7, 'Intentions'),
(155, 1, '2024120213', '', '2024-12-02', '10:08:00', 'Booked', '', 1000.00, 1000.00, 'Full Payment', '2024-12-02 02:09:48', '2024-12-02 02:14:45', 1, 41, NULL, 52, NULL, NULL, 'Baptism'),
(156, 1, '2024120215', '', '2024-12-02', '10:10:00', 'Booked', '', 2200.00, 2200.00, 'Full Payment', '2024-12-02 02:11:45', '2024-12-02 02:14:01', 1, 41, 23, NULL, NULL, NULL, 'Burial'),
(157, 1, '2024120215', '', '2024-12-25', '10:41:00', 'Reserved', '', 2300.00, 0.00, '', '2024-12-02 02:42:06', '2024-12-02 02:42:29', 1, 25, NULL, NULL, 90, NULL, 'Wedding'),
(158, 1, '2024120215', '', '2024-12-25', '10:30:00', 'Booked', '', 2200.00, 2000.00, 'Down Payment', '2024-12-02 04:59:06', '2024-12-02 05:57:54', 1, 42, NULL, NULL, 91, NULL, 'Wedding'),
(159, 1, '2024120215', '', '2024-12-02', '06:00:00', 'Booked', '', 200.00, 200.00, 'Full Payment', '2024-12-02 06:01:39', '2024-12-02 06:03:25', 1, 43, NULL, NULL, NULL, 8, 'Intentions'),
(160, 1, '2024120316', '', '2024-12-10', '20:30:00', 'Booked', '', 800.00, 800.00, 'Full Payment', '2024-12-03 05:34:06', '2024-12-03 06:15:36', 1, 45, NULL, 53, NULL, NULL, 'Baptism'),
(313, 0, '2024120316', '', '2024-12-03', '14:24:00', 'Pending', '', 2300.00, 0.00, '', '2024-12-03 06:33:11', '2024-12-03 06:33:11', 0, 25, NULL, NULL, 244, NULL, 'Wedding'),
(314, 1, '2024120331', '', '2024-12-14', '14:46:00', 'Booked', '', 2800.00, 2800.00, 'Full Payment', '2024-12-03 07:04:33', '2024-12-03 07:39:59', 1, 43, NULL, NULL, 245, NULL, 'Wedding'),
(315, 1, '2024120331', '', '2024-12-03', '15:05:00', 'Booked', '', 2200.00, 2200.00, 'Full Payment', '2024-12-03 07:08:40', '2024-12-03 08:15:47', 1, 45, 24, NULL, NULL, NULL, 'Burial'),
(316, 0, '2024120331', '', '2025-01-18', '10:30:00', 'Pending', '', 2700.00, 0.00, '', '2024-12-03 07:21:58', '2024-12-03 07:21:58', 0, 36, 25, NULL, NULL, NULL, 'Burial'),
(317, 1, '2024120331', '', '2024-12-15', '10:30:00', 'Booked', '', 3000.00, 2000.00, 'Down Payment', '2024-12-03 09:59:35', '2024-12-03 11:30:04', 1, 46, NULL, NULL, 246, NULL, 'Wedding'),
(318, 0, '2024120331', '', '2024-12-25', '08:30:00', 'Pending', '', 1300.00, 0.00, '', '2024-12-03 10:08:51', '2024-12-03 10:08:51', 0, 46, NULL, 54, NULL, NULL, 'Baptism'),
(319, 1, '2024120331', '', '2024-12-15', '19:12:00', 'Booked', '', 900.00, 900.00, 'Full Payment', '2024-12-03 11:20:39', '2024-12-03 11:22:45', 1, 46, NULL, 55, NULL, NULL, 'Baptism'),
(320, 1, '2024120332', '', '2024-12-08', '06:30:00', 'Booked', '', 200.00, 200.00, 'Full Payment', '2024-12-03 11:34:01', '2024-12-03 11:35:35', 1, 46, NULL, NULL, NULL, 9, 'Intentions'),
(321, 0, '2024120632', '', '2024-12-06', '11:29:00', 'Pending', '', 2400.00, 0.00, '', '2024-12-06 03:43:23', '2024-12-06 04:04:40', 0, 48, NULL, NULL, 247, NULL, 'Wedding'),
(322, 0, '2024120632', '', '2025-01-15', '10:30:00', 'Pending', '', 900.00, 0.00, '', '2024-12-06 05:23:35', '2024-12-06 05:24:24', 0, 48, NULL, 56, NULL, NULL, 'Baptism'),
(323, 0, '2024120632', '', '2024-12-15', '09:00:00', 'Pending', '', 100.00, 0.00, '', '2024-12-06 05:29:52', '2024-12-06 05:29:52', 0, 48, NULL, NULL, NULL, 10, 'Intentions'),
(324, 1, '2024120632', '', '2024-12-06', '14:56:00', 'Booked', '', 2200.00, 2200.00, 'Full Payment', '2024-12-06 07:01:47', '2024-12-06 07:05:14', 1, 48, 26, NULL, NULL, NULL, 'Burial'),
(325, 0, '2024122632', '', '2024-12-29', '21:30:00', 'Pending', '', 800.00, 0.00, '', '2024-12-26 04:53:39', '2024-12-26 04:53:39', 0, 45, NULL, 57, NULL, NULL, 'Baptism');

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `booking_BEFORE_INSERT` BEFORE INSERT ON `booking` FOR EACH ROW BEGIN
	DECLARE new_id INT;
    SET new_id = (SELECT MAX(booking_id) + 1 FROM booking); -- Get the next ID
    IF new_id IS NULL THEN
        SET new_id = 1; -- If the table is empty, start from 1
    END IF;
	SET NEW.booking_code = concat(REPLACE(CURRENT_DATE(),'-',''), LPAD(new_id, 2, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `burial`
--

CREATE TABLE `burial` (
  `burial_id` int(11) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `date_applied` date DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `father_name` varchar(50) DEFAULT NULL,
  `mother_name` varchar(50) DEFAULT NULL,
  `spouse_name` varchar(50) DEFAULT NULL,
  `no_of_children` int(10) DEFAULT NULL,
  `no_alive` int(10) DEFAULT NULL,
  `no_dead` int(10) DEFAULT NULL,
  `person_responsible` varchar(50) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `member_in_church_org` varchar(20) DEFAULT NULL,
  `date_of_last_rites` date DEFAULT NULL,
  `cause_of_death` varchar(50) NOT NULL,
  `date_of_death` date NOT NULL,
  `death_cert_no` varchar(30) NOT NULL,
  `burial_permit_no` varchar(30) NOT NULL,
  `cemetery` varchar(30) NOT NULL,
  `date_of_burial` date NOT NULL,
  `time_of_burial` time NOT NULL,
  `bac_coordinator` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `burial`
--

INSERT INTO `burial` (`burial_id`, `lastname`, `firstname`, `middlename`, `contact_no`, `date_applied`, `date_of_birth`, `age`, `gender`, `address`, `marital_status`, `father_name`, `mother_name`, `spouse_name`, `no_of_children`, `no_alive`, `no_dead`, `person_responsible`, `relationship`, `member_in_church_org`, `date_of_last_rites`, `cause_of_death`, `date_of_death`, `death_cert_no`, `burial_permit_no`, `cemetery`, `date_of_burial`, `time_of_burial`, `bac_coordinator`, `created_at`, `customer_id`) VALUES
(22, 'f', 'a', 'd', '0', '2024-12-02', '2000-12-02', 1, 'Male', 'sj', 'Single', 'f', 'g', 'fg', 3, 2, 1, 'Lea Par Leaban', 'q', 'f', '2024-11-01', 'sj', '2024-12-02', 'f', 'd', 'd', '2024-12-02', '10:07:00', '', '2024-12-02 02:08:29', 41),
(23, 'f', 'wue', 'e', '1', '2024-12-02', '2000-12-02', 1, 'Female', 'sj', 'Single', 'sj', 'sj', 'sj', 1, 1, 1, 'Lea Par Leaban', 'sj', 'sj', '2024-02-01', 'sj', '2024-12-02', 'sj', 'sjsj', 'sj', '2024-12-02', '10:10:00', '', '2024-12-02 02:11:45', 41),
(24, 'Palmaira', 'Dwight Jay Ven', 'Sumindol', '09815630103', '2024-12-26', '2000-06-07', 23, 'Male', 'Brgy Gegacjac Passi City', 'Single', 'Ruben Higado Palmaira', 'Jenelyn Ayroso Sumimdol', 'Carwn Panes Palmaira', 6, 5, 1, 'Dwight Sumindol Palmaira', 'Brother', 'Choir', '2024-11-13', 'Hit and Run', '2024-12-03', '12345', '6789', 'Passi City Cemetery', '2024-12-03', '15:05:00', '', '2024-12-03 07:08:40', 45),
(25, 'Padasay', 'Michael', 'Palmes', '09102772658', '2024-12-06', '1999-04-23', 25, 'Male', 'Brgy. Maasin Passi City Iloilo', 'Single', 'Mark John Palma Padasay', 'Rowena Palmes Padasay', 'Christian Santiago Cigar', 7, 5, 2, 'Lhy-D Mee Pacardo Padernilla', 'Single', 'None', '2024-12-03', 'Accident', '2024-12-03', '12345567', '122455', 'Passi City Public Cemetery', '2025-01-18', '10:30:00', '', '2024-12-03 07:21:58', 36),
(26, 'Dela Cruz', 'Juan', 'Rowil', '0912345678', '2024-12-06', '2000-12-06', 24, 'Male', 'Arac, Passi City ILoilo', 'Single', 'Shaun Dela Cruz', 'Shaira Dela Cruz', '', 0, 0, 0, 'Shyra Jane Silvestre Moreno', 'Friend', '', '2024-12-06', 'Cardiac Arrest', '2024-12-06', '0005', '0099', 'Passi  City', '2024-12-06', '14:56:00', '', '2024-12-06 07:01:47', 48);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `barangay` varchar(30) DEFAULT NULL,
  `municipality` varchar(20) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `OneTimePin` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `lastname`, `firstname`, `middlename`, `contact_no`, `email_address`, `address`, `barangay`, `municipality`, `province`, `birthdate`, `username`, `password`, `OneTimePin`, `is_active`, `created_at`) VALUES
(16, 'Doe', 'John', 'xx', '09465736543', 'sample@gmail.com', 'Dalid Calinog, Iloilo', 'Dalid', 'Calinog', 'Iloilo', NULL, 'john', '12345', 0, 1, '2024-08-02 03:18:16'),
(19, 'Cruz', 'Miya', 'Love', '09134567801', 'liberojohnpaul24@gmail.com', 'Arac iloilo, 5040', 'Arac', 'iloilo', '5040', NULL, 'admin1', 'user1', 0, 1, '2024-10-09 04:28:47'),
(25, 'Libero', 'John Paul', 'Llera', '0946579846', 'liberojohnpaul24@gmail.com', 'Ilaya Lambunao, Iloilo', 'Ilaya', 'Lambunao', 'Iloilo', NULL, 'username', 'password', 285144, 1, '2024-10-16 12:19:40'),
(31, 'asd', 'asd', 'asd', '09456142364', 'cryptogrampaul@gmail.com', 'asd asd, asd', 'asd', 'asd', 'asd', NULL, 'username1', 'pass', 575947, 1, '2024-11-28 00:22:10'),
(34, 'Palma', 'Necle', 'Jimenes', '09380941488', 'nanashipalma@gmail.com', 'Arac Passi City, Iloilo', 'Arac', 'Passi City', 'Iloilo', NULL, 'Nana', 'Na14', 726418, 1, '2024-11-28 05:14:27'),
(35, 'Padernilla', 'Louie Rio III', 'Palma', '09811562014', 'crystalpadernilla@gmail.com', 'Arac Passi City, Ilolo', 'Arac', 'Passi City', 'Ilolo', NULL, 'Nonoy', 'gwapo', 233199, 1, '2024-11-28 06:25:12'),
(36, 'Padernilla', 'Lhy-D Mee', 'Pacardo', '09102772658', 'lhydmeepadernilla3@gmail.com', 'Brgy.Buenavista Passi City, Iloilo', 'Brgy.Buenavista', 'Passi City', 'Iloilo', NULL, 'Maymay', '12345', 552570, 1, '2024-11-28 06:25:43'),
(37, 'Padura', 'Jackie', 'Rodriguez', '09948786238', 'jackielynpadura@gmail.com', 'Bacuranan Passi City, Iloilo', 'Bacuranan', 'Passi City', 'Iloilo', NULL, 'jackie', '123', 627055, 1, '2024-11-28 06:28:04'),
(38, 'Llavilla', 'Jero', 'Gajo', '09123456789', 'lavillajero769@gmail.com', 'Maribong Lambunao, Iloilo', 'Maribong', 'Lambunao', 'Iloilo', NULL, 'jero', 'gajo', 663536, 1, '2024-11-29 04:23:01'),
(40, 'Laba&amp;ntilde;a', 'El John', 'Evan', '09915914535', 'eljohnlabaa123@gmail.com', 'Pob. Ilawod Passi City, Iloilo', 'Pob. Ilawod', 'Passi City', 'Iloilo', NULL, 'eljohn@123', 'labanaeljohn123', 476232, 1, '2024-12-01 07:24:40'),
(44, 'Palmaira', 'Dwight', 'Sumindol', '09815630103', 'dwightpalmaira@gmail.com', 'Gegacjac Passi, Iloilo', 'Gegacjac', 'Passi', 'Iloilo', NULL, 'Dwight Palmaira', 'dwight07', 630135, 0, '2024-12-03 05:20:41'),
(45, 'Palmaira', 'Dwight', 'Sumindol', '09815630103', 'dwightjayvenpalmaira@gmail.com', 'Gegacjac Passi City, Iloilo', 'Gegacjac', 'Passi City', 'Iloilo', NULL, 'Jay Palmaira', 'jay12345', 111005, 1, '2024-12-03 05:28:31'),
(48, 'Moreno', 'Shyra Jane', 'Silvestre', '09123456788', 'shyrajanemoreno2@gmail.com', 'Pajo Passi City, Iloilo', 'Pajo', 'Passi City', 'Iloilo', NULL, 'jane', 'jane1', 976649, 1, '2024-12-06 03:28:07'),
(49, 'Moreno', 'Shyra Jane', 'Silvestre', '0912345678', 'pnecleangelic@gmail.com', 'Pajo Passi City, Iloilo', 'Pajo', 'Passi City', 'Iloilo', NULL, 'yoo', 'ann3', 189953, 1, '2024-12-06 06:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `email_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`email_id`, `name`, `contact_no`, `email_address`, `message`, `date_created`) VALUES
(1, 'John Lego Lebuna', 2147483647, 'john@gmail.com', 'xxx', '2024-06-27 14:26:28'),
(2, 'gene llamado lira', 32664, 'genelira942@gmail.com', 'xxxx', '2024-06-28 00:45:23'),
(3, 'Aia Noel Pagulong Ar', 2147483647, 'aianoelarguelles94@gmail.com', '', '2024-06-28 07:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `position` varchar(20) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthdate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `lastname`, `firstname`, `middlename`, `position`, `contact_no`, `address`, `gender`, `birthdate`, `created_at`, `update_at`, `user_id`, `is_active`) VALUES
(1, 'admin', 'amdin', 'admin', 'admin', '946513652', 'admin admin admin', 'Female', '2024-03-01', '2024-06-26 10:40:41', '2024-06-27 11:20:40', 1, 1),
(4, 'staff', 'staff', 'samples', 'sampless', '0912345679', 'asdasdasd', 'Male', '2000-05-29', '2024-06-27 08:48:55', '2024-07-07 08:36:27', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_accounts`
--

CREATE TABLE `employee_accounts` (
  `account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_role` varchar(25) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_accounts`
--

INSERT INTO `employee_accounts` (`account_id`, `username`, `password`, `created_at`, `updated_at`, `user_role`, `employee_id`, `is_active`, `created_by`) VALUES
(1, 'user', 'admin', '2024-06-26 10:41:32', '2024-06-27 11:21:47', 'Administrator', 1, 1, 1),
(2, 'jp', 'admin', '2024-06-27 08:48:55', '2024-07-07 08:41:34', 'Staff', 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `intentions`
--

CREATE TABLE `intentions` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `offered_for` varchar(100) NOT NULL,
  `offered_by` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intentions`
--

INSERT INTO `intentions` (`id`, `customer_id`, `date`, `time`, `offered_for`, `offered_by`, `amount`, `date_created`) VALUES
(3, 0, '2024-12-06', '15:38:00', 'saple msaple', 'John Paul Llera Libero', 200.00, '2024-11-22 07:39:09'),
(4, 32, '2024-12-01', '10:00:00', 'Mika Ann Par', 'Gene Llamado Lira', 200.00, '2024-11-28 04:41:26'),
(5, 37, '2024-11-28', '06:32:00', 'Mothers Birthday', 'Jackie Rodriguez Padura', 200.00, '2024-11-28 06:32:39'),
(6, 40, '2024-12-05', '07:27:00', 'Self', 'El John Evan Laba&amp;amp;ntilde;a', 100.00, '2024-12-01 07:28:47'),
(7, 41, '2024-12-02', '02:08:00', '', 'Lea Par Leaban', 200.00, '2024-12-02 02:08:48'),
(8, 43, '2024-12-02', '06:00:00', 'Gene Llamado Lira', 'Gene Llamado Lira', 200.00, '2024-12-02 06:01:39'),
(9, 46, '2024-12-08', '06:30:00', 'Gene Llamado Lira', 'Ann Landero Par', 200.00, '2024-12-03 11:34:01'),
(10, 48, '2024-12-15', '09:00:00', 'Shyra Jane Silvestre Moreno', 'Shyra Jane Silvestre Moreno', 100.00, '2024-12-06 05:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `intentions_sub_details`
--

CREATE TABLE `intentions_sub_details` (
  `detail_id` int(11) NOT NULL,
  `intentions_id` int(11) NOT NULL,
  `intentions_type` text NOT NULL COMMENT 'Thanksgiving, Soul, Petiton, Others',
  `intentions_name` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intentions_sub_details`
--

INSERT INTO `intentions_sub_details` (`detail_id`, `intentions_id`, `intentions_type`, `intentions_name`, `remarks`) VALUES
(38, 4, 'Thanksgiving', 'Birthday', '-'),
(39, 4, 'Soul', 'Soul', 'thank'),
(40, 5, 'Thanksgiving', 'Wedding Anniversary', '-'),
(41, 6, 'Thanksgiving', 'Birthday', '-'),
(42, 6, 'Petition', 'Good Health', '-'),
(63, 7, 'Thanksgiving', 'Birthday', '-'),
(64, 7, 'Soul', 'Soul', 'sjsj'),
(65, 8, 'Thanksgiving', 'Birthday', '-'),
(66, 9, 'Thanksgiving', 'Birthday', '-'),
(67, 3, 'Thanksgiving', 'Birthday', '-'),
(68, 3, 'Thanksgiving', 'Wedding Anniversary', '-'),
(69, 3, 'Thanksgiving', 'Blessings received', 'aasdasd'),
(70, 3, 'Thanksgiving', 'Others', 'asdasd'),
(71, 10, 'Thanksgiving', 'Birthday', '-'),
(72, 10, 'Soul', 'Soul', 'LANCH Lang sa balay');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `posted` tinyint(3) NOT NULL,
  `amount_pay` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `payment_classification` varchar(20) NOT NULL,
  `payment_date` date NOT NULL,
  `payor_name` varchar(20) NOT NULL,
  `payor_contact_no` varchar(11) NOT NULL,
  `receipt_no` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `last_modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `booking_id`, `posted`, `amount_pay`, `balance`, `payment_classification`, `payment_date`, `payor_name`, `payor_contact_no`, `receipt_no`, `created_at`, `update_at`, `created_by`, `last_modified_by`) VALUES
(62, 81, 1, 600.00, 0.00, 'Full Payment', '2024-11-28', 'John Paul Llera Libe', '0946579846', '', '2024-11-28 00:59:17', '2024-11-28 00:59:17', 1, 0),
(63, 82, 1, 200.00, 0.00, 'Full Payment', '2024-11-28', 'John Paul Llera Libe', '0946579846', '', '2024-11-28 01:19:19', '2024-11-28 01:19:19', 1, 0),
(64, 83, 1, 500.00, 0.00, 'Down Payment', '2024-11-28', 'Gene Llamado Lira', '09508901403', '', '2024-11-28 04:35:31', '2024-11-28 04:35:31', 1, 0),
(65, 83, 1, 400.00, 0.00, 'Full Payment', '2024-11-28', 'Gene Llamado Lira', '09508901403', '', '2024-11-28 04:36:31', '2024-11-28 04:36:31', 1, 0),
(66, 84, 1, 200.00, 0.00, 'Full Payment', '2024-11-28', 'Gene Llamado Lira', '09508901403', '', '2024-11-28 04:42:56', '2024-11-28 04:42:56', 1, 0),
(67, 86, 1, 500.00, 0.00, 'Down Payment', '2024-11-28', 'Louie Rio III Palma ', '09811562014', '', '2024-11-28 06:29:46', '2024-11-28 06:29:46', 1, 0),
(68, 86, 1, 200.00, 0.00, 'Full Payment', '2024-11-28', 'Louie Rio III Palma ', '09811562014', '', '2024-11-28 06:30:15', '2024-11-28 06:30:15', 1, 0),
(69, 88, 1, 200.00, 0.00, 'Full Payment', '2024-11-28', 'Jackie Rodriguez Pad', '09948786238', '', '2024-11-28 06:35:16', '2024-11-28 06:35:16', 1, 0),
(70, 87, 1, 500.00, 0.00, 'Down Payment', '2024-11-28', 'Lhy-D Mee Pacardo Pa', '09102772658', '', '2024-11-28 06:37:04', '2024-11-28 06:37:04', 1, 0),
(71, 87, 1, 300.00, 0.00, 'Full Payment', '2024-11-28', 'Lhy-D Mee Pacardo Pa', '09102772658', '', '2024-11-28 06:37:21', '2024-11-28 06:37:21', 1, 0),
(72, 89, 1, 2000.00, 0.00, 'Down Payment', '2024-11-29', 'Jero Gajo Llavilla', '09123456789', '', '2024-11-29 04:34:57', '2024-11-29 04:34:57', 1, 0),
(73, 89, 1, 500.00, 0.00, 'Full Payment', '2024-11-29', 'Jero Gajo Llavilla', '09123456789', '', '2024-11-29 04:35:23', '2024-11-29 04:35:23', 1, 0),
(74, 85, 1, 800.00, 0.00, 'Full Payment', '2024-11-29', 'Necle Jimenes Palma', '09380941488', '', '2024-11-29 04:35:50', '2024-11-29 04:35:50', 1, 0),
(75, 90, 1, 1000.00, 0.00, 'Down Payment', '2024-12-01', 'Jero Gajo Llavilla', '09123456789', '', '2024-12-01 06:53:37', '2024-12-01 06:53:37', 1, 0),
(76, 90, 1, 200.00, 0.00, 'Full Payment', '2024-12-01', 'Jero Gajo Llavilla', '09123456789', '', '2024-12-01 06:54:01', '2024-12-01 06:54:01', 1, 0),
(77, 91, 1, 100.00, 0.00, 'Full Payment', '2024-12-01', 'El John Evan Laba&am', '09915914535', '', '2024-12-01 07:30:06', '2024-12-01 07:30:06', 1, 0),
(78, 156, 1, 2200.00, 0.00, 'Full Payment', '2024-12-02', 'Lea Par Leaban', '09508901403', '', '2024-12-02 02:14:01', '2024-12-02 02:14:01', 1, 0),
(79, 155, 1, 1000.00, 0.00, 'Full Payment', '2024-12-02', 'Lea Par Leaban', '09508901403', '', '2024-12-02 02:14:45', '2024-12-02 02:14:45', 1, 0),
(80, 133, 1, 200.00, 0.00, 'Full Payment', '2024-12-02', 'Lea Par Leaban', '09508901403', '', '2024-12-02 02:15:16', '2024-12-02 02:15:16', 1, 0),
(81, 158, 1, 2000.00, 0.00, 'Down Payment', '2024-12-02', 'JENE Dan Love', '09123456789', '', '2024-12-02 05:57:54', '2024-12-02 05:57:54', 1, 0),
(82, 159, 1, 200.00, 0.00, 'Full Payment', '2024-12-02', 'Gene Llamado Lira', '09123456789', '', '2024-12-02 06:03:25', '2024-12-02 06:03:25', 1, 0),
(83, 160, 1, 800.00, 0.00, 'Full Payment', '2024-12-03', 'Dwight Sumindol Palm', '09815630103', '', '2024-12-03 06:15:36', '2024-12-03 06:15:36', 1, 0),
(84, 314, 1, 2800.00, 0.00, 'Full Payment', '2024-12-03', 'Gene Llamado Lira', '09123456789', '', '2024-12-03 07:39:59', '2024-12-03 07:39:59', 1, 0),
(85, 315, 1, 2000.00, 0.00, 'Down Payment', '2024-12-03', 'Dwight Sumindol Palm', '09815630103', '', '2024-12-03 08:15:21', '2024-12-03 08:15:21', 1, 0),
(86, 315, 1, 200.00, 0.00, 'Full Payment', '2024-12-03', 'Dwight Sumindol Palm', '09815630103', '', '2024-12-03 08:15:47', '2024-12-03 08:15:47', 1, 0),
(87, 319, 1, 900.00, 0.00, 'Full Payment', '2024-12-03', 'Ann Landero Par', '09508901403', '', '2024-12-03 11:22:45', '2024-12-03 11:22:45', 1, 0),
(88, 317, 1, 2000.00, 0.00, 'Down Payment', '2024-12-03', 'Ann Landero Par', '09508901403', '', '2024-12-03 11:30:04', '2024-12-03 11:30:04', 1, 0),
(89, 320, 1, 200.00, 0.00, 'Full Payment', '2024-12-03', 'Ann Landero Par', '09508901403', '', '2024-12-03 11:35:35', '2024-12-03 11:35:35', 1, 0),
(90, 324, 1, 2200.00, 0.00, 'Full Payment', '2024-12-06', 'Shyra Jane Silvestre', '09123456788', '', '2024-12-06 07:05:14', '2024-12-06 07:05:14', 1, 0);

--
-- Triggers `payment`
--
DELIMITER $$
CREATE TRIGGER `payment_AFTER_INSERT` AFTER INSERT ON `payment` FOR EACH ROW BEGIN
	IF NEW.posted = 1 THEN
        UPDATE booking
		SET total_payment = total_payment + NEW.amount_pay, 
        payment_status = NEW.payment_classification, 
        booking_status = "Booked"
		WHERE booking_id = NEW.booking_id;
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `payment_AFTER_UPDATE` AFTER UPDATE ON `payment` FOR EACH ROW BEGIN
     IF NEW.posted = 1 THEN
        UPDATE booking
		SET total_payment = total_payment + NEW.amount_pay
        , payment_status = NEW.payment_classification
        , booking_status = "Booked"
		WHERE booking_id = NEW.booking_id;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `rate_id` int(11) NOT NULL,
  `sacrament_type` varchar(20) DEFAULT NULL,
  `rate_name` varchar(50) NOT NULL,
  `calendar_day` varchar(20) NOT NULL COMMENT 'Weekdays, Weekends',
  `amount_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`rate_id`, `sacrament_type`, `rate_name`, `calendar_day`, `amount_rate`, `created_by`, `date_created`) VALUES
(1, 'Baptism', 'Parents', 'All', 500.00, 1, '2024-07-06 09:51:01'),
(2, 'Baptism', 'Panyal Candle Symbol', 'All', 100.00, 1, '2024-07-06 09:51:01'),
(3, 'Baptism', 'Sponsors', 'All', 100.00, 1, '2024-07-06 09:51:01'),
(4, 'Wedding', 'Mass', 'Weekdays', 1000.00, NULL, '2024-08-02 02:35:14'),
(5, 'Wedding', 'Choir', 'Weekdays', 900.00, NULL, '2024-08-02 02:37:06'),
(6, 'Wedding', 'Electricity', 'Weekdays', 300.00, NULL, '2024-08-02 02:37:32'),
(7, 'Wedding', 'Sponsors', 'Weekdays', 100.00, NULL, '2024-08-02 02:38:00'),
(8, 'Wedding', 'Mass', 'Weekends', 1500.00, NULL, '2024-08-02 02:38:38'),
(9, 'Wedding', 'Electricity', 'Weekends', 300.00, NULL, '2024-08-02 02:39:34'),
(10, 'Wedding', 'Choir', 'Weekends', 900.00, NULL, '2024-08-02 02:40:12'),
(11, 'Wedding', 'Sponsors', 'Weekends', 100.00, NULL, '2024-08-02 02:44:53'),
(12, 'Burial', 'Mass', 'Weekdays', 1000.00, NULL, '2024-08-02 02:45:26'),
(13, 'Burial', 'Choir', 'Weekdays', 900.00, NULL, '2024-08-02 02:45:55'),
(14, 'Burial', 'Electricity', 'Weekdays', 300.00, NULL, '2024-08-02 02:46:28'),
(15, 'Burial', 'Mass', 'Weekends', 1500.00, NULL, '2024-08-02 02:46:47'),
(16, 'Burial', 'Electricity', 'Weekends', 300.00, NULL, '2024-08-02 02:47:04'),
(17, 'Burial', 'Choir', 'Weekends', 900.00, NULL, '2024-08-02 02:47:22'),
(19, 'Intentions', '-', 'Weekdays', 100.00, NULL, '2024-11-20 04:18:47'),
(20, 'Intentions', '-', 'Weekends', 200.00, NULL, '2024-11-20 04:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `requirement_id` int(11) NOT NULL,
  `event_name` varchar(20) NOT NULL,
  `requirement_name` varchar(50) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `burial_id` int(11) NOT NULL,
  `baptism_id` int(11) NOT NULL,
  `wedding_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`requirement_id`, `event_name`, `requirement_name`, `filename`, `burial_id`, `baptism_id`, `wedding_id`) VALUES
(85, 'Wedding', 'Baptismal Certificate', 'Gold_Cross_Computer_File_PNG_-_Free_Download-removebg-preview.png', 0, 0, 244),
(86, 'Wedding', 'Confirmation Certification', 'Butterfly pink wallpaper.png', 0, 0, 244),
(87, 'Wedding', 'Marriage License', '_Pink & Peach Illustration Butterfly Desktop Wallpaper  .png', 0, 0, 244),
(88, 'Wedding', 'Marriage Contract', 'Tzuyu twice.jpg', 0, 0, 244),
(89, 'Wedding', 'Freedom to Marry', 'd17880af-634e-4de5-8c93-69cfa841247e.jpg', 0, 0, 244),
(90, 'Wedding', 'Permit to Marry', 'download (7).jpg', 0, 0, 244),
(91, 'Wedding', 'Baptismal Certificate', 'bAPTISM.jpg', 0, 0, 245),
(92, 'Wedding', 'Confirmation Certification', 'CONFIRMATION.png', 0, 0, 245),
(93, 'Wedding', 'Marriage License', 'licines.jpg', 0, 0, 245),
(94, 'Wedding', 'Confirmation Certification', 'download (1).jpg', 0, 0, 246),
(95, 'Wedding', 'Marriage License', 'download (2).jpg', 0, 0, 246),
(96, 'Wedding', 'Marriage Contract', 'download (3).jpg', 0, 0, 246),
(97, 'Wedding', 'Freedom to Marry', 'download.png', 0, 0, 246),
(98, 'Wedding', 'Permit to Marry', 'download (4).jpg', 0, 0, 246),
(99, 'Wedding', 'Baptismal Certificate', 'download.jpg', 0, 0, 246),
(100, 'Wedding', 'Baptismal Certificate', 'baptismal cert..jpg', 0, 0, 247),
(101, 'Wedding', 'Confirmation Certification', 'confirmation certificate.jpg', 0, 0, 247),
(102, 'Wedding', 'Marriage License', 'marriage lisence.jpg', 0, 0, 247),
(103, 'Wedding', 'Marriage Contract', 'marriage contract.jpg', 0, 0, 247),
(104, 'Wedding', 'Freedom to Marry', 'freedom to marry.jpg', 0, 0, 247),
(105, 'Wedding', 'Permit to Marry', 'permit to marry.webp', 0, 0, 247);

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `sponsor_id` int(11) NOT NULL,
  `sacrament_id` int(11) DEFAULT NULL,
  `sacrament_type` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`sponsor_id`, `sacrament_id`, `sacrament_type`, `lastname`, `firstname`, `middlename`, `amount`, `booking_id`, `created_at`, `updated_at`, `customer_id`) VALUES
(149, 47, 'Baptism', 'Pruto', 'Mika', 'Lim', 100.00, 83, '2024-11-28 04:31:55', '2024-11-28 04:31:55', 32),
(150, 47, 'Baptism', 'Andres', 'Dina', 'Loot', 100.00, 83, '2024-11-28 04:31:55', '2024-11-28 04:31:55', 32),
(151, 47, 'Baptism', 'Caro', 'Alex', 'Ong', 100.00, 83, '2024-11-28 04:31:55', '2024-11-28 04:31:55', 32),
(152, 48, 'Baptism', 'Palma', 'Necle Angelic', 'Jimenes', 100.00, 85, '2024-11-28 05:23:12', '2024-11-28 05:23:12', 34),
(153, 48, 'Baptism', 'Padernilla', 'Lhy-DMee', 'Pacardo', 100.00, 85, '2024-11-28 05:23:12', '2024-11-28 05:23:12', 34),
(154, 49, 'Baptism', '', '', '', 100.00, 86, '2024-11-28 06:28:24', '2024-11-28 06:28:24', 35),
(155, 50, 'Baptism', 'Mendoza', 'Leonie Mae ', 'Pacardo', 100.00, 87, '2024-11-28 06:29:53', '2024-11-28 06:29:53', 36),
(156, 50, 'Baptism', 'Lademora', 'Leian ken ', 'Pacardo ', 100.00, 87, '2024-11-28 06:29:53', '2024-11-28 06:29:53', 36),
(157, 31, 'Wedding', 's', 'a', 's', 100.00, 89, '2024-11-29 04:33:31', '2024-11-29 04:33:31', 38),
(158, 31, 'Wedding', 'v', 'x', 'c', 100.00, 89, '2024-11-29 04:33:31', '2024-11-29 04:33:31', 38),
(159, 31, 'Wedding', 't', 'e', 'r', 100.00, 89, '2024-11-29 04:33:31', '2024-11-29 04:33:31', 38),
(160, 51, 'Baptism', 'Lira', 'Gene', 'L', 100.00, 90, '2024-11-29 04:40:49', '2024-11-29 04:40:49', 38),
(161, 51, 'Baptism', 'Lauderes', 'Sheila', 'S', 100.00, 90, '2024-11-29 04:40:49', '2024-11-29 04:40:49', 38),
(162, 51, 'Baptism', 's', 'a', 's', 100.00, 90, '2024-11-29 04:40:49', '2024-11-29 04:40:49', 38),
(163, 51, 'Baptism', 'v', 'x', 'c', 100.00, 90, '2024-11-29 04:40:49', '2024-11-29 04:40:49', 38),
(164, 51, 'Baptism', 't', 'e', 'r', 100.00, 90, '2024-11-29 04:40:49', '2024-11-29 04:40:49', 38),
(165, 51, 'Baptism', '', '', '', 100.00, 90, '2024-11-29 04:40:49', '2024-11-29 04:40:49', 38),
(292, 52, 'Baptism', 'f', 'd', 'd', 100.00, 155, '2024-12-02 02:09:48', '2024-12-02 02:09:48', 41),
(293, 52, 'Baptism', 'g', 'df', 'f', 100.00, 155, '2024-12-02 02:09:48', '2024-12-02 02:09:48', 41),
(294, 52, 'Baptism', 'd', 'dd', 'd', 100.00, 155, '2024-12-02 02:09:48', '2024-12-02 02:09:48', 41),
(295, 52, 'Baptism', '', '', '', 100.00, 155, '2024-12-02 02:09:48', '2024-12-02 02:09:48', 41),
(296, 90, 'Wedding', 'xx', 'xx', 'x', 100.00, 157, '2024-12-02 02:42:06', '2024-12-02 02:42:06', 25),
(297, 53, 'Baptism', 'Gomez', 'Joeven ', 'Pacino', 100.00, 160, '2024-12-03 05:34:06', '2024-12-03 05:34:06', 45),
(298, 53, 'Baptism', 'Palmares', 'Kristy', 'Palma', 100.00, 160, '2024-12-03 05:34:06', '2024-12-03 05:34:06', 45),
(694, 244, 'Wedding', 'x', 'x', 'x', 100.00, 313, '2024-12-03 06:33:11', '2024-12-03 06:33:11', 25),
(695, 245, 'Wedding', 'Padernilla', 'Lhy Dmee', 'Pacardo', 100.00, 314, '2024-12-03 07:04:33', '2024-12-03 07:04:33', 43),
(696, 246, 'Wedding', 'Par', 'James', 'Lindres ', 100.00, 317, '2024-12-03 09:59:35', '2024-12-03 09:59:35', 46),
(697, 246, 'Wedding', 'Parcon', 'Dina', ' Lindo', 100.00, 317, '2024-12-03 09:59:35', '2024-12-03 09:59:35', 46),
(698, 246, 'Wedding', ' Andres', 'Alven', ' Liloc', 100.00, 317, '2024-12-03 09:59:35', '2024-12-03 09:59:35', 46),
(699, 54, 'Baptism', 'Lindo', 'Ann', 'Par', 100.00, 318, '2024-12-03 10:08:51', '2024-12-03 10:08:51', 46),
(700, 54, 'Baptism', 'Loot', 'Mika', 'Andres', 100.00, 318, '2024-12-03 10:08:51', '2024-12-03 10:08:51', 46),
(701, 54, 'Baptism', 'Leaban', 'Dino', 'Parcon', 100.00, 318, '2024-12-03 10:08:51', '2024-12-03 10:08:51', 46),
(702, 54, 'Baptism', 'Par', 'James', 'Lindres ', 100.00, 318, '2024-12-03 10:08:51', '2024-12-03 10:08:51', 46),
(703, 54, 'Baptism', 'Parcon', 'Dina', ' Lindo', 100.00, 318, '2024-12-03 10:08:51', '2024-12-03 10:08:51', 46),
(704, 54, 'Baptism', ' Andres', 'Alven', ' Liloc', 100.00, 318, '2024-12-03 10:08:51', '2024-12-03 10:08:51', 46),
(705, 54, 'Baptism', '', '', '', 100.00, 318, '2024-12-03 10:08:51', '2024-12-03 10:08:51', 46),
(706, 55, 'Baptism', 'Vargas', 'Rev. Fr.  Eric John', 'Mabico', 100.00, 319, '2024-12-03 11:20:39', '2024-12-03 11:20:39', 46),
(707, 55, 'Baptism', 'Tacardon', 'Rev. Fr.  Moises', 'Wong', 100.00, 319, '2024-12-03 11:20:39', '2024-12-03 11:20:39', 46),
(708, 55, 'Baptism', 'Rudi', 'Rev. Fr.  Joel', 'F', 100.00, 319, '2024-12-03 11:20:39', '2024-12-03 11:20:39', 46),
(709, 247, 'Wedding', 'Padura', 'Jackie', 'Rodriguez', 100.00, 321, '2024-12-06 03:43:23', '2024-12-06 03:43:23', 48),
(710, 247, 'Wedding', 'Parcon', 'Ann', ' Par', 100.00, 321, '2024-12-06 04:04:40', '2024-12-06 04:04:40', 48),
(711, 56, 'Baptism', 'Lim', 'Mika', 'Par', 100.00, 322, '2024-12-06 05:23:35', '2024-12-06 05:23:35', 48),
(712, 56, 'Baptism', 'Loot', 'Aby', 'Lorilla', 100.00, 322, '2024-12-06 05:23:35', '2024-12-06 05:23:35', 48),
(713, 56, 'Baptism', 'Lavilla', 'Jocie', ' Palma', 100.00, 322, '2024-12-06 05:24:24', '2024-12-06 05:24:24', 48),
(714, 57, 'Baptism', 'Lastimoso', 'Nadine ', 'Palma', 100.00, 325, '2024-12-26 04:53:39', '2024-12-26 04:53:39', 45),
(715, 57, 'Baptism', 'Palencia', 'Divine', 'Palmares', 100.00, 325, '2024-12-26 04:53:39', '2024-12-26 04:53:39', 45);

-- --------------------------------------------------------

--
-- Table structure for table `wedding`
--

CREATE TABLE `wedding` (
  `wedding_id` int(11) NOT NULL,
  `wedding_date` date NOT NULL,
  `wedding_time` time NOT NULL,
  `place_of_marriage` varchar(100) NOT NULL,
  `groom_lastname` varchar(50) NOT NULL,
  `groom_firstname` varchar(50) NOT NULL,
  `groom_middlename` varchar(50) NOT NULL,
  `groom_date_of_birth` date NOT NULL,
  `groom_age` int(11) NOT NULL,
  `groom_place_of_birth` varchar(100) NOT NULL,
  `groom_sex` varchar(6) NOT NULL,
  `groom_citizenship` varchar(50) NOT NULL,
  `groom_residence` varchar(100) NOT NULL,
  `groom_religion` varchar(50) NOT NULL,
  `groom_civil_status` varchar(10) NOT NULL,
  `groom_name_of_father` varchar(50) NOT NULL,
  `groom_father_citizenship` varchar(50) NOT NULL,
  `groom_maiden_name_of_mother` varchar(50) NOT NULL,
  `groom_mother_citizenship` varchar(50) NOT NULL,
  `groom_name_of_person_consent` varchar(50) NOT NULL,
  `groom_person_relationship` varchar(50) NOT NULL,
  `groom_person_residence` varchar(100) NOT NULL,
  `bride_lastname` varchar(50) NOT NULL,
  `bride_firstname` varchar(50) NOT NULL,
  `bride_middlename` varchar(50) NOT NULL,
  `bride_date_of_birth` date NOT NULL,
  `bride_age` int(11) NOT NULL,
  `bride_place_of_birth` varchar(100) NOT NULL,
  `bride_sex` varchar(6) NOT NULL,
  `bride_citizenship` varchar(20) NOT NULL,
  `bride_residence` varchar(100) NOT NULL,
  `bride_religion` varchar(20) NOT NULL,
  `bride_civil_status` varchar(20) NOT NULL,
  `bride_name_of_father` varchar(50) NOT NULL,
  `bride_father_citizenship` varchar(20) NOT NULL,
  `bride_maiden_name_of_mother` varchar(50) NOT NULL,
  `bride_mother_citizenship` varchar(20) NOT NULL,
  `bride_name_of_person_consent` varchar(10) NOT NULL,
  `bride_person_relationship` varchar(50) NOT NULL,
  `bride_person_residence` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wedding`
--

INSERT INTO `wedding` (`wedding_id`, `wedding_date`, `wedding_time`, `place_of_marriage`, `groom_lastname`, `groom_firstname`, `groom_middlename`, `groom_date_of_birth`, `groom_age`, `groom_place_of_birth`, `groom_sex`, `groom_citizenship`, `groom_residence`, `groom_religion`, `groom_civil_status`, `groom_name_of_father`, `groom_father_citizenship`, `groom_maiden_name_of_mother`, `groom_mother_citizenship`, `groom_name_of_person_consent`, `groom_person_relationship`, `groom_person_residence`, `bride_lastname`, `bride_firstname`, `bride_middlename`, `bride_date_of_birth`, `bride_age`, `bride_place_of_birth`, `bride_sex`, `bride_citizenship`, `bride_residence`, `bride_religion`, `bride_civil_status`, `bride_name_of_father`, `bride_father_citizenship`, `bride_maiden_name_of_mother`, `bride_mother_citizenship`, `bride_name_of_person_consent`, `bride_person_relationship`, `bride_person_residence`, `customer_id`, `date_created`) VALUES
(31, '2024-11-29', '12:25:00', '', 'Palma', 'Leomar', 'L', '2001-02-01', 23, 'Passi City Hospital', 'Male', 'F', 'Passi city', '6', 'single', 'Mar', 'F', 'Maria', 'F', 'mmmm', 'sister', 'passi', 'Lavilla', 'Jera', 'Gajo', '1995-11-29', 29, 'Maribong Lambunao', 'Female', 'F', 'Maribong', '6', 'single', 'Rodrego', 'f', 'Jesselyn', 'f', 'mar', 'brother', 'lambunao', 38, '2024-11-29 04:33:31'),
(90, '2024-12-25', '10:41:00', '', 'asd', 'asd', 'asd', '2000-12-02', 24, 'Calinog Iloilo', 'Male', 'Filipino', 'asd', 'Roman Catholic', 'Single', 'asd', 'Filipino', 'asd', 'Filipino', '', '', '', 'as', 'asdasd', 'asdasd', '2000-12-02', 24, 'dasdasd', 'Female', 'Filipino', 'Lampaya Calinog Iloilo', 'Roman Catholic', 'Single', 'asd', 'Filipino', 'asdasd', 'Filipino', '', '', '', 25, '2024-12-02 02:42:06'),
(91, '2024-12-25', '10:30:00', '', 'Diga', 'Vince Marr', 'Celo', '2002-07-28', 22, 'Mission Hospital', 'Male', 'f', 'Passi City', '6', 'Single', 'Vicente Medalla Diga', 'F', 'Maricel Celo Diga', 'F', 'Gene Llamado Lira', 'Friend', 'Badu CALINOG', 'Moreno', 'Shyra Jane', 'Silvestre', '2002-07-11', 22, 'Western Hospital', 'Female', 'f', 'Calinog', '6', 'Single', 'Jose Robert Buena Moreno', 'F', 'Mary Jane Silvestre Moreno', 'F', 'Gene Llama', 'F', 'Badu Calinog', 42, '2024-12-02 04:59:06'),
(244, '2024-12-03', '14:24:00', '', 'asd', 'asd', 'asd', '2000-12-03', 24, 'asdasdasd', 'Male', 'Filipino', 'xxxx', 'Roman Catholic', 'Single', 'xxx', 'Filipino', 'xxx', 'Filipino', '', '', '', 'asdasd', 'asdas', 'dasdasd', '2000-12-03', 24, 'asdasd', 'Female', 'Filipino', 'sdasdasd', 'Roman Catholic', 'Single', 'asdasdasd', 'Filipino', 'asdasdasd', 'Filipino', '', '', '', 25, '2024-12-03 06:33:11'),
(245, '2024-12-14', '14:46:00', '', 'Padernilla', 'Louie Rio  III', 'Palma', '2002-08-21', 22, 'Passi City', 'Male', 'Filipino', 'Brgy. Arac,Passi City', 'Roman Catholic', 'Single', 'Louie Rio II Padernilla', 'Filipino', 'Mona Lisa Palma', 'Filipino', 'Necle Angelic Palma', 'Friend', 'Brgy. Arac, Passi City', 'Padura', 'Jackie Lyn', 'Rodriguez', '2000-11-17', 24, 'Passi City', 'Female', 'Filipino', 'Brgy.Bacuranan,Passi City', 'Roman Catholic', 'Single', 'XXXX', 'XXX', 'Cheryle Rodriguez Padura', 'Filipino', 'Necle Ange', 'Friend', 'Brgy. Arac, Passi City', 43, '2024-12-03 07:04:33'),
(246, '2024-12-15', '10:30:00', '', 'Lindres', 'Alexa', 'Lindo', '1992-03-05', 32, 'Mission Hospital', 'Male', 'Filipino', 'Bacuranan Passi City', 'R/C', 'Single', 'Andro Liloc Lindres', 'Filipino', 'Lea Lindo Lindres', 'Filipino', 'Mike Lindo Lindres', 'Brother', 'Bacuranan Passi City', 'Par', 'Andro', 'Landero', '1990-11-03', 34, 'Western Hospital', 'Female', 'F', 'Lambunao Iloilo', 'R/C', 'Single', 'Andres Parcon Par', 'Filipino', 'Andrea Landero Par', 'Filipino', 'Ally Lande', 'Sister', 'Lambunao Iloilo', 46, '2024-12-03 09:59:35'),
(247, '2024-12-06', '11:29:00', '', 'Lee', 'Dave', 'Ong', '1980-01-31', 44, 'Passi Hospital', 'Male', 'Filipino', 'Passi City', 'R/C', 'R/C', 'Jose Palma', 'R/C', 'ana palmares', 'R/C', 'Maria Palma', '', 'Passi City', 'Jimenez', 'Jessica', 'Palma', '2000-12-06', 24, 'Passi Hospital', 'Female', 'Filipino', 'Passi City', 'R/C', 'R/C', 'Adan', 'R/C', 'Lina Palma', 'R/C', 'Kristy Pal', 'R/C', 'Passi City', 48, '2024-12-06 03:43:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baptism`
--
ALTER TABLE `baptism`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `burial`
--
ALTER TABLE `burial`
  ADD PRIMARY KEY (`burial_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_accounts`
--
ALTER TABLE `employee_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `intentions`
--
ALTER TABLE `intentions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intentions_sub_details`
--
ALTER TABLE `intentions_sub_details`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`requirement_id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`sponsor_id`);

--
-- Indexes for table `wedding`
--
ALTER TABLE `wedding`
  ADD PRIMARY KEY (`wedding_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baptism`
--
ALTER TABLE `baptism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `burial`
--
ALTER TABLE `burial`
  MODIFY `burial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_accounts`
--
ALTER TABLE `employee_accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `intentions`
--
ALTER TABLE `intentions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `intentions_sub_details`
--
ALTER TABLE `intentions_sub_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=716;

--
-- AUTO_INCREMENT for table `wedding`
--
ALTER TABLE `wedding`
  MODIFY `wedding_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
