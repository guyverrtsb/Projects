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
'GROUP_TYPE'
),( UUID(), NOW(), NOW(),
'USER_TYPE_ASSET',
'Assests have achieved the third level of status and area allowed to create content for Games',
'Game Assest',
'GROUP_TYPE'
);