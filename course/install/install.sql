DROP TABLE IF EXISTS `web_config`;
create table `web_config` (
`k` varchar(32) NOT NULL,
`v` text NULL,
PRIMARY KEY  (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `web_config` VALUES ('cache', '');
INSERT INTO `web_config` VALUES ('version', '1025');
INSERT INTO `web_config` VALUES ('admin_user', 'admin');
INSERT INTO `web_config` VALUES ('admin_pwd', '123456');
INSERT INTO `web_config` VALUES ('style', '1');
INSERT INTO `web_config` VALUES ('sitename', '教程网');
INSERT INTO `web_config` VALUES ('title', '教程网 教程大全');
INSERT INTO `web_config` VALUES ('keywords', '教程网,教程大全');
INSERT INTO `web_config` VALUES ('description', '流量卡教程官网,在线查看各种教程网站');
INSERT INTO `web_config` VALUES ('kfqq', '738476494');
INSERT INTO `web_config` VALUES ('anounce', '');
INSERT INTO `web_config` VALUES ('modal', '');
INSERT INTO `web_config` VALUES ('url', 'http://card.134920.xyz/');
INSERT INTO `web_config` VALUES ('bottom', '');

DROP TABLE IF EXISTS `web_jc`;
create table `web_jc` (
`id` int(1) NOT NULL AUTO_INCREMENT,
`url` varchar(255) NULL,
`name` text NULL,
`active` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
