-- DOCUMENTS JOIN
select *
from mimes_standard_meta_document
JOIN mimes_standard_appl_document
 ON mimes_standard_appl_document.uid = mimes_standard_meta_document.appl_table_uid
;

-- IMAGES JOIN
select *
from mimes_standard_meta_image
JOIN mimes_standard_appl_image
 ON mimes_standard_appl_image.uid = mimes_standard_meta_image.appl_table_uid
JOIN mimes_standard_appl_image_scaled
 ON mimes_standard_appl_image_scaled.uid = mimes_standard_meta_image.appl_table_scaled_uid
JOIN mimes_standard_appl_image_thumbnail_100x100
 ON mimes_standard_appl_image_thumbnail_100x100.uid = mimes_standard_meta_image.appl_table_thumbnail_uid
;