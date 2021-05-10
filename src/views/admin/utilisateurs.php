<?php include(ROOT.'src/core/utils/textFormatting.php') ?>

<div class="container">
    <a href="../admin" class="goBack"><i class="fas fa-arrow-left"></i> <span>retour au panel</span></a>

    <h3>Gestion des utilisateurs</h3>

    <div class="table table-users">
        <div class="table-head">
            <div class="table-head-item">Pseudo</div>
            <div class="table-head-item">Mail</div>
            <div class="table-head-item">Date d'adhésion</div>
            <div class="table-head-item">Rôle</div>
            <div class="table-head-item">Action</div>
        </div>
        <?php foreach ($users as $user): ?>
        <div class="table-row">
            <div class="table-row-item"><?= $user['username'] ?></div>
            <div class="table-row-item"><?= $user['mail'] ?></div>
            <div class="table-row-item"><?= dateInFrenchFormat($user['date_registration']); ?></div>
            <div class="table-row-item"><?= $user['role'] ?></div>
            <div class="table-row-item-button">
               <form method="post">
                    <button class="button-danger" type="submit" name="delete_user" value="<?= $user['id'] ?>">Supprimer</button>
                    <input type="hidden" name="user_role" value="<?= $user['role']?>"/>
                    <button class="button-danger" type="submit" name="update_role" value="<?= $user['id'] ?>">Gérer les rôles</button>
               </form>
            </div>
        </div>
        <?php endforeach ?>
    </div>   
    <?php require_once(ROOT.'src/forms/admin/utilisateursAction.php') ?>  
</div>