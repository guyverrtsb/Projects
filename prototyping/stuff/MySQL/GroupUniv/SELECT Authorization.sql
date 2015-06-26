SELECT cfg_user_roles.uid, cfg_user_roles.sdesc, cfg_user_roles.ldesc
, user_account.email
FROM user_account
JOIN match_user_account_to_cfg_user_roles
 on match_user_account_to_cfg_user_roles.user_account_uid = user_account.uid
JOIN cfg_user_roles
 on cfg_user_roles.uid = match_user_account_to_cfg_user_roles.cfg_user_roles_uid
-- WHERE user_account.uid = ''
;

SELECT *
FROM user_account
;

SELECT cfg_user_roles.uid, cfg_user_roles.sdesc, cfg_user_roles.ldesc 
FROM user_account 
JOIN match_user_account_to_cfg_user_roles
 on match_user_account_to_cfg_user_roles.user_account_uid = user_account.uid 
JOIN cfg_user_roles
 on cfg_user_roles.uid = match_user_account_to_cfg_user_roles.cfg_user_roles_uid 
WHERE user_account.uid = '0f9b01a7-7b17-11e3-af90-f54ea964f8b0'
;