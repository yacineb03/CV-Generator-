<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['generate']) || (php_sapi_name() === 'cli' && isset($argv[1]) && $argv[1] === 'generate')) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');
    $dompdf = new Dompdf($options);

    $photoHtml = '';
    $photoPaths = ['profil accuel.jpg', 'profil_yacine.jpg'];
    foreach ($photoPaths as $path) {
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $photoHtml = '<img src="' . $base64 . '" class="profile-photo" alt="Photo">';
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
            margin: 14px 20px;
        }
        body {
            font-family: Helvetica, Arial, sans-serif;
            line-height: 1.25;
            margin: 0;
            padding: 0;
            color: #1e293b;
            background-color: #fff;
        }
        
        .header-box {
            background-color: #0f172a;
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 5px;
            margin-bottom: 8px;
            border-bottom: 3.5px solid #e11d48;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-left {
            width: 33%;
            font-size: 8pt;
            color: #cbd5e1;
            vertical-align: middle;
            text-align: left;
            line-height: 1.35;
        }
        .header-center {
            width: 49%;
            text-align: center;
            vertical-align: middle;
        }
        .header-right {
            width: 18%;
            text-align: right;
            vertical-align: middle;
        }
        .header h1 { 
            font-size: 17pt; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: bold; 
            color: #ffffff;
            letter-spacing: 0.5px;
        }
        .header .subtitle { 
            font-size: 10pt; 
            font-weight: bold; 
            color: #fb7185;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #e11d48;
            color: #ffffff;
            font-size: 7.5pt;
            padding: 2.5px 8px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 4px;
            font-weight: bold;
            letter-spacing: 0.3px;
        }
        .profile-photo {
            width: 70px;
            height: auto;
            border: 2px solid #f43f5e;
            border-radius: 4px;
        }
        .contact-item {
            margin-bottom: 2px;
        }

        h2 {
            font-size: 9.2pt;
            text-transform: uppercase;
            color: #0f172a;
            font-weight: bold;
            background-color: #f8fafc;
            border-bottom: 1.5px solid #e11d48;
            border-top: 1px solid #e2e8f0;
            padding: 3px 0;
            margin-top: 7px;
            margin-bottom: 5px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .skills-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }
        .skills-column {
            width: 33%;
            vertical-align: top;
            padding: 0 4px;
        }
        .skill-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 6px 8px;
            text-align: center;
        }
        .skill-cat { 
            font-weight: bold; 
            font-size: 8.5pt; 
            text-transform: uppercase; 
            color: #e11d48;
            margin-bottom: 4px; 
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 2px;
            display: block;
        }
        .skill-list {
            font-size: 8pt;
            color: #334155;
            line-height: 1.35;
            text-align: left;
        }

        .exp-box {
            width: 96%;
            margin: 0 auto 4px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 4px 8px;
        }
        .exp-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1px;
        }
        .exp-title {
            font-weight: bold;
            font-size: 8.5pt;
            color: #0f172a;
            text-align: left;
        }
        .exp-date {
            font-weight: bold;
            font-size: 8pt;
            color: #e11d48;
            text-align: right;
        }
        .exp-subtitle {
            font-size: 7.5pt;
            color: #64748b;
            font-style: italic;
            margin-bottom: 2px;
            text-align: left;
        }
        ul.exp-list {
            margin: 1px 0 2px 14px;
            padding: 0;
            text-align: left;
        }
        ul.exp-list li {
            font-size: 8pt;
            color: #334155;
            margin-bottom: 1px;
            line-height: 1.25;
        }

        .profil-block {
            font-size: 8.5pt;
            padding: 6px 10px;
            background-color: #fff1f2;
            border: 1px solid #fecdd3;
            border-left: 4px solid #e11d48;
            margin: 5px auto 6px auto;
            width: 94%;
            line-height: 1.35;
            color: #1e293b;
            border-radius: 4px;
            text-align: center;
        }

        .hobbies-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        .hobby-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 5px 8px;
            text-align: center;
        }
        .hobby-item {
            width: 33%;
            vertical-align: top;
            padding: 0 4px;
            font-size: 8pt;
            line-height: 1.25;
            color: #334155;
        }
        .hobby-title {
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 2px;
            font-size: 8.5pt;
        }
        strong { color: #0f172a; }
    </style>
</head>
<body>

    <div class="header-box">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="contact-item">Marseille (13) &bull; France</div>
                    <div class="contact-item">Tel : 07 67 63 84 45</div>
                    <div class="contact-item">Email : benbrikyacine60@gmail.com</div>
                    <div class="contact-item" style="color:#fb7185;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">Contrat CDD 15h &bull; Disponibilité Immédiate</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Vendeur Conseil Multimédia &amp; Accessoires</div>
                        <div class="search-objective">LA CASA DE LAS CARCASAS — CDD 15H</div>
                    </div>
                </td>
                <td class="header-right">
                    $photoHtml
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Compétences Clés</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Vente Active &amp; Conseil</span>
                        <div class="skill-list">
                            &bull; <strong>Accueil Dynamique :</strong> Contact spontané et souriant<br>
                            &bull; <strong>Argumentation Produit :</strong> Accessoires téléphonie<br>
                            &bull; <strong>Ventes Multiples :</strong> Coque + verre + cordon<br>
                            &bull; <strong>Objectifs Quotidiens :</strong> Goût du challenge commercial
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Pose Technique &amp; Tenue</span>
                        <div class="skill-list">
                            &bull; <strong>Pose d'Écrans :</strong> Verres trempés &amp; hydrogel 0 bulle<br>
                            &bull; <strong>Précision Manuelle :</strong> Nettoyage minutieux et dextérité<br>
                            &bull; <strong>Facing &amp; Rangement :</strong> Mur de coques coloré et net<br>
                            &bull; <strong>Encaissement TPE :</strong> Caisse rapide et proposition fidélité
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Disponibilité &amp; Profil</span>
                        <div class="skill-list">
                            &bull; <strong>Contrat CDD 15h :</strong> Idéal pics d'affluence et week-end<br>
                            &bull; <strong>Énergie Débordante :</strong> Vif et présent en boutique<br>
                            &bull; <strong>Permis B + Véhicule :</strong> Mobilité garantie sur Marseille<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Entraide et émulation positive
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Expériences Professionnelles</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Vendeur Conseil Téléphonie &amp; Accessoires Mobiles</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Boutique Multimédia &amp; Accessoires Smartphone — Marseille (Flux Continu)</div>
            <ul class="exp-list">
                <li>Accueil chaleureux, prise en charge immédiate des clients et démonstration de produits (coques renforcées, cordons, chargeurs rapides).</li>
                <li>Application experte et sans défaut de films protecteurs en verre trempé et hydrogel sur smartphones toutes marques (Apple, Samsung, Xiaomi).</li>
                <li>Pratique quotidienne de la vente complémentaire et rebond commercial pour augmenter le panier moyen du magasin.</li>
                <li>Tenue et organisation méthodique des rayonnages muraux par modèle et gamme pour une visibilité produit maximale.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Employé Polyvalent de Commerce &amp; Tenue de Stand</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Boutique &amp; Kiosque Électronique — Centre Commercial Marseille</div>
            <ul class="exp-list">
                <li>Gestion de la caisse, encaissements rapides et tenue rigoureuse du fond de caisse.</li>
                <li>Déballage des réceptions, contrôle quantitatif des stocks et réassort des crochets en surface de vente.</li>
                <li>Entretien constant de la propreté du plan de travail et des présentoirs vitrés.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Sens de la Relation Client &amp; Dextérité Technique</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Numérique &amp; Projets — Marseille</div>
            <ul class="exp-list">
                <li>Maîtrise technologique de l'univers mobile, grande aisance relationnelle et rigueur dans le travail manuel précis.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Très dynamique, persuasif et habile manuellement, je souhaite rejoindre <strong>La Casa de las Carcasas</strong> pour un poste de <strong>Vendeur Conseil en CDD 15h</strong>.<br>
            Passionné par l'univers des smartphones et excellent pour aller au contact des clients, j'assure une pose de protections parfaite et des ventes enthousiastes tout au long de la journée.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">High-Tech &amp; Mobiles</div>
                        Connaissance aiguë des modèles de téléphones, tablettes et innovations technologiques.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball Régional</div>
                        Vivacité, esprit combatif positif, endurance physique et dynamisme communicatif.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Aisance Relationnelle</div>
                        Sourire naturel, sens de la négociation bienveillante et goût du contact humain.
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Formation</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Web@cadémie by Epitech Marseille — Bac +1</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Culture numérique avancée, réactivité et communication efficace</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Environnements mobiles, logique commerciale et rigueur méthodologique</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Sciences et Technologies du Numérique (Précision et sens pratique)</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Casa_Carcasas.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Casa_Carcasas.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Casa_Carcasas.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV La Casa de las Carcasas - CDD 15h</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #e11d48;
            border-radius: 8px;
        }
        .btn-casas {
            background-color: #e11d48;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-casas:hover {
            background-color: #be123c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#e11d48">La Casa de las Carcasas</span></h1>
            <p class="text-muted mb-4">Vendeur Conseil Multimédia &amp; Accessoires (CDD 15h)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-casas btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV La Casa de las Carcasas (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
