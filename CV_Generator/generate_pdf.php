<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['firstname'] ?? '';
    $nom = $_POST['lastname'] ?? '';
    $titre = $_POST['headline'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $links = $_POST['links'] ?? '';
    $summary = $_POST['summary'] ?? '';

    $exp_titles = $_POST['exp_title'] ?? [];
    $exp_corps = $_POST['exp_company'] ?? [];
    $exp_descs = $_POST['exp_desc'] ?? [];

    $form_titles = $_POST['form_title'] ?? [];
    $form_schools = $_POST['form_school'] ?? [];

    $exp_cats = $_POST['exp_cat'] ?? [];
    $exp_skills = $_POST['exp_skills'] ?? [];

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 1.5cm; }
        body { font-family: Arial, sans-serif; line-height: 1.3; margin: 0; padding: 0; color: #1e293b; font-size: 9pt; }
        
        /* Numérotation des pages */
        .page-number:after { content: "Page " counter(page); }
        .footer { position: fixed; bottom: -20px; left: 0; right: 0; text-align: right; font-size: 8pt; color: #94a3b8; }

        .header { text-align: center; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #28a745; }
        .header h1 { font-size: 22pt; margin: 0; text-transform: uppercase; font-weight: bold; color: #0f172a; }
        .header .subtitle { font-size: 14pt; font-weight: bold; color: #28a745; margin-top: 5px; text-transform: uppercase; }
        .contact-info { margin-top: 8px; font-size: 9pt; color: #64748b; }
        
        h2 { font-size: 11pt; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; padding-bottom: 4px; margin-top: 20px; margin-bottom: 12px; font-weight: bold; color: #0f172a; }
        
        .section { page-break-inside: auto; }
        .timeline-table { width: 100%; border-collapse: collapse; }
        tr { page-break-inside: avoid; page-break-after: auto; }
        
        .timeline-date { width: 110px; text-align: right; vertical-align: top; padding-right: 15px; font-weight: bold; font-size: 8.5pt; color: #28a745; }
        .timeline-content { vertical-align: top; padding-bottom: 10px; }
        
        .item-title { font-weight: bold; font-size: 10pt; color: #0f172a; margin-bottom: 2px; }
        .profil-block { margin-left: 125px; font-size: 9.5pt; padding: 12px; background-color: #f8fafc; border-left: 4px solid #28a745; margin-bottom: 15px; }
        .expertise-block { margin-left: 125px; margin-bottom: 15px; }
        .small-text { font-size: 9pt; color: #334155; }
        strong { color: #0f172a; }
    </style>
</head>
<body>
    <div class="footer">
        <span class="page-number"></span>
    </div>

    <div class="header">
        <h1>$prenom $nom</h1>
        <div class="subtitle">$titre</div>
        <div class="contact-info">
            $contact<br>
            $links
        </div>
    </div>

    <div class="section">
        <h2>Profil Professionnel</h2>
        <div class="profil-block">$summary</div>
    </div>

    <div class="section">
        <h2>Expertises Techniques</h2>
        <div class="expertise-block">
HTML;

    foreach ($exp_cats as $i => $cat) {
        if (empty($cat) && empty($exp_skills[$i])) continue;
        $skills = $exp_skills[$i];
        $html .= "<div style='margin-bottom: 4px;'><strong>$cat :</strong> $skills</div>";
    }

    $html .= <<<HTML
        </div>
    </div>

    <div class="section">
        <h2>Expériences Professionnelles</h2>
        <table class="timeline-table">
HTML;

    foreach ($exp_titles as $i => $t) {
        if (empty($t)) continue;
        $corps = $exp_corps[$i];
        $desc = nl2br(htmlspecialchars($exp_descs[$i]));
        $html .= "
            <tr>
                <td class='timeline-date'>$corps</td>
                <td class='timeline-content'>
                    <div class='item-title'>$t</div>
                    <div class='small-text'>$desc</div>
                </td>
            </tr>";
    }

    $html .= "</table></div>";

    if (!empty($form_titles)) {
        $html .= '<div class="section"><h2>Formation</h2><table class="timeline-table">';
        foreach ($form_titles as $i => $t) {
            if (empty($t)) continue;
            $school = $form_schools[$i];
            $html .= "
                <tr>
                    <td class='timeline-date'>$school</td>
                    <td class='timeline-content'>
                        <div class='item-title'>$t</div>
                    </td>
                </tr>";
        }
        $html .= "</table></div>";
    }

    $html .= "</body></html>";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("MonCV_Generé.pdf", ["Attachment" => true]);
    exit;
}
