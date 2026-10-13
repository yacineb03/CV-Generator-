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
            size: A4 portrait;
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
        .main-layout {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        /* SIDEBAR (32% width) */
        .sidebar {
            width: 32%;
            background-color: #111827;
            color: #f8fafc;
            padding: 24px 16px 20px 18px;
            vertical-align: top;
        }
        .photo-container {
            text-align: center;
            margin-bottom: 16px;
        }
        .profile-photo {
            width: 82px;
            height: 82px;
            border-radius: 50%;
            border: 3px solid #ec4899;
            display: block;
            margin: 0 auto;
        }

        .side-title {
            color: #ec4899;
            font-size: 8.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1.5px solid #ec4899;
            padding-bottom: 3px;
            margin-top: 14px;
            margin-bottom: 8px;
        }
        .side-title:first-of-type {
            margin-top: 0;
        }

        /* CONTACT */
        .contact-row {
            margin-bottom: 5px;
            font-size: 7.5pt;
            line-height: 1.3;
            color: #e2e8f0;
        }
        .contact-label {
            font-weight: bold;
            color: #94a3b8;
            font-size: 6.8pt;
            text-transform: uppercase;
        }
        .contact-val {
            color: #ffffff;
        }
        .contact-highlight {
            color: #ec4899;
            font-weight: bold;
        }

        /* FORMATION */
        .edu-block {
            margin-bottom: 7px;
            font-size: 7.5pt;
            line-height: 1.25;
        }
        .edu-year {
            color: #ec4899;
            font-weight: bold;
            font-size: 7pt;
        }
        .edu-degree {
            font-weight: bold;
            color: #ffffff;
        }
        .edu-school {
            color: #94a3b8;
            font-size: 7pt;
            font-style: italic;
        }

        /* SKILLS BADGES */
        .skill-badge {
            background-color: #1f2937;
            border-left: 2.5px solid #ec4899;
            color: #f1f5f9;
            font-size: 7.2pt;
            font-weight: bold;
            padding: 3px 6px;
            margin-bottom: 4px;
            border-radius: 2px;
        }

        /* LANGUES & DOTS */
        .lang-item {
            margin-bottom: 5px;
            font-size: 7.5pt;
            color: #e2e8f0;
        }
        .lang-dots {
            color: #ec4899;
            letter-spacing: 2px;
            font-size: 8pt;
        }

        /* DISPO CALLOUT */
        .dispo-card {
            background-color: rgba(0, 191, 165, 0.12);
            border: 1px solid #ec4899;
            border-radius: 4px;
            padding: 6px 8px;
            margin-top: 10px;
            text-align: center;
            font-size: 7.5pt;
            font-weight: bold;
            color: #ec4899;
        }

        /* RIGHT MAIN COLUMN (68% width) */
        .main-content {
            width: 68%;
            background-color: #ffffff;
            padding: 24px 22px 20px 22px;
            vertical-align: top;
        }

        /* NAME & HEADER */
        .header-box {
            margin-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .name-title {
            font-size: 22pt;
            font-weight: bold;
            margin: 0;
            line-height: 1.1;
            letter-spacing: 0.5px;
        }
        .name-first {
            color: #0f172a;
        }
        .name-last {
            color: #ec4899;
        }
        .job-headline {
            font-size: 10pt;
            font-weight: bold;
            color: #475569;
            text-transform: uppercase;
            margin-top: 4px;
            letter-spacing: 0.5px;
        }
        .badge-pill {
            display: inline-block;
            background-color: #ec4899;
            color: #ffffff;
            font-weight: bold;
            font-size: 7.5pt;
            padding: 2px 9px;
            border-radius: 12px;
            text-transform: uppercase;
            margin-top: 5px;
            letter-spacing: 0.4px;
        }

        /* HOOK / PROFIL */
        .profile-quote {
            background-color: #f8fafc;
            border-left: 3px solid #ec4899;
            padding: 6px 10px;
            margin-bottom: 12px;
            font-size: 7.6pt;
            line-height: 1.35;
            color: #334155;
            font-style: italic;
            border-radius: 0 4px 4px 0;
        }

        /* SECTION TITLES */
        .section-header {
            color: #0f172a;
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-top: 6px;
            margin-bottom: 8px;
            padding-bottom: 2px;
            border-bottom: 1.5px solid #ec4899;
        }

        /* TIMELINE EXPERIENCES */
        .exp-item {
            margin-bottom: 7px;
            border-left: 2px solid #e2e8f0;
            padding-left: 8px;
            position: relative;
        }
        .exp-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1px;
        }
        .exp-role {
            font-weight: bold;
            font-size: 8.5pt;
            color: #0f172a;
            text-align: left;
        }
        .exp-date-badge {
            background-color: #f1f5f9;
            color: #0f766e;
            border: 1px solid #cbd5e1;
            font-weight: bold;
            font-size: 7pt;
            padding: 1px 6px;
            border-radius: 3px;
            text-align: right;
            white-space: nowrap;
        }
        .exp-sub {
            font-size: 7.5pt;
            color: #ec4899;
            font-weight: bold;
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

    <table class="main-layout">
        <tr>
            <!-- SIDEBAR GAUCHE -->
            <td class="sidebar">
                <div class="photo-container">
                    $photoHtml
                </div>

                <div class="side-title">Contact</div>
                <div class="contact-row">
                    <div class="contact-label">Téléphone</div>
                    <div class="contact-val">+33 6 56 82 85 67</div>
                </div>
                <div class="contact-row">
                    <div class="contact-label">Email</div>
                    <div class="contact-val">jeandjdj13@gmail.com</div>
                </div>
                <div class="contact-row">
                    <div class="contact-label">Localisation</div>
                    <div class="contact-val">Marseille (13005) &bull; France</div>
                </div>
                <div class="contact-row">
                    <div class="contact-label">Mobilité</div>
                    <div class="contact-val contact-highlight">Permis B + Véhicule personnel</div>
                </div>
                <div class="contact-row">
                    <div class="contact-label">Profil</div>
                    <div class="contact-val">19 ans &bull; Né le 09/07/2006</div>
                </div>

                <div class="side-title">Savoir-Être</div>
                <div class="skill-badge">&bull; Accueil chaleureux & conseil personnalisé</div>
                <div class="skill-badge">&bull; Développement des ventes complémentaires</div>
                <div class="skill-badge">&bull; Tenue de caisse tactile & fidélisation</div>
                <div class="skill-badge">&bull; Merchandising & valorisation présentoirs</div>
                <div class="skill-badge">&bull; Sens du détail & emballages cadeaux</div>

                <div class="side-title">Formation</div>
                <div class="edu-block">
                    <div class="edu-year">2025 - 2026</div>
                    <div class="edu-degree">L1 Droit</div>
                    <div class="edu-school">Faculté Canebière Marseille</div>
                </div>
                <div class="edu-block">
                    <div class="edu-year">2024 - 2025</div>
                    <div class="edu-degree">Baccalauréat Général</div>
                    <div class="edu-school">Lycée Victor Hugo</div>
                </div>
                <div class="edu-block">
                    <div class="edu-year">2021</div>
                    <div class="edu-degree">Brevet &amp; Certif. PIX</div>
                    <div class="edu-school">Compétences numériques</div>
                </div>

                <div class="side-title">Langues</div>
                <div class="lang-item">
                    Français : Maternelle<br>
                    <span class="lang-dots">&bull;&bull;&bull;&bull;&bull;</span>
                </div>
                <div class="lang-item">
                    Anglais : Niveau B2 (Courant)<br>
                    <span class="lang-dots">&bull;&bull;&bull;&bull;&empty;</span>
                </div>

                <div class="dispo-card">
                    Disponibilité Immédiate<br>
                    Vente magasin &bull; Immédiat
                </div>
            </td>

            <!-- CONTENU PRINCIPAL DROIT -->
            <td class="main-content">
                <div class="header-box">
                    <div class="name-title">
                        <span class="name-first">DJIBRIL</span> <span class="name-last">MAILLET</span>
                    </div>
                    <div class="job-headline">Conseiller de Vente &bull; Vendeur Magasin</div>
                    <div>
                        <span class="badge-pill">CLAIRE'S &bull; VENTE & ACCESSOIRES</span>
                    </div>
                </div>

                <div class="profile-quote">
                    &laquo; Étudiant en L1 Droit souriant, dynamique et passionné par le contact client. Excellente présentation, aisance relationnelle naturelle, sens aigu du conseil personnalisé et du merchandising visuel en boutique. &raquo;
                </div>

                <div class="section-header">Expériences Professionnelles</div>

                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Vendeur Conseil &bull; Accessoires & Bijoux Fantaisie</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Mai 2025 - Oct. 2025</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Boutique d'Accessoires & Mode (Centre Commercial Marseille)</div>
                    <ul class="tasks-list">
                        <li>Accueil souriant, découverte des envies des clientes et conseil stylistique personnalisé.</li>
                        <li>Ventes additionnelles actives (lots d'accessoires, cosmétiques tendance, cartes cadeaux).</li>
                        <li>Encaissement rapide en caisse informatisée, emballages soignés et fidélisation.</li>
                        <li>Maintien d'un merchandising dynamique des présentoirs muraux et réassort continu.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Agent d'Accueil & Orientation Public</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Fév. 2025 - Mai 2025</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Intercruise — MSC Croisières (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Accueil multilingue et bienveillant des familles et touristes en gare maritime.</li>
                        <li>Sens de l'écoute, politesse irréprochable et gestion fluide des attentes.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Employé Polyvalent de Commerce & Vente</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Juil. 2024 - Déc. 2024</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Boutique Cadeaux & Mode (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Conseil client, tenue de caisse sans erreur et étiquetage soigné des nouveautés.</li>
                        <li>Participation aux inventaires et entretien rigoureux de la boutique.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Animateur Polyvalent & Sens du Contact</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Mars 2024 - Juil. 2024</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Centre d'Accueil Jeunesse (Région PACA)</div>
                    <ul class="tasks-list">
                        <li>Dynamisme communicatif, pédagogie et relation de confiance avec le public.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Assistant Accueil Clients</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Déc. 2023 - Fév. 2024</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Espace Commercial (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Sourire, courtoisie et orientation efficace des visiteurs.</li>
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
        file_put_contents('CV_Djibril_Claires.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Djibril_Claires.pdf
";
    } else {
        $dompdf->stream("CV_Djibril_Claires.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Djibril Maillet - Conseiller de Vente &bull; Vendeur Magasin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card { max-width: 600px; margin: 80px auto; text-align: center; padding: 40px; border-top: 5px solid #111827; border-radius: 8px; }
        .btn-custom { background-color: #111827; border: 2px solid #ec4899; color: #ec4899; padding: 14px 28px; font-size: 1.1rem; font-weight: bold; }
        .btn-custom:hover { background-color: #ec4899; color: #111827; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV de <span style="color:#111827">Djibril MAILLET</span></h1>
            <p class="text-muted mb-4">Conseiller de Vente &bull; Vendeur Magasin</p>
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