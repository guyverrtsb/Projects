SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


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
  `label` VARCHAR(50) NOT NULL ,
  `groupkey` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `sdesc`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_usersafety_useraccount_to_drafted_gameraccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_usersafety_useraccount_to_drafted_gameraccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `usersafety_useraccount_uid` VARCHAR(36) NOT NULL,
  `drafted_gameraccount_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_gameraccount_to_gamerprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_gameraccount_to_gamerprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `gameraccount_uid` VARCHAR(36) NOT NULL,
  `gamerprofile_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_gameraccount_to_groupaccount_to_grouprole`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_gameraccount_to_groupaccount_to_grouprole` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `gameraccount_uid` VARCHAR(36) NOT NULL,
  `groupaccount_uid` VARCHAR(36) NOT NULL,
  `configurations_sdesc_grouprole` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_merchantaccount_to_merchantprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_merchantaccount_to_merchantprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `merchantaccount_uid` VARCHAR(36) NOT NULL,
  `merchantprofile_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_groupaccount_to_groupprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_merchantaccount_to_merchantprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `groupaccount_uid` VARCHAR(36) NOT NULL,
  `groupprofile_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_merchantaccount_to_hazards`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_merchantaccount_to_hazards` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `merchantaccount_uid` VARCHAR(36) NOT NULL,
  `hazards_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_merchantaccount_to_safegaurds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_merchantaccount_to_safegaurds` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `merchantaccount_uid` VARCHAR(36) NOT NULL,
  `safegaurds_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_merchantaccount_to_places`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_merchantaccount_to_places` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `merchantaccount_uid` VARCHAR(36) NOT NULL,
  `places_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gameraccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gameraccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `gamertag` VARCHAR(45) NOT NULL,
  `configurations_sdesc_usertype` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `gamertag`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `gamertag_UNIQUE` (`gamertag` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gamerprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gamerprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `crossappl_configurations_sdesc_region` VARCHAR(100) NOT NULL,
  `crossappl_configurations_sdesc_country` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hazards`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hazards` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `nickname` VARCHAR(100) NOT NULL,
  `icon` VARCHAR(45) NOT NULL,
  `detectionrange` INT(4) NOT NULL,
  `effectiverange` INT(4) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `safegaurds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safegaurds` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `nickname` VARCHAR(100) NOT NULL,
  `icon` VARCHAR(45) NOT NULL,
  `detectionrange` INT(4) NOT NULL,
  `effectiverange` INT(4) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `places`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `places` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `nickname` VARCHAR(100) NOT NULL,
  `icon` VARCHAR(45) NOT NULL,
  `detectionrange` INT(4) NOT NULL,
  `effectiverange` INT(4) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `merchantaccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merchantaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `company` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `merchantprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merchantprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `crossappl_configurations_sdesc_region` VARCHAR(100) NOT NULL,
  `crossappl_configurations_sdesc_country` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `groupaccount`
-- -----------------------------------------------------
CREATE TABLE `groupaccount` (
  `lid` int(11) NOT NULL auto_increment,
  `uid` varchar(36) NOT NULL,
  `createddt` datetime NOT NULL,
  `changeddt` datetime NOT NULL,
  `ldesc` varchar(250) NOT NULL,
  `configurations_sdesc_grouptype` varchar(100) NOT NULL,
  PRIMARY KEY  (`lid`,`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `lid_UNIQUE` (`lid`))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `groupprofile`
-- -----------------------------------------------------
CREATE TABLE `groupprofile` (
  `lid` int(11) NOT NULL auto_increment,
  `uid` varchar(36) NOT NULL,
  `createddt` datetime NOT NULL,
  `changeddt` datetime NOT NULL,
  `validtodate` date NOT NULL,
  PRIMARY KEY  (`lid`,`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `lid_UNIQUE` (`lid`))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
