<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['generate']) || (php_sapi_name() === 'cli' && isset($argv[1]) && $argv[1] === 'generate')) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');
    $dompdf = new Dompdf($options);

    $photoHtml = '';
    $photoPaths = ['profil accuel.jpg', 'profil_yacine.jpg'];
    foreach ($photoPaths as $path) {
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $photoHtml = '<img src="' . $base64 . '" class="profile-photo" alt="Photo">';
            break;
        }
    }
    if (empty($photoHtml)) {
        $photoHtml = '<img src="https://www.svgrepo.com/show/447833/user-profile.svg" class="profile-photo" alt="Photo">';
    }

    $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            margin: 14px 20px;
        }
        body {
            font-family: Helvetica, Arial, sans-serif;
            line-height: 1.35;
            margin: 0;
            padding: 0;
            color: #1e293b;
            background-color: #fff;
        }
        
        /* HEADER DESIGN */
        .header-box {
            background-color: #0f172a;
            color: #ffffff;
            padding: 9px 13px;
            border-radius: 6px;
            margin-bottom: 7px;
            border-bottom: 3.5px solid #dc2626;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-left {
            width: 36%;
            font-size: 8.1pt;
            color: #cbd5e1;
            vertical-align: middle;
            text-align: left;
            line-height: 1.4;
        }
        .header-center {
            width: 48%;
            text-align: center;
            vertical-align: middle;
        }
        .header-right {
            width: 16%;
            text-align: right;
            vertical-align: middle;
        }
        .header h1 { 
            font-size: 16pt; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.5px;
        }
        .header .subtitle { 
            font-size: 9.8pt; 
            font-weight: bold; 
            color: #ef4444;
            margin-top: 3px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #dc2626;
            color: #ffffff;
            font-size: 7.6pt;
            padding: 2.5px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 4px;
            font-weight: bold;
        }
        .rhythm {
            font-size: 7.6pt;
            color: #cbd5e1;
            margin-top: 3px;
            font-weight: 500;
        }
        .profile-photo {
            width: 65px;
            height: auto;
            border: 2px solid #ef4444;
            border-radius: 5px;
        }
        .contact-item {
            margin-bottom: 2px;
        }

        /* SECTION TITLES */
        h2 {
            font-size: 9.2pt;
            text-transform: uppercase;
            color: #0f172a;
            font-weight: bold;
            background-color: #f8fafc;
            border-bottom: 2px solid #dc2626;
            border-top: 1px solid #e2e8f0;
            padding: 3px 8px;
            margin-top: 6px;
            margin-bottom: 5px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        /* PROFIL BLOCK */
        .profil-block {
            font-size: 8pt;
            padding: 6px 11px;
            background-color: #f1f5f9;
            border-left: 4px solid #dc2626;
            margin-bottom: 5px;
            line-height: 1.38;
            color: #334155;
            text-align: justify;
        }

        /* SKILLS TABLE */
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
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            padding: 5px 7px;
            text-align: center;
        }
        .skill-cat { 
            font-weight: bold; 
            font-size: 8pt; 
            text-transform: uppercase; 
            color: #dc2626;
            margin-bottom: 3px; 
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 2px;
            display: block;
        }
        .skill-list {
            font-size: 7.6pt;
            color: #334155;
            line-height: 1.38;
            text-align: left;
        }

        /* EXPERIENCES */
        .exp-box {
            width: 100%;
            margin: 0 auto 5px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 5px 9px;
        }
        .exp-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }
        .exp-title {
            font-weight: bold;
            font-size: 8.6pt;
            color: #0f172a;
            text-align: left;
        }
        .exp-date {
            font-weight: bold;
            font-size: 8pt;
            color: #dc2626;
            text-align: right;
        }
        .exp-subtitle {
            font-size: 7.6pt;
            color: #64748b;
            font-style: italic;
            margin-bottom: 3px;
            text-align: left;
        }
        ul.exp-list {
            margin: 2px 0 2px 14px;
            padding: 0;
            text-align: left;
        }
        ul.exp-list li {
            font-size: 7.6pt;
            color: #334155;
            margin-bottom: 2px;
            line-height: 1.35;
        }

        /* EDUCATION & DETAILS TABLE */
        .bottom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }
        .bottom-col {
            vertical-align: top;
            padding: 0 4px;
        }
        .bottom-card {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            padding: 5px 9px;
            font-size: 7.6pt;
            line-height: 1.38;
        }
        .bottom-title {
            font-weight: bold;
            font-size: 8pt;
            color: #0f172a;
            border-bottom: 1.5px solid #dc2626;
            padding-bottom: 2px;
            margin-bottom: 4px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="header-box">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="contact-item"><strong>Adresse :</strong> Zone Frontalière (France Voisine - Éligible Permis G)</div>
                    <div class="contact-item"><strong>Tél :</strong> +33 7 67 63 84 45 (Ligne directe)</div>
                    <div class="contact-item"><strong>E-mail :</strong> benbrikyacine60@gmail.com</div>
                    <div class="contact-item"><strong>Dossier :</strong> Casier judiciaire vierge + Non-poursuites</div>
                    <div class="contact-item"><strong>Statut :</strong> Frontalier (Permis G) | Mobilité Vaud & Genève</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Agent Logistique • Manutentionnaire • Cariste</div>
                        <div class="search-objective">PRÉPARATION DE COMMANDES • GESTION DE STOCKS • MANUTENTION</div>
                        <div class="rhythm">Poste Frontalier | Rigueur & Cadence | Horaires Postés 2x8 / 3x8 / Nuit</div>
                    </div>
                </td>
                <td class="header-right">
                    $photoHtml
                </td>
            </tr>
        </table>
    </div>

    <h2>Profil Professionnel</h2>
    <div class="profil-block">
        Agent logistique polyvalent, dynamique et très endurant, fort d'une solide expérience au sein d'entrepôts de distribution et plateformes logistiques à forte cadence. Habitué au travail sous contrainte de temps et aux horaires postés (matin, soir, nuit, 2x8 / 3x8). Expert en préparation de commandes (picking / RF), chargement/déchargement de camions, gerbage et utilisation d'outils de manutention (transpalettes manuels et électriques, gerbeurs). Rigoureux sur les normes de sécurité (EPI, gestes et postures, sécurité des quais) et garant du zéro-erreur de stock. Dossier administratif complet (Casier judiciaire vierge, attestation de non-poursuites). Disponibilité immédiate.
    </div>

    <h2>Compétences Clés & Habilitations</h2>
    <table class="skills-table">
        <tr>
            <td class="skills-column">
                <div class="skill-card">
                    <span class="skill-cat">Préparation & Stocks</span>
                    <div class="skill-list">
                        • Préparation de commandes & Picking RF/WMS<br>
                        • Contrôle qualité, inventaire & étiquetage<br>
                        • Réception de marchandises & mise en stock<br>
                        • Emballage, palettisation & filmage
                    </div>
                </div>
            </td>
            <td class="skills-column">
                <div class="skill-card">
                    <span class="skill-cat">Manutention & Engins</span>
                    <div class="skill-list">
                        • Chargement / Déchargement rapide de camions<br>
                        • Transpalettes manuels & électriques (conducteur porté)<br>
                        • Gerbeurs électriques & gerbage en hauteur<br>
                        • Sécurité des quais & plan de circulation
                    </div>
                </div>
            </td>
            <td class="skills-column">
                <div class="skill-card">
                    <span class="skill-cat">Garanties & Savoir-être</span>
                    <div class="skill-list">
                        • Ponctualité exemplaire & forte endurance<br>
                        • Respect strict des cadences & objectifs<br>
                        • Flexibilité totale (2x8 / 3x8 / Nuit / Week-end)<br>
                        • Permis B + Véhicule (Autonomie totale)
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <h2>Expériences Professionnelles</h2>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Agent Logistique Polyvalent & Préparateur de Commandes</td>
                <td class="exp-date">Janvier 2025 – Présent</td>
            </tr>
        </table>
        <div class="exp-subtitle">Plateforme Logistique & Entrepôt de Distribution (Hub Industriel)</div>
        <ul class="exp-list">
            <li><strong>Préparation & Picking WMS :</strong> Préparation de commandes à cadence soutenue via pistolet scanner/RF, prélèvement d'articles, vérification des références et conditionnement.</li>
            <li><strong>Manutention & Transpalette Électrique :</strong> Déplacement de charges lourdes, gerbage et constitution de palettes homogènes (filmage étirable et cerclage).</li>
            <li><strong>Expédition & Contrôle :</strong> Contrôle final des bordereaux de livraison, pesée, étiquetage des palettes et acheminement vers les zones d'expédition quais.</li>
        </ul>
    </div>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Manutentionnaire & Agent de Réception / Expédition</td>
                <td class="exp-date">Mai 2024 – Décembre 2024</td>
            </tr>
        </table>
        <div class="exp-subtitle">Centre Logistique Grande Distribution & Retail</div>
        <ul class="exp-list">
            <li><strong>Déchargement & Réception :</strong> Déchargement de camions et conteneurs (cadence soutenue), contrôle de la conformité des arrivages et signalement des avaries.</li>
            <li><strong>Mise en Stock & Racks :</strong> Approvisionnement des alvéoles de stockage et zones de picking, rangement méthodique des marchandises en hauteur.</li>
            <li><strong>Tri & Palettisation :</strong> Tri sélectif des colis par transporteur/destination, palettisation optimisée pour le transport sécurisé.</li>
        </ul>
    </div>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Préparateur de Commandes & Cariste de Manutention</td>
                <td class="exp-date">Octobre 2023 – Avril 2024</td>
            </tr>
        </table>
        <div class="exp-subtitle">Entreprise de Transport, Messagerie & Fret Logistique</div>
        <ul class="exp-list">
            <li><strong>Gestion des Cadences :</strong> Exécution rapide des commandes en respectant scrupuleusement les délais de départ des transporteurs et objectifs qualitatifs.</li>
            <li><strong>Conduite d'Engins de Manutention :</strong> Utilisation intensive de transpalettes électriques à conducteur porté et gerbeurs pour transferts inter-zones.</li>
            <li><strong>Qualité & Sécurité :</strong> Application stricte des consignes de sécurité sur quai (port des EPI obligatoires, respect du plan de circulation piétons/engins).</li>
        </ul>
    </div>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Agent de Manutention & Stockage (Vacations de Nuit / Horaires Postés)</td>
                <td class="exp-date">Janvier 2022 – Septembre 2023</td>
            </tr>
        </table>
        <div class="exp-subtitle">Entrepôt Logistique & Plateforme d'Expédition</div>
        <ul class="exp-list">
            <li><strong>Horaires Postés (Nuit) :</strong> Travail en équipe de nuit sur la préparation des flux du lendemain matin avec une fiabilité et une assiduité totales.</li>
            <li><strong>Chargement de Camions :</strong> Optimisation du volume de chargement des poids-lourds (stacking), arrimage et sécurisation du fret avant départ.</li>
            <li><strong>Inventaires & Entretien :</strong> Participation aux inventaires tournants de stock et maintien d'un espace de travail propre, sécurisé et ordonné.</li>
        </ul>
    </div>

    <h2>Formations, Certifications & Informations Complémentaires</h2>
    <table class="bottom-table">
        <tr>
            <td class="bottom-col" style="width: 50%;">
                <div class="bottom-card">
                    <div class="bottom-title">Formations & Qualifications</div>
                    <strong>2023 :</strong> Formation Logistique d'Entrepôt & Manutention Électrique<br>
                    <strong>2023 :</strong> Certificat SST (Sauveteur Secouriste du Travail / Gestes & Postures)<br>
                    <strong>2021 :</strong> Enseignement Secondaire / Formation Technique & Métiers du Terrain
                </div>
            </td>
            <td class="bottom-col" style="width: 50%;">
                <div class="bottom-card">
                    <div class="bottom-title">Garanties, Langues & Permis</div>
                    <strong>Dossier :</strong> Casier judiciaire vierge + Attestation non-poursuites<br>
                    <strong>Langues :</strong> Français (Maternelle C2), Anglais (A2 - Notions Logistiques)<br>
                    <strong>Permis :</strong> Permis B + Véhicule (Mobilité Genève, Vaud, Valais, France Voisine)
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Logistique_Suisse.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Logistique_Suisse.pdf\n";
        exit;
    } else {
        $dompdf->stream("CV_Yacine_Logistique_Suisse.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Agent Logistique & Manutention - Standard Suisse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #dc2626;
            border-radius: 8px;
        }
        .btn-danger {
            background-color: #dc2626;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-danger:hover {
            background-color: #b91c1c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#dc2626">Logistique & Manutention Suisse</span></h1>
            <p class="text-muted mb-4">Agent Logistique / Manutentionnaire / Cariste / Préparateur de Commandes — Normes Suisse Romande (1 page)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-danger btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV (PDF)
                </button>
            </form>
            <div>
                <a href="index.php" class="text-decoration-none text-muted small">← Retour au Hub</a>
            </div>
        </div>
    </div>
</body>
</html>
