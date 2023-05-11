create database progskills;

use progskills;

CREATE TABLE `products` (
  `id` int(11) NOT NULL auto_increment,
  `prod_name` varchar(100) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` int(100) NOT NULL,
  PRIMARY KEY  (`id`)
);