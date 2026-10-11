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
        .header .subtitle { font-size: 12pt; font-weight: bold; color: #f59e0b; margin-top: 3px; text-transform: uppercase; }
        .search-objective { background-color: #f59e0b; color: #0f172a; font-size: 8.5pt; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-top: 6px; font-weight: bold; }
        .profile-photo { width: 85px; height: auto; border: 2px solid #f59e0b; border-radius: 4px; }
        .contact-item { margin-bottom: 3px; }
        h2 { font-size: 10pt; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; padding-bottom: 3px; margin-top: 15px; margin-bottom: 10px; font-weight: bold; color: #0f172a; }
        .timeline-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .timeline-date { width: 105px; text-align: right; vertical-align: top; padding-right: 15px; font-weight: bold; font-size: 8.5pt; color: #f59e0b; }
        .timeline-content { vertical-align: top; padding-bottom: 6px; }
        .item-title { font-weight: bold; font-size: 9.5pt; color: #0f172a; margin-bottom: 1px; }
        .item-subtitle { color: #64748b; font-size: 8.5pt; margin-bottom: 3px; font-style: italic; }
        ul { margin: 3px 0 6px 15px; padding: 0; }
        li { margin-bottom: 3px; font-size: 8.5pt; }
        .skills-table { width: 95%; margin-left: 2.5%; border-collapse: collapse; margin-top: 8px; }
        .skills-column { width: 33%; vertical-align: top; padding-right: 15px; text-align: left; }
        .skill-cat { font-weight: bold; font-size: 9pt; text-transform: uppercase; margin-bottom: 6px; color: #f59e0b; border-bottom: 1px solid #f59e0b; display: block; padding-bottom: 2px; }
        .skill-list { font-size: 8.5pt; color: #1e293b; line-height: 1.5; margin-top: 5px; }
        .profil-block { margin-left: 110px; font-size: 9pt; padding: 10px 15px; background-color: #f1f5f9; border-left: 5px solid #f59e0b; margin-bottom: 12px; line-height: 1.4; }
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
                <div class="contact-item">Permis B + VÃ©hicule Personnel</div>
            </td>
            <td class="header-center">
                <div class="header">
                    <h1>Yacine BENBRIK</h1>
                    <div class="subtitle">Ã‰quipier Restauration Rapide</div>
                    <div class="search-objective">SNACKS, FAST-FOOD & RESTAURATION</div>
                    <div class="status-admin" style="font-size: 8.5pt; color: #1e293b; background-color: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 8px; display: inline-block; margin-top: 6px; font-weight: bold;">Carte de RÃ©sident 10 ans (France) â€” Ã‰ligible au Permis G (Frontalier)</div>
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
            Rapide, manuel et habituÃ© Ã  travailler en contact avec le public, je recherche un poste d'Ã©quipier polyvalent dans un fast-food, snack ou brasserie. J'aime le travail d'Ã©quipe et le rush de la restauration me motive. Je sais tenir une caisse proprement, respecter les gestes d'hygiÃ¨ne de base en cuisine et rendre la salle propre. Je suis motivÃ© pour travailler sÃ©rieusement et je peux commencer Ã  n'importe quel moment.
        </div>
    </div>

    <div class="section">
        <h2>ExpÃ©riences Professionnelles</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Ã‰quipier Polyvalent (Restauration Rapide)</div>
                    <div class="item-subtitle">Enseigne Fast-Food</div>
                    <ul>
                        <li>Accueil client, prise de commande sur borne et caisse, encaissement certifiÃ©.</li>
                        <li>PrÃ©paration en cuisine (cuisson, assemblage Sandwich/Burgers) lors des forts pics d'affluence.</li>
                        <li>Nettoyage constant du restaurant (salle, sanitaires, bacs) avec respect strict de l'hygiÃ¨ne.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2023 - 2024</td>
                <td class="timeline-content">
                    <div class="item-title">EmployÃ© de Snack / Sandwicherie</div>
                    <div class="item-subtitle">Commerce IndÃ©pendant</div>
                    <ul>
                        <li>Fabrication minute des plats (tacos, paninis, kebabs) et cuisson des frites.</li>
                        <li>Gestion de la caisse, rendu monnaie rapide et remise des commandes aux livreurs/clients.</li>
                        <li>Ouverture et fermeture de la boutique (nettoyage lourd des plans de travail et planchas).</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">Plongeur & Aide-Cuisine</div>
                    <div class="item-subtitle">Restaurant Traditionnel</div>
                    <ul>
                        <li>Lavage industriel intensif de la vaisselle, des ustensiles et des outils de production.</li>
                        <li>Aide Ã  la prÃ©paration de base (Ã©pluchage, dÃ©coupe, approvisionnement des frigos).</li>
                        <li>Grande capacitÃ© d'endurance au travail physique en milieu humide et trÃ¨s chaud.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>CompÃ©tences OpÃ©rationnelles</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <span class="skill-cat">MÃ©thodologie (Rush)</span>
                    <div class="skill-list">
                        PrÃ©paration rapide<br>
                        Assemblage par Ã©tape<br>
                        RÃ©sistance au stress<br>
                        RÃ©flexes de sÃ©curitÃ©
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Vente & Client</span>
                    <div class="skill-list">
                        Encaissement (Caisse/TPE)<br>
                        Prise de commandes<br>
                        Sourire commercial<br>
                        Up-selling (menus)
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">HygiÃ¨ne & PropretÃ©</span>
                    <div class="skill-list">
                        Normes HACCP gÃ©nÃ©rales<br>
                        DÃ©capage planchas<br>
                        Nettoyage de salle<br>
                        Tri des dÃ©chets
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
                    <div class="item-title">BaccalaurÃ©at STI2D</div>
                    <div class="item-subtitle">Acquisition de la mÃ©thode, de la logique et de l'esprit d'Ã©quipe.</div>
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
    $dompdf->stream("CV_Yacine_Snack_Macdo.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Snack & Fast-Food</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:#f8f9fa;}.landing-card{max-width:600px;margin:100px auto;text-align:center;padding:50px;border-top:5px solid #f59e0b;}</style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">CV <span style="color:#f59e0b">Restauration France</span></h1>
            <p class="text-muted mb-5">Ã‰quipier Polyvalent de Restauration Rapide & Snack.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn text-white btn-lg shadow w-100" style="background-color:#f59e0b">TÃ©lÃ©charger le PDF</button>
            </form>
            <div class="mt-4"><a href="index.php" class="text-muted small">â† Retour Menu</a></div>
        </div>
    </div>
</body>
</html>

