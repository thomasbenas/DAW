<div class="page-nav">
    <div class="page-nav-title"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>">ClosedClassroom</a></div>
    <div class="page-nav-block">
        <div class="page-nav-item"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>/qcm">QCM</a></div>
        <div class="page-nav-item"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>/cours">Cours</a></div>
        <div class="page-nav-item"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>/forum">Forum</a></div>
        <?php if (true): //TODO déterminer si l'utilisateur est connecté ou non?>
            <div class="button-fill"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>/utilisateur/rejoindre">REJOINDRE</a></div>
            <div class="button"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>/utilisateur/connexion">CONNEXION</a></div>
        <?php else: ?>
            <div class="page-nav-item button-img"><a href="#">Profil</a></div>
        <?php endif ?>
    </div>
</div>