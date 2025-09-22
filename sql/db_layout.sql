CREATE TABLE `books` (
 `isbn` varchar(13) NOT NULL,
 `title` varchar(255) NOT NULL,
 `author` varchar(255) DEFAULT NULL,
 `edition` int(11) DEFAULT NULL,
 `category_code` int(11) DEFAULT NULL,
 `available` tinyint(1) DEFAULT 1,
 PRIMARY KEY (`isbn`),
 KEY `category_code` (`category_code`),
 CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_code`) REFERENCES `categories` (`category_ID`)
) 


CREATE TABLE `categories` (
 `category_ID` int(11) NOT NULL AUTO_INCREMENT,
 `category_description` varchar(100) NOT NULL,
 PRIMARY KEY (`category_ID`)
)


CREATE TABLE `reservations` (
 `username` varchar(50) DEFAULT NULL,
 `isbn` varchar(13) DEFAULT NULL,
 `reservation_date` date DEFAULT NULL,
 KEY `username` (`username`),
 KEY `isbn` (`isbn`),
 CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
 CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`)
)


CREATE TABLE `users` (
 `username` varchar(50) NOT NULL,
 `password` varchar(255) NOT NULL,
 `fullname` varchar(50) NOT NULL,
 `city` varchar(20) NOT NULL,
 `mobile` char(10) NOT NULL,
 PRIMARY KEY (`username`)
)