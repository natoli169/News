-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2019 at 09:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(8) NOT NULL DEFAULT 'Enabled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `status`) VALUES
(7, 'Sports', 0, 'Enabled'),
(8, 'BasketBall', 7, 'Enabled'),
(9, 'Soccer', 7, 'Enabled'),
(10, 'Entertaiment', 0, 'Enabled'),
(11, 'Movie', 10, 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `author` varchar(16) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `body` text NOT NULL,
  `img` varchar(128) NOT NULL DEFAULT 'none',
  `category` int(11) NOT NULL,
  `headline` varchar(8) NOT NULL DEFAULT 'no',
  `view` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `author`, `time`, `body`, `img`, `category`, `headline`, `view`) VALUES
(17, 'The New York Yankees Win', 'Fitsum Ayalew', '2019-07-14 19:27:42', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.', '09-27-42_05e22730772945d0c6f38c665f3e614b.png', 8, 'Yes', 0),
(18, 'Endgame nearing to beat Avatar', 'Dani', '2019-07-14 19:34:02', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.', '09-28-41_d44e27d97b5d7f0d60b24251e1cef181.png', 11, 'No', 23),
(19, 'Arsenal new signings', 'Nacho', '2019-07-14 19:33:34', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias incidunt eius animi, omnis ullam sit nostrum obcaecati quidem consequatur ipsum totam accusamus cumque, architecto eveniet, suscipit voluptate iusto voluptatum. Earum.', '09-29-14_422de0e5af3789733c243bd297127aa4.png', 9, 'Yes', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(16) NOT NULL,
  `last_name` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(18, 'Natoli', 'Lemma', 'natolilemma1@gmail.com', '$2y$10$HfXpUskfW1pqh6yke.JqQ.SuckhqcDLRKDpIzT3sPTQ9KsbwwAq/2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
