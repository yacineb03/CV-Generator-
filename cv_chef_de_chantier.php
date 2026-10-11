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
            margin: 10px 18px;
        }
        body {
            font-family: Helvetica, Arial, sans-serif;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            color: #1e293b;
            background-color: #fff;
        }
        
        /* HEADER CENTERED DESIGN */
        .header-box {
            background-color: #0f172a;
            color: #ffffff;
            padding: 8px 12px;
            border-radius: 5px;
            margin-bottom: 6px;
            border-bottom: 3px solid #d97706;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-left {
            width: 35%;
            font-size: 8pt;
            color: #cbd5e1;
            vertical-align: middle;
            text-align: left;
            line-height: 1.3;
        }
        .header-center {
            width: 48%;
            text-align: center;
            vertical-align: middle;
        }
        .header-right {
            width: 17%;
            text-align: right;
            vertical-align: middle;
        }
        .header h1 { 
            font-size: 16pt; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.5px;
        }
        .header .subtitle { 
            font-size: 10.5pt; 
            font-weight: bold; 
            color: #f59e0b;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #d97706;
            color: #ffffff;
            font-size: 7.5pt;
            padding: 2px 7px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 4px;
            font-weight: bold;
        }
        .profile-photo {
            width: 62px;
            height: auto;
            border: 2px solid #f59e0b;
            border-radius: 4px;
        }
        .contact-item {
            margin-bottom: 1.5px;
        }

        /* CENTERED SECTION TITLES WITH SPACING */
        h2 {
            font-size: 9pt;
            text-transform: uppercase;
            color: #0f172a;
            font-weight: bold;
            background-color: #f8fafc;
            border-bottom: 1.5px solid #d97706;
            border-top: 1px solid #e2e8f0;
            padding: 2px 0;
            margin-top: 5px;
            margin-bottom: 3px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        /* 1. COMPÉTENCES CLÉS */
        .skills-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
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
            padding: 5px 7px;
            text-align: center;
        }
        .skill-cat { 
            font-weight: bold; 
            font-size: 8pt; 
            text-transform: uppercase; 
            color: #d97706;
            margin-bottom: 3px; 
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 2px;
            display: block;
        }
        .skill-list {
            font-size: 7.5pt;
            color: #334155;
            line-height: 1.3;
            text-align: left;
        }

        /* CENTERED TIMELINE & EXPÉRIENCES */
        .exp-box {
            width: 98%;
            margin: 0 auto 3px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 4px 7px;
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
            margin: 1px 0 1px 12px;
            padding: 0;
            text-align: left;
        }
        ul.exp-list li {
            font-size: 7.5pt;
            color: #334155;
            margin-bottom: 1px;
            line-height: 1.25;
        }

        /* PROFIL EN RECONVERSION */
        .profil-block {
            font-size: 8pt;
            padding: 5px 10px;
            background-color: #fffbebfb;
            border: 1px solid #fde68a;
            border-left: 3px solid #d97706;
            margin: 4px auto 4px auto;
            width: 96%;
            line-height: 1.3;
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
            padding: 4px 6px;
            text-align: center;
        }
        .hobby-item {
            width: 33%;
            vertical-align: top;
            padding: 0 4px;
            font-size: 7.5pt;
            line-height: 1.25;
            color: #334155;
        }
        .hobby-title {
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 2px;
            font-size: 8pt;
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
                        <div class="subtitle">Chef de Chantier (Alternance)</div>
                        <div class="search-objective">ORGANISATION TERRAIN &amp; EXÉCUTION</div>
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
                        <span class="skill-cat">Organisation Terrain</span>
                        <div class="skill-list">
                            • <strong>Management :</strong> Animation &amp; soutien des équipes<br>
                            • <strong>Suivi Chantier :</strong> Contrôle d'avancement &amp; qualité<br>
                            • <strong>Logistique :</strong> Matériel, approvisionnement &amp; stocks<br>
                            • <strong>Présence :</strong> Coordination quotidienne sur site
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Outils Digitaux &amp; Méthode</span>
                        <div class="skill-list">
                            • <strong>Reporting :</strong> Tableaux de bord &amp; suivis Excel<br>
                            • <strong>Collaboratif :</strong> Suite M365, Notion, Trello<br>
                            • <strong>Culture Digital :</strong> Suivi informatique &amp; applis<br>
                            • <strong>Rigueur :</strong> Comptes-rendus &amp; gestion d'incidents
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Sécurité &amp; Bases BTP</span>
                        <div class="skill-list">
                            • <strong>Bac STI2D :</strong> Structures, matériaux &amp; plans<br>
                            • <strong>Sécurité :</strong> Application stricte des EPI / QSE<br>
                            • <strong>Réactivité :</strong> Gestion des aléas de chantier<br>
                            • <strong>Mobilité :</strong> Permis B + Véhicule
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
                    <td class="exp-title">Organisation &amp; Coordination d'Équipes (Projets Digitaux)</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Web@cadémie by Epitech Marseille</div>
            <ul class="exp-list">
                <li>Répartition des tâches, animation d'équipe et suivi des plannings quotidiens.</li>
                <li>Résolution de problèmes en direct, gestion du stress et reporting d'avancement.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Stage d'Immersion Technique BTP / Sanitaire (1 semaine)</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Énergétique Sanitaire (Région Marseillaise)</div>
            <ul class="exp-list">
                <li>Suivi des équipes sur le terrain, observation des travaux thermiques et sanitaires.</li>
                <li>Contrôle du port des EPI, application des consignes et sécurité des accès.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Accompagnement &amp; Logistique de Chantier</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Chantiers de Rénovation (Aide ponctuelle auprès de professionnels/proches)</div>
            <ul class="exp-list">
                <li>Organisation de l'espace de travail, stockage des matériaux et nettoyage du chantier.</li>
                <li>Assistance technique terrain et vérification de la conformité des préparations.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Analyse de Données &amp; Structuration</td>
                    <td class="exp-date">2022 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">BTS SIO &amp; Projets Techniques</div>
            <ul class="exp-list">
                <li>Conception de tableurs de suivi de stock/matériel et méthode d'organisation.</li>
            </ul>
        </div>
    </div>

    <!-- 3. PROFIL EN RECONVERSION -->
    <div class="section">
        <h2>Profil en Reconversion</h2>
        <div class="profil-block">
            Titulaire d'un Bac STI2D et fort d'une culture numérique et agile (Epitech), je me réoriente vers le poste de Chef de Chantier en alternance.<br>
            Organisé, communicant et très présent sur le terrain, j'apporte méthode, réactivité et gestion rigoureuse des équipes au quotidien.
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
                        Esprit de compétition, leadership, discipline et gestion du stress.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Pratique Sportive</div>
                        Forme physique, goût du dépassement de soi et régularité.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Mangas &amp; Animés</div>
                        Esprit d'analyse, concentration, culture japonaise et persévérance.
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- 5. FORMATION ET RECONVERSION -->
    <div class="section">
        <h2>Formation et Reconversion</h2>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Chef de Chantier (Formation en Alternance)</td>
                    <td class="exp-date">2026 - 2028</td>
                </tr>
            </table>
            <div class="exp-subtitle">Recherche de contrat en apprentissage</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Développeur Intégrateur Web (Bac +1)</td>
                    <td class="exp-date">2025 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Web@cadémie by Epitech Marseille — Gestion de projet, logique et outils numériques</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Bureautique avancée, analyse de données &amp; gestion</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Sciences et Technologies de l'Industrie et du Développement Durable — Bases BTP &amp; Ingénierie</div>
        </div>
    </div>
</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Chef_de_Chantier.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Chef_de_Chantier.pdf\n";
        exit;
    } else {
        $dompdf->stream("CV_Yacine_Chef_de_Chantier.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Chef de Chantier en Alternance</title>
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
            <h1 class="mb-3">CV <span style="color:#d97706">Chef de Chantier 2.0</span></h1>
            <p class="text-muted mb-4">Alternance — Profil Terrain, Organisation & Digital (STI2D / Epitech)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-warning btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV (PDF)
                </button>
            </form>
            <div>
                <a href="index.php" class="text-decoration-none text-muted small">← Retour au Hub</a>
            </div>
        </div>
    </div>
</body>
</html>
