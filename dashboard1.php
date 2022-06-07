<?php

require 'connection.php';  

$modelData;

$modal=false;


if(isset($_POST['delete'])){
    
    $id = $_POST['id'];
    
    $date = date("Y-m-d H:i:s");
    
    $deleteSqlQuery = "UPDATE products SET deleted_at='$date' WHERE id='$id'";
    
    if($con->query($deleteSqlQuery)){
        
    }
}




if(isset($_POST['edit'])){
    
    $id= $_POST['id'];
    
    $editSqlQuery = "SELECT * FROM products WHERE id='$id'";
    
    $editResult = $con->query($editSqlQuery);
    
    if($editResult-> num_rows ==1){
        
        $modelData= $editResult-> fetch_assoc();
        
       $modal=true;
        
        //echo $row['product_name'];
        
    }
}


if(isset($_POST['edit_product'])){
    
    $p_name=$_POST['p_name'];
    $p_price=$_POST['p_price'];
    $p_description=$_POST['p_description'];
    $p_rating=$_POST['p_rating'];
    
    $id=$_POST['id'];
    
    $updateProductDataSqlQuery = "UPDATE products SET product_name='$p_name' ,product_price='$p_price' , product_description='$p_description' ,product_rating='$p_rating' WHERE id='$id' ";
    
    
    
    if($con->query($updateProductDataSqlQuery)){
        echo 'data updated';
    }else{
        echo 'error';
    }
    
    
}


$baseurl= "https://prototype.analogenterprises.com/uol/";
$mysqlQuery = "SELECT * FROM products";

$result= $con->query($mysqlQuery);




?>

<html>
    <head>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
 
        <script type="text/javascript" src="js/jquery-3.6.0.js">
            
        </script>
    </head>
    <body>
        <table class="table table-striped table-dark">
            <thead>
                <th>ID</th>
                <th>product_image</th>
                <th>product_name</th>
                <th>product_price</th>
                <th>product_description</th>
                <th>product_rating</th>
                <th>update</th>
                <th>delete</th>
            </thead>
            <?php
                if($result-> num_rows >0){
                    
                    while ($row= $result -> fetch_assoc()){
                         
                         if($row['deleted_at']==NULL){
                             echo '<tr>';
                             echo '<td>'.$row['id'].'</td>';
                             echo '<td><img class="h-100 w-100" src="'.$baseurl.$row['product_image'].'"></td>';
                             echo '<td>'.$row['product_name'].'</td>';
                             echo '<td>'.$row['product_price'].'</td>';
                             echo '<td>'.$row['product_description'].'</td>';
                             echo '<td>'.$row['product_rating'].'</td>';
                             
                             echo '<td>
                                <form action="dashboard1.php" method="POST">
                                    <input type="hidden" name="id" value="'.$row['id'].'">
                                    <input type="submit" name="edit" value="Edit" class="btn btn-primary">
                                </form>
                             </td>';
                             
                             echo '<td>
                                <form action="dashboard1.php" method="POST">
                                    <input type="hidden" name="id" value="'.$row['id'].'">
                                    <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                                </form>
                             </td>';
                             
                             echo '</tr>';
                         }
                    }
                    
                    
                
                }
            
            
            
            ?>
        </table>
        
        
        <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                <form class="row g-3" action="dashboard1.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo$modelData['id']; ?>">
                      <div class="col-6">
                        <img class="h-100 w-100" src='<?php echo $baseurl.$modelData['product_image']; ?>'>
                      </div>
                      <div class="col-6">
                            <div class="col-12">
                                <div class="col-12">
                                    <label for="pname" class="form-label">Product Name</label>
                                    <input type="text" name="p_name" class="form-control" id="pname" value='<?php echo $modelData['product_name']; ?>'>
                                </div>
                                <div class="col-12">
                                    <label for="pprice" class="form-label">Product Price</label>
                                    <input type="text" name="p_price" class="form-control" id="pprice" value='<?php echo $modelData['product_price']; ?>' >
                                </div>
                            </div>
                      </div>
                     
                      <div class="col-12">
                        <label for="pdescription" class="form-label">Product Description</label>
                        <input type="text" name="p_description" class="form-control" id="pdescription" value='<?php echo $modelData['product_description']; ?>'>
                      </div>
                      <div class="col-12">
                        <label for="prating" class="form-label">Product Rating</label>
                        <input type="text" name="p_rating" class="form-control" id="prating" value='<?php echo $modelData['product_rating']; ?>' >
                      </div>
                      
                      
                      <button type="submit" name="edit_product" class="btn btn-info">Save Changes</button>
            
                    </form>
        
        
                  </div>
                  
                </div>
              </div>
            </div>
            
    <?php
        if($modal==true){
            
            echo '<script type="text/javascript">
            
                $(document).ready(function(){
                    $("#exampleModal").modal("show");
                });
                
            </script>   ';
        }
    
    ?>
 
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
          
    </body>
</html>




