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
    sefarpay_management_render_view('clients.php'); // views/clients.php
}

function sefarpay_management_page_paiements()
{
    sefarpay_management_render_view('paiements.php'); // views/paiements.php
}
