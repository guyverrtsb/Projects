SELECT 
wall_message.uid, wall_message.user_account_uid 
, wall_message.group_account_uid, wall_message.content 
, user_account.uid, user_profile.nickname, user_profile.fname 
, wall_message.createddt, user_profile.lname, user_account.email 
, wall_message.mimes_uid, count(wall_message_comment.uid)
from wall_message 
join match_user_account_to_user_profile 
 on match_user_account_to_user_profile.user_account_uid = wall_message.user_account_uid 
join user_account 
 on user_account.uid = match_user_account_to_user_profile.user_account_uid 
join user_profile 
 on user_profile.uid = match_user_account_to_user_profile.user_profile_uid
join wall_message_comment 
 on wall_message_comment.wall_message_uid = wall_message.uid
WHERE wall_message.group_account_uid = 'ef9d8d4b-7718-11e2-b098-5c260a41548e' 
AND wall_message.createddt BETWEEN TIMESTAMPADD(year, -10, NOW()) AND NOW() 
ORDER BY wall_message.createddt DESC LIMIT 0,10
;

SELECT 
wall_message_comment.uid, wall_message_comment.user_account_uid 
, wall_message_comment.group_account_uid, wall_message_comment.content 
, user_account.uid, user_profile.nickname, user_profile.fname 
, wall_message.createddt, user_profile.lname, user_account.email 
from wall_message_comment 
join wall_message 
 on wall_message_comment.wall_message_uid = wall_message.uid
join match_user_account_to_user_profile 
 on match_user_account_to_user_profile.user_account_uid = wall_message.user_account_uid 
join user_account 
 on user_account.uid = match_user_account_to_user_profile.user_account_uid 
join user_profile 
 on user_profile.uid = match_user_account_to_user_profile.user_profile_uid 
WHERE wall_message_comment.wall_message_uid = 'f00fcb46-7718-11e2-b098-5c260a41548e' 
ORDER BY wall_message.createddt
;
