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

INSERT INTO `Hypervisor` (`id`, `name`, `description`, `script`, `available`, `pxe_eligible`) VALUES
(1, 'Qemu', 'Qemu is the base hypervisor for creating your virtual machines.', 'apt-get install qemu -y', 0, 1),
(2, 'Docker_x86_x64', 'Use Docker to set-up your virtual machines on your non-ARM machine.', 'apt-get install \\\r\n     apt-transport-https \\\r\n     ca-certificates \\\r\n     curl \\\r\n     gnupg2 \\\r\n     software-properties-common\r\ncurl -fsSL https://download.docker.com/linux/$(. /etc/os-release; echo \"$ID\")/gpg | sudo apt-key add -\r\napt-key fingerprint 0EBFCD88\r\nsudo add-apt-repository \\\r\n   \"deb [arch=amd64] https://download.docker.com/linux/$(. /etc/os-release; echo \"$ID\") \\\r\n   $(lsb_release -cs) \\\r\n   stable\"\r\napt-get install docker-ce', 1, 0),
(3, 'LXC', 'LXC (Linux Containers) is an operating-system-level virtualization method for running multiple isolated Linux systems (containers) on a control host using a single Linux kernel.', 'apt-get install lxc', 0, 0),
(4, 'PXE', 'Create a VM that boots via a PXE custom script.', NULL, 0, 1);

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
