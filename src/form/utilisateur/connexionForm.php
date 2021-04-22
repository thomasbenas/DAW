<form class="form-inputs" action="//<?= HOST . '/' . FOLDER_ROOT ?>/utilisateur/connexion" method="post">
    <input name="userName" placeholder="Pseudo" type="text" required />
    <input name="userPassword" placeholder="Mot de passe" type="password" required />
    <?php if(isset($error)): ?>
        <span class="error_message"><i class="far fa-times-circle"></i> <?= $error ?></span>
    <?php endif; ?>
    <input class="button button-validate" id="submit" type="submit" value="Se connecter">
</form>