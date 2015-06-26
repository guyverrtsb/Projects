INSERT INTO `gdcorpdb`.`match_usersafety_useraccount_to_role`
(`uid`,`createddt`,`changeddt`,`usersafety_useraccount_uid`,
`usersafety_role_uid`)
VALUES
(
UUID(),NOW(),NOW(),
 (select uid from usersafety_useraccount where email = 'stephen@guyverdesigns.com'),
 (select uid from usersafety_role where sdesc = 'GD_USER')
);

SELECT usersafety_useraccount.email, usersafety_role.sdesc
 FROM usersafety_useraccount
JOIN match_usersafety_useraccount_to_role
 ON match_usersafety_useraccount_to_role.usersafety_useraccount_uid = usersafety_useraccount.uid
JOIN usersafety_role
 ON usersafety_role.uid = match_usersafety_useraccount_to_role.usersafety_role_uid
;

SELECT count(*) as total from usersafety_useraccount
JOIN match_usersafety_useraccount_to_role
 ON match_usersafety_useraccount_to_role.usersafety_useraccount_uid = usersafety_useraccount.uid
JOIN usersafety_role
 ON usersafety_role.uid = match_usersafety_useraccount_to_role.usersafety_role_uid
WHERE usersafety_useraccount.email = 'stephen@guyverdesigns.com'
 AND usersafety_role.sdesc = 'GD_USER'
;
