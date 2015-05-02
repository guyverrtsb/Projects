SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';



-- -----------------------------------------------------
-- Table `seemeu_match_useraccount_to_groupaccount_to_userrole`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_match_useraccount_to_groupaccount_to_userrole` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `user_account_uid` VARCHAR(36) NOT NULL ,
  `group_account_uid` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_userrole` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_groupaccount`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_groupaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_group_type` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_visibility` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_useracceptance` VARCHAR(36) NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  `sdesc` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_groupprofile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_groupprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `validtodate` DATE NOT NULL ,
  `content` TEXT NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_match_groupaccount_to_groupprofile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_match_groupaccount_to_groupprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,
  `groupprofile_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `groupaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_match_universityaccount_to_groupaccount`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_match_universityaccount_to_groupaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `universityaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_request_group`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_request_group` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,
  `whosent_useraccount_uid` VARCHAR(36) NOT NULL ,
  `whoreceives_useraccount_uid` VARCHAR(36) NOT NULL ,
  `whoapproves_useraccount_uid` VARCHAR(36) NOT NULL ,
  `status` VARCHAR(1) NOT NULL DEFAULT 'P' ,
  PRIMARY KEY (`lid`, `uid`, `universityaccount_uid`, `groupaccount_uid`, `whoapproves_useraccount_uid`, `whoreceives_useraccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `message_status`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_message_status` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `message_uid` VARCHAR(36) NOT NULL ,
  `isread` VARCHAR(1) NOT NULL ,
  `okcount` INT(11) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `universityaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_wallmessage`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_wallmessage` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `group_account_uid` VARCHAR(36) NOT NULL ,
  `user_account_uid` VARCHAR(36) NOT NULL ,
  `content` TEXT NOT NULL ,
  `mimes_uid` VARCHAR(36) NULL DEFAULT NULL ,
  PRIMARY KEY (`lid`, `uid`, `universityaccount_uid`, `group_account_uid`, `user_account_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_wallmessage_comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_wallmessage_comment` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `group_account_uid` VARCHAR(36) NOT NULL ,
  `user_account_uid` VARCHAR(36) NOT NULL ,
  `wall_message_uid` VARCHAR(36) NOT NULL ,
  `content` TEXT NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `universityaccount_uid`, `group_account_uid`, `user_account_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `requests`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_requests` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,
  `who_requested_user_account_uid` VARCHAR(36) NOT NULL ,
  `who_approves_user_account_uid` VARCHAR(36) NOT NULL ,
  `who_gets_approved_user_account_uid` VARCHAR(36) NOT NULL ,
  `status` VARCHAR(1) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `universityaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_search_content`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_search_content` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `cfg_search_objects_uid` VARCHAR(36) NOT NULL ,
  `content` TEXT NOT NULL ,
  `object_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `cfg_search_objects_uid`, `object_uid`, `universityaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  FULLTEXT INDEX `search_content` (`content` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_search_keywords`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_search_keywords` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `cfg_search_objects_uid` VARCHAR(36) NOT NULL ,
  `keywords` TEXT NOT NULL ,
  `object_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `cfg_search_objects_uid`, `object_uid`, `universityaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  FULLTEXT INDEX `keywords` (`keywords` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_micrblog_account`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_micrblog_account` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `useraccount_uid` VARCHAR(36) NOT NULL ,
  `blogid` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`lid`, `universityaccount_uid`, `useraccount_uid`, `blogid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `useraccount_uid_UNIQUE` (`useraccount_uid` ASC) ,
  UNIQUE INDEX `blogid_UNIQUE` (`blogid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_microblog_posts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_microblog_posts` ( 
  `lid` INT(11) NOT NULL AUTO_INCREMENT , 
  `uid` VARCHAR(36) NOT NULL , 
  `createddt` DATETIME NOT NULL , 
  `changeddt` DATETIME NOT NULL , 
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `micrblogaccount_uid` VARCHAR(36) NOT NULL ,
  `content` TEXT NOT NULL ,  
  `mimes_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `micrblogaccount_uid`, `universityaccount_uid`) , 
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , 
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) 
ENGINE = MyISAM 
AUTO_INCREMENT = 1 
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_private_messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `messages_private` ( 
  `lid` INT(11) NOT NULL AUTO_INCREMENT , 
  `uid` VARCHAR(36) NOT NULL , 
  `createddt` DATETIME NOT NULL , 
  `changeddt` DATETIME NOT NULL ,  
  `subject` TEXT NOT NULL , 
  `content` TEXT NOT NULL , 
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `to_user_account_uid` VARCHAR(36) NOT NULL , 
  `from_user_account_uid` VARCHAR(36) NOT NULL , 
  `isread` VARCHAR(1) NOT NULL , 
  `reply_message_uid` VARCHAR(36), 
  PRIMARY KEY (`lid`, `uid`, `universityaccount_uid`) , 
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , 
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) 
ENGINE = MyISAM 
AUTO_INCREMENT = 1 
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;