<div class="page-nav">
    <div class="page-nav-title">ClosedClassroom</div>
    <div class="page-nav-block">
        <div class="page-nav-item"><a href="#">QCM</a></div>
        <div class="page-nav-item"><a href="#">Cours</a></div>
        <div class="page-nav-item"><a href="#">Forum</a></div>
        <?php if (true): //TODO déterminer si l'utilisateur est connecté ou non?>
            <div class="page-nav-item button"><a href="#">Rejoindre</a></div>
            <div class="page-nav-item button"><a href="#">Connexion</a></div>
        <?php else: ?>
            <div class="page-nav-item button-img"><a href="#">Profil</a></div>
        <?php endif ?>
    </div>
</div>