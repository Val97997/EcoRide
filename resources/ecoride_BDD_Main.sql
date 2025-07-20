-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 02 juil. 2025 à 14:22
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecoride`
--

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `model` varchar(45) NOT NULL,
  `registration` varchar(255) NOT NULL,
  `fuel` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `user_id`, `model`, `registration`, `fuel`, `color`, `registration_date`) VALUES
(22, 21, 'Audi Golf', 'DE-254-AD', 'autogas', 'Red', '2025-05-01'),
(25, 21, 'BMW', 'DE-257-AD', 'electric', 'blue', '2025-05-29');

-- --------------------------------------------------------

--
-- Structure de la table `carshare`
--

CREATE TABLE `carshare` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_hour` time NOT NULL,
  `departure_location` varchar(45) NOT NULL,
  `arrival_date` date NOT NULL,
  `arrival_hour` time NOT NULL,
  `arrival_location` varchar(45) NOT NULL,
  `available_seats` smallint(6) NOT NULL,
  `price` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `smoking_allowance` tinyint(1) NOT NULL,
  `animal_allowance` tinyint(1) NOT NULL,
  `pref` longtext DEFAULT NULL COMMENT '(DC2Type:simple_array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carshare`
--

INSERT INTO `carshare` (`id`, `user_id`, `car_id`, `departure_date`, `departure_hour`, `departure_location`, `arrival_date`, `arrival_hour`, `arrival_location`, `available_seats`, `price`, `status`, `smoking_allowance`, `animal_allowance`, `pref`) VALUES
(18, 21, 22, '2025-07-01', '06:00:00', 'Paris', '2025-07-01', '12:00:00', 'Narbonne', 3, 310, 'canceled', 1, 1, ''),
(19, 21, 22, '2025-08-01', '05:50:00', 'Rome', '2025-08-02', '15:00:00', 'Berlin', 9, 50, 'waiting', 1, 1, 'No snakes,no smoke'),
(20, 21, 25, '2025-10-01', '10:00:00', 'Lyon', '2025-10-01', '21:30:00', 'Madrid', 3, 80, 'waiting', 1, 0, ''),
(21, 21, 25, '2025-10-02', '15:00:00', 'Oslo', '2025-10-02', '21:00:00', 'Valence', 8, 54, 'waiting', 0, 1, ''),
(22, 21, 22, '2025-11-14', '23:30:00', 'Lisbonne', '2025-11-16', '18:00:00', 'Athens', 2, 140, 'waiting', 0, 0, ''),
(23, 21, 25, '2025-07-23', '22:00:00', 'Rome', '2025-07-24', '14:00:00', 'Oslo', 6, 62, 'waiting', 1, 1, ''),
(24, 21, 22, '2025-10-30', '12:00:00', 'Milan', '2025-10-30', '15:00:00', 'Florence', 2, 40, 'waiting', 1, 0, ''),
(25, 21, 22, '2025-07-01', '14:00:00', 'Paris', '2025-07-01', '19:00:00', 'Francfort', 20, 200, 'complete', 0, 0, NULL);

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
('DoctrineMigrations\\Version20250602103322', '2025-06-02 12:14:15', 236),
('DoctrineMigrations\\Version20250603133845', '2025-06-03 13:40:44', 127),
('DoctrineMigrations\\Version20250605152805', '2025-06-05 15:28:14', 37),
('DoctrineMigrations\\Version20250607104905', '2025-06-07 10:49:18', 38),
('DoctrineMigrations\\Version20250608125424', '2025-06-08 12:54:30', 29),
('DoctrineMigrations\\Version20250610131134', '2025-06-10 13:11:42', 109),
('DoctrineMigrations\\Version20250610131749', '2025-06-10 13:17:52', 16);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(180) DEFAULT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_nb` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `credit_balance` int(11) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `picture` longblob DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `roles`, `password`, `email`, `first_name`, `last_name`, `phone_nb`, `address`, `credit_balance`, `birth_date`, `picture`, `is_verified`) VALUES
(1, 'JohnDoe7', '[\"ROLE_USER\",\"ROLE_DRIVER\", \"ROLE_EMPLOYEE\", \"ROLE_ADMIN\"]', '$2y$13$tnCKI6tmUCS2SQjdR2N1NuMsKY6FPy4zq79qlIm7QBsz7rD0nHnAa', 'test@email.com', 'John', 'Doe', '01 01 02 05 06', '123 London Blvd', 1962, '2002-12-31', 0x433a5c55736572735c6775696c685c417070446174615c4c6f63616c5c54656d705c706870363035332e746d70, 0),
(21, 'TestDriver97', '[\"ROLE_USER\",\"ROLE_DRIVER\"]', '$2y$13$hKRvhbCvBmT81GIoC5WVX.4prb1LdmXUKp1cg7DaGOWmHeCpoXZDC', 'testDr@mail.com', 'Test', 'Driver', NULL, NULL, 38, '2007-05-01', NULL, 0),
(22, 'JohnDoe97', '[\"ROLE_USER\",\"ROLE_PASSENGER\"]', '$2y$13$AzHfgsCGePxDIhwf..gS/OOSKIQYrhVCCeciWxArkCFJA8wppnRlG', 'johnn@mail.com', 'JohnDoe', NULL, '01 02 02 02 02', '123 London Blvd', 19981, '2000-01-01', 0x433a5c55736572735c6775696c685c417070446174615c4c6f63616c5c54656d705c706870343243382e746d70, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_carshare`
--

CREATE TABLE `user_carshare` (
  `user_id` int(11) NOT NULL,
  `carshare_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_carshare`
--

INSERT INTO `user_carshare` (`user_id`, `carshare_id`) VALUES
(22, 19),
(22, 22),
(22, 25);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_773DE69DA76ED395` (`user_id`);

--
-- Index pour la table `carshare`
--
ALTER TABLE `carshare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7949F9EDA76ED395` (`user_id`),
  ADD KEY `IDX_7949F9EDC3C6F69F` (`car_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_PSEUDO` (`pseudo`);

--
-- Index pour la table `user_carshare`
--
ALTER TABLE `user_carshare`
  ADD PRIMARY KEY (`user_id`,`carshare_id`),
  ADD KEY `IDX_99C41DEDA76ED395` (`user_id`),
  ADD KEY `IDX_99C41DEDD05257A` (`carshare_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `carshare`
--
ALTER TABLE `carshare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `FK_773DE69DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `carshare`
--
ALTER TABLE `carshare`
  ADD CONSTRAINT `FK_7949F9EDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_7949F9EDC3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`);

--
-- Contraintes pour la table `user_carshare`
--
ALTER TABLE `user_carshare`
  ADD CONSTRAINT `FK_99C41DEDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_99C41DEDD05257A` FOREIGN KEY (`carshare_id`) REFERENCES `carshare` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
