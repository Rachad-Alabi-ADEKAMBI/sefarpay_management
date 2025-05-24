<?php
if (!defined('ABSPATH')) exit;

// api.php
require_once SEFARPAY_MANAGEMENT_PATH . 'api.php';

function sefarpay_register_client(array $data)
{
    global $wpdb;
    $table = $wpdb->prefix . 'sefarpay_clients';

    $sanitized_data = [
        'civilite' => sanitize_text_field($data['civilite']),
        'nom' => sanitize_text_field($data['nom']),
        'prenom' => sanitize_text_field($data['prenom']),
        'email' => sanitize_email($data['email']),
        'telephone' => sanitize_text_field($data['telephone']),
        'raison_sociale' => sanitize_text_field($data['raison_sociale']),
        'adresse' => sanitize_textarea_field($data['adresse']),
        'site_web' => sanitize_text_field($data['site_web']),
        'wilaya' => sanitize_text_field($data['wilaya']),
        'commune' => sanitize_text_field($data['commune']),
        'date_debut_activite' => sanitize_text_field($data['date_debut_activite']),
        'type_activite' => sanitize_text_field($data['type_activite']),
        'forme_juridique' => sanitize_text_field($data['forme_juridique']),
        'banque' => sanitize_text_field($data['banque']),
        'email_societe' => sanitize_email($data['email_societe']),
        'telephone_societe' => sanitize_text_field($data['telephone_societe']),
        'numero_registre' => sanitize_text_field($data['numero_registre']),
        'registre_document_url' => esc_url_raw($data['registre_document_url'])
    ];

    $inserted = $wpdb->insert($table, $sanitized_data);

    if ($inserted === false) {
        return new WP_Error(
            'db_insert_error',
            'Erreur lors de l’insertion dans la base de données.',
            ['status' => 500]
        );
    }

    return $wpdb->insert_id;
}

function sefarpay_api_register_client(WP_REST_Request $request)
{
    $data = $request->get_json_params();

    $required_fields = [
        'civilite',
        'nom',
        'prenom',
        'email',
        'telephone',
        'raison_sociale',
        'adresse',
        'site_web',
        'wilaya',
        'commune',
        'date_debut_activite',
        'type_activite',
        'forme_juridique',
        'banque',
        'email_societe',
        'telephone_societe',
        'numero_registre',
        'registre_document_url'
    ];

    $missing_fields = [];
    foreach ($required_fields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            $missing_fields[] = $field;
        }
    }

    if (!empty($missing_fields)) {
        return new WP_REST_Response([
            'error' => 'Champs obligatoires manquants',
            'missing_fields' => $missing_fields
        ], 400);
    }

    $insert_id = sefarpay_register_client($data);

    if (is_wp_error($insert_id)) {
        return new WP_REST_Response([
            'error' => $insert_id->get_error_message()
        ], $insert_id->get_error_data()['status'] ?? 500);
    }

    return new WP_REST_Response([
        'success' => true,
        'client_id' => $insert_id
    ], 201);
}

add_action('rest_api_init', function () {
    register_rest_route('sefarpay_management/v1', '/register', [
        'methods' => 'POST',
        'callback' => 'sefarpay_api_register_client',
        'permission_callback' => '__return_true',
    ]);
});
