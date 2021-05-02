<?php include(ROOT.'src/core/utils/textFormatting.php') ?>

<div class="container">
    <a href="../admin" class="goBack"><i class="fas fa-arrow-left"></i> <span>retour au panel</span></a>

    <h3>Gestion des cours</h3>

    <div class="table table-courses">
        <div class="table-head">
            <div class="table-head-item">Nom</div>
            <div class="table-head-item">Auteur</div>
            <div class="table-head-item">Publication</div>
            <div class="table-head-item">Difficulté</div>
            <div class="table-head-item">Catégorie</div>
            <div class="table-head-item">Action</div>
        </div>
        <?php foreach ($courses as $course): ?>
        <div class="table-row">
            <div class="table-row-item"><?= $course['name'] ?></div>
            <div class="table-row-item"><?= $course['author'] ?></div>
            <div class="table-row-item"><?= dateInFrenchFormat($course['date_publication']); ?></div>
            <div class="table-row-item"><?= $course['difficulty'] ?></div>
            <div class="table-row-item"><?= $course['category'] ?></div>
            <div class="table-row-item-button">
                <button class="button-action"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>/cours/voir/<?= $course['slug'] ?>">Voir</a></button>
                <form action="//<?= HOST . '/' .FOLDER_ROOT ?>/admin/ajouter/chapitre" method="post">
                    <button class="button-action" type="submit" name="add_chapter" value="<?= $course['id'] ?>">Ajouter un chapitre</button>
                    <input type="hidden" name="course_name" value="<?= $course['name']?>"/>
                </form>
               <form method="post"> 
                    <button class="button-danger" type="submit" name="delete_course" value="<?= $course['id'] ?>">Supprimer</button>
               </form>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    
    <button class="button-action"><a href="//<?= HOST . '/' .FOLDER_ROOT ?>/admin/ajouter/cours">Ajouter un cours</a></button>
 
    <?php
        if(isset($_POST['delete_course'])){
            $id_course = htmlspecialchars($_POST['delete_course']);
            $adminCapacity->deleteCourse($id_course);
        } 
    ?>
</div>