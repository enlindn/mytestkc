<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!--    css here    -->
        <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

        <link href="css/login.css" rel="stylesheet">
        <title>Login</title>
    </head>

    <body class=" lime lighten-3">
        <div id="login-box">
            <div class="card-panel center">
                <div class="row">
                    <form action="php/doAction.php?act=login" method="post" class="col s12">
                        <div class="input-field col s12">
                            <i class="mdi-action-account-circle prefix"></i>
                            <input id="icon_username" name="username" type="text" class="validate">
                            <label for="icon_username">User Name</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="icon_password" name="password" type="password" class="validate">
                            <label for="icon_password">Password</label>
                        </div>
                        <div class="col s12 divider">
                        </div>
                        <div class="col s6 cen">
                            <a id="login-in" type="submit" class="btn waves-effect waves-light blue">Login In</a>
                        </div>
                        <div class="col s6">
                            <a href="#login-help-modal" class="modal-trigger waves-effect waves-green btn-flat blue-text text-lighten-2">Help</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div id="login-help-modal" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h4>Login Help</h4>
                <p>Call me!</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">OK</a>
            </div>
        </div>
 
      
        <!--    script here -->
        <script type="text/javascript" src="jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
        <script type="text/javascript" src="js/login.js"></script>
    </body>
</html>
