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
'Oaklahoma',
'Oaklahoma',
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
select * from cfg_defaults;