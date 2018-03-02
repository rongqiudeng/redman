/*
Navicat MySQL Data Transfer

Source Server         : 192.168.199.98_3306
Source Server Version : 50546
Source Host           : 192.168.199.98:3306
Source Database       : affilate

Target Server Type    : MYSQL
Target Server Version : 50546
File Encoding         : 65001

Date: 2017-12-14 18:58:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for order_list
-- ----------------------------
DROP TABLE IF EXISTS `order_list`;
CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `pageId` int(11) DEFAULT NULL,
  `orderSN` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `tracking` varchar(255) DEFAULT NULL,
  `commission` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `orderTime` datetime DEFAULT NULL,
  `paymentTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_list
-- ----------------------------

-- ----------------------------
-- Table structure for rm_account
-- ----------------------------
DROP TABLE IF EXISTS `rm_account`;
CREATE TABLE `rm_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(11) DEFAULT NULL,
  `page_id` varchar(11) DEFAULT NULL,
  `user_number` varchar(20) DEFAULT NULL,
  `pp_email` varchar(30) DEFAULT NULL,
  `pp_phone` varchar(16) DEFAULT NULL,
  `order_price` decimal(10,2) DEFAULT NULL,
  `flow_odd_number` varchar(20) DEFAULT NULL,
  `bonus` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_account
-- ----------------------------
INSERT INTO `rm_account` VALUES ('1', '002', '002', '002', '212', '20', '2020.00', '202', '202.00', '1', '2017-11-11 13:58:30');
INSERT INTO `rm_account` VALUES ('2', '001', '213', '1312', '1321', '131', '321.00', '31', '3213.00', '0', '2017-11-11 13:58:45');

-- ----------------------------
-- Table structure for rm_card
-- ----------------------------
DROP TABLE IF EXISTS `rm_card`;
CREATE TABLE `rm_card` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `images_url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `url` varchar(200) CHARACTER SET utf8 NOT NULL,
  `auther` varchar(10) CHARACTER SET utf8 NOT NULL,
  `content` varchar(6000) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `send_times` bigint(30) DEFAULT NULL,
  `create_time` date NOT NULL DEFAULT '0000-00-00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `send_time` datetime DEFAULT NULL,
  `down_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rm_card
-- ----------------------------
INSERT INTO `rm_card` VALUES ('13', '/upload/card/20171110/8d2c027ce0bfddc39927bd8b1ffe19f5.jpg', 'http://www.baidu.com/?utm=12312311&amp;uid=123131&amp;pid=1231313&amp;sign=12313113sdfdfsdfsd', 'admin', 'You Need A Multicolor Print Maxi Dress ????????????\r\nShop Left=&gt;http://bit.ly/2zCh3lE\r\nShop Right=&gt;http://bit.ly/2hv2VA4\r\nView More=&gt;http://bit.ly/2n8XsTf', '1', '1', '0', '2017-11-23', '2017-11-23 17:11:38', null, null);
INSERT INTO `rm_card` VALUES ('14', '/upload/card/20171110/157efa11fd7bb901ae6b93c9ab9c5150.jpg', '第2条帖子', 'admin', '&amp;amp;lt;p&amp;amp;gt;第一条帖子&amp;amp;lt;/p&amp;amp;gt;asdasd', '1', '2', '0', '2017-12-11', '2017-12-11 17:49:26', null, null);
INSERT INTO `rm_card` VALUES ('15', '/upload/card/20171110/103d87cdd883922c4710ddd1de00538e.jpeg', 'www.baidu.com', 'admin', '文案：#url1', '1', '2', '0', '2017-12-11', '2017-12-11 17:43:09', null, null);
INSERT INTO `rm_card` VALUES ('16', '/upload/card/20171110/5f13016c2cb509ad5390e58fb106a6b9.png', 'wwdwdadaawdaawdaw', 'admin', '&amp;amp;amp;lt;p&amp;amp;amp;gt;安达市大多&amp;amp;amp;lt;br/&amp;amp;amp;gt;&amp;amp;amp;lt;/p&amp;amp;amp;gt;sdada', '1', '2', '0', '2017-12-11', '2017-12-11 17:49:19', null, null);
INSERT INTO `rm_card` VALUES ('18', '/upload/card/20171121/d36b76c273234323f1cc2ec88f63dd27.jpg', 'adasdaas', 'admin', 'dsadasdadas', '1', '1', '0', '2017-11-21', '0000-00-00 00:00:00', null, null);
INSERT INTO `rm_card` VALUES ('23', '/upload/card/20171122/14713a01aa870c274177284f1c3217da.png', 'DASDASDAS', 'admin', 'ASDASDASDA', '1', '0', null, '2017-11-22', '2017-11-22 15:11:58', null, null);
INSERT INTO `rm_card` VALUES ('24', '/upload/card/20171122/274c7a23d4348ba6c8fbae158d83abb3.jpg', 'adsadasdasdasdasdasdas', 'admin', 'adsasdasdasdasdasdad', '1', '0', null, '2017-11-22', '2017-11-22 15:11:43', null, null);
INSERT INTO `rm_card` VALUES ('25', '/upload/card/20171123/950ec54de57c1f900a9eb1dc89166b45.jpg', 'adadasdasdasasd', 'admin', 'You Need A Multicolor Print Maxi Dress ', '1', '0', null, '2017-11-23', '2017-11-23 17:11:24', null, null);
INSERT INTO `rm_card` VALUES ('26', '/upload/card/20171123/bb8f0b173bbc71fa615eb5a81fe5544a.png', 'sdasdadadasdas', 'admin', 'You Need A Multicolor Print Maxi Dress ????????????\r\nShop Left=&gt;http://bit.ly/2zCh3lE\r\nShop Right=&gt;http://bit.ly/2hv2VA4\r\nView More=&gt;http://bit.ly/2n8XsTf', '1', '0', null, '2017-11-23', '2017-11-23 17:11:44', null, null);
INSERT INTO `rm_card` VALUES ('27', '/upload/card/20171201/87833682ed3d9f695ea47555e626a0e9.jpg', 'http://www.redman.dev/?utm_source=facebook&amp;utm_medium=email&amp;uid=001&amp;uid=140470486718201@http://www.redman.dev/?utm_source=facebook&amp;utm_medium=email&amp;uid=001&amp;uid=140470486718201', 'admin', '第一条测试文案测试url:\r\n第二条测试文案测试url:\r\n第三条测试文案测试url:', '1', '1', null, '2017-12-01', '2017-12-01 15:12:45', null, null);
INSERT INTO `rm_card` VALUES ('28', '/upload/card/20171211/7cb620618ad9cf7c7dfd9559004f27f0.jpg', 'www.baidu.com@www.qq.com', 'admin', 'af见不到解放碑基本知识', '1', '0', null, '2017-12-11', '2017-12-11 09:12:26', null, null);
INSERT INTO `rm_card` VALUES ('29', '/upload/card/20171211/cd19858170100ff9a94ab73fd05dc7a7.jpg', 'www.qq.com', 'admin', 'af见不到解放碑基本知识大叔大婶大', '1', '1', null, '2017-12-11', '2017-12-11 17:19:38', null, null);
INSERT INTO `rm_card` VALUES ('30', '/upload/card/20171211/9d5551f1bd5e9b2bbfe2d28b75614b26.jpg', 'www.rongqiu.com@www.google.com@www.facebookssssdddd.com', 'admin', 'hello world', '1', '1', null, '2017-12-11', '2017-12-11 17:33:59', null, null);
INSERT INTO `rm_card` VALUES ('31', '/upload/card/20171211/2986a8d2ef67a1c9149a8715224db81e.jpg', 'www.taobao.com@www.qiang.com@www.liu.com', 'admin', '文案1', '1', '1', null, '2017-12-11', '2017-12-11 17:19:25', null, null);
INSERT INTO `rm_card` VALUES ('32', '/upload/card/20171211/410568770688d230d5613f24da6882c7.jpg', 'www.taobao.com@www.liu.com', 'admin', '文案1:#url1\r\n文案2:#url2', '1', '0', null, '2017-12-11', '2017-12-11 17:01:11', null, null);

-- ----------------------------
-- Table structure for rm_fbuser
-- ----------------------------
DROP TABLE IF EXISTS `rm_fbuser`;
CREATE TABLE `rm_fbuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `idToken` varchar(500) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `endTime` varchar(255) DEFAULT NULL,
  `scopes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_fbuser
-- ----------------------------
INSERT INTO `rm_fbuser` VALUES ('50', '143063623129377', 'EAACuGCwLx6ABACjJxEsUp5lJ2dx9k4F0OHqi6ZB9lFZCqkZCmkgEpvmiaP82Li44Jnv1S2zKqd3umBZARQeYILxhf4LgXUjh6ZBvZB6WkfPNG12DP0ur166VomCvaBfk5OawlTKW4fq7RZApXZBVL2WGMdZCVxW9NeJ116U7sPRgUbQZDZD', '1', 'Qiangqiang Liu', 'Qiangqiang', 'Liu', 'liuqiangqiang@ideanext.tech', 'https://fb-s-b-a.akamaihd.net/h-ak-fbx/v/t1.0-1/p50x50/23376576_124283641674042_740932320051648378_n.jpg?oh=9eb8f7f96cb4f606efb7abaf4fc45cce&oe=5A977FCD&__gda__=1519679056_df900674a9b1ddea66a587ff74730464', '2017-11-29 18:59:09', '2018-01-28 18:59:09.000000', 'email,publish_actions,manage_pages,pages_show_list,publish_pages,public_profile');
INSERT INTO `rm_fbuser` VALUES ('68', '140470486718201', 'EAACuGCwLx6ABANY2PJZB0yZBHlmn54YZCijPynjZCuAO3iKyCDhsZB4xxfu6rXhKyFcZAevZBrFfe60dv7hLld0rDwcSzXe6GxKZBO83Lz8kgmIaqIBfTQR6J9hxrxpOpZCGbLA9YFPKvDnFAdOvKJb1wfHDz8ZCRIZBoZCOyilyw1n7iQZDZD', '1', 'Rongqiu Deng', 'Rongqiu', 'Deng', '375170667@qq.com', 'https://fb-s-d-a.akamaihd.net/h-ak-fbx/v/t1.0-1/p50x50/23471904_130358241062759_7200350588938919315_n.jpg?oh=311fe5fa9579996cf4ce350dc9fb1d3b&oe=5AC01893&__gda__=1519179684_e9a83c5f863dd90687a3cc09af1797e2', '2017-12-13 16:52:13', '2018-02-11 16:52:13.000000', 'email,publish_actions,manage_pages,pages_show_list,publish_pages,public_profile');

-- ----------------------------
-- Table structure for rm_goods
-- ----------------------------
DROP TABLE IF EXISTS `rm_goods`;
CREATE TABLE `rm_goods` (
  `id` int(20) NOT NULL,
  `user_id` int(30) NOT NULL,
  `page_id` int(30) NOT NULL,
  `goods_number` varchar(30) NOT NULL,
  `goods_money` varchar(30) NOT NULL,
  `following` varchar(30) NOT NULL,
  `commission` varchar(30) NOT NULL,
  `status` varchar(5) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pay_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_goods
-- ----------------------------
INSERT INTO `rm_goods` VALUES ('0', '1322', '2132', 'adsa456', '231', '3213', '2', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `rm_goods` VALUES ('1', '2131', '123', '021312', '12', '110', '1%', '1', '2017-11-09 17:41:25', '2017-11-09 17:41:25');
INSERT INTO `rm_goods` VALUES ('3', '58641', '32132', '3213', '2313', '231', '321', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `rm_goods` VALUES ('4', '12', '122', '21131', '23131', '2313', '231', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `rm_goods` VALUES ('5', '21231', '2311', '23132', '213', '231', '231', '5', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `rm_goods` VALUES ('132', '2311', '32132', '3132', '2313', '23132', '213', '6', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for rm_log_staff_logins
-- ----------------------------
DROP TABLE IF EXISTS `rm_log_staff_logins`;
CREATE TABLE `rm_log_staff_logins` (
  `loginId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL DEFAULT '0',
  `loginTime` datetime NOT NULL,
  `loginIp` varchar(16) NOT NULL,
  PRIMARY KEY (`loginId`),
  KEY `loginTime` (`loginTime`),
  KEY `staffId` (`staffId`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_log_staff_logins
-- ----------------------------
INSERT INTO `rm_log_staff_logins` VALUES ('216', '1', '2017-11-24 12:04:30', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('217', '1', '2017-11-24 14:47:53', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('218', '1', '2017-11-24 18:20:23', '192.168.199.197');
INSERT INTO `rm_log_staff_logins` VALUES ('219', '1', '2017-11-25 09:24:58', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('220', '1', '2017-11-27 09:27:17', '192.168.199.178');
INSERT INTO `rm_log_staff_logins` VALUES ('221', '1', '2017-11-29 18:27:06', '192.168.199.62');
INSERT INTO `rm_log_staff_logins` VALUES ('222', '1', '2017-11-29 18:58:57', '192.168.199.178');
INSERT INTO `rm_log_staff_logins` VALUES ('223', '1', '2017-11-30 10:25:59', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('224', '1', '2017-11-30 10:26:31', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('225', '1', '2017-11-30 10:26:35', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('226', '1', '2017-11-30 10:28:24', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('227', '1', '2017-11-30 10:29:33', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('228', '1', '2017-11-30 10:30:04', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('229', '1', '2017-11-30 10:40:07', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('230', '1', '2017-11-30 10:45:17', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('231', '1', '2017-11-30 10:45:31', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('232', '1', '2017-11-30 10:52:04', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('233', '1', '2017-11-30 11:02:47', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('234', '1', '2017-11-30 11:21:50', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('235', '1', '2017-11-30 18:23:07', '192.168.199.178');
INSERT INTO `rm_log_staff_logins` VALUES ('236', '1', '2017-12-01 11:44:06', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('237', '1', '2017-12-01 15:08:19', '192.168.199.198');
INSERT INTO `rm_log_staff_logins` VALUES ('238', '1', '2017-12-01 15:41:45', '192.168.199.178');
INSERT INTO `rm_log_staff_logins` VALUES ('239', '1', '2017-12-04 09:48:54', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('240', '1', '2017-12-08 11:00:08', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('241', '1', '2017-12-08 17:33:13', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('242', '1', '2017-12-09 10:38:43', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('243', '1', '2017-12-11 09:25:03', '0.0.0.0');
INSERT INTO `rm_log_staff_logins` VALUES ('244', '1', '2017-12-11 09:30:48', '0.0.0.0');
INSERT INTO `rm_log_staff_logins` VALUES ('245', '1', '2017-12-11 10:27:08', '192.168.199.87');
INSERT INTO `rm_log_staff_logins` VALUES ('246', '1', '2017-12-11 11:54:10', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('247', '1', '2017-12-11 11:54:10', '127.0.0.1');
INSERT INTO `rm_log_staff_logins` VALUES ('248', '1', '2017-12-12 09:27:58', '0.0.0.0');
INSERT INTO `rm_log_staff_logins` VALUES ('249', '1', '2017-12-14 09:41:33', '192.168.199.178');

-- ----------------------------
-- Table structure for rm_member
-- ----------------------------
DROP TABLE IF EXISTS `rm_member`;
CREATE TABLE `rm_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(11) DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `PayPalTel` varchar(255) DEFAULT NULL,
  `PayPal` varchar(255) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `sex` tinyint(2) DEFAULT NULL,
  `secretKey` int(32) NOT NULL,
  `staffPhoto` varchar(150) DEFAULT NULL,
  `nickname` varchar(20) NOT NULL,
  `workStatus` tinyint(4) NOT NULL DEFAULT '1',
  `staffStatus` tinyint(4) NOT NULL DEFAULT '0',
  `createTime` datetime NOT NULL,
  `lastTime` datetime DEFAULT NULL,
  `lastIP` char(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loginName` (`name`),
  KEY `staffStatus` (`staffStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_member
-- ----------------------------
INSERT INTO `rm_member` VALUES ('17', '00001', 'admin', '9875e806ef6f9494e0de4ae1bbf9f815', null, '', '375170667@qq.com', '2', '9365', 'Upload/staffs/2015-04/55306cf76bc1f.jpg', '3', '1', '1', '2014-04-06 11:47:20', '2017-11-20 16:15:59', '192.168.199.177');
INSERT INTO `rm_member` VALUES ('18', '2', 'systemsss', '9875e806ef6f9494e0de4ae1bbf9f815', null, '', '37517066@qq.com', '1', '9365', null, '3', '1', '1', '2014-12-20 00:13:36', null, null);
INSERT INTO `rm_member` VALUES ('19', '3', 'goodsAdmin', '1600195af828b21c1f586b1e01cb89fc', null, '', '375170667@qq.com', '1', '9365', 'Upload/staffs/2014-12/5496376a7ff89.jpg', '1', '1', '0', '2014-12-21 10:58:40', null, null);
INSERT INTO `rm_member` VALUES ('20', '4', 'sadasdadasd', '07835ecd178ee79ef0cfdb8240c18364', null, '', '1375170667@qq.com', '2', '9365', '\\upload\\staffs\\2016-08\\88\\e3b5fcacf9fb3c51b8cb5a036a2bf8.jpg', '2', '1', '1', '2016-08-12 23:57:41', null, null);
INSERT INTO `rm_member` VALUES ('21', '5', 'test', '84199b9eb283d7c5be45a1f590d4a08f', null, '', '375170667@qq.com', '1', '9365', '/upload/staffs/2016-08\\59\\099bfb349c4a7694c477aa94f23664.jpg', '2', '1', '1', '2016-08-12 23:59:19', null, null);
INSERT INTO `rm_member` VALUES ('22', '6', 'rrrcc', '17059e82870edb4e0320d52a40096519', null, '', '375170667@qq.com', '2', '9365', '/upload/staffs/2016-08\\c2\\28f39b9a0cdd5839613f8aa6ef8256.jpg', '2', '1', '0', '2016-08-13 00:20:48', null, null);
INSERT INTO `rm_member` VALUES ('23', '7', 'rrr', 'd1ddbff25d00debf3ec48dcd541b7604', null, '', '375170667@qq.com', '2', '9365', '', '0', '1', '1', '2016-08-13 00:23:02', null, null);
INSERT INTO `rm_member` VALUES ('24', '8', 'rrrv', '79a65611f151432a56aca6cf291f3aff', null, '', '375170667@qq.com', '2', '9365', '', '0', '1', '1', '2016-08-13 00:23:15', null, null);
INSERT INTO `rm_member` VALUES ('25', '9', 'dddddddddddddddddddd', 'c54a53d5764e413b33cfaba89a06d164', null, '', '375170667@qq.com', '1', '9365', '/upload/staffs/2016-08\\88\\e3b5fcacf9fb3c51b8cb5a036a2bf8.jpg', '0', '1', '0', '2016-08-13 00:24:32', null, null);
INSERT INTO `rm_member` VALUES ('26', '10', 'fffff', '561429601f590b45f65e150b6a1daf5f', null, '', '375170667@qq.com', '1', '9365', '', '2', '1', '1', '2016-08-18 12:50:55', null, null);
INSERT INTO `rm_member` VALUES ('27', '11', 'aaaa', '9875e806ef6f9494e0de4ae1bbf9f815', null, '', '133@qq.com', '1', '9365', null, '0', '1', '1', '0000-00-00 00:00:00', '2017-11-20 15:14:50', '127.0.0.1');
INSERT INTO `rm_member` VALUES ('28', '12', '123', 'd2766ae2b438fde0b03dbfda8283e6fe', null, '', '133@qq.com', '1', '9365', null, '0', '1', '1', '0000-00-00 00:00:00', null, null);
INSERT INTO `rm_member` VALUES ('29', '13', 'daaad', '93b9eaeef5117bd47082078f2ba11d93', null, '', '132', '1', '9365', null, '1', '1', '1', '0000-00-00 00:00:00', null, null);
INSERT INTO `rm_member` VALUES ('30', '14', 'rrrr', 'a5edb5d35fe987369b301d134988574a', null, '', 'a', '2', '9365', null, '0', '1', '1', '0000-00-00 00:00:00', '2017-11-20 15:22:03', '127.0.0.1');
INSERT INTO `rm_member` VALUES ('31', '15', 'lqq', 'acd267019b102d88ec6bd2ddd961b42b', null, '', '8657', '2', '9365', null, '1', '1', '1', '0000-00-00 00:00:00', '2017-11-20 15:29:05', '0.0.0.0');
INSERT INTO `rm_member` VALUES ('32', '16', 'dengrongqiu', '93b9eaeef5117bd47082078f2ba11d93', null, '', '375170667@qq.com', '2', '9365', null, '3', '1', '1', '2017-11-20 15:11:00', '2017-11-20 15:37:15', '127.0.0.1');
INSERT INTO `rm_member` VALUES ('39', null, '545@q.com', '4e01cb81dc0d7652e7729363f02da294', '13678956837', '25@q.com', null, null, '1024', null, '', '1', '1', '2017-12-14 16:54:08', null, null);
INSERT INTO `rm_member` VALUES ('40', null, '375170667@qq.com', 'febaccb0b0863ebc0b6c5919527cbc29', '18723000000', '375170667@qq.com', null, null, '1024', null, '', '1', '1', '2017-12-14 18:46:00', null, null);

-- ----------------------------
-- Table structure for rm_menu
-- ----------------------------
DROP TABLE IF EXISTS `rm_menu`;
CREATE TABLE `rm_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_id` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_menu
-- ----------------------------
INSERT INTO `rm_menu` VALUES ('8', null, 'page_type', '衣服', null, null, '2017-10-31 11:14:28');
INSERT INTO `rm_menu` VALUES ('9', null, 'page_type', '鞋子', null, null, '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('12', null, 'page_type', '帽子', null, null, '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('23', null, 'page_type', '首饰', null, null, '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('27', null, 'page_type', '童装', null, null, '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('30', null, 'status', null, '合作中', '1', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('31', null, 'status', null, '停止合作', '2', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('32', null, 'status', null, '联系中', '3', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('33', null, 'status', null, '待联系', '4', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('39', null, 'fans', null, 'A', 'A : 50W-100W', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('40', null, 'fans', null, 'B', 'B : 100W-150W', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('41', null, 'fans', null, 'C', 'C : 150w-200w', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('42', null, 'fans', null, 'D', 'D : 200w-', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('43', null, 'commission_ratio', null, 'A', 'A : 3%', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('44', null, 'commission_ratio', null, 'B', 'B : 4%', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('45', null, 'commission_ratio', null, 'C', 'C：5%', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('46', null, 'fans', null, 'E', 'E : 160w-190w', '0000-00-00 00:00:00');
INSERT INTO `rm_menu` VALUES ('47', null, 'page_activity', null, '低', '0.1%', '2017-11-09 16:11:58');
INSERT INTO `rm_menu` VALUES ('48', null, 'page_activity', null, '一般', '0.3%', '2017-11-09 16:11:20');
INSERT INTO `rm_menu` VALUES ('49', null, 'page_activity', null, '较高', '1%', '2017-11-09 16:11:37');
INSERT INTO `rm_menu` VALUES ('51', null, 'page_activity', null, '高', '5%', '2017-11-09 16:11:02');

-- ----------------------------
-- Table structure for rm_menus
-- ----------------------------
DROP TABLE IF EXISTS `rm_menus`;
CREATE TABLE `rm_menus` (
  `menuId` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) NOT NULL,
  `menuName` varchar(100) NOT NULL,
  `menuSort` int(11) NOT NULL DEFAULT '0',
  `dataFlag` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuId`),
  KEY `parentId` (`parentId`,`dataFlag`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_menus
-- ----------------------------
INSERT INTO `rm_menus` VALUES ('1', '0', '首页', '0', '1');
INSERT INTO `rm_menus` VALUES ('2', '1', '系统管理', '0', '1');
INSERT INTO `rm_menus` VALUES ('3', '2', '菜单权限', '0', '1');
INSERT INTO `rm_menus` VALUES ('4', '2', '角色管理', '2', '1');
INSERT INTO `rm_menus` VALUES ('5', '2', '职员管理', '3', '1');
INSERT INTO `rm_menus` VALUES ('6', '2', '登录日志', '4', '1');
INSERT INTO `rm_menus` VALUES ('7', '2', '操作日志', '5', '1');
INSERT INTO `rm_menus` VALUES ('8', '1', '基础设置', '1', '1');
INSERT INTO `rm_menus` VALUES ('9', '8', '商城配置', '0', '1');
INSERT INTO `rm_menus` VALUES ('10', '8', '导航管理', '1', '1');
INSERT INTO `rm_menus` VALUES ('11', '8', '广告管理', '2', '1');
INSERT INTO `rm_menus` VALUES ('12', '8', '支付管理', '5', '1');
INSERT INTO `rm_menus` VALUES ('13', '8', '银行管理', '4', '1');
INSERT INTO `rm_menus` VALUES ('14', '8', '友情链接', '7', '1');
INSERT INTO `rm_menus` VALUES ('16', '8', '地区管理', '6', '1');
INSERT INTO `rm_menus` VALUES ('18', '1', '会员管理', '2', '1');
INSERT INTO `rm_menus` VALUES ('19', '18', '会员等级', '0', '1');
INSERT INTO `rm_menus` VALUES ('20', '18', '会员管理', '1', '1');
INSERT INTO `rm_menus` VALUES ('21', '18', '账号管理', '2', '1');
INSERT INTO `rm_menus` VALUES ('22', '0', '商品管理', '3', '1');
INSERT INTO `rm_menus` VALUES ('23', '22', '商品管理', '0', '1');
INSERT INTO `rm_menus` VALUES ('24', '23', '商品分类', '3', '1');
INSERT INTO `rm_menus` VALUES ('25', '23', '品牌管理', '4', '1');
INSERT INTO `rm_menus` VALUES ('29', '1', '文章管理', '3', '1');
INSERT INTO `rm_menus` VALUES ('30', '29', '文章分类', '1', '1');
INSERT INTO `rm_menus` VALUES ('31', '29', '文章管理', '0', '1');
INSERT INTO `rm_menus` VALUES ('32', '23', '商品规格', '5', '1');
INSERT INTO `rm_menus` VALUES ('33', '23', '已上架商品', '0', '1');
INSERT INTO `rm_menus` VALUES ('34', '23', '评价管理', '6', '1');
INSERT INTO `rm_menus` VALUES ('35', '0', '订单管理', '1', '1');
INSERT INTO `rm_menus` VALUES ('36', '2', '图片空间', '6', '1');
INSERT INTO `rm_menus` VALUES ('38', '0', '店铺管理', '2', '1');
INSERT INTO `rm_menus` VALUES ('39', '38', '店铺管理', '0', '1');
INSERT INTO `rm_menus` VALUES ('41', '2', '商城消息', '7', '1');
INSERT INTO `rm_menus` VALUES ('42', '8', '广告位置', '3', '1');
INSERT INTO `rm_menus` VALUES ('43', '2', '前台菜单', '1', '1');
INSERT INTO `rm_menus` VALUES ('44', '39', '店铺认证', '0', '1');
INSERT INTO `rm_menus` VALUES ('45', '39', '开店申请', '1', '1');
INSERT INTO `rm_menus` VALUES ('46', '39', '店铺管理', '2', '1');
INSERT INTO `rm_menus` VALUES ('47', '39', '停用店铺', '3', '1');
INSERT INTO `rm_menus` VALUES ('48', '23', '商品属性', '3', '1');
INSERT INTO `rm_menus` VALUES ('49', '35', '订单管理', '0', '1');
INSERT INTO `rm_menus` VALUES ('50', '49', '订单管理', '0', '1');
INSERT INTO `rm_menus` VALUES ('51', '49', '投诉订单', '1', '1');
INSERT INTO `rm_menus` VALUES ('52', '49', '退款订单', '2', '1');
INSERT INTO `rm_menus` VALUES ('53', '8', '快递管理', '8', '1');
INSERT INTO `rm_menus` VALUES ('54', '23', '待审核商品', '1', '1');
INSERT INTO `rm_menus` VALUES ('55', '23', '违规商品', '2', '1');
INSERT INTO `rm_menus` VALUES ('56', '0', '运营管理', '0', '1');
INSERT INTO `rm_menus` VALUES ('57', '56', '推荐管理', '0', '1');
INSERT INTO `rm_menus` VALUES ('58', '57', '商品推荐', '0', '1');
INSERT INTO `rm_menus` VALUES ('59', '57', '店铺推荐', '1', '1');
INSERT INTO `rm_menus` VALUES ('60', '57', '品牌推荐', '2', '1');
INSERT INTO `rm_menus` VALUES ('61', '2', '风格管理', '10', '1');
INSERT INTO `rm_menus` VALUES ('62', '56', '财务管理', '0', '1');
INSERT INTO `rm_menus` VALUES ('63', '62', '提现申请', '0', '1');
INSERT INTO `rm_menus` VALUES ('64', '62', '结算申请', '2', '1');
INSERT INTO `rm_menus` VALUES ('65', '62', '商家结算', '4', '1');

-- ----------------------------
-- Table structure for rm_page
-- ----------------------------
DROP TABLE IF EXISTS `rm_page`;
CREATE TABLE `rm_page` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL,
  `page_id` varchar(30) NOT NULL,
  `page_type` varchar(120) NOT NULL,
  `fans` varchar(30) NOT NULL,
  `page_activity` varchar(30) NOT NULL,
  `page_activity_status` varchar(30) NOT NULL,
  `commission` varchar(15) NOT NULL,
  `status` int(5) NOT NULL,
  `status_value` varchar(30) NOT NULL,
  `beizhu` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_page
-- ----------------------------
INSERT INTO `rm_page` VALUES ('12', '00001', '000001', '帽子', 'C : 150w-200w', '0.3%', '一般', 'B : 4%', '1', '合作中', '第一次沟通', '2017-11-09 16:49:04', '2017-11-20 16:11:55');
INSERT INTO `rm_page` VALUES ('13', '000002', '0000002', '衣服', 'A : 50W-100W', '0.3%', '一般', 'A : 3%', '3', '联系中', '萨达', '2017-11-09 16:50:33', '2017-11-09 16:11:33');
INSERT INTO `rm_page` VALUES ('14', '0000003', '00000003', '衣服', 'C : 150w-200w', '1%', '较高', 'B : 4%', '4', '待联系', '阿达带s', '2017-11-09 16:50:46', '2017-11-09 16:11:46');
INSERT INTO `rm_page` VALUES ('15', '000004', '000004', '帽子', 'C : 150w-200w', '5%', '高', 'B : 4%', '2', '停止合作', 'adfsdasdasda', '2017-11-09 16:11:04', null);

-- ----------------------------
-- Table structure for rm_posts
-- ----------------------------
DROP TABLE IF EXISTS `rm_posts`;
CREATE TABLE `rm_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `images_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `text` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `utm` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `uid` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `pid` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `sign` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `timing` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rm_posts
-- ----------------------------
INSERT INTO `rm_posts` VALUES ('1', '13', '/upload/card/20171110/8d2c027ce0bfddc39927bd8b1ffe19f5.jpg', 'http://www.baidu.com?utm_source=facebook&utm_medium=email@http://www.baidu.com?utm_source=facebook&utm_medium=email@http://www.baidu.com?utm_source=facebook&utm_medium=email', '第一条测试文案测试:#URL1\r\n        第二条测试文案测试:#URL2\r\n        第三条测试文案测试:#URL3', '2017-11-22 15:11:47', '1', null, null, null, null, '2017-12-29 14:16:20');
INSERT INTO `rm_posts` VALUES ('2', '14', '/upload/card/20171110/157efa11fd7bb901ae6b93c9ab9c5150.jpg', 'http://www.redman.dev?utm_source=facebook&utm_medium=email@http://www.ress.dev?utm_source=facebook&utm_medium=email', '第一条测试文案测试:#URL1\r\n第二条测试文案测试:#URL2', '2017-11-22 15:11:48', '2', null, null, null, null, '2017-12-06 14:16:24');
INSERT INTO `rm_posts` VALUES ('3', '15', '/upload/card/20171110/103d87cdd883922c4710ddd1de00538e.jpeg', 'http://www.cnit8.com?utm_source=facebook&utm_medium=email@http://www.cnit8.com?utm_source=facebook&utm_medium=email@http://www.cnit8.com?utm_source=facebook&utm_medium=email', '第一条测试文案测试:#URL1\r\n        第二条测试文案测试:#URL2\r\n        第三条测试文案测试:#URL3', '2017-11-22 16:11:02', '2', null, null, null, null, '2017-12-07 14:16:27');
INSERT INTO `rm_posts` VALUES ('4', '27', '/upload/card/20171201/87833682ed3d9f695ea47555e626a0e9.jpg', 'http://www.redman.dev?utm_source=facebook&utm_medium=email@http://www.ress.dev?utm_source=facebook&utm_medium=email@http://www.cnit8.dev?utm_source=facebook&utm_medium=email', '第一条测试文案测试:#URL1url\r\n第二条测试文案测试:#URL2URL\r\n第三条测试文案测试:#URL3', '2017-12-01 11:12:58', '1', null, null, null, null, '2017-12-06 12:16:30');
INSERT INTO `rm_posts` VALUES ('5', '18', '/upload/card/20171121/d36b76c273234323f1cc2ec88f63dd27.jpg', 'adasdaas', 'dsadasdadas', '0000-00-00 00:00:00', '0', null, null, null, null, null);

-- ----------------------------
-- Table structure for rm_posts_job
-- ----------------------------
DROP TABLE IF EXISTS `rm_posts_job`;
CREATE TABLE `rm_posts_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `uid` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `token` varchar(500) DEFAULT NULL,
  `images_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `text` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `utm` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pid` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `sign` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `timing` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rm_posts_job
-- ----------------------------
INSERT INTO `rm_posts_job` VALUES ('1', '13', '140470486718201', 'EAACuGCwLx6ABADZC3XiZBBiIL0Fxtwm2qkZAsBYZCjZA6iKEYvTpOlciCIhKpAVD6TuPZCHmXCyCekpTcRfZAKNeHLntcxqwerXLjpkD9kZAqmXbbT0Dvh2tpkZB5wByZCoRZA7Iq3wIEFjHt8tfMSliudXqgNypGp6p6GdQwA8xPmsiVzVCF98JuZAs', '/upload/card/20171110/8d2c027ce0bfddc39927bd8b1ffe19f5.jpg', 'http://www.baidu.com?utm_source=facebook&utm_medium=email@http://www.baidu.com?utm_source=facebook&utm_medium=email@http://www.baidu.com?utm_source=facebook&utm_medium=email', '第一条测试文案测试:#URL1\r\n        第二条测试文案测试:#URL2\r\n        第三条测试文案测试:#URL3', '2017-11-22 15:11:47', '1', null, null, null, '2017-12-08 16:16:00');
INSERT INTO `rm_posts_job` VALUES ('2', '14', '143063623129377', 'EAACuGCwLx6ABACjJxEsUp5lJ2dx9k4F0OHqi6ZB9lFZCqkZCmkgEpvmiaP82Li44Jnv1S2zKqd3umBZARQeYILxhf4LgXUjh6ZBvZB6WkfPNG12DP0ur166VomCvaBfk5OawlTKW4fq7RZApXZBVL2WGMdZCVxW9NeJ116U7sPRgUbQZDZD', '/upload/card/20171110/157efa11fd7bb901ae6b93c9ab9c5150.jpg', 'http://www.qq.com?utm_source=facebook&utm_medium=email@http://www.163.com?utm_source=facebook&utm_medium=email', '第12条测试文案测试:#URL1\r\n第二条测试文案测试:#URL2', '2017-11-22 15:11:48', '1', null, null, null, '2017-12-08 16:15:00');
INSERT INTO `rm_posts_job` VALUES ('3', '15', '143063623129377', 'EAACuGCwLx6ABACjJxEsUp5lJ2dx9k4F0OHqi6ZB9lFZCqkZCmkgEpvmiaP82Li44Jnv1S2zKqd3umBZARQeYILxhf4LgXUjh6ZBvZB6WkfPNG12DP0ur166VomCvaBfk5OawlTKW4fq7RZApXZBVL2WGMdZCVxW9NeJ116U7sPRgUbQZDZD', '/upload/card/20171110/103d87cdd883922c4710ddd1de00538e.jpeg', 'http://www.cnit8.com?utm_source=facebook&utm_medium=email@http://www.cnit8.com?utm_source=facebook&utm_medium=email@http://www.cnit8.com?utm_source=facebook&utm_medium=email', '第一条测试文案测试:#URL1\r\n        第二条测试文案测试:#URL2\r\n        第三条测试文案测试:#URL3', '2017-11-22 16:11:02', '1', null, null, null, '2017-12-08 16:22:27');
INSERT INTO `rm_posts_job` VALUES ('4', '27', '140470486718201', 'EAACuGCwLx6ABADZC3XiZBBiIL0Fxtwm2qkZAsBYZCjZA6iKEYvTpOlciCIhKpAVD6TuPZCHmXCyCekpTcRfZAKNeHLntcxqwerXLjpkD9kZAqmXbbT0Dvh2tpkZB5wByZCoRZA7Iq3wIEFjHt8tfMSliudXqgNypGp6p6GdQwA8xPmsiVzVCF98JuZAs', '/upload/card/20171201/87833682ed3d9f695ea47555e626a0e9.jpg', 'http://www.126.com?utm_source=facebook&utm_medium=email@http://www.ress.dev?utm_source=facebook&utm_medium=email@http://www.cnit8.dev?utm_source=facebook&utm_medium=email', '第1条测试文案测试:#URL1\r\n                第二条测试文案测试:#URL2\r\n                第三条测试文案测试:#URL3', '2017-12-01 11:12:58', '1', null, null, null, '2017-12-08 16:24:30');

-- ----------------------------
-- Table structure for rm_product
-- ----------------------------
DROP TABLE IF EXISTS `rm_product`;
CREATE TABLE `rm_product` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `images_url` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sku` varchar(5000) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `create_time` date NOT NULL DEFAULT '0000-00-00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_product
-- ----------------------------
INSERT INTO `rm_product` VALUES ('13', '/upload/card/20171110/8d2c027ce0bfddc39927bd8b1ffe19f5.jpg', '测试1阿里图库', '长：45cm 宽20cm', '0', '2017-11-10', '2017-11-16 10:11:49');
INSERT INTO `rm_product` VALUES ('14', '/upload/card/20171110/157efa11fd7bb901ae6b93c9ab9c5150.jpg', '测试阿里图库', '长：45cm 宽20cm', '0', '2017-11-07', '2017-11-10 17:41:05');
INSERT INTO `rm_product` VALUES ('15', '/upload/card/20171110/103d87cdd883922c4710ddd1de00538e.jpeg', '测试阿里图库', '长：45cm 宽20cm', '1', '2017-11-04', '2017-11-11 15:34:01');
INSERT INTO `rm_product` VALUES ('16', '/upload/card/20171110/5f13016c2cb509ad5390e58fb106a6b9.png', '测试阿里图库', '长：45cm 宽20cm', '1', '2017-11-05', '2017-11-16 10:11:49');

-- ----------------------------
-- Table structure for rm_roles
-- ----------------------------
DROP TABLE IF EXISTS `rm_roles`;
CREATE TABLE `rm_roles` (
  `roleId` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(30) NOT NULL,
  `roleDesc` varchar(255) DEFAULT NULL,
  `privileges` text,
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`roleId`),
  KEY `roleFlag` (`dataFlag`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_roles
-- ----------------------------
INSERT INTO `rm_roles` VALUES ('1', '商品管理员', null, 'spfl_00,spfl_01,spfl_02,spfl_03,ppgl_00,ppgl_01,ppgl_02,ppgl_03,splb_00,splb_04,splb_03,spsh_00,spsh_04,spsh_03,sppl_00,sppl_04,sppl_03', '1', '2014-11-02 12:07:12');
INSERT INTO `rm_roles` VALUES ('2', '门店管理员', null, 'dplb_00,dplb_01,dplb_02,dplb_03,dpsh_00,dpsh_04,dpsh_03', '1', '2014-11-02 12:09:05');
INSERT INTO `rm_roles` VALUES ('3', '系统管理员', '', 'SY_001,HHQL,XTGL_00,CDGL_00,CDGL_01,CDGL_02,CDGL_03,QXGL_01,QXGL_02,QXGL_03,QTCD_00,QTCD_01,QTCD_02,QTCD_03,JSGL_00,JSGL_01,JSGL_02,JSGL_03,ZYGL_00,ZYGL_01,ZYGL_02,ZYGL_03,DLRZ_00,CZRZ_00,TPKJ_00,TPKJ_04,SCXX_00,SCXX_01,SCXX_03,SCSZ_00,SCPZ_00,SCPZ_02,DHGL_00,DHGL_01,DHGL_02,DHGL_03,GGGL_00,GGGL_01,GGGL_02,GGGL_03,GGWZ_00,GGWZ_01,GGWZ_02,GGWZ_03,YHGL_00,YHGL_01,YHGL_02,YHGL_03,ZFGL_00,ZFGL_02,ZFGL_03,DQGL_00,DQGL_01,DQGL_02,DQGL_03,YQGL_00,YQGL_01,YQGL_02,YQGL_03,KDGL_00,KDGL_01,KDGL_02,KDGL_03,HYSZ_00,HYDJ_00,HYDJ_01,HYDJ_02,HYDJ_03,HYGL_00,HYGL_01,HYGL_02,HYGL_03,ZHGL_00,ZHGL_02,WZSZ_00,WZGL_00,WZGL_01,WZGL_02,WZGL_03,WZFL_00,WZFL_01,WZFL_02,WZFL_03,SPTJ_00,SPTJ_04,DPTJ_00,DPTJ_04,PPTJ_00,PPTJ_04,DDGL_00,DDLB_00,TSDD_00,TKDD_00,DPXX_00,DPSZ_00,RZGL_00,RZGL_01,RZGL_02,RZGL_03,DPSQ_00,DPSQ_03,DPSQ_04,DPGL_00,DPGL_01,DPGL_02,DPGL_03,TYDP_00,SPXX_00,SPSZ_00,SJSP_00,SJSP_04,SJSP_03,DSHSP_00,DSHSP_04,WGSP_00,SPFL_00,SPFL_01,SPFL_02,SPFL_03,SPSX_00,PPGL_00,PPGL_01,PPGL_02,PPGL_03,SPGG_00,SPGG_01,SPGG_02,SPGG_03,PJGL_00,PJGL_02,PJGL_03', '1', '2014-11-02 12:09:09');
INSERT INTO `rm_roles` VALUES ('4', '客服', null, 'sppl_00,sppl_04,sppl_03', '-1', '2014-12-20 00:08:53');
INSERT INTO `rm_roles` VALUES ('5', '测试管理员', 'test', 'SY_001,XTGL_00,CDGL_00,CDGL_01,CDGL_02,CDGL_03,QXGL_01,QXGL_02,QXGL_03,23', '-1', '0000-00-00 00:00:00');
INSERT INTO `rm_roles` VALUES ('6', '', '', '', '-1', '0000-00-00 00:00:00');
INSERT INTO `rm_roles` VALUES ('7', 'vvv', '', '', '-1', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for rm_staffs
-- ----------------------------
DROP TABLE IF EXISTS `rm_staffs`;
CREATE TABLE `rm_staffs` (
  `staffId` int(11) NOT NULL AUTO_INCREMENT,
  `loginName` varchar(40) NOT NULL,
  `loginPwd` varchar(50) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `sex` tinyint(2) DEFAULT NULL,
  `secretKey` int(32) NOT NULL,
  `staffName` varchar(50) NOT NULL,
  `staffNo` varchar(20) DEFAULT NULL,
  `staffPhoto` varchar(150) DEFAULT NULL,
  `staffRoleId` int(11) NOT NULL,
  `workStatus` tinyint(4) NOT NULL DEFAULT '1',
  `staffStatus` tinyint(4) NOT NULL DEFAULT '0',
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  `lastTime` datetime DEFAULT NULL,
  `lastIP` char(16) DEFAULT NULL,
  PRIMARY KEY (`staffId`),
  KEY `loginName` (`loginName`),
  KEY `staffStatus` (`staffStatus`,`dataFlag`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rm_staffs
-- ----------------------------
INSERT INTO `rm_staffs` VALUES ('1', 'admin', '9875e806ef6f9494e0de4ae1bbf9f815', '', '1', '9365', 'admin', '001', 'Upload/staffs/2015-04/55306cf76bc1f.jpg', '3', '1', '1', '1', '2014-04-06 11:47:20', '2017-12-14 09:41:33', '192.168.199.178');
INSERT INTO `rm_staffs` VALUES ('2', 'systemsss', '9875e806ef6f9494e0de4ae1bbf9f815', '37517066@qq.com', '1', '9365', '系统管理员', 'sn001', null, '3', '1', '1', '1', '2014-12-20 00:13:36', null, null);
INSERT INTO `rm_staffs` VALUES ('3', 'goodsAdmin', '1600195af828b21c1f586b1e01cb89fc', '375170667@qq.com', '1', '9365', '商品管理员', 'sn001', 'Upload/staffs/2014-12/5496376a7ff89.jpg', '1', '1', '1', '1', '2014-12-21 10:58:40', null, null);
INSERT INTO `rm_staffs` VALUES ('4', 'sadasdadasd', '07835ecd178ee79ef0cfdb8240c18364', '1375170667@qq.com', '2', '9365', 'rrr', 'rrr', '\\upload\\staffs\\2016-08\\88\\e3b5fcacf9fb3c51b8cb5a036a2bf8.jpg', '2', '1', '1', '-1', '2016-08-12 23:57:41', null, null);
INSERT INTO `rm_staffs` VALUES ('5', 'test', '84199b9eb283d7c5be45a1f590d4a08f', '375170667@qq.com', '1', '9365', 'ttt', 'ttt', '/upload/staffs/2016-08\\59\\099bfb349c4a7694c477aa94f23664.jpg', '2', '1', '1', '1', '2016-08-12 23:59:19', null, null);
INSERT INTO `rm_staffs` VALUES ('6', 'rrrcc', '17059e82870edb4e0320d52a40096519', '375170667@qq.com', '2', '9365', 'rrr', 'rrr', '/upload/staffs/2016-08\\c2\\28f39b9a0cdd5839613f8aa6ef8256.jpg', '2', '1', '1', '1', '2016-08-13 00:20:48', null, null);
INSERT INTO `rm_staffs` VALUES ('7', 'rrr', 'd1ddbff25d00debf3ec48dcd541b7604', '375170667@qq.com', '2', '9365', 'rrr', 'rr', '', '0', '1', '1', '1', '2016-08-13 00:23:02', null, null);
INSERT INTO `rm_staffs` VALUES ('8', 'rrrv', '79a65611f151432a56aca6cf291f3aff', '375170667@qq.com', '2', '9365', 'rr', 'rr', '', '0', '1', '1', '1', '2016-08-13 00:23:15', null, null);
INSERT INTO `rm_staffs` VALUES ('9', 'dddddddddddddddddddd', 'c54a53d5764e413b33cfaba89a06d164', '375170667@qq.com', '1', '9365', 'ddd--', 'dd--', '/upload/staffs/2016-08\\88\\e3b5fcacf9fb3c51b8cb5a036a2bf8.jpg', '0', '1', '1', '-1', '2016-08-13 00:24:32', null, null);
INSERT INTO `rm_staffs` VALUES ('10', 'fffff', '561429601f590b45f65e150b6a1daf5f', '375170667@qq.com', '1', '9365', 'ffff', '', '', '2', '1', '1', '1', '2016-08-18 12:50:55', null, null);
INSERT INTO `rm_staffs` VALUES ('11', 'aaaa', '9875e806ef6f9494e0de4ae1bbf9f815', '133@qq.com', '1', '9365', '', null, null, '0', '1', '1', '1', '0000-00-00 00:00:00', '2017-11-20 15:14:50', '127.0.0.1');
INSERT INTO `rm_staffs` VALUES ('12', '123', 'd2766ae2b438fde0b03dbfda8283e6fe', '133@qq.com', '1', '9365', '', null, null, '0', '1', '1', '1', '0000-00-00 00:00:00', null, null);
INSERT INTO `rm_staffs` VALUES ('13', 'daaad', '93b9eaeef5117bd47082078f2ba11d93', '132', '1', '9365', '', null, null, '1', '1', '1', '1', '0000-00-00 00:00:00', null, null);
INSERT INTO `rm_staffs` VALUES ('14', 'rrrr', 'a5edb5d35fe987369b301d134988574a', 'a', '2', '9365', '', null, null, '0', '1', '1', '1', '0000-00-00 00:00:00', '2017-11-20 15:22:03', '127.0.0.1');
INSERT INTO `rm_staffs` VALUES ('15', 'lqqlqq', 'acd267019b102d88ec6bd2ddd961b42b', '8657', '1', '9365', '', null, null, '1', '1', '1', '1', '0000-00-00 00:00:00', '2017-11-20 15:29:05', '0.0.0.0');
INSERT INTO `rm_staffs` VALUES ('16', 'dengrongqiu', '93b9eaeef5117bd47082078f2ba11d93', '375170667@qq.com', '2', '9365', '', null, null, '3', '1', '1', '1', '2017-11-20 15:11:00', '2017-11-20 15:37:15', '127.0.0.1');
SET FOREIGN_KEY_CHECKS=1;
