-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2018 at 09:18 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `psms`
--
CREATE DATABASE IF NOT EXISTS `psms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `psms`;

-- --------------------------------------------------------

--
-- Table structure for table `backup_inventory_tbl`
--

CREATE TABLE IF NOT EXISTS `backup_inventory_tbl` (
  `backup_inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` varchar(50) NOT NULL,
  `make` varchar(10) NOT NULL,
  `model` varchar(10) NOT NULL,
  `serial_no` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `availability` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`backup_inventory_id`),
  KEY `serial_no` (`serial_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `billing_tbl`
--

CREATE TABLE IF NOT EXISTS `billing_tbl` (
  `bill_id` varchar(10) NOT NULL,
  `invoice_id` varchar(10) NOT NULL,
  `invoice_date` date NOT NULL,
  `make` varchar(10) NOT NULL,
  `model` varchar(10) NOT NULL,
  `serial_no` varchar(20) NOT NULL,
  `bill_amount` varchar(50) NOT NULL,
  `cus_id` varchar(100) NOT NULL,
  `warranty_start` date NOT NULL,
  `warranty_end` date NOT NULL,
  `purchase_year` varchar(100) NOT NULL,
  `warranty_applicability` varchar(50) NOT NULL,
  `warranty_years` varchar(50) NOT NULL,
  `warranty_years_text` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`bill_id`),
  KEY `cus_id` (`cus_id`),
  KEY `serial_no` (`serial_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bill_line_item_m_tbl`
--

CREATE TABLE IF NOT EXISTS `bill_line_item_m_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(100) NOT NULL,
  `bill_line_item_no` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `invoice_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `bill_line_item_m_tbl`
--

INSERT INTO `bill_line_item_m_tbl` (`id`, `invoice_no`, `bill_line_item_no`, `category`, `make`, `model`, `serial_no`, `invoice_date`) VALUES
(42, 'INC48526', 'BLI1880', 'Projectors', 'Panasonic', 'PA128', '1913697878929', '2018-02-14'),
(43, 'INC48526', 'BLI1881', 'Projectors', 'Panasonic', 'PA128', '1727382481433', '2018-02-14'),
(44, 'INC48527', 'BLI1882', 'Projectors', 'Infocus', 'S444', '2862518412789', '2017-10-17'),
(45, 'INC48528', 'BLI1883', 'Microphones', 'Polycom', 'PJ50', '3696648158963', '2018-05-12'),
(46, 'INC48528', 'BLI1884', 'Microphones', 'Polycom', 'MRC63', '3444556942662', '2018-05-12'),
(47, 'INC48528', 'BLI1885', 'Microphones', 'Polycom', 'MRC63', '3551478324789', '2018-05-12'),
(48, 'INC48528', 'BLI1886', 'Projectors', 'Panasonic', 'PA128', '1991754779732', '2018-05-12'),
(49, 'INC48528', 'BLI1887', 'Projectors', 'Infocus', 'S444', '2753479253247', '2018-05-12'),
(50, 'INC48529', 'BLI1888', 'Conference', 'Polycom', 'PTL333', '3199157456249', '2018-04-24'),
(51, 'INC48529', 'BLI1889', 'Conference', 'Polycom', 'PTL333', '3166592719145', '2018-04-24'),
(52, 'INC48529', 'BLI1890', 'Projectors', 'Panasonic', 'DK256', '2565617596315', '2018-04-24'),
(53, 'INC48529', 'BLI1891', 'Projectors', 'Panasonic', 'DK256', '2627712157263', '2018-04-24'),
(54, 'INC48529', 'BLI1892', 'Projectors', 'Panasonic', 'PA128', '1468143233544', '2018-04-24'),
(55, 'INC48529', 'BLI1893', 'Amplifiers', 'Polycom', 'RX360', '3424443712263', '2018-04-24'),
(56, 'INC48529', 'BLI1894', 'Microphones', 'Polycom', 'PJ50', '3641593518275', '2018-04-24'),
(57, 'INC48529', 'BLI1895', 'Microphones', 'Polycom', 'MRC63', '3539714151438', '2018-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `bill_m_tbl`
--

CREATE TABLE IF NOT EXISTS `bill_m_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(100) NOT NULL,
  `invoice_date` date NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `bill_m_tbl`
--

INSERT INTO `bill_m_tbl` (`id`, `invoice_no`, `invoice_date`, `total_amount`, `customer_id`) VALUES
(73, 'INC48526', '2018-02-14', 36000.00, 'CUS1001'),
(74, 'INC48527', '2017-10-17', 40000.00, 'CUS1001'),
(75, 'INC48528', '2018-05-12', 180000.00, 'CUS1004'),
(76, 'INC48529', '2018-04-24', 809500.00, 'CUS1003');

-- --------------------------------------------------------

--
-- Table structure for table `customer_job_history_tbl`
--

CREATE TABLE IF NOT EXISTS `customer_job_history_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(200) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `job_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `final_status` varchar(100) NOT NULL,
  `status_change_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `customer_job_history_tbl`
--

INSERT INTO `customer_job_history_tbl` (`id`, `job_id`, `customer_id`, `job_date`, `status`, `final_status`, `status_change_date`) VALUES
(6, 35011, 'CUS1001', '2018-07-31', 'New', 'In Progress', '2018-07-31'),
(94, 35011, 'CUS1001', '2018-07-31', 'Technician WIP', 'In Progress', '2018-08-16'),
(106, 35011, 'CUS1001', '2018-07-31', 'Sent to Store', 'In Progress', '2018-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `customer_job_tbl`
--

CREATE TABLE IF NOT EXISTS `customer_job_tbl` (
  `job_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `job_date` date NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `problem_description` text NOT NULL,
  `warranty_type` varchar(100) NOT NULL,
  `sales_order_no` varchar(100) NOT NULL,
  `sales_order_date` date NOT NULL,
  `technician_id` varchar(100) NOT NULL,
  `store_manager_id` varchar(100) NOT NULL,
  `service_manager_id` varchar(100) NOT NULL,
  `imports_manager_id` varchar(100) NOT NULL,
  `job_status` varchar(100) NOT NULL,
  `technician_status` varchar(100) NOT NULL,
  `store_manager_status` varchar(100) NOT NULL,
  `service_manager_status` varchar(100) NOT NULL,
  `imports_manager_status` varchar(100) NOT NULL,
  `current_status` varchar(100) NOT NULL,
  PRIMARY KEY (`job_id`),
  KEY `serial_no` (`serial_no`),
  KEY `technician_id` (`technician_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_job_tbl`
--

INSERT INTO `customer_job_tbl` (`job_id`, `customer_id`, `invoice_no`, `job_date`, `serial_no`, `category`, `make`, `model`, `problem_description`, `warranty_type`, `sales_order_no`, `sales_order_date`, `technician_id`, `store_manager_id`, `service_manager_id`, `imports_manager_id`, `job_status`, `technician_status`, `store_manager_status`, `service_manager_status`, `imports_manager_status`, `current_status`) VALUES
('35011', 'CUS1001', 'INC48527', '2018-07-31', '2862518412789', 'Projectors', 'Infocus', 'S444', 'power off', 'Supplier Warranty', 'YC4204', '2016-08-25', 'TEC201', 'STMGR000', 'SERMGR000', 'IMPMGR000', 'In Progress', 'Sent to Store', 'New', 'Pending', 'Pending', 'Sent to Store');

-- --------------------------------------------------------

--
-- Table structure for table `customer_m_tbl`
--

CREATE TABLE IF NOT EXISTS `customer_m_tbl` (
  `customer_id` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `cus_address` varchar(200) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `contact_no1` varchar(20) NOT NULL,
  `NIC` varchar(10) NOT NULL,
  `fax` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_m_tbl`
--

INSERT INTO `customer_m_tbl` (`customer_id`, `title`, `cus_name`, `cus_address`, `contact_no`, `contact_no1`, `NIC`, `fax`, `email`, `status`) VALUES
('CUS1001', 'Mr.', 'Azam Anas', 'Link Natural (Pvt) Ltd,\r\nColombo 05                                                ', '0776790257', '0112719393', '887400577V', '0112719350', 'kamal@linkproducts.lk', 'active'),
('CUS1002', 'Ms.', 'Kasuni Liyanage', 'Autumn Lane Studio\r\nBattaramulla.                                                ', '0712316542', '0112714560', 'NA', 'NA', 'kasuni@autumn.lk', 'active'),
('CUS1003', 'Rev.', 'Panadure Vijitha Nanda Thero', 'Sri Medhananda Temple,\r\nPanadura                  ', '0777961111', '0112719393', 'NA', '0112719350', 'vijithananda@gmail.com', 'active'),
('CUS1004', 'Mr.', 'Gayan Akurugoda', '25/B, Rawathawaththe,\r\nMoratuwa                                                ', '0716938501', '0112793506', '935964820V', 'NA', 'gayan@yahoo.com', 'active'),
('CUS1005', 'Mr.', 'Chandra Srimantha', 'Abans Plc,\r\nColombo 08.                                                ', '0776420257', '0112719393', '759028539V', '0112719350', 'sri@abans.lk', 'active'),
('CUS1006', 'Dr.', 'Oshan Basnayake', 'No.58/A, Daniel Perera Mw,\r\nKiribathgoda', '0774560110', '0112845607', '893959317V', 'NA', 'oshanb@gmail.com', 'active'),
('CUS1007', 'Mr.', 'Neel Hettiarachchi', 'Aitken Spence Hotel,\r\nColombo 02\r\n ', '0714596740', '0112640582', '554902489V', 'NA', 'neelh@gmail.com', 'active'),
('CUS1008', 'Ms.', 'Ramya Wanigasekara', 'Mas Holdings (Pvt) Ltd\r\nRathnapura', '0783469704', '0455607803', '764056097V', '0455607803', 'ramya@masholdings.com', 'active'),
('CUS1009', 'Mr.', 'Chanaka Pathirana', 'Eco Air Condition (pvt) Ltd\r\nNittabuwa                                                ', '0777355670', '0375697320', '678035867V', 'NA', 'chanakap@eco.lk', 'active'),
('CUS1010', 'Mr.', 'Saman Weeraman', 'Subodha Furniture\r\nWadduwa', '0783958291', '0385679248', '503947202V', 'NA', 'saman@subodha.lk', 'active'),
('CUS1011', 'Ms.', 'Namali Rajapakse', 'Ministry of Education,\r\nBattaramulla.', '0765893405', '0112840571', '915703495V', '0112840572', 'namalir@edu.lk', 'active'),
('CUS1012', 'Ms.', 'Yasawathi Samarapala', 'University of Peradeniya,\r\nPeradeniya.', '0777698302', '0814972058', '501350684V', '0814972058', 'yasawathi@pera.lk', 'active'),
('CUS1013', 'Ms.', 'Vimala Galpatha', 'No 42, giripura', '0776790257', '0112718485', '951080145V', '0112719395', 'vimala@gmail.com', 'active'),
('CUS1014', 'Ms.', 'Doti Galpatha', 'No 41, Giripura Lane 1', '0774852173', '0112719390', '971023175V', '0112718485', 'vimala@gmail.com', 'active'),
('CUS1015', 'Ms.', 'Kasun Galpathaaaaaa', 'No 41, Giripura Lane 1', '0774852173', '0112719390', '911023175V', '0112718485', 'kasungalpatha@gmail.com', 'active'),
('CUS1016', 'Ms.', 'Upul Shantha', 'No 45, Colombo 10', '0771254896', '01127195247', '931085120V', '0112719390', 'upul@gmail.com', 'active'),
('CUS1017', 'Father.', 'John Silvestor ', 'St.Sebasthian Church,\r\nMoratuwa', '0718450295', '0112830428', '503951057V', '0112830428', 'johns@gmail.com', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `employee_m_tbl`
--

CREATE TABLE IF NOT EXISTS `employee_m_tbl` (
  `emp_id` varchar(100) NOT NULL,
  `emp_type` varchar(100) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_1` varchar(10) NOT NULL,
  `contact_2` varchar(10) NOT NULL,
  `NIC` varchar(10) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_m_tbl`
--

INSERT INTO `employee_m_tbl` (`emp_id`, `emp_type`, `emp_name`, `email`, `contact_1`, `contact_2`, `NIC`, `Address`, `status`) VALUES
('EMP1015', 'Technician', 'Kamal Tech', 'azam4636@gmail.com', '0776790257', '0112719390', '931080172V', 'Colombo 12', 'active'),
('EMP1016', 'Technician', 'Namal Tech', 'azam4636@gmail.com', '0776790257', '0112719390', '931080172V', 'Colombo 12', 'active'),
('EMP1017', 'Technician', 'Sunimal Tech', 'azam4636@gmail.com', '0776790257', '0112719390', '931080172V', 'Colombo 12', 'active'),
('EMP1018', 'Technician', 'Nimala Tech', 'azam4636@gmail.com', '0776790257', '0112719390', '931080172V', 'Colombo 12', 'active'),
('EMP1019', 'Technician', 'Upul Tech', 'azam4636@gmail.com', '0776790257', '0112719320', '931020182V', 'Colombo 12', 'active'),
('EMP1020', 'Technician', 'Tharindu Tech', 'azam.personal247@gmail.com', '0776790257', '0112719350', '931080172V', 'Colombo 3', 'active'),
('EMP1021', 'Technician', 'Tharu tech', 'azam.personal247@gmail.com', '0776790257', '0112719350', '931080172V', 'Colombo 6', 'active'),
('EMP1022', 'Front Desk Officer', 'Kamal Front Desk', 'azam4636@gmail.com', '0776790257', '0112719360', '931080147V', 'Colombo 78', 'active'),
('EMP1023', 'Technician', 'Upali Tech', 'azam4636@gmail.com', '0776790257', '0112718241', '931080172V', 'colombo 12', 'active'),
('EMP1024', 'Technician', 'imal Tech', 'azam4636@gmail.com', '0776790257', '0112719390', '931025874V', 'Colombo', 'active'),
('EMP1025', 'Technician', 'Tiran Tech', 'azam4636@gmail.com', '0776790257', '011245874', '931080172V', 'Colom o1', 'active'),
('EMP1026', 'Front Desk Officer', 'Uvin Tech', 'azam4636@gmail.com', '0776790257', '0112719350', '931020147V', 'Col 3', 'active'),
('EMP1027', 'Technician', 'Uvin', 'azam4636@gmail.com', '0776790257', '0112719350', '931080172V', 'Col 12', 'active'),
('EMP1028', 'Technician', 'Uvin', 'azam4636@gmail.com', '0776790257', '0112719350', '931080172V', 'Col 12', 'active'),
('EMP1029', 'Technician', 'Namal', ' azam4636@gmail.com', '0776790257', '0112719390', '931080172V', 'Colo 12', 'active'),
('EMP1030', 'Technician', 'tech tech', 'azam.personal247@gmail.com', '0776790257', '0112719390', '931080172V', 'Colombo 12', 'active'),
('EMP1031', 'Store Keeper', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', 'azam4636@gmail.com', '0776790257', '0112719390', '931245632V', 'University of Kalaniya\r\nNational Education Commission,', 'active'),
('EMP1032', 'Store Keeper', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', 'azam4636@gmail.com', '0776790257', '0112719390', '931080127v', 'University of Kalaniya\r\nNational Education Commission,', 'active'),
('EMP1033', 'Technician', 'gggg', 'azam.personal247@gmail.com', '0776790257', '0112719390', '931080172V', 'Colombo 03', 'active'),
('EMP1034', 'Store Keeper', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', 'azam4636@gmail.com', '0776790257', '0112719390', '901080172V', 'University of Kalaniya\r\nNational Education Commission,', 'active'),
('EMP1035', 'Store Keeper', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', 'azam4636@gmail.com', '0776790257', '0112719390', '901080172V', 'University of Kalaniya\r\nNational Education Commission,', 'active'),
('EMP1036', 'Store Keeper', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', 'azam4636@gmail.com', '0776790257', '0112719390', '901080172V', 'University of Kalaniya\r\nNational Education Commission,', 'active'),
('EMP1037', 'Store Keeper', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', 'azam4636@gmail.com', '0776790257', '0112719390', '901080172V', 'University of Kalaniya\r\nNational Education Commission,', 'active'),
('EMP1038', 'Front Desk Officer', 'Mohomed Azam', 'azam4636@gmail.com', '0776790257', '0776790257', '931080172V', 'No 42, Pepiliyana Road,\r\nNedimala', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `fdo_m_tbl`
--

CREATE TABLE IF NOT EXISTS `fdo_m_tbl` (
  `emp_id` varchar(100) NOT NULL,
  `fdo_id` varchar(10) NOT NULL,
  `fdo_name` varchar(20) NOT NULL,
  `fdo_contact` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`fdo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fdo_m_tbl`
--

INSERT INTO `fdo_m_tbl` (`emp_id`, `fdo_id`, `fdo_name`, `fdo_contact`, `status`) VALUES
('', 'FDO101', 'Eranthi Anurudhika', '0710215353', 'active'),
('', 'FDO102', 'Sajini Menaka', '0778595100', 'active'),
('', 'FDO103', 'Sachini Ishara', '0712859640', 'active'),
('', 'FDO104', 'Shyama Pathiranage', '0785695409', 'deactive'),
('EMP1022', 'FDO105', 'Kamal Front Desk', '0776790257', '1'),
('EMP1026', 'FDO106', 'Uvin Tech', '0776790257', '1'),
('EMP1038', 'FDO107', 'Mohomed Azam', '0776790257', '1');

-- --------------------------------------------------------

--
-- Table structure for table `id_numbers_m_tbl`
--

CREATE TABLE IF NOT EXISTS `id_numbers_m_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` varchar(100) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `id_numbers_m_tbl`
--

INSERT INTO `id_numbers_m_tbl` (`id`, `id_type`, `id_number`) VALUES
(1, 'Customer', 'CUS1017'),
(2, 'Supplier', 'SUP1011'),
(3, 'Employee', 'EMP1038'),
(4, 'Job', '35011'),
(5, 'Supplier_Purchase', 'PUR1054'),
(6, 'Warranty_Card', 'WAR1000'),
(7, 'RMA', 'R1000'),
(8, 'Front_Desk_Officer', 'FDO107'),
(9, 'Technician', 'TEC216'),
(10, 'Store Manager', 'STMGR406'),
(11, 'Service Manager', 'SERMGR500'),
(12, 'Imports Manager', 'IMPMGR600'),
(13, 'Part Ref Code', 'P_10024');

-- --------------------------------------------------------

--
-- Table structure for table `imports_m_table`
--

CREATE TABLE IF NOT EXISTS `imports_m_table` (
  `emp_id` varchar(100) NOT NULL,
  `ima_id` varchar(10) NOT NULL,
  `ima_name` varchar(20) NOT NULL,
  `ima_contact` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`ima_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_product_m_tbl`
--

CREATE TABLE IF NOT EXISTS `item_product_m_tbl` (
  `item_product_m_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`item_product_m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `item_product_m_tbl`
--

INSERT INTO `item_product_m_tbl` (`item_product_m_id`, `category`, `brand`, `model`, `status`) VALUES
(1, 'Projectors', 'Infocus', 'IN 104', 'active'),
(2, 'Amplifiers', 'Panasonic', 'AM679', 'deactive'),
(3, 'Projectors', 'Inter-M', 'IN 116', 'deactive'),
(4, 'Projectors', 'Infocus', 'IN 116x', 'active'),
(5, 'Projectors', 'Infocus', 'IN 2112', 'active'),
(6, 'Projectors', 'Infocus', 'IN 106', 'active'),
(7, 'Projectors', 'Panasonic', 'KHJ-02', 'active'),
(8, 'Projectors', 'Panasonic', 'LOY-678', 'active'),
(9, 'Microphones', 'Sure', 'IYT445', 'active'),
(10, 'Microphones', 'Sure', 'SM-879', 'active'),
(11, 'Amplifiers', 'Inter-M', 'PA-180', 'active'),
(12, 'Conference', 'Polycom', 'VS-1000', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `job_backup_tbl`
--

CREATE TABLE IF NOT EXISTS `job_backup_tbl` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` varchar(5) NOT NULL,
  `customer_id` varchar(5) NOT NULL,
  `backup_serial_no` varchar(20) NOT NULL,
  `backup_make` varchar(10) NOT NULL,
  `backup_model` varchar(10) NOT NULL,
  `accessories` text NOT NULL,
  `backup_issue_date` date NOT NULL,
  `backup_receive_date` date NOT NULL,
  `backup_defect_status` varchar(100) NOT NULL,
  `backup_defect_desc` varchar(200) NOT NULL,
  `manager_status` varchar(200) NOT NULL,
  `backup_final_cost` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`backup_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_estimate_tbl`
--

CREATE TABLE IF NOT EXISTS `job_estimate_tbl` (
  `job_estimate_id` varchar(5) NOT NULL,
  `job_id` varchar(5) NOT NULL,
  `customer_id` varchar(5) NOT NULL,
  `make` varchar(10) NOT NULL,
  `model` varchar(10) NOT NULL,
  `serial_no` varchar(20) NOT NULL,
  `estimate_desc` text NOT NULL,
  `est_inspect_fee` varchar(50) NOT NULL,
  `repair_cost` varchar(50) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `est_send_date` date NOT NULL,
  `est_expire_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`job_estimate_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `job_progress_tbl`
--

CREATE TABLE IF NOT EXISTS `job_progress_tbl` (
  `job_progress_id` int(11) NOT NULL,
  `job_id` varchar(5) NOT NULL,
  `progress_status` varchar(50) NOT NULL,
  PRIMARY KEY (`job_progress_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `job_repair_info_tbl`
--

CREATE TABLE IF NOT EXISTS `job_repair_info_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` varchar(100) NOT NULL,
  `tech_id` varchar(100) NOT NULL,
  `store_manager_id` varchar(100) NOT NULL,
  `service_manager_id` varchar(100) NOT NULL,
  `imports_manager_id` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  `assigned_date` date NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `warranty_type` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `problem_description` text NOT NULL,
  `actual_defect` text NOT NULL,
  `solution` text NOT NULL,
  `part_ref_code` varchar(100) NOT NULL,
  `part_no` varchar(100) NOT NULL,
  `part_description` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  `out_of_stock_status` varchar(100) NOT NULL,
  `status1` varchar(100) NOT NULL,
  `status2` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `job_repair_info_tbl`
--

INSERT INTO `job_repair_info_tbl` (`id`, `job_id`, `tech_id`, `store_manager_id`, `service_manager_id`, `imports_manager_id`, `created_date`, `assigned_date`, `customer_id`, `warranty_type`, `category`, `make`, `model`, `serial_no`, `problem_description`, `actual_defect`, `solution`, `part_ref_code`, `part_no`, `part_description`, `qty`, `remarks`, `out_of_stock_status`, `status1`, `status2`) VALUES
(46, '35011', 'TEC201', '', '', '', '2018-07-31', '2018-07-31', 'CUS1001', 'Supplier Warranty', 'Projectors', 'Infocus', 'S444', '2862518412789', 'power off', 'power cut off', 'replace the fuse', 'P_10006', '10A FUSE', '10A FUSE SMALL', '2', 'NA', '0', '0', '0'),
(47, '35011', 'TEC201', '', '', '', '2018-07-31', '2018-07-31', 'CUS1001', 'Supplier Warranty', 'Projectors', 'Infocus', 'S444', '2862518412789', 'power off', 'lamp cut off', 'replace the lamp', 'P_10020', 'SP-LP-085', 'Lamp for IN8606HD', '1', 'NA', '0', '0', '0'),
(48, '35011', 'TEC201', '', '', '', '2018-07-31', '2018-07-31', 'CUS1001', 'Supplier Warranty', 'Projectors', 'Infocus', 'S444', '2862518412789', 'power off', 'cpu ', 'replace the resistor', 'P_10010', '2.2K1/4W', '2.2K 1/4W RESISTOR', '3', 'sony resistor', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `parts_inventory_m_tbl`
--

CREATE TABLE IF NOT EXISTS `parts_inventory_m_tbl` (
  `part_ref_code` varchar(100) NOT NULL,
  `part_no` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `min_qty` int(10) NOT NULL,
  `store_qty` int(10) NOT NULL,
  `category` varchar(100) NOT NULL,
  `average_cost_price` varchar(100) NOT NULL,
  `closing_stock_value` double(20,2) NOT NULL,
  `bin_no` varchar(100) NOT NULL,
  `dm` varchar(100) NOT NULL,
  `gp` varchar(100) NOT NULL,
  `ro` varchar(100) NOT NULL,
  `store_status` varchar(100) NOT NULL,
  PRIMARY KEY (`part_ref_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts_inventory_m_tbl`
--

INSERT INTO `parts_inventory_m_tbl` (`part_ref_code`, `part_no`, `description`, `min_qty`, `store_qty`, `category`, `average_cost_price`, `closing_stock_value`, `bin_no`, `dm`, `gp`, `ro`, `store_status`) VALUES
('P_10001', '0.5A FUSE', '0.5A FUSE', 5, 5, '5', '2.00', 14.00, 'BOX-01-22', '', '', '', 'Available'),
('P_10002', '1.25A/FUSE', '1.25A FUSE', 6, 6, '6', '2.00', 20.00, 'BOX-01-B', '', '', '', 'Available'),
('P_10003', '1.6A FUSE', '1.6A FUSE', 7, 7, '7', '2.00', 16.00, 'BOX-02-24', '', '', '', 'Available'),
('P_10004', '100maf', '100ma FUSE', 3, 3, '3', '2.00', 20.00, 'BOX-01-A', '', '', '', 'Available'),
('P_10005', '10A FUSE', '10A FUSE LARGE', 4, 4, '4', '7.22', 260.00, 'BOX-01-23', '', '', '', 'Available'),
('P_10006', '10A FUSE', '10A FUSE SMALL', 2, 2, '2', '5.00', 40.00, 'BOX-01-21', '', '', '', 'Available'),
('P_10007', '13A FUSE', '13A FUSE', 6, 6, '6', '20.00', 160.00, 'BOX-01-20', '', '', '', 'Available'),
('P_10008', '15A FUSE', '15A FUSE', 1, 1, '1', '1.75', 24.50, 'BOX-02-23', '', '', '', 'Available'),
('P_10009', '1AFUSE', '1 AMP FUSE', 2, 2, '2', '5.02', 261.00, 'BOX-02-23', '', '', '', 'Available'),
('P_10010', '2.2K1/4W', '2.2K 1/4W RESISTOR', 3, 3, '3', '0.20', 1.80, 'BOX-01-A', '', '', '', 'Available'),
('P_10011', '0-09-1002', 'POT 1KB DUAL CONTROL', 4, 4, '4', '0.00', 0.00, 'BOX-10', '', '', '', 'Available'),
('P_10012', '00D9410059202', 'ROTARY VR-50K DNX-1100', 2, 2, '2', '200.00', 1000.00, 'BOX-03', '', '', '', 'Available'),
('P_10013', '00D9410059309', 'ROTARY VR-50K DNX-1100', 3, 3, '3', '258.28', 6457.00, 'BOX-10', '', '', '', 'Available'),
('P_10014', '00D9410059707', 'ROTARY VR-20K DNX-1100', 5, 5, '5', '0.00', 0.00, 'BOX-04', '', '', '', 'Available'),
('P_10015', '22503500110', 'S ROT/VR 50KB', 1, 1, '1', '98.29', 1867.51, 'BOX-04', '', '', '', 'Available'),
('P_10016', '27103260100', 'D.SLIDE/VR10KA', 5, 5, '5', '127.56', 10077.24, 'BOX-06', '', '', '', 'Available'),
('P_10017', 'SP-LP-078', 'Lamp for IN3124/26/28HD', 6, 6, '6', '0.00', 0.00, 'BOX-F', '', '', '', 'Available'),
('P_10018', 'SP-LP-083', 'Lamp for IN122ST/124ST/126S', 2, 2, '2', '19478.88', 38957.76, 'BOX-E', '', '', '', 'Available'),
('P_10019', 'SP-LP-084', 'Lamp for IN134UST/IN136UST', 3, 3, '3', '30911.35', 92734.05, 'BOX-D', '', '', '', 'Available'),
('P_10020', 'SP-LP-085', 'Lamp for IN8606HD', 5, 5, '5', '32625.66', 32625.66, 'BOX-C', '', '', '', 'Available'),
('P_10021', 'SP-LP-086', 'Lamp for IN 112a/114a/114st', 6, 6, '6', '35815.77', 71631.54, 'BOX-G', '', '', '', 'Available'),
('P_10022', 'SP-LP-087', 'Lamp for IN12xa/12xSTa/212xa', 4, 4, '4', '0.00', 0.00, 'BOX-G', '', '', '', 'Available'),
('P_10023', 'SP-LP-090', 'Lamp for IN5312a/IN5316HDa', 6, 6, '6', '71811.51', 71811.51, 'BOX-C', '', '', '', 'Available'),
('P_10024', 'SP-LP-093', 'Lamp for IN110x/IN110HDx', 4, 4, '4', '0.00', 0.00, 'BOX-A', '', '', '', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `rma_defect_tbl`
--

CREATE TABLE IF NOT EXISTS `rma_defect_tbl` (
  `rma_defect_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` varchar(5) NOT NULL,
  `rma_no` varchar(10) NOT NULL,
  `customer_id` varchar(5) NOT NULL,
  `serial_no` varchar(20) NOT NULL,
  `part_no` varchar(30) NOT NULL,
  `item_desc` varchar(100) NOT NULL,
  `sales_order_no` varchar(10) NOT NULL,
  `rma_defect_part_status` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `sent_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`rma_defect_id`),
  KEY `rma_no` (`rma_no`),
  KEY `serial_no` (`serial_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rma_tbl`
--

CREATE TABLE IF NOT EXISTS `rma_tbl` (
  `rma_id` int(11) NOT NULL AUTO_INCREMENT,
  `rma_no` varchar(10) NOT NULL,
  `job_id` varchar(5) NOT NULL,
  `customer_id` varchar(5) NOT NULL,
  `serial_no` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `part_no` varchar(30) NOT NULL,
  `primary_symptom` varchar(100) NOT NULL,
  `sales_order_no` varchar(10) NOT NULL,
  `pop_date` varchar(100) NOT NULL,
  `rma_status` varchar(50) NOT NULL,
  `rma_send_date` date NOT NULL,
  `rma_receive_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`rma_id`),
  KEY `rma_no` (`rma_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_manager_m_table`
--

CREATE TABLE IF NOT EXISTS `service_manager_m_table` (
  `emp_id` varchar(100) NOT NULL,
  `mgr_id` varchar(10) NOT NULL,
  `mgr_name` varchar(20) NOT NULL,
  `mgr_contact` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`mgr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_manager_m_tbl`
--

CREATE TABLE IF NOT EXISTS `store_manager_m_tbl` (
  `emp_id` varchar(100) NOT NULL,
  `store_manager_id` varchar(100) NOT NULL,
  `store_manager_name` varchar(100) NOT NULL,
  `store_manager_contact` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`store_manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_manager_m_tbl`
--

INSERT INTO `store_manager_m_tbl` (`emp_id`, `store_manager_id`, `store_manager_name`, `store_manager_contact`, `status`) VALUES
('EMP1003', 'STMGR401', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', '0776790257', '1'),
('EMP1032', 'STMGR402', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', '0776790257', '1'),
('EMP1034', 'STMGR403', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', '0776790257', '1'),
('EMP1035', 'STMGR404', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', '0776790257', '1'),
('EMP1036', 'STMGR405', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', '0776790257', '1'),
('EMP1037', 'STMGR406', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', '0776790257', '1');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_product_sno_m_tbl`
--

CREATE TABLE IF NOT EXISTS `supplier_product_sno_m_tbl` (
  `supp_product_sno_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_no` varchar(10) NOT NULL,
  `serial_no` varchar(20) NOT NULL,
  `category` varchar(100) NOT NULL,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`supp_product_sno_id`),
  KEY `sales_order_no` (`sales_order_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `supplier_product_sno_m_tbl`
--

INSERT INTO `supplier_product_sno_m_tbl` (`supp_product_sno_id`, `sales_order_no`, `serial_no`, `category`, `make`, `model`, `status`) VALUES
(39, 'TL7429', '1663264518814', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(40, 'TL7429', '1533936356361', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(41, 'TL7429', '1594435233777', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(42, 'TL7429', '1421615255123', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(43, 'TL7429', '2182992873181', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(44, 'TL7429', '1687295374735', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(45, 'TL7429', '1838811295692', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(46, 'TL7429', '2125549319795', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(47, 'TL7429', '1988136117559', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(48, 'TL7429', '1686258172973', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(49, 'YC4204', '1913697878929', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(50, 'YC4204', '1727382481433', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(51, 'YC4204', '1991754779732', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(52, 'YC4204', '1686258172973', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(53, 'YC4204', '1838688964697', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(54, 'YC4204', '1977947644276', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(55, 'YC4204', '2862518412789', 'Projectors', 'Infocus', 'S444', 'Verified'),
(56, 'YC4204', '2753479253247', 'Projectors', 'Infocus', 'S444', 'Verified'),
(57, 'YC4204', '2777147731943', 'Projectors', 'Infocus', 'S444', 'Verified'),
(58, 'YC4204', '2727437629935', 'Projectors', 'Infocus', 'S444', 'Verified'),
(59, 'YC4204', '2726815876864', 'Projectors', 'Infocus', 'S444', 'Verified'),
(60, 'YC4204', '2817713773587', 'Projectors', 'Infocus', 'S444', 'Verified'),
(61, 'YC4204', '2681454167568', 'Projectors', 'Infocus', 'S444', 'Verified'),
(62, 'YC4204', '2631711628179', 'Projectors', 'Infocus', 'S444', 'Verified'),
(63, 'YC4204', '2742815237497', 'Projectors', 'Infocus', 'S444', 'Verified'),
(64, 'YC4204', '2725954893192', 'Projectors', 'Infocus', 'S444', 'Verified'),
(65, 'YC4204', '2716368539418', 'Projectors', 'Infocus', 'S444', 'Verified'),
(66, 'YC4204', '2665927699273', 'Projectors', 'Infocus', 'S444', 'Verified'),
(67, 'YC4204', '2476644748416', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(68, 'YC4204', '2558259396928', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(69, 'YC4204', '2523634677632', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(70, 'YC4204', '2465478966227', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(71, 'YC4204', '2238379395372', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(72, 'YC4204', '2349669917862', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(73, 'YC4204', '2492136673991', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(74, 'FM9243', '3676993527251', 'Microphones', 'Polycom', 'PJ50', 'Verified'),
(75, 'FM9243', '3641593518275', 'Microphones', 'Polycom', 'PJ50', 'Verified'),
(76, 'FM9243', '3696648158963', 'Microphones', 'Polycom', 'PJ50', 'Verified'),
(77, 'FM9243', '3444556942662', 'Microphones', 'Polycom', 'MRC63', 'Verified'),
(78, 'FM9243', '3549526871898', 'Microphones', 'Polycom', 'MRC63', 'Verified'),
(79, 'FM9243', '3482697835476', 'Microphones', 'Polycom', 'MRC63', 'Verified'),
(80, 'FM9243', '3624978818194', 'Microphones', 'Polycom', 'MRC63', 'Verified'),
(81, 'FM9243', '3539714151438', 'Microphones', 'Polycom', 'MRC63', 'Verified'),
(82, 'FM9243', '3551478324789', 'Microphones', 'Polycom', 'MRC63', 'Verified'),
(83, 'LF1643', '3342894876693', 'Amplifiers', 'Polycom', 'RX360', 'Verified'),
(84, 'LF1643', '3231382823937', 'Amplifiers', 'Polycom', 'RX360', 'Verified'),
(85, 'LF1643', '3257195518389', 'Amplifiers', 'Polycom', 'RX360', 'Verified'),
(86, 'LF1643', '3441519172844', 'Amplifiers', 'Polycom', 'RX360', 'Verified'),
(87, 'LF1643', '3383713512291', 'Amplifiers', 'Polycom', 'RX360', 'Verified'),
(88, 'LF1643', '3424443712263', 'Amplifiers', 'Polycom', 'RX360', 'Verified'),
(89, 'AL4830', '2866186176147', 'Conference', 'Polycom', 'PTL333', 'Verified'),
(90, 'AL4830', '2993568837115', 'Conference', 'Polycom', 'PTL333', 'Verified'),
(91, 'AL4830', '2913921748884', 'Conference', 'Polycom', 'PTL333', 'Verified'),
(92, 'AL4830', '3144822699895', 'Conference', 'Polycom', 'PTL333', 'Verified'),
(93, 'AL4830', '3182184525316', 'Conference', 'Polycom', 'PTL333', 'Verified'),
(94, 'AL4830', '2954593685859', 'Conference', 'Polycom', 'PTL333', 'Verified'),
(95, 'AL4830', '3166592719145', 'Conference', 'Polycom', 'PTL333', 'Verified'),
(96, 'AL4830', '2979927964689', 'Conference', 'Polycom', 'PTL333', 'Verified'),
(97, 'AL4830', '3199157456249', 'Conference', 'Polycom', 'PTL333', 'Verified'),
(98, 'BG9281', '2225274992655', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(99, 'BG9281', '2322357789777', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(100, 'BG9281', '2626894332847', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(101, 'BG9281', '2627712157263', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(102, 'BG9281', '2565617596315', 'Projectors', 'Panasonic', 'DK256', 'Verified'),
(103, 'BG9281', '1123962891225', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(104, 'BG9281', '1178775992726', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(105, 'BG9281', '1146842779527', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(106, 'BG9281', '1237346318893', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(107, 'BG9281', '1212274248724', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(108, 'BG9281', '1263196231451', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(109, 'BG9281', '1371461883279', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(110, 'BG9281', '1293446445128', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(111, 'BG9281', '1285582547182', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(112, 'BG9281', '1369392972715', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(113, 'BG9281', '1412313826331', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(114, 'BG9281', '1296884468213', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(115, 'BG9281', '1566649283596', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(116, 'BG9281', '1677115773153', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(117, 'BG9281', '1437352519494', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(118, 'BG9281', '1661298689292', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(119, 'BG9281', '1683863295525', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(120, 'BG9281', '1581734627385', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(121, 'BG9281', '1662961228295', 'Projectors', 'Panasonic', 'PA128', 'Verified'),
(122, 'BG9281', '1468143233544', 'Projectors', 'Panasonic', 'PA128', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_purchase_m_tbl`
--

CREATE TABLE IF NOT EXISTS `supplier_purchase_m_tbl` (
  `supplier_purchase_id` varchar(100) NOT NULL,
  `supp_id` varchar(100) NOT NULL,
  `sales_order_no` varchar(100) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_year` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `entered_qty` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `warranty_applicability` varchar(50) NOT NULL,
  `supplier_warranty_start` date NOT NULL,
  `supplier_warranty_end` date NOT NULL,
  `warranty_years` varchar(50) NOT NULL,
  `warranty_years_text` varchar(50) NOT NULL,
  `company_warranty_applicability` varchar(100) NOT NULL,
  `company_warranty_years` varchar(100) NOT NULL,
  `company_warranty_years_text` varchar(100) NOT NULL,
  `document_name` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`supplier_purchase_id`),
  KEY `sales_order_no` (`sales_order_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_purchase_m_tbl`
--

INSERT INTO `supplier_purchase_m_tbl` (`supplier_purchase_id`, `supp_id`, `sales_order_no`, `sales_date`, `sales_year`, `category`, `make`, `model`, `entered_qty`, `qty`, `warranty_applicability`, `supplier_warranty_start`, `supplier_warranty_end`, `warranty_years`, `warranty_years_text`, `company_warranty_applicability`, `company_warranty_years`, `company_warranty_years_text`, `document_name`, `status`) VALUES
('PUR1045', 'SUP1001', 'TL7429', '2017-12-14', '2017', 'Projectors', 'Panasonic', 'PA128', 10, 10, 'yes', '2017-12-14', '2019-12-14', '24', '2 Years', 'no', 'N/A', 'N/A', 'TL7429.pdf', 'active'),
('PUR1046', 'SUP1002', 'YC4204', '2016-08-25', '2016', 'Projectors', 'Panasonic', 'PA128', 6, 6, 'yes', '2016-08-25', '2018-08-25', '24', '2 Years', 'yes', '12', '1 Year', 'YC4204.pdf', 'active'),
('PUR1047', 'SUP1002', 'YC4204', '2016-08-25', '2016', 'Projectors', 'Infocus', 'S444', 12, 12, 'yes', '2016-08-25', '2019-08-25', '36', '3 Years', 'no', 'N/A', 'N/A', 'YC4204.pdf', 'active'),
('PUR1048', 'SUP1002', 'YC4204', '2016-08-25', '2016', 'Projectors', 'Panasonic', 'DK256', 7, 7, 'yes', '2016-08-25', '2017-08-25', '12', '1 Year', 'no', 'N/A', 'N/A', 'YC4204.pdf', 'active'),
('PUR1049', 'SUP1004', 'FM9243', '2017-04-17', '2017', 'Microphones', 'Polycom', 'PJ50', 3, 3, 'no', '0000-00-00', '0000-00-00', 'N/A', 'N/A', 'no', 'N/A', 'N/A', 'FM9243.pdf', 'active'),
('PUR1050', 'SUP1004', 'FM9243', '2017-04-17', '2017', 'Microphones', 'Polycom', 'MRC63', 6, 6, 'yes', '2017-04-17', '2019-04-17', '24', '2 Years', 'no', 'N/A', 'N/A', 'FM9243.pdf', 'active'),
('PUR1051', 'SUP1003', 'LF1643', '2017-03-18', '2017', 'Amplifiers', 'Polycom', 'RX360', 6, 6, 'yes', '2017-03-18', '2020-03-18', '36', '3 Years', 'yes', '12', '1 Year', 'LF1643.pdf', 'active'),
('PUR1052', 'SUP1008', 'AL4830', '2015-04-10', '2015', 'Conference', 'Polycom', 'PTL333', 9, 9, 'yes', '2015-04-10', '2016-04-10', '12', '1 Year', 'yes', '6', '6 Months', 'AL4830.pdf', 'active'),
('PUR1053', 'SUP1011', 'BG9281', '2017-09-21', '2017', 'Projectors', 'Panasonic', 'DK256', 5, 5, 'yes', '2017-09-21', '2019-09-21', '24', '2 Years', 'no', 'N/A', 'N/A', 'BG9281.pdf', 'active'),
('PUR1054', 'SUP1011', 'BG9281', '2017-09-21', '2017', 'Projectors', 'Panasonic', 'PA128', 20, 20, 'yes', '2017-09-21', '2019-09-21', '24', '2 Years', 'yes', '12', '1 Year', 'BG9281.pdf', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `supp_details_m_tbl`
--

CREATE TABLE IF NOT EXISTS `supp_details_m_tbl` (
  `supp_id` varchar(100) NOT NULL,
  `supp_name` varchar(100) NOT NULL,
  `supp_address` varchar(100) NOT NULL,
  `sup_contact` varchar(20) NOT NULL,
  `sup_email` varchar(50) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`supp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supp_details_m_tbl`
--

INSERT INTO `supp_details_m_tbl` (`supp_id`, `supp_name`, `supp_address`, `sup_contact`, `sup_email`, `fax`, `category`, `brand`, `status`) VALUES
('SUP1001', 'Timothy Leong', 'Infocus Corporation,115 Smoke Hill LaneWoodstock, GA 30188, Porland                                 ', '+6978322693', 'thimothy@infocus.lk', '+6978322693', 'Projectors', 'Panasonic', 'active'),
('SUP1002', 'Yon Chi', 'Panasonic Corporation,1006, Oaza Kadoma, Kadoma-shi, Osaka 571-8501, Japan.                         ', '+81669081121', 'yonc@panasonic.lk', '+81669081122', 'Projectors', 'Panasonic', 'active'),
('SUP1003', 'Lee Fione', 'Inter-M Corp,5666 Corporate Ave. Cypress, CA 90630, USA.                                            ', '7148282200', 'info@inter-m.net', '7148282210', 'Amplifiers', 'Inter-M', 'active'),
('SUP1004', 'Frodsen Macgrill', 'Shure Asia Limited,22/F, 625 King''s Road\r\nNorth Point, Island East,Hong Kong                        ', '+85228934290', 'frodmac@shure.com.hk', '+85228934291', 'Microphones', 'Sure', 'active'),
('SUP1005', 'Barnabas Balthazar', 'Kramer Electronics Ltd,3 Am Veolamo st. Jerusalem, 9546303.                                         ', '+972732650200 ', 'barnabasb@kramerav.com', '+97226535369', 'Electronics', 'Kramer', 'active'),
('SUP1006', 'Caleb Iris', 'Zoom Corporation,4-4-3 Kanda-surugadai, Chiyoda-ku,\r\nTokyo 101-0062, Japan                          ', '+8135297040', 'calebi@zoom.co.jp', '+81352971009', 'Speakers', 'Zoom', 'active'),
('SUP1007', 'Hartley Peavey', 'Peavey Electronics,Meridian, Mississippi, United States.                                            ', '+8777328391', 'hartley@peavey.com', '+8777328392', 'Mixers', 'Peavey', 'active'),
('SUP1008', 'Audrey LeMercier ', 'Polycom Corporation,San Jose, California                                            ', '+18667085034', 'audrey@polycom.lk', '+18667085036', 'Conference', 'Polycom', 'active'),
('SUP1009', 'Tatami Yu', 'Lite-Puter Corporation,Neihu Dist,Taipei City, 11494, Taiwan.                                       ', ' +886227998099', 'tatami@liteputer.lk', '+886227993828', 'Electronics', 'Lite-Puter', 'active'),
('SUP1010', 'Rakesh Kannah', 'Hi-Tone Inc,Mumbai, India.                                                ', '+91812344980', 'rakesh@hitone.lk', '+91812344980', 'Speakers', 'Hi-Tone', 'active'),
('SUP1011', 'Bekam Gilbert', 'InFocus Asia-Pacific, China                                           ', '008695583', 'bekam@infocus.lk', '008695583', 'Projectors', 'Infocus', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `technician_m_tbl`
--

CREATE TABLE IF NOT EXISTS `technician_m_tbl` (
  `emp_id` varchar(100) NOT NULL,
  `tech_id` varchar(100) NOT NULL,
  `tech_name` varchar(100) NOT NULL,
  `tech_contact` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`tech_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `technician_m_tbl`
--

INSERT INTO `technician_m_tbl` (`emp_id`, `tech_id`, `tech_name`, `tech_contact`, `status`) VALUES
('EMP1002', 'TEC201', 'Kamal Tech', '0776790257', '1'),
('EMP1016', 'TEC202', 'Namal Tech', '0776790257', '1'),
('EMP1017', 'TEC203', 'Sunimal Tech', '0776790257', '1'),
('EMP1018', 'TEC204', 'Nimala Tech', '0776790257', '1'),
('EMP1019', 'TEC205', 'Upul Tech', '0776790257', '1'),
('EMP1020', 'TEC206', 'Tharindu Tech', '0776790257', '1'),
('EMP1021', 'TEC207', 'Tharu tech', '0776790257', '1'),
('EMP1023', 'TEC208', 'Upali Tech', '0776790257', '1'),
('EMP1024', 'TEC209', 'imal Tech', '0776790257', '1'),
('EMP1025', 'TEC210', 'Tiran Tech', '0776790257', '1'),
('EMP1025', 'TEC211', 'Tiran Tech', '0776790257', '1'),
('EMP1027', 'TEC212', 'Uvin', '0776790257', '1'),
('EMP1028', 'TEC213', 'Uvin', '0776790257', '1'),
('EMP1029', 'TEC214', 'Namal', '0776790257', '1'),
('EMP1030', 'TEC215', 'tech tech', '0776790257', '1'),
('EMP1033', 'TEC216', 'gggg', '0776790257', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_level_m_tbl`
--

CREATE TABLE IF NOT EXISTS `user_level_m_tbl` (
  `user_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) NOT NULL,
  `user_role_name` varchar(30) NOT NULL,
  `user_serial_id` varchar(30) NOT NULL,
  PRIMARY KEY (`user_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_level_m_tbl`
--

INSERT INTO `user_level_m_tbl` (`user_level_id`, `user_role_id`, `user_role_name`, `user_serial_id`) VALUES
(1, 1, 'admin', '1'),
(2, 2, 'import_officer', '2'),
(3, 3, 'service_manager', '3'),
(4, 4, 'technician ', '4'),
(5, 5, 'store_manager', '5'),
(6, 6, 'front_desk_officer', '6'),
(7, 7, 'customer', '7');

-- --------------------------------------------------------

--
-- Table structure for table `user_login_m_tbl`
--

CREATE TABLE IF NOT EXISTS `user_login_m_tbl` (
  `user_id` varchar(100) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `temp_password` varchar(100) NOT NULL,
  `login_attempt` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_login_m_tbl`
--

INSERT INTO `user_login_m_tbl` (`user_id`, `user_role_id`, `username`, `password`, `temp_password`, `login_attempt`, `status`) VALUES
('CUS1001', 7, 'kamal@linkproducts.lk', 'cbb7de78af0ae6d5845bdf9b58cb0d0f4900f418', '', '0', '1'),
('EMP0000', 1, 'admin@abc.com', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', '', '0', '1'),
('EMP1001', 6, 'desk1@abc.com', 'afd80538b1f1f8bdc08111bef0c05add4cf5f4a0', '', '0', '1'),
('EMP1002', 4, 'tech1@abc.com', '40807e40aa0602559be12b1ee786e225d17a8dd6', '', '0', '1'),
('EMP1003', 5, 'store1@abc.com', 'ccd9109b85b80b7b4f42bb74607a025ad0e2e2f0', '', '0', '1'),
('EMP1004', 3, 'sermagt1@abc.com', 'e34d623413384654b3dad4c685b018283a23fcb7', '', '0', '1'),
('EMP1005', 2, 'import1@abc.com', '2554d45d61c0b4be4e67bcd58f43ca1cee927109', '', '0', '1'),
('FDO105', 6, 'azam4636@gmail.com', 'a1d5f51a59da06db7d055d86ffcb607bba53a52a', 'aaaaa', '0', '1'),
('FDO106', 6, 'azam4636@gmail.com', 'FiuGlYMq', 'aaaaa', '1', '1'),
('FDO107', 6, 'azam4636@gmail.com', 'mkrhMqxV', 'aaaaa', '1', '1'),
('STMGR401', 5, 'azam4636@gmail.com', 'flwoFhjg', 'aaaaa', '1', '1'),
('STMGR402', 5, 'azam4636@gmail.com', 'UykgJoYd', 'aaaaa', '1', '1'),
('STMGR403', 5, 'azam4636@gmail.com', 'SgnLKQFS', 'aaaaa', '1', '1'),
('STMGR404', 5, 'azam4636@gmail.com', 'fUifzTkL', 'aaaaa', '1', '1'),
('STMGR405', 5, 'azam4636@gmail.com', 'HMksxEOo', 'aaaaa', '1', '1'),
('STMGR406', 5, 'azam4636@gmail.com', 'nihvvVPR', 'aaaaa', '1', '1'),
('TEC201', 4, 'azam4636@gmail.com', 'fqkNTEgx', 'aaaaa', '1', '1'),
('TEC202', 4, 'azam4636@gmail.com', 'xZCPOQcA', 'aaaaa', '1', '1'),
('TEC203', 4, 'azam4636@gmail.com', 'uiszysEm', 'aaaaa', '1', '1'),
('TEC204', 4, 'azam4636@gmail.com', 'ZEwJgHEU', 'aaaaa', '1', '1'),
('TEC205', 4, 'azam4636@gmail.com', 'IFxASrYj', 'aaaaa', '1', '1'),
('TEC206', 4, 'azam.personal247@gmail.com', 'sdmoKGio', 'aaaaa', '1', '1'),
('TEC207', 4, 'azam.personal247@gmail.com', 'SOTMBRIH', 'aaaaa', '1', '1'),
('TEC208', 4, 'azam4636@gmail.com', 'aglSxKek', 'aaaaa', '1', '1'),
('TEC209', 4, 'azam4636@gmail.com', 'jYxCPrqE', 'aaaaa', '1', '1'),
('TEC210', 4, 'azam4636@gmail.com', 'IPKepMDq', 'aaaaa', '1', '1'),
('TEC211', 4, 'azam4636@gmail.com', 'eNHeIJRv', 'aaaaa', '1', '1'),
('TEC212', 4, 'azam4636@gmail.com', 'aBWTeEgM', 'aaaaa', '1', '1'),
('TEC213', 4, 'azam4636@gmail.com', 'gQTwvQlE', 'aaaaa', '1', '1'),
('TEC214', 4, ' azam4636@gmail.com', 'FviDLhnG', 'aaaaa', '1', '1'),
('TEC215', 4, 'azam.personal247@gmail.com', 'eEwGLUcF', 'aaaaa', '1', '1'),
('TEC216', 4, 'azam.personal247@gmail.com', 'pvIXQzxa', 'aaaaa', '1', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `backup_inventory_tbl`
--
ALTER TABLE `backup_inventory_tbl`
  ADD CONSTRAINT `backup_inventory_tbl_ibfk_1` FOREIGN KEY (`serial_no`) REFERENCES `rma_defect_tbl` (`serial_no`);

--
-- Constraints for table `billing_tbl`
--
ALTER TABLE `billing_tbl`
  ADD CONSTRAINT `billing_tbl_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer_m_tbl` (`customer_id`);

--
-- Constraints for table `job_backup_tbl`
--
ALTER TABLE `job_backup_tbl`
  ADD CONSTRAINT `job_backup_tbl_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `customer_job_tbl` (`job_id`);

--
-- Constraints for table `job_estimate_tbl`
--
ALTER TABLE `job_estimate_tbl`
  ADD CONSTRAINT `job_estimate_tbl_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `customer_job_tbl` (`job_id`);

--
-- Constraints for table `job_progress_tbl`
--
ALTER TABLE `job_progress_tbl`
  ADD CONSTRAINT `job_progress_tbl_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `customer_job_tbl` (`job_id`);

--
-- Constraints for table `rma_defect_tbl`
--
ALTER TABLE `rma_defect_tbl`
  ADD CONSTRAINT `rma_defect_tbl_ibfk_1` FOREIGN KEY (`rma_no`) REFERENCES `rma_tbl` (`rma_no`);

--
-- Constraints for table `supplier_product_sno_m_tbl`
--
ALTER TABLE `supplier_product_sno_m_tbl`
  ADD CONSTRAINT `supplier_product_sno_m_tbl_ibfk_1` FOREIGN KEY (`sales_order_no`) REFERENCES `supplier_purchase_m_tbl` (`sales_order_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
