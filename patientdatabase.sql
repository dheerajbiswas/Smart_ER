-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 02:16 PM
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
-- Database: `patientdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `salute` varchar(10) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Council_registration` varchar(50) DEFAULT NULL,
  `hospital` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `whatsapp_no` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `speciality` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `username`, `password`, `role`, `salute`, `Name`, `Council_registration`, `hospital`, `phone_no`, `whatsapp_no`, `email`, `speciality`) VALUES
(1, 'naman', 'aiims@123', 'expert', 'Dr.', 'NaAgr', '123456789', NULL, '753421869', '753421869', 'namanemaiims@gmail.com', 'Emergency Medicine'),
(2, 'dheeraj', 'iitbh@123', 'user', 'Mr.', 'Dheeraj Kumar Biswas', 'zxc321', 'Aiims Raipur', '2147483647', '2147483647', 'dheerajb@iitbhilai.ac.in', 'None'),
(3, 'preeti24', 'shivanya@24', 'expert', 'Mrs.', 'Preeti Tiwari', '0990', NULL, '2147483647', '2147483647', 'preetit@iitbhilai.ac.in', 'Cardiology'),
(4, 'kajal', 'kajal@123', 'user', 'Miss', 'Kajal Kumari Sahu', '159487', 'clinic', '789456123', '789456123', 'kajal@xyz.com', 'None'),
(5, 'dheerajgupta', 'dheeraj@123', 'expert', 'Dr.', 'Dheeraj Gupta', '78936451', NULL, '123456789', '123456789', 'dheeraj.kumar@ssipmt.com', 'General Medicine'),
(6, 'mukesh', 'mukesh', 'expert', 'Mr.', 'Mukesh  Ambani', '13579', NULL, '1234567890', '1234567890', 'dheeraj.kumar@ssipmt.com', 'General Medicine'),
(7, 'dayand12', 'qwerty', 'expert', 'Mr.', 'Dayanand Tripathi', '741852963', NULL, '852963', '852963', 'asd@asd.com', 'Anesthesiology'),
(8, 'namename', '123qwe', 'user', 'Mr.', 'Aditya Vaibhav Malhotra', '412412412', NULL, '159487', '159487', 'asd@asd.com', 'None'),
(25, 'tr_drnaman', 'namankvpy', 'expert', 'Dr.', 'Naman Agrawal', 'CGMC 9517/2019', 'AIIMS Raipur', '8373975527', '8373975527', 'namanemaiims@gmail.com', 'Emergency Medicine'),
(26, 'Saipavannani', '@sai,ram', 'user', 'Dr.', 'Bakaram Sai Pavan', 'TSMC/FMR/21763', 'Aiims Raipur', '8328101665 ', '9505794950', 'saipavannani09@gmail.com', 'None'),
(27, 'arif', '@@123', '', 'Dr.', 'ArifohammadMolla', '85131', 'Aiims Raipur', '9830881495', '9830881495', 'arif2837@gmail.com', 'None'),
(28, 'drdeeputhomasv', 'Deepu@123', 'user', 'Dr.', 'DeepuTho', '69903', 'Aiims Raipur', '8075718706', '8075718706', 'drdeeputhomasv@gmail.com', 'None'),
(29, 'R@mesh12345', 'R@mesh12345', 'user', 'Dr.', 'Ramesh Patil', '0375370', 'AIIMS RAIPUR', '7829121301', '7829121301', 'rameshspatil230898@gmail.com', 'None'),
(30, 'Bharti_gindlani', '040595', 'user', 'Dr.', 'Bharti Gindlani', '8948/2019', 'Aiims Raipur', '7999681510', '7999681510', 'aarohigindlani@gmail.com', 'None'),
(31, 'kavin', 'kavin521314032', 'user', 'Dr.', 'Kavin Duraisamy', '139624', 'AIIMS', '8760379391', '8760379391', 'kavinduraisamy92@gmail.com', 'None'),
(32, 'Akila Thiagarajan', 'akila@1997', 'user', 'Dr.', 'Akila Thiagarajan', '156639', 'AIIMS RAIPUR', '9626400157', '9626400157', 'akilathiayagu97@gmail.com', 'None'),
(33, 'Meena Choudary', 'Smarter@96', 'user', 'Dr.', 'Meena Choudary Maddineni', 'APMC/FMR/108419', 'Aiims Raipur', '7032496060', '7032496060', 'maddinenimeena@gmail.com', 'None'),
(34, 'Milan@12345', 'Milan@12345', 'user', 'Dr.', 'Milan M', '85130', 'Aiims Raipur', '9447623470', '9447623470', 'milan28manu@gmail.com', 'None'),
(35, 'Docsagarsachdev', 'Diy@tiya123', 'expert', 'Dr.', 'Sagar Sachdev', 'Cgmc 2019/8904', 'AIIMS Raipur', '8770362422', '8770362422', 'Docsagarsachdev@gmail.com', 'Emergency Medicine'),
(36, 'arif123', '12345678', 'user', 'Dr.', 'Arif Mohammad Molla', '85131', 'Aiims Raipur', '9830881495', '9830881495', 'arif2837@gmail.com', 'None'),
(37, 'Balaji03', 'Balaji03', 'expert', 'Dr.', 'Balaji Sah Bds', 'TNMC 126987', 'AIIMS Raipur', '6383573252', '6383573252', 'bds0391@gmail.com', 'Emergency Medicine'),
(38, 'Bakaramsaipavan', '@sai,ram', 'user', 'Dr.', 'Sai Pavan Bakaram', 'TSMC/FMR /21763', 'Aiims Raipur', '9505794950', '9505794950', 'bakaramsaipavan@gmail.com', 'None'),
(39, 'drsachin12', 'Sachin12@', 'user', 'Dr.', 'Sachin Devidas Ambure', 'MH12345', 'AIIMS Raipur', '8668710192', '8668710192', 'sachinambure98@gmail.com', 'None'),
(40, 'deepu9631', 'Ilovemyamma@9631', 'user', 'Dr.', 'Deepu  Thomas', '69903', 'Aiims Raipur', '8075718706', '8075718706', 'deepskerala@gmail.com', 'None'),
(41, 'Siddhartha', '10', 'user', 'Dr.', 'Siddhartha  Taneja', '108585', 'AIIMS Raipur', '9557921008', '9557921008', 'siddhartha.taneja@gmail.com', 'None'),
(42, 'Siddhartha', 'siddhattha', 'user', 'Dr.', 'Siddhartha  Taneja', '108585', 'AIIMS Raipur', '9557921008', '9557921008', 'siddhartha.taneja@gmail.com', 'None'),
(43, 'Merinjohn', 'Merinjohn@123', 'user', 'Dr.', 'Merin  John', '67389', 'AIIMS RAIPUR', '9895273693', '9895273693', 'merinjohn.jan7@gmail.com', 'None'),
(44, 'Mohanprasad@123', '1234567', 'user', 'Dr.', 'Mohan  Prasad', '170297', 'AIIMS RAIPUR', '9442753878', '9442753878', 'mohanprasadkumaresan07@gmail.com', 'None'),
(45, 'Sachin123', 'Sachin12e@', 'user', 'Dr.', 'Sachin Devidas Ambure', '2342', 'AIIMS Raipur', '8668710192', '', 'satabla12797@gmail.com', 'None'),
(46, 'Kk', 'karunesh22', 'user', 'Mr.', 'Kk  Rr', '88997789', '', '7000747871', '7000747871', 'karuneshrawat22@gmail.com', 'None'),
(47, 'Kr', 'karunesh22', 'expert', 'Mr.', 'Karunesh  Rawat', '94848484', 'Aiims', '7000747871', '7000747871', 'karuneshrawat22@gmail.com', 'Others'),
(48, 'Siddharth', 'aaaa', 'user', 'Mr.', 'Aniio Sss Sasas', '123', '32', '8988767', '8988766', 'drsantosathia84@gmail.com', 'None'),
(49, 'uuu', 'Uuu@2024', 'user', 'Miss', 'Mi  Sao', '1', '67', '879798899', '80999890000', 'hweuiu@gmail.com', 'None'),
(50, 'kshitiz', '123456', 'user', 'Mr.', 'Kshitiz  Sen', '1234567890', 'Xyz', '7879227772', '', 'kshitizsen010@gmail.com', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `patientregistration`
--

CREATE TABLE `patientregistration` (
  `sno` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `patientName` varchar(20) NOT NULL,
  `patientid` varchar(255) NOT NULL,
  `template` varchar(50) NOT NULL,
  `hospital` varchar(50) NOT NULL,
  `age` varchar(6) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `presentation` varchar(10) NOT NULL,
  `chiefComplain` longtext DEFAULT NULL,
  `comorbidities` mediumtext DEFAULT NULL,
  `others` mediumtext DEFAULT NULL,
  `allergy` mediumtext DEFAULT NULL,
  `symTemplate` text DEFAULT NULL,
  `diagTemplate` text DEFAULT NULL,
  `locatn` text DEFAULT NULL,
  `duration` text DEFAULT NULL,
  `charactr` text DEFAULT NULL,
  `severe` text DEFAULT NULL,
  `radiation` text DEFAULT NULL,
  `aggravate` text DEFAULT NULL,
  `comorbid` text DEFAULT NULL,
  `athero` text DEFAULT NULL,
  `assoc_comp` text DEFAULT NULL,
  `others2` varchar(100) DEFAULT NULL,
  `pulse` text DEFAULT NULL,
  `bp` text DEFAULT NULL,
  `rr` text DEFAULT NULL,
  `spo` text DEFAULT NULL,
  `prevMI` varchar(10) DEFAULT NULL,
  `on_exam` text DEFAULT NULL,
  `pedal` text DEFAULT NULL,
  `calftend` text DEFAULT NULL,
  `bilateral` text DEFAULT NULL,
  `auscult` text DEFAULT NULL,
  `abdomentend` varchar(10) DEFAULT NULL,
  `cvs` text DEFAULT NULL,
  `s1` text DEFAULT NULL,
  `s2` text DEFAULT NULL,
  `s3` text DEFAULT NULL,
  `pericardial` text DEFAULT NULL,
  `murmur` text DEFAULT NULL,
  `desc_abnorm` text DEFAULT NULL,
  `clinic_in` text DEFAULT NULL,
  `history` int(11) NOT NULL DEFAULT 0,
  `ecg` int(11) NOT NULL DEFAULT 0,
  `cal_age` int(11) NOT NULL DEFAULT 0,
  `cv_risk` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `ecgpath` varchar(100) DEFAULT NULL,
  `prescription_path` varchar(50) DEFAULT NULL,
  `expert_presc_path` varchar(100) DEFAULT NULL,
  `pat_details_path` varchar(50) DEFAULT NULL,
  `treated_by` varchar(50) DEFAULT NULL,
  `stat` varchar(20) DEFAULT NULL,
  `expertOpinion` varchar(20) DEFAULT NULL,
  `risk` varchar(20) DEFAULT NULL,
  `expertTime` varchar(50) DEFAULT NULL,
  `expertDate` varchar(50) DEFAULT NULL,
  `expertname` varchar(50) DEFAULT NULL,
  `proformaSubmit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientregistration`
--

INSERT INTO `patientregistration` (`sno`, `date`, `time`, `patientName`, `patientid`, `template`, `hospital`, `age`, `gender`, `presentation`, `chiefComplain`, `comorbidities`, `others`, `allergy`, `symTemplate`, `diagTemplate`, `locatn`, `duration`, `charactr`, `severe`, `radiation`, `aggravate`, `comorbid`, `athero`, `assoc_comp`, `others2`, `pulse`, `bp`, `rr`, `spo`, `prevMI`, `on_exam`, `pedal`, `calftend`, `bilateral`, `auscult`, `abdomentend`, `cvs`, `s1`, `s2`, `s3`, `pericardial`, `murmur`, `desc_abnorm`, `clinic_in`, `history`, `ecg`, `cal_age`, `cv_risk`, `total`, `ecgpath`, `prescription_path`, `expert_presc_path`, `pat_details_path`, `treated_by`, `stat`, `expertOpinion`, `risk`, `expertTime`, `expertDate`, `expertname`, `proformaSubmit`) VALUES
(12, '2023-08-03', '13:41:00', 'sahil', '741', '', '', '55', 'Male', 'non-trauma', 'shortness of breathe for 3 days', 'Diabetes,Hypertension, Coronary artery disease (CAD),Obesity', 'na', 'none', 'Chest pain', '', '', '', '', 'None', '', '', '', 'Null,Peripheral arterial disease,Past MI', 'Null,Nausea and vomiting,Expectoration', '', '77', '', '', '99', NULL, NULL, 'None', 'None', 'None', '', '', NULL, 'none', 'none', 'none', 'none', 'none', '', '', 0, 0, 1, 2, 3, 'uploads/741/741.jpg', NULL, NULL, NULL, NULL, 'Pending', NULL, 'High risk', NULL, NULL, NULL, NULL),
(13, '2023-08-12', '13:08:00', 'sudesh', '7856', '', '', '45', 'Male', 'non-trauma', 'chest pain for 12 hours\r\npalptation for 6 hours', 'Null', 'nil', 'nil', 'Chest pain', '', '', '', '', 'None', '', '', '', 'None', 'None', '', '89', '101/60', '', '100', 'No', NULL, 'No', 'No', 'Equal', '', 'No', NULL, 'Normal', 'Normal', 'Present', 'Present', 'Present', '', '', 0, 0, 1, 0, 1, 'uploads/7856/7856.jpg', NULL, NULL, NULL, '', '', 'Not Taken', 'Low risk', NULL, NULL, NULL, 'Filled'),
(14, '2023-07-27', '15:27:00', 'mukesh', '7878', '', '', '78', 'Male', 'non-trauma', 'bfbfbf', 'None', 'gbgb', 'asdf', 'Chest pain', 'none', 'durg', '3days', '', 'none', '', '', '', 'Null,None', 'Null,None', NULL, '', '', '', '', NULL, 'calftender', 'None', 'None', 'None', '', '', 'pericard', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2023-07-27', '03:02:00', 'Preeti', '7896', '', '', '30', 'Female', 'non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '2023-07-27', '03:57:00', 'Manoj', 'er45', '', '', '34', 'Male', 'non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '2023-07-26', '16:24:00', 'Aman', 'test', '', '', '24', 'Male', 'non-trauma', 'adasd', 'None', 'asdsad', '', 'Chest pain', '', '', '', '', 'none', '', '', '', 'Null', 'Null', NULL, '', '', '', '', NULL, '', 'None', 'None', 'None', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '2023-08-01', '13:17:00', 'testing', 'testing', '', '', '24', 'Male', 'trauma', NULL, NULL, NULL, NULL, 'none', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '2023-08-31', '14:36:00', 'Manish Sharma', '1234asd', '', 'MMI Raipur', '50', 'Male', 'Non-trauma', 'qwe\r\nqwe', 'Diabetes,Hypertension,Coronary artery disease (CAD)', 'none', 'none', 'Chest pain', '', 'nil', 'nil', 'nil', 'Moderate', 'nil', 'nil', 'nil', 'Past MI', 'Shortness of breath,Diaphoresis', 'nil', '78permin', '120/88', '54', '98', 'Yes', NULL, 'No', 'Yes', 'equal', 'nil', 'No', NULL, 'Abnormal', 'Normal', 'Absent', 'Absent', 'Absent', 'nil', 'nil', 1, 2, 1, 2, 6, 'uploads/1234asd/1234asd.jpg', 'uploads/1234asd/1234asd_field.pdf', 'uploads/1234asd/1234asd_expert.pdf', NULL, 'Dheeraj Kumar Biswas', 'Completed', 'Completed', 'High risk', '5:54 PM', '31-08-2023', 'Dheeraj Gupta', 'True'),
(31, '2023-09-05', '16:35:00', 'Karunesh', '12345678', '', '', '25', 'Male', 'Non-trauma', 'chest pain x 12 hours', 'FamCAD,Smoker,Obesity', 'nil', 'none', 'Chest pain', '', 'antiror', '12 hours', 'heaviness', 'Servere', 'none', 'none', 'none', 'Past MI', 'Shortness of breath,Diaphoresis', '', '89', '120/80', '23', '90', 'No', NULL, 'No', 'No', 'equal', 'nil', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'none', 'na', 2, 1, 0, 2, 5, 'uploads/12345678/12345678.jpg', NULL, NULL, NULL, 'Dheeraj Kumar Biswas', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(32, '2023-09-06', '12:55:00', 'Narayan Sahu', '229142301713714', '', 'Aiims Raipur', '48', 'Male', 'Non-trauma', 'Chest pain since 10pm yesterday maximum since 9 hours(typical chest pain)', 'None', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '9hours', 'Heaviness ', 'Servere', 'Neck', 'Nil', 'Nil', 'None', 'Diaphoresis', '', '112', '96/60', '20', '97', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Present', 'Present', 'Present', '', '', 2, 2, 1, 0, 5, 'uploads/229142301713714/229142301713714.jpg', NULL, 'uploads/229142301713714/229142301713714_expert.pdf', NULL, 'Milan  M', 'Pending', 'Completed', 'High risk', '1:34 PM', '06-09-2023', 'Naman Agrawal', 'True'),
(33, '2023-09-07', '16:19:00', 'Suresh Kaushik', '229142301501351', '', 'AIIMS RAIPUR', '50', 'Male', 'Non-trauma', 'Syncope', 'Diabetes', 'Nil', 'Nil', 'Chest pain', '', '', '', '', 'None', '', '', '', 'None', 'None', '', '36', 'Nr', '22', '80%', 'No', NULL, 'No', 'No', 'Equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 0, 2, 1, 1, 4, 'uploads/229142301501351/229142301501351.jpg', NULL, NULL, NULL, 'Ramesh Patil', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Sagar Sachdev', 'True'),
(34, '2023-09-09', '14:47:00', ' Nand Lal Sahu', '229142301735131', '', 'AIIMS RAIPUR', '63', 'Male', 'Non-trauma', 'Chest pain for 13 hours', 'None', 'Associated with palpitations & increased sweating ', 'No', 'Chest pain', '', 'Retrosternal ', '13 hrs 30 mins', 'Compressive ', 'None', 'Left arm', '', '', 'None', 'None', '', '75', '100/80', '18', '100 in RA', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'No', '', 2, 2, 1, 0, 5, 'uploads/229142301735131/229142301735131.jpg', NULL, 'uploads/229142301735131/229142301735131_expert.pdf', NULL, 'Akila Thiagarajan', 'Pending', 'Completed', 'High risk', '5:58 PM', '09-09-2023', 'Naman Agrawal', 'True'),
(35, '2023-09-12', '04:21:00', 'Dev Ram Sahu', '229142301751713', '', 'AIIMS RAIPUR', '72', 'Male', 'Non-trauma', 'chest pain since 12 hours', 'None', 'nil', 'nil', 'Chest pain', '', 'retrosternal', 'for 4 hours', 'burning type', 'Moderate', 'back', 'nil', 'after loading dose', 'None', 'None', '', '68', '110/70', '18', '99', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'nil', '', 2, 1, 2, 0, 5, 'uploads/229142301751713/229142301751713.jpg', NULL, NULL, NULL, 'Ramesh Patil', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(36, '2023-09-12', '04:29:00', 'Dev Ram Sahu', '229142301751713', '', 'AIIMS RAIPUR', '72', 'Male', 'Non-trauma', 'chest pain since 12 hours', 'None', 'nil', 'nil', 'Chest pain', '', 'retrosternal', 'for 4 hours', 'burning type', 'Moderate', 'back', 'nil', 'after loading dose', 'None', 'None', '', '68', '110/70', '18', '99', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'nil', '', 2, 1, 2, 0, 5, 'uploads/229142301751713/229142301751713.jpg', NULL, NULL, NULL, 'Ramesh Patil', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(37, '2023-09-12', '04:33:00', 'Bhure Lal Sahu', '2291423011751721', '', 'AIIMS RAIPUR', '65', 'Male', 'Non-trauma', 'chest pain since 6 hours', 'None', 'nil', 'nil', 'Chest pain', '', 'retrosternal', '6 hours', 'burning type', 'Servere', 'back', 'nil', 'nil', 'None', 'None', '', '76', '120/80', '18', '99', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'nil', '', 2, 2, 2, 0, 6, 'uploads/2291423011751721/2291423011751721.jpg', NULL, NULL, NULL, 'Ramesh Patil', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(38, '2023-09-12', '18:57:00', 'GENDALAL GUPTA', '229142201869067', '', 'AIIMS Raipur', '67', 'Male', 'Non-trauma', 'CHEST PAIN SINCE 2 DAYS INCREASE SINCE 3 HOURS', 'Hypertension,Malignancy', 'CARCINOMA RECTO SIGMOID OPERATED IN 2013', 'NO', 'Chest pain', '', 'RETROSTERNAL', '3 HOURS', 'HEAVINESS, CONSTRICTING', 'Moderate', 'NO RADIATING', 'NO', 'NO', 'None', 'Diaphoresis', 'PALPITAION', '64', '134/90', '14', '99', 'No', NULL, 'No', 'No', 'equal', 'NO', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 2, 1, 7, 'uploads/229142201869067/229142201869067.jpg', 'uploads/229142201869067/229142201869067_field.pdf', NULL, NULL, 'Sachin Devidas Ambure', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(39, '2023-09-15', '13:48:00', 'Praja Ram Sahu', '229142301784115', '', 'AIIMS', '62year', 'Male', 'Non-trauma', 'Complaints of chest pain for 2 hours', 'Smoker', '', 'Nil', 'Chest pain', '', 'Central chest', '2 hours', 'Stabbing', 'Servere', 'No', 'No', 'No', 'None', 'Nausea and vomiting,Diaphoresis', '', '90/min', '132/82 mmHg', '20/min', '98% in room air', 'No', NULL, 'No', 'No', 'equal', 'No', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 1, 6, 'uploads/229142301784115/229142301784115.jpg', 'uploads/229142301784115/229142301784115_field.pdf', NULL, NULL, 'Kavin Duraisamy', 'Pending', 'Pending', 'High risk', NULL, NULL, NULL, 'True'),
(40, '2023-09-13', '06:24:00', 'REWA RAM', '229142301762243', '', 'AIIMS Raipur', '44', 'Male', 'Non-trauma', 'CHEST PAIN FOR 8 HRS', 'Diabetes,Hypertension,Smoker', '', 'NO', 'Chest pain', '', 'RETROSTERNAL', '8 HOURS', 'HEAVINESS, CONSTRICTING', 'Moderate', 'BACK', 'NO', 'NO', 'None', 'Shortness of breath,Diaphoresis', 'UNEASINESS', '90', '134/90', '30', '90', 'No', NULL, 'No', 'No', 'equal', 'B/L BASAL CREPTS', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 0, 2, 6, 'uploads/229142301762243/229142301762243.jpg', 'uploads/229142301762243/229142301762243_field.pdf', NULL, NULL, 'Sachin Devidas Ambure', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(41, '2023-09-16', '22:48:00', 'Vivek Vishwakarma ', '229142301334047', '', 'AIIMS RAIPUR', '35', 'Male', 'Non-trauma', 'Chest pain for 7 hours', 'Coronary artery disease (CAD),FamCAD,Smoker', 'Nil', 'Nil', 'Chest pain', '', 'Bilateral chest wall', '7 hours', 'Compressive ', 'Moderate', 'Left arm & jaw', 'Nil', 'Relieved after taking isosorbide dinitrate & NTG', 'None', 'Nausea and vomiting', '', '100/min', '158/110mmhg', '20', '98% in RA', 'Yes', NULL, 'No', 'No', 'Equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Present', 'Absent', 'Nil', '', 2, 2, 0, 1, 5, 'uploads/229142301334047/229142301334047.jpg', NULL, NULL, NULL, 'Akila Thiagarajan', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(42, '2023-09-27', '22:39:00', 'Ramlal Jatwar', '229142301863406', '', 'AIIMS RAIPUR', '61', 'Male', 'Non-trauma', 'Chest pain', 'Hypertension', '', 'Nil', 'Chest pain', '', 'Retrosternal', '30hours', 'Heaviness', 'Servere', 'Non radiating', 'Nil', 'Nil', 'None', 'Nausea and vomiting,Diaphoresis', '', '68', '200/110', '18', '95%', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 1, 6, 'uploads/229142301863406/229142301863406.jpg', NULL, NULL, NULL, 'Ramesh Patil', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(43, '2023-09-30', '08:51:00', 'Natthu Sende', '229142301885876', '', 'AIIMS RAIPUR', '62', 'Male', 'Non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Ramesh Patil', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, '2023-09-30', '18:12:00', 'Jai Prakash Sharma', '229142301890616', '', 'Aiims Raipur', '60/M', 'Male', 'Non-trauma', 'Chest pain. X 1hour', 'None', '', 'Nil', 'Chest pain', '', 'Retrosternal ', '1 hour', 'Heaviness ', 'Servere', 'To left arm', 'Nil', 'Nil', 'None', 'None', '', '93', '106/70', '20', '99', 'No', NULL, 'No', 'No', 'equal', 'Nil', 'No', NULL, 'Normal', 'Normal', 'Present', 'Present', 'Present', '', '', 2, 2, 1, 0, 5, 'uploads/229142301890616/229142301890616.jpg', 'uploads/229142301890616/229142301890616_field.pdf', NULL, NULL, 'Milan M', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(45, '2023-10-05', '10:46:00', 'Shravan Singh', '20124578', '', 'Aiims Raipur', '36', 'Male', 'Non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Dheeraj Kumar Biswas', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, '2024-03-18', '13:39:00', 'Ram Palat Rajbhar', '229141900396101', '', 'AIIMS Raipur', '57', 'Male', 'Non-trauma', 'Chest pain \r\nAnxiety ', 'Hypertension', 'H/o asthma ', 'Asthma ', 'Chest pain', '', 'Central ', '2 hours ', 'Dull aching ', 'Servere', 'No', '', '', 'None', 'Diaphoresis', '', '67', '121/79', '28', '95', 'No', NULL, 'No', 'No', 'Equal', 'No', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 1, 6, 'uploads/229141900396101/229141900396101.jpg', 'uploads/229141900396101/229141900396101_field.pdf', NULL, NULL, 'Siddhartha  Taneja', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(47, '2024-03-18', '13:39:00', 'Ram Palat Rajbhar', '229141900396101', '', 'AIIMS Raipur', '57', 'Male', 'Non-trauma', 'Chest pain \r\nAnxiety ', 'Hypertension', 'H/o asthma ', 'Asthma ', 'Chest pain', '', 'Central ', '2 hours ', 'Dull aching ', 'Servere', 'No', '', '', 'None', 'Diaphoresis', '', '67', '121/79', '28', '95', 'No', NULL, 'No', 'No', 'Equal', 'No', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 1, 6, 'uploads/229141900396101/229141900396101.jpg', 'uploads/229141900396101/229141900396101_field.pdf', NULL, NULL, 'Siddhartha  Taneja', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(48, '2024-03-18', '15:15:00', 'Ram Palat', '229141900395101', '', 'AIIMS', '57', 'Male', 'Non-trauma', 'C/o chest pain', 'Hypertension', 'Nil', 'Nil', 'Chest pain', '', '', '', '', 'None', '', '', '', 'None', 'None', '', '62/min', '126/78mmHg', '20/min', '100%', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Present', 'Present', 'Present', '', '', 0, 0, 1, 1, 2, 'uploads/229141900395101/229141900395101.jpg', NULL, NULL, NULL, 'Kavin Duraisamy', 'Pending', 'Pending', 'Low risk', NULL, NULL, 'Naman Agrawal', 'Filled'),
(49, '2024-03-18', '15:22:00', 'Ram Palat', '229141900395101', '', 'AIIMS', '57', 'Male', 'Non-trauma', 'C/o chest pain', 'Hypertension', 'Nil', 'Nil', 'Chest pain', '', '', '', '', 'None', '', '', '', 'None', 'None', '', '62/min', '126/78mmHg', '20/min', '100%', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Present', 'Present', 'Present', '', '', 0, 0, 1, 1, 2, 'uploads/229141900395101/229141900395101.jpg', NULL, NULL, NULL, 'Kavin Duraisamy', 'Pending', 'Pending', 'Low risk', NULL, NULL, 'Naman Agrawal', 'Filled'),
(50, '2024-03-20', '12:51:00', 'Banshi sen', '229142400535224', '', 'AIIMS', '65', 'Male', 'Non-trauma', 'C/o chest pain', 'Hypertension', 'Nil', 'Nil', 'Chest pain', '', 'Central chest', '8 hours', 'Squeezing', 'Servere', 'Chin, left shoulder', 'Nil', 'Nil', 'None', 'None', 'No', '76/min', '132/82 mmHg', '20/min', '100%', 'No', NULL, 'No', 'No', 'equal', 'No', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 2, 1, 7, 'uploads/229142400535224/229142400535224.jpg', 'uploads/229142400535224/229142400535224_field.pdf', NULL, NULL, 'Kavin Duraisamy', 'Completed', 'Not Taken', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(51, '2024-03-20', '13:08:00', 'Raja ram yadav', '229142400526306', '', 'AIIMS', '65', 'Male', 'Non-trauma', 'C/o chest pain', 'Diabetes', 'Nil', 'Nil', 'Chest pain', '', 'Left side', '1.5 hours', 'Squeezing', 'Moderate', 'No', 'Nil', 'Nil', 'None', 'Nausea and vomiting,Diaphoresis', 'Nil', '90/min', '126/78 mmHg', '20/min', '100%', 'No', NULL, 'No', 'No', 'equal', 'Nil', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 1, 2, 2, 1, 6, 'uploads/229142400526306/229142400526306.jpg', NULL, NULL, NULL, 'Kavin Duraisamy', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(52, '2024-03-20', '13:18:00', 'Kailash chandra agra', '229142400391770', '', 'AIIMS', '58', 'Male', 'Non-trauma', 'C/o chest pain', 'Diabetes', 'Nil', 'Nil', 'Chest pain', '', 'Left side', '2.5 hours', 'Squeezing', 'Moderate', 'No', 'Nil', 'Nil', 'None', 'Nausea and vomiting,Shortness of breath,Diaphoresis', '', '76/min', '126/78 mmHg', '18/min', '100%', 'No', NULL, 'No', 'No', 'equal', 'Nil', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 1, 2, 1, 1, 5, 'uploads/229142400391770/229142400391770.jpg', NULL, 'uploads/229142400391770/229142400391770_expert.pdf', NULL, 'Kavin Duraisamy', 'Pending', 'Pending', 'High risk', '2:08 PM', '20-03-2024', 'Naman Agrawal', 'True'),
(53, '2024-03-15', '23:35:00', 'Sanjay Sharma', '229141900158846', '', 'AIIMS RAIPUR', '55', 'Male', 'Non-trauma', 'Chest pain since 11 hours', 'Diabetes', 'Seizure disorder ', 'Nil', 'Chest pain', '', 'Retrosternal ', '11 hours 30 mins ', 'Compressive ', 'Moderate', 'No', 'No', 'No', 'None', 'Diaphoresis', '', '121/min', '130/80', '14', '99 percent in room air', 'No', NULL, 'No', 'No', 'equal', 'Basal crepitation', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 1, 6, 'uploads/229141900158846/229141900158846.jpg', NULL, NULL, NULL, 'Mohan  Prasad', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(54, '2024-03-22', '19:00:00', 'Khemin Sahu', '229142400576311', '', 'AIIMS RAIPUR', '55', 'Female', 'Non-trauma', 'Chest pain & dizziness ', 'None', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal ', '13 hrs 30 min ', 'Compressive ', 'Moderate', 'Nik', '', '', 'None', 'None', 'Dizziness ', '46', '60/40mmhg', '13', '96', 'No', NULL, 'No', 'No', 'equal', 'Nil', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 0, 5, 'uploads/229142400576311/229142400576311.jpg', NULL, NULL, NULL, 'Mohan  Prasad', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(55, '2024-03-30', '17:00:00', 'Khamman Lal ', '229142400624057', '', 'AIIMS Raipur', '65', 'Male', 'Non-trauma', 'Chest discomfort ', 'Diabetes,Hypertension', 'Nil', 'Nil', 'Chest pain', '', 'Retorsternal ', '5 hours ', 'Burning ', 'Servere', 'Shoulders B/l', '', '', 'None', 'Shortness of breath', '', '75', '89/63', '25', '100', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 2, 1, 7, 'uploads/229142400624057/229142400624057.jpg', 'uploads/229142400624057/229142400624057_field.pdf', NULL, NULL, 'Siddhartha  Taneja', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(56, '2024-03-27', '05:02:00', 'Rakesh Patel', '229142400593356', '', 'AIIMS RAIPUR', '44', 'Male', 'Non-trauma', 'Chest pain since 12 am', 'None', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '5 hours', 'Heaviness', 'Servere', 'To left upper limb and back', 'Exertion ', 'Nil', 'None', 'Nausea and vomiting,Shortness of breath,Diaphoresis', '', '74', '140/80', '20', '99', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Present', 'Present', 'Present', '', '', 2, 2, 0, 0, 4, 'uploads/229142400593356/229142400593356.jpg', 'uploads/229142400593356/229142400593356_field.pdf', NULL, NULL, 'Mohan  Prasad', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(57, '2024-04-05', '16:29:00', 'Nandlal Yadav ', '229142202151917', '', 'AIIMS Raipur', '74', 'Male', 'Non-trauma', 'Chest pain ', 'Diabetes,Hypertension,Coronary artery disease (CAD)', 'S/p PTCA to right RCA', 'Nil', 'Chest pain', '', 'Retrosternal ', '5 hours ', 'Stabbing ', 'Moderate', 'Non radiating ', 'Working walking ', 'None', 'None', 'Nausea and vomiting,Diaphoresis', 'Only nausea no vomiting ', '52', '92/54', '15', '99', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 1, 2, 1, 6, 'uploads/229142202151917/229142202151917.jpg', NULL, NULL, NULL, 'Siddhartha  Taneja', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(58, '2024-04-05', '16:56:00', 'Manoj', '784569', '', 'AIIMS', '54', 'Male', 'Non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Kavin Duraisamy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, '2024-04-06', '18:06:00', 'Kartik', '229142400671438', '', 'AIIMS Raipur', '19', 'Male', 'Non-trauma', 'Chest pain', 'None', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '5 hours', 'Stabbing ', 'Moderate', 'No', 'No factors', 'None', 'None', 'Nausea and vomiting,Syncope,Diaphoresis', '', '122', '148/90', '30', '99', 'No', NULL, 'Yes', 'No', 'equal', 'Basal crepitataions on both sides ', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 1, 2, 0, 0, 3, 'uploads/229142400671438/229142400671438.jpg', NULL, 'uploads/229142400671438/229142400671438_expert.pdf', NULL, 'Siddhartha  Taneja', 'Pending', 'Completed', 'High risk', '6:30 PM', '06-04-2024', 'Naman Agrawal', 'True'),
(60, '2024-04-07', '17:10:00', 'Bodhan Singh', '229142400673082', '', 'AIIMS Raipur', '45', 'Male', 'none', 'Chest pain for 7 hours', 'Diabetes,Hypertension,Obesity', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '7 hours', 'Burning', 'Moderate', 'To left shoulder', 'Nil', 'Nil', 'Stroke', 'Nausea and vomiting,Diaphoresis', '', '93', '179/120', '20', '97', 'No', NULL, 'Yes', 'No', 'equal', 'Basal crepts present bilaterally ', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'Nil', 'Nil', 2, 2, 1, 2, 7, 'uploads/229142400673082/229142400673082.jpg', NULL, 'uploads/229142400673082/229142400673082_expert.pdf', NULL, 'Siddhartha  Taneja', 'Pending', 'Completed', 'High risk', '5:28 PM', '07-04-2024', 'Naman Agrawal', 'True'),
(61, '2024-04-08', '12:35:00', 'Jeevan Lal', '2242628262528292', '', 'AIIMS Raipur', '50', 'Male', 'Non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Siddhartha  Taneja', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, '2024-04-08', '12:38:00', 'Jeevan Lal', '2242628262528292', '', 'AIIMS Raipur', '50', 'Male', 'Non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Siddhartha  Taneja', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, '2024-04-08', '12:40:00', 'Jevan Lal', '3293930', '', 'AIIMS Raipur', '50', 'Male', 'Non-trauma', 'Chest pain', 'None', 'Nil', 'Nil', 'Chest pain', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56', '100/60', '34', '88', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Siddhartha  Taneja', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, '2024-04-08', '12:45:00', 'Jeevan Lal', '45679', '', 'AIIMS Raipur', '50', 'Male', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Siddhartha  Taneja', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, '2024-04-08', '12:51:00', 'Jevan Lal', '2345672662', '', 'AIIMS Raipur', '50', 'Male', 'Non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Siddhartha  Taneja', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, '2024-04-08', '13:50:00', 'Bhuvan', '229142400156631', '', 'AIIMS', '53', 'Male', 'Non-trauma', 'Chest pain for 8 hours', 'Diabetes,COPD', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '8 hours', 'Stabbing', 'Moderate', 'No', 'Nil', 'Nil', 'Stroke', 'Nausea and vomiting,Shortness of breath', 'Nil', '48', '114/62', '8', '85', 'No', NULL, 'No', 'No', 'equal', 'No', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 1, 1, 1, 2, 5, NULL, NULL, NULL, NULL, 'Kavin Duraisamy', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'Filled'),
(67, '2024-04-08', '14:07:00', 'Harman', '567', '', 'AIIMS Raipur', '45', 'Male', 'Non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48', '13', '14', '98', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Siddhartha  Taneja', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, '2024-04-08', '14:20:00', 'Hera', '678', '', 'AIIMS Raipur', '23', 'Male', 'Non-trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Siddhartha  Taneja', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, '2024-04-08', '14:22:00', 'Saroj Bai', '229142400679005', '', 'AIIMS', '60', 'Female', 'Non-trauma', 'Nil\r\n', 'Diabetes,ckd,Chronic liver disease,COPD', 'No', 'No', 'Chest pain', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '104', '15182', '18', '99', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Kavin Duraisamy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, '2024-04-08', '14:57:00', 'Bhuvanesh', '229142400199526', '', 'AIIMS', '45', 'Male', 'Non-trauma', 'Chest pain', 'None', 'No', 'No', 'Chest pain', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86', '99/67', '18', '99', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'uploads/229142400199526/229142400199526.jpg', NULL, NULL, NULL, 'Kavin Duraisamy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, '2024-04-08', '15:20:00', 'Dinesh', '229142400199626', '', 'AIIMS', '35', 'Male', 'Non-trauma', 'Chest pain for 6 hours', 'Coronary artery disease (CAD)', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '6 hours', 'Stabbing', 'Moderate', 'No', 'Nil', 'Nil', 'Past MI', 'Nausea and vomiting,Syncope,Diaphoresis', '', '89', '147/101', '23', '99', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 0, 1, 0, 2, 3, 'uploads/229142400199626/229142400199626.jpg', NULL, NULL, NULL, 'Kavin Duraisamy', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(72, '2024-04-08', '15:29:00', 'Souvik', '229142400199725', '', 'AIIMS', '27', 'Male', 'Non-trauma', 'Chest pain for 5 hours', 'Diabetes,Hypertension', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '6 hours', 'Stabbing', 'Moderate', 'No', 'Nil', 'Nil', 'Past MI', 'Nausea and vomiting,Shortness of breath,Syncope,Diaphoresis', '', '60', '124/86', '21', '96', 'No', NULL, 'No', 'No', 'equal', 'Nil', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'Nil', '', 2, 2, 0, 2, 6, 'uploads/229142400199725/229142400199725.jpg', NULL, NULL, NULL, 'Kavin Duraisamy', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(73, '2024-04-08', '17:25:00', 'Choko Ram', '229142400673112', '', 'AIIMS Raipur', '49', 'Male', 'Non-trauma', 'Chest pain for 5 hours', 'Diabetes,Hypertension,Obesity', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '5 hours', 'Stabbing', 'Moderate', 'No', 'Nil', 'Nil', 'None', 'Nausea and vomiting,Diaphoresis', '', '63', '96/58', '18', '100', 'No', NULL, 'No', 'No', 'equal', 'B/l basal crepts', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', 'Nil', 2, 2, 1, 2, 7, 'uploads/229142400673112/229142400673112.jpg', NULL, 'uploads/229142400673112/229142400673112_expert.pdf', NULL, 'Siddhartha  Taneja', 'Pending', 'Completed', 'High risk', '5:37 PM', '08-04-2024', 'Naman Agrawal', 'True'),
(74, '2024-04-09', '10:24:00', 'Ashok', '3456793087', '', 'AIIMS Raipur', '50', 'Male', 'Non-trauma', 'Chest pain for 5 hours', 'None', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '5 hours', 'Heaviness', 'Moderate', 'Radiation to left shoulder', 'Nil', 'Nil', 'None', 'Nausea and vomiting,Shortness of breath', 'Nil', '60', '124/86', '20', '98', 'No', NULL, 'No', 'No', 'equal', 'Basal bilateral crepts', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'Nil', 'Nil', 2, 2, 1, 1, 6, NULL, NULL, NULL, NULL, 'Siddhartha  Taneja', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'Filled'),
(75, '2024-04-09', '10:45:00', 'Ashok', '2291424556789', '', 'AIIMS Raipur', '50', 'Male', 'Non-trauma', 'Chest pain for 5 hours', 'Diabetes,Hypertension', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '5 hours', 'Heaviness', 'Moderate', 'Radiation to left shoulder', 'Nil', 'Nil', 'None', 'Nausea and vomiting,Shortness of breath', 'Nil', '56', '124/86', '21', '95', 'No', NULL, 'No', 'No', 'Equal', 'Bilateral crepts', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'Nil', 'Nil', 2, 2, 1, 1, 6, 'uploads/2291424556789/2291424556789.jpg', NULL, NULL, NULL, 'Siddhartha  Taneja', '', NULL, 'High risk', NULL, NULL, NULL, 'True'),
(76, '2024-04-09', '10:52:00', 'Shouvik', '229142400199725', '', 'AIIMS Raipur', '55', 'Male', 'Non-trauma', 'Chest pain for 5 hours', 'Diabetes,Hypertension', 'Nil', 'Nil', 'Chest pain', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', '124/86', '21', '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Siddhartha  Taneja', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, '2024-04-09', '10:56:00', 'Ashook', '45632467876', '', 'AIIMS Raipur', '50', 'Male', 'Non-trauma', 'Chest pain for 5 hours', 'Diabetes,Hypertension', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '5 hours', 'Heaviness', 'Moderate', 'Radiation to left shoulder', 'Nil', 'Nil', 'None', 'Nausea and vomiting,Shortness of breath', '', '52', '110/72', '16', '95', 'No', NULL, 'No', 'No', 'equal', 'Nil', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', 'Nil', 2, 2, 1, 1, 6, 'uploads/45632467876/45632467876.jpg', NULL, NULL, NULL, 'Siddhartha  Taneja', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(78, '2024-04-09', '11:54:00', 'Ramesh', '43216785', '', 'AIIMS Raipur', '48', 'Male', 'Non-trauma', 'Chest pain for 5 hours', 'Diabetes,Hypertension', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '5 hours', 'Heaviness', 'Moderate', 'Radiation to left shoulder', 'Nil', 'Nil', 'None', 'Nausea and vomiting,Shortness of breath', 'Nil', '58', '117/67', '23', '96', 'No', NULL, 'No', 'No', 'equal', 'Nil', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'Nil', 'Nil', 2, 2, 1, 1, 6, 'uploads/43216785/43216785.jpg', NULL, 'uploads/43216785/43216785_expert.pdf', NULL, 'Siddhartha  Taneja', 'Pending', 'Completed', 'High risk', '12:04 PM', '09-04-2024', 'Naman Agrawal', 'True'),
(79, '2024-04-09', '13:43:00', 'Tilak', '564326790', '', 'AIIMS Raipur', '54', 'Male', 'Non-trauma', 'Chest pain', 'Diabetes,Hypertension,Hypothyroidism,Coronary artery disease (CAD),ckd,COPD', 'No', 'No', 'Chest pain', '', 'Retrosternal', '6 hours', '', 'Servere', 'Radiation to left shoulder', 'Nil', 'Nil', 'None', 'Nausea and vomiting,Shortness of breath,Syncope', '', '104', '127/95', '16', '95', 'No', NULL, 'No', 'No', 'equal', 'Nil', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', 'Nil', 'Nil', 2, 2, 1, 1, 6, 'uploads/564326790/564326790.jpg', NULL, NULL, NULL, 'Siddhartha  Taneja', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'Filled'),
(80, '2024-04-06', '05:17:00', 'Arun Prasad Sav', '229142101078437', '', 'AIIMS RAIPUR', '50', 'Male', 'Non-trauma', 'Chest pain since 7 hours', 'Hypertension', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '7 hours', 'Burning type', 'Servere', 'Right upper limb', '', '', 'None', 'Diaphoresis', '', '81', '122/83', '21', '100', 'No', NULL, 'No', 'No', 'equal', 'No', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 1, 6, 'uploads/229142101078437/229142101078437.jpg', 'uploads/229142101078437/229142101078437_field.pdf', NULL, NULL, 'Mohan  Prasad', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(81, '2024-04-14', '14:00:00', 'Ravi Yadav', '229142400720471', '', 'AIIMS RAIPUR', '50', 'Male', 'Non-trauma', 'Chest pain 2 hours', 'Hypertension,Coronary artery disease (CAD)', 'Nil', 'Nil', 'Chest pain', '', '', '', '', 'None', '', '', '', 'None', 'None', '', '54', '156/100mmhg', '19', '98', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 1, 6, 'uploads/229142400720471/229142400720471.jpg', NULL, NULL, NULL, 'Mohan  Prasad', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(82, '2024-04-29', '03:58:00', 'Mithun Da', '123456', '', 'Aiims Raipur', '69', 'Male', 'Non-trauma', 'Nil', 'Diabetes,Hypertension,Smoker', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '5 hours', 'stabing', 'Mild', 'None', 'Nil', 'Nil', 'Peripheral arterial disease', 'Nausea and vomiting', 'Nil', '111', '127/76', '95', '37', 'No', NULL, 'No', 'No', 'equal', 'Nil', 'No', NULL, 'Normal', 'Normal', 'Present', 'Present', 'Absent', 'Nil', 'Nil', 2, 0, 2, 2, 6, 'uploads/123456/123456.jpg', NULL, NULL, NULL, 'Dheeraj Kumar Biswas', 'Pending', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(83, '2024-04-24', '11:09:00', 'Mahadevi Ghosh', '229142400786782', '', 'AIIMS RAIPUR', '53', 'Male', 'Non-trauma', 'Chest pain since 12 Am\r\nVomiting 10 episodes', 'Diabetes,Hypertension', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '11 hours 30 mins', 'Heaviness', 'Servere', 'To bilateral upper limb', '', '', 'None', 'None', '', '105', '130/90', '13', '97', 'No', NULL, 'No', 'No', 'equal', 'No', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 1, 6, 'uploads/229142400786782/229142400786782.jpg', 'uploads/229142400786782/229142400786782_field.pdf', NULL, NULL, 'Mohan  Prasad', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(84, '2024-04-20', '04:28:00', 'Balmakund Chauhan', '229142400758517', '', 'AIIMS RAIPUR', '63', 'Male', 'Non-trauma', 'Chest pain since 12 am\r\n', 'Hypertension', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal', '4 hours 30 minutes ', 'Compressive', 'None', '', '', '', 'None', 'None', '', '66', '160/100', '18', '97', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 2, 1, 1, 6, 'uploads/229142400758517/229142400758517.jpg', 'uploads/229142400758517/229142400758517_field.pdf', NULL, NULL, 'Mohan  Prasad', 'Completed', 'Not Taken', 'High risk', NULL, NULL, NULL, 'True'),
(85, '2024-05-06', '16:10:00', 'Demo', '456', '', 'AIIMS Raipur', '45', 'Male', 'Trauma', 'Pain', 'Diabetes,ckd', 'Nil\r\n', 'Nil\r\n', 'Chest pain', '', 'retrosternal', '5', 'stabbing', 'Servere', 'nil', 'Nil ', 'Nil', 'None', 'None', '', '89', '90/65', '18', '100', 'Yes', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 1, 1, 1, 5, 'uploads/456/456.jpg', NULL, NULL, NULL, 'Siddhartha  Taneja', 'Pending', 'Pending', 'High risk', NULL, NULL, 'Naman Agrawal', 'True'),
(86, '2024-05-06', '16:57:00', 'Daulat', '4125789', '', 'AIIMS Raipur', '32', 'Male', 'Non-trauma', 'Chest pain', 'None', 'Nil\r\n', 'Nil\r\n', 'Chest pain', '', 'retrosternal', '3 hours', 'heaviness', 'Moderate', 'left arm', 'Nil', 'Nil', 'None', 'Shortness of breath,Diaphoresis', '', '71', '103/68', '17', '97', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 2, 1, 0, 0, 3, 'uploads/4125789/4125789.jpg', NULL, 'uploads/4125789/4125789_expert.pdf', NULL, 'Siddhartha  Taneja', 'Pending', 'Completed', 'High risk', '5:06 PM', '06-05-2024', 'Naman Agrawal', 'True'),
(87, '2024-05-02', '21:09:00', 'Tularam Sahu', '229142400847861', '', 'AIIMS RAIPUR', '55', 'Male', 'Non-trauma', 'Chest pain from morning 3:00AM on 2/05/2024', 'None', 'Nil', 'Nil', 'Chest pain', '', 'Retrosternal ', '16 hours ', 'Compressive ', 'Moderate', '', '', '', 'None', 'None', '', '82', '96/70', '20', '96', 'No', NULL, 'No', 'No', 'equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 0, 0, 1, 0, 1, 'uploads/229142400847861/229142400847861.jpg', NULL, NULL, NULL, 'Mohan  Prasad', 'Pending', 'Not Taken', 'Low risk', NULL, NULL, NULL, 'True'),
(88, '2024-06-21', '11:20:00', 'Dheeraj', '14785', '', 'Aiims Raipur', '45', 'Male', 'Trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Dheeraj Kumar Biswas', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, '2024-06-29', '01:55:00', 'Mithun Dada', '78945', '', 'Aiims Raipur', '56', 'Male', 'Trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Dheeraj Kumar Biswas', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, '2024-08-30', '18:45:00', 'Kajsjdn', '737373838', '', '', '60', 'Female', 'Trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Kk  Rr', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, '2024-09-03', '14:51:00', 'Djfjs', 'jhwjfkjnw', '', '', '19', 'Male', 'Trauma', 'chest pain\r\nSOB\r\nnausea', 'Diabetes,Hypertension,FamCAD,Chronic liver disease,COPD,Malignancy', 'nil', 'none', 'Chest pain', '', 'chest', '3 hour', 'typical', 'Servere', 'right shoulder', 'exertion, fever', 'rest', 'Past coronary revascularization', 'Nausea and vomiting,Diaphoresis', '', '181', '100/60', '20', '99', 'No', NULL, 'No', 'No', 'equal', 'chest clear', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', 'past MVR', 0, 0, 0, 2, 2, 'uploads/jhwjfkjnw/jhwjfkjnw.jpg', 'uploads/jhwjfkjnw/jhwjfkjnw_field.pdf', NULL, NULL, 'Kk  Rr', 'Completed', 'Not Taken', 'Low risk', NULL, NULL, 'Naman Agrawal', 'True'),
(92, '2024-09-06', '16:38:00', 'Fghf', '45574752745', '', '', '19', 'Male', 'Trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '161', '98', '43', '2232', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Kk  Rr', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, '2024-10-15', '13:01:00', 'Suresh', '10101', '', 'Xyz', '23', 'Male', 'Trauma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 'Kshitiz  Sen', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, '2024-10-15', '17:02:00', 'Anoop', '123', '', '', '28', 'Male', 'Trauma', 'dd ', 'Hypertension,Smoker,ckd,Chronic liver disease', 'dsd', 'dfdf', 'Chest pain', '', '', '', '', 'None', '', '', '', 'None', 'None', '', '23', '56', '34', '95', 'No', NULL, 'No', 'No', 'Equal', '', 'No', NULL, 'Normal', 'Normal', 'Absent', 'Absent', 'Absent', '', '', 0, 0, 0, 1, 1, 'uploads/123/123.jpg', NULL, NULL, NULL, 'Kk  Rr', '', 'Not Taken', 'Low risk', NULL, NULL, NULL, 'Filled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patientregistration`
--
ALTER TABLE `patientregistration`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `patientregistration`
--
ALTER TABLE `patientregistration`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
