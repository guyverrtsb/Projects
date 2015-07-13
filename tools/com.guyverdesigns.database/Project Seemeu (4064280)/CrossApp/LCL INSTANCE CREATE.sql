USE seemeucrossappli;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema seemeuapplication
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema seemeucrossappli
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema seemeuusersafety
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `activitylog`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `activitylog` ;

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
DROP TABLE IF EXISTS `configurations` ;

CREATE TABLE IF NOT EXISTS `configurations` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `label` VARCHAR(100) NOT NULL,
  `groupkey` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_site`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_site` ;

CREATE TABLE IF NOT EXISTS `match_site` (
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
-- Table `mime`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mime` ;

CREATE TABLE IF NOT EXISTS `mime` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `configurations_sdesc_mimetype` VARCHAR(100) NOT NULL,
  `servermimetype` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mime_blob`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mime_blob` ;

CREATE TABLE IF NOT EXISTS `mime_blob` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `mime_meta_uid` VARCHAR(36) NOT NULL,
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
-- Table `mime_meta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mime_meta` ;

CREATE TABLE IF NOT EXISTS `mime_meta` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `mime_uid` VARCHAR(36) NOT NULL,
  `configurations_sdesc_mimetypeconfig` VARCHAR(100) NOT NULL,
  `name` VARCHAR(900) NOT NULL,
  `size` VARCHAR(45) NOT NULL,
  `osfolder` VARCHAR(999) NOT NULL,
  `ospath` VARCHAR(999) NOT NULL,
  `osfileext` VARCHAR(45) NOT NULL,
  `urlfolder` VARCHAR(999) NOT NULL,
  `urlpath` VARCHAR(999) NOT NULL,
  `urlfileext` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `site`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site` ;

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
DROP TABLE IF EXISTS `sitealias` ;

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
DROP TABLE IF EXISTS `taskcontrollink` ;

CREATE TABLE IF NOT EXISTS `taskcontrollink` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `appl_configurations_sdesc_taskkey` VARCHAR(100) NOT NULL,
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- SeeMeU Cross Application
-- Use this SQL File to INSERT the configurations required for the site to run.
-- USE `seemeucrossappli`;
-- ****************************************************************************************************************
-- ************************* COUNTRIES
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'COUNTRY_US',
'United States of America',
'United States of America',
'COUNTRIES'
),
( UUID(), NOW(), NOW(),
'COUNTRY_AU',
'Australia',
'Australia',
'COUNTRIES'
),
( UUID(), NOW(), NOW(),
'COUNTRY_CA',
'Canada',
'Canada',
'COUNTRIES'
),
( UUID(), NOW(), NOW(),
'COUNTRY_EN',
'England',
'England',
'COUNTRIES'
),
( UUID(), NOW(), NOW(),
'COUNTRY_ES',
'Spain',
'Spain',
'COUNTRIES'
);
-- **********************************************************************************************************************************************
-- ************************* COUNTRY_US
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)VALUES
( UUID(), NOW(), NOW(),
'REGION_AZ',
'Arizona',
'Arizona',
'COUNTRY_US'
),
( UUID(), NOW(), NOW(),
'REGION_NC',
'North Carolina',
'North Carolina',
'COUNTRY_US'
),
( UUID(), NOW(), NOW(),
'REGION_SC',
'South Carolina',
'South Carolina',
'COUNTRY_US'
),
( UUID(), NOW(), NOW(),
'REGION_OK',
'Oklahoma',
'Oklahoma',
'COUNTRY_US'
),
( UUID(), NOW(), NOW(),
'REGION_MO',
'Missouri',
'Missouri',
'COUNTRY_US'
),
( UUID(), NOW(), NOW(),
'REGION_PA',
'Pennsylvania',
'Pennsylvania',
'COUNTRY_US'
);
-- ****************************************************************************************************************
-- ************************* MIME_OBJECT
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_OBJECT-IMAGE',
'Image is used to store images inlcuding TIF, PNG, BMP, JPG, JEG, Gif and others',
'Image',
'MIME_OBJECT'
),
( UUID(), NOW(), NOW(),
'MIME_OBJECT-DOCUMENT',
'For Doucments such as PDF, Excel, Word, and other document types',
'Document',
'MIME_OBJECT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-VIDEO',
'For Videos',
'Video',
'MIME_OBJECT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-FILE',
'Used for mimes of type files.  These are zips and other types of files that need to be tracked but not are catchalls',
'File',
'MIME_OBJECT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-CATCHALL',
'Used for items that do not fall into a defiend Mime Type',
'Catch All',
'MIME_OBJECT'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-IMAGE-TYPE
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_OBJECT-IMAGE-TYPE-JPG',
'JPG',
'JPG',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-JPEG',
'JPEG',
'JPEG',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-GIF',
'GIF',
'GIF',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-TIF',
'TIF',
'TIF',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-PNG',
'PNG',
'PNG',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-BMP',
'BMP',
'BMP',
'MIME_TYPE-IMAGE-TYPE'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-IMAGE-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-IMAGE-CONFIG'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-CONFIG-500X500',
'500 X 500',
'500 X 500',
'MIME_TYPE-IMAGE-CONFIG'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-CONFIG-100X100',
'100 X 100',
'100 X 100',
'MIME_TYPE-IMAGE-CONFIG'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-CONFIG-80X80',
'80 X 80',
'80 X 80',
'MIME_TYPE-IMAGE-CONFIG'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-DOCUMENT-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-DOCUMENT-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-DOCUMENT-CONFIG'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-VIDEO-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-VIDEO-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-VIDEO-CONFIG'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-FILE-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-FILE-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-FILE-CONFIG'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-CATCHALL-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-CATCHALL-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-CATCHALL-CONFIG'
);