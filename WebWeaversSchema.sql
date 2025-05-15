-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 08:32 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EoiID` smallint(6) NOT NULL,
  `ReferenceNumber` varchar(20) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` enum('Female','Male','Other/Unspecified') NOT NULL,
  `StreetAddress` varchar(40) NOT NULL,
  `Suburb` varchar(40) NOT NULL,
  `State` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
  `Postcode` tinyint(4) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `PhoneNumber` tinyint(4) NOT NULL,
  `TechnicalSkills` enum('Knowledge of AWS/Azure cloud platforms','Familiarity with scripting languages (e.g. Bash, Python)','System administration skills','Cloud automation proficiency','Knowledge of cloud security best practices') DEFAULT NULL,
  `OtherSkills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `JobsID` smallint(6) NOT NULL,
  `ReferenceNumber` varchar(20) NOT NULL,
  `PositionTitle` varchar(255) NOT NULL,
  `Role` text NOT NULL,
  `SalaryRange` varchar(255) DEFAULT NULL,
  `ReportsTo` varchar(255) NOT NULL,
  `RelevanceHeading` varchar(255) NOT NULL,
  `RelevanceDescription` text NOT NULL,
  `ApplyHyperLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`JobsID`, `ReferenceNumber`, `PositionTitle`, `Role`, `SalaryRange`, `ReportsTo`, `RelevanceHeading`, `RelevanceDescription`, `ApplyHyperLink`) VALUES
(1, 'COS01', 'Junior Cloud Engineer', 'Join our cloud engineering team to assist with designing, implementing, and maintaining cloud-based infrastructure, with opportunities to grow and innovate in a supportive environment.', '$70,000 - $90,000 AUD per annum', 'Senior Cloud Engineer', 'Why Cloud Engineering is Relevant', 'With the rapid shift toward cloud infrastructure across industries, we are in need of skilled engineers to build and maintain our systems. This role offers a fantastic entry point for aspiring professionals looking to grow with evolving technologies.', './apply.html'),
(2, 'COS02', 'Cloud Systems Administrator (Level 2)', 'Manage hybrid cloud systems across AWS and Azure, ensuring their security, performance, and reliability while supporting mission-critical enterprise operations.', '$95,000 - $120,000 AUD per annum', 'Cloud Infrastructure Manager', 'Importance of Cloud Systems Administration', 'As our partners adopt hybrid and multi-cloud strategies, experienced administrators play a vital role in ensuring security, performance, and reliability. This role supports mission-critical operations and provides real-world experience in enterprise settings.', './apply.html');

-- --------------------------------------------------------

--
-- Table structure for table `perks`
--

CREATE TABLE `perks` (
  `PerkID` smallint(6) NOT NULL,
  `Reasons` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `perks`
--

INSERT INTO `perks` (`PerkID`, `Reasons`) VALUES
(1, 'Flexible working arrangements, with the option to work from home three days a week.'),
(2, 'A home office setup allowance.'),
(3, 'An additional two weeks of annual leave.'),
(4, 'Health & wellbeing benefits including discounts on gym memberships.');

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `QualificationsID` smallint(6) NOT NULL,
  `JobsID` smallint(6) NOT NULL,
  `Qualification` text DEFAULT NULL,
  `ColumnType` enum('essential','preferable') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`QualificationsID`, `JobsID`, `Qualification`, `ColumnType`) VALUES
(1, 1, 'Basic knowledge of AWS and/or Azure platforms.', 'essential'),
(2, 1, 'Proficiency in a scripting language such as Python or Bash.', 'essential'),
(3, 1, 'Understanding of IAM and cloud security fundamentals.', 'essential'),
(4, 1, 'Strong analytical and communication skills.', 'essential'),
(5, 1, '1+ year experience through coursework, internships, or personal projects.', 'essential'),
(6, 1, 'Experience with Infrastructure-as-Code tools like Terraform or CloudFormation.', 'preferable'),
(7, 1, 'Exposure to DevOps tools like Docker or Jenkins.', 'preferable'),
(8, 1, 'Azure Fundamentals or AWS Certified Cloud Practitioner certification.', 'preferable'),
(9, 2, '3+ years in cloud or systems administration roles.', 'essential'),
(10, 2, 'Advanced knowledge of Microsoft Azure and AWS platforms.', 'essential'),
(11, 2, 'Experience managing Windows Server environments in cloud setups.', 'essential'),
(12, 2, 'Strong scripting skills and experience with Terraform or CloudFormation.', 'essential'),
(13, 2, 'Solid understanding of IAM, VPNs, firewalls, and data protection best practices.', 'essential'),
(14, 2, 'Relevant certifications (e.g., AWS SysOps Administrator, Azure Administrator Associate).', 'preferable'),
(15, 2, 'Experience with Kubernetes or container-based deployments.', 'preferable'),
(16, 2, 'Familiarity with CI/CD pipelines and monitoring tools.', 'preferable');

-- --------------------------------------------------------

--
-- Table structure for table `responsibilities`
--

CREATE TABLE `responsibilities` (
  `ResponsibilityID` smallint(6) NOT NULL,
  `JobsID` smallint(6) NOT NULL,
  `Responsibility` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `responsibilities`
--

INSERT INTO `responsibilities` (`ResponsibilityID`, `JobsID`, `Responsibility`) VALUES
(1, 1, 'Assist in deploying and managing cloud services across AWS and Azure.'),
(2, 1, 'Support senior engineers with troubleshooting and optimization tasks.'),
(3, 1, 'Write scripts for cloud automation tasks and system monitoring.'),
(4, 1, 'Ensure compliance with security policies and documentation standards.'),
(5, 1, 'Participate in code reviews and team knowledge-sharing sessions.'),
(6, 2, 'Monitor, maintain, and optimize cloud infrastructure.'),
(7, 2, 'Provision and manage virtual machines, storage, and network resources.'),
(8, 2, 'Automate system updates and deployments using Infrastructure-as-Code.'),
(9, 2, 'Implement security configurations and perform risk assessments.'),
(10, 2, 'Provide Tier 2 support for cloud-related service issues.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EoiID`),
  ADD UNIQUE KEY `EmailAddress` (`EmailAddress`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`),
  ADD KEY `ReferenceNumber` (`ReferenceNumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`JobsID`),
  ADD UNIQUE KEY `ReferenceNumber` (`ReferenceNumber`);

--
-- Indexes for table `perks`
--
ALTER TABLE `perks`
  ADD PRIMARY KEY (`PerkID`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`QualificationsID`),
  ADD KEY `JobsID` (`JobsID`);

--
-- Indexes for table `responsibilities`
--
ALTER TABLE `responsibilities`
  ADD PRIMARY KEY (`ResponsibilityID`),
  ADD KEY `JobsID` (`JobsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EoiID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `JobsID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `perks`
--
ALTER TABLE `perks`
  MODIFY `PerkID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `QualificationsID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `responsibilities`
--
ALTER TABLE `responsibilities`
  MODIFY `ResponsibilityID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eoi`
--
ALTER TABLE `eoi`
  ADD CONSTRAINT `eoi_ibfk_1` FOREIGN KEY (`ReferenceNumber`) REFERENCES `jobs` (`ReferenceNumber`) ON DELETE CASCADE;

--
-- Constraints for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD CONSTRAINT `qualifications_ibfk_1` FOREIGN KEY (`JobsID`) REFERENCES `jobs` (`JobsID`) ON DELETE CASCADE;

--
-- Constraints for table `responsibilities`
--
ALTER TABLE `responsibilities`
  ADD CONSTRAINT `responsibilities_ibfk_1` FOREIGN KEY (`JobsID`) REFERENCES `jobs` (`JobsID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
