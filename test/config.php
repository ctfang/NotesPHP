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
$path = dirname(__DIR__);
\NotesPHP\NotesPHP::setConfig(['base_path'=>$path]);
\NotesPHP\NotesPHP::build();