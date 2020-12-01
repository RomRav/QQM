<!DOCTYPE html>
<!--
authentificationIHM Romain Ravault 01/12/2020 
Last update: 01/12/2020 
-->

<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <title>Qu'est-ce qu'on mange?</title>
    </head>
    <body>
        <?php
        include 'partials/header.php';
        ?>
        <div class="authForm-content">
            <div class="form">
                <h3>Authentification</h3>
                <form action="authentificationCtrl.php" method="GET">
                    <div class="label-div">
                        <label for="pseudo" class="input">Pseudo</label>
                    </div>
                    <div class="input-div">
                        <input id="pseudo" type="text" name="pseudo">
                    </div>

                    <div class="label-div">
                        <label for="password" class="label">Mot de passe</label>
                    </div>
                    <div class="input-div">
                        <input id="password" class="input" type="password" name="password">
                    </div>
                    <button type="submit">Validez</button>
                </form>
                <?php
                $message
                ?>
            </div>
        </div>
    </body>
</html>
