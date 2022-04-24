<?php
    session_start();
    include 'partials/_dbconnect.php';

   if(isset($_POST['remove']))
   {
     if($_GET['action']=='remove'){
         $userid = $_SESSION['userid'];
        $del = $_GET['id'];
         $sqli = "DELETE FROM `cart` WHERE `cart`.`order_id` = '$del' AND `cart`.`userid` = '$userid' ";
         $result = mysqli_query($conn, $sqli);
     }
   }

  
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

    <style>
        .shopping-cart{
            padding: 3% 0;
        }

        .cart-items{
            padding: 2% 0;
        
        }
        .price-details h6{
            padding: 3% 2%;
        }


    </style>

 
    
</head>
<body class="bg-light">
      <?php  
        include 'partials/_header.php';
        include 'partials/_dbconnect.php'
      ?>  
    
       <div class="container-fluid">
           <div class="row px-5">
               <div class="col-md-7">
                   <div class="shopping-cart">
                    <h6 style="font-size:20px">My Cart</h6>
                    <hr>
                    
                    <?php
                        $total = 0;

                        $userid = $_SESSION['userid'];
                        $exitssql = " SELECT * FROM `cart` where userid = '$userid'";
                         $result = mysqli_query($conn, $exitssql);
                         $numrows = mysqli_num_rows($result);


                        if($numrows>0){
                            

                        $sqlii = "SELECT * FROM bookorder INNER JOIN cart ON bookorder.order_id = cart.order_id";
                        $result = mysqli_query($conn, $sqlii);

                        while($row = mysqli_fetch_assoc($result)){
                            $order_id = $row['order_id'];
                            $bookim = $row['bookimage'];
                            $bookn = $row['bookname'];
                            $author = $row['authorname'];
                            $priceb = $row['price'];
                                if($userid == $row['userid'])
                                {
                                 echo '<form action="cart.php?action=remove&id='.$row['order_id'].'" method="post" class="cart-items" name="buynowform">
                                 <div class="border rounded">
                                     <div class="row bg-white">
                                         <div class="col-md-3 pl-0">
                                         <a href="product.php?order_id= '.$order_id.'"><img src="uploadimg/'.$bookim.'" alt="image" class="img-fluid" style="height: 220px;width:150px;"></a>
                                         </div>
                                         <div class="col-md-6" style="height: 220px;">
                                         <a href="product.php?order_id= '.$order_id.'" style="text-decoration:none;color:#b88803"><h5 class="pt-2 mt-4" style="font-size:20px;">'.$bookn.'</h5></a>
                                             <h6 class="text-secondary my-2" style="font-size:15px;">'.$author.'</h6>
                                             <h5 class="pt-2 my-2" style="font-size:17px"><i class="fas fa-rupee-sign"></i>'.$priceb.'</h5>
                                             <button type="submit" class="btn btn-primary" style="margin-top:35px" name="buy" formaction="buy.php?order_id='.$row['order_id'].'">Buy Now</button>
                                             <button type="submit" class="btn btn-danger mx-2" name="remove" style="margin-top:35px">Remove</button>
                                         </div>
                                         
                                     </div>
                                 </div>
                             </form>';
                             $total = $total + (int)$row['price'];
                        }
                    }
            
            }
            else{
                echo "<h5>Cart is empty</h5>";
            }
                    ?>

                    
                   </div>
               </div>

               <div class="col-md-4 offset-md-1 border rounded bg-white h-25" style="margin-top:50px;" >
                <div class="pt-4" >
                    <h6 style="font-size:20px">Price Details</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6" >
                            <?php 
                                    echo '<h6 style="font-size:15px;">Price('.$numrows.' items)</h6>';
                            
                            ?>
                            <h6 style="font-size:15px;">Delivery Charges</h6>
                            <hr>
                            <h6 style="font-size:15px;">Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6 style="font-size:15px;"><i class="fas fa-rupee-sign"></i><?php echo $total ?></h6>
                            <h6 class="text-success"style="font-size:15px;">Free</h6>
                            <hr>
                            <h6 style="font-size:15px;"><i class="fas fa-rupee-sign"></i><?php echo $total ?></h6>
                        </div>
                    </div>
                </div>

               </div>
           </div>
       </div>
   



    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- javascript file   -->
    <script src="script.js"></script>
</body>
</html>