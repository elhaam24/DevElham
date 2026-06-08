-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 07, 2026 at 12:09 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) DEFAULT NULL,
  `c_email` varchar(50) DEFAULT NULL,
  `c_message` text,
  `c_status` varchar(10) DEFAULT 'unread',
  `c_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', '$2y$10$cAO.d41cpMGX1oZ9OHoTe.ajxDkYD0ACeMvNM3SwgV/NnZ4.uuO6m');

-- --------------------------------------------------------

--
-- Table structure for table `about_me`
--

DROP TABLE IF EXISTS `about_me`;
CREATE TABLE IF NOT EXISTS `about_me` (
  `id` int NOT NULL AUTO_INCREMENT,
  `photo_path` varchar(255) DEFAULT 'images/elham.png',
  `strong_name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `bio_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Seeding data for table `about_me`
--

INSERT INTO `about_me` (`photo_path`, `strong_name`, `title`, `bio_text`) VALUES
('images/elham.png', 'Elham Abdillahi', 'Software Developer', 'Hello! I\'m Elham Abdillahi, a passionate and detail-oriented Software Developer and a student of Computer Science. I love working on full-stack development, database design, and learning modern toolchains to solve real-world problems. I\'m currently advancing my skills in PHP, Java, and JavaScript. Outside of code, I enjoy leading student tech initiatives as an Innovation Club Coordinator, reading, and participating in global open-source developer communities.');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Seeding data for table `skills`
--

INSERT INTO `skills` (`name`, `icon`, `category`) VALUES
('PHP', '🐘', 'backend'),
('MySQL / SQL', '💾', 'backend'),
('Java', '☕', 'languages'),
('JavaScript', '🌐', 'languages'),
('HTML & CSS', '🎨', 'frontend'),
('MS Excel', '📊', 'frontend');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT 'images/portfolio.png',
  `link_url` varchar(255) DEFAULT '#',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Seeding data for table `projects`
--

INSERT INTO `projects` (`title`, `description`, `image_path`, `link_url`) VALUES
('spftrack', 'A web application built using HTML, CSS, SQL and PHP to display learning management systems and track academic indicators.', 'images/spftrack', '#'),
('My Personal Portfolio', 'A premium professional developer portfolio built with semantic HTML5, glassmorphic CSS3, AJAX, PHP, and MySQL backend dashboard features.', 'images/portfolio.png', 'index.php');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
CREATE TABLE IF NOT EXISTS `education` (
  `id` int NOT NULL AUTO_INCREMENT,
  `degree` varchar(150) NOT NULL,
  `institution` varchar(150) NOT NULL,
  `period` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Seeding data for table `education`
--

INSERT INTO `education` (`degree`, `institution`, `period`, `description`) VALUES
('Bachelor of Science in Computer Science', 'International University of East Africa', '2023 – Present', 'Studying algorithms, data structures, software engineering methodologies, databases, and core application architectures.');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(150) NOT NULL,
  `organization` varchar(150) NOT NULL,
  `period` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Seeding data for table `experience`
--

INSERT INTO `experience` (`role`, `organization`, `period`, `description`) VALUES
('Innovation Club Coordinator', 'International University of East Africa', 'Mar 2026 – Present', 'Directing technical workshops, driving hackathons, and fostering innovation among student tech groups.'),
('Web Application Development Intern', 'Razor Tech Company', 'Nov 2025 – Jan 2026', 'Assisted in building custom client-facing interfaces, responsive mockups, and writing PHP server scripts.'),
('Database Design and Management Intern', 'Razor Tech Company', 'Sep 2025 – Nov 2025', 'Modeled relational schemas, wrote database migrations, optimized query index performance, and analyzed database transactions.');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `provider` varchar(150) NOT NULL,
  `period` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT 'images/c1.png',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Seeding data for table `courses`
--

INSERT INTO `courses` (`title`, `provider`, `period`, `description`, `image_path`) VALUES
('SQL and Relational Databases 101', 'Cognitive Class', '2025', 'Acquired strong proficiency in standard SQL operations, structural database concepts, and query optimizations with real-world data.', 'images/c1.png'),
('Introduction to MS Excel', 'Microsoft', '2025', 'Applied advanced spreadsheet calculation modeling, macro operations, data analytics, and reporting structures.', 'images/c2.png'),
('Introduction to Java', 'Sololearn', '2025', 'Mastered core programming fundamentals, object-oriented concepts, logic constructs, and error handling in Java.', 'images/c3.png');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
