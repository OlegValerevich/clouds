CREATE TABLE performer (
id INT AUTO_INCREMENT NOT NULL, 
name VARCHAR(255) NOT NULL, 
`position` VARCHAR(255) NOT NULL, 
PRIMARY KEY(id)) DEFAULT character
SET utf8 
COLLATE utf8_unicode_ci 
ENGINE = InnoDB;


INSERT INTO `performer` (`id`, `name`, `position`) VALUES
(1, 'Иванов Иван Иваныч', 'директор'),
(2, 'Сидоров Семен Семеныч', 'программист'),
(3, 'Петров Петр Петрович', 'администратор');

SELECT * FROM performer p;

CREATE TABLE `task` (
id INT AUTO_INCREMENT NOT NULL, 
name VARCHAR(255) NOT NULL, 
performer_id INT NOT NULL, 
status INT NOT NULL, 
description VARCHAR(255), 
PRIMARY KEY(id)) DEFAULT 
CHARACTER SET utf8 
COLLATE utf8_unicode_ci 
ENGINE = InnoDB;

INSERT INTO `task` (`id`, `name`, `performer_id`, `status_id`, `description`) VALUES
(1, 'Task 1', 2, 1, 'Progect 1' ),
(2, 'Task 2', 3, 2, 'Progect 2' ),
(3, 'Task 3', 1, 3, 'Progect 3' );

SELECT * FROM task t;

CREATE TABLE `status` (
id INT AUTO_INCREMENT NOT NULL,
name VARCHAR(255) NOT NULL, 
PRIMARY KEY(id)) 
DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci 
ENGINE = InnoDB;

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Открыта'),
(2, 'В работе'),
(3, 'Завершена');