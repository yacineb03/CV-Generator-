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
            border: 3px solid #0284c7;
            display: block;
            margin: 0 auto;
        }

        .side-title {
            color: #0284c7;
            font-size: 8.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1.5px solid #0284c7;
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
            color: #0284c7;
            font-weight: bold;
        }

        /* FORMATION */
        .edu-block {
            margin-bottom: 7px;
            font-size: 7.5pt;
            line-height: 1.25;
        }
        .edu-year {
            color: #0284c7;
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
            border-left: 2.5px solid #0284c7;
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
            color: #0284c7;
            letter-spacing: 2px;
            font-size: 8pt;
        }

        /* DISPO CALLOUT */
        .dispo-card {
            background-color: rgba(0, 191, 165, 0.12);
            border: 1px solid #0284c7;
            border-radius: 4px;
            padding: 6px 8px;
            margin-top: 10px;
            text-align: center;
            font-size: 7.5pt;
            font-weight: bold;
            color: #0284c7;
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
            color: #0284c7;
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
            background-color: #0284c7;
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
            border-left: 3px solid #0284c7;
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
            border-bottom: 1.5px solid #0284c7;
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
            color: #0284c7;
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
                <div class="skill-badge">&bull; Cadence en caisse & zéro écart monétaire</div>
                <div class="skill-badge">&bull; Dépotage matinal palettes & mise en rayon</div>
                <div class="skill-badge">&bull; Respect chaîne du froid & rotation FIFO</div>
                <div class="skill-badge">&bull; Résistance physique & dynamisme matinal</div>
                <div class="skill-badge">&bull; Polyvalence caisse / libre-service / cuisson</div>

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
                    CDI 18h-24h &bull; Matinaux & Flexibles
                </div>
            </td>

            <!-- CONTENU PRINCIPAL DROIT -->
            <td class="main-content">
                <div class="header-box">
                    <div class="name-title">
                        <span class="name-first">DJIBRIL</span> <span class="name-last">MAILLET</span>
                    </div>
                    <div class="job-headline">Équipier Polyvalent de Magasin &bull; Caisse & Rayons</div>
                    <div>
                        <span class="badge-pill">LIDL &bull; CDI 18H-24H</span>
                    </div>
                </div>

                <div class="profile-quote">
                    &laquo; Étudiant en L1 Droit endurant, matinal et habitué aux cadences rapides de la grande distribution. Maîtrise des standards de caisse rapide, du dépotage matinal de palettes, de la rotation FIFO et de la propreté exemplaire. &raquo;
                </div>

                <div class="section-header">Expériences Professionnelles</div>

                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Équipier Polyvalent de Supermarché &bull; Libre-Service & Caisse</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Mai 2025 - Oct. 2025</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Supermarché de Proximité (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Encaissement à cadence soutenue, gestion sans écart des flux monétaires et accueil souriant des clients.</li>
                        <li>Mise en rayon matinale rapide (dépotage palettes au transpalette, contrôle DLC, respect de la rotation FIFO).</li>
                        <li>Entretien rigoureux des allées marchandes, propreté irréprochable et cuisson du point chaud.</li>
                        <li>Orientation rapide et efficace des clients dans les rayons.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Employé Libre-Service & Réassort Rayons</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Janv. 2025 - Avril 2025</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Enseigne Grande Distribution (Région PACA)</div>
                    <ul class="tasks-list">
                        <li>Approvisionnement dynamique des rayons épicerie et liquides avec tire-palette manuel.</li>
                        <li>Facing soigné, étiquetage électronique des prix et gestion rigoureuse des invendus/casse.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Agent Polyvalent & Logistique Accueil</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Oct. 2024 - Déc. 2024</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Intercruise — MSC Croisières (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Endurance physique, gestion du flux passagers avec courtoisie et réactivité.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Préparateur de Commandes & Manutentionnaire</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Juil. 2024 - Sept. 2024</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Entrepôt Logistique Alimentaire (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Prélèvement colis au transpalette, respect des cadences horaires et sécurité gestuelle.</li>
                    </ul>
                </div>
                <div class="exp-item">
                    <table class="exp-table">
                        <tr>
                            <td class="exp-role">Employé Polyvalent de Commerce</td>
                            <td style="text-align: right;"><span class="exp-date-badge">Fév. 2024 - Juin 2024</span></td>
                        </tr>
                    </table>
                    <div class="exp-sub">Point de Vente Alimentaire (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Tenue de caisse, déchargement des livraisons et relation client de proximité.</li>
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
        file_put_contents('CV_Djibril_Lidl.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Djibril_Lidl.pdf
";
    } else {
        $dompdf->stream("CV_Djibril_Lidl.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Djibril Maillet - Équipier Polyvalent de Magasin &bull; Caisse & Rayons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card { max-width: 600px; margin: 80px auto; text-align: center; padding: 40px; border-top: 5px solid #111827; border-radius: 8px; }
        .btn-custom { background-color: #111827; border: 2px solid #0284c7; color: #0284c7; padding: 14px 28px; font-size: 1.1rem; font-weight: bold; }
        .btn-custom:hover { background-color: #0284c7; color: #111827; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV de <span style="color:#111827">Djibril MAILLET</span></h1>
            <p class="text-muted mb-4">Équipier Polyvalent de Magasin &bull; Caisse & Rayons</p>
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