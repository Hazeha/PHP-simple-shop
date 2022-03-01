CREATE DATABASE db_bobshop;
USE db_bobshop;


CREATE TABLE `categories` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);
CREATE TABLE products(
     `id` int NOT NULL AUTO_INCREMENT,
     `name` varchar(255) NOT NULL,
     `description` varchar(255) NOT NULL,
     `category` varchar(255) NOT NULL,
     `imgUrl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
     `price` float NOT NULL,
     `stock` int DEFAULT NULL,
     PRIMARY KEY (`id`)
);
INSERT INTO `categories` (`id`, `name`) VALUES
    (1, 'Burger'),
    (2, 'Sides'),
    (3, 'Drinks');
INSERT INTO `products` (`name`, `description`, `category`, `imgUrl`, `price`, `stock`) VALUES
    ('Léo Roza', 'Massive Burger ./ Double Beef ./ Double Bacon ./ Extra Cheese', 'Burger', 'roza.jpg', 99, 10),
    ('Amiralo Burger', 'Juicy Shrooms ./ Pickles ./ Plant Bacon ./ Plant Beef ./', 'Burger', 'amirali.jpg', 75, 55),
    ('Chicken Ship', 'BBQ Chicken ./ Home Made BBQ Sauce ./ Chili Mayo ./ Shroom Topping', 'Burger', 'chicken.jpg', 79, 10),
    ('Chicken Wings', 'BBQ Sauce Extra ./ Dipping Sauce', 'Sides', 'wings.jpg', 49, 11),
    ('Chicken Nugget', 'Small Chicken Balls ./ Garlic Mayo', 'Sides', 'nugget.jpg', 39, 10),
    ('Chicken Sticks', 'Big Chicken Nuggets ./ Garlic Mayo ', 'Sides', 'nugget2.jpg', 49, 11),
    ('Honey Soda', 'Pure Honey Soda ./ Made from secret recipe ./ ', 'drinks', 'honey.jpg', 29, 15),
    ('Jarritos', 'Fresh & Cold Soda ./ Meny Variants ./ ', 'drinks', 'jarritos.jpg', 19, 15),
    ('Redbull', 'Energy Drink ./ Gives you wings ./', 'drinks', 'redbull.jpg', 25, 15);


CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `phone` varchar(255) NOT NULL,
    `address` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `isAdmin` tinyint(1) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

insert into users (name, email, phone, address, password, isAdmin) values
('John Doe', 'doe@mail.se', '12345678', 'street ./ post ./ country', 'pass', '0'),
('John Admin', 'admin@mail.se', '12345678', 'street ./ post ./ country', 'root', '1');
