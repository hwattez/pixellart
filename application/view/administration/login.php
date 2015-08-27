
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-lock"></i> Authentification </h3>
            </div>
            <div class="panel-body">
                
                <form role="form" action="/administration/login/" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <input value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''; ?>" type="text" class="form-control" placeholder="Votre nom d'utilisateur" name="login" id="login" autofocus>
                        </div>
                        <div class="form-group">
                            <input value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" type="password" class="form-control" placeholder="Votre mot de passe" name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-lg btn-success btn-block">Se connecter</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>