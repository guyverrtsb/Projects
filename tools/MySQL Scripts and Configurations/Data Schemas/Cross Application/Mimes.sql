delete from lclcrssapp.mimes where lid <> '0';
delete from lclcrssapp.mimes_image_originals where lid <> '0';
delete from lclcrssapp.mimes_image_thumbnail_100x100 where lid <> '0';
delete from lclcrssapp.mimes_appl_stephen where lid <> '0';

select * from lclcrssapp.mimes;
select * from lclcrssapp.mimes_image_originals;
select * from lclcrssapp.mimes_image_thumbnail_100x100;
select * from lclcrssapp.mimes_appl_stephen;

