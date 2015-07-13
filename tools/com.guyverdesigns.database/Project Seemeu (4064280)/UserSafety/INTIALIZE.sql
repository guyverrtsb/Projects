-- SeeMeU Usersafety
-- Use this SQL File to INSERT the configurations required for the site to run.
USE `seemeuusersafety`;
-- ****************************************************************************************************************
-- ************************* COUNTRIES
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-PARSE',
'Parse',
'Parse',
'OPENAUTH_PROVIDER'
),
( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-WATSAPP',
'Wats App',
'Wats App',
'OPENAUTH_PROVIDER'
),
( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-INSTAGRAM',
'Instagram',
'Instagram',
'OPENAUTH_PROVIDER'
),
( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-TWITTER',
'Twitter',
'Twitter',
'OPENAUTH_PROVIDER'
),
( UUID(), NOW(), NOW(),
'OPENAUTH_PROVIDER-FACEBOOK',
'Facebook',
'Facebook',
'OPENAUTH_PROVIDER'
);