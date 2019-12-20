<?php
include_once '../utilities/includer.php';

$people = getPeopleById($_GET["id"]);
if($people->canDelete()){
    $people->delete();
}
header("location: ../index.php?info=1");
