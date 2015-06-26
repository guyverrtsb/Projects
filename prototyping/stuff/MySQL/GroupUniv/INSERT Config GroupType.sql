-- Use this SQL File to INSERT the configurations required for the site to run.
-- ****************************************************************************************************************
-- Group Type Configuration
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'CFG_GROUP_TYPE_SPORTS',
'Group type for to work with sports and show sports type data and functionaltiy',
'Sports and Teams',
'CFG_GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_TYPE_EVENTS',
'Events and Parties is designed to allow functionality based on what a Party planner and promtore would require',
'Events and Parties',
'CFG_GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_TYPE_SOCIAL',
'Social and Freinds allows the owner to port and share information amongst friends and others that fit within a social group. These groups could be light or close freinds',
'Social and Friends',
'CFG_GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_TYPE_DISCUSSIONS',
'Discussions and Ideas provides a group that allows all within the group to engage in discussion on an idea.  This group moderates itself.',
'Discussions and Ideas',
'CFG_GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_TYPE_CLASSROOM',
'Classroom and Teaching provides a group where a single leader can drive disucssion and guide ideas for the purpose of sharing knowledge.  The Owner is the teacher and drives the class.  This god for Tutors and Mentors as well as faculy for sharing classroom ',
'Classroom and Teachings',
'CFG_GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_TYPE_FAMILY',
'This is a special group.  It allows for a Univ Meet edu user to have non-edu user commnication with the student.',
'Family',
'CFG_GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_TYPE_UNIVERSITY',
'This special group defines groups created by the University.  Groups of this type drive an automatic enrollment by the student.  This is not for General Use.',
'University',
'CFG_GROUP_TYPE'
);
-- Group User Acceptance Configuration
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'CFG_GROUP_USERACCEPTANCE_AUTO_ACCEPT',
'User is automatically accepted into group upon request.',
'Accept Upon Request',
'CFG_GROUP_USERACCEPTANCE'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_USERACCEPTANCE_OWNER_ACCEPT',
'User is accepted only by owner approval upon request.',
'Owner Accept',
'CFG_GROUP_USERACCEPTANCE'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_USERACCEPTANCE_INVITED_BY_OWNER_AUTO_ACCEPT',
'User is accepted only if invited by existing group owner.',
'Invited by Owner',
'CFG_GROUP_USERACCEPTANCE'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_USERACCEPTANCE_INVITED_BY_USER_AUTO_ACCEPT',
'User is accepted only if invited by existing group user.',
'Invited by User',
'CFG_GROUP_USERACCEPTANCE'
);
-- Group Visibility Configuration
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'CFG_GROUP_VISIBILITY_GROUP_PRIVATE',
'Only users within within the Group can see the Content of the group.',
'Group Private',
'CFG_GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_VISIBILITY_GROUP_PUBLIC',
'The content is viewable to all users within the defined university.',
'Group Public',
'CFG_GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_VISIBILITY_UNIVERSITY_PRIVATE',
'Group Content is viewable to user within other Universities',
'Univerisity Private',
'CFG_GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'CFG_GROUP_VISIBILITY_UNIVERSITY_PUBLIC',
'The content within the group is viewable to all users of the site.',
'Public',
'CFG_GROUP_VISIBILITY'
);
-- Search Objects
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'CFG_SEARCH_OBJECTS_UNIVERSITY',
'Search Object for university profiles',
'Universities',
'CFG_SEARCH_OBJECTS'
),( UUID(), NOW(), NOW(),
'CFG_SEARCH_OBJECTS_GROUP',
'Search Object for Group profiles',
'Groups',
'CFG_SEARCH_OBJECTS'
),( UUID(), NOW(), NOW(),
'CFG_SEARCH_OBJECTS_USER',
'Search Object for User profles',
'Users',
'CFG_SEARCH_OBJECTS'
),( UUID(), NOW(), NOW(),
'CFG_SEARCH_OBJECTS__CATALOG_ITEM',
'Search object for all catalog items',
'Catalog Items',
'CFG_SEARCH_OBJECTS'
),( UUID(), NOW(), NOW(),
'CFG_SEARCH_OBJECTS_WALL_MESSAGE',
'Search Object for all wall messages',
'Wall Messages',
'CFG_SEARCH_OBJECTS'
);
-- User Roles Configuration
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'CFG_USER_ROLES_GROUP_OWNER',
'Has user rights as the Owner and creator of the group.  Is able to control group',
'Group Owner',
'CFG_USER_ROLES'
),( UUID(), NOW(), NOW(),
'CFG_USER_ROLES_UNIVERSITY_OWNER',
'Has rights to University ownership.  This role is responsible for content of university',
'University Owner',
'CFG_USER_ROLES'
),( UUID(), NOW(), NOW(),
'CFG_USER_ROLES_GROUP_USER',
'Has user rights to the Group in Question',
'Group User',
'CFG_USER_ROLES'
),( UUID(), NOW(), NOW(),
'CFG_USER_ROLES_UNIVERSITY_USER',
'Has user rights to the University in Question',
'University User',
'CFG_USER_ROLES'
),( UUID(), NOW(), NOW(),
'CFG_USER_ROLES_NON_UNIVERSITY_USER',
'User is not a college attendant or alumni.',
'Non-University User',
'CFG_USER_ROLES'
),( UUID(), NOW(), NOW(),
'CFG_USER_ROLES_SITE_ADMIN',
'Is an overall site admin.  Has Admin roles a responsibilties of site.',
'Site Admin',
'CFG_USER_ROLES'
),( UUID(), NOW(), NOW(),
'CFG_USER_ROLES_SITE_USER',
'Is a site user.',
'Site User',
'CFG_USER_ROLES'
);
select * from cfg_defaults;