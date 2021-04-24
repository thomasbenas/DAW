<form class="form-inputs" action="//<?= HOST . '/' . FOLDER_ROOT ?>/utilisateur/rejoindre" method="post">
    <input name="userName" placeholder="Pseudo" type="text" required />
    <input name="userMail" placeholder="E-mail" type="email" required />
    <input id="password" name="userPassword" placeholder="Mot de passe" type="password" onkeyup='checkPassword();' minlength="7" required />
    <input id="password_confirm" name="userPassword_confirm" placeholder="Confirmer votre mot de passe" type="password" onkeyup='checkPassword();' required />  
    <span class="error_message" id='message_password'></span>
    <?php if(isset($error)): ?>
        <span class="error_message error_form"><i class="far fa-times-circle"></i> <?= $error ?></span>
    <?php endif; ?>
    <input class="button button-validate" id="submit" type="submit" value="Rejoindre">
</form>