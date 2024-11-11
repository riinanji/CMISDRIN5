-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 04:41 PM
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
-- Database: `cmisdrin5`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_tools`
--

CREATE TABLE `borrowed_tools` (
  `id` int(11) NOT NULL,
  `tool_id` int(11) NOT NULL,
  `borrowed_by` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `date_borrowed` date NOT NULL,
  `date_to_return` date NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_ID` int(11) NOT NULL,
  `categoryName` varchar(200) NOT NULL,
  `categoryDescription` longtext NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updationDate` varchar(200) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_ID`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`, `user_ID`) VALUES
(7, 'noises', 'fvd', '2024-11-08 09:20:40', '08-11-2024 05:20:40 PM', 1),
(8, 'death threat', '', '2024-11-08 02:41:55', '', 1),
(9, 'sumag', '', '2024-11-08 09:18:54', '', 1),
(10, 'sumbag', '', '2024-11-08 20:44:38', '', 1),
(11, 'labay', '', '2024-11-10 13:50:18', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `complaintremark`
--

CREATE TABLE `complaintremark` (
  `remark_ID` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `complaint_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaintremark`
--

INSERT INTO `complaintremark` (`remark_ID`, `status`, `remark`, `remarkDate`, `complaint_ID`) VALUES
(84, 'in process', 'ongoing', '2024-11-11 03:01:37', 58),
(85, 'closed', 'canclled', '2024-11-11 03:03:22', 58),
(86, 'in process', 'ongioi', '2024-11-10 12:27:05', 65),
(87, 'closed', 'done\r\n', '2024-11-10 12:28:11', 65),
(88, 'in process', '   lml', '2024-11-10 13:31:46', 63),
(89, 'in process', 'ongoing', '2024-11-10 13:34:18', 64),
(90, 'closed', 'done', '2024-11-10 13:48:51', 62);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `complaint_text` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `complaint_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_date` date NOT NULL,
  `event_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_description`, `event_date`, `event_location`) VALUES
(12, 'agay2', 'asdasdasdasdasd', '2024-09-27', 'camp jmc'),
(14, 'feeding program', 'sdxggb', '2024-09-26', 'agusan');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `position` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `profile_picture`, `name`, `age`, `address`, `position`, `status`, `sex`, `phone_number`) VALUES
(16, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Xyrell Maire P. Capio', 22, 'Camp Philips Agusan Canyon M.F Buk.', 'BSPO (Barangay Service Point Offcer)', 'active', 'Female', '09859640645'),
(17, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Gaylette P. Pacina', 22, 'Philips, Agusan Canyon, M.F.', 'BSPO (Barangay Service Point Offcer)', 'active', 'Female', '09912956167'),
(18, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Ma. Cecilia B. Obalang', 21, 'Balanban, Agusan Canyon, M.F.', 'BSPO (Barangay Service Point Offcer)', 'active', 'Female', '0'),
(19, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Marivic P. Manucan', 21, 'Balanban, Agusan Canyon, M.F.', 'BSPO (Barangay Service Point Offcer)', 'active', 'Female', '09460915530'),
(20, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Deborah Sun B. Gonzales', 21, 'Purok Ibabao, Agusan Canyon, M.F.', 'BSPO (Barangay Service Point Offcer)', 'active', 'Female', '09068895143'),
(21, 'agu1.jpg', 'Gertudes D. Addran', 22, 'Agusan Canyon, M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Male', '09354576670'),
(22, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Hamie T. Ladao', 21, 'Balanban, Agusan Canyon, M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Male', '09075654674'),
(23, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Mercy C. Muring', 21, 'Purok Merkado, Agusan Canyon M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09356001750'),
(24, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Nema Y. Ontong', 21, 'Purok Merkado, Agusan Canyon M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09124820485'),
(25, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Nicolasa Tomaquin', 21, '#70 Extension, Camp Philips, M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09759138117'),
(26, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Mary Grace E.Ginete', 21, 'New Coralles, Agusan Canyon, M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09704449578'),
(27, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Artemia P. Petalver', 21, 'Agusan Canyon, M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09756710251'),
(28, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Rosemarie A. Pasilan', 21, 'Philips, Agusan Canyon, M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09656738305'),
(29, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Mary Grace M. Ballesteros', 21, '566 Provincial Camp- Philips M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09268984495'),
(30, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Rowena Petalcurin Estey', 21, 'Camp Philips New Corrales Ext. Agusan Canyon M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09061687459'),
(31, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Maribeth H. Jaraula', 21, '562 Provincial Road, Camp Philips, Agusan Canyon, M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09061686312'),
(32, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Grace J. Algodon', 21, 'Camp Philips ST.S  Agusan Canyon M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', 'o'),
(33, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Elyngmetchen  E. Alsola', 21, 'M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Female', '09123456789'),
(34, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Marcelo C. Gio', 21, 'Agusan Canyon, M.F.', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'Male', '091055229800'),
(35, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Marjun A. Añasco', 22, 'Purok Ibabao, Agusan Canyon, M.F.', 'BOR(BARANGAY ORGANIC RESCUER)', 'active', 'Male', '09945286587'),
(36, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Erwin Vismanos', 24, 'Purok Kurbada Agusan Canyon M.F', 'BOR(BARANGAY ORGANIC RESCUER)', 'active', 'Male', '09857596796'),
(37, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Jay Zike P. Espejo', 21, 'Purok Merkado, Agusan Canyon M.F.', 'BOR(BARANGAY ORGANIC RESCUER)', 'active', 'Male', '09380016960'),
(38, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Philip L. Buedeos', 21, 'Agusan Canyon, M.F.', 'BOR(BARANGAY ORGANIC RESCUER)', 'active', 'Male', '09517046632'),
(39, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Ernesto AbrogueÃ±a', 23, 'Purok Kurbada Agusan Canyon M.F', 'BOR(BARANGAY ORGANIC RESCUER)', 'active', 'Male', '09463726064'),
(40, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Enrique M. Canillo', 21, 'New Corales st. Agusan Canyon ', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '09679667705'),
(41, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Florencio Jr A. Bincula', 21, 'Agusan Canyon, M.F.', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '0123123123'),
(42, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Norman Jade G. Galanida', 21, 'Purok mercadon M.F', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '09483529734'),
(43, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Arnel L. Etang', 21, 'Agusan Canyon, M.F.', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '0991624056'),
(44, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Brian L. Obatay', 21, 'Linabo Malaybalay City', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '09858091071'),
(45, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Precioso L. Galleto', 21, 'Old Corales Agusan Canyon M.F', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '09162694035'),
(46, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Roy A. Manomalay', 21, 'Upper Balanban Agusan Canyon M.F', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '09262135838'),
(47, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Rickner P. Pinute', 21, 'Agusan Canyon, M.F.', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '09948838772'),
(48, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Vicente M. Ramos Jr. ', 21, 'Purok Merkado M.F', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '09100257110'),
(49, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Redyn M. Dacapio', 21, 'New Corales st. Agusan Canyon', 'CVO (CIVILIAN VOLUNTEER ORGANIZATION)', 'active', 'Male', '09353841053'),
(50, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Ethez may C. Muring', 21, 'Purok Merkado M.F', 'BSI(BARANGAY SANITARY INSPECTOR)', 'active', 'Female', '0'),
(51, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Luna M. Gutlay', 21, 'Lower Balanban Agusan Canyon M.F', 'BSI(BARANGAY SANITARY INSPECTOR)', 'active', 'Female', '09057262920'),
(52, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Emelie L. Villoso', 21, 'Purok Merkado M.F', 'BNS(BARANGAY NUTRITION SCHOLAR)', 'active', 'Female', '09518868052'),
(53, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Grace C.  Wapin', 21, 'Street C, house# 478 Camp philips', 'BNS(BARANGAY NUTRITION SCHOLAR)', 'active', 'Female', '09067248017'),
(54, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Sarah Ger T. Capio', 21, 'New Corales Ext. Agusan Canyon M.F', 'PACIFICATION COMMITTEES(LUPON TAGA PAMAYAPA)', 'active', 'Female', 'N/A'),
(55, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Lyndon G. Humamoy', 21, '609 st. Camp Philips Agusan', 'PACIFICATION COMMITTEES(LUPON TAGA PAMAYAPA)', 'active', 'Male', '09261656568'),
(56, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Ederlita L. Gaoat', 21, 'New Corales st. Agusan Canyon', 'PACIFICATION COMMITTEES(LUPON TAGA PAMAYAPA)', 'active', 'Male', '09354477841'),
(57, '455614813_1987701111664511_5567577092933089251_n.jpg', 'andrion', 21, 'Purok Merkado, Agusan Canyon M.F.', 'PACIFICATION COMMITTEES(LUPON TAGA PAMAYAPA)', 'active', 'Female', '09635872495'),
(58, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Mylene A. Bataan ', 21, 'Purok Merkado, Agusan Canyon M.F.', 'PACIFICATION COMMITTEES(LUPON TAGA PAMAYAPA)', 'active', 'Female', '09460736648'),
(59, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Arcelly O. Pasok', 21, 'Balanban, Agusan Canyon, M.F.', 'PACIFICATION COMMITTEES(LUPON TAGA PAMAYAPA)', 'active', 'Female', '09486666844'),
(60, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Betty M. Cachapero', 21, 'Purok Kurbada Agusan Canyon M.F', 'LUPON', 'active', 'Female', '09981968940'),
(61, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Altagracia D. Sarzuelo', 21, 'New Corales st. Agusan Canyon', 'LUPON', 'active', 'Femlae', '0'),
(62, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Nemesia L. Abucayon', 21, 'Purok Pinetree Agusan Canyon M.F', 'LUPON', 'active', 'Female', '09976833696'),
(63, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Florida P. Saburoco', 21, 'Kisabong Agusan Canyon M.F', 'LUPON', 'active', 'Female', '0'),
(64, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Rene Joy Dela Cruz Chagas', 21, 'Balanban, Agusan Canyon, M.F.', 'DRIVER', 'active', 'Male', '09060381364'),
(65, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Brian M. BraÃ±a', 21, 'Purok Pinetree Agusan Canyon M.F', 'DRIVER', 'active', 'Male', '09066154543'),
(66, '455614813_1987701111664511_5567577092933089251_n.jpg', 'John Rey C. Dacayo', 21, 'Agusan Canyon, M.F.', 'DRIVER', 'active', 'Male', '9463663649'),
(67, '455614813_1987701111664511_5567577092933089251_n.jpg', 'Junely C. Tuston', 21, 'P-3 San Jose Libona Bukidnon', 'DRIVER', 'active', 'Male', '09692264923'),
(70, '66fb2f8141168_02f6f1e5-abc0-4d6b-8852-c6d834efb3d2.jpg', 'andrion', 12, 'camp jmc', 'BHW (BARANGAY HEALTH WORKER)', 'active', 'MALE', '1232');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_ID` int(11) NOT NULL,
  `stateName` varchar(200) NOT NULL,
  `stateDescription` tinytext NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updationDate` varchar(200) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `complainantAddress` varchar(255) DEFAULT NULL,
  `respondentAddress1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_ID`, `stateName`, `stateDescription`, `postingDate`, `updationDate`, `user_ID`, `complainantAddress`, `respondentAddress1`) VALUES
(11, '', '', '2024-11-10 11:51:33', '', 0, 'philips', 'agusan'),
(12, '', '', '2024-11-10 11:55:11', '', 0, 'agusan', 'philips'),
(13, '', '', '2024-11-10 11:55:26', '', 0, 'balanban', 'purok merkado'),
(14, '', '', '2024-11-10 11:55:39', '', 0, 'purok merkado', 'balanban');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `sub_ID` int(11) NOT NULL,
  `subcategory` varchar(200) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updationDate` varchar(200) NOT NULL,
  `category_ID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcomplaints`
--

CREATE TABLE `tblcomplaints` (
  `complaint_ID` int(11) NOT NULL,
  `complainantName` varchar(200) NOT NULL,
  `respondentName` varchar(200) NOT NULL,
  `contactNumber` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `subcategory` varchar(200) NOT NULL,
  `complaintType` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `noc` varchar(200) NOT NULL,
  `complaintDetails` mediumtext NOT NULL,
  `complaintFile` varchar(200) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(200) DEFAULT NULL,
  `lastUpdationDate` datetime NOT NULL,
  `user_ID` int(11) NOT NULL,
  `complainantContact` varchar(15) DEFAULT NULL,
  `respondentContact` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcomplaints`
--

INSERT INTO `tblcomplaints` (`complaint_ID`, `complainantName`, `respondentName`, `contactNumber`, `category`, `subcategory`, `complaintType`, `state`, `noc`, `complaintDetails`, `complaintFile`, `regDate`, `status`, `lastUpdationDate`, `user_ID`, `complainantContact`, `respondentContact`) VALUES
(58, 'ritchel', 'aldrin', '097875', '10', '', '', 'philips', 'adas', 'dasdasd', '', '2024-11-11 03:03:22', 'closed', '0000-00-00 00:00:00', 29, NULL, NULL),
(59, 'aldrins', 'andrion', '123123', '8', '', '', 'new coralles', 'nag kantaha grabi ka saba', 'asdasd', '', '2024-11-11 03:04:12', NULL, '0000-00-00 00:00:00', 29, NULL, NULL),
(60, 'jessmar', 'jessmar', '', '8', '', '', 'agusan', 'nanumbag', 'xdg', '', '2024-11-10 11:59:54', NULL, '0000-00-00 00:00:00', 29, '096189373099', '09619079099'),
(61, 'aldrin', 'jessmar', '', '7', '', '', 'agusan', 'gi ignan kog pusilon', 'xcbxb', '', '2024-11-10 12:00:58', NULL, '0000-00-00 00:00:00', 26, '09360212390', '09619079099'),
(62, 'bjane1', 'andrion', '', '8', '', '', 'purok merkado', 'gi ignan kog pusilon', 'xcvv', '', '2024-11-10 13:48:51', 'closed', '0000-00-00 00:00:00', 26, '09360212390', '09619079099f'),
(63, 'aldrin', 'jessmar', '', '7', '', '', 'purok merkado', 'kawat manok', 'cbcb', '', '2024-11-10 13:31:46', 'in process', '0000-00-00 00:00:00', 26, '09360212390', '09619079099'),
(64, 'jessmar', 'andrion', '', '8', '', '', 'balanban', 'ga saba2', 'dxfsdg', '', '2024-11-10 13:34:18', 'in process', '0000-00-00 00:00:00', 26, '09360212390', '12345678912'),
(65, 'aldrin', 'camp jmc', '', '8', '', '', 'philips', 'ga saba2', '2kjhfsd', '', '2024-11-10 12:28:11', 'closed', '0000-00-00 00:00:00', 26, '09360212390', '09619079099');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_ID` int(11) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `userEmail` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `contactNo` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `State` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `pincode` varchar(200) NOT NULL,
  `userImage` varchar(200) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updationDate` datetime NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `userAccess_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_ID`, `fullName`, `userEmail`, `password`, `contactNo`, `address`, `State`, `country`, `pincode`, `userImage`, `regDate`, `updationDate`, `status`, `userAccess_ID`) VALUES
(20, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '9619079099', '', '', '', '', '', '2024-11-01 11:16:32', '0000-00-00 00:00:00', 'Active', 1),
(21, 'ivan', 'ivan@gmail.com', '2c42e5cf1cdbafea04ed267018ef1511', '0912345678', '', '', '', '', '', '2024-10-01 14:12:14', '0000-00-00 00:00:00', 'Active', 2),
(22, 'andrion', 'andrion@gmail.com', '$2y$10$o5G.cPUpawfryx1FD3ifT.YtO/SzzDFwrnO4MjO3HGTthohDcH8Ku', '0912345678', '', '', '', '', '', '2024-09-03 10:10:25', '0000-00-00 00:00:00', 'Active', 2),
(23, 'aldrin joe', 'aldrin@gmail.com', '$2y$10$yN9z.5GuhQ4bAWB7RtkZfOWoH10mLAQjcoOscxnp0RJ6CSUgywFUK', '0975334053', '', '', '', '', '', '2024-09-11 18:13:18', '0000-00-00 00:00:00', 'Active', 2),
(24, 'aldrin joe', 'aldrinjoe@gmail.com', '$2y$10$blfNfg5Z7.NhTAMPbvKIGe2t8Hp0AcfQge2S7IPp9.Dr4yNq/Ui6S', '0912345678', '', '', '', '', '', '2024-09-13 22:12:12', '0000-00-00 00:00:00', 'Active', 2),
(25, 'jessmar ', 'Jessmardalahigon@gmail.com', '$2y$10$.0FjSUlvSYytshXfFvhlBuvahaCIr2C/QmmK5mX/TNmh0grnyy/4e', '9619079099', '', '', '', '', '', '2024-09-14 20:18:25', '0000-00-00 00:00:00', 'Active', 2),
(26, 'ivan', 'jessmar@gmail.com', '$2y$10$dBGTluLrbSA4kUqw/oN4.uwDZRek6VmOSfQIxSqSiiPL.PG9n4Sce', '9619079099', 'poblaciom', 'camp jmc', 'phili', '8701', '', '2024-09-14 22:26:35', '0000-00-00 00:00:00', 'Active', 2),
(27, 'aldrin', 'joe@gmail.com', '$2y$10$k/TcB2p47wNYAkHr2Ts2I.g9kcWgVqehr5PoBVY3B.hrQs0A0U7L.', '0912345678', '', '', '', '', '', '2024-11-18 17:20:19', '0000-00-00 00:00:00', 'Active', 2),
(29, 'admin', 'admin1@gmail.com', '$2y$10$CuBV5vE8D8tcd9yIvwsXUesEXZpN9gTLhvMYjHRblf6FFJCbZa0aC', '09753340537', '', '', '', '', '', '2024-11-08 08:57:50', '0000-00-00 00:00:00', 'Active', 1),
(30, 'andrion', 'adrion@gmail.com', '$2y$10$sR1TZq0.bTc5G9wxnG2QauPiHqtP6GFhRfHFF64FWsSByLpS019EO', '0912345678', '', '', '', '', '', '2024-10-30 16:29:00', '0000-00-00 00:00:00', 'Active', 2),
(31, 'jessmar ', 'dalahigon@gmail.com', '$2y$10$kopJBjM15PGFCHPIQ9f7Ce8b1SC74E3/yeqqiqmp.dpCJpB4xBEeK', '9360212391', '', '', '', '', '', '2024-10-01 12:15:30', '0000-00-00 00:00:00', 'Active', 2),
(32, 'aldrin joe', 'aldrinskie123@gmail.com', '$2y$10$/OGGDbTVsy68RBe9qeeUCOyak/288V79iD5JSXUp1Ld3mm8rjlLFq', '0975334053', 'camp jmc', 'camp jmc', 'ph', '123', '', '2024-11-06 09:23:12', '0000-00-00 00:00:00', 'Active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tools_equipment`
--

CREATE TABLE `tools_equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('available','borrowed','lost','broken') DEFAULT 'available',
  `borrowed_by` varchar(255) DEFAULT NULL,
  `date_borrowed` date DEFAULT NULL,
  `date_to_return` date DEFAULT NULL,
  `penalty` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tools_equipment`
--

INSERT INTO `tools_equipment` (`id`, `name`, `quantity`, `status`, `borrowed_by`, `date_borrowed`, `date_to_return`, `penalty`) VALUES
(7, 'bangko', 50, 'available', NULL, NULL, NULL, NULL),
(8, 'table', 20, 'available', NULL, NULL, NULL, NULL),
(9, 'tent', 10, 'available', NULL, NULL, NULL, NULL),
(10, 'trapal', 10, 'available', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tools_history`
--

CREATE TABLE `tools_history` (
  `id` int(11) NOT NULL,
  `tool_id` int(11) NOT NULL,
  `tool_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrowed_by` varchar(255) NOT NULL,
  `date_borrowed` datetime NOT NULL,
  `date_to_return` datetime NOT NULL,
  `date_returned` datetime DEFAULT NULL,
  `status` enum('borrowed','returned') NOT NULL DEFAULT 'borrowed',
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tools_history`
--

INSERT INTO `tools_history` (`id`, `tool_id`, `tool_name`, `quantity`, `borrowed_by`, `date_borrowed`, `date_to_return`, `date_returned`, `status`, `phone_number`) VALUES
(24, 7, 'bangko', 10, 'aldrin', '2024-10-02 00:00:00', '2024-10-03 00:00:00', '2024-10-02 09:42:38', 'returned', '09123456789'),
(25, 7, 'bangko', 10, 'andrion', '2024-10-02 00:00:00', '2024-10-10 00:00:00', '2024-10-02 09:42:52', 'returned', '123234445456'),
(26, 14, 'aldrin', 2, 'andrion', '2024-10-02 00:00:00', '2024-10-09 00:00:00', '2024-10-02 11:31:56', 'returned', '09123456789'),
(27, 9, 'tent', 10, 'ritchel', '2024-10-02 00:00:00', '2024-10-03 00:00:00', '2024-10-02 12:01:22', 'returned', '09123456789'),
(28, 7, 'bangko', 10, 'andrion', '2024-10-03 00:00:00', '2024-10-04 00:00:00', '2024-10-03 10:24:19', 'returned', '09123456789'),
(29, 9, 'tent', 1, 'andrion', '2024-10-03 00:00:00', '2024-10-04 00:00:00', '2024-10-03 14:30:22', 'returned', '09123456789'),
(30, 7, 'bangko', 20, 'andrion', '2024-10-03 00:00:00', '2024-10-04 00:00:00', '2024-10-03 15:45:01', 'returned', '09123456789'),
(31, 7, 'bangko', 30, 'andrion', '2024-10-03 00:00:00', '2024-10-04 00:00:00', '2024-10-03 15:48:52', 'returned', '09123456789'),
(32, 11, 'andrion', 12, 'aldrin', '2024-10-07 00:00:00', '2024-10-08 00:00:00', '2024-10-08 17:31:56', 'returned', '12345'),
(33, 8, 'table', 5, 'aldrin', '2024-10-14 00:00:00', '2024-10-15 00:00:00', '2024-10-14 12:40:29', 'returned', '09123456789'),
(34, 10, 'trapal', 5, 'aldrin', '2024-10-16 00:00:00', '2024-10-17 00:00:00', '2024-10-16 08:20:15', 'returned', '09123456789'),
(35, 9, 'tent', 5, 'aldrin', '2024-11-09 00:00:00', '2024-11-14 00:00:00', '2024-11-09 15:54:06', 'returned', '09753340537'),
(36, 7, 'bangko', 10, 'aldrin', '2024-11-09 00:00:00', '2024-11-18 00:00:00', '2024-11-09 15:55:48', 'returned', '123'),
(37, 7, 'bangko', 5, 'andree', '2024-11-10 00:00:00', '2024-11-11 00:00:00', '2024-11-10 21:40:37', 'returned', '21432');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `log_ID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `userip` binary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `logout` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`log_ID`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`, `user_ID`) VALUES
(28, 0, 'ivan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-02 06:59:34', '02-09-2024 02:59:34 PM', 1, 21),
(29, 0, 'admin@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-02 06:59:43', '', 1, 20),
(30, 0, 'ivan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-02 07:00:09', '', 1, 21),
(31, 0, 'admin@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-02 09:20:57', '02-09-2024 05:20:57 PM', 1, 20),
(32, 0, 'ivan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-02 09:21:08', '', 1, 21),
(33, 0, 'ivan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-02 09:26:44', '02-09-2024 05:26:44 PM', 1, 21),
(34, 0, 'ivan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-02 14:22:07', '02-09-2024 10:22:07 PM', 1, 21),
(35, 0, 'ivan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-03 01:46:39', '03-09-2024 09:46:39 AM', 1, 21),
(36, 0, 'admin@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-03 01:47:02', '', 1, 20),
(37, 0, 'admin@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-03 01:55:22', '', 1, 20),
(38, 0, 'ivan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-03 01:57:22', '03-09-2024 09:57:22 AM', 1, 21),
(39, 0, 'ivan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 12:19:47', '04-09-2024 08:19:47 PM', 1, 21),
(40, 0, 'ivan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 14:41:45', '04-09-2024 10:41:45 PM', 1, 21),
(41, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 14:49:41', '04-09-2024 10:49:41 PM', 1, 26),
(42, 0, 'joe@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 14:50:41', '04-09-2024 10:50:41 PM', 1, 27),
(43, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 14:50:50', '04-09-2024 10:50:50 PM', 1, 26),
(44, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 17:22:30', '05-09-2024 01:22:30 AM', 1, 26),
(45, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 17:26:37', '05-09-2024 01:26:37 AM', 1, 26),
(46, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 17:49:28', '05-09-2024 01:49:28 AM', 1, 26),
(47, 0, 'joe@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 17:49:37', '05-09-2024 01:49:37 AM', 1, 27),
(51, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 18:21:22', '', 1, 29),
(52, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 18:21:38', '05-09-2024 02:21:38 AM', 1, 26),
(53, 0, 'joe@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 18:22:11', '05-09-2024 02:22:11 AM', 1, 27),
(54, 0, 'dalahigon@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 18:41:01', '05-09-2024 02:41:01 AM', 1, 31),
(55, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 18:41:13', '', 1, 29),
(56, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-04 18:41:28', '', 1, 29),
(57, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-05 02:07:47', '', 1, 29),
(58, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-05 02:51:44', '05-09-2024 10:51:44 AM', 1, 26),
(59, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-05 02:52:01', '', 1, 29),
(60, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-05 15:03:10', '', 1, 29),
(61, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-06 02:26:27', '', 1, 29),
(62, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-06 05:44:33', '', 1, 29),
(63, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-06 05:52:08', '', 1, 29),
(64, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-06 06:06:33', '', 1, 26),
(65, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-06 06:48:23', '', 1, 26),
(66, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-06 07:00:50', '', 1, 29),
(67, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-06 07:24:34', '', 1, 29),
(68, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-07 13:33:20', '', 1, 26),
(69, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-07 13:33:59', '', 1, 29),
(70, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-08 08:01:20', '', 1, 29),
(71, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-08 08:01:59', '', 1, 26),
(72, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-08 11:38:56', '', 1, 29),
(73, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-08 23:42:53', '', 1, 29),
(74, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-09 00:45:18', '', 1, 29),
(75, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-09 03:12:34', '', 1, 26),
(76, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-09 05:44:07', '', 1, 29),
(77, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-09 15:55:59', '', 1, 29),
(78, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-09 16:22:08', '', 1, 29),
(79, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-09 17:05:19', '', 1, 26),
(80, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-10 07:11:10', '', 1, 29),
(81, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-10 07:16:50', '', 1, 26),
(82, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-21 00:13:57', '', 1, 29),
(83, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-21 00:48:21', '', 1, 29),
(84, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-21 02:22:54', '', 1, 29),
(85, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-21 04:19:27', '', 1, 29),
(86, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-24 22:52:57', '', 1, 29),
(87, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-24 22:55:00', '', 1, 29),
(88, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-30 17:09:53', '', 1, 32),
(89, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-30 21:40:21', '', 1, 29),
(90, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-30 21:49:53', '', 1, 32),
(91, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-30 21:58:50', '', 1, 32),
(92, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-09-30 22:59:07', '', 1, 32),
(93, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-01 15:36:51', '', 1, 32),
(94, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-01 20:28:36', '', 1, 32),
(95, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-02 00:45:51', '', 1, 29),
(96, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-02 15:56:27', '', 1, 29),
(97, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-02 15:57:11', '', 1, 32),
(98, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-02 15:59:46', '', 1, 32),
(99, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-02 16:51:14', '', 1, 32),
(100, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-02 19:02:22', '', 1, 32),
(101, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-03 16:18:44', '', 1, 32),
(102, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-03 18:36:33', '', 1, 32),
(103, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-03 21:20:05', '', 1, 32),
(104, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-03 21:20:31', '', 1, 32),
(105, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-04 00:15:45', '', 1, 32),
(106, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-04 02:11:25', '', 1, 32),
(107, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-04 02:19:48', '04-10-2024 10:19:48 AM', 1, 32),
(108, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-04 02:20:18', '04-10-2024 10:20:18 AM', 1, 32),
(109, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-04 02:45:19', '', 1, 32),
(110, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-07 14:16:26', '', 1, 32),
(111, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-08 00:08:35', '08-10-2024 08:08:35 AM', 1, 32),
(112, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-08 00:08:47', '08-10-2024 08:08:47 AM', 1, 32),
(113, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-08 00:20:20', '', 1, 32),
(114, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-08 14:49:37', '', 1, 32),
(115, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-08 17:27:00', '', 1, 32),
(116, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-08 18:21:39', '', 1, 32),
(117, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-08 23:24:46', '', 1, 32),
(118, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-08 23:26:07', '', 1, 32),
(119, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-10 15:02:46', '', 1, 29),
(120, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-10 15:27:40', '', 1, 29),
(121, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-10 15:28:01', '', 1, 29),
(122, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-10 18:51:15', '', 1, 32),
(123, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-10 23:38:58', '', 1, 32),
(124, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-13 23:09:50', '', 1, 32),
(125, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-14 17:41:01', '', 1, 32),
(126, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-14 22:55:55', '', 1, 32),
(127, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-14 23:20:03', '', 1, 29),
(128, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-16 15:10:41', '', 1, 32),
(129, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-17 18:09:23', '', 1, 32),
(130, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-17 19:45:14', '', 1, 32),
(131, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-31 16:26:31', '', 1, 32),
(132, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-10-31 17:53:00', '01-11-2024 01:53:00 AM', 1, 32),
(133, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-04 13:53:56', '', 1, 32),
(134, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-04 13:54:31', '', 1, 29),
(135, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 18:10:20', '06-11-2024 02:10:20 AM', 1, 32),
(136, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 18:10:24', '', 1, 32),
(137, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 19:00:12', '', 1, 32),
(138, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-08 03:57:46', '', 1, 32),
(139, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-08 07:31:28', '', 1, 32),
(140, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-08 15:23:02', '', 1, 32),
(141, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-08 15:36:43', '', 1, 32),
(142, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-08 16:17:58', '', 1, 32),
(143, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-08 19:45:26', '', 1, 32),
(144, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-08 19:46:28', '09-11-2024 03:46:28 AM', 1, 29),
(145, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-08 19:46:43', '', 1, 32),
(146, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-09 23:12:23', '', 1, 32),
(147, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-09 23:13:18', '10-11-2024 07:13:18 AM', 1, 29),
(148, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-09 23:22:00', '10-11-2024 07:22:00 AM', 1, 32),
(149, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 03:09:07', '10-11-2024 11:09:07 AM', 1, 32),
(150, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 03:25:17', '', 1, 29),
(151, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 03:25:41', '', 1, 32),
(152, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 03:26:07', '', 1, 29),
(153, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 03:57:57', '', 1, 29),
(154, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 06:32:36', '10-11-2024 02:32:36 PM', 1, 32),
(155, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 08:00:20', '10-11-2024 04:00:20 PM', 1, 32),
(156, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 08:02:04', '', 1, 32),
(157, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 09:17:18', '', 1, 32),
(158, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 21:35:30', '', 1, 32),
(159, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 21:38:44', '11-11-2024 05:38:44 AM', 1, 29),
(160, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 21:38:51', '', 1, 32),
(161, 0, 'aldrinskie123@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-11 02:21:54', '', 1, 32),
(162, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-11 02:22:58', '', 1, 29),
(163, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 11:32:51', '', 1, 26),
(164, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 12:00:14', '10-11-2024 08:00:14 PM', 1, 29),
(165, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 13:42:53', '10-11-2024 09:42:53 PM', 1, 26),
(166, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 13:43:26', '', 1, 26),
(167, 0, 'admin1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 13:54:39', '', 1, 29),
(168, 0, 'jessmar@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-10 15:21:11', '', 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `user_type_access`
--

CREATE TABLE `user_type_access` (
  `userAccess_ID` int(11) NOT NULL,
  `accessType` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type_access`
--

INSERT INTO `user_type_access` (`userAccess_ID`, `accessType`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowed_tools`
--
ALTER TABLE `borrowed_tools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tool_id` (`tool_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `complaintremark`
--
ALTER TABLE `complaintremark`
  ADD PRIMARY KEY (`remark_ID`),
  ADD KEY `complaint_ID` (`complaint_ID`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_ID`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`sub_ID`),
  ADD KEY `category_ID` (`category_ID`);

--
-- Indexes for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  ADD PRIMARY KEY (`complaint_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `tbl_user_ibfk_1` (`userAccess_ID`);

--
-- Indexes for table `tools_equipment`
--
ALTER TABLE `tools_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools_history`
--
ALTER TABLE `tools_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`log_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `user_type_access`
--
ALTER TABLE `user_type_access`
  ADD PRIMARY KEY (`userAccess_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowed_tools`
--
ALTER TABLE `borrowed_tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `complaintremark`
--
ALTER TABLE `complaintremark`
  MODIFY `remark_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `sub_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  MODIFY `complaint_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tools_equipment`
--
ALTER TABLE `tools_equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tools_history`
--
ALTER TABLE `tools_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `log_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `user_type_access`
--
ALTER TABLE `user_type_access`
  MODIFY `userAccess_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_tools`
--
ALTER TABLE `borrowed_tools`
  ADD CONSTRAINT `borrowed_tools_ibfk_1` FOREIGN KEY (`tool_id`) REFERENCES `tools_equipment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complaintremark`
--
ALTER TABLE `complaintremark`
  ADD CONSTRAINT `complaintremark_ibfk_1` FOREIGN KEY (`complaint_ID`) REFERENCES `tblcomplaints` (`complaint_ID`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_ID`) REFERENCES `category` (`category_ID`);

--
-- Constraints for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  ADD CONSTRAINT `tblcomplaints_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `tbl_user` (`user_ID`);

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`userAccess_ID`) REFERENCES `user_type_access` (`userAccess_ID`);

--
-- Constraints for table `userlog`
--
ALTER TABLE `userlog`
  ADD CONSTRAINT `userlog_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `tbl_user` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
