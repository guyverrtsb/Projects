SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `seemeu_groupaccount`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_groupaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_grouptype` VARCHAR(100) NOT NULL ,
  `configurations_sdesc_visibility` VARCHAR(100) NOT NULL ,
  `configurations_sdesc_useracceptance` VARCHAR(100) NOT NULL ,
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
-- Table `seemeu_grouprequests` -- Request Represent a call from someone to have access to a Group
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_grouprequests` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `groupaccount_uid` VARCHAR(36) NOT NULL ,
  `who_requested_user_account_uid` VARCHAR(36) NOT NULL ,	-- This is the person who sent the Request for access
  `who_approves_user_account_uid` VARCHAR(36) NOT NULL ,	-- This is the person who approves the Request for access
  `who_gets_approved_user_account_uid` VARCHAR(36) NOT NULL ,	-- This is the person to gets the request for access
  PRIMARY KEY (`lid`, `uid`, `groupaccount_uid`) ,
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
-- Table `seemeu_match_message_to_useraccount`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_match_message_to_useraccount` (
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
-- Table `seemeu_match_micrblogaccount_followedby_useraccount`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_match_micrblogaccount_followedby_useraccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `micrblogaccount_uid` VARCHAR(36) NOT NULL ,
  `useraccount_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `micrblogaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_match_universityaccount_to_groupaccount`
-- -----------------------------------------------------
CREATE TABLE `seemeu_match_universityaccount_to_groupaccount` (
  `lid` int(11) NOT NULL auto_increment,
  `uid` varchar(36) NOT NULL,
  `createddt` datetime NOT NULL,
  `changeddt` datetime NOT NULL,
  `universityaccount_uid` varchar(36) NOT NULL,
  `groupaccount_uid` varchar(36) NOT NULL,
  PRIMARY KEY  (`lid`,`uid`,`universityaccount_uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `lid_UNIQUE` (`lid`) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


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
  `configurations_sdesc_userrole` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_match_objecttype_to_objectuid_to_historytype`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_match_objecttype_to_objectuid_to_statetype` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `user_account_uid` VARCHAR(36) NOT NULL ,
  `configurationobjecttype` VARCHAR(100) NOT NULL ,	-- Define the Type of Object (MicroBlog Post, Wall Post, Group, Picture, University, etc)
  `object_uid` VARCHAR(36) NOT NULL ,	-- Defines the direct UID of the Object. In combination with the
  `configurations_sdesc_statetype` VARCHAR(100) NOT NULL ,	-- Defines the state type (Liked, Disliked, Replied, Sent, Posted, Deleted)
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_micrblogaccount` -- Twitter Like Account.  Allowing user to have a Univeristy specific micro blog
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_micrblogaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `useraccount_uid` VARCHAR(36) NOT NULL ,
  `userhandle` VARCHAR(100) NOT NULL ,	-- Unique Unviersity Specific Handle for the User
  PRIMARY KEY (`lid`, `universityaccount_uid`, `useraccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_microblogsposts` - Twitter Like Posts with reference to Mime
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_microblogposts` ( 
  `lid` INT(11) NOT NULL AUTO_INCREMENT , 
  `uid` VARCHAR(36) NOT NULL , 
  `createddt` DATETIME NOT NULL , 
  `changeddt` DATETIME NOT NULL , 
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `micrblogaccount_uid` VARCHAR(36) NOT NULL ,
  `content` TEXT NOT NULL ,  
  `mimes_uid` VARCHAR(36) NOT NULL ,	-- Cross Application Mimes Location
  `numofviews` INT(11) NOT NULL default 0 , 
  `numofforwards` INT(11) NOT NULL default 0 , 
  `numoflikes` INT(11) NOT NULL default 0 , 
  PRIMARY KEY (`lid`, `uid`, `micrblogaccount_uid`, `universityaccount_uid`) , 
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , 
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) 
ENGINE = MyISAM 
AUTO_INCREMENT = 1 
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_search_content` -- Searchable Content
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_search_content` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_objecttype` VARCHAR(100) NOT NULL ,
  `content` TEXT NOT NULL ,
  `object_uid` VARCHAR(36) NOT NULL ,	-- Type of content that has been indexed
  PRIMARY KEY (`lid`, `uid`, `configurations_sdesc_objecttype`, `object_uid`, `universityaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  FULLTEXT INDEX `search_content` (`content` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_search_keywords` -- Keywords associated to a searchable content object
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_search_keywords` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `configurations_sdesc_objecttype` VARCHAR(36) NOT NULL ,
  `keywords` TEXT NOT NULL ,
  `object_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `configurations_sdesc_objecttype`, `object_uid`, `universityaccount_uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  FULLTEXT INDEX `keywords` (`keywords` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_u2umessages` - User to User Messages
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `seemeu_u2umessages` ( 
  `lid` INT(11) NOT NULL AUTO_INCREMENT , 
  `uid` VARCHAR(36) NOT NULL , 
  `createddt` DATETIME NOT NULL , 
  `changeddt` DATETIME NOT NULL ,  
  `subject` TEXT NOT NULL , 
  `content` TEXT NOT NULL , 
  `universityaccount_uid` VARCHAR(36) NOT NULL ,
  `to_user_account_uid` VARCHAR(36) NOT NULL , 
  `from_user_account_uid` VARCHAR(36) NOT NULL , 
  `referenced_message_uid` VARCHAR(36), 
  PRIMARY KEY (`lid`, `uid`, `universityaccount_uid`) , 
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , 
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) 
ENGINE = MyISAM 
AUTO_INCREMENT = 1 
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `seemeu_wallposts` - Wall Posts
-- -----------------------------------------------------
CREATE TABLE `seemeu_wallposts` (
  `lid` int(11) NOT NULL auto_increment,
  `uid` varchar(36) NOT NULL,
  `createddt` datetime NOT NULL,
  `changeddt` datetime NOT NULL,
  `universityaccount_uid` varchar(36) NOT NULL,
  `group_account_uid` varchar(36) NOT NULL,
  `user_account_uid` varchar(36) NOT NULL,
  `content` text NOT NULL,
  `mimes_uid` varchar(36) default NULL,	-- Cross Application Mimes Location
  `referenced_wallpost_uid` VARCHAR(36) default NULL, 	-- If post has a reference it is consedered a comment
  PRIMARY KEY  (`lid`,`uid`, `group_account_uid`, `user_account_uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `lid_UNIQUE` (`lid`) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;