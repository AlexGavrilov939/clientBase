<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../assets/css/reset.css"/>
        <link type="text/css" rel="stylesheet" href="../assets/css/theme.css"/>
        <link type="text/css" rel="stylesheet" href="../assets/css/fonts.css"/>
        <link type="text/css" rel="stylesheet" href="../assets/css/upload.css"/>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"  type="text/javascript"></script>
    </head>
    <body>
        <div class="loginArea">
            <div id="formWrapper">
                <form id="loginForm" method="post" action="/login/signin">
                    <span class="formTitle">Login form</span>

                    <div class="formInput">
                        <img src="../assets/img/login.png"/>
                        <input type="text" id="login" name="login" placeholder="login"/>
                    </div>
                    <div class="formInput">
                        <img src="../assets/img/password.png"/>
                        <input type="password" id="password" name="password" placeholder="password"/>
                    </div>
                    <div class="formSubmit">
                        <input type="submit" id="submit" value="sign in"/>
                    </div>

                </form>
            </div>
        </div>
    <script>
        $( document).ready(function () {
            $('form#loginForm').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');

                $.post( url, data, function( responseMsg ) {

                    if( responseMsg == 'ok') {
                        getDbSelectForm();
                    } else {
                        alert('Проверьте введенные данные!');
                    }
                });
            });

            function getDbSelectForm() {
                $.post('/login/dbSelect', function success(data) {
                    $("#formWrapper").html(data);
                })
            }
        });
    </script>
    </body>
</html>