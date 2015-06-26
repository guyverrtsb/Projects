-- Use this SQL File to INSERT the configurations required for the site to run.
-- ****************************************************************************************************************
-- ************************* COUNTRIES
INSERT INTO `cfg_defaults` (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`,`group_key`) VALUES( UUID(), NOW(), NOW(),
'PLACEMENT_STATUS_REQSENT',
'Requirement E-Mail Sent',
'Requirement E-Mail Sent',
'PLACEMENT_STATUS'
),
( UUID(), NOW(), NOW(),
'PLACEMENT_STATUS_RESPONDED',
'Resource has Responded',
'Resource has Responded',
'PLACEMENT_STATUS'
),
( UUID(), NOW(), NOW(),
'PLACEMENT_STATUS_PRESCREENED',
'Resource has been PreScreened',
'Resource has been PreScreened',
'PLACEMENT_STATUS'
),
( UUID(), NOW(), NOW(),
'PLACEMENT_STATUS_APPROVED',
'Resource has been Approved',
'Resource has been Approved',
'PLACEMENT_STATUS'
),
( UUID(), NOW(), NOW(),
'PLACEMENT_STATUS_NOTAPPROVED',
'Resource has not been Approved',
'Resource has not been Approved',
'PLACEMENT_STATUS'
),
( UUID(), NOW(), NOW(),
'PLACEMENT_STATUS_SUBMITTED',
'Resource has been submitted',
'Resource has been submitted',
'PLACEMENT_STATUS'
),
( UUID(), NOW(), NOW(),
'PLACEMENT_STATUS_FAILEDSUBMISSION',
'Resource has failed submission',
'Resource has failed submission',
'PLACEMENT_STATUS'
);
SELECT * FROM cfg_defaults;