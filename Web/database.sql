-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  sam. 10 fév. 2018 à 11:28
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `deltaaer_openvirtua`
--

USE deltaaer_openvirtua;

-- --------------------------------------------------------

--
-- Structure de la table `Distribution`
--

CREATE TABLE `Distribution` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `path_local` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Distribution`
--

INSERT INTO `Distribution` (`id`, `name`, `path`, `path_local`, `description`) VALUES
(1, 'Debian 9', NULL, '', 'Your virgin Debian 9 machine.');

-- --------------------------------------------------------

--
-- Structure de la table `Hypervisor`
--

CREATE TABLE `Hypervisor` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL COMMENT '	',
  `description` text,
  `script` text COMMENT 'Script to install the hypervisor.',
  `available` tinyint(1) DEFAULT NULL,
  `pxe_eligible` tinyint(1) DEFAULT NULL,
  `Hypervisorcol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Hypervisor`
--

INSERT INTO `Hypervisor` (`id`, `name`, `description`, `script`, `available`, `pxe_eligible`, `Hypervisorcol`) VALUES
(1, 'Qemu', 'Qemu is the base hypervisor for creating your virtual machines.', 'apt-get install qemu -y', 0, 1, NULL),
(2, 'Docker_x86_x64', 'Use Docker to set-up your virtual machines on your non-ARM machine.', 'apt-get install \\\r\n     apt-transport-https \\\r\n     ca-certificates \\\r\n     curl \\\r\n     gnupg2 \\\r\n     software-properties-common\r\ncurl -fsSL https://download.docker.com/linux/$(. /etc/os-release; echo \"$ID\")/gpg | sudo apt-key add -\r\napt-key fingerprint 0EBFCD88\r\nsudo add-apt-repository \\\r\n   \"deb [arch=amd64] https://download.docker.com/linux/$(. /etc/os-release; echo \"$ID\") \\\r\n   $(lsb_release -cs) \\\r\n   stable\"\r\napt-get install docker-ce', 1, 0, NULL),
(3, 'LXC', 'LXC (Linux Containers) is an operating-system-level virtualization method for running multiple isolated Linux systems (containers) on a control host using a single Linux kernel.', 'apt-get install lxc', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Hypervisor_has_Distribution`
--

CREATE TABLE `Hypervisor_has_Distribution` (
  `id` int(11) NOT NULL,
  `Distribution_id` int(11) NOT NULL,
  `Hypervisor_id` int(11) NOT NULL,
  `details` text NOT NULL COMMENT 'JSON encoded. For exemple, Docker might need the URI to download some files.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Master`
--

CREATE TABLE `Master` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '	',
  `ip` varchar(15) DEFAULT NULL,
  `ssh_port` int(6) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `memory` int(16) DEFAULT NULL COMMENT '(In Mo)',
  `storage` int(16) DEFAULT NULL COMMENT '''(In Mo)''',
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Master`
--

INSERT INTO `Master` (`id`, `name`, `ip`, `ssh_port`, `username`, `password`, `memory`, `storage`, `User_id`) VALUES
(3, 'MyTest REMOTE', '51.15.198.55', 22, 'test', 'sNbYg51hpmk=', 2049, 41646, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Preseed`
--

CREATE TABLE `Preseed` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `script` text,
  `archive_path` varchar(45) DEFAULT NULL COMMENT 'Path of the archive if downloaded.',
  `archive_status` tinyint(1) DEFAULT NULL COMMENT '0 = not downloaded.\n1 = downloaded.',
  `Distribution_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Slave`
--

CREATE TABLE `Slave` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `mac` varchar(45) DEFAULT NULL,
  `gateway` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `memory` int(16) DEFAULT NULL COMMENT '	',
  `storage` int(16) DEFAULT NULL,
  `Master_id` int(11) NOT NULL,
  `Distribution_has_Hypervisor_id` int(11) NOT NULL,
  `Distribution_id` int(11) NOT NULL,
  `date` int(11) DEFAULT NULL COMMENT 'Date of creation.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Slave_has_Preseed`
--

CREATE TABLE `Slave_has_Preseed` (
  `id` int(11) NOT NULL,
  `Preseed_id` int(11) NOT NULL,
  `Slave_id` int(11) NOT NULL,
  `execution_order` int(11) DEFAULT NULL,
  `executed` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Token`
--

CREATE TABLE `Token` (
  `id` int(11) NOT NULL,
  `ids` varchar(255) DEFAULT NULL,
  `description` text COMMENT 'Subject of the token request.',
  `date` int(18) DEFAULT NULL COMMENT 'UNIX timestamp. Expiration each X seconds.',
  `expiration` int(18) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `User_ids` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Token`
--

INSERT INTO `Token` (`id`, `ids`, `description`, `date`, `expiration`, `ip`, `User_ids`) VALUES
(1, 'login_9fa811e3cba1824df4445d1ba3bce29e9ca91596', 'login', 1518171294, 1518173094, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(2, 'login_ac062599e02843f3af50bcbea168158ea0dea9c1', 'login', 1518171406, 1518173206, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(3, 'login_7f671eb625be93fb74deeba8e2e8d82573073d7e', 'login', 1518171471, 1518173271, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(4, 'login_2c71a729c75a64d4ad94ab1caf928cb74f1fb52f', 'login', 1518171487, 1518173287, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(5, 'login_b618d5eed1599f5cb81d88bc94c0e2381b9f8a56', 'login', 1518171575, 1518173375, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(6, 'login_9d5aeb2777f8dd5e042720eba2abdf7d10801cea', 'login', 1518171829, 1518173629, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(7, 'login_2e398aa9d6243330cbd9af52ae363eb2a44ebc3a', 'login', 1518171885, 1518173685, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(8, 'login_04242a50c5dbff3751a16a229cd5dce21b1fd771', 'login', 1518171894, 1518173694, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(9, 'login_74f8a5866d337b6da5801f3c608a14fed1ebdf63', 'login', 1518171951, 1518173751, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(10, 'login_bae5155fd2b9a23772043e5b9dee93e80c1a5897', 'login', 1518171964, 1518173764, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(11, 'login_502fade06abb2aef79486a25c48447b4dabd2d9f', 'login', 1518171981, 1518173781, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(12, 'login_74e4b2a0d645306943fc80deac23f365a70dba50', 'login', 1518172110, 1518173910, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(13, 'login_950ac56c44200d5b0423d62ca7fe3f5c856a5ce6', 'login', 1518172246, 1518174046, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(14, 'login_cf65ad38e56692218e4f01ad4e792d88d345ed22', 'login', 1518172401, 1518174201, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(15, 'login_c2b664f4b697708bc746c48a8fb47f11c9695a3a', 'login', 1518172419, 1518174219, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(16, 'login_a1eaaffc90b489e9987648a1fc0c70f4fcfa8955', 'login', 1518172451, 1518174251, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(17, 'login_c79751ba4464ae80749cdbdad5fe898fe23ade2d', 'login', 1518172464, 1518174264, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(18, 'login_f55b759a09b8764e78238a7947971058ea4b93f5', 'login', 1518172521, 1518174321, '163.5.245.101', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(19, 'login_422e818a5567a9701dcfb7d33e33dc6ec3fc2aa6', 'login', 1518191845, 1518193645, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(20, 'login_fc407f38911601014c4327d6768a69b4547a7582', 'login', 1518193988, 1518195788, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(21, 'login_2b1be49183c32339001a235211bbdc611d1a7626', 'login', 1518194257, 1518196057, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(22, 'login_fa98210d45a1c247b23951682c6cefd9997f47a7', 'login', 1518194376, 1518196176, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(23, 'login_e5f5f1eb6b693842e4f3a01272d0f9f36a1c5e2a', 'login', 1518194722, 1518196522, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(24, 'login_11faa5b1b5811f683cac0edde99ebfe6e64e2de9', 'login', 1518194830, 1518196630, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(25, 'login_72a314568103f7dddeb07b841c7190fb0bc311e2', 'login', 1518199122, 1518200922, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(26, 'login_a00415408357ec7096af2972d52a4e4a941aff2a', 'login', 1518199872, 1518201672, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(27, 'login_c98f5bb75700d1aa6ee6deb121f456dd39129302', 'login', 1518199985, 1518201785, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(28, 'login_a660e2b1e012b77d572fe997ae03a16345367192', 'login', 1518200054, 1518201854, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(29, 'login_4121d9e3019f6630d53155ef1e73ad1a1ac33aeb', 'login', 1518201333, 1518203133, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(30, 'login_c4b54a2d8528dc576cc6c23ec9e23db31bf5f132', 'login', 1518201435, 1518203235, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(31, 'login_bf7b35f676b0d9a7e6dbd8fc009f2cf01bd1e218', 'login', 1518201472, 1518203272, '109.11.40.48', '12676b2b8d07783e9585c71b0bd01b7c7897890b'),
(32, 'login_63bbcfb5871a51a30613392b062f8be4c61ebfe3', 'login', 1518271457, 1518273257, '163.5.245.124', '12676b2b8d07783e9585c71b0bd01b7c7897890b');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `ids` varchar(45) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL COMMENT '	',
  `email` varchar(255) DEFAULT NULL COMMENT '	',
  `phonenumber` varchar(20) DEFAULT NULL COMMENT '	'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `ids`, `username`, `password`, `email`, `phonenumber`) VALUES
(1, '12676b2b8d07783e9585c71b0bd01b7c7897890b', 'test', '959787779f361dab4b24e6ec204f07e2d97400fa', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Distribution`
--
ALTER TABLE `Distribution`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Hypervisor`
--
ALTER TABLE `Hypervisor`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Hypervisor_has_Distribution`
--
ALTER TABLE `Hypervisor_has_Distribution`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Master`
--
ALTER TABLE `Master`
  ADD PRIMARY KEY (`id`,`User_id`);

--
-- Index pour la table `Preseed`
--
ALTER TABLE `Preseed`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Slave`
--
ALTER TABLE `Slave`
  ADD PRIMARY KEY (`id`,`Master_id`,`Distribution_id`);

--
-- Index pour la table `Slave_has_Preseed`
--
ALTER TABLE `Slave_has_Preseed`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Token`
--
ALTER TABLE `Token`
  ADD PRIMARY KEY (`id`,`User_ids`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`,`ids`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Distribution`
--
ALTER TABLE `Distribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `Hypervisor`
--
ALTER TABLE `Hypervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Hypervisor_has_Distribution`
--
ALTER TABLE `Hypervisor_has_Distribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Master`
--
ALTER TABLE `Master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Preseed`
--
ALTER TABLE `Preseed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Slave`
--
ALTER TABLE `Slave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Token`
--
ALTER TABLE `Token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
