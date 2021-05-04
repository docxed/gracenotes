-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 01:35 PM
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
(6, 'asdasd', 1, 5, '2021-04-30 19:26:38'),
(7, 'สุดยอด', 9, 8, '2021-05-04 08:20:58'),
(8, 'GOOD', 10, 8, '2021-05-04 09:31:27');

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
(6, '03:12:00', '2001-11-03', 'เข้ามาช่วยเก็บขยะบริเวณรอบๆวัด', 'วัด', 'grace_60901c977961f.jpg', 'ผ่าน', 10, '2021-05-03 15:53:59'),
(7, '01:23:00', '2021-04-30', 'ทำความสะอาดห้องเรียนก่อนใช้สอบในวันพรุ้งนี้', 'โรงเรียน', 'grace_609020a3c4b1f.jpg', 'ผ่าน', 9, '2021-05-03 16:11:15'),
(8, '01:05:00', '2021-03-29', 'ไปบริจาคเลือดที่สภากาชาดมาครับ', 'สภากาชาดไทย', 'grace_609025dbbcfb1.jpg', 'รอการอนุมัติ', 11, '2021-05-03 16:33:31'),
(9, '02:13:00', '2021-05-02', 'ช่วยแม่ทำความสะอาดบ้านครั้งใหญ่ในรอบ2เดือน', 'บ้าน', 'grace_6090e88f7e4cb.jpg', 'รอการอนุมัติ', 12, '2021-05-04 06:24:15');

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
(8, '62070168', '1234', 'วิชยุตม์', 'ทวิชัยยุทธ', '6/1', '23', '2000-07-01', 'จ.สมุทรปราการ ต.บางเมืองใหม่  อ.เมือง หมู่บ้านไอริส 100/39', 'stu_609010f417bd9.jpg', 'teacher', '2021-05-03 15:04:20'),
(9, '5214679', '1234', 'อานิน', 'นาเดีย', '6/2', '21', '2001-01-01', 'จ.สมุทรปราการ ต.บางเมืองใหม่  อ.เมือง หมู่บ้านไอริส 100/12', 'stu_609013eac72df.png', 'student', '2021-05-03 15:16:58'),
(10, '5214680', '1234', 'โดนาน', 'อารีนัส', '6/2', '32', '2000-07-14', 'จ.สมุทรปราการ ต.บางเมืองใหม่  อ.เมือง หมู่บ้านไอริส 100/51', 'stu_60901acbe3938.jpg', 'student', '2021-05-03 15:46:19'),
(11, '5214678', '1234', 'โรนัส', 'เกเรียน', '6/4', '9', '2000-01-08', 'จ.สมุทรปราการ ต.บางเมืองใหม่  อ.เมือง หมู่บ้านไอริส 100/40', 'stu_6090238f79ade.jpg', 'student', '2021-05-03 16:23:43'),
(12, '5214682', '1234', 'เอเรียม', 'โมนาช', '5/1', '46', '2002-06-08', 'จ.สมุทรปราการ ต.บางเมืองใหม่  อ.เมือง หมู่บ้านไอริส 100/28', 'stu_6090e50402dbf.jpg', 'student', '2021-05-04 06:09:08');

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
(4, 'รหัสผ่าน', 'เปลี่ยนรหัสผ่านไม่ได้ครับ', 10, '2021-05-03 15:47:34'),
(5, 'เลขที่', 'เปลี่ยนเลขที่ไม่ได้ครับ', 9, '2021-05-04 05:54:50');

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
(3, 2, 'กำลังแก้', 2, '2021-04-07 04:11:21'),
(4, 4, 'สักครู่ครับ', 8, '2021-05-03 15:55:31'),
(5, 5, 'แก้ไขเรียบร้อยครับ', 8, '2021-05-04 08:13:38');

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
(6, 'นาย โดนาน อารีนัส ได้ใช้เวลาว่างให้เกิดประโยชน์ด้วยการเข้ามาเก็บขยะบริเวณรอบๆวัด', 'grace_60901c977961f.jpg', 8, '2021-05-03 16:00:16'),
(8, 'นาย อานิน นาเดีย ได้ช่วยเหลือภารโรงทำความสะอาดห้องเรียนที่จะใช้สอบก่อนวันสอบจริง', 'grace_609020a3c4b1f.jpg', 8, '2021-05-03 16:17:17');

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
(1, 'like', 9, 8, '2021-05-04 08:21:01');

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
  MODIFY `comment_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับความคิดเห็น', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `grace`
--
ALTER TABLE `grace`
  MODIFY `grace_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับความดี', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับสมาชิก', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับรายงาน', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `report_feedback`
--
ALTER TABLE `report_feedback`
  MODIFY `reply_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับตอบกลับรายงาน', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `social_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับโพสต์', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'หมายเลขกำกับสถานะ', AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
