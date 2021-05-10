<form class="form-inputs-admin" action="//<?= HOST . '/' . FOLDER_ROOT ?>/admin/ajouter/categorie" method="post">
    <input name="name" placeholder="lien du quiz" type="text" required />
    <div class="form-label">
        <span>Séléctionner une catégorie</span>
        <select name="category" class="select">
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <input class="button button-validate" id="submit" type="submit" value="Ajouter">