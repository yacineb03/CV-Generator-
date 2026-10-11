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
            border-bottom: 3.5px solid #0072ce;
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
            color: #38bdf8;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #0072ce;
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
            border: 2px solid #0284c7;
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
            border-bottom: 1.5px solid #0072ce;
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
            color: #0072ce;
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
            color: #0072ce;
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
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            border-left: 4px solid #0072ce;
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
                    <div class="contact-item" style="color:#38bdf8;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">Disponible en CDD 12h - 24h &bull; Immédiat</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Employé Polyvalent de Magasin</div>
                        <div class="search-objective">ACTION — CDD 12H - 24H</div>
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
                        <span class="skill-cat">Mise en Rayon &amp; Stocks</span>
                        <div class="skill-list">
                            &bull; <strong>Dépotage &amp; Réassort :</strong> Déchargement palettes<br>
                            &bull; <strong>Facing &amp; Rangement :</strong> Allées nettes et pleines<br>
                            &bull; <strong>Balisage des Prix :</strong> Étiquetage conforme et lisible<br>
                            &bull; <strong>Gestion des Déchets :</strong> Carton, plastique et bennes
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Tenue de Caisse &amp; Client</span>
                        <div class="skill-list">
                            &bull; <strong>Encaissement Rapide :</strong> Caisse tactile, TPE, espèces<br>
                            &bull; <strong>Orientation Client :</strong> Accueil courtois et souriant<br>
                            &bull; <strong>Gestion des Files :</strong> Fluidité en pic d'affluence<br>
                            &bull; <strong>Fiabilité :</strong> Rigueur sur les comptages de caisse
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Disponibilité &amp; Efficacité</span>
                        <div class="skill-list">
                            &bull; <strong>Contrat CDD 12h-24h :</strong> Horaires souples et adaptés<br>
                            &bull; <strong>Endurance Physique :</strong> Port de charges et cadence<br>
                            &bull; <strong>Permis B + Véhicule :</strong> Déplacements facilités<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Entraide constante en rayon
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
                    <td class="exp-title">Employé Commercial &amp; Polyvalent de Magasin</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Grande Distribution Spécialisée &amp; Bazar — Marseille</div>
            <ul class="exp-list">
                <li>Réception des livraisons, déchargement des palettes en réserve et acheminement rapide en surface de vente.</li>
                <li>Mise en rayon intensive (facing soigné, réassort régulier des têtes de gondoles, rotation des arrivages hebdomadaires).</li>
                <li>Vérification systématique des étiquetages prix et pose des stop-rayons promotionnels.</li>
                <li>Encaissement en caisse lors des pics d'affluence avec rapidité, exactitude et sourire.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Agent de Réassort &amp; Logistique Magasin</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Commerce &amp; Distribution — Marseille</div>
            <ul class="exp-list">
                <li>Tri des marchandises par univers, gestion rigoureuse des stocks en réserve et réassort des rayons en flux tendu.</li>
                <li>Maintien de la propreté des allées pour garantir la sécurité et le confort d'achat de la clientèle.</li>
                <li>Participation aux inventaires physiques tournants et détection des anomalies de stock.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Organisation Opérationnelle &amp; Polyvalence</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Technique &amp; Projets de Groupe — Marseille</div>
            <ul class="exp-list">
                <li>Sens poussé de l'organisation, respect strict des consignes hiérarchiques et goût du travail bien fait.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Polyvalent, travailleur et réactif, je postule chez <strong>Action</strong> pour un contrat <strong>CDD de 12h à 24h</strong>.<br>
            À l'aise aussi bien en mise en rayon rapide qu'en caisse, je mets mon énergie et ma rigueur au service de la tenue impeccable du magasin et de la satisfaction des clients.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball en Club</div>
                        Dépassement de soi, cohésion d'équipe, vivacité et discipline d'entraînement.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Condition Physique</div>
                        Capacité à travailler debout à bon rythme et à manipuler des charges en sécurité.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Rigueur &amp; Ponctualité</div>
                        Exactitude sur les plannings, respect des règles et présentation soignée.
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
            <div class="exp-subtitle">Méthode de travail structurée, endurance intellectuelle et esprit collaboratif</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Précision méthodique, organisation et traitement rigoureux des informations</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Sens pratique, respect des procédures et rigueur opérationnelle</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Action.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Action.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Action.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Action - Employé Polyvalent CDD 12h-24h</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #0072ce;
            border-radius: 8px;
        }
        .btn-action {
            background-color: #0072ce;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-action:hover {
            background-color: #005a9e;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#0072ce">Action</span></h1>
            <p class="text-muted mb-4">Employé Polyvalent de Magasin (CDD 12h - 24h)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-action btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Action (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
