

--
-- Base de données :  `octo`
--

-- --------------------------------------------------------

--
-- Structure de la table `Membre`
--

CREATE TABLE `Membre` (
`id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `login` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Membre`
--

INSERT INTO `Membre` (`id`, `nom`, `prenom`, `login`) VALUES
(1, 'ds', 'dsa', 'da'),
(3, 'lola', 'zaza', 'a');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Membre`
--
ALTER TABLE `Membre`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Membre`
--
ALTER TABLE `Membre`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;