<?php 
 
include '_session.php';

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>

     <!-- bootstrap css -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">
  
    <style>
        #cart-count{
            text-align:center;
            padding: 0px 0.9rem 0.1rem 0.9rem;
            border-radius:3rem;
            font-size:20px;
            margin-left:2px;
            margin-bottom:1px;
        }
    </style>
   

</head>

<body>

        <?php
          include '_dbconnect.php';
          $userid = $_SESSION['userid'];
           $exitssql = " SELECT * FROM `cart` where userid = '$userid'";
            $result = mysqli_query($conn, $exitssql);
            $numrows = mysqli_num_rows($result);
        ?>

    <!-- header section starts -->
    <header class="header">

        <div class="header-1">
            <a href="index.php" class="logo"><i class="fas fa-book">Books</i></a>

            <form action="/project2/search.php" class="search-form" method="get">
                <input type="search" name="search" placeholder="search here..." id="search-box" aria-label="Search">
                <button for="search-box" class="fas fa-search" type="submit" style="font-size: 23px; margin-right:10px;"></button>
            </form>

            <div class="icons">
                <div id="search-btn" class="fas fa-search"></div>
                <a href="#" class="fas fa-heart" style="text-decoration:none"></a>
                <a href="cart.php" class="fas fa-shopping-cart" style="text-decoration:none"></a>
                <?php

               
                  
                    echo '<span id="cart-count" style="background:#c9a030">'.$numrows.'</span>';
              
               
                ?>
                <?php 
               if(!$isse){
                echo "&nbsp;&nbsp;&nbsp;&nbsp";
                echo '<span style="font-size: 20px;">' . $_SESSION['username'] .'</span>';
                echo '<a href="logout.php" class="fas fa-sign-out-alt" style="text-decoration:none"></a>';
               }
               else{    
                   echo '<a href="loginpage.php" class="fas fa-user"></a>';
                
                 }    
               ?>
                
             
            </div>
        </div>


        <div class="header-2">
            <nav class="navbar" style="margin-right:350px; margin-left:350px;">
                <a href="index.php"  style="text-decoration:none;">Home</a>
                <a href="featured.php"  style="text-decoration:none;">Books</a>
                <a href="sell.php"  style="text-decoration:none;">Sell</a>
                <a href="orders.php"  style="text-decoration:none;">Orders</a>
                <a href="listing.php"  style="text-decoration:none;">Book Listing</a>
                <a href="blogs.php"  style="text-decoration:none;">Blogs</a>
            </nav>
        </div>

     </header>

    <!-- header section ends -->

     <!-- bottom navbar -->

     <nav class="bottom-navbar">
        <a href="index.php" class="fas fa-home" style="text-decoration:none"></a>
        <a href="featured.php" class="fas fa-list" style="text-decoration:none"></a>
        <a href="sell.php" class="fas fa-truck" style="text-decoration:none"></a>
        <a href="orders.php" class="fas fa-tags" style="text-decoration:none"></a>
        <a href="listing.php" class="fas fa-comments" style="text-decoration:none"></a>
        <a href="blogs.php" class="fas fa-blog" style="text-decoration:none"></a>
        
    </nav>

    <!-- bottom navbar ends -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

   <!-- javascript file   -->
    <script src="script.js"></script>
</body>