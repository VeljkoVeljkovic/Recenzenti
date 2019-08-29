<?php if(!empty($poruka)){ ?>
<div class="alert alert-danger justify-content-center mt-2">
    <p><?= $poruka ?></p>
</div>
<?php } ?>

<br>

    <div class="offset-4 col-4 offset-4 mt-2">
        <form name="login" method="POST" action="<?php echo site_url('Login/loginKor')?>">
            Username: <input class="form-control" name="username" type="text"/>
            <br><br>
            Password: <input class="form-control" name="password" type="password"/>
            <br><br>
            <button class="btn ml-5"  type="submit" name="login">Log in</button>
            <br><br>
            <p>
                Niste registrovani? <a class="link" href="<?php echo site_url("/Registration")?>">Registruj se</a>
            </p>
            <p>
                <a class="link" href="<?php echo site_url("/Reset_lozinke")?>">Zaboravili ste lozinku?</a>
            </p>

        </form>

    </div>
