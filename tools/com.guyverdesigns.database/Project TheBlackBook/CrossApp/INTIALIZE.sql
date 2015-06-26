-- Use this SQL File to INSERT the configurations required for the site to run.
-- ****************************************************************************************************************
-- ************************* COUNTRIES
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
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
-- ************************* COUNTRY_US
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)VALUES
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
),
( UUID(), NOW(), NOW(),
'REGION_OK',
'Oklahoma',
'Oklahoma',
'COUNTRY_US'
),
( UUID(), NOW(), NOW(),
'REGION_MO',
'Missouri',
'Missouri',
'COUNTRY_US'
),
( UUID(), NOW(), NOW(),
'REGION_PA',
'Pennsylvania',
'Pennsylvania',
'COUNTRY_US'
);
-- **********************************************************************************************************************************************
-- ************************* REGION_NC Counties
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`)VALUES
( UUID(), NOW(), NOW(),
'WAKE_NC',
'Arizona',
'Arizona',
'REGION_NC'
),
( UUID(), NOW(), NOW(),
'DURHAM_NC',
'North Carolina',
'North Carolina',
'REGION_NC'
),
( UUID(), NOW(), NOW(),
'ORANGE_NC',
'South Carolina',
'South Carolina',
'REGION_NC'
),
( UUID(), NOW(), NOW(),
'ALBAMARLE_NC',
'Oklahoma',
'Oklahoma',
'REGION_NC'
),
( UUID(), NOW(), NOW(),
'JOHNSTON_NC',
'Missouri',
'Missouri',
'REGION_NC'
),
( UUID(), NOW(), NOW(),
'MACKLENBURG_NC',
'Pennsylvania',
'Pennsylvania',
'REGION_NC'
);