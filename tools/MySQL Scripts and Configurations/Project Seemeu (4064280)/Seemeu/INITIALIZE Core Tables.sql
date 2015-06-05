-- SELECT * FROM seemeuapplication.configurations;
-- DELETE FROM seemeuapplication.configurations WHERE  lid <> 0;

-- **********************************************************************************************************************************************
-- Group Type Configuration
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_TYPE-SPORTS',
'Group type for to work with sports and show sports type data and functionaltiy',
'Sports and Teams',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-EVENTS',
'Events and Parties is designed to allow functionality based on what a Party planner and promtore would require',
'Events and Parties',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-SOCIAL',
'Social and Freinds allows the owner to port and share information amongst friends and others that fit within a social group. These groups could be light or close freinds',
'Social and Friends',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-GAMER',
'Gamer is designed to allow you stream and publish videos about games and gamers.  You have are allowed to broadcast and store two hours of video at a time.',
'Social and Friends',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-HIGH_SCHOOL',
'This allows you to create a social group based on a high school.  If you define your group to be public then all of your posts will show up on the high school wall.  If you define the group to be Private then your posts do not show up on Highschool.',
'High School',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-DISCUSSIONS',
'Discussions and Ideas provides a group that allows all within the group to engage in discussion on an idea.  This group moderates itself.',
'Discussions and Ideas',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-CLASSROOM',
'Classroom and Teaching provides a group where a single leader can drive disucssion and guide ideas for the purpose of sharing knowledge. This is good for Tutors and Mentors as well as faculty for sharing classroom ',
'Classroom and Teachings',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-FAMILY',
'This is a special group.  It allows for a Univ Meet edu user to have non-edu user commnication with the student.',
'Family',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-UNIVERSITY',
'This special group defines groups created by the University.  Groups of this type drive an automatic enrollment by the student.  This is not for General Use.',
'University',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-VETTING_UNIVERSITY',
'This group is for users to be able to see public and univ public posts and ask questions',
'University Vetting',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-STUDY_GROUP',
'is for scheduling study sessions',
'Study',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE-BOOSTER',
'this group is for boosters',
'University Vetting',
'GROUP_TYPE'
);
-- **********************************************************************************************************************************************
-- Group Acceptance Configuration
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
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
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY-GROUP_PRIVATE',
'Only users within within the Group can see the Content of the group.',
'Group Private',
'GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY-GROUP_PUBLIC',
'The content is viewable to all users within the defined university.',
'Group Public',
'GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY-UNIVERSITY_PRIVATE',
'Group Content is viewable to user within other Universities',
'Univerisity Private',
'GROUP_VISIBILITY'
),( UUID(), NOW(), NOW(),
'GROUP_VISIBILITY-UNIVERSITY_PUBLIC',
'The content within the group is viewable to all users of the site.',
'Public',
'GROUP_VISIBILITY'
);
-- **********************************************************************************************************************************************
-- Group Request Request
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
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
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPE-UNIVERSITY_PROFILE',
'Search Object for university profiles',
'Universities',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
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
'OBJECT_TYPE-WALL_POST',
'Object for all wall posts',
'Wall Post',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-GROUP_REQEUST',
'Object Type representing Request for Group Access',
'Group Request',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-MICR_BLOG_POST',
'Object Type reprenseting a micro blog post',
'Microblog Post',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-ALBUM_MIME',
'Object Type representing a photo in a photoalbum',
'Album Mime',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE-HIGH_SCHOOL',
'Object Type representing a High School Entity',
'High School',
'OBJECT_TYPE'
);
-- **********************************************************************************************************************************************
-- User Roles Configuration
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'USER_ROLE-GROUP_OWNER',
'Has user rights as the Owner and creator of the group.  Is able to control group',
'Group Owner',
'USER_ROLE'
),( UUID(), NOW(), NOW(),
'USER_ROLE-UNIVERSITY_OWNER',
'Has rights to University ownership.  This role is responsible for content of university',
'University Owner',
'USER_ROLE'
),( UUID(), NOW(), NOW(),
'USER_ROLE-GROUP_USER',
'Has user rights to the Group in Question',
'Group User',
'USER_ROLE'
),( UUID(), NOW(), NOW(),
'USER_ROLE-UNIVERSITY_USER',
'Has user rights to the University in Question',
'University User',
'USER_ROLE'
);
-- **********************************************************************************************************************************************
-- User Types Configuration
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'USER_TYPE-PROSPECT',
'Use this User Type if you are starting you higher education path.  If you are a High School student looking to plan your fututre or someone who is starting over and needs resources to help find the right path this type of account is for you.',
'Prospect',
'USER_TYPE'
),( UUID(), NOW(), NOW(),
'USER_TYPE-STUDENT',
'Students are currently enrolled to a Univeristy.  Students will be ale to take advantage of the tools provided to help with make your university experience enjoyable an dfullfilling',
'Sttudent',
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
);
