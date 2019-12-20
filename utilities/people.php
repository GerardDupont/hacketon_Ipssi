<?php

include_once("record.php");

class people extends record{
    public $forname;
    public $lastname;
    public $email;
    public $group;    
    
    public function save(){
        
        if($this->createdOn=="0000-00-00 00:00:00"|| $this->createdOn==null){
            $this->createdOn = date("Y-m-d H:i:s");
        }
        if($this->deletedOn=="0000-00-00 00:00:00"|| $this->deletedOn==null){
            $this->deletedOn = date("Y-m-d H:i:s");
        }
        if($this->modifiedOn=="0000-00-00 00:00:00"|| $this->modifiedOn==null){
            $this->modifiedOn = date("Y-m-d H:i:s");
        }
        if($this->lastCo=="0000-00-00 00:00:00" || $this->lastCo==null){
            
            $this->lastCo = date("Y-m-d H:i:s");
        }
        return parent::save();
    }    
}