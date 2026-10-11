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
            margin-bottom: 20px;
            padding-bottom: 12px;
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
            border: 2px solid #2563eb;
            border-radius: 4px;
        }
        .header h1 { 
            font-size: 20pt; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: bold;
            color: #0f172a;
        }
        .header .subtitle { 
            font-size: 12pt; 
            font-weight: bold; 
            color: #2563eb; /* Blue for refrigeration */
            margin-top: 3px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #2563eb;
            color: white;
            font-size: 8.5pt;
            padding: 4px 10px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 6px;
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
            font-size: 10pt;
            text-transform: uppercase;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 3px;
            margin-top: 15px;
            margin-bottom: 10px;
            font-weight: bold;
            color: #0f172a;
        }
        .timeline-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        .timeline-date {
            width: 105px;
            text-align: right;
            vertical-align: top;
            padding-right: 15px;
            font-weight: bold;
            font-size: 8.5pt;
            color: #2563eb;
        }
        .timeline-content {
            vertical-align: top;
            padding-bottom: 6px;
        }
        .item-title { 
            font-weight: bold; 
            font-size: 9.5pt; 
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
            margin-top: 8px;
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
            margin-bottom: 6px; 
            color: #2563eb;
            border-bottom: 1px solid #2563eb;
            display: block;
            padding-bottom: 2px;
        }
        .skill-list {
            font-size: 8.5pt;
            color: #1e293b;
            line-height: 1.5;
            margin-top: 5px;
        }
        .profil-block {
            margin-left: 110px;
            font-size: 9pt;
            padding: 10px 15px;
            background-color: #f1f5f9;
            border-left: 5px solid #2563eb;
            margin-bottom: 12px;
            line-height: 1.4;
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
                    <div class="subtitle">Alternance Technicien Frigoriste / CVC</div>
                    <div class="search-objective">Recherche Alternance - Technicien Froid & Climatisation (CVC)</div>
                    <div class="rhythm">Rythme : Alternance École / Entreprise — Disponible immédiatement</div>
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
            En reconversion passionnée vers les métiers du <strong>Génie Climatique (Chaud et Froid)</strong>, je recherche une alternance pour préparer mon BTS MS Option B en septembre 2026. Fort de mes premières expériences concrètes sur le terrain en tant qu'<strong>aide-technicien frigoriste</strong> et <strong>aide-chauffagiste</strong> à Marseille, j'ai développé des compétences pratiques (tirage au vide, brasage sous azote, câblage, raccordements hydrauliques). <strong>Disponible, rigoureux et soucieux de la sécurité</strong>, je souhaite m'investir pleinement au sein de vos équipes.
        </div>
    </div>

    <div class="section">
        <h2>Expériences Professionnelles (Génie Climatique & Froid)</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">Oct. 2025 - Avr. 2026</td>
                <td class="timeline-content">
                    <div class="item-title">Aide-Technicien Frigoriste (Froid Commercial & Climatisation)</div>
                    <div class="item-subtitle">Provence Froid Service - Marseille</div>
                    <ul>
                        <li><strong>Dépannage & Entretien :</strong> Diagnostic de pannes sur chambres froides (positives/négatives) et VRV, remplacement de filtres et nettoyage des condenseurs/évaporateurs.</li>
                        <li><strong>Installations techniques :</strong> Pose de liaisons en cuivre, isolation thermique, brasage sous azote, tirage au vide des circuits et contrôles d'étanchéité réglementaires.</li>
                        <li><strong>Sécurité & Normes :</strong> Manipulation assistée de fluides frigorigènes et tenue réglementaire des fiches d'intervention.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">Juin 2025 - Sep. 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Aide-Technicien Chauffagiste & CVC (Thermique & Sanitaire)</div>
                    <div class="item-subtitle">Phocéenne de Chauffage - Marseille</div>
                    <ul>
                        <li><strong>Installation de chauffage :</strong> Pose et raccordement hydraulique de chaudières murales à condensation (gaz) et de pompes à chaleur (PAC) air-eau et air-air.</li>
                        <li><strong>Réseaux fluidiques :</strong> Cintrage de tubes cuivre, pose de canalisations PER et Multicouche pour circuits de chauffage et radiateurs.</li>
                        <li><strong>Mise en service :</strong> Purge des circuits de chauffage, réglage de la régulation et des thermostats d'ambiance.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Atouts & Compétences</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <span class="skill-cat">Savoir-être</span>
                    <div class="skill-list">
                        Assiduité & Ponctualité<br>
                        Curiosité & Prise d'initiative<br>
                        Esprit d'équipe affirmé<br>
                        Sens des responsabilités
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Savoir-faire Technique</span>
                    <div class="skill-list">
                        Brasage cuivre & Tuyauterie<br>
                        Tirage au vide & Tests azote<br>
                        Lecture de schémas (CVC)<br>
                        Câblage de régulation de base
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Méthodologie</span>
                    <div class="skill-list">
                        Rigueur sécurité maximale<br>
                        Logique de diagnostic panne<br>
                        Organisation & Propreté<br>
                        <strong>Permis B + Véhicule</strong>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Formations & Diplômes</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">Sep. 2026</td>
                <td class="timeline-content">
                    <div class="item-title">Préparation BTS Maintenance des Systèmes (MS)</div>
                    <div class="item-subtitle">Option B : Systèmes Énergétiques et Fluidiques | En recherche d’entreprise</div>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Développeur Intégrateur Web (Bac +1)</div>
                    <div class="item-subtitle">Web@cadémie by Epitech | Marseille</div>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">BTS SIO (Option SLAM)</div>
                    <div class="item-subtitle">Services Informatiques aux Organisations - Solutions Logicielles et Applications Métiers</div>
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
    $dompdf->stream("CV_Yacine_Benbrik_Frigoriste.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Télécharger mon CV Frigoriste (Chaud & Froid)</title>
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
            border-top: 5px solid #2563eb;
        }

        .btn-primary {
            background-color: #2563eb;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">Espace <span class="text-primary">Technique</span></h1>
            <p class="text-muted mb-5">Technicien CVC / Frigoriste - Génie Climatique (Chaud & Froid).</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-primary btn-lg shadow">
                    Télécharger mon CV CVC / Frigoriste (Chaud & Froid) (PDF)
                </button>
            </form>
            <div class="mt-4">
                <a href="index.php" class="text-decoration-none text-muted small">← Retour Menu</a>
            </div>
        </div>
    </div>
</body>

</html>