USE `seemeuusersafety`;

SELECT * 
FROM match_user 
JOIN useraccount
 ON match_user.useraccount_uid = useraccount.uid
JOIN userprofile
 ON match_user.userprofile_uid = userprofile.uid