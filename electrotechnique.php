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
            border: 2px solid #ea580c;
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
            color: #ea580c; /* Electric/BTP Orange */
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #ea580c;
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
            color: #ea580c;
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
            color: #ea580c;
            border-bottom: 1px solid #ea580c;
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
            border-left: 5px solid #ea580c;
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
                    <div class="subtitle">Alternance BTS Électrotechnique / Assistant Conducteur de Travaux</div>
                    <div class="search-objective">Recherche Alternance - BTS Électrotechnique (Énergie & Électricité)</div>
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
            Futur étudiant en <strong>BTS Électrotechnique</strong>, j'allie un mental dur comme l'acier à une solide expérience pratique des chantiers. Issu d'un parcours initial technologique et informatique (STI2D, BTS SIO et Web@cadémie), ma reconversion professionnelle s'appuie sur une double force : la rigueur de planification, de logistique et d'analyse d'une part, et l'amour du travail de terrain d'autre part. Passionné par l'électricité, la technique et l'organisation, je sais porter du matériel lourd et travailler dans des conditions exigeantes tout en comprenant parfaitement les impératifs de planning, de sécurité et d'efficacité d'un chantier. Mon objectif : mettre mon énergie et ma rigueur au service de vos chantiers pour devenir un conducteur de travaux performant.
        </div>
    </div>

    <div class="section">
        <h2>Expériences Terrain & Organisation de Chantier</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">Depuis 2022<br><span style="font-size: 7.5pt; font-weight: normal; color: #64748b;">(Régulier)</span></td>
                <td class="timeline-content">
                    <div class="item-title">Aide-Ouvrier & Assistant d'Équipe (Rénovation de chantiers)</div>
                    <div class="item-subtitle">Région Marseillaise (Cadre personnel & familial)</div>
                    <ul>
                        <li><strong>Côté Technique (Pour le BTS) :</strong> Aide aux raccordements électriques simples, passage de gaines, tirage de câbles, pose d'appareillages, maniement d'outillage électroportatif (perceuse, meuleuse) et préparation des supports.</li>
                        <li><strong>Côté Organisation (Pour la Conduite de Travaux) :</strong> Logistique (gestion des stocks sur site, réception des livraisons, conformité des pièces) et suivi de chantier (sécurisation, nettoyage permanent, application stricte des EPI).</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Coordination de Projet & Développement Digital</div>
                    <div class="item-subtitle">Web@cadémie by Epitech - Marseille</div>
                    <ul>
                        <li><strong>Organisation & Planification :</strong> Méthodologie agile, planification de sprints, répartition des tâches dans l'équipe et suivi du planning.</li>
                        <li><strong>Rigueur :</strong> Analyse technique, respect strict des exigences de conformité et des délais.</li>
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
                    <span class="skill-cat">Technique & Chantier</span>
                    <div class="skill-list">
                        Lecture de plans simples<br>
                        Passage de gaines & Câblage<br>
                        Maniement d'outillage<br>
                        Culture sécurité (Zéro Accident)<br>
                        Raccordements de base
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Organisation & Poste</span>
                    <div class="skill-list">
                        Logistique & Gestion de stock<br>
                        Contrôle de conformité<br>
                        Esprit d'équipe & Entraide<br>
                        Anticipation des besoins terrain<br>
                        Suivi et propreté de chantier
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Profil & Atouts</span>
                    <div class="skill-list">
                        Mental d'acier (Détermination)<br>
                        Endurance & Résistance stress<br>
                        Ponctualité absolue<br>
                        Sens du détail & Rigueur<br>
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
                    <div class="item-title">Préparation BTS Électrotechnique (Alternance)</div>
                    <div class="item-subtitle">Recherche active d'entreprise d'accueil pour un contrat d'apprentissage de 24 mois.</div>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Développeur Intégrateur Web (Bac +1)</div>
                    <div class="item-subtitle">Web@cadémie by Epitech | Marseille - Apprentissage par projets, travail collaboratif</div>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">BTS SIO (Option SLAM)</div>
                    <div class="item-subtitle">Services Informatiques aux Organisations - Solutions Logicielles</div>
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
    $dompdf->stream("CV_Yacine_Benbrik_Electrotechnique.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Télécharger mon CV BTS Électrotechnique / Conducteur de Travaux</title>
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
            border-top: 5px solid #ea580c;
        }

        .btn-primary {
            background-color: #ea580c;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
        }
        
        .btn-primary:hover {
            background-color: #c2410c;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">Espace <span style="color:#ea580c">Électrotechnique</span></h1>
            <p class="text-muted mb-5">Alternance BTS Électrotechnique / Assistant Conducteur de Travaux.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-primary btn-lg shadow w-100">
                    Télécharger mon CV Électrotechnique (PDF)
                </button>
            </form>
            <div class="mt-4">
                <a href="index.php" class="text-decoration-none text-muted small">← Retour Menu</a>
            </div>
        </div>
    </div>
</body>

</html>
