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
            border-bottom: 3.5px solid #1e3a8a;
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
            color: #60a5fa;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #1e3a8a;
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
            border: 2px solid #3b82f6;
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
            border-bottom: 1.5px solid #1e3a8a;
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
            color: #1e3a8a;
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
            color: #1e3a8a;
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
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-left: 4px solid #1e3a8a;
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
                    <div class="contact-item" style="color:#60a5fa;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">CDD 15h - 24h &bull; Disponibilité Immédiate</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Vendeur Conseil Prêt-à-Porter Masculin</div>
                        <div class="search-objective">JULES — CDD 15H - 24H</div>
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
                        <span class="skill-cat">Vente &amp; Style Masculin</span>
                        <div class="skill-list">
                            &bull; <strong>Accueil Convivial :</strong> Écoute et sens du contact<br>
                            &bull; <strong>Conseil Look :</strong> Casual, urbain, costumes, jeans<br>
                            &bull; <strong>Ventes Croisées :</strong> Ceintures, chaussures, pulls<br>
                            &bull; <strong>Fidélisation :</strong> Carte de fidélité et relationnel
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Tenue Magasin &amp; Caisses</span>
                        <div class="skill-list">
                            &bull; <strong>Tables Pliées :</strong> Rangement rigoureux au gabarit<br>
                            &bull; <strong>Gestion des Cabines :</strong> Disponibilité et réassort<br>
                            &bull; <strong>Caisse Rapide :</strong> Encaissements, échanges, avoirs<br>
                            &bull; <strong>Réception &amp; Antivols :</strong> Traitement des livraisons
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Disponibilité &amp; Atouts</span>
                        <div class="skill-list">
                            &bull; <strong>Contrat 15h à 24h :</strong> Horaires souples (samedi &amp; pointes)<br>
                            &bull; <strong>Présentation Soignée :</strong> Image dynamique et moderne<br>
                            &bull; <strong>Permis B + Véhicule :</strong> Déplacements en toute autonomie<br>
                            &bull; <strong>Travail d'Équipe :</strong> Entraide et excellente humeur
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
                    <td class="exp-title">Conseiller de Vente Prêt-à-Porter Masculin</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Enseigne de Mode &amp; Prêt-à-Porter — Marseille Centre</div>
            <ul class="exp-list">
                <li>Accueil chaleureux, identification rapide des besoins des clients et proposition de silhouettes complètes.</li>
                <li>Conseil morphologique adapté (pantalons, chemises, vestes) et développement efficace du panier moyen.</li>
                <li>Maintien de la tenue irréprochable des tables de présentation (pliage au gabarit, facing, alignement des cintres).</li>
                <li>Encaissement fluide en caisse, proposition systématique du programme de fidélité et gestion des retours.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Employé Commercial &amp; Réassort Surface de Vente</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Magasin de Détail Textile — Marseille</div>
            <ul class="exp-list">
                <li>Déchargement des colis de textile, déballage, pose d'antivols et réassort continu des rayons en surface.</li>
                <li>Gestion dynamique des cabines d'essayage lors des pics d'affluence du week-end pour fluidifier le parcours client.</li>
                <li>Participation aux inventaires physiques et contrôle scrupuleux de l'étiquetage prix.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Communication &amp; Dynamique de Groupe</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Technique &amp; Projets — Marseille</div>
            <ul class="exp-list">
                <li>Aisance relationnelle éprouvée, courtoisie naturelle, esprit collaboratif et respect rigoureux des consignes.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Souriant, accessible et passionné par le commerce de prêt-à-porter masculin, je candidate chez <strong>Jules</strong> pour un contrat <strong>CDD de 15h à 24h</strong>.<br>
            Actif en boutique, attentif aux attentes des clients et rigoureux dans la tenue des rayons, je m'engage à apporter bonne humeur et efficacité au sein de votre équipe.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball en Compétition</div>
                        Sens du jeu collectif, dynamisme physique, esprit positif et solidarité d'équipe.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Intérêt pour la Mode</div>
                        Affinité avec les looks masculins actuels, tenue soignée et sens de l'esthétique.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Sens du Service Client</div>
                        Politesse spontanée, écoute active, sourire et énergie communicative.
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
            <div class="exp-subtitle">Développement du relationnel, expression orale et autonomie opérationnelle</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Sens de la méthode, gestion structurée et rigueur d'exécution</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Organisation méthodique et respect scrupuleux des directives</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Jules.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Jules.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Jules.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Jules - Vendeur Conseil CDD 15h-24h</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #1e3a8a;
            border-radius: 8px;
        }
        .btn-jules {
            background-color: #1e3a8a;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-jules:hover {
            background-color: #172554;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#1e3a8a">Jules</span></h1>
            <p class="text-muted mb-4">Vendeur Conseil Prêt-à-Porter Masculin (CDD 15h - 24h)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-jules btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Jules (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
