SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `folders` (
  `id` int(255) NOT NULL,
  `name` varchar(256) NOT NULL,
  `path` varchar(512) NOT NULL,
  `ownerUID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `notes` (
  `id` int(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `path` varchar(512) NOT NULL,
  `createDate` date NOT NULL DEFAULT current_timestamp(),
  `ownerUID` int(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `pwd` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `folders`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `notes`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `folders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `notes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
