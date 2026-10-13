<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carlos Moreira Veiga — CV Alternances & Restauration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f7f4ee;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #292524;
        }
        .hero-banner {
            background: linear-gradient(135deg, #1c1917 0%, #292524 100%);
            color: #ffffff;
            padding: 40px 25px;
            border-radius: 16px;
            margin-bottom: 35px;
            box-shadow: 0 10px 25px -5px rgba(28, 25, 23, 0.35);
            border-bottom: 4px solid #0f766e;
        }
        .avatar-carlos {
            width: 105px;
            height: 105px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0f766e;
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
            border: 1px solid #e7e2d6;
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
            font-size: 0.72rem;
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
            background-color: #1c1917;
            border-color: #1c1917;
            color: #ffffff;
        }
        .btn-download:hover {
            background-color: #0f766e;
            border-color: #0f766e;
            color: #ffffff;
        }
        .filter-btn {
            border-radius: 20px;
            font-weight: 600;
            padding: 6px 16px;
            font-size: 0.88rem;
        }
        .search-box {
            border-radius: 10px;
            padding: 12px 18px;
            font-size: 0.95rem;
            border: 1px solid #d6d3d1;
            background-color: #ffffff;
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
        
        <!-- HERO BANNER CARLOS -->
        <div class="hero-banner">
            <div class="row align-items-center">
                <div class="col-auto mb-3 mb-md-0">
                    <img src="profil_carlos.jpg" alt="Carlos Moreira Veiga" class="avatar-carlos" onerror="this.src='https://www.svgrepo.com/show/447833/user-profile.svg'">
                </div>
                <div class="col-lg-7">
                    <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: #0f766e; color: #ffffff;">
                        Espace Recrutement &bull; Carlos Moreira Veiga
                    </span>
                    <h1 class="display-6 fw-bold mb-2">⚡ Carlos Moreira Veiga — Dossier CV</h1>
                    <p class="text-slate-300 lead mb-3 fs-6" style="color: #d6d3d1;">
                        <strong>12 CVs sur-mesure</strong> pour ses candidatures en <strong>Alternance technique</strong> (CVC, Froid, Électricité, Marine, Automobile) et en <strong>Restauration Rapide</strong> (Quick, G-La Dalle, Popeyes...). Calibrés à <strong>exactement 1 page A4</strong> et <strong>zéro adresse postale</strong>.
                    </p>
                    <div>
                        <span class="info-pill"><i class="bi bi-geo-alt"></i> Marseille (13013) &bull; France</span>
                        <span class="info-pill"><i class="bi bi-telephone"></i> 07 66 28 61 46</span>
                        <span class="info-pill"><i class="bi bi-envelope"></i> cmoreirav16@gmail.com</span>
                        <span class="info-pill text-warning"><i class="bi bi-car-front-fill"></i> Permis B + Véhicule</span>
                        <span class="info-pill" style="color: #5eead4;"><i class="bi bi-tools"></i> BTS Maintenance Systèmes Énergétiques (En cours)</span>
                    </div>
                </div>
                <div class="col-lg-3 text-lg-end mt-4 mt-lg-0">
                    <a href="index.php" class="btn btn-outline-light btn-sm px-3 py-2 fw-bold mb-2 w-100">
                        <i class="bi bi-arrow-left"></i> Hub Principal
                    </a>
                    <a href="djibril_cv_emploi.php" class="btn btn-outline-info btn-sm px-3 py-2 fw-bold mb-2 w-100">
                        <i class="bi bi-person-badge"></i> Espace Djibril Maillet
                    </a>
                    <a href="cv_emploi.php" class="btn btn-outline-success btn-sm px-3 py-2 fw-bold w-100">
                        <i class="bi bi-person"></i> Espace Yacine Benbrik
                    </a>
                </div>
            </div>
        </div>

        <!-- RECHERCHE ET FILTRES -->
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-5">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="searchInput" class="form-control search-box border-start-0" placeholder="Rechercher une alternance, un métier, un fast-food (ex: Froid, Marine, Quick)...">
                </div>
            </div>
            <div class="col-md-7 text-md-end">
                <div class="d-flex flex-wrap gap-1 justify-content-md-end" id="filterContainer">
                    <button class="btn btn-dark filter-btn active" data-filter="all">Tous (12)</button>
                    <button class="btn btn-outline-secondary filter-btn" data-filter="cvc">❄️ CVC &amp; Énergies</button>
                    <button class="btn btn-outline-secondary filter-btn" data-filter="elec">⚡ Élec &amp; Bâtiment</button>
                    <button class="btn btn-outline-secondary filter-btn" data-filter="tech">⚓ Marine &amp; Auto</button>
                    <button class="btn btn-outline-secondary filter-btn" data-filter="resto">🍔 Restauration Rapide</button>
                </div>
            </div>
        </div>

        <!-- GRILLE DES 12 CVS CARLOS -->
        <div class="row g-4" id="cvGrid">

            <!-- 1. FROID COMMERCIAL & CLIMATISATION -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="cvc" data-keywords="froid commercial climatisation cvc frigoriste refrigerateur chambres froides fluide frigorigene alternance apprentissage bts mse">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0f766e;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-teal badge-contract text-white" style="background-color: #0f766e;">ALTERNANCE CVC</span>
                            <span class="badge bg-light text-dark border">Froid Commercial</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Froid Commercial &amp; Clim</h4>
                        <div class="text-muted small fw-semibold mb-3">Technicien d'Intervention en Froid Commercial et Climatisation</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Maintenance et dépannage de chambres froides, vitrines réfrigérées, split systems, fluides frigorigènes et réglages thermodynamiques.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_alt_froid_clim.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_alt_froid_clim.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. CHAUFFAGE, CLIM, SANITAIRE & ENR -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="cvc" data-keywords="chauffage climatisation sanitaire energies renouvelables enr pompes a chaleur pac solaire thermodynamique alternance">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0284c7;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #0284c7;">ALTERNANCE CVC &amp; ENR</span>
                            <span class="badge bg-light text-dark border">Chauffage &amp; PAC</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Chauffage, Clim &amp; ENR</h4>
                        <div class="text-muted small fw-semibold mb-3">Technicien Chauffage, Climatisation, Sanitaire &amp; Énergies Renouvelables</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Installation et maintenance de pompes à chaleur (PAC), chaudières, ballons thermodynamiques, réseaux hydrauliques et solaire thermique.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_alt_chauffage_clim_enr.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_alt_chauffage_clim_enr.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. CONTRÔLEUR TECHNIQUE AUTO -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="tech" data-keywords="controleur technique sur vehicules legers automobile auto banc freinage pollution obd alternance vl">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #d97706;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #d97706;">ALTERNANCE AUTOMOBILE</span>
                            <span class="badge bg-light text-dark border">Contrôle Technique VL</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Contrôleur Technique Auto</h4>
                        <div class="text-muted small fw-semibold mb-3">Contrôleur Technique sur Véhicules Légers</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Passage aux bancs de freinage/suspensions, contrôle sous fosse, analyse des émissions polluantes et vérification réglementaire des organes de sécurité.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_alt_controleur_technique_auto.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_alt_controleur_technique_auto.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. MÉCANIQUE MARINE PLAISANCE -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="tech" data-keywords="mecanique marine de plaisance reparateur moteur hors bord in board bateau nautique port alternance">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0369a1;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #0369a1;">ALTERNANCE MARINE</span>
                            <span class="badge bg-light text-dark border">Mécanique Bateaux</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Mécanique Marine Plaisance</h4>
                        <div class="text-muted small fw-semibold mb-3">Technicien Réparateur en Mécanique de Marine de Plaisance</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Entretien et réparation moteurs in-board et hors-bord, vidanges d'embase, remplacement turbines, hivernage et circuit d'alimentation navale.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_alt_meca_marine_plaisance.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_alt_meca_marine_plaisance.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. MAINTENANCE MARINE PLAISANCE -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="tech" data-keywords="maintenance marine de plaisance bateau carenage accastillage electricite marine 12v 24v alternance">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #0284c7;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #0284c7;">ALTERNANCE MARINE</span>
                            <span class="badge bg-light text-dark border">Maintenance Multitechnique</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Maintenance Marine Plaisance</h4>
                        <div class="text-muted small fw-semibold mb-3">Technicien de Maintenance en Marine de Plaisance</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Maintenance générale d'unités de plaisance : carénage, antifouling, circuits électriques de bord 12V/24V, pompes de cale et équipements de pont.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_alt_maintenance_marine_plaisance.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_alt_maintenance_marine_plaisance.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. ÉLECTRICIEN DU BÂTIMENT -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="elec" data-keywords="agent maintenance des batiments electricien d'equipement du batiment elec electricite tableau tirage alternance">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #eab308;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-dark" style="background-color: #eab308;">ALTERNANCE ÉLECTRICITÉ</span>
                            <span class="badge bg-light text-dark border">Équipement Bâtiment</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Électricien Bâtiment</h4>
                        <div class="text-muted small fw-semibold mb-3">Agent de Maintenance Bâtiments &bull; Électricien d'Équipement</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Câblage de tableaux électriques, tirage de câbles, pose d'appareillages (NF C 15-100), dépannage basse tension et maintenance multiservice.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_alt_electricien_batiment.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_alt_electricien_batiment.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 7. BÂTIMENT COMMUNICANT & CONNECTÉ -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="elec" data-keywords="electricite du batiment communicant et connecte domotique vdi smart building gtb rj45 irve alternance">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #6366f1;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #6366f1;">ALTERNANCE SMART HOME</span>
                            <span class="badge bg-light text-dark border">Domotique &amp; VDI</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Bâtiment Connecté &amp; Domotique</h4>
                        <div class="text-muted small fw-semibold mb-3">Technicien en Électricité du Bâtiment Communicant et Connecté</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Câblage réseaux VDI, baies de brassage, modules domotiques connectés, GTB/GTC et bornes de recharge pour véhicules électriques (IRVE).
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_alt_electricite_connecte.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_alt_electricite_connecte.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 8. QUICK -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="resto" data-keywords="quick contrat etudiant 12h 24h restauration rapide fast food equipier burger caisse comptoir haccp">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #dc2626;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-danger badge-contract">CONTRAT ÉTUDIANT</span>
                            <span class="badge bg-light text-dark border">Restauration Rapide</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Quick</h4>
                        <div class="text-muted small fw-semibold mb-3">Équipier Polyvalent de Restauration Rapide</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Service comptoir et borne, cuisson grill minute, toastage des buns, frites, hygiène HACCP et réactivité en rush.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_restau_quick.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_restau_quick.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 9. G-LA DALLE -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="resto" data-keywords="g la dalle g-la dalle burger fast food smash equipe cadence emporte uber deliveroo">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #ea580c;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #ea580c;">G-LA DALLE</span>
                            <span class="badge bg-light text-dark border">Smash Burger</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">G-La Dalle</h4>
                        <div class="text-muted small fw-semibold mb-3">Équipier Polyvalent de Restauration</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Assemblage minuté burgers, cuisson grill, gestion dynamique des commandes à emporter et remises livreurs Uber Eats / Deliveroo.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_restau_g_la_dalle.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_restau_g_la_dalle.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 10. POPEYES / KFC -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="resto" data-keywords="popeyes kfc poulet frit tenders friture cuisson minute fast food restauration rapide">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #f97316;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #f97316;">POPEYES / KFC</span>
                            <span class="badge bg-light text-dark border">Poulet Frit Spécialité</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Popeyes / KFC</h4>
                        <div class="text-muted small fw-semibold mb-3">Équipier Polyvalent Restauration &bull; Poulet Frit</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Panure manuelle croustillante, maîtrise des friteuses haute température, assemblage tenders/burgers et service comptoir dynamique.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_restau_popeyes.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_restau_popeyes.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 11. BURGER KING -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="resto" data-keywords="burger king bk flamme broiler flame grilled drive comptoir caisse restauration rapide">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #b91c1c;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-danger badge-contract">BURGER KING</span>
                            <span class="badge bg-light text-dark border">Service &amp; Drive</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">Burger King</h4>
                        <div class="text-muted small fw-semibold mb-3">Équipier Polyvalent de Restauration</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Cuisson flamme au broiler, assemblage garniture minuté, préparation des commandes drive et service en salle.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_restau_burger_king.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_restau_burger_king.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 12. O'TACOS -->
            <div class="col-md-6 col-lg-4 cv-item" data-category="resto" data-keywords="o tacos otacos french tacos sauce fromagere presse grill street food restauration rapide">
                <div class="card cv-card">
                    <div class="card-accent-bar" style="background-color: #b45309;"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge badge-contract text-white" style="background-color: #b45309;">O'TACOS</span>
                            <span class="badge bg-light text-dark border">French Tacos</span>
                        </div>
                        <h4 class="card-title fw-bold mb-1">O'Tacos</h4>
                        <div class="text-muted small fw-semibold mb-3">Équipier Polyvalent Snack &amp; Fast-Food</div>
                        <p class="small text-secondary flex-grow-1 mb-3">
                            Garniture des galettes, dosage sauce fromagère, pliage soigné, passage sous presse grill et expédition rapide des commandes.
                        </p>
                        <div class="d-grid gap-2">
                            <form action="carlos_restau_otacos.php" method="POST" target="_blank" class="m-0">
                                <button type="submit" name="generate" class="btn btn-download w-100">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Télécharger PDF
                                </button>
                            </form>
                            <a href="carlos_restau_otacos.php" class="btn btn-outline-secondary btn-sm">Fiche &amp; Aperçu</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- MESSAGE AUCUN RÉSULTAT -->
        <div id="noResults" class="text-center py-5 d-none">
            <i class="bi bi-search display-3 text-muted mb-3"></i>
            <h4 class="text-secondary">Aucun CV ne correspond à votre recherche</h4>
            <p class="text-muted">Essayez un autre mot-clé (ex: "Froid", "Marine", "Quick", "Élec")</p>
        </div>

        <!-- PIED DE PAGE -->
        <div class="text-center mt-5 pt-4 border-top">
            <a href="index.php" class="btn btn-outline-dark fw-bold px-4 py-2 me-2">
                <i class="bi bi-house-door"></i> Revenir au Hub Général
            </a>
            <a href="djibril_cv_emploi.php" class="btn btn-outline-info fw-bold px-4 py-2 me-2">
                <i class="bi bi-person"></i> Espace Djibril Maillet
            </a>
            <a href="cv_emploi.php" class="btn btn-outline-success fw-bold px-4 py-2">
                <i class="bi bi-person-badge"></i> Espace Yacine Benbrik
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
                    b.classList.remove('active', 'btn-dark');
                    b.classList.add('btn-outline-secondary');
                });
                btn.classList.add('active', 'btn-dark');
                btn.classList.remove('btn-outline-secondary');

                currentFilter = btn.getAttribute('data-filter');
                filterCVs();
            });
        });

        searchInput.addEventListener('input', filterCVs);
    </script>
</body>
</html>
