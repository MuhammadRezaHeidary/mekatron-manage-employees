<?php

if(!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

global $wpdb;

// table name
$mme_table_dbname = $wpdb->prefix.'mme_employees';

$wpdb->query("DROP TABLE IF EXISTS $mme_table_dbname");