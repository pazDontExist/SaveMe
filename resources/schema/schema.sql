CREATE TABLE `reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `photo` varchar(200) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `lon` float(12,12) DEFAULT NULL,
  `lat` float(12,12) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `notes` text,
  `report_type` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_addr` text,
  `city` varchar(100) DEFAULT NULL,
  `county` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `taken_charge` (
  `tk_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `report_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`tk_id`),
  UNIQUE KEY `taken_charge_pk` (`user_id`,`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locale` varchar(5) COLLATE utf8_unicode_ci DEFAULT 'it_IT',
  `user_type` int DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;