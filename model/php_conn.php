<?php
#region Copyright
//Made by Rick Lugtigheid
#endregion
class CRUD {
    #region[Properties]
    public $conn;//connect this object
    public $table;//the table name
    #endregion
    #region[Methods]
    function __construct($table){//creates a connection to the database
        try{
            $this->table = $table;

            //argument 1 is to connect to the server and find the database
            //the second and third is to verify to php myadmin that you are the admin
            $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

            //the first Attribute will report it to the webpage if something goes wrong
            //the second trows the error to the catch 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //$conn = $handle->query("SELECT * FROM characters ORDER BY `name`");
        }catch(PDOException $e){
            //database conection error
            die("[Database connection error]<br> <br>Error: $e");
        }
    }
    function Create($columns, $values){ 
        if(is_array($columns) && is_array($values) && count($columns) == count($values)){
            //to avoid an infinit loop and -1 because a array begins at 0 but count() gives 4
            $count = count($values)-1;
            
            //create the strings I need
            foreach($columns as $arg){
                $cols .= "$arg, ";
            }
            for($i = 0; $i <= $count; $i++){
                $vals .= ":value$i, ";
            }
            //                                               to replace the last ,                     same here
            $stmt = $this->conn->prepare("INSERT INTO $this->table (".substr_replace($cols ,"",-2).") VALUES (".substr_replace($vals ,"",-2).")");

            //now bind all parameters
            for($a = 0; $a <= $count; $a++){$stmt->bindParam(":value$a", $values[$a]);}

            //insert row into table
            $stmt->execute();
            //echo "inserted";
        }else{
            echo "$columns and/or $values is not an array or are no the same length";
        }
    }
    function Read($callback, $where = null, $is = null){
        //get has 3 options [default, where]
        //we want to select a row in the table
        if($where != null && $is != null){
            $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE $where=:is");
            $stmt->bindParam(":is", $is);
            //now we return the value
            $stmt->execute();
            $data = $stmt;
        }else{
            //else we want to get all rows from table
            $data = $this->conn->query("SELECT * FROM $this->table");
        }
        // the callback gives you all the data from the database
        if($callback != null){
            foreach($data as $value){
                $callback($value);
            }
        }
        return $data;
    }
    function Update($columns, $values, $where, $is){
        //make sure we can set all values
        for($i = 0; $i <= count($columns)-1; $i++){
            $vals .= $columns[$i]."=:val$i, ";
        }
        //                                               to replace the last , 
        $stmt = $this->conn->prepare("UPDATE $this->table SET ".substr_replace($vals ,"",-2)." WHERE $where=:is");
        //now bind the parameters
        for($i = 0; $i <= count($columns)-1; $i++){
            $stmt->bindParam(":val$i", $values[$i]);
        }
        $stmt->bindParam(":is", $is);
        $stmt->execute();
    }
    function Delete($where, $is){
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE $where=:val");
        $stmt->execute([':val' => "$is"]);
    }
    function Order($by){
        return $this->conn->query("SELECT * FROM $this->table ORDER BY $by");
    }
    //column editing
    function columnExists($col_name){
        try{
            $this->conn->query("SELECT $col_name FROM $this->table");
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    function addColumn($col_name, $datatype, $length){
        try{
            $this->conn->query("ALTER TABLE $this->table ADD $col_name $datatype($length)");
        }catch(Exception $e){
            echo "Note: check if your [datatype/length] is valid!<br><br>Error: $e";
        }
    }

    function Drop(){$this->conn = null;}
    #endregion
}
function Sanitize($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripcslashes($data);
    return $data;
}