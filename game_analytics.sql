-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 11:03 AM
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
-- Database: `game_analytics`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

CREATE TABLE `achievement` (
  `AchievementID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `AchievementName` varchar(100) NOT NULL,
  `DateEarned` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`AchievementID`, `PlayerID`, `AchievementName`, `DateEarned`) VALUES
(1, 1, 'Top Scorer', '2024-01-12'),
(2, 2, 'MVP Award', '2024-01-15'),
(3, 3, 'Hat Trick Hero', '2024-01-20'),
(4, 4, 'Assist King', '2024-01-25'),
(5, 5, 'Clean Sheet', '2024-02-01'),
(6, 6, 'First Blood', '2024-02-07'),
(7, 7, 'Sharp Shooter', '2024-02-13'),
(8, 8, 'Clutch Player', '2024-02-18'),
(9, 9, 'Iron Wall', '2024-02-22'),
(10, 10, 'Marathon Runner', '2024-03-01'),
(11, 11, 'Game Changer', '2024-03-06'),
(12, 12, 'Captain Leader Legend', '2024-03-12'),
(13, 13, 'Speed Demon', '2024-03-17'),
(14, 14, 'Defensive Beast', '2024-03-23'),
(15, 15, 'Midfield Maestro', '2024-03-29'),
(16, 16, 'Golden Boot', '2024-04-03'),
(17, 17, 'Rising Star', '2024-04-09'),
(18, 18, 'Power Header', '2024-04-15'),
(19, 19, 'Deadly Finisher', '2024-04-20'),
(20, 20, 'Ultimate Player', '2024-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `CoachID` int(11) NOT NULL,
  `CoachName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`CoachID`, `CoachName`) VALUES
(6, 'Angela Wright'),
(13, 'Brian Reed'),
(18, 'Chloe Burns'),
(11, 'Daniel Perez'),
(10, 'Emily Scott'),
(16, 'Grace Yang'),
(5, 'James Morris'),
(9, 'Jason Ford'),
(3, 'Kevin Brooks'),
(4, 'Laura Kim'),
(19, 'Marcus Knight'),
(1, 'Michael Hart'),
(17, 'Nathan Diaz'),
(20, 'Nina Patel'),
(14, 'Olivia Moore'),
(7, 'Peter Chen'),
(8, 'Rachel Adams'),
(2, 'Sandra Lee'),
(15, 'Steven Blake'),
(12, 'Vanessa Hill');

-- --------------------------------------------------------

--
-- Table structure for table `coachidentity`
--

CREATE TABLE `coachidentity` (
  `CoachName` varchar(100) NOT NULL,
  `DoB` date NOT NULL,
  `TeamID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coachidentity`
--

INSERT INTO `coachidentity` (`CoachName`, `DoB`, `TeamID`) VALUES
('Angela Wright', '1977-09-30', 6),
('Brian Reed', '1980-07-27', 13),
('Chloe Burns', '1978-12-03', 18),
('Daniel Perez', '1982-02-02', 11),
('Emily Scott', '1984-05-11', 10),
('Grace Yang', '1974-03-02', 16),
('James Morris', '1983-06-17', 5),
('Jason Ford', '1979-08-18', 9),
('Kevin Brooks', '1982-01-12', 3),
('Laura Kim', '1978-11-05', 4),
('Marcus Knight', '1987-09-06', 19),
('Michael Hart', '1980-03-15', 1),
('Nathan Diaz', '1985-06-30', 17),
('Nina Patel', '1981-04-22', 20),
('Olivia Moore', '1986-01-20', 14),
('Peter Chen', '1985-04-09', 7),
('Rachel Adams', '1981-12-25', 8),
('Sandra Lee', '1975-07-22', 2),
('Steven Blake', '1983-11-09', 15),
('Vanessa Hill', '1976-10-14', 12);

-- --------------------------------------------------------

--
-- Table structure for table `defender`
--

CREATE TABLE `defender` (
  `PlayerID` int(11) NOT NULL,
  `Blocks` int(11) DEFAULT NULL CHECK (`Blocks` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `defender`
--

INSERT INTO `defender` (`PlayerID`, `Blocks`) VALUES
(2, 8),
(7, 5),
(12, 6),
(17, 9),
(19, 7);

-- --------------------------------------------------------

--
-- Table structure for table `forward`
--

CREATE TABLE `forward` (
  `PlayerID` int(11) NOT NULL,
  `Shots` int(11) DEFAULT NULL CHECK (`Shots` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forward`
--

INSERT INTO `forward` (`PlayerID`, `Shots`) VALUES
(4, 10),
(5, 12),
(9, 11),
(10, 14),
(14, 9);

-- --------------------------------------------------------

--
-- Table structure for table `goalkeeper`
--

CREATE TABLE `goalkeeper` (
  `PlayerID` int(11) NOT NULL,
  `Saves` int(11) DEFAULT NULL CHECK (`Saves` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goalkeeper`
--

INSERT INTO `goalkeeper` (`PlayerID`, `Saves`) VALUES
(1, 5),
(6, 4),
(11, 6),
(16, 7),
(20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `matchsession`
--

CREATE TABLE `matchsession` (
  `MatchID` int(11) NOT NULL,
  `MatchSessionDate` date NOT NULL,
  `Result` varchar(50) DEFAULT NULL,
  `VenueID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matchsession`
--

INSERT INTO `matchsession` (`MatchID`, `MatchSessionDate`, `Result`, `VenueID`) VALUES
(1, '2024-01-05', '2-1', 1),
(2, '2024-01-10', '3-0', 2),
(3, '2024-01-15', '1-2', 3),
(4, '2024-01-20', '1-1', 4),
(5, '2024-01-25', '4-2', 5),
(6, '2024-02-01', '0-0', 6),
(7, '2024-02-07', '3-1', 7),
(8, '2024-02-13', '2-3', 8),
(9, '2024-02-18', '1-4', 9),
(10, '2024-02-22', '5-0', 10),
(11, '2024-03-01', '3-2', 11),
(12, '2024-03-06', '0-1', 12),
(13, '2024-03-12', '4-0', 13),
(14, '2024-03-17', '2-2', 14),
(15, '2024-03-23', '3-1', 15),
(16, '2024-03-29', '1-0', 16),
(17, '2024-04-03', '2-2', 17),
(18, '2024-04-09', '0-2', 18),
(19, '2024-04-15', '5-3', 19),
(20, '2024-04-20', '1-1', 20);

-- --------------------------------------------------------

--
-- Table structure for table `matchstats`
--

CREATE TABLE `matchstats` (
  `MatchStatsID` int(11) NOT NULL,
  `MatchID` int(11) NOT NULL,
  `PossessionPercent` decimal(5,2) DEFAULT NULL CHECK (`PossessionPercent` between 0 and 100),
  `Shots` int(11) DEFAULT NULL CHECK (`Shots` >= 0),
  `Fouls` int(11) DEFAULT NULL CHECK (`Fouls` >= 0),
  `Score` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matchstats`
--

INSERT INTO `matchstats` (`MatchStatsID`, `MatchID`, `PossessionPercent`, `Shots`, `Fouls`, `Score`) VALUES
(1, 1, 55.00, 12, 3, '2-1'),
(2, 2, 60.50, 15, 2, '3-0'),
(3, 3, 48.75, 10, 5, '1-2'),
(4, 4, 52.30, 11, 4, '1-1'),
(5, 5, 65.00, 18, 1, '4-2'),
(6, 6, 50.00, 9, 3, '0-0'),
(7, 7, 57.20, 14, 2, '3-1'),
(8, 8, 53.10, 13, 6, '2-3'),
(9, 9, 47.80, 8, 7, '1-4'),
(10, 10, 61.00, 17, 1, '5-0'),
(11, 11, 56.40, 16, 2, '3-2'),
(12, 12, 49.90, 7, 3, '0-1'),
(13, 13, 62.25, 20, 4, '4-0'),
(14, 14, 51.10, 13, 2, '2-2'),
(15, 15, 58.00, 12, 1, '3-1'),
(16, 16, 54.60, 10, 5, '1-0'),
(17, 17, 59.30, 14, 6, '2-2'),
(18, 18, 46.00, 6, 4, '0-2'),
(19, 19, 63.70, 19, 3, '5-3'),
(20, 20, 55.55, 11, 2, '1-1');

--
-- Triggers `matchstats`
--
DELIMITER $$
CREATE TRIGGER `sync_match_result_insert` AFTER INSERT ON `matchstats` FOR EACH ROW BEGIN
  UPDATE MatchSession
  SET Result = NEW.Score
  WHERE MatchID = NEW.MatchID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sync_match_result_update` AFTER UPDATE ON `matchstats` FOR EACH ROW BEGIN
  IF NEW.Score <> OLD.Score THEN
    UPDATE MatchSession
    SET Result = NEW.Score
    WHERE MatchID = NEW.MatchID;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `midfielder`
--

CREATE TABLE `midfielder` (
  `PlayerID` int(11) NOT NULL,
  `Passes` int(11) DEFAULT NULL CHECK (`Passes` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `midfielder`
--

INSERT INTO `midfielder` (`PlayerID`, `Passes`) VALUES
(3, 32),
(8, 40),
(13, 37),
(15, 29),
(18, 35);

-- --------------------------------------------------------

--
-- Table structure for table `participate`
--

CREATE TABLE `participate` (
  `PlayerID` int(11) NOT NULL,
  `MatchID` int(11) NOT NULL,
  `Playtime` int(11) DEFAULT NULL,
  `Goals` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participate`
--

INSERT INTO `participate` (`PlayerID`, `MatchID`, `Playtime`, `Goals`) VALUES
(1, 1, 60, 0),
(1, 11, 65, 0),
(2, 1, 45, 0),
(2, 11, 75, 0),
(3, 2, 70, 3),
(3, 12, 80, 3),
(4, 2, 90, 0),
(4, 12, 85, 0),
(5, 3, 30, 0),
(5, 13, 90, 0),
(6, 3, 80, 0),
(6, 13, 55, 0),
(7, 4, 50, 5),
(7, 14, 45, 5),
(8, 4, 60, 0),
(8, 12, 40, 0),
(8, 14, 60, 0),
(9, 1, 50, 0),
(9, 5, 75, 0),
(9, 15, 75, 0),
(10, 5, 85, 7),
(10, 15, 65, 7),
(11, 6, 90, 0),
(11, 16, 70, 0),
(12, 6, 55, 0),
(12, 16, 50, 0),
(13, 7, 65, 9),
(13, 17, 40, 9),
(14, 7, 70, 0),
(14, 17, 35, 0),
(15, 8, 40, 0),
(15, 18, 60, 0),
(16, 8, 35, 0),
(16, 18, 55, 0),
(17, 9, 50, 0),
(17, 19, 50, 0),
(18, 9, 45, 0),
(18, 10, 75, 0),
(18, 19, 60, 0),
(19, 10, 60, 8),
(19, 20, 70, 8),
(20, 10, 55, 0),
(20, 20, 65, 0);

--
-- Triggers `participate`
--
DELIMITER $$
CREATE TRIGGER `update_weekly_playtime_summary` AFTER INSERT ON `participate` FOR EACH ROW BEGIN
    DECLARE week_num INT;
    DECLARE existing INT;

    SELECT WEEK(MatchSessionDate) INTO week_num
    FROM MatchSession
    WHERE MatchID = NEW.MatchID;

    SELECT COUNT(*) INTO existing
    FROM WeeklyPlaytimeSummary
    WHERE PlayerID = NEW.PlayerID AND WeekNumber = week_num;

    IF existing > 0 THEN
        UPDATE WeeklyPlaytimeSummary
        SET TotalPlaytime = TotalPlaytime + NEW.Playtime
        WHERE PlayerID = NEW.PlayerID AND WeekNumber = week_num;
    ELSE
        INSERT INTO WeeklyPlaytimeSummary (PlayerID, WeekNumber, TotalPlaytime)
        VALUES (NEW.PlayerID, week_num, NEW.Playtime);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `performancerating`
--

CREATE TABLE `performancerating` (
  `RatingID` int(11) NOT NULL,
  `Effectiveness` int(11) DEFAULT NULL CHECK (`Effectiveness` between 0 and 10),
  `WorkRate` int(11) DEFAULT NULL CHECK (`WorkRate` between 0 and 10),
  `Feedback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performancerating`
--

INSERT INTO `performancerating` (`RatingID`, `Effectiveness`, `WorkRate`, `Feedback`) VALUES
(1, 9, 8, 'Outstanding performance throughout the game.'),
(2, 7, 9, 'High energy and consistent effort.'),
(3, 6, 6, 'Average performance, room to grow.'),
(4, 10, 10, 'Perfect game. Nothing to improve.'),
(5, 5, 7, 'Improved in second half.'),
(6, 8, 5, 'Strong start, faded a bit.'),
(7, 4, 6, 'Needs to improve decision-making.'),
(8, 6, 9, 'Very hardworking player.'),
(9, 9, 7, 'Crucial player in team effort.'),
(10, 7, 8, 'Solid performance.'),
(11, 8, 8, 'Well-rounded and reliable.'),
(12, 5, 4, 'Below average, needs focus.'),
(13, 10, 6, 'Explosive but inconsistent.'),
(14, 7, 5, 'Stable game.'),
(15, 9, 9, 'Standout player today.'),
(16, 6, 6, 'Held the midfield well.'),
(17, 8, 7, 'Versatile player, great coverage.'),
(18, 4, 5, 'Struggled defensively.'),
(19, 7, 10, 'Excellent work rate.'),
(20, 10, 10, 'Match-winning display.');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `PlayerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`PlayerID`, `Name`) VALUES
(19, 'Alexander Lee'),
(14, 'Amelia White'),
(8, 'Ava Taylor'),
(17, 'Benjamin Scott'),
(12, 'Charlotte King'),
(2, 'Emily Rivera'),
(7, 'Ethan Brooks'),
(18, 'Evelyn Turner'),
(20, 'Grace Brown'),
(16, 'Harper Green'),
(10, 'Isabella Rossi'),
(15, 'James Young'),
(1, 'John Carter'),
(3, 'Liam O\'Connor'),
(13, 'Logan Patel'),
(9, 'Lucas Silva'),
(11, 'Mason Clark'),
(6, 'Mia Zhang'),
(5, 'Noah Daniels'),
(4, 'Sophia Malik');

-- --------------------------------------------------------

--
-- Table structure for table `playeridentity`
--

CREATE TABLE `playeridentity` (
  `Name` varchar(100) NOT NULL,
  `DoB` date NOT NULL,
  `TeamID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playeridentity`
--

INSERT INTO `playeridentity` (`Name`, `DoB`, `TeamID`) VALUES
('Alexander Lee', '1999-09-28', 19),
('Amelia White', '1999-03-19', 14),
('Ava Taylor', '2003-05-03', 8),
('Benjamin Scott', '2002-01-30', 17),
('Charlotte King', '2000-10-22', 12),
('Emily Rivera', '1999-08-12', 2),
('Ethan Brooks', '2001-09-10', 7),
('Evelyn Turner', '1998-05-17', 18),
('Grace Brown', '2003-04-11', 20),
('Harper Green', '2000-08-06', 16),
('Isabella Rossi', '1999-12-08', 10),
('James Young', '2001-12-01', 15),
('John Carter', '2000-02-15', 1),
('Liam O\'Connor', '2001-01-05', 3),
('Logan Patel', '1998-07-02', 13),
('Lucas Silva', '2002-06-20', 9),
('Mason Clark', '2001-04-14', 11),
('Mia Zhang', '1998-11-18', 6),
('Noah Daniels', '2000-03-30', 5),
('Sophia Malik', '2002-07-25', 4),
('Test Delete', '1995-01-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rated`
--

CREATE TABLE `rated` (
  `PlayerID` int(11) NOT NULL,
  `MatchID` int(11) NOT NULL,
  `RatingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stadium`
--

CREATE TABLE `stadium` (
  `StadiumName` varchar(100) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Capacity` int(11) DEFAULT NULL CHECK (`Capacity` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stadium`
--

INSERT INTO `stadium` (`StadiumName`, `Location`, `Capacity`) VALUES
('Bear Basin', 'Detroit', 52000),
('Bull Bay', 'Minneapolis', 46000),
('Cobra Complex', 'Orlando', 45000),
('Dragon Dome', 'Chicago', 53000),
('Eagle Arena', 'New York', 55000),
('Falcon Field', 'Dallas', 50000),
('Fox Fortress', 'San Diego', 56000),
('Giant Grounds', 'Cleveland', 49000),
('Griffin Grounds', 'Boston', 42000),
('Hawk Haven', 'Philadelphia', 47000),
('Kraken Coliseum', 'San Francisco', 65000),
('Lion\'s Lair', 'Atlanta', 60000),
('Panther Park', 'Houston', 47000),
('Phoenix Pit', 'Denver', 61000),
('Raptor Ring', 'Las Vegas', 57000),
('Shark Stadium', 'Miami', 48000),
('Storm Stadium', 'Charlotte', 63000),
('Tiger Den', 'Los Angeles', 62000),
('Viper Vault', 'Phoenix', 51000),
('Wolf Ground', 'Seattle', 49000);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `TeamID` int(11) NOT NULL,
  `TeamName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`TeamID`, `TeamName`) VALUES
(1, 'Red Lions'),
(2, 'Blue Hawks'),
(3, 'Green Warriors'),
(4, 'Black Panthers'),
(5, 'Golden Eagles'),
(6, 'Silver Sharks'),
(7, 'Orange Vipers'),
(8, 'White Wolves'),
(9, 'Crimson Tigers'),
(10, 'Purple Phoenix'),
(11, 'Steel Blades'),
(12, 'Iron Dragons'),
(13, 'Rapid Falcons'),
(14, 'Neon Cobras'),
(15, 'Shadow Bulls'),
(16, 'Frost Giants'),
(17, 'Thunder Bears'),
(18, 'Fire Foxes'),
(19, 'Night Owls'),
(20, 'Tornado Hawks');

-- --------------------------------------------------------

--
-- Table structure for table `unlocks`
--

CREATE TABLE `unlocks` (
  `PlayerID` int(11) NOT NULL,
  `AchievementID` int(11) NOT NULL,
  `UnlockedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unlocks`
--

INSERT INTO `unlocks` (`PlayerID`, `AchievementID`, `UnlockedDate`) VALUES
(1, 1, '2024-01-15'),
(1, 2, '2024-01-20'),
(2, 1, '2024-02-10'),
(3, 3, '2024-02-15'),
(4, 2, '2024-03-01'),
(5, 4, '2024-03-05'),
(6, 1, '2024-03-10'),
(7, 3, '2024-04-01'),
(8, 2, '2024-04-10'),
(9, 5, '2024-04-15'),
(10, 2, '2024-05-01'),
(11, 1, '2024-05-05'),
(12, 3, '2024-05-10'),
(13, 4, '2024-05-15'),
(14, 5, '2024-05-20'),
(15, 1, '2024-06-01'),
(16, 2, '2024-06-05'),
(17, 3, '2024-06-10'),
(18, 4, '2024-06-15'),
(19, 5, '2024-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `UserID` int(11) NOT NULL,
  `PlayerID` int(11) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Role` enum('admin','player') DEFAULT 'player'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`UserID`, `PlayerID`, `Username`, `PasswordHash`, `Role`) VALUES
(1, NULL, 'jubrilakanbi', '$2y$10$sT0PLG1cq0n.McNcKmR6leJSc2UNGLn9eIE3rkGcTgUvI3gH74J2a', 'admin'),
(2, NULL, 'dominicejiogu', '$2y$10$sT0PLG1cq0n.McNcKmR6leJSc2UNGLn9eIE3rkGcTgUvI3gH74J2a', 'admin'),
(3, 1, 'johncarter', '$2y$10$sT0PLG1cq0n.McNcKmR6leJSc2UNGLn9eIE3rkGcTgUvI3gH74J2a', 'player'),
(4, 2, 'emilyrivera', '$2y$10$sT0PLG1cq0n.McNcKmR6leJSc2UNGLn9eIE3rkGcTgUvI3gH74J2a', 'player'),
(5, 3, 'liamoconnor', '$2y$10$sT0PLG1cq0n.McNcKmR6leJSc2UNGLn9eIE3rkGcTgUvI3gH74J2a', 'player');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` varchar(10) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Email`, `Password`, `Role`) VALUES
('g8075', 'akanbijubriladeyemi@outlook.com', '$2y$10$luIEqxMW70UVtNZzz1mhtOnLhnRcHUhQX6avAwFVUZdXKU7gTh8w6', 'admin'),
('p2323', 'akanbijubril9@gmail.com', '$2y$10$pgo1x5yYQIYwtkfFiSwReeTraK2lRWA1upt4W37TVvBg4v50snlWa', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `VenueID` int(11) NOT NULL,
  `StadiumName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`VenueID`, `StadiumName`) VALUES
(14, 'Bear Basin'),
(18, 'Bull Bay'),
(10, 'Cobra Complex'),
(5, 'Dragon Dome'),
(1, 'Eagle Arena'),
(4, 'Falcon Field'),
(16, 'Fox Fortress'),
(19, 'Giant Grounds'),
(11, 'Griffin Grounds'),
(17, 'Hawk Haven'),
(13, 'Kraken Coliseum'),
(9, 'Lion\'s Lair'),
(6, 'Panther Park'),
(12, 'Phoenix Pit'),
(15, 'Raptor Ring'),
(3, 'Shark Stadium'),
(20, 'Storm Stadium'),
(2, 'Tiger Den'),
(8, 'Viper Vault'),
(7, 'Wolf Ground');

-- --------------------------------------------------------

--
-- Table structure for table `weeklyplaytimesummary`
--

CREATE TABLE `weeklyplaytimesummary` (
  `PlayerID` int(11) NOT NULL,
  `WeekNumber` int(11) NOT NULL,
  `TotalPlaytime` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weeklyplaytimesummary`
--

INSERT INTO `weeklyplaytimesummary` (`PlayerID`, `WeekNumber`, `TotalPlaytime`) VALUES
(8, 9, 40),
(9, 0, 50),
(18, 7, 75);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`AchievementID`),
  ADD KEY `PlayerID` (`PlayerID`);

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`CoachID`),
  ADD KEY `CoachName` (`CoachName`);

--
-- Indexes for table `coachidentity`
--
ALTER TABLE `coachidentity`
  ADD PRIMARY KEY (`CoachName`),
  ADD KEY `TeamID` (`TeamID`);

--
-- Indexes for table `defender`
--
ALTER TABLE `defender`
  ADD PRIMARY KEY (`PlayerID`);

--
-- Indexes for table `forward`
--
ALTER TABLE `forward`
  ADD PRIMARY KEY (`PlayerID`);

--
-- Indexes for table `goalkeeper`
--
ALTER TABLE `goalkeeper`
  ADD PRIMARY KEY (`PlayerID`);

--
-- Indexes for table `matchsession`
--
ALTER TABLE `matchsession`
  ADD PRIMARY KEY (`MatchID`),
  ADD KEY `VenueID` (`VenueID`);

--
-- Indexes for table `matchstats`
--
ALTER TABLE `matchstats`
  ADD PRIMARY KEY (`MatchStatsID`),
  ADD KEY `MatchID` (`MatchID`);

--
-- Indexes for table `midfielder`
--
ALTER TABLE `midfielder`
  ADD PRIMARY KEY (`PlayerID`);

--
-- Indexes for table `participate`
--
ALTER TABLE `participate`
  ADD PRIMARY KEY (`PlayerID`,`MatchID`),
  ADD KEY `MatchID` (`MatchID`);

--
-- Indexes for table `performancerating`
--
ALTER TABLE `performancerating`
  ADD PRIMARY KEY (`RatingID`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`PlayerID`),
  ADD KEY `fk_player_identity` (`Name`);

--
-- Indexes for table `playeridentity`
--
ALTER TABLE `playeridentity`
  ADD PRIMARY KEY (`Name`),
  ADD KEY `TeamID` (`TeamID`);

--
-- Indexes for table `rated`
--
ALTER TABLE `rated`
  ADD PRIMARY KEY (`PlayerID`,`MatchID`,`RatingID`),
  ADD KEY `RatingID` (`RatingID`);

--
-- Indexes for table `stadium`
--
ALTER TABLE `stadium`
  ADD PRIMARY KEY (`StadiumName`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`TeamID`);

--
-- Indexes for table `unlocks`
--
ALTER TABLE `unlocks`
  ADD PRIMARY KEY (`PlayerID`,`AchievementID`),
  ADD KEY `AchievementID` (`AchievementID`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `PlayerID` (`PlayerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`VenueID`),
  ADD KEY `StadiumName` (`StadiumName`);

--
-- Indexes for table `weeklyplaytimesummary`
--
ALTER TABLE `weeklyplaytimesummary`
  ADD PRIMARY KEY (`PlayerID`,`WeekNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievement`
--
ALTER TABLE `achievement`
  MODIFY `AchievementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `CoachID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `matchsession`
--
ALTER TABLE `matchsession`
  MODIFY `MatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `matchstats`
--
ALTER TABLE `matchstats`
  MODIFY `MatchStatsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `performancerating`
--
ALTER TABLE `performancerating`
  MODIFY `RatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `PlayerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `TeamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `VenueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievement`
--
ALTER TABLE `achievement`
  ADD CONSTRAINT `achievement_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`) ON DELETE CASCADE;

--
-- Constraints for table `coach`
--
ALTER TABLE `coach`
  ADD CONSTRAINT `coach_ibfk_1` FOREIGN KEY (`CoachName`) REFERENCES `coachidentity` (`CoachName`);

--
-- Constraints for table `coachidentity`
--
ALTER TABLE `coachidentity`
  ADD CONSTRAINT `coachidentity_ibfk_1` FOREIGN KEY (`TeamID`) REFERENCES `team` (`TeamID`);

--
-- Constraints for table `defender`
--
ALTER TABLE `defender`
  ADD CONSTRAINT `defender_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`) ON DELETE CASCADE;

--
-- Constraints for table `forward`
--
ALTER TABLE `forward`
  ADD CONSTRAINT `forward_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`) ON DELETE CASCADE;

--
-- Constraints for table `goalkeeper`
--
ALTER TABLE `goalkeeper`
  ADD CONSTRAINT `goalkeeper_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`) ON DELETE CASCADE;

--
-- Constraints for table `matchsession`
--
ALTER TABLE `matchsession`
  ADD CONSTRAINT `matchsession_ibfk_1` FOREIGN KEY (`VenueID`) REFERENCES `venue` (`VenueID`) ON DELETE CASCADE;

--
-- Constraints for table `matchstats`
--
ALTER TABLE `matchstats`
  ADD CONSTRAINT `matchstats_ibfk_1` FOREIGN KEY (`MatchID`) REFERENCES `matchsession` (`MatchID`) ON DELETE CASCADE;

--
-- Constraints for table `midfielder`
--
ALTER TABLE `midfielder`
  ADD CONSTRAINT `midfielder_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`) ON DELETE CASCADE;

--
-- Constraints for table `participate`
--
ALTER TABLE `participate`
  ADD CONSTRAINT `participate_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `participate_ibfk_2` FOREIGN KEY (`MatchID`) REFERENCES `matchsession` (`MatchID`) ON DELETE CASCADE;

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `fk_player_identity` FOREIGN KEY (`Name`) REFERENCES `playeridentity` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playeridentity`
--
ALTER TABLE `playeridentity`
  ADD CONSTRAINT `playeridentity_ibfk_1` FOREIGN KEY (`TeamID`) REFERENCES `team` (`TeamID`);

--
-- Constraints for table `rated`
--
ALTER TABLE `rated`
  ADD CONSTRAINT `rated_ibfk_1` FOREIGN KEY (`PlayerID`,`MatchID`) REFERENCES `participate` (`PlayerID`, `MatchID`) ON DELETE CASCADE,
  ADD CONSTRAINT `rated_ibfk_2` FOREIGN KEY (`RatingID`) REFERENCES `performancerating` (`RatingID`) ON DELETE CASCADE;

--
-- Constraints for table `unlocks`
--
ALTER TABLE `unlocks`
  ADD CONSTRAINT `unlocks_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `unlocks_ibfk_2` FOREIGN KEY (`AchievementID`) REFERENCES `achievement` (`AchievementID`) ON DELETE CASCADE;

--
-- Constraints for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD CONSTRAINT `userlogin_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`) ON DELETE CASCADE;

--
-- Constraints for table `venue`
--
ALTER TABLE `venue`
  ADD CONSTRAINT `venue_ibfk_1` FOREIGN KEY (`StadiumName`) REFERENCES `stadium` (`StadiumName`);

--
-- Constraints for table `weeklyplaytimesummary`
--
ALTER TABLE `weeklyplaytimesummary`
  ADD CONSTRAINT `weeklyplaytimesummary_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
