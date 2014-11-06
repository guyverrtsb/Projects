-- Use this SQL File to INSERT the configurations required for the site to run.
-- **********************************************************************************************************************************************
-- ************************* MIMES_TYPES
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPES_IMAGE',
'IMAGE',
'IMAGE',
'ROOT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_DOCUMENT',
'DOCUMENT',
'DOCUMENT',
'ROOT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_CATCHALL',
'CATCHALL',
'CATCHALL',
'ROOT'
);
-- ****************************************************************************************************************
-- ************************* IMAGES
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPES_GIF',
'GIF',
'GIF',
'MIME_TYPES_IMAGE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPE_BMP',
'BMP',
'BMP',
'MIME_TYPES_IMAGE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_JPG',
'GIF',
'GIF',
'MIME_TYPES_IMAGE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_JPEG',
'JPEG',
'JPEG',
'MIME_TYPES_IMAGE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_PNG',
'PNG',
'PNG',
'MIME_TYPES_IMAGE'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_TIF',
'TIF',
'TIF',
'MIME_TYPES_IMAGE'
);
-- ****************************************************************************************************************
-- ************************* DOCUMENTS
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'MIME_TYPES_DOC',
'DOC',
'DOC',
'MIME_TYPES_DOCUMENT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_XLS',
'XLS',
'XLS',
'MIME_TYPES_DOCUMENT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_PDF',
'PDF',
'PDF',
'MIME_TYPES_DOCUMENT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_DOCX',
'DOCX',
'DOCX',
'MIME_TYPES_DOCUMENT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_XML',
'XML',
'XML',
'MIME_TYPES_DOCUMENT'
),
( UUID(), NOW(), NOW(),
'MIME_TYPES_DOT',
'DOT',
'DOT',
'MIME_TYPES_DOCUMENT'
);