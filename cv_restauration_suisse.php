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
            line-height: 1.35;
            margin: 0;
            padding: 0;
            color: #1e293b;
            background-color: #fff;
        }
        
        /* HEADER DESIGN */
        .header-box {
            background-color: #0f172a;
            color: #ffffff;
            padding: 9px 13px;
            border-radius: 6px;
            margin-bottom: 7px;
            border-bottom: 3.5px solid #dc2626;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-left {
            width: 36%;
            font-size: 8.1pt;
            color: #cbd5e1;
            vertical-align: middle;
            text-align: left;
            line-height: 1.4;
        }
        .header-center {
            width: 48%;
            text-align: center;
            vertical-align: middle;
        }
        .header-right {
            width: 16%;
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
            font-size: 9.8pt; 
            font-weight: bold; 
            color: #ef4444;
            margin-top: 3px;
            text-transform: uppercase;
        }
        .search-objective {
            background-color: #dc2626;
            color: #ffffff;
            font-size: 7.6pt;
            padding: 2.5px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 4px;
            font-weight: bold;
        }
        .rhythm {
            font-size: 7.6pt;
            color: #cbd5e1;
            margin-top: 3px;
            font-weight: 500;
        }
        .profile-photo {
            width: 65px;
            height: auto;
            border: 2px solid #ef4444;
            border-radius: 5px;
        }
        .contact-item {
            margin-bottom: 2px;
        }

        /* SECTION TITLES */
        h2 {
            font-size: 9.2pt;
            text-transform: uppercase;
            color: #0f172a;
            font-weight: bold;
            background-color: #f8fafc;
            border-bottom: 2px solid #dc2626;
            border-top: 1px solid #e2e8f0;
            padding: 3px 8px;
            margin-top: 6px;
            margin-bottom: 5px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        /* PROFIL BLOCK */
        .profil-block {
            font-size: 8pt;
            padding: 6px 11px;
            background-color: #f1f5f9;
            border-left: 4px solid #dc2626;
            margin-bottom: 5px;
            line-height: 1.38;
            color: #334155;
            text-align: justify;
        }

        /* SKILLS TABLE */
        .skills-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .skills-column {
            width: 33.33%;
            vertical-align: top;
            padding: 0 4px;
        }
        .skill-card {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            padding: 5px 7px;
            text-align: center;
        }
        .skill-cat { 
            font-weight: bold; 
            font-size: 8pt; 
            text-transform: uppercase; 
            color: #dc2626;
            margin-bottom: 3px; 
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 2px;
            display: block;
        }
        .skill-list {
            font-size: 7.6pt;
            color: #334155;
            line-height: 1.38;
            text-align: left;
        }

        /* EXPERIENCES */
        .exp-box {
            width: 100%;
            margin: 0 auto 5px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 5px 9px;
        }
        .exp-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }
        .exp-title {
            font-weight: bold;
            font-size: 8.6pt;
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
            font-size: 7.6pt;
            color: #64748b;
            font-style: italic;
            margin-bottom: 3px;
            text-align: left;
        }
        ul.exp-list {
            margin: 2px 0 2px 14px;
            padding: 0;
            text-align: left;
        }
        ul.exp-list li {
            font-size: 7.6pt;
            color: #334155;
            margin-bottom: 2px;
            line-height: 1.35;
        }

        /* EDUCATION & DETAILS TABLE */
        .bottom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }
        .bottom-col {
            vertical-align: top;
            padding: 0 4px;
        }
        .bottom-card {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            padding: 5px 9px;
            font-size: 7.6pt;
            line-height: 1.38;
        }
        .bottom-title {
            font-weight: bold;
            font-size: 8pt;
            color: #0f172a;
            border-bottom: 1.5px solid #dc2626;
            padding-bottom: 2px;
            margin-bottom: 4px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="header-box">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="contact-item"><strong>Adresse :</strong> Zone Frontalière (France Voisine - Éligible Permis G)</div>
                    <div class="contact-item"><strong>Tél :</strong> +33 7 67 63 84 45 (Ligne directe)</div>
                    <div class="contact-item"><strong>E-mail :</strong> benbrikyacine60@gmail.com</div>
                    <div class="contact-item"><strong>Dossier :</strong> Casier judiciaire vierge + Non-poursuites</div>
                    <div class="contact-item"><strong>Statut :</strong> Frontalier (Permis G) | Mobilité Vaud & Genève</div>
                </td>
                <td class="header-center">
                    <div class="header">
                        <h1>Yacine BENBRIK</h1>
                        <div class="subtitle">Équipier Polyvalent • Restauration Rapide</div>
                        <div class="search-objective">SERVICE COMPTOIR • CAISSE & RUSH • CUISINE & HYGIÈNE HACCP</div>
                        <div class="rhythm">Poste Frontalier | Gestion du Rush & Cadence | Disponibilité Flex 24/7</div>
                    </div>
                </td>
                <td class="header-right">
                    $photoHtml
                </td>
            </tr>
        </table>
    </div>

    <h2>Profil Professionnel</h2>
    <div class="profil-block">
        Équipier polyvalent de restauration rapide dynamique, réactif et très résistant au stress sous forte affluence (périodes de rush). Fort d'une solide expérience au sein d'enseignes à fort débit et standards exigeants. Rigoureux sur l'hygiène et la sécurité alimentaire (normes HACCP), expert en encaissement rapide, assemblage de commandes sans erreur et préparation en cuisine. Aisance relationnelle naturelle, sens du service client et capacité d'adaptation immédiate (passage fluide du comptoir à la cuisine). Dossier administratif complet (Casier judiciaire vierge, attestation de non-poursuites). Disponibilité immédiate et flexibilité horaire totale.
    </div>

    <h2>Compétences Clés & Habilitations</h2>
    <table class="skills-table">
        <tr>
            <td class="skills-column">
                <div class="skill-card">
                    <span class="skill-cat">Service Client & Caisse</span>
                    <div class="skill-list">
                        • Prise de commande caisse tactile & borne<br>
                        • Gestion de la caisse & encaissement rapide<br>
                        • Assemblage plateaux/sacs sans erreur<br>
                        • Vente additionnelle & accueil chaleureux
                    </div>
                </div>
            </td>
            <td class="skills-column">
                <div class="skill-card">
                    <span class="skill-cat">Cuisine & Normes HACCP</span>
                    <div class="skill-list">
                        • Préparation & cuisson rapide (Fritures)<br>
                        • Respect strict des normes HACCP & DLC<br>
                        • Nettoyage, désinfection & traçabilité<br>
                        • Rotation des stocks (méthode FIFO)
                    </div>
                </div>
            </td>
            <td class="skills-column">
                <div class="skill-card">
                    <span class="skill-cat">Garanties & Savoir-être</span>
                    <div class="skill-list">
                        • Gestion optimale du stress & des rushs<br>
                        • Polyvalence totale (Caisse/Cuisine/Salle)<br>
                        • Ponctualité & enthousiasme au travail<br>
                        • Permis B + Véhicule (Mobilité 24/7)
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <h2>Expériences Professionnelles</h2>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Équipier Polyvalent de Restauration Rapide & Rush Manager</td>
                <td class="exp-date">Janvier 2025 – Présent</td>
            </tr>
        </table>
        <div class="exp-subtitle">Enseigne de Restauration Rapide à Fort Débit (Grand Groupe)</div>
        <ul class="exp-list">
            <li><strong>Gestion des Pics d'Affluence (Rush) :</strong> Prise de commandes et encaissement à cadence élevée (jusqu'à 300 clients/heure) garantissant un flux d'attente fluide et agréable.</li>
            <li><strong>Polyvalence Comptoir & Cuisine :</strong> Préparation minutieuse des assemblages produits, fritures et emballages selon les fiches techniques et standards de l'enseigne.</li>
            <li><strong>Qualité & Hygiène HACCP :</strong> Contrôle des températures de maintien au chaud, entretien continu du poste de travail et traçabilité rigoureuse des produits.</li>
        </ul>
    </div>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Employé de Restauration & Service Client</td>
                <td class="exp-date">Mai 2024 – Décembre 2024</td>
            </tr>
        </table>
        <div class="exp-subtitle">Concept de Restauration Rapide & Vente à Emporter</div>
        <ul class="exp-list">
            <li><strong>Accueil & Vente Additionnelle :</strong> Accueil souriant, conseil des menus, traitement des demandes spécifiques et proposition d'accompagnements et desserts.</li>
            <li><strong>Préparation de Commandes & Delivery :</strong> Conditionnement rapide des commandes sur place, à emporter et livreurs partenaires (UberEats / JustEat).</li>
            <li><strong>Clôture & Nettoyage :</strong> Nettoyage approfondi des équipements de cuisine, gestion de la plonge automatique et rangement selon les exigences sanitaires suisses.</li>
        </ul>
    </div>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Équipier de Cuisine & Assemblage (Fort Débit)</td>
                <td class="exp-date">Octobre 2023 – Avril 2024</td>
            </tr>
        </table>
        <div class="exp-subtitle">Restaurant Fast-Food & Service Drive</div>
        <ul class="exp-list">
            <li><strong>Poste Cuisine & Fritures :</strong> Cuisson minutée des protéines et accompagnements, respect des temps de rétention produit et gestion dynamique de la ligne d'assemblage.</li>
            <li><strong>Gestion de Caisse & Comptoir :</strong> Prise de commande sur système tactile POS, rendu monnaie précis et réapprovisionnement des consommables comptoir.</li>
            <li><strong>Esprit d'Équipe & Cadence :</strong> Communication fluide avec l'équipe de production garantissant un temps de délivrance moyen inférieur à 2 minutes.</li>
        </ul>
    </div>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Employé Polyvalent de Restauration & Entretien</td>
                <td class="exp-date">Janvier 2022 – Septembre 2023</td>
            </tr>
        </table>
        <div class="exp-subtitle">Restauration Collective & Service au Comptoir</div>
        <ul class="exp-list">
            <li><strong>Service au Comptoir & Salle :</strong> Préparation des plateaux repas, réapprovisionnement des vitrines réfrigérées et maintien de la propreté irréprochable de la salle.</li>
            <li><strong>Réception & Stockage FIFO :</strong> Réception des livraisons alimentaires, contrôle des températures à cœur et rangement en chambre froide selon la méthode FIFO.</li>
        </ul>
    </div>

    <h2>Formations, Certifications & Informations Complémentaires</h2>
    <table class="bottom-table">
        <tr>
            <td class="bottom-col" style="width: 50%;">
                <div class="bottom-card">
                    <div class="bottom-title">Formations & Qualifications</div>
                    <strong>2023 :</strong> Formation Hygiène Alimentaire & Méthode HACCP<br>
                    <strong>2023 :</strong> Certificat SST (Sauveteur Secouriste du Travail / Sécurité)<br>
                    <strong>2021 :</strong> Enseignement Secondaire / Formation Technique & Métiers
                </div>
            </td>
            <td class="bottom-col" style="width: 50%;">
                <div class="bottom-card">
                    <div class="bottom-title">Garanties, Langues & Permis</div>
                    <strong>Dossier :</strong> Casier judiciaire vierge + Attestation non-poursuites<br>
                    <strong>Langues :</strong> Français (Maternelle C2), Anglais (A2/B1 - Accueil International)<br>
                    <strong>Permis :</strong> Permis B + Véhicule (Mobilité Genève, Vaud, Valais, France Voisine)
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
HTML;

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    if (php_sapi_name() === 'cli') {
        file_put_contents('CV_Yacine_Restauration_Suisse.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Restauration_Suisse.pdf\n";
        exit;
    } else {
        $dompdf->stream("CV_Yacine_Restauration_Suisse.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Restauration Rapide - Standard Suisse</title>
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
        .btn-danger {
            background-color: #dc2626;
            border: none;
            color: white;
            padding: 14px 28px;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .btn-danger:hover {
            background-color: #b91c1c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-3">CV <span style="color:#dc2626">Restauration Rapide Suisse</span></h1>
            <p class="text-muted mb-4">Équipier Polyvalent / Employé de Restauration / Fast-Food à fort débit — Normes Suisse Romande (1 page)</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-danger btn-lg shadow w-100 mb-3">
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
