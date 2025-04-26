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

 Date: 25/04/2025 17:06:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for stock
-- ----------------------------
DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `additional_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `itemcode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `barcode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('In Stock','Out of Stock','Back Order') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `weight` decimal(10, 2) NULL DEFAULT NULL,
  `length` decimal(10, 2) NULL DEFAULT NULL,
  `width` decimal(10, 2) NULL DEFAULT NULL,
  `height` decimal(10, 2) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `attribute_values` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stock
-- ----------------------------
INSERT INTO `stock` VALUES (1, '1000000006', '00738UNT - done.jpg', '00743UNT - done.jpg', 'calc', 'calc123', 'In Stock', 1.00, 2.00, 3.00, 4.00, 'a', '2025-04-03 16:19:47', '1');
INSERT INTO `stock` VALUES (2, '1000000006', '00759UNT - done.jpg', '00761UNT - done.jpg', '111111111111', '1111111111', 'In Stock', 2.00, 2.00, 3.00, 3.00, 'asssssssssssss', '2025-04-03 16:40:28', '1');
INSERT INTO `stock` VALUES (3, '1000000006', '00758UNT - done.jpg', '00759UNT - done.jpg', '123', '3123', 'In Stock', 4.00, 4.00, 4.00, 4.00, 'sdasda', '2025-04-03 16:41:14', '2');

SET FOREIGN_KEY_CHECKS = 1;
