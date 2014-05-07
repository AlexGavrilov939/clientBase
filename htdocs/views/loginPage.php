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
                        <input type="text" id="login" name="login"/>
                    </div>
                    <div class="formInput">
                        <img src="../assets/img/password.png"/>
                        <input type="password" id="password" name="password"/>
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
                $.post( url, data, function( data ) {
                    console.log(data);
                    if(data == true) {
                        $.post('/login/DBselect', function(data) {
                            $(".loginArea").html(data);
                        });
                    } else {
                        alert('Проверьте введенные данные и попробуйте еще раз!');
                    }
                });
            })
        });
    </script>
    </body>
</html>