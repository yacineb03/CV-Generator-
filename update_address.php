<?php
$files = glob("yacine_mrs_*.php");
$files[] = "frigoriste.php";
$files[] = "electrotechnique.php";
$files[] = "cv_mec.php";
$files[] = "lettre_motivation_mec.php";

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Remplacer l'ancienne adresse par la nouvelle (tout ce qui est avant le numéro de tel)
        $content = preg_replace(
            '/(<td class="header-left">\s*).*?(<div class="contact-item">07 67 63 84 45<\/div>)/is',
            '$1<div class="contact-item">50 Traverse Moulin de la Villette</div>' . "\n" . '                <div class="contact-item">13003 Marseille</div>' . "\n" . '                $2',
            $content
        );
        
        file_put_contents($file, $content);
    }
}
echo "Done";
?>
