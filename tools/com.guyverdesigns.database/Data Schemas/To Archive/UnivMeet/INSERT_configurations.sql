-- Use this SQL File to INSERT the configurations required for the site to run.
-- ****************************************************************************************************************
-- Group Type Configuration
INSERT INTO `univmeetdb`.`cfg_group_type` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'GT_SPORTS',
'Group type for to work with sports and show sports type data and functionaltiy',
'Sports and Teams'
);
INSERT INTO `univmeetdb`.`cfg_group_type` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'GT_EVENTS',
'Events and Parties is designed to allow functionality based on what a Party planner and promtore would require',
'Events and Parties'
);
INSERT INTO `univmeetdb`.`cfg_group_type` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'GT_SOCIAL',
'Social and Freinds allows the owner to port and share information amongst friends and others that fit within a social group. These groups could be light or close freinds',
'Social and Friends'
);
INSERT INTO `univmeetdb`.`cfg_group_type` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'GT_DISCUSSIONS',
'Discussions and Ideas provides a group that allows all within the group to engage in discussion on an idea.  This group moderates itself.',
'Discussions and Ideas'
);
INSERT INTO `univmeetdb`.`cfg_group_type` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'GT_CLASSROOM',
'Classroom and Teaching provides a group where a single leader can drive disucssion and guide ideas for the purpose of sharing knowledge.  The Owner is the teacher and drives the class.  This god for Tutors and Mentors as well as faculy for sharing classroom ',
'Classroom and Teachings'
);
INSERT INTO `univmeetdb`.`cfg_group_type` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'GT_FAMILY',
'This is a special group.  It allows for a Univ Meet edu user to have non-edu user commnication with the student.',
'Family'
);
INSERT INTO `univmeetdb`.`cfg_group_type` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'GT_UNIVERSITY',
'This special group defines groups created by the University.  Groups of this type drive an automatic enrollment by the student.  This is not for General Use.',
'Family'
);
select * from cfg_group_type;

-- ****************************************************************************************************************
-- User Roles Configuration
INSERT INTO `univmeetdb`.`cfg_user_roles` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES( UUID(), NOW(), NOW(),
'GROUP_OWNER',
'Has created the Group in Question'
);
INSERT INTO `univmeetdb`.`cfg_user_roles` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES( UUID(), NOW(), NOW(),
'UNIVERSITY_OWNER',
'Has rights to the Univeristy in Question'
);
INSERT INTO `univmeetdb`.`cfg_user_roles` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES( UUID(), NOW(), NOW(),
'GROUP_USER',
'Has user rights to the Group in Question'
);
INSERT INTO `univmeetdb`.`cfg_user_roles` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES( UUID(), NOW(), NOW(),
'UNIVERSITY_USER',
'Has user rights to the University in Question'
);
INSERT INTO `univmeetdb`.`cfg_user_roles` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES( UUID(), NOW(), NOW(),
'UNIV_ALL',
'Has user rights to the University in Question'
);
INSERT INTO `univmeetdb`.`cfg_user_roles` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES( UUID(), NOW(), NOW(),
'GROUP_ALL',
'Has user rights to the University in Question'
);
select * from cfg_user_roles;

-- ****************************************************************************************************************
-- Group User Acceptance Configuration
INSERT INTO `univmeetdb`.`cfg_group_useracceptance`
(`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'AUTO_ACCEPT',
'User is automatically accepted into group upon request.',
'Accept Upon Requestt'
);
INSERT INTO `univmeetdb`.`cfg_group_useracceptance`
(`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'OWNER_ACCEPT',
'User is accepted only by owner approval upon request.',
'Owner Accept'
);
INSERT INTO `univmeetdb`.`cfg_group_useracceptance`
(`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'INVITED_BY_OWNER_AUTO_ACCEPT',
'User is accepted only if invited by existing group owner.',
'Invited by Owner'
);
INSERT INTO `univmeetdb`.`cfg_group_useracceptance`
(`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES( UUID(), NOW(), NOW(),
'INVITED_BY_USER_AUTO_ACCEPT',
'User is accepted only if invited by existing group user.',
'Invited by User'
);
select * from cfg_group_useracceptance;

-- ****************************************************************************************************************
-- Group Visibility Configuration
INSERT INTO `univmeetdb`.`cfg_group_visibility` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES ( UUID(), NOW(), NOW(),
'UNIV_PRIVATE',
'Private within the University.  Only users within the Group can see content',
'Private'
);
INSERT INTO `univmeetdb`.`cfg_group_visibility` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES ( UUID(), NOW(), NOW(),
'UNIV_PUBLIC',
'Public within the University.  Only users within the University can see content',
'University'
);
INSERT INTO `univmeetdb`.`cfg_group_visibility` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES ( UUID(), NOW(), NOW(),
'EXT_PRIVATE',
'Private external of the University.  Everyone with an account can see the content',
'External'
);
INSERT INTO `univmeetdb`.`cfg_group_visibility` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES ( UUID(), NOW(), NOW(),
'EXT_PUBLIC',
'Public external of the University.  Everyone may see content even those without an account.  This means public on website',
'Public'
);
select * from cfg_group_visibility;

-- ****************************************************************************************************************
-- Search Objects
INSERT INTO `univmeetdb`.`cfg_search_objects` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES ( UUID(), NOW(), NOW(),
'UNIVERSITY',
'University Objects'
);
INSERT INTO `univmeetdb`.`cfg_search_objects` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP',
'Group Objects'
);
INSERT INTO `univmeetdb`.`cfg_search_objects` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES ( UUID(), NOW(), NOW(),
'USER',
'User Objects'
);
INSERT INTO `univmeetdb`.`cfg_search_objects` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES ( UUID(), NOW(), NOW(),
'CATALOG_ITEM',
'Catalog Item Objects'
);
select * from cfg_search_objects;




