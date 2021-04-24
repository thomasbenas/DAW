<div class="container">
    <h2>Panel administration</h2>
    <div class="overview">
        <a href="//<?= HOST . '/' .FOLDER_ROOT ?>/admin/utilisateurs" class="overview-square">
            <span class="overview-square-data"><?php echo (isset($usersCount)) ? $usersCount : "?"; ?></span>
            <img src="//<?= HOST . '/' .FOLDER_ROOT ?>/assets/images/users.svg" alt="">
            <h3 class="overview-square-title">UTILISATEURS</h3>
        </a>
        <a href="//<?= HOST . '/' .FOLDER_ROOT ?>/admin/cours" class="overview-square">
            <span class="overview-square-data"><?php echo (isset($coursCount)) ? $coursCount : "?"; ?></span>
            <img src="//<?= HOST . '/' .FOLDER_ROOT ?>/assets/images/courses.svg" alt="">
            <h3 class="overview-square-title">COURS</h3>
        </a>
        <a href="#" class="overview-square">
            <span class="overview-square-data"><?php echo (isset($categoriesCount)) ? $categoriesCount : "?"; ?></span>
            <img src="//<?= HOST . '/' .FOLDER_ROOT ?>/assets/images/categories.svg" alt="">
            <h3 class="overview-square-title">CATEGORIES</h3>
        </a>
        <a href="#" class="overview-square">
            <span class="overview-square-data"><?php echo (isset($qcmCount)) ? $qcmCount : "?"; ?></span>
            <img src="//<?= HOST . '/' .FOLDER_ROOT ?>/assets/images/qcm.svg" alt="">
            <h3 class="overview-square-title">QCM</h3>
        </a>
    </div>
</div>