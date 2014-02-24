-- List of Users and the Groups the Users belong to
select
user_account.email, user_profile.lname
, group_account.sdesc, group_profile.content
from user_account
join match_user_account_to_user_profile
 on match_user_account_to_user_profile.user_account_uid = user_account.uid
join user_profile
 on match_user_account_to_user_profile.user_profile_uid = user_profile.uid
join match_user_account_to_group_account_to_cfg_user_roles
 on match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = user_account.uid
join group_account
 on group_account.uid = match_user_account_to_group_account_to_cfg_user_roles.group_account_uid
join match_group_account_to_group_profile
 on match_group_account_to_group_profile.group_account_uid = group_account.uid
join group_profile
 on group_profile.uid = match_group_account_to_group_profile.group_profile_uid
-- where user_account.email = 'president.ncsu@guyverdesigns.com'
;

-- List of Universities --> Groups and Walls Notes
select
university_account.sdesc, university_account.emailkey
, university_profile.name, university_profile.city
, group_account.ldesc, group_account.sdesc, group_profile.content
, wall_message.content, user_account.email, user_profile.fname
from university_account
join match_university_account_to_university_profile
 on university_account.uid = match_university_account_to_university_profile.university_account_uid
join university_profile
 on match_university_account_to_university_profile.university_profile_uid = university_profile.uid
join match_university_account_to_group_account
 on university_account.uid = match_university_account_to_group_account.university_account_uid
join group_account
 on group_account.uid = match_university_account_to_group_account.group_account_uid
join match_group_account_to_group_profile
 on match_group_account_to_group_profile.group_account_uid = group_account.uid
join group_profile
 on group_profile.uid = match_group_account_to_group_profile.group_profile_uid
join wall_message
 on wall_message.group_account_uid = group_account.uid
join user_account
 on user_account.uid = wall_message.user_account_uid
join match_user_account_to_user_profile on
 match_user_account_to_user_profile.user_account_uid = user_account.uid
join user_profile on
 match_user_account_to_user_profile.user_profile_uid = user_profile.uid
;

