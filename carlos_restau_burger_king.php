<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['generate']) || (php_sapi_name() === 'cli' && isset($argv[1]) && $argv[1] === 'generate')) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');
    $dompdf = new Dompdf($options);

    $photoHtml = '';
    $photoPaths = ['profil_carlos.jpg', 'images/profil_carlos.jpg'];
    foreach ($photoPaths as $path) {
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $photoHtml = '<img src="' . $base64 . '" class="profile-photo" alt="Photo Carlos">';
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
            margin: 0;
            size: A4 portrait;
        }
        body {
            font-family: Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #292524;
            background-color: #ffffff;
            line-height: 1.25;
            -webkit-font-smoothing: antialiased;
        }
        .layout-table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        /* SIDEBAR (32% width) */
        .sidebar {
            width: 32%;
            background-color: #f7f4ee;
            border-right: 1.5px solid #e7e2d6;
            color: #292524;
            padding: 24px 16px 20px 18px;
            vertical-align: top;
        }
        .photo-container {
            text-align: center;
            margin-bottom: 14px;
        }
        .profile-photo {
            width: 82px;
            height: 82px;
            border-radius: 50%;
            border: 3px solid #b91c1c;
            display: block;
            margin: 0 auto;
        }

        .side-title {
            color: #b91c1c;
            font-size: 8.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1.5px solid #b91c1c;
            padding-bottom: 3px;
            margin-top: 13px;
            margin-bottom: 7px;
        }
        .side-title:first-of-type {
            margin-top: 0;
        }

        /* CONTACT */
        .contact-item {
            margin-bottom: 5px;
            font-size: 7.5pt;
            line-height: 1.3;
        }
        .contact-label {
            font-weight: bold;
            color: #78716c;
            font-size: 6.8pt;
            text-transform: uppercase;
        }
        .contact-val {
            color: #1c1917;
            font-weight: 500;
        }
        .contact-highlight {
            color: #b91c1c;
            font-weight: bold;
        }

        /* FORMATION */
        .edu-item {
            margin-bottom: 6px;
            font-size: 7.5pt;
            line-height: 1.25;
        }
        .edu-badge {
            color: #b91c1c;
            font-weight: bold;
            font-size: 7pt;
        }
        .edu-title {
            font-weight: bold;
            color: #1c1917;
        }
        .edu-sub {
            color: #78716c;
            font-size: 7pt;
            font-style: italic;
        }

        /* COMPETENCES / SAVOIR-ETRE */
        .skill-pill {
            background-color: #ffffff;
            border: 1px solid #d6d3d1;
            border-left: 2.5px solid #b91c1c;
            color: #1c1917;
            font-size: 7.2pt;
            font-weight: bold;
            padding: 3px 6px;
            margin-bottom: 4px;
            border-radius: 2px;
        }

        /* LANGUES */
        .lang-line {
            font-size: 7.5pt;
            margin-bottom: 3px;
            color: #44403c;
        }
        .lang-bold {
            font-weight: bold;
            color: #1c1917;
        }

        /* LOISIRS */
        .hobby-tag {
            display: inline-block;
            background-color: #eae5da;
            color: #44403c;
            font-size: 7pt;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 3px;
            margin-right: 3px;
            margin-bottom: 3px;
        }

        /* MAIN COLUMN (68% width) */
        .main-content {
            width: 68%;
            background-color: #ffffff;
            padding: 24px 22px 20px 22px;
            vertical-align: top;
        }

        /* HEADER */
        .header-box {
            margin-bottom: 12px;
            border-bottom: 2px solid #e7e5e4;
            padding-bottom: 10px;
        }
        .name-title {
            font-size: 21pt;
            font-weight: bold;
            margin: 0;
            line-height: 1.1;
            letter-spacing: 0.5px;
        }
        .name-first {
            color: #1c1917;
        }
        .name-last {
            color: #b91c1c;
        }
        .job-headline {
            font-size: 9.5pt;
            font-weight: bold;
            color: #57534e;
            text-transform: uppercase;
            margin-top: 4px;
            letter-spacing: 0.4px;
        }
        .badge-pill {
            display: inline-block;
            background-color: #b91c1c;
            color: #ffffff;
            font-weight: bold;
            font-size: 7.5pt;
            padding: 2.5px 10px;
            border-radius: 12px;
            text-transform: uppercase;
            margin-top: 5px;
            letter-spacing: 0.4px;
        }

        /* ACCROCHE */
        .profile-quote {
            background-color: #f7f4ee;
            border-left: 3px solid #b91c1c;
            padding: 6px 10px;
            margin-bottom: 12px;
            font-size: 7.6pt;
            line-height: 1.35;
            color: #44403c;
            font-style: italic;
            border-radius: 0 4px 4px 0;
        }

        /* SECTION TITLES */
        .section-header {
            color: #1c1917;
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-top: 6px;
            margin-bottom: 8px;
            padding-bottom: 2px;
            border-bottom: 1.5px solid #b91c1c;
        }

        /* EXPERIENCES */
        .exp-item {
            margin-bottom: 7px;
            border-left: 2px solid #e7e5e4;
            padding-left: 8px;
        }
        .exp-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1px;
        }
        .exp-role {
            font-weight: bold;
            font-size: 8.5pt;
            color: #1c1917;
            text-align: left;
        }
        .exp-date-badge {
            background-color: #f5f5f4;
            color: #b91c1c;
            border: 1px solid #d6d3d1;
            font-weight: bold;
            font-size: 7pt;
            padding: 1px 6px;
            border-radius: 3px;
            text-align: right;
            white-space: nowrap;
        }
        .exp-sub {
            font-size: 7.5pt;
            color: #b91c1c;
            font-weight: bold;
            margin-bottom: 2px;
        }
        ul.tasks-list {
            margin: 1px 0 2px 12px;
            padding: 0;
        }
        ul.tasks-list li {
            font-size: 7.8pt;
            color: #44403c;
            margin-bottom: 1.5px;
            line-height: 1.25;
        }
    </style>
</head>
<body>

    <table class="layout-table">
        <tr>
            <!-- SIDEBAR -->
            <td class="sidebar">
                <div class="photo-container">
                    $photoHtml
                </div>

                <div class="side-title">Contact</div>
                <div class="contact-item">
                    <div class="contact-label">Téléphone</div>
                    <div class="contact-val">+33 7 66 28 61 46</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">Email</div>
                    <div class="contact-val">cmoreirav16@gmail.com</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">Localisation</div>
                    <div class="contact-val">Marseille (13013) &bull; France</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">Permis &amp; Véhicule</div>
                    <div class="contact-val contact-highlight">Permis B + Véhiculé</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">Disponibilité</div>
                    <div class="contact-val contact-highlight">Contrat 12h-24h &bull; Immédiat</div>
                </div>

                <div class="side-title">Formation</div>
                <div class="edu-item">
                    <div class="edu-badge">2025 - 2027 &bull; En cours</div>
                    <div class="edu-title">BTS Maintenance des Systèmes Énergétiques</div>
                    <div class="edu-sub">Lycée Denis Diderot (Marseille)</div>
                </div>
                <div class="edu-item">
                    <div class="edu-badge">2022 - 2025</div>
                    <div class="edu-title">Baccalauréat STI2D</div>
                    <div class="edu-sub">Lycée Denis Diderot (Marseille)</div>
                </div>

                <div class="side-title">Compétences Clés</div>
                <div class="skill-pill">✦ Cuisson broiler flame-grilled & frites</div>
                <div class="skill-pill">✦ Ligne de garniture rapide & personnalisée</div>
                <div class="skill-pill">✦ Prise de commande borne/caisse & drive</div>
                <div class="skill-pill">✦ Procédure HACCP & propreté continue</div>
                <div class="skill-pill">✦ Esprit d'équipe & endurance au rush</div>

                <div class="side-title">Langues</div>
                <div class="lang-line"><span class="lang-bold">Français :</span> Langue maternelle</div>
                <div class="lang-line"><span class="lang-bold">Portugais :</span> Bilingue (Courant)</div>
                <div class="lang-line"><span class="lang-bold">Anglais :</span> Technique &amp; B1/B2</div>
                <div class="lang-line"><span class="lang-bold">Espagnol :</span> Notions professionnelles</div>

                <div class="side-title">Centres d'Intérêt</div>
                <div>
                    <span class="hobby-tag">Arts Martiaux</span>
                    <span class="hobby-tag">Musculation</span>
                    <span class="hobby-tag">Coiffure</span>
                </div>
            </td>

            <!-- CONTENU PRINCIPAL -->
            <td class="main-content">
                <div class="header-box">
                    <div class="name-title">
                        <span class="name-first">CARLOS</span> <span class="name-last">MOREIRA VEIGA</span>
                    </div>
                    <div class="job-headline">Équipier Polyvalent de Restauration</div>
                    <div>
                        <span class="badge-pill">BURGER KING &bull; SERVICE COMPTOIR & GRILL MINUTE</span>
                    </div>
                </div>

                <div class="profile-quote">
                    &laquo; Étudiant ponctuel, doté d'une excellente présentation et d'une énergie communicative. Capable de tenir les postes de cuisine (broiler flame-grilled, garniture, friteuse) comme de caisse/drive avec le sens de la satisfaction client. &raquo;
                </div>

                <div class="section-header">Expériences Professionnelles</div>

                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Équipier Polyvalent de Restauration Rapide</td>
                            <td style="text-align: right;"><span class="exp-date-badge">2025 - 2026</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Enseigne Burger King / Restauration Rapide (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Alimentation du broiler pour cuisson flamme, contrôle des températures et assemblage rapide des recettes.</li>
                        <li>Préparation des boissons, desserts et commandes drive avec respect des objectifs de temps de service.</li>
                        <li>Entretien constant de la salle de restaurant, des poubelles et des postes de production pendant les rushs.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Employé Libre-Service & Caisse</td>
                            <td style="text-align: right;"><span class="exp-date-badge">2024 - 2025</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Magasin Action (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Encaissements cadencés sans erreur et réapprovisionnement rapide des rayons.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Agent Polyvalent d'Entretien</td>
                            <td style="text-align: right;"><span class="exp-date-badge">2024 - 2025</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Société ONET (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Nettoyage rigoureux et maintien d'une propreté exemplaire des locaux.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Technicien Trottinettes Libre-Service</td>
                            <td style="text-align: right;"><span class="exp-date-badge">2024</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Flotte Urbaine (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Autonomie opérationnelle et ponctualité sur le terrain.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Surveillant Baignade & Animateur</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Été 2024 - 2025</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Centre d'Animation Saint-Jérôme (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Gestion d'affluence et sens du collectif.</li>
                    </ul>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Carlos_Burger_King.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Carlos_Burger_King.pdf
";
    } else {
        $dompdf->stream("CV_Carlos_Burger_King.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Carlos Moreira Veiga - Équipier Polyvalent de Restauration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f7f4ee; }
        .landing-card { max-width: 600px; margin: 80px auto; text-align: center; padding: 40px; border-top: 5px solid #b91c1c; border-radius: 8px; background: white; }
        .btn-custom { background-color: #b91c1c; border: 2px solid #b91c1c; color: #ffffff; padding: 14px 28px; font-size: 1.1rem; font-weight: bold; }
        .btn-custom:hover { opacity: 0.9; color: #ffffff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV de <span style="color:#b91c1c">Carlos MOREIRA VEIGA</span></h1>
            <p class="text-muted mb-4">Équipier Polyvalent de Restauration</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-custom btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV de Carlos (PDF)
                </button>
            </form>
            <div>
                <a href="carlos_cv.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Carlos Moreira Veiga</a>
            </div>
        </div>
    </div>
</body>
</html>