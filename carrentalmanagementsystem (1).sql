-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 06:10 AM
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
('EF5678GH', 'Not Available', 5, 'Compact', 'Corolla', 'Toyota', 'Black', 3000),
('IJ9012KL', 'Available', 4, 'Compact', 'Civic', 'Honda', 'Red', 3000),
('KY1234JK', 'Available', 5, 'Sedan', 'Silvia', 'Nissan', 'Black', 4000),
('MN3456OP', 'Not Available', 4, 'Compact', 'Allion', 'Toyota', 'Blue', 3500),
('QR7890ST', 'Available', 4, 'SUV', 'Forestar', 'Subaru', 'Yellow', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `USER_ID` int(11) NOT NULL,
  `Name` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `License_No` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`USER_ID`, `Name`, `email`, `Password`, `date_of_birth`, `phone`, `address`, `License_No`) VALUES
(1, 'Lusaka', 'lusaka@gmail.com', '$2y$10$7Srtg6tkLEwe7bM6LT74t.AGUTFScNCLLN6uWVnAgUS', '2000-07-20', 1789123456, 'Badda', '123456'),
(2, 'Subah', 'subah@gmail.com', '$2y$10$K2UI./w.e9HAajF7dGSm.Okn0Lk5qci0rcAbnFj5kHw', '2001-03-23', 1723456789, 'Badda', '123457'),
(3, 'Rahim', 'rahim@gmail.com', '$2y$10$toyCtcLrCeySqkadcxT1nuGDd.au3y60944qLbDTuPn', '1999-01-16', 1777777771, 'Banasree', '123458');

-- --------------------------------------------------------

--
-- Table structure for table `offer_details`
--

CREATE TABLE `offer_details` (
  `Promo_Code` varchar(15) NOT NULL,
  `Description` varchar(50) DEFAULT NULL,
  `Promo_Type` varchar(20) NOT NULL,
  `Percentage` int(11) DEFAULT NULL,
  `Discounted_Amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer_details`
--

INSERT INTO `offer_details` (`Promo_Code`, `Description`, `Promo_Type`, `Percentage`, `Discounted_Amount`) VALUES
('FLAT500', 'Flat 500 off on all cars', 'Flat Discount', NULL, 500),
('NEWYEAR15', '15% off for New Year', 'Percentage', 15, NULL),
('SUV20', '20% off on SUVs', 'Percentage', 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(11) NOT NULL AUTO_INCREMENT,
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
  `Reservation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Meter_Start` int(11) NOT NULL,
  `Meter_End` int(11) DEFAULT NULL,
  `Rent_Amount` int(11) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `License_No` varchar(15) DEFAULT NULL,
  `License_plate` char(20) NOT NULL,
  `Promo_Code` varchar(15) DEFAULT NULL,
  `Payment_ID` int(11) DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `Name` varchar(20) NOT NULL,
  `CustomerReview` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`Name`, `CustomerReview`) VALUES
('', ''),
('Peter Parker', 'This is the best car rental service I have ever used. The process was smooth, and the staff were very friendly. Highly recommend!'),
('Mary Jane', 'Great service and good selection of cars. The only downside was the pick-up time, which could be improved. Otherwise, fantastic experience!');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
