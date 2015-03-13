CREATE TABLE `User` (
`id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `username` varchar(16) NOT NULL,
  `firstName` varchar(16) NOT NULL,
  `lastName` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `lastConnect` dateTime,
  `pathImg` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;# MySQL a retourné un résultat vide (aucune ligne).



INSERT INTO `User` (`id`, `password`, `salt`, `roles`, `username`,  `firstName`, `lastName`, `email`) VALUES
(1, 'aacd64fcca4c0f430e7f30efbb56b7fc', '37d9014b7d5dcf4', 'a:1:{i:0;s:9:"ROLE_USER";}', 'admin',  'admin', 'admin', 'yunai39@gmail.com'),
(2, 'd12274e48634273218b99c6aae19f409', 'abe259f75230a24', 'a:1:{i:0;s:9:"ROLE_USER";}', 'Lola',  'lola', 'lola', 'lola@gmail.com'),
(3, '044ed08d5c8a520df909d35fd89da42b', 'd8c364d3faeca78', 'a:1:{i:0;s:9:"ROLE_USER";}', 'Lola',  'lola', 'lola', 'lola@gmail.com');# 3 lignes affectées.


--
-- Index pour les tables exportées
--

--
-- Index pour la table `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`id`);# MySQL a retourné un résultat vide (aucune ligne).


--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;# 3 lignes affectées.
