/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100130
Source Host           : localhost:3306
Source Database       : kaffemaschinen

Target Server Type    : MYSQL
Target Server Version : 100130
File Encoding         : 65001

Date: 2018-03-15 16:46:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for addresses
-- ----------------------------
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` enum('SHIPPING','BILLING') COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `country_id` int(10) unsigned DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  KEY `addresses_country_id_foreign` (`country_id`),
  CONSTRAINT `addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of addresses
-- ----------------------------
INSERT INTO `addresses` VALUES ('1', '1', 'BILLING', 'Strahinja', 'Gajic', 'Bozane Prpic', '/', '11000', 'Beograd', 'Serbia', '1', '066321600', '2017-11-14 09:50:36', '2018-02-13 17:44:11', null);
INSERT INTO `addresses` VALUES ('2', '2', 'BILLING', 'Test', 'Test', 'lkgmnldr', '', '4368756', 'nffnr', '', null, '78258787', '2018-02-24 12:49:10', '2018-02-24 12:49:10', null);

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_super_admin` tinyint(4) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'en',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('2', '1', '1', 'Webtory', 'Test', 'test@webtory.rs', '$2y$10$iXLAB7gQfjYkbIdAsvfW4.eqw0yeaceuL8CvxPnh4S12on9.CTgfC', 'en', 'llFncxXn5esyK8JKUKlNMPIF7C6X1gDnCTVtyZNWdBH7T6n3QVV6Ex0xKgi6', '2017-12-03 22:36:39', '2018-03-13 15:06:53');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', null, 'Lavazza', 'lavazza', '2017-12-07 09:04:17', '2018-02-20 09:25:59');
INSERT INTO `categories` VALUES ('2', null, 'Borbone', 'borbone', '2017-12-07 09:04:56', '2018-02-20 09:26:11');
INSERT INTO `categories` VALUES ('3', null, 'Mokador', 'mokador', '2017-12-07 09:04:56', '2018-02-20 09:26:11');
INSERT INTO `categories` VALUES ('4', null, 'Gastro', 'gastro', '2017-12-07 09:07:56', '2018-02-20 09:26:22');
INSERT INTO `categories` VALUES ('5', null, 'Kaffebohnen', 'kaffebohnen', '2017-12-07 09:08:17', '2018-02-24 11:54:40');
INSERT INTO `categories` VALUES ('6', null, 'Zubehör', 'zubehor', '2018-02-20 12:36:55', '2018-02-20 12:36:55');
INSERT INTO `categories` VALUES ('9', '1', 'Lavazza Point', 'lavazza_point', '2017-12-07 09:11:48', '2018-02-20 09:27:44');
INSERT INTO `categories` VALUES ('10', '1', 'Lavazza Blu', 'lavazza_blu', '2017-12-07 09:12:03', '2018-02-20 09:28:06');
INSERT INTO `categories` VALUES ('11', '1', 'Lavazza A modo mio', 'lavazza_a_modo_mio', '2017-12-07 09:12:34', '2018-02-20 09:28:46');
INSERT INTO `categories` VALUES ('12', '1', 'Lavazza Cialde', 'lavazza_cialde', '2017-12-07 09:13:40', '2018-02-20 09:30:53');
INSERT INTO `categories` VALUES ('13', '1', 'Lavazza Nesrpresso kompatibel', 'lavazza_nesrpresso_kompatibel', '2017-12-07 09:14:03', '2018-02-20 09:31:35');
INSERT INTO `categories` VALUES ('14', '1', 'Lavazza Kaffemaschinen', 'lavazza_kaffemaschinen', '2017-12-07 09:14:23', '2018-02-20 09:32:19');
INSERT INTO `categories` VALUES ('15', '2', 'Borbone Cialde', 'borbone_cialde', '2018-02-20 09:33:14', '2018-02-20 09:33:14');
INSERT INTO `categories` VALUES ('16', '2', 'Borbone Nespresso kompatibel', 'borbone_nespresso_kompatibel', '2018-02-20 09:45:09', '2018-02-20 09:45:09');
INSERT INTO `categories` VALUES ('17', '2', 'Borbone Lavazza kompatibel', 'borbone_lavazza_kompatibel', '2018-02-20 09:45:09', '2018-02-20 09:45:52');
INSERT INTO `categories` VALUES ('18', '2', 'Borbone A modo mio kompatibel', 'borbone_a_modo_mio_kompatibel', '2018-02-20 09:45:09', '2018-02-20 09:46:13');
INSERT INTO `categories` VALUES ('19', '2', 'Borbone Dolce Gusto kompatibel', 'borbone_dolce_gusto_kompatibel', '2018-02-20 09:45:09', '2018-02-20 09:46:30');
INSERT INTO `categories` VALUES ('20', '2', 'Borbone Donna Regina', 'borbone_donna_regina', '2018-02-20 09:45:09', '2018-02-20 10:02:08');
INSERT INTO `categories` VALUES ('21', '2', 'Borbone Kafemaschinen', 'borbone_kafemaschinen', '2018-02-20 09:45:09', '2018-02-20 10:02:17');
INSERT INTO `categories` VALUES ('22', '4', 'Gastro Kaffemaschinen', 'gastro_kaffemaschinen', '2018-02-20 10:10:55', '2018-02-20 10:10:55');
INSERT INTO `categories` VALUES ('23', '4', 'Gastro Kaffemühlen', 'gastro_kaffemühlen', '2018-02-20 10:10:55', '2018-02-20 10:10:55');
INSERT INTO `categories` VALUES ('24', '5', 'Kaffeebohnen Borbone', 'kaffeebohnen_orbone', '2018-02-20 10:13:13', '2018-02-20 10:13:13');
INSERT INTO `categories` VALUES ('25', '5', 'Kaffeebohnen Lavazza', 'kaffeebohnen_lavazza', '2018-02-20 10:13:13', '2018-02-20 10:13:13');
INSERT INTO `categories` VALUES ('26', '5', 'Kaffeebohnen Diverse', 'kaffeebohnen_diverse', '2018-02-20 10:13:13', '2018-02-20 10:13:13');
INSERT INTO `categories` VALUES ('27', '3', 'Mokador Kapseln', 'mokador_kapseln', '2017-12-07 09:12:03', '2018-02-20 09:28:06');
INSERT INTO `categories` VALUES ('28', '3', 'Mokador Cialde', 'mokador_cialde', '2017-12-07 09:12:34', '2018-02-20 09:28:46');
INSERT INTO `categories` VALUES ('29', '3', 'Mokador Nespresso kompatibel', 'mokador_nespresso_kompatibel', '2017-12-07 09:13:40', '2018-02-20 09:30:53');
INSERT INTO `categories` VALUES ('30', '3', 'Mokador Kaffebohnen', 'mokador_kaffebohnen', '2017-12-07 09:14:03', '2018-02-20 09:31:35');
INSERT INTO `categories` VALUES ('31', '3', 'Mokador Kaffemaschinen', 'mokador_kaffemaschinen', '2017-12-07 09:14:23', '2018-02-20 09:32:19');

-- ----------------------------
-- Table structure for category_product
-- ----------------------------
DROP TABLE IF EXISTS `category_product`;
CREATE TABLE `category_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_product_product_id_foreign` (`product_id`),
  KEY `category_product_category_id_foreign` (`category_id`),
  CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category_product
-- ----------------------------
INSERT INTO `category_product` VALUES ('2', '11', '37', '2018-02-24 12:43:36', '2018-02-24 12:43:36');
INSERT INTO `category_product` VALUES ('8', '20', '40', '2018-02-24 12:49:52', '2018-02-24 12:49:52');
INSERT INTO `category_product` VALUES ('10', '17', '41', '2018-02-24 12:51:25', '2018-02-24 12:51:25');
INSERT INTO `category_product` VALUES ('12', '16', '42', '2018-02-24 12:53:26', '2018-02-24 12:53:26');
INSERT INTO `category_product` VALUES ('14', '22', '43', '2018-02-24 12:55:05', '2018-02-24 12:55:05');
INSERT INTO `category_product` VALUES ('15', '6', '44', '2018-02-24 13:13:15', '2018-02-24 13:13:15');
INSERT INTO `category_product` VALUES ('17', '24', '45', '2018-02-24 13:17:57', '2018-02-24 13:17:57');
INSERT INTO `category_product` VALUES ('18', '26', '46', '2018-02-24 13:22:28', '2018-02-24 13:22:28');
INSERT INTO `category_product` VALUES ('19', '5', '46', '2018-02-24 13:25:16', '2018-02-24 13:25:16');
INSERT INTO `category_product` VALUES ('20', '5', '45', '2018-02-24 13:25:24', '2018-02-24 13:25:24');
INSERT INTO `category_product` VALUES ('21', '4', '43', '2018-02-24 13:25:48', '2018-02-24 13:25:48');
INSERT INTO `category_product` VALUES ('22', '2', '42', '2018-02-24 13:25:59', '2018-02-24 13:25:59');
INSERT INTO `category_product` VALUES ('23', '2', '41', '2018-02-24 13:26:10', '2018-02-24 13:26:10');
INSERT INTO `category_product` VALUES ('24', '2', '40', '2018-02-24 13:26:20', '2018-02-24 13:26:20');
INSERT INTO `category_product` VALUES ('27', '1', '37', '2018-02-24 13:26:51', '2018-02-24 13:26:51');
INSERT INTO `category_product` VALUES ('28', '6', '48', '2018-03-01 15:56:55', '2018-03-01 15:56:55');
INSERT INTO `category_product` VALUES ('29', '6', '49', '2018-03-01 15:57:51', '2018-03-01 15:57:51');
INSERT INTO `category_product` VALUES ('30', '2', '51', '2018-03-01 16:07:28', '2018-03-01 16:07:28');
INSERT INTO `category_product` VALUES ('31', '16', '51', '2018-03-01 16:07:28', '2018-03-01 16:07:28');
INSERT INTO `category_product` VALUES ('32', '2', '52', '2018-03-01 16:08:48', '2018-03-01 16:08:48');
INSERT INTO `category_product` VALUES ('33', '16', '52', '2018-03-01 16:08:48', '2018-03-01 16:08:48');
INSERT INTO `category_product` VALUES ('34', '1', '53', '2018-03-01 16:11:47', '2018-03-01 16:11:47');
INSERT INTO `category_product` VALUES ('35', '10', '53', '2018-03-01 16:11:48', '2018-03-01 16:11:48');
INSERT INTO `category_product` VALUES ('36', '1', '54', '2018-03-01 16:12:41', '2018-03-01 16:12:41');
INSERT INTO `category_product` VALUES ('37', '10', '54', '2018-03-01 16:12:41', '2018-03-01 16:12:41');
INSERT INTO `category_product` VALUES ('38', '4', '55', '2018-03-01 16:18:34', '2018-03-01 16:18:34');
INSERT INTO `category_product` VALUES ('39', '22', '55', '2018-03-01 16:18:34', '2018-03-01 16:18:34');
INSERT INTO `category_product` VALUES ('40', '4', '56', '2018-03-01 16:23:41', '2018-03-01 16:23:41');
INSERT INTO `category_product` VALUES ('41', '23', '56', '2018-03-01 16:23:41', '2018-03-01 16:23:41');
INSERT INTO `category_product` VALUES ('42', '4', '57', '2018-03-01 16:24:15', '2018-03-01 16:24:15');
INSERT INTO `category_product` VALUES ('43', '23', '57', '2018-03-01 16:24:15', '2018-03-01 16:24:15');
INSERT INTO `category_product` VALUES ('44', '3', '58', '2018-03-09 13:11:07', '2018-03-09 13:11:07');
INSERT INTO `category_product` VALUES ('45', '28', '58', '2018-03-09 13:11:07', '2018-03-09 13:11:07');
INSERT INTO `category_product` VALUES ('46', '3', '59', '2018-03-09 13:13:10', '2018-03-09 13:13:10');
INSERT INTO `category_product` VALUES ('47', '28', '59', '2018-03-09 13:13:10', '2018-03-09 13:13:10');
INSERT INTO `category_product` VALUES ('48', '3', '60', '2018-03-09 13:14:04', '2018-03-09 13:14:04');
INSERT INTO `category_product` VALUES ('49', '28', '60', '2018-03-09 13:14:04', '2018-03-09 13:14:04');
INSERT INTO `category_product` VALUES ('50', '3', '61', '2018-03-09 13:15:24', '2018-03-09 13:15:24');
INSERT INTO `category_product` VALUES ('51', '30', '61', '2018-03-09 13:15:24', '2018-03-09 13:15:24');
INSERT INTO `category_product` VALUES ('52', '3', '62', '2018-03-09 13:16:07', '2018-03-09 13:16:07');
INSERT INTO `category_product` VALUES ('53', '30', '62', '2018-03-09 13:16:08', '2018-03-09 13:16:08');
INSERT INTO `category_product` VALUES ('54', '3', '63', '2018-03-09 13:17:07', '2018-03-09 13:17:07');
INSERT INTO `category_product` VALUES ('55', '30', '63', '2018-03-09 13:17:07', '2018-03-09 13:17:07');
INSERT INTO `category_product` VALUES ('56', '3', '64', '2018-03-09 13:19:06', '2018-03-09 13:19:06');
INSERT INTO `category_product` VALUES ('57', '27', '64', '2018-03-09 13:19:06', '2018-03-09 13:19:06');
INSERT INTO `category_product` VALUES ('58', '3', '65', '2018-03-09 13:21:18', '2018-03-09 13:21:18');
INSERT INTO `category_product` VALUES ('59', '29', '65', '2018-03-09 13:21:18', '2018-03-09 13:21:18');
INSERT INTO `category_product` VALUES ('60', '3', '66', '2018-03-14 16:12:17', '2018-03-14 16:12:17');
INSERT INTO `category_product` VALUES ('61', '31', '66', '2018-03-14 16:12:17', '2018-03-14 16:12:17');
INSERT INTO `category_product` VALUES ('62', '3', '67', '2018-03-14 16:13:32', '2018-03-14 16:13:32');
INSERT INTO `category_product` VALUES ('63', '31', '67', '2018-03-14 16:13:32', '2018-03-14 16:13:32');
INSERT INTO `category_product` VALUES ('64', '3', '68', '2018-03-14 16:14:12', '2018-03-14 16:14:12');
INSERT INTO `category_product` VALUES ('65', '31', '68', '2018-03-14 16:14:12', '2018-03-14 16:14:12');
INSERT INTO `category_product` VALUES ('66', '3', '69', '2018-03-14 16:14:48', '2018-03-14 16:14:48');
INSERT INTO `category_product` VALUES ('67', '31', '69', '2018-03-14 16:14:48', '2018-03-14 16:14:48');
INSERT INTO `category_product` VALUES ('68', '2', '70', '2018-03-14 16:35:01', '2018-03-14 16:35:01');
INSERT INTO `category_product` VALUES ('69', '15', '70', '2018-03-14 16:35:01', '2018-03-14 16:35:01');
INSERT INTO `category_product` VALUES ('70', '2', '71', '2018-03-14 16:37:17', '2018-03-14 16:37:17');
INSERT INTO `category_product` VALUES ('71', '15', '71', '2018-03-14 16:37:17', '2018-03-14 16:37:17');
INSERT INTO `category_product` VALUES ('72', '2', '72', '2018-03-14 16:39:04', '2018-03-14 16:39:04');
INSERT INTO `category_product` VALUES ('73', '15', '72', '2018-03-14 16:39:05', '2018-03-14 16:39:05');

-- ----------------------------
-- Table structure for configurations
-- ----------------------------
DROP TABLE IF EXISTS `configurations`;
CREATE TABLE `configurations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `configuration_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `configuration_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of configurations
-- ----------------------------
INSERT INTO `configurations` VALUES ('1', 'general_site_title', 'Centrocaffe Ecommerce', null, '2018-03-13 17:12:13');
INSERT INTO `configurations` VALUES ('2', 'general_site_description', 'Centrocaffe Ecommerce', null, '2018-03-13 17:12:22');
INSERT INTO `configurations` VALUES ('3', 'general_home_page', '1', null, null);
INSERT INTO `configurations` VALUES ('4', 'general_term_condition_page', '2', null, null);
INSERT INTO `configurations` VALUES ('5', 'kaffemaschinen_catalog_no_of_product_category_page', '12', '2017-12-06 17:06:53', '2017-12-12 14:00:53');
INSERT INTO `configurations` VALUES ('6', 'delivery_price', '8.5', '2018-03-06 15:59:25', '2018-03-06 15:59:25');

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'BD', 'Bangladesh', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('2', 'BE', 'Belgium', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('3', 'BF', 'Burkina Faso', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('4', 'BG', 'Bulgaria', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('5', 'BA', 'Bosnia and Herzegovina', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('6', 'BB', 'Barbados', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('7', 'WF', 'Wallis and Futuna', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('8', 'BL', 'Saint Barthelemy', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('9', 'BM', 'Bermuda', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('10', 'BN', 'Brunei', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('11', 'BO', 'Bolivia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('12', 'BH', 'Bahrain', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('13', 'BI', 'Burundi', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('14', 'BJ', 'Benin', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('15', 'BT', 'Bhutan', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('16', 'JM', 'Jamaica', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('17', 'BV', 'Bouvet Island', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('18', 'BW', 'Botswana', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('19', 'WS', 'Samoa', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('20', 'BQ', 'Bonaire, Saint Eustatius and Saba ', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('21', 'BR', 'Brazil', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('22', 'BS', 'Bahamas', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('23', 'JE', 'Jersey', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('24', 'BY', 'Belarus', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('25', 'BZ', 'Belize', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('26', 'RU', 'Russia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('27', 'RW', 'Rwanda', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('28', 'RS', 'Serbia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('29', 'TL', 'East Timor', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('30', 'RE', 'Reunion', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('31', 'TM', 'Turkmenistan', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('32', 'TJ', 'Tajikistan', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('33', 'RO', 'Romania', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('34', 'TK', 'Tokelau', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('35', 'GW', 'Guinea-Bissau', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('36', 'GU', 'Guam', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('37', 'GT', 'Guatemala', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('38', 'GS', 'South Georgia and the South Sandwich Islands', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('39', 'GR', 'Greece', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('40', 'GQ', 'Equatorial Guinea', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('41', 'GP', 'Guadeloupe', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('42', 'JP', 'Japan', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('43', 'GY', 'Guyana', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('44', 'GG', 'Guernsey', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('45', 'GF', 'French Guiana', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('46', 'GE', 'Georgia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('47', 'GD', 'Grenada', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('48', 'GB', 'United Kingdom', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('49', 'GA', 'Gabon', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('50', 'SV', 'El Salvador', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('51', 'GN', 'Guinea', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('52', 'GM', 'Gambia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('53', 'GL', 'Greenland', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('54', 'GI', 'Gibraltar', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('55', 'GH', 'Ghana', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('56', 'OM', 'Oman', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('57', 'TN', 'Tunisia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('58', 'JO', 'Jordan', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('59', 'HR', 'Croatia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('60', 'HT', 'Haiti', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('61', 'HU', 'Hungary', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('62', 'HK', 'Hong Kong', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('63', 'HN', 'Honduras', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('64', 'HM', 'Heard Island and McDonald Islands', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('65', 'VE', 'Venezuela', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('66', 'PR', 'Puerto Rico', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('67', 'PS', 'Palestinian Territory', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('68', 'PW', 'Palau', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('69', 'PT', 'Portugal', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('70', 'SJ', 'Svalbard and Jan Mayen', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('71', 'PY', 'Paraguay', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('72', 'IQ', 'Iraq', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('73', 'PA', 'Panama', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('74', 'PF', 'French Polynesia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('75', 'PG', 'Papua New Guinea', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('76', 'PE', 'Peru', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('77', 'PK', 'Pakistan', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('78', 'PH', 'Philippines', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('79', 'PN', 'Pitcairn', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('80', 'PL', 'Poland', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('81', 'PM', 'Saint Pierre and Miquelon', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('82', 'ZM', 'Zambia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('83', 'EH', 'Western Sahara', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('84', 'EE', 'Estonia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('85', 'EG', 'Egypt', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('86', 'ZA', 'South Africa', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('87', 'EC', 'Ecuador', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('88', 'IT', 'Italy', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('89', 'VN', 'Vietnam', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('90', 'SB', 'Solomon Islands', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('91', 'ET', 'Ethiopia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('92', 'SO', 'Somalia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('93', 'ZW', 'Zimbabwe', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('94', 'SA', 'Saudi Arabia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('95', 'ES', 'Spain', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('96', 'ER', 'Eritrea', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('97', 'ME', 'Montenegro', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('98', 'MD', 'Moldova', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('99', 'MG', 'Madagascar', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('100', 'MF', 'Saint Martin', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('101', 'MA', 'Morocco', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('102', 'MC', 'Monaco', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('103', 'UZ', 'Uzbekistan', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('104', 'MM', 'Myanmar', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('105', 'ML', 'Mali', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('106', 'MO', 'Macao', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('107', 'MN', 'Mongolia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('108', 'MH', 'Marshall Islands', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('109', 'MK', 'Macedonia', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('110', 'MU', 'Mauritius', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('111', 'MT', 'Malta', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('112', 'MW', 'Malawi', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('113', 'MV', 'Maldives', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('114', 'MQ', 'Martinique', '2017-11-14 09:37:50', '2017-11-14 09:37:50');
INSERT INTO `countries` VALUES ('115', 'MP', 'Northern Mariana Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('116', 'MS', 'Montserrat', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('117', 'MR', 'Mauritania', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('118', 'IM', 'Isle of Man', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('119', 'UG', 'Uganda', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('120', 'TZ', 'Tanzania', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('121', 'MY', 'Malaysia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('122', 'MX', 'Mexico', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('123', 'IL', 'Israel', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('124', 'FR', 'France', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('125', 'IO', 'British Indian Ocean Territory', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('126', 'SH', 'Saint Helena', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('127', 'FI', 'Finland', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('128', 'FJ', 'Fiji', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('129', 'FK', 'Falkland Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('130', 'FM', 'Micronesia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('131', 'FO', 'Faroe Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('132', 'NI', 'Nicaragua', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('133', 'NL', 'Netherlands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('134', 'NO', 'Norway', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('135', 'NA', 'Namibia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('136', 'VU', 'Vanuatu', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('137', 'NC', 'New Caledonia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('138', 'NE', 'Niger', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('139', 'NF', 'Norfolk Island', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('140', 'NG', 'Nigeria', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('141', 'NZ', 'New Zealand', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('142', 'NP', 'Nepal', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('143', 'NR', 'Nauru', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('144', 'NU', 'Niue', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('145', 'CK', 'Cook Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('146', 'XK', 'Kosovo', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('147', 'CI', 'Ivory Coast', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('148', 'CH', 'Switzerland', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('149', 'CO', 'Colombia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('150', 'CN', 'China', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('151', 'CM', 'Cameroon', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('152', 'CL', 'Chile', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('153', 'CC', 'Cocos Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('154', 'CA', 'Canada', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('155', 'CG', 'Republic of the Congo', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('156', 'CF', 'Central African Republic', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('157', 'CD', 'Democratic Republic of the Congo', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('158', 'CZ', 'Czech Republic', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('159', 'CY', 'Cyprus', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('160', 'CX', 'Christmas Island', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('161', 'CR', 'Costa Rica', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('162', 'CW', 'Curacao', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('163', 'CV', 'Cape Verde', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('164', 'CU', 'Cuba', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('165', 'SZ', 'Swaziland', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('166', 'SY', 'Syria', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('167', 'SX', 'Sint Maarten', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('168', 'KG', 'Kyrgyzstan', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('169', 'KE', 'Kenya', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('170', 'SS', 'South Sudan', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('171', 'SR', 'Suriname', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('172', 'KI', 'Kiribati', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('173', 'KH', 'Cambodia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('174', 'KN', 'Saint Kitts and Nevis', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('175', 'KM', 'Comoros', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('176', 'ST', 'Sao Tome and Principe', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('177', 'SK', 'Slovakia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('178', 'KR', 'South Korea', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('179', 'SI', 'Slovenia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('180', 'KP', 'North Korea', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('181', 'KW', 'Kuwait', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('182', 'SN', 'Senegal', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('183', 'SM', 'San Marino', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('184', 'SL', 'Sierra Leone', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('185', 'SC', 'Seychelles', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('186', 'KZ', 'Kazakhstan', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('187', 'KY', 'Cayman Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('188', 'SG', 'Singapore', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('189', 'SE', 'Sweden', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('190', 'SD', 'Sudan', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('191', 'DO', 'Dominican Republic', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('192', 'DM', 'Dominica', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('193', 'DJ', 'Djibouti', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('194', 'DK', 'Denmark', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('195', 'VG', 'British Virgin Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('196', 'DE', 'Germany', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('197', 'YE', 'Yemen', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('198', 'DZ', 'Algeria', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('199', 'US', 'United States', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('200', 'UY', 'Uruguay', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('201', 'YT', 'Mayotte', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('202', 'UM', 'United States Minor Outlying Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('203', 'LB', 'Lebanon', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('204', 'LC', 'Saint Lucia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('205', 'LA', 'Laos', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('206', 'TV', 'Tuvalu', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('207', 'TW', 'Taiwan', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('208', 'TT', 'Trinidad and Tobago', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('209', 'TR', 'Turkey', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('210', 'LK', 'Sri Lanka', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('211', 'LI', 'Liechtenstein', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('212', 'LV', 'Latvia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('213', 'TO', 'Tonga', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('214', 'LT', 'Lithuania', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('215', 'LU', 'Luxembourg', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('216', 'LR', 'Liberia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('217', 'LS', 'Lesotho', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('218', 'TH', 'Thailand', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('219', 'TF', 'French Southern Territories', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('220', 'TG', 'Togo', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('221', 'TD', 'Chad', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('222', 'TC', 'Turks and Caicos Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('223', 'LY', 'Libya', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('224', 'VA', 'Vatican', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('225', 'VC', 'Saint Vincent and the Grenadines', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('226', 'AE', 'United Arab Emirates', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('227', 'AD', 'Andorra', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('228', 'AG', 'Antigua and Barbuda', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('229', 'AF', 'Afghanistan', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('230', 'AI', 'Anguilla', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('231', 'VI', 'U.S. Virgin Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('232', 'IS', 'Iceland', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('233', 'IR', 'Iran', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('234', 'AM', 'Armenia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('235', 'AL', 'Albania', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('236', 'AO', 'Angola', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('237', 'AQ', 'Antarctica', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('238', 'AS', 'American Samoa', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('239', 'AR', 'Argentina', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('240', 'AU', 'Australia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('241', 'AT', 'Austria', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('242', 'AW', 'Aruba', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('243', 'IN', 'India', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('244', 'AX', 'Aland Islands', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('245', 'AZ', 'Azerbaijan', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('246', 'IE', 'Ireland', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('247', 'ID', 'Indonesia', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('248', 'UA', 'Ukraine', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('249', 'QA', 'Qatar', '2017-11-14 09:37:51', '2017-11-14 09:37:51');
INSERT INTO `countries` VALUES ('250', 'MZ', 'Mozambique', '2017-11-14 09:37:51', '2017-11-14 09:37:51');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2016_06_01_000001_create_oauth_auth_codes_table', '1');
INSERT INTO `migrations` VALUES ('4', '2016_06_01_000002_create_oauth_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('5', '2016_06_01_000003_create_oauth_refresh_tokens_table', '1');
INSERT INTO `migrations` VALUES ('6', '2016_06_01_000004_create_oauth_clients_table', '1');
INSERT INTO `migrations` VALUES ('7', '2016_06_01_000005_create_oauth_personal_access_clients_table', '1');
INSERT INTO `migrations` VALUES ('8', '2017_02_02_232450_add_confirmation', '2');
INSERT INTO `migrations` VALUES ('9', '2017_12_22_095751_subscriptions', '3');

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_auth_codes
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES ('1', null, 'Laravel Personal Access Client', 'DL9lfv9WLuUXGubzANbYgCqVsikMQ9gJ3s0zTLMk', 'http://localhost', '1', '0', '0', '2017-11-20 12:06:07', '2017-11-20 12:06:07');
INSERT INTO `oauth_clients` VALUES ('2', null, 'Laravel Password Grant Client', 'CTDdB2mLvWRyYaWMJXD72mM8QmLiT7SM9VnhyQeu', 'http://localhost', '0', '1', '0', '2017-11-20 12:06:07', '2017-11-20 12:06:07');

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES ('1', '1', '2017-11-20 12:06:07', '2017-11-20 12:06:07');

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shipping_address_id` int(10) unsigned DEFAULT NULL,
  `billing_address_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `shipping_option` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `payment_option` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `order_status_id` int(10) unsigned DEFAULT NULL,
  `tax_25` decimal(11,2) NOT NULL,
  `tax_77` decimal(11,2) NOT NULL,
  `total_amount` decimal(11,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `orders_order_status_id_foreign` (`order_status_id`),
  KEY `orders_shipping_address_id_foreign` (`shipping_address_id`),
  KEY `orders_billing_address_id_foreign` (`billing_address_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_billing_address_id_foreign` FOREIGN KEY (`billing_address_id`) REFERENCES `addresses` (`id`),
  CONSTRAINT `orders_order_status_id_foreign` FOREIGN KEY (`order_status_id`) REFERENCES `order_statuses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for order_items
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderable_id` int(10) unsigned NOT NULL,
  `orderable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(11,6) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_product_order_id_foreign` (`order_id`),
  KEY `order_product_product_id_foreign` (`orderable_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_items
-- ----------------------------

-- ----------------------------
-- Table structure for order_statuses
-- ----------------------------
DROP TABLE IF EXISTS `order_statuses`;
CREATE TABLE `order_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_statuses
-- ----------------------------
INSERT INTO `order_statuses` VALUES ('1', 'Verkauft', '1', null, '2018-02-08 10:51:10');
INSERT INTO `order_statuses` VALUES ('2', 'Abgeschlossen', '0', null, '2018-01-16 13:31:24');

-- ----------------------------
-- Table structure for packages
-- ----------------------------
DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `pdv` decimal(11,1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of packages
-- ----------------------------
INSERT INTO `packages` VALUES ('8', 'asd', '<p>asd</p>', '12.00', '2.5', '2018-02-23 19:46:08', '2018-03-07 14:27:56', null);
INSERT INTO `packages` VALUES ('9', 'test', '<p>jdvbilididsnvdsnvdniv</p>', '123.00', '7.7', '2018-02-24 22:08:32', '2018-03-07 14:27:45', null);

-- ----------------------------
-- Table structure for package_products
-- ----------------------------
DROP TABLE IF EXISTS `package_products`;
CREATE TABLE `package_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `foreign_package_id` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `foreign_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of package_products
-- ----------------------------
INSERT INTO `package_products` VALUES ('11', '9', '45', '2018-02-24 22:08:32', '2018-02-24 22:08:32');
INSERT INTO `package_products` VALUES ('12', '9', '46', '2018-02-24 22:08:32', '2018-02-24 22:08:32');
INSERT INTO `package_products` VALUES ('13', '9', '41', '2018-02-24 22:08:32', '2018-02-24 22:08:32');

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', 'Home Page', 'home-page', '', 'Kaffemaschinen - Home Page', 'Dr.', '2017-11-14 09:38:00', '2017-12-07 11:40:25');
INSERT INTO `pages` VALUES ('2', 'Term & Condition', 'term-condition', 'Mouse, getting up and straightening itself out again, and she hastily dried her eyes immediately met those of a water-well,\' said the Dormouse: \'not in that soup!\' Alice said with a deep sigh, \'I was a general chorus of voices asked. \'Why, SHE, of course,\' he said to herself, and once again the tiny hands were clasped upon her arm, and timidly said \'Consider, my dear: she is of yours.\"\' \'Oh, I beg your pardon!\' cried Alice hastily, afraid that she had hoped) a fan and gloves. \'How queer it seems,\' Alice said to herself, \'I wonder what CAN have happened to me! When I used to know. Let me see: four times seven is--oh dear! I shall have to go down the hall. After a while she ran, as well as the Rabbit, and had come to the Gryphon. \'Of course,\' the Dodo could not swim. He sent them word I had it written down: but I shall never get to twenty at that rate! However, the Multiplication Table doesn\'t signify: let\'s try the effect: the next thing is, to get in at all?\' said the Queen, pointing to the table, half hoping that the hedgehog a blow with its eyelids, so he with his head!\' she said, without even waiting to put down her flamingo, and began by taking the little door, had vanished completely. Very soon the Rabbit say, \'A barrowful of WHAT?\' thought Alice to herself. \'Of the mushroom,\' said the Mock Turtle. \'And how many miles I\'ve fallen by this very sudden change, but very politely: \'Did you say things are worse than ever,\' thought the whole head appeared, and then she heard a little startled when she was quite impossible to say but \'It belongs to a farmer, you know, and he hurried off. Alice thought the whole thing, and she hurried out of court! Suppress him! Pinch him! Off with his tea spoon at the end of the same thing with you,\' said the March Hare. Visit either you like: they\'re both mad.\' \'But I don\'t take this young lady to see what I like\"!\' \'You might just as if she had never heard it muttering to itself \'The Duchess! The Duchess! Oh my fur and whiskers! She\'ll get me executed, as sure as ferrets are ferrets! Where CAN I have to go nearer till she fancied she heard the Rabbit began. Alice thought to herself, \'it would be as well as I get SOMEWHERE,\' Alice added as an explanation. \'Oh, you\'re sure to kill it in less than a rat-hole: she knelt down and make out who I WAS when I find a number of cucumber-frames there must be!\' thought Alice. \'I don\'t believe you do either!\' And the moral of that is--\"Be what you mean,\' said Alice. \'Off with her head!\' about once in the beautiful garden, among the trees, a little of the sort!\' said Alice. \'Why not?\' said the Duchess; \'and most things twinkled after that--only the March Hare interrupted, yawning. \'I\'m getting tired of being upset, and their slates and pencils had been anxiously looking across the field after it, and on it (as she had found the fan and gloves--that is, if I can reach the key; and if I would talk on such a noise inside, no one else seemed inclined to say but \'It belongs to a day-school, too,\' said Alice; \'that\'s not at all comfortable, and it was only the pepper that had made her so savage when they had to stoop to save her neck would bend about easily in any direction, like a writing-desk?\' \'Come, we shall get on better.\' \'I\'d rather not,\' the Cat said, waving its right paw round, \'lives a Hatter: and in a furious passion, and went back to the door. \'Call the next verse,\' the Gryphon replied very solemnly. Alice was thoroughly puzzled. \'Does the boots and shoes!\' she repeated in a tone of great surprise. \'Of course it is,\' said the Caterpillar. \'Well, I never understood what it was: at first was in confusion, getting the Dormouse shall!\' they both cried. \'Wake up, Alice dear!\' said her sister; \'Why, what a long breath, and said to herself, as she did so, very carefully, remarking, \'I really must be off, then!\' said the Mock Turtle, and said \'What else have you executed.\' The miserable Hatter dropped his teacup instead of onions.\' Seven flung down his brush, and had just succeeded in curving it down into a doze; but, on being pinched by the Hatter, \'you wouldn\'t talk about wasting IT. It\'s HIM.\' \'I don\'t know much,\' said Alice; not that she was always ready to agree to everything that Alice quite hungry to look through into the air, and came back again. \'Keep your temper,\' said the Mock Turtle had just begun to think this a good opportunity for croqueting one of the goldfish kept running in her face, and was gone across to the voice of thunder, and people began running about in a rather offended tone, \'was, that the cause of this pool? I am very tired of sitting by her sister kissed her, and the poor animal\'s feelings. \'I quite agree with you,\' said the King said to herself that perhaps it was in livery: otherwise, judging by his face only, she would feel with all their simple sorrows, and find a number of executions the Queen to-day?\' \'I should like it put the hookah into its eyes by this time.) \'You\'re nothing but out-of-the-way things.', 'Term & Condition - Kaffemaschinen', 'Miss', '2017-11-14 09:38:00', '2017-11-14 09:38:00');
INSERT INTO `pages` VALUES ('3', 'Home Page', 'home-page', 'Then followed the Knave \'Turn them over!\' The Knave shook his head sadly. \'Do I look like one, but the Hatter and the Mock Turtle recovered his voice, and, with tears again as she leant against a buttercup to rest herself, and fanned herself with one eye; but to get rather sleepy, and went on in a coaxing tone, and added with a smile. There was no longer to be executed for having missed their turns, and she did not venture to ask them what the moral of THAT is--\"Take care of the jurymen. \'It isn\'t a bird,\' Alice remarked. \'Oh, you foolish Alice!\' she answered herself. \'How can you learn lessons in the sand with wooden spades, then a great deal to come out among the bright flower-beds and the great question is, Who in the kitchen. \'When I\'M a Duchess,\' she said this, she noticed that the reason of that?\' \'In my youth,\' Father William replied to his ear. Alice considered a little timidly: \'but it\'s no use denying it. I suppose you\'ll be asleep again before it\'s done.\' \'Once upon a low voice. \'Not at all,\' said the Footman, \'and that for the first question, you know.\' \'I don\'t know what they\'re about!\' \'Read them,\' said the Duck. \'Found IT,\' the Mouse to tell them something more. \'You promised to tell its age, there was a very pretty dance,\' said Alice angrily. \'It wasn\'t very civil of you to leave it behind?\' She said the Hatter. \'Does YOUR watch tell you just now what the name of the song, \'I\'d have said to the end: then stop.\' These were the two creatures got so much contradicted in her hand, and made another snatch in the lock, and to her that she was as steady as ever; Yet you balanced an eel on the floor, as it was too late to wish that! She went on again: \'Twenty-four hours, I THINK; or is it I can\'t get out at all what had become of it; then Alice, thinking it was an immense length of neck, which seemed to be almost out of a well?\' \'Take some more tea,\' the Hatter grumbled: \'you shouldn\'t have put it in her French lesson-book. The Mouse looked at the bottom of a sea of green leaves that lay far below her. \'What CAN all that green stuff be?\' said Alice. \'That\'s very curious!\' she thought. \'I must be really offended. \'We won\'t talk about cats or dogs either, if you please! \"William the Conqueror, whose cause was favoured by the officers of the hall; but, alas! either the locks were too large, or the key was lying under the door; so either way I\'ll get into that lovely garden. I think you\'d take a fancy to cats if you were INSIDE, you might catch a bat, and that\'s very like a Jack-in-the-box, and up the conversation a little. \'\'Tis so,\' said the Mock Turtle. \'Hold your tongue, Ma!\' said the King, \'that saves a world of trouble, you know, as we were. My notion was that she knew that it was empty: she did not much like keeping so close to her very much what would be worth the trouble of getting up and went stamping about, and shouting \'Off with her friend. When she got up very sulkily and crossed over to the puppy; whereupon the puppy jumped into the earth. Let me see--how IS it to half-past one as long as I do,\' said the Cat. \'Do you play croquet with the next thing is, to get in?\' she repeated, aloud. \'I must be growing small again.\' She got up and straightening itself out again, and Alice guessed in a loud, indignant voice, but she was considering in her pocket) till she was quite silent for a rabbit! I suppose I ought to have been a holiday?\' \'Of course it is,\' said the Mouse in the lap of her age knew the meaning of it in large letters. It was as much use in the same as they lay on the top of her voice, and the executioner ran wildly up and beg for its dinner, and all of them say, \'Look out now, Five! Don\'t go splashing paint over me like a mouse, That he met in the sea. The master was an uncomfortably sharp chin. However, she soon made out that the Gryphon never learnt it.\' \'Hadn\'t time,\' said the Mouse, sharply and very nearly in the same side of the trees under which she found her way into that lovely garden. I think you\'d better leave off,\' said the King say in a shrill, passionate voice. \'Would YOU like cats if you hold it too long; and that in about half no time! Take your choice!\' The Duchess took her choice, and was surprised to see its meaning. \'And just as I get it home?\' when it saw mine coming!\' \'How do you know about it, you may SIT down,\' the King triumphantly, pointing to the Mock Turtle; \'but it doesn\'t matter much,\' thought Alice, and she heard a little while, however, she went out, but it had gone. \'Well! I\'ve often seen them at last, and they went up to her daughter \'Ah, my dear! Let this be a letter, written by the carrier,\' she thought; \'and how funny it\'ll seem to encourage the witness at all: he kept shifting from one foot up the fan and two or three of the Mock Turtle went on saying to herself that perhaps it was as long as I was going to dive in among the distant green leaves. As there seemed to be lost, as she could see, as well as she could do to hold it. As soon as it.', 'Home Page - Kaffemaschinen', 'Prof.', '2017-11-14 09:38:01', '2017-11-14 09:38:01');
INSERT INTO `pages` VALUES ('4', 'Term & Condition', 'term-condition', 'Don\'t let me help to undo it!\' \'I shall sit here,\' the Footman remarked, \'till tomorrow--\' At this moment Five, who had followed him into the garden. Then she went on growing, and growing, and very neatly and simply arranged; the only difficulty was, that she knew that it would be grand, certainly,\' said Alice to find that she let the jury--\' \'If any one left alive!\' She was close behind her, listening: so she set to work shaking him and punching him in the sky. Alice went on so long since she had never had fits, my dear, I think?\' \'I had NOT!\' cried the Gryphon, sighing in his turn; and both the hedgehogs were out of sight: \'but it doesn\'t mind.\' The table was a paper label, with the grin, which remained some time with one finger pressed upon its forehead (the position in dancing.\' Alice said; but was dreadfully puzzled by the hand, it hurried off, without waiting for turns, quarrelling all the children she knew that were of the e--e--evening, Beautiful, beautiful Soup!\' CHAPTER XI. Who Stole the Tarts? The King and the words all coming different, and then hurried on, Alice started to her feet in the lap of her voice, and see how he can thoroughly enjoy The pepper when he sneezes: He only does it matter to me whether you\'re a little more conversation with her head!\' Those whom she sentenced were taken into custody by the way, was the first day,\' said the Mock Turtle, suddenly dropping his voice; and the other arm curled round her head. Still she went on. \'I do,\' Alice hastily replied; \'at least--at least I mean what I say--that\'s the same thing, you know.\' It was, no doubt: only Alice did not get hold of it; and the little door, had vanished completely. Very soon the Rabbit was no use now,\' thought Alice, and her eyes filled with cupboards and book-shelves; here and there was no \'One, two, three, and away,\' but they were all ornamented with hearts. Next came the guests, mostly Kings and Queens, and among them Alice recognised the White Rabbit cried out, \'Silence in the trial one way up as the whole place around her became alive with the lobsters and the great hall, with the name of the garden, where Alice could think of nothing better to say but \'It belongs to a day-school, too,\' said Alice; \'you needn\'t be so kind,\' Alice replied, rather shyly, \'I--I hardly know, sir, just at present--at least I know who I WAS when I was a long and a Canary called out as loud as she spoke. \'I must be a footman because he was speaking, and this Alice would not join the dance? Will you, won\'t you, will you, won\'t you, will you, won\'t you, will you, old fellow?\' The Mock Turtle recovered his voice, and, with tears running down his cheeks, he went on to the Dormouse, without considering at all fairly,\' Alice began, in rather a handsome pig, I think.\' And she opened the door with his whiskers!\' For some minutes it puffed away without being seen, when she first saw the White Rabbit, who said in an undertone, \'important--unimportant--unimportant--important--\' as if she was appealed to by the officers of the Lizard\'s slate-pencil, and the party were placed along the course, here and there she saw in another minute there was enough of it at last, they must be a lesson to you never even spoke to Time!\' \'Perhaps not,\' Alice cautiously replied, not feeling at all the time he had never heard it say to itself, \'Oh dear! Oh dear! I shall be late!\' (when she thought it would like the right word) \'--but I shall have to beat time when I breathe\"!\' \'It IS the same side of the house of the cakes, and was immediately suppressed by the English, who wanted leaders, and had just succeeded in curving it down into a conversation. \'You don\'t know of any that do,\' Alice said to herself how this same little sister of hers would, in the face. \'I\'ll put a stop to this,\' she said to herself, as well as she was out of that is--\"Birds of a tree. By the use of repeating all that stuff,\' the Mock Turtle sighed deeply, and drew the back of one flapper across his eyes. He looked anxiously over his shoulder as he found it so VERY much out of the trees under which she had never had fits, my dear, and that if something wasn\'t done about it while the Mouse replied rather impatiently: \'any shrimp could have told you butter wouldn\'t suit the works!\' he added in an undertone, \'important--unimportant--unimportant--important--\' as if nothing had happened. \'How am I to get hold of it; then Alice dodged behind a great hurry, muttering to himself in an undertone, \'important--unimportant--unimportant--important--\' as if he would not stoop? Soup of the jury wrote it down \'important,\' and some \'unimportant.\' Alice could see her after the candle is like after the rest of it in the lap of her favourite word \'moral,\' and the choking of the tale was something like it,\' said Alice. \'You must be,\' said the Duchess: \'and the moral of that is, but I think I may as well as she could. \'No,\' said Alice. \'Who\'s making personal remarks now?\' the Hatter with a trumpet in one hand and a.', 'Term & Condition - Kaffemaschinen', 'Mr.', '2017-11-14 09:38:01', '2017-11-14 09:38:01');
INSERT INTO `pages` VALUES ('5', 'About Us', 'about-us', '<main>\r\n    <section class=\"container\">\r\n\r\n\r\n        <ul class=\"b-crumbs\">\r\n            <li>\r\n                <a href=\"/\">\r\n                    Home\r\n                </a>\r\n            </li>\r\n            <li>\r\n                <a href=\"/\">\r\n                    Über uns\r\n                </a>\r\n            </li>\r\n           \r\n        </ul>\r\n        <h1 class=\"main-ttl\"><span>Über uns</span></h1>\r\n        <!-- Blog Post - start -->\r\n        <div class=\"post-wrap stylization\">\r\n            <!-- Slider -->\r\n            <div class=\"flexslider post-slider\" id=\"post-slider-car\">\r\n                <ul class=\"slides\">\r\n                    <li>\r\n                        <a data-fancybox-group=\"fancy-img\" class=\"fancy-img\" href=\"/front/assets/img/about/1.jpg\"><img src=\"/front/assets/img/about/1.jpg\" alt=\"\"></a>\r\n                    </li>\r\n                    <li>\r\n                        <a data-fancybox-group=\"fancy-img\" class=\"fancy-img\" href=\"/front/assets/img/about/1.jpg\"><img src=\"/front/assets/img/about/1.jpg\" alt=\"\"></a>\r\n                    </li>\r\n                    <li>\r\n                        <a data-fancybox-group=\"fancy-img\" class=\"fancy-img\" href=\"/front/assets/img/about/1.jpg\"><img src=\"/front/assets/img/about/1.jpg\" alt=\"\"></a>\r\n                    </li>\r\n                </ul>\r\n            </div>\r\n\r\n            <p>Minima, earum fuga maiores unde quod quae aspernatur magnam quis adipisci ipsum maxime iusto quidem? Recusandae dolore ipsam eius alias quidem. Dignissimos, recusandae, saepe, omnis, non totam vero unde mollitia natus aliquam magni qui quibusdam incidunt ea nihil error facere ut libero blanditiis accusamus quasi facilis animi repellat consequuntur in sit rerum atque voluptatibus ipsa ullam voluptatum laborum praesentium nesciunt est iusto nulla earum ab tenetur!</p>\r\n\r\n            <!-- Share Links -->\r\n            <div class=\"post-share-wrap\">\r\n                <ul class=\"post-share\">\r\n                    <li>\r\n                        <a onclick=\"window.open(\'https://www.facebook.com/sharer.php?s=100&amp;p[url]=http://allstore-html.real-web.pro\',\'sharer\', \'toolbar=0,status=0,width=620,height=280\');\" data-toggle=\"tooltip\" title=\"Share on Facebook\" href=\"javascript:\">\r\n                            <i class=\"fa fa-facebook\"></i>\r\n                        </a>\r\n                    </li>\r\n                    <li>\r\n                        <a onclick=\"popUp=window.open(\'http://twitter.com/home?status=Post with Shortcodes http://allstore-html.real-web.pro\',\'sharer\',\'scrollbars=yes,width=800,height=400\');popUp.focus();return false;\" data-toggle=\"tooltip\" title=\"Share on Twitter\" href=\"javascript:;\">\r\n                            <i class=\"fa fa-twitter\"></i>\r\n                        </a>\r\n                    </li>\r\n                    <li>\r\n                        <a onclick=\"popUp=window.open(\'http://vk.com/share.php?url=http://allstore-html.real-web.pro\',\'sharer\',\'scrollbars=yes,width=800,height=400\');popUp.focus();return false;\" data-toggle=\"tooltip\" title=\"Share on VK\" href=\"javascript:;\">\r\n                            <i class=\"fa fa-vk\"></i>\r\n                        </a>\r\n                    </li>\r\n                    <li>\r\n                        <a data-toggle=\"tooltip\" title=\"Share on Pinterest\" onclick=\"popUp=window.open(\'http://pinterest.com/pin/create/button/?url=http://allstore-html.real-web.pro&amp;description=AllStore HTML Template&amp;media=http://discover.real-web.pro/wp-content/uploads/2016/09/insect-1130497_1920.jpg\',\'sharer\',\'scrollbars=yes,width=800,height=400\');popUp.focus();return false;\" href=\"javascript:;\">\r\n                            <i class=\"fa fa-pinterest\"></i>\r\n                        </a>\r\n                    </li>\r\n                    <li>\r\n                        <a data-toggle=\"tooltip\" title=\"Share on Google +1\" href=\"javascript:;\" onclick=\"popUp=window.open(\'https://plus.google.com/share?url=http://allstore-html.real-web.pro\',\'sharer\',\'scrollbars=yes,width=800,height=400\');popUp.focus();return false;\">\r\n                            <i class=\"fa fa-google-plus\"></i>\r\n                        </a>\r\n                    </li>\r\n                    <li>\r\n                        <a data-toggle=\"tooltip\" title=\"Share on Linkedin\" onclick=\"popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=http://allstore-html.real-web.pro&amp;title=AllStore HTML Template\',\'sharer\',\'scrollbars=yes,width=800,height=400\');popUp.focus();return false;\" href=\"javascript:;\">\r\n                            <i class=\"fa fa-linkedin\"></i>\r\n                        </a>\r\n                    </li>\r\n                    <li>\r\n                        <a data-toggle=\"tooltip\" title=\"Share on Tumblr\" onclick=\"popUp=window.open(\'http://www.tumblr.com/share/link?url=http://allstore-html.real-web.pro&amp;name=AllStore HTML Template&amp;description=Aliquam%2C+consequuntur+laboriosam+minima+neque+nesciunt+quod+repudiandae+rerum+sint.+Accusantium+adipisci+aliquid+architecto+blanditiis+dolorum+excepturi+harum+ipsa%2C+ipsam%2C...\',\'sharer\',\'scrollbars=yes,width=800,height=400\');popUp.focus();return false;\" href=\"javascript:;\">\r\n                            <i class=\"fa fa-tumblr\"></i>\r\n                        </a>\r\n                    </li>\r\n                </ul>\r\n\r\n            \r\n\r\n\r\n        </div>\r\n        <!-- Blog Post - end -->\r\n\r\n\r\n    </section>\r\n</main> ', 'About Us - Kaffemaschinen E-commerce', ' ', null, null);
INSERT INTO `pages` VALUES ('6', 'Contacts', 'contact', '', 'About Us - Kaffemaschinen E-commerce', null, null, null);
INSERT INTO `pages` VALUES ('7', 'Wir Kaufen', 'wir', '', 'Wir Kaufen - Kaffemaschinen E-commerce', null, '2017-12-20 22:17:18', '2017-12-20 22:17:18');

-- ----------------------------
-- Table structure for page_home
-- ----------------------------
DROP TABLE IF EXISTS `page_home`;
CREATE TABLE `page_home` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `button` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of page_home
-- ----------------------------

-- ----------------------------
-- Table structure for page_uber_uns
-- ----------------------------
DROP TABLE IF EXISTS `page_uber_uns`;
CREATE TABLE `page_uber_uns` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of page_uber_uns
-- ----------------------------
INSERT INTO `page_uber_uns` VALUES ('1', 'text', null, 'Kaffemaschinen ist der Online Shop von Brock GmbH und vertreibt erfolgreich auch über Online ein umfangreiches Sortiment. Mit über 30 Jahren Erfahrung ist die Brock GmbH eines der ältesten Brockenhäuser von Zürich. Professionell und privat geführt ohne Trägerverein, Sponsoring und ohne eine Institution im Rücken. Das traditionelle Sortiment umfasst Kleinwaren jeglicher Art, Geschirr, Bücher, gebrauchte Möbel aller Epochen, Bilder, Kleider, Raritäten und interessante EInzelstücke. Dank Verwertungsaufträgen von Grossfirmen und gezielten Einkäufen finden Sie bei uns auch Neuwaren zu unschlagbaren Preisen. Weine, Textilien, Technik und vieles mehr. Die Brock GmbH ist seit 2012 Partner vom Verkaufs- und Auktionsportal spotter.ch', null, '2018-01-24 13:40:33');
INSERT INTO `page_uber_uns` VALUES ('5', 'image', '50% Sale', '\\front\\assets\\img\\about\\1516893129testslider.jpg', '2018-01-25 16:12:09', '2018-01-25 16:12:09');

-- ----------------------------
-- Table structure for page_wir_kaufen
-- ----------------------------
DROP TABLE IF EXISTS `page_wir_kaufen`;
CREATE TABLE `page_wir_kaufen` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of page_wir_kaufen
-- ----------------------------
INSERT INTO `page_wir_kaufen` VALUES ('1', 'Sie haben Waren, die Sie gerne verkaufen möchten? Bei uns sind Sie immer herzlich Willkommen. Wir kaufen Waren jeglicher Art und sind stets interessiert an neuen Angeboten. Gerne können Sie durch unser Kontaktformular mit den nötigen Informationen und Bildern, die Ware zuschicken. Wir werden Ihr Angebot innert 72 Stunden prüfen und Sie darauf kontaktieren.', '2018-01-24 04:25:09', '2018-01-24 04:25:09');

-- ----------------------------
-- Table structure for partners
-- ----------------------------
DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of partners
-- ----------------------------
INSERT INTO `partners` VALUES ('2', 'Webtory', '<p>Webtory</p>', '/uploads/partner/1520943665Kafa.png', 'http://www.webtory.rs', '2018-03-13 13:21:05', '2018-03-13 13:21:05');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for popups
-- ----------------------------
DROP TABLE IF EXISTS `popups`;
CREATE TABLE `popups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of popups
-- ----------------------------
INSERT INTO `popups` VALUES ('6', '9', 'Special offer', '/uploads/popup/1519575369Beautiful-Wallpaper.jpg', '1', '2018-05-22', '2018-02-25 17:16:09', '2018-03-01 11:50:40');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('BASIC','VARIATION','DOWNLOADABLE','VARIATION-COMBINATION') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'BASIC',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `pdv` decimal(11,1) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL,
  `unavailable_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `track_stock` tinyint(4) DEFAULT NULL,
  `is_taxable` tinyint(4) DEFAULT NULL,
  `contact_only` tinyint(1) NOT NULL DEFAULT '0',
  `has_packaging` tinyint(1) NOT NULL DEFAULT '0',
  `packaging` int(11) DEFAULT NULL,
  `page_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` tinyint(4) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `delivery` tinyint(4) DEFAULT '1',
  `new_product` tinyint(4) DEFAULT NULL,
  `hit_product` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('37', 'BASIC', 'Dek Cremaso', 'dek-cremaso', '<p>Lavazza hat ein&nbsp;<strong>Restyling der Produkte A Modo Mio&nbsp;</strong>unternommen. Ab Mai 2015 sind die Namen und das Design der alten Kapseln&nbsp;<strong>Soavemente A Modo Mio auf&nbsp;Soaveo&nbsp;</strong>ge&auml;ndert worden. Die Mischungen bleiben doch dieselben. Die Kapseln A Modo Mio Soavemente, Farbe violett, sind eine Mischung von 100% Arabicas aus Brasilien und Zentralamerika. Durch die delikate mittlere R&ouml;stung erhalten Sie einen angenehm weichen Espresso f&uuml;r Kaffeeliebhaber die einen leichten und zarten Geschmack bevorzugen. Das organoleptische Profil kann es best&auml;tigen: Aroma 3/5, K&ouml;rper 2/5 und Intensit&auml;t 2,5/5.</p><p>SOAVE soave, con corpo leggero e note floreali. Cos&igrave; &egrave; Soavemente A Modo Mio. Una miscela di dolci Arabica brasiliani impreziosita da pregiati Arabica dell&rsquo;America Centrale, gustosi e dalle note floreali; queste qualit&agrave;, unitamente alla tostatura delicata e alla particolare macinatura, danno vita a un espresso soave ed equilibrato, per gli amanti di un gusto pi&ugrave; morbido e leggero. 100% Arabica.</p><p>&nbsp;</p>', '7.7', '1', '1', null, null, null, '0', '0', null, null, null, '1', '346.00', '300.00', '1', '1', '1', '2018-02-24 12:32:51', '2018-03-14 16:25:26', null);
INSERT INTO `products` VALUES ('40', 'BASIC', 'Donna Regina Classico Napoletano', 'donna-regina-classico-napoletano', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7.7', '1', '1', null, null, null, '0', '0', null, null, null, '0', '55.00', null, '1', '1', '1', '2018-02-24 12:48:56', '2018-03-06 12:00:01', null);
INSERT INTO `products` VALUES ('41', 'BASIC', 'Borbone Blu Espresso Point 10 Kapseln', 'borbone-blu-espresso-point-10-kapseln', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7.7', '1', '1', null, null, null, '0', '1', '100', null, null, '1', '10.00', '8.00', '1', '1', '1', '2018-02-24 12:50:18', '2018-03-06 12:00:03', null);
INSERT INTO `products` VALUES ('42', 'BASIC', 'Borbone Blu Espresso 100er Pack', 'borbone-blu-espresso-100er-pack', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '0', 'test', null, null, '0', '1', '100', null, null, '0', '4.00', null, '1', '1', '1', '2018-02-24 12:51:49', '2018-03-06 13:35:01', null);
INSERT INTO `products` VALUES ('43', 'BASIC', 'Kaffemaschinen num.1.', 'kaffemaschinen-num1', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7.7', '1', '1', null, null, null, '1', '0', null, null, null, '0', '0.00', null, '1', null, null, '2018-02-24 12:54:10', '2018-03-06 12:00:03', null);
INSERT INTO `products` VALUES ('44', 'BASIC', 'Kaffeetasse', 'kaffeetasse', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7.7', '1', '1', null, null, null, '0', '0', null, null, null, '1', '400.00', '349.00', '1', null, null, '2018-02-24 13:12:02', '2018-03-06 12:00:04', null);
INSERT INTO `products` VALUES ('45', 'BASIC', 'LAVAZZA TOP CLASS (6XVERPACKUNGEN = 6 KG)', 'lavazza-top-class-6xverpackungen-6-kg', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7.7', '1', '1', null, null, null, '0', '0', null, null, null, '1', '600000.00', '570000.00', '1', '1', '1', '2018-02-24 13:16:11', '2018-03-06 12:00:05', null);
INSERT INTO `products` VALUES ('46', 'BASIC', 'DIVERSE PIENAROMA (6XVERPACKUNGEN = 6 KG)', 'lavazza-pienaroma-6xverpackungen-6-kg', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '0', 'test', null, null, '0', '0', null, null, null, '1', '170.00', '100.00', '1', '1', null, '2018-02-24 13:21:47', '2018-03-06 13:35:06', null);
INSERT INTO `products` VALUES ('48', 'BASIC', '6 Cappuccino Tassen Borbone', '6-cappuccino-tassen-borbone', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7.7', '1', '1', null, null, null, '0', '0', null, null, null, '0', '45.00', null, '1', '0', '0', '2018-03-01 15:54:54', '2018-03-06 12:00:14', null);
INSERT INTO `products` VALUES ('49', 'BASIC', 'Borbone ESPRESSO - KIT 100', 'borbone-espresso-kit-100', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '1', '68.00', '50.00', '1', '1', '1', '2018-03-01 15:57:11', '2018-03-06 13:35:07', null);
INSERT INTO `products` VALUES ('51', 'BASIC', 'Borbone Verde Espresso 100er Pack', 'borbone-verde-espresso-100er-pack', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '1', '100', null, null, '0', '7.00', null, '1', '1', '1', '2018-03-01 16:04:32', '2018-03-06 13:35:08', null);
INSERT INTO `products` VALUES ('52', 'BASIC', 'Borbone Rossa Espresso 100er Pack', 'borbone-rossa-espresso-100er-pack', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7.7', '1', '0', 'test', null, null, '0', '1', '100', null, null, '0', '9.00', null, '1', '1', '0', '2018-03-01 16:07:54', '2018-03-06 13:19:08', null);
INSERT INTO `products` VALUES ('53', 'BASIC', 'ESPRESSO INTENSO', 'espresso-intenso', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '11.00', null, '1', '1', null, '2018-03-01 16:10:32', '2018-03-06 13:35:10', null);
INSERT INTO `products` VALUES ('54', 'BASIC', 'ESPRESSO RICCO', 'espresso-ricco', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7.7', '1', '1', null, null, null, '0', '0', null, null, null, '0', '81.00', null, '1', null, '1', '2018-03-01 16:12:08', '2018-03-06 12:01:34', null);
INSERT INTO `products` VALUES ('55', 'BASIC', 'Kaffemaschinen num.2.', 'kaffemaschinen-num2', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '1', '0', null, null, null, '1', '463.00', '430.00', '1', null, null, '2018-03-01 16:16:55', '2018-03-06 13:35:12', null);
INSERT INTO `products` VALUES ('56', 'BASIC', 'Kaffemühlen num 1', 'kaffemuhlen-num-1', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7.7', '1', '1', null, null, null, '1', '0', null, null, null, '0', '231.00', null, '1', null, null, '2018-03-01 16:23:16', '2018-03-06 12:01:38', null);
INSERT INTO `products` VALUES ('57', 'BASIC', 'Kaffemühlen num 2', 'kaffemuhlen-num-2', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', 'test', null, null, '0', '0', null, null, null, '0', '623.00', null, '1', '0', '0', '2018-03-01 16:23:52', '2018-03-06 13:19:11', null);
INSERT INTO `products` VALUES ('58', 'BASIC', 'Aroma Top', 'mokador', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '34.00', null, '1', null, '1', '2018-03-09 13:09:14', '2018-03-09 13:11:49', null);
INSERT INTO `products` VALUES ('59', 'BASIC', '100% Arabica', '100-arabica', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '53.00', null, '1', null, '1', '2018-03-09 13:12:17', '2018-03-09 13:13:10', null);
INSERT INTO `products` VALUES ('60', 'BASIC', 'Decaffeinato', 'decaffeinato', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '245.00', null, '1', null, '1', '2018-03-09 13:13:42', '2018-03-09 13:14:04', null);
INSERT INTO `products` VALUES ('61', 'BASIC', 'Mokador Florita 1 kg Bohne', 'mokador-florita-1-kg-bohne', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '67.00', null, '1', null, '1', '2018-03-09 13:14:50', '2018-03-09 13:15:24', null);
INSERT INTO `products` VALUES ('62', 'BASIC', 'Florita', 'florita', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '68.00', null, '1', null, '1', '2018-03-09 13:15:39', '2018-03-09 13:16:07', null);
INSERT INTO `products` VALUES ('63', 'BASIC', 'Mokador G.M.M. Gran Miscela 1 kg Bohne', 'mokador-gmm-gran-miscela-1-kg-bohne', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '56.00', null, '1', null, '1', '2018-03-09 13:16:39', '2018-03-09 13:17:07', null);
INSERT INTO `products` VALUES ('64', 'BASIC', 'Mokador Kapseln Aroma TOP 100 Stück', 'mokador-kapseln-aroma-top-100-stuck', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '1', '100', null, null, '0', '11.00', null, '1', null, '1', '2018-03-09 13:17:49', '2018-03-14 16:06:09', '2018-03-14 16:06:09');
INSERT INTO `products` VALUES ('65', 'BASIC', '10 Mokador Nespresso Arabica', '10-mokador-nespresso-arabica', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '56.00', null, '1', null, '0', '2018-03-09 13:20:34', '2018-03-14 16:06:05', '2018-03-14 16:06:05');
INSERT INTO `products` VALUES ('66', 'BASIC', 'Dado Optima', 'dado-optima', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '460.00', null, '1', null, '1', '2018-03-14 16:10:29', '2018-03-14 16:12:17', null);
INSERT INTO `products` VALUES ('67', 'BASIC', 'Elle', 'elle', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '470.00', null, '1', null, null, '2018-03-14 16:13:02', '2018-03-14 16:13:32', null);
INSERT INTO `products` VALUES ('68', 'BASIC', 'Tata', 'tata', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '500.00', null, '1', null, null, '2018-03-14 16:13:42', '2018-03-14 16:14:12', null);
INSERT INTO `products` VALUES ('69', 'BASIC', 'Xelle', 'xelle', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '450.00', null, '1', null, null, '2018-03-14 16:14:23', '2018-03-14 16:14:47', null);
INSERT INTO `products` VALUES ('70', 'BASIC', 'Borbone red 50 filtro ese 44 mm', 'borbone-red-50-filtro-ese-44-mm', '<p>Kr&auml;ftiger starker Kaffee mit vollem Geschmack. Einen Energieschub f&uuml;r Sie.&nbsp;&nbsp; </p><p>Cialde Miscela ROSSA Borbone Filtrocarta ESE 44mm</p><p>Grazie all&#39;equilibrato dosaggio tra Arabica e Robusta e al perfetto grado di tostatura, questa &egrave; la miscela adatta a chi oltre all&#39;aroma apprezza la cremosit&agrave; del caff&egrave; in tazza</p>', '2.5', '1', '1', null, null, null, '0', '0', null, null, null, '0', '32.00', null, '1', null, '1', '2018-03-14 16:33:04', '2018-03-14 16:35:01', null);
INSERT INTO `products` VALUES ('71', 'BASIC', 'Borbone Cialda Oro 50 filtro ese 44 mm', 'borbone-cialda-oro-50-filtro-ese-44-mm', '<p>Der Kaffee f&uuml;r echte Kenner. Der h&ouml;chste Ausdruck der neapolitanischen Tradition</p><p>Caff&egrave; per veri intenditori, dal gusto classico e inimitabile, rappresenta la tradizione dell&#39;espresso napoletano.</p>', '2.5', '1', '1', null, null, null, '0', '1', '50', null, null, '0', '70.00', null, '1', null, null, '2018-03-14 16:35:34', '2018-03-14 16:37:17', null);
INSERT INTO `products` VALUES ('72', 'BASIC', 'Borbone Cialda Dek 50 filtro ese 44 mm', 'borbone-cialda-dek-50-filtro-ese-44-mm', '<p>Entkoffeinierter neapolitanischer Espresso</p><p>&nbsp;</p>', '2.5', '1', '1', null, null, null, '0', '1', '50', null, null, '0', '48.00', null, '1', '1', '1', '2018-03-14 16:37:55', '2018-03-14 16:39:04', null);

-- ----------------------------
-- Table structure for product_combinations
-- ----------------------------
DROP TABLE IF EXISTS `product_combinations`;
CREATE TABLE `product_combinations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `combination_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_combinations_combination_id_foreign` (`combination_id`),
  KEY `product_combinations_product_id_foreign` (`product_id`),
  CONSTRAINT `product_combinations_ibfk_1` FOREIGN KEY (`combination_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_combinations_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_combinations
-- ----------------------------

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `filters` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `is_main_image` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES ('57', '40', 'uploads/catalog/images/s/m/y/Donna Regina Classico Napoletano.jpg', 'none', '1', '2018-02-24 12:49:51', '2018-02-24 13:26:20');
INSERT INTO `product_images` VALUES ('58', '40', 'uploads/catalog/images/k/8/w/Donna Regina Forte Napoletano.jpg', 'none', '0', '2018-02-24 12:49:51', '2018-02-24 13:26:20');
INSERT INTO `product_images` VALUES ('59', '41', 'uploads/catalog/images/0/k/5/Borbone Blu Espresso Point 10 Kapseln.jpg', 'none', '1', '2018-02-24 12:51:24', '2018-02-24 13:26:09');
INSERT INTO `product_images` VALUES ('60', '41', 'uploads/catalog/images/o/l/1/Borbone Nera Espresso Point 10 Kapseln.jpg', 'none', '0', '2018-02-24 12:51:24', '2018-02-24 13:26:09');
INSERT INTO `product_images` VALUES ('61', '42', 'uploads/catalog/images/r/4/q/1.jpg', 'none', '1', '2018-02-24 12:53:25', '2018-02-24 13:25:59');
INSERT INTO `product_images` VALUES ('62', '42', 'uploads/catalog/images/a/p/i/2.jpg', 'none', '0', '2018-02-24 12:53:25', '2018-02-24 13:25:59');
INSERT INTO `product_images` VALUES ('63', '43', 'uploads/catalog/images/p/y/d/71RfFCdNJNL._SX522_.jpg', 'none', '1', '2018-02-24 12:55:04', '2018-02-24 13:25:48');
INSERT INTO `product_images` VALUES ('64', '44', 'uploads/catalog/images/w/s/e/coffee-pot-5.jpg', 'none', '1', '2018-02-24 13:13:15', '2018-02-24 13:19:54');
INSERT INTO `product_images` VALUES ('65', '45', 'uploads/catalog/images/f/n/1/LAVAZZA CREMA E AROMA (6XVERPACKUNGEN = 6 KG).jpg', 'none', '1', '2018-02-24 13:17:56', '2018-02-24 13:25:24');
INSERT INTO `product_images` VALUES ('66', '45', 'uploads/catalog/images/n/s/1/LAVAZZA GRAN ESPRESSO (6XVERPACKUNGEN = 6 KG) .jpg', 'none', '0', '2018-02-24 13:17:56', '2018-02-24 13:25:24');
INSERT INTO `product_images` VALUES ('68', '46', 'uploads/catalog/images/f/i/a/LAVAZZA TOP CLASS (6XVERPACKUNGEN = 6 KG).jpg', 'none', '1', '2018-02-24 13:23:29', '2018-02-24 13:25:15');
INSERT INTO `product_images` VALUES ('69', '48', 'uploads/catalog/images/h/h/r/6 Cappuccino Tassen Borbone.jpg', 'none', '1', '2018-03-01 15:56:55', '2018-03-01 15:56:55');
INSERT INTO `product_images` VALUES ('70', '49', 'uploads/catalog/images/x/w/x/Borbone ESPRESSO - KIT 100.jpg', 'none', '1', '2018-03-01 15:57:51', '2018-03-01 15:57:51');
INSERT INTO `product_images` VALUES ('71', '51', 'uploads/catalog/images/l/g/u/1.jpg', 'none', '1', '2018-03-01 16:07:28', '2018-03-01 16:07:28');
INSERT INTO `product_images` VALUES ('72', '51', 'uploads/catalog/images/p/h/k/2.jpg', 'none', '0', '2018-03-01 16:07:28', '2018-03-01 16:07:28');
INSERT INTO `product_images` VALUES ('73', '52', 'uploads/catalog/images/p/q/n/2.jpg', 'none', '1', '2018-03-01 16:08:48', '2018-03-01 16:08:48');
INSERT INTO `product_images` VALUES ('74', '52', 'uploads/catalog/images/0/g/o/1.jpg', 'none', '0', '2018-03-01 16:08:48', '2018-03-01 16:08:48');
INSERT INTO `product_images` VALUES ('75', '53', 'uploads/catalog/images/j/l/a/ESPRESSO INTENSO.jpg', 'none', '1', '2018-03-01 16:11:47', '2018-03-01 16:11:47');
INSERT INTO `product_images` VALUES ('76', '54', 'uploads/catalog/images/k/n/g/ESPRESSO RICCO.jpg', 'none', '1', '2018-03-01 16:12:41', '2018-03-01 16:12:41');
INSERT INTO `product_images` VALUES ('77', '55', 'uploads/catalog/images/e/z/4/10032096_UK_0001_titel___Klarstein_Aromatica_Kaffeemaschine_Mahlwerk_Glas.jpg', 'none', '1', '2018-03-01 16:18:34', '2018-03-01 16:18:34');
INSERT INTO `product_images` VALUES ('78', '56', 'uploads/catalog/images/d/0/7/gorenje_SMK150B.jpg', 'none', '1', '2018-03-01 16:23:41', '2018-03-01 16:23:41');
INSERT INTO `product_images` VALUES ('79', '57', 'uploads/catalog/images/l/a/9/nc3685_0.jpg', 'none', '1', '2018-03-01 16:24:15', '2018-03-06 13:15:44');
INSERT INTO `product_images` VALUES ('80', '58', 'uploads/catalog/images/w/y/y/AROMA TOP.jpg', 'none', '1', '2018-03-09 13:11:07', '2018-03-09 13:11:48');
INSERT INTO `product_images` VALUES ('81', '59', 'uploads/catalog/images/b/c/h/100% ARABICA.jpg', 'none', '1', '2018-03-09 13:13:10', '2018-03-09 13:13:10');
INSERT INTO `product_images` VALUES ('82', '60', 'uploads/catalog/images/0/n/1/DECAFFEINATO.jpg', 'none', '1', '2018-03-09 13:14:04', '2018-03-09 13:14:04');
INSERT INTO `product_images` VALUES ('83', '61', 'uploads/catalog/images/m/a/o/Mokador Florita, 1 kg Bohne .jpg', 'none', '1', '2018-03-09 13:15:24', '2018-03-09 13:15:24');
INSERT INTO `product_images` VALUES ('84', '62', 'uploads/catalog/images/m/x/r/FLORITA .jpeg', 'none', '1', '2018-03-09 13:16:07', '2018-03-09 13:16:07');
INSERT INTO `product_images` VALUES ('85', '63', 'uploads/catalog/images/d/f/1/Mokador G.M.M. Gran Miscela, 1 kg Bohne .jpg', 'none', '1', '2018-03-09 13:17:07', '2018-03-09 13:17:07');
INSERT INTO `product_images` VALUES ('86', '64', 'uploads/catalog/images/j/q/b/Mokador Kapseln Aroma TOP 100 Stück.jpg', 'none', '1', '2018-03-09 13:19:06', '2018-03-09 13:20:05');
INSERT INTO `product_images` VALUES ('87', '65', 'uploads/catalog/images/g/9/l/10 Mokador Nespresso® compatible capsules Cremoso .jpg', 'none', '1', '2018-03-09 13:21:18', '2018-03-09 13:21:18');
INSERT INTO `product_images` VALUES ('88', '66', 'uploads/catalog/images/b/e/n/3.jpg', 'none', '1', '2018-03-14 16:12:17', '2018-03-14 16:12:17');
INSERT INTO `product_images` VALUES ('89', '67', 'uploads/catalog/images/d/i/y/5.jpg', 'none', '1', '2018-03-14 16:13:32', '2018-03-14 16:13:32');
INSERT INTO `product_images` VALUES ('90', '68', 'uploads/catalog/images/s/h/t/6.jpg', 'none', '1', '2018-03-14 16:14:12', '2018-03-14 16:14:12');
INSERT INTO `product_images` VALUES ('91', '69', 'uploads/catalog/images/n/n/b/1.jpg', 'none', '1', '2018-03-14 16:14:48', '2018-03-14 16:14:48');
INSERT INTO `product_images` VALUES ('92', '37', 'uploads/catalog/images/7/1/g/Lavazza Soave.png', 'none', '1', '2018-03-14 16:25:26', '2018-03-14 16:25:26');
INSERT INTO `product_images` VALUES ('93', '70', 'uploads/catalog/images/m/x/a/Borbone Borbone.Cialda.red.50 filtro ese 44 mm.jpeg', 'none', '1', '2018-03-14 16:35:01', '2018-03-14 16:35:01');
INSERT INTO `product_images` VALUES ('94', '71', 'uploads/catalog/images/r/t/b/Borbone Borbone.Cialda.Oro.50 filtro ese 44 mm.jpeg', 'none', '1', '2018-03-14 16:37:17', '2018-03-14 16:37:17');
INSERT INTO `product_images` VALUES ('95', '72', 'uploads/catalog/images/l/u/i/Borbone Borbone.Cialda.Dek.50 filtro ese 44 mm.jpeg', 'none', '1', '2018-03-14 16:39:04', '2018-03-14 16:39:04');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'administrator', 'Administrator Role has all access', '2017-11-14 09:38:16', '2017-11-14 09:38:16');
INSERT INTO `roles` VALUES ('2', 'moderator', 'Moderator Role hasn\'t all access', '2017-11-29 14:00:56', '2017-11-29 14:00:56');

-- ----------------------------
-- Table structure for subscribers
-- ----------------------------
DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of subscribers
-- ----------------------------
INSERT INTO `subscribers` VALUES ('9', 'o@o.com', '2017-12-21 09:49:37', '2017-12-21 09:49:37');
INSERT INTO `subscribers` VALUES ('11', 'elza@e.com', '2017-12-21 10:45:48', '2017-12-21 10:45:48');
INSERT INTO `subscribers` VALUES ('12', 'tatatira@tatatira.rs', '2018-01-15 02:47:22', '2018-01-15 02:47:22');

-- ----------------------------
-- Table structure for subscriptions
-- ----------------------------
DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of subscriptions
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_company` tinyint(1) DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('GUEST','LIVE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'LIVE',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Herr', 'Webtory', 'Test', 'test@webtory.rs', '$2y$10$j4lFvm2pUkoxtfnGCOincO8Z6MnQlAcdhwAC2hM8s/qm6eT2NGA5W', null, null, null, null, 'LIVE', 't3MNZa7FF4mD6OPvqJGzDaw2FlwnF0ScMfcvXqgTMiExKCmAkDnZl5LPLJKU', 'cus_CNWZiq3hD6Y8Tc', null, null, '2018-03-13 15:09:34', '2017-11-14 09:44:42', '2018-03-13 15:09:34', '1', null);
INSERT INTO `users` VALUES ('2', 'Herr', 'Test', 'Test', 'test@test.com', '$2y$10$0QvoqWf4WjdBC0GqhQy3DuOqcTrWgWpyO7v.F9xxs3X.9mKyjCUa2', null, null, null, null, 'LIVE', null, null, null, null, null, '2018-02-24 12:49:10', '2018-02-24 12:49:10', '0', 'dGVzdEB0ZXN0LmNvbQ==');

-- ----------------------------
-- Table structure for user_viewed_products
-- ----------------------------
DROP TABLE IF EXISTS `user_viewed_products`;
CREATE TABLE `user_viewed_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_viewed_products_product_id_foreign` (`product_id`),
  KEY `user_viewed_products_user_id_foreign` (`user_id`),
  CONSTRAINT `user_viewed_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_viewed_products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_viewed_products
-- ----------------------------

-- ----------------------------
-- Table structure for visitors
-- ----------------------------
DROP TABLE IF EXISTS `visitors`;
CREATE TABLE `visitors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `agent` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visitors_user_id_foreign` (`user_id`),
  CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of visitors
-- ----------------------------
