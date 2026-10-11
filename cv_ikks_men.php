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
            border-bottom: 3.5px solid #d97706;
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
            border: 2px solid #d97706;
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
            border-bottom: 1.5px solid #d97706;
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
            color: #b45309;
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

        .profil-block {
            font-size: 8.5pt;
            padding: 6px 10px;
            background-color: #fffbeb;
            border: 1px solid #fef3c7;
            border-left: 4px solid #d97706;
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
                    <div class="contact-item" style="color:#f59e0b;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">Disponibilité CDD 20h &bull; Immédiate</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Conseiller de Vente Prêt-à-Porter Masculin</div>
                        <div class="search-objective">IKKS MEN — CDD 20H</div>
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
                        <span class="skill-cat">Vente Assistée &amp; Style</span>
                        <div class="skill-list">
                            &bull; <strong>Conseil Silhouette :</strong> Morphologie et matières<br>
                            &bull; <strong>Vente Croisée :</strong> Développement panier moyen<br>
                            &bull; <strong>Fidélisation Client :</strong> Prise de coordonnées et suivi<br>
                            &bull; <strong>Excellence Relationnelle :</strong> Posture élégante et soignée
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Tenue Boutique &amp; Caisse</span>
                        <div class="skill-list">
                            &bull; <strong>Merchandising :</strong> Pliage au gabarit, cintrage net<br>
                            &bull; <strong>Cabines d'Essayage :</strong> Gestion attentive et rangement<br>
                            &bull; <strong>Encaissement :</strong> Caisse informatisée et détaxe<br>
                            &bull; <strong>Gestion des Stocks :</strong> Réassort rapide de la réserve
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Disponibilité &amp; Profil</span>
                        <div class="skill-list">
                            &bull; <strong>Contrat 20h :</strong> Horaires ciblés (jours de pointe &amp; samedi)<br>
                            &bull; <strong>Présentation Soignée :</strong> Image de marque premium<br>
                            &bull; <strong>Mobilité Complète :</strong> Permis B et véhicule personnel<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Dynamisme et collaboration active
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
            <div class="exp-subtitle">Boutique Prêt-à-Porter &amp; Mode Masculine Contemporaine — Marseille</div>
            <ul class="exp-list">
                <li>Accueil personnalisé et accompagnement complet des clients dans la sélection de leurs tenues (casual-chic, costumes et pièces tendance).</li>
                <li>Conseil technique sur les coupes, tissus et associations d'accessoires (maroquinerie, ceintures, chaussures) pour augmenter l'indice de vente.</li>
                <li>Tenue rigoureuse des cabines d'essayage et remise en rayon immédiate des pièces essayées avec respect du pliage boutique.</li>
                <li>Encaissement haut de gamme, création de fiches clients et participation active aux inventaires de collection.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Employé de Vente &amp; Visual Merchandising</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Enseigne Textile &amp; Mode — Centre Commercial Marseille</div>
            <ul class="exp-list">
                <li>Réception des livraisons, vaporisation des pièces fragiles, pose d'antivols et agencement des portants selon les directives merchandising.</li>
                <li>Veille à la propreté et à l'élégance constante de l'espace de vente afin de valoriser l'expérience client.</li>
                <li>Gestion des réassorts de réserve en flux tendu pour éviter les ruptures de tailles en surface.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Savoir-Être Professionnel &amp; Rigueur</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Supérieure &amp; Projets Techniques — Marseille</div>
            <ul class="exp-list">
                <li>Aisance d'expression orale, écoute bienveillante, courtoisie exemplaire et grand sens des responsabilités.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Passionné de mode masculine et doté d'une excellente présentation, je postule chez <strong>IKKS Men</strong> pour un poste de <strong>Conseiller de Vente en CDD 20h</strong>.<br>
            Mon sens du conseil, mon aisance relationnelle et mon souci du détail me permettent de valoriser vos collections et d'offrir une expérience shopping d'exception à votre clientèle.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Style &amp; Mode Masculine</div>
                        Sensibilité aux matières, aux coupes contemporaines et aux accords de couleurs.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball de Compétition</div>
                        Discipline, énergie positive, esprit d'équipe et détermination sous pression.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Sens de l'Accueil &amp; Écoute</div>
                        Courtoisie, discrétion attentive, sens du service client et aisance verbale.
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
            <div class="exp-subtitle">Aisance orale en soutenance publique, organisation et esprit d'initiative</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Gestion méthodique, suivi rigoureux des procédures et relation client</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Rigueur opérationnelle, précision et culture du résultat</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_IKKS_Men.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_IKKS_Men.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_IKKS_Men.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV IKKS Men - Conseiller de Vente CDD 20h</title>
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
        .btn-ikks {
            background-color: #0f172a;
            border: 2px solid #d97706;
            color: #f59e0b;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-ikks:hover {
            background-color: #1e293b;
            color: #fbbf24;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#d97706">IKKS Men</span></h1>
            <p class="text-muted mb-4">Conseiller de Vente Prêt-à-Porter Masculin (CDD 20h)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-ikks btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV IKKS Men (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
