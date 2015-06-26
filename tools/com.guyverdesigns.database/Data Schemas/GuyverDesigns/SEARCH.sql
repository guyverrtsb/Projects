SELECT *
FROM search_content
WHERE match(searchable_content) against ('stephen')
GROUP BY owner_table_record_uid
;