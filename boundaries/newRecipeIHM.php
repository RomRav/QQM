<!doctype html>
<?php
/**
 * newRecipeIHM.php
 * @authore: Romain Ravault
 * 28/02/2020
 */
require_once '../ctrl/newRecipeCtrl.php';
?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>Qu'est-ce qu'on mange?</title>
    </head>
    <body>
        <h1>Qu'est-ce qu'on mange?!</h1>
        <h2>Ajoutez une recette:</h2>
        <form action="../ctrl/newRecipeCtrl.php" method="post">
            <div class="form-group">
                <label>Nom de la recette</label>
                <input type="text" name="titre" class="form-control col-lg-4" placeholder="Nom de ma recette">
            </div>
            <h4>Caractéristique de la recette</h4>
            <div class="form-row">
                <div class="col">
                    <label>Ingredient</label>
                    <select multiple class="form-control" name="ingredient">
                        <?php echo $selectIngredient; ?>
                    </select>
                </div>
                <div class="col">
                    <label>Pays</label>
                    <select multiple class="form-control" name="country">
                        <?php echo $selectCountry; ?>
                    </select>

                </div>
                <div class="col">
                    <label>Saison</label>
                    <select multiple class="form-control" name="season[]">
                        <?php echo $selectSeason; ?>
                    </select>
                </div>
                <div class="col">
                    <label>Position du plat</label>
                    <select multiple class="form-control" name="position">
                        <?php echo $selectPosition; ?>
                        <!--                        <option name="entree">Entrée</option>
                                                <option name="plats">Plats</option>
                                                <option name="dessert">Dessert</option>-->
                    </select>
                </div>
                <div class="col">
                    <label>Contenu du plat</label>
                    <select multiple class="form-control" name="contenue">
                        <?php echo $selectType ?>
                    </select>
                </div>
            </div>
            <h4>Votre recette:</h4>
            <div class="form-row">
                <textarea name="contenuRecette" class="form-control form-control-lg col-lg-8" placeholder="Saisisez ici votre recette" cols="50" rows="10"></textarea>
            </div>
            <div class="btn btn-primary">
                <button type="submit" class="btn btn-primary">Enregistrez</button>
            </div>
            <?php echo $message; ?>
        </form>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>