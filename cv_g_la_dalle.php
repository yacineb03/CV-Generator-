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
            line-height: 1.25;
            margin: 0;
            padding: 0;
            color: #1e293b;
            background-color: #fff;
        }
        
        .header-box {
            background-color: #0f172a;
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 5px;
            margin-bottom: 8px;
            border-bottom: 3.5px solid #ea580c;
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
            color: #fb923c;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #ea580c;
            color: #ffffff;
            font-size: 7.5pt;
            padding: 2.5px 8px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 4px;
            font-weight: bold;
            letter-spacing: 0.3px;
        }
        .profile-photo {
            width: 70px;
            height: auto;
            border: 2px solid #f97316;
            border-radius: 4px;
        }
        .contact-item {
            margin-bottom: 2px;
        }

        h2 {
            font-size: 9.2pt;
            text-transform: uppercase;
            color: #0f172a;
            font-weight: bold;
            background-color: #f8fafc;
            border-bottom: 1.5px solid #ea580c;
            border-top: 1px solid #e2e8f0;
            padding: 3px 0;
            margin-top: 7px;
            margin-bottom: 5px;
            text-align: center;
            letter-spacing: 0.5px;
        }

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
            color: #ea580c;
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

        .exp-box {
            width: 96%;
            margin: 0 auto 4px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 4px 8px;
        }
        .exp-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1px;
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
            color: #ea580c;
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

        .profil-block {
            font-size: 8.5pt;
            padding: 6px 10px;
            background-color: #fff7ed;
            border: 1px solid #ffedd5;
            border-left: 4px solid #ea580c;
            margin: 5px auto 6px auto;
            width: 94%;
            line-height: 1.35;
            color: #1e293b;
            border-radius: 4px;
            text-align: center;
        }

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

    <div class="header-box">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="contact-item">Marseille (13) &bull; France</div>
                    <div class="contact-item">Tel : 07 67 63 84 45</div>
                    <div class="contact-item">Email : benbrikyacine60@gmail.com</div>
                    <div class="contact-item" style="color:#fb923c;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">Disponibilité Immédiate &bull; Soirs &amp; Week-ends</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Équipier Polyvalent de Restauration Rapide</div>
                        <div class="search-objective">G-LA DALLE — BURGER &amp; SERVICE</div>
                    </div>
                </td>
                <td class="header-right">
                    $photoHtml
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Compétences Clés</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Cuisine &amp; Fast-Food</span>
                        <div class="skill-list">
                            &bull; <strong>Assemblage Minute :</strong> Burgers, sauces, frites<br>
                            &bull; <strong>Grill &amp; Friture :</strong> Respect des temps de cuisson<br>
                            &bull; <strong>Hygiène HACCP :</strong> Nettoyage rigoureux &amp; désinfection<br>
                            &bull; <strong>Conditionnement :</strong> Emballage soigné &amp; contrôle
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Service &amp; Flux Rush</span>
                        <div class="skill-list">
                            &bull; <strong>Commandes Emporté &amp; Livraisons :</strong> Uber/Deliveroo<br>
                            &bull; <strong>Encaissement Rapide :</strong> TPE, espèces, caisse tactile<br>
                            &bull; <strong>Cadence Soutenue :</strong> Réactivité lors des pics de soirées<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Entraide permanente au passe
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Disponibilité &amp; Profil</span>
                        <div class="skill-list">
                            &bull; <strong>Disponibilité Totale :</strong> Soirs &amp; fins de semaine<br>
                            &bull; <strong>Autonomie :</strong> Permis B et véhicule pour fermetures<br>
                            &bull; <strong>Dynamisme Physique :</strong> Rapidité gestuelle et tonicité<br>
                            &bull; <strong>Sérieux :</strong> Ponctualité stricte et engagement
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Expériences Professionnelles</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Équipier Fast-Food &amp; Préparateur de Commandes</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Enseigne de Restauration Rapide &amp; Burgers — Marseille (Forte Affluence)</div>
            <ul class="exp-list">
                <li>Préparation et montage cadencé des burgers à la commande avec respect rigoureux des fiches techniques.</li>
                <li>Gestion du flux des commandes comptoir, bornes et dispatch des sacs coursiers (Uber Eats, Deliveroo) sans inversion.</li>
                <li>Maintien irréprochable de la propreté du poste cuisine, réapprovisionnement des sauces et conditionnements.</li>
                <li>Participation active aux opérations de clôture, dégraissage des équipements et respect des normes HACCP.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Employé Polyvalent de Restauration &amp; Service au Comptoir</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Snack &amp; Restauration Urbaine — Marseille Centre</div>
            <ul class="exp-list">
                <li>Accueil souriant des clients, prise de commande efficace et encaissements rapides aux heures de pointe.</li>
                <li>Cuisson des viandes au grill et frites minute dans le respect de la chaîne du froid et de l'hygiène alimentaire.</li>
                <li>Approvisionnement des stocks frigos et contrôle quotidien de la fraîcheur des ingrédients.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Travail d'Équipe Intensif &amp; Résolution Réactive</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Projets Collectifs &amp; Formation Technique — Marseille</div>
            <ul class="exp-list">
                <li>Coordination fluide sous contrainte de temps, réactivité face aux imprévus et excellente communication.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Très motivé, vif et rigoureux, je souhaite intégrer l'équipe <strong>G-La Dalle</strong> en tant qu'équipier polyvalent.<br>
            Habitué au rythme intense de la restauration rapide, je sais garder mon calme et ma rapidité en plein rush pour garantir des commandes parfaites et un service impeccable aux clients.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball de Compétition</div>
                        Coordination collective, vitesse de réaction, endurance et esprit combatif.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Sport &amp; Entraînement</div>
                        Résistance physique naturelle, excellente énergie et discipline quotidienne.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Esprit d'Entraide</div>
                        Solidarité constante avec l'équipe, politesse et sens naturel du service.
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Formation</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Web@cadémie by Epitech Marseille — Bac +1</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Pédagogie active, gestion du stress et travail d'équipe soutenu</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Organisation, structure de travail et suivi des consignes</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Rigueur opérationnelle et respect des protocoles</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_G_La_Dalle.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_G_La_Dalle.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_G_La_Dalle.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV G-La Dalle - Équipier Polyvalent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #ea580c;
            border-radius: 8px;
        }
        .btn-dalle {
            background-color: #ea580c;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-dalle:hover {
            background-color: #c2410c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#ea580c">G-La Dalle</span></h1>
            <p class="text-muted mb-4">Équipier Polyvalent de Restauration Rapide (Burger &amp; Service)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-dalle btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV G-La Dalle (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
