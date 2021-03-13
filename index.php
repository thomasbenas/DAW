<?php

define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'app/Model.php');
require_once(ROOT.'app/Conroller.php');