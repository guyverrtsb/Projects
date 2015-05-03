-- SELECT * FROM seemeuapplication.configurations;
-- DELETE FROM seemeuapplication.configurations WHERE  lid <> 0;

-- **********************************************************************************************************************************************
-- Group Type Configuration
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUPTYPE_SPORTS',
'Group type for to work with sports and show sports type data and functionaltiy',
'Sports and Teams',
'GROUPTYPE'
),( UUID(), NOW(), NOW(),
'GROUPTYPE_EVENTS',
'Events and Parties is designed to allow functionality based on what a Party planner and promtore would require',
'Events and Parties',
'GROUPTYPE'
),( UUID(), NOW(), NOW(),
'GROUPTYPE_SOCIAL',
'Social and Freinds allows the owner to port and share information amongst friends and others that fit within a social group. These groups could be light or close freinds',
'Social and Friends',
'GROUPTYPE'
),( UUID(), NOW(), NOW(),
'GROUPTYPE_DISCUSSIONS',
'Discussions and Ideas provides a group that allows all within the group to engage in discussion on an idea.  This group moderates itself.',
'Discussions and Ideas',
'GROUPTYPE'
),( UUID(), NOW(), NOW(),
'GROUPTYPE_CLASSROOM',
'Classroom and Teaching provides a group where a single leader can drive disucssion and guide ideas for the purpose of sharing knowledge. This is good for Tutors and Mentors as well as faculty for sharing classroom ',
'Classroom and Teachings',
'GROUPTYPE'
),( UUID(), NOW(), NOW(),
'GROUPTYPE_FAMILY',
'This is a special group.  It allows for a Univ Meet edu user to have non-edu user commnication with the student.',
'Family',
'GROUPTYPE'
),( UUID(), NOW(), NOW(),
'GROUPTYPE_UNIVERSITY',
'This special group defines groups created by the University.  Groups of this type drive an automatic enrollment by the student.  This is not for General Use.',
'University',
'GROUPTYPE'
),( UUID(), NOW(), NOW(),
'GROUPTYPE_UNIVERSITYVETTING',
'This group is for users to be able to see public and univ public posts and ask questions',
'University Vetting',
'GROUPTYPE'
),( UUID(), NOW(), NOW(),
'GROUPTYPE_STUDYGROUP',
'is for scheduling study sessions',
'Study',
'GROUPTYPE'
),( UUID(), NOW(), NOW(),
'GROUPTYPE_BOOSTER',
'this group is for boosters',
'University Vetting',
'GROUPTYPE'
);
-- **********************************************************************************************************************************************
-- Group User Acceptance Configuration
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUPACCEPT_AUTO_ACCEPT',
'User is automatically accepted into group upon request.',
'Accept Upon Request',
'GROUPACCEPT'
),( UUID(), NOW(), NOW(),
'GROUPACCEPT_OWNER_ACCEPT',
'User is accepted only by owner approval upon request.',
'Owner Accept',
'GROUPACCEPT'
),( UUID(), NOW(), NOW(),
'GROUPACCEPT_INVITED_BY_OWNER_AUTO_ACCEPT',
'User is accepted only if invited by existing group owner.',
'Invited by Owner',
'GROUPACCEPT'
),( UUID(), NOW(), NOW(),
'GROUPACCEPT_INVITED_BY_MEMBER_AUTO_ACCEPT',
'Member is accepted only if invited by existing group Member.',
'Invited by Member of group',
'GROUPACCEPT'
);
-- **********************************************************************************************************************************************
-- Group Visibility Configuration
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUPVISIBILITY_GROUP_PRIVATE',
'Only users within within the Group can see the Content of the group.',
'Group Private',
'GROUPVISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUPVISIBILITY_GROUP_PUBLIC',
'The content is viewable to all users within the defined university.',
'Group Public',
'GROUPVISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY_UNIVERSITY_PRIVATE',
'Group Content is viewable to user within other Universities',
'Univerisity Private',
'GROUPVISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUPVISIBILITY_UNIVERSITY_PUBLIC',
'The content within the group is viewable to all users of the site.',
'Public',
'GROUPVISIBILITY'
);
-- **********************************************************************************************************************************************
-- Group Request Request
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUPREQUEST_STATUS_DENIED',
'The owner or review board of group has denied your request for access to this group.',
'Group Request Denied',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUPREQUEST_STATUS_APPROVED',
'The owner or review board of the group has accepted your request to join the group',
'Group Request Approved',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUPREQUEST_STATUS_INREVIEW',
'The owner or review board of the group is reviewing your request',
'Group Request is In Review',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUPREQUEST_STATUS_RECIEVED',
'The owner or review board has received the group request',
'Group Request has been recieved',
'GROUP_REQUEST_STATUS'
),( UUID(), NOW(), NOW(),
'GROUPREQUEST_STATUS_SENTTOAPPROVER',
'Request has been to Approver',
'Group Request has been recieved',
'GROUP_REQUEST_STATUS'
);
-- **********************************************************************************************************************************************
-- Object Types
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECTTYPE_UNIVERSITY',
'Search Object for university profiles',
'Universities',
'OBJECTTYPE'
),( UUID(), NOW(), NOW(),
'OBJECTTYPE_GROUP',
'Object for Group profiles',
'Groups',
'OBJECTTYPE'
),( UUID(), NOW(), NOW(),
'OBJECTTYPE_USER',
'Object for User profles',
'Users',
'OBJECTTYPE'
),( UUID(), NOW(), NOW(),
'OBJECTTYPE_CATALOGITEM',
'object for all catalog items',
'Catalog Items',
'OBJECTTYPE'
),( UUID(), NOW(), NOW(),
'OBJECTTYPE_WALLPOST',
'Object for all wall posts',
'Wall Post',
'OBJECTTYPE'
),( UUID(), NOW(), NOW(),
'OBJECTTYPE_GROUPREQEUST',
'Object Type representing Request for Group Access',
'Group Request',
'OBJECTTYPE'
),( UUID(), NOW(), NOW(),
'OBJECTTYPE_MICRBLOGPOST',
'Object Type reprenseting a micro blog post',
'Microblog Post',
'OBJECTTYPE'
),( UUID(), NOW(), NOW(),
'OBJECTTYPE_ALBUMMIME',
'Object Type representing a photo in a photoalbum',
'Album Mime',
'OBJECTTYPE'
);
-- **********************************************************************************************************************************************
-- User Roles Configuration
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'USERROLE_GROUPOWNER',
'Has user rights as the Owner and creator of the group.  Is able to control group',
'Group Owner',
'USERROLE'
),( UUID(), NOW(), NOW(),
'USERROLE_UNIVERSITYOWNER',
'Has rights to University ownership.  This role is responsible for content of university',
'University Owner',
'USER_ROLE'
),( UUID(), NOW(), NOW(),
'USERROLE_GROUPUSER',
'Has user rights to the Group in Question',
'Group User',
'USERROLE'
),( UUID(), NOW(), NOW(),
'USERROLE_UNIVERSITYUSER',
'Has user rights to the University in Question',
'University User',
'USERROLE'
);
