CREATE TABLE IF NOT EXISTS `#__descargas_documentos` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL ,
	`category` VARCHAR(255)  NOT NULL ,
	`filename` VARCHAR(255)  NOT NULL ,
	`ordering` INT(11)  NOT NULL ,
	`state` TINYINT(1)  NOT NULL ,
	`checked_out` INT(11)  NOT NULL ,
	`checked_out_time` DATETIME NOT NULL ,
	`created_by` INT(11)  NOT NULL ,
	`createDate` DATETIME  NOT NULL ,
	`finishDate` DATETIME  NOT NULL ,
	`usergroup` INT(11)  NOT NULL DEFAULT 2,
	`modified_by` INT(11)  NOT NULL ,
	`language` CHAR(7)  NOT NULL ,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__descargas_ftp` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL ,
	`path` VARCHAR(255)  NOT NULL ,
	`ordering` INT(11)  NOT NULL ,
	`state` TINYINT(1)  NOT NULL ,
	`checked_out` INT(11)  NOT NULL ,
	`checked_out_time` DATETIME NOT NULL ,
	`created_by` INT(11)  NOT NULL ,
	`createDate` DATETIME  NOT NULL ,
	`finishDate` DATETIME  NOT NULL ,
	`modified_by` INT(11)  NOT NULL ,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8mb4_unicode_ci;

