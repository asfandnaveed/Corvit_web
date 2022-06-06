<?php
require 'connection.php';

$baseUrl="";

$showModal=false;
$editProductRow;


if(isset($_POST['delete'])){
    
    $id=$_POST['id'];
    $date=date("Y-m-d H:i:s");
    
    $deleteSqlQuery="UPDATE products SET deleted_at='$date' WHERE id='$id'";
    
    if($con->query($deleteSqlQuery)){
        
    }
    
}


if(isset($_POST['update'])){
    
    $id = $_POST['id'];
    
    $editSqlQuery="SELECT * FROM products WHERE id='$id'";
    
    $editResult = $con-> query($editSqlQuery);
    
    if($editResult->num_rows ==1){
        
        $editProductRow = $editResult-> fetch_assoc();
        
        $showModal=true;
        
        echo $editProductRow['product_name'];
    }
    
}




$Query ="SELECT * FROM products";

$result= $con->query($Query);



?>

<html>
    <head>
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
 
 
 
        <script type="text/javascript" src="js/jquery-3.6.0.js"></script>
    </head>
    <body>
        <table class="table table-striped table-dark">
            <thead>
                <th>ID</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Description</th>
                <th>Product Rating</th>
                <th>Update</th>
                <th>Delete</th>
            </thead>
            <?php
            if($result->num_rows>0){
                
     while($row=$result->fetch_assoc()){
       
       
       if($row['deleted_at']==NULL){
           
               echo '<tr>';
           echo '<td>'.$row['id'].'</td>';
           echo '<td><img class="h-50 w-50" src="'.$baseUrl.$row['product_image'].'"></td>';
           echo '<td>'.$row['product_name'].'</td>';
           echo '<td>'.$row['product_price'].'</td>';
           echo '<td>'.$row['product_description'].'</td>';
           echo '<td>'.$row['product_rating'].'</td>';
           
           echo '<td>
              <form action="dashboard1.php" method="POST">
                   <input type="hidden" name="id" value="'.$row["id"].'">
                   <input type="submit" name="update" value="Edit" class="btn btn-primary">
               </form>
           </td>';
           echo '<td>
               <form action="dashboard1.php" method="POST">
                   <input type="hidden" name="id" value="'.$row["id"].'">
                   <input type="submit" name="delete" value="delete" class="btn btn-danger">
               </form>
           </td>';
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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3">
 
          <div class="col-6">
            <img class="h-100 w-100" src="<?php echo $baseUrl.$editProductRow['product_image'] ?>">
          </div>
          <div class="col-6">
                <div class="col-12">
                    <div class="col-12">
                        <label for="pname" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="pname" value="<?php echo $editProductRow['product_name']; ?>">
                    </div>
                    <div class="col-12">
                        <label for="pprice" class="form-label">Product Price</label>
                        <input type="text" class="form-control" id="pprice" value="<?php echo $editProductRow['product_price']; ?>">
                    </div>
                </div>
          </div>
         
          <div class="col-12">
            <label for="pdescription" class="form-label">Product Description</label>
            <input type="text" class="form-control" id="pdescription" value="<?php echo $editProductRow['product_description']; ?>" >
          </div>
          <div class="col-12">
            <label for="prating" class="form-label">Product Rating</label>
            <input type="text" class="form-control" id="prating" value="<?php echo $editProductRow['product_rating']; ?>">
          </div>

        </form>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
   
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
       
       <?php
       
       if($showModal==true){
           
           echo '<script type="text/javascript">
           
            $(document).ready(function(){
                $("#exampleModal").modal("show");
            });
            
       </script>';
           
       }
       
       ?>
       
       
    </body>
</html>




