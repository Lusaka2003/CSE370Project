-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 09:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrentalmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `password`) VALUES
('lusaka', '1234'),
('subah', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `License_plate` char(20) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Seating_Capacity` int(11) NOT NULL,
  `Car_Type` varchar(15) NOT NULL,
  `Model` varchar(20) DEFAULT NULL,
  `Brand` varchar(20) DEFAULT NULL,
  `Color` varchar(10) DEFAULT NULL,
  `RentPerDay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`License_plate`, `Status`, `Seating_Capacity`, `Car_Type`, `Model`, `Brand`, `Color`, `RentPerDay`) VALUES
('AB1234CD', 'Available', 5, 'Compact', 'Premio', 'Toyota', 'White', 3000),
('EF5678GH', 'Available', 5, 'Compact', 'Corolla', 'Toyota', 'Black', 3000),
('IJ9012KL', 'Not Available', 4, 'Compact', 'Civic', 'Honda', 'Red', 3000),
('KY1234JK', 'Not Available', 5, 'Sedan', 'Silvia', 'Nissan', 'Black', 4000),
('MN3456OP', 'Not Available', 4, 'Compact', 'Allion', 'Toyota', 'Blue', 3500),
('QR7890ST', 'Not Available', 4, 'SUV', 'Forestar', 'Subaru', 'Yellow', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `USER_ID` int(11) NOT NULL,
  `Name` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `Password` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `License_No` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`USER_ID`, `Name`, `email`, `Password`, `date_of_birth`, `phone`, `address`, `License_No`) VALUES
(1, 'Lusaka', 'lusaka@gmail.com', 'lusaka123', '2003-03-23', 1789123123, 'Gulshan', '123456'),
(2, 'Subah', 'subah@gmail.com', 'subah123', '2001-03-23', 1723456789, 'Badda', '123459'),
(5, 'Karim', 'karim@gmail.com', 'karim123', '1997-12-23', 1888888888, 'Badda', '987654');

-- --------------------------------------------------------

--
-- Table structure for table `offer_details`
--

CREATE TABLE `offer_details` (
  `Promo_Code` varchar(15) NOT NULL,
  `Percentage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer_details`
--

INSERT INTO `offer_details` (`Promo_Code`, `Percentage`) VALUES
('FLAT500', 0),
('NEWYEAR15', 15);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(11) NOT NULL,
  `Amount_Paid` int(11) DEFAULT NULL,
  `Card_No` char(16) DEFAULT NULL,
  `Name_On_Card` varchar(50) DEFAULT NULL,
  `Paid_By_Cash` tinyint(1) DEFAULT NULL,
  `Paid_By_Card` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Amount_Paid`, `Card_No`, `Name_On_Card`, `Paid_By_Cash`, `Paid_By_Card`) VALUES
(0, 6879, '546476', 'Lusaka', 0, 0),
(1, 10500, '1234567812345678', 'Hermione Granger', 0, 1),
(2, 7000, NULL, NULL, 1, 0),
(3, 6300, '9876543298765432', 'Ron Weasley', 0, 1),
(4, 5000, NULL, NULL, 1, 0),
(5, 8200, '5555666677778888', 'Draco Malfoy', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `Referee_id` int(11) DEFAULT NULL,
  `Referer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Reservation_ID` int(11) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `License_plate` char(20) NOT NULL,
  `Promo_Code` varchar(15) DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `totalAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Reservation_ID`, `Start_Date`, `End_Date`, `License_plate`, `Promo_Code`, `USER_ID`, `totalAmount`) VALUES
(4, '2025-01-03', '2025-01-05', 'KY1234JK', 'NEWYEAR15', 5, 6800);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `CustomerReview` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ID`, `Name`, `CustomerReview`) VALUES
(1, 'Lusaka', 'very helpful'),
(2, 'Subah', 'Easy to Use'),
(3, 'Tisha', 'I Love this');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`License_plate`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indexes for table `offer_details`
--
ALTER TABLE `offer_details`
  ADD PRIMARY KEY (`Promo_Code`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation_ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
