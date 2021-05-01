<?php if(isset($_POST['validerQuiz'])): $total = 0; ?>
    <?php foreach ($_POST as $key => $value)
        if (isset($key) and $key != "validerQuiz")
            $total += $value;
    ?>

    <div id="toast"></div>

    <script>
        window.onload = function() {
            ToastWithoutRediction('Votre score est de <?= $total . "/" . $numberQuestions ?>');
            correctionQCM();
        };
    </script>

<?php $quizProcess-> updateAbilityUser($total, $quizs['categoryNumber']); endif; ?>