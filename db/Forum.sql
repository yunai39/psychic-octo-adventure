

--
-- Base de données :  `octo`
--

-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

CREATE TABLE `Message` (
`id` int(11) NOT NULL,
  `contentMessage` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateMessage` datetime NOT NULL,
  `lastUpdateMessage` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `Message`
--

INSERT INTO `Message` (`id`, `contentMessage`, `dateMessage`, `lastUpdateMessage`, `id_user`, `id_topic`) VALUES
(2, 'Permier mss', '2015-03-15 00:00:00', '2015-03-15 00:00:00', 1, 1),
(3, 'Deuxieme message', '2015-03-18 00:00:00', '2015-03-19 00:00:00', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `SubForum`
--

CREATE TABLE `SubForum` (
`id` int(11) NOT NULL,
  `nameForum` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_parentForum` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `SubForum`
--

INSERT INTO `SubForum` (`id`, `nameForum`, `description`, `id_parentForum`) VALUES
(2, 'Information Géneral', 'Ici on explique ', NULL),
(3, 'Web', 'Des informations sur le web', NULL),
(4, 'Client', '', 3),
(5, 'Serveur', '', 3);

-- --------------------------------------------------------

--
-- Structure de la table `Topic`
--

CREATE TABLE `Topic` (
`id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateTopic` datetime NOT NULL,
  `lastUpdateTopic` datetime NOT NULL,
  `contentMessage` text NOT NULL,
  `id_forum` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Topic`
--

INSERT INTO `Topic` (`id`, `title`, `dateTopic`, `lastUpdateTopic`, `contentMessage`, `id_forum`, `id_user`) VALUES
(1, 'Bonjour les enfants ', '2015-03-15 00:00:00', '2015-03-15 00:00:00', 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L''avantage du Lorem Ipsum sur un texte générique comme ''Du texte. Du texte. Du texte.'' est qu''il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour ''Lorem Ipsum'' vous conduira vers de nombreux sites qui n''en sont encore qu''à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d''y rajouter de petits clins d''oeil, voire des phrases embarassantes).\r\n ', 3, 1),
(2, 'Azert', '2015-03-17 00:00:00', '2015-03-17 00:00:00', 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L''avantage du Lorem Ipsum sur un texte générique comme ''Du texte. Du texte. Du texte.'' est qu''il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour ''Lorem Ipsum'' vous conduira vers de nombreux sites qui n''en sont encore qu''à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d''y rajouter de petits clins d''oeil, voire des phrases embarassantes).\r\n ', NULL, 3);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Message`
--
ALTER TABLE `Message`
 ADD PRIMARY KEY (`id`), ADD KEY `id_topic` (`id_topic`), ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `SubForum`
--
ALTER TABLE `SubForum`
 ADD PRIMARY KEY (`id`), ADD KEY `id_parentForum` (`id_parentForum`);

--
-- Index pour la table `Topic`
--
ALTER TABLE `Topic`
 ADD PRIMARY KEY (`id`), ADD KEY `id_forum` (`id_forum`), ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Message`
--
ALTER TABLE `Message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `SubForum`
--
ALTER TABLE `SubForum`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Topic`
--
ALTER TABLE `Topic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Message`
--
ALTER TABLE `Message`
ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_topic`) REFERENCES `Topic` (`id`),
ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `User` (`id`);

--
-- Contraintes pour la table `SubForum`
--
ALTER TABLE `SubForum`
ADD CONSTRAINT `subforum_ibfk_1` FOREIGN KEY (`id_parentForum`) REFERENCES `SubForum` (`id`);

--
-- Contraintes pour la table `Topic`
--
ALTER TABLE `Topic`
ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`id_forum`) REFERENCES `SubForum` (`id`),
ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `User` (`id`);
