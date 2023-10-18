<?php

/*
Plugin Name: Mekatron Manage Employees
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Manage Employees
Version: 1.0
Author: Muhammmad Reza Heidary
Author URI: https://mekatronik.ir/
License: MIT
*/

defined('ABSPATH') || exit;

define('MEKATRON_MANAGE_EMPLOYEES_ASSETS_URL', plugin_dir_url(__FILE__).'assets/');
define('MEKATRON_MANAGE_EMPLOYEES_VIEW_PATH', plugin_dir_path(__FILE__).'view/');
define('MEKATRON_MANAGE_EMPLOYEES_ADMIN_PATH', plugin_dir_path(__FILE__).'admin/');
const MEKATRON_MANAGE_EMPLOYEES_CSS_URL = MEKATRON_MANAGE_EMPLOYEES_ASSETS_URL . 'css/';
const MEKATRON_MANAGE_EMPLOYEES_JS_URL = MEKATRON_MANAGE_EMPLOYEES_ASSETS_URL . 'js/';
const MEKATRON_MANAGE_EMPLOYEES_IMAGES_URL = MEKATRON_MANAGE_EMPLOYEES_ASSETS_URL . 'images/';
const MEKATRON_MANAGE_EMPLOYEES_FONTS_URL = MEKATRON_MANAGE_EMPLOYEES_ASSETS_URL . 'fonts/';

if(is_admin()) {
    include (MEKATRON_MANAGE_EMPLOYEES_ADMIN_PATH.'menus.php');
}

register_activation_hook(__FILE__, 'mme_install');

function mme_install() {

    global $wpdb;

    // table name
    $table_dbname = $wpdb->prefix.'mme_employees';

    // COLLATE=utf8mb4_unicode_ci
    $table_dbcollation = $wpdb->collate;

    // SQL Script
    $sql = "
        CREATE TABLE `$table_dbname` (
          `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
          `Fname` varchar(50) NOT NULL,
          `Lname` varchar(50) NOT NULL,
          `BirthDate` date DEFAULT NULL,
          `Avatar` varchar(250) NOT NULL,
          `Weight` float NOT NULL,
          `Mission` smallint(5) unsigned NOT NULL,
          `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
          PRIMARY KEY (`ID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=$table_dbcollation COMMENT='Table for employees information'
    ";
//    $wpdb->query($sql);
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql, true);

}










