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
-- Table `match_university_account_to_university_profile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_universityaccount_to_universityprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `universityprofile_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_universityaccount_to_useraccount_to_usertype`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_universityaccount_to_useraccount_to_usertype` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `useraccount_uid` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_usertype` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_universityaccount_to_useraccount_to_userrole`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_universityaccount_to_useraccount_to_userrole` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `useraccount_uid` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_userrole` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8; 


-- -----------------------------------------------------
-- Table `universityaccount`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `universityaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `webaddress` VARCHAR(100) NOT NULL ,
  `emaildomain` VARCHAR(100) DEFAULT NULL ,
  `isactive` VARCHAR(1) NOT NULL DEFAULT "F" ,
  `islive` VARCHAR(1) NOT NULL DEFAULT "F" ,
  PRIMARY KEY (`lid`, `webaddress`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `webaddress_UNIQUE` (`webaddress` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `universityprofile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `universityprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `city` VARCHAR(45) NOT NULL ,
  `crossappl_configurations_sdesc_region` VARCHAR(100) DEFAULT NULL ,
  `crossappl_configurations_sdesc_country` VARCHAR(100) DEFAULT NULL ,
  `region` VARCHAR(45) NOT NULL ,
  `foundeddate` DATE NULL DEFAULT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  `name` VARCHAR(250) NOT NULL ,
  `phonenumber` VARCHAR(20) NOT NULL ,
  `configurations_sdesc_schooltype` VARCHAR(100) DEFAULT NULL ,
  `schooltype` VARCHAR(11) NOT NULL ,
  `latitude` VARCHAR(15) NOT NULL ,
  `longitude` VARCHAR(15) NOT NULL ,
  `universitysource_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `ldesc`, `universitysource_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `ldesc_UNIQUE` (`ldesc` ASC) ,
  UNIQUE INDEX `universitysource_uid_UNIQUE` (`universitysource_uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `universitysource`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `universitysource` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `cxurl` VARCHAR(1000) NOT NULL ,
  `idx` INT(6) NOT NULL ,
  `profile` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `universityaccountcreated` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_essentials` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_about` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_overallratings` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_studentratings` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_location` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_gettingaround` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_walkability` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_transit` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_weather` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_students` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_similar` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  `snapshot_otherschoolsnear` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `scholarshipprofile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `scholarshipprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  `name` VARCHAR(250) NOT NULL ,
  `scholarshipsponsor_uid` VARCHAR(250) NOT NULL ,
  `applylink` VARCHAR(1000) DEFAULT NULL ,
  `scholarshipsource_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `ldesc`, `scholarshipsource_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `ldesc_UNIQUE` (`ldesc` ASC) ,
  UNIQUE INDEX `scholarshipsource_uid_UNIQUE` (`scholarshipsource_uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `scholarshipsponsor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `scholarshipsponsor` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  `name` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `ldesc`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `ldesc_UNIQUE` (`ldesc` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `scholarshipsource`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `scholarshipsource` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `cxurl` VARCHAR(1000) NOT NULL ,
  `idx` INT(6) NOT NULL ,
  `profile` VARCHAR(1) NOT NULL DEFAULT 'F' ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
