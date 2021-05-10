<?php
$adminCapacity->addCategory(htmlspecialchars($_POST['name']),  htmlspecialchars($_POST['description']) ,htmlspecialchars($_POST['slug']));
?>

<div id="toast"></div>

<script>
    window.onload = function() {
        toastMessage('<i class=\'fas fa-check\'></i> Catégorie créée !', '//<?= HOST . '/' .FOLDER_ROOT ?>/admin/categories')
    };
</script>
