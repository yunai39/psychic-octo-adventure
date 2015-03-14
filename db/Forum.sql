
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_forum` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Index pour les tables exportées
--

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
-- AUTO_INCREMENT pour la table `SubForum`
--
ALTER TABLE `SubForum`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Topic`
--
ALTER TABLE `Topic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

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
