SELECT 
group_account.uid, group_account.ldesc, 
group_account.cfg_group_type_uid, group_account.cfg_group_visibility_uid, 
group_account.cfg_group_useracceptance_uid, 
group_profile.validtodate, group_profile.content 
FROM group_account 
JOIN match_group_account_to_group_profile
 on match_group_account_to_group_profile.group_account_uid = group_account.uid 
JOIN group_profile
 on match_group_account_to_group_profile.group_profile_uid = group_profile.uid 
WHERE group_account.uid='f89af014-7d6d-11e2-9800-5c260a41548e'
;

select 
university_account.uid, university_account.sdesc
, university_account.emailkey , group_account.uid
, group_account.ldesc , group_profile.uid
, group_profile.content, group_profile.validtodate 
, cfg_group_type.sdesc, cfg_group_useracceptance.sdesc
, cfg_group_visibility.sdesc 
from match_university_account_to_group_account 
join university_account 
 on university_account.uid = match_university_account_to_group_account.university_account_uid 
join group_account 
 on match_university_account_to_group_account.group_account_uid = group_account.uid 
join cfg_group_type 
 on group_account.cfg_group_type_uid = cfg_group_type.uid 
join cfg_group_useracceptance 
 on group_account.cfg_group_useracceptance_uid = cfg_group_useracceptance.uid 
join cfg_group_visibility 
 on group_account.cfg_group_visibility_uid = cfg_group_visibility.uid 
join match_group_account_to_group_profile 
 on match_group_account_to_group_profile.group_account_uid = group_account.uid 
join group_profile 
 on group_profile.uid = match_group_account_to_group_profile.group_profile_uid 
where cfg_group_type.sdesc = 'GT_UNIVERSITY' 
AND cfg_group_useracceptance.sdesc = 'AUTO_ACCEPT' 
AND cfg_group_visibility.sdesc = 'UNIV_PUBLIC' 
AND university_account.uid = 'e38b3b69-749a-11e2-92fb-5c260a41548e' 