select 
IF((SELECT match_user_account_to_group_account_to_cfg_user_roles.uid FROM match_user_account_to_group_account_to_cfg_user_roles
 JOIN group_account ON group_account.uid = match_user_account_to_group_account_to_cfg_user_roles.group_account_uid
 JOIN cfg_group_useracceptance ON cfg_group_useracceptance.uid = group_account.cfg_group_useracceptance_uid
 WHERE match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = 'eca1544e-83ca-11e3-8ccb-6a3ffe3e3965'
 AND match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = group_account.uid
 AND (cfg_group_useracceptance.sdesc = 'AUTO_ACCEPT' OR cfg_group_useracceptance.sdesc = 'OWNER_ACCEPT')) <> '', 'JOIN_NOT_ALLOWED', 'JOIN_ALLOWED')
 AS is_member_of_group 
, (SELECT user_account.email FROM user_account
 JOIN match_user_account_to_group_account_to_cfg_user_roles
 ON match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = user_account.uid
 WHERE match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = group_account.uid
 AND match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_uid = (SELECT uid from cfg_user_roles WHERE sdesc='GROUP_OWNER')) AS owner_of_group_email 
, group_profile.content AS group_profile_content,group_account.ldesc AS group_account_ldesc,group_account.uid AS group_account_uid
,group_account.createddt AS group_account_createddt,search_content.content AS search_content_content,search_content.uid AS search_content_uid
,search_content.createddt AS search_content_createddt,cfg_group_useracceptance.uid AS cfg_group_useracceptance_uid
,cfg_group_useracceptance.sdesc AS cfg_group_useracceptance_sdesc,cfg_search_objects.uid AS cfg_search_objects_uid
,cfg_search_objects.sdesc AS cfg_search_objects_sdesc,user_profile.nickname AS user_profile_nickname,wall_message.uid AS wall_message_uid
,wall_message.createddt AS wall_message_createddt,wall_message.content AS wall_message_content,wall_message.mimes_uid AS wall_message_mimes_uid
 from search_content
 JOIN wall_message  on wall_message.uid = search_content.object_uid
 JOIN group_account  on group_account.uid = wall_message.group_account_uid
 JOIN match_group_account_to_group_profile  on match_group_account_to_group_profile.group_account_uid = group_account.uid
 JOIN group_profile  on group_profile.uid = match_group_account_to_group_profile.group_profile_uid
 JOIN match_university_account_to_group_account  on match_university_account_to_group_account.group_account_uid = wall_message.group_account_uid
 JOIN university_account  on university_account.uid = match_university_account_to_group_account.university_account_uid
 JOIN cfg_group_useracceptance  on cfg_group_useracceptance.uid = group_account.cfg_group_useracceptance_uid
 JOIN cfg_search_objects  on cfg_search_objects.uid = search_content.cfg_search_objects_uid
 JOIN user_account  on user_account.uid = wall_message.user_account_uid
 JOIN match_user_account_to_user_profile  on match_user_account_to_user_profile.user_account_uid = user_account.uid
 JOIN user_profile  on  user_profile.uid = match_user_account_to_user_profile.user_profile_uid
 WHERE match(search_content.content) against ('carlos')
 AND group_account.cfg_group_visibility_uid <> (SELECT uid from cfg_group_visibility WHERE sdesc='GROUP_PRIVATE')
 AND search_content.cfg_search_objects_uid = (SELECT uid from cfg_search_objects WHERE sdesc='WALL_MESSAGE')
 AND university_account.uid = '3ac7df02-83ca-11e3-8ccb-6a3ffe3e3965'  
; 
 



-- user_account_uid = 'eca1544e-83ca-11e3-8ccb-6a3ffe3e3965'
-- university_account.uid = '3ac7df02-83ca-11e3-8ccb-6a3ffe3e3965'