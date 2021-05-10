<?php
    if(isset($_POST['delete_user'])){
        $id_user = htmlspecialchars($_POST['delete_user']);
        $adminCapacity->deleteUser($id_user);
    }

    if(isset($_POST['update_role'])):  
        $user_role = htmlspecialchars($_POST['user_role']);  
?>
        <form action="" method="post">
            <span><?= $user_role ?> <i class="fas fa-arrow-right"> </i></span>
            <select name="id_role" class="select">
                <?php foreach ($roles as $role): 
                    if($role['name'] != $user_role):?>
                        <option value="<?= $role['id'] ?>"><?= $role['name'] . ' [' . $role['description'] . ']'?></option>
                <?php endif; endforeach; ?>
            </select>
            
            <input type="hidden" name="id_user" value="<?= $_POST['update_role'] ?>" />
            <button class="button-danger admin-update-role" type="submit" name="update_role_confirmed" value="yes">changer le rôle</button>
        </form>
    <?php endif; ?>

    <?php
        if(isset($_POST['update_role_confirmed'])){
            $id_user = htmlspecialchars($_POST['id_user']);
            $id_role = htmlspecialchars($_POST['id_role']);
            $adminCapacity->updateRole($id_user, $id_role);
        }
    ?>       
    
<?php if(isset($_GET['error'])): $error = htmlspecialchars($_GET['error']);?>
    <span class="error_message error_admin"><i class="far fa-times-circle"></i> <?= $error ?></span>
<?php endif; ?>



    

        