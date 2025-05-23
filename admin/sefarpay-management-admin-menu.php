<?php
if (!defined('ABSPATH')) exit;

function sefarpay_management_admin_menu()
{
    add_menu_page(
        'Sefarpay Management',          // Titre de la page
        'Sefarpay Management',          // Titre du menu
        'manage_options',               // Capability
        'sefarpay_management',          // Slug du menu
        'sefarpay_management_page_accueil',  // Fonction pour afficher la page d'accueil
        'dashicons-admin-generic',      // Icône du menu
        25                             // Position
    );

    add_submenu_page(
        'sefarpay_management',
        'Utilisateurs',
        'Utilisateurs',
        'manage_options',
        'sefarpay_management_utilisateurs',
        'sefarpay_management_page_utilisateurs'
    );

    add_submenu_page(
        'sefarpay_management',
        'Paiements',
        'Paiements',
        'manage_options',
        'sefarpay_management_paiements',
        'sefarpay_management_page_paiements'
    );
}

add_action('admin_menu', 'sefarpay_management_admin_menu');

// Fonctions pour afficher les pages

function sefarpay_management_page_accueil()
{
    echo '<h1>Bienvenue dans Sefarpay Management</h1>';
    // Tu peux inclure une vue ou du code HTML ici
}

function sefarpay_management_page_utilisateurs()
{
    require_once SEFARPAY_MANAGEMENT_PATH . 'admin/page_utilisateurs.php';
}

function sefarpay_management_page_paiements()
{
    require_once SEFARPAY_MANAGEMENT_PATH . 'admin/page_paiements.php';
}
