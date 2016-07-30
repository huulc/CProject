/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.6.25 : Database - project
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`project` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `project`;

/*Table structure for table `assign_tasks` */

DROP TABLE IF EXISTS `assign_tasks`;

CREATE TABLE `assign_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `assign_tasks` */

insert  into `assign_tasks`(`id`,`task_id`,`user_id`,`role`) values (24,37,1,NULL),(25,38,1,NULL);

/*Table structure for table `files` */

DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1: public 0:delete',
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `files` */

insert  into `files`(`id`,`task_id`,`status`,`name`,`path`,`created`,`updated`) values (23,38,0,'When-the-Road-Meet-the-Sky.zip','\\20160730090020579c508491f80When-the-Road-Meet-the-Sky.zip','2016-07-30 09:00:20','2016-07-30 09:00:20');

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `published` int(1) NOT NULL DEFAULT '1' COMMENT '1: public 0:delete',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `projects` */

insert  into `projects`(`id`,`user_id`,`status`,`name`,`description`,`published`,`created`,`updated`) values (1,1,1,'project1','tesst',1,'2016-07-29 12:37:13','2016-07-30 01:27:10'),(2,2,1,'project2','description demo2',1,'2016-07-29 12:37:13','2016-07-29 12:37:43'),(3,2,1,'project3','1234',1,'2016-07-30 02:03:33','2016-07-30 02:17:28'),(4,1,1,'project4','',1,'2016-07-30 03:14:12','2016-07-30 03:14:12');

/*Table structure for table `tasks` */

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `des_task` text COLLATE utf8_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tasks` */

insert  into `tasks`(`id`,`project_id`,`user_id`,`name`,`content`,`des_task`,`status`,`position`,`start_time`,`end_time`,`created`,`updated`) values (37,1,0,'task1','<p>task1</p>\r\n','<p>task1</p>\r\n',0,0,NULL,NULL,'2016-07-30 08:59:49','2016-07-30 08:59:49'),(38,1,0,'task1','<p>task1</p>\r\n','<p>task1</p>\r\n',0,0,NULL,NULL,'2016-07-30 09:00:20','2016-07-30 09:00:20');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`name`,`email`,`password`,`created`,`modified`) values (1,'huulc','huulc','lehuu.masuio@gmail.com','$2a$10$SELdKZmOEEFEWRCAaERDAOr6BL01PxZqla0Tdv3Fi1cWImate.qM6','2016-07-30 09:20:23','2016-07-30 09:49:10'),(2,'admin','Admin','admin@gmail.com','$2a$10$teGGkMK8NhviRxQePFBGOu6dxmPqYc11P/VsBXTEG3sVxKfmqft3q','2016-07-30 09:32:45','2016-07-30 09:49:38'),(3,'admin1','admin1','admin1@gmail.com','$2a$10$vwb2qgEXUqI9YqPvvhzFG.YOSYOFtqWm2ucRsKMuthr20juBa0V7q','2016-07-30 09:51:30','2016-07-30 09:51:30'),(4,'admin2','admin2','admin2@gmail.com','$2a$10$zuVbQ4udjxLU6Jh5X8kX5OPEt9OA9CzAF8V.0d0dQeiUw0EcZmf9y','2016-07-30 09:53:17','2016-07-30 09:53:17');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
