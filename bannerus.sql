-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 May 2019, 22:03:39
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bannerus`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courses`
--

CREATE TABLE `courses` (
  `CRN` int(6) NOT NULL,
  `Name` char(100) NOT NULL,
  `Capacity` int(3) DEFAULT NULL,
  `Level` char(2) DEFAULT NULL,
  `Description` varchar(20000) DEFAULT NULL,
  `Term` varchar(20) DEFAULT NULL,
  `Time` varchar(50) DEFAULT NULL,
  `approval_needed` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `courses`
--

INSERT INTO `courses` (`CRN`, `Name`, `Capacity`, `Level`, `Description`, `Term`, `Time`, `approval_needed`) VALUES
(11, 'Literature', 123, 'Un', NULL, NULL, NULL, 0),
(18, 'Computer Architectures', 100, 'Un', NULL, NULL, NULL, 0),
(26, 'Database Systems', 100, 'Un', NULL, NULL, NULL, 0),
(78, 'Network Security', 45, 'Un', NULL, NULL, NULL, 0),
(81, 'Computer Graphics', 45, 'Un', 'This course is an introduction to computer graphics, modeling, animation, and rendering. Topics covered include basic image processing, geometric transformations, geometric modeling of curves and surfaces, animation, 3-D viewing, visibility algorithms, radiosity, ray tracing, shading and volume rendering. Students gain experience by developing their own graphics programs producing simple animations.            \r\n			', '2018-2019', '16:40-17:30', 0),
(89, 'Distributed Systems', 120, 'Un', NULL, NULL, NULL, 0),
(99, 'Compiler Design', 450, 'Un', NULL, NULL, NULL, 0),
(160, 'Machine Learning', 25, 'Un', 'This is an introductory machine learning course that will aim a solid understanding of the fundamental issues in machine learning (overfitting, bias/variance), together with several state-of-art approaches such as decision trees, linear regression, k-nearest neighbor, Bayesian classifiers, neural networks, logistic regression, and classifier combination.             \r\n			', '2018-2019', NULL, 1),
(321, 'Software Engineering', 54, 'Un', NULL, NULL, NULL, 0),
(430, 'Formal Lang & Automata Theory', 20, 'Un', NULL, NULL, NULL, 0),
(720, 'Data Structures', 100, 'Un', NULL, NULL, NULL, 0),
(6708, 'Advanced Security', 2, 'Gr', NULL, NULL, NULL, 0),
(123231, 'Computer Networks', 90, 'Un', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `instructor`
--

CREATE TABLE `instructor` (
  `T_username` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `instructor`
--

INSERT INTO `instructor` (`T_username`) VALUES
('cemal'),
('kamer'),
('levi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ins_course`
--

CREATE TABLE `ins_course` (
  `Course` int(6) NOT NULL,
  `Instructor` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `ins_course`
--

INSERT INTO `ins_course` (`Course`, `Instructor`) VALUES
(11, 'levi'),
(81, 'levi'),
(321, 'cemal'),
(430, 'levi'),
(720, 'cemal'),
(6708, 'levi'),
(123231, 'levi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `people`
--

CREATE TABLE `people` (
  `Username` char(20) NOT NULL,
  `Password` char(50) NOT NULL,
  `Role` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `people`
--

INSERT INTO `people` (`Username`, `Password`, `Role`) VALUES
('admin', 'admin', 'Admin'),
('ataberk', 'ataberk', 'Student'),
('bugra', 'bugra', 'Student'),
('cemal', 'cemal', 'Instructor'),
('kamer', 'kamer', 'Instructor'),
('levi', 'levi', 'Instructor'),
('yavuz', 'yavuz', 'Student');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `prerequisite_of`
--

CREATE TABLE `prerequisite_of` (
  `Prequisite_of` int(6) NOT NULL,
  `Course` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `special_request`
--

CREATE TABLE `special_request` (
  `Course` int(6) NOT NULL,
  `Description` mediumtext,
  `Status` tinyint(4) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `special_request`
--

INSERT INTO `special_request` (`Course`, `Description`, `Status`, `Name`) VALUES
(78, 'I really want to learn security', 1, 'ataberk'),
(81, 'I want to learn network', 1, 'ataberk');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `student`
--

CREATE TABLE `student` (
  `S_username` char(20) NOT NULL,
  `Level` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `student`
--

INSERT INTO `student` (`S_username`, `Level`) VALUES
('ataberk', 'ug'),
('bugra', 'ug'),
('yavuz', 'ug');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stu_course`
--

CREATE TABLE `stu_course` (
  `Course` int(6) NOT NULL,
  `Student` char(20) NOT NULL,
  `Grade` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `stu_course`
--

INSERT INTO `stu_course` (`Course`, `Student`, `Grade`) VALUES
(18, 'yavuz', NULL),
(81, 'ataberk', NULL),
(99, 'ataberk', NULL),
(321, 'ataberk', NULL),
(321, 'bugra', NULL),
(6708, 'ataberk', '50'),
(6708, 'yavuz', NULL);

--
-- Tetikleyiciler `stu_course`
--
DELIMITER $$
CREATE TRIGGER `check_prerequisite` BEFORE INSERT ON `stu_course` FOR EACH ROW BEGIN  
    DECLARE dummy INT;   
    IF EXISTS( SELECT Prequisite_of FROM PREREQUISITE_OF PR 
               WHERE PR.Course = NEW.Course AND
		     NOT EXISTS ( SELECT Course FROM STU_COURSE SC 
                		  WHERE SC.Student = NEW.Student AND SC.Grade IS NOT NULL 				  AND PR.Prequisite_of = SC.Course ) )
    THEN
    SELECT CONCAT('Cant insert course.' )  
    INTO dummy FROM information_schema.tables;
        
    END IF;  
END
$$
DELIMITER ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CRN`);

--
-- Tablo için indeksler `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`T_username`);

--
-- Tablo için indeksler `ins_course`
--
ALTER TABLE `ins_course`
  ADD PRIMARY KEY (`Course`,`Instructor`),
  ADD KEY `Instructor` (`Instructor`);

--
-- Tablo için indeksler `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`Username`);

--
-- Tablo için indeksler `prerequisite_of`
--
ALTER TABLE `prerequisite_of`
  ADD PRIMARY KEY (`Prequisite_of`,`Course`),
  ADD KEY `Course` (`Course`);

--
-- Tablo için indeksler `special_request`
--
ALTER TABLE `special_request`
  ADD PRIMARY KEY (`Course`);

--
-- Tablo için indeksler `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`S_username`);

--
-- Tablo için indeksler `stu_course`
--
ALTER TABLE `stu_course`
  ADD PRIMARY KEY (`Course`,`Student`),
  ADD KEY `Student` (`Student`);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`T_username`) REFERENCES `people` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `ins_course`
--
ALTER TABLE `ins_course`
  ADD CONSTRAINT `ins_course_ibfk_1` FOREIGN KEY (`Course`) REFERENCES `courses` (`CRN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ins_course_ibfk_2` FOREIGN KEY (`Instructor`) REFERENCES `instructor` (`T_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `prerequisite_of`
--
ALTER TABLE `prerequisite_of`
  ADD CONSTRAINT `prerequisite_of_ibfk_1` FOREIGN KEY (`Course`) REFERENCES `courses` (`CRN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prerequisite_of_ibfk_2` FOREIGN KEY (`Prequisite_of`) REFERENCES `courses` (`CRN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `special_request`
--
ALTER TABLE `special_request`
  ADD CONSTRAINT `special_request_ibfk_1` FOREIGN KEY (`Course`) REFERENCES `courses` (`CRN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`S_username`) REFERENCES `people` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `stu_course`
--
ALTER TABLE `stu_course`
  ADD CONSTRAINT `stu_course_ibfk_1` FOREIGN KEY (`Course`) REFERENCES `courses` (`CRN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stu_course_ibfk_2` FOREIGN KEY (`Student`) REFERENCES `student` (`S_username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
