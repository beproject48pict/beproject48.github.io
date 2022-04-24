<?php
    session_start();
    $isse = false;
   
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


   if(isset($_POST['booksubmit']))
   {
        $bookid = $_GET['order_id'];
        $ruserid = $_SESSION['userid'];
        $rusername = $_SESSION['username'];
        $review = $_POST['review'];

        $query = "INSERT INTO `book review` ( `book_id`, `user_id`, `uname`, `review`, `dot`) VALUES ( '$bookid', '$ruserid', '$rusername', '$review', current_timestamp())";
        $query_run = mysqli_query($conn,$query);

   }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">


</head>

<body>

    <?php  
        include 'partials/_header.php';
        include 'partials/_dbconnect.php';
        $id = $_GET['order_id'];
        $sql = "SELECT * FROM `bookorder` where order_id=$id";
        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result)){;
        $bookimage = $row['bookimage'];
        $bookn = $row['bookname'];
        $author = $row['authorname'];
        $publi = $row['publication'];
        $priceb = $row['price'];
        $desc = $row['descrip'];
        }
      ?>
    <div class="">
        <?php
          echo '
        <form action="/project2/product.php?order_id='.$id.'" method="post" class="cart-items my-5" name="buynowform">
            <div class="border rounded">
                <div class="row bg-white">
                    <div class="col-md-3 pl-0" style="width:500px;margin-left:10px;">
                        <img src="uploadimg/'.$bookimage.'" alt="image" class="img-fluid" style="height: 500px;width:415px;">
                    </div>
                    <div class="col-md-6" style="height: 220px;">
                        <h5 class="pt-2 mt-4" style="font-size:35px">'.$bookn.'</h5>
                        <h6 class="text-secondary my-4" style="font-size:25px;">'.$author.'</h6>
                        <h6 class="text-secondary my-4" style="font-size:20px;">'.$publi.'</h6>
                        <h5 class="pt-2 my-4" style="font-size:25px"><i class="fas fa-rupee-sign"></i>'.$priceb.'</h5>
                        <p class="mt-4" style="font-size:17px">'.substr($desc,0,400).'....</p>
                        
                        <button type="submit" class="btn btn-primary" style="margin-top:35px;" name="cartbtn" >Add to cart</button>
                        <input type="hidden" name="order_id" value="'.$id.'">
        
                        <button type="submit" class="btn btn-danger mx-2" style="margin-top:35px; name="buybtn" formaction="/project2/buy.php?order_id='.$id.'">Buy Now</button>
                
                    </div>
                    
                </div>
            </div>
         </form>'

         
         ?>
    </div>

    <div class="bg-light" style="margin-left:150px;margin-right:150px;">
        <h3 class="d-flex justify-content-center mt-10" style="font-size:30px;">Book Reviews</h3>
        <form action="/project2/product.php?order_id=<?php echo $id?>" method="post" style="margin-left:250px;margin-right:250px;margin-bottom:40px;">
            <h4>Add Your review here</h4>
            <div class="mb-3">
                <textarea class="form-control" id="desc" rows="3" name="review"></textarea>
            </div>
            <button type="submit" name="booksubmit" class="btn" >Submit</button>
       </form>
        
        
        <?php 
            $sqli = "SELECT * FROM `book review` where book_id='$id'";
            $result = mysqli_query($conn,$sqli);

            if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                if($id == $row['book_id']){
                echo '<div class="mt-4" style="margin-left:250px;margin-right:250px;">
                <div class="">
                    <img src="userdefault.jpg" alt="..." style="height:30px;width:30px;">
                    <div class=" " style="font-size:15px;font-weight:bold;">'.$row['uname'].'  '.$row['dot'].'</div>
                </div>
                
                <div class=" " style="font-size:14px;">
                    '.$row['review'].'
                </div>
    
            </div>';
                }
            }
        }
        else{
            echo ' <div>
            <h3 style="margin-left:250px;margin-right:250px;font-size:20px;font-weight:bold;"> Be first to review book</h3>
        </div>';
        }
        ?>
      
       


    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- javascript file   -->
    <script src="script.js"></script>
</body>

</html>