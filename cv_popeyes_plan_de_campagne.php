<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['generate']) || (php_sapi_name() === 'cli' && isset($argv[1]) && $argv[1] === 'generate')) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');
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
        
        /* HEADER CENTERED DESIGN */
        .header-box {
            background-color: #0f172a;
            color: #ffffff;
            padding: 10px 14px;
            border-radius: 5px;
            margin-bottom: 8px;
            border-bottom: 3.5px solid #d97706;
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
            color: #f59e0b;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #d97706;
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
            border: 2px solid #f59e0b;
            border-radius: 4px;
        }
        .contact-item {
            margin-bottom: 2px;
        }

        /* CENTERED SECTION TITLES */
        h2 {
            font-size: 9.5pt;
            text-transform: uppercase;
            color: #0f172a;
            font-weight: bold;
            background-color: #f8fafc;
            border-bottom: 1.5px solid #d97706;
            border-top: 1px solid #e2e8f0;
            padding: 3px 0;
            margin-top: 7px;
            margin-bottom: 5px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        /* 1. COMPÉTENCES CLÉS */
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
            color: #d97706;
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

        /* EXPÉRIENCES BOXES */
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
            color: #d97706;
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

        /* PROFIL BLOCK */
        .profil-block {
            font-size: 8.5pt;
            padding: 6px 10px;
            background-color: #fffbebfb;
            border: 1px solid #fde68a;
            border-left: 4px solid #d97706;
            margin: 5px auto 6px auto;
            width: 94%;
            line-height: 1.35;
            color: #1e293b;
            border-radius: 4px;
            text-align: center;
        }

        /* HOBBIES / CENTRES D'INTÉRÊT */
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

    <!-- HEADER BLOCK DESIGN -->
    <div class="header-box">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="contact-item">50 Trav. Moulin de la Villette</div>
                    <div class="contact-item">13003 Marseille</div>
                    <div class="contact-item">Tel : 07 67 63 84 45</div>
                    <div class="contact-item">Email : benbrikyacine60@gmail.com</div>
                    <div class="contact-item" style="color:#f59e0b;"><strong>Permis B + Véhicule Personnel</strong></div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Équipier Polyvalent (Contrat Étudiant)</div>
                        <div class="search-objective">POPEYES — PLAN DE CAMPAGNE</div>
                    </div>
                </td>
                <td class="header-right">
                    $photoHtml
                </td>
            </tr>
        </table>
    </div>

    <!-- 1. COMPÉTENCES CLÉS -->
    <div class="section">
        <h2>Compétences Clés</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Restauration &amp; Service</span>
                        <div class="skill-list">
                            • <strong>Prise de commande :</strong> Caisses &amp; bornes<br>
                            • <strong>Cuisine &amp; Rush :</strong> Assemblage &amp; cuisson<br>
                            • <strong>Hygiène HACCP :</strong> Respect des normes &amp; entretien<br>
                            • <strong>Sens du Client :</strong> Accueil rapide &amp; souriant
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Gestion &amp; Méthode</span>
                        <div class="skill-list">
                            • <strong>Esprit d'équipe :</strong> Entraide &amp; cohésion<br>
                            • <strong>Résistance au stress :</strong> Gestion des rushs<br>
                            • <strong>Rigueur :</strong> Ponctualité &amp; organisation<br>
                            • <strong>Réactivité :</strong> Polyvalence cuisine/salle
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Disponibilité &amp; Atouts</span>
                        <div class="skill-list">
                            • <strong>Contrat Étudiant :</strong> Horaires adaptables<br>
                            • <strong>Soirs &amp; Week-ends :</strong> 100% disponible<br>
                            • <strong>Permis B + Véhicule :</strong> Accès Plan de Campagne<br>
                            • <strong>Condition Physique :</strong> Dynamisme &amp; endurance
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- 2. EXPÉRIENCES -->
    <div class="section">
        <h2>Expériences</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Équipier Polyvalent Restauration &amp; Service (6 mois)</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">ISTANBUL GRILL KEBAB — Vieux-Port Marseille (Renfort Indépendant)</div>
            <ul class="exp-list">
                <li>Accueil client, prise de commande caisse/TPE et gestion des flux lors des grands rushs du Vieux-Port.</li>
                <li>Préparation en cuisine (cuissons grillades, kebabs, accompagnements et friture minute).</li>
                <li>Maintien rigoureux des normes d'hygiène HACCP, nettoyage des plans de travail et fermeture.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Coordination de Projets &amp; Travail d'Équipe</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Web@cadémie by Epitech Marseille</div>
            <ul class="exp-list">
                <li>Organisation du travail en équipe sous contrainte de temps, tenue des objectifs et réactivité.</li>
                <li>Rigueur d'organisation, gestion des priorités et esprit de collaboration au quotidien.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Stage Immersion Technique &amp; Logistique Terrain</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Énergétique Sanitaire &amp; Chantiers (Région Marseillaise)</div>
            <ul class="exp-list">
                <li>Travail physique et logistique sur le terrain, respect strict des consignes de sécurité (EPI).</li>
                <li>Endurance, assistance aux opérations techniques et maintien de la propreté de la zone de travail.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Analyse Chiffrée &amp; Gestion Méthodique</td>
                    <td class="exp-date">2022 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">BTS SIO &amp; Projets Techniques</div>
            <ul class="exp-list">
                <li>Rigueur d'exécution, suivi méthodique des tâches et gestion de données.</li>
            </ul>
        </div>
    </div>

    <!-- 3. PROFIL -->
    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Étudiant en Grande École du BTP (Conducteur de Travaux), je recherche un contrat étudiant chez Popeyes Plan de Campagne.<br>
            Dynamique, rigoureux et réactif, je suis disponible les soirs et week-ends pour renforcer vos équipes lors des rushs.
        </div>
    </div>

    <!-- 4. CENTRES D'INTÉRÊT & LOISIRS -->
    <div class="section">
        <h2>Centres d'Intérêt &amp; LoisIRS</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basketteur Semi-Pro</div>
                        Esprit d'équipe, réactivité sous pression, discipline et leadership.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Pratique Sportive</div>
                        Forme physique, dynamisme, résistance à l'effort et régularité.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Mangas &amp; Animés</div>
                        Esprit d'analyse, concentration, persévérance et culture générale.
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- 5. FORMATION -->
    <div class="section">
        <h2>Formation</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Grande École BTP — Conducteur de Travaux (Alternance)</td>
                    <td class="exp-date">2026 - 2027</td>
                </tr>
            </table>
            <div class="exp-subtitle">La Solive Marseille — Formation Supérieure BTP &amp; Management de Chantier</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Développeur Intégrateur Web (Bac +1)</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Web@cadémie by Epitech Marseille — Organisation, logique &amp; travail d'équipe</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Analyse de données, logique &amp; gestion</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Sciences et Technologies de l'Industrie et du Développement Durable</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Popeyes_Plan_de_Campagne.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Popeyes_Plan_de_Campagne.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Popeyes_Plan_de_Campagne.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Popeyes Plan de Campagne - Contrat Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #d97706;
            border-radius: 8px;
        }
        .btn-warning {
            background-color: #d97706;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-warning:hover {
            background-color: #b45309;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#d97706">Popeyes - Plan de Campagne</span></h1>
            <p class="text-muted mb-4">Équipier Polyvalent — Contrat Étudiant (Restauration Rapide)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-warning btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Spécial Popeyes (PDF)
                </button>
            </form>
            <div>
                <a href="index.php" class="text-decoration-none text-muted small">← Retour au Hub</a>
            </div>
        </div>
    </div>
</body>
</html>
