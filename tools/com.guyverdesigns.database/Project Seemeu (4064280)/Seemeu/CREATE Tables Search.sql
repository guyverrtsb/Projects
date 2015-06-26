-- SeeMeU Application
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
USE `seemeuapplication`;



-- -----------------------------------------------------
-- Table `search_wallposts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `search_wallposts`;
CREATE  TABLE IF NOT EXISTS `search_wallposts` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,					-- Group Account UID
  `record_uid` VARCHAR(36) NOT NULL ,						-- The record UID for the object
  `configurations_sdesc_objecttype` VARCHAR(100) NOT NULL ,	-- Object Type
  `text` TEXT NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `groupaccount_uid`, `configurations_sdesc_objecttype`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  FULLTEXT INDEX `search_text` (`text` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `search_entities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `search_entities`;
CREATE  TABLE IF NOT EXISTS `search_entities` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `entityaccount_uid` VARCHAR(36) NOT NULL ,				-- Entity Content is Tied to
  `recourd_uid` VARCHAR(36) NOT NULL ,						-- The record UID for the object
  `configurations_sdesc_entitytype` VARCHAR(100) NOT NULL ,	-- Object Type
  `text` TEXT NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `entityaccount_uid`, `configurations_sdesc_entitytype`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  FULLTEXT INDEX `search_text` (`text` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;