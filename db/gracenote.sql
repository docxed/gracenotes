-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 04:37 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gracenote`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(4) NOT NULL COMMENT 'หมายเลขกำกับความคิดเห็น',
  `comment_detail` text NOT NULL COMMENT 'ความคิดเห็น',
  `member_id` int(4) NOT NULL COMMENT 'ผู้แสดงความคิดเห็น',
  `social_id` int(4) NOT NULL COMMENT 'โพสต์ของความคิดเห็น',
  `comment_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ประทับเวลาความคิดเห็น'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_detail`, `member_id`, `social_id`, `comment_timestamp`) VALUES
(1, 'เยี่ยม', 2, 3, '2021-04-07 04:54:13'),
(3, '5555', 2, 4, '2021-04-07 04:54:27'),
(4, 'สุดยอด', 1, 4, '2021-04-07 04:59:46'),
(5, 'ดี', 3, 3, '2021-04-29 18:06:04'),
(6, 'asdasd', 1, 5, '2021-04-30 19:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `grace`
--

CREATE TABLE `grace` (
  `grace_id` int(4) NOT NULL COMMENT 'หมายเลขกำกับความดี',
  `grace_time` time NOT NULL COMMENT 'จำนวนเวลาที่ใช้ทำความดี',
  `grace_date` date NOT NULL COMMENT 'วันที่ทำความดี',
  `grace_detail` text NOT NULL COMMENT 'รายละเอียดความดี',
  `grace_agency` varchar(50) NOT NULL COMMENT 'หน่วยงานที่ทำความดี',
  `grace_img` varchar(30) NOT NULL COMMENT 'รูปถ่ายความดี',
  `grace_check` enum('รอการอนุมัติ','ผ่าน','ไม่ผ่าน') NOT NULL DEFAULT 'รอการอนุมัติ' COMMENT 'การรับรองความดี',
  `member_id` int(4) NOT NULL COMMENT 'หมายเลขผู้บันทึกความดี',
  `grace_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ประทับเวลาความดี'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grace`
--

INSERT INTO `grace` (`grace_id`, `grace_time`, `grace_date`, `grace_detail`, `grace_agency`, `grace_img`, `grace_check`, `member_id`, `grace_timestamp`) VALUES
(1, '05:30:00', '2020-08-11', 'เข้าร่วมกิจกรรมการชุมนุมกับกลุ่มราษฎรและร่วมกันเขียนจดหมายหรือที่เรียกว่า "ราษฎรสาส์น" เพื่อส่งถึงพระบาทสมเด็จพระเจ้าอยู่หัว', 'เยาวชนปลดแอก', 'grace_603201ea71133.jpg', 'ผ่าน', 1, '2021-02-21 06:47:06'),
(2, '03:00:00', '2021-02-21', 'ทำความสะอาดพื้นที่', 'บ้าน', 'grace_6032021cb73f8.jpg', 'ผ่าน', 2, '2021-02-21 06:47:56'),
(4, '07:02:00', '2021-02-20', 'aaa', 'รัฐสภาใหม่', 'grace_6032033564893.jpg', 'ไม่ผ่าน', 1, '2021-02-21 06:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(4) NOT NULL COMMENT 'หมายเลขกำกับสมาชิก',
  `member_user` varchar(10) NOT NULL COMMENT 'รหัสนักเรียน',
  `member_password` varchar(15) NOT NULL COMMENT 'รหัสผ่าน',
  `member_fname` varchar(30) NOT NULL COMMENT 'ชื่อ',
  `member_lname` varchar(30) NOT NULL COMMENT 'นามสกุล',
  `member_class` varchar(5) DEFAULT NULL COMMENT 'ห้องเรียน',
  `member_no` varchar(2) DEFAULT NULL COMMENT 'เลขที่',
  `member_dob` date NOT NULL COMMENT 'วันเกิด',
  `member_address` text NOT NULL COMMENT 'ที่อยู่',
  `member_img` varchar(30) NOT NULL COMMENT 'รูปประจำตัว',
  `member_level` enum('student','teacher') NOT NULL DEFAULT 'student' COMMENT 'บทบาท',
  `member_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ประทับเวลา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_user`, `member_password`, `member_fname`, `member_lname`, `member_class`, `member_no`, `member_dob`, `member_address`, `member_img`, `member_level`, `member_timestamp`) VALUES
(1, '06437', '1234', 'อคิราภ์', 'สีแสนยง', '6/1', '1', '2020-09-23', '119/505 ซอยสายไหม 15 ถนนสายไหม แขวงสายไหม เขตสายไหม กรุงเทพฯ', 'stu_602fb5e0195db.jpg', 'student', '2021-02-19 12:58:08'),
(2, '62070168', '1234', 'วิชยุตม์', 'ทวิชัยยุทธ', '6/5', '28', '2000-07-01', '119/506 ซอยสายไหม 15 ถนนสายไหม แขวงสายไหม เขตสายไหม กรุงเทพฯ', 'stu_603200a2b3932.jpg', 'teacher', '2021-02-21 06:41:38'),
(3, '06435', '1234', 'สุรวิช', 'ศิลาขาว', '6/1', '1', '2021-04-22', '119/505 ซอยสายไหม 15 ถนนสายไหม แขวงสายไหม เขตสายไหม กรุงเทพฯ 10220 ประเทศไทย', 'stu_608acf49def5c.jpg', 'student', '2021-04-29 15:22:49'),
(4, '06434', '1234', 'ภาคภูมิ', 'แสนคำ', '6/1', '', '2021-04-22', '119/505 ซอยสายไหม 15 ถนนสายไหม แขวงสายไหม เขตสายไหม กรุงเทพฯ 10220 ประเทศไทย', 'stu_608ad965d8480.jpg', 'student', '2021-04-29 16:05:57'),
(5, '06433', '1234', 'ภาสกร', 'ยืนยง', '6/1', '', '2021-04-07', '119/505 ซอยสายไหม 15 ถนนสายไหม แขวงสายไหม เขตสายไหม กรุงเทพฯ 10220 ประเทศไทย', 'stu_608ad9b88d444.jpg', 'student', '2021-04-29 16:07:20'),
(6, '06432', '1234', 'พชร', 'ศิริวัฒน์', '6/1', '', '2021-04-09', '119/505 ซอยสายไหม 15 ถนนสายไหม แขวงสายไหม เขตสายไหม กรุงเทพฯ 10220 ประเทศไทย', 'stu_608ad9e31f5ee.jpg', 'student', '2021-04-29 16:08:03'),
(7, '06431', '1234', 'ธเนศ', 'คะรังรัมย์', '6/2', '', '2021-04-16', '119/505 ซอยสายไหม 15 ถนนสายไหม แขวงสายไหม เขตสายไหม กรุงเทพฯ 10220 ประเทศไทย', 'stu_608ada55de19c.jpg', 'student', '2021-04-29 16:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(4) NOT NULL COMMENT 'หมายเลขกำกับรายงาน',
  `report_topic` varchar(100) NOT NULL COMMENT 'หัวข้อปัญหา',
  `report_detail` text NOT NULL COMMENT 'รายละเอียดปัญหา',
  `member_id` int(4) NOT NULL COMMENT 'ผู้ร้องเรียน',
  `report_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ประทับเวลาร้องเรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `report_topic`, `report_detail`, `member_id`, `report_timestamp`) VALUES
(1, 'ชื่อ', 'เปลี่ยนชื่อไม่ได้ครับ', 1, '2021-03-30 11:29:06'),
(2, 'นามสกุล', 'เปลี่ยนนามสกุลไม่ได้ครับ', 1, '2021-03-30 11:29:25'),
(3, 'เลขที่', 'เปลี่ยนเลขที่ไม่ได้ครับ', 2, '2021-03-30 11:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `report_feedback`
--

CREATE TABLE `report_feedback` (
  `reply_id` int(4) NOT NULL COMMENT 'หมายเลขกำกับตอบกลับรายงาน',
  `report_id` int(4) NOT NULL COMMENT 'หมายเลขรายงาน',
  `reply_detail` text NOT NULL COMMENT 'รายละเอียดตอบกลับ',
  `member_id` int(4) NOT NULL COMMENT 'แอดมินที่ตอบกลับ',
  `reply_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ประทับเวลาตอบกลับรายงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report_feedback`
--

INSERT INTO `report_feedback` (`reply_id`, `report_id`, `reply_detail`, `member_id`, `reply_timestamp`) VALUES
(1, 1, 'กำลังแก้ไขให้ครับ', 1, '2021-03-30 12:33:11'),
(2, 2, 'เทส', 2, '2021-04-07 04:10:49'),
(3, 2, 'กำลังแก้', 2, '2021-04-07 04:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `social_id` int(4) NOT NULL COMMENT 'หมายเลขกำกับโพสต์',
  `social_detail` text NOT NULL COMMENT 'รายละเอียดโพสต์',
  `social_img` varchar(30) NOT NULL COMMENT 'รูปโพสต์',
  `member_id` int(4) NOT NULL COMMENT 'ผู้โพสต์',
  `social_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ประทับเวลาโพสต์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`social_id`, `social_detail`, `social_img`, `member_id`, `social_timestamp`) VALUES
(3, ' นายวิชยุตม์ ทวิชัยยุทธ กวาดและถูบ้าน ช่วยแบ่งเบาภาระพ่อแม่', 'grace_6032021cb73f8.jpg', 1, '2021-04-06 11:32:12'),
(4, 'นายอคิราภ์ สีแสนยง ทำความดีเพื่อประเทศ เข้าร่วมกิจกรรมส่ง "ราษฎรสาส์น" ', 'grace_603201ea71133.jpg', 2, '2021-04-07 04:26:13'),
(5, 'asdasdasd', 'asdasdasd', 1, '2021-04-30 19:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(4) NOT NULL COMMENT 'หมายเลขกำกับสถานะ',
  `status_type` enum('like','love','sadu') NOT NULL COMMENT 'ชนิดสถานะ',
  `member_id` int(4) NOT NULL COMMENT 'ผู้ส่งสถานะ',
  `social_id` int(4) NOT NULL COMMENT 'สถานะของโพสต์',
  `status_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ประทับเวลาสถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_type`, `member_id`, `social_id`, `status_timestamp`) VALUES
(8, 'like', 1, 3, '2021-04-07 05:40:53'),
(27, 'love', 1, 4, '2021-04-07 05:46:05'),
(37, 'sadu', 2, 4, '2021-04-07 06:46:33'),
(39, 'like', 2, 3, '2021-04-29 14:32:14'),
(40, 'sadu', 3, 4, '2021-04-29 18:05:00'),
(41, 'like', 3, 3, '2021-04-29 18:05:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `grace`
--
ALTER TABLE `grace`
  ADD PRIMARY KEY (`grace_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `member_user` (`member_user`),
  ADD UNIQUE KEY `member_img` (`member_img`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `report_feedback`
--
ALTER TABLE `report_feedback`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับความคิดเห็น', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `grace`
--
ALTER TABLE `grace`
  MODIFY `grace_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับความดี', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับสมาชิก', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับรายงาน', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `report_feedback`
--
ALTER TABLE `report_feedback`
  MODIFY `reply_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับตอบกลับรายงาน', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `social_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับโพสต์', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับสถานะ', AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
