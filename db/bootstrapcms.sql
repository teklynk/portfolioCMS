-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2015 at 08:35 PM
-- Server version: 5.5.41
-- PHP Version: 5.4.4-14+deb7u5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE IF NOT EXISTS `aboutus` (
  `heading` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`heading`, `content`) VALUES
('About', '');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE IF NOT EXISTS `contactus` (
  `heading` text NOT NULL,
  `email` text NOT NULL,
  `sendtoemail` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zipcode` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`heading`, `email`, `sendtoemail`, `address`, `city`, `state`, `zipcode`, `phone`) VALUES
('Contact', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
  `heading` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`heading`, `content`) VALUES
('Around the Net', '');

-- --------------------------------------------------------

--
-- Table structure for table `landing`
--

CREATE TABLE IF NOT EXISTS `landing` (
  `heading` text NOT NULL,
  `introtext` text NOT NULL,
  `skills` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `landing`
--

INSERT INTO `landing` (`heading`, `introtext`, `skills`, `image`) VALUES
('Freelancer', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `thumbnail` text NOT NULL,
  `content` text NOT NULL,
  `active` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `thumbnail`, `content`, `active`, `datetime`) VALUES
(25, 'test', '', '<p>test</p>', 1, '2015-02-14 22:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `setup`
--

CREATE TABLE IF NOT EXISTS `setup` (
  `title` text NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `headercode` text NOT NULL,
  `author` text NOT NULL,
  `googleanalytics` text NOT NULL,
  `tinymce` int(11) NOT NULL,
  `portfolioheading` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`title`, `keywords`, `description`, `headercode`, `author`, `googleanalytics`, `tinymce`, `portfolioheading`) VALUES
('portfolioCMS', '', '', '', '', '', 1, 'Portfolio');

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

CREATE TABLE IF NOT EXISTS `socialmedia` (
  `heading` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `linkedin` text NOT NULL,
  `google` text NOT NULL,
  `github` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socialmedia`
--

INSERT INTO `socialmedia` (`heading`, `facebook`, `twitter`, `linkedin`, `google`, `github`) VALUES
('Follow Me', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
