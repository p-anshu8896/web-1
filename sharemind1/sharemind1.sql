-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2022 at 11:34 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharemind1`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postid` int(8) NOT NULL,
  `postcontent` text NOT NULL,
  `userid` int(8) NOT NULL,
  `dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postid`, `postcontent`, `userid`, `dt`) VALUES
(2, 'kutta hai yi', 97, '2022-10-03 09:31:45'),
(3, 'kutta hai yi', 97, '2022-10-03 09:33:30'),
(4, 'uytgfvhfgfghh', 97, '2022-10-03 09:33:35'),
(5, 'hhjg hgjhgjhgj', 97, '2022-10-03 09:35:01'),
(6, 'sazid gadha hai', 26, '2022-10-03 10:12:11'),
(7, 'hello i am aashtha', 129, '2022-10-12 11:17:28'),
(8, 'hello i am sneha', 49, '2022-10-12 11:38:33'),
(9, 'hello yaar i m shivani', 131, '2022-10-12 11:40:31'),
(10, 'Mera naam Tarunn hai', 127, '2022-10-12 11:41:58'),
(11, 'Gaurav mera naam ... krta hu sab kaam', 27, '2022-10-12 11:45:39'),
(12, 'Mai sazid hu', 130, '2022-10-12 11:46:50'),
(13, 'My name is Priyanshu', 132, '2022-10-13 06:50:09'),
(15, 'hjcsvcsvss Priyanshu', 132, '2022-10-13 11:33:01'),
(16, 'kutta', 132, '2022-10-13 11:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `age` int(200) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `dor` date NOT NULL,
  `propic` varchar(255) NOT NULL DEFAULT 'images/user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `mobile`, `age`, `gender`, `pwd`, `dor`, `propic`) VALUES
(26, 'garima', 'garimakumari1628@gmail.com', '8726835069', 26, 'female', '121234', '2022-09-21', 'upl/1664784057meri pic.jpg'),
(27, 'Gaurav', 'gauravgk1100@gmail.com', '7318442346', 23, 'male', '1234', '2022-09-21', 'upl/1664639688gaurav.jpeg'),
(49, 'sneha', 'snehatripathi@gmail.com', '8318883807', 23, 'female', '1234', '2022-09-21', 'upl/1664639757sneha.jpeg'),
(97, 'Ankit', 'ankit@gmail.com', '6387076403', 24, 'male', '1234', '2022-09-22', 'upl/1664639803ankit.jpeg'),
(127, 'Tarun', 'tarun@gmail.com', '9876789098', 22, 'male', '1234', '2022-10-01', 'upl/1664639892tarun.jpeg'),
(128, 'Archna yadav', 'archu@mail.com', '9336417389', 23, 'female', '1234', '2022-10-01', 'upl/1664639978Deepika.jpg'),
(129, 'Astha', 'astha@gmail.com', '9170938166', 23, 'female', '1233', '2022-10-01', 'upl/1664640092astha.jpeg'),
(130, 'Sazid', 'sazid@gamil.com', '8176853498', 23, 'male', '1234', '2022-10-01', 'upl/16656363361665595371s4.jpg'),
(131, 'Sivani', 'sivani@gmail.com', '7317405365', 23, 'female', '1234', '2022-10-01', 'upl/1664640482sivani1.jpeg'),
(132, 'Priyanshu', 'priyanshu@gmail.com', '7865498320', 20, 'male', '1212', '2022-10-13', 'upl/16656365661665597175Priyanshu.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
