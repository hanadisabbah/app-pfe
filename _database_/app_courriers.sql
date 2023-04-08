-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 09 avr. 2023 à 01:57
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app_courriers`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id`, `post_id`) VALUES
(152, NULL),
(153, NULL),
(154, NULL),
(116, 1),
(130, 1),
(132, 1),
(144, 1),
(148, 1),
(149, 1),
(114, 2),
(118, 9),
(104, 16),
(151, 16),
(101, 17),
(100, 18),
(102, 19),
(103, 20),
(126, 20),
(141, 20),
(117, 21),
(124, 21),
(146, 21),
(155, 21),
(111, 24),
(115, 24),
(134, 24),
(147, 24),
(121, 25),
(129, 25),
(133, 25),
(150, 25),
(142, 28),
(143, 28),
(156, 31),
(157, 31),
(158, 31);

-- --------------------------------------------------------

--
-- Structure de la table `courrier`
--

CREATE TABLE `courrier` (
  `id` int(11) NOT NULL,
  `starting_post_id` int(11) NOT NULL,
  `arrival_post_id` int(11) NOT NULL,
  `delivery_man_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `delivery_situation` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `postal_situation` varchar(255) NOT NULL,
  `typecourrier` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `courrier`
--

INSERT INTO `courrier` (`id`, `starting_post_id`, `arrival_post_id`, `delivery_man_id`, `status`, `created_at`, `delivery_date`, `delivery_situation`, `description`, `barcode`, `postal_situation`, `typecourrier`, `is_deleted`) VALUES
(21, 1, 6, 87, 'livré', '2023-03-24 02:15:42', '2023-03-24 00:00:00', 'JJJHJH', 'JHJHJHH', '4466', 'JKJ', 'Simple', 0),
(32, 1, 29, 98, 'livré', '2023-03-28 12:55:53', '2023-03-12 00:00:00', 'DD', 'FF', '777', 'CC', 'Simple', 0),
(37, 1, 29, 87, 'en_cours', '2023-03-31 12:36:57', '2023-03-31 12:36:57', 'TT', 'TTT', '666', 'POSTE TATAOUINE', 'Simple', 1),
(38, 2, 1, 87, 'en_cours', '2023-04-01 14:38:39', '2023-04-01 14:38:39', 'delivery', 'description', '23456789', 'POSTE  NABEUL', 'Grande', 1),
(39, 21, 6, 87, 'en_cours', '2023-04-01 16:44:26', '2023-04-01 16:44:26', 'NNN', 'NNN', '75654', 'Poste de Tunis', 'Simple', 0),
(40, 6, 18, 87, 'en_cours', '2023-04-01 17:08:06', '2023-04-01 17:08:06', 'YYY', 'LLKLK', '12345', 'Poste de Tunis', 'Grande', 1),
(41, 21, 26, 87, 'en_cours', '2023-04-02 18:41:25', '2023-04-02 18:41:25', 'pas defini', 'sqdqsdqsd', '98098077', 'POSTE TATAOUINE', 'Simple', 1),
(42, 21, 26, 87, 'en_stock', '2023-04-02 18:44:17', '2023-04-02 18:44:17', 'pas defini', 'sqdqsdqsd', '98098077', 'POSTE TATAOUINE', 'Simple', 1),
(43, 21, 26, 87, 'en_stock', '2023-04-02 18:45:29', '2023-04-02 18:45:29', 'pas defini', 'sqdqsdqsd', '98098077', 'POSTE TATAOUINE', 'Simple', 1),
(44, 21, 18, 98, 'en_stock', '2023-04-02 18:46:44', '2023-04-02 18:46:44', 'jhqsgdkqsd', 'tyafgdjkaljdmaùd', '90890789765', 'POSTE TATAOUINE', 'Grande', 0),
(45, 21, 28, 87, 'en_stock', '2023-04-02 22:23:47', '2023-04-02 00:00:00', 'TT', 'TYTYT', '00099', 'POSTE TATAOUINE', 'Simple', 1),
(46, 2, 1, 105, 'en_stock', '2023-04-03 12:29:21', '2023-04-03 12:29:21', 'NN', 'LLNN', '000006', 'Poste de Tunis', 'Simple', 1),
(47, 2, 26, 87, 'en_cours', '2023-04-03 12:30:07', '2023-04-03 12:30:07', 'mm', 'pp', '5555', 'POSTE SOUSSA', 'Grande', 1),
(48, 20, 1, 98, 'en_cours', '2023-04-03 23:52:06', '2023-04-03 23:52:06', 'RRT', 'RTRTR', '7575', 'POSTE JERBA', 'Multiple', 0),
(49, 21, 2, 87, 'en_cours', '2023-04-04 11:44:58', '2023-04-04 00:00:00', 'PPKU', 'MLMLU', '123', 'POSTE  NABEUL', 'Grande', 0),
(50, 9, 2, 87, 'en_cours', '2023-04-04 13:17:43', '2023-04-04 13:17:43', 'TTT', 'HJJ', '1245', 'POSTE  NABEUL', 'Grande', 0),
(51, 21, 27, 87, 'en_stock', '2023-04-04 13:54:08', '2023-04-04 13:54:08', 'DFD', 'DFF', '34', 'POSTE TATAOUINE', 'Grande', 0),
(52, 2, 9, 87, 'en_cours', '2023-04-05 22:42:40', '2023-04-05 22:42:40', 'YY', 'YY', '56024', 'Poste de Tunis', 'Grande', 0),
(53, 2, 16, 87, 'en_stock', '2023-04-05 22:42:55', '2023-04-05 22:42:55', 'YY', 'YY', '56024', 'Poste de Tunis', 'Grande', 1),
(54, 2, 24, 87, 'livré', '2023-04-05 22:46:05', '2023-04-05 22:46:05', 'HH', 'HH', '54133', 'POSTE TATAOUINE', 'Grande', 0),
(55, 24, 26, 87, 'en_stock', '2023-04-06 02:09:02', '2023-04-06 02:09:02', 'mmm', 'lklk', '5353', 'POSTE TATAOUINE', 'Grande', 1),
(56, 24, 26, 87, 'en_stock', '2023-04-06 02:12:12', '2023-04-06 02:12:12', 'mmm', 'lklk', '5353', 'POSTE TATAOUINE', 'Grande', 1),
(57, 24, 26, 87, 'en_stock', '2023-04-06 02:13:24', '2023-04-06 02:13:24', 'mmm', 'lklk', '5353', 'POSTE TATAOUINE', 'Grande', 1),
(58, 24, 17, 87, 'en_stock', '2023-04-06 15:17:31', '2023-04-06 15:17:31', 'LL', 'MLML', '88', 'POSTE TATAOUINE', 'Grande', 1),
(59, 24, 6, 87, 'en_stock', '2023-04-06 15:21:34', '2023-04-06 15:21:34', 'YTYT', 'RTRTR', '778', 'POSTE TATAOUINE', 'Grande', 1),
(60, 9, 30, 105, 'en_stock', '2023-04-07 00:42:46', '2023-04-07 00:42:46', 'NN', 'NJH', '01', 'POSTE  NABEUL', 'Grande', 1),
(61, 9, 31, 105, 'en_stock', '2023-04-08 00:34:36', '2023-04-08 00:34:36', 'JJJJ', 'KJKJ', '1220', 'POSTE  NABEUL', 'Grande', 1),
(62, 9, 31, 105, 'en_stock', '2023-04-08 00:36:20', '2023-04-08 00:36:20', 'JJJJ', 'KJKJ', '1220', 'POSTE  NABEUL', 'Grande', 0),
(63, 9, 27, 113, 'en_stock', '2023-04-08 00:40:23', '2023-04-08 00:00:00', 'UU', 'IU', '13230', 'POSTE  NABEUL', 'Grande', 0),
(64, 9, 27, 87, 'en_stock', '2023-04-08 11:14:01', '2023-04-08 11:14:01', 'II', 'IIU', '5252', 'POSTE  NABEUL', 'Grande', 0),
(65, 9, 29, 87, 'en_stock', '2023-04-09 00:42:29', '2023-04-09 00:42:29', 'TY', 'TY', '23', 'POSTE  NABEUL', 'Simple', 0),
(66, 9, 29, 87, 'en_stock', '2023-04-09 00:44:59', '2023-04-09 00:44:59', 'TY', 'TY', '23', 'POSTE  NABEUL', 'Simple', 0),
(67, 9, 1, 87, 'en_stock', '2023-04-09 00:45:31', '2023-04-09 00:45:31', 'dfgd', 'dgf', '7', 'POSTE  NABEUL', 'Grande', 0);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230308223316', '2023-03-08 23:33:25', 6358),
('DoctrineMigrations\\Version20230309182107', '2023-03-09 19:21:20', 3577),
('DoctrineMigrations\\Version20230310092701', '2023-03-10 10:27:13', 4310),
('DoctrineMigrations\\Version20230310092853', '2023-03-10 10:29:02', 317),
('DoctrineMigrations\\Version20230310105446', '2023-03-10 11:54:51', 3058),
('DoctrineMigrations\\Version20230310211930', '2023-03-10 22:19:38', 2617),
('DoctrineMigrations\\Version20230311103038', '2023-03-11 11:30:43', 1231),
('DoctrineMigrations\\Version20230311104111', '2023-03-11 11:41:15', 214),
('DoctrineMigrations\\Version20230315140022', '2023-03-15 15:00:38', 9693),
('DoctrineMigrations\\Version20230316091047', '2023-03-16 10:10:59', 3017),
('DoctrineMigrations\\Version20230316091236', '2023-03-16 10:12:41', 423),
('DoctrineMigrations\\Version20230316173145', '2023-03-16 18:32:04', 2785),
('DoctrineMigrations\\Version20230317001137', '2023-03-17 01:11:44', 6477),
('DoctrineMigrations\\Version20230317002403', '2023-03-17 01:24:07', 522),
('DoctrineMigrations\\Version20230317002827', '2023-03-17 01:28:32', 2283);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id` int(11) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `courrier_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`id`, `statut`, `comment`, `utilisateur_id`, `courrier_id`, `updated_at`) VALUES
(57, 'en_cours', 'ajouter un courrier d\'id: 66 en 2023-04-09 00:44', 118, 66, '2023-04-09 00:44:59'),
(58, 'en_stock', 'ajouter un courrier d\'id: 67 en 2023-04-09 00:45', 118, 67, '2023-04-09 00:45:31');

-- --------------------------------------------------------

--
-- Structure de la table `livreur`
--

CREATE TABLE `livreur` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livreur`
--

INSERT INTO `livreur` (`id`) VALUES
(87),
(98),
(105),
(113),
(159),
(160);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `type_post` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `label`, `type_post`, `address`, `is_deleted`) VALUES
(1, 'Poste de Djerba', 'Normal', 'rue xxx Djerba 6---', 1),
(2, 'Poste de Tunis', 'Normal', 'tunis', 1),
(3, 'Poste de Sfax', 'Multiple', 'Rout Sfax', 1),
(6, 'Poste SOUSSA', 'Multiple', 'rue akoda soussa', 1),
(9, 'POSTE  NABEUL', 'Multiple', 'nabeul 1234', 1),
(16, 'POSTE SFAX', 'Normal', 'rue sfaxxx', 0),
(17, 'POSTE GABES', 'Normal', 'rue gabes', 0),
(18, 'POSTE JERBA', 'Normal', 'rue jerba', 0),
(19, 'POSTE TUNIS', 'Normal', 'rue tunis', 0),
(20, 'POSTE SOUSSA', 'Normal', 'rue soussa', 0),
(21, 'POSTE TATAOUINE', 'Multiple', 'rue tataouine', 1),
(22, 'fddf', 'Normal', 'dfhdh', 1),
(23, 'fddf', 'Normal', 'dfhdh', 1),
(24, 'POSTE TATAOUINE', 'Multiple', 'rue tataouine', 0),
(25, 'POSTE BEJA', 'Multiple', 'rue beja', 0),
(26, 'POSTE MAHRES', 'Multiple', 'rue mahres', 0),
(27, 'POSTE JANDOUBBA', 'Normal', 'rue jandouba', 0),
(28, 'POSTE KEF', 'Multiple', 'rue kef', 0),
(29, 'POSTE TABARKA', 'Normal', 'rue tabarka', 0),
(30, 'POSTE MEDENINE', 'Normal', 'rue medenine', 0),
(31, 'POSTE MONASTIR', 'Normal', 'rue monastir', 0),
(32, 'POSTE BIZERTE', 'Normal', 'rue bizerte', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `type`) VALUES
(39, 'admin@gmail.com', '[\"SUPER_ADMIN\"]', '$2y$13$Vpf2/UzKo/YbEBgSjaiHj.D3uKeJR42S.p0gym1CDhX7OwfEcT0RS', 'admin', 'admin', 'user'),
(40, 'superadmin@gmail.com', '[\"SUPER_ADMIN\"]', '$2y$13$pEYYPd/cu5La6A16JJ1s4uQm5HysY9eAMsuwuzQqTMS71ZxDMwq3.', 'superadmin', 'superadmin', 'user'),
(50, 'SUPERADMINN@GMAIL.COM', '[\"SUPER_ADMIN\"]', '$2y$13$GEtXtP5w/6kOmWSGUY3GHuwsegl5rzLpY21v.GgNLqVz4msa4GLya', 'SUPERADMIN', 'SUPERADMIN', 'user'),
(87, 'livreur12@gmail.com', '[\"ROLE_LIVREUR\"]', '$2y$13$0LL.LLUzBTqWGr1FQImDBO2IRnmtXic/GYgvMU7yRhhuZO7lanDje', 'livreur12', 'livreur12', 'livreur'),
(90, 'adminiiII@gmail.com', '[\"ROLE_ADMIN\"]', '123456789', 'adminii', 'adminii', 'user'),
(98, 'livreurr@gmail.com', '[\"ROLE_LIVREUR\"]', '$2y$13$KAxFQHY9NGWh9.Xge3ZuueAoGlFksEVxsw40qTHNtqD.AjtCkJhcu', 'livreurr', 'livreurr', 'livreur'),
(100, 'ahmedagent@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$7JlqvVGaPnitxn19ZIQJquZ4t3I3UG3W6scJ2nq4sgLiGtH6MhdOi', 'ahmed', 'ahmed', 'agent'),
(101, 'agent1@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$NC/btBII7GzZybNLhKDSj.ie.7U8EhxQRVm3DjlI7X6rvZ6tzZgeW', 'agent1', 'agent1', 'agent'),
(102, 'agent2@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$wkQP3h/L6iKsotT.d6dBn.pa/JiMjWVXIap6HiC.FxfOiZKXJEQL2', 'agent2', 'agent2', 'agent'),
(103, 'agent3@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$wipL1G7iMQhicRvNbX/0TOZxOIrvJ.0mhCFFg4sgMz3XSRVo/eD6K', 'agent3', 'agent3', 'agent'),
(104, 'agent4@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$pVknaogpNUNiYG6mBbd4E.5UJKaGlJnXB2lbmvxXIa50BIO9JtUQa', 'agent4', 'agent4', 'agent'),
(105, 'livreur1@gmail.com', '[\"ROLE_LIVREUR\"]', '$2y$13$ghxC0N54PQKTkQT5VqDzD.x2yWYwPlrdINU21aJoO/OShqqbCubP.', 'livreur1', 'livreur1', 'livreur'),
(106, 'admin2@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$YnGeVQxEvP8WY2eMjG/Dseiw4fHMOu0zyt3BwHq.CiqS6rvMUGb/O', 'admin2', 'admin2', 'user'),
(111, 'superagentpostetataouine@gmail.com', '[\"ROLE_SUPER_AGENT\"]', '$2y$13$lDR8ulP/l/QtJoYPHudv0.O0AI9B61eyFNiEWVkVplRCgCG4ZC51a', 'superagentpostetataouine', 'superagentpostetataouine', 'agent'),
(112, 'adminmh@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$4c7lPe0Z3xtHzwPME616Fegc3C2Ky8m74tYxMeDrei8x.vFsojbYK', 'adminmh', 'adminmh', 'user'),
(113, 'livreur33@gmail.com', '[\"ROLE_LIVREUR\"]', '$2y$13$iJ9r/gdmyhv02ZkOdLwP3OQXHAaZ0.klmJii83gdeauNTrH305epW', 'livreur33', 'livreur33', 'livreur'),
(114, 'agentfad@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$Bb7ZvHIM3irNJWa81sfDselvCtxTg.pKffV9C/h/nZ1w1jsMXh9ge', 'agentfad', 'agentfad', 'agent'),
(115, 'agentpp@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$Ts9CgHabFiU7wZedn0sUSOUzH9YWfoZp5m.q6cnF1yua0FFRLoJnm', 'agentpp', 'agentpp', 'agent'),
(116, 'agentr@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$gOZs5Q1SEynh.Gw13EVLQuYCYuRuvNWztY98KGYaWHdMomMy35swq', 'agentr', 'agentr', 'agent'),
(117, 'agentoo@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$9anyoQnPL1kTOg.zC3uWVedoU4SeumEqBPT1XkKbVlFtUkpUonfKq', 'agentoo', 'agentoo', 'agent'),
(118, 'agentA@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$.GEG18yVKur6rWKvbynlze0Krx11aFkjXPySjBpCYFfyCkru.bW2G', 'az', 'agent', 'agent'),
(120, 'adminz@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$4KFhr273y8uykkQZFa0y1uFVPW3u9RM.uOH7vsVMfY0cZ46709lzq', 'adminz', 'adminz', 'user'),
(121, 'superragent@gmail.com', '[\"ROLE_SUPER_AGENT\"]', '$2y$13$nGHmgCC8eEg2FkeaIYpTQOH7fxVFbIRgR75sLBNZWQPaF5g1ZUyqu', 'superragent', 'superragent', 'agent'),
(124, 'agenty@gmail.comm', '[\"ROLE_AGENT\"]', '$2y$13$uDXSrKnNi4/xyvEEuNrpDumIiA5kEOyc..Qb3EkE4pWCJKdbrctrm', 'agenty', 'agenty', 'agent'),
(126, 'superagentt@gmail.com', '[\"ROLE_AGETN\"]', '123456789', 'superagenttt', 'superagenttt', 'agent'),
(127, 'superadminnn@gmail.com', '[\"SUPER_ADMIN\"]', '$2y$13$v23PgFZaGMmFXc6/0eFvjudHv1LKD82bDiKMmSf7IP0BapJDLdyFC', 'superadminj', 'superadminj', 'user'),
(128, 'yy@gmail.com', '[\"SUPER_ADMIN\"]', '$2y$13$x8kdugPZ71l8hEkSk/t.NejmkHZIKAS/l6pBFl6h7ATo3V12/7SbO', 'rr', 'rr', 'user'),
(129, 'agentrr@gmail.com', '[\"ROLE_AGETN\"]', '123456789', 'agentr', 'agentr', 'agent'),
(130, 'agentooy@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$4fmYw8gEZMmcu.Ta5ZYnfe9nMvD0XQl4j2HU2gHEfHd9K2l./3JGG', 'agentooy', 'agentooy', 'agent'),
(132, 'pp@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$g27GffQY7jSBrpD3YJJMdOk8Irj2W1/g3cQESjCaEQcPju0DLEeZm', 'pp', 'pp', 'agent'),
(133, 'tat@gmail.com', '[\"ROLE_AGETN\"]', '123456789', 'tatTT', 'tatTT', 'agent'),
(134, 'hh@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$o98eGfV/wKhF4f/1sWfrFeYg5a8vP8kpZ8kxL1pTBEBDG.BviOHqi', 'jj', 'jj', 'agent'),
(136, 'superad@gmail.com', '[\"SUPER_ADMIN\"]', '$2y$13$TmQ75xAaI4hy2bF5ArwEhuKlK7Ro6yi2IGjHZQaYDIIWKLaKWsyAi', 'superad@', 'superad@', 'user'),
(138, 'sad@gmail.com', '[\"SUPER_ADMIN\"]', '$2y$13$sexTMPL33i8KH.u8PXxUT.tF82hpBOT4Q7z/PuugZbfsyv2Y6gM.y', 'sad', 'sad', 'user'),
(141, 'sp@gmail.com', '[\"ROLE_SUPER_AGENT\"]', '$2y$13$c0yqrPEaBYfSWCXOAMUYneDrCuDm8qlkRBFpAbnJW5dBuvPADsnZm', 'sp', 'sp', 'agent'),
(142, 'mohamed@gmail.com', '[\"ROLE_SUPER_AGENT\"]', '$2y$13$4Nsc1Q5TjeHFx.80D2giE.5FubsU06nhmRWwgrUuiv/Q.YNtz4h/i', 'mohamed', 'mohamed', 'agent'),
(143, 'hanaagent@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$BF1HQIXu3lG7gO.rA7SNyOpZuUiFsKQzTWkSn.4fPiTPW5XB90pcK', 'hanaagent', 'hanaagent', 'agent'),
(144, 'sarraag@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$ug3FcH5W9UZRFQsKPaisE.hlGGVx8QdkiZsIZHF.sDytx8wuGY0k2', 'sarraag', 'sarraag', 'agent'),
(145, 'adminzzz@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$zQXa/sV.aIwQKYzcMZ384uf33hxwF1tWUYYlLitoT1rqS9PZ1BNIa', 'adminzzz', 'adminzzz', 'user'),
(146, 'salahagent@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$HYp43CZIpQ1/TnYAA94e5OdoyKhdMffJiZAuereve9Ohk4oHOqSdO', 'salahagent', 'salahagent', 'agent'),
(147, 'SSA@gmail.com', '[\"ROLE_SUPER_AGENT\"]', '$2y$13$xYs.9DtcB0QeOxQKWGOPnO/Ai0LUdGRgwmoEL2NSAlLPD9c1ArZhm', 'SSA', 'SSA', 'agent'),
(148, 'suAgent@dj.com', '[\"ROLE_SUPER_AGENT\"]', '$2y$13$8JcFYA8LiGxqctMPpDpKbubOx.h22LKs4vHHIkAilYQaobiILal0C', 'suAgent@dj.com', 'suAgent@dj.com', 'agent'),
(149, 'agentDJ@djerba.com', '[\"ROLE_AGENT\"]', '$2y$13$I8fJSIHopI9ovSZm6SCKNOZkTSQX8utRZEtSPE5M2vovjuhT4gq/m', 'agentDJ@djerba.com', 'agentDJ@djerba.com', 'agent'),
(150, 'agt@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$cx7DpGSEwF/ujvpxZtSfYO2lkOUOBNBjJu.wN5f2D6PlPmcW5kXfW', 'agt@gmail.com', 'agt@gmail.com', 'agent'),
(151, 'supsfax@gmail.com', '[\"ROLE_SUPER_AGENT\"]', '$2y$13$q9wATgHKHNJHGd9gohJXquUJ1DaLXLKr..v11IicO.IvAE9rrRj72', 'supsfax', 'supsfax', 'agent'),
(152, 'agsfax@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$tPRJd553JBmX0f/4lVCpI.p2u5J/ARDnIjSRgkO8tb/y3AIiEU.IO', 'agsfax', 'agsfax', 'agent'),
(153, 'agentsfax@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$xgOkDOFalaRZMxg/2xazBuZm6cbm8Ga5gwYM/elC7/WfF3B6QOW3i', 'agentsfax', 'agentsfax', 'agent'),
(154, 'agentbeja@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$NzxRVA2v9jsvRi5XnQXPVeDYrcePfuaUhytnW.3Z5Qpt8UxGii/DG', 'agentbeja', 'agentbeja', 'agent'),
(155, 'agenttt@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$yIxYVeRjN95gT90BMUpy0.RyXhGMEZwSkes4JA5suB6PCKrvpPErG', 'agenttt', 'agenttt', 'agent'),
(156, 'agentmostir@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$qWIPm1VgfXygvf1Bp.QJeuft.y.6Cgh7T5Ahoi9D8xndBBVJiQjP.', 'agentmostir', 'agentmostir', 'agent'),
(157, 'superagentmestir@gmail.com', '[\"ROLE_SUPER_AGENT\"]', '$2y$13$DFysLJPholtZ3rrRMtG7beoklXYD4b2xKq4z.CXmb69Dklc0erdBi', 'superagentmestir', 'superagentmestir', 'agent'),
(158, 'agentmestir@gmail.com', '[\"ROLE_AGENT\"]', '$2y$13$waKHPqFevQn3yvRoDUOQBehO4Pg8z763WkiRs0JSqxqHLypNQji42', 'agentmestir', 'agentmestir', 'agent'),
(159, 'livreurt@gmail.com', '[\"ROLE_LIVREUR\"]', '$2y$13$vvNCJ0xUjqu2KHT/lMbxj.HgOvWf/l2.Cp0hpNq5BMiLogfOEPF9C', 'livreurt', 'livreurt', 'livreur'),
(160, 'livreur4@gmail.com', '[\"ROLE_LIVREUR\"]', '$2y$13$SjIvVJgawMmlVF9x79.dWukJGRKNTNmB3GbIUO9NFJq.UP91wFCYu', 'livreur4', 'livreur4', 'livreur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_268B9C9D4B89032C` (`post_id`);

--
-- Index pour la table `courrier`
--
ALTER TABLE `courrier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BEF47CAAFC55A341` (`starting_post_id`),
  ADD KEY `IDX_BEF47CAA8042CD24` (`arrival_post_id`),
  ADD KEY `IDX_BEF47CAAFD128646` (`delivery_man_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EDBFD5ECFB88E14F` (`utilisateur_id`),
  ADD KEY `IDX_EDBFD5EC8BF41DC7` (`courrier_id`);

--
-- Index pour la table `livreur`
--
ALTER TABLE `livreur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `courrier`
--
ALTER TABLE `courrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `FK_268B9C9D4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_268B9C9DBF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `courrier`
--
ALTER TABLE `courrier`
  ADD CONSTRAINT `FK_BEF47CAA8042CD24` FOREIGN KEY (`arrival_post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_BEF47CAAFC55A341` FOREIGN KEY (`starting_post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_BEF47CAAFD128646` FOREIGN KEY (`delivery_man_id`) REFERENCES `livreur` (`id`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `FK_EDBFD5EC8BF41DC7` FOREIGN KEY (`courrier_id`) REFERENCES `courrier` (`id`),
  ADD CONSTRAINT `FK_EDBFD5ECFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `livreur`
--
ALTER TABLE `livreur`
  ADD CONSTRAINT `FK_EB7A4E6DBF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
