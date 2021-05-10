<?php 
$utilisateur->userLogin(htmlspecialchars($_POST['userName']),htmlspecialchars( $_POST['userPassword'])); 
if(isset($_GET['error'])):
    $error = htmlspecialchars($_GET['error']);
else:
?>

<div id="toast"></div>

<script>
    window.onload = function() {
        toastMessage('<i class=\'fas fa-check\'></i> Connexion réussie !', '//<?= HOST . '/' .FOLDER_ROOT ?>/')
    };
</script>

<?php endif; ?>