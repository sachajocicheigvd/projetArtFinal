# Mise en place de notre site web sur le serveur Pingouin

Voici la marche à suivre pour faire en sorte que notre site web ait fonctionné sur \
[creativepulse-pingouin.heig-vd.ch](creativepulse-pingouin.heig-vd.ch), nous avons écris cette marche à suivre de manière neutre, comme si c'était un tutoriel.

Nous limitons les détails et les grands paragraphes après le chapitre "Insertion de la BD" car nous sommes conscients que si vous lisez ceci, vous comprenez généralement ce qu'il faut faire.

## Export de notre BD de développement

Notre base de donnée de développement est déjà une bonne base pour utiliser notre site web. Si vous souhaitez posséder "rapidement" une base de donnée pour essayer, voici le script SQL, pour que vous essayez.

Afin d'être plus efficace pour la mise en place, vous pouvez déjà copier dans le presse papier de votre ordinateur les lignes suivantes.

Si vous avez des seeders, vous n'avez pas l'oligation de copier le code ci-dessous.

```SQL
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 15 juin 2023 à 13:25
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `interact`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`id`, `survey_id`, `answer`, `artist`, `picture`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bella', 'Maître Gims', '', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(2, 1, 'Waka Waka', 'Shakira', '', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(3, 2, 'Bof', NULL, NULL, '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(4, 2, 'Moui', NULL, NULL, '2023-06-15 13:24:26', '2023-06-15 13:24:26');

-- --------------------------------------------------------

--
-- Structure de la table `answer_user`
--

CREATE TABLE `answer_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `answer_user`
--

INSERT INTO `answer_user` (`id`, `answer_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(2, 2, 2, '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(3, 3, 3, '2023-06-15 13:24:26', '2023-06-15 13:24:26');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Afro', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(2, 'Reggaeton', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(3, 'Jazz', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(4, 'Electro', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(5, 'Country', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(6, 'Metal', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(7, 'Hip-hop', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(8, 'Punk', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(9, 'Rock', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(10, 'Variété française', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(11, 'Pop', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(12, 'Rap', '2023-06-15 13:24:26', '2023-06-15 13:24:26');

-- --------------------------------------------------------

--
-- Structure de la table `genre_user`
--

CREATE TABLE `genre_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `genre_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre_user`
--

INSERT INTO `genre_user` (`id`, `genre_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(2, 2, 2, '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(3, 2, 3, '2023-06-15 13:24:26', '2023-06-15 13:24:26');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `message_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Bonjour, je suis un message', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(2, 1, 2, 'Bonjour, je suis le 0 message', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(3, 1, 3, 'Bonjour, je suis le 1 message', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(4, 1, 3, 'Bonjour, je suis le 2 message', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(5, 1, 3, 'Bonjour, je suis le 3 message', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(6, 1, 3, 'Bonjour, je suis le 4 message', '2023-06-15 13:24:26', '2023-06-15 13:24:26');

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
(344, '2013_05_26_073511_create_roles_table', 1),
(345, '2014_10_12_000000_create_users_table', 1),
(346, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(347, '2019_08_19_000000_create_failed_jobs_table', 1),
(348, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(349, '2023_05_30_080004_create_genres_table', 1),
(350, '2023_05_30_080053_create_messages_table', 1),
(351, '2023_05_30_080102_create_surveys_table', 1),
(352, '2023_05_30_080103_create_answers_table', 1),
(353, '2023_05_31_080035_create_genre_user_table', 1),
(354, '2023_05_31_080116_create_answer_user_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `short_description`, `long_description`, `created_at`, `updated_at`) VALUES
(1, 'user', 'users who have registered', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(2, 'admin', 'admins have all rights to create surveys and questions', '2023-06-15 13:24:26', '2023-06-15 13:24:26');

-- --------------------------------------------------------

--
-- Structure de la table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `surveys`
--

INSERT INTO `surveys` (`id`, `user_id`, `title`, `type`, `duration`, `created_at`, `updated_at`) VALUES
(1, 1, 'Quelle musique voulez-vous écouter ensuite ?', 'music', '2023-06-16 22:44:26', '2023-06-15 13:24:26', '2023-06-15 13:24:26'),
(2, 2, 'Aimez-vous Couleur 3 ?', 'text', '2023-06-16 22:44:26', '2023-06-15 13:24:26', '2023-06-15 13:24:26');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `username`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Marques', 'Patrick', 'patrickmarques@couleur3.ch', 'Patoch', '$2y$10$GhguI013icYExSjcF3rHjOvvk3HedJErqhlkImST.jlIoyAiBBqNO', NULL, NULL, '2023-06-15 13:24:26', '2023-06-15 13:24:26', 1),
(2, 'Graber', 'Olivier', 'oliviergraber@couleur3.ch', 'Olive', '$2y$10$Bq9eF1YDwxlReO1ZMN2hdeBGatC7jcCjQ9uBkjLVJ5iKcS6wZMx82', NULL, NULL, '2023-06-15 13:24:26', '2023-06-15 13:24:26', 2),
(3, 'Dorasamy', 'Ryan', 'ryandorasamy@couleur3.ch', 'Tupidix', '$2y$10$fxH8a9ZAoloszpNn5zhVDeM3otWs4wEtvL/wBBgO/2Uc3gXzuHU3a', NULL, NULL, '2023-06-15 13:24:26', '2023-06-15 13:24:26', 2),
(4, 'Jocic', 'Sacha', 'sachajocic@couleur3.ch', 'Sacha', '$2y$10$gsDPqnknZIRmSV8HHLj9E.VmNtqTp73De7KIEgyXPp5l4aWQVpOZG', NULL, NULL, '2023-06-15 13:24:26', '2023-06-15 13:24:26', 2),
(5, 'Heig', 'Admin', 'adminheig@couleur3.ch', 'Admin', '$2y$10$ZUUPZ/UyANdkXcc8c9yGhePrg5gtej5bB3gIwyyGSZKNcxFY9syoS', NULL, NULL, '2023-06-15 13:24:26', '2023-06-15 13:24:26', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_survey_id_foreign` (`survey_id`);

--
-- Index pour la table `answer_user`
--
ALTER TABLE `answer_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `answer_user_answer_id_user_id_unique` (`answer_id`,`user_id`),
  ADD KEY `answer_user_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genres_name_unique` (`name`);

--
-- Index pour la table `genre_user`
--
ALTER TABLE `genre_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genre_user_genre_id_user_id_unique` (`genre_id`,`user_id`),
  ADD KEY `genre_user_user_id_foreign` (`user_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_message_id_foreign` (`message_id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_short_description_unique` (`short_description`);

--
-- Index pour la table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surveys_user_id_foreign` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `answer_user`
--
ALTER TABLE `answer_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `genre_user`
--
ALTER TABLE `genre_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Contraintes pour la table `answer_user`
--
ALTER TABLE `answer_user`
  ADD CONSTRAINT `answer_user_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `answer_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `genre_user`
--
ALTER TABLE `genre_user`
  ADD CONSTRAINT `genre_user_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `genre_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

## Insertion de la DB

### En copiant collant le SQL

Connectez-vous sur `nomDuGroupe-pingouin.heig-vd.ch/phpmyadmin` dans le cadre d'une base de donnée MySQL (ce qui a été notre choix).

Saisissez le nom d'utilisateur ainsi que le mot de passe correspondant qui vous est fourni par votre administrateur.

Créez une nouvelle table que vous nommerez ou accédez directement à la table puis aller sur l'onglet _"SQL"_ puis collez le code copié précédemment et éxecutez ce dernier, ce que vous voyez à l'écran peut être différent de cette image en raison du thème par défaut _"pmahomme"_ sur phpmyadmin et ici nous avons le thème _"Metro"_.

![Menu phpmyadmin](phpmyadmin-menu.png)

Félicitations, vous avez peuplé la base de données!

### Avec des commandes PHP artisan

Continuer votre lecture, nous mettrons en temps voulu le bon moment pour faire ceci.

## Télécharger le repo Git depuis github directement sur le serveur

Connectez-vous sur pingouin.heig-vd.ch avec le terminal puis avec le mot de passe de l'école. N'oubliez pas que cela fonctionne uniquement si vous êtes connecté au réseau de l'école ou depuis le dernier VPN recommandé par le helpdesk.

```
ssh login.aai@pingouin.heig-vd.ch
```

`exemple : ssh patrick.marquesm@pingouin.heig-vd.ch`

Allez sur votre répértoire projart (en changeant les 20XX pour l'année et les Y pour votre volée et les Z pour le nom de votre groupe)
(dans notre cas)

```
cd ../projart/20XX/YY/ZZZ
```

`exemple : cd ../projart/2023/50/creativepulse`

Pour notre part, nous avons effacé le dossier `nomDuGroupe-laravel`.

Ensuite on fait un `git clone` du dépôt Git pour récupérer les fichiers du site web

```
git clone <URL_du_repo>
```

Une fois le clonage terminé, renommez-le (cela va effacer le dossier de base et vous évites donc de faire une suppression avant).

```
mv nomDuDossierCloné <nomDuGroupe>-laravel
```

Puis allez dans le dossier

```
cd <nomDuGroupe>-laravel
```

Copiez le fichier d'exemple `.example.env` pour créer le fichier `.env` (à moins que vous ayez laissé le .env sur le repo Git ou que vous voulez faire un _Drag & Drop_ sur l'application FileZilla par exemple)

```
cp .example.env .env
```

Modifiez le fichier `.env` (en ligne de commande avec `nano` ou `vim` par exemple, ou depuis un éditeur de texte) selon les paramètres spécifiques à votre configuration, tels que la base de données, les identifiants, la APP_KEY (que vous pouvez générer via `php artisan key:generate`), pusher si vous avez pusher, votre service mail.

Si vous avez pris le fichier `.env` depuis votre projet, partez du principe que vous devez modifier uniquement le nom de la base de donnée si vous n'avez pas pu la choisir, le port, l'utilisateur, le mot de passe.

De ce que nous avons observé, le site est tout autant fonctionnel si vous ne modifiez pas la ligne `APP_URL`.

Une fois en production, vérifiez que la ligne `APP_DEBUG` soit égal à `false`, ceci permettra d'éviter d'afficher les potentielles erreurs aux visiteurs de votre site web, pour faire simple, ils ne verront pas la page au lieu d'atterrir sur la page qui explique l'erreur précise sur le site web et ainsi dévoiler des potentielles informations confidentielles.

De plus, si vous en avez la possibilité (pas à notre connaissance sur pingouin), améliorez encore plus votre sécurité en mettant des variables d'environnement dans le serveur et dans le fichier `.env`.

## Exécution des commandes présentes dans le fichier word fourni par le professeur

Executez depuis votre répértoire toutes les commandes ci-dessous (toujours en changeant le 20XX pour l'année et les Y pour votre volée et les Z pour le nom de votre groupe). Ils permettront de changer les droits de lecture et d'écriture.

```
sudo chgrp -R ZZZ /home/projart/20XX/YY/ZZZ/

sudo chown -R www-data /home/projart/20XX/YY/ZZZ/ZZZ-laravel/storage/

sudo chown -R www-data /home/projart/20XX/YY/ZZZ/ZZZ-laravel/bootstrap/cache/

sudo chmod -R g+wrX /home/projart/20XX/YY/ZZZ/ZZZ-laravel/

sudo chmod -R g+wrX /home/projart/20XX/YY/ZZZ/ZZZ-apache.conf
```

## Exécution des commandes recommandées par le site Laravel

Executez toutes ces commandes qui sont recommandées sur le site de Laravel, (nous les avons toutes utilisées, même la commande qui concerne les Event car nous avons des Event).

Dernière consultation le 15.06.23 sur le site de [laravel](https://laravel.com/docs/10.x/deployment#main-content).

```
composer install --optimize-autoloader --no-dev

php artisan config:cache

php artisan event:cache

php artisan route:cache

php artisan view:cache
```

## Autre commandes

Il n'est pas impossible que vous deviez faire d'autres commandes comme par exemple `php artisan storage:link` ou `npm install`, en fonction des besoins de votre site.

C'est à cet instant que les personnes qui voulaient installer leur base de donnése remplie avec des seeders en ligne de commande qu'ils peuvent le faire, vous avez normalement à faire uniquement `php artisan migrate` (si vous avez une erreur, faite `php artisan migrate:install` juste avant), puis `php artisan db:seed`.

## Génération des fichiers optimisés et vérification du bon fonctionnement

Exécutez la commande suivante pour générer les fichiers optimisés du site web.

```
npm run build
```

Vérifiez que tout fonctionne correctement en accédant à `nomDuGroupe-pingouin.heig-vd.ch` dans votre navigateur.

Si tout est opérationnel, félicitations !

Votre site web est maintenant déployé sur le serveur Pingouin.

Si vous voulez tester notre site web en tant qu'administrateur, utilisez l'accès suivant.

Username : Admin
MDP : Admin

## Mises à jour

À chaque fois que vous modifiez votre répertoire original et que vos modifications sont enregistrées sur GitHub, pensez à faire 3 choses, même si c'est redondant.

Faite au minimum, `git pull` et puis `npm run build`.

Pensez également s'il y a un problème de cache ou de route suite à vos modifications à faire un `php artisan cache:clear` et `php artisan route:cache`;

# Problèmes ?

Votre site web ne fonctionne ou est comme vous voulez que si vous faite un npm run dev en parallèle ? Il n'est donc pas prêt au déploiement.
Cela peut être dû à une utilisation multiple de l'instruction @vite par exemple (si vous utilisez `vite`).
Faites les diverses modifications et retentez de faire `npm run build` et de voir le résultat.
