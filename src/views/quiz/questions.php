<?php
$xmlstr = <<<XML
<?xml version='1.0' standalone='yes'?>
<quiz>
    <question numero='question1'>
        <libelle>Quelle balise permet de sauter 
        une ligne ?</libelle>
        <reponse point="0">head</reponse>
        <reponse point="1">br</reponse>
        <reponse point="0">footer</reponse>
    </question>

    <question numero='question2'>
        <libelle>En PHP, quelle symbole faut-il 
        utiliser pour la déclaration de variable ?</libelle>
        <reponse point="1">$</reponse>
        <reponse point="0">*</reponse>
        <reponse point="0">_</reponse>
    </question>
</quiz>
XML;
?>