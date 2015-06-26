delete from usersafety_userprofile where uid <> 'a';
delete from usersafety_useraccount where uid <> 'a';
delete from match_usersafety_useraccount_to_userprofile where uid <> 'a';
delete from match_usersafety_useraccount_to_site where uid <> 'a';
delete from match_usersafety_useraccount_to_role where uid <> 'a';

delete from usersafety_templink where uid <> 'a';
delete from usersafety_login_tracking where uid <> 'a';

delete from usersafety_site where uid <> 'a';
delete from usersafety_site_alias where uid <> 'a';
delete from match_usersafety_site_to_site_alias where uid <> 'a';
delete from match_usersafety_site_to_role where uid <> 'a';

delete from usersafety_role where uid <> 'a';
