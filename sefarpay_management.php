<?php
/*
Plugin Name: Sefarpay Management
Description: Plugin de gestion pour Sefarpay, avec création des tables nécessaires et interface admin.
Version: 1.0
Author: Rachad
*/

if (!defined('ABSPATH')) exit;

define('SEFARPAY_MANAGEMENT_PATH', plugin_dir_path(__FILE__));

// Inclure le fichier qui gère les menus admin depuis le dossier admin
require_once SEFARPAY_MANAGEMENT_PATH . 'admin/sefarpay-management-admin-menu.php';

// Inclure le fichier d'installation pour créer les tables depuis le dossier admin
require_once SEFARPAY_MANAGEMENT_PATH . 'admin/sefarpay-management-install.php';

// Notification à l’activation du plugin
function sefarpay_management_activation_notice()
{
    set_transient('sefarpay_management_activation_notice', true, 5);
}

// Affichage de la notification
function sefarpay_management_admin_notice()
{
    if (get_transient('sefarpay_management_activation_notice')) {
        echo '<div class="notice notice-success is-dismissible"><p>✅ Plugin <strong>Sefarpay Management</strong> activé avec succès.</p></div>';
        delete_transient('sefarpay_management_activation_notice');
    }
}
add_action('admin_notices', 'sefarpay_management_admin_notice');

// Lors de l'activation : créer les tables + notifier
function sefarpay_management_on_activation()
{
    sefarpay_management_create_tables();
    set_transient('sefarpay_management_activation_notice', true, 5);
}
register_activation_hook(__FILE__, 'sefarpay_management_on_activation');

// Fonction utilitaire pour afficher une vue depuis le dossier views
function sefarpay_management_render_view($filename)
{
    $path = SEFARPAY_MANAGEMENT_PATH . 'views/' . $filename;
    if (file_exists($path)) {
        include $path;
    } else {
        echo '<div class="notice notice-error"><p>Vue non trouvée : ' . esc_html($filename) . '</p></div>';
    }
}
