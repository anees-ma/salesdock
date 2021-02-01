<?php
  $filepath = 'rulingMethods.php';
  include $filepath;

  $classArray = array();
  $methodsArray = array();
  function file_get_php_classes($filepath) {
    $options = '';
    $php_code = file_get_contents($filepath);
    $classArray = get_php_classes($php_code);
    foreach ($classArray as $key => $value) {
      $method = get_class_methods($value);

      $obj = new $value; 
      foreach ($method as $key_m => $value_m) {

        $select_method = call_user_func(array($obj, $value_m));
              $options .="<option value='".$value."-".$value_m."'>".$select_method['title']."</option>";
      }
    }
    return $options;
  }

  function get_php_classes($php_code) {
    $classes = array();
    $tokens = token_get_all($php_code);
    $count = count($tokens);
    for ($i = 2; $i < $count; $i++) {
      if (   $tokens[$i - 2][0] == T_CLASS
          && $tokens[$i - 1][0] == T_WHITESPACE
          && $tokens[$i][0] == T_STRING) {

          $class_name = $tokens[$i][1];
          $classes[] = $class_name;
      }
    }
    return $classes;
  }
  $selOptions = file_get_php_classes($filepath);

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title></title>
      
      <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
      
      <link href="css/style.css" rel="stylesheet" media="all">
   </head>
   <body id="body">
      <div class="page-wrapper bg-grey p-t-100 p-b-100 font-robo">

         <div class="container table-container">
            <select style="" id="productFilter">
              <option value="all">All</option>
              <?php
                 echo $selOptions;
              ?>
            </select>
            <div class="text-center">
               <h1 class="py-3">Products</h1>
               
            </div>
            <div class="row table-row">
               
               <div class="table-responsive">
                  
                  <table class="table">
                     <thead>
                        <tr>
                        <th>Sl. No</th>
                        <th>Product Name</th>
                        <th>Upload Speed</th>
                        <th>Download Speed</th>
                        <th>Technology</th>
                        <th>Static IP</th>
                        </tr>
                     </thead>
                     <tbody id="table-data">
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script>
        function getProducts(filterInput) {
          var input = filterInput;
           $.ajax({
            url: 'getProducts.php',
            type: 'GET',
            data: {
              'input_data': input
            },
            dataType: 'json',
            success: function(res) {
              let table_data = '';
              $.each(res, function( index, value ) {
                table_data += '<tr><td>'+value.slNo+'</td><td>'+value.productName+'</td><td>'+value.uploadSpeed+'</td><td>'+value.downloadSpeed+'</td><td>'+value.technology+'</td><td>'+value.staticIp+'</td></tr>';
              });
              $('#table-data').html(table_data);
            },
            error: function(jqXHR, exception) {
              
            },
          });

       }

        $('#productFilter').on('change',function(){
            getProducts($(this).val());
        });
        getProducts('all');
      </script>
   </body>
</html>
