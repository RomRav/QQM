<?php

/*
 * router.php
 * 
 * @author: Romain Ravault
 * 27/02/2020
 * lastupdate 30/09/2020
 */

$route = filter_input(INPUT_POST, "route");
if ($route == NULL) {
    $route = filter_input(INPUT_GET, "route");
}
switch ($route) {
    case "newRecipe":
        $route = '../boundaries/newRecipeIHM.php';
        break;
    case "recipeList":
        $route = '../boundaries/recipeListIHM.php';
        break;
    case "recipe":
        $route = '../boundaries/recipeIHM.php';
        break;
    case "administration":
        $route = '../boundaries/administrationIHM.php';
        break;
    default :
        $route = '../boundaries/newRecipeIHM.php';
        break;
}
include $route;
?>