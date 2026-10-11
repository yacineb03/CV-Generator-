<?php

function update_profil($file, $new_text) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Remplace le texte du bloc profil par le nouveau texte, de façon propre
        $content = preg_replace('/<div class="profil-block">.*?<\/div>/s', '<div class="profil-block">' . "\n            " . $new_text . "\n        " . '</div>', $content);
        
        // Sécurité supplémentaire : purger les mots "Annemasse", "Poisy", "Frontalier"
        $content = str_ireplace('Annemasse', 'Marseille', $content);
        $content = str_ireplace('Poisy', 'Marseille', $content);
        $content = str_ireplace('(Frontalier)', '', $content);
        $content = str_ireplace('Frontalier', '', $content);
        
        file_put_contents($file, $content);
    }
}

// 1. Manutention
update_profil('yacine_mrs_manutention.php', "Travailler dur ne me fait pas peur. Résidant à Marseille et véhiculé, je cherche activement à m'investir, même pour de très courtes missions. Je suis un travailleur manuel, robuste et extrêmement ponctuel. J'ai l'habitude de suivre des cadences strictes, que ce soit pour de la logistique, du nettoyage industriel ou de l'aide diverse. J'apprends les consignes de sécurité très vite et on peut compter sur ma présence à l'heure exacte. Je suis prêt à prendre mon poste immédiatement.");

// 2. Polyvalent
update_profil('yacine_mrs_polyvalent.php', "Jeune, sérieux et manuel, je suis à la recherche de missions variées sur Marseille et ses environs. Que ce soit pour de la mise en rayon, de l'accueil, de l'entretien ou de l'aide sur chantier, j'ai avant tout une très forte envie de travailler. Je m'intègre facilement dans une nouvelle équipe, je suis assidu et disponible dès aujourd'hui pour renforcer vos effectifs.");

// 3. Intérim (Ultime)
update_profil('yacine_mrs_interim.php', "Jeune, manuel et très motivé, je suis à la recherche de missions en intérim sur le bassin marseillais. Titulaire du Permis B et véhiculé, j'ai l'habitude du travail physique et des environnements exigeants. Qu'il s'agisse de manutention en entrepôt, d'opérateur en usine, d'aide sur un chantier ou de livraison, j'ai avant tout envie de travailler de manière assidue. Je m'intègre facilement dans une nouvelle équipe et je suis disponible dès demain matin pour m'investir sérieusement.");

// 4. Livreur
update_profil('yacine_mrs_livreur.php', "Titulaire du Permis B depuis plusieurs années, je suis un conducteur particulièrement prudent et débrouillard. Résidant à Marseille, j'ai un très bon sens de l'orientation en ville et je connais l'importance d'optimiser une tournée de livraison. Que ce soit pour de la messagerie de colis (express) ou d'autres livraisons, je respecte scrupuleusement le véhicule et la marchandise. Poli avec la clientèle, je suis prêt à prendre la route dès demain matin.");

// 5. Préparateur de Commande
update_profil('yacine_mrs_preparateur.php', "Jeune, rigoureux et très motivé, je recherche activement des missions en logistique sur Marseille. Endurant physiquement et habitué aux cadences de travail exigeantes, je maîtrise les bases du conditionnement, de l'étiquetage et de la palettisation. Organisé dans mes tâches, je sais suivre un process avec précision. Je m'intègre rapidement en équipe et je suis disponible immédiatement pour m'investir sérieusement.");

// 6. Sécurité
update_profil('yacine_mrs_securite.php', "Titulaire de la Carte Professionnelle d'Agent de Sécurité (à jour), je recherche activement un emploi dans le gardiennage, le filtrage ou l'événementiel sur Marseille et ses alentours. Je possède une bonne aisance relationnelle tout en sachant me faire respecter avec calme et fermeté. J'ai un grand sens de l'observation et je sais gérer des situations de tension sans perdre mon sang-froid. Sérieux, sportif et très discret, je suis véhiculé et disponible de suite pour effectuer des vacations.");

echo "Done";
?>
