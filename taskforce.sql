SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `category` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` text NOT NULL,
  `icon` text NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `city` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `specializations` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users_specializations` (
  `user_id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `specialization_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  -`city_id` int(9) NOT NULL,
  `address` text NULL,
  -`avatar` text NULL,
  `description` text NULL,
  `pass` varchar(255) NOT NULL,
  `phone` varchar(50) NULL,
  `skype` varchar(100) NULL,
 - `messenger` varchar(100) NULL,
 - `push_new_message` BOOLEAN DEFAULT TRUE,
 - `push_task_actions` BOOLEAN DEFAULT TRUE,
 - `push_new_review` BOOLEAN DEFAULT TRUE,
  -`show_only_customer` BOOLEAN DEFAULT TRUE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 - `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT user_city_id_fk FOREIGN KEY (city_id)
  REFERENCES city(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `task` (
  -`id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` text NOT NULL,
  `cost` int(9) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `status` enum('new', 'cancelled', 'responded', 'in_progress', 'complited', 'failed') NOT NULL DEFAULT 'new',
  `completion_date` datetime NOT NULL,
  `category_id` int(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(9) NOT NULL,
  CONSTRAINT task_category_id_fk FOREIGN KEY (category_id)
  REFERENCES category(id),
  CONSTRAINT task_author_id_fk FOREIGN KEY (author_id)
  REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `reply` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `author_id` int(9) NOT NULL,
  `task_id` int(9) NOT NULL,
  `description` text NOT NULL,
  `bid` int(9) NULL,
  `rate` int(9) NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT response_author_id_fk FOREIGN KEY (author_id)
    REFERENCES user(id),
	CONSTRAINT response_task_id_fk FOREIGN KEY (task_id)
    REFERENCES task(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `opinion` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `author_id` int(9) NOT NULL,
  `consumer_id` int(9) NOT NULL,
  `description` text NOT NULL,
  `task_id` int(9) NOT NULL,
  `rating` int(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT review_author_id_fk FOREIGN KEY (author_id)
  REFERENCES user(id),
  CONSTRAINT review_consumer_id_fk FOREIGN KEY (consumer_id)
  REFERENCES user(id),
  CONSTRAINT review_task_id_fk FOREIGN KEY (task_id)
  REFERENCES task(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `chats` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `author_id` int(9) NOT NULL,
  `consumer_id` int(9) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT chat_author_id_fk FOREIGN KEY (author_id)
  REFERENCES user(id),
  CONSTRAINT chat_consumer_id_fk FOREIGN KEY (consumer_id)
  REFERENCES user(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `attachments` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` text NOT NULL,
  `file_path` text NOT NULL,
  `task_id` int(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT attachment_task_id_fk FOREIGN KEY (task_id)
  REFERENCES task(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
