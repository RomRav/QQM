/* 
 * jq.js
 * @author Romain Ravault
 * 08/12/2020
 * last update: 01/04/2021
 */
$(document).ready(function () {
    $('.same-pwd-checker').css('display', 'none');
    var form = $('.idLogForm');
    var status = 0;

    $('#imgFile').change(function (ev) {
        var imgPrev = ev.target.files[0];
        if (imgPrev) {
            var reader = new FileReader();
            reader.onload = function (ev) {
                $('#prevImg').attr('src', '');
                $('.prevDiv').prepend('<img id="prevImg" src="' + ev.target.result + '" />');
                $('#prevImg').attr('width', '300px');
            }
            reader.readAsDataURL(imgPrev);
        }
    });


    //Gestion du click sur le texte 'créer un compte', modifie le form pour ajouter et vérifier la saisie du mdp 
    $('#authFormChange').click(() => {
        console.log(status);
        if (status == 0) {
            $('h3').html('<h3>Nouvel utilisateur</h3>');
            $('#authFormChange').html('<p>Revenir à l\'athentification<p>');
            $('.same-pwd-checker').css('display', 'block');
            form.attr('action', 'authentificationCtrl.php?type=id');
            status = 1;
        } else {
            $('h3').html('<h3>Authentification</h3>');
            $('#authFormChange').html('<p>Créer un compte<p>');
            $('.same-pwd-checker').css('display', 'none');
            form.attr('action', 'authentificationCtrl.php?type=log');
            status = 0;
        }
    });
    //Gestion du message lors de la double saisie du mdp
    $('.pwdCheckInput').keyup(() => {
        var pwd = $('.password').val();
        var checkPwd = $('.pwdCheckInput').val();
        var pseudo = $('.pseudo').val();
        if (pwd == checkPwd & pseudo != 'undefined') {
            $('.message').html('<p>Mot de passe identique</p>');
            $('.message').css('color', 'green');
            $('button').attr('type', 'submit');
        } else {
            $('.message').html('<p>La saisie n\'est pas identique</p>');
            $('.message').css('color', 'red');
            $('button').attr('type', 'button');
        }
    });



    //Gestion du onClick sur le bouton delete de recipeIHM
    $('.deleteBtn').click(() => {
        if (window.confirm("Voulez-vous réelement supprimer la recette?")) {
            var idRecipe = getParameter('id');
            window.location.assign('../ctrl/recipeCtrl.php?choix=del&id=' + idRecipe);
        }
        ;
    });

    //Gestion du onClick sur le bouton modifier de recipeIHM
    $(".updateBtn").click(() => {
        var idRecipe = getParameter('id');
        window.location.assign('../ctrl/newRecipeCtrl.php?id=' + idRecipe);
    });

    /**
     * function getParameter
     * récupére les paramétre passé en GET dans l'url
     * @author Romain Ravault
     * 25/03/2021
     * 
     * @param {type} p
     * @returns {unresolved}
     */
    function getParameter(p) {
        var url = window.location.search.substring(1);
        var varUrl = url.split('&');
        for (var i = 0; i < varUrl.length; i++) {
            var parameter = varUrl[i].split('=');
            if (parameter[0] == p) {
                return parameter[1];
            }
        }
    }

// Gestion du click sur le bouton d'affichage du formulaire de modification du pseudo
    $(".btn-pseudo-update").click(() => {
        var attr = $('.pseudo-update-container').attr('hidden');
        if (typeof attr !== 'undefined' && attr !== false)
        {
            $('.pseudo-update-container').removeAttr('hidden');
        } else {
            $('.pseudo-update-container').attr("hidden", "");
        }

    });

// Gestion du click sur le bouton d'affichage du formulaire de modification du mot de passe
    $(".btn-mdp-update").click(() => {
        var attr = $('.mdp-update-container').attr('hidden');
        if (typeof attr !== 'undefined' && attr !== false)
        {
            $('.mdp-update-container').removeAttr('hidden');
        } else {
            $('.mdp-update-container').attr("hidden", "");
        }
    });

    // Gestion du click sur le bouton de suppression du compte
    $(".btn-account-delete").click(() => {
        if (window.confirm("Voulez-vous supprimez ce compte? Tous les recettes liée au compte seront supprimé.")) {
        }
    });
    

    

});

