-- Use this SQL File to INSERT the configurations required for the site to run.
-- **********************************************************************************************************************************************
-- ************************* GROUP_TYPE
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_TYPE_UNLIMITED',
'Group type all out war.',
'Unlimited',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_ESPIONAGE',
'Group Type for Espionage and Mission',
'Espionage',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_BRANDED',
'Group Type for Branded games such as Movie, Television Shows, Historical and Corporate branded Games',
'Branded',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_GAME',
'Discussions and Ideas provides a group that allows all within the group to engage in discussion on an idea.  This group moderates itself.',
'Game',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_SOCIAL',
'Social group.  This group is where friends get together and talk.  ',
'Social',
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'GROUP_TYPE_STAGING',
'Gamers join here to prep a game.  The gamer who created this staging group is the Game Master or the Group Owner can assign a Game Master.',
'Game',
'GROUP_TYPE'
);
-- **********************************************************************************************************************************************
-- Group User Acceptance Configuration
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
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
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
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
-- ************************* GAMER_ROLE
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'GAMER_ROLE_GAMER',
'Gamers are combatitants who have just started.',
'Gamer',
'GAMER_ROLE'
),( UUID(), NOW(), NOW(),
'GAMER_ROLE_MASTER',
'Masters have achieved the second level of status and are allowed configure Games',
'Game Master',
'GAMER_ROLE'
),( UUID(), NOW(), NOW(),
'GAMER_ROLE_ASSET',
'Assests have achieved the third level of status and area allowed to create content for Games',
'Game Assest',
'GAMER_ROLE'
);
-- **********************************************************************************************************************************************
-- ************************* MERCHANT_ROLE
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'MERCHANT_ROLE_HQ',
'Headquarters are users that oversee all offices',
'Headquarters',
'MERCHANT_ROLE'
),( UUID(), NOW(), NOW(),
'MERCHANT_ROLE_OFFICE',
'Office users over see a single office',
'Office',
'MERCHANT_ROLE'
),( UUID(), NOW(), NOW(),
'MERCHANT_ROLE_USER',
'Users have limitied access to office data',
'User',
'MERCHANT_ROLE'
);
-- **********************************************************************************************************************************************
-- ************************* USER_TYPE_GAMER_ACHIEVMENTS
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'USER_TYPE_GAMER_ACHIEVEMENT_BOMBER',
'Bomber Achievment.  This achievement gives palyer the ability to create bombs',
'Bomber',
'USER_TYPE_GAMER'
),( UUID(), NOW(), NOW(),
'USER_TYPE_GAMER_ACHIEVEMENT_MINERBUILDERS',
'Mine Builders can provide new types of mines for use through site',
'Mine Builder',
'USER_TYPE_GAMER'
),( UUID(), NOW(), NOW(),
'USER_TYPE_GAMER_ACHIEVEMENT_GUNSMITH',
'Gun Smiths deisgn standing guns wiht various reaches',
'Gun Smith',
'USER_TYPE_GAMER'
);
-- **********************************************************************************************************************************************
-- ************************* OBJECT_TYPE
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPE_HAZARD',
'Hazard',
'Hazard',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_SHIELD',
'Tools',
'Tools',
'OBJECT_TYPE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_PLACE',
'Places',
'Places',
'OBJECT_TYPE'
);
-- **********************************************************************************************************************************************
-- ************************* PAYMENT_TYPE
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'PAYMENT_TYPE_FREE',
'Free',
'Free',
'PAYMENT_TYPE'
),( UUID(), NOW(), NOW(),
'PAYMENT_TYPE_PAID',
'Paid',
'Paid',
'PAYMENT_TYPE'
);
-- **********************************************************************************************************************************************
-- ************************* OBJECT_TYPE_HAZARD
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPE_HAZARD_MINE',
'Mine',
'Mine',
'OBJECT_TYPE_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_HAZARD_SENTRYGUN',
'Sentry Gun',
'Sentry Gun',
'OBJECT_TYPE_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_HAZARD_ARTILLARY',
'Artillary',
'Artillary',
'OBJECT_TYPE_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_HAZARD_MISSLE',
'Missle',
'Missle',
'OBJECT_TYPE_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_HAZARD_DRONE',
'Drone',
'Drone',
'OBJECT_TYPE_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_HAZARD_AIRSTRIKE',
'Air Strike',
'Air Strike',
'OBJECT_TYPE_HAZARD'
);
-- **********************************************************************************************************************************************
-- ************************* OBJECT_TYPE_SHIELD
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPE_SHIELD_STEALTH',
'Stealth will hide users from hazards',
'Stealth',
'OBJECT_TYPE_SHIELD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_SHIELD_DETECTOR',
'Dectector will show Hazards and Gamers',
'Dectector',
'OBJECT_TYPE_SHIELD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_SHIELD_DISTRACT',
'Distract will through off attack into multiple directions',
'Distract',
'OBJECT_TYPE_SHIELD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_PLACE_CLONE',
'Will allow owner to duplicate themselves to confuse opponents',
'Clone',
'OBJECT_TYPE_SHIELD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_PLACE_EMP',
'Will knockout all elecronics within a radius',
'EMP',
'OBJECT_TYPE_SHIELD'
);
-- **********************************************************************************************************************************************
-- ************************* OBJECT_TYPE_PLACE
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPE_PLACE_WORSHIP',
'Place of Worship',
'Place of Worship',
'OBJECT_TYPE_PLACE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_PLACE_SANCTUARY',
'Sanctuary',
'Sanctuary',
'OBJECT_TYPE_PLACE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_PLACE_POWERUP',
'Power Up',
'Power Up',
'OBJECT_TYPE_PLACE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPE_PLACE_DEPOT',
'Depot',
'Depot',
'OBJECT_TYPE_PLACE'
);