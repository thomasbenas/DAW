<?php 
    $adminCapacity->addChapter(htmlspecialchars($_POST['lesson']), htmlspecialchars($_POST['name']), htmlspecialchars($_POST['slug']), htmlspecialchars($_POST['content'])); 
?>

<div id="toast"></div>

<script>
    window.onload = function() {
        toastMessage('<i class=\'fas fa-check\'></i> chapitre ajouté !', '//<?= HOST . '/' .FOLDER_ROOT ?>/admin/cours')
    };
</script>