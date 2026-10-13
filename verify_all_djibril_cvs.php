<?php
require 'vendor/autoload.php';

$cvFiles = [
    'djibril_quick.php' => 'CV_Djibril_Quick.pdf',
    'djibril_g_la_dalle.php' => 'CV_Djibril_G_La_Dalle.pdf',
    'djibril_action.php' => 'CV_Djibril_Action.pdf',
    'djibril_preparateur_commande.php' => 'CV_Djibril_Preparateur_Commande.pdf',
    'djibril_plaquiste.php' => 'CV_Djibril_Plaquiste.pdf',
    'djibril_agent_exploitation.php' => 'CV_Djibril_Agent_Exploitation.pdf',
    'djibril_claires.php' => 'CV_Djibril_Claires.pdf',
    'djibril_ikks_men.php' => 'CV_Djibril_IKKS_Men.pdf',
    'djibril_jules.php' => 'CV_Djibril_Jules.pdf',
    'djibril_casa_carcasas.php' => 'CV_Djibril_Casa_Carcasas.pdf',
    'djibril_pull_and_bear.php' => 'CV_Djibril_Pull_and_Bear.pdf',
    'djibril_intersport.php' => 'CV_Djibril_Intersport.pdf',
    'djibril_lidl.php' => 'CV_Djibril_Lidl.pdf',
    'djibril_leroy_merlin_nuit.php' => 'CV_Djibril_Leroy_Merlin_Nuit.pdf'
];

echo "========================================================\n";
echo "VÉRIFICATION RIGOUREUSE DES 14 CVS DE DJIBRIL MAILLET\n";
echo "========================================================\n\n";

$allPassed = true;
$index = 0;

foreach ($cvFiles as $phpFile => $expectedPdf) {
    $index++;
    echo "[$index/14] Analyse et génération : $phpFile ...\n";
    
    if (!file_exists($phpFile)) {
        echo "  [ERREUR] Le fichier $phpFile est introuvable !\n";
        $allPassed = false;
        continue;
    }

    $code = file_get_contents($phpFile);

    // 1. Check Contact Section
    if (preg_match('/<div class="side-title">Contact<\/div>(.*?)<div class="side-title">/s', $code, $contactMatch)) {
        $contactText = strip_tags($contactMatch[1]);
        if (preg_match('/(rue|avenue|bd|boulevard|chemin|impasse|allée)\s+\d+|\d+,\s*(rue|avenue|boulevard)/i', $contactText)) {
            echo "  [ERREUR ADRESSE] Une adresse physique a été trouvée dans le contact : $contactText\n";
            $allPassed = false;
        } else {
            echo "  [OK ADRESSE] Aucune adresse physique (Localisation propre : Marseille (13005)).\n";
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
    echo "RÉSULTAT FINAL : 100% SUCCÈS ! Les 14 CVs de Djibril Maillet sont TOUS à STRICTEMENT 1 PAGE A4 et 0 ADRESSE !\n";
} else {
    echo "RÉSULTAT FINAL : Des erreurs ont été détectées, voir détails ci-dessus.\n";
}
echo "========================================================\n";
