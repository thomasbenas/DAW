<div class="container">
    <a href="../../admin/quiz" class="goBack"><i class="fas fa-arrow-left"> </i> <span>retour à la gestion des quiz</span></a>

    <div class="form-admin">
        <?php if(!empty($_POST['linkXML']) && !empty($_POST['category'])): ?>
            <?php require_once(ROOT.'src/forms/admin/ajoutQuizAction.php') ?>
        <?php endif; ?>
        <div class="form-head">
            <h3>Ajout d'un Quiz</h3>
        </div>
        <?php require_once(ROOT.'src/forms/admin/ajoutQuizForm.php') ?>
    </div>
</div>

</div>