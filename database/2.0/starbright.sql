/*
 Navicat Premium Dump SQL

 Source Server         : miste_ry
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : starbright

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 17/02/2025 15:50:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for attribute_values
-- ----------------------------
DROP TABLE IF EXISTS `attribute_values`;
CREATE TABLE `attribute_values`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `attribute_id` int NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `attribute_id`(`attribute_id` ASC) USING BTREE,
  CONSTRAINT `attribute_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of attribute_values
-- ----------------------------
INSERT INTO `attribute_values` VALUES (1, 1, '1 cm');
INSERT INTO `attribute_values` VALUES (2, 1, '2 cm');
INSERT INTO `attribute_values` VALUES (3, 1, '3 cm');
INSERT INTO `attribute_values` VALUES (4, 1, '4 cm');
INSERT INTO `attribute_values` VALUES (5, 1, '5 cm');
INSERT INTO `attribute_values` VALUES (6, 2, 'Red');
INSERT INTO `attribute_values` VALUES (7, 2, 'Blue');

-- ----------------------------
-- Table structure for attributes
-- ----------------------------
DROP TABLE IF EXISTS `attributes`;
CREATE TABLE `attributes`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of attributes
-- ----------------------------
INSERT INTO `attributes` VALUES (1, 'Size', 'size', 'Label', NULL);
INSERT INTO `attributes` VALUES (2, 'Color', 'color', 'Color', NULL);
INSERT INTO `attributes` VALUES (3, 'Weight', 'weight', 'Label', NULL);
INSERT INTO `attributes` VALUES (4, 'Kulai color', 'kulai-color', 'Color', NULL);
INSERT INTO `attributes` VALUES (5, 'Indigo', 'indigo', 'Color', NULL);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `itemcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qrcode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stock_status` enum('In Stock','Out of Stock','Pre-Order','N/A','Back Order') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `weight` decimal(10, 2) NULL DEFAULT 0.00,
  `length` decimal(10, 2) NULL DEFAULT 0.00,
  `width` decimal(10, 2) NULL DEFAULT 0.00,
  `height` decimal(10, 2) NULL DEFAULT 0.00,
  `unit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'kg',
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('single','variation') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'single',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qrcode_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `slug`(`slug` ASC) USING BTREE,
  UNIQUE INDEX `qrcode`(`qrcode` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'KINANG GLITTERS 250G and 1KG', 'kinang-glitters-250g-and-1kg', '', '', '1000000001', 'N/A', 0.00, 0.00, 0.00, 0.00, 'N/A', 'arts-&-crafts', 'N/A', 'variation', '', '', '2025-02-17 15:11:24');
INSERT INTO `products` VALUES (2, '123', '123', '', '', '1000000002', 'In Stock', 0.00, 0.00, 0.00, 0.00, 'kg', 'N/A', '', 'variation', '', '', '2025-02-17 15:19:10');
INSERT INTO `products` VALUES (3, 'asdaxcvxcv', 'asdaxcvxcv', '', '', '1000000003', 'N/A', 0.00, 0.00, 0.00, 0.00, 'N/A', 'bags-&-pouches', 'N/A', 'variation', '', '', '2025-02-17 15:21:50');
INSERT INTO `products` VALUES (4, 'asfzczxc', 'asfzczxc', '', '', '1000000004', 'N/A', 0.00, 0.00, 0.00, 0.00, 'N/A', 'bags-&-pouches', 'N/A', 'variation', '', '', '2025-02-17 15:49:06');

-- ----------------------------
-- Table structure for products_variation
-- ----------------------------
DROP TABLE IF EXISTS `products_variation`;
CREATE TABLE `products_variation`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NULL DEFAULT NULL,
  `product_variation` int NULL DEFAULT NULL,
  `attribute_value` int NULL DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stock_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `item_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `weight` decimal(10, 2) NULL DEFAULT NULL,
  `lenght` decimal(10, 2) NULL DEFAULT NULL,
  `width` decimal(10, 2) NULL DEFAULT NULL,
  `height` decimal(10, 2) NULL DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products_variation
-- ----------------------------
INSERT INTO `products_variation` VALUES (1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `products_variation` VALUES (2, 3, 2, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `products_variation` VALUES (3, 4, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_rgistered` date NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'mistery', 'mistery12@gmail.com', 'admin', NULL, 'admin');
INSERT INTO `users` VALUES (2, 'sample', 'sample@gmail.com', 'sample', NULL, 'user');

SET FOREIGN_KEY_CHECKS = 1;
