CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    userpassword VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);
INSERT INTO admins (username, userpassword, email) VALUES ('admin1', '123', 'admin1@gmail.com');

INSERT INTO admins (username, userpassword, email) VALUES ('admin2', '456', 'admin2@gmail.com');

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

INSERT INTO user (username, password, address, email) VALUES
('JohnDoe', 'password123', '123 Main Street', 'john@example.com');

INSERT INTO user (username, password, address, email) VALUES
('JaneSmith', 'p@ssw0rd', '456 Elm Street', 'jane@example.com');

CREATE TABLE commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    date_commande TIMESTAMP,
    total_price FLOAT,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

INSERT INTO commande (user_id, date_commande, total_price) VALUES
(1, NOW(), 50.25), -- User 1
(2, NOW(), 75.50), -- User 2
(1, NOW(), 35.75); -- User 1

CREATE TABLE details_commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT,
    article_id INT,
    quantity INT,
    prix_unitaire FLOAT,
    FOREIGN KEY (commande_id) REFERENCES commande(id),
    FOREIGN KEY (article_id) REFERENCES article(id)
);

INSERT INTO details_commande (commande_id, article_id, quantity, prix_unitaire) VALUES
(1, 1, 2, 25.125),  -- Command 1: Article 1, Quantity 2, Total Price 50.25
(1, 2, 1, 35.75),   -- Command 1: Article 2, Quantity 1, Total Price 35.75
(2, 2, 3, 25.16667),-- Command 2: Article 2, Quantity 3, Total Price 75.50
(2, 3, 2, 37.75),   -- Command 2: Article 3, Quantity 2, Total Price 75.50
(3, 1, 1, 7.00),    -- Command 3: Article 1, Quantity 1, Total Price 7.00
(3, 3, 4, 21.00);   -- Command 3: Article 3, Quantity 4, Total Price 84.00

