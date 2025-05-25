<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des Paiements</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary-color: #0054a6;
            --primary-light: #1a6bc2;
            --primary-dark: #00407d;
            --secondary-color: #3aa7aa;
            --secondary-light: #4dbdc0;
            --secondary-dark: #2a8a8d;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #343a40;
            --error-color: #e74c3c;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --info-color: #3498db;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Poppins", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: var(--dark-gray);
            line-height: 1.6;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .page-header {
            background: linear-gradient(135deg,
                    var(--primary-color) 0%,
                    var(--primary-light) 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .page-header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: var(--white);
            border-radius: 50% 50% 0 0;
        }

        .page-header h1 {
            color: var(--white);
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 2.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .page-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .page-content {
            padding: 20px 30px 40px;
        }

        /* Filtres et actions */
        .filters-section {
            margin-bottom: 30px;
            padding: 25px;
            border-radius: 15px;
            background-color: var(--light-gray);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }

        .filters-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        .filters-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom,
                    var(--primary-color),
                    var(--secondary-color));
            border-radius: 5px 0 0 5px;
        }

        .section-title {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            position: relative;
        }

        .section-title i {
            margin-right: 12px;
            font-size: 1.3rem;
            background: linear-gradient(135deg,
                    var(--primary-color),
                    var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .filters-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-group {
            flex: 1 1 200px;
            position: relative;
        }

        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-gray);
            font-size: 0.95rem;
        }

        .filter-input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: var(--white);
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 4px rgba(58, 167, 170, 0.15);
        }

        .filter-icon {
            position: absolute;
            left: 15px;
            top: 40px;
            color: #adb5bd;
            transition: color 0.3s;
        }

        .filter-group:focus-within .filter-icon {
            color: var(--primary-color);
        }

        .actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
        }

        .export-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 20px;
            background: linear-gradient(135deg,
                    var(--secondary-color),
                    var(--secondary-light));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(58, 167, 170, 0.2);
            margin-right: 10px;
        }

        .export-btn i {
            margin-right: 8px;
        }

        .export-btn:hover {
            background: linear-gradient(135deg,
                    var(--secondary-dark),
                    var(--secondary-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(58, 167, 170, 0.25);
        }

        .export-btn:active {
            transform: translateY(0);
        }

        .reset-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 20px;
            background-color: #f8f9fa;
            color: var(--dark-gray);
            border: 1px solid #dee2e6;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .reset-btn i {
            margin-right: 8px;
        }

        .reset-btn:hover {
            background-color: #e9ecef;
        }

        /* Tableau des paiements */
        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .payments-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--white);
            font-size: 0.95rem;
        }

        .payments-table th {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 15px;
            text-align: left;
            position: relative;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            white-space: nowrap;
        }

        .payments-table th:hover {
            background-color: var(--primary-dark);
        }

        .payments-table th i {
            margin-left: 5px;
            font-size: 0.8rem;
        }

        .payments-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.3s;
        }

        .payments-table tbody tr {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .payments-table tbody tr:hover {
            background-color: rgba(233, 236, 239, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 1;
        }

        .payments-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* États de paiement */
        .status {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .status i {
            margin-right: 5px;
            font-size: 0.8rem;
        }

        .status-success {
            background-color: rgba(46, 204, 113, 0.15);
            color: var(--success-color);
        }

        .status-error {
            background-color: rgba(231, 76, 60, 0.15);
            color: var(--error-color);
        }

        .status-pending {
            background-color: rgba(243, 156, 18, 0.15);
            color: var(--warning-color);
        }

        .status-info {
            background-color: rgba(52, 152, 219, 0.15);
            color: var(--info-color);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .pagination-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            margin: 0 5px;
            border-radius: 50%;
            background-color: var(--white);
            color: var(--dark-gray);
            border: 1px solid #dee2e6;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .pagination-btn:hover {
            background-color: var(--light-gray);
            border-color: #ced4da;
        }

        .pagination-btn.active {
            background: linear-gradient(135deg,
                    var(--primary-color),
                    var(--primary-light));
            color: var(--white);
            border: none;
            box-shadow: 0 4px 10px rgba(0, 84, 166, 0.2);
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Détails de transaction */
        .transaction-details {
            display: none;
            background-color: var(--light-gray);
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .detail-item {
            margin-bottom: 15px;
        }

        .detail-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .detail-value {
            font-size: 0.95rem;
        }

        .toggle-details {
            background: none;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
            font-size: 1.1rem;
            transition: transform 0.3s;
            display: flex;
            align-items: center;
            padding: 5px;
        }

        .toggle-details:hover {
            color: var(--primary-dark);
        }

        .toggle-details i {
            transition: transform 0.3s;
        }

        .toggle-details.open i {
            transform: rotate(180deg);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .payments-table {
                font-size: 0.85rem;
            }

            .payments-table th,
            .payments-table td {
                padding: 12px 10px;
            }
        }

        @media (max-width: 768px) {
            .container {
                border-radius: 15px;
            }

            .page-header {
                padding: 30px 20px;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .page-content {
                padding: 15px 20px 30px;
            }

            .filters-section {
                padding: 20px;
            }

            .filters-row {
                flex-direction: column;
                gap: 15px;
            }

            .actions-row {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .export-btn,
            .reset-btn {
                margin-right: 0;
                justify-content: center;
            }

            .pagination-btn {
                width: 35px;
                height: 35px;
                margin: 0 3px;
            }
        }

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: var(--dark-gray);
            color: var(--white);
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.85rem;
            font-weight: normal;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .tooltip .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: var(--dark-gray) transparent transparent transparent;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Loader */
        .loader {
            display: none;
            text-align: center;
            padding: 30px;
        }

        .loader i {
            font-size: 2rem;
            color: var(--primary-color);
            animation: spin 1s infinite linear;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Empty state */
        .empty-state {
            display: none;
            text-align: center;
            padding: 50px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #adb5bd;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .empty-state p {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Liste des Paiements</h1>
            <p>
                Consultez et gérez l'historique complet des transactions de paiement
                effectuées via l'API SATIM.
            </p>
        </div>

        <div class="page-content">
            <!-- Filtres et actions -->
            <div class="filters-section">
                <h2 class="section-title"><i class="fas fa-filter"></i>Filtres</h2>
                <div class="filters-row">
                    <div class="filter-group">
                        <label for="status-filter">État du paiement</label>
                        <i class="fas fa-check-circle filter-icon"></i>
                        <select id="status-filter" class="filter-input">
                            <option value="">Tous les états</option>
                            <option value="success">Succès</option>
                            <option value="error">Échec</option>
                            <option value="pending">En attente</option>
                            <option value="refunded">Remboursé</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="date-from">Date de début</label>
                        <i class="fas fa-calendar-alt filter-icon"></i>
                        <input type="date" id="date-from" class="filter-input" />
                    </div>
                    <div class="filter-group">
                        <label for="date-to">Date de fin</label>
                        <i class="fas fa-calendar-alt filter-icon"></i>
                        <input type="date" id="date-to" class="filter-input" />
                    </div>
                    <div class="filter-group">
                        <label for="amount-min">Montant minimum</label>
                        <i class="fas fa-money-bill-wave filter-icon"></i>
                        <input
                            type="number"
                            id="amount-min"
                            class="filter-input"
                            placeholder="0" />
                    </div>
                    <div class="filter-group">
                        <label for="amount-max">Montant maximum</label>
                        <i class="fas fa-money-bill-wave filter-icon"></i>
                        <input
                            type="number"
                            id="amount-max"
                            class="filter-input"
                            placeholder="10000" />
                    </div>
                </div>
                <div class="filters-row">
                    <div class="filter-group">
                        <label for="search">Recherche</label>
                        <i class="fas fa-search filter-icon"></i>
                        <input
                            type="text"
                            id="search"
                            class="filter-input"
                            placeholder="Numéro de commande, ID transaction, nom..." />
                    </div>
                </div>
                <div class="actions-row">
                    <div>
                        <button id="apply-filters" class="export-btn">
                            <i class="fas fa-search"></i> Appliquer les filtres
                        </button>
                        <button id="reset-filters" class="reset-btn">
                            <i class="fas fa-undo"></i> Réinitialiser
                        </button>
                    </div>
                    <div>
                        <button id="export-csv" class="export-btn">
                            <i class="fas fa-file-csv"></i> Exporter CSV
                        </button>
                        <button id="export-excel" class="export-btn">
                            <i class="fas fa-file-excel"></i> Exporter Excel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tableau des paiements -->
            <div class="table-container">
                <table class="payments-table">
                    <thead>
                        <tr>
                            <th data-sort="order">
                                <i class="fas fa-sort"></i> Numéro de commande
                            </th>
                            <th data-sort="user">
                                <i class="fas fa-sort"></i> Utilisateur
                            </th>
                            <th data-sort="transaction">
                                <i class="fas fa-sort"></i> ID Transaction
                            </th>
                            <th data-sort="date"><i class="fas fa-sort"></i> Date</th>
                            <th data-sort="description">
                                <i class="fas fa-sort"></i> Description
                            </th>
                            <th data-sort="amount"><i class="fas fa-sort"></i> Montant</th>
                            <th data-sort="payment">
                                <i class="fas fa-sort"></i> Moyen de paiement
                            </th>
                            <th data-sort="status"><i class="fas fa-sort"></i> État</th>
                            <th data-sort="actions">Actions</th>
                        </tr>
                    </thead>
                    <div id="payments-data">
                      
                     <?php foreach ($paiements as $paiement): ?>
                        <tr data-id="1">
                            <td>
                                <?= esc_html($paiement->order_number) ?>
                            </td>
                            <td>
                                <div class="tooltip">
                                    <?= esc_html($paiement->cardholder_name) ?>
                                    <span class="tooltip-text">ahmed.benali@email.com<br />+213 555 123 456</span>
                                </div>
                            </td>
                            <td> <?= esc_html($paiement->order_number) ?></td>
                            <td>2023-05-15 14:30</td>
                            <td>Achat en ligne - Électronique</td>
                            <td>15,000.00 DZD</td>
                            <td>Carte bancaire</td>
                            <td>
                                <span class="status status-success"><i class="fas fa-check-circle"></i> Succès</span>
                            </td>
                            <td>
                                <button class="toggle-details" data-id="1">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="p-0">
                                <div id="details-1" class="transaction-details">
                                    <div class="details-grid">
                                        <div class="detail-item">
                                            <div class="detail-label">Nom du porteur</div>
                                            <div class="detail-value">Ahmed Benali</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Numéro de carte</div>
                                            <div class="detail-value">XXXX XXXX XXXX 4567</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Système de paiement</div>
                                            <div class="detail-value">Visa</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Score de fraude</div>
                                            <div class="detail-value">0.05 (Faible)</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Adresse IP</div>
                                            <div class="detail-value">41.96.X.X</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Banque du payeur</div>
                                            <div class="detail-value">BNA</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Pays de la banque</div>
                                            <div class="detail-value">Algérie</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Montant approuvé</div>
                                            <div class="detail-value">15,000.00 DZD</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Montant déposé</div>
                                            <div class="detail-value">15,000.00 DZD</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Montant remboursé</div>
                                            <div class="detail-value">0.00 DZD</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">ID du terminal</div>
                                            <div class="detail-value">TERM123456</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Type d'authentification</div>
                                            <div class="detail-value">3D Secure</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- État vide -->
            <div id="empty-state" class="empty-state">
                <i class="fas fa-search"></i>
                <h3>Aucun paiement trouvé</h3>
                <p>
                    Aucun paiement ne correspond à vos critères de recherche. Essayez de
                    modifier vos filtres ou d'effacer votre recherche.
                </p>
            </div>

            <!-- Loader -->
            <div id="loader" class="loader">
                <i class="fas fa-spinner"></i>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="pagination-btn" data-page="prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">4</button>
                <button class="pagination-btn">5</button>
                <button class="pagination-btn" data-page="next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Afficher/masquer les détails de transaction
        document.querySelectorAll(".toggle-details").forEach((button) => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const detailsDiv = document.getElementById(`details-${id}`);

                if (detailsDiv.style.display === "block") {
                    detailsDiv.style.display = "none";
                    this.classList.remove("open");
                } else {
                    // Fermer tous les autres détails ouverts
                    document.querySelectorAll(".transaction-details").forEach((div) => {
                        div.style.display = "none";
                    });
                    document.querySelectorAll(".toggle-details").forEach((btn) => {
                        btn.classList.remove("open");
                    });

                    // Ouvrir les détails actuels
                    detailsDiv.style.display = "block";
                    this.classList.add("open");
                }
            });
        });

        // Tri des colonnes
        document
            .querySelectorAll(".payments-table th[data-sort]")
            .forEach((header) => {
                header.addEventListener("click", function() {
                    const sortBy = this.getAttribute("data-sort");
                    const currentDirection =
                        this.getAttribute("data-direction") || "asc";
                    const newDirection = currentDirection === "asc" ? "desc" : "asc";

                    // Réinitialiser toutes les directions de tri
                    document
                        .querySelectorAll(".payments-table th[data-sort]")
                        .forEach((th) => {
                            th.removeAttribute("data-direction");
                            th.querySelector("i").className = "fas fa-sort";
                        });

                    // Définir la nouvelle direction de tri
                    this.setAttribute("data-direction", newDirection);
                    this.querySelector("i").className =
                        newDirection === "asc" ? "fas fa-sort-up" : "fas fa-sort-down";

                    // Simuler le chargement
                    document.getElementById("loader").style.display = "block";
                    document.querySelector(".table-container").style.opacity = "0.5";

                    // Simuler un délai de tri
                    setTimeout(() => {
                        // Dans un environnement réel, vous trieriez les données ici
                        document.getElementById("loader").style.display = "none";
                        document.querySelector(".table-container").style.opacity = "1";
                    }, 500);
                });
            });

        // Pagination
        document.querySelectorAll(".pagination-btn").forEach((button) => {
            if (!button.hasAttribute("data-page")) {
                button.addEventListener("click", function() {
                    document.querySelectorAll(".pagination-btn").forEach((btn) => {
                        btn.classList.remove("active");
                    });
                    this.classList.add("active");

                    // Simuler le chargement
                    document.getElementById("loader").style.display = "block";
                    document.querySelector(".table-container").style.opacity = "0.5";

                    // Simuler un délai de chargement de page
                    setTimeout(() => {
                        // Dans un environnement réel, vous chargeriez les données de la page ici
                        document.getElementById("loader").style.display = "none";
                        document.querySelector(".table-container").style.opacity = "1";
                    }, 500);
                });
            }
        });

        // Navigation de pagination
        document
            .querySelector('.pagination-btn[data-page="prev"]')
            .addEventListener("click", function() {
                const activePage = document.querySelector(".pagination-btn.active");
                if (
                    activePage.previousElementSibling &&
                    !activePage.previousElementSibling.hasAttribute("data-page")
                ) {
                    activePage.previousElementSibling.click();
                }
            });

        document
            .querySelector('.pagination-btn[data-page="next"]')
            .addEventListener("click", function() {
                const activePage = document.querySelector(".pagination-btn.active");
                if (
                    activePage.nextElementSibling &&
                    !activePage.nextElementSibling.hasAttribute("data-page")
                ) {
                    activePage.nextElementSibling.click();
                }
            });

        // Filtres
        document
            .getElementById("apply-filters")
            .addEventListener("click", function() {
                // Simuler le chargement
                document.getElementById("loader").style.display = "block";
                document.querySelector(".table-container").style.opacity = "0.5";

                // Simuler un délai de filtrage
                setTimeout(() => {
                    // Dans un environnement réel, vous filtreriez les données ici
                    document.getElementById("loader").style.display = "none";
                    document.querySelector(".table-container").style.opacity = "1";

                    // Simuler un résultat vide (pour démonstration)
                    const statusFilter = document.getElementById("status-filter").value;
                    if (statusFilter === "refunded") {
                        document.getElementById("payments-data").style.display = "none";
                        document.getElementById("empty-state").style.display = "block";
                    } else {
                        document.getElementById("payments-data").style.display = "";
                        document.getElementById("empty-state").style.display = "none";
                    }
                }, 800);
            });

        // Réinitialiser les filtres
        document
            .getElementById("reset-filters")
            .addEventListener("click", function() {
                document.getElementById("status-filter").value = "";
                document.getElementById("date-from").value = "";
                document.getElementById("date-to").value = "";
                document.getElementById("amount-min").value = "";
                document.getElementById("amount-max").value = "";
                document.getElementById("search").value = "";

                // Simuler le chargement
                document.getElementById("loader").style.display = "block";
                document.querySelector(".table-container").style.opacity = "0.5";

                // Simuler un délai de réinitialisation
                setTimeout(() => {
                    document.getElementById("loader").style.display = "none";
                    document.querySelector(".table-container").style.opacity = "1";
                    document.getElementById("payments-data").style.display = "";
                    document.getElementById("empty-state").style.display = "none";
                }, 500);
            });

        // Exportation
        document
            .getElementById("export-csv")
            .addEventListener("click", function() {
                alert("Exportation CSV en cours...");
                // Dans un environnement réel, vous généreriez et téléchargeriez un fichier CSV ici
            });

        document
            .getElementById("export-excel")
            .addEventListener("click", function() {
                alert("Exportation Excel en cours...");
                // Dans un environnement réel, vous généreriez et téléchargeriez un fichier Excel ici
            });
    </script>
</body>

</html>