<?php
if (!defined('ABSPATH')) exit;

function sefarpay_management_admin_menu()
{
    // Menu principal + sous-menu "Accueil"
    add_menu_page(
        'Sefarpay Management',               // Titre de la page
        'Sefarpay Management',               // Titre du menu
        'manage_options',                    // Capability
        'sefarpay_management',               // Slug
        'sefarpay_management_page_accueil',  // Callback
        'dashicons-admin-generic',           // Icône
        25                                   // Position
    );

    // Sous-menu "Clients"
    add_submenu_page(
        'sefarpay_management',               // Parent slug
        'Clients',                           // Titre de la page
        'Clients',                           // Titre du sous-menu
        'manage_options',                    // Capability
        'sefarpay_management_clients',       // Slug
        'sefarpay_management_page_clients'   // Callback
    );

    // Sous-menu "Paiements"
    add_submenu_page(
        'sefarpay_management',               // Parent slug
        'Paiements',                         // Titre de la page
        'Paiements',                         // Titre du sous-menu
        'manage_options',                    // Capability
        'sefarpay_management_paiements',     // Slug
        'sefarpay_management_page_paiements' // Callback
    );
}

add_action('admin_menu', 'sefarpay_management_admin_menu');

// Fonctions de rappel pour afficher les vues

function sefarpay_management_page_accueil()
{

    sefarpay_management_render_view('accueil.php'); // views/accueil.php
}

function sefarpay_management_page_clients()
{
    global $wpdb;
    $table_clients = $wpdb->prefix . 'sefarpay_clients';

    // Récupération des clients
    $clients = $wpdb->get_results("SELECT * FROM $table_clients");

    // Passage à la vue
    sefarpay_management_render_view('clients.php', ['clients' => $clients]);
}


function sefarpay_management_page_paiements()
{
    global $wpdb;
    $table_paiements = $wpdb->prefix . 'sefarpay_paiements';

    // Récupération des clients
    $paiements = $wpdb->get_results("SELECT * FROM $table_paiements");

    sefarpay_management_render_view('paiements.php', ['paiements' => $paiements]); // views/paiements.php
}
