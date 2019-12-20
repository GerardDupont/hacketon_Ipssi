<?php 

/**
 * This object is used to communicate with the database and to handle the PDO connection
 * @author antoine.balannec@gmail.com
 *
 */
class dataBase{
    
    private $connect;
    private $host;
    private $login;
    private $passwd;
    private $charset;
    private $bname;
    public function __construct($DBHOST,$DBLOGIN,$DBPASSWD,$DBCHARSET,$DBNAME){
        $this->host = $DBHOST;
        $this->login = $DBLOGIN;
        $this->passwd = $DBPASSWD;
        $this->charset = $DBCHARSET;
        $this->bname = $DBNAME;
        
        $this->engageConnectionToTheServer();
    }
    
    /**
     * This function engage the connection to the server  
     */
    public function engageConnectionToTheServer(){
        try {
            $this->connect = new PDO("mysql:host=$this->host;dbname=$this->bname;charset=$this->charset", $this->login, $this->passwd,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        } catch (PDOException $e) {
            echo '�chec de la connexion : ' . $e->getMessage();
            exit;
        }
    }
    
    /** 
     * Returns the values of an specific id in the table user 
     * This values can build a user object
     * @param int $id
     * @throws Exception
     * @return array
     */
    public function getPoepleDatasFromDB($id){
        try {
            $req = $this->connect->prepare('SELECT * FROM `people` WHERE id = :identifiant');
            $req->execute(array(
                'identifiant'=>$id
            ));
        } catch (PDOException $e) {
            echo 'echec de la connexion : ' . $e->getMessage();
            exit;
        }
        
        $resultat = $req->fetch();
        if(!$resultat){
            throw new Exception("Il y a une erreur dans la query");
        }
        return $resultat;
    }
    
   
    /**
     * Make an update query 
     * @param String $query
     * @return boolean
     */
    public function makeUpdateQuery($query){
        $req = $this->connect->prepare($query);
        $res = $req->execute();
        return $res;
    }
    
    /**
     * Make the query and return the values in an array 
     * @param String $query
     * @return array
     */
    public function makeQuery($query){
        $req = $this->connect->prepare($query);
        $req->execute();
        $resultat = $req->fetchAll();
        return $resultat;
    }
    
    
    /**
     * Make the insert query and return the last insert id
     * @param String $query
     * @return int
     */
    public function makeInsertQuery($query){
        $req = $this->connect->prepare($query);
        $req->execute();
        return $this->connect->lastInsertId();
    }
    
    public function constructUpdateQueryFromClass(record $obj){
        $values = $obj->getClassVars();
        $query = "UPDATE `".get_class($obj)."` SET ";
        foreach($values as $k=>$v){
            $query .= " `$k` = '$v',";
        }
        $query = rtrim($query,',');
        $query .= " WHERE `id`=$obj->id";
        return $query;   
    }
    
    public function constructInsertQueryFromClass(record $obj){
        $values = $obj->getClassVars();
        $firstPart = "INSERT INTO `".get_class($obj)."` ( `id`,";
        $lastPart = " VALUES (NULL,"; 
        foreach($values as $k=>$v){
            $firstPart .= " `$k`,";
            $lastPart .= "'$v',";
        }
        $firstPart = rtrim($firstPart,',');
        $firstPart .= ")";
        $lastPart = rtrim($lastPart,',');
        $lastPart .= ")";
        return $firstPart.$lastPart;
    }
    
    public function constructDeleteQuery(record $obj){
        $query = "UPDATE `".get_class($obj)."` SET
                        `deletedOn`= NOW(),
                        `deletedBy` = '$obj->deletedBy',
                        `deleted` = 1
                        WHERE `id` = $obj->id";
        
        return $query;
    }
}
