<!DOCTYPE html>
<!--
authentificationIHM Romain Ravault 01/12/2020 
Last update: 08/12/2020 
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
        <?php include 'partials/header.php'; ?>
        <div class="authForm-content">
            <div class="form">
                <h3>Authentification</h3>
                <form class="idLogForm" action="authentificationCtrl.php?type=log" method="POST">
                    <div class="label-div">
                        <label for="pseudo" class="label"">Pseudo</label>
                    </div>
                    <div class="input-div">
                        <input class="pseudo" type="text" name="pseudo">
                    </div>

                    <div class="label-pseudo">
                        <label for="password" class="label">Mot de passe</label>
                    </div>
                    <div class="input-pwd">
                        <input  class="input password" type="password" name="password">
                    </div>
                    <div class="same-pwd-checker" >
                        <div class="label-pseudo">
                            <label for="pwdCheckInput" class="label">Vérification du Mot de passe</label>
                        </div>
                        <div class="same-input-pwd-checker">
                            <input class="pwdCheckInput password" type="password" name="pwdCheckInput">
                        </div>
                    </div>
                    <div>
                        <?php
                        $mdp = filter_input(INPUT_COOKIE, 'mdp');
                        if ($mdp) {
                            echo '<input type="checkbox" id="chkSavMdp" name="chkSavMdp" checked/>
                               <label for="chkSavMdp">se souvenir de moi</label>';
                        } else {
                            echo '<input type="checkbox" id="chkSavMdp" name="chkSavMdp" />
                               <label for="chkSavMdp">se souvenir de moi</label>';
                        }
                        ?>
                    </div>
                    <div>
                        <button type="submit">Validez</button>
                    </div>
                </form>
            </div>
            <div class="message">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </div>
            <div id="authFormChange">
                <p>Créer un compte</p>
            </div>
        </div>
        <script src="../js/jquery.js" ></script>
        <script src="../js/jq.js"></script>
    </body>
</html>
