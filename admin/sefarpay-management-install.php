<?php
if (!defined('ABSPATH')) exit;

function sefarpay_management_create_tables()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    // Exemple : table utilisateurs
    $table_users = $wpdb->prefix . 'sefarpay_management_users';
    $sql_users = "CREATE TABLE $table_users (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_login varchar(60) NOT NULL,
        user_email varchar(100) NOT NULL,
        user_registered datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_users);

    // Autres tables si nécessaire
}
