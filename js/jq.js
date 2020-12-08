/* 
 * jq.js
 * @author Romain Ravault
 * 08/12/2020
 */



$(document).ready(function () {
    $('.same-pwd-checker').css('display', 'none');

    var form = $('.idLogForm');
    var status = 0;
    //Gestion du click sur le text créer un compte avec l'ajout de l'imput de verification du pwd
    $('#authFormChange').click(() => {
        if (status == 0) {
            $('h3').html('<h3>Nouvel utilisateur</h3>');
            $('#authFormChange').html('<p>Revenir à l\'athentification<p>');
//            $('.same-pwd-checker').css('display', '');
            $('.same-pwd-checker').css('display', 'block');
            form.attr('action', 'authentificationCtrl.php?type=id');
            status = 1;
        } else {
            $('h3').html('<h3>Authentification</h3>');
            $('#authFormChange').html('<p>Créer un compte<p>');
//            $('.same-pwd-checker').css('display', '');
            $('.same-pwd-checker').css('display', 'none');
            form.attr('action', 'authentificationCtrl.php?type=log');
            status = 0;
        }
    });

   
//    $('#pwdCheckInput').change(() => {
//        console.log('aa');
//        var pwd = $('.input-pwd');
//        var checkPwd = $('.same-input-pwd-checker');
//        console.log(pwd);
//        console.log(checkPwd);
//        if (pwd == checkPwd) {
//            $('.message').html('<p>Mot de passe identique</p>');
//        } else {
//            $('.message').html('<p>La saisie n\'est pas identique</p>');
//        }
//    });
});

