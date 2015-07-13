SELECT * 
FROM sitealias 
JOIN match_site_to_sitealias
 ON match_site_to_sitealias.sitealias_uid = sitealias.uid 
JOIN site
 ON site.uid = match_site_to_sitealias.site_uid