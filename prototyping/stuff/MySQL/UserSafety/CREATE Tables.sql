SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `match_usersafety_site_to_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_usersafety_site_to_role` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `usersafety_role_uid` VARCHAR(36) NOT NULL ,
  `usersafety_site_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_usersafety_site_to_site_alias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_usersafety_site_to_site_alias` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `usersafety_site_uid` VARCHAR(36) NOT NULL ,
  `usersafety_site_alias_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_usersafety_useraccount_to_site`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_usersafety_useraccount_to_site` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `usersafety_useraccount_uid` VARCHAR(36) NOT NULL ,
  `usersafety_site_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_usersafety_useraccount_to_userprofile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_usersafety_useraccount_to_userprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `usersafety_useraccount_uid` VARCHAR(36) NOT NULL ,
  `usersafety_userprofile_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usersafety_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usersafety_role` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `sdesc` VARCHAR(45) NOT NULL ,
  `ldesc` VARCHAR(250) NULL DEFAULT NULL ,
  `priority` SMALLINT(6) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `sdesc`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `srchkey_UNIQUE` (`sdesc` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usersafety_site`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usersafety_site` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `sdesc` VARCHAR(45) NOT NULL ,
  `ldesc` VARCHAR(250) NULL DEFAULT NULL ,
  PRIMARY KEY (`lid`, `uid`, `sdesc`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `package_UNIQUE` (`sdesc` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usersafety_site_alias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usersafety_site_alias` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `sdesc` VARCHAR(45) NOT NULL ,
  `ldesc` VARCHAR(250) NULL DEFAULT NULL ,
  PRIMARY KEY (`lid`, `uid`, `sdesc`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `fullyqualifieddomain_UNIQUE` (`sdesc` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usersafety_templink`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usersafety_templink` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `linkuid01` VARCHAR(36) NOT NULL ,
  `linkuid02` VARCHAR(36) NOT NULL ,
  `linkuid03` VARCHAR(36) NOT NULL ,
  `taskkey` VARCHAR(45) NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usersafety_useraccount`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usersafety_useraccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `active` VARCHAR(1) NOT NULL ,
  `changepassword` VARCHAR(1) NOT NULL ,
  `numberoflogintries` INT(4) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `email`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usersafety_userprofile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usersafety_userprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `firstname` VARCHAR(45) NOT NULL ,
  `lastname` VARCHAR(45) NOT NULL ,
  `city` VARCHAR(45) NOT NULL ,
  `region` VARCHAR(45) NOT NULL ,
  `country` VARCHAR(45) NOT NULL ,
  `nickname` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `usersafety_login_tracking`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usersafety_login_tracking` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `outcomekey` VARCHAR(45) NOT NULL ,
  `message` VARCHAR(45) NOT NULL ,
  `ipaddress` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_usersafety_useraccount_to_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_usersafety_useraccount_to_role` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `usersafety_useraccount_uid` VARCHAR(36) NOT NULL ,
  `usersafety_role_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
