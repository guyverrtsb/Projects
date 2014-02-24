-- Use this SQL File to INSERT the configurations required for the site to run.
-- ****************************************************************************************************************
-- Search Objects
INSERT INTO cfg_search_objects (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`, `label`)
VALUES ( UUID(), NOW(), NOW(),
'UNIVERSITY',
'Search Object for university profiles',
'Universities'
),( UUID(), NOW(), NOW(),
'GROUP',
'Search Object for Group profiles',
'Groups'
),( UUID(), NOW(), NOW(),
'USER',
'Search Object for User profles',
'Users'
),( UUID(), NOW(), NOW(),
'CATALOG_ITEM',
'Search object for all catalog items',
'Catalog Items'
),( UUID(), NOW(), NOW(),
'WALL_MESSAGE',
'Search Object for all wall messages',
'Wall Messages'
);
select * from cfg_search_objects;




