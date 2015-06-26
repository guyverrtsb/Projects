-- SeeMeU Application-- **********************************************************************************************************************************************
-- Entity Type Configuration
USE `seemeuapplication`;
DELETE FROM `configurations` WHERE `lid` > 0;
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
'Faculty',
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
'USER_TYPE-SEEMEU',
'Corporate Usiversity of See Me U',
'See Me U',
'SCHOOL_TYPE'
);
