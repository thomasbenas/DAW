<form class="form-inputs-admin" action="//<?= HOST . '/' . FOLDER_ROOT ?>/admin/ajout/cours" method="post">
    <input name="name" placeholder="Nom du cours" type="text" required />
    <input name="slug" placeholder="slug du cours" type="text" required />
    <div class="form-label">
        <span>Séléctionner une difficulté</span>
        <select name="difficulty" class="select">
            <?php foreach ($difficulties as $difficulty): ?>
                <option value="<?= $difficulty['id'] ?>"><?= $difficulty['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-label">
        <span>Séléctionner une catégorie</span>
        <select name="categorie" class="select">
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= $categorie['id'] ?>"><?= $categorie['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <textarea name="summary" rows="8" cols="50" >
Ici le résumé du cours...
    </textarea>
    
    <input class="button button-validate" id="submit" type="submit" value="Ajouter">
</form>