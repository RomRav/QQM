<?php

require_once '../ett/nouvRecette.php';

$saison = filter_input(INPUT_POST, "saison");
$type = filter_input(INPUT_POST, "type");
$contenue = filter_input(INPUT_POST, "contenue");
$contenuRecette = filter_input(INPUT_POST, "contenuRecette");

for ($i=0;$i<count($saison);$i++){
    echo $saison[$i];
}


$newRec = new nouvRecette($saison, $type, $contenue, $contenuRecette);
echo ' Voici votre recette à   faire en ' . $newRec->getSaison() . ', servie en ' . $newRec->getType() . ' c\'est une recette a base de' . $newRec->getContenu() . '.<br> La recette:<br>' . $newRec->getRecette();
?>

