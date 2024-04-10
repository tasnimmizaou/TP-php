CREATE TABLE `admins` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `userpassword` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admins` (`username`, `userpassword`, `email`) VALUES 
('admin1', '123', 'admin1@gmail.com'),
('admin2', '456', 'admin2@gmail.com');

CREATE TABLE `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`username`, `password`, `address`, `email`) VALUES
('JohnDoe', 'password123', '123 Main Street', 'john@example.com'),
('JaneSmith', 'p@ssw0rd', '456 Elm Street', 'jane@example.com');

CREATE TABLE `commande` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `date_commande` TIMESTAMP,
    `total_price` FLOAT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `commande` (`user_id`, `date_commande`, `total_price`) VALUES
(1, NOW(), 50.25),
(2, NOW(), 75.50),
(1, NOW(), 35.75);

CREATE TABLE `article` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) DEFAULT NULL,
    `description` TEXT,
    `price` FLOAT DEFAULT NULL,
    `reduction` INT DEFAULT NULL,
    `date_ajout` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `category` VARCHAR(255) DEFAULT NULL,
    `age` VARCHAR(255) DEFAULT NULL,
    `stock` INT DEFAULT NULL,
    `image` LONGBLOB
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `details_commande` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `commande_id` INT,
    `article_id` INT,
    `quantity` INT,
    `prix_unitaire` FLOAT,
    FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
    FOREIGN KEY (`article_id`) REFERENCES `article` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `details_commande` (`commande_id`, `article_id`, `quantity`, `prix_unitaire`) VALUES
(1, 1, 2, 25.125),
(1, 2, 1, 35.75),
(2, 2, 3, 25.16667),
(2, 3, 2, 37.75),
(3, 1, 1, 7.00),
(3, 3, 4, 21.00);


CREATE TABLE `panier` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `article_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
    CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=11;

INSERT INTO `panier` (`user_id`, `article_id`, `quantity`) VALUES
(1, 1, 2),
(2, 2, 3),
(1, 3, 1);
