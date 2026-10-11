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
        .header .subtitle { font-size: 12pt; font-weight: bold; color: #0ea5e9; margin-top: 3px; text-transform: uppercase; }
        .search-objective { background-color: #0ea5e9; color: white; font-size: 8.5pt; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-top: 6px; font-weight: bold; }
        .profile-photo { width: 85px; height: auto; border: 2px solid #0ea5e9; border-radius: 4px; }
        .contact-item { margin-bottom: 3px; }
        h2 { font-size: 10pt; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; padding-bottom: 3px; margin-top: 15px; margin-bottom: 10px; font-weight: bold; color: #0f172a; }
        .timeline-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .timeline-date { width: 105px; text-align: right; vertical-align: top; padding-right: 15px; font-weight: bold; font-size: 8.5pt; color: #0ea5e9; }
        .timeline-content { vertical-align: top; padding-bottom: 6px; }
        .item-title { font-weight: bold; font-size: 9.5pt; color: #0f172a; margin-bottom: 1px; }
        .item-subtitle { color: #64748b; font-size: 8.5pt; margin-bottom: 3px; font-style: italic; }
        ul { margin: 3px 0 6px 15px; padding: 0; }
        li { margin-bottom: 3px; font-size: 8.5pt; }
        .skills-table { width: 95%; margin-left: 2.5%; border-collapse: collapse; margin-top: 8px; }
        .skills-column { width: 33%; vertical-align: top; padding-right: 15px; text-align: left; }
        .skill-cat { font-weight: bold; font-size: 9pt; text-transform: uppercase; margin-bottom: 6px; color: #0ea5e9; border-bottom: 1px solid #0ea5e9; display: block; padding-bottom: 2px; }
        .skill-list { font-size: 8.5pt; color: #1e293b; line-height: 1.5; margin-top: 5px; }
        .profil-block { margin-left: 110px; font-size: 9pt; padding: 10px 15px; background-color: #f1f5f9; border-left: 5px solid #0ea5e9; margin-bottom: 12px; line-height: 1.4; }
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
                    <div class="subtitle">Agent de Nettoyage</div>
                    <div class="search-objective">DISPONIBLE IMMÉDIATEMENT</div>
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
            Je suis à la recherche d'un poste dans le domaine du nettoyage (locaux, bureaux ou fins de chantiers). Je suis quelqu'un de méticuleux, très discret et je n'ai pas peur du travail physique. Je connais l'importance de respecter les protocoles de nettoyage industriels ou hôteliers et de laisser derrière moi des espaces impeccables. Conscient de l'exigence des entreprises en matière de propreté et de ponctualité, je suis prêt à m'investir sérieusement dès aujourd'hui.
        </div>
    </div>

    <div class="section">
        <h2>Expériences Professionnelles</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Agent d'Entretien des Locaux (Bureaux & Résidences)</div>
                    <div class="item-subtitle">Missions régulières | Multi-sites</div>
                    <ul>
                        <li>Entretien quotidien des surfaces, aspiration, lavage des sols et vitrerie intérieure.</li>
                        <li>Nettoyage minutieux et désinfection sanitaire approfondie des espaces communs.</li>
                        <li>Gestion autonome des stocks de produits d'entretien et vidage des corbeilles.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2023 - 2024</td>
                <td class="timeline-content">
                    <div class="item-title">Nettoyage de Fin de Chantier & Industriel</div>
                    <div class="item-subtitle">Secteur BTP et Rénovation</div>
                    <ul>
                        <li>Évacuation de gravats et déblaiement très physique de zones de travaux.</li>
                        <li>Aspiration industrielle, dépoussiérage et décapage minutieux avant livraison.</li>
                        <li>Respect rigoureux des réglementations et du port des EPI.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">Employé de Nettoyage Hôtelier</div>
                    <div class="item-subtitle">Remplacements saisonniers</div>
                    <ul>
                        <li>Nettoyage intégral des chambres, réfection parfaite des lits et des salles d'eau.</li>
                        <li>Tenue stricte des cadences tout en maintenant un très haut niveau d'exigence.</li>
                        <li>Discrétion absolue et présentation parfaite au contact de la clientèle.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Atouts & Compétences</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <span class="skill-cat">Qualités Personnelles</span>
                    <div class="skill-list">
                        Grande discrétion<br>
                        Ponctualité exemplaire<br>
                        Confiance & Honnêteté<br>
                        Soin et Minutie
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Expertise Métier</span>
                    <div class="skill-list">
                        Rapidité et Efficacité<br>
                        Sens de l'hygiène<br>
                        Bonne santé physique<br>
                        Dosage des produits
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Technique</span>
                    <div class="skill-list">
                        Protocoles de désinfection<br>
                        Utilisation monobrosse<br>
                        Lavage vitrerie<br>
                        Tri des déchets
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
                    <div class="item-subtitle">Sciences et Technologies de l'Industrie - Développement des compétences pratiques.</div>
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
    $dompdf->stream("CV_Yacine_Nettoyage.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Nettoyage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:#f8f9fa;}.landing-card{max-width:600px;margin:100px auto;text-align:center;padding:50px;border-top:5px solid #0ea5e9;}</style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">Espace <span style="color:#0ea5e9">Entretien</span></h1>
            <p class="text-muted mb-5">Agent de Nettoyage : Opérationnel et discret.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn text-white btn-lg shadow" style="background-color:#0ea5e9">Télécharger le CV (PDF)</button>
            </form>
            <div class="mt-4"><a href="index.php" class="text-muted small">← Retour Menu</a></div>
        </div>
    </div>
</body>
</html>
