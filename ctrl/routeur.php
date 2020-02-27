<?php

/*
 * router.php
 * 
 * @author: Romain Ravault
 * 27/02/2020
 */

$route = filter_input(INPUT_POST, "route");
if ($route = null) {
    $route = filter_input(INPUT_GET, "route");
}

switch ($route) {
    case "newRecipe":
        $route = '../boundaries/newRecipeIHM.php';
        break;
    default :
        $route = '../boundaries/newRecipeIHM.php';
        break;
}
include $route;
?>