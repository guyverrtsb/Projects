DELETE FROM placement_requirement WHERE lid <> 0;
DELETE FROM match_placement_requirement_to_search_word WHERE lid <> 0;

DELETE FROM match_placement_resource_account_to_profile WHERE lid <> 0;
DELETE FROM match_placement_requirement_to_resource_to_cfg_placement_status WHERE lid <> 0;

DELETE FROM placement_resource_account WHERE lid <> 0;
DELETE FROM placement_resource_profile WHERE lid <> 0;
DELETE FROM match_placement_resource_account_to_profile WHERE lid <> 0;

DELETE FROM search_content WHERE lid <> 0;