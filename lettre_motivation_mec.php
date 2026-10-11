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
        body {
            font-family: Arial, sans-serif;
            font-size: 10.5pt;
            line-height: 1.6;
            color: #1e293b;
            margin: 0;
            padding: 30px 40px;
            background-color: #fff;
        }
        .container {
            width: 100%;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        .sender-info {
            width: 50%;
            vertical-align: top;
            font-size: 10pt;
            color: #0f172a;
        }
        .recipient-info {
            width: 50%;
            vertical-align: top;
            text-align: right;
            font-size: 10pt;
            color: #0f172a;
            padding-top: 30px;
        }
        .recipient-box {
            display: inline-block;
            text-align: left;
            border-left: 3px solid #0f766e; /* Accent teal for MEC */
            padding-left: 12px;
        }
        .date-container {
            text-align: right;
            margin-bottom: 35px;
            font-size: 10.5pt;
            color: #475569;
        }
        .object-line {
            font-weight: bold;
            font-size: 11pt;
            color: #0f172a;
            margin-bottom: 30px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 6px;
        }
        .salutation {
            margin-bottom: 15px;
            font-weight: bold;
        }
        .paragraph {
            margin-bottom: 18px;
            text-align: justify;
        }
        .signature-container {
            margin-top: 45px;
            text-align: right;
            padding-right: 30px;
        }
        .signature-title {
            font-weight: bold;
            margin-bottom: 40px;
        }
        .signature-placeholder {
            font-style: italic;
            font-size: 9pt;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header: Sender & Recipient info -->
        <table class="header-table">
            <tr>
                <td class="sender-info">
                    <strong>Yacine BENBRIK</strong><br>
                    50 Traverse Moulin de la Villette<br>
                    13003 Marseille<br>
                    Tél : 07 67 63 84 45<br>
                    Email : benbrikyacine60@gmail.com
                </td>
                <td class="recipient-info">
                    <div class="recipient-box">
                        <strong>Cabinet d’Économie de la Construction</strong><br>
                        Service Recrutement Alternance<br>
                        MARSEILLE
                    </div>
                </td>
            </tr>
        </table>

        <!-- Date -->
        <div class="date-container">
            À Marseille, le 12 juin 2026
        </div>

        <!-- Object -->
        <div class="object-line">
            Objet : Candidature au poste de Métreur / Économiste de la construction en alternance – BTS MEC
        </div>

        <!-- Salutation -->
        <div class="salutation">
            Madame, Monsieur,
        </div>

        <!-- Letter Body -->
        <div class="paragraph">
            Futur étudiant en BTS Management Économique de la Construction (MEC), je suis à la recherche d'une alternance pour préparer ce diplôme au sein de votre structure. Passionné par l'économie du bâtiment et fort d'une solide culture de terrain, je souhaite mettre ma rigueur et mes compétences à votre service pour le calcul des coûts, l'établissement des devis et l'analyse financière de vos projets de construction.
        </div>

        <div class="paragraph">
            Ce qui fait la force de ma candidature, c'est l'alliance unique entre mon aisance numérique et ma pratique réelle du chantier. Issu d'un parcours supérieur en informatique (BTS SIO, Web@cadémie), je maîtrise parfaitement les outils digitaux, l'analyse de données et la logique algorithmique indispensables pour manipuler les logiciels d'études de prix ou automatiser des tableaux de chiffrage complexes. En parallèle, mon expérience régulière sur des chantiers de rénovation m'a permis d'acquérir une connaissance concrète des matériaux, de la gestion physique des stocks et des contraintes réelles du terrain. Je comprends ainsi précisément la réalité opérationnelle derrière chaque chiffre et chaque ligne de devis.
        </div>

        <div class="paragraph">
            Mon objectif est de vous apporter cette double vision bureau/terrain pour fiabiliser vos estimations et garantir des métrés sans erreurs. Déterminé, doté d'un excellent sens du détail et d'une ponctualité absolue, je suis prêt à m'investir pleinement pour devenir un collaborateur autonome et performant au sein de vos équipes. Je me tiens à votre entière disposition pour un entretien afin de vous exposer mes motivations de vive voix.
        </div>

        <div class="paragraph">
            Je vous prie d'agréer, Madame, Monsieur, l'expression de mes salutations distinguées.
        </div>

        <!-- Signature -->
        <div class="signature-container">
            <div class="signature-title">Yacine BENBRIK</div>
            <div class="signature-placeholder">(Signature)</div>
        </div>
    </div>
</body>
</html>
HTML;
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("LM_Yacine_Benbrik_MEC.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Lettre de Motivation - BTS MEC</title>
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
            border-top: 5px solid #0f766e;
        }

        .btn-teal {
            background-color: #0f766e;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
        }
        .btn-teal:hover {
            background-color: #0d5c55;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">Lettre de <span style="color:#0f766e">Motivation</span></h1>
            <p class="text-muted mb-5">Métreur / Économiste de la construction en alternance - BTS MEC.</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-teal btn-lg shadow w-100">
                    Télécharger ma Lettre de Motivation (PDF)
                </button>
            </form>
            <div class="mt-4">
                <a href="index.php" class="text-decoration-none text-muted small">← Retour Menu</a>
            </div>
        </div>
    </div>
</body>

</html>
