<!DOCTYPE html>
<!--index.php Romain Ravault 27/02/2020 Last update 04/12/2020-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>QQM</title>
    </head>
    <body>
        <?php
        session_start();
        $route = "";
        if (filter_input(INPUT_COOKIE, 'mdp') !== null) {
            $route = "recipeList";
        } else {
            $route = "authentification";
        }
        header("location: ctrl/routeur.php?route=" . $route);
        ?>        
    </body>
</html>