delete from draftedusersafety.logintracking where lid <> 0;
delete from draftedusersafety.match_useraccount_to_openauth where lid <> 0;
delete from draftedusersafety.match_useraccount_to_userprofile where lid <> 0;
delete from draftedusersafety.match_usersafety_useraccount_to_crossappl_site where lid <> 0;
delete from draftedusersafety.openauth where lid <> 0;
delete from draftedusersafety.useraccount where lid <> 0;
delete from draftedusersafety.userprofile where lid <> 0;


delete from draftedcrossappli.activitylog where lid <> 0;
delete from draftedcrossappli.match_site_to_sitealias where lid <> 0;
delete from draftedcrossappli.site where lid <> 0;
delete from draftedcrossappli.sitealias where lid <> 0;
delete from draftedcrossappli.taskcontrollink where lid <> 0;


delete from drafted.battlestage where lid <> 0;
delete from drafted.gameraccount where lid <> 0;
delete from drafted.gamerprofile where lid <> 0;
delete from drafted.groupaccount where lid <> 0;
delete from drafted.groupprofile where lid <> 0;
delete from drafted.match_gameraccount_to_groupaccount_to_gamerrole where lid <> 0;
delete from drafted.match_gameraccount_to_groupaccount_to_object where lid <> 0;
delete from drafted.match_gameraccount_to_object where lid <> 0;
delete from drafted.match_groupaccount_to_groupprofile where lid <> 0;
delete from drafted.match_merchantaccount_to_merchantprofile where lid <> 0;
delete from drafted.match_merchantaccount_to_object where lid <> 0;
delete from drafted.match_useraccount_to_gameraccount_to_gamerprofile where lid <> 0;
delete from drafted.match_useraccount_to_merchantaccount_to_merchantrole where lid <> 0;
delete from drafted.merchantaccount where lid <> 0;
delete from drafted.merchantprofile where lid <> 0;
delete from drafted.object where lid <> 0;