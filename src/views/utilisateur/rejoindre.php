<div class="panel">
    <div class="aside">
        <img src="../assets/images/idea.svg" alt="">
        <span><i>Les salles de classe sont fermées... pas nous !</i></span>
    </div>
    <div class="form">
        <?php if(!empty($_POST['userName']) && !empty($_POST['userPassword'])): ?>
            <?php require_once(ROOT.'src/views/utilisateur/rejoindreAction.php') ?>
        <?php else: ?>
            <div class="form-head">
                <h3>Rejoindre</h3>
                <img src="../assets/images/blog.svg" alt="">
            </div>
            <?php require_once(ROOT.'src/views/utilisateur/rejoindreForm.php') ?>
        <?php endif; ?>
    </div>
</div>