SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `taskforce`
-- * в единсвенное число *
-- варчар заменить на текст ? - чот не понял пока почему)
-- * перенести конфиги в юзера *
-- * Таблица атачей: id, name, task_id *
-- * слаги убрать *
-- * created at - добавить текущее время *
-- * переписать все ключи наверх *
-- * добавить чат *
-- * города в отдельную таблицу *

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--
CREATE TABLE `category` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` text NOT NULL,
  `icon` text NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `response`
--

CREATE TABLE `response` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `author_id` int(9) NOT NULL,
  `task_id` int(9) NOT NULL,
  `description` text NOT NULL,
  `bid` int(9) NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT responce_author_id_fk FOREIGN KEY (author_id)
    REFERENCES user(id),
	CONSTRAINT responce_task_id_fk FOREIGN KEY (task_id)
    REFERENCES task(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `autor_id` int(9) CONSTRAINT NOT NULL FOREIGN KEY review_author_id_fk user(id),
  `consumer_id` int(9) CONSTRAINT NOT NULL FOREIGN KEY review_consumer_id_fk user(id),
  `description` text NOT NULL,
  `task_id` int(9) CONSTRAINT NOT NULL FOREIGN KEY review_task_id_fk task(id),
  `rating` int(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `autor_id` int(9) CONSTRAINT NOT NULL FOREIGN KEY chat_author_id_fk user(id),
  `consumer_id` int(9) CONSTRAINT NOT NULL FOREIGN KEY chat_consumer_id_fk user(id),
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `specialization`
--

CREATE TABLE `specialization` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` text NOT NULL,
  `cost` int(9) NOT NULL,
  `description` text NOT NULL,
  `place` text NOT NULL,
  `status` enum('new', 'cancelled', 'responded', 'in_progress', 'complited', 'failed') NOT NULL DEFAULT 'customer',
  `completion_date` datetime NOT NULL,
  `category_id` int(9) CONSTRAINT NOT NULL FOREIGN KEY task_category_id_fk category (id),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(9) CONSTRAINT NOT NULL FOREIGN KEY task_author_id_fk users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attachment`
--

CREATE TABLE `attachment` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` text NOT NULL,
  `task_id` int(9) CONSTRAINT NOT NULL FOREIGN KEY attachment_task_id_fk task(id),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `city_id` int(9) CONSTRAINT NOT NULL FOREIGN KEY user_city_id_fk city(id)
  `address` text NOT NULL,
  `avatar` text NOT NULL,
  `description` text NOT NULL,
  `pass` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `skype` varchar(100) NOT NULL,
  `messenger` varchar(100) NOT NULL,
  `push_new_message` BOOLEAN DEFAULT TRUE,
  `push_task_actions` BOOLEAN DEFAULT TRUE,
  `push_new_review` BOOLEAN DEFAULT TRUE,
  `show_only_customer` BOOLEAN DEFAULT TRUE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_specialization`
--

CREATE TABLE `user_specialization` (
  `user_id` int(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `specialization_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
