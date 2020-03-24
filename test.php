<?php

include 'TranslateY.php';

$api_key = ''; //api key yandex
$text = urldecode('one two three');

$yandex = new TranslateY($api_key);

echo $result = $yandex->translate($text, 'ru'); //autodetect lang
