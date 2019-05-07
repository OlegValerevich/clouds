--
-- База данных: `clouds`
--

CREATE DATABASE IF NOT EXISTS `clouds` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `clouds`;

--
-- Структура таблицы `performer`
--

CREATE TABLE IF NOT EXISTS `performer` (
`id` INT AUTO_INCREMENT NOT NULL, 
`name` VARCHAR(255) NOT NULL, 
`position` VARCHAR(255) NOT NULL, 
PRIMARY KEY(id)) DEFAULT character
SET utf8 
COLLATE utf8_unicode_ci 
ENGINE = InnoDB;

--
-- Структура таблицы `task`
--

CREATE TABLE IF NOT EXISTS `task` (
`id` INT AUTO_INCREMENT NOT NULL, 
`name` VARCHAR(255) NOT NULL, 
`performer_id` INT NOT NULL, 
`status` INT NOT NULL, 
`description` VARCHAR(255), 
PRIMARY KEY(id)) DEFAULT 
CHARACTER SET utf8 
COLLATE utf8_unicode_ci 
ENGINE = InnoDB;

--
-- Структура таблицы `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` INT AUTO_INCREMENT NOT NULL,
`name` VARCHAR(255) NOT NULL, 
PRIMARY KEY(id)) 
DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci 
ENGINE = InnoDB;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Открыта'),
(2, 'В работе'),
(3, 'Завершена');