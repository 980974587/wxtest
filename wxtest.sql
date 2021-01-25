/*
MySQL Backup
Database: wxtest
Backup Time: 2021-01-25 14:57:33
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wxtest`.`msgs`;
DROP TABLE IF EXISTS `wxtest`.`users`;
CREATE TABLE `msgs` (
  `id` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '消息类型，1=文本，2=图片，3=语音，4=视频，5=小视频，6=地理位置，7=链接',
  `title` varchar(255) NOT NULL DEFAULT '',
  `from_openid` varchar(0) NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL,
  `msgid` int(11) NOT NULL DEFAULT '0',
  `content` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `nickaname` varchar(255) DEFAULT '0',
  `avater` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
BEGIN;
LOCK TABLES `wxtest`.`msgs` WRITE;
DELETE FROM `wxtest`.`msgs`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `wxtest`.`users` WRITE;
DELETE FROM `wxtest`.`users`;
UNLOCK TABLES;
COMMIT;
