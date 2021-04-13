<form class="form-inputs" action="//<?= HOST . '/' . FOLDER_ROOT ?>/utilisateur/rejoindre" method="post">
    <input name="userName" placeholder="Pseudo" type="text" required />
    <input name="userMail" placeholder="E-mail" type="email" required />
    <input id="password" name="userPassword" placeholder="Mot de passe" type="password" onkeyup='checkPassword();' required />
    <input id="password_confirm" name="userPassword_confirm" placeholder="Confirmer votre mot de passe" type="password" onkeyup='checkPassword();' required />  
    <span id='message_password'></span>
    <input class="button button-validate" id="submit" type="submit" value="Rejoindre">
</form>