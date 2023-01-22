-- Date: 5th march 2021
-- This is the mysql script for create tables for the horizonsp1 database

-- Create table to store user information
DROP TABLE IF EXISTS `tills`;
CREATE TABLE `tills`(
	`id` int(13) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` text not null,
    `uname` text not null,
    `passwd` text not null
);


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`(
	`id` int(13) NOT NULL PRIMARY KEY,
    `nic` text NOT NULL,
    `idn` text NOT NULL,
    `name` text NOT NULL,
    `uname` text NOT NULL,
    `passwd` text NOT NULL,
    `home` text NOT NULL,
    `road` text NOT NULL,
    `city` text NOT NULL,
    `till` int not null
);

-- Create table to store consumption data
DROP TABLE IF EXISTS `consumption`;
CREATE TABLE `consumption`(
    `index` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `id` int(13) NOT NULL,
    `date` text NOT NULL,
    `consumption` float NOT NULL,
    FOREIGN KEY (`id`) REFERENCES `users`(`id`)
);

-- Create table to store Calculation data
DROP TABLE IF EXISTS `unitcalc`;
CREATE TABLE `unitcalc`(
    `unit_range` float(9,3) NOT NULL,
    `charge` float(9, 3) NOT NULL,
    `fixed` float(9, 3) NOT NULL
);
