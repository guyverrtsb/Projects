-- Use this SQL File to INSERT the configurations required for the site to run.
-- ****************************************************************************************************************
-- User Roles Configuration
INSERT INTO cfg_user_roles (`uid`,`createddt`,`changeddt`,`sdesc`,`ldesc`)
VALUES ( UUID(), NOW(), NOW(),
'GROUP_OWNER',
'Has user rights as the Owner and creator of the group.  Is able to control group'
),( UUID(), NOW(), NOW(),
'UNIVERSITY_OWNER',
'Has rights to University ownership.  This role is responsible for content of university'
),( UUID(), NOW(), NOW(),
'GROUP_USER',
'Has user rights to the Group in Question'
),( UUID(), NOW(), NOW(),
'UNIVERSITY_USER',
'Has user rights to the University in Question'
),( UUID(), NOW(), NOW(),
'NON_UNIVERSITY_USER',
'User is not a college attendant or alumni.'
),( UUID(), NOW(), NOW(),
'SITE_ADMIN',
'Is an overall site admin.  Has Admin roles a responsibilties of site.'
),( UUID(), NOW(), NOW(),
'SITE_USER',
'Is a site user.'
)
;
select * from cfg_user_roles;