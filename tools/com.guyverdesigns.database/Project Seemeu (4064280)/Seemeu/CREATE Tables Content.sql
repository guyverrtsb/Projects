-- SeeMeU Application
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
USE `seemeuapplication`;



-- -----------------------------------------------------
-- Table `wallpost`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wallpost`;
CREATE TABLE IF NOT EXISTS `wallpost` (
  `lid` int(11) NOT NULL auto_increment,
  `uid` varchar(36) NOT NULL,
  `createddt` datetime NOT NULL,
  `changeddt` datetime NOT NULL,
  `groupaccount_uid` varchar(36) NOT NULL,
  `usersafety_useraccount_uid` varchar(36) NOT NULL,
  `header` TEXT NOT NULL,
  `text` TEXT NOT NULL,
  `mimes_uid` varchar(36) DEFAULT NULL,					-- Cross Application Mimes Location
  `referenced_wallpost_uid` VARCHAR(36) DEFAULT NULL, 	-- If post has a reference it is consedered a comment
  PRIMARY KEY  (`lid`,`uid`, `groupaccount_uid`, `usersafety_useraccount_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `directmessage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `directmessage`;
CREATE TABLE IF NOT EXISTS `directmessage` (
  `lid` int(11) NOT NULL auto_increment,
  `uid` varchar(36) NOT NULL,
  `createddt` datetime NOT NULL,
  `changeddt` datetime NOT NULL,
  `from_usersafety_useraccount_uid` varchar(36) NOT NULL,
  `to_usersafety_useraccount_uid` varchar(36) NOT NULL,
  `subject` TEXT NOT NULL,
  `body` TEXT NOT NULL,
  `referenced_directmessage_uid` VARCHAR(36) DEFAULT NULL, 	-- If post has a reference it is consedered a comment
  PRIMARY KEY  (`lid`,`uid`, `from_usersafety_useraccount_uid`, `to_usersafety_useraccount_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_directmessage_to_mimesuid`	- for attachments
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_directmessage_to_mimesuid`;
CREATE  TABLE IF NOT EXISTS `match_directmessage_to_mimesuid` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `directmessage_uid` VARCHAR(36) NOT NULL ,
  `crossappl_mimes_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `directmessage_uid`) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;