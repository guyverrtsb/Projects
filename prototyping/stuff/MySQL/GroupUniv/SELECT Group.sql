select
group_account.uid, group_account.sdesc
from group_account
;
select
match_user_account_to_group_account_to_cfg_user_roles.group_account_uid
from match_user_account_to_group_account_to_cfg_user_roles
;
-- Group User and Wall Messages
select
group_account.ldesc, group_account.sdesc
, user_account.email, user_profile.fname, user_profile.lname
, wall_message.content, group_account.uid
from group_account
join match_user_account_to_group_account_to_cfg_user_roles
 on match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = group_account.uid
join user_account
 on match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = user_account.uid
join match_user_account_to_user_profile on
 match_user_account_to_user_profile.user_account_uid = user_account.uid
join user_profile
 on match_user_account_to_user_profile.user_profile_uid = user_profile.uid
join wall_message
 on wall_message.group_account_uid = group_account.uid
-- where group_account.uid = 'caf92a2d-77b1-11e3-bf92-355c30ddc131'
;
-- Group Account and Profile
SELECT group_account.uid, group_account.ldesc
, group_account.cfg_group_type_uid, group_account.cfg_group_visibility_uid
, group_account.cfg_group_useracceptance_uid, group_profile.validtodate
, group_profile.content 
FROM group_account 
JOIN match_group_account_to_group_profile
 on match_group_account_to_group_profile.group_account_uid = group_account.uid 
JOIN group_profile
 on match_group_account_to_group_profile.group_profile_uid = group_profile.uid 
WHERE group_account.uid='caeb2d5e-77b1-11e3-bf92-355c30ddc131'
;
-- Groups that I am an Admin of
SELECT group_account.uid, group_account.ldesc
, group_account.cfg_group_type_uid, group_account.cfg_group_visibility_uid
, group_account.cfg_group_useracceptance_uid, group_profile.validtodate
, group_profile.content 
FROM cfg_user_roles
JOIN match_user_account_to_group_account_to_cfg_user_roles
 on match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_uid = cfg_user_roles.uid
JOIN group_account
 on group_account.uid = match_user_account_to_group_account_to_cfg_user_roles.group_account_uid
JOIN match_group_account_to_group_profile
 on match_group_account_to_group_profile.group_account_uid = group_account.uid
JOIN group_profile
 on group_profile.uid = match_group_account_to_group_profile.group_profile_uid
WHERE cfg_user_roles.sdesc = 'GROUP_OWNER'
-- AND match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = ''
;
