<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['generate']) || (php_sapi_name() === 'cli' && isset($argv[1]) && $argv[1] === 'generate')) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');
    $dompdf = new Dompdf($options);

    $photoHtml = '';
    $photoPaths = ['profil_djibril.jpg', 'images/profil_djibril.jpg'];
    foreach ($photoPaths as $path) {
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $photoHtml = '<img src="' . $base64 . '" class="profile-photo" alt="Photo Djibril">';
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
        }
        body {
            font-family: Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #1e293b;
            background-color: #ffffff;
            line-height: 1.25;
            -webkit-font-smoothing: antialiased;
        }

        /* HEADER BANNER */
        .header-banner {
            width: 100%;
            background-color: #0f172a;
            padding: 16px 20px 14px 20px;
            box-sizing: border-box;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .photo-cell {
            width: 72px;
            vertical-align: middle;
        }
        .profile-photo {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            border: 2.5px solid #00bfa5;
        }
        .name-cell {
            vertical-align: middle;
            padding-left: 14px;
        }
        .name {
            font-size: 19pt;
            font-weight: bold;
            color: #ffffff;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .job-tag {
            display: inline-block;
            background-color: #00bfa5;
            color: #0f172a;
            font-size: 8pt;
            font-weight: bold;
            padding: 2px 8px;
            border-radius: 3px;
            text-transform: uppercase;
            margin-top: 3px;
            letter-spacing: 0.4px;
        }
        .job-sub {
            color: #94a3b8;
            font-size: 8.5pt;
            font-weight: bold;
            margin-left: 6px;
            text-transform: uppercase;
        }
        .contact-cell {
            width: 215px;
            vertical-align: middle;
            text-align: right;
            font-size: 7.5pt;
            line-height: 1.35;
            color: #cbd5e1;
        }
        .contact-item {
            margin-bottom: 2px;
            white-space: nowrap;
        }
        .contact-highlight {
            color: #00bfa5;
            font-weight: bold;
        }

        /* ACCENT STRIP */
        .accent-strip {
            width: 100%;
            height: 4px;
            background-color: #00bfa5;
        }

        /* CONTENT CONTAINER */
        .content-container {
            padding: 12px 18px 10px 18px;
        }
        .grid-table {
            width: 100%;
            border-collapse: collapse;
        }
        .col-left {
            width: 32%;
            vertical-align: top;
            padding-right: 14px;
        }
        .col-right {
            width: 68%;
            vertical-align: top;
            padding-left: 4px;
        }

        /* LEFT COLUMN CARDS */
        .side-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 8px 10px;
            margin-bottom: 9px;
        }
        .side-card-title {
            color: #0f172a;
            font-size: 8.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1.5px solid #00bfa5;
            padding-bottom: 2px;
            margin-bottom: 6px;
        }
        .about-text {
            font-size: 7.5pt;
            line-height: 1.3;
            color: #475569;
            margin: 0;
        }

        /* SKILL PILLS */
        .skill-pill {
            background-color: #e6fffa;
            border: 1px solid #99f6e4;
            color: #0f766e;
            font-size: 7.5pt;
            font-weight: bold;
            padding: 3px 6px;
            border-radius: 4px;
            margin-bottom: 4px;
        }

        /* FORMATION ITEMS */
        .edu-item {
            margin-bottom: 6px;
            font-size: 7.5pt;
            line-height: 1.25;
        }
        .edu-item:last-child {
            margin-bottom: 0;
        }
        .edu-badge {
            font-weight: bold;
            color: #0f766e;
            font-size: 7pt;
        }
        .edu-title {
            font-weight: bold;
            color: #0f172a;
        }
        .edu-sub {
            color: #64748b;
            font-style: italic;
        }

        /* RIGHT COLUMN : EXPERIENCES */
        .section-header {
            color: #0f172a;
            font-size: 9.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border-bottom: 1.5px solid #00bfa5;
            padding-bottom: 3px;
            margin-bottom: 8px;
        }
        .exp-card {
            border-left: 2.5px solid #00bfa5;
            padding-left: 8px;
            margin-bottom: 7px;
        }
        .exp-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }
        .exp-role {
            font-weight: bold;
            font-size: 8.5pt;
            color: #0f172a;
            text-align: left;
        }
        .exp-date-badge {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #0f766e;
            font-weight: bold;
            font-size: 7pt;
            padding: 1px 5px;
            border-radius: 3px;
            text-align: right;
            white-space: nowrap;
        }
        .exp-place {
            font-size: 7.5pt;
            color: #64748b;
            font-style: italic;
            margin-bottom: 2px;
        }
        ul.tasks-list {
            margin: 1px 0 2px 12px;
            padding: 0;
        }
        ul.tasks-list li {
            font-size: 7.8pt;
            color: #334155;
            margin-bottom: 1.5px;
            line-height: 1.25;
        }
    </style>
</head>
<body>

    <!-- TOP EXECUTIVE HEADER -->
    <div class="header-banner">
        <table class="header-table">
            <tr>
                <td class="photo-cell">
                    $photoHtml
                </td>
                <td class="name-cell">
                    <h1 class="name">DJIBRIL MAILLET</h1>
                    <div style="margin-top: 3px;">
                        <span class="job-tag">QUICK &bull; CONTRAT 12H / 24H</span>
                        <span class="job-sub">Équipier Polyvalent de Restauration</span>
                    </div>
                </td>
                <td class="contact-cell">
                    <div class="contact-item"><strong>Tél :</strong> +33 6 56 82 85 67</div>
                    <div class="contact-item"><strong>Email :</strong> jeandjdj13@gmail.com</div>
                    <div class="contact-item"><strong>Ville :</strong> Marseille (13005) &bull; France</div>
                    <div class="contact-item contact-highlight">Permis B + Véhicule Personnel</div>
                    <div class="contact-item">19 ans (09/07/2006) &bull; Immédiat</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="accent-strip"></div>

    <!-- MAIN BODY CONTENT -->
    <div class="content-container">
        <table class="grid-table">
            <tr>
                <!-- LEFT COLUMN -->
                <td class="col-left">
                    <div class="side-card">
                        <div class="side-card-title">Profil &amp; Atouts</div>
                        <p class="about-text">
                            Étudiant en L1 Droit rigoureux, dynamique et habitué aux environnements rythmés. Excellente aisance relationnelle, sens du service client et respect absolu des cadences et normes d'hygiène.
                        </p>
                    </div>

                    <div class="side-card">
                        <div class="side-card-title">Savoir-Être</div>
                        <div class="skill-pill">&bull; Cadence &amp; résistance au rush</div>
                        <div class="skill-pill">&bull; Rigueur normes HACCP &amp; hygiène</div>
                        <div class="skill-pill">&bull; Esprit d'équipe &amp; solidarité</div>
                        <div class="skill-pill">&bull; Polyvalence caisse, cuisine &amp; salle</div>
                        <div class="skill-pill">&bull; Ponctualité &amp; énergie constante</div>
                    </div>

                    <div class="side-card">
                        <div class="side-card-title">Formation</div>
                        <div class="edu-item">
                            <div class="edu-badge">2025 - 2026</div>
                            <div class="edu-title">L1 Droit</div>
                            <div class="edu-sub">Faculté Canebière Marseille</div>
                        </div>
                        <div class="edu-item">
                            <div class="edu-badge">2024 - 2025</div>
                            <div class="edu-title">Baccalauréat Général</div>
                            <div class="edu-sub">Lycée Victor Hugo</div>
                        </div>
                        <div class="edu-item">
                            <div class="edu-badge">2021</div>
                            <div class="edu-title">Brevet &amp; Certif. PIX</div>
                            <div class="edu-sub">Compétences numériques</div>
                        </div>
                    </div>

                    <div class="side-card" style="margin-bottom: 0;">
                        <div class="side-card-title">Langues &amp; Infos</div>
                        <div style="font-size: 7.5pt; color: #334155; line-height: 1.35;">
                            <div><strong>Français :</strong> Langue maternelle</div>
                            <div><strong>Anglais :</strong> Niveau B2 (Accueil bilingue)</div>
                            <div style="margin-top: 4px; color: #0f766e; font-weight: bold;">Disponibilité : Contrat 12h/24h</div>
                        </div>
                    </div>
                </td>

                <!-- RIGHT COLUMN -->
                <td class="col-right">
                    <div class="section-header">Expériences Professionnelles</div>

                    <div class="exp-card">
                        <table class="exp-header-table">
                            <tr>
                                <td class="exp-role">Équipier Polyvalent &bull; Service &amp; Restauration Rapide</td>
                                <td style="text-align: right;"><span class="exp-date-badge">Mai 2025 - Oct. 2025</span></td>
                            </tr>
                        </table>
                        <div class="exp-place">Enseigne de Restauration Rapide (Centre Commercial Marseille)</div>
                        <ul class="tasks-list">
                            <li>Accueil chaleureux, prise de commande aux bornes tactiles, encaissement rapide et gestion des flux.</li>
                            <li>Préparation minute des sandwichs, cuisson frites et assemblage des plateaux et commandes à emporter.</li>
                            <li>Application stricte des règles d'hygiène et normes HACCP, nettoyage et désinfection des postes.</li>
                        </ul>
                    </div>

                    <div class="exp-card">
                        <table class="exp-header-table">
                            <tr>
                                <td class="exp-role">Agent d'Orientation &amp; Accueil Portuaire</td>
                                <td style="text-align: right;"><span class="exp-date-badge">Fév. 2025 - Mai 2025</span></td>
                            </tr>
                        </table>
                        <div class="exp-place">Intercruise — MSC Croisières (Marseille)</div>
                        <ul class="tasks-list">
                            <li>Accueil professionnel et orientation de centaines de passagers lors des escales de croisière.</li>
                            <li>Fluidification active des files d'attente lors des pics d'affluence et contrôle d'accès.</li>
                        </ul>
                    </div>

                    <div class="exp-card">
                        <table class="exp-header-table">
                            <tr>
                                <td class="exp-role">Employé Polyvalent de Commerce &bull; Vente &amp; Caisse</td>
                                <td style="text-align: right;"><span class="exp-date-badge">Juil. 2024 - Déc. 2024</span></td>
                            </tr>
                        </table>
                        <div class="exp-place">Commerce de Détail &amp; Distribution (Marseille)</div>
                        <ul class="tasks-list">
                            <li>Accueil client souriant, conseil rapide, réassort dynamique des rayons et tenue de caisse sans écart.</li>
                            <li>Entretien régulier des locaux et réception ordonnée des réapprovisionnements.</li>
                        </ul>
                    </div>

                    <div class="exp-card">
                        <table class="exp-header-table">
                            <tr>
                                <td class="exp-role">Animateur Polyvalent &bull; Gestion d'Activités &amp; Logistique</td>
                                <td style="text-align: right;"><span class="exp-date-badge">Mars 2024 - Juil. 2024</span></td>
                            </tr>
                        </table>
                        <div class="exp-place">Centre d'Accueil Jeunesse &amp; Séjours (Région PACA)</div>
                        <ul class="tasks-list">
                            <li>Coordination logistique des plannings d'activités et respect des règles strictes de sécurité.</li>
                            <li>Sens de l'écoute, réactivité et travail en étroite synergie avec l'équipe d'encadrement.</li>
                        </ul>
                    </div>

                    <div class="exp-card">
                        <table class="exp-header-table">
                            <tr>
                                <td class="exp-role">Assistant Accueil &amp; Services aux Usagers</td>
                                <td style="text-align: right;"><span class="exp-date-badge">Déc. 2023 - Fév. 2024</span></td>
                            </tr>
                        </table>
                        <div class="exp-place">Services &amp; Agence de Proximité (Marseille)</div>
                        <ul class="tasks-list">
                            <li>Accueil physique, information et orientation courtoise du public vers les services dédiés.</li>
                        </ul>
                    </div>
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
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Djibril_Quick.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Djibril_Quick.pdf\n";
    } else {
        $dompdf->stream("CV_Djibril_Quick.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Djibril Maillet - Quick</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card { max-width: 600px; margin: 80px auto; text-align: center; padding: 40px; border-top: 5px solid #0f172a; border-radius: 8px; }
        .btn-custom { background-color: #0f172a; border: 2px solid #00bfa5; color: #00bfa5; padding: 14px 28px; font-size: 1.1rem; font-weight: bold; }
        .btn-custom:hover { background-color: #00bfa5; color: #0f172a; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV de <span style="color:#0f172a">Djibril MAILLET</span></h1>
            <p class="text-muted mb-4">Quick — Équipier Polyvalent &bull; Contrat 12h/24h</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-custom btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV de Djibril (PDF)
                </button>
            </form>
            <div>
                <a href="djibril_cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Djibril Maillet</a>
            </div>
        </div>
    </div>
</body>
</html>
