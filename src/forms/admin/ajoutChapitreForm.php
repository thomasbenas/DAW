<form class="form-inputs-admin" action="//<?= HOST . '/' . FOLDER_ROOT ?>/admin/ajouter/chapitre" method="post">
    <input name="name" placeholder="Nom du chapitre" type="text" required />
    <input name="slug" placeholder="slug du chapitre" type="text" required />
    <input type="hidden" name="lesson" value="<?= $_POST['add_chapter'] ?>" />
    <textarea name="content" rows="8" cols="50" >
Ici le contenu du chapitre...
    </textarea>
    
    <input class="button button-validate" id="submit" type="submit" value="Ajouter">