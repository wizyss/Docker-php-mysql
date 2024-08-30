
USE `php_db`;

CREATE TABLE IF NOT EXISTS `user_input` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `input_text` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


