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
            border-bottom: 3.5px solid #7c3aed;
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
            color: #a78bfa;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #7c3aed;
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
            border: 2px solid #8b5cf6;
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
            border-bottom: 1.5px solid #7c3aed;
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
            color: #7c3aed;
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
            color: #7c3aed;
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
            background-color: #f5f3ff;
            border: 1px solid #ddd6fe;
            border-left: 4px solid #7c3aed;
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
                    <div class="contact-item" style="color:#a78bfa;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">Disponibilité Immédiate &bull; Horaires Décalés</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Préparateur de Commandes / Logistique</div>
                        <div class="search-objective">LOGISTIQUE — DRIVE &amp; ENTREPÔT</div>
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
                        <span class="skill-cat">Préparation &amp; Picking</span>
                        <div class="skill-list">
                            &bull; <strong>Systèmes de Picking :</strong> Scan PDA &amp; guidage vocal<br>
                            &bull; <strong>Constitution Palettes :</strong> Équilibrage et stabilité<br>
                            &bull; <strong>Filmage &amp; Cerclage :</strong> Protection pour le transport<br>
                            &bull; <strong>Contrôle Qualité :</strong> Zéro inversion de référence
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Manutention &amp; Sécurité</span>
                        <div class="skill-list">
                            &bull; <strong>Gestes &amp; Postures :</strong> Ergonomie et sécurité du dos<br>
                            &bull; <strong>Règles Entrepôt :</strong> Port des EPI et respect des voies<br>
                            &bull; <strong>Chargement / Quai :</strong> Contrôle des bons de livraison<br>
                            &bull; <strong>Cadence Soutenue :</strong> Respect des quotas horaires
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Atouts &amp; Fiabilité</span>
                        <div class="skill-list">
                            &bull; <strong>Grande Mobilité :</strong> Permis B + voiture (zones logistiques)<br>
                            &bull; <strong>Horaires Flexibles :</strong> Équipes 2x8, matin, après-midi, nuit<br>
                            &bull; <strong>Endurance Physique :</strong> Dynamisme et marche continue<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Entraide et rigueur quotidienne
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
                    <td class="exp-title">Préparateur de Commandes &amp; Manutentionnaire Logistique</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Plateforme Logistique E-Commerce &amp; Drive — Région Marseillaise</div>
            <ul class="exp-list">
                <li>Préparation des commandes au scan pistolet (PDA) avec prélèvement cadencé des articles dans les allées.</li>
                <li>Montage méthodique de palettes selon les catégories de produits (lourds en bas, fragiles en haut) et filmage manuel étanche.</li>
                <li>Contrôle de conformité quantitatif et qualitatif avant acheminement en zone d'expédition / quai.</li>
                <li>Participation au déchargement de camions, au tri des colis et au nettoyage continu des voies de circulation.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Agent de Quai &amp; Réception Marchandises</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Entrepôt Logistique &amp; Distribution — Marseille</div>
            <ul class="exp-list">
                <li>Vérification du pointage des arrivages par rapport aux bordereaux de livraison et signalement des écarts.</li>
                <li>Rangement des marchandises dans les racks de stockage et réapprovisionnement des zones de picking.</li>
                <li>Respect strict des consignes de sécurité, de la signalisation au sol et port intégral des EPI.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Gestion de Données &amp; Rigueur Méthodique</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Technique — Marseille</div>
            <ul class="exp-list">
                <li>Sens poussé du détail, logique de classement, gestion rapide de flux d'informations et ponctualité exemplaire.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Endurant, rigoureux et autonome, je recherche un poste de <strong>Préparateur de Commandes</strong> en entrepôt ou drive.<br>
            Habitué aux cadences soutenues et au respect strict des procédures de picking, je m'investis pour garantir un taux de service irréprochable et des expéditions conformes sans erreur.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball de Niveau Régional</div>
                        Discipline d'entraînement, endurance aérobie, réactivité et communication positive.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Condition Physique &amp; Résistance</div>
                        Habitude de l'effort physique régulier, agilité gestuelle et posture vigilante.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Fiabilité &amp; Ponctualité</div>
                        Exactitude rigoureuse aux prises de poste matinales ou en horaires décalés.
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
            <div class="exp-subtitle">Organisation autonome, gestion de cadences et respect des délais stricts</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Traitement logique de données, gestion informatisée des stocks et rigueur</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Compréhension des flux industriels, respect scrupuleux des normes de sécurité</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Preparateur_Commande.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Preparateur_Commande.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Preparateur_Commande.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Préparateur de Commandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #7c3aed;
            border-radius: 8px;
        }
        .btn-prep {
            background-color: #7c3aed;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-prep:hover {
            background-color: #6d28d9;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#7c3aed">Préparateur de Commandes</span></h1>
            <p class="text-muted mb-4">Logistique, Entrepôt &amp; Drive (Scan PDA &amp; Palettisation)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-prep btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Préparateur de Commandes (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
