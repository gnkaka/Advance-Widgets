CREATE TABLE  `who_viewed_mes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `view_user` int(11) NOT NULL,
  `user_view` int(11) NOT NULL,
  `date_view` datetime NOT NULL,
  `count_view` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `view_user` (`view_user`),
  KEY `user_view` (`user_view`)
) ;


INSERT INTO core_blocks(name, path_view,params,is_active) 
VALUES('Who Viewed Me', 'myWVMs','{"0":{"label":"Title","input":"text","value":"Who Viewed Me","name":"title"},"1":{"label":"plugin","input":"hidden","value":"AdvanceWidget","name":"plugin"},"2":{"label":"Number of item to show","input":"text","value":"10","name":"num_item_show"},"3":{"label":"Title","input":"checkbox","value":"Enable Title","name":"title_enable"}}
',1);

 INSERT INTO core_blocks(name, path_view,params,is_active) 
VALUES('Check Viewed Me', 'checkWVMs','[{"label":"Title","input":"text","value":"Check Viewed Me","name":"title"},{"label":"plugin","input":"hidden","value":"WhoViewedMe","name":"plugin"}]',0);
 

INSERT INTO `core_contents` (`page_id`, `type`, `name`, `component`, `parent_id`, `order`, `params`, `attribs`, `lft`, `rght`, `column`, `core_block_id`, `core_content_count`, `invisible`) VALUES
(1, 'widget', 'checkWVMs', '', 29, 3, '{"title":"Check Viewed Me","plugin":"AdvanceWidget"}', NULL, NULL,NULL, 0, 0, 0, 0);

UPDATE `core_contents` SET   `page_id`=(SELECT `id` FROM `pages` WHERE  `title`='Profile Page')  ,  `core_block_id` =(SELECT ID FROM `core_blocks` WHERE `name`= 'Check Viewed Me' )
 WHERE name='checkWVMs';
 
 
 CREATE TABLE `whom_i_vieweds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `me_id` int(11) NOT NULL,
  `whom_id` int(11) NOT NULL,
  `date_view` datetime NOT NULL,
  `count_view` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `me_id` (`me_id`),
  KEY `whom_id` (`whom_id`)
) ;


INSERT INTO core_blocks(name, path_view,params,is_active) 
VALUES('Whom I Viewed', 'myWIVs','{"0":{"label":"Title","input":"text","value":"Whom I Viewed","name":"title"},"1":{"label":"plugin","input":"hidden","value":"AdvanceWidget","name":"plugin"},"2":{"label":"Number of item to show","input":"text","value":"10","name":"num_item_show"},"3":{"label":"Title","input":"checkbox","value":"Enable Title","name":"title_enable"}}
',1);

INSERT INTO core_blocks(name, path_view,params,is_active) 
VALUES('Check I Viewed', 'checkWIVs','[{"label":"Title","input":"text","value":"Check I Viewed","name":"title"},{"label":"plugin","input":"hidden","value":"WhomIViewed","name":"plugin"}]',0);

 INSERT INTO `core_contents` (`page_id`, `type`, `name`, `component`, `parent_id`, `order`, `params`, `attribs`, `lft`, `rght`, `column`, `core_block_id`, `core_content_count`, `invisible`) VALUES
(1, 'widget', 'checkWIVs', '', 29, 2, '{"title":"Check I Viewed","plugin":"AdvanceWidget"}', NULL, NULL,NULL, 0, 0, 0, 0);

UPDATE `core_contents` SET   `page_id`=(SELECT `id` FROM `pages` WHERE  `title`='Profile Page')  ,  `core_block_id` =(SELECT ID FROM `core_blocks` WHERE `name`= 'Check I Viewed' )
 WHERE name='checkWIVs';
 
 DELETE FROM core_menu_items WHERE name = 'Advance Widget';
