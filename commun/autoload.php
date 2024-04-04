<?php

function load($className) {
    include_once "$className.php";
}

spl_autoload_register('load');
?>