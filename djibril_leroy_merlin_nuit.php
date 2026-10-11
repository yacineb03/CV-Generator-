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
        body { font-family: Helvetica, Arial, sans-serif; margin: 0; padding: 0; color: #1e293b; background-color: #ffffff; line-height: 1.25; }
        .layout-table { width: 100%; border-collapse: collapse; height: 100%; }
        .sidebar { width: 31%; background-color: #1c354d; color: #ffffff; padding: 22px 14px; vertical-align: top; }
        .main { width: 69%; background-color: #ffffff; padding: 22px 20px; vertical-align: top; }
        .sidebar-title { color: #00bfa5; font-size: 9.5pt; font-weight: bold; text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 1.5px solid #00bfa5; padding-bottom: 2px; margin-top: 15px; margin-bottom: 8px; }
        .sidebar-title:first-child { margin-top: 0; }
        .contact-group { margin-bottom: 6px; font-size: 8pt; line-height: 1.3; color: #e2e8f0; }
        .contact-label { font-weight: bold; color: #94a3b8; font-size: 7.5pt; }
        .contact-val { margin-bottom: 4px; }
        ul.sidebar-list { margin: 0; padding-left: 13px; font-size: 8pt; line-height: 1.35; color: #f1f5f9; }
        ul.sidebar-list li { margin-bottom: 3px; }
        .edu-item { margin-bottom: 7px; font-size: 8pt; line-height: 1.25; }
        .edu-date { font-weight: bold; color: #00bfa5; font-size: 7.5pt; }
        .edu-title { font-weight: bold; color: #ffffff; }
        .edu-sub { color: #94a3b8; font-size: 7.5pt; font-style: italic; }
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        .header-info { vertical-align: middle; text-align: left; }
        .header-photo-cell { width: 80px; text-align: right; vertical-align: middle; }
        .name { font-size: 19pt; font-weight: bold; color: #1c354d; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; }
        .job-title { font-size: 9.5pt; font-weight: bold; color: #64748b; text-transform: uppercase; margin-top: 3px; letter-spacing: 0.4px; }
        .accent-bar { width: 110px; height: 7px; background-color: #00bfa5; margin-top: 7px; border-radius: 2px; }
        .profile-photo { width: 72px; height: auto; border-radius: 4px; border: 2px solid #e2e8f0; }
        .main-section-title { font-size: 10pt; font-weight: bold; text-transform: uppercase; color: #1c354d; letter-spacing: 0.6px; border-bottom: 1.5px solid #cbd5e1; padding-bottom: 3px; margin-top: 8px; margin-bottom: 8px; }
        .exp-item { margin-bottom: 7px; }
        .exp-header-table { width: 100%; border-collapse: collapse; margin-bottom: 1px; }
        .exp-role { font-weight: bold; font-size: 8.5pt; color: #0f172a; text-align: left; }
        .exp-date { font-weight: bold; font-size: 8pt; color: #00bfa5; text-align: right; white-space: nowrap; }
        .exp-place { font-size: 7.5pt; color: #64748b; font-style: italic; margin-bottom: 2px; }
        ul.tasks-list { margin: 1px 0 2px 14px; padding: 0; }
        ul.tasks-list li { font-size: 8pt; color: #334155; margin-bottom: 1.5px; line-height: 1.25; }
    </style>
</head>
<body>

    <table class="layout-table">
        <tr>
            <td class="sidebar">
                <div class="sidebar-title">Contact</div>
                <div class="contact-group">
                    <div class="contact-label">Tél :</div>
                    <div class="contact-val">+33 6 56 82 85 67</div>
                    <div class="contact-label">Email :</div>
                    <div class="contact-val">jeandjdj13@gmail.com</div>
                    <div class="contact-label">Localisation :</div>
                    <div class="contact-val">Marseille (13005) &bull; France</div>
                    <div class="contact-label">Mobilité :</div>
                    <div class="contact-val" style="color: #00bfa5; font-weight: bold;">Permis B + Véhicule</div>
                    <div class="contact-label">Date de nais. :</div>
                    <div class="contact-val">09/07/2006</div>
                    <div class="contact-label">Disponibilité :</div>
                    <div class="contact-val" style="color: #5eead4;">CDI 17h50 (20h-23h30) &bull; Nocturne</div>
                </div>

                <div class="sidebar-title">Savoir-Être</div>
                <ul class="sidebar-list">
                    <li>Rigueur logistique &amp; sécurité des racks</li>
                    <li>Excellente condition physique (port de charges)</li>
                    <li>Vitesse d'exécution &amp; autonomie nocturne</li>
                    <li>Organisation &amp; méthode d'implantation</li>
                    <li>Ponctualité &amp; esprit d'équipe solidaire</li>
                </ul>

                <div class="sidebar-title">Langues</div>
                <ul class="sidebar-list">
                    <li>Anglais (Niveau B2)</li>
                    <li>Français (Langue maternelle)</li>
                </ul>

                <div class="sidebar-title">Formation</div>
                <div class="edu-item">
                    <div class="edu-date">2025 - 2026</div>
                    <div class="edu-title">L1 Droit</div>
                    <div class="edu-sub">Faculté Canebière Marseille</div>
                </div>
                <div class="edu-item">
                    <div class="edu-date">2024 - 2025</div>
                    <div class="edu-title">Baccalauréat Général</div>
                    <div class="edu-sub">Lycée Victor Hugo</div>
                </div>
                <div class="edu-item">
                    <div class="edu-date">2021</div>
                    <div class="edu-title">Brevet &amp; Certif. PIX</div>
                    <div class="edu-sub">Compétences numériques</div>
                </div>
            </td>

            <td class="main">
                <table class="header-table">
                    <tr>
                        <td class="header-info">
                            <h1 class="name">DJIBRIL MAILLET</h1>
                            <div class="job-title">Employé Logistique &bull; Mise en Rayon de Nuit</div>
                            <div class="job-title" style="color: #00bfa5; font-size: 8.5pt;">LEROY MERLIN — CDI 17H50 (20H00 - 23H30)</div>
                            <div class="accent-bar"></div>
                        </td>
                        <td class="header-photo-cell">
                            $photoHtml
                        </td>
                    </tr>
                </table>

                <div class="main-section-title">Expériences Professionnelles</div>

                <div class="exp-item">
                    <table class="exp-header-table">
                        <tr>
                            <td class="exp-role">Employé Logistique &bull; Approvisionnement Soir / Nuit</td>
                            <td class="exp-date">Mai 2025 - Oct. 2025</td>
                        </tr>
                    </table>
                    <div class="exp-place">Grande Surface de Bricolage &amp; Aménagement (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Dépotage rapide des palettes de livraison en créneau nocturne (20h - 23h30).</li>
                        <li>Mise en rayon soignée des références volumineuses et lourdes (outillage, quincaillerie, matériaux).</li>
                        <li>Respect rigoureux des règles de sécurité, utilisation du transpalette manuel et balisage des allées.</li>
                    </ul>
                </div>

                <div class="exp-item">
                    <table class="exp-header-table">
                        <tr>
                            <td class="exp-role">Agent de Manutention &amp; Réception de Quai</td>
                            <td class="exp-date">Janv. 2025 - Avril 2025</td>
                        </tr>
                    </table>
                    <div class="exp-place">Plateforme Logistique &amp; Entrepôt (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Déchargement des camions, tri par allée et préparation du réassort magasin pour le lendemain matin.</li>
                        <li>Nettoyage et évacuation continue des emballages, cartons et films plastiques (compacteur).</li>
                    </ul>
                </div>

                <div class="exp-item">
                    <table class="exp-header-table">
                        <tr>
                            <td class="exp-role">Agent Logistique &amp; Manutention Polyvalente</td>
                            <td class="exp-date">Oct. 2024 - Déc. 2024</td>
                        </tr>
                    </table>
                    <div class="exp-place">Intercruise — MSC Croisières (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Acheminement de bagages, travail physique cadencé et coordination logistique sur quai.</li>
                    </ul>
                </div>

                <div class="exp-item">
                    <table class="exp-header-table">
                        <tr>
                            <td class="exp-role">Manutentionnaire Polyvalent de Nuit</td>
                            <td class="exp-date">Juil. 2024 - Sept. 2024</td>
                        </tr>
                    </table>
                    <div class="exp-place">Plateforme de Transit &amp; Marchandises (Marseille)</div>
                    <ul class="tasks-list">
                        <li>Port de charges lourdes avec posture de sécurité, ponctualité exemplaire et rapidité d'exécution.</li>
                    </ul>
                </div>

                <div class="exp-item">
                    <table class="exp-header-table">
                        <tr>
                            <td class="exp-role">Aide-Chantier &amp; Manutention Matériaux</td>
                            <td class="exp-date">Mars 2024 - Juin 2024</td>
                        </tr>
                    </table>
                    <div class="exp-place">Chantiers Second Œuvre (Région PACA)</div>
                    <ul class="tasks-list">
                        <li>Approvisionnement des postes de travail, manutention d'outils et nettoyage minutieux de fin de poste.</li>
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
        file_put_contents('CV_Djibril_Leroy_Merlin_Nuit.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Djibril_Leroy_Merlin_Nuit.pdf\n";
    } else {
        $dompdf->stream("CV_Djibril_Leroy_Merlin_Nuit.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Djibril Maillet - Leroy Merlin Nuit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card { max-width: 600px; margin: 80px auto; text-align: center; padding: 40px; border-top: 5px solid #1c354d; border-radius: 8px; }
        .btn-custom { background-color: #1c354d; border: 2px solid #00bfa5; color: #00bfa5; padding: 14px 28px; font-size: 1.1rem; font-weight: bold; }
        .btn-custom:hover { background-color: #00bfa5; color: #ffffff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV de <span style="color:#1c354d">Djibril MAILLET</span></h1>
            <p class="text-muted mb-4">Leroy Merlin — Mise en rayon de nuit 20h-23h30 &bull; CDI 17h50</p>
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
