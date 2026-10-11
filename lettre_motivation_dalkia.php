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
            border-left: 3px solid #dc2626; /* Accent red for Dalkia */
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
                        <strong>Dalkia Centre-Est</strong><br>
                        Service Recrutement Alternance<br>
                        GRENOBLE<br>
                        Isère (38)
                    </div>
                </td>
            </tr>
        </table>

        <!-- Date -->
        <div class="date-container">
            À Marseille, le 3 juin 2026
        </div>

        <!-- Object -->
        <div class="object-line">
            Objet : Candidature au poste de Technicien de Maintenance CVC en alternance – BTS MSEF (Grenoble)
        </div>

        <!-- Salutation -->
        <div class="salutation">
            Madame, Monsieur,
        </div>

        <!-- Letter Body -->
        <div class="paragraph">
            C’est avec un vif intérêt et une grande motivation que je vous adresse ma candidature pour l’offre de Technicien de Maintenance CVC en alternance, en vue de préparer le BTS Maintenance des Systèmes option Énergétiques et Fluidiques (MSEF) au sein de votre entreprise, en partenariat avec l’IMT de Grenoble.
        </div>

        <div class="paragraph">
            Actuellement basé à Marseille, je souhaite donner une nouvelle dynamique à mon parcours et je suis à 100 % mobile. Intégrer votre agence de Grenoble représente pour moi une formidable opportunité. Votre proposition de prise en charge de l'hébergement sur le campus de l'IMT ainsi que des frais annexes durant les périodes de formation témoigne de l’accompagnement de Dalkia envers ses alternants. Cela me permettra de m'installer sereinement et de me concentrer pleinement sur la réussite de mon diplôme et de mes missions professionnelles.
        </div>

        <div class="paragraph">
            Le secteur du génie climatique et de la maintenance énergétique m'attire particulièrement pour ses défis techniques et son rôle crucial dans la transition écologique. Choisir Dalkia, c’est faire le choix de l’excellence opérationnelle et apprendre le métier sur le terrain aux côtés d'équipes expertes. Rigoureux, manuel et doté d'un bon esprit d'équipe, je suis prêt à m’investir à fond dans l’entretien préventif et correctif des installations énergétiques que vous gérez.
        </div>

        <div class="paragraph">
            N’ayant pas formulé de vœux sur la plateforme Parcoursup, je fais la démarche de candidater directement auprès de vos services. Ma démarche est le reflet d'une réelle détermination : je possède l'autonomie et la maturité nécessaires pour vivre ce changement de région et m'engager pleinement à vos côtés durant ces deux années de formation.
        </div>

        <div class="paragraph">
            Je me tiens à votre entière disposition pour un entretien, qu'il soit téléphonique, en visioconférence ou lors d'un déplacement à Grenoble, afin de vous exposer de vive voix mes motivations.
        </div>

        <div class="paragraph">
            Dans l'attente de votre réponse, je vous prie d'agréer, Madame, Monsieur, l'expression de mes salutations distinguées.
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
    $dompdf->stream("LM_Yacine_Benbrik_Dalkia.pdf", ["Attachment" => false]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Lettre de Motivation - Dalkia</title>
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
            border-top: 5px solid #dc2626;
        }

        .btn-danger {
            background-color: #dc2626;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
        }
        .btn-danger:hover {
            background-color: #b91c1c;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card landing-card shadow-lg">
            <h1 class="mb-4">Lettre de <span class="text-danger">Motivation</span></h1>
            <p class="text-muted mb-5">Technicien de Maintenance CVC en alternance - BTS MSEF (Dalkia Grenoble).</p>
            <form method="post">
                <button type="submit" name="generate" class="btn btn-danger btn-lg shadow">
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
