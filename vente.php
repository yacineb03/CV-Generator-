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
        .header .subtitle { font-size: 12pt; font-weight: bold; color: #8b5cf6; margin-top: 3px; text-transform: uppercase; }
        .search-objective { background-color: #8b5cf6; color: white; font-size: 8.5pt; padding: 4px 10px; border-radius: 4px; display: inline-block; margin-top: 6px; font-weight: bold; }
        .profile-photo { width: 85px; height: auto; border: 2px solid #8b5cf6; border-radius: 4px; }
        .contact-item { margin-bottom: 3px; }
        h2 { font-size: 10pt; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; padding-bottom: 3px; margin-top: 15px; margin-bottom: 10px; font-weight: bold; color: #0f172a; }
        .timeline-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .timeline-date { width: 105px; text-align: right; vertical-align: top; padding-right: 15px; font-weight: bold; font-size: 8.5pt; color: #8b5cf6; }
        .timeline-content { vertical-align: top; padding-bottom: 6px; }
        .item-title { font-weight: bold; font-size: 9.5pt; color: #0f172a; margin-bottom: 1px; }
        .item-subtitle { color: #64748b; font-size: 8.5pt; margin-bottom: 3px; font-style: italic; }
        ul { margin: 3px 0 6px 15px; padding: 0; }
        li { margin-bottom: 3px; font-size: 8.5pt; }
        .skills-table { width: 95%; margin-left: 2.5%; border-collapse: collapse; margin-top: 8px; }
        .skills-column { width: 33%; vertical-align: top; padding-right: 15px; text-align: left; }
        .skill-cat { font-weight: bold; font-size: 9pt; text-transform: uppercase; margin-bottom: 6px; color: #8b5cf6; border-bottom: 1px solid #8b5cf6; display: block; padding-bottom: 2px; }
        .skill-list { font-size: 8.5pt; color: #1e293b; line-height: 1.5; margin-top: 5px; }
        .profil-block { margin-left: 110px; font-size: 9pt; padding: 10px 15px; background-color: #f1f5f9; border-left: 5px solid #8b5cf6; margin-bottom: 12px; line-height: 1.4; }
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
                    <div class="subtitle">Vendeur Conseil</div>
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
            D'un naturel souriant et avec une très bonne présentation, je cherche un emploi d'employé polyvalent en magasin ou dans la vente directe. J'ai le sens du contact client et j'aime conseiller. Mettre en rayon, faire du facing pour que le magasin soit propre ou tenir une caisse pendant les pics d'affluence sont des tâches que j'accomplis avec rigueur. Je suis dynamique, ponctuel et disponible toute la semaine ainsi que le week-end.
        </div>
    </div>

    <div class="section">
        <h2>Expériences Professionnelles</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2024 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Vendeur Conseil (Prêt-à-porter)</div>
                    <div class="item-subtitle">Boutique en Centre Commercial</div>
                    <ul>
                        <li>Accueil chaleureux, conseil personnalisé et fidélisation de la clientèle.</li>
                        <li>Tenue de caisse, encaissements multiples et gestion des retours clients.</li>
                        <li>Participation active au "Visual Merchandising" et vitrines.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2023 - 2024</td>
                <td class="timeline-content">
                    <div class="item-title">Employé Commercial & Mise en Rayon</div>
                    <div class="item-subtitle">Grande Distribution Spécialisée</div>
                    <ul>
                        <li>Gestion autonome du réassort, du facing et du balisage des prix.</li>
                        <li>Inventaires tournants et gestion informatisée des stocks en réserve.</li>
                        <li>Renseignement direct aux clients en surface de vente avec le sourire.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">Hôte de Caisses / Polyvalent</div>
                    <div class="item-subtitle">Commerce de Proximité</div>
                    <ul>
                        <li>Accueil et encaissement avec rapidité lors des pics d'affluence.</li>
                        <li>Ouverture / fermeture des terminaux de paiement et vérification des fonds.</li>
                        <li>Entretien quotidien et propreté constante de l'espace de vente.</li>
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
                    <span class="skill-cat">Relationnel</span>
                    <div class="skill-list">
                        Excellent contact client<br>
                        Sourire & Accueil<br>
                        Écoute active<br>
                        Bonne présentation
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Commerce</span>
                    <div class="skill-list">
                        Conseil / Vente<br>
                        Mise en rayon (facing)<br>
                        Gérer les réclamations<br>
                        Fidélisation
                    </div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Opérationnel</span>
                    <div class="skill-list">
                        Tenue de Caisse<br>
                        Inventaires continus<br>
                        Travail en équipe<br>
                        Adaptabilité
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
                    <div class="item-title">Études de niveau BAC+2</div>
                    <div class="item-subtitle">Développement du sens du détail et de la rigueur logistique.</div>
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
    $dompdf->stream("CV_Yacine_Commerce.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Vente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:#f8f9fa;}.landing-card{max-width:600px;margin:100px auto;text-align:center;padding:50px;border-top:5px solid #8b5cf6;}</style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">Espace <span style="color:#8b5cf6">Vente</span></h1>
            <p class="text-muted mb-5">Vendeur & Conseil Client : Souriant et Motivé.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn text-white btn-lg shadow" style="background-color:#8b5cf6">Télécharger le CV (PDF)</button>
            </form>
            <div class="mt-4"><a href="index.php" class="text-muted small">← Retour Menu</a></div>
        </div>
    </div>
</body>
</html>
