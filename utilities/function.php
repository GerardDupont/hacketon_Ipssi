<?php 
$db = new dataBase($DBHOST,$DBLOGIN,$DBPASSWD,$DBCHARSET,$DBNAME);



/**
 * Create an empty user
 * @return people
 */
function createEmptyPoeple(){
    $newPoeple = new people();
    $newPoeple->save();
    return $newPoeple;
}


function getAllUser(){
    $res = $GLOBALS["db"]->makeQuery("SELECT * FROM people WHERE deleted=0");
    $peoples = array();
    foreach($res as $datapeople){
        $temp = new people();
        $temp->setFromDataBase($datapeople);
        $peoples[]=$temp;
    }
    return $peoples;
}

function getAllGroup(){
    
}

function getUserFromGroup($group){
    $res = $GLOBALS["db"]->makeQuery("SELECT * FROM people WHERE deleted=0 AND group = $group");
    $peoples = array();
    foreach($res as $datapeople){
        $temp = new people();
        $temp->setFromDataBase($datapeople);
        $peoples[]=$temp;
    }
    return $peoples;
    
}


