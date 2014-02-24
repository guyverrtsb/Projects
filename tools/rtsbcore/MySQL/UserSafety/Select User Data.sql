
UPDATE usersafety_useraccount
SET
active = 'T'
WHERE email='stephen@guyverdesigns.com'
;

UPDATE `gdcorpdb`.`usersafety_useraccount`
SET
`numberoflogintries` = '2'
WHERE email='stephen@guyverdesigns.com'
;

select usersafety_useraccount.email, usersafety_useraccount.uid, usersafety_useraccount.password,
 usersafety_useraccount.numberoflogintries, usersafety_userprofile.firstname,
 usersafety_userprofile.lastname, usersafety_userprofile.nickname,
 usersafety_userprofile.country, usersafety_useraccount.active
from usersafety_useraccount
join match_usersafety_useraccount_to_userprofile on
	match_usersafety_useraccount_to_userprofile.usersafety_useraccount_uid = usersafety_useraccount.uid
join usersafety_userprofile on
	usersafety_userprofile.uid = match_usersafety_useraccount_to_userprofile.usersafety_userprofile_uid
;

SELECT usersafety_useraccount.uid, usersafety_useraccount.email,
 usersafety_userprofile.uid, usersafety_userprofile.firstname,
 usersafety_userprofile.lastname, usersafety_userprofile.nickname 
FROM match_usersafety_useraccount_to_userprofile 
JOIN usersafety_useraccount
 ON match_usersafety_useraccount_to_userprofile.usersafety_useraccount_uid = usersafety_useraccount.uid 
JOIN usersafety_userprofile
 ON match_usersafety_useraccount_to_userprofile.usersafety_userprofile_uid = usersafety_userprofile.uid 
WHERE match_usersafety_useraccount_to_userprofile.usersafety_useraccount_uid='db81ab56-ddfc-11e2-a64c-782bcb46ae4d'
;