-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2025 at 07:06 AM
-- Server version: 10.11.11-MariaDB-0+deb12u1
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebWeaversSchema`
--

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `EmployeeID` smallint(6) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `StreetAddress` varchar(40) NOT NULL,
  `State` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
  `City` varchar(255) NOT NULL,
  `Postcode` smallint(6) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Gender` enum('Female','Male','Other/Unspecified') NOT NULL,
  `CompanyPosition` enum('Employee','Manager','Admin') NOT NULL DEFAULT 'Employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`EmployeeID`, `FirstName`, `LastName`, `UserName`, `UserPassword`, `DateOfBirth`, `StreetAddress`, `State`, `City`, `Postcode`, `EmailAddress`, `PhoneNumber`, `Gender`, `CompanyPosition`) VALUES
(1, 'Damian', 'Moisidis', 'test', '123', '1999-06-24', 'Example St', 'VIC', 'Brighton', 8888, '104887896@Student.swin.edu.au', '04111222333', 'Male', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `EOI`
--

CREATE TABLE `EOI` (
  `EoiID` smallint(6) NOT NULL,
  `JobReferenceNumber` varchar(20) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` enum('Female','Male','Other/Unspecified') NOT NULL,
  `StreetAddress` varchar(40) NOT NULL,
  `Suburb` varchar(40) NOT NULL,
  `State` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
  `Postcode` tinyint(4) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `TechnicalSkills` enum('Knowledge of AWS/Azure cloud platforms','Familiarity with scripting languages (e.g. Bash, Python)','System administration skills','Cloud automation proficiency','Knowledge of cloud security best practices') DEFAULT NULL,
  `OtherSkills` text DEFAULT NULL,
  `Status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Jobs`
--

CREATE TABLE `Jobs` (
  `JobsID` smallint(6) NOT NULL,
  `JobReferenceNumber` varchar(20) NOT NULL,
  `PositionTitle` varchar(255) NOT NULL,
  `Role` text NOT NULL,
  `SalaryRange` varchar(255) DEFAULT NULL,
  `ReportsTo` varchar(255) NOT NULL,
  `RelevanceHeading` varchar(255) NOT NULL,
  `RelevanceDescription` text NOT NULL,
  `ApplyHyperLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Jobs`
--

INSERT INTO `Jobs` (`JobsID`, `JobReferenceNumber`, `PositionTitle`, `Role`, `SalaryRange`, `ReportsTo`, `RelevanceHeading`, `RelevanceDescription`, `ApplyHyperLink`) VALUES
(1, 'COS01', 'Junior Cloud Engineer', 'Join our cloud engineering team to assist with designing, implementing, and maintaining cloud-based infrastructure, with opportunities to grow and innovate in a supportive environment.', '$70,000 - $90,000 AUD per annum', 'Senior Cloud Engineer', 'Why Cloud Engineering is Relevant', 'With the rapid shift toward cloud infrastructure across industries, we are in need of skilled engineers to build and maintain our systems. This role offers a fantastic entry point for aspiring professionals looking to grow with evolving technologies.', './apply.html'),
(2, 'COS02', 'Cloud Systems Administrator (Level 2)', 'Manage hybrid cloud systems across AWS and Azure, ensuring their security, performance, and reliability while supporting mission-critical enterprise operations.', '$95,000 - $120,000 AUD per annum', 'Cloud Infrastructure Manager', 'Importance of Cloud Systems Administration', 'As our partners adopt hybrid and multi-cloud strategies, experienced administrators play a vital role in ensuring security, performance, and reliability. This role supports mission-critical operations and provides real-world experience in enterprise settings.', './apply.html');

-- --------------------------------------------------------

--
-- Table structure for table `Perks`
--

CREATE TABLE `Perks` (
  `PerkID` smallint(6) NOT NULL,
  `Reasons` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Perks`
--

INSERT INTO `Perks` (`PerkID`, `Reasons`) VALUES
(1, 'Flexible working arrangements, with the option to work from home three days a week.'),
(2, 'A home office setup allowance.'),
(3, 'An additional two weeks of annual leave.'),
(4, 'Health & wellbeing benefits including discounts on gym memberships.');

-- --------------------------------------------------------

--
-- Table structure for table `Qualifications`
--

CREATE TABLE `Qualifications` (
  `QualificationsID` smallint(6) NOT NULL,
  `JobsID` smallint(6) NOT NULL,
  `Qualification` text DEFAULT NULL,
  `ColumnType` enum('essential','preferable') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Qualifications`
--

INSERT INTO `Qualifications` (`QualificationsID`, `JobsID`, `Qualification`, `ColumnType`) VALUES
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
-- Table structure for table `Responsibilities`
--

CREATE TABLE `Responsibilities` (
  `ResponsibilityID` smallint(6) NOT NULL,
  `JobsID` smallint(6) NOT NULL,
  `Responsibility` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Responsibilities`
--

INSERT INTO `Responsibilities` (`ResponsibilityID`, `JobsID`, `Responsibility`) VALUES
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
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `UserPassword` (`UserPassword`),
  ADD UNIQUE KEY `EmailAddress` (`EmailAddress`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`);

--
-- Indexes for table `EOI`
--
ALTER TABLE `EOI`
  ADD PRIMARY KEY (`EoiID`),
  ADD UNIQUE KEY `EmailAddress` (`EmailAddress`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`),
  ADD KEY `JobReferenceNumber` (`JobReferenceNumber`);

--
-- Indexes for table `Jobs`
--
ALTER TABLE `Jobs`
  ADD PRIMARY KEY (`JobsID`),
  ADD UNIQUE KEY `JobReferenceNumber` (`JobReferenceNumber`);

--
-- Indexes for table `Perks`
--
ALTER TABLE `Perks`
  ADD PRIMARY KEY (`PerkID`);

--
-- Indexes for table `Qualifications`
--
ALTER TABLE `Qualifications`
  ADD PRIMARY KEY (`QualificationsID`),
  ADD KEY `JobsID` (`JobsID`);

--
-- Indexes for table `Responsibilities`
--
ALTER TABLE `Responsibilities`
  ADD PRIMARY KEY (`ResponsibilityID`),
  ADD KEY `JobsID` (`JobsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `EmployeeID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `EOI`
--
ALTER TABLE `EOI`
  MODIFY `EoiID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Jobs`
--
ALTER TABLE `Jobs`
  MODIFY `JobsID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Perks`
--
ALTER TABLE `Perks`
  MODIFY `PerkID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Qualifications`
--
ALTER TABLE `Qualifications`
  MODIFY `QualificationsID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Responsibilities`
--
ALTER TABLE `Responsibilities`
  MODIFY `ResponsibilityID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `EOI`
--
ALTER TABLE `EOI`
  ADD CONSTRAINT `EOI_ibfk_1` FOREIGN KEY (`JobReferenceNumber`) REFERENCES `Jobs` (`JobReferenceNumber`) ON DELETE CASCADE;

--
-- Constraints for table `Qualifications`
--
ALTER TABLE `Qualifications`
  ADD CONSTRAINT `Qualifications_ibfk_1` FOREIGN KEY (`JobsID`) REFERENCES `Jobs` (`JobsID`) ON DELETE CASCADE;

--
-- Constraints for table `Responsibilities`
--
ALTER TABLE `Responsibilities`
  ADD CONSTRAINT `Responsibilities_ibfk_1` FOREIGN KEY (`JobsID`) REFERENCES `Jobs` (`JobsID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
