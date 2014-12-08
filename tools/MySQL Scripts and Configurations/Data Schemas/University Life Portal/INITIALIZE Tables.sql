SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `cfg_defaults`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfg_defaults` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `sdesc` VARCHAR(45) NOT NULL ,
  `ldesc` VARCHAR(250) NOT NULL ,
  `label` VARCHAR(50) NOT NULL ,
  `group_key` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`, `sdesc`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `activity_log`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `core_activity_log` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `fdesc` VARCHAR(45) NOT NULL ,
  `notes` TEXT NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_university_account_to_university_profile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_university_account_to_university_profile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `university_account_uid` VARCHAR(36) NOT NULL ,
  `university_profile_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_university_account_to_user_account_to_cfg_user_roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_university_account_to_user_account_to_cfg_user_roles` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `university_account_uid` VARCHAR(36) NOT NULL ,
  `user_account_uid` VARCHAR(36) NOT NULL ,
  `cfg_user_roles_sdesc` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_user_account_to_cfg_user_roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_user_account_to_cfg_user_site_roles` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `user_account_uid` VARCHAR(36) NOT NULL ,
  `cfg_user_site_roles_sdesc` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_user_account_to_user_profile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `match_user_account_to_user_profile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `user_account_uid` VARCHAR(36) NOT NULL ,
  `user_profile_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `university_account`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `university_account` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `sdesc` VARCHAR(45) NOT NULL ,
  `emailkey` VARCHAR(45) NOT NULL ,
  `tablekey` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`lid`, `emailkey`, `sdesc`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `searchkey_UNIQUE` (`sdesc` ASC) ,
  UNIQUE INDEX `univemailkey_UNIQUE` (`emailkey` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ,
  UNIQUE INDEX `tablekey_UNIQUE` (`tablekey` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `university_profile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `university_profile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `city` VARCHAR(45) NOT NULL ,
  `cfg_region_sdesc` VARCHAR(45) NOT NULL ,
  `cfg_country_sdesc` VARCHAR(45) NOT NULL ,
  `foundeddate` DATE NULL DEFAULT NULL ,
  `content` TEXT NOT NULL ,
  `name` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user_messages` ( 
  `lid` INT(11) NOT NULL AUTO_INCREMENT , 
  `uid` VARCHAR(36) NOT NULL , 
  `createddt` DATETIME NOT NULL , 
  `changeddt` DATETIME NOT NULL , 
  `cfg_message_type_sdesc` VARCHAR(45) NOT NULL , 
  `subject` TEXT NOT NULL , 
  `content` TEXT NOT NULL , 
  `to_user_account_uid` VARCHAR(36) NOT NULL , 
  `from_user_account_uid` VARCHAR(36) NOT NULL , 
  `isread` VARCHAR(1) NOT NULL , 
  `reply_message_uid` VARCHAR(36), 
  PRIMARY KEY (`lid`, `uid`) , 
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , 
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) 
ENGINE = MyISAM 
AUTO_INCREMENT = 1 
DEFAULT CHARACTER SET = utf8; 
-- -----------------------------------------------------
-- Table `notifications`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user_notifications` ( 
  `lid` INT(11) NOT NULL AUTO_INCREMENT , 
  `uid` VARCHAR(36) NOT NULL , 
  `createddt` DATETIME NOT NULL , 
  `changeddt` DATETIME NOT NULL , 
  `cfg_message_type_sdesc` VARCHAR(45) NOT NULL , 
  `message_uid` VARCHAR(36) NOT NULL , 
  PRIMARY KEY (`lid`, `uid`) , 
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) , 
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) ) 
ENGINE = MyISAM 
AUTO_INCREMENT = 1 
DEFAULT CHARACTER SET = utf8; 
-- -----------------------------------------------------
-- Table `geolocation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `geolocation` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(36) NOT NULL ,
  `createddt` DATETIME NOT NULL ,
  `changeddt` DATETIME NOT NULL ,
  `latitude` VARCHAR(36) NOT NULL ,
  `longitude` VARCHAR(36) NOT NULL ,
  `account_uid` VARCHAR(36) NOT NULL ,
  PRIMARY KEY (`lid`, `uid`) ,
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC) ,
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- ********************************************************************************************************************************************
-- ********************************************************************************************************************************************
-- ********************************************************************************************************************************************
-- UNIVERSITY TABLES
-- ********************************************************************************************************************************************
-- ********************************************************************************************************************************************
-- ********************************************************************************************************************************************

-- ********************************************************************************************************************************************
-- ********************************************************************************************************************************************
-- ********************************************************************************************************************************************
-- USERSAEFTY TABLES
-- ********************************************************************************************************************************************
-- ********************************************************************************************************************************************
-- ********************************************************************************************************************************************
-- -----------------------------------------------------
-- Table `usersafety_login_tracking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usersafety_login_tracking` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `outcomekey` VARCHAR(45) NOT NULL,
  `message` VARCHAR(45) NOT NULL,
  `ipaddress` VARCHAR(45) NOT NULL,
  `nickname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `usersafety_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usersafety_role` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NULL DEFAULT NULL,
  `priority` INT(2) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `srchkey_UNIQUE` (`sdesc` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `usersafety_site`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usersafety_site` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `package_UNIQUE` (`sdesc` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `usersafety_site_alias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usersafety_site_alias` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `fullyqualifieddomain_UNIQUE` (`sdesc` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `usersafety_task_control_links`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usersafety_task_control_links` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `task_key` VARCHAR(45) NOT NULL,
  `uid1` VARCHAR(36) NOT NULL,
  `uid2` VARCHAR(36) NOT NULL,
  `uid3` VARCHAR(36) NOT NULL,
  `record_uid` VARCHAR(36) NOT NULL,
  `isactive` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `usersafety_useraccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usersafety_useraccount` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `nickname` VARCHAR(45) NOT NULL,
  `usertablekey` VARCHAR(100) NOT NULL,
  `isactive` VARCHAR(1) NOT NULL,	-- User Account is deactivated.  Activation can only occur by Site Administrators
  `islocked` VARCHAR(1) NOT NULL,	-- User Account is locked.  User must Unock using Unlock Tool
  `changepassword` VARCHAR(1) NOT NULL,
  `numberoflogintries` INT(4) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `email`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `usersafety_userprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usersafety_userprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `cfg_region_sdesc` VARCHAR(100) NOT NULL,
  `cfg_country_sdesc` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `match_usersafety_site_to_site_alias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_usersafety_site_to_site_alias` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `usersafety_site_uid` VARCHAR(36) NOT NULL,
  `usersafety_site_alias_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `match_usersafety_useraccount_to_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_usersafety_useraccount_to_role` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `usersafety_useraccount_uid` VARCHAR(36) NOT NULL,
  `usersafety_role_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `usersafety_useraccount_uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `match_usersafety_useraccount_to_site`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_usersafety_useraccount_to_site` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `usersafety_useraccount_uid` VARCHAR(36) NOT NULL,
  `usersafety_site_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;
-- -----------------------------------------------------
-- Table `match_usersafety_useraccount_to_userprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_usersafety_useraccount_to_userprofile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `usersafety_useraccount_uid` VARCHAR(36) NOT NULL,
  `usersafety_userprofile_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;




-- Use this SQL File to INSERT the configurations required for the site to run.
-- ****************************************************************************************************************
-- ************************* COUNTRIES
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'COUNTRY_US',
'United States of America',
'United States of America',
'COUNTRIES'
),
( UUID(), NOW(), NOW(),
'COUNTRY_AU',
'Australia',
'Australia',
'COUNTRIES'
),
( UUID(), NOW(), NOW(),
'COUNTRY_CA',
'Canada',
'Canada',
'COUNTRIES'
),
( UUID(), NOW(), NOW(),
'COUNTRY_EN',
'England',
'England',
'COUNTRIES'
),
( UUID(), NOW(), NOW(),
'COUNTRY_ES',
'Spain',
'Spain',
'COUNTRIES'
);
-- **********************************************************************************************************************************************
-- ************************* US REGIONS
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)VALUES
( UUID(), NOW(), NOW(),
'REGION_AZ',
'Arizona',
'Arizona',
'COUNTRY_US'
),
( UUID(), NOW(), NOW(),
'REGION_NC',
'North Carolina',
'North Carolina',
'COUNTRY_US'
),
( UUID(), NOW(), NOW(),
'REGION_SC',
'South Carolina',
'South Carolina',
'COUNTRY_US'
);
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)VALUES
( UUID(), NOW(), NOW(),
'REGION_OK',
'Oklahoma',
'Oklahoma',
'COUNTRY_US'
);
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)VALUES
( UUID(), NOW(), NOW(),
'REGION_MO',
'Missouri',
'Missouri',
'COUNTRY_US'
);
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)VALUES
( UUID(), NOW(), NOW(),
'REGION_PA',
'Pennsylvania',
'Pennsylvania',
'COUNTRY_US'
);
-- **********************************************************************************************************************************************
-- Group Type Configuration
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_TYPE_SPORTS',
'Group type for to work with sports and show sports type data and functionaltiy',
'Sports and Teams',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_EVENTS',
'Events and Parties is designed to allow functionality based on what a Party planner and promtore would require',
'Events and Parties',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_SOCIAL',
'Social and Freinds allows the owner to port and share information amongst friends and others that fit within a social group. These groups could be light or close freinds',
'Social and Friends',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_DISCUSSIONS',
'Discussions and Ideas provides a group that allows all within the group to engage in discussion on an idea.  This group moderates itself.',
'Discussions and Ideas',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_CLASSROOM',
'Classroom and Teaching provides a group where a single leader can drive disucssion and guide ideas for the purpose of sharing knowledge. This is good for Tutors and Mentors as well as faculty for sharing classroom ',
'Classroom and Teachings',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_FAMILY',
'This is a special group.  It allows for a Univ Meet edu user to have non-edu user commnication with the student.',
'Family',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_UNIVERSITY',
'This special group defines groups created by the University.  Groups of this type drive an automatic enrollment by the student.  This is not for General Use.',
'University',
'GROUP_TYPE'
);
-- **********************************************************************************************************************************************
-- Group User Acceptance Configuration
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_ACCEPT_AUTO_ACCEPT',
'User is automatically accepted into group upon request.',
'Accept Upon Request',
'GROUP_ACCEPT'
),( UUID(), NOW(), NOW(),
'GROUP_ACCEPT_OWNER_ACCEPT',
'User is accepted only by owner approval upon request.',
'Owner Accept',
'GROUP_ACCEPT'
),( UUID(), NOW(), NOW(),
'GROUP_ACCEPT_INVITED_BY_OWNER_AUTO_ACCEPT',
'User is accepted only if invited by existing group owner.',
'Invited by Owner',
'GROUP_ACCEPT'
),( UUID(), NOW(), NOW(),
'GROUP_ACCEPT_INVITED_BY_MEMBER_AUTO_ACCEPT',
'Member is accepted only if invited by existing group Member.',
'Invited by Member of group',
'GROUP_ACCEPT'
);
-- **********************************************************************************************************************************************
-- Group Visibility Configuration
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY_GROUP_PRIVATE',
'Only users within within the Group can see the Content of the group.',
'Group Private',
'GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY_GROUP_PUBLIC',
'The content is viewable to all users within the defined university.',
'Group Public',
'GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY_UNIVERSITY_PRIVATE',
'Group Content is viewable to user within other Universities',
'Univerisity Private',
'GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY_UNIVERSITY_PUBLIC',
'The content within the group is viewable to all users of the site.',
'Public',
'GROUP_VISIBILITY'
);
-- **********************************************************************************************************************************************
-- Group Request Request
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)VALUES
( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS_DENIED',
'The owner or review board of group has denied your request for access to this group.',
'Group Request Denied',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS_APPROVED',
'The owner or review board of the group has accepted your request to join the group',
'Group Request Approved',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS_INREVIEW',
'The owner or review board of the group is reviewing your request',
'Group Request is In Review',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS_RECIEVED',
'The owner or review board has received the group request',
'Group Request has been recieved',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUP_REQUEST_STATUS_SENTTOAPPROVER',
'Request has been to Approver',
'Group Request has been recieved',
'GROUP_REQUEST_STATUS'
);
-- **********************************************************************************************************************************************
-- Search Objects
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_UNIVERSITY',
'Search Object for university profiles',
'Universities',
'SEARCH_OBJECT'
),( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_GROUP',
'Search Object for Group profiles',
'Groups',
'SEARCH_OBJECT'
),( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_USER',
'Search Object for User profles',
'Users',
'SEARCH_OBJECT'
),( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_CATALOG_ITEM',
'Search object for all catalog items',
'Catalog Items',
'SEARCH_OBJECT'
),( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_WALL_MESSAGE',
'Search Object for all wall messages',
'Wall Messages',
'SEARCH_OBJECT'
);
-- **********************************************************************************************************************************************
-- User Roles Configuration
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)VALUES 
( UUID(), NOW(), NOW(),
'USER_ROLE_GROUP_OWNER',
'Has user rights as the Owner and creator of the group.  Is able to control group',
'Group Owner',
'USER_ROLE'
),( UUID(), NOW(), NOW(),
'USER_ROLE_UNIVERSITY_OWNER',
'Has rights to University ownership.  This role is responsible for content of university',
'University Owner',
'USER_ROLE'
),( UUID(), NOW(), NOW(),
'USER_ROLE_GROUP_USER',
'Has user rights to the Group in Question',
'Group User',
'USER_ROLE'
),( UUID(), NOW(), NOW(),
'USER_ROLE_UNIVERSITY_USER',
'Has user rights to the University in Question',
'University User',
'USER_ROLE'
),( UUID(), NOW(), NOW(),
'USER_ROLE_NON_UNIVERSITY_USER',
'User is not a college attendant or alumni.',
'Non-University User',
'USER_ROLE'
)
;
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)VALUES 
( UUID(), NOW(), NOW(),
'USER_ROLE_SITE_GOD',
'User has full access to everything.  All admin Tasks and any job.',
'Site God',
'USER_SITE_ACCESS'
),( UUID(), NOW(), NOW(),
'USER_ROLE_SITE_ADMIN',
'Is an overall site admin.  Has Admin roles a responsibilties of site.',
'Site Admin',
'USER_SITE_ACCESS'
),( UUID(), NOW(), NOW(),
'USER_ROLE_SITE_USER',
'Is a site user.',
'Site User',
'USER_SITE_ACCESS'
);
-- **********************************************************************************************************************************************
-- User Roles Configuration
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'MESSAGE_TYPE_GROUP_JOIN_REQUEST',
'This message is associated to a Request to Joining a Group',
'Join Request',
'MESSAGE_TYPE'
),( UUID(), NOW(), NOW(),
'MESSAGE_TYPE_MESSAGE',
'Message has to a user.',
'Message',
'MESSAGE_TYPE'
),( UUID(), NOW(), NOW(),
'MESSAGE_TYPE_CHAT',
'Chat Messages',
'Chat',
'MESSAGE_TYPE'
);


-- **********************************************************************************************************************************************
INSERT INTO `user_account` (`uid`,`createddt`,`changeddt`,`email`,`password`,`active`,`usertablekey`, `nickname`) VALUES
( UUID(), NOW(), NOW(),
'admin@groupuniv.com',
'1234567890',
'T',
'GROUP_YOU_ADMIN',
'GROUP_YOU_ADMIN'
)
;
INSERT INTO `user_profile` (`uid`,`createddt`,`changeddt`,`fname`,`lname`,`city`,`cfg_region_sdesc`,`cfg_country_sdesc`) VALUES
( UUID(), NOW(), NOW(),
'Javier',
'Collegiate',
'Tulsa',
'REGION_OK',
'COUNTRY_US'
)
;
INSERT INTO `match_user_account_to_user_profile` (`uid`,`createddt`,`changeddt`,`user_account_uid`,`user_profile_uid`) VALUES
( UUID(), NOW(), NOW(),
(select uid from `user_account` WHERE `lid`='1'),
(select uid from `user_profile` WHERE `lid`='1')
)
;
INSERT INTO `match_user_account_to_cfg_user_site_roles` (`uid`,`createddt`,`changeddt`,`user_account_uid`,`cfg_user_site_roles_sdesc`) VALUES
( UUID(), NOW(), NOW(),
(select uid from `user_account` WHERE `email`='admin@groupuniv.com'),
'USER_ROLE_SITE_GOD'
)
;
select * from cfg_defaults;
