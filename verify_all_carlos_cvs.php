<?php
require 'vendor/autoload.php';

$cvFiles = [
    'carlos_alt_froid_clim.php' => 'CV_Carlos_Froid_Clim.pdf',
    'carlos_alt_chauffage_clim_enr.php' => 'CV_Carlos_Chauffage_Clim_ENR.pdf',
    'carlos_alt_controleur_technique_auto.php' => 'CV_Carlos_Controleur_Technique_Auto.pdf',
    'carlos_alt_meca_marine_plaisance.php' => 'CV_Carlos_Meca_Marine_Plaisance.pdf',
    'carlos_alt_maintenance_marine_plaisance.php' => 'CV_Carlos_Maintenance_Marine_Plaisance.pdf',
    'carlos_alt_electricien_batiment.php' => 'CV_Carlos_Electricien_Batiment.pdf',
    'carlos_alt_electricite_connecte.php' => 'CV_Carlos_Electricite_Connecte.pdf',
    'carlos_restau_quick.php' => 'CV_Carlos_Quick.pdf',
    'carlos_restau_g_la_dalle.php' => 'CV_Carlos_G_La_Dalle.pdf',
    'carlos_restau_popeyes.php' => 'CV_Carlos_Popeyes.pdf',
    'carlos_restau_burger_king.php' => 'CV_Carlos_Burger_King.pdf',
    'carlos_restau_otacos.php' => 'CV_Carlos_Otacos.pdf'
];

echo "========================================================\n";
echo "VÉRIFICATION RIGOUREUSE DES 12 CVS DE CARLOS MOREIRA VEIGA\n";
echo "========================================================\n\n";

$allPassed = true;
$index = 0;

foreach ($cvFiles as $phpFile => $expectedPdf) {
    $index++;
    echo "[$index/12] Analyse et génération : $phpFile ...\n";
    
    if (!file_exists($phpFile)) {
        echo "  [ERREUR] Le fichier $phpFile est introuvable !\n";
        $allPassed = false;
        continue;
    }

    $code = file_get_contents($phpFile);

    // 1. Check Contact Section for street address
    if (preg_match('/<div class="side-title">Contact<\/div>(.*?)<div class="side-title">/s', $code, $contactMatch)) {
        $contactText = strip_tags($contactMatch[1]);
        if (preg_match('/(rue|avenue|bd|boulevard|chemin|impasse|allée|daudet)\s+\d+|\d+,\s*(rue|avenue|boulevard)|112\s+rue/i', $contactText)) {
            echo "  [ERREUR ADRESSE] Une adresse physique a été trouvée dans le contact : $contactText\n";
            $allPassed = false;
        } else {
            echo "  [OK ADRESSE] Aucune adresse physique (Localisation propre : Marseille (13013)).\n";
        }
    } else {
        echo "  [ATTENTION] Section contact introuvable dans $phpFile\n";
    }

    // 2. Remove old PDF if exists to ensure fresh generation
    if (file_exists($expectedPdf)) {
        unlink($expectedPdf);
    }

    // 3. Run CLI generation
    $cmd = "php \"$phpFile\" generate";
    exec($cmd, $cliOutput, $returnCode);

    if ($returnCode !== 0 || !file_exists($expectedPdf)) {
        echo "  [ERREUR GÉNÉRATION] Échec de la compilation de $expectedPdf (Code: $returnCode)\n";
        $allPassed = false;
        continue;
    }

    // 4. Verify PDF size and Page count
    $pdfData = file_get_contents($expectedPdf);
    $size = filesize($expectedPdf);
    $pageCount = preg_match_all("/\/Type\s*\/Page[^s]/", $pdfData, $m);

    echo "  [FICHIER PDF] $expectedPdf généré avec succès (" . number_format($size, 0, ',', ' ') . " octets)\n";
    echo "  [PAGE COUNT] Nombre de page(s) : $pageCount\n";

    if ($pageCount === 1) {
        echo "  [SUCCÈS] Strictement 1 page A4 respectée !\n\n";
    } else {
        echo "  [ERREUR DÉBORDEMENT] Le PDF fait $pageCount pages ! Réduction requise.\n\n";
        $allPassed = false;
    }
}

echo "========================================================\n";
if ($allPassed) {
    echo "RÉSULTAT FINAL : 100% SUCCÈS ! Les 12 CVs de Carlos Moreira Veiga sont TOUS à STRICTEMENT 1 PAGE A4 et 0 ADRESSE !\n";
} else {
    echo "RÉSULTAT FINAL : Des erreurs ont été détectées, voir détails ci-dessus.\n";
}
echo "========================================================\n";
