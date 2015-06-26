-- ************** User
select * from user_account;
select * from user_profile;

-- ************** University
select * from university_account;
select * from university_profile;

-- ************** Groups
select * from group_account;
select * from group_profile;

-- ************** Configurations
SELECT * FROM univmeetdb.cfg_group_type;
SELECT * FROM univmeetdb.cfg_group_useracceptance;
SELECT * FROM univmeetdb.cfg_group_visibility;
SELECT * FROM univmeetdb.cfg_user_roles;
SELECT * FROM univmeetdb.cfg_defaults;
SELECT * FROM univmeetdb.cfg_search_objects;

-- ************** MIMES
select * from mimes;
select * from mimes_image_originals;
select * from mimes_image_thumbnail_100x100;
select * from mimes_image_wall_message;

-- WALL MESSAGES
select * from wall_message;
select * from wall_message_comment;

-- SEARCH OBJECTS
select * from search_content;
select * from search_keywords;