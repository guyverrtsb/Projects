USE `seemeuapplication`;
-- Get Groups for Entity University
select *
from match_entity_to_university

join match_group
on match_entity_to_university.match_entity_uid = match_group.match_entity_uid
join groupaccount
on match_group.groupaccount_uid = groupaccount.uid
join groupprofile
on match_group.groupprofile_uid = groupprofile.uid
;
-- Get Groups for Entity University
select *
from match_entity_to_university

join match_entity
on match_entity_to_university.match_entity_uid = match_entity.uid
join entityaccount
on match_entity.entityaccount_uid = entityaccount.uid
join entityprofile
on match_entity.entityprofile_uid = entityprofile.uid

join entity_universityaccount
on match_entity_to_university.entity_universityaccount_uid = entity_universityaccount.uid
join entity_universityprofile
on match_entity_to_university.entity_universityprofile_uid = entity_universityprofile.uid

join match_group
on match_entity_to_university.match_entity_uid = match_group.match_entity_uid
join groupaccount
on match_group.groupaccount_uid = groupaccount.uid
join groupprofile
on match_group.groupprofile_uid = groupprofile.uid
;


