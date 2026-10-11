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
            border-bottom: 3.5px solid #dc2626;
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
            color: #f87171;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #dc2626;
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
            border: 2px solid #ef4444;
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
            border-bottom: 1.5px solid #dc2626;
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
            color: #dc2626;
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
            color: #dc2626;
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
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            border-left: 4px solid #dc2626;
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
                    <div class="contact-item" style="color:#f87171;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">Contrat 12h/24h &bull; Disponibilité Immédiate</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Équipier Polyvalent de Restauration Rapide</div>
                        <div class="search-objective">QUICK — CONTRAT 12H / 24H</div>
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
                        <span class="skill-cat">Restauration &amp; Service</span>
                        <div class="skill-list">
                            &bull; <strong>Accueil &amp; Caisses :</strong> Prise de commande TPE/borne<br>
                            &bull; <strong>Cuisine &amp; Grill :</strong> Cuisson burgers, frites, sauces<br>
                            &bull; <strong>Normes HACCP :</strong> Hygiène, chaîne du froid, traçabilité<br>
                            &bull; <strong>Sens du Client :</strong> Service rapide, courtois et souriant
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Organisation &amp; Rush</span>
                        <div class="skill-list">
                            &bull; <strong>Gestion du Stress :</strong> Efficace en plein pic d'affluence<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Entraide, communication active<br>
                            &bull; <strong>Polyvalence Totale :</strong> Rotation salle / comptoir / cuisine<br>
                            &bull; <strong>Rapidité d'Exécution :</strong> Respect des temps de service
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Disponibilité &amp; Atouts</span>
                        <div class="skill-list">
                            &bull; <strong>Contrat 12h/24h :</strong> Horaires flexibles &amp; adaptés<br>
                            &bull; <strong>Endurance Physique :</strong> Dynamisme debout prolongé<br>
                            &bull; <strong>Véhiculé (Permis B) :</strong> Ponctualité garantie aux ouvertures/fermetures<br>
                            &bull; <strong>Rigueur :</strong> Nettoyage minutieux et postes soignés
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
                    <td class="exp-title">Équipier Polyvalent de Restauration Rapide (Service &amp; Cuisine)</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Restauration Rapide &amp; Grill — Marseille (Service continu &amp; Rushs)</div>
            <ul class="exp-list">
                <li>Accueil de la clientèle au comptoir, encaissement caisse/TPE et gestion dynamique des commandes aux bornes.</li>
                <li>Préparation et assemblage minute des sandwichs, maîtrise des cuissons grill/friteuse selon les standards de qualité.</li>
                <li>Application stricte des règles d'hygiène et de sécurité alimentaire (HACCP), désinfection continue des plans de travail.</li>
                <li>Nettoyage approfondi des équipements, gestion des stocks et fermeture du restaurant dans les délais impartis.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Employé Polyvalent de Commerce &amp; Flux Clients</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Commerce &amp; Distribution — Marseille</div>
            <ul class="exp-list">
                <li>Accueil des clients avec réactivité et orientation en surface de vente lors des fortes affluences.</li>
                <li>Gestion des réassorts, rangement des zones d'encaissement et maintien de la propreté des locaux.</li>
                <li>Travail en équipe solidaire et coordination quotidienne avec les responsables pour fluidifier l'expérience client.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Projets Collectifs &amp; Gestion des Priorités sous Contrainte</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Technique Supérieure — Marseille</div>
            <ul class="exp-list">
                <li>Capacité éprouvée à prioriser les tâches dans l'urgence, sens aigu de l'écoute et discipline de groupe.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Dynamique, souriant et naturellement travailleur, je souhaite rejoindre l'équipe <strong>Quick</strong> pour un <strong>contrat de 12h à 24h</strong>.<br>
            Très motivé par le travail en équipe et l'intensité des rushs, je m'adapte immédiatement aux cadences pour offrir aux clients un service rapide, impeccable et chaleureux.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball en Compétition</div>
                        Esprit d'équipe solidaire, réactivité sous pression, endurance physique et leadership naturel.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Discipline &amp; Sport</div>
                        Excellente condition physique, résistance à l'effort prolongé et ponctualité rigoureuse.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Sens du Service Client</div>
                        Aisance relationnelle, dynamisme communicatif, politesse et respect des consignes.
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
            <div class="exp-subtitle">Développement de l'autonomie, travail en équipe intensive et gestion rigoureuse des délais</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Rigueur logique, méthode d'organisation et suivi des procédures</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D — Spécialité Systèmes et Numérique</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Précision technique, sérieux et respect des normes de sécurité</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Quick.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Quick.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Quick.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Quick - Équipier Polyvalent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #dc2626;
            border-radius: 8px;
        }
        .btn-quick {
            background-color: #dc2626;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-quick:hover {
            background-color: #b91c1c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#dc2626">Quick</span></h1>
            <p class="text-muted mb-4">Équipier Polyvalent de Restauration Rapide (Contrat 12h / 24h)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-quick btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Quick (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
