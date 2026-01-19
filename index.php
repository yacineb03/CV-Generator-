<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['generate'])) {
    $dompdf = new Dompdf();
    $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            color: #1e293b;
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #28a745;
        }
        .header h1 { 
            font-size: 26pt; 
            margin: 0; 
            text-transform: uppercase; 
            font-weight: bold;
            color: #0f172a;
        }
        .header .subtitle { 
            font-size: 14pt; 
            font-weight: bold; 
            color: #28a745;
            margin-top: 5px;
            text-transform: uppercase;
        }
        .contact-info { 
            margin-top: 15px;
            font-size: 10pt; 
            color: #64748b;
        }
        h2 {
            font-size: 11pt;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
            margin-top: 30px;
            margin-bottom: 18px;
            font-weight: bold;
            color: #0f172a;
        }
        .timeline-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .timeline-date {
            width: 120px;
            text-align: right;
            vertical-align: top;
            padding-right: 25px;
            font-weight: bold;
            font-size: 10pt;
            color: #28a745;
        }
        .timeline-content {
            vertical-align: top;
            padding-bottom: 10px;
        }
        .item-title { 
            font-weight: bold; 
            font-size: 11pt; 
            color: #0f172a;
            margin-bottom: 4px;
        }
        .item-subtitle { 
            color: #64748b; 
            font-size: 9pt; 
            margin-bottom: 8px; 
            font-style: italic;
        }
        ul { 
            margin: 8px 0 10px 15px; 
            padding: 0;
        }
        li { 
            margin-bottom: 5px; 
            font-size: 10pt; 
        }
        .skills-table {
            width: 78%;
            margin-left: 145px;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .skills-column {
            width: 33%;
            vertical-align: top;
            padding-right: 20px;
            text-align: left;
        }
        .skill-cat { 
            font-weight: bold; 
            font-size: 9pt; 
            text-transform: uppercase; 
            margin-bottom: 12px; 
            color: #28a745;
            border-bottom: 1px solid #28a745;
            display: block;
            padding-bottom: 4px;
        }
        .skill-list {
            font-size: 9pt;
            color: #1e293b;
            line-height: 1.6;
            margin-top: 10px;
        }
        .profil-block {
            margin-left: 145px;
            font-size: 10pt;
            padding: 15px;
            background-color: #f1f5f9;
            border-left: 5px solid #28a745;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        strong { color: #0f172a; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Yacine BENBRIK</h1>
        <div class="subtitle">Développeur Full-Stack Junior</div>
        <div class="contact-info">
            Marseille, France | 07 67 63 84 45 | benbrikyacine60@gmail.com<br>
            github.com/yacineb03 | linkedin.com/in/yacine-benbrik
        </div>
    </div>

    <div class="section">
        <h2>Profil Professionnel</h2>
        <div class="profil-block">
            Étudiant à la <strong>Web@cadémie by Epitech</strong>, je me spécialise dans le développement Full-Stack. Ma méthodologie repose sur l'exploitation des outils de <strong>Productivité Augmentée (IA)</strong>, me permettant d'accélérer le cycle de développement, de sécuriser l'architecture logicielle et de résoudre des problématiques techniques complexes.
        </div>
    </div>

    <div class="section">
        <h2>Expérience & Freelance</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2023 - 2025</td>
                <td class="timeline-content">
                    <div class="item-title">Développeur Web Indépendant (Freelance)</div>
                    <div class="item-subtitle">Conception & Solutions Digitales</div>
                    <ul>
                        <li>Développement d'interfaces responsives (HTML5, CSS3, JS ES6).</li>
                        <li>Gestion de la relation client : analyse des besoins et suivi de projet.</li>
                        <li>Optimisation SEO technique et amélioration de l'UX.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Réalisations Full-Stack</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">Architecture SaaS</td>
                <td class="timeline-content">
                    <div class="item-title">Plateforme de Gestion Métier (Auto-École)</div>
                    <div class="item-subtitle">Full-Stack Development & Workflow IA</div>
                    <ul>
                        <li>Système complet de planning, gestion d'élèves et suivi pédagogique.</li>
                        <li>Utilisation de l'IA pour l'optimisation des algorithmes.</li>
                        <li>Intégration de <strong>Firebase (Auth & Realtime Database)</strong>.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">Web Application</td>
                <td class="timeline-content">
                    <div class="item-title">Prototype de Réservation (Type Airbnb)</div>
                    <div class="item-subtitle">Architecture MVC & Logique métier</div>
                    <ul>
                        <li>Mise en place d'un moteur de recherche dynamique avec filtrage.</li>
                        <li>Focus sur la robustesse du code et la rapidité d'exécution.</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Formation</h2>
        <table class="timeline-table">
            <tr>
                <td class="timeline-date">2024 - 2026</td>
                <td class="timeline-content">
                    <div class="item-title">Web@cadémie by Epitech Marseille</div>
                    <div class="item-subtitle">Développeur Intégrateur Web (Niveau 5)</div>
                    <ul>
                        <li>Pédagogie par projets : PHP, SQL, JS ES6, React/Next.js.</li>
                        <li>Évaluations par <strong>soutenances orales</strong> et présentations techniques.</li>
                        <li>Apprentissage du <strong>travail en équipe</strong> et de la planification de projet.</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2022 - 2023</td>
                <td class="timeline-content">
                    <div class="item-title">BTS SIO (Option SLAM)</div>
                    <div class="item-subtitle">Services Informatiques aux Organisations</div>
                </td>
            </tr>
            <tr>
                <td class="timeline-date">2021 - 2022</td>
                <td class="timeline-content">
                    <div class="item-title">Baccalauréat STI2D</div>
                    <div class="item-subtitle">Sciences et Technologies de l'Industrie et du Développement Durable</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Expertises Techniques</h2>
        <table class="skills-table">
            <tr>
                <td class="skills-column">
                    <span class="skill-cat">Back-end & Data</span>
                    <div class="skill-list">PHP, SQL (MySQL),<br>Firebase, <strong>Node.js</strong>.</div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Front-end</span>
                    <div class="skill-list">HTML5, CSS3, <strong>Tailwind CSS</strong>,<br>JavaScript ES6+, <strong>Next.js</strong>.</div>
                </td>
                <td class="skills-column">
                    <span class="skill-cat">Méthodologie & Soft Skills</span>
                    <div class="skill-list"><strong>Aisance orale</strong>, Travail en équipe,<br>Gestion de projet, Workflow IA,<br>Git / GitHub.</div>
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
    $dompdf->stream("CV_Yacine_Benbrik.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Télécharger mon CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .landing-card {
            max-width: 600px;
            margin: 100px auto;
            text-align: center;
            padding: 50px;
            border-top: 5px solid #28a745;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">Bonjour, je suis <span class="text-success">Yacine</span></h1>
            <p class="text-muted mb-5">Développeur Full-Stack passionné par les nouvelles technologies.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-success btn-lg shadow">
                    Télécharger mon CV (PDF)
                </button>
            </form>
            <div class="mt-4">
                <a href="CV_Generator/index.php" class="text-decoration-none text-muted small">Accéder au générateur →</a>
            </div>
        </div>
    </div>
</body>

</html>