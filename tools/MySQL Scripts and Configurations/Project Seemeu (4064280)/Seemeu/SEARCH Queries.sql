select
 IF((SELECT uid FROM Z_ncsu_match_user_account_to_group_account_to_cfg_user_roles
 WHERE Z_ncsu_match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = '052ec475-896b-11e3-8e8b-70596f205138'
 AND Z_ncsu_match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = Z_ncsu_group_account.uid) <> '', 'USER_IS_MEMBER', 'USER_IS_NOT_MEMBER')
 AS is_member_of_group
, (SELECT accepted FROM Z_ncsu_group_request_message
 WHERE Z_ncsu_group_request_message.who_sent_user_account_uid = '052ec475-896b-11e3-8e8b-70596f205138'
 AND Z_ncsu_group_request_message.group_account_uid = Z_ncsu_group_account.uid LIMIT 0,1)
 AS has_a_request
, (SELECT user_account.email FROM user_account
 JOIN Z_ncsu_match_user_account_to_group_account_to_cfg_user_roles ON Z_ncsu_match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = user_account.uid
 WHERE Z_ncsu_match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = Z_ncsu_group_account.uid
 AND Z_ncsu_match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_uid = (SELECT uid from cfg_user_roles WHERE sdesc='GROUP_OWNER')) AS owner_of_group_email 
, Z_ncsu_group_profile.content AS group_profile_content,Z_ncsu_group_account.ldesc AS group_account_ldesc,Z_ncsu_group_account.uid AS group_account_uid
,Z_ncsu_group_account.createddt AS group_account_createddt,Z_ncsu_search_content.content AS search_content_content,Z_ncsu_search_content.uid AS search_content_uid
,Z_ncsu_search_content.createddt AS search_content_createddt,cfg_group_useracceptance.uid AS cfg_group_useracceptance_uid
,cfg_group_useracceptance.sdesc AS cfg_group_useracceptance_sdesc,cfg_search_objects.uid AS cfg_search_objects_uid,cfg_search_objects.sdesc AS cfg_search_objects_sdesc
,user_profile.nickname AS user_profile_nickname,Z_ncsu_wall_message.uid AS wall_message_uid,Z_ncsu_wall_message.createddt AS wall_message_createddt
,Z_ncsu_wall_message.content AS wall_message_content,Z_ncsu_wall_message.mimes_uid AS wall_message_mimes_uid from Z_ncsu_search_content
 JOIN Z_ncsu_wall_message  on Z_ncsu_wall_message.uid = Z_ncsu_search_content.object_uid
 JOIN Z_ncsu_group_account  on Z_ncsu_group_account.uid = Z_ncsu_wall_message.group_account_uid
 JOIN Z_ncsu_match_group_account_to_group_profile  on Z_ncsu_match_group_account_to_group_profile.group_account_uid = Z_ncsu_group_account.uid
 JOIN Z_ncsu_group_profile  on Z_ncsu_group_profile.uid = Z_ncsu_match_group_account_to_group_profile.group_profile_uid
 JOIN Z_ncsu_match_university_account_to_group_account  on Z_ncsu_match_university_account_to_group_account.group_account_uid = Z_ncsu_wall_message.group_account_uid
 JOIN university_account  on university_account.uid = Z_ncsu_match_university_account_to_group_account.university_account_uid
 JOIN cfg_group_useracceptance  on cfg_group_useracceptance.uid = Z_ncsu_group_account.cfg_group_useracceptance_uid
 JOIN cfg_search_objects  on cfg_search_objects.uid = Z_ncsu_search_content.cfg_search_objects_uid
 JOIN user_account  on user_account.uid = Z_ncsu_wall_message.user_account_uid
 JOIN match_user_account_to_user_profile  on match_user_account_to_user_profile.user_account_uid = user_account.uid
 JOIN user_profile  on  user_profile.uid = match_user_account_to_user_profile.user_profile_uid 
WHERE match(Z_ncsu_search_content.content) against ('tiffany') 
AND Z_ncsu_group_account.cfg_group_visibility_uid <> (SELECT uid from cfg_group_visibility WHERE sdesc='GROUP_PRIVATE') 
AND Z_ncsu_search_content.cfg_search_objects_uid = (SELECT uid from cfg_search_objects WHERE sdesc='WALL_MESSAGE') 
AND university_account.uid = '20ddde12-8968-11e3-8e8b-70596f205138'  
;
