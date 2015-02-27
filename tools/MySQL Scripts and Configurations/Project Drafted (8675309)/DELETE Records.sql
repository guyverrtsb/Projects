-- DELETE USERS AND GAMERS AND MERCHANTS
delete from draftedusersafety.useraccount where lid <> 0;
delete from draftedusersafety.userprofile where lid <> 0;
delete from draftedusersafety.match_useraccount_to_userprofile where lid <> 0;
delete from draftedusersafety.match_usersafety_useraccount_to_crossappl_site where lid <> 0;

delete from drafted.gameraccount where lid <> 0;
delete from drafted.gamerprofile where lid <> 0;
delete from drafted.match_useraccount_to_gameraccount_to_gamerprofile where lid <> 0;
delete from drafted.match_gameraccount_to_hazard where lid <> 0;
delete from drafted.match_gameraccount_to_place where lid <> 0;
delete from drafted.match_gameraccount_to_shield where lid <> 0;
delete from drafted.match_gameraccount_to_groupaccount_to_hazard where lid <> 0;
delete from drafted.match_gameraccount_to_groupaccount_to_place where lid <> 0;
delete from drafted.match_gameraccount_to_groupaccount_to_shield where lid <> 0;

delete from drafted.groupaccount where lid <> 0;
delete from drafted.groupprofile where lid <> 0;
delete from drafted.match_groupaccount_to_groupprofile where lid <> 0;

delete from drafted.merchantaccount where lid <> 0;
delete from drafted.merchantprofile where lid <> 0;
delete from drafted.match_merchantaccount_to_merchantprofile where lid <> 0;
delete from drafted.match_merchantaccount_to_hazard where lid <> 0;
delete from drafted.match_merchantaccount_to_place where lid <> 0;
delete from drafted.match_merchantaccount_to_shield where lid <> 0;

delete from drafted.hazard where lid <> 0;
delete from drafted.place where lid <> 0;
delete from drafted.shield where lid <> 0;
