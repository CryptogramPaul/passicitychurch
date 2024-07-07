-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 04, 2024 at 08:38 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u354008421_db_passichurch`
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
(33, 'Lego', 'Ma. Althea', 'Leaban', 'Lambunao hospital', '2000-07-03', '2024-07-27', '10:30:00', 'Rodger', 'Rodger', 'Rodger', 'Ma. Alma', 'Ma. Alma', 'Ma. Alma', '2024-07-03 12:10:42', 8);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `posted` tinyint(3) NOT NULL DEFAULT 0 COMMENT '0-Pending, 1-(Reserved, Booked), 7 - (Cancelled,Deleted)',
  `booking_code` varchar(30) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
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
  `sacrament_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `posted`, `booking_code`, `booking_date`, `start_time`, `end_time`, `booking_status`, `remarks`, `amount_to_pay`, `total_payment`, `payment_status`, `created_at`, `updated_at`, `last_modified_by`, `customer_id`, `burial_id`, `baptism_id`, `wedding_id`, `sacrament_type`) VALUES
(24, 0, 'BKNG202407030001', '2024-07-27', '10:30:00', '00:00:00', 'Pending', '', 0.00, 0.00, '', '2024-07-03 12:10:42', '2024-07-04 03:26:32', 0, 8, NULL, 33, NULL, 'Baptism'),
(25, 0, '2024070425', '2024-08-04', '13:00:00', '00:00:00', 'Pending', '', 0.00, 0.00, '', '2024-07-04 07:06:35', '2024-07-04 07:06:35', 0, 8, NULL, NULL, 7, 'Wedding'),
(26, 0, '2024070426', '2024-07-07', '10:00:00', '00:00:00', 'Pending', '', 0.00, 0.00, '', '2024-07-04 07:07:41', '2024-07-04 07:07:41', 0, 8, 10, NULL, NULL, 'Burial');

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
  `contact_no` int(11) DEFAULT NULL,
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
  `date_of_last_rites` date NOT NULL,
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
(10, 'xx', 'xx', 'xx', 2147483647, '2024-07-04', '2000-07-04', 24, 'Male', 'xxxxx', 'Single', 'xxxxxx', 'xxxx', 'xxxx', 1, 1, 0, 'John Doe Miller', 'xxx', 'xxxx', '0000-00-00', 'xxxxxxxxxxxxxx', '2024-06-04', 'xxxxxxx', 'xx', 'xxxx', '2024-07-07', '10:00:00', '', '2024-07-04 07:07:41', 8);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `barangay` varchar(30) DEFAULT NULL,
  `municipality` varchar(20) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `lastname`, `firstname`, `middlename`, `contact_no`, `email_address`, `address`, `barangay`, `municipality`, `province`, `birthdate`, `username`, `password`, `is_active`, `created_at`) VALUES
(8, 'Miller', 'John', 'Doe', 2147483647, 'john@gmail.com', 'sample sample, sample', 'sample', 'sample', 'sample', NULL, 'john', '__admin', 1, '2024-07-02 01:19:12');

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
  `contact_no` int(11) NOT NULL,
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
(1, 'admin', 'amdin', 'admin', 'admin', 946513652, 'admin admin admin', 'Female', '2024-03-01', '2024-06-26 10:40:41', '2024-06-27 11:20:40', 1, 1),
(4, 'samples', 'samples', 'samples', 'sampless', 2147483647, 'asdasdasd', 'Male', '2000-05-29', '2024-06-27 08:48:55', '2024-06-27 11:07:02', 1, 0);

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
(2, 'jp', 'admin', '2024-06-27 08:48:55', '2024-06-27 10:42:05', 'Staff', 4, 1, 1);

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
  `payor_contact_no` int(11) NOT NULL,
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
(2, 5, 1, 2000.00, 0.00, 'Full Payment', '2024-06-27', 'sample', 964576234, '111111', '2024-06-27 03:19:52', '2024-06-27 06:01:07', 1, 1),
(3, 4, 1, 1500.00, 0.00, 'Full Payment', '2024-06-27', 'John Lego Lebuna', 95089143, '247', '2024-06-27 10:55:28', '2024-06-27 10:55:28', 1, 0),
(4, 8, 1, 1200.00, 0.00, 'Down Payment', '2024-06-28', 'gene lira', 2147483647, '267', '2024-06-28 00:36:59', '2024-06-28 00:36:59', 1, 0),
(5, 7, 1, 1500.00, 0.00, 'Full Payment', '2024-06-28', 'john', 9, '555', '2024-06-28 00:54:14', '2024-06-28 00:54:14', 1, 0),
(6, 8, 1, 1500.00, 0.00, 'Full Payment', '2024-07-15', 'Kate Lim', 2147483647, '246', '2024-06-28 01:59:24', '2024-06-28 01:59:24', 1, 0),
(7, 9, 1, 1500.00, 0.00, 'Full Payment', '2024-06-28', 'gene lira', 2147483647, '333', '2024-06-28 02:29:55', '2024-06-28 02:29:55', 1, 0),
(8, 6, 1, 1500.00, 0.00, 'Full Payment', '2024-06-28', 'gene lira', 2147483647, '3333', '2024-06-28 03:01:38', '2024-06-28 03:01:38', 1, 0);

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
		SET total_payment = NEW.amount_pay 
        , payment_status = NEW.payment_classification
        , booking_status = "Booked"
		WHERE booking_id = OLD.booking_id;
	END IF;
END
$$
DELIMITER ;

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
  `booking_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`sponsor_id`, `sacrament_id`, `sacrament_type`, `lastname`, `firstname`, `middlename`, `booking_id`, `created_at`, `updated_at`, `customer_id`) VALUES
(9, 33, 'Baptism', 'Loria', 'Jessa', 'Landero', 24, '2024-07-03 12:10:42', '2024-07-04 03:27:01', 8),
(10, 33, 'Baptism', ' Lim', 'Ally Del', 'Lego', 24, '2024-07-03 12:10:42', '2024-07-04 03:27:01', 8),
(11, 33, 'Baptism', 'xxxx', 'xxxx', 'xxxxxx', 24, '2024-07-04 03:20:31', '2024-07-04 03:37:18', 8),
(12, 7, 'Wedding', 'xxxx', 'xxx', 'xxx', 25, '2024-07-04 07:06:35', '2024-07-04 07:06:35', 8);

-- --------------------------------------------------------

--
-- Table structure for table `wedding`
--

CREATE TABLE `wedding` (
  `wedding_id` int(11) NOT NULL,
  `wedding_date` date NOT NULL,
  `wedding_time` time NOT NULL,
  `groom_lastname` varchar(50) NOT NULL,
  `groom_firstname` varchar(50) NOT NULL,
  `groom_middlename` varchar(50) NOT NULL,
  `bride_lastname` varchar(50) NOT NULL,
  `bride_firstname` varchar(50) NOT NULL,
  `bride_middlename` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wedding`
--

INSERT INTO `wedding` (`wedding_id`, `wedding_date`, `wedding_time`, `groom_lastname`, `groom_firstname`, `groom_middlename`, `bride_lastname`, `bride_firstname`, `bride_middlename`, `customer_id`, `date_created`) VALUES
(7, '2024-08-04', '13:00:00', 'xx', 'xxx', 'xxx', 'xx', 'xx', 'xx', 8, '2024-07-04 07:06:35');

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
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `burial`
--
ALTER TABLE `burial`
  MODIFY `burial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wedding`
--
ALTER TABLE `wedding`
  MODIFY `wedding_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
