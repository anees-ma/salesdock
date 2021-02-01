<?php
    require_once('connectDb.php');
    require_once('rulingMethods.php');
    
    class productsData {
    	public $product_db;
    	public function __construct(){
    		$this->productDataDb= new productsDataDb;
    	}

        public function getProducts($get){
        	$productData = $this->productDataDb->getProductData($get);
        	echo $productData;
        }
    }

    
    class productsDataDb {  
        public $conn;
        function __construct() {  
            $db = new dbConnection;
            $this->conn=$db->connectDb();
               
        }
        public function getProductData($getData){

            if($getData['input_data']=='all'){
                $query = "SELECT * from products";
            }
            else {
                $extract_input = explode("-",$getData['input_data']);
                $methodName = $extract_input[1];
                $className = $extract_input[0];
                
                $classObj = new $className;
                $selectMethod = call_user_func(array($classObj, $methodName));
                $condition = $selectMethod['condition'];
                $query = 'SELECT * from products '.$condition;
            }
            $qry = mysqli_query($this->conn,$query) or die(mysqli_error($this->conn));
            $products = array();
            while($data_ = mysqli_fetch_assoc($qry)){
              $products[] = $data_;
            }

            $sl_no = 1;
            foreach ($products as $key => $fr) {
                $products[$key]['slNo'] = $sl_no;
                $sl_no++;
            }
            return json_encode($products);
        }

    }

    $productsDataObj = new productsData;
    if($_GET) $productsDataObj->getProducts($_GET);

?>