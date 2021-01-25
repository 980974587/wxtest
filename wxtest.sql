/*
MySQL Backup
Database: wxtest
Backup Time: 2021-01-25 15:48:59
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wxtest`.`msgs`;
DROP TABLE IF EXISTS `wxtest`.`users`;
CREATE TABLE `msgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '消息类型，0=文本，1=图片，2=语音，3=视频，4=小视频，5=地理位置，6=链接',
  `title` varchar(255) NOT NULL DEFAULT '',
  `from_openid` varchar(50) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL,
  `msgid` int(11) NOT NULL DEFAULT '0',
  `content` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
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
INSERT INTO `wxtest`.`msgs` (`id`,`type`,`title`,`from_openid`,`create_time`,`msgid`,`content`) VALUES (1, 1, '', 'bbb', 1611554238, 123456789, '1234'),(2, 0, '', 'oXmle1mpYCpVWPPVzytQ0H9NGiIc', 1611554238, 1, '123123'),(4, 0, '', 'oXmle1mpYCpVWPPVzytQ0H9NGiIc', 1611554238, 1, '123123'),(5, 0, '', 'oXmle1mpYCpVWPPVzytQ0H9NGiIc', 1611554238, 1, '123123'),(6, 0, '', 'oXmle1mpYCpVWPPVzytQ0H9NGiIc', 1611554238, 1, '123123');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `wxtest`.`users` WRITE;
DELETE FROM `wxtest`.`users`;
UNLOCK TABLES;
COMMIT;
