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
        .header .subtitle { font-size: 12pt; font-weight: bold; color: #1e3a8a; margin-top: 3px; text-transform: uppercase; }
        .search-objective { background-color: #1e3a8a; color: white; font-size: 8.5pt; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-top: 6px; font-weight: bold; }
        .profile-photo { width: 85px; height: auto; border: 2px solid #1e3a8a; border-radius: 4px; }
        .contact-item { margin-bottom: 3px; }
        h2 { font-size: 10pt; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; padding-bottom: 3px; margin-top: 15px; margin-bottom: 10px; font-weight: bold; color: #0f172a; }
        .timeline-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .timeline-date { width: 105px; text-align: right; vertical-align: top; padding-right: 15px; font-weight: bold; font-size: 8.5pt; color: #1e3a8a; }
        .timeline-content { vertical-align: top; padding-bottom: 6px; }
        .item-title { font-weight: bold; font-size: 9.5pt; color: #0f172a; margin-bottom: 1px; }
        .item-subtitle { color: #64748b; font-size: 8.5pt; margin-bottom: 3px; font-style: italic; }
        ul { margin: 3px 0 6px 15px; padding: 0; }
        li { margin-bottom: 3px; font-size: 8.5pt; }
        .skills-table { width: 95%; margin-left: 2.5%; border-collapse: collapse; margin-top: 8px; }
        .skills-column { width: 33%; vertical-align: top; padding-right: 15px; text-align: left; }
        .skill-cat { font-weight: bold; font-size: 9pt; text-transform: uppercase; margin-bottom: 6px; color: #1e3a8a; border-bottom: 1px solid #1e3a8a; display: block; padding-bottom: 2px; }
        .skill-list { font-size: 8.5pt; color: #1e293b; line-height: 1.5; margin-top: 5px; }
        .profil-block { margin-left: 110px; font-size: 9pt; padding: 10px 15px; background-color: #f1f5f9; border-left: 5px solid #1e3a8a; margin-bottom: 12px; line-height: 1.4; }
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
                    <div class="subtitle">Employé Polyvalent (Toutes Missions)</div>
                    <div class="search-objective">AGENT DE SÉCURITÉ / LOGISTIQUE / SERVICES</div>
                </div>
            </td>
            <td class="header-right">
                $photoHtml
            </td>
        </tr>
    </table>

    <div class="section">
        <h2>Profil : Emploi Immédiat Toutes Missions</h2>
        <div class="profil-block">
            Jeune, manuel et très motivé, je suis à la recherche de missions en intérim sur le bassin marseillais. Titulaire du Permis B et véhiculé, j'ai l'habitude du travail physique et des environnements exigeants. Qu'il s'agisse de manutention en entrepôt, d'opérateur en usine, d'aide sur un chantier ou de livraison, j'ai avant tout envie de travailler de manière assidue. Je m'intègre facilement dans une nouvelle équipe et je suis disponible dès demain matin pour m'investir sérieusement.
        </div>
    </div>

    <div class="section">
        <h2>Secteurs d'Intervention & Expériences Ciblées</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Logistique, Entrepôt & Industrie (Agro / Usine)</div>
                    <div class="item-subtitle">Secteurs E-commerce et Chaîne de Production</div>
                    <ul>
                        <li><strong>Métiers ciblés :</strong> Préparateur de commandes, Agent de quai, Manutentionnaire.</li>
                        <li><strong>Compétences :</strong> Tri de colis, montage de palettes, port de charges lourdes (chargement camion).</li>
                        <li><strong>Industrie :</strong> Opérateur de production, agent de fabrication, conditionnement et cadence usine.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2023 - 2024</td>
                <td class="timeline-content">
                    <div class="item-title">BTP / Chantiers & Transport / Livraison</div>
                    <div class="item-subtitle">Gros Œuvre, Sous-traitance et Messagerie</div>
                    <ul>
                        <li><strong>Métiers ciblés :</strong> Manœuvre de chantier, Chauffeur Livreur VL, Livreur colis.</li>
                        <li><strong>BTP :</strong> Déblaiement, acheminement de matériaux pour maçons/plombiers, respect strict des EPI.</li>
                        <li><strong>Livraison :</strong> Conduite VL parfaite (Permis B), optimisation des tournées, efficience Amazon/Restauration.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">Commerce, Nettoyage & Sécurité Événementielle</div>
                    <div class="item-subtitle">Secteur Tertiaire, Grandes Surfaces et Prestation de Service</div>
                    <ul>
                        <li><strong>Métiers ciblés :</strong> Employé libre-service, Agent d'entretien, Agent de Sécurité Privée.</li>
                        <li><strong>Distribution / Nettoyage :</strong> Mise en rayon rapide (facing), tenue de caisse, décapage et hygiène locaux.</li>
                        <li><strong>Sécurité :</strong> Agent de prévention filtrage / palpation avec Carte Professionnelle validée en préfecture.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Compétences Transversales & Atouts</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <span class="skill-cat">Métiers Phares</span>
                    <div class="skill-list">
                        Préparateur / Agent de quai<br>
                        Manutentionnaire / Usine<br>
                        Manœuvre (Chantiers BTP)<br>
                        Chauffeur Livreur VL
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Polyvalence Active</span>
                    <div class="skill-list">
                        Mise en rayon / Caisse<br>
                        Nettoyage / Entretien<br>
                        Conditionnement (Agro)<br>
                        Sécurité (Carte PRO)
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Profil Prêt à l'Emploi</span>
                    <div class="skill-list">
                        Disponible maintenant<br>
                        Aucun diplôme requis<br>
                        Permis B + Véhicule<br>
                        Fiabilité & Assiduité
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Formation</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2023</td>
                <td class="timeline-content">
                    <div class="item-title">Habilitation CQP / Carte Pro Sécurité</div>
                    <div class="item-subtitle">Certifie de la capacité juridique et professionnelle d'intervenir en sécurité.</div>
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
    $dompdf->stream("CV_Yacine_France_Interim.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Intérim France</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:#f8f9fa;}.landing-card{max-width:600px;margin:100px auto;text-align:center;padding:50px;border-top:5px solid #1e3a8a;}</style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">CV <span style="color:#1e3a8a">Intérim France Ultime</span></h1>
            <p class="text-muted mb-5">Profil Multi-casquettes (Sécurité, Logistique, Service).</p>
            <form method="post">
                <button type="submit" name="generate" class="btn text-white btn-lg shadow w-100" style="background-color:#1e3a8a">Télécharger le PDF</button>
            </form>
            <div class="mt-4"><a href="index.php" class="text-muted small">← Retour Menu</a></div>
        </div>
    </div>
</body>
</html>
