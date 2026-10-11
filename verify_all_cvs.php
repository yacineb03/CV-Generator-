<?php
$cvFiles = [
    'Quick' => ['file' => 'cv_quick.php', 'pdf' => 'CV_Yacine_Quick.pdf'],
    'G-La Dalle' => ['file' => 'cv_g_la_dalle.php', 'pdf' => 'CV_Yacine_G_La_Dalle.pdf'],
    'Action' => ['file' => 'cv_action.php', 'pdf' => 'CV_Yacine_Action.pdf'],
    'Préparateur de Commande' => ['file' => 'cv_preparateur_commande.php', 'pdf' => 'CV_Yacine_Preparateur_Commande.pdf'],
    'Plaquiste' => ['file' => 'cv_plaquiste.php', 'pdf' => 'CV_Yacine_Plaquiste.pdf'],
    'Agent d\'Exploitation' => ['file' => 'cv_agent_exploitation.php', 'pdf' => 'CV_Yacine_Agent_Exploitation.pdf'],
    'Claire\'s' => ['file' => 'cv_claires.php', 'pdf' => 'CV_Yacine_Claires.pdf'],
    'IKKS Men' => ['file' => 'cv_ikks_men.php', 'pdf' => 'CV_Yacine_IKKS_Men.pdf'],
    'Jules' => ['file' => 'cv_jules.php', 'pdf' => 'CV_Yacine_Jules.pdf'],
    'La Casa de las Carcasas' => ['file' => 'cv_casa_carcasas.php', 'pdf' => 'CV_Yacine_Casa_Carcasas.pdf'],
    'Pull & Bear' => ['file' => 'cv_pull_and_bear.php', 'pdf' => 'CV_Yacine_Pull_Bear.pdf'],
    'Intersport' => ['file' => 'cv_intersport.php', 'pdf' => 'CV_Yacine_Intersport.pdf'],
    'Lidl' => ['file' => 'cv_lidl.php', 'pdf' => 'CV_Yacine_Lidl.pdf'],
    'Leroy Merlin Nuit' => ['file' => 'cv_leroy_merlin_nuit.php', 'pdf' => 'CV_Yacine_Leroy_Merlin_Nuit.pdf'],
];

echo "====================================================\n";
echo "VÉRIFICATION COMPLÈTE DES 14 CVS - GÉNÉRATION & PAGES\n";
echo "====================================================\n\n";

$allSuccess = true;

foreach ($cvFiles as $name => $info) {
    $script = $info['file'];
    $pdf = $info['pdf'];

    // 1. Exécuter la génération en CLI
    exec("php " . escapeshellarg($script) . " generate 2>&1", $output, $returnCode);

    if ($returnCode !== 0 || !file_exists($pdf)) {
        echo "[ERREUR] $name ($script) : Échec de génération (Code $returnCode)\n";
        $allSuccess = false;
        continue;
    }

    $pdfContent = file_get_contents($pdf);
    $size = strlen($pdfContent);

    // 2. Compter le nombre de pages
    $pageCount = preg_match_all('/\/Type\s*\/Page\b/', $pdfContent);

    // 3. Vérifier l'absence d'adresse postale
    $sourceCode = file_get_contents($script);
    $hasStreetAddress = preg_match('/(Villette|Traverse|Monod|Chemin de Monod|\d+\s+rue|\d+\s+avenue)/i', $sourceCode);

    $pageStatus = ($pageCount === 1) ? "OK (1 page)" : "ATTENTION ($pageCount pages)";
    $addrStatus = (!$hasStreetAddress) ? "OK (Zéro adresse)" : "ATTENTION (Adresse détectée)";

    if ($pageCount !== 1 || $hasStreetAddress) {
        $allSuccess = false;
    }

    printf("%-26s | %-13s | %-19s | %6d Ko\n", $name, $pageStatus, $addrStatus, round($size / 1024));
}

echo "\n====================================================\n";
if ($allSuccess) {
    echo "RÉSULTAT GLOBAL : SUCCÈS TOTAL !\nLes 14 CVs font STRICTEMENT 1 page, sans aucune adresse postale de rue.\n";
} else {
    echo "RÉSULTAT GLOBAL : Des ajustements sont nécessaires.\n";
}
echo "====================================================\n";
