SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema lclcrossapplication
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema lclguyverdesigns
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema lclunivlifeportal
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema lclusersafety
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema lclunivlifeportal_specific_tables
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `accounting_billto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accounting_billto` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `companyname` VARCHAR(100) NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `cfg_region_sdesc` VARCHAR(100) NOT NULL,
  `cfg_country_sdesc` VARCHAR(100) NOT NULL,
  `accountingcontactname` VARCHAR(100) NOT NULL,
  `accountingcontactemail` VARCHAR(45) NOT NULL,
  `accountingcontactnumber` VARCHAR(45) NOT NULL,
  `invoicenumberprefix` VARCHAR(7) NOT NULL,
  `timesheetnumberprefix` VARCHAR(7) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `invoicenumberprefix_UNIQUE` (`invoicenumberprefix` ASC),
  UNIQUE INDEX `timesheetnumberprefix_UNIQUE` (`timesheetnumberprefix` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `accounting_client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accounting_client` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `companyname` VARCHAR(100) NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `cfg_region_sdesc` VARCHAR(100) NOT NULL,
  `cfg_country_sdesc` VARCHAR(100) NOT NULL,
  `contactname` VARCHAR(100) NOT NULL,
  `contactemail` VARCHAR(45) NOT NULL,
  `contactnumber` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `accounting_project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accounting_project` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `cfg_region_sdesc` VARCHAR(100) NOT NULL,
  `cfg_country_sdesc` VARCHAR(100) NOT NULL,
  `contactname` VARCHAR(100) NOT NULL,
  `contactemail` VARCHAR(45) NOT NULL,
  `contactnumber` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `accounting_project_profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accounting_project_profile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `accounting_project_uid` VARCHAR(36) NOT NULL,
  `cfg_payoutcycle_sdesc` VARCHAR(100) NOT NULL,
  `cfg_ratetype_sdesc` VARCHAR(100) NOT NULL,
  `rate_hourly_remote` VARCHAR(3) NOT NULL,
  `rate_hourly_onsite` VARCHAR(3) NOT NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `accounting_project_uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `accounting_project_uid_UNIQUE` (`accounting_project_uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `accounting_timesheet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accounting_timesheet` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `accounting_project_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `accounting_project_uid_UNIQUE` (`accounting_project_uid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `accounting_timesheet_dates`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accounting_timesheet_dates` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `accounting_timesheet_uid` VARCHAR(36) NOT NULL,
  `week_number` INT(2) NOT NULL,
  `timesheet_number` VARCHAR(20) NOT NULL,
  `cfg_workweekstatus_sdesc` VARCHAR(100) NOT NULL,
  `d0_work_date` DATETIME NOT NULL,
  `d0_work_day_idx` INT(1) NOT NULL,
  `d0_work_hours` INT(2) NOT NULL,
  `d0_cfg_workdaystatus_sdesc` VARCHAR(100) NOT NULL,
  `d0_ldesc` VARCHAR(250) NULL DEFAULT NULL,
  `d0_cfg_ratetype_sdesc` VARCHAR(100) NOT NULL,
  `d1_work_date` DATETIME NOT NULL,
  `d1_work_day_idx` INT(1) NOT NULL,
  `d1_work_hours` INT(2) NOT NULL,
  `d1_cfg_workdaystatus_sdesc` VARCHAR(100) NOT NULL,
  `d1_ldesc` VARCHAR(250) NULL DEFAULT NULL,
  `d1_cfg_ratetype_sdesc` VARCHAR(100) NOT NULL,
  `d2_work_date` DATETIME NOT NULL,
  `d2_work_day_idx` INT(1) NOT NULL,
  `d2_work_hours` INT(2) NOT NULL,
  `d2_cfg_workdaystatus_sdesc` VARCHAR(100) NOT NULL,
  `d2_ldesc` VARCHAR(250) NULL DEFAULT NULL,
  `d2_cfg_ratetype_sdesc` VARCHAR(100) NOT NULL,
  `d3_work_date` DATETIME NOT NULL,
  `d3_work_day_idx` INT(1) NOT NULL,
  `d3_work_hours` INT(2) NOT NULL,
  `d3_cfg_workdaystatus_sdesc` VARCHAR(100) NOT NULL,
  `d3_ldesc` VARCHAR(250) NULL DEFAULT NULL,
  `d3_cfg_ratetype_sdesc` VARCHAR(100) NOT NULL,
  `d4_work_date` DATETIME NOT NULL,
  `d4_work_day_idx` INT(1) NOT NULL,
  `d4_work_hours` INT(2) NOT NULL,
  `d4_cfg_workdaystatus_sdesc` VARCHAR(100) NOT NULL,
  `d4_ldesc` VARCHAR(250) NULL DEFAULT NULL,
  `d4_cfg_ratetype_sdesc` VARCHAR(100) NOT NULL,
  `d5_work_date` DATETIME NOT NULL,
  `d5_work_day_idx` INT(1) NOT NULL,
  `d5_work_hours` INT(2) NOT NULL,
  `d5_cfg_workdaystatus_sdesc` VARCHAR(100) NOT NULL,
  `d5_ldesc` VARCHAR(250) NULL DEFAULT NULL,
  `d5_cfg_ratetype_sdesc` VARCHAR(100) NOT NULL,
  `d6_work_date` DATETIME NOT NULL,
  `d6_work_day_idx` INT(1) NOT NULL,
  `d6_work_hours` INT(2) NOT NULL,
  `d6_cfg_workdaystatus_sdesc` VARCHAR(100) NOT NULL,
  `d6_ldesc` VARCHAR(250) NULL DEFAULT NULL,
  `d6_cfg_ratetype_sdesc` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `accounting_timesheet_uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `activity_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `activity_log` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `fdesc` VARCHAR(45) NOT NULL,
  `notes` TEXT NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cfg_defaults`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cfg_defaults` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `ldesc` VARCHAR(250) NOT NULL,
  `label` VARCHAR(50) NOT NULL,
  `group_key` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `documents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `documents` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `content` TEXT NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `documents_headlines`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `documents_headlines` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `headline0` VARCHAR(100) NOT NULL,
  `headline1` VARCHAR(100) NOT NULL,
  `headline2` VARCHAR(100) NOT NULL,
  `headline3` VARCHAR(100) NOT NULL,
  `headline4` VARCHAR(100) NOT NULL,
  `title` VARCHAR(75) NOT NULL,
  `documents_types_uid` VARCHAR(36) NOT NULL,
  `object_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `documents_search`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `documents_search` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `content` TEXT NOT NULL,
  `object_uid` VARCHAR(36) NOT NULL,
  `documents_types_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  FULLTEXT INDEX `content` (`content` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `documents_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `documents_types` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `sdesc` VARCHAR(100) NOT NULL,
  `display` VARCHAR(250) NOT NULL,
  `document_template` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `sdesc`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `sdesc_UNIQUE` (`sdesc` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `geolocation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `geolocation` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `latitude` VARCHAR(36) NOT NULL,
  `longitude` VARCHAR(36) NOT NULL,
  `account_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_accounting_project_to_billto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_accounting_project_to_billto` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `accounting_project_uid` VARCHAR(36) NOT NULL,
  `accounting_billto_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_accounting_project_to_client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_accounting_project_to_client` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `accounting_project_uid` VARCHAR(36) NOT NULL,
  `accounting_client_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_usersafety_site_to_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_usersafety_site_to_role` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `usersafety_role_uid` VARCHAR(36) NOT NULL,
  `usersafety_site_uid` VARCHAR(36) NOT NULL,
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


-- -----------------------------------------------------
-- Table `page_resume`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `page_resume` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `active` VARCHAR(1) NOT NULL,
  `changepassword` VARCHAR(1) NOT NULL,
  `numberoflogintries` INT(4) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


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
  `isactive` VARCHAR(1) NOT NULL,
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
-- Table `match_placement_requirement_to_search_word`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_placement_requirement_to_search_word` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `placement_requirement_uid` VARCHAR(36) NOT NULL,
  `search_word` TEXT NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `placement_requirement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `placement_requirement` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `requirement_number` VARCHAR(7) NOT NULL,
  `sdesc` VARCHAR(255) NOT NULL,
  `title` VARCHAR(999) NOT NULL,
  `role_desc` VARCHAR(999) NOT NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `requested_days` INT(4) NOT NULL,
  `days_per_week` INT(1) NOT NULL,
  `is_remote_possible` VARCHAR(7) NOT NULL,
  `cfg_country_sdesc` VARCHAR(100) NOT NULL,
  `cfg_region_sdesc` VARCHAR(100) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `scope_of_tasks` TEXT NOT NULL,
  `comments` TEXT NULL,
  `company_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `requirement_number`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  UNIQUE INDEX `requirement_number_UNIQUE` (`requirement_number` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_placement_requirement_to_resource_to_cfg_placement_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_placement_requirement_to_resource_to_cfg_placement_status` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `placement_requirement_uid` VARCHAR(36) NOT NULL,
  `placement_resource_account_uid` VARCHAR(36) NOT NULL,
  `cfg_placement_status_sdesc` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `match_placement_resource_account_to_profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `match_placement_resource_account_to_profile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `placement_resource_account_uid` VARCHAR(36) NOT NULL,
  `placement_resource_profile_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `placement_resource_account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `placement_resource_account` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `profile_id` VARCHAR(45) NULL,
  `profile_url` VARCHAR(999) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `placement_resource_profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `placement_resource_profile` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`lid`, `uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `search_content`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `search_content` (
  `lid` INT(11) NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(36) NOT NULL,
  `createddt` DATETIME NOT NULL,
  `changeddt` DATETIME NOT NULL,
  `searchable_content` TEXT NOT NULL,
  `cfg_search_object_sdesc` VARCHAR(36) NOT NULL,
  `owner_table_name` VARCHAR(99) NOT NULL,
  `owner_table_record_uid` VARCHAR(36) NOT NULL,
  PRIMARY KEY (`lid`, `uid`, `cfg_search_object_sdesc`, `owner_table_name`, `owner_table_record_uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  UNIQUE INDEX `lid_UNIQUE` (`lid` ASC),
  FULLTEXT INDEX `search_content` (`searchable_content` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
