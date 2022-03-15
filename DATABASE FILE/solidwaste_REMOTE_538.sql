-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2022 at 09:16 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solidwaste`
--

-- --------------------------------------------------------

--
-- Table structure for table `expend`
--

CREATE TABLE `expend` (
  `expend_id` varchar(14) NOT NULL,
  `total` int(11) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `start_expend` date NOT NULL,
  `wastecat_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expend`
--

INSERT INTO `expend` (`expend_id`, `total`, `detail`, `start_expend`, `wastecat_id`) VALUES
('20210130093105', 5503, 'Washers Bought', '2021-01-01', 'K004'),
('20210130104609', 4260, 'Salary Payment January 2021', '2021-01-30', 'K000'),
('20210130110802', 466, 'Electricity Bills', '2021-06-16', 'K004'),
('20210805095557', 3000, 'Employee Salary Payment July 2021', '2021-07-02', 'K000'),
('20210805095931', 3000, 'Employee Salary Payment August 2021', '2021-08-05', 'K000'),
('20220102083511', 70, '4343', '2022-01-02', 'K005'),
('20220102083949', 800, 'hello', '2022-01-02', 'K005');

-- --------------------------------------------------------

--
-- Table structure for table `municipal`
--

CREATE TABLE `municipal` (
  `id` int(11) NOT NULL,
  `municipal_id` char(150) NOT NULL,
  `name_municipal` varchar(50) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `province` text NOT NULL,
  `barangay` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `municipal`
--

INSERT INTO `municipal` (`id`, `municipal_id`, `name_municipal`, `zipcode`, `province`, `barangay`) VALUES
(11, 'M0014', 'Julita ', '', 'Leyte', 'Poblacion District IV'),
(1, 'P001', 'Brenda Roach', 'Female', '3641 Frum Street', '081243568387'),
(10, 'P0010', 'Larry Meuller', 'Male', '85 Stom Avenue', '72566600150'),
(2, 'P002', 'Gerald Whisler', 'Male', '1005 Heliport Loop', '08234454345'),
(3, 'P003', 'Johnny Smith', 'Male', '4327 Nuzum Court', '082284003073'),
(4, 'P004', 'Misti R Hurd', 'Female', '398 Central Avenue', '082282553856'),
(5, 'P005', 'Antonio Waree', 'Male', '704 Brown Street', '08236749827'),
(6, 'P006', 'Amber Slank', 'Female', '1518 Wilkinson Court', '085634872555'),
(7, 'P007', 'Joseph Howie', 'Male', '2254 Norma Avenue', '085544338866'),
(8, 'P008', 'James Smith', 'Laki-Laki', '7125 Demo Street', '01478541000'),
(9, 'P009', 'Karen Peige', 'Female', '4552 Poling Farm Road', '74100025690');

-- --------------------------------------------------------

--
-- Table structure for table `transac`
--

CREATE TABLE `transac` (
  `transac_id` varchar(14) NOT NULL,
  `municipal_id` char(7) NOT NULL,
  `wastecat_id` char(6) NOT NULL,
  `weight` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transac`
--

INSERT INTO `transac` (`transac_id`, `municipal_id`, `wastecat_id`, `weight`, `total`, `start_date`, `end_date`) VALUES
('20210130151203', 'P001', 'K004', 12, 46, '2021-01-01', '2021-01-03'),
('20210130151243', 'P002', 'K004', 15, 58, '2021-01-01', '2021-01-04'),
('20210130151304', 'P003', 'K004', 15, 58, '2021-01-02', '2021-01-04'),
('20210130151345', 'P004', 'K004', 20, 77, '2021-01-02', '2021-01-05'),
('20210130164704', 'P002', 'K004', 25, 96, '2021-01-05', '2021-01-08'),
('20210130164722', 'P005', 'K004', 25, 96, '2021-01-07', '2021-01-09'),
('20210130164748', 'P003', 'K004', 18, 69, '2021-01-08', '2021-01-10'),
('20210130164804', 'P001', 'K004', 19, 73, '2021-01-10', '2021-01-12'),
('20210130164821', 'P004', 'K004', 20, 77, '2021-01-11', '2021-01-13'),
('20210130164855', 'P003', 'K004', 22, 85, '2021-01-13', '2021-01-15'),
('20210130164918', 'P002', 'K004', 11, 42, '2021-01-16', '2021-01-18'),
('20210130170149', 'P005', 'K004', 15, 58, '2021-01-17', '2021-01-19'),
('20210130170220', 'P001', 'K004', 8, 31, '2021-01-17', '2021-01-20'),
('20210130170251', 'P004', 'K004', 18, 69, '2021-01-20', '2021-01-22'),
('20210130170310', 'P003', 'K004', 29, 112, '2021-01-21', '2021-01-23'),
('20210130171108', 'P006', 'K004', 20, 77, '2021-01-21', '2021-01-23'),
('20210130171129', 'P007', 'K004', 18, 69, '2021-01-22', '2021-01-24'),
('20210130171209', 'P005', 'K004', 17, 65, '2021-01-23', '2021-01-25'),
('20210130171253', 'P002', 'K004', 19, 73, '2021-01-24', '2021-01-26'),
('20210130171310', 'P004', 'K004', 20, 77, '2021-01-25', '2021-01-27'),
('20210130171348', 'P001', 'K004', 17, 65, '2021-01-26', '2021-01-28'),
('20210130171433', 'P006', 'K004', 8, 31, '2021-01-26', '2021-01-28'),
('20210130171537', 'P003', 'K004', 15, 58, '2021-01-27', '2021-01-29'),
('20210130171617', 'P007', 'K004', 10, 39, '2021-01-27', '2021-01-29'),
('20210130171846', 'P005', 'K004', 46, 177, '2021-08-03', '2021-08-05'),
('20210130172114', 'P004', 'K004', 21, 81, '2021-08-02', '2021-08-05'),
('20210627232518', 'P008', 'K004', 5, 19, '2021-06-26', '2021-06-27'),
('20210805150525', 'P009', 'K004', 14, 54, '2021-08-05', '2021-08-05'),
('20210805153848', 'P007', 'K005', 73, 281, '2021-07-07', '2021-08-05'),
('20210805211713', 'P002', 'K005', 36, 139, '2021-08-05', '2021-08-05'),
('20220102143416', 'M0014', 'K006', 90, 347, '2022-01-27', '2022-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` char(4) NOT NULL,
  `namauser` varchar(30) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` char(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `namauser`, `username`, `password`, `level`) VALUES
('U001', 'Liam Moore', 'admin', 'D00F5D5217896FB7FD601412CB890830', 'superuser');

-- --------------------------------------------------------

--
-- Table structure for table `wastecat`
--

CREATE TABLE `wastecat` (
  `wastecat_id` char(4) NOT NULL,
  `name_wastecat` varchar(50) NOT NULL,
  `col_day` varchar(10) NOT NULL,
  `spec` text NOT NULL,
  `source` varchar(15) NOT NULL,
  `col_fees` int(11) NOT NULL,
  `col_date` date NOT NULL,
  `fin_date` date NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wastecat`
--

INSERT INTO `wastecat` (`wastecat_id`, `name_wastecat`, `col_day`, `spec`, `source`, `col_fees`, `col_date`, `fin_date`, `aktif`) VALUES
('K000', 'Liam Moore', 'Female', '7869 Ralph Street', '096001588696', 90, '2022-01-02', '2022-01-02', 0),
('K001', 'Cythia Eddy', 'Female', '2902 Drainer Avenue', '08123456792', 1360, '2019-10-06', '2021-01-25', 0),
('K002', 'Curt Payne', 'Male', '2277 Elsie Drive', '087840927394', 1450, '2019-12-04', '2021-02-22', 0),
('K003', 'William Fransen', 'Male', '3178 Roy Alley', '08128349834', 1450, '2019-12-10', '2021-03-09', 0),
('K004', 'Christine Moore', 'Female', '8600 Allace Avenue', '08122334458', 1400, '2020-02-03', '0000-00-00', 1),
('K005', 'Clea Randolph', 'Female', '3914 Dennison Street', '78500014714', 0, '2021-05-04', '0000-00-00', 1),
('K006', 'Thomas', 'Male', '4572 Emily Drive', '71400000250', 1560, '2021-08-01', '0000-00-00', 1),
('W007', 'Female', 'Female', 'sdwd', 'Commerce/Indust', 500, '2022-01-02', '2023-01-02', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expend`
--
ALTER TABLE `expend`
  ADD PRIMARY KEY (`expend_id`);

--
-- Indexes for table `municipal`
--
ALTER TABLE `municipal`
  ADD PRIMARY KEY (`municipal_id`),
  ADD UNIQUE KEY `UNIQUE` (`id`);

--
-- Indexes for table `transac`
--
ALTER TABLE `transac`
  ADD PRIMARY KEY (`transac_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wastecat`
--
ALTER TABLE `wastecat`
  ADD PRIMARY KEY (`wastecat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `municipal`
--
ALTER TABLE `municipal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
