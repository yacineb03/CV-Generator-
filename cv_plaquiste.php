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
            border-bottom: 3.5px solid #0d9488;
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
            color: #2dd4bf;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #0d9488;
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
            border: 2px solid #14b8a6;
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
            border-bottom: 1.5px solid #0d9488;
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
            color: #0d9488;
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
            color: #0d9488;
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
            background-color: #f0fdfa;
            border: 1px solid #ccfbf1;
            border-left: 4px solid #0d9488;
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
                    <div class="contact-item" style="color:#2dd4bf;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">Disponibilité Immédiate &bull; Chantiers PACA</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Plaquiste &bull; Plâtrier (BTP Second Œuvre)</div>
                        <div class="search-objective">BTP &amp; AMÉNAGEMENT INTÉRIEUR</div>
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
                        <span class="skill-cat">Pose &amp; Cloisonnement</span>
                        <div class="skill-list">
                            &bull; <strong>Ossatures Métalliques :</strong> Rails &amp; montants<br>
                            &bull; <strong>Plaques de Plâtre :</strong> Découpe &amp; fixation BA13<br>
                            &bull; <strong>Isolation :</strong> Laine de verre, roche, acoustique<br>
                            &bull; <strong>Plafonds &amp; Doublages :</strong> Suspendus et cloisons
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Finitions &amp; Rigueur</span>
                        <div class="skill-list">
                            &bull; <strong>Joints &amp; Bandes :</strong> Pose soignée sans bulles<br>
                            &bull; <strong>Enduisage &amp; Ponçage :</strong> Finition lisse prête à peindre<br>
                            &bull; <strong>Prise de Cotes :</strong> Traçage au laser et au niveau<br>
                            &bull; <strong>Nettoyage Chantier :</strong> Évacuation des chutes
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Sécurité &amp; Profil</span>
                        <div class="skill-list">
                            &bull; <strong>Port des EPI :</strong> Casque, gants, lunettes, chaussures<br>
                            &bull; <strong>Endurance Physique :</strong> Manutention de plaques<br>
                            &bull; <strong>Permis B + Voiture :</strong> Autonome pour aller sur chantier<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Entraide avec les compagnons
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
                    <td class="exp-title">Aide-Plaquiste &amp; Poseur de Cloisons Sèches</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Entreprise de Second Œuvre &amp; Rénovation — Région Marseillaise</div>
            <ul class="exp-list">
                <li>Implantation des cloisons, découpe et fixation des rails et montants métalliques selon les plans.</li>
                <li>Découpe manuelle et mécanique des plaques de plâtre (BA13 standard, hydrofuge et phonique) et vissage sur ossatures.</li>
                <li>Mise en place d'isolants thermo-acoustiques en rouleaux et panneaux dans le respect des règles d'étanchéité.</li>
                <li>Application d'enduit de collage, pose de bandes à joint armées/papier, passes de lissage et ponçage minutieux.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Manœuvre BTP &amp; Approvisionnement de Chantier</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Chantiers Résidentiels &amp; Tertiaires — PACA</div>
            <ul class="exp-list">
                <li>Déchargement et approvisionnement des étages en plaques de plâtre, rails, sacs d'enduit et outillages.</li>
                <li>Préparation des surfaces de pose, nettoyage continu des zones de travail et tri sélectif des gravats en bennes.</li>
                <li>Assistance directe aux plaquistes qualifiés et respect scrupuleux des consignes de sécurité (EPI).</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Lecture de Plans &amp; Rigueur Opérationnelle</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Technique — Marseille</div>
            <ul class="exp-list">
                <li>Compréhension rapide des cotes et consignes d'exécution, précision géométrique et goût du travail bien fini.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Travailleur, méticuleux et doté d'une excellente condition physique, je propose mes compétences de <strong>Plaquiste</strong>.<br>
            Autonome sur la pose d'ossatures, le vissage de plaques et la réalisation de joints soignés, je m'intègre rapidement dans vos équipes pour livrer des chantiers propres et parfaitement exécutés.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball de Compétition</div>
                        Force physique, esprit de camaraderie, communication claire et discipline collective.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Solidité Physique &amp; Résistance</div>
                        Habitude des efforts physiques répétés, posture sécurisée et énergie constante.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Sens du Détail &amp; Propreté</div>
                        Finition soignée des arrêtes et surfaces, tenue d'un chantier propre et sécurisé.
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
            <div class="exp-subtitle">Rigueur de méthode, respect strict des délais et organisation autonome</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Esprit d'analyse, logique mathématique et méthode de travail</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Sciences et Technologies de l'Industrie (Architecture &amp; Construction, Sécurité BTP)</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Plaquiste.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Plaquiste.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Plaquiste.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Plaquiste - BTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #0d9488;
            border-radius: 8px;
        }
        .btn-plaquiste {
            background-color: #0d9488;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-plaquiste:hover {
            background-color: #0f766e;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#0d9488">Plaquiste — BTP</span></h1>
            <p class="text-muted mb-4">Plaquiste / Plâtrier (Ossatures Métalliques, BA13, Isolants &amp; Bandes)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-plaquiste btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Plaquiste (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
