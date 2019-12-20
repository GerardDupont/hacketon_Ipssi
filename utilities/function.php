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
    $res = $GLOBALS["db"]->makeQuery("SELECT * FROM user WHERE deleted=0");
    $peoples = array();
    foreach($res as $datapeople){
        $temp = new people();
        $temp->setFromDataBase($datapeople);
        $peoples[]=$temp;
    }
    return $peoples;
}

/**
 * find all the groups that already exist
 */
function getAllGroup(){
    
}

/** 
 * Return all the people of a $group 
 * @param string $group
 * @return people[]
 */
function getPeopleFromGroup($group){
    $res = $GLOBALS["db"]->makeQuery("SELECT * FROM user WHERE deleted=0 AND group = $group");
    $peoples = array();
    foreach($res as $datapeople){
        $temp = new people();
        $temp->setFromDataBase($datapeople);
        $peoples[]=$temp;
    }
    return $peoples;
    
}

/**
 * This function permit to know if somebody can be added to a groupe
 * @param string $group
 * @return boolean
 */
function isThisGroupFull($group){
    $peoples = getUserFromGroup($group);
    return count($peoples)<6;
}


