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
                        <div class="subtitle">Agent de Sécurité & Surveillance Privée</div>
                        <div class="search-objective">GARDIENNAGE • CONTRÔLE D'ACCÈS • SÛRETÉ ÉVÉNEMENTIELLE</div>
                        <div class="rhythm">Poste Frontalier | Connaissance CESP | Dossier Complet | Disponibilité 24/7</div>
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
        Agent de sécurité expérimenté, rigoureux et réactif. Spécialiste de la surveillance de sites sensibles, du filtrage d'accès tertiaire et logistique ainsi que de la sûreté événementielle. Doté d'une excellente maîtrise de soi et d'une gestion calme et ferme des situations conflictuelles. Connaissance du cadre réglementaire de la sécurité privée en Suisse (Concordat Romand CESP). Dossier administratif complet (Casier judiciaire vierge, attestation de non-poursuites). Candidat frontalier disponible immédiatement 24/7 (vacations de jour, nuit, week-ends et jours fériés).
    </div>

    <h2>Compétences Clés & Habilitations</h2>
    <table class="skills-table">
        <tr>
            <td class="skills-column">
                <div class="skill-card">
                    <span class="skill-cat">Sûreté & Contrôle</span>
                    <div class="skill-list">
                        • Contrôle d'accès & filtrage piétons/PL<br>
                        • Palpations de sécurité & fouilles de sacs<br>
                        • Gardiennage de sites sensibles & rondes<br>
                        • Vidéoprotection CCTV (Milestone / Genetec)
                    </div>
                </div>
            </td>
            <td class="skills-column">
                <div class="skill-card">
                    <span class="skill-cat">Intervention & Procédures</span>
                    <div class="skill-list">
                        • Désescalade & gestion de conflits<br>
                        • Procédures d'urgence & Secourisme BLS-AED/SST<br>
                        • Radiophonie VHF/UHF & Dispositif PTI/DATI<br>
                        • Main courante informatique & rapports
                    </div>
                </div>
            </td>
            <td class="skills-column">
                <div class="skill-card">
                    <span class="skill-cat">Garanties & Savoir-être</span>
                    <div class="skill-list">
                        • Casier judiciaire vierge & Extrait à jour<br>
                        • Posture & présentation professionnelle<br>
                        • Ponctualité & rigueur irréprochables<br>
                        • Permis B + Véhicule personnel
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <h2>Expériences Professionnelles</h2>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Agent de Sécurité & Contrôle d'Accès Sites Sensibles</td>
                <td class="exp-date">Janvier 2025 – Présent</td>
            </tr>
        </table>
        <div class="exp-subtitle">Société de Sécurité Privée & Gardiennage Industriels</div>
        <ul class="exp-list">
            <li><strong>Contrôle d'Accès Premium :</strong> Filtrage et enregistrement informatique des flux (personnel, prestataires, visiteurs), délivrance de badges et contrôle des habilitations.</li>
            <li><strong>Rondes & Surveillance Technico-Sécuritaire :</strong> Inspection périmétrique et intérieure sur complexes industriels avec suivi par rondier électronique et DATI/PTI.</li>
            <li><strong>Gestion d'Incidents :</strong> Application immédiate des consignes de sécurité, levée de doute sur alarmes et rédaction systématique des rapports de vacation.</li>
        </ul>
    </div>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Agent de Sécurité Événementielle & Secourisme</td>
                <td class="exp-date">Mai 2024 – Décembre 2024</td>
            </tr>
        </table>
        <div class="exp-subtitle">Prestataire de Sécurité & Manifestations Grand Public</div>
        <ul class="exp-list">
            <li><strong>Sécurisation de Manifestations Majeures :</strong> Filtrage du public, contrôle de billetterie et orientation pour événements d'envergure (jusqu'à 15'000 personnes).</li>
            <li><strong>Inspection & Fouille :</strong> Palpations de sécurité préventives, contrôles visuels des bagages et sécurisation permanente des zones réservées / VIP.</li>
            <li><strong>Médiation & Secourisme :</strong> Interventions de premier secours (SST / BLS-AED), désescalade des comportements à risque et maintien de la sérénité.</li>
        </ul>
    </div>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Agent d'Intervention & Prévention Vol (Grande Surface)</td>
                <td class="exp-date">Octobre 2023 – Avril 2024</td>
            </tr>
        </table>
        <div class="exp-subtitle">Société de Gardiennage & Sûreté Commerciale (Enseignes de la Grande Distribution)</div>
        <ul class="exp-list">
            <li><strong>Surveillance & Dissuasion :</strong> Posture dissuasive aux accès de surfaces commerciales, présence rassurante garantissant un climat serein pour la clientèle.</li>
            <li><strong>Vidéoprotection & Lutte Anti-Démarque :</strong> Surveillance active via réseau CCTV, détection des comportements suspects (-25% de pertes de marchandise).</li>
            <li><strong>Procédures d'Interpellation :</strong> Prise en charge des contrevenants dans le respect du cadre légal, rédaction des fiches d'incident et liaison forces de l'ordre.</li>
        </ul>
    </div>

    <div class="exp-box">
        <table class="exp-header-table">
            <tr>
                <td class="exp-title">Agent de Gardiennage Périmétrique & Rondier Nocturne</td>
                <td class="exp-date">Janvier 2022 – Septembre 2023</td>
            </tr>
        </table>
        <div class="exp-subtitle">Société de Sécurité & Surveillance Logistique (Sites Industriels & Tertiaires)</div>
        <ul class="exp-list">
            <li><strong>Vacations Nocturnes & Rondes :</strong> Surveillance de complexes logistiques de +20'000 m², contrôle horodaté des points névralgiques et détection d'anomalies.</li>
            <li><strong>Contrôle Logistique Poids-Lourds :</strong> Vérification des documents de transport, inspection des scellés/plombs et tenue de la main courante informatique.</li>
        </ul>
    </div>

    <h2>Formations, Certifications & Informations Complémentaires</h2>
    <table class="bottom-table">
        <tr>
            <td class="bottom-col" style="width: 50%;">
                <div class="bottom-card">
                    <div class="bottom-title">Formations & Qualifications</div>
                    <strong>2023 :</strong> Formation Agent de Sécurité (CQP / APS à jour) & Carte Pro<br>
                    <strong>2023 :</strong> Certificat Secourisme SST & Équivalence BLS-AED (Réanimation)<br>
                    <strong>2021 :</strong> Enseignement Secondaire / Formation Technique & Terrain
                </div>
            </td>
            <td class="bottom-col" style="width: 50%;">
                <div class="bottom-card">
                    <div class="bottom-title">Garanties, Langues & Permis</div>
                    <strong>Dossier :</strong> Casier judiciaire vierge + Attestation non-poursuites<br>
                    <strong>Langues :</strong> Français (Maternelle C2), Anglais (A2/B1 - Accueil), Allemand (A1)<br>
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
        file_put_contents('CV_Yacine_Securite_Suisse.pdf', $dompdf->output());
        echo "PDF généré avec succès dans CV_Yacine_Securite_Suisse.pdf\n";
        exit;
    } else {
        $dompdf->stream("CV_Yacine_Securite_Suisse.pdf", ["Attachment" => false]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV Agent de Sécurité - Standard Suisse</title>
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
            <h1 class="mb-3">CV <span style="color:#dc2626">Sécurité Suisse</span></h1>
            <p class="text-muted mb-4">Agent de Sécurité / Gardiennage / Contrôle d'Accès — Normes Genève & Vaud (1 page)</p>
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
