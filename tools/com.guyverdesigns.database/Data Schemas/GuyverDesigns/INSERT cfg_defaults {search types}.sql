-- Use this SQL File to INSERT the configurations required for the site to run.
-- **********************************************************************************************************************************************
-- Search Objects
INSERT INTO cfg_defaults (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`)
VALUES ( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_REQUIREMENT',
'Search Object for Job Requirments',
'Requirement',
'SEARCH_OBJECT'
),( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_RESOURCE',
'Search Object for Personel Resource',
'Resource',
'SEARCH_OBJECT'
),( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_ARTICLE',
'Search Object for Article or News',
'Article',
'SEARCH_OBJECT'
),( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_WHITE_PAPER',
'Search object for White Paper',
'White Paper',
'SEARCH_OBJECT'
),( UUID(), NOW(), NOW(),
'SEARCH_OBJECT_BLOG',
'Search Object for all Blog',
'Blog',
'SEARCH_OBJECT'
);
SELECT * FROM cfg_defaults;