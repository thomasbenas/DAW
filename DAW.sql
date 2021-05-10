-- Adminer 4.8.0 MySQL 8.0.23-0ubuntu0.20.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `DAW`;
CREATE DATABASE `DAW` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `DAW`;

DELIMITER ;;

CREATE PROCEDURE `delete_difficulty`(dft INTEGER UNSIGNED)
BEGIN
	DECLARE previous_dft INTEGER UNSIGNED;

	SELECT previous
		INTO previous_dft
		FROM difficulties
		WHERE id = dft;

	IF
		previous_dft IS NOT NULL
	THEN
		UPDATE abilities
			SET difficulty = previous_dft
			WHERE difficulty = dft;
		UPDATE lessons
			SET difficulty = previous_dft
			WHERE difficulty = dft;
		UPDATE difficulties
			SET previous = previous_dft
			WHERE previous = dft;
		DELETE FROM difficulties
			WHERE id = dft;
	END IF;
END;;

CREATE PROCEDURE `insert_difficulty`(d_name VARCHAR(255), d_previous INTEGER UNSIGNED)
BEGIN
	DECLARE first_dft INTEGER UNSIGNED;
	DECLARE to_update INTEGER UNSIGNED;
	DECLARE new_dft INTEGER UNSIGNED;
	DECLARE bool TINYINT;
	SET bool = -1;

	IF
		d_previous IS NULL
	THEN
		SELECT id
			INTO first_dft
			FROM difficulties
			WHERE previous IS NULL;

		IF
			first_dft IS NOT NULL
		THEN
			SELECT id
				INTO d_previous
				FROM difficulties AS a
				WHERE NOT EXISTS
					(SELECT previous
						FROM difficulties AS b
						WHERE a.id = b.previous);
		END IF;
	ELSE
		SET bool = 1;
		SELECT id
			INTO to_update
			FROM difficulties
			WHERE previous = d_previous;
	END IF;

	INSERT INTO difficulties (name, previous)
		VALUES (d_name, d_previous);

	IF
		bool = 1
	THEN
		SELECT id
			INTO new_dft
			FROM difficulties
			ORDER BY id DESC
			LIMIT 1;
		UPDATE difficulties
			SET previous = new_dft
			WHERE id = to_update;
	END IF;
END;;

DELIMITER ;

DROP TABLE IF EXISTS `QCM`;
CREATE TABLE `QCM` (
  `linkXML` varchar(255) NOT NULL,
  `date_published` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` int unsigned NOT NULL,
  PRIMARY KEY (`category`),
  UNIQUE KEY `linkXML` (`linkXML`),
  CONSTRAINT `QCM_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `QCM` (`linkXML`, `date_published`, `category`) VALUES
('web.xml',	'2021-05-01 14:01:50',	2);

DROP TABLE IF EXISTS `abilities`;
CREATE TABLE `abilities` (
  `user` int unsigned NOT NULL,
  `category` int unsigned NOT NULL,
  `difficulty` int unsigned DEFAULT NULL,
  PRIMARY KEY (`user`,`category`),
  KEY `category` (`category`),
  KEY `difficulty` (`difficulty`),
  CONSTRAINT `abilities_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `abilities_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `abilities_ibfk_3` FOREIGN KEY (`difficulty`) REFERENCES `difficulties` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `abilities` (`user`, `category`, `difficulty`) VALUES
(6,	1,	1),
(6,	2,	1),
(6,	3,	1),
(6,	4,	1),
(1,	2,	3),
(5,	2,	3);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `name`, `description`, `slug`) VALUES
(1,	'test',	'Ceci est un test',	'test'),
(2,	'web',	'',	'web'),
(3,	'algo',	'',	'algo'),
(4,	'bdd',	'',	'bdd'),
(5,	'Logique',	'Programmation logique',	'logique');

DROP TABLE IF EXISTS `chapters`;
CREATE TABLE `chapters` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `lesson` int unsigned NOT NULL,
  `ch_number` tinyint unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lessons_ch_number_UNIQUE` (`lesson`,`ch_number`),
  CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `chapters` (`id`, `lesson`, `ch_number`, `name`, `content`, `slug`) VALUES
(15,	26,	1,	'Introduction au prolog',	'Le prolog est un langage...\r\n    ',	'Intro-prolog'),
(16,	26,	2,	'Lambda calcul',	'Ceci est un cours sur le lambda calcul.',	'lambda-calcul'),
(17,	30,	1,	'Découvrez les bases de HTML5',	'Nous allons découvrir les bases du langage HTML et enregistrer notre toute première page web !',	'html-bases'),
(18,	30,	2,	'Découvrez des fonctionnalités évoluées',	'Nous allons commencer par construire des tableaux basiques, puis nous les complexifierons au fur et à mesure.',	'html-evo'),
(19,	31,	1,	'Mettez en forme vos pages avec CSS',	'Dans ce premier chapitre sur le CSS, nous allons voir la théorie sur le CSS.',	'CSS-bases'),
(20,	31,	2,	'Mettez en page votre site',	'Si nos pages web ne ressemblent pas encore tout à fait aux sites web que nous connaissons, c\'est qu\'il nous manque les connaissances nécessaires pour faire la mise en page.',	'CSS-evo'),
(21,	32,	1,	'Déclarez des variables et modifiez leurs valeurs',	'L\'objectif d\'un programme informatique est de faire quelque chose avec des données. Votre programme utilise des variables pour enregistrer et manipuler ces données. ',	'javascript-base'),
(22,	32,	2,	'Regroupez vos données avec les tableaux et les objets',	'Il existe un type pour cela en JavaScript : le tableau (array).',	'javascript-evo'),
(23,	33,	1,	'Travaillez sur les fonctions',	'Une fonction est un bloc de code auquel vous attribuez un nom. Quand vous appelez cette fonction, vous exécutez le code qu\'elle contient.',	'javascript-a-bases'),
(24,	33,	2,	'Définissez des méthodes d\'instance et des propriétés',	'Maintenant que vous avez commencé à découvrir les fonctions, vous pouvez ajouter des méthodes d\'instance à ces classes, pour augmenter leur puissance et leur utilité.',	'javascript-a-evo'),
(25,	27,	1,	'Découvrez le fonctionnement d\'un site écrit en PHP',	'Ce qui fait le succès du Web aujourd\'hui, c\'est à la fois sa simplicité et sa facilité d\'accès. Un internaute lambda n\'a pas besoin de savoir « comment ça fonctionne derrière ». Et heureusement pour lui.',	'php-bases'),
(26,	27,	2,	'Écrivez votre premier script',	'Vous allez en particulier comprendre comment on sépare le code HTML classique du code PHP.',	'php-evo'),
(27,	28,	1,	'Les variables',	'Les variables sont un élément indispensable dans tout langage de programmation, et en PHP on n\'y échappe pas. Ce n\'est pas un truc de programmeurs tordus, c\'est au contraire quelque chose qui va nous simplifier la vie. Sans les variables, vous n\'irez pas bien loin.',	'php-i-bases'),
(28,	28,	2,	'Les fonctions',	'En PHP, on n\'aime pas avoir à répéter le même code. Pour pallier ce problème, nous avons découvert les boucles, qui permettent d\'exécuter des instructions un certain nombre de fois. Ici, nous allons découvrir un autre type de structure indispensable pour la suite : les fonctions.',	'php-i-evo'),
(29,	28,	3,	'Au secours ! Mon script plante !',	'Alors comme ça, votre script ne marche pas, et PHP vous affiche des erreurs incompréhensibles ?\r\nPas de souci à vous faire : c\'est tout à fait normal, on ne réussit jamais un script du premier coup (en tout cas, moi, jamais !).',	'php-i-avan'),
(30,	29,	1,	'Transmettez des données avec l\'URL',	'Savez-vous ce qu\'est une URL ? Cela signifie Uniform Resource Locator, et cela sert à représenter une adresse sur le web.',	'php-a-bases'),
(31,	29,	2,	'Transmettez des données avec les formulaires',	'Les formulaires constituent le principal moyen pour vos visiteurs d\'entrer des informations sur votre site. Les formulaires permettent de créer une interactivité.',	'php-a-evo'),
(32,	34,	1,	'Qu\'est-ce qu\'un algorithme ?',	'Un algorithme est la description précise, sous forme de concepts simples, de la manière dont on peut résoudre un problème.\r\n\r\nDans la vie de tous les jours, nous avons souvent besoin de résoudre des problèmes. Surtout si on considère la notion de \"problème\" au sens large.',	'algo-apprenti-bases'),
(33,	34,	2,	'La notion de complexité',	'Quand un programmeur a besoin de résoudre un problème informatique, il écrit (généralement) un programme pour cela. Son programme contient une implémentation, c\'est-à-dire si on veut une \"transcription dans un langage informatique\" d\'un algorithme : l\'algorithme, c\'est juste une description des étapes à effectuer pour résoudre le problème, ça ne dépend pas du langage ou de l\'environnement du programmeur ; de même, si on traduit une recette de cuisine dans une autre langue, ça reste la \"même\" recette.',	'algo-apprenti-evo'),
(34,	35,	1,	'Découvrez le concept de relation',	'Une relation, c\'est un tableau dans lequel on met des données. Un tableau dans lequel une ligne représente un objet, et où chaque ligne représente des objets de même nature.\r\n\r\nSi nous représentons des pommes, nous pouvons les caractériser par leur masse, leur diamètre et leur couleur. Nous pouvons aussi leur attribuer un identifiant, c\'est-à-dire un nombre (ou un code) unique qui permet de les différencier.',	'sql-bases'),
(35,	35,	2,	'Comprenez l\'importance des clés',	'Dans la vie quotidienne, une clé sert à ouvrir une porte pour accéder à votre maison. Une caractéristique essentielle d\'une clé est qu\'elle doit être unique, car si votre clé est identique à celle de la maison de votre voisin, il se pose un problème évident !\r\n\r\nDans le modèle relationnel, une clé a donc pour vocation d\'accéder à un tuple, et donc d\'identifier ce dernier.\r\n\r\n Ainsi, pour une relation donnée, une clé est un groupe d\'attribut minimum déterminant un tuple unique.',	'sql-evo');

DELIMITER ;;

CREATE TRIGGER `before_insert_chapters` BEFORE INSERT ON `chapters` FOR EACH ROW
BEGIN
      DECLARE last INTEGER;
      
      SELECT ch_number
         INTO last
         FROM chapters
         WHERE lesson = NEW.lesson
            AND ch_number >= ALL 
               (SELECT ch_number FROM chapters WHERE lesson = NEW.lesson);

      IF last IS null then#
          SET NEW.ch_number = 1;
      ELSE#
          SET NEW.ch_number = (last + 1);
      END IF;

      
   END;;

DELIMITER ;

DROP TABLE IF EXISTS `difficulties`;
CREATE TABLE `difficulties` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `previous` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `previous` (`previous`),
  CONSTRAINT `difficulties_ibfk_1` FOREIGN KEY (`previous`) REFERENCES `difficulties` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `difficulties` (`id`, `name`, `previous`) VALUES
(1,	'Débutant',	NULL),
(2,	'Intermédiaire',	1),
(3,	'Expert',	2);

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE `lessons` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_publication` datetime NOT NULL,
  `author` int unsigned DEFAULT NULL,
  `category` int unsigned DEFAULT NULL,
  `difficulty` int unsigned DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'courses.svg',
  `summary` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`),
  KEY `author` (`author`),
  KEY `category` (`category`),
  KEY `difficulty` (`difficulty`),
  CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `lessons_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `lessons_ibfk_3` FOREIGN KEY (`difficulty`) REFERENCES `difficulties` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lessons` (`id`, `name`, `date_publication`, `author`, `category`, `difficulty`, `slug`, `image`, `summary`) VALUES
(26,	'Le prolog',	'2021-05-02 14:12:14',	1,	5,	1,	'prolog',	'courses.svg',	'Un cours sur le prolog avec des vidéos Youtube.\r\n    '),
(27,	'php débutant',	'2021-05-10 07:35:47',	1,	2,	1,	'php-debutant',	'courses.svg',	'Un cours de php orienté pour les débutants'),
(28,	'php intermédiaire',	'2021-05-10 07:36:43',	1,	2,	2,	'php-intermediaire',	'courses.svg',	'Un cours de php intermédiaire'),
(29,	'php avancé',	'2021-05-10 07:37:24',	1,	2,	3,	'php-avance',	'courses.svg',	'Un cours de php avancé'),
(30,	'html',	'2021-05-10 07:40:37',	1,	2,	1,	'html',	'courses.svg',	'Cours de html'),
(31,	'css',	'2021-05-10 07:41:06',	1,	2,	1,	'css',	'courses.svg',	'Cours de CSS'),
(32,	'javascript débutant',	'2021-05-10 07:42:16',	1,	2,	2,	'javascript-debutant',	'courses.svg',	'Cours de javascript débutant'),
(33,	'javascript avancé',	'2021-05-10 07:42:49',	1,	2,	3,	'javascript-avance',	'courses.svg',	'Cours de javascript avancé'),
(34,	'Algorithmique pour l\'apprenti programmeur',	'2021-05-10 13:35:38',	1,	3,	1,	'algo-apprenti',	'courses.svg',	'Les deux notions clés de ce tutoriel sont les suivantes : la complexité, et les structures de données. La complexité est une manière d\'estimer les performances d\'un algorithme. Les structures de données sont la manière dont vous organisez les informations dans votre programme. En choisissant une structure de données adaptée, vous serez capables de coder des opérations très performantes (de faible complexité).'),
(35,	'Initiez-vous à l\'algèbre relationnelle avec le langage SQL',	'2021-05-10 13:39:17',	1,	4,	1,	'sql',	'courses.svg',	'Dans ce cours, vous apprendrez à manipuler des relations à l’aide des opérateurs de l’algèbre relationnelle. Ensuite, vous appliquerez ces concepts théoriques à un langage très utilisé : le SQL, permettant d’interagir avec des bases de données… relationnelles !');

DROP TABLE IF EXISTS `lessons_taken`;
CREATE TABLE `lessons_taken` (
  `user` int unsigned NOT NULL,
  `lesson` int unsigned NOT NULL,
  `date_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`user`,`lesson`),
  KEY `lesson` (`lesson`),
  CONSTRAINT `lessons_taken_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lessons_taken_ibfk_2` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `user` int unsigned NOT NULL,
  `role` int unsigned NOT NULL,
  PRIMARY KEY (`user`,`role`),
  KEY `role` (`role`),
  CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `permissions` (`user`, `role`) VALUES
(1,	1),
(2,	2),
(3,	3),
(5,	4),
(6,	4);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `author` int unsigned DEFAULT NULL,
  `subject` int unsigned NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `subject` (`subject`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`subject`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `posts` (`id`, `author`, `subject`, `content`, `date`) VALUES
(11,	1,	12,	'En quoi consite ce forum ?',	'2021-05-02 13:08:17'),
(12,	1,	12,	'C\'est un forum qui est l&agrave; pour favoriser l\'entraide !',	'2021-05-02 13:30:49'),
(13,	1,	12,	'C\'est super amusant de se r&eacute;pondre &agrave; soi-m&ecirc;me :grimacing:',	'2021-05-02 13:33:10'),
(14,	1,	12,	'Nan mais s&eacute;rieusement ...',	'2021-05-02 13:34:11'),
(15,	1,	13,	'yo\r\n',	'2021-05-08 08:46:36'),
(16,	1,	13,	'yo',	'2021-05-08 08:46:40'),
(17,	1,	13,	'yo',	'2021-05-08 08:46:46'),
(18,	1,	13,	'yo',	'2021-05-08 08:46:49'),
(19,	1,	13,	'yo',	'2021-05-08 08:46:51'),
(20,	1,	13,	'yo',	'2021-05-08 08:46:55'),
(21,	1,	13,	'yo',	'2021-05-08 08:46:58'),
(22,	1,	13,	'yo',	'2021-05-08 08:47:01'),
(23,	1,	13,	'yo',	'2021-05-08 08:47:04'),
(24,	5,	13,	'Hi',	'2021-05-08 10:05:56'),
(25,	1,	16,	'Le projet de Web est trop cool !!',	'2021-05-08 16:31:23'),
(26,	1,	16,	'a',	'2021-05-10 07:35:14'),
(27,	1,	16,	'a',	'2021-05-10 07:35:15');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1,	'admin',	'Administrateur du site'),
(2,	'modérateur',	'Modérateur du forum'),
(3,	'créateur',	'Créateur de contenu sur le site'),
(4,	'utilisateur ',	'Utilisateur lambda');

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `author` int unsigned DEFAULT NULL,
  `category` int unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `author` (`author`),
  KEY `category` (`category`),
  CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `subjects` (`id`, `author`, `category`, `title`, `date`, `slug`) VALUES
(12,	1,	1,	'ceci est un test',	'2021-05-02 13:07:58',	'ceci-test'),
(13,	1,	1,	'yo',	'2021-05-08 08:46:26',	'yo'),
(14,	1,	2,	'Projet de Web',	'2021-05-08 16:30:03',	'Cr&eacute;ation d\'un site'),
(16,	1,	2,	'Projet web',	'2021-05-08 16:31:11',	'Creationsite');

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int NOT NULL AUTO_INCREMENT,
  `str` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `test` (`id`, `str`, `slug`) VALUES
(1,	'Ceci est un test',	'femme-faute-de-dieu');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `date_registration` datetime NOT NULL,
  `date_birth` date DEFAULT NULL,
  `biography` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `date_registration`, `date_birth`, `biography`) VALUES
(1,	'Test',	'aevdv0uGrASy2',	'test@hotmail.fr',	'2021-04-14 15:36:08',	NULL,	NULL),
(2,	'Test1',	'aevdv0uGrASy2',	'test1@hotmail.fr',	'2021-04-24 08:02:47',	NULL,	NULL),
(3,	'Test21',	'aevdv0uGrASy2',	'test2@hotmail.fr',	'2021-04-24 08:03:07',	NULL,	NULL),
(5,	'Ninjarque',	'aeVmwL0IuHOdE',	'ninjarque@gmail.com',	'2021-05-08 11:49:45',	NULL,	NULL),
(6,	'cakeIsALie',	'aeSwVFY65Igt6',	'cakeIsALie@true.youKnow',	'2021-05-10 15:00:45',	NULL,	NULL);

DELIMITER ;;

CREATE TRIGGER `after_insert_users` AFTER INSERT ON `users` FOR EACH ROW
BEGIN
        DECLARE end BOOLEAN DEFAULT FALSE;
        DECLARE category INTEGER UNSIGNED;
        DECLARE difficulty INTEGER UNSIGNED;
        DECLARE curs CURSOR FOR
            (SELECT id FROM categories);
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET end = TRUE;

        SELECT id
            INTO difficulty
            FROM difficulties
            WHERE previous IS NULL;

        OPEN curs;
        loop_curs : LOOP
            FETCH curs INTO category;
            IF
                end
            THEN
                LEAVE loop_curs;
            END IF;
            INSERT INTO abilities
                VALUES (NEW.id, category, difficulty);
        END LOOP;
        CLOSE curs;
    END;;

DELIMITER ;

-- 2021-05-10 14:32:42
