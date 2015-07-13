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
  `ldesc` TEXT NOT NULL,
  `label` VARCHAR(50) NOT NULL,
  `groupkey` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `directmessage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `directmessage` ;

CREATE TABLE IF NOT EXISTS `directmessage` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `from_usersafety_useraccount_uid` VARCHAR(36) NOT NULL,
  `to_usersafety_useraccount_uid` VARCHAR(36) NOT NULL,
  `subject` TEXT NOT NULL,
  `body` TEXT NOT NULL,
  `referenced_directmessage_uid` VARCHAR(36) NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`, `from_usersafety_useraccount_uid`, `to_usersafety_useraccount_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entityaccount`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entityaccount` ;

CREATE TABLE IF NOT EXISTS `entityaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `configurations_sdesc_entitytype` VARCHAR(100) NOT NULL,
  `configurations_sdesc_entityaccept` VARCHAR(100) NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entityprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entityprofile` ;

CREATE TABLE IF NOT EXISTS `entityprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `groupaccount`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `groupaccount` ;

CREATE TABLE IF NOT EXISTS `groupaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `configurations_sdesc_grouptype` VARCHAR(100) NOT NULL,
  `configurations_sdesc_groupvisibility` VARCHAR(100) NOT NULL,
  `configurations_sdesc_groupaccept` VARCHAR(100) NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `groupprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `groupprofile` ;

CREATE TABLE IF NOT EXISTS `groupprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_directmessage_attachments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_directmessage_attachments` ;

CREATE TABLE IF NOT EXISTS `match_directmessage_attachments` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `directmessage_uid` VARCHAR(36) NOT NULL,
  `crossappl_mimes_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `directmessage_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_entity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_entity` ;

CREATE TABLE IF NOT EXISTS `match_entity` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `entityaccount_uid` VARCHAR(36) NOT NULL,
  `entityprofile_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `entityaccount_uid`, `entityprofile_uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_group`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_group` ;

CREATE TABLE IF NOT EXISTS `match_group` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `groupaccount_uid` VARCHAR(36) NOT NULL,
  `groupprofile_uid` VARCHAR(36) NOT NULL,
  `match_entity_uid` VARCHAR(36) NOT NULL,
  `match_usersafety_user_uid` VARCHAR(36) NULL,
  `configurations_sdesc_grouprole` VARCHAR(100) NULL,
  PRIMARY KEY (`lid`, `uid`, `groupaccount_uid`, `groupprofile_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `request_for_groupaccess`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `request_for_groupaccess` ;

CREATE TABLE IF NOT EXISTS `request_for_groupaccess` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `universityaccount_uid` VARCHAR(36) NOT NULL,
  `groupaccount_uid` VARCHAR(36) NOT NULL,
  `who_requested_usersafety_useraccount_uid` VARCHAR(36) NOT NULL,
  `who_approves_usersafety_useraccount_uid` VARCHAR(36) NOT NULL,
  `who_gets_approved_usersafety_useraccount_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `groupaccount_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_scholarshipaccount`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_scholarshipaccount` ;

CREATE TABLE IF NOT EXISTS `entity_scholarshipaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `entityaccount_uid` VARCHAR(36) NOT NULL,
  `isactive` VARCHAR(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_scholarshipprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_scholarshipprofile` ;

CREATE TABLE IF NOT EXISTS `entity_scholarshipprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `name` VARCHAR(250) NOT NULL,
  `entity_scholarshipsponsor_uid` VARCHAR(250) NOT NULL,
  `applylink` VARCHAR(1000) NULL DEFAULT NULL,
  `entity_scholarshipsource_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `ldesc`, `entity_scholarshipsource_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `ldesc_UNIQUE` (`ldesc` ASC),
  UNIQUE INDEX `scholarshipsource_uid_UNIQUE` (`entity_scholarshipsource_uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_scholarshipsource`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_scholarshipsource` ;

CREATE TABLE IF NOT EXISTS `entity_scholarshipsource` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `url` VARCHAR(1000) NOT NULL,
  `idx` INT(6) NOT NULL,
  `profile` VARCHAR(1) NOT NULL DEFAULT 'F',
  `screendata` VARCHAR(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_scholarshipsourcedata`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_scholarshipsourcedata` ;

CREATE TABLE IF NOT EXISTS `entity_scholarshipsourcedata` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `idx` INT(6) NOT NULL,
  `entity_scholarshipsource_uid` VARCHAR(36) NOT NULL,
  `screendata_json` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_scholarshipsponsor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_scholarshipsponsor` ;

CREATE TABLE IF NOT EXISTS `entity_scholarshipsponsor` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `name` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `ldesc`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `ldesc_UNIQUE` (`ldesc` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `search_entities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `search_entities` ;

CREATE TABLE IF NOT EXISTS `search_entities` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `match_entity_uid` VARCHAR(36) NOT NULL,
  `record_uid` VARCHAR(36) NOT NULL,
  `configurations_sdesc_entitytype` VARCHAR(100) NOT NULL,
  `text` TEXT NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `match_entity_uid`, `configurations_sdesc_entitytype`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  FULLTEXT INDEX `search_text` (`text` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `search_wallposts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `search_wallposts` ;

CREATE TABLE IF NOT EXISTS `search_wallposts` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `match_group_uid` VARCHAR(36) NOT NULL,
  `record_uid` VARCHAR(36) NOT NULL,
  `configurations_sdesc_objecttype` VARCHAR(100) NOT NULL,
  `text` TEXT NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `match_group_uid`, `configurations_sdesc_objecttype`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  FULLTEXT INDEX `search_text` (`text` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_universityaccount`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_universityaccount` ;

CREATE TABLE IF NOT EXISTS `entity_universityaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `emaildomain` VARCHAR(100) NOT NULL,
  `isactive` VARCHAR(1) NOT NULL DEFAULT 'F',
  `islive` VARCHAR(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`lid`, `uid`, `emaildomain`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `emaildomain_UNIQUE` (`emaildomain` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_universityprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_universityprofile` ;

CREATE TABLE IF NOT EXISTS `entity_universityprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `webaddress` VARCHAR(100) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `crossappl_configurations_sdesc_region` VARCHAR(100) NULL,
  `crossappl_configurations_sdesc_country` VARCHAR(100) NULL DEFAULT NULL,
  `region` VARCHAR(45) NOT NULL,
  `foundeddate` DATE NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `name` VARCHAR(250) NOT NULL,
  `phonenumber` VARCHAR(20) NOT NULL,
  `configurations_sdesc_schooltype` VARCHAR(100) NULL,
  `schooltype` VARCHAR(11) NOT NULL,
  `latitude` VARCHAR(15) NOT NULL,
  `longitude` VARCHAR(15) NOT NULL,
  `entity_universitysource_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `entity_universitysource_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `universitysource_uid_UNIQUE` (`entity_universitysource_uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_universitysource`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_universitysource` ;

CREATE TABLE IF NOT EXISTS `entity_universitysource` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `url` VARCHAR(1000) NOT NULL,
  `idx` INT(6) NOT NULL,
  `profilecreated` VARCHAR(1) NOT NULL DEFAULT 'F',
  `accountcreated` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_essentials` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_about` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_overallratings` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_studentratings` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_location` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_gettingaround` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_walkability` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_transit` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_weather` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_students` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_similar` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_otherschoolsnear` VARCHAR(1) NOT NULL DEFAULT 'F',
  `snapshot_screendata` VARCHAR(1) NOT NULL DEFAULT 'F',
  `academics_screendata` VARCHAR(1) NOT NULL DEFAULT 'F',
  `costs_screendata` VARCHAR(1) NOT NULL DEFAULT 'F',
  `admissions_screendata` VARCHAR(1) NOT NULL DEFAULT 'F',
  `collegelife_screendata` VARCHAR(1) NOT NULL DEFAULT 'F',
  `photosvideos_screendata` VARCHAR(1) NOT NULL DEFAULT 'F',
  `reviews_screendata` VARCHAR(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_universitysourcedata`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_universitysourcedata` ;

CREATE TABLE IF NOT EXISTS `entity_universitysourcedata` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `idx` INT(6) NOT NULL,
  `entity_universitysource_uid` VARCHAR(36) NOT NULL,
  `snapshot_screendata_json` MEDIUMTEXT NULL DEFAULT NULL,
  `academics_screendata_json` MEDIUMTEXT NULL DEFAULT NULL,
  `costs_screendata_json` MEDIUMTEXT NULL DEFAULT NULL,
  `admissions_screendata_json` MEDIUMTEXT NULL DEFAULT NULL,
  `collegelife_screendata_json` MEDIUMTEXT NULL DEFAULT NULL,
  `photosvideos_screendata_json` MEDIUMTEXT NULL DEFAULT NULL,
  `reviews_screendata_json` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`, `entity_universitysource_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `universitysource_uid_UNIQUE` (`entity_universitysource_uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `wallpost`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wallpost` ;

CREATE TABLE IF NOT EXISTS `wallpost` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `match_group_uid` VARCHAR(36) NOT NULL,
  `match_usersafety_user_uid` VARCHAR(36) NOT NULL,
  `header` TEXT NOT NULL,
  `text` TEXT NOT NULL,
  `mimes_uid` VARCHAR(36) NULL DEFAULT NULL,
  `referenced_wallpost_uid` VARCHAR(36) NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`, `match_group_uid`, `match_usersafety_user_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_entity_to_university`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_entity_to_university` ;

CREATE TABLE IF NOT EXISTS `match_entity_to_university` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `entity_universityaccount_uid` VARCHAR(36) NOT NULL,
  `entity_universityprofile_uid` VARCHAR(36) NOT NULL,
  `match_entity_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `match_entity_uid`, `entity_universityaccount_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `entity_universityprofile_uid_UNIQUE` (`entity_universityprofile_uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_entity_to_usersafety_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_entity_to_usersafety_user` ;

CREATE TABLE IF NOT EXISTS `match_entity_to_usersafety_user` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `match_entity_uid` VARCHAR(36) NOT NULL,
  `match_usersafety_user_uid` VARCHAR(36) NOT NULL,
  `configurations_sdesc_usertype` VARCHAR(100) NULL,
  `configurations_sdesc_entityrole` VARCHAR(100) NULL,
  PRIMARY KEY (`lid`, `uid`, `match_entity_uid`, `match_usersafety_user_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_merchantaccount`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_merchantaccount` ;

CREATE TABLE IF NOT EXISTS `entity_merchantaccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `isactive` VARCHAR(1) NOT NULL DEFAULT 'F',
  `islive` VARCHAR(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `entity_merchantprofile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `entity_merchantprofile` ;

CREATE TABLE IF NOT EXISTS `entity_merchantprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `webaddress` VARCHAR(100) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `crossappl_configurations_sdesc_region` VARCHAR(100) NULL,
  `crossappl_configurations_sdesc_country` VARCHAR(100) NULL DEFAULT NULL,
  `region` VARCHAR(45) NOT NULL,
  `foundeddate` DATE NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `name` VARCHAR(250) NOT NULL,
  `phonenumber` VARCHAR(20) NOT NULL,
  `configurations_sdesc_schooltype` VARCHAR(100) NULL,
  `latitude` VARCHAR(15) NOT NULL,
  `longitude` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_entity_to_merchant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `match_entity_to_merchant` ;

CREATE TABLE IF NOT EXISTS `match_entity_to_merchant` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `entity_merchantaccount_uid` VARCHAR(36) NOT NULL,
  `entity_merchantprofile_uid` VARCHAR(36) NOT NULL,
  `match_entity_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `match_entity_uid`, `entity_merchantaccount_uid`),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `entity_universityprofile_uid_UNIQUE` (`entity_merchantprofile_uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `personalization`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `personalization` ;

CREATE TABLE IF NOT EXISTS `personalization` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `match_usersafety_user_uid` VARCHAR(36) NOT NULL,
  `university_active_match_entity_uid` VARCHAR(36) NOT NULL,
  `active_group_uid` VARCHAR(36) NULL,
  `scholarship_active_entity_uid` VARCHAR(36) NULL,
  PRIMARY KEY (`lid`, `uid`, `match_usersafety_user_uid`, `university_active_match_entity_uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- SeeMeU Application-- **********************************************************************************************************************************************
-- Entity Type Configuration
-- USE `seemeuapplication`;
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'ENTITY_TYPE-UNIVERSITY',
'Container for Universities',
'University',
'ENTITY_TYPE'
),( UUID(), NOW(), NOW(),
'ENTITY_TYPE-HIGH_SCHOOL',
'Container for High Schools',
'High School',
'ENTITY_TYPE'
),( UUID(), NOW(), NOW(),
'ENTITY_TYPE-ADULT_LEARNER',
'Container for Adult Learners',
'Adult Learner',
'ENTITY_TYPE'
),( UUID(), NOW(), NOW(),
'ENTITY_TYPE-GED',
'Container for G.E.D. graduates',
'G.E.D.',
'ENTITY_TYPE'
),( UUID(), NOW(), NOW(),
'ENTITY_TYPE-HOME_SCHOOL',
'Container for Home Schools',
'Home School',
'ENTITY_TYPE'
),( UUID(), NOW(), NOW(),
'ENTITY_TYPE-SCHOLARSHIP',
'Container for Scholarships',
'Scholarship',
'ENTITY_TYPE'
),( UUID(), NOW(), NOW(),
'ENTITY_TYPE-MERCHANT',
'Container for Merchant',
'Merchant',
'ENTITY_TYPE'
);
-- **********************************************************************************************************************************************
-- Entity Acceptance Configuration
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'ENTITY_ACCEPT-AUTO_ACCEPT',
'User is automatically accepted to allow their group to attach',
'Accept Upon Request',
'ENTITY_ACCEPT'
),( UUID(), NOW(), NOW(),
'ENTITY_ACCEPT-OWNER_ACCEPT',
'The owner of the tentity accepts the request to attach group to the entity.',
'Owner Accept',
'ENTITY_ACCEPT'
),( UUID(), NOW(), NOW(),
'ENTITY_ACCEPT-INVITED_BY_OWNER_AUTO_ACCEPT',
'Owner invites someone to attach their group to this entity.  Once attachment is made the acceptance is automatic',
'Invited by Owner',
'ENTITY_ACCEPT'
);
-- **********************************************************************************************************************************************
-- Group Type Configuration
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_TYPE-SPORTS',
'Sports Enthusiats may use this Channel to folow your favorite team and share ',
'Sports and Teams',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-EVENTS',
'Have a Party or other Event planned?  Use the Events Channel to Sell and Track Tickets as well as share content amongst attendees and fans',
'Events and Parties',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-SOCIAL',
'Oh yeah..We have you covered if you just want to have a plae wher eyou and freinds can share about the moments occuring right now.',
'Social',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-GAMER',
'Gamer is designed to allow you stream and publish videos about games and gamers.  You have are allowed to broadcast and store two hours of video at a time.',
'Social and Friends',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-DISCUSSIONS',
'Lets say you want to discuss and collaborate on various topics of your choosing.  This Channel has ll the tools you need for that.',
'Discussions and Ideas',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-CLASSROOM',
'Have a class you need to track and stay informed with?  This channel will help with that.  Store Homework and Projects here.  Collabrate with feelow class mates.',
'Classroom and Teachings',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-FAMILY',
'Her we have a channel for you connect with those who are not part of your Univeristy.  Bring family close even though you are stepping out into your own path.',
'Family',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-VETTING_UNIVERSITY',
'Too see all things with regards to universities.  Use this channel see what life is across all universities and then start your search for where your journey will begin.',
'University Vetting',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-STUDY_GROUP',
'Have abunch of classmates who would benefit from off classroom studying and collaboration.  This Channel is for you.',
'Study',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-BOOSTER',
'You have achieved your goal and now want to help the University that helped you.  This Channel is designed with tools to help you give back.',
'Booster',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-ENTITY',
'this channel allows you to attach and share to Entities allowing a central audience to what you are sharing.',
'Entity',
'GROUP_TYPE'
);
-- **********************************************************************************************************************************************
-- Group Acceptance Configuration
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_ACCEPT-AUTO_ACCEPT',
'User is automatically accepted into group upon request.',
'Accept Upon Request',
'GROUP_ACCEPT'
),( UUID(), NOW(), NOW(),
'GROUP_ACCEPT-OWNER_ACCEPT',
'User is accepted only by owner approval upon request.',
'Owner Accept',
'GROUP_ACCEPT'
),( UUID(), NOW(), NOW(),
'GROUP_ACCEPT-INVITED_BY_OWNER_AUTO_ACCEPT',
'User is accepted only if invited by existing group owner.',
'Invited by Owner',
'GROUP_ACCEPT'
),( UUID(), NOW(), NOW(),
'GROUP_ACCEPT-INVITED_BY_MEMBER_AUTO_ACCEPT',
'Member is accepted only if invited by existing group Member.',
'Invited by Member of group',
'GROUP_ACCEPT'
);
-- **********************************************************************************************************************************************
-- Group Visibility Configuration
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY-PRIVATE',
'Only users within within the Group can see the Content of the group.',
'Group Private',
'GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY-PUBLIC',
'The COntent is viewable to everyone even those not logged in',
'Group Public',
'GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY-ENTITY_PRIVATE',
'The Content is only visible to those assigned to the same entity',
'Univerisity Private',
'GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY-ENTITY_PUBLIC',
'the content is viewable to only those assigned to the same Entity type.',
'Public',
'GROUP_VISIBILITY'
);
-- **********************************************************************************************************************************************
-- Group Request Request
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS-DENIED',
'The owner or review board of group has denied your request for access to this group.',
'Group Request Denied',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS-APPROVED',
'The owner or review board of the group has accepted your request to join the group',
'Group Request Approved',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS-IN_REVIEW',
'The owner or review board of the group is reviewing your request',
'Group Request is In Review',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS-RECIEVED',
'The owner or review board has received the group request',
'Group Request has been recieved',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS-SENT_TO_APPROVER',
'Request has been to Approver',
'Group Request has been recieved',
'GROUP_REQUEST_STATUS'
);
-- **********************************************************************************************************************************************
-- Object Types
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPE-GROUP_PROFILE',
'Object for Group profiles',
'Groups',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-USER_PROFILE',
'Object for User profles',
'Users',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-CATALOG_ITEM',
'object for all catalog items',
'Catalog Items',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-WALL_POST_HEADER',
'Object for all wall posts header',
'Wall Post',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-WALL_POST_TEXT',
'Object for all wall posts text',
'Wall Post',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-WALL_POST_COMMENT',
'Object for all wall posts comment',
'Wall Post',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-GROUP_REQEUST',
'Object Type representing Request for Group Access',
'Group Request',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-MICRBLOG_POST',
'Object Type reprenseting a micro blog post',
'Microblog Post',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-ALBUM_MIME',
'Object Type representing a photo in a photoalbum',
'Album Mime',
'OBJECT_TYPE'
);
-- **********************************************************************************************************************************************
-- User Roles Configuration
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_ROLE-OWNER',
'Has user rights as the Owner and creator of the group.  Is able to control group',
'Group Owner',
'GROUP_ROLE'
),( UUID(), NOW(), NOW(),
'GROUP_ROLE-USER',
'Has user rights to the Group in Question',
'Group User',
'GROUP_ROLE'
),( UUID(), NOW(), NOW(),
'ENTITY_ROLE-OWNER',
'Has rights to Entity ownership.  This role is responsible for content of university',
'Entity Owner',
'ENTITY_ROLE'
),( UUID(), NOW(), NOW(),
'ENTITY_ROLE-USER',
'Has user rights to the Entity in Question',
'Entity User',
'ENTITY_ROLE'
);
-- **********************************************************************************************************************************************
-- User Types Configuration
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'USER_TYPE-PROSPECT',
'Use this User Type if you are starting you higher education path.  If you are a High School student looking to plan your fututre or someone who is starting over and needs resources to help find the right path this type of account is for you.',
'Prospect',
'USER_TYPE'
),( UUID(), NOW(), NOW(),
'USER_TYPE-STUDENT',
'Students are currently enrolled to a Univeristy.  Students will be ale to take advantage of the tools provided to help with make your university experience enjoyable an dfullfilling',
'Student',
'USER_TYPE'
),( UUID(), NOW(), NOW(),
'USER_TYPE-ALUMNI',
'For those who have completed their Unvierity path and are wanting to exapnd that experience or continue it by engaging with students and helping those at your unviersity this type is for you.',
'Alumni',
'USER_TYPE'
),( UUID(), NOW(), NOW(),
'USER_TYPE-FACULTY',
'If you work as a teacher or some other Faculty role at a University register here to give you access to helping current students and guiding the path of prospective students',
'Faculty',
'USER_TYPE'
),( UUID(), NOW(), NOW(),
'USER_TYPE-SEEMEU',
'If you work as a teacher or some other Faculty role at a University register here to give you access to helping current students and guiding the path of prospective students',
'SeeMeU',
'USER_TYPE'
),( UUID(), NOW(), NOW(),
'USER_TYPE-MERCHANT',
'To take advantage of all of SeeMeUs Merchant services and getting connected with the customer USe this User Type',
'Merchant',
'USER_TYPE'
);
-- **********************************************************************************************************************************************
-- School Types
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'SCHOOL_TYPE-UNIVERSITY',
'University',
'University',
'SCHOOL_TYPE'
),( UUID(), NOW(), NOW(),
'SCHOOL_TYPE-HIGH_SCHOOL',
'High Scool levels 9-12',
'High School',
'SCHOOL_TYPE'
),( UUID(), NOW(), NOW(),
'SCHOOL_TYPE-ONLINE',
'Online School for Higher Education',
'Online',
'SCHOOL_TYPE'
),( UUID(), NOW(), NOW(),
'SCHOOL_TYPE-SEEMEU',
'Corporate Usiversity of See Me U',
'SeeMeU',
'SCHOOL_TYPE'
);
