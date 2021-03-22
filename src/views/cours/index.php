<div id="pageCours">
    <h1>Phrase d'accroche</h1>

    <div class="listeOutilsCours">
        <button class="outilsCours">Explorer</button>
        <button class="outilsCours">En cours</button>
        <button class="outilsCours">Terminé</button>
    </div>
    <div class="listeCours">
        <!--</*?php /** @var array $courses */
        foreach ($courses as $cours): ?> -->
        <div class="cours">    <!-- <a href="cours/voir/</*?= $cours['slug'] ?>"></*?= $cours['id'] ?></a> -->
        <img class="imageCours" src="https://via.placeholder.com/150">           <!-- <img src"</*?= cours['image-path]?>" > -->
            <div class="descCours">
                <h2>Titre cours correspondant</h2>  <!--<h2></*?= $cours['slug'] ?></h2> -->
                <p>Description du cours</p>         <!--<h2></*?= $cours['desc'] ?></h2> -->
            </div>
        </div>
    </div>
        <!--</*?php endforeach ?> -->
    </div>
</div>
