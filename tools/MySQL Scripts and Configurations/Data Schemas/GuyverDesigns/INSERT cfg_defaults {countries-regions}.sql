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
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`) VALUES( UUID(), NOW(), NOW(),
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
SELECT * FROM cfg_defaults;