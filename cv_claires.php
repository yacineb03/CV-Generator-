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
            border-bottom: 3.5px solid #db2777;
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
            color: #f472b6;
            margin-top: 2px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #db2777;
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
            border: 2px solid #ec4899;
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
            border-bottom: 1.5px solid #db2777;
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
            color: #db2777;
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
            color: #db2777;
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
            background-color: #fdf2f8;
            border: 1px solid #fbcfe8;
            border-left: 4px solid #db2777;
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
                    <div class="contact-item" style="color:#f472b6;"><strong>Permis B &bull; Véhicule Personnel</strong></div>
                    <div class="contact-item">Disponibilité Immédiate &bull; Polyvalent Vente</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Conseiller de Vente &bull; Vendeur Magasin</div>
                        <div class="search-objective">CLAIRE'S — VENTE &amp; ACCESSOIRES</div>
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
                        <span class="skill-cat">Vente &amp; Conseil Client</span>
                        <div class="skill-list">
                            &bull; <strong>Accueil Chaleureux :</strong> Sourire et écoute active<br>
                            &bull; <strong>Conseil Personnalisé :</strong> Ventes complémentaires<br>
                            &bull; <strong>Bijoux &amp; Accessoires :</strong> Présentation soignée<br>
                            &bull; <strong>Fidélisation :</strong> Convivialité et relation client
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Tenue de Caisse &amp; Boutique</span>
                        <div class="skill-list">
                            &bull; <strong>Encaissement Fluide :</strong> TPE, caisse tactile, retours<br>
                            &bull; <strong>Merchandising Visuel :</strong> Vitrines et présentoirs nets<br>
                            &bull; <strong>Réassort Minutieux :</strong> Rangement par thème et couleur<br>
                            &bull; <strong>Antivolage &amp; Sécurité :</strong> Vigilance démarque inconnue
                        </div>
                    </div>
                </td>
                <td class="skills-column">
                    <div class="skill-card">
                        <span class="skill-cat">Atouts &amp; Savoir-Être</span>
                        <div class="skill-list">
                            &bull; <strong>Sens de l'Accueil :</strong> Très bonne élocution et politesse<br>
                            &bull; <strong>Énergie Communicative :</strong> Dynamisme et enthousiasme<br>
                            &bull; <strong>Mobilité Facile :</strong> Permis B et véhicule personnel<br>
                            &bull; <strong>Esprit d'Équipe :</strong> Entraide constante avec les collègues
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
                    <td class="exp-title">Vendeur Conseil &bull; Accessoires de Mode &amp; Cadeaux</td>
                    <td class="exp-date">2024 - 2025</td>
                </tr>
            </table>
            <div class="exp-subtitle">Boutique Accessoires &amp; Tendance — Centre Commercial Marseille</div>
            <ul class="exp-list">
                <li>Accueil personnalisé d'une clientèle variée (familles, jeunes), conseil sur les tendances et suggestions d'achats cadeaux.</li>
                <li>Développement systématique des ventes additionnelles (accessoires de coiffure, petite maroquinerie, bijoux fantaisie).</li>
                <li>Gestion de la caisse avec rapidité et exactitude, encaissement multimodale et application des remises promotionnelles.</li>
                <li>Maintien d'un merchandising irréprochable, agencement méthodique des portants et mise en valeur des nouveautés.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Employé Commercial &amp; Réassort de Boutique</td>
                    <td class="exp-date">2023 - 2024</td>
                </tr>
            </table>
            <div class="exp-subtitle">Magasin de Détail &amp; Équipement — Marseille</div>
            <ul class="exp-list">
                <li>Réception des colis de marchandises, étiquetage, pose d'antivols et réassort continu des présentoirs en rayon.</li>
                <li>Maintien de la propreté exemplaire de l'espace de vente et des zones de caisse tout au long de la journée.</li>
                <li>Participation aux inventaires réguliers et contrôle rigoureux des petits conditionnements.</li>
            </ul>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Communication &amp; Relationnel d'Équipe</td>
                    <td class="exp-date">2024 - 2026</td>
                </tr>
            </table>
            <div class="exp-subtitle">Formation Technique &amp; Projets — Marseille</div>
            <ul class="exp-list">
                <li>Excellente aisance à l'oral, présentation impeccable, esprit positif et dynamisme quotidien.</li>
            </ul>
        </div>
    </div>

    <div class="section">
        <h2>Profil</h2>
        <div class="profil-block">
            Souriant, dynamique et passionné par le contact clientèle, je souhaite rejoindre l'équipe <strong>Claire's</strong> en tant que vendeur conseil.<br>
            À l'écoute et enthousiaste, j'aime guider les clients dans leurs choix, valoriser les produits et maintenir une boutique accueillante et parfaitement rangée.
        </div>
    </div>

    <div class="section">
        <h2>Qualités &amp; Centres d'Intérêt</h2>
        <table class="hobbies-table">
            <tr>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Basket-ball en Équipe</div>
                        Sens du collectif, communication positive, convivialité et dynamisme permanent.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Mode &amp; Tendances</div>
                        Sensible au design des accessoires, souci du détail esthétique et présentation soignée.
                    </div>
                </td>
                <td class="hobby-item">
                    <div class="hobby-card">
                        <div class="hobby-title">Relationnel &amp; Politesse</div>
                        Écoute attentive, politesse naturelle, bonne humeur et esprit commercial.
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
            <div class="exp-subtitle">Sens du relationnel, présentations orales et travail de groupe soutenu</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">BTS SIO (Services Informatiques aux Organisations)</td>
                    <td class="exp-date">2022 - 2023</td>
                </tr>
            </table>
            <div class="exp-subtitle">Rigueur de gestion, sens du service client et organisation méthodique</div>
        </div>

        <div class="exp-box">
            <table class="exp-header-table">
                <tr>
                    <td class="exp-title">Baccalauréat STI2D</td>
                    <td class="exp-date">2021 - 2022</td>
                </tr>
            </table>
            <div class="exp-subtitle">Méthodologie, rigueur opérationnelle et respect des consignes</div>
        </div>
    </div>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Claires.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Claires.pdf\n";
    } else {
        $dompdf->stream("CV_Yacine_Claires.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Claire's - Conseiller de Vente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .landing-card {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            padding: 40px;
            border-top: 5px solid #db2777;
            border-radius: 8px;
        }
        .btn-claires {
            background-color: #db2777;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-claires:hover {
            background-color: #be185d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#db2777">Claire's</span></h1>
            <p class="text-muted mb-4">Conseiller de Vente &bull; Vendeur Magasin (Accessoires &amp; Bijoux)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-claires btn-lg shadow w-100 mb-3">
                    📄 Télécharger le CV Claire's (PDF)
                </button>
            </form>
            <div>
                <a href="cv_emploi.php" class="text-decoration-none text-muted small">← Retour à l'espace CV Emploi</a>
            </div>
        </div>
    </div>
</body>
</html>
