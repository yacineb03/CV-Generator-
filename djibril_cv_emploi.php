<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Djibril Maillet — CV Emploi & Candidatures Ciblées</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f1f5f9;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #1e293b;
        }
        .hero-banner {
            background: linear-gradient(135deg, #1c354d 0%, #0f1f2e 100%);
            color: #ffffff;
            padding: 40px 25px;
            border-radius: 16px;
            margin-bottom: 35px;
            box-shadow: 0 10px 25px -5px rgba(28, 53, 77, 0.35);
            border-bottom: 4px solid #00bfa5;
        }
        .avatar-djibril {
            width: 105px;
            height: 105px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #00bfa5;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        .cv-card {
            border: none;
            border-radius: 12px;
            transition: all 0.25s ease-in-out;
            background: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
        }
        .cv-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .card-accent-bar {
            height: 5px;
            width: 100%;
        }
        .badge-contract {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 5px 10px;
            border-radius: 6px;
            letter-spacing: 0.3px;
        }
        .btn-download {
            font-weight: 600;
            border-radius: 8px;
            padding: 9px 14px;
            transition: all 0.2s;
            background-color: #1c354d;
            border-color: #1c354d;
            color: #ffffff;
        }
        .btn-download:hover {
            background-color: #00bfa5;
            border-color: #00bfa5;
            color: #ffffff;
        }
        .filter-btn {
            border-radius: 20px;
            font-weight: 600;
            padding: 6px 16px;
            font-size: 0.9rem;
        }
        .search-box {
            border-radius: 10px;
            padding: 12px 18px;
            font-size: 0.95rem;
            border: 1px solid #cbd5e1;
        }
        .info-pill {
            background-color: rgba(255, 255, 255, 0.12);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
            margin: 3px 2px;
        }
    </style>
</head>
<body>

    <div class="container py-4">
        
        <!-- EN-TÊTE PRINCIPAL DJIBRIL -->
        <div class="hero-banner">
            <div class="row align-items-center">
                <div class="col-auto mb-3 mb-md-0">
                    <img src="profil_djibril.jpg" alt="Djibril Maillet" class="avatar-djibril" onerror="this.src='https://www.svgrepo.com/show/447833/user-profile.svg'">
                </div>
                <div class="col-lg-7">
                    <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: #00bfa5; color: #0f1f2e;">
                        Espace Recrutement &bull; Djibril Maillet
                    </span>
                    <h1 class="display-6 fw-bold mb-2">🧑‍🤝‍🧑 Djibril Maillet — CV Emploi</h1>
                    <p class="text-slate-300 lead mb-3 fs-6" style="color: #cbd5e1;">
                        <strong>14 CVs sur-mesure</strong> au design 2 colonnes avec sidebar navy, <strong>garantis 1 page A4</strong>. Profil étudiant valorisé (L1 Droit, Bac 2025), mobile véhiculé, et <strong>zéro adresse postale</strong> pour postuler partout en toute crédibilité.
                    </p>
                    <div>
                        <span class="info-pill"><i class="bi bi-geo-alt"></i> Marseille (13005) &bull; France</span>
                        <span class="info-pill"><i class="bi bi-telephone"></i> +33 6 56 82 85 67</span>
                        <span class="info-pill"><i class="bi bi-envelope"></i> jeandjdj13@gmail.com</span>
                        <span class="info-pill text-warning"><i class="bi bi-car-front-fill"></i> Permis B + Véhicule</span>
                        <span class="info-pill text-info"><i class="bi bi-mortarboard-fill"></i> L1 Droit Marseille Canebière</span>
                    </div>
                </div>
                <div class="col-lg-3 text-lg-end mt-4 mt-lg-0">
                    <a href="index.php" class="btn btn-outline-light btn-sm px-3 py-2 fw-bold mb-2 w-100">
                        <i class="bi bi-arrow-left"></i> Hub Principal
                    </a>
                    <a href="cv_emploi.php" class="btn btn-outline-info btn-sm px-3 py-2 fw-bold w-100">
                        <i class="bi bi-person-badge"></i> Espace CV Yacine Benbrik
                    </a>
                </div>
            </div>
        </div>

        <!-- RECHERCHE ET FILTRES -->
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-5">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchInput" class="form-control search-box border-start-0" placeholder="Rechercher une enseigne, un poste, un contrat (ex: CDD, Quick, 20h)...">
                </div>
            </div>
            <div class="col-md-7 text-md-end">
                <div class="d-flex flex-wrap gap-1 justify-content-md-end" id="filterContainer">
                    <button class="btn btn-primary filter-btn active" data-filter="all">Tous (14)</button>
                    <button class="btn btn-outline-secondary filter-btn" data-filter="resto">🍔 Restauration Rapide</button>
                    <button class="btn btn-outline-secondary filter-btn" data-filter="vente">🛍️ Mode &amp; Vente</button>
                    <button class="btn btn-outline-secondary filter-btn" data-filter="distrib">🛒 Grande Distribution</button>
                    <button class="btn btn-outline-secondary filter-btn" data-filter="logbtp">📦 Logistique &amp; BTP</button>
                </div>
            </div>
        </div>

        <!-- GRILLE DES 14 CVS DJIBRIL -->
        <div class="row g-4" id="cvGrid">

            <!-- 1. QUICK -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="resto" data-keywords="quick contrat 12h 24h 12h/24h burger fast food restauration rapide caisse equipier">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #dc2626;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-danger badge-contract">CONTRAT 12H / 24H</span>
                            <span class="badge bg-light text-dark border">Restauration Rapide</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Quick</h4>
                        <div class="text-muted small fw-semibold mb-3">Équipier Polyvalent (Contrat 12h/24h)</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Accueil client, service comptoir/borne, cuisson minute &amp; frites, respect rigoureux HACCP et rushs rythmés.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_quick.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_quick.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. G-LA DALLE -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="resto" data-keywords="g la dalle g-la dalle burger fast food smash restauration rapide equipier emporte uber">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #ea580c;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #ea580c;">G-LA DALLE</span>
                            <span class="badge bg-light text-dark border">Fast-Food Burger</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">G-La Dalle</h4>
                        <div class="text-muted small fw-semibold mb-3">Équipier Polyvalent de Restauration</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Assemblage cadencé burgers, cuisson grill, préparation des sacs Uber Eats/Deliveroo et propreté de la cuisine.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_g_la_dalle.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_g_la_dalle.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. ACTION -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="distrib" data-keywords="action cdd 12h 24h 12h-24h employe polyvalent magasin caisse rayon deballage discounter">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0284c7;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-primary badge-contract">CDD 12H - 24H</span>
                            <span class="badge bg-light text-dark border">Discounter / Bazar</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Action</h4>
                        <div class="text-muted small fw-semibold mb-3">Employé Polyvalent de Magasin</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Déballage rapide de cartons, facing impeccable des rayons, encaissement rapide et orientation client dynamique.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_action.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_action.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. PRÉPARATEUR DE COMMANDE -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="logbtp" data-keywords="preparateur de commande logistique entrepot picking scan caces transpalette colisage expedition">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #10b981;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-success badge-contract">LOGISTIQUE / ENTREPÔT</span>
                            <span class="badge bg-light text-dark border">Picking &amp; Expédition</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Préparateur de Commande</h4>
                        <div class="text-muted small fw-semibold mb-3">Opérateur Logistique &bull; Picking &amp; Scan</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Prélèvement guidé par pistolet scanner/RF, constitution de palettes stables, filmage et zéros erreurs de référence.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_preparateur_commande.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_preparateur_commande.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. PLAQUISTE -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="logbtp" data-keywords="plaquiste btp plaquiste platre placo ba13 rails montants joints finition chantier">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #d97706;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #d97706;">SECOND ŒUVRE BTP</span>
                            <span class="badge bg-light text-dark border">Chantier &amp; Rénovation</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Plaquiste &bull; Plâtrerie</h4>
                        <div class="text-muted small fw-semibold mb-3">Poseur Placo, Cloisons &amp; Isolants</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Pose d'ossatures métalliques, fixation de plaques BA13, intégration d'isolants laine de verre et bandes à joint.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_plaquiste.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_plaquiste.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. AGENT D'EXPLOITATION POLYVALENT -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="logbtp" data-keywords="agent exploitation polyvalent logistique quai reception transit plateforme expedition fret">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #6366f1;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #6366f1;">LOGISTIQUE GLOBALE</span>
                            <span class="badge bg-light text-dark border">Quai &amp; Plateforme</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Agent d'Exploitation Polyvalent</h4>
                        <div class="text-muted small fw-semibold mb-3">Opérations Quai, Transit &amp; Dispatch</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Déchargement et contrôle des bons de livraison, tri et dispatching colis sur hub logistique, gestion des flux.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_agent_exploitation.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_agent_exploitation.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 7. CLAIRE'S -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="claire's claires vendeur vendeuse accessoires bijoux mode conseil caisse retail">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #ec4899;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #ec4899;">MODE &amp; ACCESSOIRES</span>
                            <span class="badge bg-light text-dark border">Vente Conseil</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Claire's</h4>
                        <div class="text-muted small fw-semibold mb-3">Conseiller de Vente &bull; Accessoires &amp; Bijoux</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Accueil chaleureux, conseil personnalisé, encaissement en caisse tactile, fidélisation et merchandising des présentoirs.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_claires.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_claires.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 8. IKKS MEN -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="ikks men ikks conseiller de vente cdd 20h pret a porter haut de gamme homme stylisme">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #334155;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-dark badge-contract">CDD 20H</span>
                            <span class="badge bg-light text-dark border">Prêt-à-Porter Masculin</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">IKKS Men</h4>
                        <div class="text-muted small fw-semibold mb-3">Conseiller de Vente (CDD 20h)</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Conseil stylistique personnalisé, argumentation pièces haut de gamme, tenue élégante du magasin et fidélisation clientèle.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_ikks_men.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_ikks_men.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 9. JULES -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="jules vendeur cdd 15h 24h 15h-24h mode masculine pret a porter pliage merchandising caisse">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #2563eb;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-primary badge-contract">CDD 15H - 24H</span>
                            <span class="badge bg-light text-dark border">Mode Masculine</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Jules</h4>
                        <div class="text-muted small fw-semibold mb-3">Conseiller de Vente (CDD 15h-24h)</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Accueil souriant, association de silhouettes, gestion active des cabines, pliage soigné et encaissements rapides.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_jules.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_jules.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 10. LA CASA DE LAS CARCASAS -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="la casa de las carcasas casa carcasas vendeur cdd 15h coques smartphones pose verre trempe accessoires">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #f59e0b;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-dark" style="background-color: #f59e0b;">CDD 15H</span>
                            <span class="badge bg-light text-dark border">Accessoires High-Tech</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">La Casa de las Carcasas</h4>
                        <div class="text-muted small fw-semibold mb-3">Vendeur Conseil (CDD 15h)</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Pose minutieuse de protections d'écran en verre trempé, approche proactive en galerie marchande, ventes complémentaires.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_casa_carcasas.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_casa_carcasas.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 11. PULL & BEAR -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="pull and bear pull & bear cdd 24h inditex streetwear mode jeune cabines reassort">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0f172a;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-dark badge-contract">CDD 24H</span>
                            <span class="badge bg-light text-dark border">Groupe Inditex</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Pull &amp; Bear</h4>
                        <div class="text-muted small fw-semibold mb-3">Conseiller de Vente &bull; Mode Urbaine (CDD 24h)</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Merchandising dynamique, réassort cadencé des rayons, orientation cabines d'essayage, encaissement en caisses rapides.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_pull_and_bear.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_pull_and_bear.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 12. INTERSPORT -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="intersport vendeur textile cdd 12 24h 12h/24h sport running sportswear conseil rayon">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #059669;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-success badge-contract">CDD 12H / 24H</span>
                            <span class="badge bg-light text-dark border">Textile Sport</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Intersport</h4>
                        <div class="text-muted small fw-semibold mb-3">Vendeur Conseil Rayon Textile (CDD 12/24h)</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Conseil sur textiles techniques, réassort et facing des marques majeures, tenue des cabines, encaissement et fidélité.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_intersport.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_intersport.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 13. LIDL -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="distrib" data-keywords="lidl cdi 18h 24h 18h24h 18h-24h equipier polyvalent caisse mise en rayon supermarche cadence haccp">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0284c7;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-primary badge-contract">CDI 18H - 24H</span>
                            <span class="badge bg-light text-dark border">Supermarché</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Lidl</h4>
                        <div class="text-muted small fw-semibold mb-3">Équipier Polyvalent de Magasin (CDI 18h-24h)</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Cadence soutenue en caisse, dépotage matinal palettes, respect de la chaîne du froid, contrôle DLC et propreté exemplaire.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_lidl.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_lidl.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 14. LEROY MERLIN -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="logbtp" data-keywords="leroy merlin le roy merlan nuit 20h 23h30 20h-23h30 cdi 17h50 mise en rayon logistique manutention bricolage">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #16a34a;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-success badge-contract">CDI 17H50 &bull; 20H-23H30</span>
                            <span class="badge bg-light text-dark border">Nocturne Logistique</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Leroy Merlin</h4>
                        <div class="text-muted small fw-semibold mb-3">Employé Logistique &bull; Rayon de Nuit (20h-23h30)</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Approvisionnement nocturne, dépotage transpalette, gerbage des charges lourdes en rayons et rangement sécurisé du dépôt.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="djibril_leroy_merlin_nuit.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="djibril_leroy_merlin_nuit.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- MESSAGE AUCUN RÉSULTAT -->
        <div id="noResults" class="text-center py-5 d-none">
            <i class="bi bi-search display-3 text-muted mb-3"></i>
            <h4 class="text-secondary">Aucun CV ne correspond à votre recherche</h4>
            <p class="text-muted">Essayez un autre mot-clé (ex: "CDD", "Burger", "Logistique", "Caisse")</p>
        </div>

        <!-- PIED DE PAGE -->
        <div class="text-center mt-5 pt-4 border-top">
            <a href="index.php" class="btn btn-outline-dark fw-bold px-4 py-2 me-2">
                <i class="bi bi-house-door"></i> Revenir au Hub Général
            </a>
            <a href="cv_emploi.php" class="btn btn-outline-primary fw-bold px-4 py-2">
                <i class="bi bi-person"></i> Espace CV Yacine Benbrik
            </a>
            <p class="text-muted small mt-3">Générateur Automatique de CV Dompdf &bull; Formats A4 conformes aux standards recruteurs 2026</p>
        </div>

    </div>

    <!-- SCRIPT DE FILTRAGE ET RECHERCHE -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const cvItems = document.querySelectorAll('.cv-item');
        const noResults = document.getElementById('noResults');

        let currentFilter = 'all';

        function filterCVs() {
            const query = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            cvItems.forEach(item => {
                const category = item.getAttribute('data-category');
                const keywords = item.getAttribute('data-keywords').toLowerCase();
                const cardText = item.innerText.toLowerCase();

                const matchesFilter = (currentFilter === 'all' || category === currentFilter);
                const matchesQuery = (query === '' || keywords.includes(query) || cardText.includes(query));

                if (matchesFilter && matchesQuery) {
                    item.classList.remove('d-none');
                    visibleCount++;
                } else {
                    item.classList.add('d-none');
                }
            });

            if (visibleCount === 0) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        }

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => {
                    b.classList.remove('active', 'btn-primary');
                    b.classList.add('btn-outline-secondary');
                });
                btn.classList.add('active', 'btn-primary');
                btn.classList.remove('btn-outline-secondary');

                currentFilter = btn.getAttribute('data-filter');
                filterCVs();
            });
        });

        searchInput.addEventListener('input', filterCVs);
    </script>
</body>
</html>
