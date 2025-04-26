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

 Date: 25/04/2025 17:06:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `brand_id` int NOT NULL,
  `category_id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_qr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `qr_code_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `slug`(`slug` ASC) USING BTREE,
  UNIQUE INDEX `product_qr`(`product_qr` ASC) USING BTREE,
  INDEX `brand_id`(`brand_id` ASC) USING BTREE,
  INDEX `category_id`(`category_id` ASC) USING BTREE,
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'canon printer ', 'canon-printer', 6, 1, 'uploads/', '1000000001', '2025-03-27 12:06:59', NULL);
INSERT INTO `products` VALUES (2, 'calculator', 'calculator', 6, 1, 'uploads/', '1000000002', '2025-03-27 12:08:38', NULL);
INSERT INTO `products` VALUES (3, 'calc', 'calc', 6, 1, 'uploads/1743065376_00718UNT - done.jpg', '1000000003', '2025-03-27 16:49:36', NULL);
INSERT INTO `products` VALUES (4, 'cacacac', 'cacacac', 6, 1, 'uploads/1743067079_00761UNT - done.jpg', '1000000004', '2025-03-27 17:17:59', NULL);
INSERT INTO `products` VALUES (5, 'calc2', 'calc2', 6, 1, 'uploads/1743068103_00760UNT- done.jpg', '1000000005', '2025-03-27 17:35:03', NULL);
INSERT INTO `products` VALUES (8, 'samplesadasd', 'samplesadasd', 6, 1, 'uploads/1743068786_00762UNT -done.jpg', '1000000006', '2025-03-27 17:46:26', 'uploads/qrcode/1743068786_qr.png');
INSERT INTO `products` VALUES (10, 'canon printer1', 'canon-printer1', 6, 1, 'uploads/1743086861_00761UNT - done.jpg', '1000000007', '2025-03-27 22:47:41', 'uploads/qrcode/1743086861_qr.png');

SET FOREIGN_KEY_CHECKS = 1;
