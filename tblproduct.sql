CREATE TABLE IF NOT EXISTS `tblproduct` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`code`)
);

INSERT INTO `tblproduct` (`id`, `name`, `code`, `image`, `price`) VALUES
(1, 'Cashew Crunch (17 Pieces)', 'cc1', 'product-images/cashewcrunch.jpg', 250.00),
(2, 'Swiss Biscuits (28 Pieces)', 'bb1', 'product-images/swissBiscuits.jpg', 330.00),
(3, 'Badam Pista Cookies (21 Pieces)', 'as1', 'product-images/badamPistaCookies.jpg', 430.00);


CREATE TABLE IF NOT EXISTS `Customer`
(
`C_Id` int(8) NOT NULL AUTO_INCREMENT,
`firstName` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`mobile` varchar(255) NOT NULL,
PRIMARY KEY (C_Id)
);


CREATE TABLE IF NOT EXISTS `Orders`
(
`C_Id` int(8) NOT NULL,
`name` varchar(255) NOT NULL,
`code` varchar(255) NOT NULL,
`price` double(10,2) NOT NULL,
`totalprice` int(8) NOT NULL,
`qty` int(8) NOT NULL,
FOREIGN KEY (C_Id) REFERENCES Customer(C_Id)
);