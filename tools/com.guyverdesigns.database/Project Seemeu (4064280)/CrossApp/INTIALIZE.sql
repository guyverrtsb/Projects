-- SeeMeU Cross Application
-- Use this SQL File to INSERT the configurations required for the site to run.
USE `seemeucrossappli`;
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
-- ****************************************************************************************************************
-- ************************* MIME_TYPE
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_OBJECT-IMAGE',
'Image is used to store images inlcuding TIF, PNG, BMP, JPG, JEG, Gif and others',
'Image',
'MIME_OBJECT'
),
( UUID(), NOW(), NOW(),
'MIME_OBJECT-DOCUMENT',
'For DOucments such as PDF, Excel, Word, and other document types',
'Document',
'MIME_OBJECT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-VIDEO',
'For Videos',
'Video',
'MIME_OBJECT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-FILE',
'Used for mimes of type files.  These are zips and other types of files that need to be tracked but not are catchalls',
'File',
'MIME_OBJECT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-CATCHALL',
'Used for items that do not fall into a defiend Mime Type',
'Catch All',
'MIME_OBJECT'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-IMAGE-TYPE
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_OBJECT-IMAGE-TYPE-JPG',
'JPG',
'JPG',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-JPEG',
'JPEG',
'JPEG',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-GIF',
'GIF',
'GIF',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-TIF',
'TIF',
'TIF',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-PNG',
'PNG',
'PNG',
'MIME_TYPE-IMAGE-TYPE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-TYPE-BMP',
'BMP',
'BMP',
'MIME_TYPE-IMAGE-TYPE'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-IMAGE-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-IMAGE-CONFIG'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-CONFIG-500X500',
'500 X 500',
'500 X 500',
'MIME_TYPE-IMAGE-CONFIG'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-CONFIG-100X100',
'100 X 100',
'100 X 100',
'MIME_TYPE-IMAGE-CONFIG'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE-IMAGE-CONFIG-80X80',
'80 X 80',
'80 X 80',
'MIME_TYPE-IMAGE-CONFIG'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-DOCUMENT-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-DOCUMENT-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-DOCUMENT-CONFIG'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-VIDEO-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-VIDEO-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-VIDEO-CONFIG'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-FILE-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-FILE-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-FILE-CONFIG'
);
-- ****************************************************************************************************************
-- ************************* MIME_TYPE-CATCHALL-CONFIG
INSERT INTO `configurations` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`groupkey`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPE-CATCHALL-CONFIG-ORIGINAL',
'Original',
'Original',
'MIME_TYPE-CATCHALL-CONFIG'
);