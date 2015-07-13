USE seemeuusersafety;

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
  `groupkey` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `logintracking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `logintracking` ;

CREATE TABLE IF NOT EXISTS `logintracking` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `outcomekey` VARCHAR(45) NOT NULL,
  `message` TEXT NOT NULL,
  `ipaddress` VARCHAR(45) NOT NULL,
  `nickname` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_openauth`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_openauth` ;

CREATE TABLE IF NOT EXISTS `match_openauth` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `useraccount_uid` VARCHAR(36) NOT NULL,
  `openauth_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_user` ;

CREATE TABLE IF NOT EXISTS `match_user` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `useraccount_uid` VARCHAR(36) NOT NULL,
  `userprofile_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_user_to_crossappl_site`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_user_to_crossappl_site` ;

CREATE TABLE IF NOT EXISTS `match_user_to_crossappl_site` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `match_user_uid` VARCHAR(36) NOT NULL,
  `crossappl_match_site_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `openauth`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `openauth` ;

CREATE TABLE IF NOT EXISTS `openauth` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `openauthkey` VARCHAR(36) NOT NULL,
  `expiredt` DATETIME NOT NULL,
  `isvalid` VARCHAR(1) NOT NULL,
  `configurations_sdesc_openauthprovider` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `useraccount`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `useraccount` ;

CREATE TABLE IF NOT EXISTS `useraccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `nickname` VARCHAR(100) NOT NULL,
  `usertablekey` VARCHAR(100) NOT NULL,
  `isactive` VARCHAR(1) NOT NULL,
  `changepassword` VARCHAR(1) NOT NULL,
  `numberoflogintries` INT(1) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `email`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `userprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `userprofile` ;

CREATE TABLE IF NOT EXISTS `userprofile` (
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- SeeMeU Usersafety
-- Use this SQL File to INSERT the configurations required for the site to run.
-- USE `seemeuusersafety`;
-- ****************************************************************************************************************
-- ************************* COUNTRIES
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-PARSE',
'Parse',
'Parse',
'OPENAUTH_PROVIDER'
),
( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-WATSAPP',
'Wats App',
'Wats App',
'OPENAUTH_PROVIDER'
),
( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-INSTAGRAM',
'Instagram',
'Instagram',
'OPENAUTH_PROVIDER'
),
( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-TWITTER',
'Twitter',
'Twitter',
'OPENAUTH_PROVIDER'
),
( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-FACEBOOK',
'Facebook',
'Facebook',
'OPENAUTH_PROVIDER'
);