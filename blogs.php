<?php
    session_start();
    $isse = false;
    $alert = false;
   
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    { 
        $isse = true;
        session_destroy();
        // header("location: loginpage.php");  
    }

    if(isset($_POST['blogsubmit']))
    {
        include 'partials/_dbconnect.php';

        $blogtitle = $_POST['btitle'];
        $blog = $_POST['blog'];
        $userid = $_SESSION['userid'];

        $sql = "INSERT INTO `blogs` ( `user_id`, `btitle`, `blog`, `date`) VALUES ('$userid', '$blogtitle', '$blog', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $alert = true;



    }
 

?>

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

    <style>
    .heading {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .heading span {
        font-size: 2.5rem;
        font-family: Georgia, serif;
        padding: .5rem 2rem;
        color: var(--black);
        background: #fff;
        border: var(--border);
    }
    </style>

</head>

<body>
    <?php  
        include 'partials/_header.php';
        include 'partials/_dbconnect.php';
      ?>
    <?php
        if($alert){
        echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        <strong>Your Blog submitted Successfully!!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>

  


    <section class="blogs" id="blogs">

        <form action="blogs.php" method="post">

            <h3 class="heading"><span>Write Your Blog Here</span></h3>
            <span class="mt-4" style="font-size:18px;font-family: Georgia, serif;">Blog Title:</span><br>
            <input type="text" name="btitle" class="box mt-3"
                style="height:35px;width:900px;font-size:17px;border: double #888;border-radius:8px;">
            <textarea type="text" name="blog" class="box my-5" rows="12" cols="150"
                style="font-size:17px; border: double #888; border-radius:8px;"></textarea>

            <?php if(!$isse){  ?>
            <input type="submit" name="blogsubmit" value="Submit" class="btn">
            <?php } ?>

        </form>

        <h1 class="heading mt-5"><span>Blogs</span></h1>

        <div class="container my-3">
            <div class="row">
            <?php
                $sqli = "SELECT * FROM `blogs`";
                $result = mysqli_query($conn, $sqli);   
                
                while($row = mysqli_fetch_assoc($result))
                {
                    $btitle = $row['btitle'];
                    $bdisc = $row['blog'];
                    $bid = $row['bno'];
                    echo '<div class="col-md-4 my-3">
                    <div class="card mx-auto" style="width: 18rem;">
                        <img src="https://source.unsplash.com/500x600/?books,'.$btitle.'" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">'.$btitle.'</h5>
                            <p class="card-text">'.substr($bdisc,0,90).'...</p>
                            <a href="bload.php?blogid='.$bid.'" class="btn btn-primary">Load More</a>
                        </div>
                    </div>
                </div>';
                }
            ?>
               

            </div>

        </div>

    </section>


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