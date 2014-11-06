select 
user_account.uid, user_account.email
, user_profile.fname, user_profile.lname
, user_profile.ldesc, user_profile.city
, user_profile.state, user_profile.country
, user_profile.nickname
from user_account
join match_user_account_to_user_profile on
 match_user_account_to_user_profile.user_account_uid = user_account.uid
join user_profile on
 match_user_account_to_user_profile.user_profile_uid = user_profile.uid
;

