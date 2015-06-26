select * from draftedcrossappli.taskcontrollink;
select * from draftedcrossappli.configurations;

select *
from draftedcrossappli.site
join draftedcrossappli.match_site_to_sitealias
on draftedcrossappli.site.uid = draftedcrossappli.match_site_to_sitealias.site_uid
join draftedcrossappli.sitealias
on draftedcrossappli.match_site_to_sitealias.sitealias_uid = draftedcrossappli.sitealias.uid
;

select *
from draftedusersafety.useraccount
join draftedusersafety.match_useraccount_to_userprofile
on draftedusersafety.useraccount.uid = draftedusersafety.match_useraccount_to_userprofile.useraccount_uid
join draftedusersafety.userprofile
on draftedusersafety.match_useraccount_to_userprofile.userprofile_uid = draftedusersafety.userprofile.uid
;

select * from drafted.configurations;

select *
from drafted.gameraccount
join drafted.match_useraccount_to_gameraccount_to_gamerprofile
on drafted.gameraccount.uid = drafted.match_useraccount_to_gameraccount_to_gamerprofile.gameraccount_uid
join drafted.gamerprofile
on drafted.match_useraccount_to_gameraccount_to_gamerprofile.gamerprofile_uid = drafted.gamerprofile.uid
;

select *
from drafted.merchantaccount
join drafted.match_merchantaccount_to_merchantprofile
on drafted.merchantaccount.uid = drafted.match_merchantaccount_to_merchantprofile.merchantaccount_uid
join drafted.merchantprofile
on drafted.match_merchantaccount_to_merchantprofile.merchantprofile_uid = drafted.merchantprofile.uid
join drafted.match_useraccount_to_merchantaccount_to_merchantrole
on drafted.merchantaccount.uid = drafted.match_useraccount_to_merchantaccount_to_merchantrole.merchantaccount_uid
;
select *
from drafted.merchantaccount
;
select *
from drafted.merchantprofile
;
select *
from drafted.match_merchantaccount_to_merchantprofile
;
select *
from drafted.match_useraccount_to_merchantaccount_to_merchantrole
;
select *
from drafted.object
;

select * 
from drafted.merchantaccount
join drafted.match_merchantaccount_to_object
on drafted.merchantaccount.uid = drafted.match_merchantaccount_to_object.merchantaccount_uid
join drafted.object
on drafted.match_merchantaccount_to_object.object_uid = drafted.object.uid;

select * 
from drafted.gameraccount
join drafted.match_gameraccount_to_object
on drafted.gameraccount.uid = drafted.match_gameraccount_to_object.gameraccount_uid
join drafted.object
on drafted.match_gameraccount_to_object.object_uid = drafted.object.uid;
