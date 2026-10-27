<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['generate']) || (php_sapi_name() === 'cli' && isset($argv[1]) && $argv[1] === 'generate')) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            margin: 14px 20px 12px 20px;
        }
        body {
            font-family: Helvetica, Arial, sans-serif;
            line-height: 1.25;
            margin: 0;
            padding: 0;
            color: #1e293b;
            background-color: #fff;
        }
        
        /* HEADER DESIGN */
        .header-box {
            background-color: #0f172a;
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 5px;
            margin-bottom: 9px;
            border-bottom: 3px solid #d97706;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-left {
            width: 32%;
            font-size: 8pt;
            color: #cbd5e1;
            vertical-align: middle;
            text-align: left;
            line-height: 1.35;
        }
        .header-center {
            width: 50%;
            text-align: center;
            vertical-align: middle;
        }
        .header-right {
            width: 18%;
            text-align: right;
            vertical-align: middle;
        }
        .header h1 { 
            font-size: 16.5pt; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.5px;
        }
        .header .subtitle { 
            font-size: 10.5pt; 
            font-weight: bold; 
            color: #f59e0b;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #d97706;
            color: #ffffff;
            font-size: 7.5pt;
            padding: 2.5px 8px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 4px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .profile-photo {
            width: 70px;
            height: auto;
            border: 2px solid #f59e0b;
            border-radius: 4px;
        }
        .contact-item {
            margin-bottom: 2px;
        }

        /* SECTION TITLES */
        h2 {
            font-size: 9pt;
            text-transform: uppercase;
            color: #0f172a;
            font-weight: bold;
            background-color: #f8fafc;
            border-bottom: 1.5px solid #d97706;
            border-top: 1px solid #e2e8f0;
            padding: 2.5px 6px;
            margin-top: 6px;
            margin-bottom: 5px;
            text-align: left;
            letter-spacing: 0.4px;
        }

        /* 1. COMPÉTENCES CLÉS (3 COLS) */
        .skills-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .skills-column {
            width: 33.33%;
            vertical-align: top;
            padding: 0 4px;
        }
        .skill-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 5px 7px;
            min-height: 88px;
        }
        .skill-cat { 
            font-weight: bold; 
            font-size: 8pt; 
            text-transform: uppercase; 
            color: #d97706;
            margin-bottom: 3px; 
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 2px;
            display: block;
            text-align: center;
        }
        .skill-list {
            font-size: 7.4pt;
            color: #334155;
            line-height: 1.35;
            text-align: left;
        }

        /* EXPÉRIENCES */
        .exp-box {
            width: 98%;
            margin: 0 auto 4px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 4.5px 8px;
        }
        .exp-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5px;
        }
        .exp-title {
            font-weight: bold;
            font-size: 8.5pt;
            color: #0f172a;
            text-align: left;
        }
        .exp-date {
            font-weight: bold;
            font-size: 8pt;
            color: #d97706;
            text-align: right;
        }
        .exp-subtitle {
            font-size: 7.2pt;
            color: #64748b;
            font-style: italic;
            margin-bottom: 2px;
            text-align: left;
        }
        ul.exp-list {
            margin: 1.5px 0 1.5px 13px;
            padding: 0;
            text-align: left;
        }
        ul.exp-list li {
            font-size: 7.5pt;
            color: #334155;
            margin-bottom: 1px;
            line-height: 1.25;
        }

        /* PROFIL EN RECONVERSION */
        .profil-block {
            font-size: 8pt;
            padding: 6px 10px;
            background-color: #fffbebfb;
            border: 1px solid #fde68a;
            border-left: 4px solid #d97706;
            margin: 4px auto 6px auto;
            width: 96%;
            line-height: 1.35;
            color: #1e293b;
            border-radius: 4px;
            text-align: justify;
        }

        /* FORMATIONS */
        .edu-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1px;
        }
        .edu-cell {
            padding: 3px 6px;
            vertical-align: top;
            border-bottom: 1px dotted #e2e8f0;
        }
        .edu-date {
            width: 95px;
            font-weight: bold;
            font-size: 7.8pt;
            color: #d97706;
            white-space: nowrap;
        }
        .edu-title {
            font-weight: bold;
            font-size: 8.2pt;
            color: #0f172a;
        }
        .edu-sub {
            font-size: 7.2pt;
            color: #64748b;
            font-style: italic;
        }

        /* SAVOIR-ÊTRE / ATOUTS (BOTTOM TABLE) */
        .hobbies-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2px;
        }
        .hobby-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 4px 6px;
            text-align: center;
        }
        .hobby-item {
            width: 33.33%;
            vertical-align: top;
            padding: 0 4px;
            font-size: 7.3pt;
            line-height: 1.25;
            color: #334155;
        }
        .hobby-title {
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 1px;
            font-size: 7.8pt;
        }
        strong { color: #0f172a; }
    </style>
</head>
<body>

    <!-- HEADER BLOCK -->
    <div class="header-box">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="contact-item"><strong>Marseille (13003)</strong> &bull; PACA</div>
                    <div class="contact-item">Tél : 07 67 63 84 45</div>
                    <div class="contact-item">benbrikyacine60@gmail.com</div>
                    <div class="contact-item" style="color:#f59e0b;"><strong>Permis B + Véhicule Personnel</strong></div>
                    <div class="contact-item" style="font-size:7.2pt; color:#94a3b8;">Mobilité : Aubagne, Gardanne, Marseille (13)</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Électricien d'Équipement du Bâtiment</div>
                        <div class="search-objective">RECHERCHE ALTERNANCE &bull; TITRE PRO (CAP/BEP) &bull; RYTHME AFPA</div>
                    </div>
                </td>
                <td class="header-right">
                    $photoHtml
                </td>
            </tr>
        </table>
    </div>

    <!-- 1. PROFIL EN RECONVERSION -->
    <div class="section">
        <h2>Profil &amp; Objectif Professionnel</h2>
        <div class="profil-block">
            En <strong>reconversion professionnelle motivée vers les métiers de l'électricité du bâtiment</strong> (Titre Professionnel Niveau 3 / CAP préparé avec l'Afpa Marseille La Treille), je souhaite m'investir pleinement au sein de votre entreprise en alternance. Issu d'un <strong>Bac STI2D</strong> (bases solides en énergie, électrotechnique et schémas) et d'un cursus axé sur la méthode et la logique, j'allie habileté manuelle, rigueur absolue et sens de la sécurité. Motivé, disponible immédiatement et véhiculé, je suis prêt à apprendre à vos côtés pour devenir rapidement autonome sur vos chantiers.
        </div>
    </div>

    <!-- 2. COMPÉTENCES CLÉS -->
    <div class="section">
        <h2>Compétences Clés &amp; Savoir-Faire</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Courants Forts &amp; Énergie</span>
                        <div class="skill-list">
                            &bull; <strong>Cheminement :</strong> Pose de gaines ICTA, moulures, goulottes et saignées<br>
                            &bull; <strong>Câblage :</strong> Tirage de câbles, pose d'appareillages (prises, éclairages, va-et-vient)<br>
                            &bull; <strong>Distribution :</strong> Implantation tableau, disjoncteurs, coffrets de commande<br>
                            &bull; <strong>Chauffage &amp; ECS :</strong> Raccordements appareils de chauffage et ballons
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Courants Faibles &amp; VDI</span>
                        <div class="skill-list">
                            &bull; <strong>Réseaux Comm. :</strong> Câblage VDI, prises RJ45, coffrets de communication<br>
                            &bull; <strong>Sécurité &amp; Accès :</strong> Interphonie, gâche électrique, sonnettes, visiophone<br>
                            &bull; <strong>Éco-Énergie :</strong> Détecteurs de présence, éclairage LED basse consommation<br>
                            &bull; <strong>Schémas :</strong> Lecture de plans d'architecte et schémas électriques unifilaires
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Sécurité &amp; Pratique Chantier</span>
                        <div class="skill-list">
                            &bull; <strong>Norme NF C 15-100 :</strong> Respect des calibres, sections et volumes<br>
                            &bull; <strong>Sécurité / EPI :</strong> Sensibilisation VAT, consignation, travail hors tension<br>
                            &bull; <strong>Outillage :</strong> Pince à dénuder, tournevis isolés 1000V, perforateur<br>
                            &bull; <strong>Mobilité BTP :</strong> Permis B + véhicule, ponctualité exemplaire
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- 3. EXPÉRIENCES & IMMERSION TERRAIN -->
    <div class="section">
        <h2>Expériences Professionnelles &amp; Pratique Chantier</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Aide-Ouvrier &amp; Pratique Chantier de Rénovation (Second Œuvre)</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Chantiers Résidentiels &amp; Rénovation — Région Marseillaise (Aide auprès d'artisans/proches)</div>
            <ul class="exp-list">
                <li>Aide au passage de gaines, tirage de conducteurs électriques (phases, neutres, terres) en cloisons et combles.</li>
                <li>Préparation des boîtes d'encastrement, fixation des supports et assistance à la pose d'appareillages muraux.</li>
                <li>Maintien de la propreté du chantier, tri sélectif des chutes de cuivre/gaines et respect strict des consignes de sécurité.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Stage d'Immersion Technique BTP &amp; Maintenance Sanitaire</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Entreprise de Maintenance &amp; Énergétique — Bouches-du-Rhône (13)</div>
            <ul class="exp-list">
                <li>Observation d'interventions techniques, découverte des alimentations électriques des équipements sanitaires/thermiques.</li>
                <li>Accompagnement de techniciens qualifiés, manipulation sécurisée de l'outillage et port systématique des EPI.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Gestion de Projet Technique, Logique &amp; Rigueur Méthodique</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Web@cadémie by Epitech Marseille — Formation intensive par projets</div>
            <ul class="exp-list">
                <li>Rigueur analytique, respect rigoureux des délais, des cahiers des charges et résolution méthodique d'imprévus.</li>
                <li>Travail en équipe quotidien, communication fluide et capacité d'adaptation rapide aux nouvelles technologies.</li>
            </ul>
        </div>
    </div>

    <!-- 4. FORMATIONS & DIPLÔMES -->
    <div class="section">
        <h2>Formation &amp; Diplômes</h2>
        <table class="edu-table">
            <tr>
                <td class="edu-cell edu-date">2026 - 2027<br><span style="font-size:7pt; color:#64748b;">(En préparation)</span></td>
                <td class="edu-cell">
                    <div class="edu-title">Titre Professionnel Électricien d'Équipement du Bâtiment (Niveau 3 - CAP/BEP)</div>
                    <div class="edu-sub">En partenariat avec l'Afpa Marseille La Treille &bull; Rythme : 3 semaines entreprise / 1 semaine Afpa</div>
                </td>
            </tr>
            <tr>
                <td class="edu-cell edu-date">2024 - 2025</td>
                <td class="edu-cell">
                    <div class="edu-title">Développeur Intégrateur Web (Niveau Bac+1)</div>
                    <div class="edu-sub">Web@cadémie by Epitech Marseille &bull; Rigueur de méthode, logique technique et gestion de planning</div>
                </td>
            </tr>
            <tr>
                <td class="edu-cell edu-date">2021 - 2022</td>
                <td class="edu-cell">
                    <div class="edu-title">Baccalauréat STI2D (Sciences et Technologies de l'Industrie et du Développement Durable)</div>
                    <div class="edu-sub">Lycée Denis Diderot Marseille &bull; Bases en énergie, systèmes électriques, schémas et sciences appliquées</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- 5. ATOUTS & SAVOIR-ÊTRE -->
    <div class="section">
        <h2>Qualités &amp; Savoir-Être</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Rigueur &amp; Concentration</div>
                        Attention méticuleuse aux détails, respect scrupuleux des normes de sécurité et des consignes.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Condition Physique &amp; Dynamisme</div>
                        Pratique sportive régulière (Basket-ball), endurance, goût de l'effort physique et travail manuel.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Autonomie &amp; Esprit d'Équipe</div>
                        Sens de l'écoute, ponctualité exemplaire, esprit d'entraide et volonté d'apprendre au contact des tuteurs.
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
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Electricien_Equipement_Batiment.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Electricien_Equipement_Batiment.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Electricien_Equipement_Batiment.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Électricien d'Équipement du Bâtiment (Alternance CAP) - Yacine Benbrik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 640px;
            margin: 60px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #d97706;
            border-radius: 8px;
            background: #ffffff;
        }
        .btn-electric {
            background-color: #d97706;
            border: 2px solid #d97706;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-electric:hover {
            background-color: #b45309;
            border-color: #b45309;
            color: white;
        }
        .badge-target {
            background-color: #0f172a;
            color: #f59e0b;
            font-size: 0.85rem;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <span class="badge-target">⚡ CIBLE ANNONCES AFPA • AUBAGNE / MARSEILLE / GARDANNE</span>
            <h1 class="mb-2">CV <span style="color:#d97706">Électricien d'Équipement</span></h1>
            <h4 class="text-secondary mb-3">Titre Pro Niveau 3 (CAP/BEP) en Alternance</h4>
            <p class="text-muted mb-4">
                CV spécialisé pour l'alternance en électricité du bâtiment : réseaux courants forts (armoires, câblage, appareillage) et courants faibles (VDI, communication, efficacité énergétique).
            </p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-electric btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Électricien du Bâtiment (PDF)
                </button>
            </form>
            <div class="mt-3">
                <a href="index.php" class="text-decoration-none text-muted small">← Retour au Hub Principal</a>
            </div>
        </div>
    </div>
</body>
</html>
