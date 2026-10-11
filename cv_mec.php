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
            line-height: 1.25;
            margin: 0;
            padding: 10px 25px;
            color: #1e293b;
            background-color: #fff;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            padding-bottom: 6px;
        }
        .header-left {
            width: 30%;
            font-size: 8.5pt;
            color: #64748b;
            vertical-align: middle;
            text-align: left;
        }
        .header-center {
            width: 50%;
            text-align: center;
            vertical-align: middle;
        }
        .header-right {
            width: 20%;
            text-align: right;
            vertical-align: middle;
        }
        .profile-photo {
            width: 75px;
            height: auto;
            border: 2px solid #0f766e;
            border-radius: 4px;
        }
        .header h1 { 
            font-size: 19pt; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: bold;
            color: #0f172a;
        }
        .header .subtitle { 
            font-size: 11pt; 
            font-weight: bold; 
            color: #0f766e; /* MEC Teal */
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #0f766e;
            color: white;
            font-size: 8.5pt;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 5px;
            font-weight: bold;
        }
        .rhythm {
            font-size: 8.5pt;
            color: #64748b;
            margin-top: 4px;
            font-weight: bold;
        }
        .contact-item {
            margin-bottom: 3px;
        }
        h2 {
            font-size: 9.5pt;
            text-transform: uppercase;
            border-bottom: 2px solid #e2e8f0;
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
            font-size: 8.5pt;
            color: #0f766e;
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
            font-size: 8.5pt; 
            margin-bottom: 3px; 
            font-style: italic;
        }
        ul { 
            margin: 3px 0 6px 15px; 
            padding: 0;
        }
        li { 
            margin-bottom: 3px; 
            font-size: 8.5pt; 
        }
        .skills-table {
            width: 95%;
            margin-left: 2.5%;
            border-collapse: collapse;
            margin-top: 6px;
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
            color: #0f766e;
            border-bottom: 1px solid #0f766e;
            display: block;
            padding-bottom: 2px;
        }
        .skill-list {
            font-size: 8.5pt;
            color: #1e293b;
            line-height: 1.45;
            margin-top: 4px;
        }
        .profil-block {
            margin-left: 110px;
            font-size: 9pt;
            padding: 8px 12px;
            background-color: #f1f5f9;
            border-left: 5px solid #0f766e;
            margin-bottom: 10px;
            line-height: 1.35;
        }
        strong { color: #0f172a; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td class="header-left">
                <div class="contact-item">50 Traverse Moulin de la Villette</div>
                <div class="contact-item">13003 Marseille</div>
                <div class="contact-item">07 67 63 84 45</div>
                <div class="contact-item">benbrikyacine60@gmail.com</div>
                <div class="contact-item">Permis B + Véhicule Personnel</div>
            </td>
            <td class="header-center">
                <div class="header">
                    <h1>Yacine BENBRIK</h1>
                    <div class="subtitle">Alternance BTS MEC / Économiste de la construction / Métreur</div>
                    <div class="search-objective">Recherche Alternance - BTS Management Économique de la Construction (MEC)</div>
                    <div class="rhythm">Rythme : Alternance École / Entreprise — Disponible immédiatement</div>
                </div>
            </td>
            <td class="header-right">
                $photoHtml
            </td>
        </tr>
    </table>

    <div class="section">
        <h2>Profil en Reconversion</h2>
        <div class="profil-block">
            Futur étudiant en <strong>BTS Management Économique de la Construction (MEC)</strong>, j'allie un solide bagage informatique et numérique à une pratique concrète du chantier. Issu d'un parcours technologique et informatique (STI2D, BTS SIO et Web@cadémie), je maîtrise la modélisation de bases de données, la logique algorithmique, et le traitement rigoureux des chiffres sur Excel. Parallèlement, ma pratique régulière sur des chantiers de rénovation m'apporte une connaissance physique des matériaux et des contraintes opérationnelles. Mon objectif est d'unir ce double profil bureau/terrain pour estimer, chiffrer et suivre l'économie de vos projets de construction avec une rigueur absolue et sans erreurs.
        </div>
    </div>

    <div class="section">
        <h2>Expériences Terrain & Gestion de Projet</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">Depuis 2022<br><span style="font-size: 7.5pt; font-weight: normal; color: #64748b;">(Régulier)</span></td>
                <td class="timeline-content">
                    <div class="item-title">Aide-Ouvrier & Assistant d'Équipe (Rénovation de chantiers)</div>
                    <div class="item-subtitle">Région Marseillaise (Cadre personnel & familial)</div>
                    <ul>
                        <li><strong>Sens du Matériau & Réalité Terrain :</strong> Travaux de démolition, préparation de supports, manutention lourde et observation des étapes de pose. Compréhension directe des rendements de main-d'œuvre et de la mise en œuvre.</li>
                        <li><strong>Organisation & Logistique :</strong> Gestion des stocks de matériaux sur site, réception et contrôle rigoureux de la conformité des livraisons, sécurisation des zones et application stricte des règles de sécurité (EPI).</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Gestion de Projets Digitaux & Analyse de Données</div>
                    <div class="item-subtitle">Web@cadémie by Epitech - Marseille</div>
                    <ul>
                        <li><strong>Modélisation & Algorithmique :</strong> Conception de structures de données, exécution de calculs complexes automatisés, planification de budgets de projets de développement et suivi de livraison.</li>
                        <li><strong>Rigueur & Précision :</strong> Travail d'équipe en méthodologie agile, respect de cahiers des charges rigides, et élimination méthodique des erreurs de logique ou de chiffrage.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Compétences Clés</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <span class="skill-cat">Économie & Numérique</span>
                    <div class="skill-list">
                        Calculs de coûts & Excel<br>
                        Modélisation de données<br>
                        Logique d'analyse financière<br>
                        Lecture de plans techniques<br>
                        Logiciels professionnels (CAO/DAO)
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Terrain & Matériaux</span>
                    <div class="skill-list">
                        Réalité physique du chantier<br>
                        Gestion des stocks sur site<br>
                        Contrôle de conformité<br>
                        Culture sécurité (EPI)<br>
                        Rendement de main-d'œuvre
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Atouts Personnels</span>
                    <div class="skill-list">
                        Rigueur absolue (zéro erreur)<br>
                        Mental d'acier (Résilience)<br>
                        Ponctualité absolue<br>
                        Esprit d'équipe & Écoute<br>
                        <strong>Permis B + Véhicule</strong>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Formations & Reconversion</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">Dès Sep. 2026</td>
                <td class="timeline-content">
                    <div class="item-title">Préparation BTS MEC (Management Économique de la Construction)</div>
                    <div class="item-subtitle">Recherche active d'entreprise d'accueil pour un contrat d'apprentissage de 24 mois.</div>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Développeur Intégrateur Web (Bac +1)</div>
                    <div class="item-subtitle">Web@cadémie by Epitech | Marseille - Travail en équipe, gestion de sprints</div>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">BTS SIO (Option SLAM)</div>
                    <div class="item-subtitle">Services Informatiques aux Organisations - Logique algorithmique & base de données</div>
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
</body>
</html>
HTML;
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("CV_Yacine_Benbrik_MEC.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Télécharger mon CV BTS MEC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .landing-card {
            max-width: 600px;
            margin: 100px auto;
            text-align: center;
            padding: 50px;
            border-top: 5px solid #0f766e;
        }

        .btn-primary {
            background-color: #0f766e;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
        }
        
        .btn-primary:hover {
            background-color: #0d5c55;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">Espace <span style="color:#0f766e">BTS MEC</span></h1>
            <p class="text-muted mb-5">Alternance BTS Management Économique de la Construction / Métreur / Économiste.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-primary btn-lg shadow w-100">
                    Télécharger mon CV BTS MEC (PDF)
                </button>
            </form>
            <div class="mt-4">
                <a href="index.php" class="text-decoration-none text-muted small">← Retour Menu</a>
            </div>
        </div>
    </div>
</body>

</html>
