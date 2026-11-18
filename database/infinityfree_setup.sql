-- Blumies production schema for InfinityFree/phpMyAdmin.
-- Select the if0_43188418_blumiesdb database, then import this file once.
-- CREATE TABLE IF NOT EXISTS keeps this safe for a partially initialized database.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `coins` int NOT NULL DEFAULT 0,
  `type` varchar(50) NOT NULL DEFAULT 'client',
  `account_status` tinyint(1) NOT NULL DEFAULT 1,
  `email_activated` tinyint(1) NOT NULL DEFAULT 0,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `pets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `species` enum('bunny','goat','fish') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `base_affection` int NOT NULL DEFAULT 0,
  `base_energy` int NOT NULL DEFAULT 0,
  `base_maintenance` int NOT NULL DEFAULT 0,
  `health` int NOT NULL DEFAULT 100,
  `energy` int NOT NULL DEFAULT 100,
  `hunger` int NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pets_user_id` (`user_id`),
  CONSTRAINT `pets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `delivery_method` varchar(100) NOT NULL,
  `gcash_name` varchar(100) DEFAULT NULL,
  `gcash_number` varchar(11) DEFAULT NULL,
  `payment_reference` varchar(100) NOT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'received',
  `jotform_status` varchar(30) NOT NULL DEFAULT 'pending',
  `jotform_submission_id` varchar(50) DEFAULT NULL,
  `jotform_error` text DEFAULT NULL,
  `jotform_synced_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` int unsigned DEFAULT NULL,
  `product_name` varchar(150) NOT NULL,
  `variant` varchar(100) DEFAULT NULL,
  `quantity` int unsigned NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id` (`order_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `catalog_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `jotform_category_id` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `synced_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `catalog_category_jotform_unique` (`jotform_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `catalog_products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `jotform_product_id` varchar(30) NOT NULL,
  `category_id` int unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` text DEFAULT NULL,
  `variants` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `synced_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `catalog_product_jotform_unique` (`jotform_product_id`),
  KEY `catalog_products_category_id` (`category_id`),
  CONSTRAINT `catalog_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `catalog_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `order_id` bigint unsigned DEFAULT NULL,
  `event_key` varchar(120) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` varchar(500) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '/notifications',
  `read_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `notifications_event_key_unique` (`event_key`),
  KEY `notifications_user_read` (`user_id`,`read_at`),
  KEY `notifications_order_id` (`order_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notifications_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users`
  (`username`,`display_name`,`email`,`phone`,`password_hash`,`coins`,`type`,`account_status`,`email_activated`,`profile_image`,`created_at`,`updated_at`)
VALUES
  ('admin','Administrator','admin@blumies.test','09170000001','$2y$10$TL9QQdckIfSlD0jKCBDjwuPO/5pHdmpNzvhAoqvsy4IAb9X5oQ.Z.',9999,'admin',1,1,'uploads/default_admin.png',NOW(),NOW()),
  ('testuser','Test User','user@blumies.test','09170000002','$2y$10$B85LQEa62ovBWc8zErku.OAN6hlWAejnxOmMF4nu7NnpdwaxO1ZLu',100,'client',1,1,'uploads/default_user.png',NOW(),NOW())
ON DUPLICATE KEY UPDATE
  `display_name`=VALUES(`display_name`),
  `phone`=VALUES(`phone`),
  `password_hash`=VALUES(`password_hash`),
  `type`=VALUES(`type`),
  `account_status`=1,
  `email_activated`=1,
  `updated_at`=NOW();

SET FOREIGN_KEY_CHECKS = 1;
