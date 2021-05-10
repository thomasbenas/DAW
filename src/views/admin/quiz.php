<div class="container">
    <a href="../admin" class="goBack"><i class="fas fa-arrow-left"></i> <span>retour au panel</span></a>

    <h3>Gestion des Quiz</h3>

    <div class="table table-courses">
        <div class="table-head">
            <div class="table-head-item">Lien</div>
            <div class="table-head-item">Date d'ajout</div>
            <div class="table-head-item">Categorie</div>
            <div class="table-head-item">Action</div>
        </div>
        <?php foreach ($quizs as $quiz): ?>
            <div class="table-row">
                <div class="table-row-item">assets/xml/<?= $quiz['linkXML'] ?></div>
                <div class="table-row-item"><?= $quiz['date_published'] ?></div>
                <div class="table-row-item"><?= $quiz['category_name'] ?></div>
                <div class="table-row-item-button">
                    <form method="post">
                        <button class="button-danger" type="submit" name="delete_quiz" value="<?= $quiz['linkXML'] ?>">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <button class="button-action"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>/admin/ajouter/quiz">Ajouter un quiz</a></button>

    <?php
    if(isset($_POST['delete_category'])){
        $id_quiz = htmlspecialchars($_POST['delete_quiz']);
        $adminCapacity->deletequiz($id_quiz);
    }
    ?>
</div>