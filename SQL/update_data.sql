# UPDATE NEW COLUMNS FROM VERSION 1.5.6.4 TO VERSION 2.0.3.1
UPDATE `oc_category_description` SET `meta_title` = `name`;
UPDATE `oc_information_description` SET `meta_title` = `name`;
UPDATE `oc_product_description` SET `meta_title` = `name`;
UPDATE `oc_setting` SET `key` = 'config_meta_title' WHERE `key` = 'config_title';
DELETE FROM `oc_setting` WHERE `key` = 'config_api_id';
INSERT INTO `oc_setting` SET `code` = 'config', `key` = 'config_api_id', `value` = '1', `serialized` = '0';
DELETE FROM `oc_setting` WHERE `key` = 'config_processing_status';
INSERT INTO `oc_setting` SET `code` = 'config', `key` = 'config_processing_status', `value` = 'a:1:{i:0;s:1:"2";}', `serialized` = '1';
DELETE FROM `oc_setting` WHERE `key` = 'config_complete_status';
INSERT INTO `oc_setting` SET `code` = 'config', `key` = 'config_complete_status', `value` = 'a:1:{i:0;s:1:"5";}', `serialized` = '1';
UPDATE `oc_setting` SET `key` = 'config_product_limit' WHERE `key` = 'config_catalog_limit';
UPDATE `oc_setting` SET `key` = 'config_limit_admin' WHERE `key` = 'config_admin_limit';
DELETE FROM `oc_setting` WHERE `key` = 'config_image_location_height';
INSERT INTO `oc_setting` SET `code` = 'config', `key` = 'config_image_location_width', `value` = '268', `serialized` = '0';
DELETE FROM `oc_setting` WHERE `key` = 'config_image_location_width';
INSERT INTO `oc_setting` SET `code` = 'config', `key` = 'config_image_location_width', `value` = '268', `serialized` = '0';
DELETE FROM `oc_setting` WHERE `key` = 'config_product_limit';
INSERT INTO `oc_setting` SET `code` = 'config', `key` = 'config_product_limit', `value` = '15', `serialized` = '0';
DELETE FROM `oc_setting` WHERE `key` = 'config_product_description_length';
INSERT INTO `oc_setting` SET `code` = 'config', `key` = 'config_product_description_length', `value` = '20', `serialized` = '0';
