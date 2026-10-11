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
            margin: 14px 20px;
        }
        body {
            font-family: Helvetica, Arial, sans-serif;
            line-height: 1.25;
            margin: 0;
            padding: 0;
            color: #1e293b;
            background-color: #fff;
        }
        
        /* HEADER CENTERED DESIGN */
        .header-box {
            background-color: #0f172a;
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 5px;
            margin-bottom: 10px;
            border-bottom: 3px solid #d97706;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-left {
            width: 33%;
            font-size: 8pt;
            color: #cbd5e1;
            vertical-align: middle;
            text-align: left;
            line-height: 1.35;
        }
        .header-center {
            width: 49%;
            text-align: center;
            vertical-align: middle;
        }
        .header-right {
            width: 18%;
            text-align: right;
            vertical-align: middle;
        }
        .header h1 { 
            font-size: 17pt; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.5px;
        }
        .header .subtitle { 
            font-size: 10pt; 
            font-weight: bold; 
            color: #f59e0b;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #d97706;
            color: #ffffff;
            font-size: 7.5pt;
            padding: 2px 8px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 4px;
            font-weight: bold;
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

        /* CENTERED SECTION TITLES WITH SPACING */
        h2 {
            font-size: 9.5pt;
            text-transform: uppercase;
            color: #0f172a;
            font-weight: bold;
            background-color: #f8fafc;
            border-bottom: 1.5px solid #d97706;
            border-top: 1px solid #e2e8f0;
            padding: 3px 0;
            margin-top: 8px;
            margin-bottom: 6px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        /* 1. COMPÉTENCES CLÉS */
        .skills-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }
        .skills-column {
            width: 33%;
            vertical-align: top;
            padding: 0 4px;
        }
        .skill-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 6px 8px;
            text-align: center;
        }
        .skill-cat { 
            font-weight: bold; 
            font-size: 8.5pt; 
            text-transform: uppercase; 
            color: #d97706;
            margin-bottom: 4px; 
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 2px;
            display: block;
        }
        .skill-list {
            font-size: 8pt;
            color: #334155;
            line-height: 1.35;
            text-align: left;
        }

        /* CENTERED TIMELINE & EXPÉRIENCES */
        .exp-box {
            width: 96%;
            margin: 0 auto 5px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 5px 9px;
        }
        .exp-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
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
            font-size: 7.5pt;
            color: #64748b;
            font-style: italic;
            margin-bottom: 2px;
            text-align: left;
        }
        ul.exp-list {
            margin: 1px 0 2px 14px;
            padding: 0;
            text-align: left;
        }
        ul.exp-list li {
            font-size: 8pt;
            color: #334155;
            margin-bottom: 1px;
            line-height: 1.25;
        }

        /* PROFIL EN RECONVERSION */
        .profil-block {
            font-size: 8.5pt;
            padding: 6px 10px;
            background-color: #fffbebfb;
            border: 1px solid #fde68a;
            border-left: 4px solid #d97706;
            margin: 5px auto 6px auto;
            width: 94%;
            line-height: 1.35;
            color: #1e293b;
            border-radius: 4px;
            text-align: center;
        }

        /* HOBBIES / CENTRES D'INTÉRÊT */
        .hobbies-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        .hobby-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 5px 8px;
            text-align: center;
        }
        .hobby-item {
            width: 33%;
            vertical-align: top;
            padding: 0 4px;
            font-size: 8pt;
            line-height: 1.25;
            color: #334155;
        }
        .hobby-title {
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 2px;
            font-size: 8.5pt;
        }
        strong { color: #0f172a; }
    </style>
</head>
<body>

    <!-- HEADER BLOCK DESIGN -->
    <div class="header-box">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="contact-item">50 Trav. Moulin de la Villette</div>
                    <div class="contact-item">13003 Marseille (Campus Solive)</div>
                    <div class="contact-item">Tel : 07 67 63 84 45</div>
                    <div class="contact-item">Email : benbrikyacine60@gmail.com</div>
                    <div class="contact-item" style="color:#f59e0b;"><strong>Permis B + Véhicule Personnel</strong></div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Conducteur de Travaux (La Solive)</div>
                        <div class="search-objective">CANDIDATURE ALTERNANCE — MARSEILLE &amp; AVIGNON</div>
                    </div>
                </td>
                <td class="header-right">
                    $photoHtml
                </td>
            </tr>
        </table>
    </div>

    <!-- 1. COMPÉTENCES CLÉS (ALIGNÉES CRITÈRES LA SOLIVE) -->
    <div class="section">
        <h2>Compétences Clés</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Aisance Numérique (Solive)</span>
                        <div class="skill-list">
                            • <strong>Outils Digitaux :</strong> Suivi de projet &amp; plannings<br>
                            • <strong>Tableaux de Bord :</strong> Excel, formules &amp; suivi<br>
                            • <strong>Organisation :</strong> Rigueur &amp; gestion du temps<br>
                            • <strong>Agilité :</strong> Prise en main rapide d'applis
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Bases BTP &amp; STI2D</span>
                        <div class="skill-list">
                            • <strong>Systèmes Constructifs :</strong> Culture STI2D<br>
                            • <strong>Préparation Chantier :</strong> Logistique &amp; stock<br>
                            • <strong>Sécurité &amp; EPI :</strong> Consignes &amp; normes QSE<br>
                            • <strong>Lecture de Plans :</strong> Plans simples &amp; notices
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Critères &amp; Atouts</span>
                        <div class="skill-list">
                            • <strong>Permis B + Véhicule :</strong> Mobilité Avignon<br>
                            • <strong>Motivation :</strong> Projet de reconversion BTP<br>
                            • <strong>Mental Sportif :</strong> Basketteur Semi-Pro<br>
                            • <strong>Français :</strong> Maîtrise parfaite orale &amp; écrite
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- 2. EXPÉRIENCES -->
    <div class="section">
        <h2>Expériences</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Organisation de Projets Digitaux &amp; Suivi d'Échéances</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Web@cadémie by Epitech Marseille</div>
            <ul class="exp-list">
                <li>Gestion des priorités, plannings de projet et suivi rigoureux des livrables.</li>
                <li>Pratique quotidienne des outils numériques d'organisation et travail en équipe.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Stage d'Immersion Technique BTP / Sanitaire (1 semaine)</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Énergétique Sanitaire (Région Marseillaise)</div>
            <ul class="exp-list">
                <li>Découverte des interventions techniques, observation des installations thermiques et sanitaires.</li>
                <li>Accompagnement sur le terrain, sensibilisation aux règles de sécurité et port des EPI.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Accompagnement Terrain &amp; Observation Pratique</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Chantiers de Rénovation (Aide ponctuelle auprès de professionnels/proches)</div>
            <ul class="exp-list">
                <li>Observation des phases de travaux, aide au rangement et préparation des zones d'intervention.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Analyse Chiffrée &amp; Logique de Projet</td>
                    <td class="exp-date">2022 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">BTS SIO &amp; Projets Techniques</div>
            <ul class="exp-list">
                <li>Utilisation des tableurs informatiques pour la création d'outils de suivi automatisés.</li>
            </ul>
        </div>
    </div>

    <!-- 3. PROFIL EN RECONVERSION (SPÉCIAL LA SOLIVE - MAX 3 LINES) -->
    <div class="section">
        <h2>Profil en Reconversion</h2>
        <div class="profil-block">
            Titulaire d'un Bac STI2D et très à l'aise avec les outils numériques (Epitech), je souhaite intégrer la formation La Solive pour devenir Conducteur de Travaux en alternance.<br>
            Titulaire du Permis B et véhiculé, je suis ultra-motivé pour suivre le BootCamp à Marseille puis m'investir sur le terrain à Avignon.
        </div>
    </div>

    <!-- 4. CENTRES D'INTÉRÊT & LOISIRS -->
    <div class="section">
        <h2>Centres d'Intérêt &amp; LoisIRS</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basketteur Semi-Pro</div>
                        Esprit de compétition, leadership, discipline et gestion du stress.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Pratique Sportive</div>
                        Forme physique, goût du dépassement de soi et régularité.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Mangas &amp; Animés</div>
                        Esprit d'analyse, concentration, culture japonaise et persévérance.
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- 5. FORMATION ET RECONVERSION -->
    <div class="section">
        <h2>Formation et Reconversion</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Conducteur de Travaux (Candidature La Solive)</td>
                    <td class="exp-date">2026 - 2027</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Alternance : 3 mois Campus Marseille + 9 mois Entreprise Avignon (Titre Pro Bac +2)</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Développeur Intégrateur Web (Bac +1)</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Web@cadémie by Epitech Marseille — Aisance numérique &amp; logique de projet</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Analyse de données &amp; bureautique avancée</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Sciences et Technologies de l'Industrie — Bases BTP &amp; Systèmes Constructifs</div>
        </div>
    </div>
</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_La_Solive.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_La_Solive.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_La_Solive.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Conducteur de Travaux - Candidature La Solive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #d97706;
            border-radius: 8px;
        }
        .btn-warning {
            background-color: #d97706;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-warning:hover {
            background-color: #b45309;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#d97706">Spécial La Solive</span></h1>
            <p class="text-muted mb-4">Formation Conducteur de Travaux en Alternance (Marseille / Avignon)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-warning btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Spécial La Solive (PDF)
                </button>
            </form>
            <div>
                <a href="index.php" class="text-decoration-none text-muted small">← Retour au Hub</a>
            </div>
        </div>
    </div>
</body>
</html>
