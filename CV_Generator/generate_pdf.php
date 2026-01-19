<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['firstname'];
    $nom = $_POST['lastname'];
    $titre = $_POST['headline'];
    $exp_titles = $_POST['exp_title'] ?? [];
    $exp_corps = $_POST['exp_company'] ?? [];
    $exp_descs = $_POST['exp_desc'] ?? [];

    $html = "
    <html>
    <head>
        <style>
            body { font-family: sans-serif; }
            h1 { color: #333; margin-bottom: 0px; }
            .titre { color: #28a745; font-size: 18px; font-weight: bold; margin-bottom: 20px; }
            .section { border-bottom: 2px solid #28a745; font-weight: bold; margin-top: 20px; }
            .item { margin-top: 10px; }
            .desc { color: #666; font-size: 11px; }
        </style>
    </head>
    <body>
        <h1>$prenom $nom</h1>
        <div class='titre'>$titre</div>
        <div class='section'>EXPÉRIENCES</div>";

    foreach ($exp_titles as $i => $t) {
        if (empty($t)) continue;
        $c = $exp_corps[$i];
        $d = nl2br(htmlspecialchars($exp_descs[$i]));
        $html .= "<div class='item'><strong>$t</strong> chez $c</div>";
        $html .= "<div class='desc'>$d</div>";
    }

    $html .= "</body></html>";

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("MonCV.pdf", ["Attachment" => true]);
}
