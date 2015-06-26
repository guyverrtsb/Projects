-- This INSERT file is allows for the entry of default like Country and Region
-- The CFG_DEFAULTS table is designed to be a central place for Parent Child Defualt Values that are reused through out a site.
-- use the CG_DEFAULT table to limit redundancy.
-- ************************* COUNTRIES
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`dependant_sdesc`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'COUNTRY_US',
'United States of America',
'ROOT',
'COUNTRY'
);
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`dependant_sdesc`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'COUNTRY_AU',
'Australia',
'ROOT',
'COUNTRY'
);
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`dependant_sdesc`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'COUNTRY_CA',
'Canada',
'ROOT',
'COUNTRY'
);
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`dependant_sdesc`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'COUNTRY_EN',
'England',
'ROOT',
'COUNTRY'
);
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`dependant_sdesc`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'COUNTRY_ES',
'Spain',
'ROOT',
'COUNTRY'
);
-- ************************* US REGIONS
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`dependant_sdesc`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'REGION_AZ',
'Arizona',
'COUNTRY_US',
'REGION'
);
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`dependant_sdesc`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'REGION_NC',
'North Carolina',
'COUNTRY_US',
'REGION'
);
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`dependant_sdesc`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'REGION_SC',
'South Carolina',
'COUNTRY_US',
'REGION'
);

select * from cfg_defaults;