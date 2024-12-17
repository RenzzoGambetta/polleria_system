-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para flowfer_pelleria
CREATE DATABASE IF NOT EXISTS `flowfer_pelleria` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `flowfer_pelleria`;

-- Volcando datos para la tabla flowfer_pelleria.brands: ~10 rows (aproximadamente)
INSERT IGNORE INTO `brands` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Raynor, Feest and Runolfsdottir', '', '2024-11-14 22:43:50', '2024-11-14 22:43:50'),
	(2, 'Towne Ltd', '', '2024-11-14 22:43:53', '2024-11-14 22:43:53'),
	(3, 'Ankunding and Sons', '', '2024-11-14 22:43:57', '2024-11-14 22:43:57'),
	(4, 'Von Ltd', '', '2024-11-14 22:44:00', '2024-11-14 22:44:00'),
	(5, 'Dare PLC', '', '2024-11-14 22:44:04', '2024-11-14 22:44:04'),
	(6, 'Gottlieb, Yundt and Stokes', '', '2024-11-14 22:45:48', '2024-11-14 22:45:48'),
	(7, 'Streich LLC', '', '2024-11-14 22:45:52', '2024-11-14 22:45:52'),
	(8, 'Hammes, Kovacek and Green', '', '2024-11-14 22:45:55', '2024-11-14 22:45:55'),
	(9, 'Hane Inc', '', '2024-11-14 22:45:58', '2024-11-14 22:45:58'),
	(10, 'Jones-Beatty', '', '2024-11-14 22:46:02', '2024-11-14 22:46:02');

-- Volcando datos para la tabla flowfer_pelleria.cache: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.cache_locks: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.cashier_sessions: ~15 rows (aproximadamente)
INSERT IGNORE INTO `cashier_sessions` (`id`, `user_id`, `employee_id`, `opening_balance`, `cash_open_at`, `cash_close_at`, `note`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 43.00, '2024-11-15 22:26:27', '2024-11-15 22:28:45', '1', '2024-11-15 22:26:27', '2024-11-15 22:28:45'),
	(2, 2, 1, 1200.00, '2024-12-08 00:50:17', '2024-12-08 00:50:16', '1', '2024-11-15 22:29:06', '2024-11-15 22:29:06'),
	(3, 1, 1, 1200.00, '2024-12-08 00:21:25', '2024-12-08 05:21:25', '1', '2024-11-15 22:29:10', '2024-12-08 05:21:25'),
	(4, 1, 2, 0.00, '2024-12-08 00:43:19', '2024-12-08 05:43:19', '1', '2024-12-08 05:42:43', '2024-12-08 05:43:19'),
	(5, 1, 2, 12.00, '2024-12-08 00:47:17', '2024-12-08 05:47:17', '1', '2024-12-08 05:45:52', '2024-12-08 05:47:17'),
	(6, 1, 1, 1.00, '2024-12-08 00:48:31', '2024-12-08 05:48:31', '1', '2024-12-08 05:47:41', '2024-12-08 05:48:31'),
	(7, 1, 2, 12.00, '2024-12-08 00:49:51', '2024-12-08 05:49:51', '1', '2024-12-08 05:48:37', '2024-12-08 05:49:51'),
	(8, 1, 3, 12.00, '2024-12-08 00:50:33', '2024-12-08 05:50:33', '1', '2024-12-08 05:49:56', '2024-12-08 05:50:33'),
	(9, 1, 2, 12.00, '2024-12-08 02:21:21', '2024-12-08 07:21:21', '1', '2024-12-08 07:21:09', '2024-12-08 07:21:21'),
	(10, 1, 2, 12.00, '2024-12-08 02:24:38', '2024-12-08 07:24:38', '1', '2024-12-08 07:24:08', '2024-12-08 07:24:38'),
	(11, 1, 2, 12.00, '2024-12-08 02:25:05', '2024-12-08 07:25:05', '1', '2024-12-08 07:24:43', '2024-12-08 07:25:05'),
	(12, 1, 1, 12.00, '2024-12-08 02:26:22', '2024-12-08 07:26:22', '1', '2024-12-08 07:25:14', '2024-12-08 07:26:22'),
	(13, 1, 2, 12.00, '2024-12-08 02:28:42', '2024-12-08 07:28:42', '1', '2024-12-08 07:26:31', '2024-12-08 07:28:42'),
	(14, 1, 2, 12.00, '2024-12-08 17:07:52', '2024-12-08 22:07:52', '1', '2024-12-08 07:31:39', '2024-12-08 22:07:52'),
	(15, 1, 2, 1200.00, '2024-12-10 02:50:53', '2024-12-10 07:50:53', '1', '2024-12-08 22:08:09', '2024-12-10 07:50:53'),
	(16, 1, 2, 10.00, '2024-12-12 03:19:23', '2024-12-12 08:19:23', '1', '2024-12-10 07:51:02', '2024-12-12 08:19:23'),
	(17, 1, 2, 1200.00, '2024-12-12 08:34:24', NULL, NULL, '2024-12-12 08:34:24', '2024-12-12 08:34:24');

-- Volcando datos para la tabla flowfer_pelleria.clients: ~38 rows (aproximadamente)
INSERT IGNORE INTO `clients` (`id`, `person_id`, `address`, `type`, `created_at`, `updated_at`) VALUES
	(1, 1, '123 Calle Principal, Ciudad A', 'Regular', '2024-01-10 09:15:00', '2024-01-10 09:15:00'),
	(2, 2, '456 Avenida Central, Ciudad B', 'Premium', '2024-01-11 10:20:00', '2024-01-11 10:20:00'),
	(3, 3, '789 Calle Secundaria, Ciudad C', 'Regular', '2024-01-12 08:05:00', '2024-01-12 08:05:00'),
	(4, 4, '1011 Avenida Norte, Ciudad D', 'VIP', '2024-01-13 13:30:00', '2024-01-13 13:30:00'),
	(5, 5, '1213 Calle Este, Ciudad E', 'Regular', '2024-01-14 14:45:00', '2024-01-14 14:45:00'),
	(6, 6, '1415 Avenida Sur, Ciudad F', 'Premium', '2024-01-15 15:55:00', '2024-01-15 15:55:00'),
	(7, 7, '1617 Calle Oeste, Ciudad G', 'Regular', '2024-01-16 16:10:00', '2024-01-16 16:10:00'),
	(8, 8, '1819 Avenida Central, Ciudad H', 'VIP', '2024-01-17 17:20:00', '2024-01-17 17:20:00'),
	(9, 9, '2021 Calle Principal, Ciudad I', 'Regular', '2024-01-18 18:30:00', '2024-01-18 18:30:00'),
	(10, 10, '2223 Avenida Central, Ciudad J', 'Premium', '2024-01-19 19:40:00', '2024-01-19 19:40:00'),
	(11, 11, '2425 Calle Secundaria, Ciudad K', 'Regular', '2024-01-20 20:50:00', '2024-01-20 20:50:00'),
	(12, 12, '2627 Avenida Norte, Ciudad L', 'VIP', '2024-01-21 21:15:00', '2024-01-21 21:15:00'),
	(13, 13, '2829 Calle Este, Ciudad M', 'Regular', '2024-01-22 07:30:00', '2024-01-22 07:30:00'),
	(14, 14, '3031 Avenida Sur, Ciudad N', 'Premium', '2024-01-23 08:45:00', '2024-01-23 08:45:00'),
	(15, 15, '3233 Calle Oeste, Ciudad O', 'Regular', '2024-01-24 09:55:00', '2024-01-24 09:55:00'),
	(16, 16, '3435 Avenida Central, Ciudad P', 'VIP', '2024-01-25 10:15:00', '2024-01-25 10:15:00'),
	(17, 17, '3637 Calle Principal, Ciudad Q', 'Regular', '2024-01-26 11:25:00', '2024-01-26 11:25:00'),
	(18, 18, '3839 Avenida Central, Ciudad R', 'Premium', '2024-01-27 12:35:00', '2024-01-27 12:35:00'),
	(19, 19, '4041 Calle Secundaria, Ciudad S', 'Regular', '2024-01-28 13:45:00', '2024-01-28 13:45:00'),
	(20, 20, '4243 Avenida Norte, Ciudad T', 'VIP', '2024-01-29 14:55:00', '2024-01-29 14:55:00'),
	(21, 21, '4445 Calle Este, Ciudad U', 'Regular', '2024-01-30 07:05:00', '2024-01-30 07:05:00'),
	(22, 22, '4647 Avenida Sur, Ciudad V', 'Premium', '2024-01-31 08:15:00', '2024-01-31 08:15:00'),
	(23, 23, '4849 Calle Oeste, Ciudad W', 'Regular', '2024-02-01 09:25:00', '2024-02-01 09:25:00'),
	(24, 24, '5051 Avenida Central, Ciudad X', 'VIP', '2024-02-02 10:35:00', '2024-02-02 10:35:00'),
	(25, 25, '5253 Calle Principal, Ciudad Y', 'Regular', '2024-02-03 11:45:00', '2024-02-03 11:45:00'),
	(26, 26, '5455 Avenida Central, Ciudad Z', 'Premium', '2024-02-04 12:55:00', '2024-02-04 12:55:00'),
	(27, 27, '5657 Calle Secundaria, Ciudad AA', 'Regular', '2024-02-05 13:05:00', '2024-02-05 13:05:00'),
	(28, 28, '5859 Avenida Norte, Ciudad BB', 'VIP', '2024-02-06 14:15:00', '2024-02-06 14:15:00'),
	(29, 29, '6061 Calle Este, Ciudad CC', 'Regular', '2024-02-07 15:25:00', '2024-02-07 15:25:00'),
	(30, 30, '6263 Avenida Sur, Ciudad DD', 'Premium', '2024-02-08 16:35:00', '2024-02-08 16:35:00'),
	(31, 31, '6465 Calle Oeste, Ciudad EE', 'Regular', '2024-02-09 17:45:00', '2024-02-09 17:45:00'),
	(32, 32, '6667 Avenida Central, Ciudad FF', 'VIP', '2024-02-10 18:55:00', '2024-02-10 18:55:00'),
	(33, 33, '6869 Calle Principal, Ciudad GG', 'Regular', '2024-02-11 19:05:00', '2024-02-11 19:05:00'),
	(34, 46, NULL, NULL, '2024-11-28 02:38:01', '2024-11-28 02:38:01'),
	(35, 47, NULL, NULL, '2024-11-28 02:43:00', '2024-11-28 02:43:00'),
	(36, 48, NULL, NULL, '2024-11-28 03:21:09', '2024-11-28 03:21:09'),
	(37, 49, NULL, NULL, '2024-11-28 03:33:34', '2024-11-28 03:33:34'),
	(38, 50, NULL, NULL, '2024-11-28 03:39:37', '2024-11-28 03:39:37'),
	(39, 51, NULL, NULL, '2024-11-29 00:37:42', '2024-11-29 00:37:42'),
	(40, 52, NULL, NULL, '2024-11-29 00:45:34', '2024-11-29 00:45:34'),
	(41, 53, NULL, NULL, '2024-11-29 00:50:33', '2024-11-29 00:50:33'),
	(42, 54, NULL, NULL, '2024-12-04 07:08:12', '2024-12-04 07:08:12'),
	(43, 55, NULL, NULL, '2024-12-04 07:08:55', '2024-12-04 07:08:55'),
	(44, 56, NULL, NULL, '2024-12-04 07:10:22', '2024-12-04 07:10:22');

-- Volcando datos para la tabla flowfer_pelleria.combo_item_details: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.cooking_places: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.employees: ~12 rows (aproximadamente)
INSERT IGNORE INTO `employees` (`id`, `person_id`, `address`, `nationality`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Av. Los Pinos 123, Lima', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(2, 2, 'Calle Las Flores 456, Arequipa', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(3, 3, 'Jr. San Martín 789, Cusco', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(4, 45, 'Av. Javier Prado 321, Lima', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(5, 5, 'Calle Las Palmeras 654, Trujillo', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(6, 6, 'Av. Grau 987, Piura', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(7, 7, 'Jr. Bolognesi 432, Chiclayo', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(8, 8, 'Av. Larco 765, Lima', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(9, 9, 'Calle La Merced 876, Puno', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(10, 44, 'Av. Arequipa 1357, Lima', 'Peruana', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(11, 45, 'Tacna', 'Peruano', '2024-11-17 02:20:48', '2024-11-17 02:20:48'),
	(12, 58, 'Tacna', 'Peruano', '2024-12-04 20:50:18', '2024-12-04 20:50:18');

-- Volcando datos para la tabla flowfer_pelleria.failed_jobs: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.identity_document_types: ~2 rows (aproximadamente)
INSERT IGNORE INTO `identity_document_types` (`id`, `name`, `abbreviation`, `digit_length`, `created_at`, `updated_at`) VALUES
	(1, 'documento nacional de identidad', 'dni', 8, '2024-11-08 15:10:25', '2024-11-08 15:10:25'),
	(2, 'registro unico de contribuyente', 'ruc', 11, '2024-11-08 15:10:25', '2024-11-08 15:10:25');

-- Volcando datos para la tabla flowfer_pelleria.inventory_issues: ~2 rows (aproximadamente)
INSERT IGNORE INTO `inventory_issues` (`id`, `outgoing_date`, `reason`, `created_at`, `updated_at`) VALUES
	(1, '2024-12-04', NULL, '2024-12-04 20:56:18', '2024-12-04 20:56:18'),
	(2, '2024-12-04', NULL, '2024-12-04 20:56:54', '2024-12-04 20:56:54');

-- Volcando datos para la tabla flowfer_pelleria.inventory_movement_details: ~7 rows (aproximadamente)
INSERT IGNORE INTO `inventory_movement_details` (`id`, `receipt_id`, `issue_id`, `supply_id`, `price`, `discount`, `quantity`, `total_amount`, `note`, `created_at`, `updated_at`) VALUES
	(1, 6, NULL, 8, 41.41, 49.61, 61, -500.20, 'Amet et et repellat quidem modi nisi vel optio praesentium id facilis.', '2024-11-14 22:46:02', '2024-11-14 22:46:02'),
	(2, 7, NULL, 9, 22.29, 17.17, 62, 317.44, NULL, '2024-11-14 22:46:03', '2024-11-14 22:46:03'),
	(3, 8, NULL, 10, 61.78, 15.16, 65, 3030.30, 'Nemo vero perferendis dicta labore nostrum aliquid aut.', '2024-11-14 22:46:03', '2024-11-14 22:46:03'),
	(4, 9, NULL, 11, 5.88, 33.92, 36, -1009.44, NULL, '2024-11-14 22:46:04', '2024-11-14 22:46:04'),
	(5, 10, NULL, 12, 5.70, 24.65, 67, -1269.65, 'Dolorem porro eos et id rerum est.', '2024-11-14 22:46:04', '2024-11-14 22:46:04'),
	(6, NULL, 1, 3, 0.00, 0.00, 2, 0.00, NULL, '2024-12-04 20:56:18', '2024-12-04 20:56:18'),
	(7, NULL, 2, 2, 0.00, 0.00, 12, 0.00, NULL, '2024-12-04 20:56:54', '2024-12-04 20:56:54'),
	(8, 11, NULL, 2, 2.00, 0.00, 2, 4.00, NULL, '2024-12-16 20:22:36', '2024-12-16 20:22:36'),
	(9, 12, NULL, 3, 3.00, 0.00, 3, 9.00, NULL, '2024-12-16 20:23:56', '2024-12-16 20:23:56');

-- Volcando datos para la tabla flowfer_pelleria.inventory_receipts: ~10 rows (aproximadamente)
INSERT IGNORE INTO `inventory_receipts` (`id`, `voucher_id`, `supplier_id`, `total_amount`, `incoming_date`, `commentary`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 158.15, '1991-09-18', NULL, '2024-11-14 22:43:49', '2024-11-14 22:43:49'),
	(2, 2, 3, 310.34, '1996-03-03', 'Minus ducimus similique asperiores aut odio natus nostrum.', '2024-11-14 22:43:53', '2024-11-14 22:43:53'),
	(3, 3, 4, 278.96, '1978-08-02', 'Aut mollitia voluptatum aliquam voluptatibus dolores.', '2024-11-14 22:43:56', '2024-11-14 22:43:56'),
	(4, 4, 5, 781.93, '1989-11-07', NULL, '2024-11-14 22:44:00', '2024-11-14 22:44:00'),
	(5, 5, 6, 303.72, '2015-11-02', NULL, '2024-11-14 22:44:03', '2024-11-14 22:44:03'),
	(6, 6, 7, 12.56, '2021-06-25', 'Dolor sunt tempore expedita quia nihil dolorum at.', '2024-11-14 22:45:48', '2024-11-14 22:45:48'),
	(7, 7, 8, 922.79, '1992-07-17', NULL, '2024-11-14 22:45:51', '2024-11-14 22:45:51'),
	(8, 8, 9, 595.22, '2012-05-03', NULL, '2024-11-14 22:45:55', '2024-11-14 22:45:55'),
	(9, 9, 10, 904.68, '2014-05-31', NULL, '2024-11-14 22:45:58', '2024-11-14 22:45:58'),
	(10, 10, 11, 579.30, '2004-08-16', 'Non maxime vero quis illum ut.', '2024-11-14 22:46:01', '2024-11-14 22:46:01'),
	(11, 28, 2, 4.00, '2024-12-02', 'awd', '2024-12-16 20:22:36', '2024-12-16 20:22:36'),
	(12, 29, 1, 9.00, '2024-12-16', NULL, '2024-12-16 20:23:56', '2024-12-16 20:23:56');

-- Volcando datos para la tabla flowfer_pelleria.inventory_receipt_details: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.jobs: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.job_batches: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.lounges: ~21 rows (aproximadamente)
INSERT IGNORE INTO `lounges` (`id`, `code`, `name`, `floor`, `address`, `created_at`, `updated_at`) VALUES
	(1, '1245', 'sala 1', 1, 'tacna', '2024-11-08 17:02:20', '2024-11-08 17:02:20'),
	(2, 'B202', 'Lounge VIP', 2, 'Calle Secundaria 456, Arequipa', '2024-11-01 13:30:00', '2024-11-01 16:00:00'),
	(3, 'C303', 'Lounge Ejecutivo', 3, 'Jirón Los Álamos 789, Trujillo', '2024-11-02 14:00:00', '2024-11-02 15:30:00'),
	(4, 'D404', 'Lounge Familiar', 4, 'Av. Primavera 101, Cusco', '2024-11-03 15:00:00', '2024-11-03 17:00:00'),
	(5, 'E505', 'Lounge Estudio', 5, 'Pasaje Las Flores 202, Piura', '2024-11-04 16:00:00', '2024-11-04 18:00:00'),
	(6, 'F606', 'Lounge Relax', 6, 'Av. Sol Naciente 303, Tacna', '2024-11-05 17:00:00', '2024-11-05 19:00:00'),
	(7, 'G707', 'Lounge Café', 7, 'Calle La Paz 404, Iquitos', '2024-11-06 18:00:00', '2024-11-06 20:00:00'),
	(8, 'H808', 'Lounge Ejecutivo Plus', 8, 'Jirón Amazonas 505, Chiclayo', '2024-11-07 19:00:00', '2024-11-07 21:00:00'),
	(9, 'I909', 'Lounge Terraza', 9, 'Av. Libertad 606, Puno', '2024-11-08 20:00:00', '2024-11-08 22:00:00'),
	(10, 'J010', 'Lounge Sunset', 10, 'Pasaje Primavera 707, Huancayo', '2024-11-09 21:00:00', '2024-11-09 23:00:00'),
	(11, 'K011', 'Lounge Nocturno', 11, 'Av. Aurora 808, Tumbes', '2024-11-10 22:00:00', '2024-11-11 00:00:00'),
	(12, 'L012', 'Lounge Galaxy', 12, 'Calle Celeste 909, Juliaca', '2024-11-11 23:00:00', '2024-11-12 01:00:00'),
	(13, 'M013', 'Lounge Andino', 13, 'Jirón Cusqueña 010, Cajamarca', '2024-11-13 00:00:00', '2024-11-13 02:00:00'),
	(14, 'N014', 'Lounge Urbano', 14, 'Av. Modernidad 011, Moquegua', '2024-11-14 01:00:00', '2024-11-14 03:00:00'),
	(15, 'O015', 'Lounge Clásico', 15, 'Pasaje Historia 012, Ayacucho', '2024-11-15 02:00:00', '2024-11-15 04:00:00'),
	(16, 'P016', 'Lounge Vintage', 16, 'Av. Tradición 013, Ica', '2024-11-16 03:00:00', '2024-11-16 04:59:00'),
	(17, 'Q017', 'Lounge Gourmet', 17, 'Calle Sabor 014, Tarapoto', '2024-11-17 04:00:00', '2024-11-29 00:28:50'),
	(18, 'R018', 'Lounge Tropical', 18, 'Jirón Palmas 015, Pucallpa', '2024-11-17 13:00:00', '2024-11-29 00:28:51'),
	(19, 'S019', 'Lounge Aventura', 19, 'Av. Exploradores 016, Madre de Dios', '2024-11-18 14:00:00', '2024-11-18 15:00:00'),
	(20, 'T020', 'Lounge Vista', 20, 'Pasaje Horizonte 017, Amazonas', '2024-11-19 15:00:00', '2024-11-19 16:00:00'),
	(21, 'A101', 'Lounge Principal', 1, 'Av. Principal 123, Lima', '2024-11-01 13:00:00', '2024-11-01 15:00:00');

-- Volcando datos para la tabla flowfer_pelleria.menu_categories: ~30 rows (aproximadamente)
INSERT IGNORE INTO `menu_categories` (`id`, `name`, `display_order`, `created_at`, `updated_at`) VALUES
	(1, 'Entradas', 3, '2024-11-14 09:00:00', '2024-12-02 18:28:17'),
	(2, 'Sopas', 6, '2024-11-14 09:00:00', '2024-12-10 07:48:53'),
	(3, 'Ensaladas', 8, '2024-11-14 09:00:00', '2024-12-10 07:48:53'),
	(4, 'Carnes', 1, '2024-11-14 09:00:00', '2024-12-10 07:48:53'),
	(5, 'Pollos', 4, '2024-11-14 09:00:00', '2024-12-10 07:48:54'),
	(6, 'Mariscos', 5, '2024-11-14 09:00:00', '2024-12-10 07:48:54'),
	(7, 'Pastas', 10, '2024-11-14 09:00:00', '2024-12-02 18:28:17'),
	(8, 'Parrillas', 7, '2024-11-14 09:00:00', '2024-12-10 07:48:54'),
	(9, 'Pescados', 12, '2024-11-14 09:00:00', '2024-12-02 18:28:17'),
	(10, 'Pizzas', 2, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(11, 'Sandwiches', 14, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(12, 'Hamburguesas', 15, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(13, 'Tacos', 16, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(14, 'Bebidas', 9, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(15, 'Jugos', 13, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(16, 'Postres', 17, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(17, 'Comida Peruana', 11, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(18, 'Comida Mexicana', 22, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(19, 'Comida Italiana', 24, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(20, 'Comida China', 26, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(21, 'Comida Japonesa', 27, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(22, 'Salsas', 28, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(23, 'Vinos', 29, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(24, 'Cervezas', 21, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(25, 'Café', 18, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(26, 'Té', 30, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(27, 'Cócteles', 20, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(28, 'Helados', 25, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(29, 'Tapas', 23, '2024-11-14 09:00:00', '2024-12-02 18:28:18'),
	(30, 'Snacks', 19, '2024-11-14 09:00:00', '2024-12-02 18:28:18');

-- Volcando datos para la tabla flowfer_pelleria.menu_items: ~33 rows (aproximadamente)
INSERT IGNORE INTO `menu_items` (`id`, `category_id`, `cooking_place_id`, `name`, `price`, `is_combo`, `display_order`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 'Ensalada César', 12.50, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(2, 1, NULL, 'Tartar de Atún', 15.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(3, 1, NULL, 'Sopa de Lentejas', 10.00, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(4, 1, NULL, 'Sopa Criolla', 9.50, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(5, 1, NULL, 'Ensalada de Quinoa', 13.00, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(6, 1, NULL, 'Ensalada Griega', 14.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(7, 4, NULL, 'Lomo Saltado', 18.00, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(8, 4, NULL, 'Bistec a la Parrilla', 20.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(9, 5, NULL, 'Pollo a la Brasa', 17.50, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(10, 5, NULL, 'Pollo a la Plancha', 16.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(11, 6, NULL, 'Camarones al Ajillo', 22.00, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(12, 6, NULL, 'Piqueo de Mariscos', 24.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(13, 7, NULL, 'Spaghetti a la Boloñesa', 14.50, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(14, 7, NULL, 'Lasagna', 16.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(15, 8, NULL, 'Parrillada Mixta', 25.00, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(16, 8, NULL, 'Costillas a la Parrilla', 28.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(17, 9, NULL, 'Filete de Pescado', 19.50, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(18, 9, NULL, 'Tartar de Salmón', 21.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(19, 10, NULL, 'Pizza Margarita', 14.00, 0, 2, '2024-11-14 09:00:00', '2024-12-02 18:29:13'),
	(20, 10, NULL, 'Pizza Pepperoni', 16.50, 0, 1, '2024-11-14 09:00:00', '2024-12-02 18:29:13'),
	(21, 11, NULL, 'Sandwich de Pollo', 9.50, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(22, 11, NULL, 'Sandwich Vegano', 11.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(23, 12, NULL, 'Hamburguesa Clásica', 13.00, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(24, 12, NULL, 'Hamburguesa BBQ', 14.50, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(25, 13, NULL, 'Tacos al Pastor', 9.00, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(26, 13, NULL, 'Tacos de Carnitas', 10.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(27, 14, NULL, 'Cerveza Artesanal', 5.00, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(28, 14, NULL, 'Cócteles de Frutas', 7.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(29, 15, NULL, 'Jugos Naturales', 4.50, 0, 1, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(30, 15, NULL, 'Limonada', 3.00, 0, 2, '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(31, 1, NULL, 'awdawd', 123.00, 0, 0, '2024-12-04 22:18:32', '2024-12-04 22:18:32'),
	(41, 1, NULL, 'pescado negro', 12.00, 0, 0, '2024-12-07 05:53:40', '2024-12-07 05:53:40'),
	(43, 1, NULL, 'pescado negro2', 12.00, 0, 0, '2024-12-07 05:55:11', '2024-12-07 05:55:11');

-- Volcando datos para la tabla flowfer_pelleria.menu_supply_details: ~7 rows (aproximadamente)
INSERT IGNORE INTO `menu_supply_details` (`id`, `item_id`, `supply_id`, `supply_quantity`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 22, '2024-12-04 22:13:26', '2024-12-04 22:13:26'),
	(2, 31, 3, 23, '2024-12-04 22:18:32', '2024-12-04 22:18:32'),
	(7, 41, 2, 24, '2024-12-07 05:53:40', '2024-12-07 05:53:40'),
	(8, 41, 3, 22, '2024-12-07 05:53:40', '2024-12-07 05:53:40'),
	(9, 41, 4, 22, '2024-12-07 05:53:40', '2024-12-07 05:53:40'),
	(11, 43, 2, 2, '2024-12-07 05:55:11', '2024-12-07 05:55:11'),
	(12, 43, 5, 3, '2024-12-07 05:55:11', '2024-12-07 05:55:11');

-- Volcando datos para la tabla flowfer_pelleria.migrations: ~33 rows (aproximadamente)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_07_20_014600_create_identity_document_types_table', 1),
	(5, '2024_07_21_014600_create_persons_table', 1),
	(6, '2024_07_23_053855_create_employees_table', 1),
	(7, '2024_07_23_225224_create_roles_table', 1),
	(8, '2024_07_23_225508_create_permissions_table', 1),
	(9, '2024_07_23_230106_create_role_permission_table', 1),
	(10, '2024_09_24_200020_create_suppliers_table', 1),
	(11, '2024_09_24_200307_create_brands_table', 1),
	(12, '2024_09_24_200531_create_supplies_table', 1),
	(13, '2024_10_06_020000_create_voucher_types_table', 1),
	(14, '2024_10_06_052900_create_voucher_series_table', 1),
	(15, '2024_10_06_052910_create_payment_methods_table', 1),
	(16, '2024_10_06_053005_create_vouchers_table', 1),
	(17, '2024_10_07_024816_create_inventory_receipts_table', 1),
	(18, '2024_10_08_162054_create_inventory_receipt_details_table', 1),
	(19, '2024_10_08_184534_create_lounges_table', 1),
	(20, '2024_10_08_184544_create_tables_table', 1),
	(21, '2024_10_16_000018_create_menu_categories_table', 1),
	(22, '2024_10_16_000834_create_menu_items_table', 1),
	(23, '2024_10_21_033754_supplier_supply', 1),
	(24, '2024_10_21_155638_create_combo_item_details', 1),
	(25, '2024_10_27_060713_create_menu_supply_details', 1),
	(26, '2024_10_29_171843_create_cooking_places_table', 1),
	(27, '2024_10_29_172312_add_foreign_key_cooking_place_in_tables', 1),
	(28, '2024_10_29_172959_create_cashier_sessions_table', 1),
	(29, '2024_10_29_191431_create_clients_table', 1),
	(30, '2024_10_30_174423_create_orders_table', 1),
	(31, '2024_10_30_183446_create_order_details_table', 1),
	(32, '2024_10_08_162055_create_inventory_movement_details_table', 2),
	(33, '2024_11_08_163958_create_inventory_issues_table', 2),
	(34, '2024_11_28_073735_create_voucher_payment_details_table', 3),
	(35, '2024_12_12_022203_add_new_columns_to_your_table', 3);

-- Volcando datos para la tabla flowfer_pelleria.orders: ~11 rows (aproximadamente)
INSERT IGNORE INTO `orders` (`id`, `client_id`, `table_id`, `cashier_session_id`, `waiter_id`, `voucher_id`, `total_amount`, `status`, `is_delibery`, `commentary`, `created_at`, `updated_at`) VALUES
	(6, NULL, 637, 1, 1, NULL, NULL, 'pendiente', 0, 'Hola parse', '2024-11-25 04:46:20', '2024-11-25 04:46:20'),
	(7, NULL, 629, 1, 1, NULL, NULL, 'pendiente', 0, 'pollito con papa y salsa de picabnte', '2024-11-25 13:58:12', '2024-11-25 13:58:12'),
	(8, NULL, 630, 1, 1, NULL, 80.00, 'pendiente', 0, 'ya pe causa un par de chorisos', '2024-11-29 04:51:55', '2024-11-29 04:51:55'),
	(9, NULL, 632, 1, 1, NULL, NULL, 'pendiente', 0, 'Estofado de pollo con arros plis para la mesa especial', '2024-12-03 02:40:52', '2024-12-03 02:40:52'),
	(10, NULL, 631, 1, 1, NULL, NULL, 'pendiente', 0, '', '2024-12-08 05:50:53', '2024-12-08 05:50:53'),
	(11, NULL, 648, 1, 1, NULL, NULL, 'pendiente', 0, '', '2024-12-08 06:19:35', '2024-12-08 06:19:35'),
	(12, NULL, 640, 1, 1, NULL, NULL, 'pendiente', 0, '', '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(13, NULL, 641, 1, 1, NULL, NULL, 'pendiente', 0, '', '2024-12-08 06:20:45', '2024-12-08 06:20:45'),
	(14, NULL, 661, 1, 1, NULL, NULL, 'pendiente', 0, '', '2024-12-08 22:05:35', '2024-12-08 22:05:35'),
	(15, NULL, 671, 1, 1, NULL, NULL, 'pendiente', 0, '', '2024-12-10 07:50:10', '2024-12-10 07:50:10'),
	(16, NULL, 638, 1, 1, NULL, NULL, 'pendiente', 0, '', '2024-12-10 07:52:09', '2024-12-10 07:52:09');

-- Volcando datos para la tabla flowfer_pelleria.order_details: ~41 rows (aproximadamente)
INSERT IGNORE INTO `order_details` (`id`, `order_id`, `menu_item_id`, `price`, `quantity`, `total_amount`, `status`, `is_delibery`, `note`, `created_at`, `updated_at`) VALUES
	(1, 6, 1, 12.50, 1, 12.50, 'pendiente', 0, NULL, '2024-11-25 04:46:21', '2024-11-25 04:46:21'),
	(2, 6, 3, 10.00, 1, 10.00, 'pendiente', 1, 'awd', '2024-11-25 04:46:21', '2024-11-25 04:46:21'),
	(3, 6, 4, 9.50, 1, 9.50, 'pendiente', 1, 'awd', '2024-11-25 04:46:22', '2024-11-25 04:46:22'),
	(4, 6, 5, 13.00, 1, 13.00, 'pendiente', 0, 'awd', '2024-11-25 04:46:22', '2024-11-25 04:46:22'),
	(5, 6, 6, 14.00, 12, 168.00, 'pendiente', 0, 'awd', '2024-11-25 04:46:22', '2024-11-25 04:46:22'),
	(6, 6, 6, 14.00, 1, 14.00, 'pendiente', 1, 'awd4', '2024-11-25 04:46:23', '2024-11-25 04:46:23'),
	(7, 7, 1, 12.50, 1, 12.50, 'pendiente', 1, 'awd', '2024-11-25 13:58:12', '2024-11-25 13:58:12'),
	(8, 7, 5, 13.00, 12, 156.00, 'pendiente', 0, 'awd', '2024-11-25 13:58:13', '2024-11-25 13:58:13'),
	(9, 8, 1, 12.50, 1, 12.50, 'pendiente', 1, NULL, '2024-11-29 04:51:55', '2024-11-29 04:51:55'),
	(10, 8, 2, 15.00, 1, 15.00, 'pendiente', 1, NULL, '2024-11-29 04:51:55', '2024-11-29 04:51:55'),
	(11, 8, 2, 15.00, 1, 15.00, 'pendiente', 0, NULL, '2024-11-29 04:51:55', '2024-11-29 04:51:55'),
	(12, 9, 19, 14.00, 1, 14.00, 'pendiente', 0, NULL, '2024-12-03 02:40:52', '2024-12-03 02:40:52'),
	(13, 9, 20, 16.50, 1, 16.50, 'pendiente', 0, NULL, '2024-12-03 02:40:52', '2024-12-03 02:40:52'),
	(14, 10, 9, 17.50, 1, 17.50, 'pendiente', 0, NULL, '2024-12-08 05:50:53', '2024-12-08 05:50:53'),
	(15, 10, 10, 16.00, 1, 16.00, 'pendiente', 0, NULL, '2024-12-08 05:50:53', '2024-12-08 05:50:53'),
	(16, 11, 19, 14.00, 1, 14.00, 'pendiente', 0, NULL, '2024-12-08 06:19:35', '2024-12-08 06:19:35'),
	(17, 12, 9, 17.50, 1, 17.50, 'pendiente', 0, NULL, '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(18, 12, 10, 16.00, 1, 16.00, 'pendiente', 0, NULL, '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(19, 12, 19, 14.00, 1, 14.00, 'pendiente', 0, NULL, '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(20, 12, 20, 16.50, 1, 16.50, 'pendiente', 0, NULL, '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(21, 12, 1, 12.50, 1, 12.50, 'pendiente', 0, NULL, '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(22, 12, 2, 15.00, 1, 15.00, 'pendiente', 0, NULL, '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(23, 12, 3, 10.00, 1, 10.00, 'pendiente', 0, NULL, '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(24, 12, 4, 9.50, 1, 9.50, 'pendiente', 0, NULL, '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(25, 12, 43, 12.00, 1, 12.00, 'pendiente', 0, NULL, '2024-12-08 06:19:56', '2024-12-08 06:19:56'),
	(26, 13, 10, 16.00, 1, 16.00, 'pendiente', 0, NULL, '2024-12-08 06:20:45', '2024-12-08 06:20:45'),
	(27, 13, 9, 17.50, 1, 17.50, 'pendiente', 0, NULL, '2024-12-08 06:20:45', '2024-12-08 06:20:45'),
	(28, 13, 2, 15.00, 5, 75.00, 'pendiente', 0, NULL, '2024-12-08 06:20:45', '2024-12-08 06:20:45'),
	(29, 13, 1, 12.50, 4, 50.00, 'pendiente', 0, NULL, '2024-12-08 06:20:45', '2024-12-08 06:20:45'),
	(30, 13, 5, 13.00, 1, 13.00, 'pendiente', 0, NULL, '2024-12-08 06:20:45', '2024-12-08 06:20:45'),
	(31, 13, 31, 123.00, 1, 123.00, 'pendiente', 0, NULL, '2024-12-08 06:20:45', '2024-12-08 06:20:45'),
	(32, 13, 6, 14.00, 1, 14.00, 'pendiente', 0, NULL, '2024-12-08 06:20:45', '2024-12-08 06:20:45'),
	(33, 14, 10, 16.00, 2, 32.00, 'pendiente', 0, NULL, '2024-12-08 22:05:35', '2024-12-08 22:05:35'),
	(34, 14, 9, 17.50, 5, 87.50, 'pendiente', 1, NULL, '2024-12-08 22:05:35', '2024-12-08 22:05:35'),
	(35, 14, 10, 16.00, 1, 16.00, 'pendiente', 1, NULL, '2024-12-08 22:05:35', '2024-12-08 22:05:35'),
	(36, 14, 10, 16.00, 1, 16.00, 'pendiente', 0, 'si ensalada', '2024-12-08 22:05:35', '2024-12-08 22:05:35'),
	(37, 14, 10, 16.00, 1, 16.00, 'pendiente', 0, 'awd', '2024-12-08 22:05:35', '2024-12-08 22:05:35'),
	(38, 15, 7, 18.00, 1, 18.00, 'pendiente', 0, NULL, '2024-12-10 07:50:10', '2024-12-10 07:50:10'),
	(39, 15, 8, 20.00, 1, 20.00, 'pendiente', 0, NULL, '2024-12-10 07:50:10', '2024-12-10 07:50:10'),
	(40, 16, 20, 16.50, 4, 66.00, 'pendiente', 1, NULL, '2024-12-10 07:52:09', '2024-12-10 07:52:09'),
	(41, 16, 7, 18.00, 1, 18.00, 'pendiente', 0, NULL, '2024-12-10 07:52:09', '2024-12-10 07:52:09');

-- Volcando datos para la tabla flowfer_pelleria.payment_methods: ~5 rows (aproximadamente)
INSERT IGNORE INTO `payment_methods` (`id`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
	(1, 'efectivo', 'efectivo', '2024-11-08 15:10:27', '2024-11-08 15:10:27'),
	(2, 'tarjeta de debito', 'debito', '2024-11-08 15:10:27', '2024-11-08 15:10:27'),
	(3, 'tarjeta de credito', 'credito', '2024-11-08 15:10:28', '2024-11-08 15:10:28'),
	(4, 'yape', 'yape', '2024-11-08 15:10:28', '2024-11-08 15:10:28'),
	(5, 'plin', 'plin', '2024-11-08 15:10:29', '2024-11-08 15:10:29');

-- Volcando datos para la tabla flowfer_pelleria.permissions: ~8 rows (aproximadamente)
INSERT IGNORE INTO `permissions` (`id`, `lounge_id`, `name`, `category`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Permisos de Administrador', 'administrador', '2024-12-16 14:07:59', '2024-12-16 14:07:59'),
	(2, NULL, 'Gestión de usuarios', 'administrador', '2024-12-16 14:07:59', '2024-12-16 14:07:59'),
	(3, NULL, 'Acciones', 'cocina', '2024-12-16 14:07:59', '2024-12-16 14:07:59'),
	(4, NULL, 'Panel de cosina', 'cocina', '2024-12-16 14:07:59', '2024-12-16 14:07:59'),
	(5, NULL, 'Atención de mesas', 'mozo', '2024-12-16 14:07:59', '2024-12-16 14:07:59'),
	(6, NULL, 'Registro de pedidos', 'mozo', '2024-12-16 14:07:59', '2024-12-16 14:07:59'),
	(7, NULL, 'Apertura y cierre de caja', 'caja', '2024-12-16 14:07:59', '2024-12-16 14:07:59'),
	(8, NULL, 'Administrador de ordenes', 'caja', '2024-12-16 14:07:59', '2024-12-16 14:07:59');

-- Volcando datos para la tabla flowfer_pelleria.persons: ~58 rows (aproximadamente)
INSERT IGNORE INTO `persons` (`id`, `document_type_id`, `document_number`, `name`, `lastname`, `company_name`, `birthdate`, `gender`, `phone`, `email`, `created_at`, `updated_at`) VALUES
	(0, 2, '00000000000', 'anonimo', 'anonimo', 'anonimo', '2024-12-03', 0, NULL, NULL, '2024-12-04 03:32:25', '2024-12-04 03:32:24'),
	(1, 2, '20123456789', 'pedorne', NULL, 'Servicios Integrales SAC', NULL, NULL, '123456789', 'contacto@serviciosintegrales.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(2, 1, '67890123', 'Felipe', 'Zapata', NULL, '1988-11-22', 1, '912345678', 'felipe.zapata@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(3, 2, '20456789012', 'dirgo', NULL, 'Logística Global EIRL', NULL, NULL, '987654123', 'contacto@logisticaglobal.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(4, 1, '56789012', 'Ana', 'Torres', NULL, '2000-10-30', 0, '932165478', 'ana.torres@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(5, 1, '45678901', 'Roberto', 'Mejia', NULL, '1995-07-25', 1, '954321987', 'roberto.mejia@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(6, 2, '20987654321', 'perla', NULL, 'Comercial Industrial S.A.', NULL, NULL, '876543210', 'info@comercialindsa.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(7, 1, '34567890', 'Lucia', 'Ramirez Peres', NULL, '1978-03-20', 0, '987123456', 'lucia.ramirez@example.com', '2024-11-14 09:00:00', '2024-11-17 02:55:24'),
	(8, 1, '71571704', 'diego', NULL, NULL, NULL, NULL, '921302376', NULL, '2024-11-08 15:11:37', '2024-11-08 15:11:37'),
	(9, 1, '12345678', 'Carlos', 'Gonzales', NULL, '1985-04-10', 1, '987654321', 'carlos.gonzales@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(10, 1, '87654321', 'María', 'Lopez', NULL, '1990-08-15', 0, '965432187', 'maria.lopez@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(11, 1, '23456789', 'Juan', 'Perez', NULL, '1982-12-01', 1, '954321876', 'juan.perez@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(12, 1, '77665544', 'Luis', 'Salas', NULL, '1987-03-18', 1, '954321888', 'luis.salas@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(13, 2, '20445566777', 'dora', NULL, 'Construcciones Modernas SAC', NULL, NULL, '987654322', 'contacto@construccionesmodernas.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(14, 1, '88990011', 'Andrea', 'Mendoza', NULL, '1995-09-10', 0, '987654123', 'andrea.mendoza@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(15, 1, '22334455', 'Sofia', 'Lopez', NULL, '1983-11-23', 0, '911223344', 'sofia.lopez@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(16, 2, '20123455678', 'dorana', NULL, 'Grupo Automotriz S.A.', NULL, NULL, '987654432', 'ventas@grupoautomotriz.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(17, 1, '44332211', 'Miguel', 'Castro', NULL, '1991-06-17', 1, '931112233', 'miguel.castro@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(18, 2, '20223344556', 'matias', NULL, 'Inversiones Generales SAC', NULL, NULL, '976543210', 'info@inversionesgenerales.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(19, 1, '55667788', 'Ana', 'Marquez', NULL, '1999-07-24', 0, '987654567', 'ana.marquez@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(20, 1, '11223344', 'Mario', 'Noriega', NULL, '1975-02-12', 1, '954321654', 'mario.noriega@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(21, 2, '20334455677', 'luis', NULL, 'Consultoría Empresarial EIRL', NULL, NULL, '987456123', 'contacto@consultoriaeirl.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(22, 1, '77889900', 'Juliana', 'Guzmán', NULL, '1982-01-30', 0, '987111234', 'juliana.guzman@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(23, 2, '20556677888', 'ricardo', NULL, 'Tech Solutions S.A.', NULL, NULL, '975432189', 'support@techsolutions.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(24, 1, '33221100', 'Fernando', 'Quispe', NULL, '1989-05-20', 1, '921234567', 'fernando.quispe@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(25, 1, '66778899', 'Raul', 'Cornejo', NULL, '1986-10-05', 1, '987654765', 'raul.cornejo@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(26, 2, '20446677889', 'pedro', NULL, 'Servicios de Transporte S.A.C.', NULL, NULL, '987654333', 'transporte@transporte.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(27, 1, '99887766', 'Carmen', 'Valdez', NULL, '1997-08-11', 0, '931234876', 'carmen.valdez@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(28, 1, '11221122', 'Ernesto', 'Cabrera', NULL, '1983-03-17', 1, '945321876', 'ernesto.cabrera@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(29, 2, '20778899001', 'pablo', NULL, 'Servicios Integrales y Logística SAC', NULL, NULL, '987654789', 'logistica@serviciosintegrales.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(30, 1, '33445577', 'Olga', 'Palacios', NULL, '1990-02-21', 0, '923456789', 'olga.palacios@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(31, 1, '44556677', 'Rafael', 'Suarez', NULL, '1978-09-14', 1, '987654111', 'rafael.suarez@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(32, 1, '77554433', 'Lorena', 'Diaz', NULL, '1994-04-15', 0, '987655432', 'lorena.diaz@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(33, 2, '20677889901', 'diego', NULL, 'Distribuidora Nacional SAC', NULL, NULL, '954567890', 'contacto@distribuidoranacional.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(34, 1, '33445566', 'Jose', 'Rios', NULL, '1992-05-14', 1, '987123450', 'jose.rios@example.com', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(35, 1, '49047820', 'Mozell', 'Rath', NULL, '2006-07-09', 0, '8078435636', 'torphy.noelia@example.org', '2024-11-14 22:43:49', '2024-11-14 22:43:49'),
	(36, 1, '12948200', 'Gregoria', 'Stoltenberg', NULL, '1981-02-08', 1, '7627310702', 'sydney64@example.org', '2024-11-14 22:43:52', '2024-11-14 22:43:52'),
	(37, 1, '05979486', 'Renee', 'Kshlerin', NULL, '1983-07-30', 0, '9914297098', 'khalil17@example.org', '2024-11-14 22:43:56', '2024-11-14 22:43:56'),
	(38, 1, '23920049', 'Seamus', 'Rowe', NULL, '2011-08-25', 1, '2340676725', 'erwin01@example.net', '2024-11-14 22:43:59', '2024-11-14 22:43:59'),
	(39, 1, '85748467', 'Destany', 'Gutmann', NULL, '1981-04-13', 1, '2397661132', 'brandyn.mccullough@example.org', '2024-11-14 22:44:02', '2024-11-14 22:44:02'),
	(40, 1, '97400958', 'Kellen', 'Daniel', NULL, '1971-01-28', 0, '8014160746', 'schuyler61@example.org', '2024-11-14 22:45:47', '2024-11-14 22:45:47'),
	(41, 1, '48322932', 'Rogelio', 'Boyer', NULL, '1994-06-14', 1, '1807276448', 'karina.kautzer@example.com', '2024-11-14 22:45:50', '2024-11-14 22:45:50'),
	(42, 1, '03059641', 'Jerrold', 'Walter', NULL, '1982-03-04', 1, '5410973033', 'amiya.ondricka@example.net', '2024-11-14 22:45:54', '2024-11-14 22:45:54'),
	(43, 1, '59474181', 'Johanna', 'Kulas', NULL, '1995-02-27', 0, '3504125851', 'serena01@example.net', '2024-11-14 22:45:57', '2024-11-14 22:45:57'),
	(44, 1, '25663098', 'Connor', 'Schmeler Peres', NULL, '1971-03-11', 1, '6715002886', 'alexandre.okeefe@example.org', '2024-11-14 22:46:01', '2024-11-14 22:46:01'),
	(45, 1, '71571705', 'Karen', 'QUISPE APAZA', NULL, '2024-11-27', 1, '980078259', 'jorge@gmail.com', '2024-11-17 02:20:48', '2024-11-17 02:50:30'),
	(46, 1, '24356709', 'pere', 'pollo rico', NULL, NULL, 0, NULL, NULL, '2024-11-28 02:38:01', '2024-11-28 02:38:01'),
	(47, 1, '24346579', 'Roique', 'Limache Peres', NULL, '2024-11-30', 0, '921302377', 'jorge@gmail.com', '2024-11-28 02:43:00', '2024-11-28 02:43:00'),
	(48, 2, '24234235635', 'rth', NULL, NULL, NULL, 0, NULL, NULL, '2024-11-28 03:21:09', '2024-11-28 03:21:09'),
	(49, 2, '78637878578', 'esfgsefs', NULL, NULL, NULL, 0, NULL, NULL, '2024-11-28 03:33:34', '2024-11-28 03:33:34'),
	(50, 2, '12424654546', 'jose peres el rico', NULL, NULL, NULL, 0, NULL, NULL, '2024-11-28 03:39:37', '2024-11-28 03:39:37'),
	(51, 1, '71571708', 'JOSEPH JAHIR', 'CUTIPA TICONA', NULL, NULL, 0, NULL, NULL, '2024-11-29 00:37:42', '2024-11-29 00:37:42'),
	(52, NULL, '71571709', 'MARIBEL THANIA', 'CALIZAYA CONDORI', NULL, NULL, 0, NULL, NULL, '2024-11-29 00:45:34', '2024-11-29 00:45:34'),
	(53, NULL, '71571701', 'BRIGIDA', 'LUPACA NIETO', NULL, NULL, 0, NULL, NULL, '2024-11-29 00:50:33', '2024-11-29 00:50:33'),
	(54, NULL, '00000000004', 'pollo peep', 'negro', NULL, NULL, 0, NULL, NULL, '2024-12-04 07:08:12', '2024-12-04 07:08:12'),
	(55, NULL, '00000000001', 'pollo peep', 'negro', NULL, NULL, 0, NULL, NULL, '2024-12-04 07:08:54', '2024-12-04 07:08:54'),
	(56, NULL, '00000000003', 'pollo peep', NULL, NULL, NULL, 0, NULL, NULL, '2024-12-04 07:10:22', '2024-12-04 07:10:22'),
	(58, NULL, '23876357', 'diego', '12wd 123awd', NULL, '2024-12-20', 0, '987564321', 'jorge@gmail.com', '2024-12-04 20:50:18', '2024-12-04 20:50:18');

-- Volcando datos para la tabla flowfer_pelleria.roles: ~5 rows (aproximadamente)
INSERT IGNORE INTO `roles` (`id`, `cooking_place_id`, `name`, `created_at`, `updated_at`) VALUES
	(15, NULL, 'Area cocina', '2024-12-16 19:11:36', '2024-12-16 19:11:36'),
	(16, NULL, 'Area mozo', '2024-12-16 19:12:00', '2024-12-16 19:12:00'),
	(17, NULL, 'Area caja', '2024-12-16 19:12:13', '2024-12-16 19:12:28'),
	(18, NULL, 'Sub Administrador', '2024-12-16 19:12:54', '2024-12-16 19:12:54'),
	(19, NULL, 'Administrador', '2024-12-16 19:13:14', '2024-12-16 19:13:14');

-- Volcando datos para la tabla flowfer_pelleria.role_permission: ~16 rows (aproximadamente)
INSERT IGNORE INTO `role_permission` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
	(83, 15, 3, NULL, NULL),
	(84, 15, 4, NULL, NULL),
	(85, 16, 5, NULL, NULL),
	(86, 16, 6, NULL, NULL),
	(87, 17, 7, NULL, NULL),
	(88, 17, 8, NULL, NULL),
	(89, 18, 1, NULL, NULL),
	(90, 18, 2, NULL, NULL),
	(91, 19, 1, NULL, NULL),
	(92, 19, 2, NULL, NULL),
	(93, 19, 3, NULL, NULL),
	(94, 19, 4, NULL, NULL),
	(95, 19, 5, NULL, NULL),
	(96, 19, 6, NULL, NULL),
	(97, 19, 7, NULL, NULL),
	(98, 19, 8, NULL, NULL);

-- Volcando datos para la tabla flowfer_pelleria.sessions: ~2 rows (aproximadamente)
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('nAX65yC2ZB3c9qBi4fFMHWeg9nCk0Wh6tPm3PkBG', 34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYUd5SWE0UmJYZ0pPdXRsajFNTktFT1BOdGdhOUNXcldjWlZORG5DeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzQ7fQ==', 1734359478),
	('zLiFyQ9WEeZICv3kV2TepXOZBwsfBG11nN9Wi1TB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWUFyNnRqSmVwY0ZteW11cVJ0enhPUHNDckljR3ZUbno0VUR6MUNqTSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xpdCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjcxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYW5jaG9yX3N1cHBseV9wcm92aWRlcj9zdXBwbGllcklkPW51bGwmc3VwcGx5SWQ9MyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1734362771);

-- Volcando datos para la tabla flowfer_pelleria.suppliers: ~11 rows (aproximadamente)
INSERT IGNORE INTO `suppliers` (`id`, `person_id`, `address`, `created_at`, `updated_at`) VALUES
	(1, 8, NULL, '2024-11-08 15:11:38', '2024-11-08 15:11:38'),
	(2, 35, '7817 Wiza Courts Apt. 231\nShanonborough, ND 34163', '2024-11-14 22:43:49', '2024-11-14 22:43:49'),
	(3, 36, '121 Runolfsdottir Radial Apt. 324\nStaceyburgh, MN 20781-2572', '2024-11-14 22:43:52', '2024-11-14 22:43:52'),
	(4, 37, '9540 Hyatt Knolls Apt. 578\nLake Nilsburgh, IA 77661-3240', '2024-11-14 22:43:56', '2024-11-14 22:43:56'),
	(5, 38, '78410 Halvorson Radial Apt. 360\nRunteburgh, IN 86734-7879', '2024-11-14 22:43:59', '2024-11-14 22:43:59'),
	(6, 39, '38769 Corwin Lock\nPort Adrain, GA 48755-8410', '2024-11-14 22:44:03', '2024-11-14 22:44:03'),
	(7, 40, '193 Danika Forges\nRonhaven, NM 10844-7072', '2024-11-14 22:45:48', '2024-11-14 22:45:48'),
	(8, 41, '15062 Maggio Prairie\nNew Jimmiehaven, OK 97934', '2024-11-14 22:45:51', '2024-11-14 22:45:51'),
	(9, 42, '594 Alyce Course\nFeestbury, ME 24212', '2024-11-14 22:45:54', '2024-11-14 22:45:54'),
	(10, 43, '13939 Diamond Ridges Suite 649\nKonopelskichester, NC 71102', '2024-11-14 22:45:58', '2024-11-14 22:45:58'),
	(11, 44, '6221 Rebekah Forge\nMicheleville, AZ 98665', '2024-11-14 22:46:01', '2024-11-14 22:46:01');

-- Volcando datos para la tabla flowfer_pelleria.supplier_supply: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.supplies: ~11 rows (aproximadamente)
INSERT IGNORE INTO `supplies` (`id`, `brand_id`, `code`, `name`, `is_stockable`, `stock`, `unit`, `note`, `created_at`, `updated_at`) VALUES
	(2, NULL, NULL, 'Inca Kola', 1, 0, 'l', NULL, '2024-11-08 15:34:31', '2024-12-04 21:16:54'),
	(3, 1, '98125333', 'Jugo', 1, 90, 'cja', 'Nam neque quod enim aspernatur qui est fugiat neque. Velit numquam est beatae. Quis corrupti recusandae ad cupiditate. Praesentium nihil repellat officia et iusto tenetur placeat et.', '2024-11-14 22:43:50', '2024-11-14 22:43:50'),
	(4, 2, '48918589', 'Pollo', 1, 61, 'und', 'Saepe corporis reiciendis esse et modi omnis. Omnis iusto similique accusamus est. Rerum molestiae ipsa repellat assumenda consequatur hic. Explicabo nulla et sit ea fuga eum.', '2024-11-14 22:43:54', '2024-11-14 22:43:54'),
	(5, 3, '25713299', 'Papas', 0, 28, 'cja', 'Incidunt quasi quia provident quia magnam blanditiis. Doloremque velit aspernatur enim officia quis voluptatibus. Unde vel dolore vel amet minus similique perspiciatis. Accusamus ut ipsum illum est praesentium.', '2024-11-14 22:43:57', '2024-11-14 22:43:57'),
	(6, 4, '48839792', 'Pimienta', 0, 73, 'cja', 'Laudantium pariatur minima aut necessitatibus. Est excepturi esse minima suscipit ut. Repellendus odio id voluptas animi voluptas. Saepe eos asperiores ratione ullam est aspernatur consequatur.', '2024-11-14 22:44:01', '2024-11-14 22:44:01'),
	(7, 5, '61488854', 'Comino', 0, 30, 'cja', 'Voluptas qui cumque voluptas iure quas. Illum iure dolor ut magnam dignissimos iste aut. Hic ullam dolorem enim neque. Eaque praesentium aut porro doloremque.', '2024-11-14 22:44:04', '2024-11-14 22:44:04'),
	(8, 6, '06916671', 'Aji', 1, 66, 'und', 'Tempore possimus cumque ut deserunt deserunt dolores perspiciatis. Consequatur ut voluptatum sit cumque sit. Voluptatem laborum illo molestiae sit temporibus quia. Nesciunt similique accusantium ex molestias sed amet magni.', '2024-11-14 22:45:49', '2024-11-14 22:45:49'),
	(9, 7, '68630447', 'Mostasa', 1, 87, 'und', 'Sed culpa atque laboriosam aliquid. Aliquam dolorum voluptatibus laudantium eum quasi eum. Et optio officiis iusto excepturi sit.', '2024-11-14 22:45:52', '2024-11-14 22:45:52'),
	(10, 8, '59518198', 'Camote', 1, 37, 'bls', 'Voluptates repellendus harum et commodi. Tempora voluptatem eligendi odit enim. Occaecati pariatur blanditiis nostrum tempora. Odit facere et quia earum. Voluptatem odit quae et voluptas. Ad sapiente mollitia praesentium laborum.', '2024-11-14 22:45:55', '2024-11-14 22:45:55'),
	(11, 9, '32832358', 'Repollo', 1, 79, 'und', 'Ullam sit molestias suscipit eveniet eius rerum eaque. Architecto voluptas fuga quo quia in quidem ut. Vel qui sunt sit eius quia. Voluptatem fugiat temporibus id distinctio. Ea pariatur et rerum suscipit laudantium.', '2024-11-14 22:45:59', '2024-11-14 22:45:59'),
	(12, 10, '75154530', 'Coca Cola', 0, 55, 'lt', 'Nobis laudantium ducimus sint voluptatem autem. Doloremque expedita exercitationem assumenda. Cumque quo aspernatur veniam soluta ab corrupti. Mollitia unde voluptatem exercitationem pariatur nam.', '2024-11-14 22:46:02', '2024-11-14 22:46:02');

-- Volcando datos para la tabla flowfer_pelleria.tables: ~33 rows (aproximadamente)
INSERT IGNORE INTO `tables` (`id`, `lounge_id`, `code`, `status`, `created_at`, `updated_at`) VALUES
	(629, 1, '1', 1, '2024-11-19 19:32:28', '2024-11-25 13:58:13'),
	(630, 1, '2', 1, '2024-11-19 19:32:28', '2024-11-29 04:51:55'),
	(631, 1, '3', 1, '2024-11-19 19:32:28', '2024-12-08 05:50:53'),
	(632, 1, '4', 1, '2024-11-19 19:32:28', '2024-12-03 02:40:52'),
	(633, 1, '5', 0, '2024-11-19 19:32:28', '2024-11-19 19:32:28'),
	(634, 1, '6', 0, '2024-11-19 19:32:28', '2024-11-19 19:32:28'),
	(635, 1, '7', 0, '2024-11-19 19:32:28', '2024-11-19 19:32:28'),
	(636, 1, '8', 0, '2024-11-19 19:32:28', '2024-11-19 19:32:28'),
	(637, 1, '9', 1, '2024-11-19 19:32:28', '2024-11-25 04:46:23'),
	(638, 1, '10', 1, '2024-11-19 19:32:28', '2024-12-10 07:52:09'),
	(639, 2, '1', 0, '2024-12-08 05:52:03', '2024-12-08 05:52:03'),
	(640, 2, '2', 1, '2024-12-08 05:52:03', '2024-12-08 06:19:56'),
	(641, 2, '3', 1, '2024-12-08 05:52:03', '2024-12-08 06:20:45'),
	(642, 2, '4', 0, '2024-12-08 05:52:03', '2024-12-08 05:52:03'),
	(643, 2, '5', 0, '2024-12-08 05:52:03', '2024-12-08 05:52:03'),
	(644, 2, '6', 0, '2024-12-08 05:52:03', '2024-12-08 05:52:03'),
	(645, 2, '7', 0, '2024-12-08 05:52:03', '2024-12-08 05:52:03'),
	(646, 2, '8', 0, '2024-12-08 05:52:03', '2024-12-08 05:52:03'),
	(647, 2, '9', 0, '2024-12-08 05:52:03', '2024-12-08 05:52:03'),
	(648, 2, '10', 1, '2024-12-08 05:52:03', '2024-12-08 06:19:35'),
	(659, 1, '11', 0, '2024-12-08 06:00:38', '2024-12-08 06:00:38'),
	(660, 1, '12', 0, '2024-12-08 06:00:38', '2024-12-08 06:00:38'),
	(661, 1, '13', 1, '2024-12-08 06:01:22', '2024-12-08 22:05:35'),
	(662, 2, '11', 0, '2024-12-10 07:49:34', '2024-12-10 07:49:34'),
	(663, 2, '12', 0, '2024-12-10 07:49:34', '2024-12-10 07:49:34'),
	(664, 2, '13', 0, '2024-12-10 07:49:34', '2024-12-10 07:49:34'),
	(665, 2, '14', 0, '2024-12-10 07:49:34', '2024-12-10 07:49:34'),
	(666, 2, '15', 0, '2024-12-10 07:49:34', '2024-12-10 07:49:34'),
	(667, 2, '16', 0, '2024-12-10 07:49:34', '2024-12-10 07:49:34'),
	(668, 2, '17', 0, '2024-12-10 07:49:34', '2024-12-10 07:49:34'),
	(669, 2, '18', 0, '2024-12-10 07:49:34', '2024-12-10 07:49:34'),
	(670, 2, '19', 0, '2024-12-10 07:49:34', '2024-12-10 07:49:34'),
	(671, 2, '20', 1, '2024-12-10 07:49:34', '2024-12-10 07:50:10');

-- Volcando datos para la tabla flowfer_pelleria.users: ~3 rows (aproximadamente)
INSERT IGNORE INTO `users` (`id`, `role_id`, `employee_id`, `username`, `password`, `commentary`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, NULL, 1, 'demo', '$2y$12$uvdy2vm9J5bhp.jpfCkJA.dAGbtr7ieJIMMtsUQ8lssBT625sSB0G', NULL, NULL, '2024-11-08 14:35:24', '2024-11-08 14:35:24'),
	(2, NULL, 1, 'carlosg', 'password123', 'Usuario de ventas', 'abc123xyz', '2024-11-14 09:00:00', '2024-11-14 09:00:00'),
	(34, 16, 12, 'mozo', '$2y$12$2JAoFOxFn7DV.KnhKHVhoOaAFL7c0bxc.N3OGN3SSrZBFBzQ1Lfk.', NULL, NULL, '2024-12-16 19:15:54', '2024-12-16 19:15:54');

-- Volcando datos para la tabla flowfer_pelleria.vouchers: ~12 rows (aproximadamente)
INSERT IGNORE INTO `vouchers` (`id`, `voucher_serie_id`, `correlative_number`, `issuance_date`, `expiration_date`, `total_amount`, `payment_type`, `payment_method_id`, `commentary`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, '1970-02-23', '1993-02-27', 893.95, 'credito', 2, 'Est ex hic ut tempore magni.', '2024-11-14 22:43:47', '2024-11-14 22:43:47'),
	(2, 2, 2, '2002-09-08', '2008-08-24', 556.84, 'contado', 2, NULL, '2024-11-14 22:43:51', '2024-11-14 22:43:51'),
	(3, 1, 1, '1993-06-14', '1992-01-31', 126.62, 'credito', 5, 'Sequi minima adipisci laudantium quam.', '2024-11-14 22:43:54', '2024-11-14 22:43:54'),
	(4, 1, 2, '2005-06-07', '2005-03-15', 944.69, 'contado', 5, NULL, '2024-11-14 22:43:58', '2024-11-14 22:43:58'),
	(5, 2, 3, '2005-08-16', '1998-11-28', 158.09, 'credito', 4, 'Omnis consequatur dicta quos sit cupiditate voluptate.', '2024-11-14 22:44:01', '2024-11-14 22:44:01'),
	(6, 1, 3, '1981-12-25', '2011-07-29', 300.38, 'credito', 1, NULL, '2024-11-14 22:45:46', '2024-11-14 22:45:46'),
	(7, 2, 4, '2017-11-26', '1976-05-30', 327.40, 'credito', 2, NULL, '2024-11-14 22:45:49', '2024-11-14 22:45:49'),
	(8, 1, 4, '1970-01-28', '1993-01-23', 891.01, 'contado', 2, NULL, '2024-11-14 22:45:53', '2024-11-14 22:45:53'),
	(9, 1, 5, '1974-02-01', '2009-05-28', 400.54, 'credito', 2, NULL, '2024-11-14 22:45:56', '2024-11-14 22:45:56'),
	(10, 2, 5, '2010-09-08', '1970-11-11', 324.00, 'credito', 5, NULL, '2024-11-14 22:45:59', '2024-11-14 22:45:59'),
	(28, 2, 22, '2024-12-02', NULL, 4.00, 'credito', NULL, NULL, '2024-12-16 20:22:36', '2024-12-16 20:22:36'),
	(29, 1, 22, '2024-12-16', NULL, 9.00, 'credito', NULL, NULL, '2024-12-16 20:23:56', '2024-12-16 20:23:56');

-- Volcando datos para la tabla flowfer_pelleria.voucher_payment_details: ~0 rows (aproximadamente)

-- Volcando datos para la tabla flowfer_pelleria.voucher_series: ~3 rows (aproximadamente)
INSERT IGNORE INTO `voucher_series` (`id`, `voucher_type_id`, `serie_number`, `last_correlative_number`, `created_at`, `updated_at`) VALUES
	(1, 1, 'B001', 5, '2024-11-08 15:10:26', '2024-11-14 22:45:57'),
	(2, 2, 'F001', 5, '2024-11-08 15:10:27', '2024-11-14 22:46:00'),
	(3, 3, 'N001', 5, '2024-12-07 03:24:28', '2024-12-07 03:24:29');

-- Volcando datos para la tabla flowfer_pelleria.voucher_types: ~3 rows (aproximadamente)
INSERT IGNORE INTO `voucher_types` (`id`, `code`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
	(1, 'B1', 'Boleta', 'BL', '2024-11-08 15:10:26', '2024-11-08 15:10:26'),
	(2, 'F1', 'Factura', 'FT', '2024-11-08 15:10:26', '2024-11-08 15:10:26'),
	(3, 'N1', 'Nota', 'N', '2024-12-07 03:24:54', '2024-12-07 03:24:55');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
