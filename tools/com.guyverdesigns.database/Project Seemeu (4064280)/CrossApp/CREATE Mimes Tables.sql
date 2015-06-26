-- SeeMeU Cross Application
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
USE `seemeucrossappli`;



DROP TABLE IF EXISTS `mime`;
-- -----------------------------------------------------
-- Table `mime`
-- -----------------------------------------------------
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


DROP TABLE IF EXISTS `mime_meta`;
-- -----------------------------------------------------
-- Table `mime_meta_image`
-- -----------------------------------------------------
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


DROP TABLE IF EXISTS `mime_blob`;
-- -----------------------------------------------------
-- Table `mime_object_blob`
-- -----------------------------------------------------
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



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
