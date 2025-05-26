<?php
/*
Plugin Name: Sefarpay Management
Description: Plugin de gestion pour Sefarpay, avec création des tables nécessaires et interface admin.
Version: 1.0
Author: Rachad
*/

if (!defined('ABSPATH')) exit;

define('SEFARPAY_MANAGEMENT_PATH', plugin_dir_path(__FILE__));

// Inclure les fichiers nécessaires
require_once SEFARPAY_MANAGEMENT_PATH . 'admin/sefarpay-management-admin-menu.php';
require_once SEFARPAY_MANAGEMENT_PATH . 'admin/sefarpay-management-install.php';
require_once SEFARPAY_MANAGEMENT_PATH . 'api.php';  // <-- Ajout ici


// Notification à l’activation
function sefarpay_management_activation_notice()
{
    set_transient('sefarpay_management_activation_notice', true, 5);
}

// Affichage de la notification admin
function sefarpay_management_admin_notice()
{
    if (get_transient('sefarpay_management_activation_notice')) {
        echo '<div class="notice notice-success is-dismissible"><p>✅ Vous avez activé le plugin <strong>Sefarpay Management</strong>.</p></div>';
        delete_transient('sefarpay_management_activation_notice');
    }
}
add_action('admin_notices', 'sefarpay_management_admin_notice');

// Fonction d’activation : création des tables + notification
function sefarpay_management_on_activation()
{
    sefarpay_management_create_tables(); // Défini dans install.php
    set_transient('sefarpay_management_activation_notice', true, 5);
}
register_activation_hook(__FILE__, 'sefarpay_management_on_activation');
// Fonction pour inclure une vue depuis /views avec passage de variables
function sefarpay_management_render_view($filename, $data = [])
{
    $path = SEFARPAY_MANAGEMENT_PATH . 'views/' . $filename;

    if (file_exists($path)) {
        extract($data); // rend les clés du tableau disponibles comme variables
        include $path;
    } else {
        echo '<div class="notice notice-error"><p>Vue non trouvée : ' . esc_html($filename) . '</p></div>';
    }
}
