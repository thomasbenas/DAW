<div class="container">
    <h2>Quiz web</h2>
    <form action="http://localhost/DAW/quiz" method="post" class="quiz">
    <?php
        include 'questions.php';
        $quizXML = new SimpleXMLElement($xmlstr);
        $quizz = simplexml_load_file(HOST . '/' .FOLDER_ROOT.'/src/views/quiz/example.xml');
        var_dump($quizz);
        print(HOST . '/' .FOLDER_ROOT.'/src/views/quiz/example.xml');
        $numberQuestions = 0;
        foreach($quizXML->question as $question):
            $numberQuestions++;?>
            <div class="blockQuestion">
                <div class="question"><?='Question ' . $numberQuestions . " : " . $question->libelle?></div>
                <?php foreach($question->reponse as $reponse) :?>
                    <div class="reponse"><input required type="radio" name="<?= $question['numero']?>"
                    value="<?=$reponse['point']?>"><?=$reponse?></div>
                <?php endforeach?>
            </div>
        <?php endforeach ?>

        <input class="button-fill" type="submit" name="submit" value="Terminer le quiz">
    </form>
</div>

