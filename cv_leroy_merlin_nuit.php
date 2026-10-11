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
            border-bottom: 3.5px solid #15803d;
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
            color: #4ade80;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #15803d;
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
            border: 2px solid #22c55e;
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
            border-bottom: 1.5px solid #15803d;
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
            color: #15803d;
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
            color: #15803d;
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
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #15803d;
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
                    <div class="contact-item" style="color:#4ade80;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">Horaires Nuit 20h - 23h30 &bull; CDI 17h50</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Employé Logistique &bull; Mise en Rayon de Nuit</div>
                        <div class="search-objective">LEROY MERLIN — HORAIRES 20H-23H30 (CDI 17H50)</div>
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
                        <span class="skill-cat">Logistique &amp; Rayon Nuit</span>
                        <div class="skill-list">
                            &bull; <strong>Dépotage Palettes :</strong> Tri par allée &amp; rayon<br>
                            &bull; <strong>Mise en Rayon Soignée :</strong> Facing et alignement<br>
                            &bull; <strong>Bricolage &amp; Habitat :</strong> Connaissance univers<br>
                            &bull; <strong>Balisage &amp; Prix :</strong> Étiquetage informatisé net
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Manutention &amp; Sécurité</span>
                        <div class="skill-list">
                            &bull; <strong>Port des EPI :</strong> Chaussures sécurité, gants, gilet<br>
                            &bull; <strong>Gestes &amp; Postures :</strong> Manipulation ergonomique<br>
                            &bull; <strong>Allées Dégagées :</strong> Évacuation palettes et cartons<br>
                            &bull; <strong>Cadence Soutenue :</strong> Respect des temps nocturnes
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Disponibilité &amp; Profil</span>
                        <div class="skill-list">
                            &bull; <strong>Créneau 20h - 23h30 :</strong> 100% adapté et motivé<br>
                            &bull; <strong>Contrat CDI 17h50 :</strong> Engagement durable et fiable<br>
                            &bull; <strong>Permis B + Voiture :</strong> Autonomie totale pour retours tardifs<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Entraide et rigueur d'exécution
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
                    <td class="exp-title">Employé Logistique &amp; Approvisionnement Magasin</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Grande Surface de Bricolage &amp; Équipement — Région Marseillaise</div>
            <ul class="exp-list">
                <li>Réception des livraisons, déchargement des palettes en réserve et ventilation vers les secteurs (outillage, quincaillerie, sanitaire).</li>
                <li>Mise en rayon soignée hors présence clients, pose d'antivols et réassort des linéaires selon les plans de merchandising.</li>
                <li>Vérification systématique du balisage des prix et remplacement des étiquettes électroniques ou papier manquantes.</li>
                <li>Broyage des cartons, filmage des palettes vides et maintien des zones de circulation dans un état de propreté parfait.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Agent de Quai &amp; Manutention Nocturne</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Dépôt Logistique &amp; Distribution — Marseille</div>
            <ul class="exp-list">
                <li>Dépotage méthodique de palettes sous cadence soutenue avec contrôle quantitatif des références scannées.</li>
                <li>Manipulation sécurisée de charges lourdes dans le respect des gestes et postures et consignes de sécurité.</li>
                <li>Ponctualité exemplaire et assiduité constante sur des horaires décalés de fin de journée et soirée.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Sens Méthodique &amp; Rigueur Opérationnelle</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Technique — Marseille</div>
            <ul class="exp-list">
                <li>Capacité d'organisation autonome, rapidité d'exécution, fiabilité et respect absolu des consignes de sécurité.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Endurant, autonome et particulièrement rigoureux, je postule chez <strong>Leroy Merlin</strong> pour le poste d'<strong>Employé Logistique de Nuit (20h - 23h30 / CDI 17h50)</strong>.<br>
            Grâce à mon véhicule personnel et à ma solide condition physique, je m'investis pour que les rayons soient parfaitement approvisionnés, sécurisés et prêts à accueillir les clients dès l'ouverture.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball Régional</div>
                        Endurance athlétique, dynamisme, esprit d'équipe solidaire et détermination.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Endurance &amp; Travail Physique</div>
                        Habitude des efforts physiques continus, rigueur posturale et vitalité en soirée.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Autonomie &amp; Ponctualité</div>
                        Exactitude rigoureuse aux prises de poste nocturnes et engagement sans faille.
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
            <div class="exp-subtitle">Méthodologie structurée, endurance et travail collaboratif poussé</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Logique, gestion rigoureuse et suivi des procédures</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Sciences et Technologies Industrielles (Sécurité, flux matériels et rigueur)</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Leroy_Merlin_Nuit.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Leroy_Merlin_Nuit.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Leroy_Merlin_Nuit.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Leroy Merlin - Mise en Rayon de Nuit (20h-23h30)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #15803d;
            border-radius: 8px;
        }
        .btn-leroy {
            background-color: #15803d;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-leroy:hover {
            background-color: #166534;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#15803d">Leroy Merlin</span></h1>
            <p class="text-muted mb-4">Employé Logistique &bull; Mise en Rayon de Nuit (20h - 23h30 / CDI 17h50)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-leroy btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Leroy Merlin Nuit (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
