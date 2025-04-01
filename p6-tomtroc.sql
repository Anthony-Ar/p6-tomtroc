/*
 Navicat Premium Dump SQL

 Source Server         : Docker
 Source Server Type    : MySQL
 Source Server Version : 90200 (9.2.0)
 Source Host           : localhost:3306
 Source Schema         : p6-tomtroc

 Target Server Type    : MySQL
 Target Server Version : 90200 (9.2.0)
 File Encoding         : 65001

 Date: 31/03/2025 18:18:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `ownerId` int NOT NULL,
  `createdAt` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES (1, 'Esther', 'Alabaster', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover1.png', 1, 27, '2025-03-14 08:30:28');
INSERT INTO `book` VALUES (2, 'The Kinkfolk Table', 'Nathan Williams', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', '/build/images/book-cover/frosty-ilze-tfYL1j1jKNo-unsplash.png', 1, 27, '2025-03-14 08:30:31');
INSERT INTO `book` VALUES (3, 'Wabi Sabi', 'Beth Kempton', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover3.png', 1, 27, '2025-03-14 08:30:34');
INSERT INTO `book` VALUES (5, 'Delight!', 'Justin Rossow', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover5.png', 1, 27, '2025-03-14 08:41:21');
INSERT INTO `book` VALUES (4, 'Milk & honey', 'Rupi Kaur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover4.png', 1, 27, '2025-03-14 08:40:36');
INSERT INTO `book` VALUES (6, 'Milwaukee Mission', 'Elder Cooper Low', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover6.png', 1, 27, '2025-03-14 08:41:41');
INSERT INTO `book` VALUES (7, 'Minimalist Graphics', 'Julia Schonlau', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover7.png', 1, 27, '2025-03-14 08:42:00');
INSERT INTO `book` VALUES (8, 'Hygge', 'Meik Wiking', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover8.png', 1, 27, '2025-03-14 08:42:15');
INSERT INTO `book` VALUES (9, 'Innovation', 'Matt Ridley', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover9.png', 1, 27, '2025-03-14 08:42:34');
INSERT INTO `book` VALUES (10, 'Psalms', 'Alabaster', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover10.png', 1, 27, '2025-03-14 08:42:50');
INSERT INTO `book` VALUES (11, 'Thinking, Fast & Slow', 'Daniel Kahneman', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover11.png', 0, 27, '2025-03-14 08:43:10');
INSERT INTO `book` VALUES (12, 'A Book Full Of Hope', 'Rupi Kaur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover12.png', 1, 27, '2025-03-14 08:43:26');
INSERT INTO `book` VALUES (13, 'The Subtle Art Of...', 'Mark Manson', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover13.png', 1, 27, '2025-03-14 08:43:50');
INSERT INTO `book` VALUES (14, 'Narnia', 'C.S Lewis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover14.png', 0, 27, '2025-03-14 08:44:03');
INSERT INTO `book` VALUES (15, 'Company Of One', 'Paul Jarvis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover15.png', 1, 27, '2025-03-14 08:44:15');
INSERT INTO `book` VALUES (16, 'The Two Towers', 'J.R.R Tolkien', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam aliquam augue ac erat consequat, a pellentesque mi tincidunt. Nam dictum eu purus sit amet fringilla. Aenean vulputate magna vel purus dignissim scelerisque. In placerat, massa sed consequat lobortis, mi massa volutpat massa, ut pulvinar ante ex vulputate arcu. Integer cursus enim ac risus gravida, sed lobortis urna suscipit. Nam sapien lacus, volutpat eget vulputate eu, ornare in nisi. Aliquam quis efficitur velit.\r\n\r\nFusce mi est, elementum sed arcu id, laoreet condimentum quam. Donec in est in odio placerat elementum. Nulla malesuada cursus neque eget suscipit. Phasellus a mi nisl. Vivamus at turpis nec magna rhoncus tempus non sed enim. Maecenas hendrerit eget arcu vitae consectetur. Proin aliquet porta pulvinar. Aenean id ornare sapien, id molestie nisi. Nulla varius libero non rutrum posuere. Aliquam in.', '/build/images/book-cover/cover16.png', 1, 27, '2025-03-14 08:44:31');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ownerId` int NOT NULL,
  `receiverId` int NOT NULL,
  `date` datetime NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES (1, 32, 27, '2025-03-27 07:36:09', 'Salut !');
INSERT INTO `message` VALUES (2, 32, 27, '2025-03-27 06:47:44', 'Bonjour');
INSERT INTO `message` VALUES (3, 33, 27, '2025-03-26 07:48:22', 'Test');
INSERT INTO `message` VALUES (4, 32, 27, '2025-03-27 07:48:31', 'Encore un test');
INSERT INTO `message` VALUES (5, 27, 32, '2025-03-11 08:58:19', 'Aaaaaaa');
INSERT INTO `message` VALUES (6, 27, 32, '2025-03-27 10:17:37', 'jjjjjjj');
INSERT INTO `message` VALUES (7, 27, 32, '2025-03-27 10:18:17', 'efezfzfezfze');
INSERT INTO `message` VALUES (8, 27, 32, '2025-03-27 10:18:51', 'encore un message !');
INSERT INTO `message` VALUES (9, 27, 32, '2025-03-27 10:20:56', 'encore un autre message');
INSERT INTO `message` VALUES (10, 27, 33, '2025-03-27 12:32:32', 'Réponse au test ');
INSERT INTO `message` VALUES (11, 27, 32, '2025-03-27 12:32:52', 'encore un');
INSERT INTO `message` VALUES (12, 27, 33, '2025-03-27 12:33:26', 'réponse 2');
INSERT INTO `message` VALUES (13, 27, 32, '2025-03-27 12:33:54', 'et encore');
INSERT INTO `message` VALUES (14, 27, 33, '2025-03-27 12:33:57', 'test 2');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `inscriptionDate` datetime NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (27, 'LostSomewhere', 'anthony.arrighi@orange.fr', '$2y$12$3e6qvXLVn4lnLwWWs2RIseXFnFucXQKGzbCg9..pbxYoavb8wi4oq', '2023-01-01 16:37:46', '/build/images/avatar/avatar.png');
INSERT INTO `user` VALUES (28, 'emilie', 'anthony.arrighi@orange.fr0', '$2y$12$KKMgpLQXYgvAyIKqTjxpS.vUoNt3Got.2Z5RVL3EBYPHqEvAbInES', '2025-03-01 16:37:49', '/build/images/avatar/avatar.png');
INSERT INTO `user` VALUES (29, 'emilie', 'anthony.arrighi@orange.fr0', '$2y$12$QkXnk8mSC6yw2.QWTF1IP.9Er5yvXJ.ovNEjuq0sq/kenq.i7TEgy', '2025-03-01 16:37:51', '/build/images/avatar/avatar.png');
INSERT INTO `user` VALUES (30, 'emilie', 'anthony.arrighi@orange.fr0', '$2y$12$L7ePBs1tvUoA5SgAVFeueuK57Xigitdxey0wzoYGUPR9XiNKDAO6i', '2025-03-01 16:37:54', '/build/images/avatar/avatar.png');
INSERT INTO `user` VALUES (31, 'emilie', 'anthony.arrighi@orange.fr0', '$2y$12$PRI7bDxrXacjA951jQ23i.l3E9/8/rOBLlhreWNt2FxNZyoSGdhd6', '2025-03-01 16:37:56', '/build/images/avatar/avatar.png');
INSERT INTO `user` VALUES (32, 'LostSomewhere', 'anthony.arrighi@orange.fr0', '$2y$12$3e6qvXLVn4lnLwWWs2RIseXFnFucXQKGzbCg9..pbxYoavb8wi4oq', '2025-03-01 16:37:59', '/build/images/avatar/avatar.png');
INSERT INTO `user` VALUES (33, 'fefz', 'efe', '$2y$12$QlO954ubRL/Qnd08KKvIZ.E5bGuuN7jvLbAE0pJOTfFTZRdSTnIuO', '2025-03-01 16:38:01', '/build/images/avatar/avatar.png');

SET FOREIGN_KEY_CHECKS = 1;
