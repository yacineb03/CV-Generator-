<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['generate'])) {
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 0; color: #333; }
        .container { display: table; width: 100%; height: 100%; }
        .sidebar { display: table-cell; width: 32%; background-color: #2c3e50; color: #ecf0f1; padding: 25px 15px; vertical-align: top; }
        .main { display: table-cell; width: 68%; background-color: #ffffff; padding: 30px 25px; vertical-align: top; }
        
        .sidebar h2 { color: #e74c3c; font-size: 13pt; border-bottom: 2px solid #e74c3c; padding-bottom: 3px; margin-bottom: 12px; margin-top: 25px; text-transform: uppercase; letter-spacing: 1px; }
        .sidebar h2:first-child { margin-top: 0; }
        .contact-info, .skills-info, .edu-info { margin-bottom: 10px; font-size: 9.5pt; line-height: 1.4; }
        .contact-item { margin-bottom: 8px; }
        .skill-item { margin-bottom: 5px; }
        
        .edu-date { font-weight: bold; color: #e74c3c; font-size: 9pt; }
        .edu-degree { font-weight: bold; font-size: 9.5pt; margin-top: 2px; }
        .edu-school { font-style: italic; font-size: 8.5pt; margin-bottom: 10px; }

        .header { margin-bottom: 20px; }
        .header h1 { font-size: 26pt; margin: 0; color: #2c3e50; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; }
        .header .job-title { font-size: 13pt; color: #7f8c8d; margin-top: 5px; font-weight: 300; text-transform: uppercase; letter-spacing: 1px; }
        .admin-status { background-color: #e74c3c; color: #fff; padding: 4px 10px; font-size: 9pt; font-weight: bold; display: inline-block; margin-top: 10px; border-radius: 3px; }
        
        .section-title { font-size: 15pt; color: #2c3e50; text-transform: uppercase; border-bottom: 2px solid #ecf0f1; padding-bottom: 6px; margin-bottom: 15px; margin-top: 20px; font-weight: bold; }
        
        .exp-item { margin-bottom: 12px; page-break-inside: avoid; }
        .exp-header { display: table; width: 100%; margin-bottom: 3px; }
        .exp-title-company { display: table-cell; text-align: left; }
        .exp-date { display: table-cell; text-align: right; font-weight: bold; color: #e74c3c; font-size: 9.5pt; white-space: nowrap; }
        
        .exp-title { font-weight: bold; font-size: 11.5pt; color: #34495e; }
        .exp-company { font-style: italic; font-size: 10pt; color: #7f8c8d; }
        
        ul.tasks { margin: 4px 0 0 0; padding-left: 20px; }
        ul.tasks li { font-size: 9.5pt; margin-bottom: 3px; line-height: 1.3; color: #444; }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Contact</h2>
            <div class="contact-info">
                <div class="contact-item"><strong>Tél :</strong><br>+33 6 56 82 85 67</div>
                <div class="contact-item"><strong>Email :</strong><br>jeandjdj13@gmail.com</div>
                <div class="contact-item"><strong>Adresse :</strong><br>134 Chemin de Monod<br>74330 Poisy, France</div>
                <div class="contact-item"><strong>Mobilité :</strong><br>Permis B + Véhicule</div>
                <div class="contact-item"><strong>Date de nais. :</strong><br>09/07/2006</div>
            </div>

            <h2>Compétences</h2>
            <div class="skills-info">
                <div class="skill-item">• Normes d'hygiène (HACCP)</div>
                <div class="skill-item">• Rapidité d'exécution</div>
                <div class="skill-item">• Résistance au stress</div>
                <div class="skill-item">• Sens du service client</div>
            </div>

            <h2>Langues</h2>
            <div class="skills-info">
                <div class="skill-item">• Anglais (Niveau B2)</div>
                <div class="skill-item">• Français (Maternelle)</div>
            </div>

            <h2>Formation</h2>
            <div class="edu-info">
                <div class="edu-date">2024 - 2025</div>
                <div class="edu-degree">Baccalauréat Général</div>
                <div class="edu-school">Lycée Victor Hugo</div>
                
                <div class="edu-date">2021</div>
                <div class="edu-degree">Brevet & Certif. PIX</div>
                <div class="edu-school">Collège Alexandre Dumas</div>
            </div>
        </div>

        <div class="main">
            <div class="header">
                <h1>DJIBRIL MAILLET</h1>
                <div class="job-title">Employé Polyvalent Restauration & Plongeur</div>
                <div class="admin-status">Statut : Éligible au Permis G (Frontalier)</div>
            </div>

            <div class="section-title">Expériences Professionnelles</div>

            <div class="exp-item">
                <div class="exp-header">
                    <div class="exp-title-company">
                        <div class="exp-title">Employé Polyvalent de Restauration Rapide</div>
                        <div class="exp-company">Snack & Restauration (Avignon)</div>
                    </div>
                    <div class="exp-date">Juillet 2022 - Fév. 2023</div>
                </div>
                <ul class="tasks">
                    <li>Accueil client, prise de commande rapide et encaissement en caisse.</li>
                    <li>Nettoyage lourd des plans de travail et de la salle après les services.</li>
                    <li>Application des protocoles stricts d'hygiène (chaîne du froid, HACCP).</li>
                </ul>
            </div>

            <div class="exp-item">
                <div class="exp-header">
                    <div class="exp-title-company">
                        <div class="exp-title">Agent d'Accueil & Service Polyvalent</div>
                        <div class="exp-company">Centre Le Martouret</div>
                    </div>
                    <div class="exp-date">Mai 2025 - Oct. 2025</div>
                </div>
                <ul class="tasks">
                    <li>Service des repas et encadrement de groupes lors des moments de restauration.</li>
                    <li>Mise en place de la salle, débarrassage et nettoyage approfondi (Plonge).</li>
                    <li>Grande résistance physique lors des pics d'affluence.</li>
                </ul>
            </div>
            
            <div class="exp-item">
                <div class="exp-header">
                    <div class="exp-title-company">
                        <div class="exp-title">Hôte d'Accueil Portuaire</div>
                        <div class="exp-company">Intercruise (MSC Croisières)</div>
                    </div>
                    <div class="exp-date">Fév. 2025 - Mai 2025</div>
                </div>
                <ul class="tasks">
                    <li>Accueil d'une clientèle internationale avec le sourire et professionnalisme.</li>
                    <li>Gestion du stress et de l'attente clientèle lors des embarquements massifs.</li>
                </ul>
            </div>

            <div class="exp-item">
                <div class="exp-header">
                    <div class="exp-title-company">
                        <div class="exp-title">Aide-Ouvrier (Résistance Physique)</div>
                        <div class="exp-company">Chantiers divers (Paris)</div>
                    </div>
                    <div class="exp-date">Mars 2024 - Déc. 2024</div>
                </div>
                <ul class="tasks">
                    <li>Habitude de la chaleur et du travail manuel exigeant (idéal pour la Plonge).</li>
                    <li>Nettoyage intégral du chantier avec des produits d'entretien lourds.</li>
                </ul>
            </div>

        </div>
    </div>
</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("CV_Djibril_Restauration.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Djibril Restauration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:#f8f9fa;}.landing-card{max-width:600px;margin:100px auto;text-align:center;padding:50px;border-top:5px solid #e74c3c;}</style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">CV <span style="color:#e74c3c">Restauration</span> (Djibril)</h1>
            <p class="text-muted mb-5">Optimisé pour la restauration rapide, plonge et service.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn text-white btn-lg shadow w-100" style="background-color:#e74c3c">Télécharger CV Restauration</button>
            </form>
            <div class="mt-4"><a href="index.php" class="text-muted small">← Retour Menu</a></div>
        </div>
    </div>
</body>
</html>
