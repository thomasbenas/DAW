<?php 
    $adminCapacity->addCourse(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['slug']), htmlspecialchars($_POST['difficulty']), htmlspecialchars($_POST['category']), htmlspecialchars($_POST['summary'])); 
?>

<div id="toast"></div>

<script>
    window.onload = function() {
        toastMessage('<i class=\'fas fa-check\'></i> Cours créé !', '//<?= HOST . '/' .FOLDER_ROOT ?>/admin/cours')
    };
</script>
