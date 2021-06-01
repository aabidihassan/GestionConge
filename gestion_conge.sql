-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 01 juin 2021 à 14:31
-- Version du serveur :  10.4.19-MariaDB
-- Version de PHP : 8.0.6

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
(14, '2021_05_19_121337_create_vacances_table', 10),
(15, '2021_05_21_114133_create_services_table', 11);

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
(1, '2021', '2021', 1, NULL, '2021-05-24 11:49:25');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chef` int(11) NOT NULL,
  `minim` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `chef`, `minim`, `created_at`, `updated_at`) VALUES
(1, 'الاعلاميات', 1, 1, NULL, NULL),
(2, 'مكتب التدبير الإداري والضبط', 1, 1, NULL, NULL),
(3, 'مكتب الرسوم القضائبة', 9, 2, NULL, NULL),
(4, 'مكتب التنسيق مع المفوضين', 12, 2, NULL, NULL),
(5, 'مكاتب الواجهة', 17, 2, NULL, NULL),
(6, 'المحجوزات', 1, 0, NULL, NULL),
(7, 'القطب المدني', 29, 1, NULL, NULL),
(8, 'القطب الزجري', 61, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `id_service` int(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `id_service`, `etat`, `created_at`, `updated_at`) VALUES
(1, 'مولاي يوسف اشهان', 'y.achahane', '$2y$10$OLEQ3YYupQgVrtV6gSZwGuOxswqI69sXtMfQ4gN5k1fRIMpgl9Yhe', 'chef', 1, 1, '2021-05-30 09:51:31', '2021-05-30 09:51:31'),
(2, 'عبد الوافي ايكضد', 'a.ikidid', '$2y$10$nOI8rrABAdvuRbe/.mBHvewOViwxfG1PoMKAo.H3mw7ny8r5ynXre', 'user', 1, 1, '2021-05-30 09:53:59', '2021-05-30 09:53:59'),
(3, 'سفيان تقي', 's.taqi', '$2y$10$jw42QMUe9qpRW7COMNUfVuyG3.jluXvijkFyy1zbkP0259h7uXIgK', 'user', 1, 1, '2021-05-30 09:54:23', '2021-05-30 09:54:23'),
(4, 'الهام فسكى', 'i.faska', '$2y$10$7AHl6wXBWTvHC3N9xg/HPOWLAraCbu4wCX4BPSzDInvQ49Sby2AQS', 'user', 2, 1, '2021-05-30 09:54:46', '2021-05-30 09:54:46'),
(5, 'خالد ماوي', 'k.maoui', '$2y$10$TFAdzXb9R/xPDy8LUehcAu9XVQV9tSW6Z14wtoLfdGV3g2BaaAf8G', 'user', 2, 1, '2021-05-30 09:55:07', '2021-05-30 09:55:07'),
(6, 'نورة صنوار', 'n.sanouar', '$2y$10$Bn0TqGxYDivCJ0WwdIw0GuFcD6jkqTyLay6.czPBmgyiX.0WQ2UPO', 'user', 2, 1, '2021-05-30 09:55:28', '2021-05-30 09:55:28'),
(7, 'سهام مرشاد', 's.morchad', '$2y$10$bb4Tbl3T7oVP.lfrIJUXqeU9iR2dIdj5gSrHcAnGQ51jaomWFkayG', 'user', 2, 1, '2021-05-30 09:55:47', '2021-05-30 09:55:47'),
(8, 'هشام بوضركة', 'h.boudarga', '$2y$10$nZLnXFQ6Zhaj9iaF9MC0CO1AbY8Qb.MVHBqDgxxRYCiktJD1/BxSu', 'user', 2, 1, '2021-05-30 09:56:07', '2021-05-30 09:56:07'),
(9, 'رشيد الطويل', 'r.touil', '$2y$10$8/BdfF72Ij2HBHor.q0ijeGYhHbmgSyo9BgWHgyGF3KlQtatrtBnC', 'chef', 3, 1, '2021-05-30 09:56:32', '2021-05-30 09:56:32'),
(10, 'محمد حليم بنحيدة', 'm.benhida', '$2y$10$gFA68HQ98pkjjUfvM0YzketRC3HQBW53WkEF8ZtRZa6bqazr5mHKa', 'user', 3, 1, '2021-05-30 10:49:17', '2021-05-30 10:49:17'),
(11, 'إسماعيل لشان', 'i.lachane', '$2y$10$zhFRsug2WL61C/dd/7RU9uVFsmMJLB1ZM6YrMA4ZONw3DcEqWWF4i', 'user', 4, 1, '2021-05-30 10:54:16', '2021-05-30 10:54:16'),
(12, 'نعيمة بنحسي', 'n.benhassi', '$2y$10$DLm.iktKouDlxbsOdTvLNe6HkGT7GaU73744uREbwjbLytQPjuUYW', 'chef', 4, 1, '2021-05-30 10:54:47', '2021-05-30 10:54:47'),
(13, 'محمد مالكي', 'm.malki', '$2y$10$lTWmZowUvSCcJzOfTcXCEu1cfbTG3N4hPW4QU8M/cIFgLaf4fRMHS', 'user', 4, 1, '2021-05-30 10:55:07', '2021-05-30 10:55:07'),
(14, 'محمد يقين', 'm.yaqine', '$2y$10$a9NLg4rRdVuA6kWiiBNN9eGd0hV3ugc3IMFcbmQVqeOWu1EErsuJ2', 'user', 4, 1, '2021-05-30 10:55:34', '2021-05-30 10:55:34'),
(15, 'نادية اصيف', 'n.assif', '$2y$10$cgo4CkgowcSLBv16pd4JV.Y7IHlLkIwI3iuYp35o0.QuXp7.s5gfu', 'user', 4, 1, '2021-05-30 10:59:30', '2021-05-30 10:59:30'),
(16, 'عزيزة الراحي', 'a.arrahi', '$2y$10$rAaT.Rl0SSh6hPnLDv7Fw.c1dRHTsdGb4OqDzRPyWX1EhVXJaAePS', 'user', 4, 1, '2021-05-30 10:59:54', '2021-05-30 10:59:54'),
(17, 'يوسف الزكريتي', 'y.zekriti', '$2y$10$SgHvauZLBv/OErbysBAvpOZH4btYz7cCpbJ0tJ2GKQMYqPvgOrsay', 'chef', 5, 1, '2021-05-30 11:00:19', '2021-05-30 11:00:19'),
(18, 'نزهة المختاري', 'n.mokhtari', '$2y$10$/bk7kWQNVtaUrgfa6aGNIes3KuG4PBTSky4Pyxon0mQTJvSSHoIsO', 'user', 5, 1, '2021-05-30 11:00:38', '2021-05-30 11:00:38'),
(19, 'مريم اقس', 'm.ikss', '$2y$10$PuQphRCww3EftkMtsvr3q.E7yD9Xdqxq0rRw1doDJTjzD8vmxAPtK', 'user', 5, 1, '2021-05-30 11:00:54', '2021-05-30 11:00:54'),
(20, 'لطيفة الراضي', 'l.erradi', '$2y$10$npeHbHba48P1N9QOWQuvxORFg6WjmxPsqo1vYBdWreLWXm3O1Xppe', 'user', 5, 1, '2021-05-30 11:01:11', '2021-05-30 11:01:11'),
(21, 'سامية بنعبو', 's.benabbou', '$2y$10$zaOzqChXf15oE3jANZK/P.jmoQnQRMCD7GS4z5fY/ZUk2.gBlFUeG', 'user', 5, 1, '2021-05-30 11:01:32', '2021-05-30 11:01:32'),
(22, 'خديجة رومنجو', 'k.erroumanjou', '$2y$10$7Z7mBBM.VJAElUkXItGYNe58SI46muoj0vsCIT3Miwy2ldkPkU4uW', 'user', 5, 1, '2021-05-30 11:01:47', '2021-05-30 11:01:47'),
(23, 'يوسف تائب', 'y.taeb', '$2y$10$8rZJTJOIMqLPvOms4Z834e0shsWQaaU0Egl5gwXykoXVr7fw3Sn3u', 'user', 5, 1, '2021-05-30 11:02:04', '2021-05-30 11:02:04'),
(24, 'رشيد بنحدية', 'r.benhadiya', '$2y$10$iKUvLL0jDIo8GHuQZEM8w.VX5xvLDRnNQW3qzQZDoblZG7NVLiSiC', 'user', 6, 1, '2021-05-30 11:02:37', '2021-05-30 11:02:37'),
(25, 'عزيزة الخليفة', 'a.elkhalifa', '$2y$10$hs6BAnnTFRFvM584XFFPaOpBh.XlY86IG63ep4Yh5uZsBtjLOE.mq', 'user', 7, 1, '2021-05-30 11:02:56', '2021-05-30 11:02:56'),
(26, 'ثورية أبو عبد الله', 't.abouabdilah', '$2y$10$ZNMDdpp42ka66FUgeeXO6eLFm.R9swBWB/HMaU7QzTD.bXLy/AC/y', 'user', 7, 1, '2021-05-30 11:03:20', '2021-05-30 11:03:20'),
(27, 'ليلى ايت مغار', 'l.aitoumghar', '$2y$10$lBbxdvlqnIWWopBthut19upQBjNH87SobAnxDPhDnpL4ehwqg/fXq', 'user', 7, 1, '2021-05-30 11:03:49', '2021-05-30 11:03:49'),
(28, 'بهيجة الغزالي', 'b.elghazali', '$2y$10$Zpio6b/7F827ccIG6AeWjOD2Hg9yRdlZ4Defyipzcaf3ui7tI9uDG', 'user', 7, 1, '2021-05-30 11:04:06', '2021-05-30 11:04:06'),
(29, 'عبد القادر كلولي', 'a.kalouli', '$2y$10$dDhlAA8bdHF2YOivgfPHsOXz2JYbQQMAbDjn6r7F60ZROQF0V/FXS', 'chef', 7, 1, '2021-05-30 11:04:22', '2021-05-30 11:04:22'),
(30, 'نوال قلاج', 'n.qalaj', '$2y$10$9pLfX4Puk8IIks6VNIr6q.WrwY0IOtH84SsxDteUZH.oPoLb.xJN2', 'user', 7, 1, '2021-05-30 11:04:41', '2021-05-30 13:05:37'),
(31, 'فوزية الزوان', 'f.elgabsi', '$2y$10$xz7EdjXTdtjIfpX4JrGr7u1q9k66F08K/fDCaKtoCLRV6BvvV6YdG', 'user', 7, 1, '2021-05-30 11:04:57', '2021-05-30 11:04:57'),
(32, 'عزيزة التلوسي', 'a.tloussi', '$2y$10$mQpPwC2sGq3jrzFKnhs0ou9YbEqfNy2Jf3Q5qbjeQ5zB2kSRX7BEW', 'user', 7, 1, '2021-05-30 11:05:42', '2021-05-30 11:05:42'),
(33, 'مليكة دؤالي', 'm.douali', '$2y$10$KoiPbbl0Pry0pgE.rRGOpeeMfdwZZRZx1i.PXapKtqLS9rfH6Swk2', 'user', 7, 1, '2021-05-30 11:05:57', '2021-05-30 11:05:57'),
(34, 'شطومة شكور', 'c.chakour', '$2y$10$gFTi/.P8yAp9EZMeipDxGOY3U4ooichMtnDHWQoNgThW2H7P9R0Uy', 'user', 7, 1, '2021-05-30 11:06:15', '2021-05-30 11:06:15'),
(35, 'رجاء السماحي', 'r.essmahi', '$2y$10$DfycW6WuJfiAOBN6QA7a3.GEShytFXinat1TC4dea3UPOozLk5lG6', 'user', 7, 1, '2021-05-30 11:06:32', '2021-05-30 11:06:32'),
(36, 'ماجدة زهير', 'm.zahir', '$2y$10$G76f7qZE1RFiwoYyojo0puQlEZeaP4IT6kiFmn/V1hHDN2h4snpcG', 'user', 7, 1, '2021-05-30 11:06:50', '2021-05-30 11:06:50'),
(37, 'للاحسناء المنديلي', 'h.elmandili', '$2y$10$beTQ9Ljg7R692YXZ9PZjqu5x.S4cs49BGGnZsnvIIqWm2bXfk5X6u', 'user', 7, 1, '2021-05-30 11:07:06', '2021-05-30 11:07:06'),
(38, 'امينة الكومي', 'a.elgoumi', '$2y$10$W97o8qpRvMuR7hEJi1YAdOXH2ZGUcil0ITaUfW4SHpaTWxoPY79zG', 'user', 7, 1, '2021-05-30 11:07:21', '2021-05-30 11:07:21'),
(39, 'عبد الاله بن الرايس', 'a.benerraess', '$2y$10$l2.GLEDwSflepNeHTAq7nuhQvyhqhNAL8/CN..J0PcO.BCi2Sl0Ui', 'user', 7, 1, '2021-05-30 11:09:48', '2021-05-30 11:09:48'),
(40, 'بوساق محمد', 'm.boussk', '$2y$10$PRleJ9/.c8kLPHUhiaXwNe2NWobg0HDOSKhMg8CkchnoS9aQks6s6', 'user', 7, 1, '2021-05-30 11:10:03', '2021-05-30 11:10:03'),
(41, 'امينة اوراغ', 'a,aouragh', '$2y$10$3y/RQw5MRtfSEo0TYKc6Tu2UXssB/Dg3lzl3jYC2/QVnP0uMuSbJa', 'user', 7, 1, '2021-05-30 11:10:23', '2021-05-30 11:10:23'),
(42, 'بشرى اجعيدر', 'b.agaider', '$2y$10$hJjA4pPrjn6ug2L1G.RtAeZUOgiNDeM3wWYhiWPGF2s6MUwnh/FCi', 'user', 7, 1, '2021-05-30 11:10:40', '2021-05-30 11:10:40'),
(43, 'هند العرباطي', 'h.elairbati', '$2y$10$2TgZ/Yd2K9DdmpSQPF4u7OFS55Qmq93QG6h6yukuod4VdNnD1ho0m', 'user', 8, 1, '2021-05-30 11:10:57', '2021-05-30 11:10:57'),
(44, 'طامو ايت فضيلة', 't.aitfdila', '$2y$10$ot09dhbRMMxB8S7P5oXaOejvQ.1eRyzTf4qC2DEEA8Iwv6rJDMLQq', 'user', 8, 1, '2021-05-30 11:11:19', '2021-05-30 11:11:19'),
(45, 'حفيظة لمسكين', 'h.lamskine', '$2y$10$2YAa3/X7s0kCP6uIHdYsbengEgxvz4TstIJ4tbM0qhxE66hrc4E8q', 'user', 8, 1, '2021-05-30 11:11:35', '2021-05-30 11:11:35'),
(46, 'حيات فوزي', 'h.faouzi', '$2y$10$6fFL7WobJ0tA0SDMlF/UBOF6nvlAnp93jY2BcCr4BBKicoGgnpg2S', 'user', 8, 1, '2021-05-30 11:11:53', '2021-05-30 11:11:53'),
(47, 'مونة الودني', 'm.elouadni', '$2y$10$55b5J/Cx2guL/UsNQys3pO1mnzQJs2EQjs0uGOdLxUk9E.BuEHxC.', 'user', 8, 1, '2021-05-30 11:12:10', '2021-05-30 11:12:10'),
(48, 'الحسين البردوني', 'l.elbardouni', '$2y$10$pNq44jpIE7FOhSSyILHAR.npPpmy9mc3.tp40hbmzxeHEbKwNvPbu', 'user', 8, 1, '2021-05-30 11:12:32', '2021-05-30 11:12:32'),
(49, 'عبد الغني ايت موح', 'a.aitmouh', '$2y$10$fq82HxXbucxCFIAQPGrbqOEwHcAmHKRgK/69MqLFw0iRhpLLujuUy', 'user', 8, 1, '2021-05-30 11:12:50', '2021-05-30 11:12:50'),
(50, 'عبد الرحيم ابلعيد', 'a.oubelaid', '$2y$10$08fh2SlU0h3AgCyH9Zaf0OJu/pEr41SW148B3v5Cn9sKftRs6QcM.', 'user', 8, 1, '2021-05-30 11:13:05', '2021-05-30 11:13:05'),
(51, 'نوفل اغلاي', 'n.aghallay', '$2y$10$eaMPjgQqT5YBAXWHeXa.0.oPchMozg6uS0Nmi4tkAhd/1eXi5aF/2', 'user', 8, 1, '2021-05-30 11:13:20', '2021-05-30 11:13:20'),
(53, 'يوسف ناجيبي', 'y.najibi', '$2y$10$qVugm.06ofjY/31sxhltSOmT9uDjGkwQ0Tx9Q5WTHhrydWX14pGNa', 'user', 8, 1, '2021-05-30 11:14:14', '2021-05-30 11:14:14'),
(54, 'فؤاد مدود', 'f.moudoud', '$2y$10$wTMBBrDxI7cHis1pTZ1zEusTk1gte/QaB6sH5XLjmxtbL0qr4fQSe', 'user', 8, 1, '2021-05-30 11:14:28', '2021-05-30 11:14:28'),
(55, 'مصطفى لحميدات', 'm.lahmidate', '$2y$10$37WN5PpGEk/cHqmPDt42ouRLxnaAqzKux.eG5ZNVaoFu0ZwYLJ0NO', 'user', 8, 1, '2021-05-30 11:14:44', '2021-05-30 11:14:44'),
(56, 'عبد الله واعزيز', 'a.ouaziz', '$2y$10$A1sNreCHY43TWy91LmIbJunpnb.sGmyCyh9PwBLSiPeYgIoxm31oe', 'user', 8, 1, '2021-05-30 11:14:59', '2021-05-30 11:14:59'),
(57, 'عبد العالي الكص', 'a.gasse', '$2y$10$6bKzbwIJUi1JlEpOFoBjgeG396BVhyIwrtK1FcLwZhqVYq7bclSFq', 'user', 8, 1, '2021-05-30 11:15:13', '2021-05-30 11:15:13'),
(58, 'عزالدين خلدون', 'a.khaldoun', '$2y$10$Fc.wFniBCWTzlyTv6iGjdOZOM/GA4XcjcRKMnCPlZuN7goe14EmNK', 'user', 8, 1, '2021-05-30 11:15:31', '2021-05-30 11:15:31'),
(59, 'إبراهيم الزحولي', 'b.ezzahouli', '$2y$10$ZGlEjFyLAsZ0R20lCQcuUuukIYYD1hjHUSV4YhiCML9cuEw15NlJW', 'user', 7, 1, '2021-05-30 11:15:48', '2021-05-30 11:15:48'),
(60, 'عزيز بوكصة', 'a.bougassa', '$2y$10$luv3PoQE/noVfdHn.qe/5OVQbQ6CcO55HZGO99PH4f7GVdQYpy45u', 'user', 7, 1, '2021-05-30 11:16:08', '2021-05-30 11:16:08'),
(61, 'احمد لواء الدين', 'a.lioeddine', '$2y$10$uYWH2Yy9RnqShCEJCTTecunyfH1bgnRAmrqdEM/S7grUYVWZwyoU.', 'chef', 8, 1, '2021-05-30 11:16:36', '2021-05-30 11:16:36'),
(62, 'مومن عبد الكريم', 'a.moumen', '$2y$10$CvbFGoh3Mnq7o/ijlFNgCO9Ygp1V.lxaOROr5D2zxmHg47Emf4Dz.', 'user', 9, 1, '2021-05-30 11:17:55', '2021-05-30 11:17:55'),
(63, 'سعاد امعيلات', 's.amillat', '$2y$10$Ic42BglK2jfZGk3GJhrVu.ktMLOr14yMfSSpfDUFoEPHxg8V8Sp5W', 'user', 9, 1, '2021-05-30 11:18:09', '2021-05-30 11:18:09'),
(64, 'ثوريا المتنبي', 't.elmoutanabih', '$2y$10$fR1f1iXC4M1A.GG14eU25.IXwbwg11jgFIYDjsYENGw1uftinuIRS', 'user', 9, 1, '2021-05-30 11:18:24', '2021-05-30 11:18:24'),
(65, 'الهام عياض', 'i.ayad', '$2y$10$BwJfs9PqkUSDBcjp/AZwquShgK4U7uTgMylJRgU/7CDQ5YG/RQDoS', 'user', 9, 1, '2021-05-30 11:18:41', '2021-05-30 11:18:41'),
(66, 'سعيدة ننيش', 's.ninich', '$2y$10$5jIXpxzJ5d8ou4kjG/hQieC1dZQkVMf17cF5mo01Wz8/uaJO1JOrm', 'user', 9, 1, '2021-05-30 11:18:55', '2021-05-30 11:18:55'),
(67, 'خديجة مسبب', 'k.moussabbib', '$2y$10$bJnqvYEFTqOHAQ2WEOx3ReYbuva4Xe3mxM9bzcIff4rbBK5V8ShS2', 'user', 9, 1, '2021-05-30 11:19:11', '2021-05-30 11:19:11'),
(68, 'عائشة ادالقشي', 'a.idelkacha', '$2y$10$i9F72DICUZCAQ6D7B1BvkuXeBQx7d6GmpPxcAGIx8ubnQRAOWWOiW', 'user', 9, 1, '2021-05-30 11:19:27', '2021-05-30 11:19:27'),
(69, 'مراد السراج', 'm.essiraj', '$2y$10$fHTjNznj6FadhQRkiblqx.CVUx46MOrTezkJfLh/x4/ccvmArWRwO', 'user', 9, 1, '2021-05-30 11:19:44', '2021-05-30 11:19:44'),
(70, 'نجية الودناكسي', 'n.elwadnakssi', '$2y$10$jSi8dpCQNo0CbJJHGrxX2eHisz9R/gOst0JTXcz/PZyEyMtPwoQIa', 'user', 9, 1, '2021-05-30 11:21:20', '2021-05-30 11:21:20'),
(71, 'سعاد لعسكري', 's.lassakri', '$2y$10$JEq1Hh94RTce1l5eTVp9teCuuL//KV6uiQm6VMEBDUnYf.Ahn49Gu', 'user', 9, 1, '2021-05-30 11:22:34', '2021-05-30 11:22:34'),
(72, 'امينة الخطيري', 'a.khoteiri', '$2y$10$5PFlsKjVUY9VZo37YkrXyuWEuFwQ86O9PIA4NG4IBfJM1ycYqBrQC', 'user', 9, 1, '2021-05-30 11:22:49', '2021-05-30 11:22:49'),
(73, 'الطاهر سموط', 't.samout', '$2y$10$xOYPD.fV9rWfEzF7dMlJxueiaghae8QzATV190xPutyGW8A9M9m2u', 'user', 9, 1, '2021-05-30 11:23:02', '2021-05-30 11:23:02'),
(74, 'محمد بنبراهيم', 'm.benbrahim', '$2y$10$jZkbIdeZNkEf7Zp8Y3DFkOhXMYiG.cgeoWFcSQU9T5sMl2Crd5uD.', 'user', 9, 1, '2021-05-30 11:23:16', '2021-05-30 11:23:16'),
(75, 'سعاد اعشي', 's.ouachi', '$2y$10$RXv70yzsQKMrAF2MAGNWmO55iT/.AgMon7hT2JXw3uVnbuK1q5zQO', 'user', 9, 1, '2021-05-30 11:23:46', '2021-05-30 11:23:46'),
(76, 'لطيفة علوان', 'l.alouane', '$2y$10$sUCOMFHL367ENqr09YU5pu19nDUzL3Thu7kBDVgiYfFlSZekdn1bO', 'user', 9, 1, '2021-05-30 11:24:01', '2021-05-30 11:24:01'),
(77, 'نجية اغريس', 'n.aghriss', '$2y$10$2ldWOhmNQMBgcku2fPNNM..syyDxkQ6JKXM.cIOMRklKVgs1KIOBy', 'user', 9, 1, '2021-05-30 11:24:13', '2021-05-30 11:24:13'),
(78, 'ابتسام العمري', 'b.elamri', '$2y$10$yeHAdk7W5N1GklP/aOxopufYARWgyFNsGZieC/c6W.J5je88NFNUC', 'user', 9, 1, '2021-05-30 11:24:27', '2021-05-30 11:24:27'),
(79, 'عزيز فنتي', 'a.founti', '$2y$10$Bbr5Z0clJ0w63DwHvlrsGeInJqd7K2QLR8Yy6so12xvHy7/5OH5s.', 'user', 9, 1, '2021-05-30 11:24:50', '2021-05-30 11:24:50'),
(80, 'محمد بلحرة', 'm.belhora', '$2y$10$86HebAQUCV0.G30NRkv14.86JKO52ifWFLGOLvVoRfpZ.WR3os1T.', 'user', 9, 1, '2021-05-30 11:25:05', '2021-05-30 11:25:05'),
(81, 'يوسف ازيكو', 'y.azaykou', '$2y$10$Cuhe8p7iRylfR2U7Zwhcc.ynDWB6aE1vZyAkf1UONztQW8rkVeh02', 'user', 9, 1, '2021-05-30 11:25:22', '2021-05-30 11:25:22'),
(82, 'زهيرة النوري', 'z.nouri', '$2y$10$bMGVx6yCFodgXla7nMd63.aAZOWIuqiZcgPTm.WFWtjvoUe/8.aoq', 'user', 9, 1, '2021-05-30 11:25:36', '2021-05-30 11:25:36'),
(83, 'امينة البتني', 'm.elboutni', '$2y$10$WzkG08Xlylo6FiJ200cm9OiW0Cfalg1pEXPAOh7uGdjs1.vps0Jb6', 'user', 9, 1, '2021-05-30 11:25:51', '2021-05-30 11:25:51'),
(84, 'ثريا الهيماني', 't.haimani', '$2y$10$Zt2kqFSwa3Bw6gcHVGFzruU6UznjE3K9gSDyi4AJnOW7o3pexw6VW', 'user', 9, 1, '2021-05-30 11:26:04', '2021-05-30 11:26:04'),
(85, 'رشيد هنان', 'r.ahnane', '$2y$10$uNvLl1VciEW2JgHgIe4rNepQ4D2ho0O0UjwNZDxm1nRwTaTvPlIZi', 'chef', 9, 1, '2021-05-30 11:26:16', '2021-05-30 11:26:16'),
(86, 'حسن عبيدي', 'user', '$2y$10$U9wBDCFbFAT6nwe3ICYyy.x08RgQSRqH9Ifz8ACqrV0zmwPjTu3iK', 'user', 1, 1, '2021-05-30 11:51:23', '2021-05-31 17:56:50'),
(87, 'حسن عبيدي', 'chef', '$2y$10$PkzIeZQtzjBo61f7OZO4SudDiTjHCG1zZIxGYmWIQTznXpqIGXTN2', 'chef', 1, 1, '2021-05-30 11:51:49', '2021-05-30 11:51:49'),
(88, 'حسن عبيدي', 'admin', '$2y$10$NbYbojzP7nXkPsSy3y3w5uyTzv9iknMcUPNe1RNbKhW6QDox5Lb4i', 'admin', 0, 1, '2021-05-30 11:51:58', '2021-05-30 11:51:58');

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
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_chef_index` (`chef`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_service` (`id_service`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `referances`
--
ALTER TABLE `referances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `vacances`
--
ALTER TABLE `vacances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
