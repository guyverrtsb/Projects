SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `mimes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mimes` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `filename` VARCHAR(45) NULL ,
  `filetype` VARCHAR(45) NULL DEFAULT NULL ,
  `fileextension` VARCHAR(45) NULL DEFAULT NULL ,
  `tablename` VARCHAR(50) NOT NULL ,
  `filesize` VARCHAR(45) NOT NULL ,
  `filepath` VARCHAR(999) NOT NULL ,
  `filefolder` VARCHAR(999) NOT NULL ,
  `sitepackage` VARCHAR(200) NOT NULL ,
  `sitealias` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `tablename`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_appl_stephen`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mimes_appl_stephen` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `objecttiny` TINYBLOB NULL DEFAULT NULL ,
  `objectsmall` BLOB NULL DEFAULT NULL ,
  `objectmedium` MEDIUMBLOB NULL DEFAULT NULL ,
  `objectlong` LONGBLOB NULL DEFAULT NULL ,
  `mimes_uid` VARCHAR(36) NOT NULL ,
  `width` INT(11) NOT NULL ,
  `height` INT(11) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `mimes_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `mimes_uid_UNIQUE` (`mimes_uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_image_originals`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mimes_image_originals` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `objecttiny` TINYBLOB NULL DEFAULT NULL ,
  `objectsmall` BLOB NULL DEFAULT NULL ,
  `objectmedium` MEDIUMBLOB NULL DEFAULT NULL ,
  `objectlong` LONGBLOB NULL DEFAULT NULL ,
  `mimes_uid` VARCHAR(36) NOT NULL ,
  `width` INT(11) NOT NULL ,
  `height` INT(11) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `mimes_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `mimes_uid_UNIQUE` (`mimes_uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mimes_image_thumbnail_100x100`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mimes_image_thumbnail_100x100` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `objecttiny` TINYBLOB NULL DEFAULT NULL ,
  `objectsmall` BLOB NULL DEFAULT NULL ,
  `objectmedium` MEDIUMBLOB NULL DEFAULT NULL ,
  `objectlong` LONGBLOB NULL DEFAULT NULL ,
  `mimes_uid` VARCHAR(36) NOT NULL ,
  `width` INT(11) NOT NULL ,
  `height` INT(11) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `mimes_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `mimes_uid_UNIQUE` (`mimes_uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;