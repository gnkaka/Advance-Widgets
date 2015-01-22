DROP TABLE IF EXISTS whom_i_vieweds;
DELETE FROM core_contents WHERE name = 'myWIVs';
DELETE FROM core_contents WHERE name = 'checkWIVs';
DELETE FROM core_blocks WHERE path_view = 'myWIVs';
DELETE FROM core_blocks WHERE path_view = 'checkWIVs';


DROP TABLE IF EXISTS who_viewed_mes;
DELETE FROM core_contents WHERE name = 'myWVMs';
DELETE FROM core_contents WHERE name = 'checkWVMs';
DELETE FROM core_blocks WHERE path_view = 'myWVMs';
DELETE FROM core_blocks WHERE path_view = 'checkWVMs';
