CREATE TABLE `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(45) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `slot` varchar(45) NOT NULL,
  `cost` int unsigned NOT NULL,
  `value` float unsigned NOT NULL,
  `description` text NOT NULL,
  `views` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `file_name_UNIQUE` (`file_name`),
  UNIQUE KEY `product_name_UNIQUE` (`product_name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
