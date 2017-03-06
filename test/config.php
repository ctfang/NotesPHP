<?php

require_once '../vendor/autoload.php';
function p(...$data)
{
    echo "<xmp>";
    foreach ($data as $value){
        print_r($value);
    }
    echo "</xmp>";
}
\NotesPHP\NotesPHP::setConfig([
    'base_path'=>dirname(__DIR__),
    'save_path'=>dirname(__DIR__).'/runtime/class.php',
    'extension'=>'php',
    'save_type'=>'array',
    ]);

\NotesPHP\NotesPHP::build();

p(\NotesPHP\NotesPHP::getConfig());

p($str = include '../runtime/class.php');

