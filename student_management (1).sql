-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 11:30 AM
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
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_fees`
--

CREATE TABLE `additional_fees` (
  `fee_id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `is_mandatory` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `status` enum('Present','Absent') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `startingfrom` varchar(100) DEFAULT NULL,
  `teacher` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `course_code` varchar(100) DEFAULT NULL,
  `status` double NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `description`, `price`, `name`, `duration`, `startingfrom`, `teacher`, `image`, `course_code`, `status`, `created_at`) VALUES
(7, 'A comprehensive course on Data Science covering Python, Machine Learning, and Data Visualization', 199.99, 'Data Science Mastery', '6 months', '25 December, 2024', '7', 'Data_Science_Mastery-1734345539.jpeg', 'DS101', 1, '2024-01-01 03:30:00'),
(8, 'Learn the basics of web development using HTML, CSS, and JavaScript', 99.99, 'Web Development for Beginners', '3 months', '2024-02-15', '3', 'Web_Development_for_Beginners-1736323691.png', 'WD102', 1, '2024-02-15 04:30:00'),
(9, 'Explore advanced topics in Machine Learning including deep learning and neural networks', 299.99, 'Advanced Machine Learning', '6 months', '2024-03-01', '4', 'Advanced_Machine_Learning-1736327748.jpg', 'ML202', 1, '2024-03-01 05:30:00'),
(10, 'An in-depth course on Python programming from basic to advanced concepts', 149.99, 'Python Programming', '4 months', '2024-04-01', 'Emily Davis', 'python_programming.jpg', 'PY303', 1, '2024-04-01 06:30:00'),
(11, 'Learn to build mobile applications for Android using Kotlin', 249.99, 'Android App Development', '5 months', '2024-05-01', 'Sophia Jackson', 'android_dev.jpg', 'AD304', 1, '2024-05-01 08:30:00'),
(12, 'Master web development frameworks like React and Angular', 179.99, 'Frontend Web Development', '4 months', '2024-06-01', 'David Lee', 'frontend_web_dev.jpg', 'FWD305', 1, '2024-06-01 10:00:00'),
(13, 'Learn backend web development using Node.js and Express', 159.99, 'Backend Web Development', '4 months', '2024-07-01', 'Olivia Martinez', 'backend_web_dev.jpg', 'BWD306', 1, '2024-07-01 10:30:00'),
(14, 'Explore the fundamentals of digital marketing including SEO, SEM, and social media marketing', 129.99, 'Digital Marketing Basics', '3 months', '2024-08-01', 'William Young', 'digital_marketing.jpg', 'DM407', 1, '2024-08-01 11:30:00'),
(15, 'Learn the basics of cloud computing and AWS services', 199.99, 'Cloud Computing with AWS', '4 months', '2024-09-01', 'James Clark', 'cloud_computing.jpg', 'CC408', 1, '2024-09-01 12:30:00'),
(16, 'A course on AI and Deep Learning with TensorFlow and Keras', 349.99, 'AI and Deep Learning', '6 months', '2024-10-01', 'Charlotte Moore', 'ai_deep_learning.jpg', 'AI409', 1, '2024-10-01 04:00:00'),
(17, 'Learn the basics of data analysis and visualization with R and Excel', 129.99, 'Data Analysis with R and Excel', '3 months', '2024-11-01', 'Matthew Scott', 'data_analysis.jpg', 'DA510', 1, '2024-11-01 05:00:00'),
(18, 'A course on modern user interface (UI) design principles using Figma', 99.99, 'UI Design with Figma', '2 months', '2024-12-01', 'Isabella King', 'ui_design.jpg', 'UI511', 1, '2024-12-01 05:30:00'),
(19, 'Learn ethical hacking and penetration testing to secure your systems', 299.99, 'Ethical Hacking and Penetration Testing', '6 months', '2025-01-01', 'Henry Adams', 'ethical_hacking.jpg', 'EH512', 1, '2025-01-01 07:00:00'),
(20, 'Introduction to the Internet of Things (IoT) and building IoT projects', 199.99, 'Introduction to IoT', '4 months', '2025-02-01', 'Grace Lewis', 'iot_course.jpg', 'IoT613', 1, '2025-02-01 07:30:00'),
(21, 'A beginner course in database management using SQL', 99.99, 'SQL for Beginners', '3 months', '2025-03-01', 'Ethan Allen', 'sql_course.jpg', 'SQL614', 1, '2025-03-01 08:45:00'),
(22, 'Learn advanced data structures and algorithms for competitive programming', 249.99, 'Algorithms and Data Structures', '4 months', '2025-04-01', 'Mia Hall', 'algorithms.jpg', 'ADS615', 1, '2025-04-01 10:00:00'),
(23, 'A complete course on building RESTful APIs with Node.js and Express', 179.99, 'Building RESTful APIs with Node.js', '4 months', '2025-05-01', 'Daniel White', 'rest_apis.jpg', 'REST616', 1, '2025-05-01 10:30:00'),
(24, 'Learn computer graphics and 3D modeling using Blender', 149.99, 'Computer Graphics with Blender', '5 months', '2025-06-01', 'Olivia Martinez', 'blender_graphics.jpg', 'CG617', 1, '2025-06-01 11:30:00'),
(25, 'A detailed course on blockchain and cryptocurrencies', 349.99, 'Blockchain and Cryptocurrency', '6 months', '2025-07-01', 'Sophia Jackson', 'blockchain_course.jpg', 'BC618', 1, '2025-07-01 13:00:00'),
(26, 'A comprehensive course on advanced photography techniques and editing', 129.99, 'Advanced Photography and Editing', '3 months', '2025-08-01', 'David Lee', 'photography.jpg', 'PH619', 1, '2025-08-01 13:30:00'),
(27, 'gtr f', 5200.00, 'Full Stack', '1 year', '18 December, 2024', '4', 'Full_Stack-1736323743.png', '20212', 1, '2024-12-16 09:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(110) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_rollno` varchar(110) NOT NULL,
  `enrollment_date` varchar(111) NOT NULL,
  `fee_status` enum('active','completed','dropped','withdrawn') DEFAULT 'active',
  `enrollment_type` varchar(50) NOT NULL,
  `payment_status` enum('paid','unpaid','pending') DEFAULT 'pending',
  `start_date` varchar(50) DEFAULT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `discount_fee` decimal(60,0) DEFAULT NULL,
  `total_payable` decimal(60,0) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(5) NOT NULL DEFAULT current_timestamp(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `student_id`, `course_id`, `student_rollno`, `enrollment_date`, `fee_status`, `enrollment_type`, `payment_status`, `start_date`, `end_date`, `discount_fee`, `total_payable`, `status`, `created_at`) VALUES
(20, 1, 8, 'MGC-Web D-1', '1 January, 2025', 'active', 'Regular', 'pending', '80', 'Invalid start date format. Please provide a valid ', 20, 80, 1, '2024-12-16 11:27:46.74915'),
(21, 5, 11, 'MGC-Andro-1', '27 December, 2024', 'active', 'Hybrid', 'pending', '195', 'Invalid start date format. Please provide a valid ', 55, 195, 1, '2024-12-17 12:25:41.16918'),
(22, 5, 9, 'MGC-Advan-1', '25 December, 2024', 'active', 'Crosponding', 'pending', '1 January, 2025', '01 July, 2025', 8, 292, 1, '2024-12-17 12:33:05.14481');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `fee_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `installment_count` int(11) DEFAULT NULL,
  `amount_per_installment` decimal(10,2) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('Paid','Unpaid','Installment') DEFAULT NULL,
  `discount` decimal(20,0) DEFAULT NULL,
  `total_payable` decimal(20,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`fee_id`, `student_id`, `course_id`, `total_amount`, `installment_count`, `amount_per_installment`, `due_date`, `status`, `discount`, `total_payable`) VALUES
(1, 1, 1, 20000.00, 5, 4000.00, '2024-01-15', 'Installment', NULL, NULL),
(2, 2, 2, 18000.00, 3, 6000.00, '2024-03-15', 'Installment', NULL, NULL),
(3, 3, 3, 22000.00, 4, 5500.00, '2024-02-20', 'Installment', NULL, NULL),
(4, 4, 4, 21000.00, 5, 4200.00, '2024-01-30', 'Installment', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `grade_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `installment_payments`
--

CREATE TABLE `installment_payments` (
  `installment_id` int(11) NOT NULL,
  `fee_id` int(11) DEFAULT NULL,
  `installment_number` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `status` enum('Paid','Unpaid','Overdue') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `installment_payments`
--

INSERT INTO `installment_payments` (`installment_id`, `fee_id`, `installment_number`, `amount`, `payment_date`, `status`) VALUES
(1, 1, 1, 4000.00, '2023-08-15', 'Paid'),
(2, 1, 2, 4000.00, '2023-09-15', 'Paid'),
(3, 1, 3, 4000.00, '2023-10-15', 'Paid'),
(4, 1, 4, 4000.00, '2023-11-15', 'Unpaid'),
(5, 1, 5, 4000.00, '2023-12-15', 'Unpaid'),
(6, 2, 1, 6000.00, '2023-08-10', 'Paid'),
(7, 2, 2, 6000.00, '2023-09-10', 'Paid'),
(8, 2, 3, 6000.00, '2023-10-10', 'Unpaid'),
(9, 3, 1, 5500.00, '2023-08-20', 'Paid'),
(10, 3, 2, 5500.00, '2023-09-20', 'Paid'),
(11, 3, 3, 5500.00, '2023-10-20', 'Unpaid'),
(12, 3, 4, 5500.00, '2023-11-20', 'Unpaid'),
(13, 4, 1, 4200.00, '2023-08-25', 'Paid'),
(14, 4, 2, 4200.00, '2023-09-25', 'Paid'),
(15, 4, 3, 4200.00, '2023-10-25', 'Unpaid'),
(16, 4, 4, 4200.00, '2023-11-25', 'Unpaid'),
(17, 4, 5, 4200.00, '2023-12-25', 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `logintable`
--

CREATE TABLE `logintable` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `parents` varchar(200) DEFAULT NULL,
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `adm_date` varchar(50) DEFAULT NULL,
  `rollno` varchar(121) DEFAULT NULL,
  `sibling_id` tinyint(20) DEFAULT NULL,
  `password` varchar(222) DEFAULT NULL,
  `image` varchar(233) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `last_name`, `parents`, `f_name`, `m_name`, `dob`, `gender`, `email`, `phone`, `address`, `adm_date`, `rollno`, `sibling_id`, `password`, `image`, `status`, `created_at`) VALUES
(1, 'kumar', 'kuam', 'fd', 'dfdsf', 'fdsfs', '2024-11-27', 'Male', 'f@gmail.com', '8784654654', 'gfv bvb', '2024-11-14', NULL, 0, '123', 'kumar-1736328591.jpg', 1, '2024-11-25 11:09:37'),
(2, 'kumar', 'kuam', 'fd', 'dfdsf', 'fdsfs', '2024-11-27', 'male', 'f@gmail.com', '8784654654', 'gfv bvb', '2024-11-14', NULL, NULL, NULL, NULL, 1, '2024-11-25 11:09:41'),
(3, 'John', 'Doe', 'Mr. & Mrs. Doe', 'Robert Doe', 'Maria Doe', '2005-05-15', 'Male', 'john.doe@example.com', '1234567895', '123 Main St, City, Country', '2024-08-01', 'R12345', 0, '123', 'John-1736328655.png', 1, '2024-08-01 05:00:00'),
(4, 'Jane', 'Smith', 'Mr. & Mrs. Smith', 'David Smith', 'Linda Smith', '2004-11-25', 'female', 'jane.smith@example.com', '+1987654321', '456 Maple Rd, City, Country', '2023-09-10', 'R67890', NULL, NULL, 'jane_smith.jpg', 0, '2023-09-10 08:50:00'),
(5, 'Michael', 'Johnson', 'Mr. & Mrs. Johnson', 'Steven Johnson', 'Patricia Johnson', '2006-02-17', 'male', 'michael.johnson@example.com', '+1122334455', '789 Oak Ave, City, Country', '2024-05-12', 'R11223', NULL, NULL, 'michael_johnson.jpg', 1, '2024-05-12 03:30:00'),
(6, 'Emily', 'Williams', 'Mr. & Mrs. Williams', 'James Williams', 'Emma Williams', '2003-07-22', 'female', 'emily.williams@example.com', '+1567890123', '321 Birch Rd, City, Country', '2023-12-15', 'R45678', NULL, NULL, 'emily_williams.jpg', 0, '2023-12-15 08:20:00'),
(7, 'Daniel', 'Brown', 'Mr. & Mrs. Brown', 'Richard Brown', 'Susan Brown', '2007-01-03', 'male', 'daniel.brown@example.com', '+1425364879', '654 Pine Ln, City, Country', '2024-07-09', 'R33445', NULL, NULL, 'daniel_brown.jpg', 1, '2024-07-09 06:10:00'),
(8, 'Olivia', 'Miller', 'Mr. & Mrs. Miller', 'Thomas Miller', 'Helen Miller', '2002-09-12', 'female', 'olivia.miller@example.com', '+1987654322', '987 Cedar St, City, Country', '2023-10-05', 'R55667', NULL, NULL, 'olivia_miller.jpg', 0, '2023-10-05 10:00:00'),
(9, 'Lucas', 'Davis', 'Mr. & Mrs. Davis', 'Christopher Davis', 'Nancy Davis', '2006-12-05', 'male', 'lucas.davis@example.com', '+1432567890', '321 Elm St, City, Country', '2024-03-30', 'R22334', NULL, NULL, 'lucas_davis.jpg', 1, '2024-03-30 02:45:00'),
(10, 'Sophia', 'Garcia', 'Mr. & Mrs. Garcia', 'Anthony Garcia', 'Jessica Garcia', '2004-10-29', 'female', 'sophia.garcia@example.com', '+1654983720', '654 Maple St, City, Country', '2023-11-19', 'R88990', NULL, NULL, 'sophia_garcia.jpg', 0, '2023-11-19 10:55:00'),
(11, 'Benjamin', 'Martinez', 'Mr. & Mrs. Martinez', 'Carlos Martinez', 'Victoria Martinez', '2005-04-18', 'male', 'benjamin.martinez@example.com', '+1273658490', '321 Willow Rd, City, Country', '2024-06-11', 'R66778', NULL, NULL, 'benjamin_martinez.jpg', 1, '2024-06-11 11:40:00'),
(12, 'Ava', 'Hernandez', 'Mr. & Mrs. Hernandez', 'Eduardo Hernandez', 'Isabel Hernandez', '2007-08-27', 'female', 'ava.hernandez@example.com', '+1394586720', '876 Birch Rd, City, Country', '2024-02-21', 'R99887', NULL, NULL, 'ava_hernandez.jpg', 0, '2024-02-21 12:30:00'),
(13, 'Kundan kumar Kushwaha', NULL, NULL, 'fdghj', 'dfghj', '0000-00-00', 'Female', 'kundan@gmail.com', '9654773764', 'D-11/57 rohini east metro station\r\npillar no - 387 vedanta ias academy', '0000-00-00', '', 2, '123', 'Kundan_kumar_Kushwaha-1734348219.jpeg', 1, '2024-12-16 11:03:51'),
(14, 'Kundan kumar', NULL, NULL, 'prasad', 'dfghj', '8 January, 2025', 'Male', 'kundan@gmail.com', '09654773764', 'pillar no - 387 vedanta ias academy', '11 January, 2025', '', 2, '54354', 'Kundan_kumar-1734348254.jpeg', 1, '2024-12-16 11:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `eligibility` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `qualified_from` varchar(200) DEFAULT NULL,
  `passout` varchar(200) DEFAULT NULL,
  `availability` varchar(122) DEFAULT NULL,
  `experience` varchar(12) DEFAULT NULL,
  `joindate` varchar(100) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `teacher_profile` varchar(250) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `full_name`, `eligibility`, `email`, `phone`, `specialty`, `address`, `gender`, `qualified_from`, `passout`, `availability`, `experience`, `joindate`, `about`, `status`, `teacher_profile`, `created_at`) VALUES
(3, 'rajan', 'ug', 'rajan@gmail.com', '465465445', 'PHP', 'hnvbfcb cv bcv ', 'male', 'du', '2023', NULL, NULL, NULL, NULL, 1, 'sgygdf.jpg', '2024-11-19'),
(4, 'Abhishek', 'b.tch', 'abhii@gmail.com', '7847857484', '3434', '						this is my adddress						 ', '', 'mdu', '2022', NULL, NULL, NULL, NULL, 1, 'media/teachers-image/-1732018759.jpg', '2024-11-19'),
(5, 'Abhishek', 'b.tch', 'abhii@gmail.com', '7847857484', '3434', '						this is my adddress						 ', '', 'mdu', '2022', NULL, NULL, NULL, NULL, 1, 'media/teachers-image/Abhishek-1732018829.jpg', '2024-11-19'),
(6, 'kumar', 'ug', 'kum@gmail.com', '95511144', 'php', ' drgvf cvbdfv bdf vbdr', 'male', 'du', '2020', 'full time', '12', NULL, NULL, 1, 'dfvxc.jpg', '2024-11-21'),
(7, 'kundan', 'ug', 'kundan@gmail.com', '9355986539', 'php', 'tg', '', 'mdu', '2024-12', 'full time', '3', ' 21 November, 2024', 'v vc bccvdfge', 1, 'media/teachers-image/kundan-1732181527.jpg', '2024-11-21'),
(8, 'kundan', 'ug', 'kundan@gmail.com', '9355986539', 'php', 'tg', '', 'mdu', '2024-12', 'full time', '3', ' ', 'v vc bccvdfge', 1, 'media/teachers-image/kundan-1732181536.jpg', '2024-11-21'),
(9, 'John Smith', 'M.Tech', 'john.smith@example.com', '9876543210', 'Data Science', '1234 Elm St, New York, USA', 'Male', 'MIT', '2015', 'Full-Time', '5 years', '2024-06-01', 'Experienced in teaching Data Science and AI', 1, 'john_smith.jpg', '2024-06-01'),
(10, 'Sarah Johnson', 'M.Sc. in Physics', 'sarah.johnson@example.com', '9988776655', 'Physics', '5678 Oak St, London, UK', 'Female', 'Oxford University', '2017', 'Part-Time', '3 years', '2023-11-15', 'Physics teacher with a passion for research', 0, 'sarah_johnson.jpg', '2023-11-15'),
(11, 'Alex Brown', 'Ph.D. in Mathematics', 'alex.brown@example.com', '9911223344', 'Mathematics', '910 Pine Rd, Toronto, Canada', 'Male', 'Harvard University', '2012', 'Full-Time', '8 years', '2024-07-10', 'Specializes in Applied Mathematics', 1, 'alex_brown.jpg', '2024-07-10'),
(12, 'Emily Davis', 'MBA', 'emily.davis@example.com', '9202837465', 'Management', '4321 Birch Ln, Paris, France', 'Female', 'INSEAD', '2016', 'Full-Time', '4 years', '2023-08-20', 'Passionate about teaching leadership and entrepreneurship', 1, 'emily_davis.jpg', '2023-08-20'),
(13, 'Michael Wilson', 'B.Tech', 'michael.wilson@example.com', '9456712345', 'Computer Science', '8765 Cedar Ave, Sydney, Australia', 'Male', 'University of Sydney', '2018', 'Full-Time', '3 years', '2024-05-12', 'Expert in web development and software engineering', 1, 'michael_wilson.jpg', '2024-05-12'),
(14, 'Olivia Martinez', 'M.A. in English', 'olivia.martinez@example.com', '9563847261', 'English Literature', '6543 Maple St, Rome, Italy', 'Female', 'University of Rome', '2014', 'Full-Time', '6 years', '2024-04-22', 'Lover of poetry and classical literature', 0, 'olivia_martinez.jpg', '2024-04-22'),
(15, 'David Lee', 'M.S. in Chemistry', 'david.lee@example.com', '9612837495', 'Chemistry', '2234 Willow Rd, Tokyo, Japan', 'Male', 'University of Tokyo', '2013', 'Full-Time', '7 years', '2024-03-19', 'Experienced in organic chemistry and lab management', 1, 'david_lee.jpg', '2024-03-19'),
(16, 'Sophia Jackson', 'M.Sc. in Biology', 'sophia.jackson@example.com', '9723648580', 'Biology', '1587 Birch Rd, Berlin, Germany', 'Female', 'University of Berlin', '2015', 'Part-Time', '4 years', '2023-07-30', 'Researcher in genetics and cell biology', 1, 'sophia_jackson.jpg', '2023-07-30'),
(17, 'Daniel White', 'M.Tech in IT', 'daniel.white@example.com', '9837462910', 'Information Technology', '9032 Ashwood Dr, Madrid, Spain', 'Male', 'Technical University of Madrid', '2016', 'Full-Time', '4 years', '2024-05-30', 'Specialized in cybersecurity and AI', 0, 'daniel_white.jpg', '2024-05-30'),
(18, 'Ava Robinson', 'Ph.D. in History', 'ava.robinson@example.com', '9901746235', 'History', '2984 Maple Ave, Moscow, Russia', 'Female', 'Moscow State University', '2010', 'Full-Time', '9 years', '2024-09-01', 'Passionate historian with a focus on ancient civilizations', 1, 'ava_robinson.jpg', '2024-09-01'),
(19, 'James Clark', 'B.A. in Philosophy', 'james.clark@example.com', '9938472634', 'Philosophy', '5679 Oak St, New Delhi, India', 'Male', 'Jawaharlal Nehru University', '2015', 'Part-Time', '4 years', '2024-02-14', 'Teaching critical thinking and ethics', 1, 'james_clark.jpg', '2024-02-14'),
(20, 'Grace Lewis', 'M.A. in Sociology', 'grace.lewis@example.com', '9423716580', 'Sociology', '3421 Pine St, Cape Town, South Africa', 'Female', 'University of Cape Town', '2013', 'Full-Time', '6 years', '2024-03-10', 'Sociologist with a focus on social inequalities', 0, 'grace_lewis.jpg', '2024-03-10'),
(21, 'William Young', 'M.Sc. in Environmental Science', 'william.young@example.com', '9264738290', 'Environmental Science', '7845 Cedar Ln, Buenos Aires, Argentina', 'Male', 'University of Buenos Aires', '2017', 'Part-Time', '3 years', '2024-01-19', 'Expert in climate change and sustainability', 1, 'william_young.jpg', '2024-01-19'),
(22, 'Mia Hall', 'Ph.D. in Political Science', 'mia.hall@example.com', '9054763821', 'Political Science', '3657 Maple Rd, Toronto, Canada', 'Female', 'University of Toronto', '2012', 'Full-Time', '8 years', '2023-12-22', 'Specialist in international relations and politics', 1, 'mia_hall.jpg', '2023-12-22'),
(23, 'Ethan Allen', 'M.A. in Economics', 'ethan.allen@example.com', '9276453810', 'Economics', '1487 Birch Rd, Auckland, New Zealand', 'Male', 'University of Auckland', '2016', 'Full-Time', '4 years', '2024-07-01', 'Expert in macroeconomics and financial markets', 1, 'ethan_allen.jpg', '2024-07-01'),
(24, 'Isabella King', 'M.Sc. in Statistics', 'isabella.king@example.com', '9201827365', 'Statistics', '7541 Pine Ave, Cape Town, South Africa', 'Female', 'University of Cape Town', '2018', 'Part-Time', '2 years', '2024-02-18', 'Data analyst with a passion for data science', 0, 'isabella_king.jpg', '2024-02-18'),
(25, 'Matthew Scott', 'Ph.D. in Chemistry', 'matthew.scott@example.com', '9037462821', 'Chemistry', '5321 Oak Ave, Chicago, USA', 'Male', 'University of Chicago', '2014', 'Full-Time', '7 years', '2024-06-05', 'Specializing in analytical chemistry and research', 1, 'matthew_scott.jpg', '2024-06-05'),
(26, 'Charlotte Moore', 'B.A. in English Literature', 'charlotte.moore@example.com', '9884512345', 'English Literature', '3245 Cedar Rd, Melbourne, Australia', 'Female', 'University of Melbourne', '2017', 'Full-Time', '3 years', '2024-02-25', 'Passionate about literature and creative writing', 0, 'charlotte_moore.jpg', '2024-02-25'),
(27, 'Henry Adams', 'M.Sc. in Computer Science', 'henry.adams@example.com', '9192837465', 'Computer Science', '1452 Birch St, Lisbon, Portugal', 'Male', 'University of Lisbon', '2013', 'Part-Time', '6 years', '2023-11-05', 'Expert in algorithms and machine learning', 1, 'henry_adams.jpg', '2023-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendance`
--

CREATE TABLE `teacher_attendance` (
  `attendance_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `status` enum('Present','Absent','On Leave') DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','teacher','principal') NOT NULL,
  `linked_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `linked_id`, `created_at`) VALUES
(1, 'student1', '482c811da5d5b4bc6d497ffa98491e38', 'student', 1, '2024-11-15 10:39:46'),
(2, 'teacher1', '6c9af7b4d61c6fd36add03adab327dac', 'teacher', NULL, '2024-11-15 10:39:46'),
(3, 'principal', '25e4ee4e9229397b6b17776bfceaf8e7', 'principal', NULL, '2024-11-15 10:39:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_fees`
--
ALTER TABLE `additional_fees`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`fee_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `installment_payments`
--
ALTER TABLE `installment_payments`
  ADD PRIMARY KEY (`installment_id`),
  ADD KEY `fee_id` (`fee_id`);

--
-- Indexes for table `logintable`
--
ALTER TABLE `logintable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_fees`
--
ALTER TABLE `additional_fees`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `installment_payments`
--
ALTER TABLE `installment_payments`
  MODIFY `installment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `logintable`
--
ALTER TABLE `logintable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `installment_payments`
--
ALTER TABLE `installment_payments`
  ADD CONSTRAINT `installment_payments_ibfk_1` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`fee_id`);

--
-- Constraints for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  ADD CONSTRAINT `teacher_attendance_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
