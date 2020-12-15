<!DOCTYPE html>
<!--
recipeIHM Romain Ravault 30/09/2020 
Last update: 
-->

<?php
require_once '../ctrl/administrationCtrl.php';
include 'partials/header.php';
?>
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
        <h1>Administration</h1>
        <?php
        echo $message;
        ?>
        <div class="row">
            <div class="col-6">
                <!--Cooker Card -->
                <div class="card" >
                    <div class="card-header">
                        <h5 class="card-title">Cuisinier</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        echo $cookerForm;
                        ?>        
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=cooker&cat=update"  class='btn btn-outline-primary'>Modifier</a>
                                </div>
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=cooker&cat=add"  class='btn btn-outline-success'>Ajouter</a>
                                </div>
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=cooker&cat=delete"  class='btn btn-outline-danger'>Supprimer</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <!--Type Card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Type de plat</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        echo $typeForm;
                        ?>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=type&cat=update"  class='btn btn-outline-primary'>Modifier</a>
                                </div>
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=type&cat=add"  class='btn btn-outline-success'>Ajouter</a>
                                </div>
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=type&cat=delete" class='btn btn-outline-danger'>Supprimer</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <!--Country Card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Pays</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        echo $countryForm;
                        ?>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=country&cat=update"  class='btn btn-outline-primary'>Modifier</a>
                                </div>
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=country&cat=add"  class='btn btn-outline-success'>Ajouter</a>
                                </div>
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=country&cat=delete"  class='btn btn-outline-danger'>Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <!--Ingredient Card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ingredients</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        echo $ingredientForm;
                        ?>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=ingredient&cat=update"  class='btn btn-outline-primary'>Modifier</a>
                                </div>
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=ingredient&cat=add"  class='btn btn-outline-success'>Ajouter</a>
                                </div>
                                <div class="col-4">
                                    <a href="../ctrl/administrationCtrl.php?choice=ingredient&cat=delete"  class='btn btn-outline-danger'>Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <!--Position Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Position du plat</h5>
                </div>
                <div class="card-body">
                    <?php
                    echo $positionForm;
                    ?>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-4">
                                <a href="../ctrl/administrationCtrl.php?choice=position&cat=update"  class='btn btn-outline-primary'>Modifier</a>
                            </div>
                            <div class="col-4">
                                <a href="../ctrl/administrationCtrl.php?choice=position&cat=add"  class='btn btn-outline-success'>Ajouter</a>
                            </div>
                            <div class="col-4">
                                <a href="../ctrl/administrationCtrl.php?choice=position&cat=delete"  class='btn btn-outline-danger'>Supprimer</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-6">
            <!--Unite de mesur Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Unité de mesure</h5>
                </div>
                <div class="card-body">
                    <?php
                    echo $uomForm;
                    ?>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-4">
                                <a href="../ctrl/administrationCtrl.php?choice=uom&cat=update"  class='btn btn-outline-primary'>Modifier</a>
                            </div>
                            <div class="col-4">
                                <a href="../ctrl/administrationCtrl.php?choice=uom&cat=add"  class='btn btn-outline-success'>Ajouter</a>
                            </div>
                            <div class="col-4">
                                <a href="../ctrl/administrationCtrl.php?choice=uom&cat=delete"  class='btn btn-outline-danger'>Supprimer</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/jq.js"></script>
</body>
</html>
