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
            border-bottom: 3.5px solid #0284c7;
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
            background-color: #0284c7;
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
            border-bottom: 1.5px solid #0284c7;
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
            color: #0284c7;
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
            color: #0284c7;
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
            border-left: 4px solid #0284c7;
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
                    <div class="contact-item">Contrat CDD 24h &bull; Disponibilité Immédiate</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Conseiller de Vente Prêt-à-Porter (Mode Jeune)</div>
                        <div class="search-objective">PULL &amp; BEAR — CDD 24H</div>
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
                        <span class="skill-cat">Vente &amp; Univers Jeune</span>
                        <div class="skill-list">
                            &bull; <strong>Accueil Tendance :</strong> Sens du contact et convivialité<br>
                            &bull; <strong>Style Streetwear :</strong> Culture mode &amp; tendances actuelles<br>
                            &bull; <strong>Orientation Client :</strong> Conseil taille et coupe rapide<br>
                            &bull; <strong>Ventes Croisées :</strong> Chaussures, hoodies, accessoires
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Merchandising &amp; Cabines</span>
                        <div class="skill-list">
                            &bull; <strong>Flux Cabines :</strong> Rangement minute et retour portant<br>
                            &bull; <strong>Pliage Rapide :</strong> Tables nettes selon normes groupe<br>
                            &bull; <strong>Réassort Soutenu :</strong> Approvisionnement continu<br>
                            &bull; <strong>Caisse Tactile :</strong> Encaissements cadencés et fluides
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Disponibilité &amp; Profil</span>
                        <div class="skill-list">
                            &bull; <strong>Contrat 24h :</strong> Flexibilité idéale selon plannings<br>
                            &bull; <strong>Énergie &amp; Dynamisme :</strong> Rythme soutenu sans fatigue<br>
                            &bull; <strong>Permis B + Voiture :</strong> Autonomie totale pour les shifts<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Entraide permanente en boutique
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
                    <td class="exp-title">Conseiller de Vente Prêt-à-Porter &amp; Streetwear</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Enseigne Internationale de Fast Fashion — Centre Commercial Marseille</div>
            <ul class="exp-list">
                <li>Accueil et orientation des clients dans une boutique à très fort passage, dynamisation des ventes en surface.</li>
                <li>Gestion intensive des cabines d'essayage lors des pics d'affluence du samedi (comptage articles, remise sur cintre immédiate).</li>
                <li>Réassort cadencé de la surface de vente depuis la réserve et respect des règles visuelles de merchandising.</li>
                <li>Encaissement rapide en caisse, désactivation des antivols et gestion fluide des flux de clients.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Employé Polyvalent de Vente &amp; Stock Magasin</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Boutique Textile Urbain &amp; Accessoires — Marseille</div>
            <ul class="exp-list">
                <li>Réception des cartons de collection, bippage au scanner, antivolage et mise en rayon matinale.</li>
                <li>Maintien de l'ordre parfait des tables de jeans et t-shirts, facing des portants et propreté de l'espace de vente.</li>
                <li>Collaboration étroite avec les responsables de rayon pour atteindre les objectifs de chiffre d'affaires journaliers.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Esprit Collaboratif &amp; Agilité Opérationnelle</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Technique &amp; Projets — Marseille</div>
            <ul class="exp-list">
                <li>Adaptabilité rapide, excellente présentation vestimentaire, énergie communicative et esprit d'équipe permanent.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Dynamique, passionné de mode urbaine et doté d'un excellent sens relationnel, je postule chez <strong>Pull &amp; Bear</strong> pour un contrat <strong>CDD 24h</strong>.<br>
            À l'aise dans les environnements rythmés et axé sur la satisfaction client, je m'engage à tenir un magasin impeccable et à booster l'ambiance et les ventes de l'équipe.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Streetwear &amp; Tendances</div>
                        Intérêt marqué pour les cultures urbaines, la musique actuelle et les styles graphiques.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball en Club</div>
                        Esprit d'équipe, tonicité athlétique, endurance et communication instantanée.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Enthousiasme &amp; Sourire</div>
                        Aisance spontanée avec les jeunes et les familles, optimisme et bonne humeur.
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
            <div class="exp-subtitle">Créativité, travail sous pression et polyvalence opérationnelle</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Logique, méthodologie et rigueur dans l'exécution</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Organisation, autonomie et respect des processus</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Pull_Bear.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Pull_Bear.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Pull_Bear.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Pull &amp; Bear - CDD 24h</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #0284c7;
            border-radius: 8px;
        }
        .btn-pull {
            background-color: #0284c7;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-pull:hover {
            background-color: #0369a1;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#0284c7">Pull &amp; Bear</span></h1>
            <p class="text-muted mb-4">Conseiller de Vente Prêt-à-Porter (CDD 24h)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-pull btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Pull &amp; Bear (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
