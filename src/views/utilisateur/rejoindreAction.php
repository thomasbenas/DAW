<?php $utilisateur->UserRegistration(htmlspecialchars($_POST['userName']),htmlspecialchars( $_POST['userPassword']), htmlspecialchars($_POST['userMail'])); ?>

<h2>Bienvenue parmis nous <i class="fas fa-star"></i> <?= $_POST['userName'] ?> <i class="fas fa-star"></i> </h2>