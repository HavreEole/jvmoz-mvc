-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 24 juin 2018 à 16:32
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mosaic`
--

-- --------------------------------------------------------

--
-- Structure de la table `mz_decrire`
--

DROP TABLE IF EXISTS `mz_decrire`;
CREATE TABLE IF NOT EXISTS `mz_decrire` (
  `numero` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero_PROJET` smallint(5) UNSIGNED NOT NULL,
  `numero_TAG` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `FK_DECRIRE_numero_PROJET` (`numero_PROJET`),
  KEY `FK_DECRIRE_numero_TAGS` (`numero_TAG`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mz_decrire`
--

INSERT INTO `mz_decrire` (`numero`, `numero_PROJET`, `numero_TAG`) VALUES
(0, 9, 25),
(1, 8, 10),
(2, 7, 25),
(3, 6, 11),
(4, 5, 22),
(5, 4, 29),
(6, 3, 28),
(7, 2, 4),
(8, 1, 30),
(9, 0, 18),
(10, 9, 22),
(11, 8, 8),
(12, 7, 28),
(13, 6, 18),
(14, 5, 4),
(15, 4, 30),
(16, 3, 11),
(17, 2, 29),
(18, 1, 8),
(19, 0, 28),
(20, 9, 11);

-- --------------------------------------------------------

--
-- Structure de la table `mz_depeindre`
--

DROP TABLE IF EXISTS `mz_depeindre`;
CREATE TABLE IF NOT EXISTS `mz_depeindre` (
  `numero` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero_PERSONNE` smallint(5) UNSIGNED NOT NULL,
  `numero_TAG` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `FK_DEPEINDRE_numero_PERSONNE` (`numero_PERSONNE`),
  KEY `FK_DEPEINDRE_numero_TAGS` (`numero_TAG`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mz_depeindre`
--

INSERT INTO `mz_depeindre` (`numero`, `numero_PERSONNE`, `numero_TAG`) VALUES
(1, 3, 6),
(2, 2, 1),
(3, 3, 1),
(4, 7, 15),
(5, 1, 12),
(6, 2, 4),
(7, 3, 14),
(8, 4, 1),
(9, 5, 7),
(10, 6, 2),
(11, 7, 3),
(12, 8, 4),
(13, 9, 5),
(14, 10, 8),
(15, 0, 9),
(16, 1, 10),
(18, 3, 12),
(19, 4, 13),
(20, 5, 14),
(41, 20, 19),
(51, 31, 28),
(52, 31, 10),
(53, 31, 6),
(54, 31, 14),
(55, 31, 15),
(56, 31, 25),
(57, 2, 11),
(59, 2, 17),
(64, 0, 7),
(65, 20, 4),
(66, 20, 30),
(67, 20, 18),
(68, 0, 18),
(76, 24, 30),
(77, 24, 14),
(78, 24, 27),
(79, 13, 18),
(80, 13, 3),
(81, 13, 21),
(82, 13, 19),
(83, 14, 4),
(84, 14, 30),
(85, 14, 26),
(86, 14, 0),
(87, 14, 20),
(88, 15, 22),
(89, 15, 0),
(90, 15, 24),
(91, 16, 12),
(92, 16, 9),
(93, 16, 13),
(94, 17, 15),
(95, 17, 2),
(96, 17, 16),
(97, 19, 30),
(98, 19, 12),
(99, 19, 5),
(100, 21, 30),
(101, 21, 8),
(102, 21, 20),
(103, 23, 28),
(104, 23, 14),
(105, 23, 6),
(106, 26, 28),
(107, 26, 25),
(108, 26, 29),
(109, 26, 10),
(110, 26, 6),
(111, 26, 15),
(112, 27, 30),
(113, 27, 11),
(114, 27, 26),
(115, 27, 0),
(116, 29, 30),
(117, 29, 11),
(118, 29, 8),
(119, 29, 21),
(120, 30, 8),
(121, 30, 29),
(122, 30, 5);

-- --------------------------------------------------------

--
-- Structure de la table `mz_personne`
--

DROP TABLE IF EXISTS `mz_personne`;
CREATE TABLE IF NOT EXISTS `mz_personne` (
  `numero` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` tinytext,
  `mdp` tinytext,
  `admin` tinyint(1) DEFAULT NULL,
  `ban` tinyint(1) DEFAULT NULL,
  `prenom` tinytext,
  `pseudo` tinytext,
  `nom` tinytext,
  `twitter` tinytext,
  `linkedin` tinytext,
  `website` tinytext,
  `description` text,
  `urlAvatar` tinytext,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mz_personne`
--

INSERT INTO `mz_personne` (`numero`, `email`, `mdp`, `admin`, `ban`, `prenom`, `pseudo`, `nom`, `twitter`, `linkedin`, `website`, `description`, `urlAvatar`) VALUES
(0, 'cami@vanille.com', '$2y$10$AQBmWvGjjZlIuOHa3u7hxO.gDhInGgvHVJ8SDan4HTtYjtdHYnzKi', 1, 0, 'Camille', '', 'Vanille', 'vanille', '', 'vanille.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ', 'vues/img/avatars/31.jpg'),
(1, 'pinpin@lapin.com', '$2y$10$yvLSOgjUp8eZZognO7rNPOlQwF3/oysWqx1eWD/dFl0j7sCpjciOy', 1, 0, 'Florïn', '', 'Zolli', 'pouet', 'pouet', 'pouet.com', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.', 'vues/img/avatars/1.jpg'),
(2, 'dot@dot.com', '$2y$10$2fuGSVf6yCP.5bi9NUHVpeTHRiZKsBpzoUd7HUDvnrjdXOnwC.7Ha', 0, 0, 'Blue', '', 'dotstar', 'blue', 'blue', 'blue.com', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'vues/img/avatars/2.jpg'),
(3, 'grrr@grrr.com', '$2y$10$kePsKjXmUk.arbv.z..yHuB1Br8SGQycjiOQcLxLYsf0owrEJOzLG', 0, 0, 'Teddy', '', 'Furbear', 'teddy', 'teddy', 'teddy.com', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.', 'vues/img/avatars/3.jpg'),
(4, 'picpicpic@ture.com', '$2y$10$YU1FNT6HV3rF.0XYLNlTuOA04O7T3P28nYCUUlOKMQYqDGSza7p72', 0, 0, 'Dan', 'PicCam', 'Greatcam', 'picpicpic', '', 'picpicpic.com', 'No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.', 'vues/img/avatars/4.jpg'),
(5, 'fly@fly.com', '$2y$10$00nLoDF1i7rtKBNUqFrM3OG7Gul1burESkjxv9HtMgj4G2Lna6/Ga', 0, 0, 'Marty', '', 'Fly', 'fly', '', 'fly.com', 'To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?', 'vues/img/avatars/5.jpg'),
(6, 'potpotpot@pot.com', '$2y$10$ESUgYtGVeVHsSxsI.Ijshe53KFKAaQwPgqwdKqtUe4Y6kwljbKQV.', 0, 0, 'Potter', '', 'Coolbus', 'potpotpot', '', 'potpotpot.com', 'But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 'vues/img/avatars/6.jpg'),
(7, 'lalala@la.com', '$2y$10$4oYoW46xK1dnPyoKqEtuBunC5kv7Szi8fnXLdtsnxjeWMG562Jt2S', 0, 0, '', '', 'Lace', 'lalala', 'lalala', '', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.', 'vues/img/avatars/7.jpg'),
(8, 'garden@garden.com', '$2y$10$od1ClYcDWwl3tR/vfN8VZ.OSCnI30FM1U9Gb9TNyGscmZUu7Na3gy', 0, 0, 'Green', 'PrettyGarden', 'Garden', '', '', '', 'As our world becomes more and more connected, opportunities to work together to create new forms of art and utopian social systems become greater and greater. This interconnectedness is also overwhelming and shocking. We are increasingly exposed to each others’ suffering – suffering that has previously existed but was largely ignored.', 'vues/img/avatars/8.jpg'),
(9, 'lili@cena.com', '$2y$10$8igVRHFrRZGbX9GY4.kCY.QWvZkQU5V19jBD7KQ5W349yAc7rQmRG', 0, 0, 'Light', '', 'Cena', 'cena', '', '', 'In western culture all individuals are assumed to be self-interested; all shock is assumed to produce a fight-or-flight response; all narratives are assumed to require conflict; all villains are assumed to be evil; all social exchange, politics, and even the natural world are assumed to be driven by competition and won by domination. These are false, incomplete assumptions.', 'vues/img/avatars/9.jpg'),
(10, 'grass@grass.com', '$2y$10$Srro.m/SufjO6Q9G.fg5Yu3AE4V3kVLGWiKxFB8zvvSvntqaQnHYC', 0, 1, '', 'WideOutdoor', 'Outdoor', 'outdoor', '', '', 'The stress theory of tend-and-befriend shows us that individuals are not purely self-interested and that shock does not only produce brutality or fear. We posit that the antidote to shock is not to dominate, not to disconnect, not to continue to ignore, but to take collective responsibility. The antidote for shock is to care.', 'vues/img/avatars/10.jpg'),
(11, 'miam@miam.com', '$2y$10$unp8W.f1AwoeWCthh/wVEOSfc5d.CbaiQEfUi6q8CZrGbVPxhEQkO', 0, 1, 'Adorable', 'CuteParty', 'Party', '', 'adorable', 'adorable.com', 'Care builds understanding, action, and connection. Care provides insight, healing and agency. Systems built on care are stronger than those built on non-consensual domination and fear. We seek mutually beneficial outcomes and utopian futures.', 'vues/img/avatars/11.jpg'),
(12, 'o@cean.com', '$2y$10$2Lj4DBEMtx9A7p2Dk7NP9.zCSVzLn5vC8gDHKWO86Pdpw3WeYNZ4i', 0, 0, 'Karin', '', 'Ocean', '', 'ocean', 'ocean.com', 'Video games are a natural place to explore and to prototype systems of care. We assert that video games have not only the ability but also the responsibility to explore care, systems of care, and utopian futures.', 'vues/img/avatars/12.jpg'),
(13, 'chap@pie.com', '$2y$10$hiAddQ3fDVJh.jtJUwxuLOnod5oj9Qhwt2M9T3HwU8uUqZB/4izkO', 0, 0, 'Chappie', 'MountainHat', 'Hat', 'chappie', '', '', 'We are not individual actors, our paths are not linear, and life is not a zero-sum game. Video games that provide fun through shock, fight-or-flight mechanics, conflict, power fantasies, dehumanized villains, zero-sum outcomes, and other expressions of non-consensual domination are incomplete expressions of what it is to be human.', 'vues/img/avatars/13.jpg'),
(14, 'xxx@xxx.com', '$2y$10$QVNQIdBGgit6eeYF9RMDouqhm0Oa/YWE9jKDLskRZayMEqiVHMYSi', 0, 0, 'Blanche', 'Whitey', 'Glasses', '', '', 'blanche.com', 'Carewave is a utopian movement of artworks that care. It is a movement of creators, audiences, and artworks taking responsibility for the power and influence we have as media creators and curators and collectively using this power to propagate visions of great worlds, where care is woven throughout our social structures and cultures.', 'vues/img/avatars/14.jpg'),
(15, 'pink@pink.com', '$2y$10$/M8SUyna.CWsT9OaIJYAGOKk7lR2nFezgm0HSXOqDF5jzIJDrwlTG', 0, 0, 'Rose', '', 'Brown', '', 'pink', '', 'Carewave artworks are made in any medium: Carewave artworks are interactive or non-interactive or blur the lines between interactivity and non-interactivity. Carewave grew out of video games and has a foundation in connectedness, interactivity, and systems.', 'vues/img/avatars/15.jpg'),
(16, 'point@glasses.com', '$2y$10$/qsxSbSfvq.ABVRSkhqI1.NfLItZ7t/4JZAGTbm/Os9PKNgwpWccC', 0, 0, 'Dot', '', 'Curly', '', '', '', 'Utopia lies at the horizon. When I draw nearer by two steps, it retreats two steps. If I proceed ten steps forward, it swiftly slips ten steps ahead. No matter how far I go, I can never reach it. What, then, is the purpose of utopia? It is to cause us to advance. (Eduardo Galeano)', 'vues/img/avatars/16.jpg'),
(17, 'denise@mask.com', '$2y$10$1Ofh7wd/Ykn.h3uPWnSXGucnvO9Auo.HXcebaetgxIgcFx9n0Ks0G', 0, 0, 'Venicia', '', 'Mask', 'venicia', 'venicia', 'venicia.com', 'This regulator is code--the software and hardware that make cyberspace as it is. This code, or architecture, sets the terms on which life in cyberspace is experienced. It determines how easy it is to protect privacy, or how easy it is to censor speech. It determines whether access to information is general or whether information is zoned. It affects who sees what, or what is monitored.', 'vues/img/avatars/17.jpg'),
(18, 'large@town.com', '$2y$10$Kkqy3jYxFGAgUDQE1zHLKOcOJOiVJW132ZVWsyLC/r1SPGusx.7na', 0, 0, 'Secret', 'BigTown', 'City', 'bigcity', '', '', 'This regulation is changing. The code of cyberspace is changing. And as this code changes, the character of cyberspace will change as well. Cyberspace will change from a place that protects anonymity, free speech, and individual control, to a place that makes anonymity harder, speech less free, and individual control the province of individual experts only.', 'vues/img/avatars/18.jpg'),
(19, 'jiji@jean.com', '$2y$10$tLQqdvtnCvQAg6FprYqf0.l5WrzbEXIMnLBic2jpSgT2U9bRm1t/a', 0, 0, 'Jean', 'JeanJeanne', 'Graph', '', '', '', 'The basic code of the Internet implements a set of protocols called TCP/IP. These protocols enable the exchange of data among interconnected networks. This exchange occurs without the networks knowing the content of the data, or without any true idea of who in real life the sender of a given bit of data is. This code is neutral about the data, and ignorant about the user.', 'vues/img/avatars/19.jpg'),
(20, 'lili@dev.com', '$2y$10$gvsDM7zJaysHPeJ7bCj9WO13wp.eo5FGkfzrsww42r/J/uK6/kHO6', 0, 0, 'Dev', 'Little#Dev', 'Lili', 'lili', 'liliDev', '', 'But no thought is more dangerous to the future of liberty in cyberspace than this faith in freedom guaranteed by the code. For the code is not fixed. The architecture of cyberspace is not given. Unregulability is a function of code, but the code can change. Other architectures can be layered onto the basic TCP/IP protocols, and these other architectures can make behavior on the Net fundamentally regulable. Commerce is building these other architectures; the government can help; the two together can transform the character of the Net. They can and they are.', 'vues/img/avatars/20.jpg'),
(21, 'sourire@beard.com', '$2y$10$3X76.9aBezy1SgnQVEyjlu9g6ID3SsYVMVc6xV0yWmI3hq1eauBi2', 0, 0, 'Smile', '', 'Whitebeard', 'smile', '', 'smile.com', 'Thus whether the certification architecture that emerges protects privacy depends upon the choices of those who code. Their choices depend upon the incentives they face. If protecting privacy is not an incentive--if the market has not sufficiently demanded it and if law has not, either--then this code will not provide it.', 'vues/img/avatars/21.jpg'),
(22, 'plage@wave.com', '$2y$10$vOvn5dA0bi1OiHtFLp6wP.aGiB4BuRj4w8YZF4tGtbOzpoufwzjM6', 0, 0, 'Wave', '', 'Surfer', 'wave', '', '', 'Our choice is not between \"regulation\" and \"no regulation.\" The code regulates. It implements values, or not. It enables freedoms, or disables them. It protects privacy, or promotes monitoring. People choose how the code does these things. People write the code. Thus the choice is not whether people will decide how cyberspace regulates. People--coders--will. The only choice is whether we collectively will have a role in their choice--and thus in determining how these values regulate--or whether collectively we will allow the coders to select our values for us.', 'vues/img/avatars/22.jpg'),
(23, 'ponponpon@pont.com', '$2y$10$oSIKIW.3X22vryUeid/bz.oVqtKUwdAi2U0PePM2e2aTf8wUWxNIC', 0, 0, 'Bridge', 'OceanBridge', 'Mister', '', 'mister', '', '\"Le code détermine ce qui est possible ou impossible, qui a accès à quoi. Celles et ceux qui l\'écrivent ont la responsabilité de prendre les besoins des autres en compte.\" cf Lawrence Lessig, Code is Law', 'vues/img/avatars/23.jpg'),
(24, 'ella@ella.com', '$2y$10$oKbW0qDkyf1karbZORcXe.Jt7K37Pgudn2hxLVrpjZG//ZFXsia6q', 0, 0, 'Two', '', 'Ombrella', 'ombrella', '', 'ombrella.com', '\"If you test your system on people who look like you and it works fine then you\'re never going to know that there\'s a problem\" Joy Buolamwini', 'vues/img/avatars/24.jpg'),
(25, 'yum@yum.com', '$2y$10$KETTCjlG0XoAGcCBusaiEO1Zu6uAuoWg967sN3oLspas9od3b.8Vu', 0, 0, 'Chill', '', 'Coffee', '', '', '', 'There is growing concern that many of the algorithms that make decisions about our lives - from what we see on the internet to how likely we are to become victims or instigators of crime - are trained on data sets that do not include a diverse range of people.', 'vues/img/avatars/25.jpg'),
(26, 'sky@sky.com', '$2y$10$zSDjItTYXVU1lVqV/8Eyu.mJQ8tCJVRD9vJkv0dHvwrdRTgUPHtzG', 0, 0, 'Will', 'BlondySky', 'Blondy', '', '', 'will.com', '\"I\'m now starting to think, are we testing to make sure these systems work on older people who aren\'t as well represented in the tech space? Are we also looking to make sure these systems work on people who might be overweight, because of some of the people who have reported it? It is definitely hitting a chord.\"', 'vues/img/avatars/26.jpg'),
(27, 'ray@ray.com', '$2y$10$TS/ySXiLs/octBSdp.6gYuBCaP.Qgn/Ox9L8e132cLzaoD2fL97JS', 0, 0, 'Ray', 'RayStripes', 'Yellow', 'ray', '', 'ray.com', 'In other words the concern has been that the bias, or skew, in decision-making will shift from things we recognise as human prejudice to things we no longer recognise and therefore cannot detect - because we will take the decision-making for granted.', 'vues/img/avatars/27.jpg'),
(28, 'fleur@fleur.com', '$2y$10$hlPn8u3ai1bz3wAIJolKlundzN1kO/JR290vvMoZjgaLu0WQahU/y', 0, 0, 'Petit', '', 'Bouquet', '', 'forest', 'forest.com', 'Any technology that we create is going to reflect both our aspirations and our limitations', 'vues/img/avatars/28.jpg'),
(29, 'sand@sand.com', '$2y$10$Rv2GXD5kFuHE55QWEWhH6uvsNrJldCsiXaO1.DnItn6cQ61n2ER8u', 0, 0, 'Sand', '', 'Marine', '', '', '', 'If we are limited when it comes to being inclusive that\'s going to be reflected in the robots we develop or the tech that\'s incorporated within the robots.', 'vues/img/avatars/29.jpg'),
(30, 'lili@mana.com', '$2y$10$KkLCGg1h11ozw9SGX1RlQOxXunBQGkMS/XD/X1RRFNAJc1yX/96tO', 0, 0, 'Lila', '', 'Manager', '', '', '', 'Ms Buolamwini says she is hopeful that the situation will improve if people are more aware of the potential problems.', 'vues/img/avatars/30.jpg'),
(31, 'toto@toto.com', '$2y$10$eROx04qJWNHBR.mXr8qBBOiC15dWLENjKxlTXCtytnhf6i8WD4BkO', 0, 1, 'Tototo', '', 'Poireau', 'totoyo', '', '', 'J\'aime les melons et les bonbons, ron ron petit patapon !', 'vues/img/avatars/0.jpg'),
(32, 'aloe@vera.fr', '$2y$10$5EJW4rROoX/jzJKCXaqVc.Kl6lrYBb.wiK8YH2L9RqBoS.Y1ut/32', 1, 0, 'Aloe', '', 'Vera', NULL, NULL, NULL, 'Des plantes des plantes des plantes ! ♥', 'vues/img/avatars/0.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `mz_projet`
--

DROP TABLE IF EXISTS `mz_projet`;
CREATE TABLE IF NOT EXISTS `mz_projet` (
  `numero` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mdp` tinytext,
  `nom` tinytext,
  `studio` tinytext,
  `description` text,
  `dateSortie` date DEFAULT NULL,
  `website` tinytext,
  `urlVisuel` tinytext,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mz_projet`
--

INSERT INTO `mz_projet` (`numero`, `mdp`, `nom`, `studio`, `description`, `dateSortie`, `website`, `urlVisuel`) VALUES
(0, 'RfF1_&2&NtWZspbxgMTo', 'LOL', 'Studio Lol', 'Un jeu où on rigole énormément.', '2001-01-01', 'lololol.com', 'vues/img/visuels/0.jpg'),
(1, 'IchPr0UzdE&NpQsCXvik', 'Libraire', 'Raplapla', 'Vous travaillez dans une bibliothèque.', '2001-01-01', 'pouet.com', 'vues/img/visuels/1.jpg'),
(2, '_13NmJld2PC&BLn&OI1w', 'Lapins Attaque', '5 Jours', 'C\'est peut-être un piège avec des bruits bizarres...', '2001-01-01', 'nini.com', 'vues/img/visuels/2.jpg'),
(3, 'bnp_wK&OhESvHBulR8P&', 'Bêtes Apparat', 'Boulanger', 'C\'est pas gagné mais c\'est sympa d\'essayer !', '2001-01-01', 'gagaga.com', 'vues/img/visuels/3.jpg'),
(4, 'sl1H&eXr_M6&SQ1y_xTL', 'Nombres on fire', 'Pierre', 'Attention, il ne faut pas partir en mission en solitaire.', '2001-01-01', 'toto.com', 'vues/img/visuels/4.jpg'),
(5, 'L_qWb_&sMiYStDVgr_&o', 'Hôtel Castor', 'Heures', 'Comme c\'est joli il y a des rondins et c\'est gentil !', '2001-01-01', 'tutu.com', 'vues/img/visuels/5.jpg'),
(6, '_iTUPJW&Og39KeqXvMn&', 'Salopette Nocturne', 'Vampire', 'La spéléologie pour les chauve-souris.', '2001-01-01', 'yop.com', 'vues/img/visuels/6.jpg'),
(7, '7GnWQd6BRJHyYk&rhNqi', 'Lumière Bonsoir', 'Repos', 'C\'est très tranquille.', '2001-01-01', 'hiphip.com', 'vues/img/visuels/7.jpg'),
(8, '&v93p5WfFXij1n&_NHsh', 'Poisson ici famille', 'Ocean', 'Un jeu avec des familles de poissons. Des fois ils ont des points communs, mais faut pas le dire.', NULL, '', 'vues/img/visuels/8.jpg'),
(9, 'X4pNehgDrRMxwV_KbZzd', 'Patience', 'Reflexion', 'Ca s\'appelle Patience mais en fait c\'est vachement rapide, c\'est un concept.', '2018-06-29', 'krr.com', 'vues/img/visuels/9.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `mz_tag`
--

DROP TABLE IF EXISTS `mz_tag`;
CREATE TABLE IF NOT EXISTS `mz_tag` (
  `numero` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` tinytext,
  `nbUsages` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mz_tag`
--

INSERT INTO `mz_tag` (`numero`, `nom`, `nbUsages`) VALUES
(0, 'Freelance', 3),
(1, 'Journalisme', 3),
(2, 'Narrative Design', 2),
(3, 'Community Management', 2),
(4, 'Unity', 9),
(5, 'Management', 3),
(6, 'Graphisme', 5),
(7, 'Game Design', 2),
(8, 'Web', 9),
(9, 'Level Design', 2),
(10, '3D', 5),
(11, 'Game Jam', 9),
(12, 'Lead', 4),
(13, 'Level Building', 1),
(14, 'Need Job', 5),
(15, 'Illustration', 4),
(16, 'Concept Art', 1),
(17, 'Chroniques', 1),
(18, 'Youtube', 7),
(19, 'Streaming', 1),
(20, 'Recherche', 2),
(21, 'Enseignement', 2),
(22, 'Musique', 4),
(24, 'Sound Design', 1),
(25, 'Animation', 6),
(26, 'Expat', 2),
(27, 'Tool Dev', 1),
(28, '2D', 10),
(29, 'Indie', 7),
(30, 'Developpement', 12);

-- --------------------------------------------------------

--
-- Structure de la table `mz_travailler`
--

DROP TABLE IF EXISTS `mz_travailler`;
CREATE TABLE IF NOT EXISTS `mz_travailler` (
  `numero` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero_PERSONNE` smallint(5) UNSIGNED NOT NULL,
  `numero_PROJET` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `FK_TRAVAILLER_numero_PERSONNE` (`numero_PERSONNE`),
  KEY `FK_TRAVAILLER_numero_PROJET` (`numero_PROJET`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mz_travailler`
--

INSERT INTO `mz_travailler` (`numero`, `numero_PERSONNE`, `numero_PROJET`) VALUES
(1, 5, 2),
(2, 7, 4),
(3, 12, 6),
(4, 5, 8),
(6, 7, 2),
(7, 2, 4),
(8, 11, 6),
(10, 19, 1),
(11, 8, 3),
(12, 17, 5),
(13, 6, 7),
(15, 4, 1),
(16, 3, 3),
(17, 2, 5),
(18, 1, 7),
(24, 4, 0),
(25, 9, 0),
(26, 14, 2),
(27, 15, 1),
(28, 16, 2),
(29, 17, 3),
(30, 2, 8),
(31, 0, 8),
(44, 20, 9),
(45, 24, 6),
(52, 0, 9);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `mz_decrire`
--
ALTER TABLE `mz_decrire`
  ADD CONSTRAINT `FK_DECRIRE_numero_PROJET` FOREIGN KEY (`numero_PROJET`) REFERENCES `mz_projet` (`numero`),
  ADD CONSTRAINT `FK_DECRIRE_numero_TAGS` FOREIGN KEY (`numero_TAG`) REFERENCES `mz_tag` (`numero`);

--
-- Contraintes pour la table `mz_depeindre`
--
ALTER TABLE `mz_depeindre`
  ADD CONSTRAINT `FK_DEPEINDRE_numero_PERSONNE` FOREIGN KEY (`numero_PERSONNE`) REFERENCES `mz_personne` (`numero`),
  ADD CONSTRAINT `FK_DEPEINDRE_numero_TAGS` FOREIGN KEY (`numero_TAG`) REFERENCES `mz_tag` (`numero`);

--
-- Contraintes pour la table `mz_travailler`
--
ALTER TABLE `mz_travailler`
  ADD CONSTRAINT `FK_TRAVAILLER_numero_PERSONNE` FOREIGN KEY (`numero_PERSONNE`) REFERENCES `mz_personne` (`numero`),
  ADD CONSTRAINT `FK_TRAVAILLER_numero_PROJET` FOREIGN KEY (`numero_PROJET`) REFERENCES `mz_projet` (`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
