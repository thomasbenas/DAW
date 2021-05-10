<div class="container">
    <a href="../../admin/cours" class="goBack"><i class="fas fa-arrow-left"> </i> <span>retour à la gestion des cours</span></a>

    <div class="form-admin">
        <?php if(!empty($_POST['name']) && !empty($_POST['slug'])): ?>
            <?php require_once(ROOT.'src/forms/admin/ajoutCoursAction.php') ?>
        <?php endif; ?>
        <div class="form-head">
            <h3>Ajout d'un cours</h3>
        </div>
        <?php require_once(ROOT.'src/forms/admin/ajoutCoursForm.php') ?>  
    </div>
</div>

</div>