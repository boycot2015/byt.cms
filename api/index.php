<?php
$file= __DIR__ . '/..'.$_SERVER["PHP_SELF"];
if(file_exists($file))
{
   return false;
}
else
{
    require_once __DIR__ . '/../install.php';
}
// echo $_SERVER["PHP_SELF"];
