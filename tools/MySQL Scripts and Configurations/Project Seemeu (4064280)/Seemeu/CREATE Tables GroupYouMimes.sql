SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `mimes_appl_groupyou_wall_message`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mimes_appl_groupyou_wall_message` (
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
