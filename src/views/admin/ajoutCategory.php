<div class="container">
    <a href="../../admin/categories" class="goBack"><i class="fas fa-arrow-left"> </i> <span>retour à la gestion des categories</span></a>

    <div class="form-admin">
        <?php if(!empty($_POST['name']) && !empty($_POST['slug'])): ?>
            <?php require_once(ROOT.'src/forms/admin/ajoutCategoryAction.php') ?>
        <?php endif; ?>
        <div class="form-head">
            <h3>Ajout d'une categorie</h3>
        </div>
        <?php require_once(ROOT.'src/forms/admin/ajoutCategoryForm.php') ?>
    </div>
</div>

</div>
