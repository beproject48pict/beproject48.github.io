<?php
    session_start();
    $isse = false;
    $showerror2 = false;
   
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    { 
        $isse = true;
        session_destroy();
        // header("location: loginpage.php");  
    }

    if($_SERVER['REQUEST_METHOD'] =='POST'){

        include 'partials/_dbconnect.php';

        if(isset($_POST['cartbtn']))
        {
            $orderid = $_POST['order_id'];
            $userid = $_SESSION['userid'];

            $exitssql = " SELECT * FROM `cart` where userid = '$userid' AND order_id = '$orderid'";
            $result = mysqli_query($conn, $exitssql);
            $numrows = mysqli_num_rows($result);
           if($numrows>0)
           {
            $showerror2 = true;
           }
           else{
            $sqlie = "INSERT INTO `cart` (`order_id`, `userid`) VALUES ('$orderid', '$userid')";
            $result = mysqli_query($conn, $sqlie);

         
           }   
        }
            
   }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Featured</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">
    

</head>
<body>
    <?php

        if($showerror2){
            echo '<div class="alert alert-danger alert-dismissible fade show mb-0 " role="alert">
            <strong>Product Already in cart!!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>
      <?php  
        include 'partials/_header.php';
        include 'partials/_dbconnect.php';
      ?>  
   
     <div class="container my-3">
         
         <div class="row">

             <?php 
                $per_page = 9;
                $start = 0;
                $current_page = 1;

                if(isset($_GET['start'])){
                    $start = $_GET['start'];
                    if($start<=0)
                    {
                        $start = 0;
                        $current_page = 1;
                    }
                    else{
                        $current_page = $start;
                        $start--;
                        $start = $start*$per_page;
                    }
                }

                $record = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `bookorder`"));
                $pagi = ceil($record/$per_page);

                $sql = "SELECT * FROM `bookorder` limit $start,$per_page ";
                $result = mysqli_query($conn, $sql);


                if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $order_id= $row['order_id'];
                    ?>
                
                  <div class="col-md-4 my-3" >
                    <form action="/project2/featured.php" method="post" class="h-100">
                        <div class="card mx-auto h-100" style="width: 18rem;">
                           <?php if($isse) {?>

                            <a href="product.php?order_id= <?php echo $row['order_id']; ?>" style="pointer-events:none"><img src="<?php echo "uploadimg/".$row['bookimage']; ?>" class="card-img-top" alt="Image not available" style="height:255px; width:178px"></a>
                            <?php } 
                            else {?>
                            <a href="product.php?order_id= <?php echo $row['order_id']; ?>"><img src="<?php echo "uploadimg/".$row['bookimage']; ?>" class="card-img-top" alt="Image not available" style="height:255px; width:178px"></a>
                            <?php } ?>
                            <div class="card-body" >
                            <?php if($isse) {?>
                            <a href="product.php?order_id= <?php echo $row['order_id'];?>" style="text-decoration:none;color:#b88803;pointer-events:none"><h3 class="card-title"><?php echo $row['bookname'];?></a>
                            <?php } 
                            else {?>
                            <a href="product.php?order_id= <?php echo $row['order_id'];?>" style="text-decoration:none;color:#b88803;"><h3 class="card-title"><?php echo $row['bookname'];?></a>
                            <?php } ?>
                            <h4 class="card-title"><?php echo $row['authorname'];?></h4>
                                <h4 class="card-text"><?php echo $row['publication']; ?></h4>
                                <h4 class="card-title"><i class="fas fa-rupee-sign"></i><?php echo $row['price']; ?></h4>
                                
                            </div>
                            <?php if(!$isse){  ?>
                            <button href="#" type="submit" class="btn btn-primary" name="cartbtn">Add to Cart</buttton>
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                            <?php } ?>
                        </div>
                    </form>
                </div> 
              
            <?php
                }
            }
            else{
                echo 'No Records Found';
            }
            ?>
              
         </div>

         <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center fs-3 my-3">
                <?php 
                  $nextp = $current_page;
                  $prev = $current_page;
                  $prev--;
                  $nextp++;
                 ?>
                 <?php 
                    $class2 = "";
                    if($current_page==1) {
                        $class2 = "disabled";
                    }
                 ?>
                <li class="page-item <?php echo $class2?>">
                <a class="page-link text-dark" href="?start=<?php echo $prev ?>">Previous</a>
                </li>

                <?php for($i=1;$i<=$pagi;$i++)  { 
                    $class="";
                    if($current_page==$i)
                    {
                        $class = "active";
                    }  
                    ?>
                <li class="page-item <?php echo $class?> " ><a class="page-link text-dark" <?php if($class=="active"){?>style="background-color:#c9a030;" <?php }  ?>   href="?start=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php } ?>

                <?php 
                    $class1 = "";
                    if($pagi==$current_page) {
                        $class1 = "disabled";
                    }
                 ?>
                <li class="page-item <?php echo $class1?>">
                <a class="page-link text-dark" href="?start=<?php echo $nextp ?>">Next</a>
                </li>
            </ul>
       
        </nav>
     
        
     </div>
    


    <!-- newsletter -->

    <section class="newsletter">

        <form action="">
            <h3>subscribe for latest update</h3>
            <input type="email" name="" placeholder="enter your email" id="" class="box">
            <input type="submit" value="subscribe" class="btn">
        </form>
    </section>
    
    <!-- newsletter ends -->

    <!-- footer section -->
    <?php  
        include 'partials/_footer.php';
      ?>
  


<!-- footer section ends -->












      <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

      <!-- javascript file   -->
      <script src="script.js"></script>
</body>
</html>