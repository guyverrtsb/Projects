SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema lclcrossapplication
-- -----------------------------------------------------
-- The thought behind this tabel is that all of the Physical BLOB files and core Meta Data would be stored in these tables.  
-- META: The meta table will be used to store the Core Data.
-- APPL: The appl table is the physical blob file.
-- 
-- The {appl_table_name; appl_record_uid} will be used to map the META data to the APPL data.
-- -----------------------------------------------------
-- Schema lclguyverdesigns
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema lclunivlifeportal
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema lclusersafety
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema lclunivlifeportal_specific_tables
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `activity_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `activity_log` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `fdesc` VARCHAR(45) NOT NULL,
  `notes` TEXT NOT NULL,
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
  `appl_table` VARCHAR(255) NOT NULL COMMENT 'Use this field to reference which table in the database should be used for the BLOB',
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
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table is the default location for MIMES META Data.';


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
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table is the DEFAULT Location for Image BLOBs in their ' /* comment truncated */ /*humbnail state
*.png; *.bmp; *.gif; *.jpg; *.jpeg; *.tif*/;


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
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table is the DEFAULT Location for Image BLOBs in their ' /* comment truncated */ /*riginal state
*.png; *.bmp; *.gif; *.jpg; *.jpeg; *.tif*/;


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
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table is the DEFAULT Location for Image BLOBs in their ' /* comment truncated */ /*esired resized state
*.png; *.bmp; *.gif; *.jpg; *.jpeg; *.tif*/;


-- -----------------------------------------------------
-- Table `cfg_defaults`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cfg_defaults` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `label` VARCHAR(50) NOT NULL,
  `group_key` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC),
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
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table is the DEFAULT Location for Document BLOBs' /* comment truncated */ /**.pdf; *.xls; *.doc
*/;


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
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table is the DEFAULT Location for Document BLOBs' /* comment truncated */ /**.pdf; *.xls; *.doc
*/;


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
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table is the default location for MIMES META Data.';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
