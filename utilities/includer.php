<?php
include_once("config.php");
foreach ($_requiredFiles as $file){
    include_once "$file.php";   
}
