<?php
$adminCapacity->addQuiz(htmlspecialchars($_POST['LinkXML']),  htmlspecialchars($_POST['category']));
?>

<div id="toast"></div>

<script>
    window.onload = function() {
        toastMessage('<i class=\'fas fa-check\'></i> Quiz ajouté !', '//<?= HOST . '/' .FOLDER_ROOT ?>/admin/quiz')
    };
</script>