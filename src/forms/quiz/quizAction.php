<?php if(isset($_POST['validerQuiz'])): $total = 0; ?>
    <?php foreach ($_POST as $key => $value)
        if (isset($key) and $key != "validerQuiz")
            $total += $value;
    ?>

    <p>Votre score est de <?= $total ?>.</p>

<?php endif; ?>