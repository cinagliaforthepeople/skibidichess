-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 14, 2025 alle 16:45
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chess`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `access_logs`
--

CREATE TABLE `access_logs` (
  `user_id` int(11) NOT NULL,
  `ip` varchar(24) NOT NULL,
  `device` varchar(32) NOT NULL,
  `os` varchar(25) NOT NULL,
  `client` varchar(32) NOT NULL,
  `country` varchar(32) NOT NULL,
  `region` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `isp` varchar(32) NOT NULL,
  `as_` varchar(32) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `access_logs`
--

INSERT INTO `access_logs` (`user_id`, `ip`, `device`, `os`, `client`, `country`, `region`, `city`, `isp`, `as_`, `time`) VALUES
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 136.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-03-30 18:58:04'),
(64, '5.90.231.176', 'N/A', 'Android 15', 'Firefox Mobile 136.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-03-30 19:00:22'),
(64, '5.90.231.176', 'N/A', 'Android 15', 'Firefox Mobile 136.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-03-30 19:01:27'),
(64, '5.90.231.176', 'N/A', 'Android 15', 'Firefox Mobile 136.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-03-30 19:02:19'),
(65, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 136.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-03-30 19:14:54'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 18:41:24'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 18:46:54'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 19:18:00'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 19:24:14'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 19:24:27'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 20:53:38'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 20:53:54'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 20:57:48'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 20:58:23'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 20:58:54'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 20:59:13'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 20:59:27'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 20:59:55'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 21:00:57'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 21:01:49'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 21:10:45'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 21:11:14'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 21:11:51'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 21:15:21'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 21:18:45'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 21:19:07'),
(64, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-27 21:19:34'),
(71, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-28 19:52:55'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-28 19:53:09'),
(70, '192.168.1.15', 'N/A', 'Android 10', 'Chrome Mobile 135.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-28 20:11:54'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-28 20:20:29'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-28 20:28:59'),
(72, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-28 20:31:03'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-28 20:33:56'),
(72, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-28 20:39:30'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-28 20:47:05'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-30 20:29:06'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-30 20:29:53'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-30 20:53:53'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-30 20:57:37'),
(70, '::1', 'N/A', 'Windows 10', 'Microsoft Edge 135.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-30 21:20:56'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-30 21:41:14'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-30 21:43:53'),
(72, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-30 21:44:33'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 137.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-04-30 21:44:43'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-05 17:26:41'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-05 17:28:39'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:15:55'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:16:44'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:20:37'),
(72, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:21:35'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:24:33'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:28:55'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:40:41'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:44:06'),
(70, '::1', 'N/A', 'Windows 10', 'Microsoft Edge 136.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:44:34'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 13:45:59'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 19:46:38'),
(72, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 20:41:00'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-11 21:10:28'),
(70, '93.67.104.237', 'N/A', 'Android 15', 'Firefox Mobile 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-11 21:58:05'),
(75, '93.67.104.237', 'N/A', 'Android 15', 'Firefox Mobile 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-11 22:01:46'),
(70, '93.67.104.237', 'N/A', 'Android 15', 'Firefox Mobile 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-11 22:04:06'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-13 15:55:49'),
(75, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-13 16:37:24'),
(75, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-13 16:43:00'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-13 17:34:57'),
(75, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-13 18:56:44'),
(70, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-13 19:38:49'),
(75, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-13 19:53:25'),
(75, '192.168.1.15', 'N/A', 'Android 15', 'Firefox Mobile 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-13 20:29:46'),
(75, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-13 20:39:01'),
(75, '77.32.7.0', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Tuscany', 'Albinia', 'EOLO S.p.A', 'AS35612 EOLO S.p.A.', '2025-05-13 21:08:27'),
(75, '77.32.7.0', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Tuscany', 'Albinia', 'EOLO S.p.A', 'AS35612 EOLO S.p.A.', '2025-05-13 21:11:57'),
(70, '93.67.104.237', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-13 21:25:24'),
(70, '93.67.104.237', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-13 21:29:02'),
(75, '193.207.222.157', 'N/A', 'Android 11', 'Firefox Mobile 138.0', 'Italy', 'Lombardy', 'Seriate', 'Telecom Italia S.p.A.', 'AS3269 Telecom Italia S.p.A.', '2025-05-13 22:02:04'),
(75, '93.67.104.237', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-13 23:20:03'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-14 15:54:43'),
(70, '127.0.0.1', 'N/A', 'Windows 10', 'Firefox 138.0', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-05-14 15:54:50'),
(70, '93.67.104.237', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-14 16:00:48'),
(70, '93.67.104.237', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-14 16:14:53'),
(70, '93.67.104.237', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-14 16:16:48'),
(70, '93.67.104.237', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-14 16:17:25'),
(70, '5.90.231.242', 'N/A', 'Android 15', 'Firefox Mobile 138.0', 'Italy', 'Lazio', 'Mentana', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-14 16:18:12'),
(75, '77.32.7.0', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Tuscany', 'Albinia', 'EOLO S.p.A', 'AS35612 EOLO S.p.A.', '2025-05-14 16:18:39'),
(75, '93.67.104.237', 'N/A', 'Windows 10', 'Firefox 138.0', 'Italy', 'Lazio', 'Rome', 'Vodafone', 'AS30722 Vodafone Italia S.p.A.', '2025-05-14 16:44:50');

-- --------------------------------------------------------

--
-- Struttura della tabella `accounts`
--

CREATE TABLE `accounts` (
  `id` int(8) NOT NULL,
  `username` varchar(24) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `pts` int(15) NOT NULL DEFAULT 0,
  `pfp_path` varchar(250) NOT NULL,
  `private_token` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `active`, `admin`, `pts`, `pfp_path`, `private_token`) VALUES
(70, 'cinag', 'Riccardo', 'Cinaglia', 'cinagliariccardo@gmail.com', '$2y$10$v/r9OVD/S.z3deyVr1dx3.LfTIvmQYDeay/nN2/6FDtDw2tKg807i', 1, 1, 5000, '', ''),
(75, 'test', 'Test', 'test', 'daddyalberty@gmail.com', '$2y$10$siZkCkCSRPH7i9Z61ZIb6OuwUFjwQDL6wfgGc8DnQ3CCFoBXzjnTS', 1, 0, 500, '', ''),
(76, 'provatoken', 'PROVA', 'TOKEN ', 'gidoc94306@daupload.com', '$2y$10$1ZKBJAFCzCbS.HXuC/YvWepu207TZbLdP4.qH3tIp1qmKCBcUbiPe', 1, 0, 0, '', '0f5da05900daccee59b3b4f107cebdabf87dfa59fac6d2d5e508d30fafc4dff2');

-- --------------------------------------------------------

--
-- Struttura della tabella `active_games`
--

CREATE TABLE `active_games` (
  `id` int(6) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `winner_id` int(11) DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `ended` binary(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `active_games`
--

INSERT INTO `active_games` (`id`, `creator_id`, `creation_date`, `winner_id`, `end_date`, `ended`) VALUES
(101751, 70, '2025-05-13 14:15:04', NULL, NULL, 0x30),
(102916, 70, '2025-05-13 19:12:09', NULL, NULL, 0x30),
(107403, 70, '2025-05-13 17:27:08', NULL, NULL, 0x30),
(107415, 70, '2025-05-13 16:36:24', NULL, NULL, 0x30),
(108966, 75, '2025-05-13 19:17:55', NULL, NULL, 0x30),
(112180, 70, '2025-05-13 16:16:12', NULL, NULL, 0x30),
(115913, 75, '2025-05-13 19:37:31', NULL, NULL, 0x30),
(119261, 70, '2025-05-13 13:55:55', NULL, NULL, 0x30),
(121019, 70, '2025-05-13 19:20:54', NULL, NULL, 0x30),
(122118, 75, '2025-05-13 14:43:07', NULL, NULL, 0x30),
(122182, 75, '2025-05-14 14:23:12', NULL, NULL, 0x30),
(124349, 75, '2025-05-13 18:30:10', NULL, NULL, 0x30),
(140306, 70, '2025-05-13 20:54:07', NULL, NULL, 0x30),
(140616, 0, '2025-05-05 16:24:09', NULL, NULL, 0x30),
(149162, 75, '2025-05-14 14:23:15', NULL, NULL, 0x30),
(150117, 75, '2025-05-14 14:23:09', NULL, NULL, 0x30),
(160408, 70, '2025-05-13 20:53:50', NULL, NULL, 0x30),
(165216, 70, '2025-05-13 17:46:03', NULL, NULL, 0x30),
(177243, 70, '2025-05-13 16:30:19', NULL, NULL, 0x30),
(177770, 70, '2025-05-13 17:28:42', NULL, NULL, 0x30),
(179956, 75, '2025-05-13 14:39:30', NULL, NULL, 0x30),
(181577, 75, '2025-05-14 14:23:12', NULL, NULL, 0x30),
(184179, 75, '2025-05-14 14:23:24', NULL, NULL, 0x30),
(184190, 75, '2025-05-14 14:23:17', NULL, NULL, 0x30),
(189092, 75, '2025-05-14 14:23:20', NULL, NULL, 0x30),
(190143, 70, '2025-05-13 16:26:54', NULL, NULL, 0x30),
(192368, 70, '2025-05-13 14:12:28', NULL, NULL, 0x30),
(203508, 70, '2025-05-13 20:52:41', NULL, NULL, 0x30),
(203530, 75, '2025-05-13 19:17:00', NULL, NULL, 0x30),
(205465, 75, '2025-05-13 19:23:45', NULL, NULL, 0x30),
(205587, 70, '2025-05-13 17:29:19', NULL, NULL, 0x30),
(214891, 75, '2025-05-14 14:23:18', NULL, NULL, 0x30),
(215274, 75, '2025-05-14 14:23:40', NULL, NULL, 0x30),
(219940, 75, '2025-05-14 14:23:12', NULL, NULL, 0x30),
(224654, 70, '2025-05-13 16:42:24', NULL, NULL, 0x30),
(230899, 70, '2025-05-13 16:35:34', NULL, NULL, 0x30),
(231618, 75, '2025-05-14 14:23:23', NULL, NULL, 0x30),
(245857, 75, '2025-05-13 14:37:26', NULL, NULL, 0x30),
(245914, 70, '2025-05-13 15:05:05', NULL, NULL, 0x30),
(246699, 70, '2025-05-13 19:18:19', NULL, NULL, 0x30),
(254919, 70, '2025-05-13 15:06:13', NULL, NULL, 0x30),
(255909, 70, '2025-05-13 14:57:11', NULL, NULL, 0x30),
(259148, 70, '2025-05-13 19:22:39', NULL, NULL, 0x30),
(259326, 70, '2025-05-13 19:27:29', NULL, NULL, 0x30),
(267144, 75, '2025-05-14 14:23:42', NULL, NULL, 0x30),
(268616, 75, '2025-05-14 14:23:22', NULL, NULL, 0x30),
(276050, 70, '2025-05-13 16:27:29', NULL, NULL, 0x30),
(282434, 70, '2025-05-13 18:23:44', NULL, NULL, 0x30),
(289292, 75, '2025-05-14 14:23:24', NULL, NULL, 0x30),
(295299, 75, '2025-05-14 14:23:18', NULL, NULL, 0x30),
(303629, 70, '2025-05-13 14:02:31', NULL, NULL, 0x30),
(306800, 75, '2025-05-14 14:23:21', NULL, NULL, 0x30),
(308439, 75, '2025-05-14 14:18:51', NULL, NULL, 0x30),
(309186, 75, '2025-05-14 14:23:14', NULL, NULL, 0x30),
(315795, 70, '2025-05-13 17:04:20', NULL, NULL, 0x30),
(317953, 70, '2025-05-14 14:00:52', NULL, NULL, 0x30),
(324734, 75, '2025-05-14 14:23:17', NULL, NULL, 0x30),
(325113, 70, '2025-05-13 21:30:26', NULL, NULL, 0x30),
(329436, 70, '2025-05-13 21:09:27', NULL, NULL, 0x30),
(345955, 70, '2025-05-13 18:06:26', NULL, NULL, 0x30),
(346102, 70, '2025-05-13 16:04:36', NULL, NULL, 0x30),
(349264, 75, '2025-05-14 14:23:19', NULL, NULL, 0x30),
(355072, 70, '2025-05-13 18:03:55', NULL, NULL, 0x30),
(359609, 75, '2025-05-14 14:23:17', NULL, NULL, 0x30),
(360109, 70, '2025-05-13 14:57:25', NULL, NULL, 0x30),
(361022, 75, '2025-05-14 14:23:23', NULL, NULL, 0x30),
(362884, 75, '2025-05-14 14:23:13', NULL, NULL, 0x30),
(371305, 70, '2025-05-14 14:21:03', NULL, NULL, 0x30),
(376929, 70, '2025-05-14 14:04:16', NULL, NULL, 0x30),
(377564, 70, '2025-05-13 17:47:51', NULL, NULL, 0x30),
(381616, 70, '2025-05-13 17:51:51', NULL, NULL, 0x30),
(396368, 70, '2025-05-13 19:18:34', NULL, NULL, 0x30),
(403249, 70, '2025-05-13 16:56:04', NULL, NULL, 0x30),
(404340, 70, '2025-05-13 20:48:54', NULL, NULL, 0x30),
(404902, 70, '2025-05-13 16:43:49', NULL, NULL, 0x30),
(409379, 70, '2025-05-13 16:27:21', NULL, NULL, 0x30),
(410132, 70, '2025-05-13 14:12:26', NULL, NULL, 0x30),
(410167, 70, '2025-05-13 19:34:11', NULL, NULL, 0x30),
(415158, 70, '2025-05-13 19:26:47', NULL, NULL, 0x30),
(416652, 70, '2025-05-13 14:57:07', NULL, NULL, 0x30),
(424994, 75, '2025-05-13 19:00:50', NULL, NULL, 0x30),
(425476, 70, '2025-05-13 17:45:21', NULL, NULL, 0x30),
(426258, 70, '2025-05-13 21:09:15', NULL, NULL, 0x30),
(431461, 75, '2025-05-13 18:30:08', NULL, NULL, 0x30),
(432890, 75, '2025-05-14 14:23:21', NULL, NULL, 0x30),
(432923, 75, '2025-05-14 14:23:14', NULL, NULL, 0x30),
(441647, 70, '2025-05-13 17:25:02', NULL, NULL, 0x30),
(441730, 70, '2025-05-13 15:13:06', NULL, NULL, 0x30),
(448862, 70, '2025-05-13 14:56:58', NULL, NULL, 0x30),
(449446, 70, '2025-05-13 15:23:30', NULL, NULL, 0x30),
(451318, 75, '2025-05-13 21:24:19', NULL, NULL, 0x30),
(452305, 70, '2025-05-13 17:34:57', NULL, NULL, 0x30),
(454009, 75, '2025-05-13 19:24:48', NULL, NULL, 0x30),
(457788, 70, '2025-05-13 14:34:28', NULL, NULL, 0x30),
(460357, 70, '2025-05-14 14:31:23', NULL, NULL, 0x30),
(471248, 70, '2025-05-13 18:59:03', NULL, NULL, 0x30),
(472358, 70, '2025-05-13 14:12:54', NULL, NULL, 0x30),
(481831, 70, '2025-05-13 14:12:28', NULL, NULL, 0x30),
(482525, 75, '2025-05-13 19:23:52', NULL, NULL, 0x30),
(482923, 75, '2025-05-14 14:23:10', NULL, NULL, 0x30),
(483989, 70, '2025-05-13 14:13:47', NULL, NULL, 0x30),
(486216, 70, '2025-05-13 15:07:08', NULL, NULL, 0x30),
(488278, 75, '2025-05-14 14:23:24', NULL, NULL, 0x30),
(488346, 70, '2025-05-13 19:26:49', NULL, NULL, 0x30),
(488353, 70, '2025-05-14 14:15:28', NULL, NULL, 0x30),
(490113, 75, '2025-05-14 14:23:14', NULL, NULL, 0x30),
(493109, 70, '2025-05-13 15:19:19', NULL, NULL, 0x30),
(493708, 70, '2025-05-13 20:48:51', NULL, NULL, 0x30),
(503239, 70, '2025-05-13 17:29:30', NULL, NULL, 0x30),
(514596, 70, '2025-05-13 20:37:39', NULL, NULL, 0x30),
(522832, 75, '2025-05-14 14:23:41', NULL, NULL, 0x30),
(527785, 70, '2025-05-13 19:20:50', NULL, NULL, 0x30),
(532227, 75, '2025-05-14 14:23:10', NULL, NULL, 0x30),
(537064, 70, '2025-05-13 20:39:18', NULL, NULL, 0x30),
(547842, 75, '2025-05-14 14:23:40', NULL, NULL, 0x30),
(552222, 75, '2025-05-14 14:23:17', NULL, NULL, 0x30),
(553868, 75, '2025-05-14 14:23:41', NULL, NULL, 0x30),
(557205, 70, '2025-05-13 14:15:50', NULL, NULL, 0x30),
(560820, 70, '2025-05-13 21:15:49', NULL, NULL, 0x30),
(561612, 70, '2025-05-14 14:29:37', NULL, NULL, 0x30),
(566467, 75, '2025-05-13 19:17:14', NULL, NULL, 0x30),
(569285, 75, '2025-05-13 19:19:23', NULL, NULL, 0x30),
(569909, 75, '2025-05-13 19:29:02', NULL, NULL, 0x30),
(570050, 75, '2025-05-14 14:23:17', NULL, NULL, 0x30),
(576853, 70, '2025-05-13 14:12:58', NULL, NULL, 0x30),
(579753, 70, '2025-05-14 14:20:54', NULL, NULL, 0x30),
(581465, 0, '2025-05-05 18:10:45', NULL, NULL, 0x30),
(582026, 70, '2025-05-13 16:40:27', NULL, NULL, 0x30),
(582596, 70, '2025-05-13 17:33:35', NULL, NULL, 0x30),
(592272, 75, '2025-05-14 14:23:23', NULL, NULL, 0x30),
(596399, 70, '2025-05-13 17:52:02', NULL, NULL, 0x30),
(596811, 70, '2025-05-13 15:07:20', NULL, NULL, 0x30),
(600722, 70, '2025-05-13 21:19:43', NULL, NULL, 0x30),
(602753, 70, '2025-05-13 14:12:38', NULL, NULL, 0x30),
(606372, 70, '2025-05-13 18:38:43', NULL, NULL, 0x30),
(606524, 70, '2025-05-13 19:27:28', NULL, NULL, 0x30),
(607088, 70, '2025-05-14 13:59:12', NULL, NULL, 0x30),
(609912, 75, '2025-05-13 18:30:10', NULL, NULL, 0x30),
(613228, 70, '2025-05-13 16:26:19', NULL, NULL, 0x30),
(615162, 75, '2025-05-14 14:23:19', NULL, NULL, 0x30),
(616142, 75, '2025-05-13 19:23:45', NULL, NULL, 0x30),
(618607, 75, '2025-05-14 14:23:11', NULL, NULL, 0x30),
(620999, 75, '2025-05-13 14:44:08', NULL, NULL, 0x30),
(623473, 70, '2025-05-13 17:53:29', NULL, NULL, 0x30),
(626749, 75, '2025-05-13 14:43:24', NULL, NULL, 0x30),
(628356, 70, '2025-05-13 17:02:45', NULL, NULL, 0x30),
(628777, 70, '2025-05-13 19:32:58', NULL, NULL, 0x30),
(629380, 70, '2025-05-13 17:38:20', NULL, NULL, 0x30),
(631559, 70, '2025-05-13 16:26:41', NULL, NULL, 0x30),
(646332, 70, '2025-05-13 18:29:26', NULL, NULL, 0x30),
(646503, 75, '2025-05-14 14:23:16', NULL, NULL, 0x30),
(648873, 75, '2025-05-14 14:23:13', NULL, NULL, 0x30),
(649225, 75, '2025-05-13 14:41:23', NULL, NULL, 0x30),
(649893, 70, '2025-05-13 18:20:25', NULL, NULL, 0x30),
(652925, 70, '2025-05-13 17:35:01', NULL, NULL, 0x30),
(658650, 70, '2025-05-13 14:15:38', NULL, NULL, 0x30),
(664554, 75, '2025-05-14 14:23:21', NULL, NULL, 0x30),
(682236, 75, '2025-05-14 14:23:21', NULL, NULL, 0x30),
(685451, 75, '2025-05-14 14:23:42', NULL, NULL, 0x30),
(688260, 75, '2025-05-13 19:25:06', NULL, NULL, 0x30),
(689632, 75, '2025-05-14 14:23:18', NULL, NULL, 0x30),
(693843, 70, '2025-05-13 18:31:45', NULL, NULL, 0x30),
(698874, 75, '2025-05-14 14:23:20', NULL, NULL, 0x30),
(719946, 75, '2025-05-14 14:23:18', NULL, NULL, 0x30),
(721581, 70, '2025-05-13 14:25:40', NULL, NULL, 0x30),
(726054, 70, '2025-05-13 16:35:48', NULL, NULL, 0x30),
(728044, 70, '2025-05-13 14:26:13', NULL, NULL, 0x30),
(729307, 70, '2025-05-13 20:03:40', NULL, NULL, 0x30),
(729540, 70, '2025-05-13 15:08:10', NULL, NULL, 0x30),
(731194, 70, '2025-05-13 14:12:27', NULL, NULL, 0x30),
(736372, 75, '2025-05-14 14:23:03', NULL, NULL, 0x30),
(740747, 70, '2025-05-14 14:29:44', NULL, NULL, 0x30),
(745039, 75, '2025-05-14 14:23:11', NULL, NULL, 0x30),
(745459, 75, '2025-05-14 14:23:09', NULL, NULL, 0x30),
(749849, 75, '2025-05-14 14:23:19', NULL, NULL, 0x30),
(753649, 75, '2025-05-13 21:30:01', NULL, NULL, 0x30),
(762128, 6, '2025-03-26 22:02:06', NULL, NULL, 0x30),
(764977, 70, '2025-05-13 17:27:40', NULL, NULL, 0x30),
(766702, 70, '2025-05-13 14:53:52', NULL, NULL, 0x30),
(769755, 75, '2025-05-14 14:23:19', NULL, NULL, 0x30),
(792287, 70, '2025-05-13 14:14:55', NULL, NULL, 0x30),
(803011, 75, '2025-05-14 14:23:15', NULL, NULL, 0x30),
(806866, 70, '2025-05-13 16:46:23', NULL, NULL, 0x30),
(809519, 70, '2025-05-13 20:39:57', NULL, NULL, 0x30),
(827094, 70, '2025-05-13 16:41:22', NULL, NULL, 0x30),
(829238, 75, '2025-05-14 14:23:44', NULL, NULL, 0x30),
(831980, 75, '2025-05-14 14:23:43', NULL, NULL, 0x30),
(836050, 75, '2025-05-13 19:25:06', NULL, NULL, 0x30),
(836132, 75, '2025-05-14 14:23:22', NULL, NULL, 0x30),
(836317, 70, '2025-05-13 19:26:48', NULL, NULL, 0x30),
(836516, 70, '2025-05-13 18:05:23', NULL, NULL, 0x30),
(838405, 70, '2025-05-13 14:13:45', NULL, NULL, 0x30),
(841525, 75, '2025-05-13 19:08:31', NULL, NULL, 0x30),
(842628, 75, '2025-05-14 14:23:52', NULL, NULL, 0x30),
(842806, 70, '2025-05-13 18:19:01', NULL, NULL, 0x30),
(848299, 70, '2025-05-13 18:15:01', NULL, NULL, 0x30),
(853694, 70, '2025-05-13 17:52:37', NULL, NULL, 0x30),
(861607, 70, '2025-05-13 17:33:56', NULL, NULL, 0x30),
(861917, 6, '2025-03-26 22:02:12', NULL, NULL, 0x30),
(869318, 75, '2025-05-14 14:23:15', NULL, NULL, 0x30),
(873808, 70, '2025-05-13 20:40:24', NULL, NULL, 0x30),
(874422, 70, '2025-05-13 14:32:37', NULL, NULL, 0x30),
(878645, 70, '2025-05-13 19:18:24', NULL, NULL, 0x30),
(878978, 70, '2025-05-13 16:22:39', NULL, NULL, 0x30),
(879668, 75, '2025-05-13 19:22:59', NULL, NULL, 0x30),
(881396, 75, '2025-05-14 14:23:12', NULL, NULL, 0x30),
(881744, 75, '2025-05-14 14:23:42', NULL, NULL, 0x30),
(885585, 70, '2025-05-13 19:27:14', NULL, NULL, 0x30),
(889863, 70, '2025-05-13 17:26:16', NULL, NULL, 0x30),
(894747, 70, '2025-05-13 15:25:32', NULL, NULL, 0x30),
(898129, 75, '2025-05-14 14:23:41', NULL, NULL, 0x30),
(905702, 70, '2025-05-13 14:14:26', NULL, NULL, 0x30),
(910069, 75, '2025-05-14 14:23:22', NULL, NULL, 0x30),
(917711, 75, '2025-05-13 16:58:42', NULL, NULL, 0x30),
(918413, 75, '2025-05-13 18:30:09', NULL, NULL, 0x30),
(922541, 75, '2025-05-14 14:23:42', NULL, NULL, 0x30),
(923821, 75, '2025-05-14 14:23:17', NULL, NULL, 0x30),
(928166, 70, '2025-05-13 14:50:55', NULL, NULL, 0x30),
(933821, 70, '2025-05-13 14:43:09', NULL, NULL, 0x30),
(934547, 75, '2025-05-13 21:28:29', NULL, NULL, 0x30),
(941318, 70, '2025-05-13 17:23:43', NULL, NULL, 0x30),
(942614, 70, '2025-05-13 20:36:20', NULL, NULL, 0x30),
(946037, 75, '2025-05-13 14:43:22', NULL, NULL, 0x30),
(946388, 70, '2025-05-13 21:17:35', NULL, NULL, 0x30),
(958296, 70, '2025-05-13 19:21:11', NULL, NULL, 0x30),
(960516, 70, '2025-05-13 17:22:56', NULL, NULL, 0x30),
(961057, 75, '2025-05-14 14:23:41', NULL, NULL, 0x30),
(962643, 75, '2025-05-14 14:23:43', NULL, NULL, 0x30),
(968426, 75, '2025-05-14 14:23:16', NULL, NULL, 0x30),
(973848, 70, '2025-05-13 18:10:55', NULL, NULL, 0x30),
(983178, 70, '2025-05-13 16:59:18', NULL, NULL, 0x30),
(985512, 70, '2025-05-13 15:34:34', NULL, NULL, 0x30),
(999540, 70, '2025-05-13 17:03:44', NULL, NULL, 0x30);

-- --------------------------------------------------------

--
-- Struttura della tabella `games_history`
--

CREATE TABLE `games_history` (
  `game_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `joiner_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `winner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `verification_codes`
--

CREATE TABLE `verification_codes` (
  `code` varchar(6) NOT NULL,
  `email` varchar(32) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `expires` datetime NOT NULL DEFAULT (current_timestamp() + interval 10 minute),
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `active_games`
--
ALTER TABLE `active_games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
