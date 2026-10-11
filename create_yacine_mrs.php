<?php
$files = [
    'manutention.php' => 'yacine_mrs_manutention.php',
    'polyvalent.php' => 'yacine_mrs_polyvalent.php',
];

foreach ($files as $src => $dst) {
    if (!file_exists($src)) continue;
    
    $content = file_get_contents($src);
    
    // Replace address blocks
    $content = preg_replace('/<div class="contact-item">134 Chemin de Monod<\/div>\s*<div class="contact-item">74330 Poisy, France<\/div>/', '<div class="contact-item">Marseille</div><div class="contact-item">13000 Marseille, France</div>', $content);
    $content = preg_replace('/<div class="contact-item">\+33 7 67 63 84 45<\/div>/', '<div class="contact-item">07 67 63 84 45</div>', $content);
    
    // Replace title to be "Marseille"
    $content = preg_replace('/<span style="color:#b45309">Manutention<\/span>/', '<span style="color:#e67e22">Manutention MRS</span>', $content);
    $content = preg_replace('/<span style="color:#1e3a8a">Intérim Polyvalent<\/span>/', '<span style="color:#1e3a8a">Polyvalent MRS</span>', $content);
    
    // Remove status admin for Permis G
    $content = preg_replace('/<div class="status-admin"[^>]*>Carte de Résident 10 ans \(France\) — Éligible au Permis G \(Frontalier\)<\/div>\s*/', '', $content);
    
    // Update objective to INTERIM
    $content = preg_replace('/<div class="search-objective">VÉHICULÉ - PRÊT À COMMENCER<\/div>/', '<div class="search-objective">DISPONIBLE POUR MISSIONS D\'INTÉRIM</div>', $content);
    
    file_put_contents($dst, $content);
}
echo "Done";
?>
