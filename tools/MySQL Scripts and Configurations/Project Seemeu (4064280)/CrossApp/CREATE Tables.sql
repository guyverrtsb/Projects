SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `activitylog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `activitylog` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `notes` TEXT NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `configurations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `configurations` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `sdesc` VARCHAR(100) NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  `label` VARCHAR(100) NOT NULL ,
  `groupkey` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `sdesc`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_site_to_sitealias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_site_to_sitealias` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `site_uid` VARCHAR(36) NOT NULL,
  `sitealias_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `site`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `package_UNIQUE` (`sdesc` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sitealias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sitealias` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `fullyqualifieddomain_UNIQUE` (`sdesc` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `taskcontrollink`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `taskcontrollink` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `appl_configurations_sdesc_taskkey` VARCHAR(250) NOT NULL,
  `uid1` VARCHAR(36) NOT NULL,
  `uid2` VARCHAR(36) NOT NULL,
  `uid3` VARCHAR(36) NOT NULL,
  `pathtoclass` VARCHAR(999) NOT NULL,
  `isactive` VARCHAR(1) NOT NULL,
  `json` TEXT NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_standard_meta_document`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mimes_standard_meta_document` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `site` VARCHAR(200) NOT NULL,
  `sitealias` VARCHAR(200) NOT NULL,
  `appl_table` VARCHAR(255) NOT NULL COMMENT 'Use this feild to reference which table in the database should be used for the BLOB',
  `appl_table_uid` VARCHAR(36) NOT NULL COMMENT 'Use this field to reference which field in the ref_table_name should be used for the BLOB',
  `name` VARCHAR(45) NOT NULL,
  `type` VARCHAR(999) NOT NULL,
  `size` VARCHAR(45) NOT NULL,
  `url` VARCHAR(999) NOT NULL,
  `osfolder` VARCHAR(999) NOT NULL,
  `ospath` VARCHAR(999) NOT NULL,
  `urlfolder` VARCHAR(999) NOT NULL,
  `urlpath` VARCHAR(999) NOT NULL,
  `osfileext` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_standard_appl_image_thumbnail_100x100`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mimes_standard_appl_image_thumbnail_100x100` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `objecttiny` TINYBLOB NULL DEFAULT NULL,
  `objectsmall` BLOB NULL DEFAULT NULL,
  `objectmedium` MEDIUMBLOB NULL DEFAULT NULL,
  `objectlong` LONGBLOB NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_standard_appl_image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mimes_standard_appl_image` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `objecttiny` TINYBLOB NULL DEFAULT NULL,
  `objectsmall` BLOB NULL DEFAULT NULL,
  `objectmedium` MEDIUMBLOB NULL DEFAULT NULL,
  `objectlong` LONGBLOB NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_standard_appl_image_scaled`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mimes_standard_appl_image_scaled` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `objecttiny` TINYBLOB NULL DEFAULT NULL,
  `objectsmall` BLOB NULL DEFAULT NULL,
  `objectmedium` MEDIUMBLOB NULL DEFAULT NULL,
  `objectlong` LONGBLOB NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_standard_appl_document`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mimes_standard_appl_document` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `objecttiny` TINYBLOB NULL DEFAULT NULL,
  `objectsmall` BLOB NULL DEFAULT NULL,
  `objectmedium` MEDIUMBLOB NULL DEFAULT NULL,
  `objectlong` LONGBLOB NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_standard_appl_catchall`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mimes_standard_appl_catchall` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `objecttiny` TINYBLOB NULL DEFAULT NULL,
  `objectsmall` BLOB NULL DEFAULT NULL,
  `objectmedium` MEDIUMBLOB NULL DEFAULT NULL,
  `objectlong` LONGBLOB NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_standard_meta_image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mimes_standard_meta_image` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `site` VARCHAR(200) NOT NULL,
  `sitealias` VARCHAR(200) NOT NULL,
  `appl_table` VARCHAR(255) NOT NULL COMMENT 'Use this feild to reference which table in the database should be used for the BLOB',
  `appl_table_uid` VARCHAR(36) NOT NULL COMMENT 'Use this field to reference which field in the ref_table_name should be used for the BLOB',
  `name` VARCHAR(45) NOT NULL,
  `type` VARCHAR(999) NOT NULL,
  `size` VARCHAR(45) NOT NULL,
  `url` VARCHAR(999) NOT NULL,
  `osfolder` VARCHAR(999) NOT NULL,
  `ospath` VARCHAR(999) NOT NULL,
  `urlfolder` VARCHAR(999) NOT NULL,
  `urlpath` VARCHAR(999) NOT NULL,
  `osfileext` VARCHAR(45) NOT NULL,
  `appl_table_scaled` VARCHAR(255) NOT NULL COMMENT 'Use this feild to reference which table in the database should be used for the BLOB',
  `appl_table_scaled_uid` VARCHAR(36) NOT NULL COMMENT 'Use this field to reference which field in the ref_table_name should be used for the BLOB',
  `appl_table_scaled_size` VARCHAR(45) NOT NULL,
  `appl_table_scaled_url` VARCHAR(999) NOT NULL,
  `appl_table_scaled_ospath` VARCHAR(999) NOT NULL,
  `appl_table_scaled_osfolder` VARCHAR(999) NOT NULL,
  `appl_table_thumbnail` VARCHAR(255) NOT NULL COMMENT 'Use this feild to reference which table in the database should be used for the BLOB',
  `appl_table_thumbnail_uid` VARCHAR(36) NOT NULL COMMENT 'Use this field to reference which field in the ref_table_name should be used for the BLOB',
  `appl_table_thumbnail_size` VARCHAR(45) NOT NULL,
  `appl_table_thumbnail_url` VARCHAR(999) NOT NULL,
  `appl_table_thumbnail_ospath` VARCHAR(999) NOT NULL,
  `appl_table_thumbnail_osfolder` VARCHAR(999) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
