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
        .header .subtitle { font-size: 12pt; font-weight: bold; color: #475569; margin-top: 3px; text-transform: uppercase; }
        .search-objective { background-color: #475569; color: white; font-size: 8.5pt; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-top: 6px; font-weight: bold; }
        .profile-photo { width: 85px; height: auto; border: 2px solid #475569; border-radius: 4px; }
        .contact-item { margin-bottom: 3px; }
        h2 { font-size: 10pt; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; padding-bottom: 3px; margin-top: 15px; margin-bottom: 10px; font-weight: bold; color: #0f172a; }
        .timeline-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .timeline-date { width: 105px; text-align: right; vertical-align: top; padding-right: 15px; font-weight: bold; font-size: 8.5pt; color: #475569; }
        .timeline-content { vertical-align: top; padding-bottom: 6px; }
        .item-title { font-weight: bold; font-size: 9.5pt; color: #0f172a; margin-bottom: 1px; }
        .item-subtitle { color: #64748b; font-size: 8.5pt; margin-bottom: 3px; font-style: italic; }
        ul { margin: 3px 0 6px 15px; padding: 0; }
        li { margin-bottom: 3px; font-size: 8.5pt; }
        .skills-table { width: 95%; margin-left: 2.5%; border-collapse: collapse; margin-top: 8px; }
        .skills-column { width: 33%; vertical-align: top; padding-right: 15px; text-align: left; }
        .skill-cat { font-weight: bold; font-size: 9pt; text-transform: uppercase; margin-bottom: 6px; color: #475569; border-bottom: 1px solid #475569; display: block; padding-bottom: 2px; }
        .skill-list { font-size: 8.5pt; color: #1e293b; line-height: 1.5; margin-top: 5px; }
        .profil-block { margin-left: 110px; font-size: 9pt; padding: 10px 15px; background-color: #f1f5f9; border-left: 5px solid #475569; margin-bottom: 12px; line-height: 1.4; }
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
                    <div class="subtitle">Employé Polyvalent</div>
                    <div class="search-objective">DISPONIBLE POUR MISSIONS (100%)</div>
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
            Travailler dur ne me fait pas peur. Résidant à Annemasse (Frontalier) et véhiculé, je cherche activement à m'investir, même pour de très courtes missions. Je suis un travailleur manuel, robuste et extrêmement ponctuel. J'ai l'habitude de suivre des cadences strictes, que ce soit pour de la logistique, du nettoyage industriel ou de l'aide diverse. J'apprends les consignes de sécurité très vite et on peut compter sur ma présence à l'heure exacte. Je suis prêt à prendre mon poste immédiatement.
        </div>
    </div>

    <div class="section">
        <h2>Expériences Polyvalentes</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Missions d'Urgence en Industrie & Logistique</div>
                    <div class="item-subtitle">Diverses Agences d'Intérim | Zone Frontalière</div>
                    <ul>
                        <li>Prise de poste immédiate en renfort sur lignes de production, tri et usinage.</li>
                        <li>Intégration instantanée aux équipes formées avec compréhension rapide des règles.</li>
                        <li>Respect inconditionnel des process, des cadences et des horaires d'usine.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2023 - 2024</td>
                <td class="timeline-content">
                    <div class="item-title">Aide-Déménageur & Manutention Événementielle</div>
                    <div class="item-subtitle">Sociétés Locales et Événementiel</div>
                    <ul>
                        <li>Emballage soigneux, montage/démontage de meubles professionnels.</li>
                        <li>Mise en place de salles et de structures modulaires pour des événements locaux.</li>
                        <li>Excellente endurance garantissant un travail constant de la première à la dernière heure.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">Inventaires de Nuit & Travaux Divers</div>
                    <div class="item-subtitle">Grandes Surfaces et Dépôts</div>
                    <ul>
                        <li>Décompte scrupuleux et rigoureux des articles avec lecteurs codes-barres.</li>
                        <li>Travail de nuit exigeant une concentration forte et une ponctualité parfaite.</li>
                        <li>Esprit "couteau suisse" : missions de balayage, de tri et d'étiquetage en fin de poste.</li>
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
                    <span class="skill-cat">Domaines d'action</span>
                    <div class="skill-list">
                        Manutention (Charges)<br>
                        Lignes de production<br>
                        Nettoyage et entretien<br>
                        Vente et caisse
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Profil Généraliste</span>
                    <div class="skill-list">
                        Adaptation tous métiers<br>
                        Compréhension Rapide<br>
                        Permis B + Véhicule<br>
                        Outils logistiques
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Disponibilité</span>
                    <div class="skill-list">
                        Horaires de journée<br>
                        Prise de poste immédiate<br>
                        Week-ends & Fériés<br>
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
                <td class="timeline-date">2023</td>
                <td class="timeline-content">
                    <div class="item-title">Niveau BAC+2 Technique</div>
                    <div class="item-subtitle">Confère d'excellentes aptitudes de logique, d'organisation, et d'outil informatique.</div>
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
    $dompdf->stream("CV_Yacine_Polyvalent.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Polyvalent Intérim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:#f8f9fa;}.landing-card{max-width:600px;margin:100px auto;text-align:center;padding:50px;border-top:5px solid #475569;}</style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">Espace <span style="color:#475569">Intérim & Agences</span></h1>
            <p class="text-muted mb-5">Employé Polyvalent : Prêt pour toutes missions, tout de suite.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn text-white btn-lg shadow" style="background-color:#475569">Télécharger le CV (PDF)</button>
            </form>
            <div class="mt-4"><a href="index.php" class="text-muted small">← Retour Menu</a></div>
        </div>
    </div>
</body>
</html>
