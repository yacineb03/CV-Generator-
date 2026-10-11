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
        .header .subtitle { font-size: 12pt; font-weight: bold; color: #16a34a; margin-top: 3px; text-transform: uppercase; }
        .search-objective { background-color: #16a34a; color: white; font-size: 8.5pt; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-top: 6px; font-weight: bold; }
        .profile-photo { width: 85px; height: auto; border: 2px solid #16a34a; border-radius: 4px; }
        .contact-item { margin-bottom: 3px; }
        h2 { font-size: 10pt; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; padding-bottom: 3px; margin-top: 15px; margin-bottom: 10px; font-weight: bold; color: #0f172a; }
        .timeline-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .timeline-date { width: 105px; text-align: right; vertical-align: top; padding-right: 15px; font-weight: bold; font-size: 8.5pt; color: #16a34a; }
        .timeline-content { vertical-align: top; padding-bottom: 6px; }
        .item-title { font-weight: bold; font-size: 9.5pt; color: #0f172a; margin-bottom: 1px; }
        .item-subtitle { color: #64748b; font-size: 8.5pt; margin-bottom: 3px; font-style: italic; }
        ul { margin: 3px 0 6px 15px; padding: 0; }
        li { margin-bottom: 3px; font-size: 8.5pt; }
        .skills-table { width: 95%; margin-left: 2.5%; border-collapse: collapse; margin-top: 8px; }
        .skills-column { width: 33%; vertical-align: top; padding-right: 15px; text-align: left; }
        .skill-cat { font-weight: bold; font-size: 9pt; text-transform: uppercase; margin-bottom: 6px; color: #16a34a; border-bottom: 1px solid #16a34a; display: block; padding-bottom: 2px; }
        .skill-list { font-size: 8.5pt; color: #1e293b; line-height: 1.5; margin-top: 5px; }
        .profil-block { margin-left: 110px; font-size: 9pt; padding: 10px 15px; background-color: #f1f5f9; border-left: 5px solid #16a34a; margin-bottom: 12px; line-height: 1.4; }
        strong { color: #0f172a; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td class="header-left">
                <div class="contact-item">134 Chemin de Monod</div>
                <div class="contact-item">74330 Poisy, France</div>
                <div class="contact-item">+33 7 67 63 84 45</div>
                <div class="contact-item">benbrikyacine60@gmail.com</div>
                <div class="contact-item">Permis B + Véhicule Personnel</div>
            </td>
            <td class="header-center">
                <div class="header">
                    <h1>Yacine BENBRIK</h1>
                    <div class="subtitle">Chauffeur Livreur VL</div>
                    <div class="search-objective">VÉHICULÉ - PRÊT À PRENDRE LA ROUTE</div>
                    <div class="status-admin" style="font-size: 8.5pt; color: #1e293b; background-color: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 8px; display: inline-block; margin-top: 6px; font-weight: bold;">Carte de Résident 10 ans (France) — Éligible au Permis G (Frontalier)</div>
                </div>
            </td>
            <td class="header-right">
                $photoHtml
            </td>
        </tr>
    </table>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Titulaire du Permis B depuis plusieurs années, je suis un conducteur particulièrement prudent et très débrouillard. J'ai un excellent sens de l'orientation en ville et je connais l'importance d'optimiser une tournée de livraison. Que ce soit pour de la messagerie de colis (livraison express) ou de la restauration rapide, je respecte scrupuleusement le véhicule et la marchandise. Je suis poli avec les clients finaux et je suis prêt à prendre la route dès demain matin.
        </div>
    </div>

    <div class="section">
        <h2>Expériences Professionnelles</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Chauffeur Livreur VL (Messagerie & Colis)</div>
                    <div class="item-subtitle">Sous-traitance logistique</div>
                    <ul>
                        <li>Chargement organisé du véhicule utilitaire selon le plan d'itinéraire de la journée.</li>
                        <li>Livraison de 60 à 80 colis/jour aux particuliers et entreprises avec scan des bordereaux.</li>
                        <li>Respect inconditionnel du Code de la Route et entretien de base du véhicule (niveaux).</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2023 - 2024</td>
                <td class="timeline-content">
                    <div class="item-title">Livreur Restauration Rapide</div>
                    <div class="item-subtitle">Plateformes de livraison et Snacks locaux</div>
                    <ul>
                        <li>Livraisons express à domicile, garantie de la chaîne du chaud/froid des produits.</li>
                        <li>Utilisation experte des outils de navigation GPS (Waze, Maps) pour éviter les bouchons.</li>
                        <li>Encaissement direct (espèces/TPE) et gestion irréprochable du fonds de caisse.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">Manutentionnaire & Préparateur de Tournées</div>
                    <div class="item-subtitle">Centres de tri et Dépôts Logistiques</div>
                    <ul>
                        <li>Tri méthodique et très rapide des colis sur tapis, scan et étiquetage.</li>
                        <li>Aide au chargement sécurisé (arrimage, répartition des poids) pour les transporteurs.</li>
                        <li>Port régulier de charges lourdes et manutention de matériel encombrant.</li>
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
                    <span class="skill-cat">Conduite & Route</span>
                    <div class="skill-list">
                        Permis B<br>
                        Conduite souple et sûre<br>
                        Bon sens de l'orientation<br>
                        Entretien basique du VL
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Logistique Opérationnelle</span>
                    <div class="skill-list">
                        Optimisation des tournées<br>
                        Arrimage des charges<br>
                        Utilisation PDA/Scanners<br>
                        Aide à la manutention
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Contact Client</span>
                    <div class="skill-list">
                        Ponctualité exemplaire<br>
                        Sourire et Politesse<br>
                        Encaissement sans erreurs<br>
                        Sens des responsabilités
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
                    <div class="item-subtitle">Excellente logique technique, résolution de problèmes rapides.</div>
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
    $dompdf->stream("CV_Yacine_Livreur.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Chauffeur Livreur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:#f8f9fa;}.landing-card{max-width:600px;margin:100px auto;text-align:center;padding:50px;border-top:5px solid #16a34a;}</style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">CV <span style="color:#16a34a">Livreur France</span></h1>
            <p class="text-muted mb-5">Chauffeur Livreur VL.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn text-white btn-lg shadow w-100" style="background-color:#16a34a">Télécharger le PDF</button>
            </form>
            <div class="mt-4"><a href="index.php" class="text-muted small">← Retour Menu</a></div>
        </div>
    </div>
</body>
</html>
