<?php 
$utilisateur->userRegistration(htmlspecialchars($_POST['userName']),htmlspecialchars( $_POST['userPassword']), htmlspecialchars($_POST['userMail'])); 
if(isset($_GET['error']))
    $error = htmlspecialchars($_GET['error']);
?>

<div id="toast"></div>

<script>
    window.onload = function() {
        LoginLogoutMessage('<i class=\'fas fa-check\'></i> Connexion réussie !')
    };
</script>