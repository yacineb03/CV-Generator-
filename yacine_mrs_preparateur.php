<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
if (isset($_POST['generate'])) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $path = 'profil accuel.jpg';
    $photoHtml = '';
    if (file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $photoHtml = '<img src="' . $base64 . '" class="profile-photo" alt="Photo">';
    } else {
        $photoHtml = '<img src="https://www.svgrepo.com/show/447833/user-profile.svg" class="profile-photo" alt="Photo">';
    }

    $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.25; margin: 0; padding: 10px 25px; color: #1e293b; background-color: #fff; }
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; padding-bottom: 12px; }
        .header-left { width: 30%; font-size: 8.5pt; color: #64748b; vertical-align: middle; text-align: left; }
        .header-center { width: 40%; text-align: center; vertical-align: middle; }
        .header-right { width: 30%; text-align: right; vertical-align: middle; }
        .header h1 { font-size: 20pt; margin: 0; text-transform: uppercase; font-weight: bold; color: #0f172a; }
        .header .subtitle { font-size: 12pt; font-weight: bold; color: #8e44ad; margin-top: 3px; text-transform: uppercase; }
        .search-objective { background-color: #8e44ad; color: white; font-size: 8.5pt; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-top: 6px; font-weight: bold; }
        .profile-photo { width: 85px; height: auto; border: 2px solid #8e44ad; border-radius: 4px; }
        .contact-item { margin-bottom: 3px; }
        h2 { font-size: 10pt; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; padding-bottom: 3px; margin-top: 15px; margin-bottom: 10px; font-weight: bold; color: #0f172a; }
        .timeline-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .timeline-date { width: 105px; text-align: right; vertical-align: top; padding-right: 15px; font-weight: bold; font-size: 8.5pt; color: #8e44ad; }
        .timeline-content { vertical-align: top; padding-bottom: 6px; }
        .item-title { font-weight: bold; font-size: 9.5pt; color: #0f172a; margin-bottom: 1px; }
        .item-subtitle { color: #64748b; font-size: 8.5pt; margin-bottom: 3px; font-style: italic; }
        ul { margin: 3px 0 6px 15px; padding: 0; }
        li { margin-bottom: 3px; font-size: 8.5pt; }
        .skills-table { width: 95%; margin-left: 2.5%; border-collapse: collapse; margin-top: 8px; }
        .skills-column { width: 33%; vertical-align: top; padding-right: 15px; text-align: left; }
        .skill-cat { font-weight: bold; font-size: 9pt; text-transform: uppercase; margin-bottom: 6px; color: #8e44ad; border-bottom: 1px solid #8e44ad; display: block; padding-bottom: 2px; }
        .skill-list { font-size: 8.5pt; color: #1e293b; line-height: 1.5; margin-top: 5px; }
        .profil-block { margin-left: 110px; font-size: 9pt; padding: 10px 15px; background-color: #f1f5f9; border-left: 5px solid #8e44ad; margin-bottom: 12px; line-height: 1.4; }
        strong { color: #0f172a; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td class="header-left">
                <div class="contact-item">50 Traverse Moulin de la Villette</div>
                <div class="contact-item">13003 Marseille</div>
                <div class="contact-item">07 67 63 84 45</div>
                <div class="contact-item">benbrikyacine60@gmail.com</div>
                 <div class="contact-item">Permis B + Véhicule</div>
            </td>
            <td class="header-center">
                <div class="header">
                    <h1>Yacine BENBRIK</h1>
                    <div class="subtitle">Préparateur de Commandes / Logistique</div>
                    <div class="search-objective">PRÊT POUR MISSIONS D'INTÉRIM</div>
                </div>
            </td>
            <td class="header-right">
                $photoHtml
            </td>
        </tr>
    </table>

    <div class="section">
        <h2>Profil : Opérationnel & Rigoureux</h2>
        <div class="profil-block">
            Jeune, rigoureux et très motivé, je recherche activement des missions en logistique sur Marseille. Endurant physiquement et habitué aux cadences de travail exigeantes, je maîtrise les bases du conditionnement, de l'étiquetage et de la palettisation. Organisé dans mes tâches, je sais suivre un process avec précision. Je m'intègre rapidement en équipe et je suis disponible immédiatement pour m'investir sérieusement.
        </div>
    </div>

    <div class="section">
        <h2>Expériences Professionnelles (Secteurs Opérationnels)</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Manutention Logistique & Industrie</div>
                    <div class="item-subtitle">Secteurs E-commerce et Conditionnement</div>
                    <ul>
                        <li>Tri et préparation de commandes (utilisation de bordereaux et douchette/scan).</li>
                        <li>Montage de palettes et filmage sécurisé pour expédition.</li>
                        <li>Chargement et déchargement manuel de camions, port de charges lourdes.</li>
                        <li>Nettoyage et entretien continu de la zone de stockage (respect des normes de sécurité).</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2023 - 2024</td>
                <td class="timeline-content">
                    <div class="item-title">Agent d'Opérations & Manœuvre BTP</div>
                    <div class="item-subtitle">Missions d'intérim (Chantiers et Dépôts)</div>
                    <ul>
                        <li>Déblaiement, acheminement de matériaux pour les équipes spécialisées.</li>
                        <li>Grande endurance physique dans des environnements poussiéreux ou difficiles.</li>
                        <li>Travail en équipe et respect strict des règles de sécurité (EPI).</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">Employé Polyvalent de Commerce</div>
                    <div class="item-subtitle">Secteur Tertiaire / Grande Distribution</div>
                    <ul>
                        <li>Mise en rayon rapide (facing) et gestion des stocks en réserve.</li>
                        <li>Contrôle visuel des produits, détection des anomalies et nettoyage des surfaces.</li>
                        <li>Tenue de caisse et relation clientèle fluide.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Compétences Techniques & Logistiques</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <span class="skill-cat">Logistique Entrepôt</span>
                    <div class="skill-list">
                        Préparation de commandes<br>
                        Utilisation de Scan/PDA<br>
                        Palettisation & Filmage<br>
                        Contrôle qualité (bases)
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Manutention</span>
                    <div class="skill-list">
                        Port de charges lourdes<br>
                        Gestes et postures<br>
                        Chargement/Déchargement<br>
                        Nettoyage de zone
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Savoir-Être</span>
                    <div class="skill-list">
                        Excellente ponctualité<br>
                        Respect des cadences<br>
                        Travail en équipe<br>
                        Fiabilité absolue
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Formation</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2022</td>
                <td class="timeline-content">
                    <div class="item-title">Baccalauréat STI2D</div>
                    <div class="item-subtitle">Sciences et Technologies de l'Industrie et du Développement Durable (Méthode, logique, précision).</div>
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
    $dompdf->stream("CV_Yacine_Preparateur_Commande.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Préparateur de Commandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:#f8f9fa;}.landing-card{max-width:600px;margin:100px auto;text-align:center;padding:50px;border-top:5px solid #8e44ad;}</style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">CV <span style="color:#8e44ad">Préparateur Logistique</span></h1>
            <p class="text-muted mb-5">Idéal pour entrepôts et intérim.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn text-white btn-lg shadow w-100" style="background-color:#8e44ad">Télécharger le PDF</button>
            </form>
            <div class="mt-4"><a href="index.php" class="text-muted small">← Retour Menu</a></div>
        </div>
    </div>
</body>
</html>
