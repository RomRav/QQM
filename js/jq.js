/* 
 * jq.js
 * @author Romain Ravault
 * 08/12/2020
 * last update: 06/01/2021
 */
$(document).ready(function () {
    $('.same-pwd-checker').css('display', 'none');
    var form = $('.idLogForm');
    var status = 0;

    $('#imgFile').change(function (ev) {
        var imgPrev = ev;
        console.log(ev.target);
        if (imgPrev) {
            consol.log('a');
            console.log(impPrev);
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
});

