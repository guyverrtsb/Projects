INSERT INTO usersafety_role
(`uid`,`createddt`,`changeddt`,`sdesc`,`priority`,`ldesc`)
VALUES
(
UUID(),NOW(),NOW(),'GD_ADMIN',4,
'Adminstrator role for site has access to all web app functionality for site.'
),
(
UUID(),NOW(),NOW(),'GD_PUBLISHER',3,
'Publisher roles is designed as a mechanism for having persons and activities that approvae content for being released to site.'
),
(
UUID(),NOW(),NOW(),'GD_CONTENT_CREATOR',2,
'Content Creator role for site is allowed to create content for site however not aprove content for release.'
),
(
UUID(),NOW(),NOW(),'GD_USER',1,
'User role for site is allowed to view secured content on site. This user is Logged in'
),
(
UUID(),NOW(),NOW(),'GD_GUEST',0,
'Guest role for site is allowed to see insecure content on a site. This user is not logged in.'
)
;
SELECT * FROM usersafety_role;