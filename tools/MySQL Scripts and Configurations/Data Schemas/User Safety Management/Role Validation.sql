-- Using Site and Role SDESC determine if 
SELECT usersafety_role.priority
FROM usersafety_role
JOIN match_usersafety_useraccount_to_role
 on match_usersafety_useraccount_to_role.usersafety_role_uid = usersafety_role.uid
JOIN usersafety_useraccount
 on usersafety_useraccount.uid = match_usersafety_useraccount_to_role.usersafety_useraccount_uid
WHERE usersafety_useraccount.email = 'stephen@guyverdesigns.com'
;

SELECT priority
FROM usersafety_role
WHERE sdesc = 'GD_ADMIN'
;