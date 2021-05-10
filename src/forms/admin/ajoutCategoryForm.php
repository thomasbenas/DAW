<form class="form-inputs-admin" action="//<?= HOST . '/' . FOLDER_ROOT ?>/admin/ajouter/categorie" method="post">
    <input name="name" placeholder="Nom de la catégorie" type="text" required />
    <input name="slug" placeholder="slug de la catégorie" type="text" required />
    <textarea name="description" rows="8" cols="50" >Ici la description de la catégorie...</textarea>

    <input class="button button-validate" id="submit" type="submit" value="Ajouter">