-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2018 at 08:13 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bill_line_item_m_tbl`
--

INSERT INTO `bill_line_item_m_tbl` (`id`, `invoice_no`, `bill_line_item_no`, `category`, `make`, `model`, `serial_no`, `invoice_date`) VALUES
(1, '4002', '40011', 'Projector', 'Panasonic', 'MK64', '6771780070003350', '2016-12-03'),
(2, '4001', '40012', 'Conferance', 'Polycom', 'OPT651', '4168199000073619', '2016-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `bill_m_tbl`
--

CREATE TABLE IF NOT EXISTS `bill_m_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(100) NOT NULL,
  `invoice_date` date NOT NULL,
  `total_amount` int(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bill_m_tbl`
--

INSERT INTO `bill_m_tbl` (`id`, `invoice_no`, `invoice_date`, `total_amount`, `customer_id`) VALUES
(1, '4001', '2016-12-03', 35000, 'CUS1001'),
(2, '4002', '2017-08-03', 65000, 'CUS1004'),
(3, '4003', '2014-06-25', 23000, 'CUS1002'),
(4, '4004', '2017-06-09', 16000, 'CUS1004');

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
  `service_manage_id` varchar(100) NOT NULL,
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

INSERT INTO `customer_job_tbl` (`job_id`, `customer_id`, `invoice_no`, `job_date`, `serial_no`, `category`, `make`, `model`, `problem_description`, `warranty_type`, `sales_order_no`, `sales_order_date`, `technician_id`, `store_manager_id`, `service_manage_id`, `imports_manager_id`, `job_status`, `technician_status`, `store_manager_status`, `service_manager_status`, `imports_manager_status`, `current_status`) VALUES
('35001', 'CUS1001', '4001', '2012-12-09', '4168199000073619', 'Conferance', 'Polycom', 'OPT651', 'Power cutoff', 'Supplier Warranty', 'KA1001', '2017-11-25', 'TEC201', '', '', '', 'In Progress', 'Technician WIP', 'Pending', 'Pending', '', 'Technician WIP'),
('35002', 'CUS1001', '4001', '2014-12-09', '4168199000073619', 'Conferance', 'Polycom', 'OPT651', 'Cable issue', 'Supplier Warranty', 'KA1001', '2017-11-25', 'TEC201', '', '', '', 'In Progress', 'Technician WIP', 'Pending', 'Pending', '', 'Technician WIP'),
('35003', 'CUS1001', '4001', '2016-12-09', '4168199000073619', 'Conferance', 'Polycom', 'OPT651', 'Lamp issue', 'Supplier Warranty', 'KA1001', '2017-11-25', 'Tech000', '', '', '', 'New', 'Pending', 'Pending', 'Pending', '', 'New'),
('35004', 'CUS1001', '4001', '2017-12-09', '4168199000073619', 'Conferance', 'Polycom', 'OPT651', 'fgdfgfdg', 'Customer Repair', 'KA1001', '2017-11-25', 'Tech000', '', '', '', 'New', 'Pending', 'Pending', 'Pending', '', 'New'),
('35005', 'CUS1001', '4001', '2017-12-09', '4168199000073619', 'Conferance', 'Polycom', 'OPT651', 'networkjhgdjhgfdhfgd', 'Customer Repair', 'KA1001', '2017-11-25', 'Tech000', '', '', '', 'New', 'Pending', 'Pending', 'Pending', '', 'New'),
('35006', 'CUS1001', '4001', '2017-12-09', '4168199000073619', 'Conferance', 'Polycom', 'OPT651', 'no power on', 'Customer Repair', 'KA1001', '2017-11-25', 'Tech000', '', '', '', 'New', 'Pending', 'Pending', 'Pending', '', 'New');

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
('CUS1003', 'Rev.', 'Panadure Vijitha Nanda Thero', 'Sri Medhananda Temple,\r\nPanadura                  ', '0777961111', '0112719393', '596538189V', '0112719350', 'vijithananda@gmail.com', 'active'),
('CUS1004', 'Mr.', 'Gayan Akurugoda', '25/B, Rawathawaththe,\r\nMoratuwa                                                ', '0716938501', '0112793506', '935964820V', 'NA', 'gayan@yahoo.com', 'active'),
('CUS1005', 'Mr.', 'Chandra Srimantha', 'Abans Plc,\r\nColombo 08.                                                ', '0776420257', '0112719393', '759028539V', '0112719350', 'sri@abans.lk', 'active'),
('CUS1006', 'Dr.', 'Oshan Basnayake', 'No.58/A, Daniel Perera Mw,\r\nKiribathgoda', '0774560110', '0112845607', '893959317V', 'NA', 'oshanb@gmail.com', 'active'),
('CUS1007', 'Mr.', 'Neel Hettiarachchi', 'Aitken Spence Hotel,\r\nColombo 02\r\n ', '0714596740', '0112640582', '554902489V', 'NA', 'neelh@gmail.com', 'active'),
('CUS1008', 'Ms.', 'Ramya Wanigasekara', 'Mas Holdings (Pvt) Ltd\r\nRathnapura', '0783469704', '0455607803', '764056097V', '0455607803', 'ramya@masholdings.com', 'active'),
('CUS1009', 'Mr.', 'Chanaka Pathirana', 'Eco Air Condition (pvt) Ltd\r\nNittabuwa                                                ', '0777355670', '0375697320', '678035867V', 'NA', 'chanakap@eco.lk', 'active'),
('CUS1010', 'Mr.', 'Saman Weeraman', 'Subodha Furniture\r\nWadduwa', '0783958291', '0385679248', '503947202V', 'NA', 'saman@subodha.lk', 'deactive'),
('CUS1011', 'Ms.', 'Namali Rajapakse', 'Ministry of Education,\r\nBattaramulla.', '0765893405', '0112840571', '915703495V', '0112840572', 'namalir@edu.lk', 'active'),
('CUS1012', 'Ms.', 'Yasawathi Samarapala', 'University of Peradeniya,\r\nPeradeniya.', '0777698302', '0814972058', '501350684V', '0814972058', 'yasawathi@pera.lk', 'deactive'),
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
(4, 'Job', '35007'),
(5, 'Supplier_Purchase', 'PUR1044'),
(6, 'Warranty_Card', 'WAR1000'),
(7, 'RMA', 'R1000'),
(8, 'Front_Desk_Officer', 'FDO107'),
(9, 'Technician', 'TEC216'),
(10, 'Store Manager', 'STMGR406'),
(11, 'Service Manager', 'SERMGR500'),
(12, 'Imports Manager', 'IMPMGR600'),
(13, 'Part Ref Code', 'P_1002');

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
  `part_no` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  `out_of_stock_status` varchar(100) NOT NULL,
  `status1` varchar(100) NOT NULL,
  `status2` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `store_status` varchar(100) NOT NULL,
  PRIMARY KEY (`part_ref_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts_inventory_m_tbl`
--

INSERT INTO `parts_inventory_m_tbl` (`part_ref_code`, `part_no`, `description`, `min_qty`, `store_qty`, `store_status`) VALUES
('P_1001', 'L45', 'sony lamp', 3, 24, 'Available'),
('P_1002', 'IC1009', 'SONY board IC 1009', 4, 89, 'Available');

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
('EMP1031', 'STMGR401', 'Prof.R.H.R.GUNAWARDENE Dr. G B Gunawardena', '0776790257', '1'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `supplier_product_sno_m_tbl`
--

INSERT INTO `supplier_product_sno_m_tbl` (`supp_product_sno_id`, `sales_order_no`, `serial_no`, `category`, `make`, `model`, `status`) VALUES
(24, 'KA1001', '8814875132313', 'Projectors', 'Infocus', 'IN 109', 'Verified'),
(25, 'KA1001', '00158906028', 'Projectors', 'Infocus', 'IN 109', 'Verified'),
(26, 'KA1001', '4792210100248', 'Projectors', 'Infocus', 'IN 109', 'Verified'),
(27, 'KA1001', '1100056867318', 'Projectors', 'Infocus', 'IN 109', 'Verified'),
(28, 'KA1001', '4168199000073619', 'Conferance', 'Polycom', 'OPT651', 'Verified'),
(29, 'KA1001', '8814875132313', 'Amplifiers', 'Panasonic', 'PA456', 'Verified'),
(30, 'KA1001', '00158906028', 'Amplifiers', 'Panasonic', 'PA456', 'Verified'),
(31, 'KA1001', '1100056867318', 'Amplifiers', 'Panasonic', 'PA456', 'Verified'),
(32, 'KA1001', '4168199000073619', 'Microphones', 'Infocus', 'MIC1111', 'Verified'),
(33, 'KA1129', '6771780070003360', 'Mixers', 'Sure', 'AZ741', 'Verified'),
(34, 'KA1129', '4168199000073619', 'Mixers', 'Sure', 'AZ741', 'Verified'),
(35, 'KA1129', '1100056407767', 'Mixers', 'Sure', 'AZ741', 'Verified'),
(36, 'RE404', '4168199000073619', 'Amplifiers', 'Polycom', 'POL789', 'Verified'),
(37, 'RE404', '1100056407767', 'Amplifiers', 'Polycom', 'POL789', 'Verified'),
(38, 'RE404', '6771780070003350', 'Amplifiers', 'Polycom', 'POL789', 'Verified');

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
('PUR1014', 'SUP1005', 'AN1001', '2017-11-12', '2017', 'Projectors', 'Infocus', 'IN 104', 0, 10, 'yes', '2017-11-12', '2019-11-12', '24', '2 Years', '', '', '', '', 'active'),
('PUR1015', 'SUP1004', 'NI100', '2017-11-12', '2017', 'Projectors', 'Inter-M', 'IN 105', 0, 20, 'yes', '2017-11-12', '2018-05-12', '6', '6 Months', '', '', '', 'NI100.pdf', 'active'),
('PUR1016', 'SUP1003', 'KA100', '2017-11-12', '2017', 'Microphones', 'Panasonic', 'MI4545', 0, 30, 'no', '0000-00-00', '0000-00-00', 'N/A', 'N/A', '', '', '', '', 'active'),
('PUR1017', 'SUP1003', 'KA1001', '2017-11-25', '2017', 'Projectors', 'Infocus', 'IN 109', 4, 4, 'yes', '2017-11-12', '2020-11-12', '36', '3 Years', '', '', '', '', 'active'),
('PUR1018', 'SUP1003', 'KA1002', '2017-11-12', '2017', 'Projectors', 'Inter-M', 'IN 104', 0, 40, 'yes', '2017-11-12', '2018-05-12', '6', '6 Months', '', '', '', '', 'active'),
('PUR1019', 'SUP1003', 'KA1003', '2017-11-12', '2017', 'Projectors', 'Sure', 'IN 1123', 0, 50, 'yes', '2017-11-12', '2018-02-12', '3', '3 Months', '', '', '', '', 'active'),
('PUR1020', 'SUP1003', 'KA1003', '2017-11-12', '2017', 'Microphones', 'Panasonic', 'PA679', 0, 60, 'yes', '2017-11-12', '2018-11-12', '12', '1 Year', '', '', '', '', 'active'),
('PUR1021', 'SUP1003', 'KA1001', '2017-11-25', '2017', 'Amplifiers', 'Panasonic', 'PA456', 4, 4, 'no', '0000-00-00', '0000-00-00', 'N/A', 'N/A', '', '', '', '', 'active'),
('PUR1022', 'SUP1003', 'KA1001', '2017-11-25', '2017', 'Microphones', 'Infocus', 'MIC1111', 1, 36, 'yes', '2017-11-25', '2021-11-25', '48', '4 Years', '', '', '', '', 'active'),
('PUR1023', 'SUP1003', 'KA1001', '2017-11-25', '2017', 'Conferance', 'Polycom', 'OPT651', 1, 1, 'yes', '2012-11-25', '2016-11-25', '48', '4 Years', '', '', '', '', 'active'),
('PUR1024', 'SUP1003', 'TEST12', '2017-11-12', '2017', 'Mixers', 'Sure', 'IN 104', 0, 20, 'yes', '2017-11-12', '2019-11-12', '24', '2 Years', '', '', '', '', 'active'),
('PUR1025', 'SUP1003', 'TEST12', '2017-11-12', '2017', 'Mixers', 'Sure', 'IN 104', 0, 20, 'yes', '2017-11-12', '2019-11-12', '24', '2 Years', '', '', '', '', 'active'),
('PUR1026', 'SUP1003', 'TESTK12', '2017-11-12', '2017', 'Projectors', 'Sure', 'MJ9876', 0, 60, 'yes', '2017-11-12', '2019-11-12', '24', '2 Years', '', '', '', '', 'active'),
('PUR1027', 'SUP1005', 'ANTest123', '2017-11-12', '2017', 'Projectors', 'Infocus', 'OOP4545', 0, 80, 'yes', '2017-11-12', '2018-11-12', '12', '1 Year', '', '', '', 'ANTest123.docx', 'active'),
('PUR1028', 'SUP1004', 'NI500', '2017-11-12', '2017', 'Mixers', 'Panasonic', 'MJ9876', 0, 36, 'yes', '2017-11-12', '2021-11-12', '48', '4 Years', '', '', '', 'NI500.pdf', 'active'),
('PUR1029', 'SUP1005', 'SO99999', '2017-11-12', '2017', 'Amplifiers', 'Inter-M', 'IN 104', 0, 10, 'yes', '2017-11-12', '2021-11-12', '48', '4 Years', '', '', '', 'temp', 'active'),
('PUR1030', 'SUP1003', 'SO8888', '2017-11-12', '2017', 'Projectors', 'Panasonic', 'IN 104', 0, 60, 'yes', '2017-11-12', '2019-11-12', '24', '2 Years', '', '', '', 'temp', 'active'),
('PUR1031', 'SUP1002', 'TL6363', '2017-11-12', '2017', 'Projectors', 'Inter-M', 'TL74123', 0, 55, 'yes', '2017-11-12', '2021-11-12', '48', '4 Years', '', '', '', 'TL6363.docx', 'active'),
('PUR1032', 'SUP1003', 'KA1129', '2017-11-29', '2017', 'Projectors', 'Panasonic', 'T1129', 0, 60, 'yes', '2017-11-29', '2020-11-29', '36', '3 Years', 'yes', '12', '1 Year', 'KA1129.pdf', 'active'),
('PUR1033', 'SUP1003', 'KA1130', '2017-11-29', '2017', 'Amplifiers', 'Sure', 'IN LKR', 0, 85, 'no', '0000-00-00', '0000-00-00', 'N/A', 'N/A', 'no', 'N/A', 'N/A', 'KA1130.pdf', 'active'),
('PUR1034', 'SUP1003', 'KA1131', '2017-11-29', '2017', 'Mixers', 'Inter-M', 'INT987', 0, 45, 'yes', '2017-11-29', '2018-05-29', '6', '6 Months', 'no', 'N/A', 'N/A', 'KA1131.pdf', 'active'),
('PUR1035', 'SUP1003', 'KA1132', '2017-11-29', '2017', 'Microphones', 'Infocus', 'MJ9741', 0, 20, 'no', '0000-00-00', '0000-00-00', 'N/A', 'N/A', 'yes', '48', '4 Years', 'KA1132.pdf', 'active'),
('PUR1036', 'SUP1003', 'KA1129', '2017-11-29', '2017', 'Amplifiers', 'Panasonic', 'DSF100', 0, 45, 'yes', '2017-11-29', '2018-11-29', '12', '1 Year', 'yes', '36', '3 Years', 'temp', 'active'),
('PUR1037', 'SUP1003', 'KA1129', '2017-11-29', '2017', 'Mixers', 'Sure', 'AZ741', 3, 3, 'yes', '2017-11-29', '2019-11-29', '24', '2 Years', 'yes', '36', '3 Years', 'temp', 'active'),
('PUR1038', 'SUP1003', 'KA1130', '2017-11-29', '2017', 'Mixers', 'Panasonic', 'UTY7896', 0, 74, 'no', '0000-00-00', '0000-00-00', 'N/A', 'N/A', 'yes', '24', '2 Years', 'temp', 'active'),
('PUR1039', 'SUP1003', 'KA1129', '2017-11-29', '2017', 'Microphones', 'Panasonic', 'LOP6321', 0, 34, 'yes', '2017-11-29', '2018-11-29', '12', '1 Year', 'yes', '24', '2 Years', 'temp', 'active'),
('PUR1040', 'SUP1003', 'KA1129', '2017-11-29', '2017', 'Amplifiers', 'Infocus', 'UAT7845', 0, 21, 'no', '0000-00-00', '0000-00-00', 'N/A', 'N/A', 'no', 'N/A', 'N/A', 'temp', 'active'),
('PUR1041', 'SUP1003', 'KA1129', '2017-11-29', '2017', 'Mixers', 'Inter-M', 'JHG4565', 0, 62, 'yes', '2017-11-29', '2019-11-29', '24', '2 Years', 'no', 'N/A', 'N/A', 'temp', 'active'),
('PUR1042', 'SUP1003', 'KA1129', '2017-11-29', '2017', 'Amplifiers', 'Panasonic', 'POP1212', 0, 13, 'no', '0000-00-00', '0000-00-00', 'N/A', 'N/A', 'yes', '36', '3 Years', 'temp', 'active'),
('PUR1043', 'SUP1002', 'KA2090', '2017-10-30', '2017', 'Conference', 'Polycom', 'VX-1000', 0, 3, 'yes', '2017-10-30', '2018-10-30', '12', '1 Year', 'yes', '12', '1 Year', 'KA2090.PDF', 'active'),
('PUR1044', 'SUP1003', 'RE404', '2017-12-05', '2017', 'Amplifiers', 'Polycom', 'POL789', 3, 3, 'yes', '2017-12-05', '2019-12-05', '24', '2 Years', 'yes', '24', '2 Years', 'RE404.pdf', 'active');

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
('SUP1011', 'Bekam Gilbert', 'InFocus Asia-Pacific, China                                           ', '008695583', 'bekam@infocus.lk', '008695583', 'Projectors', 'Infocus', 'deactive');

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
