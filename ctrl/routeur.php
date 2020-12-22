<?php
/*
 * router.php
 * 
 * @author: Romain Ravault
 * 27/02/2020
 * lastupdate 01/12/2020
 */

$route = filter_input(INPUT_POST, "route");
if ($route == NULL) {
    $route = filter_input(INPUT_GET, "route");
}
switch ($route) {
    case "authentification":
        $route = '../boundaries/authentificationIHM.php';
        break;
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
        $route = '../boundaries/pageInconnu.php';
        break;
}
include $route;
?>