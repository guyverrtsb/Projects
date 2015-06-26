-- Use this SQL File to INSERT the configurations required for the site to run.
-- ****************************************************************************************************************
-- Group User Acceptance Configuration
INSERT INTO cfg_group_useracceptance (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES ( UUID(), NOW(), NOW(),
'AUTO_ACCEPT',
'User is automatically accepted into group upon request.',
'Accept Upon Requestt'
),( UUID(), NOW(), NOW(),
'OWNER_ACCEPT',
'User is accepted only by owner approval upon request.',
'Owner Accept'
),( UUID(), NOW(), NOW(),
'INVITED_BY_OWNER_AUTO_ACCEPT',
'User is accepted only if invited by existing group owner.',
'Invited by Owner'
),( UUID(), NOW(), NOW(),
'INVITED_BY_USER_AUTO_ACCEPT',
'User is accepted only if invited by existing group user.',
'Invited by User'
);
select * from cfg_group_useracceptance;