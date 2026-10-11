<?php
$files = [
    'france_interim.php' => 'yacine_mrs_interim.php',
    'france_securite.php' => 'yacine_mrs_securite.php',
    'france_livreur.php' => 'yacine_mrs_livreur.php',
];

foreach ($files as $src => $dst) {
    $content = file_get_contents($src);
    
    // Fix address 1 (Annemasse)
    $content = preg_replace('/<div class="contact-item">12 Rue du Commerce<\/div>\s*<div class="contact-item">74100 Annemasse, France<\/div>/', '<div class="contact-item">Marseille</div><div class="contact-item">Marseille, France</div>', $content);
    
    // Fix address 2 (Poisy)
    $content = preg_replace('/<div class="contact-item">134 Chemin de Monod<\/div>\s*<div class="contact-item">74330 Poisy, France<\/div>/', '<div class="contact-item">Marseille</div><div class="contact-item">Marseille, France</div>', $content);
    
    // Remove Permis G status completely if it exists
    $content = preg_replace('/<div class="status-admin".*?<\/div>\s*/', '', $content);
    
    file_put_contents($dst, $content);
}
echo "Done";
?>
