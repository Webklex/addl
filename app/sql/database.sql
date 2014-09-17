
#CREATE DATABASE [%DATABASE%];

DROP TABLE IF EXISTS `[%DATABASE%]`.`times`;
CREATE TABLE `[%DATABASE%]`.`times` (
    `id`                    INT(11)       NOT NULL    AUTO_INCREMENT ,
    `project_name`          VARCHAR(150)  DEFAULT NULL ,
    `service_name`          VARCHAR(150)  DEFAULT NULL ,
    `minutes`               INT(5)        NOT NULL ,
    `created`               INT(11)       NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[%DATABASE%]`.`sets`;
CREATE TABLE `[%DATABASE%]`.`sets` (
    `id`                    INT(11)       NOT NULL    AUTO_INCREMENT ,
    `object_data`           TEXT          NOT NULL ,
    `set_date`              VARCHAR(8)    NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `[%DATABASE%]`.`extensions`;
CREATE TABLE `[%DATABASE%]`.`extensions` (
    `id`               INT(255)       NOT NULL    AUTO_INCREMENT ,
    `parent`           INT(255)       DEFAULT NULL ,
    `value`            VARCHAR(250)   NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[%DATABASE%]`.`configs`;
CREATE TABLE `[%DATABASE%]`.`configs` (
    `id`             INT(255)        NOT NULL    AUTO_INCREMENT ,
    `name`           VARCHAR(150)    NOT NULL ,
    `value`          VARCHAR(150)    NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `[%DATABASE%]`.`configs` (`name`,`value`) VALUES ('VERSION','14.09alpha');
INSERT INTO `[%DATABASE%]`.`configs` (`name`,`value`) VALUES ('COMPANY_NAME','Firma GmbH');
INSERT INTO `[%DATABASE%]`.`configs` (`name`,`value`) VALUES ('AUSB_START','01.02.2013');
INSERT INTO `[%DATABASE%]`.`configs` (`name`,`value`) VALUES ('MITE_SUB','https://xxx.mite.yo.lk/');
INSERT INTO `[%DATABASE%]`.`configs` (`name`,`value`) VALUES ('MITE_KEY','xxx');
INSERT INTO `[%DATABASE%]`.`configs` (`name`,`value`) VALUES ('MITE_TIMES','false');
