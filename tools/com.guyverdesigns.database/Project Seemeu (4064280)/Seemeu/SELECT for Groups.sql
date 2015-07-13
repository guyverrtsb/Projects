USE seemeuapplication;
-- Get List of Groups for Entity by Group Type
select * from match_group
join groupaccount
on match_group.groupaccount_uid = groupaccount.uid
join groupprofile
on match_group.groupprofile_uid = groupprofile.uid
where match_group.match_entity_uid = 'ab234986-2509-11e5-a0e7-b0a427d6bb28'
and groupaccount.configurations_sdesc_grouptype = 'GROUP_TYPE-ENTITY';
;

-- Get List of Groups Owned
select * from match_group
join groupaccount
on match_group.groupaccount_uid = groupaccount.uid
join groupprofile
on match_group.groupprofile_uid = groupprofile.uid
where match_group.configurations_sdesc_grouprole = 'GROUP_ROLE-OWNER';
;

-- Get List of Groups Member Of
select * from match_group
join groupaccount
on match_group.groupaccount_uid = groupaccount.uid
join groupprofile
on match_group.groupprofile_uid = groupprofile.uid
where match_group.configurations_sdesc_grouprole = 'GROUP_ROLE-USER';
;

SELECT match_group.lid AS match_group_lid,match_group.uid AS match_group_uid,match_group.createddt AS match_group_createddt,match_group.changeddt AS match_group_changeddt,match_group.groupaccount_uid AS match_group_groupaccount_uid,match_group.groupprofile_uid AS match_group_groupprofile_uid,match_group.match_entity_uid AS match_group_match_entity_uid,match_group.match_usersafety_user_uid AS match_group_match_usersafety_user_uid,match_group.configurations_sdesc_grouprole AS match_group_configurations_sdesc_grouprole,groupaccount.lid AS groupaccount_lid,groupaccount.uid AS groupaccount_uid,groupaccount.createddt AS groupaccount_createddt,groupaccount.changeddt AS groupaccount_changeddt,groupaccount.configurations_sdesc_grouptype AS groupaccount_configurations_sdesc_grouptype,groupaccount.configurations_sdesc_groupvisibility AS groupaccount_configurations_sdesc_groupvisibility,groupaccount.configurations_sdesc_groupaccept AS groupaccount_configurations_sdesc_groupaccept,groupaccount.sdesc AS groupaccount_sdesc,groupaccount.ldesc AS groupaccount_ldesc,groupprofile.lid AS groupprofile_lid,groupprofile.uid AS groupprofile_uid,groupprofile.createddt AS groupprofile_createddt,groupprofile.changeddt AS groupprofile_changeddt,groupprofile.ldesc AS groupprofile_ldesc FROM personalization
JOIN match_group
ON personalization.university_active_match_entity_uid = match_group.match_entity_uid
JOIN groupaccount
ON match_group.groupaccount_uid = groupaccount.uid
JOIN groupprofile
ON match_group.groupprofile_uid = groupprofile.uid
WHERE personalization.match_usersafety_user_uid = 'a5d9aca9-2585-11e5-a0e7-b0a427d6bb28'
AND match_group.configurations_sdesc_grouprole = 'GROUP_ROLE-USER'
AND match_group.match_usersafety_user_uid =  'a5d9aca9-2585-11e5-a0e7-b0a427d6bb28'
;

select * from match_group
join groupaccount
on match_group.groupaccount_uid = groupaccount_uid