select university_account.sdesc, university_account.emailkey, university_account.UID
, university_account.geolocation, university_profile.city
, university_profile.state, university_profile.country
, university_profile.foundeddate, university_profile.content
, university_profile.name
from university_account
join match_university_account_to_university_profile on
 match_university_account_to_university_profile.university_account_uid =
 university_account.uid
join university_profile on
 match_university_account_to_university_profile.university_profile_uid =
 university_profile.uid;

