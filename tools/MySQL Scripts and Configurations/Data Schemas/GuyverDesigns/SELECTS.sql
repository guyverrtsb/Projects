SELECT * FROM mimes_meta_standard;
SELECT * FROM mimes_appl_standard_document;

SELECT * FROM usersafety_site;
SELECT * FROM usersafety_site_alias;
SELECT * FROM usersafety_useraccount;
SELECT * FROM cfg_defaults;

SELECT * FROM match_placement_requirement_to_resource_to_cfg_placement_status WHERE lid <> 0;
SELECT * FROM match_placement_requirement_to_search_word WHERE lid <> 0;
SELECT * FROM match_placement_resource_account_to_profile WHERE lid <> 0;

SELECT * FROM placement_requirement WHERE lid <> 0;
SELECT * FROM placement_resource_account WHERE lid <> 0;
SELECT * FROM placement_resource_profile WHERE lid <> 0;

SELECT * FROM search_content WHERE lid <> 0;

SELECT * 
FROM placement_resource_account
JOIN match_placement_resource_account_to_profile
 ON match_placement_resource_account_to_profile.placement_resource_account_uid = placement_resource_account.uid
JOIN placement_resource_profile
 ON placement_resource_profile.uid = match_placement_resource_account_to_profile.placement_resource_profile_uid
JOIN match_placement_requirement_to_resource_to_cfg_placement_status
 ON match_placement_requirement_to_resource_to_cfg_placement_status.placement_resource_account_uid = placement_resource_account.uid
;

SELECT * FROM lclguyverdesigns.usersafety_useraccount
;

SELECT * 
FROM placement_resource_account 
JOIN match_placement_resource_account_to_profile
 ON placement_resource_account.uid = match_placement_resource_account_to_profile.placement_resource_account_uid 
JOIN placement_resource_profile
 ON placement_resource_profile.uid = match_placement_resource_account_to_profile.placement_resource_profile_uid
-- WHERE placement_resource_account.uid='09b33cce-3ae0-11e4-89ed-604f6d34bd19' 
;

SELECT *
FROM match_placement_requirement_to_resource_to_cfg_placement_status
JOIN placement_requirement
 ON placement_requirement.uid = match_placement_requirement_to_resource_to_cfg_placement_status.placement_requirement_uid
WHERE match_placement_requirement_to_resource_to_cfg_placement_status.placement_resource_account_uid=
;