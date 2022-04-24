<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

</head>

<body class="bg-light">

    <?php
        include 'partials/_dbconnect.php';
        $bid = $_GET['blogid'];

        $sql = "SELECT * FROM blogs WHERE `bno`='$bid'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $btitle = $row['btitle'];
        $bdesc = $row['blog'];
        $userid = $row['user_id'];
        $date =$row['date'];


        $sqli = "SELECT * FROM  `signuptable` WHERE `sr_no`='$userid'";
        $result = mysqli_query($conn,$sqli);
        $row =  mysqli_fetch_assoc($result);
        $uname = $row['name'];
        $usurname = $row['surname'];
    ?>

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/500x600/?books" class="w-100" alt="..."
                    style="height:500px;">
          
            </div>
            

        </div>
    </div>

    <h5 style="color:#3b3b39;font-size:50px;" class="text-center my-5"><?php echo $btitle ?> </h5>
    <p style="color:#3b3b39;font-size:25px;" class="text-center my-1">By <strong><?php echo $uname ?>&nbsp<?php echo $usurname?></strong>&nbsp on <?php echo $date; ?> </p>

    <p class="my-5 mx-5" style="font-size:25px;font-family: 'Roboto', sans-serif;">
        &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<?php echo $bdesc; ?>
    </p>


    <?php  

        include 'partials/_footer.php';
    ?>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- javascript file   -->
    <script src="script.js"></script>
</body>

</html>