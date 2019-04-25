/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.5.53 : Database - deerp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`deerp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `deerp`;

/*Table structure for table `d_client_supplier` */

DROP TABLE IF EXISTS `d_client_supplier`;

CREATE TABLE `d_client_supplier` (
  `company` varchar(0) NOT NULL COMMENT '公司名称',
  `name` varchar(0) NOT NULL COMMENT '名称',
  `address` varchar(0) NOT NULL COMMENT '地址',
  `bank_number` varchar(19) DEFAULT NULL COMMENT '银行账号',
  `telephone` varchar(11) NOT NULL COMMENT '电话号码',
  `belong` varchar(30) NOT NULL COMMENT '上级分类',
  `id` varchar(30) DEFAULT NULL COMMENT '系统id',
  `phone` varchar(8) NOT NULL COMMENT '固话',
  `status` char(1) DEFAULT NULL COMMENT '0存在1不存在',
  `client_us` char(1) DEFAULT '2' COMMENT '0供应商1客户2都有',
  KEY `belong` (`belong`),
  KEY `id` (`id`),
  CONSTRAINT `fk_d_client_supplier_d_organization_1` FOREIGN KEY (`belong`) REFERENCES `d_organization` (`belong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_client_supplier` */

/*Table structure for table `d_grant` */

DROP TABLE IF EXISTS `d_grant`;

CREATE TABLE `d_grant` (
  `id` varchar(30) NOT NULL COMMENT '绑定角色的员工，或者是部门的id',
  `role_id` varchar(30) NOT NULL COMMENT '角色id',
  `who` char(1) NOT NULL COMMENT '标注是员工还是部门',
  PRIMARY KEY (`id`),
  KEY `fk_d_grant_d_role_1` (`role_id`),
  CONSTRAINT `fk_d_grant_d_organization_1` FOREIGN KEY (`id`) REFERENCES `d_organization` (`id`),
  CONSTRAINT `fk_d_grant_d_role_1` FOREIGN KEY (`role_id`) REFERENCES `d_role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_grant` */

/*Table structure for table `d_model` */

DROP TABLE IF EXISTS `d_model`;

CREATE TABLE `d_model` (
  `id` varchar(30) NOT NULL COMMENT '模块id',
  `m_name` varchar(20) NOT NULL COMMENT '模块名',
  `details` text NOT NULL COMMENT '模块详情',
  `address` varchar(60) NOT NULL COMMENT '访问地址',
  UNIQUE KEY `one` (`m_name`,`address`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_model` */

/*Table structure for table `d_organization` */

DROP TABLE IF EXISTS `d_organization`;

CREATE TABLE `d_organization` (
  `id` varchar(30) NOT NULL COMMENT '组织结构id',
  `name` varchar(30) NOT NULL COMMENT '名称',
  `belong` varchar(30) DEFAULT 'A1111' COMMENT '上级',
  `number` char(7) DEFAULT NULL COMMENT '人数',
  `who` char(1) NOT NULL COMMENT '0员工结构1产品结构2客户结构3供应商结构',
  `status` char(1) NOT NULL DEFAULT '0' COMMENT '0存在1删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `one` (`name`),
  KEY `belong` (`belong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_organization` */

insert  into `d_organization`(`id`,`name`,`belong`,`number`,`who`,`status`) values ('C-111','公司','A1111','1','0','0');

/*Table structure for table `d_product` */

DROP TABLE IF EXISTS `d_product`;

CREATE TABLE `d_product` (
  `header` varchar(100) DEFAULT NULL COMMENT '图片',
  `use_id` varchar(20) NOT NULL COMMENT '自定义id',
  `id` varchar(30) NOT NULL COMMENT '系统id',
  `name` varchar(30) NOT NULL COMMENT '产品名称',
  `belong` varchar(30) NOT NULL COMMENT '上级分类',
  `brand` char(10) NOT NULL COMMENT '品牌',
  `status` char(1) NOT NULL DEFAULT '0' COMMENT '0在售1缺货2下架',
  `spec` varchar(30) DEFAULT NULL COMMENT '规格',
  `exchange` varchar(60) DEFAULT NULL COMMENT '兑换：1箱=320盒、1盒=12个',
  KEY `fk_d_product_d_organization_1` (`belong`),
  KEY `id` (`id`),
  CONSTRAINT `fk_d_product_d_organization_1` FOREIGN KEY (`belong`) REFERENCES `d_organization` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_product` */

/*Table structure for table `d_product_inventory` */

DROP TABLE IF EXISTS `d_product_inventory`;

CREATE TABLE `d_product_inventory` (
  `p_id` varchar(30) NOT NULL COMMENT '商品id',
  `w_id` varchar(30) NOT NULL COMMENT '仓库id',
  `num` char(10) NOT NULL DEFAULT '0' COMMENT '数量',
  `max_num` char(10) DEFAULT NULL COMMENT '上限阈值',
  `min_num` varchar(10) DEFAULT NULL COMMENT '下线阈值',
  `status` char(1) DEFAULT NULL COMMENT '0充足1超额2不足3无货4停产',
  `location` varchar(10) DEFAULT NULL COMMENT '位置',
  `exchang` varchar(20) DEFAULT NULL COMMENT '兑换：1箱=320盒、1盒=12个',
  KEY `fk_d_product_inventory_d_warehouse_1` (`w_id`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `fk_d_product_inventory_d_product_1` FOREIGN KEY (`p_id`) REFERENCES `d_product` (`id`),
  CONSTRAINT `fk_d_product_inventory_d_warehouse_1` FOREIGN KEY (`w_id`) REFERENCES `d_warehouse` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_product_inventory` */

/*Table structure for table `d_purchase` */

DROP TABLE IF EXISTS `d_purchase`;

CREATE TABLE `d_purchase` (
  `id` varchar(30) NOT NULL COMMENT '单号',
  `newtime` datetime DEFAULT NULL COMMENT '制单时间',
  `user_id` varchar(30) NOT NULL COMMENT '制单人',
  `money` double DEFAULT NULL COMMENT '总价',
  `get_time` date DEFAULT NULL COMMENT '交货时间',
  `delivery_type` char(1) DEFAULT NULL COMMENT '交货方式',
  `payment` char(1) DEFAULT NULL COMMENT '支付方式0现付',
  `in_address` varchar(60) DEFAULT NULL COMMENT '收获地址',
  `client_id` varchar(30) NOT NULL COMMENT '客户或供应商',
  `status` char(1) DEFAULT NULL COMMENT '0完成1已付款2作废',
  `remark` varchar(200) DEFAULT NULL COMMENT '备注',
  UNIQUE KEY `one` (`id`),
  KEY `user_id` (`user_id`,`client_id`),
  KEY `fk_table_2_d_client_supplier_1` (`client_id`),
  CONSTRAINT `fk_table_2_d_client_supplier_1` FOREIGN KEY (`client_id`) REFERENCES `d_client_supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_purchase` */

/*Table structure for table `d_role` */

DROP TABLE IF EXISTS `d_role`;

CREATE TABLE `d_role` (
  `m_id` varchar(30) DEFAULT NULL COMMENT '模块id',
  `name` varchar(30) NOT NULL COMMENT '角色名',
  `grant` char(1) NOT NULL COMMENT '0查看1增2删4改8无权',
  `role_id` varchar(30) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`role_id`),
  KEY `m_id` (`m_id`),
  CONSTRAINT `fk_d_grant_d_model_1` FOREIGN KEY (`m_id`) REFERENCES `d_model` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_role` */

/*Table structure for table `d_staff_clock` */

DROP TABLE IF EXISTS `d_staff_clock`;

CREATE TABLE `d_staff_clock` (
  `staff_id` char(10) NOT NULL,
  `to_work` date DEFAULT NULL,
  `off_work` date DEFAULT NULL,
  `to_work_info` char(1) NOT NULL DEFAULT '2',
  `off_work_info` char(1) NOT NULL DEFAULT '2',
  KEY `fk_d_staff_clock_d_staff_login_1` (`staff_id`),
  CONSTRAINT `fk_d_staff_clock_d_staff_login_1` FOREIGN KEY (`staff_id`) REFERENCES `d_staff_login` (`jobnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_staff_clock` */

/*Table structure for table `d_staff_information` */

DROP TABLE IF EXISTS `d_staff_information`;

CREATE TABLE `d_staff_information` (
  `name` varchar(30) NOT NULL COMMENT '姓名',
  `age` char(2) NOT NULL COMMENT '年龄',
  `telephone` char(11) NOT NULL COMMENT '电话',
  `identity_card` char(18) NOT NULL COMMENT '身份证',
  `mail` varchar(20) NOT NULL COMMENT '电子邮箱',
  `location` varchar(100) NOT NULL COMMENT '地址',
  `h_name` varchar(30) NOT NULL COMMENT '紧急联系人',
  `h_telephone` char(11) NOT NULL COMMENT '紧急联系人电话',
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '系统id',
  `header` varchar(100) DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`id`),
  UNIQUE KEY `one` (`telephone`,`identity_card`,`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `d_staff_information` */

insert  into `d_staff_information`(`name`,`age`,`telephone`,`identity_card`,`mail`,`location`,`h_name`,`h_telephone`,`id`,`header`) values ('admin','1','18038848740','111111111111111','1440705477@qq.com','jj','1','1',1,NULL),('张三','20','13302804355','350583197109234021','23428394@163.com','广东省佛山市南海万科城','王五','13302804352',2,NULL);

/*Table structure for table `d_staff_login` */

DROP TABLE IF EXISTS `d_staff_login`;

CREATE TABLE `d_staff_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统id自增',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(10) NOT NULL DEFAULT '6b3b2f701e' COMMENT '密码',
  `status` char(1) NOT NULL COMMENT '0实习期1在职2辞职',
  `jobnumber` char(10) DEFAULT NULL COMMENT '工号',
  `in_time` date DEFAULT NULL,
  `out_time` date DEFAULT NULL,
  `belong` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_d_staff_login_d_organization_1` (`belong`),
  KEY `jobnumber` (`jobnumber`),
  CONSTRAINT `fk_d_staff_login_d_organization_1` FOREIGN KEY (`belong`) REFERENCES `d_organization` (`id`),
  CONSTRAINT `fk_d_staff_login_d_staff_information_1` FOREIGN KEY (`username`) REFERENCES `d_staff_information` (`telephone`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `d_staff_login` */

insert  into `d_staff_login`(`id`,`username`,`password`,`status`,`jobnumber`,`in_time`,`out_time`,`belong`) values (6,'18038848740','6b3b2f701e','0','112332322',NULL,NULL,'C-111');

/*Table structure for table `d_warehouse` */

DROP TABLE IF EXISTS `d_warehouse`;

CREATE TABLE `d_warehouse` (
  `belong` varchar(30) DEFAULT NULL COMMENT '上级id',
  `id` varchar(30) NOT NULL COMMENT '仓库id',
  `name` varchar(30) DEFAULT NULL COMMENT '仓库名称',
  `location` varchar(40) DEFAULT NULL COMMENT '位置',
  `status` char(1) DEFAULT NULL COMMENT '0存在1消失',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `d_warehouse` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
