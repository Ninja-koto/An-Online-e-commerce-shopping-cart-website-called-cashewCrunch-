<?php
class DBController {
    private $host = "fdb17.awardspace.net";
    private $user = "2326010_cashewcrunch";
    private $password = "qwertyytrewq123";
    private $database = "2326010_cashewcrunch";
    private $connection = "";
    
    function __construct() {
        $conn = $this->connectDB();
        $this->connection = $conn;
    }
    
    function connectDB() {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
              if($conn === false) {
                echo "Connect error";
    // Handle error - notify administrator, log to a file, show an error screen, etc.
            return mysqli_connect_error(); 
}
else {
        return $conn;
    }
    }
    
    function runQuery($query) {
        $result = mysqli_query($this->connection,$query);
        if (!$result) {
        echo 'MySQL Error: ' . mysqli_error();
        exit;
    }
        while($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }       
        if(!empty($resultset))
            return $resultset;
    }
    
    function numRows($query) {
        $result  = mysqli_query($this->connection,$query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;   
    }
    function mysql() {
      $idforincrement = mysqli_insert_id($this->connection);
        return $idforincrement;
    }
}
?>