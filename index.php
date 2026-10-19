<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['generate'])) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $path = 'profil accuel.jpg';
    $photoHtml = '';
    if (file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $photoHtml = '<img src="' . $base64 . '" class="profile-photo" alt="Photo">';
    } else {
        $photoHtml = '<img src="https://www.svgrepo.com/show/447833/user-profile.svg" class="profile-photo" alt="Photo">';
    }

    $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.2;
            margin: 0;
            padding: 10px 25px;
            color: #1e293b;
            background-color: #fff;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            padding-bottom: 5px;
        }
        .header-left {
            width: 30%;
            font-size: 8.5pt;
            color: #64748b;
            vertical-align: middle;
            text-align: left;
        }
        .header-center {
            width: 40%;
            text-align: center;
            vertical-align: middle;
        }
        .header-right {
            width: 30%;
            text-align: right;
            vertical-align: middle;
        }
        .header h1 { 
            font-size: 19pt; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: bold;
            color: #0f172a;
        }
        .header .subtitle { 
            font-size: 11.5pt; 
            font-weight: bold; 
            color: #28a745;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #28a745;
            color: white;
            font-size: 8.5pt;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 5px;
            font-weight: bold;
        }
        .rhythm {
            font-size: 8pt;
            color: #64748b;
            margin-top: 3px;
        }
        .profile-photo {
            width: 80px;
            height: auto;
            border: 2px solid #28a745;
            border-radius: 4px;
        }
        .contact-item {
            margin-bottom: 2px;
        }
        .contact-icon {
            width: 9px;
            height: 9px;
            margin-right: 4px;
        }
        h2 {
            font-size: 9.5pt;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 2px;
            margin-top: 12px;
            margin-bottom: 8px;
            font-weight: bold;
            color: #0f172a;
        }
        .timeline-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        .timeline-date {
            width: 105px;
            text-align: right;
            vertical-align: top;
            padding-right: 15px;
            font-weight: bold;
            font-size: 8pt;
            color: #28a745;
        }
        .timeline-content {
            vertical-align: top;
            padding-bottom: 5px;
        }
        .item-title { 
            font-weight: bold; 
            font-size: 9pt; 
            color: #0f172a;
            margin-bottom: 1px;
        }
        .item-subtitle { 
            color: #64748b; 
            font-size: 8pt; 
            margin-bottom: 2px; 
            font-style: italic;
        }
        ul { 
            margin: 2px 0 5px 15px; 
            padding: 0;
        }
        li { 
            margin-bottom: 2px; 
            font-size: 8.5pt; 
        }
        .skills-table {
            width: 95%;
            margin-left: 2.5%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        .skills-column {
            width: 33%;
            vertical-align: top;
            padding-right: 15px;
            text-align: left;
        }
        .skill-cat { 
            font-weight: bold; 
            font-size: 9pt; 
            text-transform: uppercase; 
            margin-bottom: 5px; 
            color: #28a745;
            border-bottom: 1px solid #28a745;
            display: block;
            padding-bottom: 2px;
        }
        .skill-list {
            font-size: 8.5pt;
            color: #1e293b;
            line-height: 1.4;
            margin-top: 4px;
        }
        .skill-icon, .section-icon {
            width: 11px;
            height: 11px;
            vertical-align: middle;
            margin-right: 5px;
        }
        .profil-block {
            margin-left: 110px;
            font-size: 9pt;
            padding: 8px 12px;
            background-color: #f1f5f9;
            border-left: 5px solid #28a745;
            margin-bottom: 10px;
            line-height: 1.3;
        }
        strong { color: #0f172a; }

    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td class="header-left">
                <div class="contact-item">Marseille, France</div>
                <div class="contact-item">07 67 63 84 45</div>
                <div class="contact-item">yacin.benbrik@epitech.eu</div>
                <div class="contact-item">github.com/yacineb03</div>
                <div class="contact-item">linkedin.com/in/yacine-benbrik</div>
            </td>
            <td class="header-center">
                <div class="header">
                    <h1>Yacine BENBRIK</h1>
                    <div class="subtitle">Développeur Full-Stack Junior</div>
                    <div class="search-objective">RECHERCHE D'ALTERNANCE</div>
                    <div class="rhythm">Rythme : 5 semaines / 1 semaine</div>
                </div>
            </td>
            <td class="header-right">
                $photoHtml
            </td>
        </tr>
    </table>
    <div class="section">
        <h2>Profil Professionnel</h2>
        <div class="profil-block">
            Actuellement étudiant à la <strong>Web@cadémie by Epitech</strong>, je suis passionné par le développement web et j'apprends chaque jour de nouvelles technologies. Je recherche aujourd'hui une alternance pour mettre mes connaissances en pratique, apprendre aux côtés de professionnels et m'investir sérieusement dans vos projets de développement.
        </div>
    </div>

    <div class="section">
        <h2>Projets & Réalisations</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">Académique</td>
                <td class="timeline-content">
                    <div class="item-title">Projets Académiques & Développement Personnel</div>
                    <div class="item-subtitle">Mise en pratique intensive des fondamentaux du Web@cadémie</div>
                    <ul>
                        <li>Réalisation de projets en conditions réelles : respect des délais et des cahiers des charges.</li>
                        <li>Travail en équipe et utilisation quotidienne d'outils de versioning (Git).</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">Dév. Web</td>
                <td class="timeline-content">
                    <div class="item-title">Klivio : Plateforme de mise en relation</div>
                    <div class="item-subtitle">Développement Full-Stack & Expérience Utilisateur</div>
                    <ul>
                        <li>Développement de fonctionnalités interactives et gestion des flux de données.</li>
                        <li>Focus sur l'accessibilité et la fluidité de l'interface.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">Architecture</td>
                <td class="timeline-content">
                    <div class="item-title">Architecture SaaS : Gestion de planning Auto-école</div>
                    <div class="item-subtitle">Full-Stack Development (Firebase / Node.js)</div>
                    <ul>
                        <li>Conception d'un système complet de planning dynamique et de suivi.</li>
                        <li>Intégration d'une base de données temps réel pour la synchronisation des données.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">Full-Stack</td>
                <td class="timeline-content">
                    <div class="item-title">Application Web : Système de réservation dynamique</div>
                    <div class="item-subtitle">Architecture MVC & Logique métier (Type Airbnb)</div>
                    <ul>
                        <li>Développement d'un moteur de recherche avec filtrage dynamique des annonces.</li>
                        <li>Gestion des réservations et structuration de la base de données relationnelle.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Formation</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2024 - 2026</td>
                <td class="timeline-content">
                    <div class="item-title">Web@cadémie by Epitech Marseille</div>
                    <div class="item-subtitle">Développeur Intégrateur Web (Niveau 5)</div>
                    <ul>
                        <li>Pédagogie par projets : PHP, SQL, JS ES6, React/Next.js.</li>
                        <li>Évaluations par <strong>soutenances orales</strong> et présentations techniques.</li>
                        <li>Apprentissage du <strong>travail en équipe</strong> et de la planification de projet.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">BTS SIO (Option SLAM)</div>
                    <div class="item-subtitle">Services Informatiques aux Organisations</div>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2021 - 2022</td>
                <td class="timeline-content">
                    <div class="item-title">Baccalauréat STI2D</div>
                    <div class="item-subtitle">Sciences et Technologies de l'Industrie et du Développement Durable</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Expertises Techniques</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <span class="skill-cat">Back-end & Data</span>
                    <div class="skill-list">
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg"> PHP, 
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg"> SQL,<br>
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-plain.svg"> Firebase, 
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg"> <strong>Node.js</strong>
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Front-end</span>
                    <div class="skill-list">
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg"> HTML5, 
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg"> CSS3,<br>
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg"> <strong>Tailwind</strong>, 
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg"> <strong>Next.js</strong>
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Méthodologie & Soft Skills</span>
                    <div class="skill-list">
                        <strong>Aisance orale</strong>, Travail en équipe,<br>
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg"> Git / 
                        <img class="skill-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"> GitHub
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
HTML;
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("CV_Yacine_Benbrik.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hub Générateur de CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .border-top-3 { border-top-width: 4px !important; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Hub <span class="text-primary">Générateur CV</span></h1>
            <p class="text-muted lead">Sélectionnez la catégorie de CV à générer :</p>
        </div>

        <div class="row g-4">
            
            <!-- NOUVEAU : YACINE BENBRIK CV EMPLOI -->
            <div class="col-12">
                <div class="card shadow-lg border-0 border-top border-primary border-top-3" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; border-radius: 14px;">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="badge bg-warning text-dark px-3 py-2 fw-bold text-uppercase mb-2">⭐ NOUVEAU ESPACE</span>
                                <h2 class="h3 fw-bold text-white mb-1">💼 YACINE BENBRIK — CV EMPLOI</h2>
                                <p class="text-light mb-0 small" style="color: #cbd5e1 !important;">
                                    14 CVs sur-mesure pour chaque métier et enseigne ciblée. Formats A4 calibrés à 1 page, expériences valorisées, <strong>zéro adresse postale</strong>.
                                </p>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <a href="cv_emploi.php" class="btn btn-primary btn-lg fw-bold shadow px-4 py-2">
                                    🚀 Ouvrir le Hub CV Emploi (14 Métiers) →
                                </a>
                            </div>
                        </div>

                        <hr style="border-color: rgba(255,255,255,0.2);">

                        <div class="row g-2 text-start">
                            <!-- Restauration -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold text-warning small mb-2">🍔 RESTAURATION RAPIDE</div>
                                    <a href="cv_quick.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🔴 Quick (12h/24h)</a>
                                    <a href="cv_g_la_dalle.php" class="btn btn-sm btn-outline-light w-100 text-start">🟠 G-La Dalle (Burger)</a>
                                </div>
                            </div>
                            <!-- Mode & Vente -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold text-info small mb-2">🛍️ MODE &amp; VENTE</div>
                                    <a href="cv_claires.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🌸 Claire's (Accessoires)</a>
                                    <a href="cv_ikks_men.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">👔 IKKS Men (CDD 20h)</a>
                                    <a href="cv_jules.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">👖 Jules (CDD 15h-24h)</a>
                                    <a href="cv_casa_carcasas.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">📱 Casa Carcasas (CDD 15h)</a>
                                    <a href="cv_pull_and_bear.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🧢 Pull &amp; Bear (CDD 24h)</a>
                                    <a href="cv_intersport.php" class="btn btn-sm btn-outline-light w-100 text-start">⚽ Intersport (CDD 12-24h)</a>
                                </div>
                            </div>
                            <!-- Grande Distribution -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold text-success small mb-2">🛒 GRANDE DISTRIBUTION</div>
                                    <a href="cv_action.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🔵 Action (CDD 12h-24h)</a>
                                    <a href="cv_lidl.php" class="btn btn-sm btn-outline-light w-100 text-start">🟡 Lidl (CDI 18h-24h)</a>
                                </div>
                            </div>
                            <!-- Logistique & BTP -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold small mb-2" style="color: #c4b5fd !important;">📦 LOGISTIQUE &amp; BTP</div>
                                    <a href="cv_preparateur_commande.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">📦 Préparateur Commande</a>
                                    <a href="cv_agent_exploitation.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🚚 Agent Exploitation</a>
                                    <a href="cv_plaquiste.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🧱 Plaquiste / BTP</a>
                                    <a href="cv_leroy_merlin_nuit.php" class="btn btn-sm btn-outline-light w-100 text-start">🟢 Leroy Merlin (Nuit)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NOUVEAU : DJIBRIL MAILLET CV EMPLOI (NOUVEAU STYLE SIDEBAR 2 COLONNES) -->
            <div class="col-12">
                <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #1c354d 0%, #0f1f2e 100%); color: white; border-radius: 14px; border-left: 6px solid #00bfa5 !important;">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <img src="profil_djibril.jpg" alt="Djibril" style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid #00bfa5; object-fit: cover;" onerror="this.src='https://www.svgrepo.com/show/447833/user-profile.svg'">
                                <div>
                                    <span class="badge px-3 py-1 fw-bold text-uppercase mb-1" style="background-color: #00bfa5; color: #0f1f2e;">⭐ NOUVEAU DESIGN SIDEBAR</span>
                                    <h2 class="h3 fw-bold text-white mb-1">🧑‍🤝‍🧑 DJIBRIL MAILLET — CV EMPLOI</h2>
                                    <p class="text-light mb-0 small" style="color: #cbd5e1 !important;">
                                        14 CVs sur-mesure au nouveau style 2 colonnes avec sidebar navy (#1c354d), photo, L1 Droit, permis B et <strong>zéro adresse postale</strong>.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <a href="djibril_cv_emploi.php" class="btn btn-lg fw-bold shadow px-4 py-2" style="background-color: #00bfa5; color: #0f1f2e; border: none;">
                                    🚀 Ouvrir le Hub Djibril Maillet (14 CVs) →
                                </a>
                            </div>
                        </div>

                        <hr style="border-color: rgba(255,255,255,0.2);">

                        <div class="row g-2 text-start">
                            <!-- Restauration -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold small mb-2" style="color: #5eead4;">🍔 RESTAURATION RAPIDE</div>
                                    <a href="djibril_quick.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🔴 Quick (12h/24h)</a>
                                    <a href="djibril_g_la_dalle.php" class="btn btn-sm btn-outline-light w-100 text-start">🟠 G-La Dalle (Burger)</a>
                                </div>
                            </div>
                            <!-- Mode & Vente -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold text-info small mb-2">🛍️ MODE &amp; VENTE</div>
                                    <a href="djibril_claires.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🌸 Claire's (Accessoires)</a>
                                    <a href="djibril_ikks_men.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">👔 IKKS Men (CDD 20h)</a>
                                    <a href="djibril_jules.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">👖 Jules (CDD 15h-24h)</a>
                                    <a href="djibril_casa_carcasas.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">📱 Casa Carcasas (CDD 15h)</a>
                                    <a href="djibril_pull_and_bear.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🧢 Pull &amp; Bear (CDD 24h)</a>
                                    <a href="djibril_intersport.php" class="btn btn-sm btn-outline-light w-100 text-start">⚽ Intersport (CDD 12-24h)</a>
                                </div>
                            </div>
                            <!-- Grande Distribution -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold text-success small mb-2">🛒 GRANDE DISTRIBUTION</div>
                                    <a href="djibril_action.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🔵 Action (CDD 12h-24h)</a>
                                    <a href="djibril_lidl.php" class="btn btn-sm btn-outline-light w-100 text-start">🟡 Lidl (CDI 18h-24h)</a>
                                </div>
                            </div>
                            <!-- Logistique & BTP -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold small mb-2" style="color: #c4b5fd !important;">📦 LOGISTIQUE &amp; BTP</div>
                                    <a href="djibril_preparateur_commande.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">📦 Préparateur Commande</a>
                                    <a href="djibril_agent_exploitation.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🚚 Agent Exploitation</a>
                                    <a href="djibril_plaquiste.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🧱 Plaquiste / BTP</a>
                                    <a href="djibril_leroy_merlin_nuit.php" class="btn btn-sm btn-outline-light w-100 text-start">🟢 Leroy Merlin (Nuit)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NOUVEAU : CARLOS MOREIRA VEIGA (ALTERNANCES TECHNIQUES & RESTAURATION) -->
            <div class="col-12">
                <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #1c1917 0%, #292524 100%); color: white; border-radius: 14px; border-left: 6px solid #0f766e !important;">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <img src="profil_carlos.jpg" alt="Carlos" style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid #0f766e; object-fit: cover;" onerror="this.src='https://www.svgrepo.com/show/447833/user-profile.svg'">
                                <div>
                                    <span class="badge px-3 py-1 fw-bold text-uppercase mb-1" style="background-color: #0f766e; color: #ffffff;">⭐ NOUVEAU DOSSIER CANDIDAT</span>
                                    <h2 class="h3 fw-bold text-white mb-1">⚡ CARLOS MOREIRA VEIGA — CV ALTERNANCE &amp; EMPLOI</h2>
                                    <p class="text-light mb-0 small" style="color: #d6d3d1 !important;">
                                        12 CVs sur-mesure (7 Alternances techniques CVC, Bâtiment, Marine, Auto + 5 Restauration rapide). BTS Énergies en cours, permis B et <strong>zéro adresse postale</strong>.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <a href="carlos_cv.php" class="btn btn-lg fw-bold shadow px-4 py-2" style="background-color: #0f766e; color: #ffffff; border: none;">
                                    🚀 Ouvrir le Hub Carlos Moreira Veiga (12 CVs) →
                                </a>
                            </div>
                        </div>

                        <hr style="border-color: rgba(255,255,255,0.2);">

                        <div class="row g-2 text-start">
                            <!-- CVC & Énergies -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold small mb-2" style="color: #2dd4bf;">❄️ ALTERNANCES CVC</div>
                                    <a href="carlos_alt_froid_clim.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🧊 Froid Commercial &amp; Clim</a>
                                    <a href="carlos_alt_chauffage_clim_enr.php" class="btn btn-sm btn-outline-light w-100 text-start">🔥 Chauffage, Clim &amp; ENR</a>
                                </div>
                            </div>
                            <!-- Élec & Bâtiment -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold small mb-2" style="color: #facc15;">⚡ ÉLEC &amp; BÂTIMENT</div>
                                    <a href="carlos_alt_electricien_batiment.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">💡 Électricien Bâtiment</a>
                                    <a href="carlos_alt_electricite_connecte.php" class="btn btn-sm btn-outline-light w-100 text-start">📱 Bâtiment Connecté &amp; VDI</a>
                                </div>
                            </div>
                            <!-- Marine & Auto -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold small mb-2" style="color: #38bdf8;">⚓ MARINE &amp; VÉHICULES</div>
                                    <a href="carlos_alt_meca_marine_plaisance.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🛥️ Mécanique Marine</a>
                                    <a href="carlos_alt_maintenance_marine_plaisance.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">⚓ Maintenance Plaisance</a>
                                    <a href="carlos_alt_controleur_technique_auto.php" class="btn btn-sm btn-outline-light w-100 text-start">🚗 Contrôleur Auto VL</a>
                                </div>
                            </div>
                            <!-- Restauration -->
                            <div class="col-md-3">
                                <div class="p-2 rounded h-100" style="background: rgba(255,255,255,0.06);">
                                    <div class="fw-bold small mb-2" style="color: #fb923c;">🍔 RESTAURATION RAPIDE</div>
                                    <a href="carlos_restau_quick.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🔴 Quick</a>
                                    <a href="carlos_restau_g_la_dalle.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🟠 G-La Dalle</a>
                                    <a href="carlos_restau_popeyes.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">🍗 Popeyes / KFC</a>
                                    <a href="carlos_restau_burger_king.php" class="btn btn-sm btn-outline-light w-100 mb-1 text-start">👑 Burger King</a>
                                    <a href="carlos_restau_otacos.php" class="btn btn-sm btn-outline-light w-100 text-start">🌮 O'Tacos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- INTÉRIM SUISSE -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100 border-top border-danger border-top-3">
                    <div class="card-body">
                        <h4 class="card-title text-danger mb-4">🇨🇭 INTÉRIM SUISSE <small class="text-muted fs-6">(Frontalier)</small></h4>
                        <div class="row g-2">
                            <div class="col-12 mb-1"><a href="cv_securite_suisse.php" class="btn btn-danger w-100 fw-bold shadow-sm">🛡️ Sécurité & Surveillance (Standard Suisse 2026)</a></div>
                            <div class="col-12 mb-1"><a href="cv_logistique_suisse.php" class="btn btn-danger w-100 fw-bold shadow-sm">📦 Logistique / Manutention / Cariste (Standard Suisse 2026)</a></div>
                            <div class="col-12 mb-1"><a href="cv_restauration_suisse.php" class="btn btn-danger w-100 fw-bold shadow-sm">🍔 Restauration Rapide / Équipier Polyvalent (Standard Suisse 2026)</a></div>
                            <div class="col-6"><a href="polyvalent.php" class="btn btn-outline-danger w-100">🏢 Polyvalent</a></div>
                            <div class="col-6"><a href="restauration.php" class="btn btn-outline-danger w-100">🍔 Restauration</a></div>
                            <div class="col-6"><a href="nettoyage.php" class="btn btn-outline-danger w-100">🧹 Nettoyage</a></div>
                            <div class="col-6"><a href="vente.php" class="btn btn-outline-danger w-100">🛒 Vente/Magasin</a></div>
                            <div class="col-12"><a href="manutention.php" class="btn btn-outline-danger w-100">🏗️ Manutention BTP</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INTÉRIM MARSEILLE -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100 border-top border-primary border-top-3">
                    <div class="card-body">
                        <h4 class="card-title text-primary mb-4">📍 INTÉRIM MARSEILLE</h4>
                        <div class="row g-2">
                            <div class="col-6"><a href="yacine_mrs_preparateur.php" class="btn btn-outline-primary w-100">📦 Prépa. Commande</a></div>
                            <div class="col-6"><a href="yacine_mrs_livreur.php" class="btn btn-outline-primary w-100">🚚 Livreur</a></div>
                            <div class="col-6"><a href="yacine_mrs_manutention.php" class="btn btn-outline-primary w-100">🏗️ Manutention</a></div>
                            <div class="col-6"><a href="yacine_mrs_polyvalent.php" class="btn btn-outline-primary w-100">🔄 Polyvalent</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ALTERNANCES -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100 border-top border-success border-top-3">
                    <div class="card-body">
                        <h4 class="card-title text-success mb-4">🎓 RECHERCHE ALTERNANCE</h4>
                        <div class="row g-3">
                            <div class="col-12">
                                <form method="post" class="m-0">
                                    <button type="submit" name="generate" class="btn btn-success w-100 fw-bold py-2">💻 Alternance Développeur Web</button>
                                </form>
                            </div>
                            <div class="col-12">
                                <a href="cv_popeyes_plan_de_campagne.php" class="btn btn-warning w-100 fw-bold py-2 shadow-sm text-dark">🍗 Popeyes Plan de Campagne (Contrat Étudiant)</a>
                            </div>
                            <div class="col-12">
                                <a href="cv_restauration_fastfood_etudiant.php" class="btn btn-outline-warning w-100 fw-bold py-2 shadow-sm text-dark">🍔 Restauration Rapide & Fast-Food Général (Contrat Étudiant)</a>
                            </div>
                            <div class="col-12">
                                <a href="cv_technicien_cvc_solive.php" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">❄️ Alternance Technicien CVC — SPÉCIAL LA SOLIVE</a>
                            </div>
                            <div class="col-12">
                                <a href="cv_la_solive.php" class="btn btn-danger w-100 fw-bold py-2 shadow-sm">☀️ Alternance Conducteur de Travaux — SPÉCIAL LA SOLIVE</a>
                            </div>
                            <div class="col-12">
                                <a href="cv_conducteur_travaux.php" class="btn btn-warning w-100 fw-bold py-2 shadow-sm text-dark">🏗️ Alternance Conducteur de Travaux (Général)</a>
                            </div>
                            <div class="col-12">
                                <a href="cv_conducteur_travaux_pluguffan.php" class="btn btn-warning w-100 fw-bold py-2 shadow-sm text-dark">🏗️ Alternance Conducteur de Travaux — PLUGUFFAN (29)</a>
                            </div>
                            <div class="col-12">
                                <a href="cv_chef_de_chantier.php" class="btn btn-warning w-100 fw-bold py-2 shadow-sm text-dark">🚧 Alternance Chef de Chantier (Général)</a>
                            </div>
                            <div class="col-12">
                                <a href="frigoriste.php" class="btn btn-outline-success w-100 fw-bold py-2">❄️ Alternance Frigoriste CVC (Chaud & Froid)</a>
                            </div>
                            <div class="col-12">
                                <a href="electrotechnique.php" class="btn btn-outline-success w-100 fw-bold py-2">⚡ Alternance BTS Électrotechnique / Assistant Conducteur de Travaux</a>
                            </div>
                            <div class="col-12">
                                <a href="cv_mec.php" class="btn btn-outline-success w-100 fw-bold py-2">📐 Alternance BTS MEC / Économiste de la construction</a>
                            </div>
                            <div class="col-12">
                                <a href="lettre_motivation_mec.php" class="btn btn-outline-danger w-100 fw-bold py-2">✉️ Lettre de Motivation - BTS MEC</a>
                            </div>
                            <div class="col-12">
                                <a href="lettre_motivation_dalkia.php" class="btn btn-outline-danger w-100 fw-bold py-2">✉️ Lettre de Motivation - Dalkia CVC</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INTÉRIM ANNEMASSE -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100 border-top border-info border-top-3">
                    <div class="card-body">
                        <h4 class="card-title text-info mb-4">🏔️ INTÉRIM FRANCE <small class="text-muted fs-6">(Annemasse)</small></h4>
                        <div class="row g-2">
                            <div class="col-6"><a href="france_interim.php" class="btn btn-outline-info w-100">🔴 Ultime Intérim</a></div>
                            <div class="col-6"><a href="france_securite.php" class="btn btn-outline-info w-100">🛡️ Sécurité</a></div>
                            <div class="col-6"><a href="france_livreur.php" class="btn btn-outline-info w-100">🚚 Livreur</a></div>
                            <div class="col-6"><a href="france_restauration.php" class="btn btn-outline-info w-100">🍟 Fast-Food</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CV PROCHES -->
            <div class="col-md-12">
                <div class="card shadow-sm border-top border-secondary border-top-3">
                    <div class="card-body">
                        <h4 class="card-title text-secondary mb-3">🧑‍🤝‍🧑 CV PROCHES <small class="text-muted fs-6">(Djibril Maillet &amp; Carlos Moreira Veiga)</small></h4>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <a href="djibril_cv_emploi.php" class="btn btn-dark w-100 fw-bold shadow-sm py-2" style="background-color: #1c354d; border: 2px solid #00bfa5; color: #00bfa5;">
                                    ⭐ 14 CVs de Djibril Maillet (Sidebar Sarcelle) →
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="carlos_cv.php" class="btn btn-dark w-100 fw-bold shadow-sm py-2" style="background-color: #1c1917; border: 2px solid #0f766e; color: #2dd4bf;">
                                    ⭐ 12 CVs de Carlos Moreira Veiga (Sidebar Ivoire &amp; CVC) →
                                </a>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-3"><a href="djibril.php" class="btn btn-outline-secondary w-100 btn-sm">📄 Djibril Polyvalent</a></div>
                            <div class="col-md-3"><a href="djibril_manutention.php" class="btn btn-outline-secondary w-100 btn-sm">📦 Djibril Manutention</a></div>
                            <div class="col-md-3"><a href="carlos_alt_froid_clim.php" class="btn btn-outline-secondary w-100 btn-sm">❄️ Carlos Froid &amp; Clim</a></div>
                            <div class="col-md-3"><a href="carlos_restau_quick.php" class="btn btn-outline-secondary w-100 btn-sm">🍔 Carlos Quick</a></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-5 pt-4 border-top">
            <a href="CV_Generator/index.php" class="text-decoration-none text-muted">Accéder à l'ancien générateur complet →</a>
        </div>
    </div>
</body>
</html>