<?php
include_once '../utilities/includer.php';

if(!isset($_POST["data"]))
{
    throw new Exception("Erreur de saisie du nom");
    //     header("location: ../connection.php?err=1");
}
$data = $_POST["data"];
if(isset($_POST["group"])){
    $group = $_POST["group"];
}
foreach($data as $d){
    if(isset($group)){
        $d["group"] = $group;
    }
    if(!isThisGroupFull($d["group"])){
        $people = new people();
        $people->forname = $d["forname"];
        $people->lastname = $d["lastname"];
        $people->group = $d["group"];
        $people->mail = $d["mail"];
        $people->promo = $d["promo"];
        $people->save();
    }
}
header("location: ../index.php?info=1");
