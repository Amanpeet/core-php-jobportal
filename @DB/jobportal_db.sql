-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2019 at 08:55 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobportal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `uid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `attachments` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `dated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`uid`, `username`, `password`, `role`, `phone`, `fullname`, `address`, `attachments`, `email`, `status`, `dated`) VALUES
(1, 'admin', '305e4f55ce823e111a46a9d500bcb86c', 'admin', '', '', '', '', '', '', '2019-10-09 12:17:58'),
(5, 'master', 'd091512c0fc990f338d5710b897f842c', 'admin', '', '', '', '', 'example@mail.com', '', '2019-10-09 12:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `amounts`
--

CREATE TABLE `amounts` (
  `aid` int(11) NOT NULL,
  `amt_title` varchar(200) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `amt_notes` text NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amounts`
--

INSERT INTO `amounts` (`aid`, `amt_title`, `amount`, `amt_notes`, `updated`) VALUES
(1, 'employer_starter', '899', 'Free for first 3 months', '2019-10-09 15:11:13'),
(2, 'employer_medium', '1999', '', '2019-10-11 18:10:20'),
(3, 'employer_business', '2999', '', '2019-10-11 18:10:39'),
(4, 'user_starter', '499', '', '2019-10-11 18:09:29'),
(5, 'user_medium', '699', '', '2019-10-11 18:09:36'),
(6, 'user_pro', '899', '', '2019-10-09 15:11:23'),
(7, 'extra_fees', '500', '', '2019-10-09 15:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `applied`
--

CREATE TABLE `applied` (
  `ujid` int(11) NOT NULL,
  `job_id` varchar(200) NOT NULL,
  `job_title` varchar(400) NOT NULL,
  `user_applied` varchar(200) NOT NULL,
  `user_purposal` text NOT NULL,
  `employer_reply` text NOT NULL,
  `dated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applied`
--

INSERT INTO `applied` (`ujid`, `job_id`, `job_title`, `user_applied`, `user_purposal`, `employer_reply`, `dated`) VALUES
(2, '2', 'Carpenter needed urgently', 'widow', 'hire me', '', '2019-10-10 18:45:19'),
(7, '4', 'php developer required', 'widow', 'i am unemployed', '', '2019-10-11 11:31:18'),
(8, '4', 'php developer required', 'ajay', 'testing', '', '2019-10-11 12:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `bid` int(11) NOT NULL,
  `blog_title` text NOT NULL,
  `blog_image` varchar(400) NOT NULL,
  `blog_content` text NOT NULL,
  `blog_date` varchar(100) NOT NULL,
  `dated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`bid`, `blog_title`, `blog_image`, `blog_content`, `blog_date`, `dated`) VALUES
(1, 'New Tech Requires a Broader Approach', 'blog_1570691251.jpg', '<p>For quite a long time web pages were the alpha and omega of the internet experience. However, in the last few years the software market has evolved with a speed that was never seen before. We read about new devices every day, and smartphones and tablets have become ubiquitous in our lives.</p>\r\n<p><a target=\"_blank\" href=\"https://www.hongkiat.com/blog/mobile-web-design/\" rel=\"noopener noreferrer\">Designing for mobile screens</a> is different from designing for the desktop, but it canâ€™t be compared to extra-small screens such as the watchface of a smartwatch. Thereâ€™s not too much place for glossy design elements on most wearables.</p>\r\n<p>They need to be functional, and designers need to <strong>focus more on how users interact with the screen</strong>. Interaction with the screen also has many new methods such as <strong>gestures, voice control </strong>and<strong> facial expressions</strong>.</p>', '28/9/2019', '2019-09-28 12:51:32'),
(2, 'Traditional LAMP Development', 'blog_1570691200.jpg', '<p>Most developers should know about the traditional LAMP stack because itâ€™s been around since the early web. <strong>LAMP</strong> stands for <strong>Linux, Apache, MySQL</strong> and <strong>PHP</strong>. Each of these are individual software packs that are combined to form a versatile server solution. The biggest reason to stick with LAMP is security and widespread support. It has been around for decades, and itâ€™s a proven method of hosting websites.</p>\r\n<p>All the backend tech like PHP and MySQL are well known, and <strong>supported by every major hosting provider</strong>. If you work on a LAMP stack you can basically host anywhere. Additionally, you get <strong>access to the most popular CMS engines</strong>. WordPress, Drupal, and Joomla all run on PHP/MySQL.</p>', '30/9/2019', '2019-09-28 13:02:42'),
(3, 'Cyberpunk is incoming 2020', 'blog_1570691017.jpg', 'Global software solution company, we use the latest in trend technologies including Blockchain, NLP, AI and ML to scale up your business web applications to the upcoming technologies. We also develop the best in-class IT applications from scratch by accelerating speed to get you on new technologies platforms with aim to deliver the industry solutioning the best ever wether it is web, mobile or any other devices.Our in-depth technologies experts helped various customers across globe in designing and developing realistic business use cases to performing IT application with integration to various industries junctions through exemplary APIâ€™s developments.', '12/10/2019', '2019-10-10 12:08:08'),
(4, 'Lending a Helping Hand', '', 'Really wish i didn\'t have to compress the images and convert to jpg to be under 5 mb. They lose so much quality :(. For some reason it wont let me post anything over 5mb. the original 4k versions all clock in at around 10-13mb. If anyone knows how to change this, please let me know. They still look good. Sorry i forget to remove the HUD sometimes. Aequinoctium is still my only go to weather mod though.', '20-Mar-2013', '2019-10-10 12:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jid` int(11) NOT NULL,
  `job_category` varchar(200) NOT NULL,
  `job_title` varchar(300) NOT NULL,
  `job_responsibility` text NOT NULL,
  `job_salary` text NOT NULL,
  `job_location` text NOT NULL,
  `job_industry` text NOT NULL,
  `job_type` text NOT NULL,
  `job_employment` text NOT NULL,
  `job_functional_area` text NOT NULL,
  `job_validity` text NOT NULL,
  `job_description` text NOT NULL,
  `job_experience_req` text NOT NULL,
  `job_education_req` text NOT NULL,
  `job_skills_req` text NOT NULL,
  `file_documents` varchar(200) NOT NULL,
  `company_details` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `posted_by` varchar(200) NOT NULL,
  `notes` text NOT NULL,
  `dated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jid`, `job_category`, `job_title`, `job_responsibility`, `job_salary`, `job_location`, `job_industry`, `job_type`, `job_employment`, `job_functional_area`, `job_validity`, `job_description`, `job_experience_req`, `job_education_req`, `job_skills_req`, `file_documents`, `company_details`, `status`, `posted_by`, `notes`, `dated`, `updated`) VALUES
(2, 'hardware', 'Carpenter needed urgently', 'ninucu@mail.com', 'Ut dolores praesen', 'Mohali', 'Exercitationem nos', 'Quis sed anim pari', 'Dolore velit quia ', 'Maxime ut possimus', 'Laborum consequatu', 'Really wish i didn\'t have to compress the images and convert to jpg to be under 5 mb. They lose so much quality :(. For some reason it wont let me post anything over 5mb. the original 4k versions all clock in at around 10-13mb. If anyone knows how to change this, please let me know. They still look good. Sorry i forget to remove the HUD sometimes. Aequinoctium is still my only go to weather mod though.', '1-2 years', 'Possimus error la', 'Est quia dolore do', '', 'At commodo in even', 'active', '', 'Explicabo Vitae u', '2019-10-04 15:35:36', '2019-10-10 12:40:25'),
(3, 'designing', 'Web designing job ', 'torepidygu@mail.com', 'In reprehenderit ', 'Chandigarh', 'Molestiae aliquip ', 'Ea id voluptatem ', 'Modi totam adipisi', 'Ad eaque iusto cil', 'Qui id reiciendis', 'A personal project Iâ€™m currently working on involves turning a styled HTML node tree into a printable PDF asset on client side. I spent a long time searching for the definitive solution and went through a lot of hardships. I will share with you my solution, which I believe is very easy to use, and Iâ€™ll go about pros / cons of other approaches. It will take only two minutes of implementation.', '5 years', 'Dolore magna enim ', 'Error asperiores t', '', 'Et laboriosam eiu', 'active', '', 'Quae rerum est rep', '2019-10-07 12:11:22', '2019-10-10 12:42:14'),
(4, 'designing', 'php developer required', 'fehy@mail.com', 'Corporis consequat', 'Delhi', 'Fugiat commodi opt', 'contract', 'Hic quisquam dolor', 'Fugiat non dolore', 'Et sit sed libero ', 'A personal project Iâ€™m currently working on involves turning a styled HTML node tree into a printable PDF asset on client side. I spent a long time searching for the definitive solution and went through a lot of hardships. I will share with you my solution, which I believe is very easy to use, and Iâ€™ll go about pros / cons of other approaches. It will take only two minutes of implementation.', '0 years', 'Minus enim beatae ', 'Magni amet labore', '', 'Provident maxime ', 'active', 'ajay', '', '2019-10-07 12:11:39', '2019-10-10 16:18:40'),
(5, 'government', 'Great job to become rich', 'qyfyhimax@mail.com', 'Quia deserunt nisi', 'Chandigarh', 'Veniam dolor aut ', 'Quam molestias vol', 'Consectetur volup', 'Maxime proident c', 'Nisi animi incidi', 'Really wish i didn\'t have to compress the images and convert to jpg to be under 5 mb. They lose so much quality :(. For some reason it wont let me post anything over 5mb. the original 4k versions all clock in at around 10-13mb. If anyone knows how to change this, please let me know. They still look good. Sorry i forget to remove the HUD sometimes. Aequinoctium is still my only go to weather mod though.', '2 years', 'Voluptates consect', 'na', 'job_file_1570430598.jpg', 'intiger', 'active', 'ajay', 'lil notes', '2019-10-07 12:13:17', '2019-10-10 15:07:36'),
(6, 'category3', 'Jack of all Trades', 'Cum aperiam volupt', '15k-25k', 'Noida', 'Veritatis dolor et', 'Aperiam aliquid ut', 'Fugiat quam minus', 'Omnis ea vel delen', '30 Oct, 2019', 'ive devoloped a online grocery purchace android app .almost 98 percent work is done .my problem is by clicking increment\\decrement button the num of quantity is adding from vegetable fragment to cart [login to view URL] if i increment\\decrement qty in cart activity the updated num is not showing in vegetable fragment.', '2 years', 'bca, mca,', 'html, css, wordpress', '', 'Quo ipsum id quo ', 'active', 'admin', 'Natus maxime sunt ', '2019-10-07 14:46:50', '2019-10-10 14:18:24'),
(7, 'category1', 'House Keeper in Office', 'Quae quia in commo', '95000', 'Chandigarh', 'IT', 'Cleaning', 'awesome', 'all area', '5 years', 'here are a lot of Photoshop tutorials on the web but hardly any of them cover the basics. Though you can follow them to do a particular task, you will not understand the logic and concept behind the process. Those advanced photoshop tutorials assume that the reader already has an understanding of the basics.', '20 years', 'PHD', 'Cleaning', '', 'Microsoft', 'active', 'admin', 'Sint ratione dolor', '2019-10-10 14:13:40', '2019-10-10 14:18:42'),
(8, 'hardware', 'Deliver the Nuclear Hardware', 'Delivery', '40000', 'Mohali', 'Radioactive', 'Pariatur Cupidata', 'Consequatur aute e', 'Reprehenderit dolo', 'Mollitia provident', 'Despite the introduction of the Lightroom and numerous other apps, Photoshop remains the most flexible and resourceful application. The precision and control it offers are undoubtedly the best in class. Though Photoshop looks like a difficult thing to understand, it becomes easy & fun when you know the basics. So letâ€™s get started.', 'Cupidatat quisquam', 'Nisi ex obcaecati ', 'At culpa eum sunt', 'job_file_1570705077.jpg', 'Nuke Bombers', 'draft', 'ajay', '', '2019-10-10 16:27:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pid` int(11) NOT NULL,
  `pay_username` varchar(200) NOT NULL,
  `pay_package` varchar(200) NOT NULL,
  `pay_amount` varchar(100) NOT NULL,
  `pay_order_id` varchar(200) NOT NULL,
  `pay_notes` text NOT NULL,
  `pdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `uidx` int(11) NOT NULL,
  `form_type` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `phone2` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `pincode` varchar(200) NOT NULL,
  `dob` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `job_category` text NOT NULL,
  `job_location` text NOT NULL,
  `education1` text NOT NULL,
  `education2` text NOT NULL,
  `education3` text NOT NULL,
  `education4` text NOT NULL,
  `experience1` text NOT NULL,
  `experience2` text NOT NULL,
  `experience3` text NOT NULL,
  `experience4` text NOT NULL,
  `skills` text NOT NULL,
  `linkedin` varchar(400) NOT NULL,
  `file_resume` text NOT NULL,
  `file_profile_pic` text NOT NULL,
  `com_name` text NOT NULL,
  `com_industry` text NOT NULL,
  `com_location` text NOT NULL,
  `com_website` text NOT NULL,
  `com_phone` varchar(200) NOT NULL,
  `com_email` varchar(200) NOT NULL,
  `com_address` text NOT NULL,
  `com_state` varchar(200) NOT NULL,
  `com_city` text NOT NULL,
  `com_pincode` varchar(200) NOT NULL,
  `file_identification` text NOT NULL,
  `dated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`uidx`, `form_type`, `username`, `email`, `phone`, `phone2`, `fullname`, `address`, `state`, `city`, `pincode`, `dob`, `gender`, `job_category`, `job_location`, `education1`, `education2`, `education3`, `education4`, `experience1`, `experience2`, `experience3`, `experience4`, `skills`, `linkedin`, `file_resume`, `file_profile_pic`, `com_name`, `com_industry`, `com_location`, `com_website`, `com_phone`, `com_email`, `com_address`, `com_state`, `com_city`, `com_pincode`, `file_identification`, `dated`, `updated`, `notes`) VALUES
(1, 'employer', 'jilyretoty', 'letyvator@mailinator.net', '+1 (135) 418-6958', '+1 (676) 502-5687', 'Darryl Parrish', 'Reprehenderit aut o', 'Dolor rerum asperior', 'Quas explicabo Est ', 'Dolorem deserunt eum', '2003-07-02', 'on', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2019-08-31 18:01:21', '0000-00-00 00:00:00', ''),
(5, 'user', 'kapil', 'intiger.com@mail.net', '+1 (996) 734-5612', '+1 (728) 857-5947', 'Ryan Orr', 'Sit mollitia asperna', 'Quidem fugit est mo', 'Dolorem eaque dolori', 'Molestiae officia ap', '2006-04-16', 'on', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2019-09-02 11:15:40', '2019-09-10 17:42:57', ''),
(7, 'user', 'qybepometo', 'meky@mail.com', '+1 (773) 194-7839', '+1 (599) 559-4929', 'Gretchen Brooks', 'Voluptas cum repud', 'Nostrud et ea moll', 'Animi ex sapiente', 'Tempora incidunt ', 'Deserunt assumenda', 'on', 'Ex consequat Iste', 'Consectetur conse', '', '', '', '', '', '', '', '', 'Voluptatum modi ul', '', 'qybepometo_pic.png', '', '', '', '', '', '', '', '', '', '', '', '', '2019-09-09 11:59:42', '0000-00-00 00:00:00', ''),
(8, 'user', 'nupawuzal', 'fisotine@mail.com', '+1 (367) 897-2341', '+1 (471) 169-5921', 'Karleigh Jennings', 'Molestias aut et e', 'Possimus voluptat', 'Id esse quae ear', 'Sed veritatis ex e', 'Fugit quasi sint', 'on', 'Hic similique mini', 'Sit harum ullamco ', '', '', '', '', '', '', '', '', 'Beatae do ad non u', '', 'nupawuzal_pic.png', '', '', '', '', '', '', '', '', '', '', '', '', '2019-09-09 12:02:51', '0000-00-00 00:00:00', ''),
(9, 'user', 'zemucypa', 'kuwehas@mail.com', '+1 (803) 318-1764', '+1 (833) 326-3863', 'Ariana Ortega', 'Voluptate amet du', 'Adipisci et sequi ', 'Quis non enim blan', 'Voluptatum repelle', 'Repudiandae autem ', 'on', 'Suscipit dolorum m', 'Sint id sunt accu', '', '', '', '', '', '', '', '', 'Sit nemo accusanti', '', 'zemucypa_pic.png', '', '', '', '', '', '', '', '', '', '', '', '', '2019-09-09 12:06:01', '0000-00-00 00:00:00', ''),
(10, 'user', 'coduxygu', 'velix@mail.com', '+1 (153) 403-2676', '+1 (272) 142-6734', 'Jena Bradley', 'Dolore quaerat et ', 'Aut illum non sit', 'Quos velit provide', 'Nisi repudiandae q', 'Alias necessitatib', 'on', 'Consequatur fugia', 'Nulla odit veniam', '', '', '', '', '', '', '', '', 'Elit soluta rerum', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2019-09-09 12:15:35', '0000-00-00 00:00:00', ''),
(12, 'user', 'ajay', 'ajay@mail.com', '+1 (731) 467-5442', '+1 (793) 214-6076', 'Hadassah Ross', 'Sunt aut quisquam', 'Magni duis proiden', 'Quia consequatur ', 'Modi voluptatem I', 'Dolor nostrud nobi', 'on', 'Asperiores deserun', 'Laborum Consequat', 'a:3:{s:12:\"edu_course_1\";s:16:\"Velit at est ali\";s:15:\"edu_institute_1\";s:18:\"Dolorem deleniti m\";s:10:\"edu_year_1\";s:4:\"1980\";}', 'a:3:{s:12:\"edu_course_2\";s:18:\"Maiores quisquam p\";s:15:\"edu_institute_2\";s:18:\"Soluta et enim est\";s:10:\"edu_year_2\";s:4:\"2009\";}', 'a:3:{s:12:\"edu_course_3\";s:17:\"Ipsum ea molestia\";s:15:\"edu_institute_3\";s:16:\"Ex est et amet m\";s:10:\"edu_year_3\";s:4:\"1970\";}', 'a:3:{s:12:\"edu_course_4\";s:17:\"Proident deleniti\";s:15:\"edu_institute_4\";s:18:\"Quis rerum obcaeca\";s:10:\"edu_year_4\";s:4:\"1998\";}', 'a:3:{s:11:\"exp_title_1\";s:18:\"Cillum quo nulla e\";s:13:\"exp_company_1\";s:24:\"Livingston Hendricks Plc\";s:11:\"exp_years_1\";s:4:\"2003\";}', 'a:3:{s:11:\"exp_title_2\";s:17:\"Mollit optio ut p\";s:13:\"exp_company_2\";s:25:\"Buckley and Frank Traders\";s:11:\"exp_years_2\";s:4:\"1995\";}', 'a:3:{s:11:\"exp_title_3\";s:18:\"Praesentium invent\";s:13:\"exp_company_3\";s:23:\"Stevenson and Weeks Plc\";s:11:\"exp_years_3\";s:4:\"1984\";}', 'a:3:{s:11:\"exp_title_4\";s:18:\"Quia deserunt dict\";s:13:\"exp_company_4\";s:22:\"Aguilar and Conley Inc\";s:11:\"exp_years_4\";s:4:\"2006\";}', 'Aliqua Quis lorem', '', 'ajay_resume.pdf', 'ajay_pic.png', '', '', '', '', '', '', '', '', '', '', '', '2019-09-09 12:19:54', '2019-09-10 17:54:58', ''),
(13, 'employer', 'dozekazo', 'buriweci@mail.com', '+1 (501) 649-7276', '+1 (165) 437-3871', 'Macaulay Compton', 'Unde est vero sed ', 'Numquam ea delectu', 'Neque qui exceptur', 'Vel rerum possimus', 'Iste in est sed o', 'on', '', '', '', '', '', '', '', '', '', '', '', '', '', 'dozekazo_pic.png', 'Ezekiel Williamson', 'Ipsum cupiditate ', 'Voluptatum mollit ', 'https://www.dequda.net', '+1 (931) 442-4798', 'xyqypudeze@mail.com', 'Explicabo Delenit', 'Ducimus ducimus ', 'Obcaecati qui aute', 'Optio dolorum dol', 'dozekazo_id.pdf', '2019-09-09 12:23:11', '0000-00-00 00:00:00', ''),
(14, 'user', 'tinax', 'batyhihat@mail.com', '', '', 'Uta Doyle', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2019-09-23 12:40:46', '0000-00-00 00:00:00', ''),
(15, 'user', 'widow', 'widow@dark.com', '+1 (497) 236-8338', '+1 (299) 738-5906', 'Black Widower', 'Maiores cupidatat ', 'Et exercitationem ', 'Est ut non nihil c', 'Non ea voluptatem', 'Voluptatem Ipsam ', 'on', 'Iusto duis sit fug', 'Natus accusantium ', 'a:3:{s:12:\"edu_course_1\";s:18:\"Voluptate nihil et\";s:15:\"edu_institute_1\";s:16:\"Velit et elit iu\";s:10:\"edu_year_1\";s:4:\"1970\";}', 'a:3:{s:12:\"edu_course_2\";s:16:\"Est explicabo Od\";s:15:\"edu_institute_2\";s:18:\"Ex quasi ullam dol\";s:10:\"edu_year_2\";s:4:\"1982\";}', '', '', 'a:3:{s:11:\"exp_title_1\";s:18:\"Sapiente accusanti\";s:13:\"exp_company_1\";s:19:\"Haley Ewing Traders\";s:11:\"exp_years_1\";s:4:\"1981\";}', 'a:3:{s:11:\"exp_title_2\";s:18:\"Aut rerum debitis \";s:13:\"exp_company_2\";s:20:\"Foley Ingram Traders\";s:11:\"exp_years_2\";s:4:\"1989\";}', 'a:3:{s:11:\"exp_title_3\";s:18:\"Eu fugiat voluptat\";s:13:\"exp_company_3\";s:24:\"Murphy and Patterson Plc\";s:11:\"exp_years_3\";s:4:\"1987\";}', '', 'Commodo qui aut et', 'linkedin.com', 'widow_resume.jpg', 'widow_pic.jpg', 'x', '', '', '', '', '', '', '', '', '', 'widow_id.jpg', '2019-09-23 15:28:59', '2019-09-28 11:32:18', ''),
(16, 'employer', 'emplo', 'emplo@mailx.com', '+1 (454) 255-2528', '+1 (799) 849-3718', 'Empo Leon', 'Iure nostrud optio', 'Odio adipisicing e', 'Similique ex aliqu', 'Ipsam nihil eos ra', 'Provident est ips', 'Doloremque autem s', '', '', '', '', '', '', '', '', '', '', '', 'https://www.linkedin.com/fisasowyviveten', '', 'emplo_pic.jpg', 'Baxter Chang', 'Voluptates possimu', 'Tenetur vero dolor', 'https://www.fisasowyviveten.cc', '+1 (732) 932-5246', 'lipybepy@mail.com', 'Molestiae illo ame', 'Quos iste nobis qu', 'Nisi maxime ipsa ', 'Provident reicien', 'emplo_id.jpg', '2019-09-28 12:26:01', '2019-09-28 12:33:19', 'notes or information');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `uid` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `action_term` varchar(200) NOT NULL,
  `action_on` varchar(200) NOT NULL,
  `action_details` text NOT NULL,
  `dated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`uid`, `user_name`, `user_role`, `action_term`, `action_on`, `action_details`, `dated`) VALUES
(1, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-08-27 15:43:10'),
(2, 'admin', 'admin', 'admin_delete', '', 'Deleted admin with id: 6', '2019-08-27 15:43:49'),
(3, 'admin', 'admin', 'admin_delete', '', 'Deleted admin with id: 7', '2019-08-27 15:43:52'),
(4, 'admin', 'admin', 'admin_delete', '', 'Deleted admin with id: 8', '2019-08-27 15:43:58'),
(5, 'admin', 'admin', 'admin_edit', '', 'Edited admin info with id: 5', '2019-08-27 15:47:50'),
(6, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 10', '2019-08-27 17:18:32'),
(7, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 12', '2019-08-27 17:18:35'),
(8, 'admin', 'admin', 'user_edit', '', 'Edited user info with id: 2', '2019-08-27 17:18:46'),
(9, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-09-02 11:18:18'),
(10, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-09-03 15:35:54'),
(11, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 16', '2019-09-03 15:35:59'),
(12, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 14', '2019-09-03 15:36:10'),
(13, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-09-23 11:46:58'),
(14, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 17', '2019-09-23 12:04:42'),
(15, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 25', '2019-09-23 12:05:52'),
(16, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 18', '2019-09-23 12:06:59'),
(17, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 24', '2019-09-23 12:09:32'),
(18, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 1', '2019-09-23 12:17:23'),
(19, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 1', '2019-09-23 12:17:48'),
(20, 'admin', 'admin', 'user_delete', '', 'Deleted user with id: 27', '2019-09-23 12:38:43'),
(21, 'admin', 'admin', 'user_add', '', 'Added new user with id: 0', '2019-09-23 12:39:06'),
(22, 'admin', 'admin', 'user_add', '', 'Added new user with id: 0', '2019-09-23 12:40:03'),
(23, 'admin', 'admin', 'user_add', '', 'Added new user with id: 14', '2019-09-23 12:40:46'),
(24, 'tinax', 'user', 'login', '', 'Front End User logged in using login page', '2019-09-23 12:57:53'),
(25, 'tinax', 'user', 'login', '', 'Front End User logged in using login page', '2019-09-23 13:00:38'),
(26, 'tinax', 'user', 'login', '', 'Front End User logged in using login page', '2019-09-23 13:00:59'),
(27, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-09-23 14:48:06'),
(28, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-09-23 15:29:34'),
(29, 'widow', 'user', 'login', '', 'Front End User logged in using login page', '2019-09-28 11:23:35'),
(30, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-09-28 11:26:54'),
(31, 'admin', 'admin', 'user_add', '', 'Added new user with id: 16', '2019-09-28 12:26:01'),
(32, 'emplo', 'employer', 'login', '', 'Front End User logged in using login page', '2019-09-28 12:34:28'),
(33, 'emplo', 'employer', 'login', '', 'Front End User logged in using login page', '2019-09-28 13:14:54'),
(34, 'widow', 'user', 'login', '', 'Front End User logged in using login page', '2019-09-28 13:23:44'),
(35, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-10-01 14:59:30'),
(36, 'widow', 'user', 'login', '', 'Front End User logged in using login page', '2019-10-03 11:25:17'),
(37, 'emplo', 'employer', 'login', '', 'Front End User logged in using login page', '2019-10-03 11:25:27'),
(38, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-10-03 11:32:45'),
(39, 'admin', 'admin', 'job_add', '', 'Added new job with id: 1', '2019-10-04 15:32:55'),
(40, 'admin', 'admin', 'job_add', '', 'Added new job with id: 2', '2019-10-04 15:35:36'),
(41, 'admin', 'admin', 'job_add', '', 'Added new job with id: 3', '2019-10-07 12:11:23'),
(42, 'admin', 'admin', 'job_add', '', 'Added new job with id: 4', '2019-10-07 12:11:39'),
(43, 'admin', 'admin', 'job_add', '', 'Added new job with id: 5', '2019-10-07 12:13:17'),
(44, 'admin', 'admin', 'job_add', '', 'updated new job with id: 5', '2019-10-07 12:38:15'),
(45, 'admin', 'admin', 'job_delete', '', 'Deleted Job with id: 1', '2019-10-07 12:51:11'),
(46, 'admin', 'admin', 'job_add', '', 'Added new job with id: 6', '2019-10-07 14:46:50'),
(47, 'admin', 'admin', 'job_add', '', 'updated new job with id: 5', '2019-10-10 12:40:15'),
(48, 'admin', 'admin', 'job_add', '', 'updated new job with id: 2', '2019-10-10 12:40:25'),
(49, 'admin', 'admin', 'job_add', '', 'updated new job with id: 3', '2019-10-10 12:42:14'),
(50, 'admin', 'admin', 'job_add', '', 'updated new job with id: 4', '2019-10-10 12:42:27'),
(51, 'admin', 'admin', 'job_add', '', 'Added new job with id: 7', '2019-10-10 14:13:41'),
(52, 'admin', 'admin', 'job_add', '', 'updated new job with id: 7', '2019-10-10 14:15:19'),
(53, 'admin', 'admin', 'job_add', '', 'updated new job with id: 6', '2019-10-10 14:18:24'),
(54, 'admin', 'admin', 'job_add', '', 'updated new job with id: 7', '2019-10-10 14:18:33'),
(55, 'admin', 'admin', 'job_add', '', 'updated new job with id: 7', '2019-10-10 14:18:42'),
(56, 'ajay', 'employer', 'login', '', 'Front End User logged in using login page', '2019-10-10 14:32:21'),
(57, 'ajay', 'employer', 'job_add', '', 'updated new job with id: 4', '2019-10-10 16:15:56'),
(58, 'ajay', 'employer', 'job_add', '', 'updated new job with id: 4', '2019-10-10 16:17:14'),
(59, 'ajay', 'employer', 'job_add', '', 'updated new job with id: 4', '2019-10-10 16:18:16'),
(60, 'ajay', 'employer', 'job_add', '', 'updated new job with id: 4', '2019-10-10 16:18:40'),
(61, 'ajay', 'employer', 'job_add', '', 'Added new job with id: 8', '2019-10-10 16:27:57'),
(62, 'widow', 'user', 'login', '', 'Front End User logged in using login page', '2019-10-10 16:30:21'),
(63, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-10-10 16:33:06'),
(64, 'ajay', 'employer', 'login', '', 'Front End User logged in using login page', '2019-10-11 11:34:02'),
(65, 'admin', 'admin', 'login', '', 'user logged in using login panel', '2019-10-11 18:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(250) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `dated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `role`, `email`, `fullname`, `status`, `dated`) VALUES
(30, 'emplo', 'e10adc3949ba59abbe56e057f20f883e', 'employer', 'emplo@mailx.com', 'Empo Leon', 'pending', '2019-09-28 12:26:01'),
(2, 'kapil', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'kapil@mail.in', 'Kapil Dev', 'active', '2019-08-27 16:57:53'),
(13, 'ajay', 'e10adc3949ba59abbe56e057f20f883e', 'employer', 'ajay@mail.com', 'Ajay Sen', 'active', '2019-08-27 12:57:45'),
(19, 'welixy', 'a2784c7656d665b686dc86ce38d38637', 'user', 'frodo@mail.com', 'Dana Berry', 'active', '2019-09-09 11:47:21'),
(20, 'qybepometo', '28434d6f88a80834e7799a0cbb3baaf9', 'user', 'meky@mail.com', 'Gretchen Brooks', 'active', '2019-09-09 11:59:42'),
(21, 'nupawuzal', '28434d6f88a80834e7799a0cbb3baaf9', 'user', 'fisotine@mail.com', 'Karleigh Jennings', 'active', '2019-09-09 12:02:51'),
(22, 'zemucypa', '28434d6f88a80834e7799a0cbb3baaf9', 'user', 'kuwehas@mail.com', 'Ariana Ortega', 'active', '2019-09-09 12:06:01'),
(23, 'coduxygu', '28434d6f88a80834e7799a0cbb3baaf9', 'user', 'velix@mail.com', 'Jena Bradley', 'active', '2019-09-09 12:15:35'),
(28, 'tinax', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'batyhihat@mail.com', 'Uta Doyle', 'pending', '2019-09-23 12:40:46'),
(29, 'widow', 'fcea920f7412b5da7be0cf42b8c93759', 'user', 'widow@dark.com', 'Black Widower', 'active', '2019-09-23 15:28:59'),
(26, 'dozekazo', '28434d6f88a80834e7799a0cbb3baaf9', 'employer', 'buriweci@mail.com', 'Macaulay Compton', 'active', '2019-09-09 12:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `users_resetpass`
--

CREATE TABLE `users_resetpass` (
  `rid` int(11) NOT NULL,
  `email` varchar(300) NOT NULL,
  `token` varchar(300) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_resetpass`
--

INSERT INTO `users_resetpass` (`rid`, `email`, `token`, `expDate`) VALUES
(1, 'kapil@mail.in', '768e78024aa8fdb9b8fe87be86f64745aaf43c86bf', '2019-07-31 11:38:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `amounts`
--
ALTER TABLE `amounts`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `applied`
--
ALTER TABLE `applied`
  ADD PRIMARY KEY (`ujid`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`uidx`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user_email` (`email`);

--
-- Indexes for table `users_resetpass`
--
ALTER TABLE `users_resetpass`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `applied`
--
ALTER TABLE `applied`
  MODIFY `ujid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `uidx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users_resetpass`
--
ALTER TABLE `users_resetpass`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
