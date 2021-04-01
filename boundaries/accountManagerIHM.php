<!DOCTYPE html>
<!--
accountManagerIHM Romain Ravault 01/04/2021 
Last update: 01/04/2021
-->

<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="../css/style.css">
        <title>Qu'est-ce qu'on mange?</title>
    </head>
    <body>
        <?php
        session_start();
        include 'partials/header.php';
        ?>
        <div class="authForm-content">
            <div class="form">
                <h3>Mon Compte</h3>
                <h4><?php echo $_SESSION['pseudo'] ?></h4>
                <div class="pseudo-update-container" hidden>
                    <label>Entrez le nouvel identifiant</label>
                    <input type="text">
                    <button>Validez la modification</button>
                </div>
                <div class="mdp-update-container" hidden>
                    <label>Entrez l'ancien mot de passe</label>
                    <input type="text">
                    <label>Entrez le nouveau mot de passe</label>
                    <input type="text">
                    <button>Validez la modification</button>
                </div>
                <div class="btns-container">
                    <button class="btn-pseudo-update">Modifier l'identifiant</button>
                    <button class="btn-mdp-update">Modifier le mot de passe</button>
                    <button class="btn-account-delete">Supprimer le compte</button>
                </div>
                <form>

                </form>
            </div>
            <div class="message">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </div>

        </div>
        <script src="../js/jquery.js" ></script>
        <script src="../js/jq.js"></script>
    </body>
</html>
