-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 09:17 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boilerplate_greendash`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eliezer', 'Morissette', '(864) 308-3026', 'admin@admin.com', '2022-03-08 01:00:35', '$2y$10$8.X7mfFbGPBeqMpmBamV2OMCRT9ICO0Ng5Lj.u4S9cYqU0jgA9DLG', 'kejjf7SbpRAIa9dZbRgIsOlITe3jqag7Tof1aDjFRcSL9ZjaVpBU1usnTXxW', '2022-03-08 01:00:35', '2022-03-22 01:58:39'),
(2, 'Itzel', 'Stokes', '989.810.4659', 'ralph15@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oJjPPGy8HE', '2022-03-08 01:00:35', '2022-03-08 01:00:35'),
(3, 'Emmy', 'Hettinger', '+14694479054', 'kautzer.rafaela@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8pdttHB95h', '2022-03-08 01:00:35', '2022-03-08 01:00:35'),
(4, 'Ona', 'McDermott', '+1-731-989-9540', 'hkilback@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HWkf9SWGQm', '2022-03-08 01:00:35', '2022-03-08 01:00:35'),
(5, 'Camron', 'Funk', '+1-517-806-1083', 'annalise29@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'it39J83dZB', '2022-03-08 01:00:35', '2022-03-08 01:00:35'),
(6, 'Tavares', 'Conroy', '463.540.0921', 'schaefer.charles@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'v2v04ZIWsv', '2022-03-08 01:00:35', '2022-03-08 01:00:35'),
(7, 'Miller', 'Collier', '(223) 317-0003', 'burnice.mosciski@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'F8kWrtdNFn', '2022-03-08 01:00:35', '2022-03-08 01:00:35'),
(8, 'Shemar', 'VonRueden', '272-302-8949', 'bahringer.zelda@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'o3M4ln7Wb9', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(9, 'Lincoln', 'Schmeler', '+1 (470) 765-8889', 'rosalia.witting@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tzO1keV4t7', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(10, 'Jacklyn', 'Thiel', '260.720.5708', 'beer.weldon@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BoGefcwlSe', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(11, 'Ronny', 'Beatty', '+1 (747) 236-0915', 'herta46@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KlSOorzOmn', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(12, 'Arno', 'White', '1-803-797-1631', 'freida.green@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UJr4HHPNeF', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(13, 'Richie', 'Leuschke', '972-603-8537', 'kuhic.lizzie@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5Na9H638oP', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(14, 'Pink', 'Rodriguez', '+12628885671', 'qcartwright@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'VcmMawb6Pz', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(15, 'Emiliano', 'Rath', '217-790-9625', 'fdubuque@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'h63saXdy4h', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(16, 'Odessa', 'Cruickshank', '+15164205776', 'claude94@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yX0zv0kYm2', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(17, 'Elza', 'Labadie', '1-970-253-5514', 'jdaugherty@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'WCh6P4CnjE', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(18, 'Valentine', 'Cummerata', '+1-585-829-5503', 'joanny38@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vq4tOFTzSn', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(19, 'Aryanna', 'Marks', '(463) 692-3392', 'lueilwitz.katelynn@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ijf8GYss7R', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(20, 'Preston', 'Farrell', '930.683.9340', 'bschmitt@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5dVxiiSs4k', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(21, 'Leonor', 'Fadel', '+15853720312', 'irwin.hegmann@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'PX23A6DwsR', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(22, 'Vince', 'Monahan', '(838) 215-6354', 'dibbert.robb@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fWUWWSydL0', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(23, 'Jacey', 'Brekke', '979.838.2393', 'kiera92@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vpCxuBhKtt', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(24, 'Jayce', 'Moen', '(817) 627-1841', 'nicole61@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rzOWVeLND7', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(25, 'Lexie', 'Tromp', '1-870-240-0607', 'mgoldner@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'n021LGZ2w9', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(26, 'Devyn', 'Lynch', '+1.571.331.0741', 'anissa.jaskolski@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BJCAVG8405', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(27, 'Kale', 'Rosenbaum', '272.683.6659', 'akemmer@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FoPsYxsM5W', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(28, 'Lowell', 'McCullough', '+1 (620) 735-4571', 'kenyon54@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nKSNLRwePO', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(29, 'Garrett', 'Roob', '+18637455306', 'whuel@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1gRL8UmGHX', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(30, 'Kenyatta', 'Mertz', '620.647.2018', 'thomas95@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TACbIsHpQV', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(31, 'Vivianne', 'Pfannerstill', '+1 (219) 447-3423', 'letha61@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xLZB1qEPsK', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(32, 'Nigel', 'Romaguera', '1-240-474-4914', 'vida35@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fn9P7qzvNH', '2022-03-08 01:00:36', '2022-03-08 01:00:36'),
(33, 'Cyrus', 'West', '323-593-4693', 'easton30@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sX6G5GoPow', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(34, 'Skylar', 'Christiansen', '+1.480.693.7517', 'wondricka@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1bWCGuK7K0', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(35, 'Vicky', 'Smitham', '267.493.8965', 'houston.turner@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'f2BuqKGfYS', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(36, 'Kiley', 'Jacobson', '314.992.0661', 'orion.hartmann@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hBeUgk2dkr', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(37, 'Rachael', 'Kling', '479-312-8799', 'bauch.lucius@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XGXQWIRUpm', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(38, 'Russell', 'Robel', '864.518.0597', 'gerlach.lue@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pigeTO7TFp', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(39, 'Talia', 'Maggio', '+1.262.274.6180', 'eddie75@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lp15g7itPa', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(40, 'Rosalyn', 'Schumm', '570.440.6121', 'mcorwin@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hqugunoDCn', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(41, 'Shea', 'Schiller', '+1 (551) 638-0130', 'dbeahan@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0ePuXFziSt', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(42, 'Roxane', 'Auer', '+1-240-408-9766', 'hope99@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jqXiJE5QyK', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(43, 'Gwen', 'Frami', '+1 (352) 438-9589', 'lacey12@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MmoybQEtre', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(44, 'Norma', 'Brekke', '+18283330824', 'neha94@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fu1G9HCmpK', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(45, 'Preston', 'O\'Conner', '1-480-383-4440', 'rachael83@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1xO4jDgMzD', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(46, 'Brenda', 'Hodkiewicz', '1-669-685-3870', 'avery64@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jQRPF0dWo4', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(47, 'Irving', 'Toy', '765-331-6223', 'steuber.vallie@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 's6obYlez1g', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(48, 'Jaydon', 'Waelchi', '(480) 912-0371', 'kattie75@example.com', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vL0EHJ7i8l', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(49, 'Mckenna', 'Klocko', '636.694.6713', 'kschiller@example.net', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'EUTpBfp1ah', '2022-03-08 01:00:37', '2022-03-08 01:00:37'),
(50, 'Kenton', 'Hoeger', '(351) 355-2255', 'zanderson@example.org', '2022-03-08 01:00:35', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XI2egPIDUI', '2022-03-08 01:00:37', '2022-03-08 01:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_08_050250_create_admins_table', 1),
(6, '2022_03_08_050314_create_vendors_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phone`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tremayne', 'Weimann', '+1.520.668.9533', 'user@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'syNNcGZqtWY5OmNnMXoqAbKlFcUlnFaMKRozfzM5H3tESifA9mMZl8AeCsGb', '2022-03-08 01:00:21', '2022-03-08 01:00:21'),
(2, 'Selena', 'Sporer', '337.875.3299', 'bruen.zora@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'AU0iCW5kmZ', '2022-03-08 01:00:21', '2022-03-08 01:00:21'),
(3, 'Citlalli', 'Volkman', '(316) 200-6553', 'delpha38@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'pwVakfk219', '2022-03-08 01:00:21', '2022-03-08 01:00:21'),
(4, 'Christy', 'Marvin', '269-780-4199', 'fgusikowski@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'pQBPQ0BwU7', '2022-03-08 01:00:21', '2022-03-08 01:00:21'),
(5, 'Skylar', 'McKenzie', '1-803-440-7953', 'jennifer49@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'ZBuDjrxJQY', '2022-03-08 01:00:21', '2022-03-08 01:00:21'),
(6, 'Gerry', 'Mohr', '(229) 680-1083', 'jones.linnie@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'hFHLjvY0bH', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(7, 'Monique', 'Bradtke', '+1 (520) 847-5374', 'abdul38@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'Es8eUh49fy', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(8, 'Kiara', 'Orn', '(838) 919-4695', 'brekke.guiseppe@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'h19SfbgjfB', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(9, 'Calista', 'Zulauf', '(308) 425-9733', 'hilario24@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '19YeBSY7mK', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(10, 'Everett', 'Grimes', '(718) 546-6303', 'araceli.friesen@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '7cVjV8T674', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(11, 'Lenny', 'Strosin', '+1 (917) 929-1225', 'lucius.fritsch@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '7I4uLFKK75', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(12, 'Gay', 'Smitham', '434-885-3885', 'fernando.dare@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'LPHIKvKisR', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(13, 'Remington', 'Nader', '+1-901-505-1231', 'nprohaska@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'RlunbEYZih', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(14, 'Tito', 'Kulas', '+19177343132', 'kaycee.jast@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'GZEQsDxBzS', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(15, 'Deondre', 'Robel', '(585) 844-7013', 'kutch.jennings@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'POq5S2wG9P', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(16, 'Leif', 'Macejkovic', '+1.815.883.9210', 'thompson.pattie@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'AeonaG3vyi', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(17, 'Jackson', 'Kunze', '+17793496563', 'aurelio13@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'GpfT6VEV91', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(18, 'Jennyfer', 'Bechtelar', '1-707-229-5565', 'eryn37@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'ns2jVB3JOt', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(19, 'Thelma', 'Gulgowski', '1-854-375-9676', 'gweimann@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'Ug49Kl5Kbm', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(20, 'Molly', 'Swift', '+1-606-437-9621', 'ansley71@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'mGPmewcEON', '2022-03-08 01:00:22', '2022-03-08 01:00:22'),
(21, 'Golden', 'Rogahn', '904-295-5928', 'kali02@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '1GkVXmbepp', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(22, 'Jeromy', 'Jakubowski', '1-228-580-5421', 'stracke.kenyatta@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'jToCazWPFO', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(23, 'Logan', 'Blick', '224-932-2850', 'robin91@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'HFcw9COiuz', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(24, 'Kirsten', 'Kertzmann', '1-251-285-7819', 'klarkin@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'udnyY7O5OE', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(25, 'Reyes', 'Little', '1-765-675-7725', 'jzboncak@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'QSWeQfkXfm', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(26, 'Lance', 'Mertz', '541-490-3099', 'ewell35@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'Shgj9ekvQn', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(27, 'Andreanne', 'Franecki', '321-369-8968', 'yhagenes@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'keJwxSbF18', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(28, 'Mekhi', 'Hammes', '463.304.7685', 'funk.breanna@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'oAYfEQRbsr', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(29, 'Troy', 'Schaden', '571-710-9772', 'erowe@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '8GQ5cIx384', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(30, 'Lavon', 'Schimmel', '774-253-2569', 'acasper@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'pJ2fD1amMf', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(31, 'Libby', 'Zulauf', '785-474-6199', 'dorris51@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'dzk1gHzJum', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(32, 'Jarrod', 'Tromp', '+1-531-898-3302', 'aurelie24@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '2MuSoXrZs8', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(33, 'Kaelyn', 'Schimmel', '+1 (931) 634-8850', 'gerry18@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'pRbPbPfga0', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(34, 'Dangelo', 'Rowe', '+1-432-602-1511', 'bergnaum.pablo@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'JwQVgHrp91', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(35, 'Myah', 'VonRueden', '1-802-266-3291', 'alessandra97@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'YMiZJtdBxX', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(36, 'Esmeralda', 'Hoppe', '551.383.1298', 'katrina.von@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'lO47gqjXJK', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(37, 'Donnie', 'Cormier', '(302) 720-0677', 'harber.alessandro@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'kgInlnVNvq', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(38, 'Magali', 'Towne', '201.240.2549', 'elias10@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '0ksK6T2tzo', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(39, 'Angelina', 'Bechtelar', '1-856-764-5333', 'ehirthe@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'av6IcPe88m', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(40, 'Fern', 'Beahan', '+1.906.488.4228', 'madeline.connelly@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'ecLVyQzTBw', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(41, 'Nash', 'Koelpin', '1-430-360-5708', 'hilpert.alverta@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '9m88M66cZi', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(42, 'Destin', 'Prohaska', '1-480-759-9935', 'jarod91@example.net', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '5STHWBxgfR', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(43, 'Myrtis', 'Casper', '220-660-7417', 'johan76@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '0PJUQ0NbL6', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(44, 'Alf', 'Lindgren', '+15168551387', 'hcrooks@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'kBjbaaWuSb', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(45, 'Creola', 'Koch', '458.588.9096', 'lottie.schroeder@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'ogue4GHTyH', '2022-03-08 01:00:23', '2022-03-08 01:00:23'),
(46, 'Cruz', 'Watsica', '+1 (337) 288-7143', 'bo32@example.org', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'g6PBhEhjLd', '2022-03-08 01:00:24', '2022-03-08 01:00:24'),
(47, 'Maxie', 'Keebler', '+1.351.393.1822', 'vicenta.eichmann@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'ywE03vsoK8', '2022-03-08 01:00:24', '2022-03-08 01:00:24'),
(48, 'Laury', 'Jacobi', '+17066419126', 'claude44@example.com', '2022-03-08 01:00:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'M3hkA1aqL3', '2022-03-08 01:00:24', '2022-03-08 01:00:24'),
(51, 'Mark', 'Jacob', '9958745896', 'markjacob@gmail.com', NULL, '$2y$10$/YuH1KHNLTZ7.adelLmwreHTe6I3tU.TF/FGszyelEcNd4A69Qyi2', 'active', NULL, '2022-03-22 01:54:39', '2022-03-22 01:56:21'),
(52, 'Allen', 'West', '9874589625', 'allenwest@gmailcom', NULL, '$2y$10$tUUNd3felbODZcajMnMvkuwPMJcDtPr3F/K9OvvuwZOE9VoAHUHHm', 'active', NULL, '2022-03-22 02:21:48', '2022-03-22 02:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `firstname`, `lastname`, `phone`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Barry', 'Allen', '+1.240.475.7465', 'vendor@admin.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'Hpm6znLyrH', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(2, 'Michel', 'Hartmann', '+15734837245', 'xmcclure@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'uO2E0er8ZV', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(3, 'Modesta', 'Wilderman', '(740) 913-6267', 'schmeler.earnestine@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'WyYgxXbMtn', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(4, 'Leora', 'Kohler', '913.984.9323', 'prunte@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'pUFnwLz8cr', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(5, 'Ruben', 'Monahan', '435-388-9542', 'treva.murphy@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'QjhhWyR0y3', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(6, 'Jeanne', 'Klein', '952-763-1885', 'cdurgan@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'SN87ZPbR9P', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(7, 'Constantin', 'Hettinger', '(651) 640-7139', 'gulgowski.shanel@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'Cz4VJINzG2', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(8, 'Toy', 'Kub', '341.674.2640', 'abbott.adolphus@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'SSSApba07o', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(9, 'Eunice', 'Kub', '1-812-319-7418', 'lind.adolfo@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '6YdtKL1d3x', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(10, 'Marielle', 'Buckridge', '(336) 350-8238', 'strosin.laury@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'h2N7UT9Rm0', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(11, 'Vern', 'Hodkiewicz', '973.875.3969', 'spencer.lynch@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'oxCxH6Tst9', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(12, 'Maximillia', 'Conn', '+1 (361) 488-6757', 'bruen.rafael@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'JAFX4Jeetp', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(13, 'Elyssa', 'Pacocha', '1-769-718-1683', 'jeramy21@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'oXEgWaqXU7', '2022-03-08 01:00:27', '2022-03-08 01:00:27'),
(14, 'Breanna', 'Spinka', '+14633512281', 'karley.bernier@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'TxWT9uVaIm', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(15, 'Garnett', 'Kautzer', '+19848228082', 'webster.conn@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '5w2VA5kIgU', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(16, 'Maximilian', 'Toy', '617-498-7984', 'edickinson@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'dVb3fE9OnR', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(17, 'Courtney', 'Yundt', '+1-281-973-1110', 'vjohns@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '20nsJlni5V', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(18, 'Marlen', 'Gerhold', '364-700-7431', 'lbartell@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'yc0bDD0LWN', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(19, 'Rahsaan', 'Bergnaum', '(231) 990-9366', 'uspinka@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '73wHGlNc7e', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(20, 'Clemens', 'Hyatt', '+1 (609) 305-4613', 'delilah70@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'XeNYR0FFeN', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(21, 'Maci', 'Metz', '+1 (972) 894-2284', 'luettgen.eldred@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'AJEeGWYEYk', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(22, 'Ruth', 'D\'Amore', '+16506861265', 'beer.oral@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'Sfjy4S6xC9', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(23, 'Theodora', 'Huel', '(623) 388-8807', 'vita.gislason@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'PNxvruLwIL', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(24, 'Dustin', 'Ratke', '(364) 483-7448', 'conrad.reilly@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'ge2qtQh9da', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(25, 'Quincy', 'Jacobi', '+1-602-461-2268', 'leland17@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'esYdz1poWj', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(26, 'Darby', 'Watsica', '539-723-6498', 'rashad17@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'TeU1EMGMlm', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(27, 'Stephen', 'Schneider', '+19566420240', 'brandt42@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'qZxc3Y8ltc', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(28, 'Lora', 'Hill', '737-527-1489', 'powlowski.ben@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'nuLE96TNRU', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(29, 'Autumn', 'Nicolas', '934.384.2380', 'claudie.murphy@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'YMQ81FvVgI', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(30, 'Jaydon', 'Kuhlman', '(941) 347-4373', 'habshire@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'qtPKbqC3Gd', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(31, 'Raymundo', 'Davis', '+1 (504) 540-9532', 'everett.reynolds@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'dQPv6zRede', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(32, 'Claud', 'Reynolds', '+1-541-354-8587', 'eli26@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'Vg3xbSxhD7', '2022-03-08 01:00:28', '2022-03-08 01:00:28'),
(33, 'Zoey', 'Kuphal', '(336) 213-4401', 'lina.kautzer@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'FUuIUaLs34', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(34, 'Deven', 'Collier', '1-347-752-4561', 'kbogisich@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'B7EoOJOtvY', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(35, 'Priscilla', 'Pacocha', '502.561.4450', 'jledner@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'wz5IYmPzUh', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(36, 'Odie', 'Lind', '+1.934.729.9388', 'kacie36@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'HJX5kKxLvy', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(37, 'Madilyn', 'Parker', '+1 (934) 445-6922', 'shields.lauretta@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'lHmsqDR7Xh', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(38, 'Wilson', 'Will', '+1 (218) 997-4086', 'harris.roberto@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'mw0v75FOD8', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(39, 'Alyson', 'Olson', '(740) 390-5318', 'werner20@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'UhXYvmvQf8', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(40, 'Florida', 'Larson', '503.433.1720', 'parisian.quinton@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'bPkTYllaIk', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(41, 'Billie', 'Gislason', '801-681-4753', 'scotty68@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '8WDGi25uVr', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(42, 'Tara', 'Donnelly', '+1-262-784-2301', 'brant27@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'LSaMZmVQTR', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(43, 'Maximo', 'Turcotte', '360.248.9873', 'sabryna.bogan@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'aBmZgd2kdB', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(44, 'Jada', 'Volkman', '+13392598690', 'marcia.goyette@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'f1fKOtoGvU', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(45, 'Allison', 'Ziemann', '1-872-726-1235', 'trycia11@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'PJYNA3wOct', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(46, 'Edmond', 'Murphy', '1-754-660-5842', 'xpfannerstill@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'f3ePdq9QJa', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(47, 'Kareem', 'Murphy', '828-909-1265', 'dare.domenica@example.org', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', '4xlW3gqlkc', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(48, 'Baby', 'O\'Conner', '281-969-3867', 'dwelch@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'ivqJon673N', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(49, 'Dion', 'Schulist', '+1-531-819-3799', 'hadley.denesik@example.com', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'jZw83xQ8yX', '2022-03-08 01:00:29', '2022-03-08 01:00:29'),
(50, 'Enrico', 'Lemke', '1-838-544-7854', 'lynn.runte@example.net', '2022-03-08 01:00:27', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'active', 'q8YhItn5An', '2022-03-08 01:00:29', '2022-03-08 01:00:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_phone_unique` (`phone`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
