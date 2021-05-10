<div class="container">
    <a href="../admin" class="goBack"><i class="fas fa-arrow-left"></i> <span>retour au panel</span></a>

    <h3>Gestion des Categories</h3>

    <div class="table table-courses">
        <div class="table-head">
            <div class="table-head-item">Nom</div>
            <div class="table-head-item">Slug</div>
            <div class="table-head-item">Description</div>
            <div class="table-head-item">Action</div>
        </div>
        <?php foreach ($categories as $categorie): ?>
            <div class="table-row">
                <div class="table-row-item"><?= $categorie['name'] ?></div>
                <div class="table-row-item"><?= $categorie['slug'] ?></div>
                <div class="table-row-item"><?= $categorie['description'] ?></div>
                <div class="table-row-item-button">
                    <form method="post">
                        <button class="button-danger" type="submit" name="delete_category" value="<?= $categorie['id'] ?>">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <button class="button-action"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>/admin/ajouter/categorie">Ajouter une categorie</a></button>

    <?php
    if(isset($_POST['delete_category'])){
        $id_category = htmlspecialchars($_POST['delete_category']);
        $adminCapacity->deleteCategory($id_category);
    }
    ?>
</div>
