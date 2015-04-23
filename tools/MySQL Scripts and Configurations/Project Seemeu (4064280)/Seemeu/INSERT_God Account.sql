INSERT INTO `user_account` (`uid`,`createddt`,`changeddt`,`email`,`password`,`active`,`usertablekey`, `nickname`) VALUES
( UUID(), NOW(), NOW(),
'admin@groupuniv.com',
'1234567890',
'T',
'GROUP_YOU_ADMIN',
'GROUP_YOU_ADMIN'
)
;
INSERT INTO `user_profile` (`uid`,`createddt`,`changeddt`,`fname`,`lname`,`city`,`cfg_region_sdesc`,`cfg_country_sdesc`) VALUES
( UUID(), NOW(), NOW(),
'Javier',
'Collegiate',
'Tulsa',
'REGION_OK',
'COUNTRY_US'
)
;
INSERT INTO `match_user_account_to_user_profile` (`uid`,`createddt`,`changeddt`,`user_account_uid`,`user_profile_uid`) VALUES
( UUID(), NOW(), NOW(),
(select uid from `user_account` WHERE `lid`='1'),
(select uid from `user_profile` WHERE `lid`='1')
)
;
INSERT INTO `match_user_account_to_cfg_user_site_roles` (`uid`,`createddt`,`changeddt`,`user_account_uid`,`cfg_user_site_roles_sdesc`) VALUES
( UUID(), NOW(), NOW(),
(select uid from `user_account` WHERE `email`='admin@groupuniv.com'),
'USER_ROLE_SITE_GOD'
)
;