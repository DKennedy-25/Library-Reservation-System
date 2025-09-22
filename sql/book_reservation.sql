-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 12:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `edition` int(11) DEFAULT NULL,
  `category_code` int(11) DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `author`, `edition`, `category_code`, `available`) VALUES
('093-403992', 'Computers in Business', 'Alicia Oneill', 3, 4, 1),
('23472-8729', 'Exploring Peru', 'Stephanie Birchi', 4, 5, 1),
('237-34823', 'Business Strategy', 'Joe Peppard', 2, 2, 1),
('23u8-923849', 'A guide to nutrition', 'John Thorpe', 2, 1, 0),
('2983-3494', 'Cooking for children', 'Anabelle Sharpe', 3, 7, 0),
('82n8-308', 'Computers for Idiots', 'Susan O\'Neill', 5, 4, 1),
('9823-23984', 'My life in picture', 'Kevin Graham', 8, 3, 1),
('9823-2403-0', 'DaVinci Code', 'Dan Brown', 1, 8, 1),
('9823-98345', 'How to cook Italian food', 'Jamie Oliver', 2, 7, 0),
('9823-98487', 'Optimising your business', 'Cleo Blair', 1, 2, 1),
('98234-029384', 'My ranch in Texas', 'George Bush', 5, 3, 1),
('987-0039882', 'Shooting History', 'Jon Snow', 1, 3, 1),
('988745-234', 'Tara Road', 'Maeve Binchy', 4, 8, 0),
('993-004-00', 'My life in bits', 'John Smith', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_ID` int(11) NOT NULL,
  `category_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_ID`, `category_description`) VALUES
(1, 'Health'),
(2, 'Business'),
(3, 'Biography'),
(4, 'Technology'),
(5, 'Travel'),
(6, 'Self-Help'),
(7, 'Cookery'),
(8, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `isbn` varchar(13) DEFAULT NULL,
  `reservation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `username`, `isbn`, `reservation_date`) VALUES
(1, 'joecrotty', '98234-029384', '2024-12-04'),
(2, 'tommy100', '9823-98345', '2024-12-04'),
(8, 'darragh', '988745-234', '2024-12-05'),
(9, 'darragh', '2983-3494', '2024-12-06'),
(11, 'darragh2', '23u8-923849', '2024-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `mobile` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fullname`, `city`, `mobile`) VALUES
('alanjmckenna', '$2b$12$JVQVqGaVMtgLt6AP8cDXoeAHmTFXaHzs1ZOl9EJEVvDnJUip9jGsi', 'Alan McKenna', 'Dublin', '856625567'),
('c234', '$2y$10$PcoC4D2CxQ1wUlitFtKyPOrcfNAuGoffldhj3hboCupURlQ.DgMGK', 'Darragh Kennedy', 'Cork', '0832281287'),
('darragh', '$2y$10$s5RZdGAPoh.mAEc5cD5pvuNkGicUp26fq0BRlmh/9R9Y.DzOu1QNm', 'Darragh Kennedy', 'Dublin', '0000000000'),
('darragh2', '$2y$10$dqVlYDchQvZPpqb7Jlz97e1kg4/ZzZcr3cUWFzoxE/MkTWAbLj4BS', 'Darragh Kennedy', 'Dublin', '1234567890'),
('joecrotty', '$2b$12$bp/fA.d3FwFc0JTOvR0k8..Caiy9nY3FxCvN9DXI/WFgruEXGPSWa', 'Joseph Crotty', 'Dublin', '876654456'),
('tommy100', '$2b$12$43SuRE0guFfM/k8SsZ8jv.EKpvHET8koSiaH85K8Rm3bDGGQf9BKS', 'Tom Behan', 'Dublin', '876738782');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `category_code` (`category_code`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_code`) REFERENCES `categories` (`category_ID`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
