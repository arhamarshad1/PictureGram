/*
Arham Arshad
B00768939
CSCI 2170
Lab 3
*/

/*
The following code creates a database Picturegram and inserts values into the database
*/

-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 01, 2020 at 12:51 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `PictureGram`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `CommentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`CommentID`, `UserID`, `PostID`, `Comment`, `Date`) VALUES
(1, 1, 1, 'Aenean cursus scelerisque iaculis. Vivamus enim sem, pharetra placerat vulputate pellentesque, ornare in velit. Donec sollicitudin pharetra fringilla. Duis pretium malesuada nisi. Vivamus at varius lectus. Praesent est sem, lobortis nec dui et, efficitur aliquet metus. Quisque pharetra vulputate turpis a sagittis. ', '2020-11-01 00:48:08'),
(2, 1, 1, 'Nnon ullamcorper ante. Nulla aliquam volutpat ligula, vel pretium arcu interdum vel. Nam id varius nisi, ut fringilla diam. Vestibulum congue ultricies nisl eget malesuada. Donec eget dapibus tortor. \r\n', '2020-11-01 00:48:08'),
(3, 1, 1, 'Cras sagittis arcu orci, ut vestibulum neque ornare id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eu leo vitae velit consequat consectetur a eu est.  ', '2020-11-01 00:48:08'),
(4, 1, 2, 'Strange, wonder how they got there??!', '2020-11-01 00:48:08'),
(5, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing!! ', '2020-11-01 00:48:08'),
(6, 1, 2, 'Vivamus volutpat viverra ultrices. Pellentesque porta scelerisque auctor. Sed luctus, massa nec luctus fringilla, urna diam semper turpis, a cursus massa ligula vitae mi.', '2020-11-01 00:48:08'),
(7, 1, 3, 'Donec eu leo vitae velit consequat consectetur a eu est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean laoreet tortor eros, sed pretium mi lacinia ut. Nunc imperdiet velit quam, quis aliquet augue imperdiet vel.\r\n', '2020-11-01 00:48:08'),
(8, 1, 3, 'Is this a winery?', '2020-11-01 00:48:08'),
(9, 1, 3, 'What a view!!', '2020-11-01 00:48:08'),
(10, 1, 4, 'Nostra, per inceptos himenaeos. Aenean laoreet tortor eros, sed pretium mi lacinia ut. Nunc imperdiet velit quam, quis aliquet augue imperdiet vel.', '2020-11-01 00:48:08'),
(11, 1, 4, 'In id risus justo. Aenean id elementum justo. Fusce rutrum ligula a ligula fermentum dapibus. Nunc non libero tincidunt leo lacinia blandit quis vel elit.', '2020-11-01 00:48:08'),
(12, 1, 4, 'Looks like you\'re on the ferry!', '2020-11-01 00:48:08'),
(13, 1, 5, 'Venenatis vitae, tincidunt id nisi. Sed ipsum velit, sodales nec ultricies eget, sagittis eget lorem. Nam in congue nulla.', '2020-11-01 00:48:08'),
(14, 1, 5, 'Gotta love fresh veggies!', '2020-11-01 00:48:08'),
(15, 1, 1, 'wow!!', '2020-11-01 00:48:08'),
(16, 1, 1, 'What a sunset!!', '2020-11-01 00:48:08'),
(17, 1, 5, 'So pretty', '2020-11-01 00:48:08'),
(18, 1, 1, 'Nice!', '2020-11-01 00:48:08'),
(19, 1, 2, 'Pretty!', '2020-11-01 00:48:08'),
(20, 1, 2, 'How do they grow like that!?', '2020-11-01 00:48:08'),
(21, 1, 2, 'How do they do that?', '2020-11-01 00:50:32'),
(22, 1, 2, 'How do they do that?', '2020-11-01 00:50:32'),
(23, 1, 2, 'Nice photo!', '2020-11-01 00:50:32'),
(24, 1, 2, 'Nice photo!', '2020-11-01 00:50:32'),
(25, 1, 5, 'Nice farm!', '2020-11-01 00:50:32'),
(26, 1, 3, 'Looks hot there!', '2020-11-01 00:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PostImage` varchar(50) NOT NULL,
  `Post` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`PostID`, `UserID`, `PostImage`, `Post`, `Date`) VALUES
(1, 1, 'sunset.jpg', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.', '2020-11-01 00:34:55'),
(2, 1, 'poppies.jpg', 'Pellentesque pellentesque hendrerit rhoncus. Curabitur quis elementum lorem, finibus molestie.', '2020-11-01 00:34:55'),
(3, 1, 'valley1.jpg', 'Fusce libero ligula, feugiat sit. Ut non tincidunt odio, a.', '2020-11-01 00:34:55'),
(4, 1, 'cityscape.jpg', 'Quisque consequat tellus diam, ut.Vestibulum non purus magna. Nam varius, justo dignissim dapibus sollicitudin.', '2020-11-01 00:34:55'),
(5, 1, 'farm.jpg', 'Lorem ipsum dolor sit amet. Fusce ac nisi quis.', '2020-11-01 00:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `About` text NOT NULL,
  `AboutImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Name`, `About`, `AboutImage`) VALUES
(1, 'Lorrem Nullam', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque id varius magna, scelerisque aliquet odio. Fusce vel scelerisque felis, a facilisis felis. Donec pharetra lacus nulla, vel lobortis turpis convallis porttitor. Quisque vehicula ut purus ac venenatis. Phasellus pharetra sit amet tellus sit amet accumsan. Vivamus in faucibus metus. Proin et tellus luctus ipsum finibus posuere. In vulputate urna orci, vel tristique quam ornare eget. Etiam eget odio felis. Vestibulum a eros eleifend, bibendum dui nec, tristique quam. Phasellus molestie ex ac ipsum posuere, sit amet pellentesque orci vulputate. Proin posuere augue at turpis tincidunt venenatis.\r\n\r\nIn id ante laoreet, interdum ex sed, varius nunc. Etiam ut felis congue lacus imperdiet egestas quis in odio. Nam rhoncus purus enim, a pharetra urna hendrerit vel. Morbi laoreet et mauris quis egestas. Vivamus euismod quam a nisi accumsan volutpat. Pellentesque dui diam, consequat nec consequat nec, ultrices quis tellus. Sed aliquam luctus nisl non lacinia. Etiam faucibus magna et tincidunt fringilla. Nulla sed justo pulvinar, porta mi vel, ornare nisi. Maecenas sit amet cursus justo. Proin lacinia neque urna.', 'dal-about.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PostID` (`PostID`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`PostID`) REFERENCES `Post` (`PostID`);

--
-- Constraints for table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);