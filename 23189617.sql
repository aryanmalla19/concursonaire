-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 03:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `23189617`
--
CREATE DATABASE IF NOT EXISTS `23189617` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `23189617`;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `options` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `question_id`, `options`, `is_correct`) VALUES
(1, 1, 'H2O', 1),
(2, 1, 'O2', 0),
(3, 1, 'CO2', 0),
(4, 1, 'H2', 0),
(5, 2, 'Mars', 1),
(6, 2, 'Venus', 0),
(7, 2, 'Jupiter', 0),
(8, 2, 'Saturn', 0),
(9, 3, 'Oxygen', 0),
(10, 3, 'Carbon Dioxide', 1),
(11, 3, 'Nitrogen', 0),
(12, 3, 'Hydrogen', 0),
(13, 4, '300,000 km/s', 1),
(14, 4, '150,000 km/s', 0),
(15, 4, '450,000 km/s', 0),
(16, 4, '600,000 km/s', 0),
(17, 5, 'Diamond', 1),
(18, 5, 'Gold', 0),
(19, 5, 'Iron', 0),
(20, 5, 'Quartz', 0),
(21, 6, 'Oxygen', 0),
(22, 6, 'Nitrogen', 1),
(23, 6, 'Carbon Dioxide', 0),
(24, 6, 'Hydrogen', 0),
(25, 7, 'Photosynthesis', 1),
(26, 7, 'Respiration', 0),
(27, 7, 'Digestion', 0),
(28, 7, 'Transpiration', 0),
(29, 8, 'Gravity', 1),
(30, 8, 'Magnetism', 0),
(31, 8, 'Friction', 0),
(32, 8, 'Electricity', 0),
(33, 9, 'Nucleus', 1),
(34, 9, 'Cytoplasm', 0),
(35, 9, 'Cell Membrane', 0),
(36, 9, 'Mitochondria', 0),
(37, 10, 'Mercury', 1),
(38, 10, 'Venus', 0),
(39, 10, 'Earth', 0),
(40, 10, 'Mars', 0),
(81, 11, 'x = 5', 1),
(82, 11, 'x = 10', 0),
(83, 11, 'x = 7', 0),
(84, 11, 'x = 3', 0),
(85, 12, '-cos(x) + C', 0),
(86, 12, 'cos(x) + C', 0),
(87, 12, '-cos(x) - C', 0),
(88, 12, '-cos(x)', 1),
(89, 13, '93√3 sq. units', 1),
(90, 13, '54√3 sq. units', 0),
(91, 13, '27√3 sq. units', 0),
(92, 13, '36√3 sq. units', 0),
(93, 14, '2x + 3', 1),
(94, 14, '2x - 3', 0),
(95, 14, '2x + 1', 0),
(96, 14, '4x - 6', 0),
(97, 15, '5', 1),
(98, 15, '4', 0),
(99, 15, '6', 0),
(100, 15, '3', 0),
(101, 16, 'y = 2x + 1', 0),
(102, 16, 'y = 4x - 5', 0),
(103, 16, 'y = 2x + 5', 0),
(104, 16, 'y = 1.5x + 2', 1),
(105, 17, '6', 1),
(106, 17, '-6', 0),
(107, 17, '3', 0),
(108, 17, '-3', 0),
(109, 18, '4000π cubic units', 1),
(110, 18, '1000π cubic units', 0),
(111, 18, '2000π cubic units', 0),
(112, 18, '8000π cubic units', 0),
(113, 19, 'x² + 3x + C', 0),
(114, 19, 'x² + 3x', 0),
(115, 19, '2x² + 3x + C', 1),
(116, 19, '2x² + 3x', 0),
(117, 20, '21', 1),
(118, 20, '19', 0),
(119, 20, '17', 0),
(120, 20, '23', 0),
(121, 21, 'France', 1),
(122, 21, 'Croatia', 0),
(123, 21, 'Brazil', 0),
(124, 21, 'Germany', 0),
(125, 22, 'Diego Maradona', 0),
(126, 22, 'Cristiano Ronaldo', 0),
(127, 22, 'Lionel Messi', 0),
(128, 22, 'Pele', 1),
(129, 23, 'Manchester United', 0),
(130, 23, 'Bayern Munich', 0),
(131, 23, 'Real Madrid', 1),
(132, 23, 'Barcelona', 0),
(133, 24, 'Robert Lewandowski', 0),
(134, 24, 'Lionel Messi', 1),
(135, 24, 'Cristiano Ronaldo', 0),
(136, 24, 'Jorginho', 0),
(137, 25, 'Brazil', 1),
(138, 25, 'Argentina', 0),
(139, 25, 'Germany', 0),
(140, 25, 'Russia', 0),
(141, 26, 'Kobe Bryant', 0),
(142, 26, 'LeBron James', 1),
(143, 26, 'Michael Jordan', 0),
(144, 26, 'Shaquille O\'Neal', 0),
(145, 27, 'Golden State Warriors', 0),
(146, 27, 'Los Angeles Lakers', 1),
(147, 27, 'Miami Heat', 0),
(148, 27, 'Toronto Raptors', 0),
(149, 28, 'Kareem Abdul-Jabbar', 1),
(150, 28, 'Michael Jordan', 0),
(151, 28, 'LeBron James', 0),
(152, 28, 'Bill Russell', 0),
(153, 29, '1946', 1),
(154, 29, '1956', 0),
(155, 29, '1966', 0),
(156, 29, '1976', 0),
(157, 30, 'Wilt Chamberlain', 1),
(158, 30, 'Michael Jordan', 0),
(159, 30, 'Kobe Bryant', 0),
(160, 30, 'Shaquille O\'Neal', 0),
(161, 31, 'Kareem Abdul-Jabbar', 1),
(162, 31, 'Karl Malone', 0),
(163, 31, 'LeBron James', 0),
(164, 31, 'Michael Jordan', 0),
(165, 32, 'Los Angeles Lakers', 0),
(166, 32, 'Chicago Bulls', 0),
(167, 32, 'Miami Heat', 0),
(168, 32, 'Golden State Warriors', 1),
(169, 33, '1970', 0),
(170, 33, '1976', 1),
(171, 33, '1980', 0),
(172, 33, '1984', 0),
(173, 34, 'Oscar Robertson', 1),
(174, 34, 'Magic Johnson', 0),
(175, 34, 'Wilt Chamberlain', 0),
(176, 34, 'Larry Bird', 0),
(177, 35, 'John Stockton', 1),
(178, 35, 'Magic Johnson', 0),
(179, 35, 'Steve Nash', 0),
(180, 35, 'Jason Kidd', 0),
(181, 36, 'Kobe Bryant', 0),
(182, 36, 'LeBron James', 1),
(183, 36, 'Michael Jordan', 0),
(184, 36, 'Kevin Durant', 0),
(185, 37, 'Dikembe Mutombo', 1),
(186, 37, 'Ben Wallace', 0),
(187, 37, 'Hakeem Olajuwon', 0),
(188, 37, 'Gary Payton', 0),
(189, 38, 'Hakeem Olajuwon', 1),
(190, 38, 'Dirk Nowitzki', 0),
(191, 38, 'Steve Nash', 0),
(192, 38, 'Tim Duncan', 0),
(193, 39, 'Los Angeles Lakers', 0),
(194, 39, 'Chicago Bulls', 0),
(195, 39, 'Boston Celtics', 1),
(196, 39, 'Golden State Warriors', 0),
(197, 40, 'Elgin Baylor', 0),
(198, 40, 'David Thompson', 0),
(199, 40, 'Wilt Chamberlain', 1),
(200, 40, 'Pete Maravich', 0),
(201, 41, 'Prithvi Narayan Shah', 1),
(202, 41, 'Mahendra Malla', 0),
(203, 41, 'Jaya Prakash Malla', 0),
(204, 41, 'Ranajit Malla', 0),
(205, 42, '1815', 0),
(206, 42, '1816', 1),
(207, 42, '1817', 0),
(208, 42, '1818', 0),
(209, 43, 'Dravya Shah', 1),
(210, 43, 'Ram Shah', 0),
(211, 43, 'Narendra Shah', 0),
(212, 43, 'Prithvi Narayan Shah', 0),
(213, 44, '1200 AD', 0),
(214, 44, '1260 AD', 0),
(215, 44, '1300 AD', 1),
(216, 44, '1350 AD', 0),
(217, 45, 'Jung Bahadur Rana', 1),
(218, 45, 'Chandra Shamsher JBR', 0),
(219, 45, 'Mohan Shamsher JBR', 0),
(220, 45, 'Dev Shamsher JBR', 0),
(221, 46, 'Battle of Kirtipur', 0),
(222, 46, 'Treaty of Sugauli', 0),
(223, 46, 'Kot Massacre', 1),
(224, 46, 'Anglo-Nepalese War', 0),
(225, 47, '1950', 1),
(226, 47, '1951', 0),
(227, 47, '1952', 0),
(228, 47, '1953', 0),
(229, 48, 'B.P. Koirala', 0),
(230, 48, 'Ganesh Man Singh', 0),
(231, 48, 'Jung Bahadur Rana', 1),
(232, 48, 'King Mahendra', 0),
(233, 49, '1948', 0),
(234, 49, '1950', 0),
(235, 49, '1955', 1),
(236, 49, '1960', 0),
(237, 50, 'King Gyanendra', 1),
(238, 50, 'King Birendra', 0),
(239, 50, 'King Dipendra', 0),
(240, 50, 'King Tribhuvan', 0),
(301, 51, 'Sachin Tendulkar', 1),
(302, 51, 'Brian Lara', 0),
(303, 51, 'Ricky Ponting', 0),
(304, 51, 'Jacques Kallis', 0),
(305, 52, 'Australia', 0),
(306, 52, 'West Indies', 1),
(307, 52, 'England', 0),
(308, 52, 'India', 0),
(309, 53, 'Muttiah Muralitharan', 1),
(310, 53, 'Shane Warne', 0),
(311, 53, 'Wasim Akram', 0),
(312, 53, 'Glenn McGrath', 0),
(313, 54, '2005', 0),
(314, 54, '2006', 0),
(315, 54, '2003', 0),
(316, 54, '2004', 1),
(317, 55, 'Mumbai Indians', 1),
(318, 55, 'Chennai Super Kings', 0),
(319, 55, 'Kolkata Knight Riders', 0),
(320, 55, 'Sunrisers Hyderabad', 0),
(321, 56, 'Sachin Tendulkar', 0),
(322, 56, 'Virender Sehwag', 1),
(323, 56, 'Chris Gayle', 0),
(324, 56, 'Rohit Sharma', 0),
(325, 57, 'Sachin Tendulkar', 1),
(326, 57, 'Brian Lara', 0),
(327, 57, 'Viv Richards', 0),
(328, 57, 'Ricky Ponting', 0),
(329, 58, 'Sunil Gavaskar', 0),
(330, 58, 'Kapil Dev', 1),
(331, 58, 'Mohammad Azharuddin', 0),
(332, 58, 'Ravi Shastri', 0),
(333, 59, 'Lord\'s Cricket Ground', 1),
(334, 59, 'Eden Gardens', 0),
(335, 59, 'Melbourne Cricket Ground', 0),
(336, 59, 'The Oval', 0),
(337, 60, 'AB de Villiers', 0),
(338, 60, 'Chris Gayle', 1),
(339, 60, 'Shahid Afridi', 0),
(340, 60, 'Virat Kohli', 0),
(341, 61, 'Sydney', 0),
(342, 61, 'Melbourne', 0),
(343, 61, 'Canberra', 1),
(344, 61, 'Brisbane', 0),
(345, 62, 'Kangaroo', 1),
(346, 62, 'Koala', 0),
(347, 62, 'Emu', 1),
(348, 62, 'Platypus', 0),
(349, 63, 'New South Wales', 0),
(350, 63, 'Queensland', 0),
(351, 63, 'Western Australia', 1),
(352, 63, 'Victoria', 0),
(353, 64, 'James Cook', 0),
(354, 64, 'Abel Tasman', 1),
(355, 64, 'Christopher Columbus', 0),
(356, 64, 'Ferdinand Magellan', 0),
(357, 65, 'Sydney', 1),
(358, 65, 'Melbourne', 0),
(359, 65, 'Perth', 0),
(360, 65, 'Adelaide', 0),
(361, 66, 'Koala', 0),
(362, 66, 'Dingo', 1),
(363, 66, 'Wombat', 0),
(364, 66, 'Kangaroo', 0),
(365, 67, 'Coral Sea', 0),
(366, 67, 'Great Barrier Reef', 1),
(367, 67, 'Tasman Reef', 0),
(368, 67, 'Ningaloo Reef', 0),
(369, 68, '1901', 1),
(370, 68, '1910', 0),
(371, 68, '1931', 0),
(372, 68, '1945', 0),
(373, 69, 'Didgeridoo', 1),
(374, 69, 'Boomerang', 0),
(375, 69, 'Yidaki', 1),
(376, 69, 'Garma', 0),
(377, 70, 'Uluru', 1),
(378, 70, 'Mount Kosciuszko', 0),
(379, 70, 'Great Dividing Range', 0),
(380, 70, 'Blue Mountains', 0),
(381, 71, 'Sad', 0),
(382, 71, 'Angry', 0),
(383, 71, 'Joyful', 1),
(384, 71, 'Fearful', 0),
(385, 72, 'William Wordsworth', 0),
(386, 72, 'William Shakespeare', 1),
(387, 72, 'John Milton', 0),
(388, 72, 'Charles Dickens', 0),
(389, 73, 'She don\'t like apples.', 0),
(390, 73, 'She doesn\'t likes apples.', 0),
(391, 73, 'She doesn\'t like apples.', 1),
(392, 73, 'She not likes apples.', 0),
(393, 74, 'Run', 0),
(394, 74, 'Ran', 1),
(395, 74, 'Runned', 0),
(396, 74, 'Running', 0),
(397, 75, 'Easy', 1),
(398, 75, 'Tough', 0),
(399, 75, 'Hard', 0),
(400, 75, 'Complicated', 0),
(401, 76, 'Simile', 0),
(402, 76, 'Metaphor', 1),
(403, 76, 'Personification', 0),
(404, 76, 'Hyperbole', 0),
(405, 77, 'A Midsummer Night\'s Dream', 0),
(406, 77, 'Hamlet', 1),
(407, 77, 'The Tempest', 0),
(408, 77, 'Twelfth Night', 0),
(409, 78, 'Childs', 0),
(410, 78, 'Children', 1),
(411, 78, 'Childes', 0),
(412, 78, 'Childrens', 0),
(413, 79, 'Thoughts', 1),
(414, 79, 'Words', 0),
(415, 79, 'Mind', 0),
(416, 79, 'Ideas', 0),
(417, 80, 'Love', 0),
(418, 80, 'Freedom', 0),
(419, 80, 'Totalitarianism', 1),
(420, 80, 'Adventure', 0),
(421, 81, 'O(n)', 0),
(422, 81, 'O(log n)', 1),
(423, 81, 'O(n^2)', 0),
(424, 81, 'O(1)', 0),
(425, 82, 'Array', 1),
(426, 82, 'Tree', 0),
(427, 82, 'Graph', 0),
(428, 82, 'Hash Table', 0),
(429, 83, 'Charles Babbage', 0),
(430, 83, 'Alan Turing', 1),
(431, 83, 'John von Neumann', 0),
(432, 83, 'Bill Gates', 0),
(433, 84, 'Structured Query Language', 1),
(434, 84, 'Simple Query Language', 0),
(435, 84, 'Sequential Query Language', 0),
(436, 84, 'Standard Query Language', 0),
(437, 85, 'Bubble Sort', 0),
(438, 85, 'Quick Sort', 1),
(439, 85, 'Insertion Sort', 0),
(440, 85, 'Selection Sort', 0),
(441, 86, 'To compile programs', 0),
(442, 86, 'To manage hardware resources', 1),
(443, 86, 'To manage databases', 0),
(444, 86, 'To provide internet access', 0),
(445, 87, 'Python', 0),
(446, 87, 'JavaScript', 0),
(447, 87, 'HTML', 1),
(448, 87, 'Java', 0),
(449, 88, 'The condition that ends the recursion', 1),
(450, 88, 'The first function call', 0),
(451, 88, 'The last function call', 0),
(452, 88, 'An infinite loop', 0),
(453, 89, 'HyperText Transfer Protocol', 1),
(454, 89, 'Hyperlink Transfer Protocol', 0),
(455, 89, 'HyperTransfer Text Protocol', 0),
(456, 89, 'Hyperlink Text Transfer Protocol', 0),
(457, 90, 'Queue', 0),
(458, 90, 'Stack', 1),
(459, 90, 'Array', 0),
(460, 90, 'Tree', 0),
(461, 91, 'MySQL', 0),
(462, 91, 'MongoDB', 1),
(463, 91, 'PostgreSQL', 0),
(464, 91, 'SQLite', 0),
(465, 92, 'The ability to take many forms', 1),
(466, 92, 'The ability to inherit from a superclass', 0),
(467, 92, 'The ability to override methods', 0),
(468, 92, 'The ability to access private variables', 0),
(469, 93, 'Python', 0),
(470, 93, 'Java', 1),
(471, 93, 'JavaScript', 0),
(472, 93, 'Ruby', 0),
(473, 94, 'To convert IP addresses to domain names', 0),
(474, 94, 'To convert domain names to IP addresses', 1),
(475, 94, 'To store email addresses', 0),
(476, 94, 'To host websites', 0),
(477, 95, '1000', 0),
(478, 95, '1010', 1),
(479, 95, '1100', 0),
(480, 95, '1110', 0),
(481, 96, 'FTP', 0),
(482, 96, 'SMTP', 0),
(483, 96, 'SSL/TLS', 1),
(484, 96, 'HTTP', 0),
(485, 97, 'Random Access Memory', 1),
(486, 97, 'Read Access Memory', 0),
(487, 97, 'Rapid Access Memory', 0),
(488, 97, 'Readily Available Memory', 0),
(489, 98, 'Git', 1),
(490, 98, 'Docker', 0),
(491, 98, 'Jenkins', 0),
(492, 98, 'Kubernetes', 0),
(493, 99, 'Faster access time', 0),
(494, 99, 'Dynamic memory allocation', 1),
(495, 99, 'Fixed size', 0),
(496, 99, 'Sequential access', 0),
(497, 100, '192.168.0.256', 0),
(498, 100, '192.168.1.1', 1),
(499, 100, '256.256.256.256', 0),
(500, 100, '123.456.789.0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attempt`
--

CREATE TABLE `attempt` (
  `quiz_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attempt`
--

INSERT INTO `attempt` (`quiz_id`, `student_id`, `marks`, `created_at`, `id`) VALUES
(3, 3, 5, '2024-06-17 15:35:23', 19),
(3, 4, 4, '2024-06-19 17:01:42', 23),
(2, 4, 2, '2024-06-20 14:19:36', 24),
(8, 4, 2, '2024-06-20 17:54:00', 25),
(10, 4, 13, '2024-06-20 18:06:50', 26),
(3, 21, 3, '2024-06-21 16:28:38', 27),
(2, 23, 2, '2024-06-22 11:01:53', 28),
(7, 23, 1, '2024-06-22 11:06:45', 29),
(8, 23, 2, '2024-06-22 11:11:24', 30);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `likes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`user_id`, `quiz_id`, `text`, `likes`, `created_at`, `id`) VALUES
(3, 1, 'This is a very good quizzzzz !!!!', 0, '2024-06-08 16:58:00', 1),
(4, 1, 'This quiz has helped me a lot in my science exam !!!', 0, '2024-06-09 09:56:04', 2),
(4, 2, 'This is a very good quiz.', 0, '2024-06-09 10:50:40', 4),
(4, 3, 'Good', 0, '2024-06-17 15:33:05', 12),
(21, 3, 'This is very good quiz', 0, '2024-06-21 16:27:25', 15),
(23, 2, 'I\'m very excited to try this quiz !\r\n', 0, '2024-06-22 10:39:07', 16),
(23, 7, 'good', 0, '2024-06-22 11:06:00', 18),
(23, 8, 'Australia is my fav country and i loved this quiz. Thank you sir !\r\n', 0, '2024-06-22 11:10:52', 19);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Bibek Sapkota', 'saps@gmail.com', '9877654567', 'Hello World', '2024-06-22 07:17:02'),
(2, 'aryan', 'aryanmalla19@gmail.com', '987', 'meow', '2024-06-22 07:17:02'),
(3, 'aryan', 'aryanmalla19@gmail.com', '987', 'meow', '2024-06-22 07:17:02'),
(4, 'bro', 'bro@bro.com', '876543', 'bro\r\n', '2024-06-22 07:20:11'),
(5, 'Pranj Rai', 'pranjrai@gmail.com', '9867654121', 'good website admin sir !', '2024-06-22 11:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `questionText` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `quiz_id`, `questionText`) VALUES
(1, 1, 'What is the chemical symbol for water?'),
(2, 1, 'What planet is known as the Red Planet?'),
(3, 1, 'What gas do plants absorb from the atmosphere?'),
(4, 1, 'What is the speed of light?'),
(5, 1, 'What is the hardest natural substance on Earth?'),
(6, 1, 'What is the main gas found in the air we breathe?'),
(7, 1, 'What is the process by which plants make their food?'),
(8, 1, 'What force keeps us on the ground?'),
(9, 1, 'What part of the cell contains genetic material?'),
(10, 1, 'What planet is closest to the Sun?'),
(11, 2, 'Solve for x: 2x + 5 = 15.'),
(12, 2, 'What is the integral of sin(x) dx?'),
(13, 2, 'Calculate the area of a regular hexagon with a side length of 6 units.'),
(14, 2, 'Simplify the expression: (4x^2 + 9) / (2x + 3).'),
(15, 2, 'What is the value of log₂(32)?'),
(16, 2, 'Find the equation of the line passing through points (2, 3) and (5, 7).'),
(17, 2, 'What is the sum of the roots of the quadratic equation x² - 6x + 9 = 0?'),
(18, 2, 'Calculate the volume of a sphere with radius 10 units.'),
(19, 2, 'Solve the differential equation: dy/dx = 2x + 3.'),
(20, 2, 'If f(x) = 3x² + 5x + 2, what is f(2)?'),
(21, 3, 'Which country won the FIFA World Cup in 2018?'),
(22, 3, 'Who is known as the King of Football?'),
(23, 3, 'Which club has won the most UEFA Champions League titles?'),
(24, 3, 'Who won the Ballon d\'Or in 2021?'),
(25, 3, 'Which country hosted the 2014 FIFA World Cup?'),
(26, 4, 'Which player is known as \"The King\"?'),
(27, 4, 'Which team won the NBA Championship in 2020?'),
(28, 4, 'Who has the most NBA MVP awards?'),
(29, 4, 'What year was the NBA founded?'),
(30, 4, 'Which player scored 100 points in a single game?'),
(31, 5, 'Which player has the most career points in NBA history?'),
(32, 5, 'Which team holds the record for the longest winning streak in NBA history?'),
(33, 5, 'In what year did the NBA-ABA merger occur?'),
(34, 5, 'Who was the first player to record a triple-double in an NBA game?'),
(35, 5, 'Which player has the most career assists in NBA history?'),
(36, 5, 'Who was the youngest player to score 10,000 points in the NBA?'),
(37, 5, 'Which player won the most NBA Defensive Player of the Year awards?'),
(38, 5, 'Who was the first non-American player to win the NBA MVP award?'),
(39, 5, 'Which NBA team has the most championship titles?'),
(40, 5, 'Who was the first player to score 70 points in a single NBA game?'),
(41, 6, 'Who was the first King of unified Nepal?'),
(42, 6, 'In which year was the Treaty of Sugauli signed?'),
(43, 6, 'Who was the founder of the Gorkha Kingdom?'),
(44, 6, 'Which year marks the beginning of the Malla Dynasty in Kathmandu Valley?'),
(45, 6, 'Who was the Prime Minister of Nepal during the Kot Massacre?'),
(46, 6, 'Which historical event led to the establishment of the Rana regime?'),
(47, 6, 'When did King Tribhuvan return to Nepal ending the Rana rule?'),
(48, 6, 'Who is known as the \"Iron Man\" of Nepal?'),
(49, 6, 'Which year did Nepal become a member of the United Nations?'),
(50, 6, 'Who was the last monarch of Nepal?'),
(51, 7, 'Who is the highest run-scorer in Test cricket?'),
(52, 7, 'Which country won the first ICC Cricket World Cup in 1975?'),
(53, 7, 'Who has the most wickets in ODI cricket?'),
(54, 7, 'In which year did T20 cricket make its debut?'),
(55, 7, 'Which team has won the most IPL titles?'),
(56, 7, 'Who was the first cricketer to score a double century in ODI cricket?'),
(57, 7, 'Which cricketer is known as the \"Master Blaster\"?'),
(58, 7, 'Who was the captain of the Indian cricket team that won the 1983 World Cup?'),
(59, 7, 'Which cricket ground is known as the \"Home of Cricket\"?'),
(60, 7, 'Which cricketer holds the record for the fastest century in ODI cricket?'),
(61, 8, 'What is the capital city of Australia?'),
(62, 8, 'Which animal is found on the Australian coat of arms?'),
(63, 8, 'What is the largest state in Australia by area?'),
(64, 8, 'Who was the first European to discover Australia?'),
(65, 8, 'Which Australian city is famous for its Opera House and Harbour Bridge?'),
(66, 8, 'What is the native Australian dog called?'),
(67, 8, 'Which reef system is located off the coast of Queensland, Australia?'),
(68, 8, 'In which year did Australia gain independence from Britain?'),
(69, 8, 'What is the traditional Aboriginal instrument known for its unique sound?'),
(70, 8, 'Which Australian landmark is considered one of the world’s largest monoliths?'),
(71, 9, 'What is the synonym of \"happy\"?'),
(72, 9, 'Who wrote the play \"Romeo and Juliet\"?'),
(73, 9, 'Which sentence is grammatically correct?'),
(74, 9, 'What is the past tense of \"run\"?'),
(75, 9, 'What is the antonym of \"difficult\"?'),
(76, 9, 'Identify the figure of speech: \"The world is a stage.\"'),
(77, 9, 'Which of the following is a Shakespearean tragedy?'),
(78, 9, 'What is the plural form of \"child\"?'),
(79, 9, 'Complete the idiom: \"A penny for your _____.\"'),
(80, 9, 'What is the main theme of George Orwell\'s \"1984\"?'),
(81, 10, 'What is the time complexity of binary search?'),
(82, 10, 'Which of the following is a linear data structure?'),
(83, 10, 'Who is known as the father of computer science?'),
(84, 10, 'What does SQL stand for?'),
(85, 10, 'Which sorting algorithm is the fastest in the average case scenario?'),
(86, 10, 'What is the primary function of an operating system?'),
(87, 10, 'Which of the following is not a programming language?'),
(88, 10, 'What is the value of the base case in a recursive function?'),
(89, 10, 'What does HTTP stand for?'),
(90, 10, 'Which data structure is used for implementing LIFO?'),
(91, 10, 'Which of the following is a NoSQL database?'),
(92, 10, 'What is polymorphism in object-oriented programming?'),
(93, 10, 'Which of the following is an example of a compiled language?'),
(94, 10, 'What is the main purpose of DNS?'),
(95, 10, 'What is the binary equivalent of the decimal number 10?'),
(96, 10, 'Which protocol is used for secure communication over the Internet?'),
(97, 10, 'What does RAM stand for?'),
(98, 10, 'Which of the following is a version control system?'),
(99, 10, 'What is the main advantage of using a linked list over an array?'),
(100, 10, 'Which of the following is a valid IPv4 address?');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `level` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `title`, `user_id`, `subject`, `level`, `created_at`, `updated_at`, `description`) VALUES
(1, 'Science Quiz', 1, 'Science', 1, '2023-01-01 04:15:00', '2024-06-21 17:00:54', 'This is science quiz. School level students are highly recommended for this quiz.'),
(2, 'Advanced Math Quiz', 1, 'Maths', 3, '2023-01-01 04:15:00', '2024-06-21 17:03:39', 'This is a quiz'),
(3, 'Football Quiz', 1, 'Sports', 1, '2024-06-17 14:25:34', '2024-06-17 14:25:34', 'This quiz tests your knowledge of football.'),
(4, 'Basketball Quiz', 1, 'Sports', 2, '2024-06-17 14:31:18', '2024-06-17 14:31:18', 'This quiz tests your knowledge of basketball.'),
(5, 'Advanced Basketball Quiz', 1, 'Sports', 4, '2024-06-17 14:45:58', '2024-06-17 14:45:58', 'This quiz tests your advanced knowledge of basketball.'),
(6, 'Advanced History of Nepal Quiz', 20, 'History', 5, '2024-06-20 17:45:36', '2024-06-20 17:45:36', 'This quiz tests your advanced knowledge of the history of Nepal.'),
(7, 'Cricket Knowledge Quiz', 20, 'Sports', 3, '2024-06-20 17:47:38', '2024-06-20 17:47:38', 'This quiz tests your knowledge of cricket.'),
(8, 'Australia Knowledge Quiz', 20, 'Geography', 3, '2024-06-20 17:51:14', '2024-06-20 17:51:14', 'This quiz tests your knowledge of Australia, covering geography, history, culture, and more.'),
(9, 'English Language Quiz', 20, 'English', 3, '2024-06-20 17:56:46', '2024-06-20 17:56:46', 'This quiz tests your knowledge of the English language, including grammar, vocabulary, literature, and more.'),
(10, 'Computer Science Quiz', 20, 'Computer Science', 5, '2024-06-20 18:01:00', '2024-06-20 18:01:00', 'This quiz tests your knowledge of various computer science topics including algorithms, data structures, programming languages, and more.');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `rating` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`user_id`, `quiz_id`, `text`, `rating`, `created_at`) VALUES
(4, 1, 'Need more question sir !', 5, '2024-06-16 18:21:47'),
(4, 2, 'Good', 3, '2024-06-16 18:24:31'),
(4, 3, 'Good quiz', 1, '2024-06-17 14:27:24'),
(3, 3, 'This quiz was very awesome', 1, '2024-06-17 15:35:59'),
(4, 2, 'i failed this quiz but it was good !!\r\n', 1, '2024-06-20 14:20:25'),
(4, 8, 'good\r\n', 1, '2024-06-20 17:55:30'),
(23, 2, 'awesome sir', 1, '2024-06-22 11:02:10'),
(23, 7, 'damnn good\r\n', 5, '2024-06-22 11:06:58'),
(23, 7, 'damnn good\r\n', 5, '2024-06-22 11:06:59'),
(23, 8, '5 Star quiz. No doubt', 5, '2024-06-22 11:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_num` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pet_name` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_num`, `username`, `role`, `age`, `password`, `created_at`, `pet_name`) VALUES
(1, 'Aryan Malla', 'aryanmalla19@gmail.com', '9869723240', 'kbk', 'teacher', 20, '$2y$10$IC25VrFWNTC1c2SbAtF/J.tYB6zu0zXAMvQJ4XIw3RV4DBUSqukbu', '2024-06-19 06:20:09', 'suntali'),
(3, 'Krishu Karki', 'kreeshukarki1234@gmail.com', '9876543345', 'Kaykayy', 'student', 19, '$2y$10$D70d4FlZ2roOdPPwQ9Rk0.TrppO5uyP6E4Jfj9h/86Z7Pwk83IHga', '2024-06-19 06:20:09', 'pup'),
(4, 'Bibek Sapkota', 'saps@gmail.com', '9877654567', 'saps', 'student', 20, '$2y$10$OLSaK4GPcnDS97LSUYdyEeC4j/m11kblxiYfvveDFa8y7lYADZYlS', '2024-06-19 06:20:09', 'leo'),
(5, 'Nafisha', 'nafu@gmail.com', '9877654323', 'nafu', 'student', 19, '$2y$10$nvdS8oYZnsm.CmJ/65xjVeBdmJkUp79C6qNID1tD5q.EFM7v/KFre', '2024-06-19 06:20:09', 'simba'),
(12, 'Aryan Malla', 'admin@gmail.com', '9869723243', 'admin', 'admin', 21, '$2y$10$H1DIvHxRTLppgzDB5MC.3eD./d5WRaNRlYLAolH0jY5jVF4I6Zw1e', '2024-06-19 06:20:09', 'rocky'),
(20, 'Ayush Malla', 'ayushmalla@gmail.com', '982465433', 'iush_brook', 'teacher', 20, '$2y$10$5y7afX.GhmAaP4mR/iZuiuTqCbYc0mBYEQMZSdIMnlBu/gjs3HU3C', '2024-06-20 05:02:45', 'micky'),
(21, 'Solomon Silwal', 'silwalsolomon@gmail.com', '9869374141', 'solo', 'student', 20, '$2y$10$tChlepZiC4R4epCn6H81Wuhc2.kKoWvS3w3tQvWj56uW6ZA6/p/ru', '2024-06-21 16:25:36', 'tiny'),
(23, 'Pranj Rai', 'pranjrai@gmail.com', '9867654121', 'pranj_891', 'student', 20, '$2y$10$P//xYef2UbzGqpw.C11/9O7nTtvW2WfKyvDZCIbnbGZa6rCTyisu6', '2024-06-22 10:38:02', 'tommy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `attempt`
--
ALTER TABLE `attempt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_num` (`phone_num`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `attempt`
--
ALTER TABLE `attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Constraints for table `attempt`
--
ALTER TABLE `attempt`
  ADD CONSTRAINT `attempt_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`),
  ADD CONSTRAINT `attempt_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
