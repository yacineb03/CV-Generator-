<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yacine Benbrik — CV Emploi & Candidatures Ciblées</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f1f5f9;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #1e293b;
        }
        .hero-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            padding: 45px 20px;
            border-radius: 16px;
            margin-bottom: 35px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.25);
            border-bottom: 4px solid #3b82f6;
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
        
        <!-- EN-TÊTE PRINCIPAL -->
        <div class="hero-banner">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-primary mb-2 px-3 py-2 text-uppercase fw-bold">Espace Recrutement &amp; Candidatures</span>
                    <h1 class="display-6 fw-bold mb-2">💼 Yacine Benbrik — CV Emploi</h1>
                    <p class="text-slate-300 lead mb-3 fs-6" style="color: #cbd5e1;">
                        <strong>14 CVs sur-mesure</strong> pour chaque enseigne et métier visé. Structurés selon les standards professionnels, <strong>garantis 1 page A4</strong>, avec expériences valorisées et <strong>zéro adresse postale</strong> pour une candidature anonymisée et crédible.
                    </p>
                    <div>
                        <span class="info-pill"><i class="bi bi-geo-alt"></i> Marseille (13) &bull; France</span>
                        <span class="info-pill"><i class="bi bi-telephone"></i> 07 67 63 84 45</span>
                        <span class="info-pill"><i class="bi bi-envelope"></i> benbrikyacine60@gmail.com</span>
                        <span class="info-pill text-warning"><i class="bi bi-car-front-fill"></i> Permis B &bull; Véhicule Personnel</span>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="index.php" class="btn btn-outline-light btn-sm px-3 py-2 fw-bold">
                        <i class="bi bi-arrow-left"></i> Retour au Hub Général
                    </a>
                </div>
            </div>
        </div>

        <!-- RECHERCHE ET FILTRES -->
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-5">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchInput" class="form-control search-box border-start-0" placeholder="Rechercher une enseigne, un poste, un contrat (ex: CDD, Quick, Nuit)...">
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

        <!-- GRILLE DES 14 CVS -->
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
                            Accueil client, caisse/borne, cuisson grill &amp; friteuse minute, normes HACCP, rushs soutenus et fermeture.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_quick.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-danger btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_quick.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
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
                            Assemblage cadencé burgers, cuisson grill, gestion des flux commandes à emporter et livreurs (Uber/Deliveroo).
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_g_la_dalle.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #ea580c;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_g_la_dalle.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. ACTION -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="distrib" data-keywords="action cdd 12h 24h employe polyvalent magasin mise en rayon facing caisse palette">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0072ce;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #0072ce;">CDD 12H - 24H</span>
                            <span class="badge bg-light text-dark border">Bazar &amp; Magasin</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Action</h4>
                        <div class="text-muted small fw-semibold mb-3">Employé Polyvalent de Magasin</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Déchargement palettes, réassort cadencé, facing impeccable des linéaires, encaissement rapide et balisage prix.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_action.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #0072ce;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_action.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. PRÉPARATEUR DE COMMANDE -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="logbtp" data-keywords="preparateur de commande logistique entrepot drive picking scan pda vocal colis palette">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #7c3aed;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #7c3aed;">LOGISTIQUE</span>
                            <span class="badge bg-light text-dark border">Entrepôt &amp; Drive</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Préparateur de Commande</h4>
                        <div class="text-muted small fw-semibold mb-3">Logistique / Picking &amp; Palettisation</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Scan PDA / guidage vocal, respect des quotas horaires de prélèvement, filmage, constitution de palettes stables.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_preparateur_commande.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #7c3aed;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_preparateur_commande.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. PLAQUISTE -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="logbtp" data-keywords="plaquiste platrier btp second oeuvre ba13 rails montants joints enduit isolation">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0d9488;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #0d9488;">BTP SECOND ŒUVRE</span>
                            <span class="badge bg-light text-dark border">Chantier</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Plaquiste — Plâtrier</h4>
                        <div class="text-muted small fw-semibold mb-3">Pose de Cloisons &amp; Aménagement BTP</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Ossatures métalliques, rails/montants, découpe et fixation BA13, isolants phoniques/thermiques, bandes &amp; enduisage.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_plaquiste.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #0d9488;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_plaquiste.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. AGENT D'EXPLOITATION POLYVALENT -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="logbtp" data-keywords="agent exploitation polyvalent flux quai logistique expedition reception bordereaux">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #4338ca;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #4338ca;">EXPLOITATION</span>
                            <span class="badge bg-light text-dark border">Gestion de Site &amp; Quai</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Agent d'Exploitation</h4>
                        <div class="text-muted small fw-semibold mb-3">Agent d'Exploitation Polyvalent</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Coordination des flux de quai, contrôle des bordereaux BL/CMR, dispatching colis/palettes, suivi traçabilité.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_agent_exploitation.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #4338ca;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_agent_exploitation.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 7. CLAIRE'S -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="claire's claires vendeurs vendeuse accessoires bijoux boutique mode conseil caisse">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #db2777;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #db2777;">CLAIRE'S</span>
                            <span class="badge bg-light text-dark border">Accessoires &amp; Bijoux</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Claire's</h4>
                        <div class="text-muted small fw-semibold mb-3">Conseiller de Vente / Vendeur Magasin</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Accueil chaleureux, conseil personnalisé accessoires/bijoux fantaisie, ventes complémentaires, caisse et merchandising soigné.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_claires.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #db2777;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_claires.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 8. IKKS MEN -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="ikks men ikks conseiller vente cdd 20h pret a porter masculin mode homme haut de gamme">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #d97706;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #d97706;">CDD 20H</span>
                            <span class="badge bg-light text-dark border">Mode Masculine Haut de Gamme</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">IKKS Men</h4>
                        <div class="text-muted small fw-semibold mb-3">Conseiller de Vente Prêt-à-Porter</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Vente assistée haut de gamme, conseil silhouette/morphologie, augmentation du panier moyen, tenue impeccable de boutique.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_ikks_men.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #0f172a; border: 1.5px solid #d97706; color: #f59e0b !important;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_ikks_men.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 9. JULES -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="jules vendeur cdd 15h 24h pret a porter masculin mode homme casual caisse">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #1e3a8a;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #1e3a8a;">CDD 15H - 24H</span>
                            <span class="badge bg-light text-dark border">Prêt-à-Porter Masculin</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Jules</h4>
                        <div class="text-muted small fw-semibold mb-3">Vendeur Conseil Prêt-à-Porter</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Conseil look &amp; matières, tables pliées au gabarit, cabines, réassort dynamique et encaissement avec sourire.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_jules.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #1e3a8a;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_jules.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 10. LA CASA DE LAS CARCASAS -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="la casa de las carcasas casas carcasas vendeur cdd 15h coques verre trempe telephone multimédia">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #e11d48;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #e11d48;">CDD 15H</span>
                            <span class="badge bg-light text-dark border">Accessoires Mobiles</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">La Casa de las Carcasas</h4>
                        <div class="text-muted small fw-semibold mb-3">Vendeur Conseil Multimédia</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Vente active en boutique à fort passage, pose experte de verres trempés/hydrogel sans bulle, ventes complémentaires.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_casa_carcasas.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #e11d48;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_casa_carcasas.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 11. PULL & BEAR -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="pull bear pull & bear cdd 24h conseiller vente mode jeune inditex streetwear">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0284c7;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #0284c7;">CDD 24H</span>
                            <span class="badge bg-light text-dark border">Mode Jeune &amp; Streetwear</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Pull &amp; Bear</h4>
                        <div class="text-muted small fw-semibold mb-3">Conseiller de Vente Prêt-à-Porter</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Rythme soutenu en centre commercial, gestion fluide des cabines d'essayage, réassort selon normes Inditex et caisse.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_pull_and_bear.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #0284c7;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_pull_and_bear.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 12. INTERSPORT -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="vente" data-keywords="intersport vendeur textile cdd 12h 24h sport basket vetements sneakers">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #1d4ed8;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #1d4ed8;">CDD 12H - 24H</span>
                            <span class="badge bg-light text-dark border">Sport &amp; Textile</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Intersport</h4>
                        <div class="text-muted small fw-semibold mb-3">Vendeur Conseil Rayon Textile &amp; Sport</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Conseil technique vêtements sport &amp; lifestyle (Nike, Adidas, Puma), réassort tailles, profil basketteur de compétition.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_intersport.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #1d4ed8;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_intersport.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 13. LIDL -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="distrib" data-keywords="lidl cdi 18h 24h equipier polyvalent supermarche caisse rapide fraicheur pain">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #1e40af;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #1e40af;">CDI 18H - 24H</span>
                            <span class="badge bg-light text-dark border">Supermarché &amp; Discount</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Lidl</h4>
                        <div class="text-muted small fw-semibold mb-3">Équipier Polyvalent de Magasin</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Encaissement cadencé, contrôle fraîcheur fruits/légumes, cuisson point chaud boulangerie, réassort ultra-rapide.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_lidl.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #1e40af; border: 1.5px solid #eab308;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_lidl.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 14. LEROY MERLIN NUIT -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="logbtp" data-keywords="leroy merlin le roy merlan employe logistique mise en rayon nuit 20h 23h30 cdi 17h50 bricolage">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #15803d;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #15803d;">NUIT 20H-23H30</span>
                            <span class="badge bg-light text-dark border">CDI 17H50</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Leroy Merlin</h4>
                        <div class="text-muted small fw-semibold mb-3">Employé Logistique (Mise en Rayon de Nuit)</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Dépotage palettes nocturne, approvisionnement rayons bricolage/habitat, sécurité EPI, autonomie avec véhicule personnel.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="cv_leroy_merlin_nuit.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn text-white btn-download w-100" style="background-color: #15803d;">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="cv_leroy_merlin_nuit.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="noResults" class="text-center py-5 d-none">
            <i class="bi bi-emoji-frown display-4 text-muted mb-3"></i>
            <h5 class="text-secondary">Aucun CV ne correspond à votre recherche</h5>
            <p class="text-muted small">Essayez avec un autre mot-clé (ex: "CDD", "Action", "Lidl", "Vente"...)</p>
        </div>

        <!-- PIED DE PAGE -->
        <div class="text-center mt-5 pt-4 border-top">
            <a href="index.php" class="btn btn-outline-dark fw-bold px-4 py-2">
                <i class="bi bi-house-door"></i> Revenir au Hub Principal de CV
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
