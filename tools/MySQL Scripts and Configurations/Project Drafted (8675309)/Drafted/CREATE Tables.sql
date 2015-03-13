SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `battlestage`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `battlestage` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `connectionkey` VARCHAR(50) NOT NULL ,
  `tablekey` VARCHAR(100) NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `groupaccount_uid`, `tablekey`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `groupaccount_uid_UNIQUE` (`groupaccount_uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
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
-- Table `gameraccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gameraccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `gamertag` VARCHAR(45) NOT NULL,
  `isactive` VARCHAR(1) NOT NULL,
  `configurations_sdesc_gamerrole` VARCHAR(100) NOT NULL,
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
  `avatarmimeuid` VARCHAR(36),
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
  `sdesc` varchar(100) NOT NULL,
  `configurations_sdesc_grouptype` varchar(100) NOT NULL,
  `configurations_sdesc_groupvisibility` varchar(100) NOT NULL,
  `configurations_sdesc_groupaccept` varchar(100) NOT NULL,
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
  `description` TEXT NOT NULL ,
  `mantra` TEXT NOT NULL ,
  `objectives` TEXT NOT NULL ,
  PRIMARY KEY  (`lid`,`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `lid_UNIQUE` (`lid`))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_gameraccount_to_groupaccount_to_gamerrole`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_gameraccount_to_groupaccount_to_gamerrole` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `gameraccount_uid` VARCHAR(36) NOT NULL,
  `groupaccount_uid` VARCHAR(36) NOT NULL,
  `configurations_sdesc_gamerrole` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_gameraccount_to_groupaccount_to_object`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_gameraccount_to_groupaccount_to_object` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `gameraccount_uid` VARCHAR(36) NOT NULL,
  `groupaccount_uid` VARCHAR(36) NOT NULL,
  `object_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_gameraccount_to_object`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_gameraccount_to_object` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `gameraccount_uid` VARCHAR(36) NOT NULL,
  `object_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_groupaccount_to_groupprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_groupaccount_to_groupprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `groupaccount_uid` VARCHAR(36) NOT NULL,
  `gamerprofile_uid` VARCHAR(36) NOT NULL,
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
-- Table `match_merchantaccount_to_object`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_merchantaccount_to_object` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `merchantaccount_uid` VARCHAR(36) NOT NULL,
  `object_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_useraccount_to_gameraccount_to_gamerprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_useraccount_to_gameraccount_to_gamerprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `useraccount_uid` VARCHAR(36) NOT NULL,
  `gameraccount_uid` VARCHAR(36) NOT NULL,
  `gamerprofile_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_useraccount_to_merchantaccount_to_merchantrole`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_useraccount_to_merchantaccount_to_merchantrole` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `useraccount_uid` VARCHAR(36) NOT NULL,
  `merchantaccount_uid` VARCHAR(36) NOT NULL,
  `configurations_sdesc_merchantrole` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `merchantaccount`
-- -----------------------------------------------------
CREATE TABLE `merchantaccount` (
  `lid` int(11) NOT NULL auto_increment,
  `uid` varchar(36) NOT NULL,
  `createddt` datetime NOT NULL,
  `changeddt` datetime NOT NULL,
  `sdesc` varchar(100) NOT NULL,
  `companyname` varchar(250) NOT NULL,
  `parentsdesc` varchar(100) NOT NULL default 'ROOT',
  PRIMARY KEY  (`lid`,`uid`,`sdesc`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `lid_UNIQUE` (`lid`),
  UNIQUE KEY `sdesc` (`sdesc`))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARSET = utf8;


-- -----------------------------------------------------
-- Table `merchantprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `merchantprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `officename` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `address1` VARCHAR(100) NOT NULL,
  `address2` VARCHAR(100) NOT NULL,
  `address3` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `crossappl_configurations_sdesc_region` VARCHAR(100) NOT NULL,
  `crossappl_configurations_sdesc_country` VARCHAR(100) NOT NULL,
  `intldialingcode` INT(5) NOT NULL,
  `areacode` INT(3) NOT NULL,
  `prefix` INT(3) NOT NULL,
  `number` INT(4) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `object`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `object` (
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
  `configurations_sdesc_objecttype` VARCHAR(100) NOT NULL,
  `configurations_sdesc_paymenttype` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
