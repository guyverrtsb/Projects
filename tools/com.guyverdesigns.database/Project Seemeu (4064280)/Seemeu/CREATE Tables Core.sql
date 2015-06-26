-- SeeMeU Application
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
USE `seemeuapplication`;



-- -----------------------------------------------------
-- Table `configurations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `configurations`;
CREATE  TABLE IF NOT EXISTS `configurations` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `sdesc` VARCHAR(100) NOT NULL ,
  `ldesc` TEXT NOT NULL ,
  `label` VARCHAR(50) NOT NULL ,
  `groupkey` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `sdesc`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entityaccount`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entityaccount`;
CREATE  TABLE IF NOT EXISTS `entityaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `configurations_sdesc_entitytype` VARCHAR(100) NOT NULL ,
  `configurations_sdesc_entityaccept` VARCHAR(100) NOT NULL ,
  `sdesc` VARCHAR(100) NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `sdesc`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entityprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entityprofile`;
CREATE  TABLE IF NOT EXISTS `entityprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_entityaccount_to_entityprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_entityaccount_to_entityprofile`;
CREATE  TABLE IF NOT EXISTS `match_entityaccount_to_entityprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `entityaccount_uid` VARCHAR(36) NOT NULL ,
  `entityprofile_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `entityaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `groupaccount`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `groupaccount`;
CREATE  TABLE IF NOT EXISTS `groupaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `configurations_sdesc_grouptype` VARCHAR(100) NOT NULL ,
  `configurations_sdesc_groupvisibility` VARCHAR(100) NOT NULL ,
  `configurations_sdesc_groupaccept` VARCHAR(100) NOT NULL ,
  `sdesc` VARCHAR(100) NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `sdesc`) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `groupprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `groupprofile`;
CREATE  TABLE IF NOT EXISTS `groupprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_groupaccount_to_groupprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_groupaccount_to_groupprofile`;
CREATE  TABLE IF NOT EXISTS `match_groupaccount_to_groupprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,
  `groupprofile_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `groupaccount_uid`) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_entityaccount_to_groupaccount_useraccount_to_userrole`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_entityaccount_to_groupaccount_useraccount_to_userrole`;
CREATE  TABLE IF NOT EXISTS `match_entityaccount_to_groupaccount_useraccount_to_userrole` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `entityaccount_uid` VARCHAR(36) NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,
  `usersafety_useraccount_uid` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_userrole` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `request_for_groupaccess` -- Request Represent a call from someone to have access to a Group
-- -----------------------------------------------------
DROP TABLE IF EXISTS `request_for_groupaccess`;
CREATE  TABLE IF NOT EXISTS `request_for_groupaccess` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,
  `who_requested_usersafety_useraccount_uid` VARCHAR(36) NOT NULL ,	-- This is the person who sent the Request for access
  `who_approves_usersafety_useraccount_uid` VARCHAR(36) NOT NULL ,	-- This is the person who approves the Request for access
  `who_gets_approved_usersafety_useraccount_uid` VARCHAR(36) NOT NULL ,	-- This is the person to gets the request for access
  PRIMARY KEY (`lid`, `uid`, `groupaccount_uid`) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_useraccount_to_usertype`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_useraccount_to_usertype`;
CREATE  TABLE IF NOT EXISTS `match_useraccount_to_usertype` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `usersafety_useraccount_uid` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_usertype` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;