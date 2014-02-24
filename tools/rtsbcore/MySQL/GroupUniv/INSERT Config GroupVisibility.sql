-- Use this SQL File to INSERT the configurations required for the site to run.
-- ****************************************************************************************************************
-- Group Visibility Configuration
INSERT INTO cfg_group_visibility (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`,`label`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_PRIVATE',
'Only users within within the Group can see the Content of the group.',
'Group Private'
),( UUID(), NOW(), NOW(),
'GROUP_PUBLIC',
'The content is viewable to all users within the defined university.',
'Group Public'
),( UUID(), NOW(), NOW(),
'UNIVERSITY_PRIVATE',
'Group Content is viewable to user within other Universities',
'Univerisity Private'
),( UUID(), NOW(), NOW(),
'UNIVERSITY_PUBLIC',
'The content within the group is viewable to all users of the site.',
'Public'
)
;
select * from cfg_group_visibility;