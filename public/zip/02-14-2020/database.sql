ALTER TABLE `manage_role` ADD `reviews_view` TINYINT(1) NOT NULL DEFAULT '0' AFTER `edit_management`,
 ADD `reviews_update` TINYINT(1) NOT NULL DEFAULT '0' AFTER `reviews_view`;
 
 UPDATE `manage_role` SET `reviews_view`=1,`reviews_update`=1 WHERE `user_types_id` = 1
