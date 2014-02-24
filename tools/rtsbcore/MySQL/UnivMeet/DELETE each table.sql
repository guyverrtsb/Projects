-- Activity Log
DELETE FROM core_activity_log WHERE uid <> "a";
DELETE FROM geolocation WHERE uid <> "a";

DELETE FROM group_account WHERE uid <> "a";
DELETE FROM group_profile WHERE uid <> "a";
DELETE FROM match_group_account_to_group_profile WHERE uid <> "a";

DELETE FROM match_university_account_to_group_account WHERE uid <> "a";
DELETE FROM match_university_account_to_university_profile WHERE uid <> "a";
DELETE FROM match_university_account_to_user_account_to_cfg_user_roles WHERE uid <> "a";

DELETE FROM match_user_account_to_group_account_to_cfg_user_roles WHERE uid <> "a";
DELETE FROM match_user_account_to_user_profile WHERE uid <> "a";

DELETE FROM message_status WHERE uid <> "a";

DELETE FROM university_account WHERE uid <> "a";
DELETE FROM university_profile WHERE uid <> "a";

DELETE FROM user_account WHERE uid <> "a";
DELETE FROM user_profile WHERE uid <> "a";

-- Activity Log
DELETE FROM search_content WHERE uid <> "a";
DELETE FROM search_keywords WHERE uid <> "a";

DELETE FROM wall_message WHERE uid <> "a";
DELETE FROM wall_message_comment WHERE uid <> "a";

-- Mimes
DELETE from lclcrssapp.mimes WHERE uid <> "a";
DELETE from lclcrssapp.mimes_image_originals WHERE uid <> "a";
DELETE from lclcrssapp.mimes_image_thumbnail_100x100 WHERE uid <> "a";
DELETE from lclcrssapp.mimes_appl_stephen WHERE uid <> "a";
