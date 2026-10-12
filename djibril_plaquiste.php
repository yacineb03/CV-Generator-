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
        @page { margin: 0; }
        body {
            font-family: Helvetica, Arial, sans-serif;
            margin: 0; padding: 0;
            color: #1e293b; background-color: #ffffff;
            line-height: 1.25;
            -webkit-font-smoothing: antialiased;
        }
        .header-banner {
            width: 100%; background-color: #0f172a;
            padding: 16px 20px 14px 20px; box-sizing: border-box;
        }
        .header-table { width: 100%; border-collapse: collapse; }
        .photo-cell { width: 72px; vertical-align: middle; }
        .profile-photo {
            width: 68px; height: 68px; border-radius: 50%;
            border: 2.5px solid #d97706;
        }
        .name-cell { vertical-align: middle; padding-left: 14px; }
        .name {
            font-size: 19pt; font-weight: bold; color: #ffffff;
            margin: 0; text-transform: uppercase; letter-spacing: 0.8px;
        }
        .job-tag {
            display: inline-block; background-color: #d97706;
            color: #ffffff; font-size: 8pt; font-weight: bold;
            padding: 2px 8px; border-radius: 3px;
            text-transform: uppercase; margin-top: 3px; letter-spacing: 0.4px;
        }
        .job-sub {
            color: #94a3b8; font-size: 8.5pt; font-weight: bold;
            margin-left: 6px; text-transform: uppercase;
        }
        .contact-cell {
            width: 215px; vertical-align: middle; text-align: right;
            font-size: 7.5pt; line-height: 1.35; color: #cbd5e1;
        }
        .contact-item { margin-bottom: 2px; white-space: nowrap; }
        .contact-highlight { color: #d97706; font-weight: bold; }
        .accent-strip { width: 100%; height: 4px; background-color: #d97706; }
        .content-container { padding: 12px 18px 10px 18px; }
        .grid-table { width: 100%; border-collapse: collapse; }
        .col-left { width: 32%; vertical-align: top; padding-right: 14px; }
        .col-right { width: 68%; vertical-align: top; padding-left: 4px; }
        .side-card {
            background-color: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 5px; padding: 8px 10px; margin-bottom: 9px;
        }
        .side-card-title {
            color: #0f172a; font-size: 8.5pt; font-weight: bold;
            text-transform: uppercase; letter-spacing: 0.5px;
            border-bottom: 1.5px solid #d97706; padding-bottom: 2px; margin-bottom: 6px;
        }
        .about-text { font-size: 7.5pt; line-height: 1.3; color: #475569; margin: 0; }
        .skill-pill {
            background-color: #f8fafc; border: 1px solid #cbd5e1;
            color: #0f172a; font-size: 7.5pt; font-weight: bold;
            padding: 3px 6px; border-radius: 4px; margin-bottom: 4px;
        }
        .edu-item { margin-bottom: 6px; font-size: 7.5pt; line-height: 1.25; }
        .edu-item:last-child { margin-bottom: 0; }
        .edu-badge { font-weight: bold; color: #d97706; font-size: 7pt; }
        .edu-title { font-weight: bold; color: #0f172a; }
        .edu-sub { color: #64748b; font-style: italic; }
        .section-header {
            color: #0f172a; font-size: 9.5pt; font-weight: bold;
            text-transform: uppercase; letter-spacing: 0.6px;
            border-bottom: 1.5px solid #d97706; padding-bottom: 3px; margin-bottom: 8px;
        }
        .exp-card {
            border-left: 2.5px solid #d97706; padding-left: 8px; margin-bottom: 7px;
        }
        .exp-header-table { width: 100%; border-collapse: collapse; margin-bottom: 2px; }
        .exp-role { font-weight: bold; font-size: 8.5pt; color: #0f172a; text-align: left; }
        .exp-date-badge {
            background-color: #f1f5f9; border: 1px solid #e2e8f0;
            color: #d97706; font-weight: bold; font-size: 7pt;
            padding: 1px 5px; border-radius: 3px; text-align: right; white-space: nowrap;
        }
        .exp-place { font-size: 7.5pt; color: #64748b; font-style: italic; margin-bottom: 2px; }
        ul.tasks-list { margin: 1px 0 2px 12px; padding: 0; }
        ul.tasks-list li { font-size: 7.8pt; color: #334155; margin-bottom: 1.5px; line-height: 1.25; }
    </style>
</head>
<body>

    <div class="header-banner">
        <table class="header-table">
            <tr>
                <td class="photo-cell">$photoHtml</td>
                <td class="name-cell">
                    <h1 class="name">DJIBRIL MAILLET</h1>
                    <div style="margin-top: 3px;">
                        <span class="job-tag">PLAQUISTE &bull; SECOND ŒUVRE BTP</span>
                        <span class="job-sub">Pose Cloisons, Faux-Plafonds & Isolants</span>
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

    <div class="content-container">
        <table class="grid-table">
            <tr>
                <td class="col-left">
                    <div class="side-card">
                        <div class="side-card-title">Profil &amp; Atouts</div>
                        <p class="about-text">Jeune travailleur rigoureux, très courageux et doté d'une solide résistance physique. Expérience concrète sur chantiers de rénovation : pose d'ossatures métalliques, plaques de plâtre BA13, isolants et joints.</p>
                    </div>

                    <div class="side-card">
                        <div class="side-card-title">Savoir-Être</div>
                        <div class="skill-pill">&bull; Implantation rails, montants & suspentes</div>
                        <div class="skill-pill">&bull; Découpe & vissage plaques de plâtre BA13</div>
                        <div class="skill-pill">&bull; Pose isolants laine de verre / roche</div>
                        <div class="skill-pill">&bull; Application bandes calicots & enduit</div>
                        <div class="skill-pill">&bull; Nettoyage chantier & sécurité EPI</div>
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
                            <div style="margin-top: 4px; color: #d97706; font-weight: bold;">Disponibilité : Disponible chantiers &bull; Permis B</div>
                        </div>
                    </div>
                </td>

                <td class="col-right">
                    <div class="section-header">Expériences Professionnelles</div>
                    <div class="exp-card">
                        <table class="exp-header-table">
                            <tr>
                                <td class="exp-role">Aide-Plaquiste & Poseur Cloisons Sèches</td>
                                <td style="text-align: right;"><span class="exp-date-badge">Mai 2025 - Oct. 2025</span></td>
                            </tr>
                        </table>
                        <div class="exp-place">Entreprise de Rénovation & BTP (Marseille & PACA)</div>
                        <ul class="tasks-list">
                            <li>Prise de mesures, traçage et fixation des ossatures métalliques (rails et montants).</li>
                            <li>Manutention, découpe précise et vissage des plaques de plâtre BA13 sur murs et cloisons.</li>
                            <li>Mise en place des panneaux d'isolation thermique et phonique dans le respect des normes.</li>
                            <li>Préparation des bandes à joint et nettoyage méthodique du chantier en fin de journée.</li>
                        </ul>
                    </div>
                    <div class="exp-card">
                        <table class="exp-header-table">
                            <tr>
                                <td class="exp-role">Aide-Ouvrier / Peintre en Bâtiment</td>
                                <td style="text-align: right;"><span class="exp-date-badge">Fév. 2025 - Mai 2025</span></td>
                            </tr>
                        </table>
                        <div class="exp-place">Chantiers divers de Rénovation (Région PACA)</div>
                        <ul class="tasks-list">
                            <li>Préparation des supports : ponçage, rebouchage des fissures, application d'enduits de lissage.</li>
                            <li>Lessivage, protection des sols/menuiseries et application soignée de couches d'impression.</li>
                        </ul>
                    </div>
                    <div class="exp-card">
                        <table class="exp-header-table">
                            <tr>
                                <td class="exp-role">Manutentionnaire Chantier & Approvisionnement</td>
                                <td style="text-align: right;"><span class="exp-date-badge">Juil. 2024 - Déc. 2024</span></td>
                            </tr>
                        </table>
                        <div class="exp-place">Chantiers Logement (Marseille)</div>
                        <ul class="tasks-list">
                            <li>Déchargement des camions de matériaux (sacs d'enduit, rails, placo) et portage aux étages.</li>
                            <li>Évacuation continue des gravats et respect strict du port des EPI.</li>
                        </ul>
                    </div>
                    <div class="exp-card">
                        <table class="exp-header-table">
                            <tr>
                                <td class="exp-role">Ouvrier Polyvalent Second Œuvre</td>
                                <td style="text-align: right;"><span class="exp-date-badge">Mars 2024 - Juin 2024</span></td>
                            </tr>
                        </table>
                        <div class="exp-place">Rénovation Résidentielle (Marseille)</div>
                        <ul class="tasks-list">
                            <li>Assistance aux artisans plaquistes et peintres, découpe de matériaux et maintien du chantier propre.</li>
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
        file_put_contents('CV_Djibril_Plaquiste.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Djibril_Plaquiste.pdf
";
    } else {
        $dompdf->stream("CV_Djibril_Plaquiste.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Djibril Maillet - Pose Cloisons, Faux-Plafonds & Isolants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card { max-width: 600px; margin: 80px auto; text-align: center; padding: 40px; border-top: 5px solid #d97706; border-radius: 8px; }
        .btn-custom { background-color: #0f172a; border: 2px solid #d97706; color: #d97706; padding: 14px 28px; font-size: 1.1rem; font-weight: bold; }
        .btn-custom:hover { background-color: #d97706; color: #ffffff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV de <span style="color:#0f172a">Djibril MAILLET</span></h1>
            <p class="text-muted mb-4">Pose Cloisons, Faux-Plafonds & Isolants</p>
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