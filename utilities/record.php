<?php 
abstract class record {
    public $id;
    public $createdOn;
    public $deletedOn;
    public $deleted;
    
    
    public function __construct(){

    }
    
    public function canCreate(){
        return true;
    }
    
    
    public function canDelete(){

    }
    
    public function canUpdate(){
        return true;
    }
    
    public function isDeleted(){
        return $this->deleted;
    }
    public function save(){
        $db = $GLOBALS["db"];
        if(isset($this->id)&&!empty($this->id)){
            if($this->canUpdate()){
                $this->modifiedOn = date("Y-m-d H:i:s");
                $query = $db->constructUpdateQueryFromClass($this);
                $db->makeUpdateQuery($query);
            }
        } else{
            if($this->canCreate()){
                $this->createdOn = date("Y-m-d H:i:s");
                $this->modifiedOn = date("Y-m-d H:i:s");
                $this->deletedOn = date("Y-m-d H:i:s");
                $this->deletedBy = 0;
                $this->deleted =0;
                $query = $db->constructInsertQueryFromClass($this);
                $this->id = $db->makeInsertQuery($query);
            }
        }
    }
    
    public function delete(){
        $db = $GLOBALS["db"];
        if($this->canDelete()){
            $this->deleted = true;
            $this->deletedOn = date("Y-m-d H:i:s");
            $query = $db->constructDeleteQuery($this);
            $db->makeUpdateQuery($query);
        }
    }
    
    
    public function getClassVars(){
        $vars = get_object_vars($this);
        foreach($vars as $k=>$v){
            if($k[0]== "_"|| $k== "id"){
                unset($vars[$k]);
            }
        }
        return $vars;
    }
    
    public function setFromDataBase($values){
        foreach ($values as $k=>$v){
            if(!is_numeric($k)){
                $this->$k = $v;
            }
        }
    }
}