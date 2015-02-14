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
-- ************************* USER_TYPE
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'USER_TYPE_GAMER',
'Gamers are combatitants who have just started.',
'Gamer',
'USER_TYPE'
),( UUID(), NOW(), NOW(),
'USER_TYPE_MASTER',
'Masters have achieved the second level of status and are allowed configure Games',
'Game Master',
'USER_TYPE'
),( UUID(), NOW(), NOW(),
'USER_TYPE_ASSET',
'Assests have achieved the third level of status and area allowed to create content for Games',
'Game Assest',
'USER_TYPE'
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
-- ************************* PAYMENT_TYPES
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'PAYMENT_TYPES_FREE',
'Free',
'Free',
'PAYMENT_TYPES'
),( UUID(), NOW(), NOW(),
'PAYMENT_TYPES_PAID',
'Paid',
'Paid',
'PAYMENT_TYPES'
);
-- **********************************************************************************************************************************************
-- ************************* OBJECT_TYPES
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPES_HAZARD',
'Hazard',
'Hazard',
'OBJECT_TYPES'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_TOOL',
'Tools',
'Tools',
'OBJECT_TYPES'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_PLACE',
'Places',
'Places',
'OBJECT_TYPES'
);
-- **********************************************************************************************************************************************
-- ************************* OBJECT_TYPES_HAZARD
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPES_HAZARD_MINE',
'Mine',
'Mine',
'OBJECT_TYPES_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_HAZARD_SENTRYGUN',
'Sentry Gun',
'Sentry Gun',
'OBJECT_TYPES_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_HAZARD_ARTILLARY',
'Artillary',
'Artillary',
'OBJECT_TYPES_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_HAZARD_MISSLE',
'Missle',
'Missle',
'OBJECT_TYPES_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_HAZARD_DRONE',
'Drone',
'Drone',
'OBJECT_TYPES_HAZARD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_HAZARD_AIRSTRIKE',
'Air Strike',
'Air Strike',
'OBJECT_TYPES_HAZARD'
);
-- **********************************************************************************************************************************************
-- ************************* OBJECT_TYPES_SHIELD
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPES_SHIELD_STEALTH',
'Stealth',
'Stealth will hide users from hazards',
'OBJECT_TYPES_SHIELD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_SHIELD_DETECTOR',
'Dectector',
'Dectector will show Hazards and Gamers',
'OBJECT_TYPES_SHIELD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_SHIELD_DISTRACT',
'Distract',
'Distract will through off attack into multiple directions',
'OBJECT_TYPES_SHIELD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_PLACE_CLONE',
'Clone',
'Will allow owner to duplicate themselves to confuse opponents',
'OBJECT_TYPES_SHIELD'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_PLACE_EMP',
'EMP',
'Will knockout all elecronics within a radius',
'OBJECT_TYPES_SHIELD'
);
-- **********************************************************************************************************************************************
-- ************************* OBJECT_TYPES_PLACE
INSERT INTO configurations (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)
VALUES ( UUID(), NOW(), NOW(),
'OBJECT_TYPES_PLACE_WORSHIP',
'Place of Worship',
'Place of Worship',
'OBJECT_TYPES_PLACE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_PLACE_SANCTUARY',
'Sanctuary',
'Sanctuary',
'OBJECT_TYPES_PLACE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_PLACE_POWERUP',
'Power Up',
'Power Up',
'OBJECT_TYPES_PLACE'
),( UUID(), NOW(), NOW(),
'OBJECT_TYPES_PLACE_DEPOT',
'Depot',
'Depot',
'OBJECT_TYPES_PLACE'
);