<?php 
$utilisateur->UserRegistration(htmlspecialchars($_POST['userName']),htmlspecialchars( $_POST['userPassword']), htmlspecialchars($_POST['userMail'])); 
$utilisateur->userRegistration(htmlspecialchars($_POST['userName']),htmlspecialchars( $_POST['userPassword']), htmlspecialchars($_POST['userMail'])); 
if(isset($_GET['error']))
    $error = htmlspecialchars($_GET['error']);
else{
    $index = 'Location:'. "//" . HOST . "/" . FOLDER_ROOT . "/";
    header($index);
}
?>