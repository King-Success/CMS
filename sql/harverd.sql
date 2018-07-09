-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2018 at 09:51 AM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsnew`
--

-- --------------------------------------------------------

--
-- dumping data into table `subjects`
INSERT INTO `subjects` (`id`, `name`, `class_id`, `staff_id`, `created_at`, `updated_at`) VALUES (NULL, 'Physics',
'', '', NULL, NULL), (NULL, 'Mathmatics', '', '', NULL, NULL), (NULL, 'Biology', '', '', NULL, NULL), (NULL, 'Economics',
'', '', NULL, NULL), (NULL, 'Agric', '', '', NULL, NULL), (NULL, 'English', '', '', NULL, NULL), (NULL, 'Commerce', '',
'', NULL, NULL), (NULL, 'History', '', '', NULL, NULL), (NULL, 'Technical drawing', '', '', NULL, NULL), (NULL, 
'Further Mathmatics', '', '', NULL, NULL);


INSERT INTO `subject_scores` (`id`, `student_id`, `subject_id`, `class_id`, `class_options_id`, `teacher_id`, 
`session_id`, `term_id`, `CA1`, `CA2`, `CA3`, `CA4`, `CA5`, `exam`, `total`, `position`, `created_at`, `updated_at`) 
VALUES (NULL, '1', '1', '6', '1', '1', '1', '1', '6', '7', '2', '3', NULL, '65', '95', '1', NULL, NULL), (NULL, '1', '2',
'6', '1', '2', '1', '1', '5', '7', '4', '3', NULL, '67', '89', '2', NULL, NULL), (NULL, '1', '3', '6', '1', '3', '1', '1',
'4', '5', '3', '3', NULL, '', '76', '4', NULL, NULL), (NULL, '1', '4', '6', '1', '4', '1', '1', '7', '8', '5', '4', NULL,
'67', '91', '1', NULL, NULL), (NULL, '1', '5', '6', '1', '5', '1', '1', '4', '8', '4', '5', '', '67', '88', '1', NULL,
NULL), (NULL, '1', '6', '6', '1', '6', '1', '1', '4', '4', '5', '5', '', '69', '89', '1', NULL, NULL);

INSERT INTO `teachers` (`id`, `staff_id`, `created_at`, `updated_at`) VALUES (NULL, '1', NULL, NULL), (NULL, '2', NULL, 
NULL), (NULL, '3', NULL, NULL), (NULL, '4', NULL, NULL), (NULL, '5', NULL, NULL), (NULL, '6', NULL, NULL);

INSERT INTO `sessions` (`id`, `name`, `description`, `year`, `active`, `created_at`, `updated_at`) VALUES (NULL, 
'2015/2016', '', '2016', '1', NULL, NULL);

INSERT INTO `classes` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, 'JSS 1', NULL, NULL), (NULL, 'JSS 2', 
NULL, NULL), (NULL, 'JSS 3', NULL, NULL), (NULL, 'SSS 1', NULL, NULL), (NULL, 'SSS 2', NULL, NULL), (NULL, 'SSS 3', NULL,
 NULL);

 INSERT INTO `class_options` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, 'A', NULL, NULL), (NULL, 'B', NULL,
  NULL), (NULL, 'C', NULL, NULL), (NULL, 'D', NULL, NULL), (NULL, 'E', NULL, NULL);


INSERT INTO `subject_scores` (`id`, `student_id`, `subject_id`, `class_id`, `class_options_id`, `teacher_id`, 
`session_id`, `term_id`, `CA1`, `CA2`, `CA3`, `CA4`, `CA5`, `exam`, `total`, `position`, `created_at`, `updated_at`) 
VALUES (NULL, '1', '1', '6', '1', '1', '1', '2', '10', '6', '3', '4', NULL, '70', '93', '1', NULL, NULL);