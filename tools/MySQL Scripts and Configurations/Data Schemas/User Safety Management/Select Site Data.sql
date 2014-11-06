select
 usersafety_site.sdesc, usersafety_site.ldesc,
 usersafety_site_alias.sdesc, usersafety_site_alias.ldesc,
 usersafety_role.sdesc
from usersafety_site
join match_usersafety_site_to_site_alias on
 match_usersafety_site_to_site_alias.usersafety_site_uid = usersafety_site.uid
join usersafety_site_alias on
 match_usersafety_site_to_site_alias.usersafety_site_alias_uid = usersafety_site_alias.uid
join match_usersafety_site_to_role on
 usersafety_site.uid = match_usersafety_site_to_role.usersafety_site_uid
join usersafety_role on
 match_usersafety_site_to_role.usersafety_role_uid = usersafety_role.uid
-- where usersafety_site.uid = match_usersafety_site_to_site_alias.usersafety_site_uid
;
