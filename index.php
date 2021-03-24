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
        $cookiePseudo = filter_input(INPUT_COOKIE, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
        $cookieId = filter_input(INPUT_COOKIE, 'idCooker', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($cookiePseudo !== null && $cookieId !== null) {
            $route = "recipeList";
            $_SESSION['pseudo'] = $cookiePseudo;
            $_SESSION['idCooker'] = $cookieId;
        } else {
            $route = "authentification";
        }
        header("location: ctrl/routeur.php?route=" . $route);
        ?>        
    </body>
</html>