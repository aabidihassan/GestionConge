-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 mai 2021 à 12:27
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_conge`
--

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

CREATE TABLE `conges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_adjoint` int(11) NOT NULL,
  `referance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_vac` int(1) NOT NULL,
  `annee` year(4) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nbJours` int(2) NOT NULL,
  `adjoint` int(1) NOT NULL,
  `chef_service` int(1) NOT NULL,
  `greffier_chef` int(1) NOT NULL,
  `etat` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conges`
--

INSERT INTO `conges` (`id`, `id_user`, `id_adjoint`, `referance`, `type_vac`, `annee`, `date_debut`, `date_fin`, `nbJours`, `adjoint`, `chef_service`, `greffier_chef`, `etat`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020/3', 1, 2020, '2021-05-13', '2021-05-23', 7, 1, 0, 0, 1, '2021-05-11 09:25:32', '2021-05-15 21:12:43'),
(5, 1, 1, '2020/4', 1, 2020, '2021-05-12', '2021-05-31', 14, 2, 1, 0, 2, '2021-05-11 09:27:19', '2021-05-17 11:49:16'),
(6, 1, 1, '2019/1', 1, 2019, '2021-05-16', '2021-05-21', 5, 1, 0, 0, 1, '2021-05-15 22:32:20', '2021-05-15 22:32:20'),
(7, 1, 1, '2021/1', 1, 2021, '2021-05-16', '2021-05-23', 5, 5, 0, 0, 1, '2021-05-15 22:32:58', '2021-05-17 11:49:20'),
(8, 1, 1, '2019/2', 2, 2019, '2021-05-30', '2021-05-31', 1, 1, 0, 0, 1, '2021-05-15 22:51:55', '2021-05-16 13:01:07'),
(9, 1, 1, '2021/2', 1, 2021, '2021-05-27', '2021-05-30', 2, 1, 0, 0, 1, '2021-05-17 12:23:43', '2021-05-17 12:23:43');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_27_113424_create_user_type', 2),
(5, '2021_04_27_123955_laratrust_setup_tables', 3),
(6, '2021_04_28_120851_jours_restants', 4),
(8, '2021_04_29_123232_demande', 5),
(10, '2021_05_05_210507_create_demandes_table', 6),
(11, '2021_05_06_113538_create_referances_table', 7),
(12, '2021_05_07_092741_create_referances_table', 8),
(13, '2021_05_10_125519_create_conges_table', 9),
(14, '2021_05_19_121337_create_vacances_table', 10);

-- --------------------------------------------------------

--
-- Structure de la table `referances`
--

CREATE TABLE `referances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastNum` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `referances`
--

INSERT INTO `referances` (`id`, `annee`, `referance`, `lastNum`, `created_at`, `updated_at`) VALUES
(1, '2020', '2020', 5, NULL, '2021-05-11 09:27:19'),
(2, '2021', '2021', 3, NULL, '2021-05-17 12:23:43'),
(3, '2019', '2019', 3, NULL, '2021-05-15 22:51:55');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `type`) VALUES
(1, 'حسن عبيدي', 'hassan', NULL, '$2y$10$vwMqiXnX0wrD1mdPSara2ubpQyynhG9GzDhMez4ux7hLlUuoVcXca', 'oqgKWIFOacjj1mGTAs5yQFo0ZAW8HxWZ1fBF2JoEYG710xMTSSIa0CLr3hDE', '2021-04-26 21:39:16', '2021-04-26 21:39:16', 'user'),
(3, 'Administrator', 'admin', NULL, '$2y$10$Zl.OiMtXCuy7siuEWhQrO.i5txb7BaslP6pofNEKwKYnQqJ7pWftS', NULL, '2021-04-27 12:24:27', '2021-04-27 12:24:27', 'admin'),
(4, 'aabidi', 'aabidi', NULL, '$2y$10$vwMqiXnX0wrD1mdPSara2ubpQyynhG9GzDhMez4ux7hLlUuoVcXca', NULL, NULL, NULL, 'chef');

-- --------------------------------------------------------

--
-- Structure de la table `vacances`
--

CREATE TABLE `vacances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `nbJours` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vacances`
--

INSERT INTO `vacances` (`id`, `name`, `date`, `nbJours`, `created_at`, `updated_at`) VALUES
(1, 'تقديم وثيقة الاستقلال', '2021-01-11', 1, NULL, NULL),
(2, 'عيد الشغل', '2021-05-01', 1, NULL, NULL),
(3, 'عيد الفطر', '2021-05-13', 2, NULL, NULL),
(4, 'عيد الأضحى', '2021-07-20', 2, NULL, NULL),
(5, 'عيد العرش', '2021-07-30', 1, NULL, NULL),
(6, 'رأس السنة الهجرية', '2021-08-10', 2, NULL, NULL),
(7, 'فاتح يناير', '2021-01-01', 1, NULL, NULL),
(8, 'ذكرى وادي الذهب', '2021-08-14', 1, NULL, NULL),
(9, 'ذكرى ثورة الملك و الشعب', '2021-08-20', 1, NULL, NULL),
(10, 'عيد الشباب', '2021-08-21', 1, NULL, NULL),
(11, 'ذكرى المسيرة الخضراء', '2021-09-06', 1, NULL, NULL),
(12, 'عيد الإستقلال', '2021-09-18', 1, NULL, NULL),
(13, 'عيد المولد النبوي', '2021-10-19', 2, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `referances`
--
ALTER TABLE `referances`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `vacances`
--
ALTER TABLE `vacances`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conges`
--
ALTER TABLE `conges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `referances`
--
ALTER TABLE `referances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vacances`
--
ALTER TABLE `vacances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
