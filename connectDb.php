<?php  
    class dbConnection { 
        public $conn;
        public function connectDb(){
            $this->conn = mysqli_connect('localhost', 'root', ''); 
            mysqli_select_db($this->conn,'salesdock');  
            if(!$this->conn)
            {  
                die ("failed to connect to the database");  
            }  
             
            return $this->conn; 
        } 
        public function Close(){  
            mysqli_close();  
        }  
    }
?>  