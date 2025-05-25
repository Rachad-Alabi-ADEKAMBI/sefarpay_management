<?php
if (!defined('ABSPATH')) exit;

function sefarpay_management_create_tables()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_clients = $wpdb->prefix . 'sefarpay_clients';
    $table_paiements = $wpdb->prefix . 'sefarpay_paiements';

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $sql_clients = "CREATE TABLE $table_clients (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        civilite VARCHAR(10) NOT NULL,
        nom VARCHAR(100) NOT NULL,
        prenom VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        telephone VARCHAR(20) NOT NULL,
        raison_sociale VARCHAR(150) NOT NULL,
        adresse TEXT NOT NULL,
        site_web VARCHAR(150) NOT NULL,
        wilaya VARCHAR(100) NOT NULL,
        commune VARCHAR(100) NOT NULL,
        date_debut_activite DATE NOT NULL,
        type_activite VARCHAR(100) NOT NULL,
        forme_juridique VARCHAR(100) NOT NULL,
        banque VARCHAR(100) NOT NULL,
        email_societe VARCHAR(100) NOT NULL,
        telephone_societe VARCHAR(20) NOT NULL,
        numero_registre VARCHAR(50) NOT NULL,
        registre_document_url VARCHAR(255) NOT NULL,
        statut VARCHAR(20) NOT NULL DEFAULT 'inactif',
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    $sql_paiements = "CREATE TABLE $table_paiements (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    client_id BIGINT(20) UNSIGNED NOT NULL,
    nom_client VARCHAR(100),
    email_client VARCHAR(100),
    telephone_client VARCHAR(20),
    numero_commande VARCHAR(100) NOT NULL,
    transaction_satim_id VARCHAR(100),
    date_paiement DATETIME,
    description TEXT,
    montant_paye DECIMAL(10,2),
    devise VARCHAR(10),
    moyen_paiement VARCHAR(50),
    nom_carte VARCHAR(100),
    pan VARCHAR(50),
    systeme_paiement VARCHAR(50),
    etat_paiement VARCHAR(20),
    score_fraude VARCHAR(20),
    ip_payeur VARCHAR(45),
    banque_payeur VARCHAR(100),
    pays_banque VARCHAR(100),
    code_action VARCHAR(10),
    description_action TEXT,
    code_acceptation VARCHAR(10),
    code_autorisation VARCHAR(50),
    code_reference VARCHAR(100),
    montant_depose DECIMAL(10,2),
    montant_rembourse DECIMAL(10,2),
    montant_approuve DECIMAL(10,2),
    terminal_id VARCHAR(50),
    type_authentification VARCHAR(50),
    return_url VARCHAR(255),
    fail_url VARCHAR(255),
    date_enregistrement DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (client_id) REFERENCES $table_clients(id) ON DELETE CASCADE
) $charset_collate;";


    dbDelta($sql_clients);
    dbDelta($sql_paiements);
}
